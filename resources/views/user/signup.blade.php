@extends('layouts.main')
@section('body-class'){{ 'login-signup' }}@stop

@section('content')
    <div class="login-signup-modal">

        <section class="four-sections">
            <div class="container no-padding">
                <div class="col-sm-3 col-xs-6 category-block category-smart-travel hover-zoom overhide">
                    <div class="box-item__overlay category-bg"></div>
                    <img class="img-responsive" src="/assets/images/login-signup/signup-0.jpg">
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
                    <img class="img-responsive" src="/assets/images/login-signup/signup-4.jpg">
                </div>
            </div>
        </section>

        <section class="row  pale-grey-bg">
            <div class="container text-center padding-40">
                <h1>Create a Free Account</h1>
                <h4 class="grey">Join Indeaing to live smarter</h4>
            </div>
        </section>

        <section class="row">
            <div class="container text-center padding-40 form-box" ng-app="publicApp" ng-controller="publicController">
                <uib-alert ng-repeat="alert in alerts" type="@{{alert.type}}"
                           close="closeAlert($index)">
                    <p ng-bind-html="alertHTML"></p>
                </uib-alert>

                <section id="signup-modal"  style="{{(isset($tab) && $tab != 'signup') ? 'display: none;' : ''}}">
                    <div class="col-lg-6">
                        <nav class="col-xs-12 login-controls contentable">
                            <a class="btn btn-info col-xs-12" ng-click="registerWithFB()" href="#"><i class="m-icon m-icon--facebook-id"></i>Sign up with Facebook</a>
                            <span data-toggle="#login-modal" data-hide="#signup-modal" class="btn btn-info col-xs-12 green-bg text-uppercase {{(!isset($tab) || $tab == 'login' || $tab =='') ? 'active' : ''}} "><span class="m-icon m-icon--email-form-id white"></span> Log in with Email</span>
                        </nav>
                    </div>

                    <div class="col-lg-6">
                        <div class="modal-content hero-box qiuck-signup modal-login">
                            <h3 class="text-left">Register</h3>
                            <form>
                                <input class="first form-control" ng-model="FullName" type="text" placeholder="Name" >
                            <input class="form-control" ng-model="Email" ng-readonly="{{empty($email)?'false':'true'}}" ng-init="Email='{{empty($email)?'':$email}}'" type="text" placeholder="Email" >
                                <input class="form-control" ng-model="Password" type="password" placeholder="Password" >
                                <input class="last form-control" ng-model="PasswordConf" type="password" placeholder="Retype Password" >
                                <div class="modal-minor-text">
                                    <input ng-model="rememberMe" type="checkbox" id="remember" name="remember" ><label for="remember"><span></span> <b class="grey">By Signing up, you agree to <a href="/terms-of-use">TERMS AND CONDITIONS</a> of Ideaing</b>
                                    </label>
                                </div>
                                <a class="btn btn-success col-xs-12" ng-click="registerSubscribedUser()" href="#">
                                    <span class="lamp-wrap">
                                        <span class="m-icon--bulb2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
                                    </span>
                                    <b>Create new account</b>
                                </a>
                            </form>
                        </div>
                    </div>
                </section>

                <section id="login-modal">
                    <div class="col-lg-6">
                        <nav class="col-xs-12 login-controls contentable">
                            <a class="btn btn-info col-xs-12"  ng-click="registerWithFB()" href="#"><i class="m-icon m-icon--facebook-id"></i>Log in with Facebook</a>
                            <span  data-toggle="#signup-modal" data-hide="#login-modal" class="btn btn-info col-xs-12 green-bg text-uppercase {{(isset($tab) && $tab == 'signup') ? 'active' : ''}} "><span class="m-icon m-icon--email-form-id white"></span> Sign up with Email</span>
                        </nav>
                    </div>

                    <div class="col-lg-6">
                        <div class="modal-content contentable hero-box qiuck-signup modal-login" style="{{(isset($tab) && $tab != 'login') ? 'display: none;' : ''}}">
                            <form>
                                <h3 class="text-left">Login</h3>
                               <input class="first form-control" ng-model="Email" type="text" placeholder="Email" name="email">
                                <input class="last form-control" ng-model="Password" type="password" placeholder="Password" name="password">
                                <div class="modal-minor-text">
                                    <input ng-model="rememberMe" type="checkbox" id="remember" name="remember" ><label for="remember"><span></span> <b class="grey">Remember me</b>
                                    </label>
                                </div>

                                <a class="btn btn-success col-xs-12" ng-click="loginUser('home')" href="#">
                                    <span class="lamp-wrap">
                                        <span class="m-icon--bulb2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
                                    </span>
                                    <b>Log in</b>
                                </a>
                                <div class="modal-minor-text">
                                    <a class="forgot" ng-click="passwordResetRequest()" href="#">Forgot password?</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </section>


        <section class="row to-home">
            <div class="container text-center padding-40">
                <span class="m-icon--bulb2 center-block"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
                <h4 class="grey">HOME</h4>
            </div>
        </section>

    {{--<div class="background"></div>--}}

    <script src="/assets/js/main.js"></script>
@stop

