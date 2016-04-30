@extends('layouts.main')

@section('body-class'){{ 'giveaway-page'}}{{$ended ? ' expired' : ''}}@stop

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
            <div id="hero-bg"  style="background-image: url({{$giveaway->giveaway_image}}); "></div>
            <div class="container fixed-sm full-480">

                <div  id="publicApp" ng-app="publicApp" ng-controller="publicController" class="col-md-offset-1 col-md-4 col-xs-12 hero-box qiuck-signup pull-right" ng-cloak>
                    <img id="hero-arrow" src="assets/images/home-arrow.png" alt="">
                    <div>
                        <strong style="color: red">@{{ responseMessage }}</strong>
                    </div>
                    <form>
                        <span class="email-input-holder ">
		                    <input class="form-control" ng-model="SubscriberEmail" type="text" placeholder="Email" name="email" value="{{@$userData['email']}}">
		                </span>
                        <span class="password-input-holder ">
		                    <input class="form-control" ng-model="SubscriberPassword" type="text" placeholder="Password" name="password">
                           <input ng-model="GiveAwayID" type="hidden" name="giveaway_id" value="{{$giveaway->id}}">

		                </span>

                        <button ng-click="enterGiveaway('')" class="btn btn-success col-xs-12"  href="#">Enter</button>
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

        </div>
    </nav>
	<div class="container-fluid">
	    <div class="container fixed-sm full-480 giveaway-content" >
	        	<div class="col-md-7 col-xs-12">
				        <div class='giveaway_title'><h2>{{$giveaway->giveaway_title}}</h2></div>
				        <div class='giveaway_desc'>{{$giveaway->giveaway_desc}}</div>
                   <section class="col-lg-12 sign-in">
                       @if(@$userData['login'])
                           <div class="col-lg-6">
                               <h5>Hi <span>{{$userData['name']}}!</span></h5>
                           </div>
                           <div  id="publicApp" ng-app="publicApp" ng-controller="publicController" class="col-lg-6 col-xs-12 qiuck-signup pull-right" ng-cloak>

                               <form ng-if="!responseMessage.success">
                                   <div>
                                       <strong class="red">@{{ responseMessage.error }}</strong>
                                   </div>
                                <input id="user-email" ng-model="SubscriberEmail" type="hidden" name="email" value="{{@$userData['email']}}">
                                 <input id="giveaway_id" ng-model="GiveAwayID" type="hidden" name="giveaway_id" value="{{$giveaway->id}}">
                                   <button ng-click="enterGiveaway('')" class="btn btn-success col-xs-12"  href="#">Enter Giveaway</button>
                               </form>

                               <form ng-if="responseMessage.success">
                                   <div>
                                       <strong class="red">@{{ responseMessage.success }}</strong>
                                   </div>
                               </form>
                           </div>
                       @else
                           <div class="col-lg-6">
                               <h5>Sign in to <span>WIN!</span></h5>
                               <div data-switch=".giveaway-signup" data-hide=".giveaway-login" class="giveaway-login line-wrap">Not yet a member? Create an account!</div>
                               <div data-switch=".giveaway-login" data-hide=".giveaway-signup" class="giveaway-signup line-wrap hidden-soft">Already a member? Sign in!</div>
                           </div>

                           <div  id="publicApp" ng-app="publicApp" ng-controller="publicController" class="col-lg-6 col-xs-12 qiuck-signup pull-right giveaway-login" ng-cloak>
                               <div>
                                   <strong style="color: red">@{{ responseMessage }}</strong>
                               </div>
                               <form>
                            <span class="email-input-holder ">
                                <input class="form-control" ng-model="SubscriberEmail" type="text" placeholder="Email" name="email">
                            </span>
                            <span class="password-input-holder ">
                                <input class="form-control" ng-model="SubscriberPassword" type="text" placeholder="Password" name="password">
                                 <input id="giveaway_id" ng-model="GiveAwayID" type="hidden" name="giveaway_id" value="{{$giveaway->id}}">
                            </span>

                                   <button ng-click="enterGiveaway('')" class="btn btn-success col-xs-12"  href="#">Enter</button>
                               </form>
                           </div>

                           <div class="col-lg-6 col-xs-12 qiuck-signup pull-right hidden-soft giveaway-signup">
                               <form>
                                   <a class="btn btn-info col-xs-12" ng-click="registerWithFB()" href="#"><i class="fa fa-facebook"></i>Sign
                                       up with Facebook</a>
                                   <div class="line-wrap modal-minor-text">or</div>

                                   <input class="form-control" ng-model="FullName" type="text" placeholder="Name" >
                                   <input class="form-control" ng-model="Email" type="text" placeholder="Email" >
                                   <input class="form-control" ng-model="Password" type="password" placeholder="Password" >
                                   <input class="form-control" ng-model="PasswordConf" type="password" placeholder="Retype Password" >

                                   <a class="btn btn-success col-xs-12" ng-click="registerUser()" href="#">Sign up</a>

                               </form>
                           </div>
                       @endif
                   </section>
				</div>

	        	<div class="col-md-4 col-xs-12 pull-right giveaway-toc">
				        <h4>Terms of Conditions</h4>
				        <p>
				        	{{$giveaway->giveaway_toc}}
				        </p>
				</div>
            <h4 class="red col-xs-12 text-center">Stay tuned for these upcoming giveaways!</h4>

            <section class="slider giveaway-slider black-slider col-lg-12">
                    <img src="/assets/images/giveaway-logo.png" class="giveaway-logo col-xs-3" />
                    <div class="giveaway-slider-content col-xs-9">
                        @foreach($nextGiveaways as $nextGive)
                            <div class="thumb-wrap">
                                <img class="giveaway-thumb" src="{{$nextGive->giveaway_image}}" />
                                <h6>{{date('F', strtotime($nextGive->goes_live))}}</h6>
                            </div>
                        @endforeach
                    </div>
                </section>
        </div>

    </div>

    <script>
        jQuery(document).ready(function($) {
            $('.giveaway-slider-content ').royalSlider({
                arrowsNav: true,
                loop: false,
                keyboardNavEnabled: true,
                controlsInside: true,
                imageScaleMode: 'fit',
                arrowsNavAutoHide: false,
//                controlNavigation: 'bullets',
//                thumbsFitInViewport: false,
                navigateByClick: false,
//                startSlideId: 0,
                autoPlay: false,
                transitionType:'move',
                globalCaption: false,
                deeplinking: {
                    enabled: true,
                    change: false
                },
                /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
                imgWidth: "100%",
                imageScaleMode: "fill",
//                autoScaleSliderWidth: 300,
//                autoScaleSliderHeight: 150,
                visibleNearby: {
                    enabled: true,
                    centerArea: 0.17,
                    center: false,
//                    breakpoint: 650,
//                    breakpointCenterArea: 0.64,
//                    navigateByCenterClick: true
                }
//    autoScaleSlider: true
            });
        });
    </script>
@stop
