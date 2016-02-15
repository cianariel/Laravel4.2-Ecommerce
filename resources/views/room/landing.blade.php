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

    
    <nav class="mid-nav hidden-xs">
        <div class="container full-sm fixed-sm">
<!--            <ul class=" col-sm-offset-1 col-sm-9">-->
            <ul class=" wrap col-xs-9">
                <li class="home">
                    <span class="box-link-active-line"></span>
                    <a href=""><i class="m-icon m-icon--smart-home"></i> Smart Home</a>
                </li>

                <li><a @if($roomInformation['Permalink'] == 'kitchen') class="active" @endif href="{{url('room/kitchen')}}">Kitchen</a></li>
                <li><a @if($roomInformation['Permalink'] == 'bath') class="active" @endif href="{{url('room/bath')}}">Bath</a></li>
                <li><a @if($roomInformation['Permalink'] == 'bedroom') class="active" @endif href="{{url('room/bedroom')}}">Bedroom</a></li>
                <li><a @if($roomInformation['Permalink'] == 'office') class="active" @endif href="{{url('room/office')}}">Office</a></li>
                <li><a @if($roomInformation['Permalink'] == 'living') class="active" @endif href="{{url('room/living')}}">Living</a></li>
                <li><a @if($roomInformation['Permalink'] == 'outdoor') class="active" @endif href="{{url('room/outdoor')}}">Outdoor</a></li>
                <li><a @if($roomInformation['Permalink'] == 'lighting') class="active" @endif href="{{url('room/lighting')}}">Lighting</a></li>
                <li><a @if($roomInformation['Permalink'] == 'decor') class="active" @endif href="{{url('room/decor')}}">Decor</a></li>
                <!--<li><a data-toggle=".extra-nav" class="more-link extra" href="">...</a>
                    <ul class="extra-nav hidden-620 hidden-soft">
                        <li><a class="travel-link blue" href="#">Travel</a></li>
                        <li><a class="wearables-link green" href="#">Wearables</a></li>
                    </ul>
                </li>-->

            </ul>
<!--            <div class="hidden-xs col-sm-2">-->
            <div class="hide">
                <ul class="pull-right"> 
                    <li class="nested">
                        <a id="browse-all" href="#" class="" data-toggle=".shop-menu"><i class="m-icon m-icon--menu"></i>&nbsp; Browse all</a>
                    </li>
            </ul>
        </div>

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
    navigateByClick: false,
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
    imageScaleMode: "fill",
    autoScaleSliderWidth: 1500,
    autoScaleSliderHeight: 500,
    autoScaleSlider: true
  });
});
</script>

<div id="pagingApp" ng-app="pagingApp" ng-controller="pagingController">
    <div id="hero" class="royalSlider heroSlider rsMinW room-hero slider">
        @if(isset($roomInformation['images']))
            @foreach( $roomInformation['images'] as $key => $image )
            <div class="rsContent">
<!--                <div class="rsInnerContent">-->
                @if(isset($roomInformation['images']))
                <div class="container-fluid fixed-sm full-480">
                    <div class="hero-tags">
                        @foreach($image['Image_Products'] as $i_products)
                        <div class="tag {{$i_products->product_color}}" style="left:{{$i_products->x}}%;top:{{$i_products->y}}%" >
                            <span class="tag-icon"><i class="m-icon--shopping-bag-light-green"></i> </span>
                            <a class="{{$i_products->product_color}}-border" href="/product/{{$i_products->product_permalink}}">
                                <img src="{{$i_products->media_link}}" class="round" alt="" />
                            </a>
                           <div class="hover-box">
                               <h6>{{$i_products->product_name}}</h6>
                               <div>
                                   <a href="{{$i_products->affiliate_link}}">Get it</a> from {{$i_products->sale_price}}
                                   <a href="{{$i_products->affiliate_link}}"> <img class="vendor-logo" alt="{{ $i_products->store['Description'] }}" src="{{ $i_products->store['ThumbnailPath'] }}"></a>
                               </div>
                           </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <img class="rsImg" src="{{$image['Image']}}" alt="{{$image['Image_alt']}}">
<!--                <img class="rsImg" src="http://10.0.1.101/1.jpg" alt="{{$image['Image_alt']}}">-->

