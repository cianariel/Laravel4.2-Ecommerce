<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $menuProductSettings = [
            'ActiveItem' => true,
            'limit'      => 4,
            'page'       => 1,
            'CustomSkip' => false,

            'CategoryId' => false,
            'FilterType' => false,
            'FilterText' => false,
            'ShowFor'    => false,
            'WithTags'   => false,
        ];

        $prod = new Product();

        $menuProductSettings['CategoryId'] = 1;
        $travel = $prod->getProductList($menuProductSettings);
        $menuProducts['travel'] = $travel['result'];
        $menuProductSettings['IgnoreIDs'] = $travel['allIDs'];

        $menuProductSettings['CategoryId'] = 2;
        $wearables = $prod->getProductList($menuProductSettings);
        $menuProducts['wearables'] = $wearables['result'];
        $menuProductSettings['IgnoreIDs'] = $menuProductSettings['IgnoreIDs'] + $wearables['allIDs'];

        $menuProductSettings['CategoryId'] = 3;
        $homeDecor = $prod->getProductList($menuProductSettings);
        $menuProducts['homeDecor'] = $homeDecor['result'];
        $menuProductSettings['IgnoreIDs'] = $menuProductSettings['IgnoreIDs'] + $wearables['allIDs'];

        $menuProductSettings['CategoryId'] = 5;
        $menuProductSettings['limit'] = 8;
        $smartHome = $prod->getProductList($menuProductSettings);
        $menuProducts['smartHome'] = $smartHome['result'];
        $menuProductSettings['IgnoreIDs'] = $menuProductSettings['IgnoreIDs'] + $wearables['allIDs'];

        $menuProductSettings['CategoryId'] = 7;
        $menuProductSettings['limit'] = 1;
        $mostPopular = $prod->getProductList($menuProductSettings);
        $menuProducts['mostPopular'] = $mostPopular['result'];

        return view('shop.index')->with('menuProducts', $menuProducts);
    }

    public function shopCategory()
    {
        return view('shop.shop-category');
    }
}
