@extends('layouts.main')

@section('body-class'){{ 'giveaway-page' }}@stop

@section('content')
	<nav class="mid-nav">
	    <div class="container full-sm fixed-sm">
	        <ul class="wrap col-lg-9">
	            <li class="box-link-ul active-ul ">
	                <a class="box-link active" href="#">
	                    <span class="box-link-active-line"></span>
	                    Giveaway
	                </a>
	            </li>
	        </ul>
	    </div>
	</nav>
    <section id="hero" class="landing-hero">
        <div class="rsContent">
            <div id="hero-bg" style="background-image: url('/assets/images/dummies/giveaway-hero.jpg'); "></div>
            {{--<div class="color-overlay"></div>--}}
            <div class="container fixed-sm full-480">
                <div  id="publicApp" ng-app="publicApp" ng-controller="publicController" class="col-md-offset-1 col-md-4  col-xs-4 hero-box qiuck-signup hidden-620 pull-right" ng-cloak>
                    <div>
                        <strong style="color: red">@{{ responseMessage }}</strong>
                    </div>
                    <form>
                        <span class="email-input-holder ">
		                    {{--<i class="m-icon m-icon--email-form-id"></i>--}}
		                    <input class="form-control" ng-model="SubscriberEmail" type="text" placeholder="Email" name="email">
		                </span>
                        <span class="password-input-holder ">
		                    {{--<i class="m-icon m-icon--email-form-id"></i>--}}
		                    <input class="form-control" ng-model="SubscriberEmail" type="text" placeholder="Password" name="password">
		                </span>

                        <button ng-click="subscribe('')" class="btn btn-success col-xs-12"  href="#">Enter</button>
                        <div class="line-wrap">Not yet a member? Create an account!</div>
                    </form>
                </div>
            </div>
            <hgroup class="giveaway-banner">
                <div class="container">
                    <h3>
                        Monthly Giveaway
                    </h3>
                    <h4>
                        {{$giveaway->giveaway_title}}
                    </h4>
                </div>
            </hgroup>
        </div>
    </section>
    <nav id="hero-nav" class="col-sm-12">
        <div class="container">
            <ul class="share-buttons hidden-xs col-lg-7 col-md-8 pull-right">
                @include('layouts.parts.share-buttons')
                <li><a class="comment" data-scrollto=".comments" href="#"><i class="m-icon m-icon--comments-id" ng-init="getCommentsForIdeas()"></i>
                        <b ng-bind="commentsCount">
                        </b>
                    </a>
                </li>
            </ul>

            <ul class="like-nav " ng-init="heartUsers('ideas')">
                <li>
                    <div class="social-stats">
                        <div class="social-stats__item">
                            <a href="#" class="likes" ng-click="heartAction()" >
                                <i ng-class="unHeart != false ? 'm-icon m-icon--heart-solid' : 'm-icon m-icon--ScrollingHeaderHeart'">
                                        <span class="m-hover">
                                            <span class="path1"></span><span class="path2"></span>
                                        </span>
                                </i>
                                <span class="social-stats__text" ng-bind="heartCounter">&nbsp;  </span>
                            </a>
                        </div>
                    </div>

                </li>
                <?php // include('/var/www/ideaing/public/ideas/wp-content/themes/ideaing/heart-user-img.php') ?>
            </ul>
        </div>
    </nav>
	<div class="container-fluid">
	    <div class="container fixed-sm full-480 giveaway-content" >
	        	<div class="col-md-7 col-xs-8">
                    <img src="/assets/images/dummies/giveaway-hero.jpg" />
				        <div class='giveaway_title'><h2>{{$giveaway->giveaway_title}}</h2></div>
				        <div class='giveaway_img'><img src='{{$giveaway->giveaway_image}}' class='giveaway_image'></div>
				        <div class='giveaway_desc'>{{$giveaway->giveaway_desc}}</div>
				        {{--<div class='giveaway_button'><a class="btn btn-success col-xs-12" href="{{url('signup')}}">Get started</a></div>--}}
                    <div class="col-lg-6">
                        <h5>Sign in to WIN</h5>
                        <div class="line-wrap">Not yet a member? Create an account!</div>
                    </div>

                    <div  id="publicApp" ng-app="publicApp" ng-controller="publicController" class="col-lg-6 qiuck-signup hidden-620 pull-right" ng-cloak>
                        <div>
                            <strong style="color: red">@{{ responseMessage }}</strong>
                        </div>
                        <form>
                        <span class="email-input-holder ">
		                    {{--<i class="m-icon m-icon--email-form-id"></i>--}}
                            <input class="form-control" ng-model="SubscriberEmail" type="text" placeholder="Email" name="email">
		                </span>
                        <span class="password-input-holder ">
		                    {{--<i class="m-icon m-icon--email-form-id"></i>--}}
                            <input class="form-control" ng-model="SubscriberEmail" type="text" placeholder="Password" name="password">
		                </span>

                            <button ng-click="subscribe('')" class="btn btn-success col-xs-12"  href="#">Enter</button>

                        </form>
                    </div>
                    <h5 class="red">Stay tuned for these upcoming giveaways!</h5>
				</div>

	        	<div class="col-md-4 col-xs-8 pull-right giveaway-toc">
				        <h4>Terms of Conditions</h4>
				        <p>
				        	{{$giveaway->giveaway_toc}}
				        </p>
				</div>
                <section class="giveaway-slider col-lg-12">
                    <img class="giveaway-thumb" src="/assets/images/dummies/giveaway-thumb.jpg" />
                    <img class="giveaway-thumb" src="/assets/images/dummies/giveaway-thumb.jpg" />
                    <img class="giveaway-thumb" src="/assets/images/dummies/giveaway-thumb.jpg" />
                    <img class="giveaway-thumb" src="/assets/images/dummies/giveaway-thumb.jpg" />
                    <img class="giveaway-thumb" src="/assets/images/dummies/giveaway-thumb.jpg" />
                </section>
        </div>

    </div>
@stop
