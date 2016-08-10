<div class="img-holder">
    <img  itemprop="image"  src="<?php echo '{{item.media_link_full_path}}' ?>" alt="<?php echo '{{item.product_name}}' ?>"/>
</div>
<div class="category-<?php  echo '{{item.master_category}}' ?>">
    <div class="idea-meta product category-bg">
        <div class="box-item__label-product">
            <a href="/product/<?php echo '{{item.product_permalink}}' ?>" class="box-item__label box-item__label--clear" itemprop="name"><?php echo '{{item.product_name}}' ?></a>
        </div>


        <a ng-if="!item.is_deal" href="/ideas">
            <span class="round-tag__label in" itemprop="articleSection">In <span ng-if="item.master_category_name"><?php echo '{{item.master_category_name}}' ?>, </span> <?php echo '{{item.category_name}}' ?> <i class="m-icon m-icon--shopping-bag-light-green white"></i></span>
        </a>

    </div>
    <div class="box-item__overlay category-bg" ng-click="openProductPopup(item.id)"></div>
</div>
<span class="box-item__time text-uppercase"><?php echo '{{item.created_at}}' ?></span>




