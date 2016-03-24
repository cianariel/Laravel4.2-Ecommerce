@extends('layouts.main')

@section('body-class'){{ 'homepage' }}@stop

@section('content')
    <section id="hero" class="landing-hero royalSlider heroSlider rsMinW room-hero slider" style="display: none;">
        <div class="rsContent">
            <div class="hero-background"></div>
            <div class="color-overlay"></div>

            @if(empty($userData['email']))
            <div class="container fixed-sm full-480">
                <div class="col-md-5 col-xs-6 full-620 col-md-offset-1 why-us">
                    <h2>Ideas for Smarter Living</h2>
                    <ul>
                        <li class="get-ideas"><i class="m-icon m-icon--bulb3"></i>Get ideas for a smarter and sexier home</li>
                        <li class="share-vote"><i class="m-icon m-icon--heart-id"></i>Share and Vote on the best theme decor</li>
                        <li class="shop-cool"><i class="m-icon m-icon--products"></i>Shop for cool gadgets and unique decor</li>
                    </ul>
                </div>


                <div  id="publicApp" ng-app="publicApp" ng-controller="publicController"
                      class="col-md-4 col-xs-6 col-md-offset-1 hero-box qiuck-signup hidden-620" ng-cloak>
    <!--            <div class="col-md-4 col-xs-6 col-md-offset-1 hero-box qiuck-signup hidden-620">-->
                    <div style="background-color: lightgrey; text-align: center;">
                        <strong style="color: red">@{{ responseMessage }}</strong>
                    </div>
                    <form>
                        <h4>
                            <b>Sign-up in Seconds</b>
                        </h4>

                        {{--<input class="form-control hide" type="text" placeholder="First name" name="name">--}}
                        <span class="email-input-holder ">
                            <i class="m-icon m-icon--email-form-id"></i>
                            <input class="form-control" ng-model="SubscriberEmail" type="text" placeholder="Email" name="email">
                        </span>
                        
                        <button ng-click="subscribe('')" class="btn btn-success col-xs-12"  href="#">Sign up</button>
                        <div class="line-wrap">or</div>
                        <button ng-click="registerWithFB()" class="btn btn-info col-xs-12" href="#"><i class="m-icon m-icon--facebook-id"></i>Sign up with Facebook</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
        @if(isset($homehero))
            @foreach( $homehero as $key => $image )
            <div class="rsContent">
<!--                <div class="rsInnerContent">-->
                @if(isset($homehero))
                <div class="container-fluid fixed-sm full-480">

                    <div class="hero-tags">
                            <div class="photoCopy">{{$image['hero_image_title']}}: {{$image['hero_image_caption']}} @if($image['hero_image_link']!="")<a href="{{$image['hero_image_link']}}">{{$image['hero_image_link_title']}}</a>@endif </div>
 
                        @foreach($image['Image_Products'] as $i_products)
                            @if($i_products->product_id!=null)
                            <div class="tag {{$i_products->product_color}}" style="left:{{$i_products->x}}%;top:{{$i_products->y}}%" >

                                <span class="tag-icon">
                                @if(property_exists($i_products,'tag_type'))
                                @if($i_products->tag_type=="thumb")
                                
                                    <img src="{{@$i_products->media_link}}" class="round" alt="" />
                                
                                @else 
                                <i class="m-icon--shopping-bag-light-green"></i>
                                @endif
                                @else 
                                <i class="m-icon--shopping-bag-light-green"></i>
                                @endif
                                </span>
                                <a class="{{$i_products->product_color}}-border" href="/product/{{@$i_products->product_permalink}}">
                                    <img src="{{@$i_products->media_link}}" class="round" alt="" />
                                </a>
                               <div class="hover-box">
                                   <h6>{{@$i_products->product_name}}</h6>
                                       <div class="icon-wrap" style="height: 90px">
                                            <a class="category-tag get-round" href="{{@$i_products->affiliate_link}}" target="_blank">
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
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <img class="rsImg" src="{{$image['hero_image']}}" alt="{{$image['hero_image_alt']}}">

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
                                @if($i_products->product_id!=null)
                                    <li class="{{$i_products->product_color}}">
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-10">
                                                <a class="{{@$i_products->product_color}}-border " href="/product/{{@$i_products->product_permalink}}">
                                                    <span class="img-holder">
                                                        <img src="{{@$i_products->media_link}}" class="round" alt="" />
                                                    </span>
                                                    <span class="name-holder">
                                                        {{@$i_products->product_name}}
                                                    </span>
                                                </a> 
                                            </div>
                                            <div class="col-xs-4 col-sm-2">
                                                <a href="{{@$i_products->affiliate_link}}" class="get solid pull-right ">Get it</a>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </section>
                </div>
                </script>

            </div>
            @endforeach
        @endif
    </section>
    <div class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>
        <nav id="hero-nav" class="col-sm-12">
            <div class="container full-620  fixed-sm">
                {{--<ul class="left-nav col-xs-1 hidden-620">--}}
                    {{--<li class="active"><a class="home-link" href="#">Home</a></li>--}}
                {{--</ul>--}}
                <ul class="category-nav main-content-filter">
                    <li ng-class="{active: (activeMenu == '1' || !activeMenu)}" ng-click="activeMenu='1'">
                        <a ng-click="filterContent(null)"  href="" data-filterby="all" class="all-link">
                            <i class="m-icon m-icon--menu"></i>
                            All
                            
                        </a>
                    </li>
                    <li ng-class="{active: activeMenu == '2'}" ng-click="activeMenu='2'">
                        <a ng-click="filterContent('idea')" data-filterby="ideas" href="" class="ideas-link">
                            <i class="m-icon m-icon--bulb"></i>
                            Ideas
                        </a>
                    </li>
                    <li ng-class="{active: activeMenu == '3'}" ng-click="activeMenu='3'">
                        <a  ng-click="filterContent('product')" data-filterby="products" href="" class="products-link">
                            <i class="m-icon m-icon--item"></i>
                            Products
                        </a>
                    </li>
                    <li ng-class="{active: activeMenu == '4'}" ng-click="activeMenu='4'">
                        <a data-filterby="photos" href="" class="photos-link">
                            <i class="m-icon m-icon--image"></i>
                            Photos
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="clearfix"></div>

        <div class="homepage-grid center-block" style="min-height:1000px">
                <div class="loader loader-abs" cg-busy="firstLoad"></div>
                {{--<div class="loader loader-abs" cg-busy="filterLoad"></div>--}}
                <div class="loader loader-fixed" cg-busy="nextLoad"></div>

                @include('grid.grid')

        <div class="container">
            <a ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12">Load More</a>
        </div>

        <!-- custom angular template - START -->
        
        @include('layouts.parts.product-popup')

        <!-- custom angular template - END -->
        
        </div>
        <style>
#full-width-slider {
  width: 100%;
  color: #000;
}
.photoCopy {
  position: absolute;
  line-height: 24px;
  font-size: 12px;
  background: black;
  color: black;
  background-color: rgba(255, 255, 255, 0.75);
  padding: 0px 10px;
  position: absolute;
  left: 12px;
  bottom: 12px;
  top: auto;
  border-radius: 2px;
  z-index: 25;
}
.photoCopy a {
  color: grey;
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