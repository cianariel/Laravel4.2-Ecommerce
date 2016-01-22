@extends('layouts.main')

@section('body-class'){{ 'homepage' }}@stop

@section('content')
    <section id="hero" class="landing-hero">
        <div class="hero-background"></div>
        <div class="color-overlay"></div>

        <div class="container fixed-sm full-480">
            <div class="col-md-5 col-xs-6 full-620 col-md-offset-1 why-us">
                <h2>Ideas for Smarter Living</h2>

                <ul>
                    <li class="get-ideas">Get ideas for a smarter and sexier home</li>
                    <li class="share-vote">Share and Vote on the best theme decor</li>
                    <li class="shop-cool">Shop for cool gadgets and unique decor</li>
                </ul>

            </div>
            <div class="col-md-4 col-xs-6 col-md-offset-1 hero-box qiuck-signup hidden-620">
                <form>
                    <h4>
                        <b>Sign-up in Seconds</b>
                    </h4>

                    <input class="form-control" type="text" placeholder="First name" name="name">
                    <input class="form-control"  type="text" placeholder="Email" name="email">

                    <a class="btn btn-success col-xs-12" href="#">Sign up</a>
                    <div class="line-wrap">or</div>
                    <a class="btn btn-info col-xs-12" href="#"><i class="icon fb-icon"></i>Sign up with Facebook</a>
                </form>
            </div>


        </div>
    </section>
    <nav id="hero-nav" class="col-sm-12">
        <div class="container full-620  fixed-sm">
            {{--<ul class="left-nav col-xs-1 hidden-620">--}}
                {{--<li class="active"><a class="home-link" href="#">Home</a></li>--}}
            {{--</ul>--}}
            <ul class="category-nav main-content-filter">
                <li class="active"><a href="" data-filterby="all" class="all-link">All</a></li>
                <li><a data-filterby="ideas" href="#" class="ideas-link">Ideas</a></li>
                <li><a data-filterby="products" href="#" class="products-link">Products</a></li>
                <li><a data-filterby="photos" href="#" class="photos-link">Photos</a></li>
            </ul>
        </div>
    </nav>

    <div class="clearfix"></div>

    <div class="homepage-grid container main-content" ng-app="pagingApp" ng-controller="pagingController">

        <div class="grid-box-3">
                <div ng-if="item.type == 'idea'" ng-repeat="item in content['row-1']">
                    @include('grid.idea')
                </div>

                <div ng-if="item.type == 'product'" ng-repeat="item in content['row-1']" class="box-item product-box">
                    @include('grid.product')
                </div>
        </div>
        <div class="grid-box-3">
                <div ng-if="item.type == 'idea'" ng-repeat="item in content['row-3']">
                    @include('grid.idea')
                </div>

                <div ng-if="item.type == 'product'" ng-repeat="item in content['row-3']" class="box-item product-box">
                    @include('grid.product')
                </div>
        </div>
        <div class="grid-box-3">
                <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in content['row-5']">
                    @include('grid.idea')
                </div>

                <div ng-if="item.type == 'product'" ng-repeat="item in content['row-5']" class="box-item product-box">
                    @include('grid.product')
                </div>
        </div>

        <script>
            angular.module('pagingApp.controllers', []).
                    controller('pagingController', function($scope, pagaingApi) {
                        $scope.content = [];

                        pagaingApi.getContent().success(function (response) {
                            //Dig into the responde to get the relevant data
                            $scope.content = response;
                            console.log($scope.content['row-1'])
                        });
                    });

            angular.module('pagingApp', [
                'pagingApp.controllers',
                'pagingApp.services'
            ]);

            angular.module('pagingApp.services', []).
                    factory('pagaingApi', function($http) {

                        var pagaingApi = {};

                        pagaingApi.getContent = function() {
                            return $http({
                                method: 'GET',
                                url: '/api/paging/get-content'
                            });
                        }

                        return pagaingApi;
                    });
        </script>


        {{--<div class="grid-box-3">--}}
            {{--@foreach($content['row-1'] as $item)--}}
                {{--@if(!isset($item->type) || $item->type != 'product')--}}
                    {{--@include('grid.idea')--}}
                {{--@else--}}
                    {{--@include('grid.product')--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--</div>--}}

        {{--@if($content['row-2'])--}}
            {{--<div class="grid-box-full">--}}
                {{--@foreach($content['row-2'] as $item)--}}
                        {{--@include('grid.idea')--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--@endif--}}

        {{--<div class="grid-box-3">--}}
            {{--@foreach($content['row-3'] as $item)--}}
                {{--@if(!isset($item->type) || $item->type != 'product')--}}
                    {{--@include('grid.idea')--}}
                {{--@else--}}
                    {{--@include('grid.product')--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--</div>--}}

        {{--@if($content['row-4'])--}}
            {{--<div class="grid-box-full">--}}
                {{--@foreach($content['row-4'] as $item)--}}
                    {{--@include('grid.idea')--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--@endif--}}

        {{--<div class="grid-box-3">--}}
            {{--@foreach($content['row-5'] as $item)--}}
                {{--@if(!isset($item->type) || $item->type != 'product')--}}
                    {{--@include('grid.idea')--}}
                {{--@else--}}
                    {{--@include('grid.product')--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--</div>--}}

        {{--@if($content['row-6'])--}}
            {{--<div class="grid-box-full">--}}
                {{--@foreach($content['row-6'] as $item)--}}
                    {{--@include('grid.idea')--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--@endif--}}

        <a class="btn btn-success bottom-load-more col-xs-12">Load More</a>

    </div>


    {{--<div ng-app="pagingApp" ng-controller="pagingController">--}}
        {{--<table>--}}
            {{--<thead>--}}
            {{--<tr><th colspan="4">Drivers Championship Standings</th></tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--<tr ng-repeat="item in content">--}}
                {{--        <td>{{$index + 1}}</td>--}}
                {{--<td>--}}
                {{--@{{item.Driver.givenName}}&nbsp;@{{item.Driver.familyName}}--}}
                {{--</td>--}}
                {{--<td>@{{item.Constructors[0].name}}</td>--}}
            {{--</tr>--}}
            {{--</tbody>--}}
        {{--</table>--}}

    {{--</div>--}}


@stop