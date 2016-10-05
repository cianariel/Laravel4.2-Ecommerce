<div id="loadDynamicData" class="container">
    <script>
        var profilePicture = '{{$profile}}';
        var profileFullName = '{{$fullname}}';
    </script>
    <!--feed start -->
    <div ng-show="ActivityActive">
        <div class="col-md-3 side-bar hidden hidden-xs hidden-sm">
            <div class="row">
                <ul class="nav sidenav">
                    <li ng-class="activeClassAll">
                        <a href="#" ng-click="showActivity('all')">
                            <i class="m-icon m-icon--menu"></i>&nbsp;
                            All Activity
                        </a>
                    </li>
                    <li ng-class="activeClassHeart">
                        <a href="#" ng-click="showActivity('heart')">
                            <i class="m-icon m-icon--heart-id"></i>&nbsp;
                            Likes
                        </a>
                    </li>
                    <li ng-class="activeClassComment">
                        <a href="#" ng-click="showActivity('comment')">
                            <i class="m-icon m-icon--comments-id"></i>&nbsp;
                            Comments
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{--<div class="col-md-9 main-content" ng-init="userActivityList({{$userData['id']}},5)">--}}
        <div class="col-md-9 main-content center-block" ng-init="userActivityList('{{$permalink}}',5)">

            <div ng-repeat="item in activityData">
                <div class="col-lg-6">
                    <div class="feed-content" ng-show="(item['Type']=='comment') && showComment">
                        <div class="feed-header ">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="pull-left">
                                        <img ng-src="@{{ profilePicture }}" width="50px" class="profile-photo" alt="">
                                    </div>
                                    <div class="pull-left name-time">
                                        <strong>@{{ profileFullName }}</strong> {{--<i class="m-icon--heart-solid"></i>--}}
                                        <br>
                                        <span class="time">@{{ item['UpdateTime'] }}</span>
                                    </div>
                                    <div class="pull-right">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feed-body ">
                            <div class="row">


                                <div class="col-xs-12" ng-show="item['Image'] !=''">
                                    <img ng-src="@{{ item['Image'] }}">
                                </div>


                                <div ng-class="item['Type'] =='heart' ? 'col-xs-12':'col-xs-12'">
                                    <strong>
                                        @{{ profileFullName }} recently
                                        <span ng-if="item['Type']=='comment'"> commented</span>
                                        <span ng-if="item['Type']!='comment'"> liked</span> a

                                        <span ng-if="item['Section']=='product'"> product</span>
                                        <span ng-if="item['Section']!='product'"> idea</span>

                                    </strong>: <a href="@{{ item['Link'] }}" target="_blank">@{{ item['Title'] }}</a>
                                </div>

                            </div>
                        </div>
                        <div class="feed-footer ">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="pull-left">
                                <span class="favorite"><i
                                            class="m-icon--heart-solid"></i> @{{ item['HeartCount'] }}</span>
                                    <span class="comment"><i
                                                class="m-icon--buble"></i> @{{ item['CommentCount'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="feed-content" ng-show="(item['Type']!='comment') && showHeart">
                    <div class="feed-header ">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pull-left">
                                    <img ng-src="@{{ profilePicture }}" width="50px" class="profile-photo" alt="">
                                </div>
                                <div class="pull-left name-time">
                                    <strong>@{{ profileFullName }}</strong> {{--<i class="m-icon--heart-solid"></i>--}}
                                    <br>
                                    <span class="time">@{{ item['UpdateTime'] }}</span>
                                </div>
                                <div class="pull-right">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="feed-body ">
                        <div class="row">


                            <div class="col-xs-12" ng-show="item['Image'] !=''">
                                <img ng-src="@{{ item['Image'] }}">
                            </div>


                            <div ng-class="item['Type'] =='heart' ? 'col-xs-12':'col-xs-12'">
                                <strong>
                                    @{{ profileFullName }} recently
                                    <span ng-if="item['Type']=='comment'"> commented</span>
                                    <span ng-if="item['Type']!='comment'"> liked</span> a

                                    <span ng-if="item['Section']=='product'"> product</span>
                                    <span ng-if="item['Section']!='product'"> idea</span>

                                </strong>: <a href="@{{ item['Link'] }}" target="_blank">@{{ item['Title'] }}</a>
                            </div>

                        </div>
                    </div>
                    <div class="feed-footer ">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pull-left">
                                <span class="favorite"><i
                                            class="m-icon--heart-solid"></i> @{{ item['HeartCount'] }}</span>
                                    <span class="comment"><i
                                                class="m-icon--buble"></i> @{{ item['CommentCount'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!--feed end-->

    <!--post start-->
    <div ng-show="postActive">
        <div class="row">
            <div class="col-md-12 main-content" ng-init="userPostList('{{$permalink}}', 6)">
                <div class="row">

                    <div ng-repeat="item in userPostData">
                        <!-- start -->
                        <div class="col-sm-6">
                            <div class="feed-content ">
                                <div class="feed-header ">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="pull-left">
                                                <img ng-src="@{{item.avator}}" width="50px" class="profile-photo"
                                                     alt="">
                                            </div>
                                            <div class="pull-left name-time">

                                                <strong>@{{item.author}}</strong> <br>
                                                <span class="time">@{{item.creation_date}}</span>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="feed-body ">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <img ng-src="@{{ item.image }}">
                                        </div>
                                        <div class="col-xs-12">
                                            <br>
                                            <a href="@{{ item.url }}" target="_blank">
                                                <strong>@{{ renderHTML(item.title) }}</strong><br>
                                                <div ng-bind-html="item.content"></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="feed-footer ">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="pull-left">
                                                <span class="favorite"><i
                                                            class="m-icon--heart-solid"></i> @{{ item.heart_count }}</span>
                                            <span class="comment"><i
                                                        class="m-icon--buble"></i> @{{ item.comment_count }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                    </div>

                </div>
                <div ng-hide="userPostData.length > 0" class="row text-center">
                    <div class="container">
                        No activity yet
                    </div>
                </div>

                <div class="col-xs-3">
                    <span class="time">3 months ago</span>

                    <div class="pull-right">
                        <span class="favorite"><i class="m-icon--heart-solid"></i> 5</span>
                        <span class="comment"><i class="m-icon--buble"></i> 0</span>
                    </div>
                </div>


                <div class="feed-content col-xs-9">
                    <div class="feed-header">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pull-left name-time">
                                    <!-- ngIf: item['Type']=='comment' -->
                                    <!-- ngIf: item['Type']!='comment' --><span ng-if="item['Type']!='comment'" class="ng-scope"> Liked</span><!-- end ngIf: item['Type']!='comment' -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="feed-body">
                        <div class="row">
                            <div class="col-xs-3">
                                <img ng-src="https://d3f8t323tq9ys5.cloudfront.net/uploads/2016/03/2016-03-30-SpeakerSystems_380.jpg">
                            </div>

                            <div ng-class="item['Type'] =='heart' ? 'col-xs-12':'col-xs-12'" class="col-xs-9">
                                <a href="https://staging.ideaing.com/ideas/?p=6683" target="_blank" class="ng-binding">How the August Smart Doorbell Cam Makes My Life Simpler &amp; Safer</a>
                            </div>

                        </div>
                    </div>
                    <div class="feed-footer ">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pull-left">
                                    <span class="favorite ng-binding"><i class="m-icon--heart-solid"></i> 5</span>
                                    <span class="comment ng-binding"><i class="m-icon--buble"></i> 0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--post end-->


</div>
<script>
    $(window).scroll(function () {
        if ($(document).height() <= $(window).scrollTop() + $(window).height()) {

            var postActive = angular.element(document.getElementById('loadDynamicData')).scope().postActive;
            var ActivityActive = angular.element(document.getElementById('loadDynamicData')).scope().ActivityActive;

            if (ActivityActive == true) {
                // load dynamic feed data
                angular.element(document.getElementById('loadDynamicData')).scope().userActivityList('{{$permalink}}', 5);
            }
            if (postActive == true) {
                // load dynamic post data
                angular.element(document.getElementById('loadDynamicData')).scope().userPostList('{{$permalink}}', 6);
            }
        }
    });
</script>