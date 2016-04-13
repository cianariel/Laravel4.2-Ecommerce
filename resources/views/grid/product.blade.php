<div class="img-holder">
    <img src="<?php echo '{{item.media_link_full_path}}' ?>" alt="<?php echo '{{item.product_name}}' ?>"/>
</div>
<span class="mobile-show">
        <i class="p-show m-icon--Add-Active"></i>
        <i class="p-close m-icon--Close"></i>
    </span>
<span class="box-item__time"><?php echo '{{item.updated_at}}' ?></span>
<div class="box-item__overlay" ng-click="openProductPopup(item.id)"></div>

<div class="social-stats  ">
    <div class="social-stats__item">
        <?php
        $userId = !empty($userData->id) ? $userData->id : 0;
            if($userId == 0)
            {
                $userId = !empty($userData['id'] ) ? $userData['id']  : 0;
            }

        ?>

        <heart-counter-dir uid="<?php echo $userId ?>" iid=item.id plink=item.product_permalink sec='product'>

        </heart-counter-dir>
    </div>
</div>

<a href="/shop" class="round-tag round-tag--product">
    <i class="m-icon m-icon--item"></i>
    <span class="round-tag__label">Product</span>
</a>

<div class="box-item__label-prod">
    <a href="/product/<?php echo '{{item.product_permalink}}' ?>"
       class="box-item__label box-item__label--clear"><?php echo '{{item.product_name}}' ?></a>
    <!--    <a href="#" class="box-item__label box-item__label--clear" ng-click="openProductPopup()"><?php echo '{{item.product_name}}' ?></a>-->
    <div class="clearfix"></div>
    <div class="merchant-widget">
        <span class="merchant-widget__price">$<?php echo '{{item.sale_price}}' ?></span>
        <span>from</span>
        <img class="merchant-widget__store" alt="<?php echo '{{ item.storeInfo.Description }}' ?>"
             ng-src='<?php echo '{{ item.storeInfo.ImagePath }}' ?>'/>

    </div>
    <div class="clearfix"></div>
    <a target="_blank" href="<?php echo '{{item.affiliate_link}}' ?>" class="box-item__get-it">Get it</a>
</div>

