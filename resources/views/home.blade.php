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

        @if($content['row-2'])
            <div class="grid-box-full">
                @foreach($content['row-2'] as $item)
                        @include('grid.idea')
                @endforeach
            </div>
        @endif

        <div class="grid-box-3">
            @foreach($content['row-3'] as $item)
                @if(!isset($item->type) || $item->type != 'product')
                    @include('grid.idea')
                @else
                    @include('grid.product')
                @endif
            @endforeach
        </div>

        @if($content['row-4'])
            <div class="grid-box-full">
                @foreach($content['row-4'] as $item)
                    @include('grid.idea')
                @endforeach
            </div>
        @endif

        <div class="grid-box-3">
            @foreach($content['row-5'] as $item)
                @if(!isset($item->type) || $item->type != 'product')
                    @include('grid.idea')
                @else
                    @include('grid.product')
                @endif
            @endforeach
        </div>

        @if($content['row-6'])
            <div class="grid-box-full">
                @foreach($content['row-6'] as $item)
                    @include('grid.idea')
                @endforeach
            </div>
        @endif


        </div>
@stop