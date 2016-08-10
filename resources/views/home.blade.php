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

        <div class="white-bg col-xs-12">
            <section class="most-popular-new container center-block overhide no-padding">
                <h4 class="col-xs-12 home-subheader"><span>Popular <i class="m-icon m-icon--flame pink"></i></span></h4>
                <div class="col-sm-4 col-xs-12 popular-section category-smart-home">
                    <h5 class="category-link__smart-home  category-color">
                        <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--smart-home"></i>
                        <span class="m-icon-text text-uppercase">Smart Home</span>
                    </h5>

                    @if(@$mostPopular->smart_home)
                           <?php $i = 0; ?>
                        @foreach($mostPopular->smart_home as $item)
                            @if($i == 1)
                                <div class="popular-wrap">
                            @endif

                                @if(@$item->product_name) <!-- this is a product -->
                                    <div class="box-item product-box relative">
                                        <a href="/product/{{$item->product_permalink}}" >
                                            <img class="img-responsive" src="{{ $item->media_link_full_path }}">
                                        </a>
                                        <a href="{{$item->product_permalink}}" class="category-{{$item->master_category}}">
                                            <div class="box-item__overlay category-bg"></div>
                                        </a>
                                    </div>
                                @else
                                    <div class="box-item relative">
                                        <a href="{{$item->url}}">
                                            @if(is_array(@$item->feed_image))
                                                <img alt="{{@$item->feed_image['alt']}}" title="{{@$item->feed_image['title']}}"
                                                     src="{{ @$item->feed_image['url']}}">
                                            @else
                                                <img alt="{{@$item->feed_image->alt}}" title="{{@$item->feed_image->title}}"
                                                     src="{{@$item->feed_image->url}}">
                                            @endif
                                        </a>
                                        <a href="{{$item->url}}" class="category-{{$item->category_main}}">
                                            <div class="box-item__overlay category-bg"></div>
                                        </a>
                                    </div>

                                @endif

                           @if($i == 2)
                                </div>
                           @endif
                            <?php ++$i?>
                        @endforeach
                    @endif
                </div>
                <div class="col-sm-4 col-xs-12 popular-section category-smart-body">
                <h5 class="category-link__smart-body m-icon-text-holder">
                        <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--wearables"></i>
                        <span class="m-icon-text text-uppercase">Smart Body</span>
                    </h5>
                    @if(@$mostPopular->smart_body)
                           <?php $i = 0; ?>
                        @foreach($mostPopular->smart_body as $item)
                            @if($i == 1)
                                <div class="popular-wrap">
                            @endif

                                @if(@$item->product_name) <!-- this is a product -->
                                    <div class="box-item product-box">
                                        <a href="/product/{{$item->product_permalink}}" >
                                            <img class="img-responsive" src="{{ $item->media_link_full_path }}">
                                        </a>
                                        <a href="{{$item->product_permalink}}" class="category-{{$item->master_category}}">
                                            <div class="box-item__overlay category-bg"></div>
                                        </a>
                                    </div>
                                @else
                                    <div class="box-item">
                                        <a href="{{$item->url}}">
                                            @if(is_array(@$item->feed_image))
                                                <img alt="{{@$item->feed_image['alt']}}" title="{{@$item->feed_image['title']}}"
                                                     src="{{ @$item->feed_image['url']}}">
                                            @else
                                                <img alt="{{@$item->feed_image->alt}}" title="{{@$item->feed_image->title}}"
                                                     src="{{@$item->feed_image->url}}">
                                            @endif
                                        </a>
                                        <a href="{{$item->url}}" class="category-{{$item->category_main}}">
                                            <div class="box-item__overlay category-bg"></div>
                                        </a>
                                    </div>
                                @endif

                           @if($i == 2)
                                </div>
                           @endif
                            <?php ++$i?>
                        @endforeach
                    @endif
                </div>

                <div class="col-sm-4 col-xs-12 popular-section category-smart-entertainment">
                    <h5 class="category-link__smart-entertainment m-icon-text-holder">
                        <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--video"></i>
                        <span class="m-icon-text text-uppercase">Smart Entertainment</span>
                    </h5>
                    @if(@$mostPopular->smart_entertainment)
                           <?php $i = 0; ?>
                        @foreach($mostPopular->smart_entertainment as $item)
                            @if($i == 1)
                                <div class="popular-wrap">
                            @endif

                                @if(@$item->product_name) <!-- this is a product -->
                                    <div class="box-item product-box">
                                        <a href="/product/{{$item->product_permalink}}" >
                                            <img class="img-responsive" src="{{ $item->media_link_full_path }}">
                                        </a>
                                        <a href="{{$item->product_permalink}}" class="category-{{$item->master_category}}">
                                            <div class="box-item__overlay category-bg"></div>
                                        </a>
                                    </div>
                                @else
                                    <div class="box-item">
                                        <a href="{{$item->url}}">
                                            @if(is_array(@$item->feed_image))
                                                <img alt="{{@$item->feed_image['alt']}}" title="{{@$item->feed_image['title']}}"
                                                     src="{{ @$item->feed_image['url']}}">
                                            @else
                                                <img alt="{{@$item->feed_image->alt}}" title="{{@$item->feed_image->title}}"
                                                     src="{{@$item->feed_image->url}}">
                                            @endif
                                        </a>
                                        <a href="{{$item->url}}" class="category-{{$item->category_main}}">
                                            <div class="box-item__overlay category-bg"></div>
                                        </a>
                                    </div>
                                @endif

                           @if($i == 2)
                                </div>
                           @endif
                            <?php ++$i?>
                        @endforeach
                    @endif
                </div>
            </section>
        </div>

        <div class="col-xs-12 center-block overhide">

            {{--<nav id="hero-nav" class="col-sm-9">--}}
                {{--<div class="container full-620 fixed-sm">--}}
                    {{--<ul class="category-nav main-content-filter">--}}
                        {{--<li ng-class="{active: (activeMenu == '1' || !activeMenu)}" ng-click="activeMenu='1'">--}}
                            {{--<a ng-click="filterContent(null)"  href="" data-filterby="all" class="all-link">--}}
                                {{--<i class="m-icon m-icon--menu"></i>--}}
                                {{--All--}}

                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li ng-class="{active: activeMenu == '2'}" ng-click="activeMenu='2'">--}}
                            {{--<a ng-click="filterContent('idea')" data-filterby="ideas" href="" class="ideas-link">--}}
                                {{--<i class="m-icon m-icon--bulb"></i>--}}
                                {{--Ideas--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li ng-class="{active: activeMenu == '3'}" ng-click="activeMenu='3'">--}}
                            {{--<a  ng-click="filterContent('product')" data-filterby="products" href="" class="products-link">--}}
                                {{--<i class="m-icon m-icon--item"></i>--}}
                                {{--Products--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li ng-class="{active: activeMenu == '4'}" ng-click="activeMenu='4'">--}}
                            {{--<a data-filterby="stories" href="" class="stories-link">--}}
                                {{--<i class="m-icon m-icon--image"></i>--}}
                                {{--Stories--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</nav>--}}
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
//            showImages('.grid-wrap.shown');
            $('.grid-wrap.shown').show();
        });

        // if the image in the window of browser when scrolling the page, show that image
        $(window).scroll(function() {
            showImages('.grid-wrap');
        });
    </script>

@stop