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
                  class="col-md-4 col-xs-6 col-md-offset-1 hero-box qiuck-signup hidden-620">
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
    <div class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController">
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

        
        <script type="text/ng-template" id="product-popup.html">
            <div class="lbMain">
                <div class="lbImageContainer">
                    <div id="product-slider" class="product-slider slider">
                        <div>
                            <img 
                                 src="http://s3-us-west-1.amazonaws.com/ideaing-01/product-56b246ce6326f-dvx-at100-1.jpg"
                                 class="attachment-large wp-post-image"
                                 alt=""/>
                        </div>
                        <div>
                            <img 
                                 src="http://s3-us-west-1.amazonaws.com/ideaing-01/product-56b246ce6326f-dvx-at100-1.jpg"
                                 class="attachment-large wp-post-image"
                                 alt=""/>
                        </div>
                    </div>
                </div>
                <div class="lbInfo">
                    <a class="close" href="#" ng-click="cancel()"><i class="m-icon--Close"></i> </a>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="p-category-holder">
                                <li>
                                    <a class="active p-category" href="#">
                                        <i class="m-icon m-icon--features-c1"></i><br>
                                        <span>Features</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="p-category" href="#">
                                        <i class="m-icon m-icon--specs"></i><br>
                                        <span>Specs</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="p-category" href="#">
                                        <i class="m-icon  m-icon--comparisons"></i><br>
                                        <span>Comparisons</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="p-category" href="#">
                                        <i class="m-icon m-icon--reviews"></i><br>
                                        <span>Reviews</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 ideaing-score-holder">
                            <div class="p-average-ideaing-score">
                                <i class="m-icon--bulb-detailed-on-rating"></i> <span class="p-score">98%</span><br>
                                <span>Average Ideaing Score</span>
                            </div>
                            <div class="pull-left p-nest-protect">
                                <p class="p-title">Nest Protect (second generation)</p>
                                <ul class="">
                                    <li>
                                        <i class="m-icon m-icon--alert"></i> GetAlerts
                                    </li>
                                    <li>
                                        <i class="m-icon m-icon--shares-active"></i> 99
                                    </li>
                                    <li>
                                        <i class="m-icon m-icon--heart2"></i> 768
                                    </li>
                                    <li>
                                        <i class="m-icon m-icon--discuss"></i> 1.2K
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 p-get-it-holder">
                            <div class="p-get-it-amazon">
                                <div class="p-body">
                                    <a class="get-round" href="http://www.dxv.com/product/at100-electronic-luxury-bidet-seat-by-dxv" target="_blank">Get it</a>
                                    <img src="/assets/images/dummies/amazon-2.png">
                                    
                                </div>
                                <div class="p-footer">
                                    From $375.00 <i class=" m-icon--Right-Arrow-Active"></i>
                                </div>
                            </div>
                            <div class="pull-left p-get-it-right">
                                <div class="col-xs-12">
                                    <div class="p-row">
                                        <span class="pull-left">Ctrutchfleld</span>
                                        <div class="p-horizontal-line"></div>
                                        <span class="pull-right"><button class="btn p-btn-get-it">$500.00</button></span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="p-row">
                                        <div class="p-horizontal-line"></div>
                                        <span class="pull-left">Amazon</span>
                                        <span class="pull-right"><button class="btn p-btn-get-it">$500.00</button></span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="p-row">
                                        <div class="p-horizontal-line"></div>
                                        <span class="pull-left">Bose</span>
                                        <span class="pull-right"><button class="btn p-btn-get-it">$500.00</button></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 p-row-group">
                                <ul class="share-buttons hidden-xs col-lg-7 col-md-8 pull-right">
                                    <li class="all-shares"><b>120K </b>all shares</li>
                                    <li><a class="fb" href="#"><i class="m-icon m-icon--facebook-id"></i><b>189</b></a></li>
                                    <li><a class="twi" href="#"><i class="m-icon  m-icon--twitter-id"></i><b>189</b></a></li>
                                    <li><a class="gp" href="#"><i class="m-icon m-icon--google-plus-id"></i><b>189</b></a></li>
                                    <li><a class="pint" href="#"><i class="m-icon  m-icon--pinterest-id"></i><b>189</b></a></li>
                                    <li><a class="comment" data-scrollto=".comments" href="#"><i class="m-icon m-icon--comments-id"></i><b>189</b></a></li>
                                </ul>
                        </div>
                        
                        <div class="col-xs-12 p-row-group">
                            <div class="p-row-inner">
                                <p>Nest Labs apparently loves a good challenge. Its ability to transform a real boring, utilitarian household products into smart devices beaustiful enough make a desing giant like Yves we(I imagine) is an incredible feat. And yet. Nest's original Protect smoke and carbon monoxide (CO)</p>
                                <p><a href="#" class="p-read-more">Read more <i class=" m-icon--Actions-Down-Arrow-Active"></i></a></p>
                            </div>
                        </div>

                        <!-- div class="col-xs-12 p-row-group">
                            <div class="p-row-inner specification-container">
                                <p class="specification-title">Specifications</p>
                                <p>Nest Cam and IFTTT, this $99 detector is the best connected one we've seen yet. Nest Cam and IFTTT, this $99 Nest Cam and IFTTT, this $99 dectector is the best connected one we've seen yet. If you already have a first-gen Nest Protect. I'd skip this upgrade, but I strongly recommend the</p>
                                <p><a href="#" class="p-read-more">Read more <i class=" m-icon--Actions-Down-Arrow-Active"></i></a></p>
                                <br>
                                <p class="comparisons-title">Comparisons</p>

                            </div>
                        </div -->

                        <div class="col-xs-12 p-row-group">
                            <div class="p-row-inner p-reviews-holder">
                                <br><br>
                                <p class="p-reviews-title">Reviews(4)</p>
                                <br><br>
                                <div class="reviews-medium-container">
                                    <div class="">
                                        <div class=" col-xs-12">
                                            <div class="average-score block-center">
                                                <div class="score">
                                                    <i class=" m-icon--bulb-detailed-on-rating"></i>
                                                                                                    0
                                                    %
                                                </div>
                                                <span class="caption">Average Ideaing Score</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 text-center reviews-service-holder critic">
                                            <div class="vertical-line "></div>
                                            <div class="title">Critic</div>
                                            <div class="reviews">Reviews</div>

                                            <div class="star-raiting" style="text-align: center">
                                                <span class="star"></span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                            </div>
                                            <p style="color: black" class="text-center">
                                                0
                                                <span class="light-black">
                                                    Review
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-xs-6 text-center reviews-service-holder amazon">
                                            <div class="vertical-line"></div>
                                            <div class="title"><a style="color: #00b1ff;" href="" target="_blank">Amazon</a></div>
                                            <div class="reviews">Reviews</div>
                                            <div class="star-raiting" style="text-align: center">
                                                <span class="star"></span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                            </div>
                                            <p style="color: black" class="text-center">
                                                <a href="" target="_blank">
                                                    1
                                                    <span class="light-black">
                                                        Review
                                                    </span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>                                

                            </div>
                        </div>
                        
                        <div class="col-xs-12 p-row-group">
                            <div class="p-row-inner p-comment-holder">
                                <br>
                                <div>
                                    <p class="p-comments-title pull-left">Comments<span class="p-responses"> (211 responses)</span></p>
                                    <span class="pull-right p-favorite"><i class="m-icon--heart-id"></i> 2,349</span>
                                    <div class="clearfix"></div>
                                </div>
                                <br><br>
                                <div class="p-comment-row">
                                    <div class="pull-left">
                                        <img src="/assets/images/dummies/author.png" width="50px" class="p-photo">
                                    </div>
                                    <div class="p-comment">
                                        <p>We very much enjoyed our summer stay at this incline Village condo. Very comfortable, had all thenecessites and a very responsive host. The location was great - close to bike paths, recreation center and beached. Recommended!</p>
                                        <div class="p-footer">
                                            <span class="p-time pull-left">August 2015</span>
                                            <button class="pull-right btn btn-helpful"><i class="m-icon--heart"></i> Helpful</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-comment-row">
                                    <div class="pull-left">
                                        <img src="/assets/images/dummies/author.png" width="50px" class="p-photo">
                                    </div>
                                    <div class="p-comment">
                                        <p>We very much enjoyed our summer stay at this incline Village condo. Very comfortable, had all thenecessites and a very responsive host. The location was great - close to bike paths, recreation center and beached. Recommended!</p>
                                        <div class="p-footer">
                                            <span class="p-time pull-left">August 2015</span>
                                            <button class="pull-right btn btn-helpful"><i class="m-icon--heart"></i> Helpful</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 p-row-group">
                            <div class="p-row-inner p-comment-holder p-add-comment">
                                <div class="p-comment-row">
                                    <div class="pull-left">
                                        <img src="/assets/images/dummies/author.png" width="50px" class="p-photo">
                                    </div>
                                    <div class="p-comment-box-holder">
                                        <div>
                                            <textarea id="comment-content" class="form-control" placeholder="What are you working on..."></textarea>
                                        </div>
                                        <div class="text-right p-footer">
                                            <i class="m-icon--camera"></i> &nbsp; Add a photo &nbsp; <button class="btn btn-primary">Post</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                
                </div>
            </div>
        </script>
        
        </div>
    <script src="/assets/js/vendor/angular-busy.min.js"></script>
    <script src="/assets/js/angular-custom/custom.paging.js"></script>
    <script src="/assets/js/angular-custom/public.common.js"></script>
    <script>
        angular.bootstrap(document.getElementById('pagingApp'),['pagingApp']);
      //  angular.bootstrap(document.getElementById('publicApp'),['publicApp']);
    </script>
@stop