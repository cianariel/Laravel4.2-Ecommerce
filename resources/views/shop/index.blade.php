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
                    <div id="daily-deals" class="slider has-bullets" >
                        <div class="box-item idea-box box-item--featured rsContent" ng-repeat="item in dailyDeals" >
                            @include('grid.idea')
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
                    <div class="shop-by-category-submneu smart-home active">
                        <div class="col-md-2">
                            <a href="/shop/category">
                                <i class="m-icon--energy"></i>
                                <p class="title"><strong>Energy & Air</strong></p>
                                <p class="hidden-xs hidden-sm">Purifiers<br> Fans<br> Water thermostats</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                                <i class="m-icon--cameras"></i>
                                <p class="title"><strong>Cameras & Security</strong></p>
                                <p class="hidden-xs hidden-sm">Sensors<br> Cameras<br> Home Security Systems</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                                <i class="m-icon--entertainment"></i>
                                <p class="title"><strong>Entertainment</strong></p>
                                <p class="hidden-xs hidden-sm">Audio<br> Video</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                                <i class="m-icon--lighting"></i>
                                <p class="title"><strong>Lighting</strong></p>
                                <p class="hidden-xs hidden-sm">Light Bulbs<br> Switches<br> Outlets</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                                <i class="m-icon--cleaning"></i>
                                <p class="title"><strong>Cleaning</strong></p>
                                <p class="hidden-xs hidden-sm">Vacuums<br> Robots</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                                <i class="m-icon--networking"></i>
                                <p class="title"><strong>Networking</strong></p>
                                <p class="hidden-xs hidden-sm">Routers<br> Tablets<br> Modems<br> Powerline<br> NAS</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                                <i class="m-icon--doors"></i>
                                <p class="title"><strong>Doors</strong></p>
                                <p class="hidden-xs hidden-sm">Door Locks<br> Garage<br> Remote open/close</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                                <i class="m-icon--appliances"></i>
                                <p class="title"><strong>Appliances</strong></p>
                                <p class="hidden-xs hidden-sm">Stoves<br> Ovens<br> Refrigerators<br> Washer/Dryers<br> Toilets</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                                <i class="m-icon--pets"></i>
                                <p class="title"><strong>Pets</strong></p>
                            </a>
                        </div>
                        @for($i=0; $i< 3; $i++)
                            <div class="col-md-2 hidden-xs hidden-sm">
                            </div>
                        @endfor
                    </div>
                    <div class="shop-by-category-submneu travel">
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class="m-icon--luggage"></i>
                            <p class="title"><strong>Luggage</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--gadgets"></i>
                            <p class="title"><strong>Gadgets</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class="m-icon--bags"></i>
                            <p class="title"><strong>Bags</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--backpacks"></i>
                            <p class="title"><strong>Backpacks</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--accesories"></i>
                            <p class="title"><strong>Accesories</strong></p>
                            </a>
                        </div>
                    </div>
                    <div class="shop-by-category-submneu wearable">
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class="m-icon--wellness"></i>
                            <p class="title"><strong>Wellness & Fitness</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--health"></i>
                            <p class="title"><strong>Health Devices</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class="m-icon--wearable-cameras"></i>
                            <p class="title"><strong>Wearable Cameras</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--smart-watches"></i>
                            <p class="title"><strong>Smart Watches</strong></p>
                            </a>
                        </div>
                    </div>
                    <div class="shop-by-category-submneu decor">
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class="m-icon--wellness"></i>
                            <p class="title"><strong>Kitchen & Dining</strong></p>
                            <p class="hidden-xs hidden-sm">Cookware<br> Coffee &Tea<br> Cutlery<br> Utensils</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--health"></i>
                            <p class="title"><strong>Furniture</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class="m-icon--wearable-cameras"></i>
                            <p class="title"><strong>Bddding</strong></p>
                            <p class="hidden-xs hidden-sm">Beds<br> Nightstands<br> Dressers<br> Pillows</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--smart-watches"></i>
                            <p class="title"><strong>Bath</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--smart-watches"></i>
                            <p class="title"><strong>Decor</strong></p>
                            <p class="hidden-xs hidden-sm">Vacuums<br> Robots</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--smart-watches"></i>
                            <p class="title"><strong>Office</strong></p>
                            <p class="hidden-xs hidden-sm">Desks<br> Office Chairs<br> Bookcases<br> Filling Cabinets</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--smart-watches"></i>
                            <p class="title"><strong>Storage</strong></p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="/shop/category">
                            <i class=" m-icon--smart-watches"></i>
                            <p class="title"><strong>Outdoor</strong></p>
                            </a>
                        </div>
                        @for($i=0; $i< 4; $i++)
                            <div class="col-md-2 hidden-xs hidden-sm">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/js/vendor/angular-busy.min.js"></script>
    <script src="/assets/js/angular-custom/custom.paging.js"></script>
    <script src="/assets/js/angular-custom/public.common.js"></script>
@stop