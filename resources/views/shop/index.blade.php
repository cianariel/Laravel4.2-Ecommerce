@extends('layouts.main')

@section('body-class'){{ 'shoppage shop-landing' }}@stop

@section('content')
    <h1 class="hidden">Shop</h1>
    <nav class="mid-nav ">
        <div class="container full-sm fixed-sm">
            <div class="">
                <ul class="wrap shop-landing-submenu">
                    <li class="box-link-ul ">
                        <a class="box-link " href="/shop/smart-home">
                            SMART HOME
                        </a>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link"
                           href="/shop/smart-entertainment">
                            <span class="box-link-active-line"></span>
                            SMART ENTERTAINMENT
                        </a>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link " href="/shop/smart-travel">
                            SMART TRAVEL
                        </a>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link " href="/shop/smart-body">
                            SMART BODY
                        </a>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link " href="/shop/decor">
                            DECOR
                        </a>
                    </li>
                    <li class="box-link-ul hidden-xs">
                        <a class="box-link " href="/ideas/deals">
                            DEALS
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="clearfix"></div>
    <div class="app-wrap" ng-app="pagingApp" ng-controller="shoplandingController">
        <div ng-cloak>
            <div class="homepage-grid center-block">
                <div class="loader loader-fixed" cg-busy="nextLoad"></div>

                <div class="main-content ">
                    <fieldset class="shoplanding-title">
                        <legend align="center">Daily Deals</legend>
                    </fieldset>
                    <div class="loader loader-abs" cg-busy="firstLoad"></div>
                    <div class="row">
                        <div id="daily-deals" class="slider has-bullets">
                            <!--                        <div class="grid-box rsContent">-->
                            <div class="box-item idea-box box-item--featured rsContent" ng-repeat="item in dailyDeals">
                                @include('grid.idea')
                            </div>
                            <!--                        </div>-->
                        </div>
                    </div>
                    <fieldset class="shoplanding-title">
                        <legend align="center">Newest Arrivals</legend>
                    </fieldset>
                    <div class="row">
                        <div id="newest-arrivals" class="slider col-xs-12 has-bullets">
                            <div class="grid-box-3 rsContent" ng-repeat="items in newestArrivals">
                                <div class="box-item product-box  slider-box text-center" ng-repeat="item in items">
                                    @include('grid.product')
                                </div>
                            </div>


                        </div>
                    </div>
                    <fieldset class="shoplanding-title">
                        <legend align="center">Shop by Category</legend>
                    </fieldset>
                    <div class="row desktop-view hidden-xs hidden-sm">
                        <div class="col-xs-3 shop-by-category-item smart-home selected" data-submenu="smart-home">
                            <img src="/assets/images/category-home.png" alt=""><br><br>
                            <span><a href="/shop/smart-home">Smart Home</a></span>
                            <!--<a href="#" class="show-menus">
                                <i class="m-icon--Add-Active"></i>
                            </a>
                            <a href="#" class="hide-menus">
                                <i class=" m-icon--Close"></i>
                            </a>-->
                        </div>
                        <div class="col-xs-3 shop-by-category-item active" data-submenu="active">
                            <img src="assets/images/category-travel.png" alt=""><br><br>
                            <span><a href="/shop/smart-travel/">Smart Travel</a></span>
                            <!--<a href="#" class="show-menus">
                                <i class="m-icon--Add-Active"></i>
                            </a>
                            <a href="#" class="hide-menus">
                                <i class=" m-icon--Close"></i>
                            </a>-->
                        </div>
                        <div class="col-xs-3 shop-by-category-item wearables" data-submenu="wearables">
                            <img src="assets/images/category-wearable.png" alt=""><br><br>
                            <span><a href="/shop/smart-body/">Smart Body</a></span>
                            <!--<a href="#" class="show-menus">
                                <i class="m-icon--Add-Active"></i>
                            </a>
                            <a href="#" class="hide-menus">
                                <i class=" m-icon--Close"></i>
                            </a>-->
                        </div>
                        <div class="col-xs-3 shop-by-category-item home-decor" data-submenu="home-decor">
                            <img src="assets/images/category-decor.png" alt=""><br><br>
                            <span><a href="/shop/decor/">Decor</a></span>
                            <!--<a href="#" class="show-menus">
                                <i class="m-icon--Add-Active"></i>
                            </a>
                            <a href="#" class="hide-menus">
                                <i class=" m-icon--Close"></i>
                            </a>-->
                        </div>
                    </div>
                    <div class="row desktop-view hidden-xs hidden-sm">
                        <?php $i = 1 ?>
                        @foreach($categoryTree as $topCategory => $parentCategories)
                            <div class="shop-by-category-submneu {{$topCategory}} {{$i == 1 ? 'selected' : ''}}">
                                @foreach($parentCategories as $parentCategory)
                                    <div class="col-md-2">
                                        <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}">
                                            <i class="{{$parentCategory['childCategory']->icon}}  desktop-parent-icon"></i>
                                            <p class="title">
                                                <strong>{{strtoupper($parentCategory['childCategory']->category_name)}}</strong>
                                            </p>
                                        </a>

                                        <p class="hidden-xs hidden-sm">
                                            @foreach($parentCategory['grandchildCategories'] as $item)
                                                <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}/{{$item->extra_info}}">
                                                    <i class="{{$item->icon}} "></i>&nbsp; {{trim($item->category_name)}}
                                                </a>
                                                <br>
                                            @endforeach
                                        </p>
                                    </div>
                                @endforeach
                                <?php $i++; ?>
                            </div>
                        @endforeach
                    </div>
                    <div class="visible-xs visible-sm mobile-shop-by-category-holder">
                        <div class="">
                            <div class="col-sm-12 shop-by-category-item smart-home">
                                <a href="/shop/smart-home" class="shop-by-category-item-link">
                                    <img src="/assets/images/category-home.png" alt="">
                                    Smart Home
                                </a> &nbsp;
                                <a data-content="smart-home" class="show-and-hide">
                                    <i class="m-icon--Header-Dropdown down"></i>
                                    <i class="m-icon--footer-up-arrow up"></i>
                                </a>

                                <div class="shop-by-category-submneu smart-home ">
                                    @foreach($categoryTree['smart-home'] as $parentCategory)
                                        <div class="col-md-12">

                                            <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}">
                                                <i class="{{$parentCategory['childCategory']->icon}}  desktop-parent-icon"></i>
                                                <span class="title"><strong>{{strtoupper($parentCategory['childCategory']->category_name)}}</strong></span>
                                            </a>
                                            @if(count($parentCategory['grandchildCategories']))
                                                <a class="show-and-hide-grandchild">
                                                    <i class=" m-icon--Add-Active add"></i>
                                                    <i class=" m-icon--Close close"></i>
                                                </a>
                                                <div class="grandchild-holder">
                                                    @foreach($parentCategory['grandchildCategories'] as $item)
                                                        <div class="grandchild-item">
                                                            <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}/{{$item->extra_info}}"><i
                                                                        class="{{$item->icon}} "></i>&nbsp; {{trim($item->category_name)}}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                            </div>


                            <div class="col-sm-12 shop-by-category-item travel">
                                <a href="/shop/active" class="shop-by-category-item-link">
                                    <img src="assets/images/category-travel.png" alt="">
                                    Active
                                </a> &nbsp;
                                <a data-content="smart-home" class="show-and-hide">
                                    <i class="m-icon--Header-Dropdown down"></i>
                                    <i class="m-icon--footer-up-arrow up"></i>
                                </a>

                                <div class="shop-by-category-submneu smart-home ">
                                    @foreach($categoryTree['smart-travel'] as $parentCategory)
                                        <div class="col-md-12">
                                            <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}">
                                                <i class="{{$parentCategory['childCategory']->icon}} desktop-parent-icon"></i>
                                                <span class="title"><strong>{{strtoupper($parentCategory['childCategory']->category_name)}}</strong></span>
                                            </a>
                                            @if(count($parentCategory['grandchildCategories']))
                                                <a class="show-and-hide-grandchild">
                                                    <i class=" m-icon--Add-Active add"></i>
                                                    <i class=" m-icon--Close close"></i>
                                                </a>
                                                <div class="grandchild-holder">
                                                    @foreach($parentCategory['grandchildCategories'] as $item)
                                                        <div class="grandchild-item">
                                                            <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}/{{$item->extra_info}}"><i
                                                                        class="{{$item->icon}} "><i
                                                                            class="{{$item->icon}}"></i>&nbsp; {{trim($item->category_name)}}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                            <div class="col-sm-12 shop-by-category-item wearables">
                                <a href="/shop/wearables" class="shop-by-category-item-link">
                                    <img src="assets/images/category-wearable.png" alt="">
                                    Wearables
                                </a> &nbsp;
                                <a data-content="smart-home" class="show-and-hide">
                                    <i class="m-icon--Header-Dropdown down"></i>
                                    <i class="m-icon--footer-up-arrow up"></i>
                                </a>

                                <div class="shop-by-category-submneu smart-home ">
                                    @foreach($categoryTree['smart-body'] as $parentCategory)
                                        <div class="col-md-12">
                                            <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}">
                                                <i class="{{$parentCategory['childCategory']->icon}} desktop-parent-icon"></i>
                                                <span class="title"><strong>{{strtoupper($parentCategory['childCategory']->category_name)}}</strong></span>
                                            </a>
                                            @if(count($parentCategory['grandchildCategories']))
                                                <a class="show-and-hide-grandchild">
                                                    <i class=" m-icon--Add-Active add"></i>
                                                    <i class=" m-icon--Close close"></i>
                                                </a>
                                                <div class="grandchild-holder">
                                                    @foreach($parentCategory['grandchildCategories'] as $item)
                                                        <div class="grandchild-item">
                                                            <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}/{{$item->extra_info}}"><i
                                                                        class="{{$item->icon}}"></i>&nbsp; {{trim($item->category_name)}}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                            <div class="col-sm-12 shop-by-category-item home-decor">
                                <a href="/shop/home-decor" class="shop-by-category-item-link">
                                    <img src="assets/images/category-decor.png" alt="">
                                    Home & Decor
                                </a>
                                <a data-content="smart-home" class="show-and-hide">
                                    <i class="m-icon--Header-Dropdown down"></i>
                                    <i class="m-icon--footer-up-arrow up"></i>
                                </a>
                                <div class="shop-by-category-submneu smart-home ">
                                    @foreach($categoryTree['decor'] as $parentCategory)
                                        <div class="col-md-12">
                                            <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}">
                                                <i class="{{$parentCategory['childCategory']->icon}} desktop-parent-icon"></i>
                                                <span class="title"><strong>{{strtoupper($parentCategory['childCategory']->category_name)}}</strong></span>
                                            </a>
                                            @if(count($parentCategory['grandchildCategories']))
                                                <a class="show-and-hide-grandchild">
                                                    <i class=" m-icon--Add-Active add"></i>
                                                    <i class=" m-icon--Close close"></i>
                                                </a>
                                                <div class="grandchild-holder">
                                                    @foreach($parentCategory['grandchildCategories'] as $item)
                                                        <div class="grandchild-item">
                                                            <a href="/shop/{{$topCategory}}/{{trim($parentCategory['childCategory']->extra_info)}}/{{$item->extra_info}}"><i
                                                                        class="{{$item->icon}}"></i>&nbsp; {{trim($item->category_name)}}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>


                        <!--<select id="mobile-shop-by-category-items" class="form-control">
                            <option value="smart-home"><a href="/shop/smart-home">Smart Home</a></option>
                            <option value="travel"><a href="/shop/travel">Travel</a></option>
                            <option value="wearable"><a href="/shop/wearables">Wearable</a></option>
                            <option value="decor"><a href="/shop/home-decor">Home & Decor</a></option>
                        </select>-->
                        <br>
                    </div>
                </div>
            </div>
            @include('layouts.parts.product-popup')
        </div>
    </div>
    {{--<script src="/assets/js/vendor/angular-busy.min.js"></script>--}}
    {{--<script src="/assets/js/main.js"></script>--}}
    {{--<script src="/assets/js/angular-custom/public.common.js"></script>--}}
@stop