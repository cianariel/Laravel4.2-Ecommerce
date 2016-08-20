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
        <section id="hero" class="landing-hero col-lg-12">
            @include('layouts.parts.home-hero-slider')
        </section>

        <div class="white-bg mostpop-wrap col-xs-12">
            <div class="homepage-grid center-block">
                <h4 class="col-xs-12 home-subheader"><span>Popular <i class="m-icon m-icon--flame pink"></i></span></h4>

                @if(@$mostPopular->$thisCategory)
                    <section class="most-popular-new container no-padding">
                        @foreach($mostPopular->$thisCategory as $i => $item)
                            <div class="col-sm-3 col-xs-12 popular-section category-{{$thisCategory}}">
                                @include('most-popular.single-thumb')
                            </div>
                        @endforeach
                    </section>
                @endif

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