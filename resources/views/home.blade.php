@extends('layouts.main')

@section('body-class'){{ 'homepage' }}@stop

@section('content')
    <?php
    if(!function_exists('is_single')){
        echo  '<h1 id="site-name">Ideaing</h1>
              <h2 id="site-subhead" class="hidden">Ideas for Smarter Living</h2>';
    }
    ?>
    <section id="hero" class="landing-hero">
        @if(empty($userData['email']))
             @if(isset($homehero))
                @foreach( $homehero as $key => $image )
                    <div class="rsContent">
                            <div id="hero-bg" style="background-image: url('{{$image['hero_image']}}'); "></div>
                            <div class="color-overlay"></div>
                            <div class="container fixed-sm full-480">
                                <div class="col-md-5 col-xs-6 full-620 col-md-offset-1 why-us">
                                    <h2>Ideas for Smarter Living</h2>
                                    <ul>
                                    <li class="get-ideas"><i class="m-icon m-icon--heart-id"></i>Discover smart home products that will change your life</li>
                                    <li class="share-vote">
                                        <i class="m-icon m-icon--bulb"></i>Share ideas on making your home automated and beautiful
                                        <img id="hero-arrow" src="assets/images/home-arrow.png" alt="">
                                    </li>
                                    <li class="shop-cool"><i class="m-icon m-icon--shopping-bag-light-green"></i>Shop for new and innovative home gadgets and decor</li>
                                    </ul>
                                </div>
                                <div  id="publicApp" ng-app="publicApp" ng-controller="publicController" class="col-md-4 col-xs-6 col-md-offset-1 hero-box qiuck-signup hidden-620" ng-cloak>
                                    <div class="response-wrap">
                                        <strong>@{{ responseMessage }}</strong>
                                    </div>
                                    <form>
                                        <h4>
                                            <b>Sign-up in Seconds</b>
                                        </h4>

                                        <span class="email-input-holder ">
                                            <i class="m-icon m-icon--email-form-id"></i>
                                            <input class="form-control" ng-model="SubscriberEmail" type="text" placeholder="Email" name="email">
                                        </span>

                                        <button ng-click="subscribe('')" class="btn btn-success col-xs-12"  href="#">Sign up</button>
                                        <div class="line-wrap">or</div>
                                        <button ng-click="registerWithFB()" class="btn btn-info col-xs-12" href="#"><i class="m-icon m-icon--facebook-id"></i>Sign up with Facebook</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                @endforeach
            @endif
        @else
                @include('layouts.parts.hero-slider')
        @endif
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
                    </li>
                </ul>
            </div>
        </nav>

        <div class="clearfix"></div>

        <div class="homepage-grid center-block">
                <div class="loader loader-abs" cg-busy="firstLoad"></div>

                @include('grid.grid')

                @include('layouts.parts.load-more')


                        <!-- custom angular template - START -->
        
        @include('layouts.parts.product-popup')

        <!-- custom angular template - END -->
        
        </div>
@stop