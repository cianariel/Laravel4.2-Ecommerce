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
            @foreach($content['row-1'] as $item)
                @if(!isset($item->type) || $item->type != 'product')
                    @include('grid.idea')
                @else
                    @include('grid.product')
                @endif
            @endforeach
        </div>

        <div class="grid-box-3">
            @foreach($content['row-3'] as $item)
                @if(!isset($item->type) || $item->type != 'product')
                    @include('grid.idea')
                @else
                    @include('grid.product')
                @endif
            @endforeach
        </div>

        <div class="grid-box-full">
            <div class="box-item box-item--featured">

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

        <div class="grid-box-3">
            @foreach($content['row-5'] as $item)
                @if(!isset($item->type) || $item->type != 'product')
                    @include('grid.idea')
                @else
                    @include('grid.product')
                @endif
            @endforeach
        </div>

        <div class="grid-box-full">
            <div class="box-item box-item--featured">

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
    </div>


@stop