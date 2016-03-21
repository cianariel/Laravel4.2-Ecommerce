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
use Input;


class SearchController extends Controller
{

    public function indexData($data = 'all'){

        // 1. Setup CloudSeach client
        $csDomainClient = AWS::createClient('CloudsearchDomain',
            [
                'endpoint'    => 'https://search-ideaing-production-sykvgbgxrd4moqagcoyh3pt5nq.us-west-2.cloudsearch.amazonaws.com',
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


    public function searchData($query = false){

        $input = Input::all();

        if(!$query){
            $query = Input::get('search');
        }

        $csDomainClient = AWS::createClient('CloudsearchDomain',
            [
                'endpoint'    => 'https://search-ideaing-production-sykvgbgxrd4moqagcoyh3pt5nq.us-west-2.cloudsearch.amazonaws.com',
            ]
        );

        $results = $csDomainClient->search(array(
            'query'  =>  $query
        ));

        $return = [];
        foreach( $results->getPath('hits/hit') as $hit){
            $item =[];

            foreach($hit['fields'] as $key => $it){ // flatten results TODO - get rid of this
                if(is_array($it) && count($it) == 1){
                    $item[$key] = $it[0];
                }
            }


            if($item['type'] == 'idea'){
                $item['url'] = $item['permalink'];
                $item['feed_image'] = json_decode($item['feed_image']);
            }elseif($item['type'] == 'product'){
                $item['product_name'] = $item['title'];
                $item['product_permalink'] = $item['permalink'];
                $item['media_link_full_path'] = $item['feed_image'];
                $item['storeInfo'] = json_decode($item['storeinfo']);
            }

            $return[] = $item;
        }

        return $return;
    }

}
