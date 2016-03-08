<div class="img-holder">
<img src="{{item.media_link_full_path}}" alt="{{item.product_name}}"/>
</div>
    <span class="mobile-show">
        <i class="p-show m-icon--Add-Active"></i>
        <i class="p-close m-icon--Close"></i>
    </span>
<span class="box-item__time">{{item.updated_at}}</span>
    <div class="box-item__overlay" ng-click="openProductPopup()"></div>

<ul class="social-stats">
    <li class="social-stats__item">
        <a href="#">
                <i class="m-icon m-icon--ScrollingHeaderHeart">
                    <span class="m-hover">
                        <span class="path1"></span><span class="path2"></span>
                    </span>
                </i>
            <span class="social-stats__text">52</span>
        </a>
    </li>
</ul>

<div class="round-tag round-tag--product">
    <i class="m-icon m-icon--item"></i>
    <span class="round-tag__label">Product</span>
</div>

<div class="box-item__label-prod">
    <a href="/product/{{item.product_permalink}}" class="box-item__label box-item__label--clear">{{item.product_name}}</a>
    <!--    <a href="#" class="box-item__label box-item__label--clear" ng-click="openProductPopup()">{{item.product_name}}</a>-->
    <div class="clearfix"></div>
    <div class="merchant-widget">
        <span class="merchant-widget__price">${{item.sale_price}}</span>
        <span>from</span>
       <img class="merchant-widget__store" alt="{{ item.storeInfo.Description }}" ng-src='{{ item.storeInfo.ImagePath }}' />

    </div>
    <div class="clearfix"></div>
    <a target="_blank" href="{{item.affiliate_link}}" class="box-item__get-it">Get it</a>
</div>

