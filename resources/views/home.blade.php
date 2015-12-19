@extends('layouts.main')

@section('content')
    <section id="hero" class="landing-hero">
        <div class="hero-background"></div>
        <div class="color-overlay"></div>

        <div class="container fixed-sm full-480">
            <div class="col-md-5 col-xs-6 full-620 col-md-offset-1 why-us">
                <h2>Ideas for Smarter Living</h2>

                <ul>
                    <li class="get-ideas">Get ideas for a smarter and sexier home</li>
                    <li class="share-vote">Share and Vote on the best theme decor</li>
                    <li class="shop-cool">Shop for cool gadgets and unique decor</li>
                </ul>

            </div>
            <div class="col-md-4 col-xs-6 col-md-offset-1 hero-box qiuck-signup hidden-620">
                <form>
                    <h4>
                        <b>Sign-up in Seconds</b>
                    </h4>

                    <input class="form-control" type="text" placeholder="First name" name="name">
                    <input class="form-control"  type="text" placeholder="Email" name="email">

                    <a class="btn btn-success col-xs-12" href="#">Sign up</a>
                    <div class="line-wrap">or</div>
                    <a class="btn btn-info col-xs-12" href="#"><i class="icon fb-icon"></i>Sign up with Facebook</a>
                </form>
            </div>


        </div>
    </section>
    <nav id="hero-nav" class="col-sm-12">
        <div class="container full-620  fixed-sm">
            <ul class="left-nav col-xs-1 hidden-620">
                <li class="active"><a class="home-link" href="#">Home</a></li>
            </ul>
            <ul class="category-nav pull-right">
                <li class="active"><a href="" class="all-link">All</a></li>
                <li><a href="" class="ideas-link">Ideas</a></li>
                <li><a href="" class="products-link">Products</a></li>
                <li><a href="" class="photos-link">Photos</a></li>
            </ul>
        </div>
    </nav>

    <div class="container full-620 main-container fixed-sm">
        <button id="show-mobile-filters" class="toggler btn btn-info col-sm-4 col-xs-8 hidden-soft shown-620" data-toggle="#mobile-side-filters">Filter</button>

        <section id="mobile-side-filters" class="side-filters pale-grey-bg col-xs-12 hidden-lg hidden-md">
            <ul class="mobile-filter-switch hidden-sm">
                <li class="col-xs-4 active" data-toggle="#idea-filter" data-hide="#mobile-side-filters div">
                    <b>Ideas</b>
                </li>
                <li class="col-xs-4" data-toggle="#product-filter" data-hide="#mobile-side-filters div">
                    <b >Products</b>
                </li>
                <li class="col-xs-4"  data-toggle="#photo-filter" data-hide="#mobile-side-filters div">
                    <b>Photos</b>
                </li>
            </ul>
            <div id="idea-filter" class="col-md-12 col-sm-4 col-xs-7 col-sm-offset-0 col-xs-offset-1">
                <h5 class="hidden-xs">Ideas</h5>

                <input type="checkbox" name="dyi" id="dyi-nobile"> <label for="dyi-nobile"><span></span>DIY</label>
                <input type="checkbox" name="best-buys" id="best-buys-mobile"> <label for="best-buys-mobile"><span></span>Best Buys</label>
                <input type="checkbox" name="declutter" id="declutter-mobile"> <label for="declutter-mobile"><span></span>Declutter</label>
            </div>
            <div id="product-filter" class="col-md-12 col-sm-4 col-xs-7">
                <h5>Products</h5>
                <input type="checkbox" name="cheap" id="cheap-mobile"> <label for="cheap-mobile"><span></span>Under $50</label>
                <input type="checkbox" name="top" id="top-mobile"> <label for="top-mobile"><span></span>Top</label>
                <input type="checkbox" name="stuff" id="stuff-mobile"> <label for="stuff-mobile"><span></span>Stuff</label>
            </div>
            <div id="photo-filter" class="col-md-12 col-sm-4 col-xs-7">
                <h5>Photos</h5>
                <input type="checkbox" name="hd" id="hd-mobile"> <label for="hd-mobile"><span></span>HD (1920px and above)</label>
                <input type="checkbox" name="md" id="md-mobile"> <label for="md-mobile"><span></span>MD (1920px and above)</label>
                <input type="checkbox" name="anysize" id="anysize-mobile"> <label for="anysize-mobile"><span></span>Any sizes</label>
            </div>

        </section>

        <section class="main-content landing col-xs-9 full-620">

            <ul class="layout-controls col-xs-12 hidden-xs">
                <li class="list">List</li>
                <li class="grid selected">Grid</li>
            </ul>

            <div class="latest-heading">
                <hr/>
                <h6>The Latest</h6>
            </div>


                <div class="col-xs-6 grid-box full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                        <a href="#" class="overlay-tag category-tag top product">Category: Products</a>

                        <div class="color-overlay">
                            <b class="price">$199</b>
                            <img class="vendor-logo" src="/assets/images/dummies/amazon.png">
                            <div class="get solid">Get it</div>
                            <h4>Venetian Louge Suite</h4>
                        </div>
                    </div>
                    <div class="like-wrap">
                        <a href="#" class="social-pic likes">157</a>
                        <a href="#" class="social-pic comment">89</a>
                    </div>
                    <datetime>21 Dec 2015</datetime>

                </div>



                <div class="col-xs-6 grid-box full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="/assets/images/dummies/img-small.jpg">
                        <a href="#" class="overlay-tag category-tag top product">Category: Products</a>
                        <div class="color-overlay">
                            <b class="price">$199</b>
                            <img class="vendor-logo" src="/assets/images/dummies/amazon.png">
                            <div class="get solid">Get it</div>
                            <h4>Venetian Louge Suite</h4>
                        </div>
                    </div>
                    <div class="like-wrap">
                        <a href="#" class="social-pic likes">157</a>
                        <a href="#" class="social-pic comment">89</a>
                    </div>
                    <datetime>21 Dec 2015</datetime>


                </div>

            @foreach($stories as $story)

            <div class="col-xs-12 grid-box big-box full-620">
                <div class="img-wrap">
                    <img class="img-responsive" src="{{$story['image']}}">
                    <a href="{{$story['url']}}" class="overlay-tag category-tag top idea">Style</a>
                    <a href="#" class="overlay-tag bottom author">Get it</a>

                    <div class="like-wrap">
                        <a href="#" class="social-pic likes">Like it</a>
                        <a href="#" class="social-pic comment">Comment</a>
                    </div>

                    <a href="#" class="overlay-tag bottom featured-badge big">
                        Featured
                    </a>
                </div>
                <h3><a href="{{$story['url']}}">{{$story['title']}}</a> </h3>
                <datetime>{{date('h m - d M y', strtotime($story['pubdate']))}}
                </datetime>
            </div>

            @endforeach


            <div class="col-xs-12 grid-insert pale-grey-bg">
                <h4><a href="#">550.230 Kitchen Design Photos</a></h4>
                <p>
                    Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath. Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath. Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath.
                </p>
                <a class="btn btn-success" href="#">Upload a photo</a>
            </div>

            <a class="btn btn-success bottom-load-more col-xs-12">Load More</a>

        </section>

        <aside class="col-xs-3 hidden-620">
            <section class="sidebar-category products">
                <h4>Top Products</h4>

                <div class="grid-box sidebar-box">
                    <div class="img-wrap">
                        <img class="img-responsive" src="/assets/images/dummies/img-small.jpg">
                        <a href="#" class="overlay-tag top-left-corner number">1</a>
                        <a class="sidebar-social-counter like">31</a>
                    </div>
                    <h5><a href="#">4 Tier wood utility</a></h5>
                    {{--<ul class="box-tags">--}}
                    {{--<li class="box-tag"><a>Products</a></li>--}}
                    {{--</ul>--}}
                    {{--<a class="sidebar-social-counter like">31</a>--}}
                </div>
            </section>
            <section class="sidebar-category ideas">
                <h4>Top Ideas</h4>

                <div class="grid-box sidebar-box">
                    <div class="img-wrap">
                        <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                        <a href="#" class="overlay-tag top-left-corner number">1</a>
                        <a class="sidebar-social-counter like">31</a>
                    </div>
                    <h5><a href="#">4 Tier wood utility</a></h5>
                    {{--<ul class="box-tags">--}}
                    {{--<li class="box-tag"><a>Products</a></li>--}}
                    {{--</ul>--}}
                </div>
            </section>
            <section class="sidebar-category photos">
                <h4>Top Photos</h4>

                <div class="grid-box sidebar-box">
                    <div class="img-wrap">
                        <img class="img-responsive" src="/assets/images/dummies/img-small.jpg">
                        <a href="#" class="overlay-tag top-left-corner number">1</a>
                        <a class="sidebar-social-counter like">31</a>
                    </div>
                    <h5><a href="#">4 Tier wood utility</a></h5>
                    {{--<ul class="box-tags">--}}
                    {{--<li class="box-tag"><a>Products</a></li>--}}
                    {{--</ul>--}}
                </div>
            </section>

            <section id="side-filters" class="side-filters pale-grey-bg pale-grey-border">
                <div>
                    <h5>Ideas</h5>
                    <input type="checkbox" name="dyi" id="dyi"> <label for="dyi"><span></span>DIY</label>
                    <input type="checkbox" name="best-buys" id="best-buys"> <label for="best-buys"><span></span>Best Buys</label>
                    <input type="checkbox" name="declutter" id="declutter"> <label for="declutter"><span></span>Declutter</label>
                </div>
                <div>
                    <h5>Products</h5>
                    <input type="checkbox" name="cheap" id="cheap"> <label for="cheap"><span></span>Under $50</label>
                    <input type="checkbox" name="top" id="top"> <label for="top"><span></span>Top</label>
                    <input type="checkbox" name="stuff" id="stuff"> <label for="stuff"><span></span>Stuff</label>
                </div>
                <div>
                    <h5>Photos</h5>
                    <input type="checkbox" name="hd" id="hd"> <label for="hd"><span></span>HD (1920px and above)</label>
                    <input type="checkbox" name="md" id="md"> <label for="md"><span></span>MD (1920px and above)</label>
                    <input type="checkbox" name="anysize" id="anysize"> <label for="anysize"><span></span>Any sizes</label>
                </div>

                {{--<a class="btn btn-success col-xs-12">Apply Filters</a>--}}
                {{--<a class="btn-none col-xs-12">Cancel</a>--}}
            </section>
        </aside>
    </div>

@stop