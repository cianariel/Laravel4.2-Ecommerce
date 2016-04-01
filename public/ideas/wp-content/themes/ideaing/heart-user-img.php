<div ng-init="heartUsers()">
    <li class="hidden-xs"><a class="" href="#">
            <img id="currentPhoto" class="profile-photo" width="40px" ng-src="{{ authorImage }}"
                 onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'">
        </a>
    </li>
    <li class="hidden-xs"><a class="" href="#">
            <img id="currentPhoto" class="author" width="40px" ng-src="{{ authorImage }}"
                 onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'">
        </a>
    </li>
</div>
<!--<li class="hidden-xs"><a class="likes" href="#">+ 186</a></li>-->

<!--<div class="author-image-big col-lg-3 col-sm-4 col-xs-5 full-480">
	<img id="currentPhoto" class="profile-photo" width="150px" ng-src="{{ authorImage }}"
		 onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'" width="170">
</div>-->