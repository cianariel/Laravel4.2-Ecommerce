@extends('layouts.main')

@section('body-class'){{ 'shoppage shop-landing' }}@stop

@section('content')
    <h1 class="hidden">Shop</h1>

    <div class="app-wrap" ng-app="pagingApp" ng-controller="shoplandingController">
        <div ng-cloak>
            <div class="homepage-grid center-block">
                <div class="loader loader-fixed" cg-busy="nextLoad"></div>

                <div class="main-content ">
                    <div class="sub-item-container best-sellers">
                        <fieldset class="shoplanding-title">
                            <legend align="left"> <i class="m-icon--flame-fill fill-with-red"></i> Best Sellers</legend>
                        </fieldset>
                        <div class="loader loader-abs" cg-busy="firstLoad"></div>

                        <div class="row">
                            <div class="container">
                                <uib-tabset class="tab-swing-lined" active="active">
                                    <uib-tab index="0" heading="Smart Homes" class="category-smart-home">
                                        @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-home'])
                                    </uib-tab>
                                    <uib-tab index="1" heading="Smart Entertainment" class="category-smart-entertainment">
                                        @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-entertainment'])
                                    </uib-tab>
                                    <uib-tab index="2" heading="Smart Body" class="category-smart-body">
                                        @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-body'])
                                    </uib-tab>
                                    <uib-tab index="3" heading="Smart Travel" class="category-smart-travel">
                                        @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-travel'])
                                    </uib-tab>
                                </uib-tabset>
                            </div>
                        </div>
                    </div>

                    <div class="sub-item-container newest-arrivals">
                        <fieldset class="shoplanding-title">
                            <legend align="left"> <i class="m-icon--arrow fill-with-red"></i> Newest Arrivals </legend>
                        </fieldset>

                        <div class="row">
                            <div class="container">
                                <uib-tabset class="tab-swing-lined" active="active">
                                    <uib-tab index="0" heading="Smart Homes" class="category-smart-home">
                                        @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-home'])
                                    </uib-tab>
                                    <uib-tab index="1" heading="Smart Entertainment" class="category-smart-entertainment">
                                        @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-entertainment'])
                                    </uib-tab>
                                    <uib-tab index="2" heading="Smart Body" class="category-smart-body">
                                        @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-body'])
                                    </uib-tab>
                                    <uib-tab index="3" heading="Smart Travel" class="category-smart-travel">
                                        @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-travel'])
                                    </uib-tab>
                                </uib-tabset>
                            </div>
                        </div>
                    </div>

                    <div class="sub-item-container hot-deals">
                        <fieldset class="shoplanding-title">
                            <legend align="left">Hot Deals <br/> <i class="m-icon--flame-fill fill-with-purple"></i> 29</legend>
                        </fieldset>

                        <div class="row">
                            <div class="col-md-7 left-price-description">
                                <div>
                                    <h1>Best quadcopter in the world gets an upgrade</h1>
                                </div>
                                <div class="price-container">
                                    <div class="normal-price"><span>NORMAL PRICE:</span> <span class="line-through-price">$95.00</span></div>
                                    <div class="big-price-container"><span>$95.00</span></div>
                                    <div class="get-it-inner"><button class="btn btn-lg">GET IT</button></div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="right-view-container">
                                    <img src="/assets/images/chair.jpg" />
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="sub-item-container bottom-newest-arrival">
                        <fieldset class="shoplanding-title">
                            <legend align="left"> <i class="m-icon--arrow fill-with-red"></i> Newest Arrivals </legend>
                        </fieldset>

                        <div class="row">
                            <div class="container">
                                <uib-tabset class="tab-swing-lined" active="active">
                                    <uib-tab index="0" heading="Shop by category">
                                        <h1>Shop by category</h1>
                                    </uib-tab>
                                    <uib-tab index="1" heading="Shop by product">
                                        <h1>Shop by product</h1>
                                    </uib-tab>
                                </uib-tabset>
                            </div>
                        </div>
                    </div>

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