@extends('layouts.main')

@section('content')
    <section id="hero" class="landing-hero">
        <div class="hero-background"></div>
        <nav id="mid-nav"  class="col-xs-12">
            <div class="container hidden-xs">
                <ul>
                    <li class="selected"><a href="">All ideas</a></li>
                    <li><a href="">Kitchen</a></li>
                    <li><a href="">Bedroom</a></li>
                    <li><a href="">Office</a></li>
                    <li><a href="">Living</a></li>
                    <li><a href="">Outdoor</a></li>
                    <li><a href="">Lighting</a></li>
                    <li><a href="">Decor</a></li>
                    <li><a class="more-link" href="">...</a></li>
                </ul>
            </div>
            <div class="container mobile-menu hidden-lg hidden-md hidden-sm full-620">
                <ul>
                    <li class="selected"><a href="">All ideas</a></li>
                    <li><a href="">Kitchen</a></li>
                    <li><a href="">Bath</a></li>
                    <li><a class="nested" href="">More</a></li>
                    {{--<li><a href="">Outdoor</a></li>--}}
                    {{--<li><a href="">Lighting</a></li>--}}
                    {{--<li><a href="">Decor</a></li>--}}
                    <li><a class="more-link" href="">...</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="col-md-5 col-sm-6 col-md-offset-1 why-us hidden-xs">
                <h2>Ideas for Smarter Living</h2>

                <ul>
                    <li class="get-ideas">Get ideas for a smarter and sexier home</li>
                    <li class="share-vote">Share and Vote on the best theme decor</li>
                    <li class="shop-cool">Shop for cool gadgets and unique decor for the home</li>
                </ul>

                <a class="btn btn-success col-xs-8" href="#">Find out more</a>
            </div>
            <div class="col-md-4 col-sm-6 col-md-offset-1 hero-box qiuck-signup hidden-xs">
                <form>
                    <h4>Our famous <br/>
                        <b>30-second sign-up</b>
                    </h4>

                    <input class="form-control" type="text" placeholder="First name" name="name">
                    <input class="form-control"  type="text" placeholder="Email" name="email">

                    <a class="btn btn-success col-xs-12" href="#">Sign up</a>
                        <div class="line-wrap">or</div>
                    <a class="btn btn-info col-xs-12" href="#"><i class="icon fb-icon"></i>Sign up with Facebook</a>
                </form>
            </div>

            <div class="mobile-hero col-xs-12 hidden-lg hidden-md hidden-sm">
                <h2>11 Kitchen Gadgets You Need Now</h2>
                <a href="#" class="social-pic likes red">193</a>


            </div>

            {{--<div class="mobile-register hidden-lg hidden-md hidden-sm">--}}
                {{--<div>--}}
                    {{--<a href="#" class="register-button">--}}
                        {{--Register--}}
                    {{--</a>--}}
                    {{--<a class="signup-with-facebook pull-right">Signup with Facebook</a>--}}
                {{--</div>--}}

            {{--</div>--}}

        </div>
    </section>
    <nav id="hero-nav" class="col-sm-12">
        <div class="container full-620">
            <ul>
                <li class="col-sm-4 "><a class="home-link" href="">Home</a></li>

                <li class="col-sm-2 active"><a href="" class="all-link">All</a></li>
                <li class="col-sm-2 "><a href="" class="ideas-link">Ideas</a></li>
                <li class="col-sm-2 "><a href="" class="products-link">Products</a></li>
                <li class="col-sm-2 "><a href="" class="photos-link">Photos</a></li>
            </ul>
        </div>
    </nav>

    <div class="container full-620 main-container">
        <button id="show-mobile-filters" class="toggler btn btn-info col-sm-4 col-xs-8 hidden-lg hidden-md" data-toggle="#mobile-side-filters">Filter</button>

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

        <section class="main-content landing col-md-9">

            <ul class="layout-controls col-xs-12 hidden-xs">
               <li class="list">List</li>
               <li class="grid selected">Grid</li>
            </ul>

            <div class="col-md-6 grid-box full-620">
                <div class="img-wrap">
                    <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                    <a href="#" class="overlay-tag category-tag top product">Category: Products</a>
                    <div class="like-wrap">
                        <a href="#" class="social-pic likes">Like it</a>
                        <a href="#" class="social-pic comment">Comment</a>
                    </div>
                    <a href="#" class="overlay-tag bottom get-it">
                        <div class="circle-3">
                            <div class="circle-2">
                                <div class="circle-1">Get it</div>
                            </div>
                        </div>
                    </a>

                </div>
                <h3><a href="#">Venetian Louge Suite</a></h3>
                <ul class="box-tags">
                    <li class="box-tag"><a>Products</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                </ul>
            </div>
            <div class="col-md-6 grid-box full-620">
                <div class="img-wrap">
                    <img class="img-responsive" src="/assets/images/dummies/img-small.jpg">
                    <a href="#" class="overlay-tag category-tag top photo">Category: Photo</a>

                    <div class="like-wrap">
                         <a href="#" class="social-pic likes">Like it</a>
                         <a href="#" class="social-pic comment">Comment</a>
                    </div>

                    <a href="#" class="overlay-tag bottom get-it">
                        <div class="circle-3">
                            <div class="circle-2">
                                <div class="circle-1">Get it</div>
                            </div>
                        </div>
                    </a>
                </div>
                <h3><a href="#">Venetian Louge Suite</a></h3>
                <ul class="box-tags">
                    <li class="box-tag"><a>Products</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                </ul>
            </div>
            <div class="col-md-12 grid-box big-box full-620">
                <div class="img-wrap">
                    <img class="img-responsive" src="/assets/images/dummies/img-small.jpg">
                    <a href="#" class="overlay-tag category-tag top idea">Category: Idea</a>
                    <a href="#" class="overlay-tag bottom author">Get it</a>

                    <div class="like-wrap">
                        <a href="#" class="social-pic likes">Like it</a>
                        <a href="#" class="social-pic comment">Comment</a>
                    </div>

                    <a href="#" class="overlay-tag bottom get-it big green">
                        <div class="circle-3">
                            <div class="circle-2">
                                <div class="circle-1">Featured</div>
                            </div>
                        </div>
                    </a>
                </div>
                <h3><a href="#">The Top Kitchen Gadgets</a></h3>
                <p>Truly good design and taste are always current, always relevant. Quiet, muted colors determine the image</p>
                <ul class="box-tags">
                    <li class="box-tag"><a>Products</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                    <li class="box-tag"><a>Improvements</a></li>
                </ul>
            </div>


            <div class="col-md-12 grid-insert pale-grey-bg">
                <h4><a href="#">550.230 Kitchen Design Photos</a></h4>
                <p>
                    Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath. Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath. Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath.
                </p>
                <a class="btn btn-success" href="#">Upload a photo</a>
            </div>

                <a class="btn btn-success bottom-load-more col-xs-12">Load More</a>

        </section>

        <aside class="col-md-3 hidden-sm hidden-xs">
            <section id="side-filters" class="side-filters pale-grey-bg">
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

            <section class="sidebar-category products">
                <h4>Most Popular Products</h4>

                <div class="grid-box sidebar-box">
                        <div class="img-wrap">
                            <img class="img-responsive" src="/assets/images/dummies/img-small.jpg">
                            <a href="#" class="overlay-tag top-left-corner number">1</a>
                        </div>
                    <h5><a href="#">4 Tier wood utility</a></h5>
                    <ul class="box-tags">
                        <li class="box-tag"><a>Products</a></li>
                    </ul>
                    <a class="sidebar-social-counter like">31</a>
                </div>
            </section>
            <section class="sidebar-category ideas">
                <h4>Most Popular Ideas</h4>

                <div class="grid-box sidebar-box">
                        <div class="img-wrap">
                            <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                            <a href="#" class="overlay-tag top-left-corner number">1</a>
                        </div>
                    <h5><a href="#">4 Tier wood utility</a></h5>
                    <ul class="box-tags">
                        <li class="box-tag"><a>Products</a></li>
                    </ul>
                    <a class="sidebar-social-counter like">31</a>
                </div>
            </section>
            <section class="sidebar-category photos">
                <h4>Most Popular Photos</h4>

                <div class="grid-box sidebar-box">
                        <div class="img-wrap">
                            <img class="img-responsive" src="/assets/images/dummies/img-small.jpg">
                            <a href="#" class="overlay-tag top-left-corner number">1</a>
                        </div>
                    <h5><a href="#">4 Tier wood utility</a></h5>
                    <ul class="box-tags">
                        <li class="box-tag"><a>Products</a></li>
                    </ul>
                    <a class="sidebar-social-counter like">31</a>
                </div>
            </section>


        </aside>
    </div>

    <div id="myModal" class="modal col-lg-4 col-md-6 col-sm-6 col-xs-12 col-offset-md-2">
        <div class="modal-content hero-box qiuck-signup">
            <span data-dismiss="modal" class="close-button">✖</span>
            <form>
                <h4>Our famous <br/>
                    <b>30-second sign-up</b>
                </h4>

                <input class="form-control" type="text" placeholder="First name" name="name">
                <input class="form-control"  type="text" placeholder="Email" name="email">

                <a class="btn btn-success col-xs-12" href="#">Sign up</a>
                <div class="line-wrap">or</div>
                <a class="btn btn-info col-xs-12" href="#"><i class="icon fb-icon"></i>Sign up with Facebook</a>
            </form>
        </div>
    </div>
    <div id="overlay"></div>


@stop