<div class="container">
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
    <div class="col-md-9 main-content" ng-init="userActivityList({{$userData['id']}},null)">

        @foreach($activity as $item)

            <div class="feed-content row"
                 @if($item['Type']=='comment') ng-show="showComment" @else ng-show="showHeart" @endif >
                <div class="feed-header ">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-left">
                                <img src="{{$profile}}" width="50px" class="profile-photo" alt="">
                            </div>
                            <div class="pull-left name-time">
                                <strong>{{$fullname}}</strong> {{--<i class="m-icon--heart-solid"></i>--}}<br>
                                <span class="time">{{ $item['UpdateTime'] }}</span>
                            </div>
                            <div class="pull-right">
                                {{--<a href="#">
                                    Actions
                                    <span class="caret"></span>
                                </a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feed-body ">
                    <div class="row">

                        @if($item['Image'] !='')
                            <div class="col-xs-4">
                                <img src="{{ $item['Image'] }}">
                            </div>
                        @endif

                        <div @if($item['Type'] =='heart') class="col-xs-12" @else class="col-xs-8" @endif>
                            <strong>
                                {{$fullname}} recently @if($item['Type']=='comment') commented @else liked @endif a
                                @if($item['Section']=='product') product @else idea @endif
                            </strong>: <a href="{{ $item['Link'] }}" target="_blank">{{ $item['Title'] }}</a>
                        </div>
                    </div>
                </div>
                <div class="feed-footer ">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-left">
                                <span class="favorite"><i class="m-icon--heart-solid"></i> {{ $item['HeartCount'] }}</span>
                                <span class="comment"><i class="m-icon--buble"></i> {{ $item['CommentCount'] }}</span>
                            </div>
                            {{--<div class="pull-right">
                                <a href="{{ $item['Link'] }}" target="_blank"><strong>View original post</strong></a>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
