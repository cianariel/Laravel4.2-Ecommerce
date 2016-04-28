<?php

    namespace App\Http\Controllers;


    use Aws\CloudFront\Exception\Exception;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use App\Models\Giveaway;
    use App\Models\User;
    use App\Models\Media;
    use Illuminate\Contracts\Filesystem\Factory;
    use Illuminate\Support\Facades\Redirect;
    use Storage;
    use Folklore\Image\Facades;
    use Carbon\Carbon;
    use DB;


    class GiveawayController extends ApiController {

        public function enterUser()
        {
            $inputData = \Input::all();

            $user = new User;

            if($authUser = $user->IsAuthorizedUser($inputData)){
                try
                {
                    if(! DB::table('giveaway_users')->where(
                        [
                            'user_id' => $authUser->id,
                            'giveaway_id' => $inputData['giveaway_id'],
                        ]
                    )){
                        DB::table('giveaway_users')->insert(
                            [
                                'user_id' => $authUser->id,
                                'giveaway_id' => $inputData['giveaway_id'],
                            ]
                        );
                        return ['success' => 'Thank you!'];
                    }else{
                        return ['error' => 'You have already entered this Giveaway'];
                    }

                } catch (Exception $ex)
                {
                    return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                        ->makeResponseWithError("System Failure !", $ex);
                }

            }else{
                    return ['error' => 'Incorrect email or password'];
            }
        }

        public function addGiveaway(Request $request)
        {
            try
            {
                $inputData = \Input::all();
                $newGiveaway = $this->giveaway->create($inputData);
                $ImageResult = $this->addMediaForGiveaway($request,'giveaway_image',$newGiveaway->id);
                if($ImageResult['status_code'] == 200)
                {
                   $newGiveaway->giveaway_image = $ImageResult['result'];
                   $newGiveaway->giveaway_status = 1;
                }
                $newGiveaway->save();
                return Redirect::to('/admin/giveaway-edit/'.$newGiveaway->id)->with('id', $newGiveaway->id);
            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }
        public function updateGiveaway(Request $request)
        {
            try
            {
                $inputData = \Input::all();
                $editGiveaway  = Giveaway::find($inputData['giveaway_id']);
                if($inputData['goes_live']){
                    $inputData['goes_live'] = date('Y-m-d', strtotime($inputData['goes_live']));
                }
                $editGiveaway->update($inputData);

                $ImageResult = $this->addMediaForGiveaway($request,'giveaway_image',$editGiveaway->id);
                if($ImageResult['status_code'] == 200)
                {
                   $editGiveaway->giveaway_image = $ImageResult['result'];
                }

                $editGiveaway->save();
                return Redirect::to('/admin/giveaway-edit/'.$editGiveaway->id)->with('id', $editGiveaway->id);

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }
        
        public function addMediaForGiveaway(Request $request,$filename,$Giveaway_id)
        {
            $fileResponse = [];

            if (!$request->hasFile($filename))
            {
                $fileResponse['result'] = \Config::get("const.file.file-not-exist");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");

                return $fileResponse;

            } else if (!$request->file($filename)->isValid())
            {
                $fileResponse['result'] = \Config::get("const.file.file-not-exist");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");

                return $fileResponse;
            } else if (!in_array($request->file($filename)->guessClientExtension(), array("jpeg", "jpg", "bmp", "png", "mp4", "avi", "mkv")))
            {
                $fileResponse['result'] = \Config::get("const.file.file-invalid");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");

                return $fileResponse;
            } else if ($request->file($filename)->getClientSize() > \Config::get("const.file.file-max-size"))
            {
                $fileResponse['result'] = \Config::get("const.file.file-max-limit-exit");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");

                return $fileResponse;
            } else
            {
                $fileName = 'giveaway-image-' . uniqid() . '-' . $request->file($filename)->getClientOriginalName();

                // pointing filesystem to AWS S3
                $s3 = Storage::disk('s3');
                $destinationPath = 'giveaway/'.$Giveaway_id.'/';
                $directory = $s3->makeDirectory($destinationPath);
                // Thumbnail creation and uploading to AWS S3
                if (in_array($request->file($filename)->guessClientExtension(), array("jpeg", "jpg", "bmp", "png")))
                {
                    // $thumb = \Image::make($request->file('file'))->crop(100,100);
                    $thumb = \Image::make($request->file($filename))
                        ->resize(90, null, function ($constraint)
                        {
                            $constraint->aspectRatio();
                        });

                    $thumb = $thumb->stream();
                    $thumbFileName = 'thumb-' . $fileName;
                    $s3->put($destinationPath.$thumbFileName, $thumb->__toString(), 'public');
                }


                if ($s3->put($destinationPath.$fileName, file_get_contents($request->file($filename)), 'public'))
                {
                    $fileResponse['result'] = \Config::get("const.file.s3-path").$destinationPath.$fileName;
                    $fileResponse['status_code'] = \Config::get("const.api-status.success");

                    return $fileResponse;
                }
            }

        }
        public function deleteGiveaway()
        {
            $id = \Input::get('GiveawayId');
            $Giveaway = $this->giveaway->find($id);
            if ($Giveaway == null)
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("No data available !");
            $this->giveaway->find($id)->delete();
            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse("Data deleted Successfully");
        }
    }