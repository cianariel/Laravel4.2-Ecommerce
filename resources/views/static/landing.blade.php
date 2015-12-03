@extends('layouts.main')

@section('content')
    <section id="hero" class="landing-hero">
        <div class="hero-background"></div>
        <nav id="mid-nav"  class="col-xs-12 hidden-sm hidden-xs">
            <div class="container">
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
        </nav>

        <div class="container">
            <div class="col-sm-5 col-sm-offset-1 why-us hidden-md hidden-sm hidden-xs">
                <h2>Ideas for Smarter Living</h2>

                <ul>
                    <li class="get-ideas">Get ideas for a smarter and sexier home</li>
                    <li class="share-vote">Share and Vote on the best theme decor</li>
                    <li class="shop-cool">Shop for cool gadgets and unique decor for the home</li>
                </ul>

                <a class="btn btn-success col-xs-8" href="#">Find out more</a>
            </div>
            <div class="col-sm-4 col-sm-offset-1 hero-box qiuck-signup hidden-md hidden-sm hidden-xs">
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
    </section>
    <nav id="hero-nav" class="col-sm-12">
        <div class="container">
            <ul>
                <li class="col-sm-4 "><a class="home-link" href="">Home</a></li>

                <li class="col-sm-2 "><a href="" class="all-link">All</a></li>
                <li class="col-sm-2 "><a href="" class="ideas-link orange">Ideas</a></li>
                <li class="col-sm-2 "><a href="" class="products-link green">Products</a></li>
                <li class="col-sm-2 "><a href="" class="photos-link blue">Photos</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <section class="main-content landing col-md-9">

            <ul class="layout-controls col-xs-12 hidden-xs">
               <li class="list">List</li>
               <li class="grid selected">Grid</li>
            </ul>

            <div class="col-md-6 grid-box">
                <div class="img-wrap">
                    <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                    <a href="#" class="overlay-tag category-tag top product">Category: Products</a>
                    <a href="#" class="overlay-tag bottom get-it">Get it</a>
                    <a href="#" class="social-pic likes">Like it</a>
                    <a href="#" class="social-pic comment">Comment</a>
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
            <div class="col-md-6 grid-box">
                <div class="img-wrap">
                    <img class="img-responsive" src="/assets/images/dummies/img-small.jpg">
                    <a href="#" class="overlay-tag category-tag top photo">Category: Photo</a>
                    <a href="#" class="overlay-tag bottom get-it">Get it</a>
                    <a href="#" class="social-pic likes">Like it</a>
                    <a href="#" class="social-pic comment">Comment</a>
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
            <div class="col-md-12 grid-box">
                <div class="img-wrap">
                    <img class="img-responsive" src="/assets/images/dummies/img-big.jpg">
                    <a href="#" class="overlay-tag category-tag top idea">Category: Idea</a>
                    <a href="#" class="overlay-tag bottom get-it author">Get it</a>
                    <a href="#" class="social-pic likes">Like it</a>
                    <a href="#" class="social-pic comment">Comment</a>
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
            <section id="side-filters" class="pale-grey-bg">
                <div>
                    <h5>Ideas</h5>
                    <label><input type="checkbox">DIY</label>
                    <label><input type="checkbox">Best Buys</label>
                    <label><input type="checkbox">Declutter</label>
                </div>
                <div>
                    <h5>Products</h5>
                    <label><input type="checkbox">Under $50</label>
                    <label><input type="checkbox">Top</label>
                    <label><input type="checkbox">Stuff</label>
                </div>
                <div>
                    <h5>Photos</h5>
                    <label><input type="checkbox">HD (1920px and above)</label>
                    <label><input type="checkbox">MD (1920px and above)</label>
                    <label><input type="checkbox">Any sizes</label>
                </div>

                <a class="btn btn-success col-xs-12">Apply Filters</a>
                <a class="btn-none col-xs-12">Cancel</a>
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


@stop