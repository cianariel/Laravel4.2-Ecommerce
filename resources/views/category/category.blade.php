@extends('layouts.main')

@section('body-class'){{ 'homepage category' }}@stop

@section('content')
    <?php
    if(!function_exists('is_single')){
        echo  '<h1 id="site-name">Ideaing</h1>
              <h2 id="site-subhead" class="hidden">Ideas for Smarter Living</h2>';
    }
    ?>

    <div class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>

        <div class="white-bg mostpop-wrap col-xs-12">
            <div class="homepage-grid center-block">
                <h4 class="col-xs-12 home-subheader"><span>Popular <i class="m-icon m-icon--flame pink"></i></span></h4>
                <section class="most-popular-new container no-padding">
                    <div class="col-sm-3 col-xs-12 popular-section category-smart-home">
                        <h5 class="category-link__smart-home  category-color">
                            <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--smart-home"></i>
                            <span class="m-icon-text text-uppercase">Smart Home</span>
                        </h5>

                        @if(@$mostPopular->smart_home)
                            @foreach($mostPopular->smart_home as $item)
                                    @include('most-popular.single-thumb')
                            @endforeach
                        @endif
                    </div>
                    <div class="col-sm-3 col-xs-12 popular-section category-smart-body">
                        <h5 class="category-link__smart-body m-icon-text-holder">
                            <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--wearables"></i>
                            <span class="m-icon-text text-uppercase">Smart Body</span>
                        </h5>
                        @if(@$mostPopular->smart_body)
                            @foreach($mostPopular->smart_body as $item)
                                @include('most-popular.single-thumb')
                            @endforeach
                        @endif
                    </div>

                    <div class="col-sm-3 col-xs-12 popular-section category-smart-entertainment">
                        <h5 class="category-link__smart-entertainment m-icon-text-holder">
                            <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--video"></i>
                            <span class="m-icon-text text-uppercase">Smart Entertainment</span>
                        </h5>
                        @if(@$mostPopular->smart_entertainment)
                            @foreach($mostPopular->smart_entertainment as $item)
                                @include('most-popular.single-thumb')
                            @endforeach
                        @endif
                    </div>

                    <div class="col-sm-3 col-xs-12 popular-section category-smart-body">
                        <h5 class="category-link__smart-body m-icon-text-holder">
                            <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--video"></i>
                            <span class="m-icon-text text-uppercase">Smart Entertainment</span>
                        </h5>
                        @if(@$mostPopular->smart_body)
                            @foreach($mostPopular->smart_body as $item)
                                @include('most-popular.single-thumb')
                            @endforeach
                        @endif
                    </div>
                </section>
            </div>
        </div>


        <div class="homepage-grid center-block">
                @include('grid.grid')


        <!-- custom angular template - START -->
        
                @include('layouts.parts.product-popup')

        <!-- custom angular template - END -->

        </div>
        </div>

    @include('layouts.parts.giveaway-popup')

    <script>
        function showImages(el) {
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

        // if the image in the window of browser when scrolling the page, show that image
        $(window).scroll(function() {
            showImages('.grid-wrap');
        });
    </script>

@stop