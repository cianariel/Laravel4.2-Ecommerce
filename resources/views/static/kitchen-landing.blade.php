@extends('layouts.main')

@section('body-class'){{ 'room-landing kitchen-landing' }}@stop

@section('content')
    {{--<header class="story-header hidden-620 hidden-soft" >--}}
        {{--<a href="#" class="side-logo lamp-logo">--}}
        {{--</a>--}}
        {{--<h1>Nest Protect (Second Generation)</h1>--}}

        {{--<ul class="social-rounds hidden-sm hidden-xs pull-right">--}}
            {{--<li><a class="fb" href="#"></a></li>--}}
            {{--<li><a class="twi" href="#"></a></li>--}}
            {{--<li><a class="gp" href="#"></a></li>--}}
            {{--<li><a class="pint" href="#"></a></li>--}}
        {{--</ul>--}}

        {{--<ul class="like-nav hidden-xs pull-right pull-right">--}}
            {{--<li><a class="like-counter" href="#"><span></span><b>189</b></a></li>--}}
        {{--</ul>--}}

        {{--<div class="icon-wrap pull-right">--}}
            {{--<div class="get solid">Get it</div>--}}
            {{--<img class="vendor-logo" src="/assets/images/dummies/amazon-black.png">--}}
            {{--<b class="price">$199</b>--}}
        {{--</div>--}}
    {{--</header>--}}

    <nav class="mid-nav hidden-620">
        <div class="container">
            <ul class="left-nav col-xs-2 hidden-620">
                <!--                    <li><a class="home-link" href="#">Home</a></li>-->
                <li><a href="#" class="pink kitchen-link icon-link">Kitchen</a></li>
            </ul>
            <ul class="hidden-620 left-nav pull-right col-xs-2">
                <!--                    <li><a class="home-link" href="#">Home</a></li>-->
                <li class="nested"><a href="#" class="all-link icon-link ">Browse all</a></li>
            </ul>
        </div>
    </nav>

    <section id="hero" class="room-hero">
        <div class="hero-background" style="background-image: url('/assets/images/room-landing-hero.jpg')"></div>
        {{--<div class="color-overlay"></div>--}}

        <div class="container fixed-sm full-480">
            <div class="hero-tags">
                <div class="tag one red" >
                    <span></span>
                    <a class="pink-border" href="#">
                        <img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" />
                    </a>
                   <div class="hover-box">
                       <h6>Glow Lamps (Multi-colored)</h6>
                       <div>
                           Get it from $560
                           <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png">
                       </div>
                   </div>
                </div>
                <div class="tag two blue">
                    <span ></span>
                    <a class="pink-border" href="#">
                        <img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" />
                    </a>
                   <div class="hover-box">
                       <h6>Glow Lamps (Multi-colored)</h6>
                       <div>
                           Get it from $560
                           <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png">
                       </div>
                   </div>
                </div>
                <div class="tag three green">
                    <span></span>
                    <a class="pink-border" href="#">
                        <img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" />
                    </a>
                   <div class="hover-box">
                       <h6>Glow Lamps (Multi-colored)</h6>
                       <div>
                           Get it from $560
                           <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png">
                       </div>
                   </div>
                </div>
                {{--<div class="tag four">--}}
                    {{--<span class="blue"></span>--}}
                    {{--<a class="pink-border" href="#">--}}
                        {{--<img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" />--}}
                    {{--</a>--}}
                   {{--<div class="hover-box">--}}
                       {{--<h6>Glow Lamps (Multi-colored)</h6>--}}
                       {{--Get it from $560--}}
                       {{--<img class="vendor-logo" src="/assets/images/dummies/amazon-2.png">--}}
                   {{--</div>--}}
                {{--</div>--}}
            </div>
            <section class="hero-related-products col-md-4 pull-right ">
                    <h5>Related Products</h5>
                <ul>
                    <li class="pink"><a class="pink-border" href="#"><img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" /> Steam pot</a> <a href="#" class="get solid pull-right">Get it</a></li>
                    <li class="red"><a class="red-border" href="#"><img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" /> Steam pot</a> <a href="#" class="get solid pull-right">Get it</a></li>
                    <li class="blue"><a class="blue-border" href="#"><img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" /> Steam pot</a> <a href="#" class="get solid pull-right">Get it</a></li>
                    <li class="orange"><a class="orange-border" href="#"><img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" /> Steam pot</a> <a href="#" class="get solid pull-right">Get it</a></li>
                    <li class="green"><a class="green-border" href="#"><img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" /> Steam pot</a> <a href="#" class="get solid pull-right">Get it</a></li>
                    <li class="yellow"><a class="yellow-border" href="#"><img src="/assets/images/dummies/box-image-dummy.png" class="round" alt="" /> Steam pot</a> <a href="#" class="get solid pull-right">Get it</a></li>
                </ul>
            </section>
        </div>
    </section>

    <nav id="hero-nav" class="col-sm-12">
        <div class="container full-620  fixed-sm">
            {{--<ul class="left-nav col-xs-1 hidden-620">--}}
            {{--<li class="active"><a class="home-link" href="#">Home</a></li>--}}
            {{--</ul>--}}

            <ul class="col-sm-4 pull-right">
                <li class="pull-right">
                    <a href="#" class="box-link">Newest</a>
                </li>
                <li class="pull-right">
                    <a href="#" class="box-link">Popular</a>
                </li>
            </ul>
            <ul class="category-nav col-sm-5 pull-right">
                <li><a href="" class="all-link">All</a></li>
                <li><a href="" class="ideas-link">Ideas</a></li>
                <li><a href="" class="products-link">Products</a></li>
                <li><a href="" class="photos-link">Photos</a></li>
            </ul>
        </div>
    </nav>

    <main class="page-content">
        <div class="container">
            <div class="box-container">
                <div class="grid-box square not-rounded product-box col-xs-4 full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="/assets/images/dummies/webcam-square.jpg">

                        <div class="like-wrap">
                            <a href="#" class="social-pic likes">157</a>
                            <a href="#" class="social-pic comment">157</a>
                        </div>
                        <a href="#" class="overlay-tag category-tag top idea">Idea</a>
                        <h4><a href="#">10 Ideas for Gorgeous Kitchens</a></h4>
                        {{--<b>In wooden Kitchen styles</b>--}}
                    </div>
                    <a href="#" class="overlay-tag bottom author" style="background-image: url('/assets/images/dummies/author.png')">Author Name Here</a>

                    <time>Posted 5 hours ago</time>
                </div>
                <div class="grid-box square not-rounded product-box product col-xs-4 full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="/assets/images/dummies/webcam-square.jpg">

                        <div class="like-wrap">
                            <a href="#" class="social-pic likes">157</a>
                        </div>
                        <a href="#" class="overlay-tag category-tag top product">Product</a>
                    </div>
                    <time>Posted 5 hours ago</time>

                    <div class="color-overlay">
                        <h4><a href="#">The Awesome Webcam</a></h4>
                        <ul class="prices">
                                <li>
                                    <a href="#"><b>$35.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>
                                </li>
                                <li>
                                    <a href="#"><b>$39.50.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>
                                </li>
                                <li>
                                    <a href="#"><b>$41.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>
                                </li>
                            </ul>

                        </div>
                </div>
                <div class="grid-box square not-rounded product-box col-xs-4 full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="/assets/images/dummies/webcam-square.jpg">

                        <div class="like-wrap">
                            <a href="#" class="social-pic likes">157</a>
                            <a href="#" class="social-pic comment">157</a>
                        </div>
                        <a href="#" class="overlay-tag category-tag top idea">Idea</a>
                        <h4><a href="#">10 Ideas for Gorgeous Kitchens</a></h4>
                        {{--<b>In wooden Kitchen styles</b>--}}
                    </div>
                    <a href="#" class="overlay-tag bottom author" style="background-image: url('/assets/images/dummies/author.png')">Author Name Here</a>

                    <time>Posted 5 hours ago</time>
                </div>
                <div class="grid-box square not-rounded product-box huge col-xs-12 full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="/assets/images/dummies/clock.png">

                        <div class="like-wrap">
                            <a href="#" class="social-pic likes">157</a>
                        </div>
                        <a href="#" class="overlay-tag category-tag top idea">Idea</a>
                        <h4><a href="#">10 Ideas for Gorgeous Kitchens</a></h4>
                    </div>
                    <time>Posted 5 hours ago</time>

                    {{--<div class="color-overlay">--}}
                        {{--<h4><a href="#">The Awesome Webcam</a></h4>--}}
                        {{--<ul class="prices">--}}
                                {{--<li>--}}
                                    {{--<a href="#"><b>$35.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#"><b>$39.50.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#"><b>$41.00</b> from  <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png"></a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}

                        {{--</div>--}}
                </div>
            </div>
            <div class="col-xs-12 grid-insert">
                <h4><a href="#">620.325 Awesome Products to Buy</a></h4>
                <p>
                    Charming, fully furnished Upper Castro apartment features high-end open kitchen, luxurious bath. Charming, fully furnished Upper Castro apartment features high-end open kitchen.
                </p>
                <a class="btn btn-success" href="#">Upload a photo</a>
            </div>

            <a class="btn btn-success bottom-load-more col-xs-12">Load More</a>
        </div>

    </main>

@stop