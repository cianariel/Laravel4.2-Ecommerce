@extends('layouts.main')

@section('body-class'){{ 'shoppage shop-landing' }}@stop

@section('content')
    <div class="app-wrap" ng-app="pagingApp" ng-controller="shoplandingController">
        
        <div class="container">
            <div class="loader loader-fixed" cg-busy="nextLoad"></div>
            
            <div class="main-content ">
                <fieldset class="shoplanding-title">
                    <legend align="center">Daily Deals</legend>
                </fieldset>
                <div class="loader loader-abs" cg-busy="firstLoad"></div>
                <div class="row">
                    <div id="daily-deals" class="slider has-bullets">
<!--                        <div class="grid-box rsContent">-->
                            <div class="box-item idea-box box-item--featured rsContent" ng-repeat="item in dailyDeals" >
                                @include('grid.idea')
                            </div>
<!--                        </div>-->
                    </div>
                </div>
                <fieldset class="shoplanding-title">
                    <legend align="center">Newest Arrivals</legend>
                </fieldset>
                <div class="row">
                    <div id="newest-arrivals" class="slider col-xs-12 has-bullets" >
                        <div class="grid-box-3 rsContent" ng-repeat="items in newestArrivals">
                            <div class="box-item product-box text-center" ng-repeat="item in items" >
                                @include('grid.product')
                            </div>
                        </div>
                    
                    
                    
                    </div>
                </div>
                <fieldset class="shoplanding-title">
                    <legend align="center">Shop by Category</legend>
                </fieldset>
                <div class="row hidden-xs hidden-sm">
                    <div class="col-xs-3 shop-by-category-item smart-home active" data-submenu="smart-home">
                        <img src="/assets/images/category-home.png" alt=""><br><br>
                        <span>Smart Home</span>
                        <a href="#" class="show-menus">
                            <i class="m-icon--Add-Active"></i>
                        </a>
                        <a href="#" class="hide-menus">
                            <i class=" m-icon--Close"></i>
                        </a>
                    </div>
                    <div class="col-xs-3 shop-by-category-item travel" data-submenu="travel">
                        <img src="assets/images/category-travel.png" alt=""><br><br>
                        <span>Travel</span>
                        <a href="#" class="show-menus">
                            <i class="m-icon--Add-Active"></i>
                        </a>
                        <a href="#" class="hide-menus">
                            <i class=" m-icon--Close"></i>
                        </a>
                    </div>
                    <div class="col-xs-3 shop-by-category-item wearables" data-submenu="wearables">
                        <img src="assets/images/category-wearable.png" alt=""><br><br>
                        <span>Wearable</span>
                        <a href="#" class="show-menus">
                            <i class="m-icon--Add-Active"></i>
                        </a>
                        <a href="#" class="hide-menus">
                            <i class=" m-icon--Close"></i>
                        </a>
                    </div>
                    <div class="col-xs-3 shop-by-category-item home-decor" data-submenu="home-decor">
                        <img src="assets/images/category-decor.png" alt=""><br><br>
                        <span>Home & Decor</span>
                        <a href="#" class="show-menus">
                            <i class="m-icon--Add-Active"></i>
                        </a>
                        <a href="#" class="hide-menus">
                            <i class=" m-icon--Close"></i>
                        </a>
                    </div>
                </div>
                <div class="visible-xs visible-sm">
                    <select id="mobile-shop-by-category-items" class="form-control">
                        <option value="smart-home">Smart Home</option>
                        <option value="travel">Travel</option>
                        <option value="wearable">Wearable</option>
                        <option value="decor">Home & Decor</option>
                    </select>
                    <br>
                </div>
                <div class="row">
                    <?php $i =1 ?>
                    @foreach($categoryTree as $topCategory => $parentCategories)
                        <div class="shop-by-category-submneu {{$topCategory}} {{$i == 1 ? 'active' : ''}}">
                            @foreach($parentCategories as $parent => $grandChildren)
                                <div class="col-md-2">
                                    <div>
                                    <a href="/shop/category/{{trim($parent)}}">
                                        <i class="m-icon--energy"></i>
                                        <p class="title"><strong>{{strtoupper(str_replace('-', ' ', $parent))}}</strong></p>
                                        <p class="hidden-xs hidden-sm">
                                            @foreach($grandChildren as $item)
                                                {{trim($item->category_name)}}<br>
                                            @endforeach
                                        </p>
                                    </a>
                                </div>
                                </div>
                            @endforeach
                            <?php $i++; ?>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/js/vendor/angular-busy.min.js"></script>
    <script src="/assets/js/angular-custom/custom.paging.js"></script>
    <script src="/assets/js/angular-custom/public.common.js"></script>
@stop