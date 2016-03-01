@extends('layouts.main')

@section('body-class'){{ 'product-details' }}@stop

@section('content')
    <script type="text/javascript">
        var permalink = "{{$permalink}}";
    </script>
    <nav class="mid-nav ">
        <div class="container full-sm fixed-sm">
            <ul class="wrap col-lg-9">
                @if(isset($productInformation['CatTree']))
                    @foreach( $productInformation['CatTree'] as $key => $category )
                        <li class="box-link-ul ">
                            <a class="box-link @if($key==(count($productInformation['CatTree'])-1)) active @endif"
                               href="/category/@if(isset($category['CategoryPermalink'])){{$category['CategoryPermalink']}}@endif"
                               @if($category == end($productInformation['CatTree']))class="current"
                                    @endif>
                                <span class="box-link-active-line"></span>
                                @if(isset($category['CategoryName']))
                                    {{$category['CategoryName']}}
                                @endif
                            </a>
                        </li>
                        <li class="horizontal-line-holder hidden-xs ">
                            <span class="horizontal-line"></span>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </nav>
    <div id="productApp" ng-app="productApp" data-ng-controller="productController" ng-cloak>
        <header class="story-header hidden-620 hidden-soft">
            <div class="col-xs-1">
            <a href="#" class="side-logo lamp-logo">
                <i class="m-icon m-icon--bulb2">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
                </i>
            </a>
            </div>
            <div class="col-xs-4">
            <h1>
                    <span class="title-holder">
                <span class="title">
                    @if(isset($productInformation['ProductName']))
                        {{$productInformation['ProductName']}}
                    @endif
                </span>
                <ul class="social-stats center-block ">
                    <li class="social-stats__item">
                        <a href="#">
                                    <i class="m-icon m-icon--ScrollingHeaderHeart">
                                        <span class="m-hover">
                                            <span class="path1"></span><span class="path2"></span>
                                        </span>
                                    </i>
                            <span class="social-stats__text">1819</span>
                        </a>
                    </li>
                </ul>
                    </span>
            </h1>
            </div>
            <div class="col-xs-7">
            <ul class="share-buttons short hidden-xs col-lg-6 col-sm-8 pull-right">
                <li class="all-shares"><b>120K </b>all shares</li>
                <li><a class="fb" href="#"><i class="m-icon m-icon--facebook-id"></i> <b>189</b></a></li>
                <li><a class="twi" href="#"><i class="m-icon  m-icon--twitter-id"></i> <b>189</b></a></li>
            </ul>

            <div class="icon-wrap pull-right">
                <a class="category-tag get-round" ng-href="@if(isset($productInformation['AffiliateLink']))
                {{$productInformation['AffiliateLink']}}
                @endif" target="_blank">
                    Get it
                </a>
                <b class="price">
                    &nbsp;
                    @if(isset($productInformation['SellPrice']))
                        ${{$productInformation['SellPrice']}}
                    @endif
                </b>
            </div>
            </div>
        </header>

        <section id="hero" class="product-hero">
            <div class="hero-background"
                 style="background-image: url('@if(isset($selfImages['heroImage'])){{$selfImages['heroImage']}}@endif')"></div>
            <div class="color-overlay"></div>

            <div class="container fixed-sm full-480">

                <div class="row hero-content-holder">
                    <div class="col-sm-11">
                        <div class="average-score pull-right">

                            <div class="score">
                                <i class=" m-icon--bulb-detailed-on-rating"></i>
                                @if(isset($productInformation['Review']))
                                    {{intval(((($productInformation['Review'][0]->value > 0 ? $productInformation['Review'][0]->value : $productInformation['Review'][1]->value) + $productInformation['Review'][1]->value)/2)*20)}}%
                                @endif
                            </div>
                            <span class="caption">Average Ideaing Score</span>
                        </div>
                        <h1 class="text-right average-score-title">
                            @if(isset($productInformation['ProductName']))
                                {{$productInformation['ProductName']}}
                            @endif
                        </h1>
                    </div>
                    <div class="col-sm-1"></div>
                </div>


                <nav class="top-product-controls">
                    <ul>
                        <li><a href="#" class="get-alerts"><i class="m-icon m-icon--alert"></i>&nbsp; Get alerts</a></li>
                        {{--<li><a class="compare">99</a></li>--}}
                        <li><a href="#" class="likes"><i class="m-icon m-icon--heart-solid"></i>&nbsp; 768</a></li>
                        <li><a href="#" data-scrollto="#comments" class="comments"><i class="m-icon m-icon--discuss-products"></i>&nbsp; 1.2K</a></li>
                    </ul>
                </nav>


                <div class="slider product-slider">
                    <script>
      jQuery(document).ready(function($) {
                            if (window.innerWidth < 480) {

                                $('#gallery').royalSlider({
                                    arrowsNav: true,
                                    keyboardNavEnabled: true,
                                    controlsInside: false,
                                    imageScaleMode: 'fit',
                                    arrowsNavAutoHide: false,
                                    autoScaleSlider: true,
                                    controlNavigation: 'thumbnails',
                                    thumbsFitInViewport: false,
                                    navigateByClick: true,
                                    startSlideId: 0,
                                    autoPlay: false,
                                    transitionType: 'move',
                                    globalCaption: false,
                                    deeplinking: {
                                        enabled: true,
                                        change: false
                                    },
                                    thumbs: {
                                        appendSpan: true,
                                        firstMargin: false,
//                                orientation: 'horizntal',
                                    },
                                    loop: true
//                            imgWidth: 1400,
//                            imgHeight: 680
                                });
                            } else {
                                    $('#gallery').royalSlider({
//                            arrowsNav: true,
                                        loop: false,
                                        keyboardNavEnabled: true,
                                        controlsInside: false,
                                        imageScaleMode: 'fit',
                                        arrowsNavAutoHide: false,
//                        autoScaleSlider: true,
                                        controlNavigation: 'thumbnails',
                                        thumbsFitInViewport: false,
                                        navigateByClick: true,
                                        startSlideId: 0,
                                        autoPlay: false,
                                        transitionType: 'move',
                                        globalCaption: false,
                                        deeplinking: {
                                            enabled: true,
                                            change: false
                                        },
                                        thumbs: {
                                            arrows: true,
                                            appendSpan: true,
                                            firstMargin: false,
                                            orientation: 'vertical'
                                        },
                                        loop: true

//                        imgWidth: 1400,
//                        imgHeight: 680
                                    });
                            }
                        });
                    </script>

                    <div id="gallery" class="royalSlider rsDefault">

                        @if(isset($selfImages['picture']))
                            @foreach( $selfImages['picture'] as $image )
                                <a class="rsImg" data-rsbigimg="{{$image['link']}}"
                                   href="{{$image['link']}}">
                                    <img itemprop="image" class="rsTmb" src="{{$image['link']}}"
                                         alt="{{$image['picture-name']}}">
                                </a>
                            @endforeach
                        @endif
                        <img width="640" height="427"
                             src="@if(isset($selfImages['picture'][1]['link'])){{$selfImages['picture'][1]['link']}}@endif"
                             class="attachment-large wp-post-image"
                             alt="@if(isset($selfImages['picture'][1]['picture-name'])){{$selfImages['picture'][1]['picture-name']}}@endif"/>
                    </div>

                    <div class="slider-side-block">

                        <div class="top">
                            <a class="get-round" href="@if(isset($productInformation['AffiliateLink']))
                            {{$productInformation['AffiliateLink']}}
                            @endif" target="_blank">
                                Get it
                            </a>
                            <img class="vendor-logo" width="107"
                                 src="@if(isset($storeInformation['ImagePath'])){{$storeInformation['ImagePath']}}@endif"
                            alt="@if(isset($storeInformation['StoreName'])){{$storeInformation['StoreName']}}@endif">
                            <b class="price">$ @if(isset($productInformation['SellPrice']))
                                    {{$productInformation['SellPrice']}}
                                @endif</b>
                            <div style="color: white; text-align: center;">@if(isset($productInformation['Available']))
                                    {{$productInformation['Available']}}
                                @endif
                            </div>
                        </div>
                        <div class="table hide">
                            <ul>
                                <li>
                                    <a href="/pro/@if(isset($storeInformation['Identifier'])){{$storeInformation['Identifier']}}@endif">
                                        <span class="name">@if(isset($storeInformation['StoreName'])){{$storeInformation['StoreName']}}@endif</span>
                                        <span class="price">&nbsp;</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <nav id="hero-nav" class="product-nav col-sm-12">
            <div class="container full-620 fixed-sm">
                <ul class="category-nav full-620">
                    <li class="active"><a href="#" class="photos-link"><i class="m-icon m-icon--photos"></i>Photos</a></li>
                    <li><a href="#" data-scrollto="#features" class="features-link"><i class="m-icon m-icon--features-c1"></i>Features</a>
                    </li>
                    <li><a href="#" data-scrollto="#specs" class="specs-link"><i class="m-icon m-icon--specs"></i>Specs</a>
                    </li>
                    <li class="hidden-category-menu"><a href="#" data-scrollto="#compare" class="compare-link"><i class="m-icon  m-icon--comparisons"></i>Comparisons</a></li>
                    <li class="hidden-category-menu"><a href="#" data-scrollto="#reviews" class="reviews-link"><i class="m-icon m-icon--reviews"></i>Reviews</a>
                    </li>
                </ul>
                <a class="show-hero-category" href="#">></a>
                <div class="hideen-hero-category-menu mobile-top-menu">
                    <ul>
                        <li><a href="#" data-scrollto="#compare" class="compare-link"><i class="m-icon  m-icon--comparisons"></i>Comparisons</a></li>
                        <li><a href="#" data-scrollto="#reviews" class="reviews-link"><i class="m-icon m-icon--reviews"></i>Reviews</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="page-content">
            <article class="product">
                <div id="sticky-anchor"></div>
                <div class="container main-container fixed-sm">

                    @include('layouts.parts.share-bar')

                    <section class="article-content col-lg-12 col-sm-11 pull-right" id="features">
                        <div>
                            @if(isset($productInformation['Description']))
                                {!! $productInformation['Description'] !!}
                            @endif
                        </div>
                    </section>
                </div>

                <section class="pale-grey-bg product-specs" id="specs">
                    <div class="container">

                        <h3 class="green">Specifications</h3>

                        @if(isset($productInformation['Specifications']))
                            <div class="col-lg-6"
                                 style="float: none;margin-left: auto; margin-right: auto; text-align: center">
                                <table class="table col-sm-3">

                                    <tbody>
                                    @foreach( $productInformation['Specifications'] as $specification )
                                        <tr>
                                            <td><strong>{{ $specification->key}}</strong></td>
                                            <td>{{ $specification->value}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>

                </section>

                <section class="comparison hidden-xs hidden-sm" id="compare">
                    <div class="container">
                        <h3 class="purple">Comparisons</h3>

                        <div class="col-sm-3 col-xs-6 comparison-tab">
                            <section class="purple">
                                Add Product To Compare
                            </section>
                        </div>

                        <!-- compare dynamic start -->


                        <div ng-repeat="item in temporaryViewList | limitTo:3">

                            <div class="col-sm-3 col-xs-6 comparison-tab">
                                <div>
                                    <img class="img-responsive" ng-src="@{{ item.data.selfImages.mainImage}}"
                                         alt="@{{ item.data.selfImages.mainImageName}}"/>

                                    <div class="tab-wrap">
                                        <h4 style="height: 35px;overflow: hidden;">@{{ item.data.productInformation.ProductName | limitTo: 50 }} @{{item.data.productInformation.ProductName.length > 50 ? '...' : ''}}</h4>

<!--                                        <b class="score">@{{ item.data.productInformation.Review[1].value }}</b>-->

                                        <div class="star-raiting score" style="text-align: center">
                                            <span class="star active" ng-repeat="n in [1, 2, 3, 4, 5]">
                                                <i ng-class="item.data.productInformation.Review[1].value<=(n-1) ?  'm-icon--star-blue-full-lines' : (item.data.productInformation.Review[1].value<n ? 'm-icon--star-blue-half2' :  'm-icon--star-blue-full')"></i>
                                            </span>
                                        </div>

                                        <div class="star-raiting" style="text-align: center">
                                            <span class="stars">(@{{ item.data.productInformation.Review[1].counter | number:0 }}
                                                ) Customer Reviews</span>
                                        </div>
                                        <div class="purple-bg price-badge">
                                            <a href="@{{ item.data.productInformation.AffiliateLink }}" target="_blank">
                                            <span>@{{ item.data.storeInformation.StoreName }}</span>
                                            <b>$@{{ item.data.productInformation.SellPrice }}</b>
                                            </a>
                                        </div>
                                        <a class="btn-none" href="@{{ item.data.productInformation.AffiliateLink }}"
                                           target="_blank">More Info</a>
                                    </div>
                                    <span class="close-button" ng-click="deleteSelectedItem($index)">✕</span>
                                </div>
                            </div>
                        </div>
                        <!-- add item to compare -->
                        <div class="col-sm-3 col-xs-6 comparison-tab" ng-hide="dataLength > 2"
                             ng-init="loadProductDetails()">

                            <div ng-hide="showCompareButton">
                                <div style="margin-top: 265px">
                                    <autocomplete ng-model="selectedProduct"
                                                  attr-placeholder="Search product to add..."
                                                  {{--attr-input-class="form-control"--}}
                                                  ng-model-options="{debounce: 1000}"
                                                  data="suggestedItems"
                                                  on-select="selectedIdem"
                                                  on-type="searchProductByName">

                                    </autocomplete>
                                </div>

                            </div>

                            <div ng-show="showCompareButton">
                                <a class="purple add-more" ng-click="toggleCompareButton()">
                                    <span class="plus">+</span>
                                    <span>Add Product</span>
                                </a>
                            </div>
                        </div>

                        <!-- compare dynamic end -->

                        <div class="crearfix"></div>

                        <h5>Compare maximum 3 products </h5>

                        <div class="col-sm-3 col-xs-6 comparison-tab table-heads">
                            <h4></h4>
                            <hr>

                            <b ng-repeat="spec in specList track by $index">@{{ spec }}</b>

                        </div>
                        <!-- compare dynamic 2nd part start-->
                        <div ng-repeat="item in temporaryViewList | limitTo:3">
                            <div class="col-sm-3 col-xs-6 comparison-tab table-cells">
                                <h4 style="height: 35px;overflow: hidden;">@{{ item.data.productInformation.ProductName | limitTo: 65 }} @{{item.data.productInformation.ProductName.length > 65 ? '...' : ''}}</h4>

                                <hr>
                                <div class="bordered" ng-repeat="spec in item.data.productInformation.Specifications">
                                    <b>@{{ spec.value }}</b>
                                </div>
                            </div>

                        </div>

                        <!-- compare dynamic 2nd part end -->

                    </div>
                </section>
                <!-- TODO - use two (three?) columns -->

                <section class="pale-grey-bg reviews" id="reviews">
                    <div class="container fixed-sm">
                        <div class="reviews-medium-container">
                            <div class="row hidden-xs">
                                <div class="average-ideaing-line col-xs-4 text-right">
                                    <img src="/assets/images/average-ideaing-left-line.png" alt="">
                                </div>
                                <div class="text-center col-xs-4">
                                    <div class="average-score">
                                        <div class="score">
                                            <i class="  m-icon--bulb-detailed-on-rating"></i>
                                            @if(isset($productInformation['Review']))
                                                {{intval(((($productInformation['Review'][0]->value > 0 ? $productInformation['Review'][0]->value : $productInformation['Review'][1]->value) + $productInformation['Review'][1]->value)/2)*20)}}%
                                            @endif
                                        </div>
                                        <span class="caption">Average Ideaing Score</span>
                                    </div>

                                </div>
                                <div class="average-ideaing-line col-xs-4 text-left">
                                    <img src="/assets/images/average-ideaing-right-line.png" alt="">
                                </div>
                            </div>
                            <div class="visible-xs">
                                <div class=" col-xs-12">
                                    <div class="average-score block-center">
                                        <div class="score">
                                            <i class=" m-icon--bulb-detailed-on-rating"></i>
                                            @if(isset($productInformation['Review']))
                                                {{
                                                intval((((
                                                $productInformation['Review'][0]->value)
                                                + $productInformation['Review'][1]->value)/2)*20
                                                )
                                                }}%
                                            @endif
                                        </div>
                                        <span class="caption">Average Ideaing Score</span>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-4 text-center reviews-service-holder critic">
                                    <div class="vertical-line visible-xs"></div>
                                    <div class="title">Critic</div>
                                    <div class="reviews">Reviews</div>

                                    <div class="star-raiting" style="text-align: center">
                                        <?php
                                        $stars = $productInformation['Review'][0]->value;
                                        $fStar = floor($stars);
                                        $cStar = ceil($stars);
                                        $halfStar = -1;
                                        if ($fStar == $cStar)
                                            $halfStar = $cStar;

                                        ?>
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $fStar)
                                                <span class="star active">
                                                    <i class="m-icon--star-blue-full"></i>
                                                </span>
                                            @elseif($cStar == $i)
                                                <span class="star half">
                                                    <i class=" m-icon--star-blue-half2"></i>
                                                </span>
                                            @else
                                                <span class="star">
                                                    <i class=" m-icon--star-blue-full-lines"></i>
                                                </span>
                                            @endif
                                        @endfor
                                    </div>
                                    <p style="color: black" class="text-center">
                                        {{number_format($productInformation['Review'][0]->counter == ''?0:$productInformation['Review'][0]->counter)}}
                                        <span class="light-black">
                                            @if(isset($productInformation['Review'][0]->counter)&& $productInformation['Review'][0]->counter >1)
                                                Reviews
                                            @else
                                                Review
                                            @endif
                                        </span>

                                    </p>

                                    @if(isset($productInformation['Review']))
                                        @foreach( array_slice($productInformation['Review'],2) as $review )
                                            <div class="critic-outer-rating">
                                                <div class="line-label "><a
                                                            href="@if(isset($review->link)){{$review->link}}@endif"
                                                            target="_blank">@if(isset($review->key)){{$review->key}}@endif
                                                    </a></div>

                                                <div class="star-raiting" style="text-align: center">
                                                    <?php
                                                    $stars = isset($review->value) ? $review->value : 0;
                                                    $fStar = floor($stars);
                                                    $cStar = ceil($stars);
                                                    $halfStar = -1;
                                                    if ($fStar == $cStar)
                                                        $halfStar = $cStar;
                                                    // TODO - move to model or Angular
                                                    ?>
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($i <= $fStar)
                                                            <span class="star active">
                                                                <i class="m-icon--star-blue-full"></i>
                                                            </span>
                                                        @elseif($cStar == $i)
                                                            <span class="star half">
                                                                <i class=" m-icon--star-blue-half2"></i>
                                                            </span>
                                                        @else
                                                            <span class="star">
                                                                <i class=" m-icon--star-blue-full-lines"></i>
                                                            </span>
                                                        @endif
                                                    @endfor
                                                </div>

                                    </div>
                                        @endforeach
                                    @endif

                                </div>
                                <div class="col-xs-6 col-sm-4 col-sm-offset-4 text-center reviews-service-holder amazon">
                                    <div class="vertical-line visible-xs"></div>
                                    <div class="title"><a style="color: #00b1ff;"
                                                          href="@if(isset($productInformation['Review'][1]->link)){{$productInformation['Review'][1]->link}}@endif"
                                                          target="_blank">Amazon</a></div>
                                    <div class="reviews">Reviews</div>
                                    <div class="star-raiting" style="text-align: center">
                                        <?php
                                            $stars = $productInformation['Review'][1]->value;
                                            $fStar = floor($stars);
                                            $cStar = ceil($stars);
                                            $halfStar = -1;
                                            if($fStar == $cStar)
                                                $halfStar = $cStar;

                                        ?>
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $fStar)
                                                <span class="star active">
                                                    <i class="m-icon--star-blue-full"></i>
                                                </span>
                                            @elseif($cStar == $i)
                                                <span class="star half">
                                                    <i class=" m-icon--star-blue-half2"></i>
                                                </span>
                                            @else
                                                <span class="star">
                                                    <i class=" m-icon--star-blue-full-lines"></i>
                                                </span>
                                            @endif
                                        @endfor
                                    </div>
                                    <p style="color: black" class="text-center">
                                        <a href="@if(isset($productInformation['Review'][1]->link)){{$productInformation['Review'][1]->link}}@endif"
                                           target="_blank">
                                            {{$productInformation['Review'][1]->counter == ''?0:number_format($productInformation['Review'][1]->counter)}}
                                            <span class="light-black">
                                               @if(isset($productInformation['Review'][1]->counter)&& $productInformation['Review'][1]->counter >1)
                                                    Reviews
                                                @else
                                                    Review
                                                @endif
                                            </span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="visible-xs visible-sm">

                        </div>

                        <div class="col-md-4 col-md-offset-4 critic-quote">
                            <div>
                                @if(isset($productInformation['ReviewExtLink']))
                                    {!! $productInformation['ReviewExtLink'] !!}
                                @endif
                            </div>
                        </div>

                    </div>
                </section>
            </article>


            @include('layouts.parts.comments')


            <!-- /article -->


            <section class="related-items pale-grey-bg">
                <div class="main-content full-620 fixed-sm">
                    <h3 class="green">Related Products</h3>
                    <div class="related-products grid-box-3">


                        @if(isset($relatedProducts) && ($relatedProducts != null) )
                            @foreach( $relatedProducts as $product )
                                <div class="box-item product-box ">
                                    <img class="img-responsive" src="{{ $product['Image'] }}">
                                    <span class="box-item__time ng-binding">{{ $product['UpdateTime'] }}</span>
                                    <div class="box-item__overlay"></div>
                                    <ul class="social-stats">
                                        <li class="social-stats__item">
                                            <a href="#">
                                                <i class="m-icon m-icon--ScrollingHeaderHeart">
                                                    <span class="m-hover">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </span>
                                                </i>
                                                <span class="social-stats__text">157</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="round-tag round-tag--product">
                                        <i class="m-icon m-icon--item"></i>
                                        <span class="round-tag__label">Product</span>
                                    </div>
                                    <div class="box-item__label-prod">
                                        <a href="{{$product['Permalink']}}"
                                           class="box-item__label box-item__label--clear ">{{ $product['Name'] }}</a>
                                        <div class="clearfix"></div>

                                        <div class="clearfix"></div>
                                        <a target="_blank" href="{{ $product['Permalink'] }}" class="box-item__get-it">
                                            Get it
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="related-ideas grid-box-3">
                        <h3 class="orange">Related Ideas</h3>

                            @if(isset($relatedIdeas) && ($relatedIdeas != null) )
                                @foreach( $relatedIdeas as $item )
                                <div class="box-item" >
                                    <div class="img-holder">
                                        <img alt="{{$item->feed_image->alt}}" title="{{$item->feed_image->alt}}" src="{{$item->feed_image->url}}">
                                    </div>

                                    <span class="box-item__time">{{$item->updated_at}}</span>
                                    <div class="box-item__overlay"></div>

                                    <ul class="social-stats">
                                        <li class="social-stats__item">
                                            <a href="#">
                                                <i class="m-icon m-icon--ScrollingHeaderHeart">
                                                    <span class="m-hover">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </span>
                                                </i>
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

                            @endforeach
                            @endif
                    </div>
                </div>
            </section>
        </main>
    </div>
    <!-- Angular JS and components-->

    <script type="text/javascript" src="/assets/js/vendor/autocomplete.js"></script>
    <script type="text/javascript" src="/assets/product/js/custom.product.js"></script>
@stop