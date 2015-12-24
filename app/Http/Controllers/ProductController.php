<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use App\Models\Product;

    class ProductController extends ApiController {

        public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth', ['except' => ['updateProductInfo', 'getAllProductList', 'getProductById', 'isPermalinkExist', 'addProduct']]);
            $this->product = new Product();
        }

        public function isPermalinkExist($permalink)
        {
            // $inputData = \Input::all();

            $product = $this->product->checkPermalink($permalink);//($inputData['Permalink']);
            if ($product == false)
                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse(\Config::get("const.product.permalink-exist"));
            else
                return $this->setStatusCode(\Config::get("const.api-status.success-with-variation"))
                    ->makeResponse($product);
        }

        public function addProduct()
        {
            $inputData = \Input::all();

            try
            {
                $product = $this->isPermalinkExist($inputData['Permalink']);

                if (json_decode($product->getContent())->status_code == \Config::get("const.api-status.success"))
                {
                    $newProduct = $this->product->firstOrCreate(['product_permalink' => $inputData['Permalink'], 'post_status' => 'Inactive']);

                    return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($newProduct);
                } else
                {
                    return $this->setStatusCode(\Config::get("const.api-status.app-failure"))
                        ->makeResponseWithError(\Config::get("const.product.can-not-create-product"));
                }
            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }

        public function getProductById($id = null)
        {
            try
            {
                $product = $this->product->where('id', $id)->first();

                if ($product == null)
                {
                    return $this->setStatusCode(\Config::get("const.api-status.app-failure"))
                        ->makeResponseWithError(\Config::get("const.product.product-not-found"));
                } else
                {
                    return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($product);
                }

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }

        public function getAllProductList()
        {
            try
            {
                $settings['ActiveItem'] = (\Input::get('ActiveItem') == 'Active') ? true : false;
                $settings['CategoryId'] = (\Input::get('CategoryId') == null) ? null : \Input::get('CategoryId');

                $settings['limit'] = \Input::get('limit');
                $settings['page'] = \Input::get('page');

                $productList = $this->product->getProductList($settings);

                $settings['total'] = $productList['total'];
                array_forget($productList, 'total');

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse(array_merge($productList, $settings));
            } catch (Excpetion $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }
        }


        public function updateProductInfo()
        {
            try
            {
                $data = \Input::all();
                $this->product->updateProductInfo($data);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse("Update Successful.");

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }

        public function addMediaContent()
        {

        }


    }