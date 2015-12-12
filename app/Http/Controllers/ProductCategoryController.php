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

            $this->productCategory = new ProductCategory();

        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
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
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {


        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
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

        /**
         * Display the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    }
