    <div class="img-holder">
        <img ng-if="item.is_featured == true || item.feed_image == undefined" src="{{item.image}}" itemprop="image">

        <img ng-if="item.feed_image !== undefined && item.is_featured != true" alt="{{item.feed_image.alt}}" title="{{item.feed_image.alt}}" src="{{item.feed_image.url}}" itemprop="image">
    </div>

    <div class="box-item__author">
        <a href="/user/profile/{{item.authorlink}}"  class="user-widget">
            <img class="user-widget__img" src="{{item.avator}}">
            <span class="user-widget__name" itemprop="author">{{item.author}}</span>
        </a>
    </div>

<div class=" category-{{item.category_main}}">
    <div class="idea-meta category-bg">
        <div class="box-item__label-idea"  ng-if="!item.is_deal">
            <a href="{{item.url}}" class="box-item__label" itemprop="name">{{renderHTML(item.title)}}</a>
        </div>

        <div class="box-item__label-idea deal"  ng-if="item.is_deal">
            <a href="{{item.url}}" class="box-item__label" itemprop="name">{{renderHTML(item.title)}}</a>
        </div>

        <a ng-if="!item.is_deal" href="/ideas">
            <span class="round-tag__label text-uppercase in" itemprop="articleSection">In {{item.category}}, Ideas <i class="m-icon m-icon--bulb"></i></span>
        </a>

      <!--  <a  ng-if="item.is_deal" href="/ideas" class="round-tag round-tag--idea deal">
            <i class="m-icon m-icon--item"></i>
            <span class="round-tag__label" itemprop="articleSection">Deal</span>
        </a> -->

        <ul class="social-stats">
          <!--  <li class="social-stats__item">
                <i class="m-icon m-icon--flame white" ng-show="item.views >= 100"></i>
                <span class="social-stats__text white">{{item.views}} views</span>
            </li> -->
            <li class="social-stats__item">
                <a href="#">
                    <i class="m-icon m-icon--buble"></i>
                    <span class="social-stats__text"  itemprop="commentCount">{{item.CommentCount}}</span>
                </a>
            </li>
        </ul>
        <span class="box-item__time"  itemprop="dateCreated">{{item.updated_at}}</span>
    </div>
</div>
    <a href="{{item.url}}">
        <div class="box-item__overlay"></div>
    </a>
