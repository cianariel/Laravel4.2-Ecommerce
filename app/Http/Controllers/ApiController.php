<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Response;
    use Illuminate\Http\Response as IlluminateResponse;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Contracts\Filesystem\Factory;

    use JWTAuth;
    use FeedParser;

    class ApiController extends Controller {

        protected $httpStatus = array('code' => IlluminateResponse::HTTP_OK, 'message' => 'success');
        protected $authToken = "";

        public function __construct()
        {
          //  $this->middleware('jwt.auth', ['except' => ['mediaUpload']]);

        }

        /**
         * Return the custom status code and message
         * @return array
         */

        public function getStatusCode()
        {
            return $this->httpStatus;
        }


        /**
         * Set the custom status code and message
         *
         * @param $status
         * @return $this
         */
        public function setStatusCode($status)
        {
            $this->httpStatus = $status;

            return $this;
        }

        /**
         * Get JWT Auth toke for authenticated user
         * @return string
         */
        public function getAuthToken()
        {
            return $this->authToken == null ? "" : $this->authToken;

        }

        /**
         * Set JWT Auth toke for authenticated user
         * @param $toke
         * @return $this
         */
        public function setAuthToken($toke)
        {
            session(['auth.token' => isset($toke) ? $toke : null]);
            $this->authToken = $toke;

            return $this;
        }


        /**
         * Create an API Response
         * @param $data
         * @param array $headers
         * @return mixed
         */
        public function makeResponse($data, $headers = [])
        {
            $authToken = $this->getAuthToken();
            if ($authToken != "")
            {
                $data = array_merge(['data' => $data], [
                    'token' => $this->getAuthToken()
                ]);
            } else
            {
                $data = [
                    'data'        => $data,
                    'status_code' => $this->getStatusCode()
                ];
            }

            return response()->json($data);

        }


        /**
         * Create an API Response with Error code & message
         * @param $message
         * @param null $log
         * @return mixed
         */
        public function makeResponseWithError($message, $log = null)
        {
            Log::error($log);

            return $this->makeResponse([
                'error' => [
                    'message' => $message,
                ]
            ]);

        }


        /**
         * Create an API Response
         * @param Paginator $modelData
         * @param $data
         * @return mixed
         */
        public function responseWithPagination(Paginator $modelData, $data)
        {

            $data = array_merge($data, [
                'paginator' => [
                    'total_count'  => $modelData->getTotal(),
                    'total_pages'  => ceil($modelData->getTotal() / $modelData->getPerPage()),
                    'current_page' => $modelData->getCurrentPage(),
                    'limit'        => $modelData->getPerPage()
                ]
            ]);

            return $this->makeResponse($data);
        }

        // upload media content to S3
        public function mediaUpload(\Request $request)
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
            } else if (in_array($request->file('file')->guessClientExtension(), array("jpeg", "jpg", "bmp", "png", "mp4", "avi", "mkv")))
            {
                $fileResponse['result'] =  \Config::get("const.file.file-not-exist");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");
                return $fileResponse;
            } else if ($request->file('file')->getClientSize() > \Config::get("const.file.file-max-size"))
            {
                $fileResponse['result'] = \Config::get("const.file.file-max-limit-exit");
                $fileResponse['status_code'] = \Config::get("const.api-status.validation-fail");
                return $fileResponse;
            }else{
                $fileName = 'product-'.$request->file('file')->getClientOriginalName().uniqid().$request->file('file')->getClientOriginalExtension();

                // pointing filesystem to AWS S3
                $s3 = Storage::disk('s3');

                if($s3->put($fileName,file_get_contents($request->file('file')),'public'))
                {
                    $fileResponse['result'] = \Config::get("const.file.s3-path").$fileName;
                    $fileResponse['status_code'] = \Config::get("const.api-status.success");
                    return $fileResponse;
                }
            }
        }


        /**
         * User input validation
         * @param $inputData
         * @param $validationRules
         * @return array
         */
        protected function inputValidation($inputData, $validationRules)
        {
            // Trim blank spaces from

            \Input::merge(array_map('trim', $inputData));

            $cleanData = \Input::all();

            $validator = \Validator::make($validationRules['values'], $validationRules['rules']);

            return array($cleanData, $validator);
        }


    }
