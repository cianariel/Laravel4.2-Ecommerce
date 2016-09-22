@extends('layouts.main')

@section('body-class'){{ 'homepage category' }}@stop

@section('content')
    <?php
    if(!function_exists('is_single')){
        echo  '<h1 id="site-name">Ideaing</h1>
              <h2 id="site-subhead" class="hidden">Ideas for Smarter Living</h2>';
    }
    ?>

    <div class="app-wrap category-@{{ideaCategory}}" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>
        <section id="hero" class="landing-hero col-lg-12" ng-init="initGrid('{{$thisCategory}}')">
            @include('layouts.parts.home-hero-slider')
        </section>

        <div class="mostpop-wrap col-xs-12">
            <div class="homepage-grid center-block">
                <h4 class="home-subheader trending text-center no-border">Trending <i class="m-icon m-icon--flame black"></i></h4>
                <div class="col-xs-12">
                    <h6 class="home-subheader switcher text-center center-block no-padding">
                        <div class="col-xs-6 no-padding swing-lined" data-toggle=".popular-guides"><div class="block">Guides</div></div>
                        <div class="col-xs-6 no-padding swing-lined active" data-toggle=".popular-products"><div class="block">Products</span></div>
                    </h6>
                </div>

                    <section ng-if="ideaCategory == 'default'" class="most-popular-new container no-padding">
                        <div class="col-sm-4 col-xs-12 popular-section category-smart-home">
                            <h5 class="category-link__smart-home category-color">
                                <i class="hidden-xs hidden-sm m-icon m-icon--smart-home"></i>
                                <span class="m-icon-text"><span class="hidden-sm hidden-md">Smart</span> Home</span>
                            </h5>

                                <div ng-repeat="item in readContent.mostPopular.smart_home.item">
                                    @include('most-popular.single-thumb')
                                </div>

                        </div>
                        <div class="col-sm-4 col-xs-12 popular-section category-smart-body">
                            <h5 class="category-link__smart-body m-icon-text-holder">
                                <i class="hidden-xs hidden-sm m-icon m-icon--wearables"></i>
                                <span class="m-icon-text"><span class="hidden-sm hidden-md">Smart</span> Body</span>
                            </h5>
                                <div ng-repeat="item in readContent.mostPopular.smart_body.item">
                                    @include('most-popular.single-thumb')
                                </div>

                        </div>

                        <div class="col-sm-4 col-xs-12 popular-section category-smart-entertainment">
                            <h5 class="category-link__smart-entertainment m-icon-text-holder">
                                <i class="hidden-xs hidden-sm m-icon m-icon--video"></i>
                                <span class="m-icon-text"><span class="hidden-sm hidden-md">Smart</span> Entertainment</span>
                            </h5>
                                 <div ng-repeat="item in readContent.mostPopular.smart_entertainment.item">
                                    @include('most-popular.single-thumb')
                                </div>
                        </div>

                        <div class="col-sm-4 col-xs-12 popular-section category-smart-travel">
                            <h5 class="category-link__smart-travel m-icon-text-holder">
                                <i class="hidden-xs hidden-sm m-icon m-icon--wearables"></i>
                                <span class="m-icon-text"><span class="hidden-sm hidden-md">Smart</span> Entertainment</span>
                            </h5>
                                 <div ng-repeat="item in readContent.mostPopular.smart_travel.item">
                                    @include('most-popular.single-thumb')
                                </div>
                        </div>
                </section>

                <section ng-if="ideaCategory != 'default'" class="most-popular-new container no-padding">
                        <div class="col-sm-3 col-xs-12 popular-section category-@{{ideaCategory}}" ng-repeat="item in readContent['mostPopular'][ideaCategory]" >
                            @include('most-popular.single-thumb')
                        </div>
                </section>
               
            </div>
        </div>


        <div class="homepage-grid center-block latest">
                @include('grid.grid')


        <!-- custom angular template - START -->
        
                @include('layouts.parts.product-popup')

        <!-- custom angular template - END -->

        </div>
        </div>

    @include('layouts.parts.giveaway-popup')

    <script>
        function showBoxes(el) {
            var windowHeight = jQuery( window ).height();
            $(el).each(function(){
                var thisPos = $(this).offset().top;

                var topOfWindow = $(window).scrollTop();
                if (topOfWindow + windowHeight - 200 > thisPos ) {
                    $(this).addClass("fadeIn");
                }
            });
        }

        // if the image in the window of browser when the page is loaded, show that image
        $(document).ready(function(){
            $('.grid-wrap').show();
        });

        if(window.innerWidth > 620) { // mobile only
            $(window).scroll(function () {
                console.log(118181)
                showBoxes('.grid-wrap');
            });
        }
    </script>

@stop