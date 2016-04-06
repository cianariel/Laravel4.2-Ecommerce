<!--<div ng-init="heartUsers('ideas')">-->
    <li ng-repeat="user in heartUsersInfo" ><a class="" href="#">    
            <img id="currentPhoto" class="profile-photo" width="40px" alt="{{ user.name }}" ng-src="{{ user.medias[0].media_link }}"
                 onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'">
        </a>
    </li>
<!--</div>-->

<li ng-if="heartCounter>3"><a class="more-like-count" href="#">+{{heartCounter-3}}</a></li>

<!--<div class="author-image-big col-lg-3 col-sm-4 col-xs-5 full-480">
	<img id="currentPhoto" class="profile-photo" width="150px" ng-src="{{ authorImage }}"
		 onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'" width="170">
</div>-->