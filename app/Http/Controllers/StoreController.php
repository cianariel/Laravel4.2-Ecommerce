<?php

    namespace App\Http\Controllers;

    use App\Models\Media;
    use App\Models\Store;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;

    class StoreController extends ApiController {

        public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller

            $this->middleware('jwt.auth',
                ['except' => [
                    'updateStore'
                ]]);

            $this->store = new Store();
            $this->media = new Media();

        }

        public function updateStore()
        {
            $inputData = \Input::all();
            $store = null;

            if (!isset($inputData['StoreId']))
            {
                $store = $this->store->create([
                    'store_identifier'  => $inputData['StoreIdentifier'],
                    'store_name'        => $inputData['StoreName'],
                    'status'            => $inputData['StoreStatus'],
                    'store_description' => $inputData['StoreDescription']
                ]);

            } else
            {
                $store = $this->store->where('id', $inputData['StoreId'])->first();

               // $this->media->deleteMediaItem($store->medias[0]['id']);

                $store->store_identifier = $inputData['StoreIdentifier'];
                $store->store_name = $inputData['StoreName'];
                $store->status = $inputData['StoreStatus'];
                $store->store_description = $inputData['StoreDescription'];
                $store->save();
            }

            try
            {
                $this->media->media_name = $inputData['StoreIdentifier'];
                $this->media->media_type = 'img-upload';
                $this->media->media_link = $inputData['MediaLink'];

                $result = $store->medias()->save($this->media);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($result);

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }
        }
    }
