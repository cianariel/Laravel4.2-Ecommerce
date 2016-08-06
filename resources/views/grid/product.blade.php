<div class="img-holder">
    <img  itemprop="image"  src="<?php echo '{{item.media_link_full_path}}' ?>" alt="<?php echo '{{item.product_name}}' ?>"/>
</div>

<div class="idea-meta product">
    <div class="box-item__label-product">
        <a href="/product/<?php echo '{{item.product_permalink}}' ?>" class="box-item__label box-item__label--clear" itemprop="name"><?php echo '{{item.product_name}}' ?></a>
    </div>


    <a ng-if="!item.is_deal" href="/ideas">
        <span class="round-tag__label text-uppercase in" itemprop="articleSection">In Smart Home, Products <i class="m-icon  m-icon-shopping-bag-light-green"></i></span>
    </a>

    <!--  <a  ng-if="item.is_deal" href="/ideas" class="round-tag round-tag--idea deal">
          <i class="m-icon m-icon--item"></i>
          <span class="round-tag__label" itemprop="articleSection">Deal</span>
      </a> -->

    <div class="merchant-widget" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <span class="merchant-widget__price" >
            <span itemprop="priceCurrency" content="USD">$</span>
             <span itemprop="price" content=" <?php echo '{{item.sale_price}}' ?>">
                 <?php echo '{{item.sale_price}}' ?>
             </span>
        </span>
        <span class="white">from</span>
        <img class="merchant-widget__store" alt="<?php echo '{{ item.storeInfo.Description }}' ?>"
             ng-src='<?php echo '{{ item.storeInfo.ImagePath }}' ?>'/>

    </div>

    <span class="box-item__time"><?php echo '{{item.updated_at}}' ?></span>
</div>
<div class="box-item__overlay" ng-click="openProductPopup(item.id)"></div>



