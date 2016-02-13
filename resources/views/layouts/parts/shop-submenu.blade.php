        <header class="sub-head">
            <nav class="shop-menu hidden-soft hidden-620">
                <div class="container full-sm">
                    <section class="most-popular col-xs-4" ng-repeat="item in productsForShopMenu.mostPopular">
                        <h5><a style="position: static" href="/shop/">Most Popular</a></h5>

                        <div class="img-wrap">
                            <img style="width: 70%;height: auto;" class="img-responsive" src="@{{item.media_link_full_path}}">
                        </div>
                        <div style="position: static">
                            <span class="in" style="position: static; text-transform: capitalize;">In @{{item.category_name}}</span>
                            <b><a style="position: static;" href="/product/@{{item.product_permalink}}">@{{item.product_name}}</a></b>
                        </div>

                    </section>

                    <section class="smart-home col-xs-2">
                        <h5><a href="/shop/smart-home">Smart Home</a></h5>
                        <div class="img-wrap" ng-repeat="item in productsForShopMenu.smartHome">
                            <a href="/product/@{{item.product_permalink}}">
                                <img  style="width: 70%;height: auto;" class="img-responsive" src="@{{item.media_link_full_path}}">
                            </a>
                            {{--<b><a href="/product/@{{item.product_permalink}}">@{{item.product_name}}</a></b>--}}
                        </div>
                    </section>


                    <section class="travel col-xs-2">
                        <h5><a href="/shop/travel">Travel</h5>
                        <div class="img-wrap" ng-repeat="item in productsForShopMenu.travel">
                            <a href="/product/@{{item.product_permalink}}">
                                 <img  style="width: 70%;height: auto;" class="img-responsive" src="@{{item.media_link_full_path}}">
                            </a>
                            {{--<b><a href="/product/@{{item.product_permalink}}">@{{item.product_name}}</a></b>--}}
                        </div>
                    </section>

                    <section class="wearables col-xs-2">
                        <h5><a href="/shop/wearables">Wearables</h5>
                        <div class="img-wrap" ng-repeat="item in productsForShopMenu.wearables">
                            <a href="/product/@{{item.product_permalink}}">
                                <img style="width: 70%;height: auto;"  class="img-responsive" src="@{{item.media_link_full_path}}">
                            </a>
                            {{--<b><a href="/product/@{{item.product_permalink}}">@{{item.product_name}}</a></b>--}}
                        </div>
                    </section>


                    <section class="home-decor col-xs-2">
                        <h5><a href="/shop/wearables">Home and Decor</a></h5>
                        <div class="img-wrap" ng-repeat="item in productsForShopMenu.homeDecor">
                            <a href="/product/@{{item.product_permalink}}">
                                <img  style="width: 70%;height: auto;" class="img-responsive" src="@{{item.media_link_full_path}}">
                            </a>
                            {{--<b><a href="/product/@{{item.product_permalink}}">@{{item.product_name}}</a></b>--}}
                        </div>
                    </section>
                </div>
            </nav>
        </header>
