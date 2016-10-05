@extends('layouts.main')

@section('body-class'){{ 'profilepage' }}@stop

@section('content')
    <div id="pupblicApp" ng-app="publicApp" ng-controller="publicController">
        <section id="hero" class="landing-hero">
            <div>
                <div class="container">
                    <div class="col-sm-3">
                        <div class="user-score white-bg rounded-5 grey-border">
                            <h5 class="black">User Score <span class="pull-right">Level 1</span></h5>
                            <div class="percent pink">0%</div>
                            <div class="stat-item">
                                <span class="pink stat-name"><b>Comments</b></span>
                                <div class="progress-bar overhide full-50"></div>
                                <span class="number text-right grey pull-right">150/300</span>
                            </div>
                            <div class="stat-item">
                                <span class="pink stat-name"><b>Likes</b></span>
                                <div class="progress-bar overhide full-50"></div>
                               <span class="number text-right grey pull-right">150/300</span>
                            </div>
                            <div class="stat-item">
                                <span class="pink stat-name"><b>Shares</b></span>
                                <div class="progress-bar overhide full-50"></div>
                                <span class="number text-right grey pull-right">150/300</span>
                            </div>
                        </div>

                        <div class="share-profile white-bg rounded-5 grey-border">
                            <h5 class="text-uppercase">Share your profile</h5>

                            <ul class="share-buttons squares">
                                <li class="col-xs-6 no-padding" ><a data-service="facebook" class="fb" href="#" ng-click="openSharingModal('facebook')"><i class="m-icon m-icon--facebook-id"></i> </a></li>
                                <li class="col-xs-6 no-padding"><a data-service="twitter" class="twi" href="#" ng-click="openSharingModal('twitter')"><i class="m-icon  m-icon--twitter-id"></i> </a></li>
                            </ul>

                        </div>

                        {{--@if(!$showEditOption)--}}
                                {{--<button id="btn-follow" type="button" class="btn " uib-dropdown-toggle>--}}
                                {{--Follow <i class=" m-icon--Actions-Down-Arrow-Active"></i>--}}
                                {{--</button>--}}
                                <button id="btn-add-friend" type="button" class="btn btn-success col-xs-12">
                                   &nbsp; Add Friends
                                </button>
                        {{--@endif--}}

                    </div>

                    <div class="col-sm-9 static">
                        <div class="col-sm-3 text-right avatar-wrap">
                            <img class="img-circle full-wide" src="{{$profile}}">
                            {{--@if($showEditOption)--}}
                                    <span class="change-foto-button" ng-click="openProfileSetting(true)">
                                        <i class="m-icon m-icon--camera-active"></i>
                                    </span>
                            {{--@endif--}}
                        </div>

                        <div class="col-sm-8">
                            <p>
                                <span class="fullname lightfont">{{$fullname}}</span>&nbsp;
                                {{--                @if($showEditOption)--}}

                                {{--<div class="edit-background hidden-xs hidden-sm">--}}
                                {{--<a href="#">--}}
                                {{--<i class="m-icon--Edit-Background"></i><br>--}}
                                {{--Edit background--}}
                                {{--</a>--}}
                                {{--</div>--}}

                                <a href="#" class="btn edit-profile-link white-bg pink" ng-click="openProfileSetting()"><i class="m-icon--Edit-Profile"></i> Edit Profile&nbsp;&nbsp;</a>
                                {{--<p class="hidden-xs hidden-sm"><a href="/user/profile/{{@$userPermalink}}">View your profile as--}}
                                {{--other people see it</a></p>--}}
                                {{--<p class="visible-xs visible-sm">&nbsp;</p>--}}
                                {{--@endif--}}
                            </p>
                            <p class="description">{{$personalInfo}}</p>

                            <ul class="share-buttons">
                                <li class="col-xs-1 no-padding"><a data-service="facebook" class="fb" href="#" ng-click="openSharingModal('facebook')"><i class="m-icon m-icon--facebook-id"></i> </a></li>
                                <li class="col-xs-1"><a data-service="twitter" class="twi" href="#" ng-click="openSharingModal('twitter')"><i class="m-icon  m-icon--twitter-id"></i> </a></li>
                            </ul>



                            {{--<div>--}}
                                {{--<a href="#" class="follow">0 Follower</a>--}}
                                {{--<a href="#" class="follow">0 Following</a>--}}
                            {{--</div>--}}

                            {{--<div>--}}
                                {{--<a href="#" class="follow"--}}
                                   {{--socialshare--}}
                                   {{--socialshare-via="{{env('FB_APP')}}"--}}
                                   {{--socialshare-type="feed"--}}
                                   {{--socialshare-provider="facebook"--}}
                                   {{--socialshare-text="Welcome to Ideaing"--}}
                                   {{--socialshare-hashtags="Ideaing"--}}
                                   {{--socialshare-url="https://ideaing.com"--}}
                                        {{-->--}}
                                    {{--Invite Facebook Friends--}}
                                {{--</a>--}}

                                {{--<a href="#" class="follow"--}}
                                   {{--socialshare--}}
                                   {{--socialshare-via="{{env('FB_APP')}}"--}}
                                   {{--socialshare-type="feed"--}}
                                   {{--socialshare-provider="twitter"--}}
                                   {{--socialshare-text="Welcome to Ideaing"--}}
                                   {{--socialshare-hashtags="Ideaing"--}}
                                   {{--socialshare-url="https://ideaing.com"--}}
                                        {{-->--}}
                                    {{--Invite Twitter Friends--}}
                                {{--</a>--}}
                            {{--</div>--}}

                        </div>
                            <nav id="hero-nav" class="col-xs-12">
                                @if(empty($notification))
                                    <ul class="main-content-filter over-visible">
                                        <li ng-class="{active: (activeMenu == '1' || !activeMenu)}" ng-click="activeMenu='1'">
                                            <a ng-click="clickOnActivity('{{$permalink}}', 5)" href="/user/profile/{{$permalink}}"
                                               data-filterby="all" class="selected active all-activity swing-lined blue-line">
                                                <div><i class="m-icon m-icon--menu"></i>
                                                All Activity</div>
                                            </a>
                                        </li>

                                        <li ng-class="{active: activeMenu == '2'}" ng-click="activeMenu='2'">
                                            <a ng-click="clickOnActivityLike('{{$permalink}}', 5)" class="my-purchases swing-lined green-line">
                                                <div><i class="m-icon m-icon--deals green"></i>
                                                0 Purchases</div>
                                            </a>
                                        </li>
                                        <li ng-class="{active: activeMenu == '2'}" ng-click="activeMenu='2'">
                                            <a ng-click="clickOnActivityLike('{{$permalink}}', 5)" class="my-likes swing-lined">
                                                <div><i class="m-icon m-icon--heart-id pink"></i>
                                                15 Likes</div>
                                            </a>
                                        </li>
                                        {{--<li ng-class="{active: activeMenu == '3'}" ng-click="activeMenu='3'">--}}
                                        {{--<a ng-click="clickOnActivityComment('{{$permalink}}', 5)" class="my-comments">--}}
                                        {{--<i class="m-icon--comments-id"></i>--}}
                                        {{--<span>Comments</span>--}}
                                        {{--</a>--}}
                                        {{--</li>--}}
                                        {{--<li ng-class="{active: activeMenu == '4'}" ng-click="activeMenu='4'">--}}
                                        {{--<a ng-click="clickOnPost('{{$permalink}}', 6)" class="my-post">--}}
                                        {{--<i class="m-icon m-icon--image"></i>--}}
                                        {{--<span>Posts</span>--}}
                                        {{--</a>--}}
                                        {{--</li>--}}


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
                </div>

            </div>
        </section>

        <div class="app-wrap">

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