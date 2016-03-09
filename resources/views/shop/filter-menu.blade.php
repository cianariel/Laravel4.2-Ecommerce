<aside class="room-filter" style="top:0; left:-220px">

    <ul class="extra-nav hidden-620">
{{--        @foreach($categoryTree as $name => $unused)--}}
            <li><a class="{{$masterCategory->extra_info}}-link" href="/shop/{{@$parentCategory->extra_info ? $parentCategory . '/' : ''}}{{$currentCategory->extra_info}}">{{$masterCategory->category_name}}</a></li>
        {{--@endforeach--}}
    </ul>

    <ul class="room-list">
{{--        @foreach($categoryTree as $parent => $children)--}}
        @if(@$categoryTree[$grandParent])
            @foreach(@$categoryTree[$grandParent] as $child)
                <li>
                    <a ng-click="filterPlainContent('{{$child->extra_info}}', false)"  href="/shop/{{$masterCategory->extra_info}}/{{$child->extra_info}}" data-filterby="{{$child->extra_info}}">{{$child->category_name}}</a>
                </li>
            @endforeach
        @endif

        {{--@endforeach--}}
    </ul>

    {{--<ul class="sortby">--}}
        {{--<li ng-click="filterPlainContent(false, 'sale_price')">Price</li>--}}
    {{--</ul>--}}

    {{--<h6 class="gift">Gift ideas</h6>--}}
    {{--<ul class="for">--}}
        {{--<li>For Her</li>--}}
        {{--<li>For Him</li>--}}
        {{--<li>For Kids</li>--}}
        {{--<li>For Pets</li>--}}
        {{--<li>For the Techie</li>--}}
        {{--<li>For the Traveler</li>--}}
        {{--<li>For the Decorator</li>--}}
        {{--<li>Stocking Suffers</li>--}}
    {{--</ul>--}}
</aside>