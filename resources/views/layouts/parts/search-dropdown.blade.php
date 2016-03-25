<ul class="cat-suggestions">
    <li ng-repeat="item in categorySuggestions" >
        <a href="{{item.link}}">
            <i ng-if="item.isProduct == 1" class="hidden-xs m-icon m-icon--shopping-bag-light-green" style="float: left; position: static; padding-right: 5px; padding-botom: 5px;"></i>
            <i ng-if="item.type == 'ideas'" class="hidden-xs m-icon m-icon--bulb" style="float: left; position: static; padding-right: 5px; padding-botom: 5px;"></i>
            <b style="color:#000">{{renderHTML(item.term)}}</b> in {{item.type}}
        </a>
    </li>
</ul>