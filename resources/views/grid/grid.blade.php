<?php // !!!! for use on WP PLEASE USER PURE PHP HERE
        $ideaView = 'ideaWP';
?>
<div ng-repeat="batch in content" class="container main-content col-xs-12">
    <div class="grid-box-3">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-1']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-1']"              class="box-item product-box" itemscope itemtype="http://schema.org/Product">
            <?php include('/var/www/ideaing/resources/views/grid/product.blade.php') ?>
        </div>
    </div>

    <div class="grid-box-full">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'"
             ng-repeat="item in batch['row-2']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>

        </div>

    </div>

    <div class="grid-box-3">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-3']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-3']"
             class="box-item product-box" itemscope itemtype="http://schema.org/Product">
            <?php include('/var/www/ideaing/resources/views/grid/product.blade.php') ?>
        </div>
    </div>

    <div class="grid-box-full">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'"
             ng-repeat="item in batch['row-4']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>

    </div>

    <div class="grid-box-3">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-5']" itemscope itemtype="http://schema.org/BlogPosting" >
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-5']"
             class="box-item product-box">
            <?php include('/var/www/ideaing/resources/views/grid/product.blade.php') ?>
        </div>
    </div>


    <div class="grid-box-full">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'"
             ng-repeat="item in batch['row-6']" itemscope itemtype="http://schema.org/BlogPosting">
            <?php include('/var/www/ideaing/resources/views/grid/'.$ideaView.'.blade.php') ?>
        </div>

    </div>

</div>