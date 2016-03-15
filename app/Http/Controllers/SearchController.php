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
        $index = Search::buildIndex();
        $json = json_encode($index);

        print_r($index);
    }

}
