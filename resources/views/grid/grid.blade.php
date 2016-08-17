<?php // !!!! for use on WP PLEASE USER PURE PHP HERE
        $ideaView = 'ideaWP';
?>
<div class="loader loader-abs" cg-busy="firstLoad">

</div>


<h4 class="current-timespan home-subheader col-xs-12 no-heading">
    <?php // echo '{{currentPage}}' ?>

        <span>
            <div class="icon-clock blue">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="28px" height="28px" viewBox="288.6 378 36 36" enable-background="new 288.6 378 36 36" xml:space="preserve">
<g>
    <path fill="none" d="M306.6 414c-9.9 0-18-8.1-18-18c0-9.9 8.1-18 18-18s18 8.1 18 18C324.6 405.9 316.5 414 306.6 414z M306.6 381.9c-7.8 0-14.1 6.3-14.1 14.1s6.3 14.1 14.1 14.1s14.1-6.3 14.1-14.1S314.4 381.9 306.6 381.9z"></path>
</g>
                <path fill="none" d="M305.4 399.6c-1.1 0-2-0.9-2-2v-0.3c0-1.1 0.9-2 2-2h6.9c1.1 0 2 0.9 2 2v0.3c0 1.1-0.9 2-2 2H305.4z"></path>
                <path fill="none" opacity="0.79" class="theme-colour-change" d="M307.7 397.7c0 1.1-0.9 2-2 2h-0.3c-1.1 0-2-0.9-2-2v-8.6c0-1.1 0.9-2 2-2h0.3c1.1 0 2 0.9 2 2V397.7z"></path>
</svg>
        </div>
        Latest Stories</span>
</h4> 
<ul class="hidden"> <?php // we are keeping the switch controls here so that we can click them from anywehre (from other controllers) ?>
                                <li>
                                    <a id="show-smart-home" ng-click="switchCategory('smart-home')" href="/ideas/smart-home" class="category-link__smart-home" href="#">
                                        <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--smart-home"></i>
                                        <span class="m-icon-text">Smart Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a id="show-smart-entertainment" ng-click="switchCategory('smart-entertainment')"  class="category-link__smart-entertainment m-icon-text-holder" href="/ideas/smart-entertainment">
                                        <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--video"></i>
                                        <span class="m-icon-text"><span class="hidden-xs hidden-sm">Smart</span> Entertainment</span>
                                    </a>
                                </li>
                                <li>
                                    <a id="show-smart-body" class="category-link__smart-body m-icon-text-holder" href="/ideas/smart-body" ng-click="switchCategory('smart-body')" >
                                        <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--wearables"></i>
                                        <span class="m-icon-text"><span class="hidden-xs hidden-sm">Smart</span> Body</span>
                                    </a> 
                                </li>
                                <li>
                                    <a id="show-smart-travel" class="category-link__smart-travel m-icon-text-holder" href="/ideas/smart-travel" ng-click="switchCategory('smart-travel')" >
                                        <i class="hidden-xs hidden-sm hidden-md m-icon m-icon--travel"></i>
                                        <span class="m-icon-text"><span class="hidden-xs hidden-sm">Smart</span> Travel</span>
                                    </a>
                                </li>
                            </ul>
                            
<div>
<div ng-repeat="batch in content" class="container main-content col-xs-12">
    <div class="grid-box-full grid-wrap visible"> 
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'"
             ng-repeat="item in batch['row-1']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>
    </div>

    <div class="grid-box-2 grid-wrap visible">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-2']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-2']" class="box-item product-box" itemscope itemtype="http://schema.org/Product">
            <?php include('/var/www/ideaing/resources/views/grid/product.blade.php') ?>
        </div>
    </div>

    <div class="grid-box-3 grid-wrap visible">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-3']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-3']"
             class="box-item product-box" itemscope itemtype="http://schema.org/Product">
            <?php include('/var/www/ideaing/resources/views/grid/product.blade.php') ?>
        </div>
    </div>

    <div class="grid-box-full grid-wrap hidden-soft">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'"
             ng-repeat="item in batch['row-4']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>
    </div>

    <div class="grid-box-2 grid-wrap hidden-soft">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-5']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-5']" class="box-item product-box" itemscope itemtype="http://schema.org/Product">
            <?php include('/var/www/ideaing/resources/views/grid/product.blade.php') ?>
        </div>
    </div>

    <div class="grid-box-3 grid-wrap hidden-soft">
        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-6']"
             class="box-item product-box" itemscope itemtype="http://schema.org/Product">
            <?php include('/var/www/ideaing/resources/views/grid/product.blade.php') ?>
        </div>
    </div>

</div>

</div>

<a ng-show="hasMore" ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12 hidden">Load More</a>
