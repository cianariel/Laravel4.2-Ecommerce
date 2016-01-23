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
    }