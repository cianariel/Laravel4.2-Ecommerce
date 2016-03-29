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
            {{--<img class="vendor-logo" src="<?php echo env('ASSETS_CDN') ?>/images/dummies/amazon-black.png">--}}
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
                                   <img class="vendor-logo" src="<?php echo env('ASSETS_CDN') ?>/images/dummies/amazon-black.png">
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
                <div class="grid-box square not-rounded idea-box col-xs-4 full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="<?php echo env('ASSETS_CDN') ?>/images/dummies/webcam-square.jpg">

                        <div class="like-wrap">
                            <a href="#" class="social-pic likes">157</a>
                            <a href="#" class="social-pic comment">157</a>
                        </div>
                        <a href="#" class="overlay-tag category-tag top idea">Idea</a>
                        <h4><a href="#">10 Ideas for Gorgeous Kitchens</a></h4>
                        {{--<b>In wooden Kitchen styles</b>--}}
                    </div>
                    <a href="#" class="overlay-tag bottom author" style="background-image: url('<?php echo env('ASSETS_CDN') ?>/images/dummies/author.png')"><span>Bob Barbarian</span></a>

                    <time>Posted 5 hours ago</time>

                    <div class="color-overlay">

                        <a href="#" class="box-link">
                            Read More
                        </a>

                    </div>
                </div>
                <div class="grid-box square not-rounded product-box product col-xs-4 full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="<?php echo env('ASSETS_CDN') ?>/images/dummies/webcam-square.jpg">

                        <div class="like-wrap">
                            <a href="#" class="social-pic likes">157</a>
                        </div>
                        <a href="#" class="overlay-tag category-tag top product">Product</a>
                        <a class="category-tag get-round hidden-soft">
                            Get it
                        </a>
                    </div>
                    <time>Posted 5 hours ago</time>

                    <div class="color-overlay">
                        <h4><a href="#">The Awesome Webcam</a></h4>
                        <ul class="prices">
                                <li>
                                    <a href="#"><b>$35.00</b> from  <img class="vendor-logo" src="<?php echo env('ASSETS_CDN') ?>/images/dummies/amazon-black.png"></a>
                                </li>

                            </ul>

                    </div>
                </div>
                <div class="grid-box square not-rounded idea-box col-xs-4 full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="<?php echo env('ASSETS_CDN') ?>/images/dummies/webcam-square.jpg">

                        <div class="like-wrap">
                            <a href="#" class="social-pic likes">157</a>
                            <a href="#" class="social-pic comment">157</a>
                        </div>
                        <a href="#" class="overlay-tag category-tag top idea">Idea</a>
                        <h4><a href="#">10 Ideas for Gorgeous Kitchens</a></h4>
                        {{--<b>In wooden Kitchen styles</b>--}}
                    </div>
                    <a href="#" class="overlay-tag bottom author" style="background-image: url('<?php echo env('ASSETS_CDN') ?>/images/dummies/author.png')"><span>Bob Barbarian</span></a>

                    <time>Posted 5 hours ago</time>
                    <div class="color-overlay">

                        <a href="#" class="box-link">
                            Read More
                        </a>

                    </div>
                </div>
                <div class="grid-box square not-rounded idea-box huge col-xs-12 full-620">
                    <div class="img-wrap">
                        <img class="img-responsive" src="<?php echo env('ASSETS_CDN') ?>/images/dummies/clock.png">

                        <div class="like-wrap">
                            <a href="#" class="social-pic likes">157</a>
                            <a href="#" class="social-pic comment">200</a>
                        </div>
                        <a href="#" class="overlay-tag category-tag top idea">Idea</a>
                        <h4><a href="#">10 Ideas for Gorgeous Kitchens</a></h4>
                    </div>
                    <a href="#" class="overlay-tag bottom author" style="background-image: url('<?php echo env('ASSETS_CDN') ?>/images/dummies/author.png')"><span>Bob Barbarian</span></a>

                    <time>Posted 5 hours ago</time>
                    <a href="#" class="overlay-tag bottom featured-badge big">
                        Featured
                    </a>
                    <div class="color-overlay">

                        <a href="#" class="box-link">
                            Read More
                        </a>

                    </div>
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

            <aside class="room-filter">
                <ul class="extra-nav hidden-620">
                    <li><a class="diy-link pink" href="#">DYI</a></li>
                    <li><a class="shopping-link green" href="#">Shopping</a></li>
                    <li><a class="travel-link blue" href="#">Travel</a></li>
                    <li><a class="wearables-link brown" href="#">Wearables</a></li>
                    <li><a class="decor-link green" href="#">Home and Decor</a></li>
                </ul>

                <ul class="room-list">
                    <li>
                        <a href="#">Kitchen and Dining</a>
                    </li>
                    <li>
                        <a href="#">Furniture</a>
                    </li>
                    <li>
                        <a href="#">Bedding</a>
                    </li>
                    <li>
                        <a href="#">Bath</a>
                    </li>
                    <li>
                        <a href="#">Decor</a>
                    </li>
                    <li>
                        <a href="#">Office</a>
                    </li>
                    <li>
                        <a href="#">Storage</a>
                    </li>
                    <li>
                        <a href="#">Outdoor</a>
                    </li>
                </ul>

                <ul class="sortby">
                    <li>Popularity</li>
                </ul>

                <h6 class="gift">Gift ideas</h6>
                <ul class="for">
                    <li>For Her</li>
                    <li>For Him</li>
                    <li>For Kids</li>
                    <li>For Pets</li>
                    <li>For the Techie</li>
                    <li>For the Traveler</li>
                    <li>For the Decorator</li>
                    <li>Stocking Suffers</li>
                </ul>
            </aside>
        </div>

    </main>
<style>
#full-width-slider {
  width: 100%;
  color: #000;
}
</style>
@stop