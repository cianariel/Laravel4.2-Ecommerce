<aside class="room-filter">
    <ul class="extra-nav hidden-620">
        @foreach($categoryTree as $name => $unused)
            <li><a class="{{$name}}-link" href="#">{{$name}}</a></li>
        @endforeach
    </ul>

    <ul class="room-list">
        @foreach($categoryTree as $parent => $children)
            @foreach($children as $child)
                <li>
                    <a href="/shop/{{$parent}}/{{$child->extra_info}}">{{$child->category_name}}</a>
                </li>
            @endforeach
        @endforeach
    </ul>

    <ul class="sortby">
        <li ng-click="sortContent(false)">Popularity</li>
    </ul>

    <h6 class="gift">Gift ideas</h6>
    <ul class="for">
        <li>For Her</li>
        <li>For Him</li>
        <li>For Kids</li>
        <li>For Pets</li>
        <li>For the Techie</li>
        <li>For the Traveler</li>
        <li>For the Decorator</li>
        <li>Stocking Suffers</li>
    </ul>
</aside>