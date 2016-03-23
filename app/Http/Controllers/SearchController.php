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
use Redirect;


class SearchController extends Controller
{


    public function deleteAllDocs(){
        ini_set('memory_limit', '1024M');

           $csDomainClient = AWS::createClient('CloudsearchDomain',
            [
                'endpoint'    => 'https://search-ideaing-production-sykvgbgxrd4moqagcoyh3pt5nq.us-west-2.cloudsearch.amazonaws.com',
            ]
        );

        $result = $csDomainClient->search(array('query' => 'matchall', 'queryParser' => 'structured', 'size' => 10000));

        foreach ($result["hits"]["hit"] as $hit){
             
                   $send[] = array(
                       'type'        => 'delete',
                       'id'        => $hit['id'],
                     //  'fields'     => $batch
                   );
                   $result = $csDomainClient->uploadDocuments(array(
                       'documents'     => json_encode($send),
                       'contentType'     =>'application/json'
                   ));
        }
                print_r($result);
                echo '<br/>';

    }   


    public function reIndexAll(){
        ini_set('memory_limit', '1024M');

        
       // 1. Setup CloudSeach client
       $csDomainClient = AWS::createClient('CloudSearch',
           [
               'endpoint'    => 'https://search-ideaing-production-sykvgbgxrd4moqagcoyh3pt5nq.us-west-2.cloudsearch.amazonaws.com',
           ]
       );

       $result = $csDomainClient->indexDocuments(array(
           // DomainName is required
           'DomainName' => 'https://search-ideaing-production-sykvgbgxrd4moqagcoyh3pt5nq.us-west-2.cloudsearch.amazonaws.com',
       ));



                print_r($result);
                echo '<br/>';
    }  

    public function indexData($data = 'all'){
        ini_set('memory_limit', '1024M');


        // 0. Delete old data
        self::deleteAllDocs();

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

    public function formatAndRedirectSearch(){

            $input = Input::all();

            $searchQuery = str_replace('+', '-', $input['search']);

            return Redirect::to('search/' . $searchQuery);

    }


    public function searchData($query = false, $size = 12, $offset = 0, $type = false, $sort = false){

        $input = Input::all();

        if(!$query){
            $query = Input::get('search');
        }

        $query = str_replace('-', ' ', $query);

        $csDomainClient = AWS::createClient('CloudsearchDomain',
            [
                'endpoint'    => 'https://search-ideaing-production-sykvgbgxrd4moqagcoyh3pt5nq.us-west-2.cloudsearch.amazonaws.com',
            ]
        );

        $arguments = [
            'query' =>  $query,
            'size'  =>  $size,
            'start' =>  $offset,
        ];

        if($sort && $sort != 'undefined' && $sort != 'false'){
            $arguments['sort'] = "$sort asc";
        }else{
            $arguments['sort'] = "date_created asc";

        }

        if($type && $type != 'undefined' && $type != 'false'){
            $arguments['filterQuery'] = "(term field=type '$type')";
//                "type: '$type''";
        }

        $results = $csDomainClient->search($arguments);

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
                $item['media_link_full_path'] = @$item['feed_image'];
                $item['storeInfo'] = json_decode($item['storeinfo']);
            }

            $return[] = $item;
        }

        return $return;
    }

}
