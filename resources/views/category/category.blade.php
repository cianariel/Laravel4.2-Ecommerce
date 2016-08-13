@extends('layouts.main')

@section('body-class'){{ 'homepage category' }}@stop

@section('content')
    <?php
    if(!function_exists('is_single')){
        echo  '<h1 id="site-name">Ideaing</h1>
              <h2 id="site-subhead" class="hidden">Ideas for Smarter Living</h2>';
    }
    ?>

    <div class="app-wrap category-{{$thisCategory}}" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>
        {{--<section id="hero" class="landing-hero col-lg-12">c    @include('layouts.parts.home-hero-slider')--}}
        {{--</section>--}}

        <div class="white-bg col-xs-12">
            <section class="most-popular-new container center-block overhide no-padding">
                <h4 class="col-xs-12 home-subheader"><span>Popular <i class="m-icon m-icon--flame pink"></i></span></h4>
                <div class="col-sm-4 col-xs-12 popular-section category-smart-home">
                    <h5 class="category-link__smart-home  category-color">
                        <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--smart-home"></i>
                        <span class="m-icon-text text-uppercase">{{$thisCategory}}</span>
                    </h5>


        </div>

        <div class="col-xs-12 center-block overhide">

        </div>

        <div class="homepage-grid center-block">
                @include('grid.grid')

                {{--@include('layouts.parts.load-more')--}}


        <!-- custom angular template - START -->
        
        @include('layouts.parts.product-popup')

        <!-- custom angular template - END -->

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