<?php

    namespace App\Http\Controllers;


    use Aws\CloudFront\Exception\Exception;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use App\Models\Product;
    use App\Models\Media;
    use Illuminate\Contracts\Filesystem\Factory;
    use Storage;
    use Folklore\Image\Facades;
    use Carbon\Carbon;
    use App\Models\ProductCategory;
    use App\Core\ProductApi\ProductStrategy;

    class ProductController extends ApiController {

        public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth',
                ['except' => [
                    'publishProduct', 'searchProductByName', 'updateProductInfo', 'productDetailsView',
                    'getAllProductList', 'getProductById', 'isPermalinkExist', 'addProduct',
                    'addMediaForProduct', 'addMediaInfo', 'getMediaForProduct', 'deleteSingleMediaItem',
                    'getProductInfoFromApi', 'priceUpdate', 'deleteProduct'
                ]]);
            $this->product = new Product();

            $this->media = new Media();
        }

        /**
         * @param $permalink
         * @return mixed
         */
        public function isPermalinkExist($permalink)
        {
            $product = $this->product->checkPermalink($permalink);//($inputData['Permalink']);
            if ($product == false)
                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse(\Config::get("const.product.permalink-exist"));
            else
                return $this->setStatusCode(\Config::get("const.api-status.success-with-variation"))
                    ->makeResponse($product);
        }


        /** Set a default product entry with post status as Inactive.
         * @return mixed
         */
        public function addProduct()
        {
            try
            {
                $newProduct = $this->product->create(['post_status' => 'Inactive']);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($newProduct);

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }


        /**
         * @param null $id
         * @return mixed
         */
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


        // Generating Category tree Hierarchy
        public function generateCategoryHierarchy($catId)
        {
            //todo : implement proper response mechanism
            return $this->product->getCategoryHierarchy($catId);
        }

        /*
         * generate data for public view
         * */
        /**
         * @param $permalink
         * @return mixed
         */
        public function productDetailsView($permalink)
        {
            try
            {
                $productData['product'] = $this->product->getViewForPublic($permalink);

                // Get category tree
                $catTree = $this->generateCategoryHierarchy($productData['product']->product_category_id);

                $result = $this->product->productDetailsViewGenerate($productData, $catTree);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($result);

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }
        }

        /**
         * @return mixed
         */
        public function getAllProductList()
        {
            try
            {
                $settings['ActiveItem'] = (\Input::get('ActiveItem') == 'Active') ? true : false;
                $settings['CategoryId'] = (\Input::get('CategoryId') == null) ? null : \Input::get('CategoryId');
                $settings['FilterType'] = (\Input::get('FilterType') == null) ? null : \Input::get('FilterType');
                $settings['FilterText'] = (\Input::get('FilterText') == null) ? null : \Input::get('FilterText');

                $settings['limit'] = \Input::get('limit');
                $settings['page'] = \Input::get('page');

                $productList = $this->product->getProductList($settings);

                // dd($productList);
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


        /**
         * @return mixed
         */
        public function updateProductInfo()
        {
            try
            {
                $inputData = \Input::all();
                //$inputData['SimilarProductIds'] = $inputData['SimilarProductIds'];

                $newProduct = $this->product->updateProductInfo($inputData);

                // dd($newProduct);
                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($newProduct);
            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }
        }


        /** Delete product.
         * @return mixed
         * @internal param $productId
         */
        public function deleteProduct()
        {
            $id = \Input::get('ProductId');

            $records = $this->product->find($id);
            if ($records == null)
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("No data available !");

            foreach ($records->medias as $record)
            {
                $this->deleteMediaById($record->id);
            }

            $this->product->find($id)->delete();

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse("Data deleted Successfully");

        }


        /**
         * @return mixed
         */
        public function publishProduct()
        {
            try
            {
                $inputData = \Input::all();

                $tempInputData = $inputData;
                $tempInputData['Specifications'] = null;
                $tempInputData['SimilarProductIds'] = null;
                $tempInputData['Review'] = null;

                $validationRules = [
                    'rules'  => [
                        'Name'         => 'required',
                        'Permalink'    => 'required',
                        'selectedItem' => 'required'
                    ],
                    'values' => [
                        'Name'         => isset($tempInputData['Name']) ? $tempInputData['Name'] : null,
                        'Permalink'    => isset($tempInputData['Permalink']) ? $tempInputData['Permalink'] : null,
                        'selectedItem' => isset($tempInputData['CategoryId']) ? $tempInputData['CategoryId'] : null
                    ]
                ];

                list($productData, $validator) = $this->inputValidation($tempInputData, $validationRules);

                $productData['Specifications'] = $inputData['Specifications'];
                $productData['SimilarProductIds'] = $inputData['SimilarProductIds'];
                $productData['Review'] = $inputData['Review'];

                //$this->inputValidation($inputData,$validationRules);

                if ($validator->passes())
                {
                    $updatedProduct = $this->product->updateProductInfo($productData);
                    //  $updatedProduct->post_status = 'Active';
                    //   $updatedProduct->save();

                    return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse("Update Successful.");
                } elseif ($validator->fails())
                {
                    $validatorMessage = $validator->messages()->toArray();

                    return $this->setStatusCode(\Config::get("const.api-status.validation-fail"))
                        ->makeResponseWithError(array('Validation failed', $validatorMessage));
                }


            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }


        public function searchProductByName($name)
        {
            return Product::where('product_name', 'LIKE', "%$name%")->get(['id', 'product_name AS name']);
        }


        /**
         * @return array
         * @internal param Request|\Request $request
         */


        public function addMediaInfo()
        {
            $inputData = \Input::all();

            $productId = isset($inputData['ProductId']) ? $inputData['ProductId'] : null;

            $product = $this->product->where('id', $productId)->first();

            $media = new Media();

            $media->media_name = $inputData['MediaTitle'];
            $media->media_type = $inputData['MediaType'];
            $media->media_link = $inputData['MediaLink'];
            $media->is_hero_item = $inputData['IsHeroItem'];

            try
            {
                $result = $product->medias()->save($media);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($result);

            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }
        }

        public function getMediaForProduct($id)
        {
            $result = Product::find($id)->medias;

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse($result);

        }

        public function deleteSingleMediaItem()
        {
            $id = \Input::get('MediaId');
            try
            {
                $this->deleteMediaById($id);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse("File deleted successfully");
            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }
        }


        /**
         * @param Request $request
         * @return array
         */
        public function addMediaForProduct(Request $request)
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

        /** Fetch product information form vendor API
         * @param $itemId
         * @return mixed
         */
        public function getProductInfoFromApi($itemId)
        {
            try
            {
                $value = $this->product->getApiProductInformation($itemId); // test id "B0147EVKCQ"
                // return $value;
                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($value);
            } catch (Exception $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }
        }

        public function priceUpdate()
        {
            $this->product->updateProductPrice();
        }

        /** Delete medias for product
         * @param $id
         */
        private function deleteMediaById($id)
        {
            $mediaItem = $this->media->where('id', $id)->first();

            //delete entry from database
            $this->media->where('id', $id)->delete();

            if (($mediaItem['media_type'] == 'img-upload') || ($mediaItem['media_type'] == 'video-upload'))
            {
                // delete file from S3
                $strReplace = \Config::get("const.file.s3-path");// "http://s3-us-west-1.amazonaws.com/ideaing-01/";
                $file = str_replace($strReplace, '', $mediaItem['media_link']);
                $s3 = Storage::disk('s3');
                $s3->delete($file);

                if ($mediaItem['media_type'] == 'img-upload')
                {
                    $file = 'thumb-' . $file;
                    $s3->delete($file);
                }
            }
        }


    }