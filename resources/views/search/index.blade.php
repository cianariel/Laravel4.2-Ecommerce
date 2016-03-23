@extends('layouts.main')

@section('body-class'){{ 'homepage' }}@stop

@section('content')

    <div style="padding-top: 120px" class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="SearchController" ng-cloak>
        <nav id="hero-nav" class="col-sm-12">
            <div class="container full-620  fixed-sm banner-nav">
                <ul class="popular-new pull-left">
                    {{--<li class="">--}}
                    {{--<a ng-click="sortBy(popularity)" href="#" class="box-link active">POPULAR</a>--}}
                    {{--</li>--}}
                    <li class="">
                        <a ng-click="filterSearchContent('all', false)" data-filterby="all" href="#" class="box-link active">ALL</a>
                    </li>
                    <li class="">
                        <a ng-click="filterSearchContent('idea', false)" data-filterby="idea" href="#" class="box-link">IDEAS</a>
                    </li>
                    <li class="">
                        <a ng-click="filterSearchContent('product', false)"  data-filterby="product"  href="#" class="box-link">PRODUCTS</a>
                    </li>
                </ul>
                <ul class="popular-new pull-right">
                    {{--<li class="">--}}
                    {{--<a ng-click="sortBy(popularity)" href="#" class="box-link active">POPULAR</a>--}}
                    {{--</li>--}}
                    <li class="">
                        <a ng-click="filterSearchContent(false, 'date_created')" data-sortby="default" href="#" class="box-link active">NEWEST</a>
                    </li>
                    <li class="">
                        <a ng-click="filterSearchContent(false, 'sale_price')"  data-sortby="sale_price"  href="#" class="box-link">PRICE</a>
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
                <div id="shop-filter-grid-box-3" ng-class="['col-lg-12', {'show-filter': showFilter}]">
                    {{--<div class="visible-md visible-lg">--}}
                        {{--@include('shop.filter-menu')--}}
                    {{--</div>--}}
                    <div class="grid-box-3" >
                        {{--<div class="box-item product-box " ng-repeat="item in content" >--}}


                        {{--</div>--}}
                        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in content">
                            @include('grid.idea')
                            <?php // include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
                        </div>

                        <div ng-if="item.type == 'product'" ng-repeat="item in content"             class="box-item product-box">
                            @include('grid.product')
                        <?php // include('/var/www/ideaing/resources/views/grid/product.blade.php') ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <a ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12">Load More</a>
                </div>
            </div>
        </div>
         @include('layouts.parts.product-popup')
    </div>

@stop