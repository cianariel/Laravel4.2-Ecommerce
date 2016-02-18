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

    
    <!--<nav class="mid-nav hidden-xs">
        <div class="container full-sm fixed-sm">
            <ul class=" wrap col-xs-9">
                <li class="home box-link">
                    <a class="box-link" href="">
                    <span class="box-link-active-line"></span>
                        <i class="m-icon m-icon--smart-home"></i> Smart Home
                    </a>
                </li>

                <li><a class="box-link @if($roomInformation['Permalink'] == 'kitchen') active @endif " href="{{url('room/kitchen')}}">Kitchen</a></li>
                <li><a class="box-link @if($roomInformation['Permalink'] == 'bath') active @endif " href="{{url('room/bath')}}">Bath</a></li>
                <li><a class="box-link @if($roomInformation['Permalink'] == 'bedroom') active @endif " href="{{url('room/bedroom')}}">Bedroom</a></li>
                <li><a class="box-link @if($roomInformation['Permalink'] == 'office') active @endif " href="{{url('room/office')}}">Office</a></li>
                <li><a class="box-link @if($roomInformation['Permalink'] == 'living') active @endif " href="{{url('room/living')}}">Living</a></li>
                <li><a class="box-link @if($roomInformation['Permalink'] == 'outdoor') active @endif " href="{{url('room/outdoor')}}">Outdoor</a></li>
                <li><a class="box-link @if($roomInformation['Permalink'] == 'lighting') active @endif " href="{{url('room/lighting')}}">Lighting</a></li>
                <li><a @if($roomInformation['Permalink'] == 'decor') class="active" @endif href="{{url('room/decor')}}">Decor</a></li>

            </ul>
            <div class="hide">
                <ul class="pull-right"> 
                    <li class="nested">
                        <a id="browse-all" href="#" class="" data-toggle=".shop-menu"><i class="m-icon m-icon--menu"></i>&nbsp; Browse all</a>
                    </li>
            </ul>
        </div>

        </div>
    </nav>-->
    

<div id="pagingApp" ng-app="pagingApp" ng-controller="pagingController">
    <div id="hero" class="royalSlider heroSlider rsMinW room-hero slider" style="display: none;">
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
                                   <div class="icon-wrap" style="height: 90px">
                                        <a class="category-tag get-round" href="{{$i_products->affiliate_link}}" target="_blank">
                                            Get it
                                        </a>
                                        <div style="border:none">
                                        <b class="price">
                                            &nbsp;
                                            @if(isset($i_products->sale_price))
                                                ${{$i_products->sale_price}}
                                            @endif
                                        </b>
                                        </div>
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
                                <li ng-click="activeMenu='1'" ng-class="{active: !activeMenu || activeMenu == '1'}">
                            <a ng-click="filterContent(null)" href="" data-filterby="all" class="all-link">
                                        <i class="m-icon m-icon--menu"></i>
                                All
                            </a>
                        </li>
                                <li ng-click="activeMenu='2'" ng-class="{active: activeMenu == '2'}">
                            <a ng-click="filterContent('idea')" data-filterby="ideas" href="" class="ideas-link">
                                <i class="m-icon m-icon--bulb"></i>
                                Ideas
                            </a>
                        </li>
                                <li ng-click="activeMenu='3'" ng-class="{active: activeMenu == '3'}">
                            <a ng-click="filterContent('product')" data-filterby="products" href=""
                               class="products-link">
                                        <i class="m-icon m-icon--item"></i>
                                Products
                            </a>
                        </li>
                                <li ng-click="activeMenu='4'" ng-class="{active: activeMenu == '4'}">
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

            @include('layouts.parts.product-popup')

            <!-- custom angular template - END -->
        </div>

    </main>
</div>
<style>
#full-width-slider {
  width: 100%;
  color: #000;
}
.royalSlider { display:none }
</style>
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
  $('.royalSlider').css('display', 'block');
});
</script>
@stop