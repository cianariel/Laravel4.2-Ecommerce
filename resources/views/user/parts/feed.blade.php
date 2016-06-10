<div id="loadDynamicData" class="container hidden">
    <div class="col-md-3 side-bar hidden-xs hidden-sm">
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
                {{-- <li>
                     <a href="#">
                         <i class="m-icon m-icon--Saved-Active"></i>&nbsp;
                         Saved
                     </a>
                 </li>--}}
            </ul>
        </div>
    </div>


    <script>
        var profilePicture = '{{$profile}}';
        var profileFullName = '{{$fullname}}';
    </script>

    {{--<div class="col-md-9 main-content" ng-init="userActivityList({{$userData['id']}},5)">--}}
        <div class="col-md-9 main-content" ng-init="userActivityList('{{$permalink}}',5)">

        <div ng-repeat="item in activityData">
            data

            <div class="feed-content row" ng-show="(item['Type']=='comment') && showComment">
                <div class="feed-header ">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-left">
                                <img ng-src="@{{ profilePicture }}" width="50px" class="profile-photo" alt="">
                            </div>
                            <div class="pull-left name-time">
                                <strong>@{{ profileFullName }}</strong> {{--<i class="m-icon--heart-solid"></i>--}}<br>
                                <span class="time">@{{ item['UpdateTime'] }}</span>
                            </div>
                            <div class="pull-right">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="feed-body ">
                    <div class="row">


                        <div class="col-xs-4" ng-show="item['Image'] !=''">
                            <img ng-src="@{{ item['Image'] }}">
                        </div>


                        <div ng-class="item['Type'] =='heart' ? 'col-xs-12':'col-xs-8'">
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
                                <span class="comment"><i class="m-icon--buble"></i> @{{ item['CommentCount'] }}</span>
                            </div>
                            {{--<div class="pull-right">
                                <a href="{{ $item['Link'] }}" target="_blank"><strong>View original post</strong></a>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="feed-content row" ng-show="(item['Type']!='comment') && showHeart">
                <div class="feed-header ">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-left">
                                <img ng-src="@{{ profilePicture }}" width="50px" class="profile-photo" alt="">
                            </div>
                            <div class="pull-left name-time">
                                <strong>@{{ profileFullName }}</strong> {{--<i class="m-icon--heart-solid"></i>--}}<br>
                                <span class="time">@{{ item['UpdateTime'] }}</span>
                            </div>
                            <div class="pull-right">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="feed-body ">
                    <div class="row">


                        <div class="col-xs-4" ng-show="item['Image'] !=''">
                            <img ng-src="@{{ item['Image'] }}">
                        </div>


                        <div ng-class="item['Type'] =='heart' ? 'col-xs-12':'col-xs-8'">
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
                                <span class="comment"><i class="m-icon--buble"></i> @{{ item['CommentCount'] }}</span>
                            </div>
                            {{--<div class="pull-right">
                                <a href="{{ $item['Link'] }}" target="_blank"><strong>View original post</strong></a>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    $(window).scroll(function () {
        if ($(document).height() <= $(window).scrollTop() + $(window).height()) {
           // angular.element(document.getElementById('loadDynamicData')).scope().userActivityList({{$userData['id']}}, 5);
             angular.element(document.getElementById('loadDynamicData')).scope().userActivityList('{{$permalink}}', 5);
        }
    });
</script>