        <header class="sub-head">
            <nav id="shop-menu" class="shop-menu hidden-soft hidden-620">
                <div class="container full-sm">
                    <section class="most-popular col-xs-4" ng-repeat="item in productsForShopMenu.mostPopular">
                        <h5><a style="position: static" href="/shop/">Most Popular</a></h5>

                        <div class="img-wrap">
                            <img style="width: 70%;height: auto;" class="img-responsive" src="{{item.media_link_full_path}}">
                        </div>
                        <div style="position: static">
                            <span class="in" style="position: static; text-transform: capitalize;">In {{item.category_name}}</span>
                            <b><a style="position: static;" href="/product/{{item.product_permalink}}">{{item.product_name}}</a></b>
                        </div>

                    </section>

                    <section class="smart-home col-xs-2">
                        <h5><a href="/shop/smart-home">Smart Home</a></h5>
                        <div class="img-wrap" ng-repeat="item in productsForShopMenu.smartHome">
                            <a href="/product/{{item.product_permalink}}">
                                <img  style="width: 70%;height: auto;" class="img-responsive" src="{{item.media_link_full_path}}">
                            </a>
                        </div>
                    </section>


                    <section class="travel col-xs-2">
                        <h5><a href="/shop/travel">Travel</h5>
                        <div class="img-wrap" ng-repeat="item in productsForShopMenu.travel">
                            <a href="/product/{{item.product_permalink}}">
                                 <img  style="width: 70%;height: auto;" class="img-responsive" src="{{item.media_link_full_path}}">
                            </a>
                        </div>
                    </section>

                    <section class="wearables col-xs-2">
                        <h5><a href="/shop/wearables">Wearables</h5>
                        <div class="img-wrap" ng-repeat="item in productsForShopMenu.wearables">
                            <a href="/product/{{item.product_permalink}}">
                                <img style="width: 70%;height: auto;"  class="img-responsive" src="{{item.media_link_full_path}}">
                            </a>
                        </div>
                    </section>


                    <section class="home-decor col-xs-2">
                        <h5><a href="/shop/home-decor">Home and Decor</a></h5>
                        <div class="img-wrap" ng-repeat="item in productsForShopMenu.homeDecor">
                            <a href="/product/{{item.product_permalink}}">
                                <img  style="width: 70%;height: auto;" class="img-responsive" src="{{item.media_link_full_path}}">
                            </a>
                        </div>
                    </section>
                </div>
            </nav>
            <nav id="all-shop-menu" class="shop-menu hidden-soft hidden-620">
                <div class="container full-sm">
                    <section class="col-xs-4 shop-by-category" >
                        <p class="title"><a href="/shop/">Shop by Category</a></p>

                        <div class="link-row">
                            <a href="#">Smart Home</a>
                        </div>
                        <div class="link-row">
                            <a href="#">Travel</a>
                        </div>
                        <div class="link-row">
                            <a href="#">Wearables</a>
                        </div>
                        <div class="link-row">
                            <a href="#">Home & Decor</a>
                        </div>

                    </section>

                    <section class="smart-home col-xs-8">
                        <div class="col-md-12">                        
                            <p class="title"><a href="/shop/">Smart Home</a></p>
                        </div>
                        <div class="col-sm-4 link-row"><a href="#">Energy and Air</a></div>
                        <div class="col-sm-4 link-row"><a href="#">Energy and Air</a></div>
                        <div class="col-sm-4 link-row"><a href="#">Energy and Air</a></div>
                        <div class="col-sm-4 link-row"><a href="#">Energy and Air</a></div>
                        <div class="col-sm-4 link-row"><a href="#">Energy and Air</a></div>
                    </section>

                </div>
            </nav>
        </header>
