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
        $csClient = CloudSearchClient::factory(array(
            'key'          => 'AKIAJIBIY57I4ZATMUHA',
            'secret'      => '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',
            'region'     =>  'us_west'
        ));
        $csDomainClient = $csClient->getDomainClient(
            'arn:aws:cloudsearch:us-west-2:890219607996:domain/ideaing-01',
            array(
                'credentials' => $csClient->getCredentials(),
            )
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
               'documents'     => json_encode($batch),
               'contentType'     =>'application/json'
           ));
       }






        print_r($result);
    }

}
