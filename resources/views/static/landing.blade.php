@extends('layouts.main')

@section('content')
    <section id="hero" class="landing-hero">
        <nav id="mid-nav"  class="col-xs-12">
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
            <div class="col-sm-5 col-sm-offset-1 why-us">
                <h2>Ideas for Smarter Living</h2>

                <ul>
                    <li class="get-ideas">Get ideas for a smarter and sexier home</li>
                    <li class="share-vote">Share and Vote on the best theme decor</li>
                    <li class="shop-cool">Shop for cool gadgets and unique decor for the home</li>
                </ul>

                <a class="btn btn-success col-xs-8" href="#">Find out more</a>
            </div>
            <div class="col-sm-4 col-sm-offset-1 hero-box qiuck-signup">
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
                <li class="col-sm-4"><a class="home-link" href="">Home</a></li>

                <li class="col-sm-2"><a href="" class="all-link">All</a></li>
                <li class="col-sm-2"><a href="" class="ideas-link orange">Ideas</a></li>
                <li class="col-sm-2"><a href="" class="products-link green">Products</a></li>
                <li class="col-sm-2"><a href="" class="photos-link blue">Photos</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <section class="main-content landing">

            <ul class="layout-control">
               <li>List</li>
               <li>Grid</li>
            </ul>

            <a class="home-link">Home</a>

            <div class="col-md-6">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top product"></a>
                    <a href="#" class="overlay-tag bottom">Get it</a>
                    <a href="#" class="social-pic likes">123</a>
                    <a href="#" class="social-pic comment">Comment</a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>

            <div class="col-md-6">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top product"></a>
                    <a href="#" class="overlay-tag bottom">Get it</a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>

            <div class="col-md-12">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top idea"></a>
                    <a href="#" class="overlay-tag bottom"><img class="author-pic"></a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>

            <div class="col-md-12">
                <h6><a href="#">550.230 Kitchen Design Photos</a></h6>
                <p>

                </p>
                <a class="btn btn-success" href="#">Upload a photo</a>
            </div>

            <div class="col-md-6">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top product"></a>
                    <a href="#" class="overlay-tag bottom">Get it</a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>

            <div class="col-md-6">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top product"></a>
                    <a href="#" class="overlay-tag bottom">Get it</a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>

            <div class="col-md-12">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top idea"></a>
                    <a href="#" class="overlay-tag bottom"><img class="author-pic"></a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>


            <div class="col-md-6">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top product"></a>
                    <a href="#" class="overlay-tag bottom">Get it</a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>


            <div class="col-md-6">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top product"></a>
                    <a href="#" class="overlay-tag bottom">Get it</a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>


            <div class="col-md-6">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top product"></a>
                    <a href="#" class="overlay-tag bottom">Get it</a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>

            <div class="col-md-6">
                <div>
                    <img src="">
                    <a href="#" class="overlay-tag top product"></a>
                    <a href="#" class="overlay-tag bottom">Get it</a>
                </div>
                <h5><a href="#">Venetian Louge Suite</a></h5>
                <ul class="box-tags">
                    <li><a>Products</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                    <li><a>Imptovrments</a></li>
                </ul>
            </div>

            <a class="btn btn-success">Load More</a>

        </section>

        <aside class="col-md-2">
            <section id="side-filters">
                <div>
                    <b>Ideas</b>
                    <label><input type="checkbox">DIY</label>
                    <label><input type="checkbox">Best Buys</label>
                    <label><input type="checkbox">Declutter</label>
                </div>
                <div>
                    <b>Products</b>
                    <label><input type="checkbox">DIY</label>
                    <label><input type="checkbox">Best Buys</label>
                    <label><input type="checkbox">Declutter</label>
                </div>
                <div>
                    <b>Photos</b>
                    <label><input type="checkbox">DIY</label>
                    <label><input type="checkbox">Best Buys</label>
                    <label><input type="checkbox">Declutter</label>
                </div>

                <a class="btn btn-success">Apply Filters</a>
                <a class="btn btn-default">Cancel</a>

                <div>
                    <div class="image-wrapper">
                        <img src="">
                        <a href="#" class="overlay-tag top-left-corner number">1</a>
                    </div>
                    <h5><a href="#">Venetian Louge Suite</a></h5>
                    <ul class="box-tags">
                        <li><a>Products</a></li>
                    </ul>
                    <a href="sidebard-social-counter like">+31</a>
                </div>
            </section>
        </aside>
    </div>

    <button id="back-to-top">Back to top</button>

@stop