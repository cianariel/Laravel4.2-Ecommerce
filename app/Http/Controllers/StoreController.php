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
                    'updateStore', 'getAllStores','deleteStore'
                ]]);

            $this->store = new Store();
            $this->media = new Media();

        }

        public function updateStore()
        {
            $inputData = \Input::all();
            $store = null;
            try
            {
                if (!isset($inputData['StoreId']) || ($inputData['StoreId'] == ''))
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


                $this->media->media_name = $inputData['StoreIdentifier'];
                $this->media->media_type = 'img-upload';
                $this->media->media_link = $inputData['MediaLink'];

                $result = $store->medias()->save($this->media);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($result);

            } catch (\Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }
        }

        public function deleteStore()
        {
            $storeId = \Input::get('StoreId');

            $store = $this->store->find($storeId);
            if ($store == null)
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("No data available !");

            foreach ($store->medias as $media)
            {
                $this->media->deleteMediaItem($media->id);
            }

            $this->store->find($storeId)->delete();

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse("Data deleted Successfully");

        }

        public function getAllStores()
        {
            $store = $this->store->with('medias')->get();
            $storeInfo = null;
            try
            {
                foreach ($store as $key => $value)
                {
                    $storeInfo[ $key ]['Id'] = $store[ $key ]['id'];
                    $storeInfo[ $key ]['Name'] = $store[ $key ]['store_name'];
                    $storeInfo[ $key ]['Identifier'] = $store[ $key ]['store_identifier'];
                    $storeInfo[ $key ]['Status'] = $store[ $key ]['status'];
                    $storeInfo[ $key ]['Description'] = $store[ $key ]['store_description'];

                    $storeInfo[ $key ]['ImageLink'] = $store[ $key ]->medias[0]->media_link;

                    $strReplace = \Config::get("const.file.s3-path");// "http://s3-us-west-1.amazonaws.com/ideaing-01/";
                    $file = str_replace($strReplace, '', $store[ $key ]->medias[0]->media_link);

                    $storeInfo[ $key ]['ThumbImageLink'] = $strReplace . 'thumb-' . $file;
                }

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($storeInfo);

            } catch (\Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }


            // dd($storeInfo);//($store[0]->medias);
        }
    }
