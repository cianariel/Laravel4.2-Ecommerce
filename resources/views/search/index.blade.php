@extends('layouts.main')

@section('body-class'){{ 'homepage' }}@stop

@section('content')

    <div style="padding-top: 120px" class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="SearchController" ng-cloak>
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