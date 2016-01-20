@extends('layouts.main')

@section('body-class'){{ 'homepage' }}@stop

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
            {{--<ul class="left-nav col-xs-1 hidden-620">--}}
                {{--<li class="active"><a class="home-link" href="#">Home</a></li>--}}
            {{--</ul>--}}
            <ul class="category-nav">
                <li class="active"><a href="" class="all-link">All</a></li>
                <li><a href="" class="ideas-link">Ideas</a></li>
                <li><a href="" class="products-link">Products</a></li>
                <li><a href="" class="photos-link">Photos</a></li>
            </ul>
        </div>
    </nav>

    <div class="clearfix"></div>

    <div class="homepage-grid container">

        <div class="grid-box-3">
            <div class="box-item">

                <img src="/assets/images/dummies/webcam-square.jpg" alt=""/>

                <span class="box-item__time">posted 5 hours ago</span>
                <div class="box-item__overlay"></div>

                <ul class="social-stats">
                    <li class="social-stats__item">
                        <a href="#">
                            <i class="m-icon m-icon--heart"></i>
                            <span class="social-stats__text">52</span>
                        </a>
                    </li>
                    <li class="social-stats__item">
                        <a href="#">
                            <i class="m-icon m-icon--buble"></i>
                            <span class="social-stats__text">157</span>
                        </a>
                    </li>
                </ul>

                <div class="round-tag round-tag--idea">
                    <i class="m-icon m-icon--item"></i>
                    <span class="round-tag__label">Idea</span>
                </div>

                <div class="box-item__label-idea">
                    <a href="#" class="box-item__label">10 Ideas for Gorgeous Kitchens</a>
                    <div class="clearfix"></div>
                    <a href="#" class="box-item__read-more">Read More</a>
                </div>

                <div class="box-item__author">
                    <a href="#" class="user-widget">
                        <img class="user-widget__img" src="/assets/images/dummies/author.png">
                        <span class="user-widget__name">Bob Barbarian</span>
                    </a>
                </div>
            </div>
            <div class="box-item">

                <img src="/assets/images/dummies/webcam-square.jpg" alt=""/>

                <span class="box-item__time">posted 5 hours ago</span>
                <div class="box-item__overlay"></div>

                <ul class="social-stats">
                                    <li class="social-stats__item">
                                        <a href="#">
                                            <i class="m-icon m-icon--heart"></i>
                                            <span class="social-stats__text">52</span>
                                        </a>
                                    </li>
                                    <li class="social-stats__item">
                                        <a href="#">
                                            <i class="m-icon m-icon--buble"></i>
                                            <span class="social-stats__text">157</span>
                                        </a>
                                    </li>
                                </ul>

                <div class="round-tag round-tag--product">
                    <i class="m-icon m-icon--item"></i>
                    <span class="round-tag__label">Product</span>
                </div>

                <div class="box-item__label-prod">
                    <a href="#" class="box-item__label box-item__label--clear">The Awesome Webcam</a>
                    <div class="clearfix"></div>
                    <div class="merchant-widget">
                        <span class="merchant-widget__price">$32.00</span>
                        <span>from</span>
                        <img class="merchant-widget__store" src="/assets/images/dummies/amazon-black.png" />
                    </div>
                    <div class="clearfix"></div>
                    <a href="#" class="box-item__get-it">Get it</a>
                </div>
            </div>
            <div class="box-item">

                <img src="/assets/images/dummies/webcam-square.jpg" alt=""/>

                <span class="box-item__time">posted 5 hours ago</span>
                <div class="box-item__overlay"></div>

                <ul class="social-stats">
                                    <li class="social-stats__item">
                                        <a href="#">
                                            <i class="m-icon m-icon--heart"></i>
                                            <span class="social-stats__text">52</span>
                                        </a>
                                    </li>
                                    <li class="social-stats__item">
                                        <a href="#">
                                            <i class="m-icon m-icon--buble"></i>
                                            <span class="social-stats__text">157</span>
                                        </a>
                                    </li>
                                </ul>

                <div class="round-tag round-tag--idea">
                    <i class="m-icon m-icon--item"></i>
                    <span class="round-tag__label">Idea</span>
                </div>

                <div class="box-item__label-idea">
                    <a href="#" class="box-item__label">10 Ideas for Gorgeous Kitchens</a>
                    <div class="clearfix"></div>
                    <a href="#" class="box-item__read-more">Read More</a>
                </div>

                <div class="box-item__author">
                    <a href="#" class="user-widget">
                        <img class="user-widget__img" src="/assets/images/dummies/author.png">
                        <span class="user-widget__name">Bob Barbarian</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid-box-full">
            <div class="box-item">

                <div class="box-item__img" style="background-image: url('/assets/images/dummies/clock.png')"></div>

                <span class="box-item__time">posted 5 hours ago</span>
                <div class="box-item__overlay"></div>

                <ul class="social-stats">
                                    <li class="social-stats__item">
                                        <a href="#">
                                            <i class="m-icon m-icon--heart"></i>
                                            <span class="social-stats__text">52</span>
                                        </a>
                                    </li>
                                    <li class="social-stats__item">
                                        <a href="#">
                                            <i class="m-icon m-icon--buble"></i>
                                            <span class="social-stats__text">157</span>
                                        </a>
                                    </li>
                                </ul>

                <div class="round-tag round-tag--idea">
                    <i class="m-icon m-icon--item"></i>
                    <span class="round-tag__label">Idea</span>
                </div>

                <div class="box-item__label-idea">
                    <a href="#" class="box-item__label">10 Ideas for Gorgeous Kitchens</a>
                    <div class="clearfix"></div>
                    <a href="#" class="box-item__read-more">Read More</a>
                </div>

                <div class="box-item__author">
                    <a href="#" class="user-widget">
                        <img class="user-widget__img" src="/assets/images/dummies/author.png">
                        <span class="user-widget__name">Bob Barbarian</span>
                    </a>
                </div>
            </div>
        </div>

        {{--@foreach($stories as $story)--}}
        {{--<div class="col-xs-12 grid-box big-box full-620">--}}
        {{--<div class="img-wrap">--}}
        {{--<a href="{{$story->url}}" class="big-image-link">--}}

        {{--@if($story->feed_image)--}}
        {{--<img class="img-responsive" alt="{{$story->feed_image->alt}}" title="{{$story->feed_image->alt}}" src="{{$story->feed_image->url}}">--}}
        {{--@else--}}
        {{--<img class="img-responsive" src="{{$story->image}}">--}}
        {{--@endif--}}

        {{--</a>--}}
        {{--<a href="#" class="overlay-tag category-tag top idea">{{$story->category}}</a>--}}
        {{--<a href="{{$story->authorlink}}" class="overlay-tag bottom author" style="background-image: url({{$story->avator}})">{{$story->author}}</a>--}}
        {{--<div class="like-wrap">--}}
        {{--<a href="#" class="social-pic likes">Like it</a>--}}
        {{--<a href="#" class="social-pic comment">Comment</a>--}}
        {{--</div>--}}
        {{--@if($story->is_featured)--}}
        {{--<a href="#" class="overlay-tag bottom featured-badge big">--}}
        {{--Featured--}}
        {{--</a>--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--<h3><a href="{{$story->url}}">{{$story->title}}</a></h3>--}}
        {{--<time>{{$story->date}}</time>--}}
        {{--</div>--}}
        {{--@endforeach--}}

    </div>


    {{-- old home --}}
    {{--<div class="container full-620 main-container fixed-sm">--}}


            {{--<div class="col-xs-6 grid-box full-620">--}}
                {{--<div class="img-wrap">--}}
                    {{--<img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">--}}

                    {{--<div class="color-overlay">--}}
                        {{--<div class="like-wrap">--}}
                            {{--<a href="#" class="social-pic likes">157</a>--}}
                        {{--</div>--}}

                        {{--<h4>Venetian Louge Suite</h4>--}}

                        {{--<ul class="prices">--}}
                            {{--<li>--}}
                                {{--<a href="#"><b>$35.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#"><b>$39.50.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#"> <a href="#"><b>$41.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}

                    {{--</div>--}}
                {{--</div>--}}

                {{--<time>1 hour ago</time>--}}

            {{--</div>--}}

            {{--<div class="col-xs-6 grid-box full-620">--}}
                {{--<div class="img-wrap">--}}
                    {{--<img class="img-responsive" src="/assets/images/dummies/img-small.jpg">--}}

                    {{--<div class="color-overlay">--}}
                        {{--<div class="like-wrap">--}}
                            {{--<a href="#" class="social-pic likes">157</a>--}}
                        {{--</div>--}}

                        {{--<h4>Venetian Louge Suite</h4>--}}

                        {{--<ul class="prices">--}}
                            {{--<li>--}}
                                {{--<a href="#"><b>$35.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#"><b>$39.50.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#"> <a href="#"><b>$41.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}

                    {{--</div>--}}
                {{--</div>--}}

                {{--<time>5 hours ago</time>--}}

            {{--</div>--}}

                {{--@foreach($stories as $story)--}}
                    {{--<div class="col-xs-12 grid-box big-box full-620">--}}
                        {{--<div class="img-wrap">--}}
                            {{--<a href="{{$story->url}}" class="big-image-link">--}}

                                {{--@if($story->feed_image)--}}
                                    {{--<img class="img-responsive" alt="{{$story->feed_image->alt}}" title="{{$story->feed_image->alt}}" src="{{$story->feed_image->url}}">--}}
                                {{--@else--}}
                                    {{--<img class="img-responsive" src="{{$story->image}}">--}}
                                {{--@endif--}}

                            {{--</a>--}}
                            {{--<a href="#" class="overlay-tag category-tag top idea">{{$story->category}}</a>--}}
                            {{--<a href="{{$story->authorlink}}" class="overlay-tag bottom author" style="background-image: url({{$story->avator}})">{{$story->author}}</a>--}}
                            {{--<div class="like-wrap">--}}
                                {{--<a href="#" class="social-pic likes">Like it</a>--}}
                                {{--<a href="#" class="social-pic comment">Comment</a>--}}
                            {{--</div>--}}
                            {{--@if($story->is_featured)--}}
                                {{--<a href="#" class="overlay-tag bottom featured-badge big">--}}
                                    {{--Featured--}}
                                {{--</a>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--<h3><a href="{{$story->url}}">{{$story->title}}</a></h3>--}}
                        {{--<time>{{$story->date}}</time>--}}
                    {{--</div>--}}
                {{--@endforeach--}}

            {{--<div class="col-xs-12 grid-insert pale-grey-bg">--}}
                {{--<h4><a href="#">550.230 Kitchen Design Photos</a></h4>--}}
                {{--<p>--}}
                    {{--Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath. Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath. Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath.--}}
                {{--</p>--}}
                {{--<a class="btn btn-success" href="#">Upload a photo</a>--}}
            {{--</div>--}}

            {{--<a class="btn btn-success bottom-load-more col-xs-12">Load More</a>--}}

        {{--<aside class="col-xs-3 hidden-620">--}}
            {{--<section class="sidebar-category products">--}}
                {{--<h4>Top Products</h4>--}}

                {{--<div class="grid-box sidebar-box">--}}
                    {{--<a href="#" class="overlay-tag top-left-corner number">1</a>--}}
                    {{--<div class="img-wrap">--}}
                        {{--<img class="img-responsive" src="/assets/images/dummies/img-small.jpg">--}}
                        {{--<a class="sidebar-social-counter like">31</a>--}}
                    {{--</div>--}}
                    {{--<h5><a href="#">4 Tier wood utility</a></h5>--}}
                {{--</div>--}}
            {{--</section>--}}
            {{--<section class="sidebar-category ideas">--}}
                {{--<h4>Top Ideas</h4>--}}

                {{--<div class="grid-box sidebar-box">--}}
                    {{--<a href="#" class="overlay-tag top-left-corner number">1</a>--}}
                    {{--<div class="img-wrap">--}}
                        {{--<img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">--}}
                        {{--<a class="sidebar-social-counter like">31</a>--}}
                    {{--</div>--}}
                    {{--<h5><a href="#">4 Tier wood utility</a></h5>--}}
                {{--</div>--}}
            {{--</section>--}}
            {{--<section class="sidebar-category photos">--}}
                {{--<h4>Top Photos</h4>--}}

                {{--<div class="grid-box sidebar-box">--}}
                    {{--<a href="#" class="overlay-tag top-left-corner number">1</a>--}}
                    {{--<div class="img-wrap">--}}
                        {{--<img class="img-responsive" src="/assets/images/dummies/img-small.jpg">--}}
                        {{--<a class="sidebar-social-counter like">31</a>--}}
                    {{--</div>--}}
                    {{--<h5><a href="#">4 Tier wood utility</a></h5>--}}
                {{--</div>--}}
            {{--</section>--}}

            {{--<section id="side-filters" class="side-filters pale-grey-bg pale-grey-border">--}}
            {{--<div>--}}
            {{--<h5>Ideas</h5>--}}
            {{--<input type="checkbox" name="dyi" id="dyi"> <label for="dyi"><span></span>DIY</label>--}}
            {{--<input type="checkbox" name="best-buys" id="best-buys"> <label for="best-buys"><span></span>Best Buys</label>--}}
            {{--<input type="checkbox" name="declutter" id="declutter"> <label for="declutter"><span></span>Declutter</label>--}}
            {{--</div>--}}
            {{--<div>--}}
            {{--<h5>Products</h5>--}}
            {{--<input type="checkbox" name="cheap" id="cheap"> <label for="cheap"><span></span>Under $50</label>--}}
            {{--<input type="checkbox" name="top" id="top"> <label for="top"><span></span>Top</label>--}}
            {{--<input type="checkbox" name="stuff" id="stuff"> <label for="stuff"><span></span>Stuff</label>--}}
            {{--</div>--}}
            {{--<div>--}}
            {{--<h5>Photos</h5>--}}
            {{--<input type="checkbox" name="hd" id="hd"> <label for="hd"><span></span>HD (1920px and above)</label>--}}
            {{--<input type="checkbox" name="md" id="md"> <label for="md"><span></span>MD (1920px and above)</label>--}}
            {{--<input type="checkbox" name="anysize" id="anysize"> <label for="anysize"><span></span>Any sizes</label>--}}
            {{--</div>--}}

            {{--</section>--}}
        {{--</aside>--}}
    {{--</div>--}}

@stop