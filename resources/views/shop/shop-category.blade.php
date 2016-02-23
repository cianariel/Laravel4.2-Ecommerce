@extends('layouts.main')

@section('body-class'){{ 'shoppage shop-category' }}@stop

@section('content')
    @include('shop.browseall-menu')
    <nav class="mid-nav ">
        <div class="container full-sm fixed-sm">
            <ul class="wrap col-lg-9">
                @if($parentCategory)
                    <li class="box-link-ul active">
                        <a class="box-link" href="/shop/{{$parentCategory->extra_info}}" >
                            <span class="box-link-active-line"></span>
                            {{ucfirst($parentCategory->category_name)}}
                        </a>
                    </li>

                    <li class="horizontal-line-holder hidden-xs ">
                        <span class="horizontal-line"></span>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link active" href="/shop/{{$parentCategory->extra_info}}/@if(isset($category['CategoryPermalink'])){{$category['CategoryPermalink']}}@endif" >
                            <span class="box-link-active-line"></span>
                            {{ucfirst($currentCategory->category_name)}}
                        </a>
                    </li>
                @else
                    <li class="box-link-ul active">
                        <a class="box-link active" href="/shop/{{$currentCategory->extra_info}}" >
                            <span class="box-link-active-line"></span>
                            {{ucfirst($currentCategory->category_name)}}
                        </a>
                    </li>
                @endif
            </ul>
                <a class="browse-all hidden-xs hidden-sm" data-toggle="#all-shop-menu" href="#">
                    <i class="m-icon--menu"></i>
                    <span>
                        BROWSE ALL
                        <i class="m-icon--Header-Dropdown down"></i>
                        <i class="m-icon--footer-up-arrow up"></i>
                    </span>
                </a>
                <a class="browse-all visible-xs visible-sm" data-toggle="#all-shop-menu-mobile" href="#">
                    <span>
                        <i class="m-icon--Header-Dropdown down"></i>
                        <i class="m-icon--footer-up-arrow up"></i>
                    </span>
                </a>
        </div>
    </nav>

    <section id="category-banner" class="landing-hero {{$currentCategory->extra_info}}-hero">
        <img src="/assets/images/shop-category-banner.png" class="img-responsive" alt="">
        <div class="head-wrap container">
            <!--  class name: smart-home, travel, wearables, home-decor -->
            <h1 class="text-center"><span class="smart-home">{{ucfirst($currentCategory->category_name)}}</span></h1>
        </div>        
    </section>

    <div class="app-wrap" ng-app="pagingApp" ng-controller="shopcategoryController">
        <nav id="hero-nav" class="col-sm-12">
            <div class="container full-620  fixed-sm banner-nav">
                        <ul class="popular-new ">
                            {{--<li class="">--}}
                                {{--<a ng-click="sortBy(popularity)" href="#" class="box-link active">POPULAR</a>--}}
                            {{--</li>--}}
                            <li class="">
                                <a ng-click="filterPlainContent(false, 'default')" data-sortby="default" href="#" class="box-link active">NEWEST</a>
                            </li>
                            <li class="">
                                <a ng-click="filterPlainContent(false, 'sale_price')"  data-sortby="sale_price"  href="#" class="box-link">PRICE</a>
                            </li>
                        </ul>
                    </div>
        </nav>

        <div class="clearfix"></div>

        <div class="homepage-grid center-block">
            <div class="loader loader-abs" cg-busy="firstLoad"></div>
            {{--<div class="loader loader-abs" cg-busy="filterLoad"></div>--}}
            <div class="loader loader-fixed" cg-busy="nextLoad"></div>
            
            <div class="main-content ">
                    <div class="grid-box-3" >
                        <div class="box-item product-box " ng-repeat="item in content" >
                            @include('grid.product')
                        </div>
                    </div>
                <div class="container">
                    <a ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12">Load More</a>
                </div>
            </div>
            @include('shop.filter-menu')
        </div>

        @include('layouts.parts.product-popup')
    </div>
    
    <script src="/assets/js/vendor/angular-busy.min.js"></script>
    <script src="/assets/js/angular-custom/custom.paging.js"></script>
    <script src="/assets/js/angular-custom/public.common.js"></script>
@stop