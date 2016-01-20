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

        @foreach($content as $i => $item)
            @if(@$item->is_featured)
                <div class="grid-box-full">
            @elseif($i == 0 || ($i % 3) == 0)
                <div class="grid-box-3">
            @endif

                @if(!isset($item->type) || $item->type != 'product')

                        <div class="box-item">

                        @if($item->feed_image)
                             <img alt="{{$item->feed_image->alt}}" title="{{$item->feed_image->alt}}" src="{{$item->feed_image->url}}">
                        @else
                             <img src="{{$item->image}}">
                        @endif

                        <span class="box-item__time">{{$item->date}}</span>
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
                            <a href="{{$item->url}}" class="box-item__label">{{$item->title}}</a>
                            <div class="clearfix"></div>
                            <a href="{{$item->url}}" class="box-item__read-more">Read More</a>
                        </div>

                        <div class="box-item__author">
                            <a href="{{$item->authorlink}}" class="user-widget">
                                <img class="user-widget__img" src="{{$item->avator}}">
                                <span class="user-widget__name">{{$item->author}}</span>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="box-item">

                        <img src="{{$item->media_link}}" alt="{{$item->product_name}}"/>

                        <span class="box-item__time">{{$item->updated_at}}</span>
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
                            <a href="#" class="box-item__label box-item__label--clear">{{$item->product_name}}</a>
                            <div class="clearfix"></div>
                            <div class="merchant-widget">
                                <span class="merchant-widget__price">${{$item->price}}</span>
                                <span>from</span>
                                <img class="merchant-widget__store" src="/assets/images/dummies/amazon-black.png" />
                            </div>
                            <div class="clearfix"></div>
                            <a href="#" class="box-item__get-it">Get it</a>
                        </div>
                    </div>
                @endif

              @if(@$item->is_featured || ($i % 2) == 0)
                </div> {{--grid-box-full--}}
              @endif
        @endforeach

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


    </div>


@stop