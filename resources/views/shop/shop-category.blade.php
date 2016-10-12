@extends('layouts.main')

@section('body-class'){{ 'shoppage shop-category' }}@stop

@section('content')

    @include('shop.browseall-menu')

    <nav class="mid-nav ">
        <div class="container full-sm fixed-sm">
            @if($parentCategory)
                <ul class="wrap col-lg-9">
                    <li class="box-link-ul active">
                        <a class="box-link"
                           href="/shop/{{$grandParent}}/{{$grandParent != $parentCategory->extra_info ? $parentCategory->extra_info . '/' : ''}}">
                            <span class="box-link-active-line"></span>
                            {{ucfirst($parentCategory->category_name)}}
                        </a>
                    </li>

                    <li class="horizontal-line-holder hidden-xs ">
                        <span class="horizontal-line"></span>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link active"
                           href="/shop/{{$grandParent}}/{{$grandParent != $parentCategory->extra_info ? $parentCategory->extra_info . '/' : ''}}{{$currentCategory->extra_info}}">
                            <span class="box-link-active-line"></span>
                            {{ucfirst($currentCategory->category_name)}}
                        </a>
                    </li>
                </ul>
            @else
                <ul class="wrap shop-landing-submenu">
                    <li class="box-link-ul ">
                        <a class="box-link @if($currentCategory->extra_info == 'smart-home') active @endif"
                           href="/shop/smart-home">
                            <span class="box-link-active-line"></span>
                            SMART HOME
                        </a>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link @if($currentCategory->extra_info == 'smart-entertainment') active @endif"
                           href="/shop/smart-entertainment">
                            <span class="box-link-active-line"></span>
                            SMART ENTERTAINMENT
                        </a>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link @if($currentCategory->extra_info == 'smart-travel') active @endif"
                           href="/shop/smart-travel">
                            <span class="box-link-active-line"></span>
                            SMART TRAVEL
                        </a>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link @if($currentCategory->extra_info == 'smart-body') active @endif"
                           href="/shop/smart-body">
                            <span class="box-link-active-line"></span>
                            SMART BODY
                        </a>
                    </li>
                    <li class="box-link-ul ">
                        <a class="box-link @if($currentCategory->extra_info == 'decor') active @endif"
                           href="/shop/decor">
                            <span class="box-link-active-line"></span>
                            DECOR
                        </a>
                    </li>
                      <li class="box-link-ul hidden-xs">
                        <a class="box-link " href="/ideas/deals">
                            DEALS
                        </a>
                    </li>
                </ul>
            @endif
            <a class="browse-all hidden-xs hidden-sm" data-toggle="#all-shop-menu" href="#">
                <span class="box-link-active-line"></span>
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
<<<<<<< HEAD
    </nav>


    <div class="app-wrap" ng-app="pagingApp" ng-controller="shopcategoryController">
=======
    </nav>--}}  -->
>>>>>>> parent of a9486d3... fix category page layout

    <section id="category-banner" class="landing-hero {{$currentCategory->extra_info}}-hero">
        <!--        <img src="/assets/images/shop-category-banner.png" class="img-responsive" alt="">-->
        <img src="{{$currentCategory->background_image}}" class="img-responsive full-wide" alt="{{ucfirst($currentCategory->category_name)}}">
        <div class="head-wrap container">
            <!--  class name: smart-home, travel, wearables, home-decor -->
            <h1 class="text-center"><span class="smart-home">{{ucfirst($currentCategory->category_name)}}</span></h1>
        </div>
    </section>

<<<<<<< HEAD
                <nav id="hero-nav" class="col-sm-12">
                    <div class="banner-nav">

                        <a class="pull-left visible-md visible-lg" id="shop-filter-menu-button" href="#"
                           ng-click="showFilter ? showFilter=0: showFilter=1">
                            <i class="m-icon--MenuButton"></i>
                            Filter
                        </a>


                            <a class="browse-all hidden-xs hidden-sm" data-toggle="#all-shop-menu" href="#" style="margin-left: 30px">
                                <span class="box-link-active-line"></span>
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

                        <ul class="popular-new pull-right">
                            <li class="">
                                <a ng-click="filterPlainContent(false, 'default')" data-sortby="default" href="#"
                                   class="box-link active">NEWEST</a>
                            </li>
                            <li class="">
                                <a ng-click="filterPlainContent(false, 'sale_price')" data-sortby="sale_price" href="#"
                                   class="box-link">PRICE</a>
                            </li>
                        </ul>

                </nav>
=======
    <div class="app-wrap" ng-app="pagingApp" ng-controller="shopcategoryController">
        <div ng-cloak>
            <nav id="hero-nav" class="col-sm-12">
                <div class="container full-620  fixed-sm banner-nav">
                    <a class="pull-left visible-md visible-lg" id="shop-filter-menu-button" href="#"
                       ng-click="showFilter ? showFilter=0: showFilter=1">
                        <i class="m-icon--MenuButton"></i>
                        Filter
                    </a>
                    <ul class="popular-new pull-right">
                        <li class="">
                            <a ng-click="filterPlainContent(false, 'default')" data-sortby="default" href="#"
                               class="box-link active">NEWEST</a>
                        </li>
                        <li class="">
                            <a ng-click="filterPlainContent(false, 'sale_price')" data-sortby="sale_price" href="#"
                               class="box-link">PRICE</a>
                        </li>
                    </ul>
                </div>
            </nav>
>>>>>>> parent of a9486d3... fix category page layout

            <div class="clearfix"></div>

            <div class="homepage-grid center-block">
                <div class="loader loader-abs" cg-busy="firstLoad"></div>
                {{--<div class="loader loader-abs" cg-busy="filterLoad"></div>--}}
                {{--<div class="loader loader-fixed" cg-busy="nextLoad"></div>--}}

                <div class="main-content ">
                    <div id="shop-filter-grid-box-3" ng-class="['col-lg-12', {'show-filter': showFilter}]">
                        <div class="visible-md visible-lg">
                            @include('shop.filter-menu')
                        </div>
                        <div class="grid-box-3">
                            <div class="box-item product-box-item product-box " ng-repeat="item in content">
                                @include('grid.product')
                            </div>
                        </div>
                    </div>

                    @include('layouts.parts.load-more')

                </div>
            </div>

            @include('layouts.parts.product-popup')
        </div>
    </div>
@stop