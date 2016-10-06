<div class="img-holder">
    <img itemprop="image" src="<?php echo '{{item.media_link_full_path}}' ?>"
         alt="<?php echo '{{item.product_name}}' ?>"/>
</div>
<span class="mobile-show hidden-620">
        <i class="p-show m-icon--Add-Active"></i>
        <i class="p-close m-icon--Close"></i>
    </span>
<span class="box-item__time"><?php echo '{{item.updated_at}}' ?></span>
<div class="box-item__overlay" ng-click="openProductPopup(item.id)"></div>

<div ng-if="item.AverageScore" class="social-stats">
    <div class="social-stats__item rating" data-toggle="tooltip" title="Ideaing Score">
        <span class="icon m-icon--bulb-detailed-on-rating"></span>
        <span class="value"><?php echo '{{item.AverageScore}}' ?>%</span>
    </div>
</div>

<a href="/shop" class="round-tag round-tag--product">
    <i class="m-icon m-icon--item"></i>
    <span class="round-tag__label">Product</span>
</a>

<div class="box-item__label-prod">
    <a href="/product/<?php echo '{{item.product_permalink}}' ?>"
       class="box-item__label box-item__label--clear" itemprop="name"><?php echo '{{item.product_name}}' ?></a>
    <!--    <a href="#" class="box-item__label box-item__label--clear" ng-click="openProductPopup()"><?php echo '{{item.product_name}}' ?></a>-->
    <div class="clearfix"></div>
    <div class="merchant-widget" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <span  ng-hide="item.product_name == 0" class="merchant-widget__price" >
            <span itemprop="priceCurrency" content="USD">$</span>
             <span itemprop="price" content=" <?php echo '{{item.sale_price}}' ?>">
                 <?php echo '{{item.sale_price}}' ?>
             </span>
        </span>
        <span>From</span>
        <img class="merchant-widget__store" alt="<?php echo '{{ item.storeInfo.Description }}' ?>"
             ng-src='<?php echo '{{ item.storeInfo.ImagePath }}' ?>'/>

    </div>
    <div class="clearfix"></div>
    <!-- <a target="_blank" href="<?php // echo '{{item.affiliate_link}}' ?>" class="box-item__get-it">Get it</a> -->
    <a target="_blank" href="/open/<?php echo '{{item.id}}' ?>/home" class="box-item__get-it">Get it</a>
</div>

