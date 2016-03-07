@include('header')

<div class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>

    <div class="clearfix"></div>

    <div class="homepage-grid center-block" style="min-height:1000px">
        <div class="loader loader-abs" cg-busy="firstLoad"></div>
        {{--<div class="loader loader-abs" cg-busy="filterLoad"></div>--}}
        <div class="loader loader-fixed" cg-busy="nextLoad"></div>

        <div ng-repeat="batch in content" class="main-content col-xs-12">
            <div class="grid-box-3">
                <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-1']">
                    <a href="{{item.url}}" class="box-item__label">{{renderHTML(item.title)}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <a ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12">Load More</a>
    </div>

</div>


<?php get_footer(); ?>

<script type="text/javascript" src="/assets/product/js/custom.product.js"></script>




