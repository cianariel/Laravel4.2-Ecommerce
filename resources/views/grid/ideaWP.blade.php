<div class="img-holder">
    <img ng-if="item.is_featured == true || item.feed_image == undefined" src="{{item.image}}">

    <img ng-if="item.feed_image !== undefined && item.is_featured != true" alt="{{item.feed_image.alt}}" title="{{item.feed_image.alt}}" src="{{item.feed_image.url}}">
</div>

<span class="box-item__time">{{item.updated_at}}</span>
<a href="{{item.url}}">
<div class="box-item__overlay"></div>
</a>

<ul class="social-stats">
    <li class="social-stats__item">
        <?php
        $userId = !empty($userData->id) ? $userData->id:0;
        ?>
        <heart-counter-dir uid = "<?php echo $userId ?>" iid = item.id plink = item.url sec = 'ideas' >

        </heart-counter-dir>
    </li>
    <li class="social-stats__item">
        <a href="#">
            <i class="m-icon m-icon--buble"></i>
            <span class="social-stats__text">{{item.CommentCount}}</span>
        </a>
    </li>
</ul>

<div class="round-tag round-tag--idea">
    <i class="m-icon m-icon--item"></i>
    <span class="round-tag__label">Idea</span>
</div>

<div class="box-item__label-idea">
    <a href="{{item.url}}" class="box-item__label">{{renderHTML(item.title)}}</a>
    <div class="clearfix"></div>
    <a href="{{item.url}}" class="box-item__read-more">Read More</a>
</div>

<div class="box-item__author">
    <a href="" class="user-widget">
        <img class="user-widget__img" src="{{item.avator}}">
        <span class="user-widget__name">{{item.author}}</span>
    </a>
</div>