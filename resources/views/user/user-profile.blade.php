@extends('layouts.main')

@section('body-class'){{ 'profilepage' }}@stop

@section('content')
    <div  id="pupblicApp" ng-app="publicApp" ng-controller="publicController">
        <nav class="mid-nav">
            <div class="container full-sm fixed-sm">
                <ul class="wrap col-lg-9">
                    <li class="box-link-ul  active-ul ">
                        <a class="box-link active" href="/user/profile">
                            <span class="box-link-active-line"></span>
                            <!--                                <img class="profile-photo" src="/assets/images/profile.jpg" alt="" width="40px"> -->
                            My Profile
                        </a>
                    </li>
                </ul>
            </div>
        </nav>


        <section id="hero" class="landing-hero">
            <div>
                <div class="hero-background" style="background-image: url('/assets/images/landing-hero-3.jpg');"></div>
                <div class="color-overlay"></div>
                <div class="container">
                    <div class="col-sm-6 text-right">
                        <img class="profile-photo" width="120px" src="{{$profile}}">
                        @if($showEditOption)
                            <br>
                            <br>
                            <div>
                                <button id="btn-add-friend" type="button" ng-click="openProfileSetting(true)"
                                        class="btn btn-danger">
                                    <i class=""></i>&nbsp; Change Image
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6">
                        <p>
                            <span class="fullname">{{$fullname}}</span>&nbsp;
                            <span class="location"><i class=" m-icon--Location"></i> {{$address}}</span>
                        </p>
                        <p class="description">{{$personalInfo}}</p>

                        @if(!$showEditOption)
                            <div>
                                <button id="btn-follow" type="button" class="btn " uib-dropdown-toggle>
                                    Follow <i class=" m-icon--Actions-Down-Arrow-Active"></i>
                                </button>
                                <button id="btn-add-friend" type="button" class="btn btn-primary">
                                    <i class="m-icon m-icon--Add-Friends"></i>&nbsp; Add Friends
                                </button>
                            </div>
                        @endif
                        <br>
                        <div>
                            <a href="#" class="follow">0 Follower</a>
                            <a href="#" class="follow">0 Following</a>
                        </div>
                    </div>
                </div>
                @if($showEditOption)
                    {{-- Upload Photo hide for timebeing
                    <a href="#" id="upload-photo"><i class="m-icon--Upload-Inactive"></i> Upload Photo</a>
                    --}}
                    <div class="edit-background hidden-xs hidden-sm">
                        <a href="#">
                            <i class="m-icon--Edit-Background"></i><br>
                            Edit background
                        </a>
                    </div>

                    <div class=" edit-profile">
                        <div><a href="#" class="edit-profile-link" ng-click="openProfileSetting()">Edit Profile&nbsp;&nbsp;<i
                                        class="m-icon--Edit-Profile"></i></a></div>
                        <p class="hidden-xs hidden-sm"><a href="/user/profile/{{$userPermalink}}">View your profile as
                                other people see it</a></p>
                        <p class="visible-xs visible-sm">&nbsp;</p>
                    </div>
                @endif
            </div>
        </section>
        {{-- <div class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController">--}}
        <div class="app-wrap">
            <div class="container ">
                <nav id="hero-nav">
                    <ul class=" main-content-filter ">
                        <li ng-class="{active: (activeMenu == '1' || !activeMenu)}" ng-click="activeMenu='1'">
                            <a ng-click="filterContent(null)" href="" data-filterby="all" class="all-activity">
                                <i class="m-icon m-icon--menu"></i>
                                All Activity
                            </a>
                        </li>
                        <li ng-class="{active: activeMenu == '2'}" ng-click="activeMenu='2'">
                            <a href="{{--/user/profile/my-posts--}}" class="my-post">
                                <i class="m-icon m-icon--image"></i>
                                My Posts
                            </a>
                        </li>
                        <li ng-class="{active: activeMenu == '3'}" ng-click="activeMenu='3'">
                            <a ng-click="filterContent('product')" data-filterby="products" href="" class="message">
                                <i class="m-icon m-icon--Messages"></i>
                                Messages
                            </a>
                        </li>
                        <li ng-class="{active: activeMenu == '4'}" ng-click="activeMenu='4'">
                            <a data-filterby="photos" href="" class="my-product">
                                <i class="m-icon m-icon--menu"></i>
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
@stop