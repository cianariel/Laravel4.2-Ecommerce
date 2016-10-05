@extends('layouts.main')

@section('body-class'){{ 'profilepage' }}@stop

@section('content')
    <div id="pupblicApp" ng-app="publicApp" ng-controller="publicController">
        <section id="hero" class="landing-hero">
            <div>
                <div class="container">
                    <div class="col-sm-3">
                        <div class="user-score white-bg pink">
                            <h5>User Score <span>Level 1</span></h5>
                            <div class="percent">95%</div>
                            <div>
                                <span>Comments</span>
                                <div class="progress-bar"></div>
                                25/300
                            </div>
                            <div>
                                <span>Likes</span>
                                <div class="progress-bar"></div>
                                25/300
                            </div>
                            <div>
                                <span>Shares</span>
                                <div class="progress-bar"></div>
                                25/300
                            </div>
                        </div>

                        <div class="white-bg">
                            Share your profile
                            <button class="fb">Facebook</button>
                            <button class="twi">Twitter</button>
                        </div>

                        @if(!$showEditOption)
                                {{--<button id="btn-follow" type="button" class="btn " uib-dropdown-toggle>--}}
                                {{--Follow <i class=" m-icon--Actions-Down-Arrow-Active"></i>--}}
                                {{--</button>--}}
                                <button id="btn-add-friend" type="button" class="btn btn-primary">
                                    <i class="m-icon m-icon--Add-Friends"></i>&nbsp; Add Friends
                                </button>
                        @endif

                    </div>

                    <div class="col-sm-9">
                        <div class="col-sm-4 text-right">
                            <img class="profile-photo img-circle full-wide" src="{{$profile}}">
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

                        <div class="col-sm-8">
                            <p>
                                <span class="fullname lightfont">{{$fullname}}</span>&nbsp;
                                {{--<span class="location"><i class=" m-icon--Location"></i> {{$address}}</span>--}}
                            </p>
                            <p class="description">{{$personalInfo}}</p>



                            <ul class="share-buttons">
                                <li><a data-service="facebook" class="fb" href="#" ng-click="openSharingModal('facebook')"><i class="m-icon m-icon--facebook-id"></i> </a></li>
                                <li><a data-service="twitter" class="twi" href="#" ng-click="openSharingModal('twitter')"><i class="m-icon  m-icon--twitter-id"></i> </a></li>
                            </ul>

                            {{--<div>--}}
                                {{--<a href="#" class="follow">0 Follower</a>--}}
                                {{--<a href="#" class="follow">0 Following</a>--}}
                            {{--</div>--}}

                            <div>
                                <a href="#" class="follow"
                                   socialshare
                                   socialshare-via="{{env('FB_APP')}}"
                                   socialshare-type="feed"
                                   socialshare-provider="facebook"
                                   socialshare-text="Welcome to Ideaing"
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
                                   socialshare-text="Welcome to Ideaing"
                                   socialshare-hashtags="Ideaing"
                                   socialshare-url="https://ideaing.com"
                                        >
                                    Invite Twitter Friends
                                </a>
                            </div>

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