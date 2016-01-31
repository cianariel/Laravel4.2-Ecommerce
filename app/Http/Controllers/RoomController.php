<?php

    namespace App\Http\Controllers;


    use Aws\CloudFront\Exception\Exception;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use App\Models\Product;
    use App\Models\Room;
    use App\Models\Media;
    use Illuminate\Contracts\Filesystem\Factory;
    use Illuminate\Support\Facades\Redirect;
    use Storage;
    use Folklore\Image\Facades;
    use Carbon\Carbon;


    class RoomController extends ApiController {
        public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth',
                ['except' => [
                    'updateRoom', 'addRoom'
                ]]);
            $this->product = new Product();
            $this->room = new Room();
            $this->media = new Media();
        }
        public function addRoom(Request $request)
        {
            try
            {
                $inputData = \Input::all();
                $newRoom = $this->room->create($inputData);
                $ImageResult = $this->addMediaForRoom($request,'hero_image_1');
                if($ImageResult['status_code'] == 200)
                {
                   $newRoom->hero_image_1 = $ImageResult['result'];
                }

                $ImageResult = $this->addMediaForRoom($request,'hero_image_2');
                if($ImageResult['status_code'] == 200)
                {
                   $newRoom->hero_image_2 = $ImageResult['result'];
                }

                $ImageResult = $this->addMediaForRoom($request,'hero_image_3');
                if($ImageResult['status_code'] == 200)
                {
                   $newRoom->hero_image_3 = $ImageResult['result'];
                }

                $newRoom->save();
                return Redirect::to('/admin/room-edit/'.$newRoom->id)->with('id', $newRoom->id);
                /*return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($newRoom);*/

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }
        public function updateRoom(Request $request)
        {
            try
            {
                $inputData = \Input::all();
                $editRoom  = Room::find($inputData['room_id']);
                $editRoom->update($inputData);
                //$editRoom = $this->room->update($inputData);
                $ImageResult = $this->addMediaForRoom($request,'hero_image_1');
                if($ImageResult['status_code'] == 200)
                {
                   $editRoom->hero_image_1 = $ImageResult['result'];
                }

                $ImageResult = $this->addMediaForRoom($request,'hero_image_2');
                if($ImageResult['status_code'] == 200)
                {
                   $editRoom->hero_image_2 = $ImageResult['result'];
                }

                $ImageResult = $this->addMediaForRoom($request,'hero_image_3');
                if($ImageResult['status_code'] == 200)
                {
                   $editRoom->hero_image_3 = $ImageResult['result'];
                }

                $editRoom->save();
                return Redirect::to('/admin/room-edit/'.$editRoom->id)->with('id', $editRoom->id);
                /*return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($newProduct);*/

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }
        
        public function addMediaForRoom(Request $request,$filename)
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
                $fileName = 'room-image-' . uniqid() . '-' . $request->file($filename)->getClientOriginalName();

                // pointing filesystem to AWS S3
                $s3 = Storage::disk('s3');

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
                    $s3->put($thumbFileName, $thumb->__toString(), 'public');
                }


                if ($s3->put($fileName, file_get_contents($request->file($filename)), 'public'))
                {
                    $fileResponse['result'] = \Config::get("const.file.s3-path") . $fileName;
                    $fileResponse['status_code'] = \Config::get("const.api-status.success");

                    return $fileResponse;
                }
            }

        }
    }