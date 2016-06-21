<div id="loadDynamicData" class="container">
    <script>
        var profilePicture = '{{$profile}}';
        var profileFullName = '{{$fullname}}';
    </script>
    <!--feed start -->
    <div>

        {{--<div class="col-md-9 main-content" ng-init="userActivityList({{$userData['id']}},5)">--}}
        <div class="col-md-9 main-content">

            @foreach($contents as $item)
                <div>

                    <div class="feed-content row">
                        <div class="feed-header ">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="pull-left">
                                        <img src="{{ $item['UserPicture'] }}" width="50px" class="profile-photo" alt="">
                                    </div>
                                    <div class="pull-left name-time">
                                        <strong>{{ $item['UserName'] }}</strong> {{--<i class="m-icon--heart-solid"></i>--}}
                                        <br>
                                        <span class="time">{{ $item['Time'] }}</span>
                                    </div>
                                    <div class="pull-left">&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="pull-left">
                                        @if(($item['Section'] == 'ideas-heart')||($item['Section'] == 'product-heart')||($item['Section'] == 'product-heart'))

                                            {{ $item['UserName'] }} liked :
                                            <a href="{{ URL::to('/').'/'.$item['ItemLink'] }}"
                                               target="_blank">{{ $item['ItemTitle'] }}</a>

                                        @else

                                            {{ $item['UserName'] }} commented on :
                                            <a href="{{ URL::to('/').'/'.$item['ItemLink'] }}"
                                               target="_blank">{{ $item['ItemTitle'] }}</a>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <!--feed end-->

</div>
