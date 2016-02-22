<?php

    namespace App\Http\Controllers;

    use App\Models\Media;
    use Aws\CloudFront\Exception\Exception;
    use Illuminate\Http\Request;

    use App\Http\Requests;


    use Illuminate\Contracts\Filesystem\Factory;
    use Storage;
    use Folklore\Image\Facades;
    use Carbon\Carbon;

    class MediaController extends ApiController {

        public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth',
                ['except' => [
                    'addMediaContent','updateMediaContent','fileUploader','deleteMediaContent'
            ]]);
            $this->media = new Media();
        }


        public function updateMediaContent()
        {
            $inputData = \Input::all();

         //   dd($inputData);
            $data = array(
                "media_name"   => $inputData['MediaTitle'],
                "media_type"   => $inputData['MediaType'],
                "media_link"   => $inputData['MediaLink'],
                "is_hero_item" => $inputData['IsHeroItem'],
                "is_main_item" => $inputData['IsMainItem']
            );

            return Media::where('id','=',$inputData['MediaId'])->update($data);

        }

        public function fileUploader(Request $request)
        {
            $fileResponse = [];

            if (!$request->hasFile('file'))
            {
                $fileResponse['result'] = \Config::get("const.file.file-not-exist");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");

                return $fileResponse;

            } else if (!$request->file('file')->isValid())
            {
                $fileResponse['result'] = \Config::get("const.file.file-not-exist");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");

                return $fileResponse;
            } else if (!in_array($request->file('file')->guessClientExtension(), array("jpeg", "jpg", "bmp", "png", "mp4", "avi", "mkv")))
            {
                $fileResponse['result'] = \Config::get("const.file.file-invalid");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");

                return $fileResponse;
            } else if ($request->file('file')->getClientSize() > \Config::get("const.file.file-max-size"))
            {
                $fileResponse['result'] = \Config::get("const.file.file-max-limit-exit");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");

                return $fileResponse;
            } else
            {
                $fileName = 'product-' . uniqid() . '-' . $request->file('file')->getClientOriginalName();

                // pointing filesystem to AWS S3
                $s3 = Storage::disk('s3');

                if ($s3->put($fileName, file_get_contents($request->file('file')), 'public'))
                {
//                    $fileResponse['result'] = \Config::get("const.file.s3-path") . $fileName;
//                    $fileResponse['status_code'] = \Config::get("const.api-status.success");

//                    return $fileResponse;
                }

                // Thumbnail creation and uploading to AWS S3
                if (in_array($request->file('file')->guessClientExtension(), array("jpeg", "jpg", "bmp", "png")))
                {
                    // $thumb = \Image::make($request->file('file'))->crop(100,100);
                    $thumb = \Image::make($request->file('file'))
                        ->resize(90, null, function ($constraint)
                        {
                            $constraint->aspectRatio();
                        });

                    $thumb = $thumb->stream();
                    $thumbFileName = 'thumb-' . $fileName;
                    
                    $s3->put($thumbFileName, $thumb->__toString(), 'public');
                     $thumb = \Image::make($request->file('file'))->crop(120,120);
//                    $thumb = \Image::make($request->file('file'))
//                        ->resize(120, 120, 1);

                    $thumb = $thumb->stream();
                    $thumbFileName = '120-' . $fileName;
                    $s3->put($thumbFileName, $thumb->__toString(), 'public');

                    $fileResponse['result'] = \Config::get("const.file.s3-path") . $thumbFileName;
                    $fileResponse['status_code'] = \Config::get("const.api-status.success");

                    return $fileResponse;
                    
                }

            }
        }



        public function deleteMediaContent()
        {
            $id = \Input::get('id');
            $this->media->deleteMediaItem($id);

        }


    }
