<ul class="cat-suggestions">
    <li style="width: 100%; display: block; float: left; padding: 5px 10px;" ng-repeat="item in categorySuggestions" >
        <a href="{{item.link}}">
            <b style="color:#000">{{item.term}}</b> in {{item.type}}
        </a>
    </li>
</ul>