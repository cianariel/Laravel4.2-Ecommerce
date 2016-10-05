@extends('layouts.main')

@section('body-class'){{ 'shoppage shop-landing' }}@stop

@section('content')
    <h1 class="hidden">Shop</h1>

    <div class="app-wrap" ng-app="pagingApp" ng-controller="shoplandingController">
        <div ng-cloak>
            <div class="homepage-grid center-block">
                <div class="loader loader-fixed" cg-busy="nextLoad"></div>

                <div class="main-content container">
                    <div class="sub-item-container best-sellers">
                        <fieldset class="shoplanding-title">
                            <legend align="left"> <i class="m-icon--flame-fill fill-with-red"></i> Best Sellers</legend>
                        </fieldset>
                        <div class="loader loader-abs" cg-busy="firstLoad"></div>

                        <div>
                            <uib-tabset class="tab-swing-lined" active="active">
                                <uib-tab index="0" heading="Smart Home" class="category-smart-home">
                                    @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-home'])
                                </uib-tab>
                                <uib-tab index="1" heading="Smart Entertainment" class="category-smart-entertainment">
                                    @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-entertainment'])
                                </uib-tab>
                                <uib-tab index="2" heading="Smart Body" class="category-smart-body">
                                    @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-body'])
                                </uib-tab>
                                <uib-tab index="3" heading="Smart Travel" class="category-smart-travel">
                                    @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-travel'])
                                </uib-tab>
                            </uib-tabset>
                        </div>
                    </div>

                    <div class="sub-item-container newest-arrivals">
                        <fieldset class="shoplanding-title">
                            <legend align="left"> <i class="m-icon--arrow fill-with-red"></i> Newest Arrivals </legend>
                        </fieldset>

                        <div>
                            <uib-tabset class="tab-swing-lined" active="active">
                                <uib-tab index="0" heading="Smart Home" class="category-smart-home">
                                    @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-home'])
                                </uib-tab>
                                <uib-tab index="1" heading="Smart Entertainment" class="category-smart-entertainment">
                                    @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-entertainment'])
                                </uib-tab>
                                <uib-tab index="2" heading="Smart Body" class="category-smart-body">
                                    @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-body'])
                                </uib-tab>
                                <uib-tab index="3" heading="Smart Travel" class="category-smart-travel">
                                    @include('layouts.parts.shop-tab', ['category_name' => 'category-smart-travel'])
                                </uib-tab>
                            </uib-tabset>
                        </div>
                    </div>

                    <div class="sub-item-container hot-deals">
                        <fieldset class="shoplanding-title">
                            <legend align="left"><i class="m-icon--deals fill-with-purple"></i> Hot Deals </legend>
                        </fieldset>

                        <div class="row">
                            <div class="col-md-7 left-price-description">
                                <div>
                                    <h1>Best quadcopter in the world gets an upgrade</h1>
                                </div>
                                <div class="price-container">
                                    <div class="normal-price"><span>NORMAL PRICE:</span> <span class="line-through-price">$95.00</span></div>
                                    <div class="big-price-container"><span>$95.00</span></div>
                                    <div class="get-it-button-container">
                                        <a class="btn-get-it" href="#">Get it</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="right-view-container">
                                    <img src="/assets/images/chair.jpg" />
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="sub-item-container bottom-categories-container">
                        <div>
                            <uib-tabset class="tab-swing-lined" active="active">
                                <uib-tab index="0" class="category-tab" heading="Shop by Category">
                                    <div class="shop-by-category-container">
                                        <div class="row">
                                            <div class="col-md-1 category-list">
                                                <div class="vertical-text">Smart Home</div>
                                            </div>
                                            <div class="col-md-11 product-list">
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 category-list">
                                                <div class="vertical-text">Smart Body</div>
                                            </div>
                                            <div class="col-md-11 product-list">
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 category-list">
                                                <div class="vertical-text vertical-long-text">Smart Entertainment</div>
                                            </div>
                                            <div class="col-md-11 product-list">
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 category-list">
                                                <div class="vertical-text">Smart Travel</div>
                                            </div>
                                            <div class="col-md-11 product-list">
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-travel"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-travel"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-travel"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-travel"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </uib-tab>
                                <uib-tab index="1" class="product-tab" heading="Shop by Product">
                                    <div class="shop-by-product-container">
                                        <div class="row">
                                            <div class="col-md-1 category-list">
                                                <div class="vertical-text">Smart Home</div>
                                            </div>
                                            <div class="col-md-11 product-list">
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-home"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 category-list">
                                                <div class="vertical-text">Smart Body</div>
                                            </div>
                                            <div class="col-md-11 product-list">
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-entertainment"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 category-list">
                                                <div class="vertical-text vertical-long-text">Smart Entertainment</div>
                                            </div>
                                            <div class="col-md-11 product-list">
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-body"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 category-list">
                                                <div class="vertical-text">Smart Travel</div>
                                            </div>
                                            <div class="col-md-11 product-list">
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-travel"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-travel"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bedding</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-travel"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Back packs</a></div>
                                                </div>
                                                <div class="one-product-category">
                                                    <div class="icon-container"><a href="#"><i class="m-icon--bath category-smart-travel"></i></a></div>
                                                    <div class="underneath-text"><a href="#">Bath</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </uib-tab>
                            </uib-tabset>
                        </div>
                    </div>

                    <br>
                </div>
            </div>
        </div>
        @include('layouts.parts.product-popup')
    </div>
<script>
    window.onscroll = function() {scrolling()};

    function scrolling() {
        var topMenuClasses = document.getElementById("publicApp").classList;

        if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
            if (!topMenuClasses.contains("shop-top-menu-container")) {
                topMenuClasses.add("shop-top-menu-container");
            }
        } else {
            if (topMenuClasses.contains("shop-top-menu-container")) {
                topMenuClasses.remove("shop-top-menu-container");
            }
        }
    }
</script>
    {{--<script src="/assets/js/vendor/angular-busy.min.js"></script>--}}
    {{--<script src="/assets/js/main.js"></script>--}}
    {{--<script src="/assets/js/angular-custom/public.common.js"></script>--}}
@stop