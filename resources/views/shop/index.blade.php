@extends('layouts.main')

@section('body-class'){{ 'shoppage shop-landing' }}@stop

@section('content')
    <h1 class="hidden">Shop</h1>

    <div class="app-wrap" ng-app="pagingApp" ng-controller="shoplandingController">
        <div ng-cloak>
            <div class="homepage-grid center-block">
                <div class="loader loader-fixed" cg-busy="nextLoad"></div>

                <div class="main-content ">
                    <div class="sub-item-container">
                    <fieldset class="shoplanding-title">
                        <legend align="left">Best Sellers <i class="m-icon--flame-fill-red fill-with-red"></i> </legend>
                    </fieldset>
                    <div class="loader loader-abs" cg-busy="firstLoad"></div>

                    <div class="row">
                        <div class="container">
                            <uib-tabset active="active">
                                <uib-tab index="0" heading="Smart Homes">
                                    @include('layouts.parts.shop-tab')
                                </uib-tab>
                                <uib-tab index="1" heading="Smart Travel">
                                    @include('layouts.parts.shop-tab')
                                </uib-tab>
                                <uib-tab index="2" heading="Smart Body">
                                    @include('layouts.parts.shop-tab')
                                </uib-tab>
                                <uib-tab index="3" heading="Smart Entertainment">
                                    @include('layouts.parts.shop-tab')
                                </uib-tab>
                            </uib-tabset>
                        </div>
                    </div>
                    </div>

                    <div class="sub-item-container">
                    <fieldset class="shoplanding-title">
                        <legend align="left">Newest Arrivals <i class="m-icon--arrow fill-with-red"></i></legend>
                    </fieldset>

                    <div class="row">
                        <div class="container">
                            <uib-tabset active="active">
                                <uib-tab index="0" heading="Smart Homes">
                                    @include('layouts.parts.shop-tab')
                                </uib-tab>
                                <uib-tab index="1" heading="Smart Travel">
                                    @include('layouts.parts.shop-tab')
                                </uib-tab>
                                <uib-tab index="2" heading="Smart Body">
                                    @include('layouts.parts.shop-tab')
                                </uib-tab>
                                <uib-tab index="3" heading="Smart Entertainment">
                                    @include('layouts.parts.shop-tab')
                                </uib-tab>
                            </uib-tabset>
                        </div>
                    </div>
                    </div>

                    <div class="sub-item-container">
                        <fieldset class="shoplanding-title">
                            <legend align="left">Hot Deals <br/> <i class="m-icon--flame-fill-red fill-with-purple"></i> 29</legend>
                        </fieldset>

                        <div class="row">
                            <div class="container">
                                <uib-tabset active="active">
                                    <uib-tab index="0" heading="Smart Homes">
                                        @include('layouts.parts.shop-tab')
                                    </uib-tab>
                                    <uib-tab index="1" heading="Smart Travel">
                                        @include('layouts.parts.shop-tab')
                                    </uib-tab>
                                    <uib-tab index="2" heading="Smart Body">
                                        @include('layouts.parts.shop-tab')
                                    </uib-tab>
                                    <uib-tab index="3" heading="Smart Entertainment">
                                        @include('layouts.parts.shop-tab')
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