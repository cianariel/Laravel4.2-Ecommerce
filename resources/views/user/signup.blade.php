@extends('layouts.main')
@section('body-class'){{ 'login-signup' }}@stop

@section('content')
    <div class="login-signup-modal">

        <section class="four-sections">
            <div class="container no-padding">
                <div class="col-sm-3 col-xs-6 category-block category-smart-travel hover-zoom overhide">
                    <div class="box-item__overlay category-bg"></div>
                    <img class="img-responsive" src="/assets/images/welcome/welcome-smart-travel.jpg">
                </div>
                <div class="col-sm-3 col-xs-6 category-block category-smart-body hover-zoom overhide">
                    <div class="box-item__overlay category-bg"></div>
                    <img class="img-responsive" src="/assets/images/login-signup/signup-1.jpg">
                </div>
                <div class="col-sm-3 col-xs-6 category-block category-smart-home hover-zoom overhide">
                    <div class="box-item__overlay category-bg"></div>
                    <img class="img-responsive" src="/assets/images/login-signup/signup-2.jpg">
                </div>
                <div class="col-sm-3 col-xs-6 category-block category-smart-entertainment hover-zoom overhide">
                    <div class="box-item__overlay category-bg"></div>
                    <img class="img-responsive" src="/assets/images/welcome/welcome-smart-entertainment.jpg">
                </div>
            </div>
        </section>

        <div class="modal-intro contentable">
            <section class="row">
                <div class="container">
                    <h1>Create a Free Account</h1>
                    <h3>Join Indeaing to live smarter</h3>
                </div>
            </section>
        </div>


        <div class="content-holder" ng-app="publicApp" ng-controller="publicController">
            <div>
                <uib-alert ng-repeat="alert in alerts" type="@{{alert.type}}"
                           close="closeAlert($index)">
                    <p ng-bind-html="alertHTML"></p>
                </uib-alert>
            </div>
            <nav class="col-xs-12 login-controls contentable">
                <span  data-toggle="#signup-modal" data-hide="#login-modal" class="col-xs-6 {{(isset($tab) && $tab == 'signup') ? 'active' : ''}} ">Sign up</span>
                <span data-toggle="#login-modal" data-hide="#signup-modal" class="col-xs-6 {{(!isset($tab) || $tab == 'login' || $tab =='') ? 'active' : ''}} ">Log in</span>
            </nav>
            <div id="login-modal" class="modal-content contentable hero-box qiuck-signup modal-login" style="{{(isset($tab) && $tab != 'login') ? 'display: none;' : ''}}">
                <form>
                        <a class="btn btn-info col-xs-12"  ng-click="registerWithFB()" href="#"><i class="m-icon m-icon--facebook-id"></i>Log in with Facebook</a>
                    <div class="line-wrap modal-minor-text">or</div>
                        <span class="email-input-holder ">
                            <i class="m-icon m-icon--email-form-id black"></i>
                           <input class="form-control" ng-model="Email" type="text" placeholder="Email" name="email">
                        </span>
                        <input class="form-control" ng-model="Password" type="password" placeholder="Password" name="password">
                    <div class="modal-minor-text">
                            <input ng-model="rememberMe" type="checkbox" id="remember" name="remember"><label for="remember"><span></span>Remember me
                            </label>
                    </div>

                        <a class="btn btn-success col-xs-12" ng-click="loginUser('home')" href="#">Log in</a>

                    <div class="modal-minor-text">
                            <a class="forgot" ng-click="passwordResetRequest()" href="#">Forgot password?</a>
                    </div>

                </form>
            </div>
            <div id="signup-modal" style="{{(isset($tab) && $tab != 'signup') ? 'display: none;' : ''}}" class="modal-content hero-box qiuck-signup modal-login">
                <form>
                        <a class="btn btn-info col-xs-12" ng-click="registerWithFB()" href="#"><i class="m-icon m-icon--facebook-id"></i>Sign
                            up with Facebook</a>
                    <div class="line-wrap modal-minor-text">or</div>

                        <input class="form-control" ng-model="FullName" type="text" placeholder="Name" >
                        <span class="email-input-holder ">
                            <i class="m-icon m-icon--email-form-id black"></i>
                            <input class="form-control" ng-model="Email" ng-readonly="{{empty($email)?'false':'true'}}" ng-init="Email='{{empty($email)?'':$email}}'" type="text" placeholder="Email" >
                        </span>
                        <input class="form-control" ng-model="Password" type="password" placeholder="Password" >
                        <input class="form-control" ng-model="PasswordConf" type="password" placeholder="Retype Password" >

                        <a class="btn btn-success col-xs-12" ng-click="registerSubscribedUser()" href="#">Sign up</a>

                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    {{--<div class="background"></div>--}}

    <script src="/assets/js/main.js"></script>
@stop

