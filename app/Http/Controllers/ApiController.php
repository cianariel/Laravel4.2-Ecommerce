<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{

    protected $httpStatus = array('code' =>IlluminateResponse::HTTP_OK,'message' => 'success' );


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
     * Create an API Response
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function makeResponse($data,$headers=[])
    {
       return response()->json($data,$this->getStatusCode(),$headers);
    }


    /**
     * Create an API Response with Error code & message
     * @param $message
     * @param null $log
     * @return mixed
     */
    public function makeResponseWithError($message,$log = null)
    {
        Log::error($log);
        return $this->makeResponse([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
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
                'total_count' => $modelData->getTotal(),
                'total_pages' => ceil($modelData->getTotal() / $modelData->getPerPage()),
                'current_page' => $modelData->getCurrentPage(),
                'limit' => $modelData->getPerPage()
            ]
        ]);

        return $this->makeResponse($data);
    }







}
