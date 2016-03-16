<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Factory;

use App\Models\Product;
use App\Models\Search;
use AWS;


class SearchController extends Controller
{

    public function indexData($data = 'all'){

        // 1. Setup CloudSeach client
        $csDomainClient = AWS::createClient('CloudsearchDomain',
            [
                'endpoint'    => 'https://search-ideaing-01-3xyefj3ouifu7hm677jeqj4z5u.us-west-2.cloudsearch.amazonaws.com',
            ]
        );

        // 2. Build index
        $index = Search::buildIndex();
//        $json = json_encode($index);

       foreach($index as $key => $batch){
           $send[] = array(
               'type'        => 'add',
               'id'        => $key,
               'fields'     => $batch
           );
           $result = $csDomainClient->uploadDocuments(array(
               'documents'     => json_encode($send),
               'contentType'     =>'application/json'
           ));
       }

        print_r($result);
    }


    public function searchData($query = ''){

        $csDomainClient = AWS::createClient('CloudsearchDomain',
            [
                'endpoint'    => 'https://search-ideaing-01-3xyefj3ouifu7hm677jeqj4z5u.us-west-2.cloudsearch.amazonaws.com',
            ]
        );

        $result = $csDomainClient->search(array(
            'query'  =>  $query
        ));

        print_r($result);
    }

}
