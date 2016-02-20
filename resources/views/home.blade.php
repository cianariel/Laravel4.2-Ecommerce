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
                    <li class="get-ideas"><i class="m-icon m-icon--bulb3"></i>Get ideas for a smarter and sexier home</li>
                    <li class="share-vote"><i class="m-icon m-icon--heart-id"></i>Share and Vote on the best theme decor</li>
                    <li class="shop-cool"><i class="m-icon m-icon--products"></i>Shop for cool gadgets and unique decor</li>
                </ul>
            </div>
            <div  id="publicApp" ng-app="publicApp" ng-controller="publicController"
                  class="col-md-4 col-xs-6 col-md-offset-1 hero-box qiuck-signup hidden-620" ng-cloak>
<!--            <div class="col-md-4 col-xs-6 col-md-offset-1 hero-box qiuck-signup hidden-620">-->
                <div style="background-color: lightgrey; text-align: center;">
                    <strong style="color: red">@{{ responseMessage }}</strong>
                </div>
                <form>
                    <h4>
                        <b>Sign-up in Seconds</b>
                    </h4>

                    {{--<input class="form-control hide" type="text" placeholder="First name" name="name">--}}
                    <span class="email-input-holder ">
                        <i class="m-icon m-icon--email-form-id"></i>
                        <input class="form-control" ng-model="SubscriberEmail" type="text" placeholder="Email" name="email">
                    </span>
                    
                    <button ng-click="subscribe()" class="btn btn-success col-xs-12"  href="#">Sign up</button>
                    <div class="line-wrap">or</div>
                    <button ng-click="registerWithFB()" class="btn btn-info col-xs-12" href="#"><i class="m-icon m-icon--facebook-id"></i>Sign up with Facebook</button>
                </form>
            </div>


        </div>
    </section>
    <div class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>
        <nav id="hero-nav" class="col-sm-12">
            <div class="container full-620  fixed-sm">
                {{--<ul class="left-nav col-xs-1 hidden-620">--}}
                    {{--<li class="active"><a class="home-link" href="#">Home</a></li>--}}
                {{--</ul>--}}
                <ul class="category-nav main-content-filter">
                    <li ng-class="{active: (activeMenu == '1' || !activeMenu)}" ng-click="activeMenu='1'">
                        <a ng-click="filterContent(null)"  href="" data-filterby="all" class="all-link">
                            <i class="m-icon m-icon--menu"></i>
                            All
                            
                        </a>
                    </li>
                    <li ng-class="{active: activeMenu == '2'}" ng-click="activeMenu='2'">
                        <a ng-click="filterContent('idea')" data-filterby="ideas" href="" class="ideas-link">
                            <i class="m-icon m-icon--bulb"></i>
                            Ideas
                        </a>
                    </li>
                    <li ng-class="{active: activeMenu == '3'}" ng-click="activeMenu='3'">
                        <a  ng-click="filterContent('product')" data-filterby="products" href="" class="products-link">
                            <i class="m-icon m-icon--item"></i>
                            Products
                        </a>
                    </li>
                    <li ng-class="{active: activeMenu == '4'}" ng-click="activeMenu='4'">
                        <a data-filterby="photos" href="" class="photos-link">
                            <i class="m-icon m-icon--image"></i>
                            Photos
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="clearfix"></div>

        <div class="homepage-grid center-block" style="min-height:1000px">
                <div class="loader loader-abs" cg-busy="firstLoad"></div>
                {{--<div class="loader loader-abs" cg-busy="filterLoad"></div>--}}
                <div class="loader loader-fixed" cg-busy="nextLoad"></div>

                <div ng-repeat="batch in content" class="main-content col-xs-12">
                    <div class="grid-box-3">
                            <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-1']">
                                @include('grid.idea')
                            </div>

                            <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-1']" class="box-item product-box">
                                @include('grid.product')
                            </div>
                    </div>

                    <div class="grid-box-full">
                        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-2']">
                            @include('grid.idea')
                        </div>

                    </div>

                    <div class="grid-box-3">
                        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-3']">
                            @include('grid.idea')
                        </div>

                        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-3']" class="box-item product-box">
                            @include('grid.product')
                        </div>
                    </div>

                    <div class="grid-box-full">
                        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-4']">
                            @include('grid.idea')
                        </div>

                    </div>

                    <div class="grid-box-3">
                            <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-5']">
                                @include('grid.idea')
                            </div>

                            <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-5']" class="box-item product-box">
                                @include('grid.product')
                            </div>
                    </div>


                    <div class="grid-box-full">
                        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-6']">
                            @include('grid.idea')
                        </div>

                    </div>

                </div>
            {{--</div>--}}
        </div>
        <div class="container">
            <a ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12">Load More</a>
        </div>

        <!-- custom angular template - START -->
        
        @include('layouts.parts.product-popup')

        <!-- custom angular template - END -->
        
        </div>

@stop