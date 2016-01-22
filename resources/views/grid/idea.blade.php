{{--<div class="box-item idea-box box-item--featured"  ng-if="item.is_featured == 'true'">--}}
        {{--<img alt="@{{item.feed_image.alt}}" title="@{{item.feed_image.alt}}" src="@{{$item.feed_image.url}}">--}}

        {{--@include('grid.idea-inner')--}}
{{--</div>--}}

{{--<div class="box-item idea-box"  ng-if="item.is_featured != 'true'">--}}
        <img alt="@{{item.feed_image.alt}}" title="@{{item.feed_image.alt}}" src="@{{$item.feed_image.url}}">

        @include('grid.idea-inner')
{{--</div>--}}

{{--<div class="box-item idea-box {{$item->is_featured ? 'box-item--featured' : ''}}">--}}
    {{--@if(!$item->is_featured && $item->feed_image)--}}
        {{--<img alt="{{$item->feed_image->alt}}" title="{{$item->feed_image->alt}}" src="{{$item->feed_image->url}}">--}}
    {{--@else--}}
        {{--<img src="{{$item->image}}">22--}}
    {{--@endif--}}

    {{--@include('grid.idea-inner')--}}
{{--</div>--}}