<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Response;
    use Illuminate\Http\Response as IlluminateResponse;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Collection;

    class ApiController extends Controller {

        protected $httpStatus = array('code' => IlluminateResponse::HTTP_OK, 'message' => 'success');
        protected $authToken = "";

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
            $data = array_merge(['data'=>$data], [
                'token' => $this->getAuthToken()
            ]);

            return response()->json($data, $this->getStatusCode(), $headers);
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
                    'message'     => $message,
                    'status_code' => $this->getStatusCode()
                ],
                'token' => $this->getStatusCode()
            ]);

        }


        /**
         * Create an API Response
         * @param Paginator $modelData
         * @param $data
         * @return mixed
         */
        protected function responseWithPagination(Paginator $modelData, $data)
        {

            $data = array_merge($data, [
                'paginator' => [
                    'total_count'  => $modelData->getTotal(),
                    'total_pages'  => ceil($modelData->getTotal() / $modelData->getPerPage()),
                    'current_page' => $modelData->getCurrentPage(),
                    'limit'        => $modelData->getPerPage()
                ],
                'token'     => $this->getStatusCode()
            ]);

            return $this->makeResponse($data);
        }


    }
