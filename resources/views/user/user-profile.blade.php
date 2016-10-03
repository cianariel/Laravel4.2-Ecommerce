@extends('layouts.main')

@section('body-class'){{ 'profilepage' }}@stop

@section('content')
    <div id="pupblicApp" ng-app="publicApp" ng-controller="publicController">
        <nav class="mid-nav">
            <div class="container full-sm fixed-sm">
                <ul class="wrap col-lg-9">
                    <li class="box-link-ul  active-ul ">
                        <a class="box-link active" href="/user/profile">
                            <span class="box-link-active-line"></span>
                            <!-- <img class="profile-photo" src="/assets/images/profile.jpg" alt="" width="40px"> -->
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


                        <br>
                        <div>
                            <a href="#" class="follow"
                               socialshare
                               socialshare-via="{{env('FB_APP')}}"
                               socialshare-type="feed"
                               socialshare-provider="facebook"
                               socialshare-text="Join Ideaing"
                               socialshare-hashtags="Ideaing"
                               socialshare-url="https://ideaing.com"
                            >
                                Invite Facebook Friends
                            </a>

                            <a href="#" class="follow"
                               socialshare
                               socialshare-via="{{env('FB_APP')}}"
                               socialshare-type="feed"
                               socialshare-provider="twitter"
                               socialshare-text="Join Ideaing"
                               socialshare-hashtags="Ideaing"
                               socialshare-url="https://ideaing.com"
                            >
                                Invite Twitter Friends
                            </a>
                        </div>

                    </div>
                </div>
                @if($showEditOption)

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

        <div class="app-wrap">
            <div class="container ">
                <nav id="hero-nav">
                    @if(empty($notification))
                        <ul class="main-content-filter ">
                            <li ng-class="{active: (activeMenu == '1' || !activeMenu)}" ng-click="activeMenu='1'">
                                <a ng-click="clickOnActivity('{{$permalink}}', 5)" href="/user/profile/{{$permalink}}"
                                   data-filterby="all" class="selected all-activity">
                                    <i class="m-icon m-icon--menu"></i>
                                   All Activity
                                </a>
                            </li>

                            <li ng-class="{active: activeMenu == '2'}" ng-click="activeMenu='2'">
                                <a ng-click="clickOnActivityLike('{{$permalink}}', 5)" class="my-likes">
                                    <i class="m-icon m-icon--heart-id"></i>
                                    <span>Likes</span>
                                </a>
                            </li>
                            <li ng-class="{active: activeMenu == '3'}" ng-click="activeMenu='3'">
                                <a ng-click="clickOnActivityComment('{{$permalink}}', 5)" class="my-comments">
                                    <i class="m-icon--comments-id"></i>
                                    <span>Comments</span>
                                </a>
                            </li>
                            <li ng-class="{active: activeMenu == '4'}" ng-click="activeMenu='4'">
                                <a ng-click="clickOnPost('{{$permalink}}', 6)" class="my-post">
                                    <i class="m-icon m-icon--image"></i>
                                    <span>Posts</span>
                                </a>
                            </li>


                            <li class="hidden" ng-class="{active: activeMenu == '4'}" ng-click="activeMenu='4'">
                                <a data-filterby="photos" href="" class="my-product">
                                    <i class="m-icon m-icon--menu"></i>
                                    My Products
                                </a>
                            </li>
                        </ul>
                    @endif
                </nav>
            </div>
            <div class="clearfix"></div>
            <br><br>

            @if(empty($notification))
                @if(!empty($showProfilePosts))
                    @include('user.parts.post')
                @else
                    @include('user.parts.feed')
                @endif
            @else
                @include('user.parts.notification')
            @endif
        </div>
    </div>
@stop