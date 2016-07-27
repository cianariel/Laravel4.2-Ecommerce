@extends('layouts.main')

@section('body-class'){{ 'homepage' }}@stop

@section('content')
    <?php
    if(!function_exists('is_single')){
        echo  '<h1 id="site-name">Ideaing</h1>
              <h2 id="site-subhead" class="hidden">Ideas for Smarter Living</h2>';
    }
    ?>

    <div class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>
            <section id="hero" class="landing-hero col-lg-12">
                @include('layouts.parts.home-hero-slider')
            </section>
        <div class="col-lg-8 center-block overhide">
            <h4 class="current-timespan col-sm-3">Today</h4>
            <nav id="hero-nav" class="col-sm-9">
                <div class="container full-620 fixed-sm">
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
                            <a data-filterby="stories" href="" class="stories-link">
                                <i class="m-icon m-icon--image"></i>
                                Stories
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="homepage-grid center-block">
                <div class="loader loader-abs" cg-busy="firstLoad"></div>
                <div class="loader loader-abs" cg-busy="filterLoad"></div>

                @include('grid.grid')

                @include('layouts.parts.load-more')


        <!-- custom angular template - START -->
        
        @include('layouts.parts.product-popup')

        <!-- custom angular template - END -->

        </div>
    @include('layouts.parts.giveaway-popup')

@stop