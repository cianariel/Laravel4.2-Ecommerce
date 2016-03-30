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
	<div class="container-fluid" style="background-color: lightgrey">
	    <div class="container fixed-sm full-480 giveaway-row" >
	    	<div class='row'>
	        	<div class="col-md-7 col-xs-8  hero-box" style="text-align: center;">
				        <div class = 'giveaway_title'><h2>{{$giveaway->giveaway_title}}</h2></div>
				        <div class = 'giveaway_img'><img src = '/assets/images/about1.png' class = 'giveaway_image'></div>
				        <div class = 'giveaway_desc'>{{$giveaway->giveaway_desc}}</div>
				        <div class = 'giveaway_button'><a class="btn btn-success col-xs-12" href="{{url('signup')}}">Get started</a></div>
				</div>
				<div  id="publicApp" ng-app="publicApp" ng-controller="publicController" class="col-md-offset-1 col-md-4  col-xs-4 hero-box qiuck-signup hidden-620" ng-cloak>
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
		                
		                <button ng-click="subscribe('')" class="btn btn-success col-xs-12"  href="#">Sign up</button>
		                <div class="line-wrap">or</div>
		                <button ng-click="registerWithFB()" class="btn btn-info col-xs-12" href="#"><i class="m-icon m-icon--facebook-id"></i>Sign up with Facebook</button>
		            </form>
		        </div>
	        </div>
	    </div>
	    <div class="container fixed-sm full-480 giveaway-row-2" >
	    	<div class='row'>
	        	<div class="col-md-7 col-xs-8  hero-box" style="text-align: center;">
				        <div>
				        <h2>Terms of Conditions</h2>
				        <p>
				        	{{$giveaway->giveaway_title}}
				        </p>
				        </div>

				</div>
	        </div>
	    </div>
    </div>
@stop
