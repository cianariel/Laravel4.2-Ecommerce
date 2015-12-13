<?php

    namespace App\Http\Controllers;

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
            $this->middleware('jwt.auth', ['except' => ['updateCategory', 'index', 'addCategory', 'showAllRootCategory', 'destroy']]);
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
         * Store a newly created resource in storage.
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
                        'ParentId'     => 'integer'
                    ],
                    'values' => [
                        'CategoryName' => isset($inputData['CategoryName']) ? $inputData['CategoryName'] : null,
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

            } catch (\Exception $ex)
            {
                \Log::error($ex);

                return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->makeResponseWithError("Internal server error !");

            }
        }


        public function showAllRootCategory()
        {
            $data = $this->productCategory->getAllRootCategory();

            return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                ->makeResponse($data);
          //  dd($data);
        }




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

        /**
         * Remove the specified resource from storage.
         *
         * @param $category
         * @return IlluminateResponse
         * @internal param int $id
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


            } catch (\Exception $ex)
            {
                \Log::error($ex);

                return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                    ->makeResponseWithError("Invalid category provided!!");
            }

        }
    }
