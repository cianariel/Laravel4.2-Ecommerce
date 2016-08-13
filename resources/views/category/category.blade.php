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