 
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
                                        <strong>@{{ profileFullName }}</strong> <i class="m-icon--heart-solid"></i>
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
                                    <strong>@{{ profileFullName }}</strong> <i class="m-icon--heart-solid"></i>
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

 <div ng-show="postActive">
            <div ng-init="userActivityList('{{$permalink}}', 5)">
        <div class="col-xs-12 activity-item" ng-repeat="item in activityData">
            <div class="col-xs-3 text-right">
                <span class="time grey lightfont">@{{item['UpdateTime']}}</span>
                <div class="pull-right activity-tags">
                    <div class="favorite white-bg relative"><i class="m-icon--heart-solid pink"></i></div>
                    <div class="comment white-bg"><i class="m-icon--buble blue"></i></div>
                </div>
            </div>
            <div class="feed-content col-xs-9 radius-5">
                <div class="feed-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-left name-time">
                                <span ng-if="item['Type']=='comment'"> Commented</span>
                                <span ng-if="item['Type']!='comment'"> Liked</span> 

                                  <!--   <span ng-if="item['Section']=='product'"> product</span>
                                    <span ng-if="item['Section']!='product'"> idea</span> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feed-body">
                    <div class="row">
                        <div class="col-xs-3 no-padding">
                            <img class="radius-5" ng-src="@{{ item['Image'] }}">
                        </div>


                        <div ng-class="item['Type'] =='heart' ? 'col-xs-12':'col-xs-12'" class="col-xs-9">
                            <a href="@{{ item['Link'] }}" target="_blank">@{{ item['Title'] }}</a>
                            <p>
                                <!-- Epic sale happening right now of all Apple devices in the 2015 Festive season across the boards! -->
                            </p>
                            <div class="col-xs-12 no-padding">
                                <div class="pull-left activity-stats">
                                    <span class="favorite white pink-bg radius-5"><i class="m-icon--heart-solid white"></i> @{{ item['HeartCount'] }}</span>
                                    <span class="comment black pale-grey-bg radius-5"><i class="m-icon--buble blue"></i> @{{ item['CommentCount'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
  </div>           



 <div ng-show="postActive">
            <div ng-init="userPostList('{{$permalink}}', 6)">
        <div class="col-xs-12 activity-item" ng-repeat="item in userPostData">
            <div class="col-xs-3 text-right">
                <span class="time grey lightfont">@{{item.creation_date}}</span>
                <div class="pull-right activity-tags">
                    <div class="favorite white-bg relative"><i class="m-icon--heart-solid pink"></i></div>
                    <div class="comment white-bg"><i class="m-icon--buble blue"></i></div>
                </div>
            </div>
            <div class="feed-content col-xs-9 radius-5">
                <div class="feed-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-left name-time">
                                <span ng-if="item['Type']=='comment'"> Commented</span>
                                <span ng-if="item['Type']!='comment'"> Liked</span> 

                                  <!--   <span ng-if="item['Section']=='product'"> product</span>
                                    <span ng-if="item['Section']!='product'"> idea</span> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feed-body">
                    <div class="row">
                        <div class="col-xs-3 no-padding">
                            <img class="radius-5" ng-src="@{{ item.image }}">
                        </div>


                        <div ng-class="item['Type'] =='heart' ? 'col-xs-12':'col-xs-12'" class="col-xs-9">
                            <a href="@{{ item['Link'] }}" target="_blank">@{{ item['Title'] }}</a>
                            <p>
                                <!-- Epic sale happening right now of all Apple devices in the 2015 Festive season across the boards! -->
                            </p>
                            <div class="col-xs-12 no-padding">
                                <div class="pull-left activity-stats">
                                    <span class="favorite white pink-bg radius-5"><i class="m-icon--heart-solid white"></i> @{{ item.heart_count }}</span>
                                    <span class="comment black pale-grey-bg radius-5"><i class="m-icon--buble blue"></i> @{{ item.comment_count }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
  </div>