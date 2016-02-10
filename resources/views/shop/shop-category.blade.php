@extends('layouts.main')

@section('body-class'){{ 'shoppage shop-category' }}@stop

@section('content')
    <section id="category-banner" class="landing-hero">
        <img src="/assets/images/shop-category-banner.png" class="img-responsive" alt="">
    </section>

    <div class="app-wrap" ng-app="pagingApp" ng-controller="shopcategoryController">
        
        <div class="container">
            <div class="loader loader-abs" cg-busy="firstLoad"></div>
            {{--<div class="loader loader-abs" cg-busy="filterLoad"></div>--}}
            <div class="loader loader-fixed" cg-busy="nextLoad"></div>
            
            <div class="main-content ">
                <div class="row banner-nav">
                    <div class="col-xs-12">
                        <ul class="popular-new ">
                            <li class="">
                                <a href="#" class="box-link active">POPULAR</a>
                            </li>
                            <li class="">
                                <a href="#" class="box-link ">NEWEST</a>
                            </li>
                            <li class="">
                                <a href="#" class="box-link ">PRICE</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="grid-box-3" >
                        <div class="box-item product-box " ng-repeat="item in items" >
                            @include('grid.product')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/js/vendor/angular-busy.min.js"></script>
    <script src="/assets/js/angular-custom/custom.paging.js"></script>
    <script src="/assets/js/angular-custom/public.common.js"></script>
@stop