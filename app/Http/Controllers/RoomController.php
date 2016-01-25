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
    use Storage;
    use Folklore\Image\Facades;
    use Carbon\Carbon;


    class RoomController extends ApiController {
        public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth',
                ['except' => [
                    'publishProduct', 'searchProductByName', 'updateProductInfo', 'productDetailsView',
                    'getAllProductList','getProducts' ,'getProductById', 'isPermalinkExist', 'addRoom',
                    'addMediaForProduct', 'addMediaInfo', 'getMediaForProduct', 'deleteSingleMediaItem',
                    'getProductInfoFromApi', 'priceUpdate', 'deleteProduct'
                ]]);
            $this->product = new Product();
            $this->room = new Room();
            $this->media = new Media();
        }
        public function addRoom()
        {
            try
            {
                $inputData = \Input::all();
                $newProduct = $this->room->create($inputData);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($newProduct);

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }
        public function addMediaForRoom(Request $request)
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
                $fileName = 'room-image-' . uniqid() . '-' . $request->file('file')->getClientOriginalName();

                // pointing filesystem to AWS S3
                $s3 = Storage::disk('s3');

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
                }


                if ($s3->put($fileName, file_get_contents($request->file('file')), 'public'))
                {
                    $fileResponse['result'] = \Config::get("const.file.s3-path") . $fileName;
                    $fileResponse['status_code'] = \Config::get("const.api-status.success");

                    return $fileResponse;
                }
            }

        }
    }