<!--                </div>-->
                <span ng-click="open({{$key}})" class="room-related-product-button" ><i class="m-icon--Add-Active"></i></span>

                <script type="text/ng-template" id="room-related-product-{{$key}}.html">
                    <div class="modal-header">
                        <h3 data-toggle="#related-list">Related Products</h3>
                        <a class=" box-item__get-it" href="#" ng-click="cancel()"><i class="m-icon--Close"></i></a>
                    </div>
                    <div class="modal-body">
                        <section class="hero-related-products ">
                            <ul  >
                            @foreach($image['Image_Products'] as $i_products)
                                    <li class="{{$i_products->product_color}}">
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-10">
                                                <a class="{{$i_products->product_color}}-border " href="/product/{{$i_products->product_permalink}}">
                                                    <span class="img-holder">
                                                        <img src="{{$i_products->media_link}}" class="round" alt="" />
                                                    </span>
                                                    <span class="name-holder">
                                                        {{$i_products->product_name}}
                                                    </span>
                                                </a> 
                                            </div>
                                            <div class="col-xs-4 col-sm-2">
                                                <a href="{{$i_products->affiliate_link}}" class="get solid pull-right ">Get it</a>
                                            </div>
                                        </div>
                                    </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
                </script>

            </div>
            @endforeach
        @endif
        </div>


    <!--<nav id="hero-nav" class="col-sm-12">
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
    </nav>-->

    <main class="page-content">
        <div class="app-wrap" >
            <nav id="hero-nav" class="col-sm-12">
                <div class="container">
                    <div class="col-lg-12 hidden-lg">
                        <ul class="popular-new text-center">
                        <li class="">
                            <a href="#" class="box-link active">Newest</a>
                        </li>
                        <li class="">
                            <a href="#" class="box-link ">Popular</a>
                        </li>
                    </ul>
                    </div>

                    <div class="col-lg-offset-3 col-lg-6">
                        <div class="row">
                        <ul class="category-nav main-content-filter ">
                        <li class="active">
                            <a ng-click="filterContent(null)" href="" data-filterby="all" class="all-link">
                                        <i class="m-icon m-icon--menu"></i>
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
                                        <i class="m-icon m-icon--item"></i>
                                Products
                            </a>
                        </li>
                        <li>
                            <a data-filterby="photos" href="" class="photos-link">
                                        <i class="m-icon m-icon--image"></i>
                                Photos
                            </a>
                        </li>
                    </ul>
                    </div>
                    </div>
                    <div class="col-lg-3 visible-lg">
                        <ul class="popular-new ">
                            <li class="">
                                <a href="#" class="box-link active">Newest</a>
                            </li>
                            <li class="">
                                <a href="#" class="box-link ">Popular</a>
                            </li>
                        </ul>
                    </div>
                    
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

            <!-- custom angular template - START -->

            <script type="text/ng-template" id="product-popup.html">
                <div class="lbMain">
                    <div class="lbImageContainer">
                        <div id="product-slider" class="product-slider slider">
                            <div>
                                <img
                                        src="http://s3-us-west-1.amazonaws.com/ideaing-01/product-56b246ce6326f-dvx-at100-1.jpg"
                                        class="attachment-large wp-post-image"
                                        alt=""/>
                            </div>
                            <div>
                                <img
                                        src="http://s3-us-west-1.amazonaws.com/ideaing-01/product-56b246ce6326f-dvx-at100-1.jpg"
                                        class="attachment-large wp-post-image"
                                        alt=""/>
                            </div>
                        </div>
                    </div>
                    <div class="lbInfo">
                        <a class="close" href="#" ng-click="cancel()"><i class="m-icon--Close"></i> </a>
                        <div class="row">
                            <div class="col-xs-12">
                                <ul class="p-category-holder">
                                    <li>
                                        <a class="active p-category" href="#">
                                            <i class="m-icon m-icon--features-c1"></i><br>
                                            <span>Features</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="p-category" href="#">
                                            <i class="m-icon m-icon--specs"></i><br>
                                            <span>Specs</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="p-category" href="#">
                                            <i class="m-icon  m-icon--comparisons"></i><br>
                                            <span>Comparisons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="p-category" href="#">
                                            <i class="m-icon m-icon--reviews"></i><br>
                                            <span>Reviews</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 ideaing-score-holder">
                                <div class="p-average-ideaing-score">
                                    <i class="m-icon--bulb-detailed-on-rating"></i> <span class="p-score">98%</span><br>
                                    <span>Average Ideaing Score</span>
                                </div>
                                <div class="pull-left p-nest-protect">
                                    <p class="p-title">Nest Protect (second generation)</p>
                                    <ul class="">
                                        <li>
                                            <i class="m-icon m-icon--alert"></i> GetAlerts
                                        </li>
                                        <li>
                                            <i class="m-icon m-icon--shares-active"></i> 99
                                        </li>
                                        <li>
                                            <i class="m-icon m-icon--heart2"></i> 768
                                        </li>
                                        <li>
                                            <i class="m-icon m-icon--discuss"></i> 1.2K
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-12 p-get-it-holder">
                                <div class="p-get-it-amazon">
                                    <div class="p-body">
                                        <a class="get-round" href="http://www.dxv.com/product/at100-electronic-luxury-bidet-seat-by-dxv" target="_blank">Get it</a>
                                        <img src="/assets/images/dummies/amazon-2.png">

                                    </div>
                                    <div class="p-footer">
                                        From $375.00 <i class=" m-icon--Right-Arrow-Active"></i>
                                    </div>
                                </div>
                                <div class="pull-left p-get-it-right">
                                    <div class="col-xs-12">
                                        <div class="p-row">
                                            <span class="pull-left">Ctrutchfleld</span>
                                            <div class="p-horizontal-line"></div>
                                            <span class="pull-right"><button class="btn p-btn-get-it">$500.00</button></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="p-row">
                                            <div class="p-horizontal-line"></div>
                                            <span class="pull-left">Amazon</span>
                                            <span class="pull-right"><button class="btn p-btn-get-it">$500.00</button></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="p-row">
                                            <div class="p-horizontal-line"></div>
                                            <span class="pull-left">Bose</span>
                                            <span class="pull-right"><button class="btn p-btn-get-it">$500.00</button></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 p-row-group">
                                <ul class="share-buttons hidden-xs col-lg-7 col-md-8 pull-right">
                                    <li class="all-shares"><b>120K </b>all shares</li>
                                    <li><a class="fb" href="#"><i class="m-icon m-icon--facebook-id"></i><b>189</b></a></li>
                                    <li><a class="twi" href="#"><i class="m-icon  m-icon--twitter-id"></i><b>189</b></a></li>
                                    <li><a class="gp" href="#"><i class="m-icon m-icon--google-plus-id"></i><b>189</b></a></li>
                                    <li><a class="pint" href="#"><i class="m-icon  m-icon--pinterest-id"></i><b>189</b></a></li>
                                    <li><a class="comment" data-scrollto=".comments" href="#"><i class="m-icon m-icon--comments-id"></i><b>189</b></a></li>
                                </ul>
                            </div>

                            <div class="col-xs-12 p-row-group">
                                <div class="p-row-inner">
                                    <p>Nest Labs apparently loves a good challenge. Its ability to transform a real boring, utilitarian household products into smart devices beaustiful enough make a desing giant like Yves we(I imagine) is an incredible feat. And yet. Nest's original Protect smoke and carbon monoxide (CO)</p>
                                    <p><a href="#" class="p-read-more">Read more <i class=" m-icon--Actions-Down-Arrow-Active"></i></a></p>
                                </div>
                            </div>

                            <!-- div class="col-xs-12 p-row-group">
                                <div class="p-row-inner specification-container">
                                    <p class="specification-title">Specifications</p>
                                    <p>Nest Cam and IFTTT, this $99 detector is the best connected one we've seen yet. Nest Cam and IFTTT, this $99 Nest Cam and IFTTT, this $99 dectector is the best connected one we've seen yet. If you already have a first-gen Nest Protect. I'd skip this upgrade, but I strongly recommend the</p>
                                    <p><a href="#" class="p-read-more">Read more <i class=" m-icon--Actions-Down-Arrow-Active"></i></a></p>
                                    <br>
                                    <p class="comparisons-title">Comparisons</p>

                                </div>
                            </div -->

                            <div class="col-xs-12 p-row-group">
                                <div class="p-row-inner p-reviews-holder">
                                    <br><br>
                                    <p class="p-reviews-title">Reviews(4)</p>
                                    <br><br>
                                    <div class="reviews-medium-container">
                                        <div class="">
                                            <div class=" col-xs-12">
                                                <div class="average-score block-center">
                                                    <div class="score">
                                                        <i class=" m-icon--bulb-detailed-on-rating"></i>
                                                        0
                                                        %
                                                    </div>
                                                    <span class="caption">Average Ideaing Score</span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 text-center reviews-service-holder critic">
                                                <div class="vertical-line "></div>
                                                <div class="title">Critic</div>
                                                <div class="reviews">Reviews</div>

                                                <div class="star-raiting" style="text-align: center">
                                                    <?php
                                                    $stars = 4.5;
                                                    $fStar = floor($stars);
                                                    $cStar = ceil($stars);
                                                    $halfStar = -1;
                                                    if ($fStar == $cStar)
                                                        $halfStar = $cStar;

                                                    for($i=1; $i<=5; $i++){
                                                        if($i <= $fStar){
                                                            echo '
                                                            <span class="star active">
                                                                <i class="m-icon--star-blue-full"></i>
                                                            </span>
                                                            ';
                                                        }elseif($cStar == $i){
                                                            echo
                                                            '<span class="star half">
                                                                <i class=" m-icon--star-blue-half2"></i>
                                                            </span>
                                                            ';
                                                        }else{
                                                            echo
                                                            '<span class="star">
                                                                <i class=" m-icon--star-blue-full-lines"></i>
                                                            </span>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <p style="color: black" class="text-center">
                                                    0
                                                <span class="light-black">
                                                    Review
                                                </span>
                                                </p>
                                            </div>
                                            <div class="col-xs-6 text-center reviews-service-holder amazon">
                                                <div class="vertical-line"></div>
                                                <div class="title"><a style="color: #00b1ff;" href="" target="_blank">Amazon</a></div>
                                                <div class="reviews">Reviews</div>
                                                <div class="star-raiting" style="text-align: center">
                                                    <?php
                                                    $stars = 3.3;
                                                    $fStar = floor($stars);
                                                    $cStar = ceil($stars);
                                                    $halfStar = -1;
                                                    if ($fStar == $cStar)
                                                        $halfStar = $cStar;

                                                    for($i=1; $i<=5; $i++){
                                                        if($i <= $fStar){
                                                            echo '
                                                            <span class="star active">
                                                                <i class="m-icon--star-blue-full"></i>
                                                            </span>
                                                            ';
                                                        }elseif($cStar == $i){
                                                            echo
                                                            '<span class="star half">
                                                                <i class=" m-icon--star-blue-half2"></i>
                                                            </span>
                                                            ';
                                                        }else{
                                                            echo
                                                            '<span class="star">
                                                                <i class=" m-icon--star-blue-full-lines"></i>
                                                            </span>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <p style="color: black" class="text-center">
                                                    <a href="" target="_blank">
                                                        1
                                                    <span class="light-black">
                                                        Review
                                                    </span>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="critic-quote">
                                        <div>
                                            <p>It's the perfect balance of comfort and support without any annoying 'quicksand' feel<br><br>-&nbsp;<span class="author vcard"><span class="fn">Sean Fry,&nbsp;http://www.sleepinglikealog.com</span></span><!--EndFragment--><br><br></p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12 p-row-group">
                                <div class="p-row-inner p-comment-holder">
                                    <br>
                                    <div>
                                        <p class="p-comments-title pull-left">Comments<span class="p-responses"> (211 responses)</span></p>
                                        <span class="pull-right p-favorite"><i class="m-icon--heart-id"></i> 2,349</span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <br><br>
                                    <div class="p-comment-row">
                                        <div class="pull-left">
                                            <img src="/assets/images/dummies/author.png" width="50px" class="p-photo">
                                        </div>
                                        <div class="p-comment">
                                            <p>We very much enjoyed our summer stay at this incline Village condo. Very comfortable, had all thenecessites and a very responsive host. The location was great - close to bike paths, recreation center and beached. Recommended!</p>
                                            <div class="p-footer">
                                                <span class="p-time pull-left">August 2015</span>
                                                <button class="pull-right btn btn-helpful"><i class="m-icon--heart"></i> Helpful</button>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-comment-row">
                                        <div class="pull-left">
                                            <img src="/assets/images/dummies/author.png" width="50px" class="p-photo">
                                        </div>
                                        <div class="p-comment">
                                            <p>We very much enjoyed our summer stay at this incline Village condo. Very comfortable, had all thenecessites and a very responsive host. The location was great - close to bike paths, recreation center and beached. Recommended!</p>
                                            <div class="p-footer">
                                                <span class="p-time pull-left">August 2015</span>
                                                <button class="pull-right btn btn-helpful"><i class="m-icon--heart"></i> Helpful</button>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 p-row-group">
                                <div class="p-row-inner p-comment-holder p-add-comment">
                                    <div class="p-comment-row">
                                        <div class="pull-left">
                                            <img src="/assets/images/dummies/author.png" width="50px" class="p-photo">
                                        </div>
                                        <div class="p-comment-box-holder">
                                            <div>
                                                <textarea id="comment-content" class="form-control" placeholder="What are you working on..."></textarea>
                                            </div>
                                            <div class="text-right p-footer">
                                                <i class="m-icon--camera"></i> &nbsp; Add a photo &nbsp; <button class="btn btn-primary">Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </script>

            <!-- custom angular template - END -->
        </div>

    </main>
</div>
<style>
#full-width-slider {
  width: 100%;
  color: #000;
}
</style>
 
@stop