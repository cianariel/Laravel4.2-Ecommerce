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

        <section class="most-popular col-lg-8 center-block overhide">
            @if(@$mostPopular['products'])
                @foreach($mostPopular['products'] as $product)
                    <div class="box-item product-box">
                        <img class="img-responsive" src="{{ $product->media_link_full_path }}">
                        <span class="box-item__time">{{ $product->updated_at }}</span>
                        <div class="box-item__overlay" ng-click="openProductPopup({{$product->id}})"></div>
                        @if($product->AverageScore != 0)
                            <div class="social-stats">
                                <div class="social-stats__item rating" data-toggle="tooltip" title="Ideaing Score">
                                    <span class="icon m-icon--bulb-detailed-on-rating"></span>
                                    <span class="value ng-binding">{{ $product->AverageScore }}%</span>
                                </div>
                            </div>
                        @endif
                        <div class="round-tag round-tag--product">
                            <i class="m-icon m-icon--item"></i>
                            <span class="round-tag__label">Product</span>
                        </div>
                        <div class="box-item__label-prod">
                            <a href="/product/{{$product->product_permalink}}"
                               class="box-item__label box-item__label--clear ">{{ $product->product_name }}</a>
                            <div class="clearfix"></div>

                            <div class="clearfix"></div>
                            <a target="_blank" href="/open/{{ $product->id }}/ideas" class="box-item__get-it">
                                Get it
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif

            @if(@$mostPopular['ideas'])
                @foreach(@$mostPopular['ideas'] as $item)
                        <div class="box-item">
                            <div class="img-holder">
                                @if(is_array($item->feed_image))
                                    <img alt="{{@$item->feed_image['alt']}}" title="{{@$item->feed_image['title']}}"
                                         src="{{ @$item->feed_image['url']}}">
                                @else
                                    <img alt="{{@$item->feed_image->alt}}" title="{{@$item->feed_image->title}}"
                                         src="{{@$item->feed_image->url}}">
                                @endif

                            </div>

                            <span class="box-item__time">{{$item->updated_at}}</span>
                            <div class="box-item__overlay"></div>

                            <ul class="social-stats">
                                <li class="social-stats__item">
                                    <?php
                                    $userId = !empty($userData->id) ? $userData->id : 0;
                                    ?>

                                    <heart-counter-product uid="<?php echo $userId ?>" iid="{{  $item->id }}"
                                                           plink="{{ json_encode($item->url) }}" sec='ideas'>

                                    </heart-counter-product>
                                </li>
                                <li class="social-stats__item">
                                    {{-- <a href="#">
                                         <i class="m-icon m-icon--buble"></i>
                                         <span class="social-stats__text">157</span>
                                     </a>--}}
                                </li>
                            </ul>

                            <div class="round-tag round-tag--idea">
                                <i class="m-icon m-icon--item"></i>
                                <span class="round-tag__label">idea</span>
                            </div>

                            <div class="box-item__label-idea">
                                <a href="{{$item->url}}" class="box-item__label">{{$item->title}}</a>
                                <div class="clearfix"></div>
                                <a href="{{$item->url}}" class="box-item__read-more">Read More</a>
                            </div>

                            <div class="box-item__author">
                                <a href="{{$item->authorlink}}" class="user-widget">
                                    <img class="user-widget__img" src="{{$item->avator}}">
                                    <span class="user-widget__name">{{$item->author}}</span>
                                </a>
                            </div>
                        </div>
                @endforeach
            @endif
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