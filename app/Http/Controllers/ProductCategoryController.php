<?php

    namespace App\Http\Controllers;

    use Exception;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    // use App\Http\Controllers\Controller;
    use Illuminate\Http\Response as IlluminateResponse;
    use App\Models\ProductCategory;
    use Crypt;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;

    use CustomAppException;
    use Config;


    /*use App\Events\SendActivationMail;
    use App\Events\SendResetEmail;
    use Crypt;
    use Illuminate\Http\Request;
    use App\Http\Requests;
    use Illuminate\Http\Response as IlluminateResponse;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use App\Models\User;
    use Carbon\Carbon;*/

    class ProductCategoryController extends ApiController {


        public function __construct()
        {

            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth', ['except' => ['showProductInCategoryName', 'updateCategory', 'index', 'addCategory', 'showAllRootCategory', 'destroy']]);
            $this->productCategory = new ProductCategory();


        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return "hi";
            // dd(Config::get('Constant.val'));
            /*try
            {
                $this->productCategory->throwExc();
            } catch (CustomAppException $ex)
            {
                return $ex;
            }*/
        }


        /**
         * Add a category in parent id is not provided or else add a subcategory.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function addCategory(Request $request)
        {
            try
            {
                $inputData = \Input::all();

                // set validation rule to filter input

                $validationRules = [

                    'rules'  => [
                        'CategoryName' => 'required | max: 15',
                        'ExtraInfo'    => 'required | max: 25',
                        'ParentId'     => 'integer'
                    ],
                    'values' => [
                        'CategoryName' => isset($inputData['CategoryName']) ? $inputData['CategoryName'] : null,
                        'CategoryName' => isset($inputData['ExtraInfo']) ? $inputData['ExtraInfo'] : null,
                        'ParentId'     => isset($inputData['ParentId']) ? $inputData['ParentId'] : null
                    ]
                ];

                list($inputData, $validator) = $this->inputValidation($inputData, $validationRules);

                if ($validator->fails())
                {
                    return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                        ->makeResponseWithError(array('Validation failed', $validator->messages()));
                } elseif ($validator->passes())
                {
                    $newCategory = $this->productCategory->addCategory($inputData);

                    /*if ($newCategory == false)
                    {
                        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                            ->makeResponseWithError('Can not save category.');
                    } else*/


                    // return error if a not existing product id given.

                    if ($newCategory == \Config::get("const.product-id-not-exist"))
                    {
                        // dd(\Config::get("const.product-id-exist"));
                        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                            ->makeResponseWithError(\Config::get("const.product-id-not-exist"));

                    } else
                    {
                        return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                            ->makeResponse($newCategory);
                    }
                }

            } catch (Exception $ex)
            {
               // \Log::error($ex);

                return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->makeResponseWithError("Internal server error !",$ex);

            }
        }

        /**
         * Returns all root category items
         *
         * @return mixed
         */
        public function showAllRootCategory()
        {
            $data = $this->productCategory->getAllRootCategory();

            return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                ->makeResponse($data);
            //  dd($data);
        }


        public function showProductInCategoryName($identity = null)
        {
            if (!isset($identity))
                return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                    ->makeResponseWithError(array('Invalid request,please provide category parameter !'));
            try
            {
                $category = ProductCategory::where('extra_info', '=', $identity)->first();
                if ($category->count() != 0)
                    $products = $this->productCategory->productWithinCategory($category['id']);

                return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                    ->makeResponse($products);

            } catch (Exception $ex)
            {
                 return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                ->makeResponseWithError(array('Invalid request !',$ex));
            }

        }


        /**
         * Update a category / Subcategory value based on provided category id in POST method
         * @return mixed
         */
        public function updateCategory()
        {
            $inputData = \Input::all();

            // set validation rule to filter input

            $validationRules = [
                'rules'  => [
                    'CategoryName' => 'required | max: 15',
                    'CategoryId'   => 'required | integer'
                ],
                'values' => [
                    'CategoryName' => isset($inputData['CategoryName']) ? $inputData['CategoryName'] : null,
                    'CategoryId'   => isset($inputData['CategoryId']) ? $inputData['CategoryId'] : null
                ]
            ];

            list($inputData, $validator) = $this->inputValidation($inputData, $validationRules);

            if ($validator->fails())
            {
                return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                    ->makeResponseWithError(array('Validation failed', $validator->messages()));
            } elseif ($validator->passes())
            {
                $message = $this->productCategory->updateCategoryInfo($inputData);

                if ($message == \Config::get("const.category-updated"))
                {
                    return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                        ->makeResponse($message);
                } else
                {
                    return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                        ->makeResponseWithError(\Config::get("const.category-not-exist"));
                }
            }

        }

        /** First checks whether a category is  associated with any product or not ,
         *if not associated then delte the category item and regenerate the configuration
         *fields in database as per algorithm.
         *
         */
        public function destroy()
        {
            try
            {
                $category = \Input::get('categoryId');

                $message = $this->productCategory->deleteCategory($category);
                if ($message == \Config::get("const.category-delete-exists"))
                {
                    return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                        ->makeResponse($message);
                } elseif ($message == \Config::get("const.category-delete"))
                {
                    return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                        ->makeResponse($message);
                }


            } catch (Exception $ex)
            {
                \Log::error($ex);

                return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                    ->makeResponseWithError("Invalid category provided!!");
            }

        }
    }
