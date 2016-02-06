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
            <ul class="hidden-620 left-nav pull-right col-md-2 col-sm-3">
                <!--                    <li><a class="home-link" href="#">Home</a></li>-->
                <li class="nested"><a href="#" class="all-link icon-link ">Browse all</a></li>
            </ul>
        </div>
    </nav>
<script>
jQuery(document).ready(function($) {
  $('#hero').royalSlider({
    arrowsNav: true,
    loop: false,
    keyboardNavEnabled: true,
    controlsInside: false,
    imageScaleMode: 'fit',
    arrowsNavAutoHide: false,
    controlNavigation: 'bullets',
    thumbsFitInViewport: false,
    navigateByClick: true,
    startSlideId: 0,
    autoPlay: false,
    transitionType:'move',
    globalCaption: false,
    deeplinking: {
      enabled: true,
      change: false
    },
    /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
    imgWidth: "100%",
  });
});
</script>
        <div id="hero" class="royalSlider heroSlider rsMinW room-hero">
        @if(isset($roomInformation['images']))
            @foreach( $roomInformation['images'] as $image )
            <div class="rsContent">
                @if(isset($roomInformation['images']))
                <div class="container-fluid fixed-sm full-480">
                    <div class="hero-tags">
                        @foreach($image['Image_Products'] as $i_products)
                        <div class="tag {{$i_products->product_color}}" style="left:{{$i_products->x}}%;top:{{$i_products->y}}%" >
                            <span></span>
                            <a class="{{$i_products->product_color}}-border" href="#">
                                <img src="{{$i_products->media_link}}" class="round" alt="" />
                            </a>
                           <div class="hover-box">
                               <h6>{{$i_products->product_name}}</h6>
                               <div>
                                   Get it from {{$i_products->price}}
                                   <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png">
                               </div>
                           </div>
                        </div>
                        @endforeach
                    </div>
                    <section class="hero-related-products col-md-4 pull-right hidden-620">
                        <h5 data-toggle="#related-list">Related Products</h5>
                        <ul id="related-list" class="hidden-soft">
                            @foreach($image['Image_Products'] as $i_products)
                            <li class="{{$i_products->product_color}}"><a class="{{$i_products->product_color}}-border" href="#"><img src="{{$i_products->media_link}}" class="round" alt="" /> {{$i_products->product_name}}</a> <a href="#" class="get solid pull-right">Get it</a></li>
                            @endforeach
                        </ul>
                    </section>
                </div>
                @endif
            <img class="rsImg" src="{{$image['Image']}}" alt="{{$image['Image_alt']}}">
            </div>
            @endforeach
        @endif
        </div>



    <main class="page-content">
        <div class="app-wrap" ng-app="pagingApp" ng-controller="pagingController">
            <nav id="hero-nav" class="col-sm-12">
                <div class="container full-620  fixed-sm">
                    <ul class="left-nav col-xs-1 hidden-620">
                        <li><a class="filter-link" href="#">Filter</a></li>
                    </ul>

                    <ul class="col-sm-4 pull-right popular-new">
                        <li class="pull-right">
                            <a href="#" class="box-link">Popular</a>
                        </li>
                        <li class="pull-right">
                            <a href="#" class="box-link active">Newest</a>
                        </li>
                    </ul>
                    <ul class="category-nav col-sm-6 pull-right">
                        <ul class="category-nav main-content-filter">
                            <li class="active">
                                <a ng-click="filterContent(null)" href="" data-filterby="all" class="all-link">
                                    <i class="m-icon--menu"></i>&nbsp;
                                    All
                                </a>
                            </li>
                            <li>
                                <a ng-click="filterContent('idea')" data-filterby="ideas" href="" class="ideas-link">
                                    <i class="m-icon m-icon--bulb"></i>
                                    Ideas
                                </a>
                            </li>
                            <li>
                                <a ng-click="filterContent('product')" data-filterby="products" href=""
                                   class="products-link">
                                    <i class="m-icon--item"></i>&nbsp;
                                    Products
                                </a>
                            </li>
                            <li>
                                <a data-filterby="photos" href="" class="photos-link">
                                    <i class=" m-icon--image"></i>&nbsp;
                                    Photos
                                </a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </nav>

            <div class="clearfix"></div>

            <div class="homepage-grid center-block" style="min-height:1000px">
                <div class="loader loader-abs" cg-busy="firstLoad"></div>
                <div class="loader loader-fixed" cg-busy="nextLoad"></div>

                @include('grid.grid')

            </div>
            <div class="container">
                <a ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12">Load More</a>
            </div>

        </div>

    </main>
<style>
#full-width-slider {
  width: 100%;
  color: #000;
}
</style>
    <script src="/assets/js/vendor/angular-busy.min.js"></script>
    <script src="/assets/js/angular-custom/custom.paging.js"></script>
@stop