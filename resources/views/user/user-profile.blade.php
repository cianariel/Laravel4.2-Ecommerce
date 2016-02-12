@extends('layouts.main')

@section('body-class'){{ 'profilepage' }}@stop

@section('content')
    <div ng-app="pagingApp" ng-controller="pagingController">
        <section id="hero" class="landing-hero">
            <div class="hero-background" style="background-image: url('/assets/images/landing-hero-3.jpg');"></div>
            <div class="color-overlay"></div>
            <div class="container">
                <div class="col-sm-6 text-right">
                    <img class="profile-photo" width="120px" src="{{$profile}}">
                </div>
                <div class="col-sm-6">
                    <p>
                        <span class="fullname">{{$fullname}}</span>&nbsp;
                        <span class="location"><i class=" m-icon--Location"></i> Oklahoma, USA</span>
                    </p>
                    <p class="description">Only the best tech gadgets from Apple. Samsung and LG.</p>
                    <div>
                        <button id="btn-follow" type="button" class="btn " uib-dropdown-toggle>
                            Follow <i class=" m-icon--Actions-Down-Arrow-Active"></i>
                        </button>
                        <button id="btn-add-friend" type="button" class="btn btn-primary" >
                            <i class="m-icon m-icon--Add-Friends"></i>&nbsp; Add Friends 
                        </button>
                    </div>
                    <br>
                    <div>
                        <a href="#" class="follow">1550 Followers</a>
                        <a href="#" class="follow">91 Following</a>
                    </div>
                </div>
            </div>
            <a href="#" id="upload-photo" ><i class="m-icon--Upload-Inactive"></i> Upload Photo</a>
            <div class="edit-background hidden-xs hidden-sm">
                <a href="#">
                    <i class="m-icon--Edit-Background"></i><br>
                    Edit background
                </a>
            </div>
            <div class="hidden-xs hidden-sm edit-profile">
                <div><a href="#" class="edit-profile-link" ng-click="openProfileSetting()">Edit Profile&nbsp;&nbsp;<i class="m-icon--Edit-Profile"></i></a></div>
                <p><a href="#">View your profile as other people see it</a></p>
            </div>
        </section>
        <div class="app-wrap" >
            <div class="container ">
                <nav id="hero-nav" >
                    <ul class="breadcrumb pull-left hidden-xs hidden-sm">
                        <li><a href="/"><i class="m-icon--Home"></i> Home</a> <span>-></span></li>
                        <li><a href="/user/profile"><img class="profile-photo" width="40px" src="{{$profile}}" alt=""> My Profile</a></li>
                    </ul>
                    <ul class=" main-content-filter pull-right">
                        <li ng-class="{active: (activeMenu == '1' || !activeMenu)}" ng-click="activeMenu='1'">
                            <a ng-click="filterContent(null)"  href="" data-filterby="all" class="all-activity">
                                <i class="m-icon m-icon--menu"></i>
                                All Activity
                                
                            </a>
                        </li>
                        <li ng-class="{active: activeMenu == '2'}" ng-click="activeMenu='2'">
                            <a href="/user/profile/my-posts" class="my-post">
                                <i class="m-icon m-icon--image"></i>
                                My Posts
                            </a>
                        </li>
                        <li ng-class="{active: activeMenu == '3'}" ng-click="activeMenu='3'">
                            <a  ng-click="filterContent('product')" data-filterby="products" href="" class="message">
                                <i class="m-icon m-icon--Messages"></i>
                                Messages
                            </a>
                        </li>
                        <li ng-class="{active: activeMenu == '4'}" ng-click="activeMenu='4'">
                            <a data-filterby="photos" href="" class="my-product">
                                <i class="m-icon m-icon--shopping-bag-light-green"></i>
                                My Products
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="clearfix"></div>
            <br><br>
            @if($permalink == 'my-posts')
                @include('user.parts.post')
            @else
                @include('user.parts.feed')
            @endif
        </div>
    </div>
    <script src="/assets/js/vendor/angular-busy.min.js"></script>
    <script src="/assets/js/angular-custom/custom.paging.js"></script>
    <script src="/assets/js/angular-custom/public.common.js"></script>
@stop