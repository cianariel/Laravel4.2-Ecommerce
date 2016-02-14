@extends('layouts.main')

@section('body-class'){{ 'shoppage shop-landing' }}@stop

@section('content')
<script>
jQuery(document).ready(function($) {
  $('#daily-deals').royalSlider({
    arrowsNav: true,
    loop: false,
    keyboardNavEnabled: true,
    controlsInside: false,
    imageScaleMode: 'fit',
    arrowsNavAutoHide: false,
    controlNavigation: 'bullets',
    thumbsFitInViewport: false,
    navigateByClick: false,
    startSlideId: 0,
    autoPlay: false,
    transitionType:'move',
    globalCaption: false,
    deeplinking: {
      enabled: true,
      change: false
    },
    /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
    imgWidth: "100%",
    imageScaleMode: "fill",
    autoScaleSliderWidth: 1500,
    autoScaleSliderHeight: 500,
    autoScaleSlider: true
  });
  
  $('#newest-arrivals').royalSlider({
    arrowsNav: true,
    loop: false,
    keyboardNavEnabled: true,
    controlsInside: false,
    imageScaleMode: 'fit',
    arrowsNavAutoHide: false,
    controlNavigation: 'bullets',
    thumbsFitInViewport: false,
    navigateByClick: false,
    startSlideId: 0,
    autoPlay: false,
    transitionType:'move',
    globalCaption: false,
    deeplinking: {
      enabled: true,
      change: false
    },
    /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
    imgWidth: "100%",
    imageScaleMode: "fill",
    autoHeight: true
//    autoScaleSliderWidth: 1500,
//    autoScaleSliderHeight: 500,
//    autoScaleSlider: true
  });

  
});
</script>


    <div class="app-wrap" ng-app="pagingApp" ng-controller="shoplandingController">
        
        <div class="container">
            <div class="loader loader-fixed" cg-busy="nextLoad"></div>
            
            <div class="main-content ">
                <fieldset class="shoplanding-title">
                    <legend align="center">Daily Deals</legend>
                </fieldset>
                <div class="loader loader-abs" cg-busy="firstLoad"></div>
                <div class="row">
                    <div id="daily-deals" class="slider has-bullets">
                        <div class="grid-box rsContent">
                            <div class="box-item idea-box box-item--featured" ng-repeat="item in dailyDeals" >
                                @include('grid.idea')
                            </div>
                        </div>
                    </div>
                </div>
                <fieldset class="shoplanding-title">
                    <legend align="center">Newest Arrivals</legend>
                </fieldset>
                <div class="row">
                    <div id="newest-arrivals" class="slider col-xs-12 has-bullets" >
                        <div class="grid-box-3 rsContent">
                            <div class="box-item product-box "ng-repeat="item in newestArrivals">
                                @include('grid.product')
                            </div>
                        </div>
                    </div>
                </div>
                <fieldset class="shoplanding-title">
                    <legend align="center">Shop by Category</legend>
                </fieldset>
                <div class="row hidden-xs hidden-sm">
                    <div class="col-xs-3 shop-by-category-item smart-home active" data-submenu="smart-home">
                        <img src="/assets/images/category-home.png" alt=""><br><br>
                        <span>Smart Homes</span>
                        <a href="#" class="show-menus">
                            <img src="/assets/images/plus.png" alt="">
                        </a>
                        <a href="#" class="hide-menus">
                            <img src="/assets/images/close.png" alt="">
                        </a>
                    </div>
                    <div class="col-xs-3 shop-by-category-item travel" data-submenu="travel">
                        <img src="assets/images/category-travel.png" alt=""><br><br>
                        <span>Travel</span>
                        <a href="#" class="show-menus">
                            <img src="/assets/images/plus.png" alt="">
                        </a>
                        <a href="#" class="hide-menus">
                            <img src="/assets/images/close.png" alt="">
                        </a>
                    </div>
                    <div class="col-xs-3 shop-by-category-item wearable" data-submenu="wearable">
                        <img src="assets/images/category-wearable.png" alt=""><br><br>
                        <span>Wearable</span>
                        <a href="#" class="show-menus">
                            <img src="/assets/images/plus.png" alt="">
                        </a>
                        <a href="#" class="hide-menus">
                            <img src="/assets/images/close.png" alt="">
                        </a>
                    </div>
                    <div class="col-xs-3 shop-by-category-item decor" data-submenu="decor">
                        <img src="assets/images/category-decor.png" alt=""><br><br>
                        <span>Home & Decor</span>
                        <a href="#" class="show-menus">
                            <img src="/assets/images/plus.png" alt="">
                        </a>
                        <a href="#" class="hide-menus">
                            <img src="/assets/images/close.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="visible-xs visible-sm">
                    <select id="mobile-shop-by-category-items" class="form-control">
                        <option value="smart-home">Smart Homes</option>
                        <option value="travel">Travel</option>
                        <option value="wearable">Wearable</option>
                        <option value="decor">Home & Decor</option>
                    </select>
                    <br>
                </div>
                <div class="row">
                    <?php $i =1 ?>
                    @foreach($categoryTree as $topCategory => $parentCategories)
                        <div class="shop-by-category-submneu {{$topCategory}} {{$i == 1 ? 'active' : ''}}">
                            @foreach($parentCategories as $parent => $grandChildren)
                                <div class="col-md-2">
                                    <a href="/shop/category/{{trim($parent)}}">
                                        <i class="m-icon--energy"></i>
                                        <p class="title"><strong>{{$parent}}</strong></p>
                                        <p class="hidden-xs hidden-sm">
                                            @foreach($grandChildren as $item)
                                                {{trim($item->category_name)}}<br>
                                            @endforeach
                                        </p>
                                    </a>
                                </div>
                            @endforeach
                            <?php $i++; ?>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/js/vendor/angular-busy.min.js"></script>
    <script src="/assets/js/angular-custom/custom.paging.js"></script>
    <script src="/assets/js/angular-custom/public.common.js"></script>
@stop