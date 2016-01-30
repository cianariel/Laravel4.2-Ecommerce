@extends('layouts.main')

@section('body-class'){{ 'product-details' }}@stop

@section('content')
    <script type="text/javascript">
        var permalink = "{{$permalink}}";
    </script>
    <div ng-app="productApp" data-ng-controller="productController" ng-cloak>
        <nav class="mid-nav hidden-620">
            <div class="container">
                <ul class="left-nav breadcrumbs hidden-620">
                    <!--                    <li><a class="home-link" href="#">Home</a></li>-->
                    {{--<li class="active"><a href="#" class="larger-text allcaps orange">Ideas</a></li>--}}
                    {{--<li><a href="#" class="orange box-link">Kitchen</a></li>--}}
                    {{--<li><a href="#" class="orange box-link">Style</a></li>--}}

                    @if(isset($productInformation['CatTree']))
                        @foreach( $productInformation['CatTree'] as $category )
                            <li>
                                <a class="orange box-link"
                                   href="/category/@if(isset($category['CategoryPermalink'])){{$category['CategoryPermalink']}}@endif"
                                   @if($category == end($productInformation['CatTree']))class="current"
                                        @endif>
                                    @if(isset($category['CategoryName']))
                                        {{$category['CategoryName']}}
                                    @endif</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </nav>
        <header class="story-header hidden-620 hidden-soft">
            <a href="#" class="side-logo lamp-logo">
            </a>

            <h1>
                @if(isset($productInformation['ProductName']))
                    {{$productInformation['ProductName']}}
                @endif
                <a class="like-counter" href="#"><span></span><b>1819</b></a>
            </h1>

            <ul class="share-buttons short hidden-xs col-lg-6 col-sm-8 pull-right">
                <li class="all-shares"><b>120K </b>all shares</li>
                <li><a class="fb" href="#"><span></span><b>189</b></a></li>
                <li><a class="twi" href="#"><span></span><b>189</b></a></li>
            </ul>

            {{--<ul class="like-nav hidden-xs pull-right pull-right">--}}
            {{--<li><a class="like-counter" href="#"><span></span><b>1819</b></a></li>--}}
            {{--</ul>--}}

            <div class="icon-wrap pull-right">
                <a class="category-tag get-round" ng-href="@if(isset($productInformation['AffiliateLink']))
                {{$productInformation['AffiliateLink']}}
                @endif" target="_blank">
                    Get it
                </a>
                <img class="vendor-logo"  style="-webkit-filter: invert(100%); filter: invert(100%);" width="90" src="@if(isset($storeInformation['ThumbnailPath'])){{$storeInformation['ThumbnailPath']}}@endif"
                     alt="@if(isset($storeInformation['StoreName'])){{$storeInformation['StoreName']}}@endif">
                <b class="price">$ @if(isset($productInformation['SellPrice']))
                        {{$productInformation['SellPrice']}}
                    @endif</b>
            </div>
        </header>

        <section id="hero" class="product-hero">
            <div class="hero-background"
                 style="background-image: url('@if(isset($selfImages['heroImage'])){{$selfImages['heroImage']}}@endif')"></div>
            <div class="color-overlay"></div>

            <div class="container fixed-sm full-480">
                {{--<nav class="breadcrumbs">--}}
                {{--<ul>--}}
                {{----}}
                {{--</ul>--}}
                {{--</nav>--}}

                <div class="average-score">
                    <div class="score">@if(isset($productInformation['Review']) && isset($productInformation['IdeaingReviewScore']))
                            {{intval((($productInformation['Review'][0]->value + $productInformation['IdeaingReviewScore'])/2)*20)}}@endif%
                    </div>
                    <span class="caption">Average Ideaing Score</span>
                </div>

                <h1>
                    @if(isset($productInformation['ProductName']))
                        {{$productInformation['ProductName']}}
                    @endif
                </h1>

                <nav class="top-product-controls">
                    <ul>
                        <li><a href="#" class="get-alerts">Get alerts</a></li>
                        {{--<li><a class="compare">99</a></li>--}}
                        <li><a href="#" class="likes">768</a></li>
                        <li><a href="#" data-scrollto="#comments" class="comments">1.2K</a></li>
                    </ul>
                </nav>


                <div class="slider product-slider">
                    <script>
                        jQuery(document).ready(function ($) {
                            if (window.innerWidth < 480) {

                                $('#gallery').royalSlider({
                                    arrowsNav: true,
                                    loop: false,
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
                                jQuery(document).ready(function ($) {
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
                            <div style="color: white; text-align: center;">@if(isset($productInformation['Available']))
                                    {{$productInformation['Available']}}
                                @endif</div>
                            <a class="get-round" href="@if(isset($productInformation['AffiliateLink']))
                            {{$productInformation['AffiliateLink']}}
                            @endif" target="_blank">
                                Get it
                            </a>
                            <img class="vendor-logo" width="107" src="@if(isset($storeInformation['ImagePath'])){{$storeInformation['ImagePath']}}@endif"
                            alt="@if(isset($storeInformation['StoreName'])){{$storeInformation['StoreName']}}@endif">
                            <b class="price">$ @if(isset($productInformation['SellPrice']))
                                    {{$productInformation['SellPrice']}}
                                @endif</b>
                        </div>
                        <div class="table">
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
                    <li><a href="#" class="photos-link">Photos</a></li>
                    <li><a href="#" class="features-link">Features</a></li>
                    <li><a href="#" data-scrollto="#specs" class="specs-link">Specs</a></li>
                    <li><a href="#" data-scrollto="#compare" class="compare-link">Comparisons</a></li>
                    <li><a href="#" data-scrollto="#reviews" class="reviews-link">Reviews</a></li>
                </ul>
            </div>
        </nav>

        <main class="page-content">
            <article class="product">
                <div id="sticky-anchor"></div>
                <div class="container main-container fixed-sm">

                    @include('layouts.parts.share-bar')

                    <section class="article-content col-lg-12 col-sm-11 pull-right">
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

                <section class="comparison" id="compare">
                    <div class="container">
                        <h3 class="purple">Comparisons</h3>

                        {{--<button class="arrow arrow-left" ng-hide="compareIndex == 0" ng-click="traverseBackward()"></button>--}}

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
                                        <h4>@{{ item.data.productInformation.ProductName | limitTo: 50 }} @{{item.data.productInformation.ProductName.length > 50 ? '...' : ''}}</h4>

                                        {{--<i>@{{ item.data.productInformation.Available }}</i>--}}
                                        <b class="score">@{{ item.data.productInformation.Review[1].value }}</b>

                                        <div class="star-raiting" style="text-align: center">
                                            <span class="stars">(@{{ item.data.productInformation.Review[1].counter | number:0 }}
                                                ) Customer Reviews</span>
                                        </div>
                                        <div class="btn purple-bg price-badge">
                                            <span>@{{ item.data.storeInformation.StoreName }}</span> <b>$@{{ item.data.productInformation.SellPrice }}</b>
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

                        {{-- <button class="arrow arrow-right"  ng-hide="compareIndex == dataLength-1" ng-click="traverseForward()"></button>--}}

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
                                <h4>@{{ item.data.productInformation.ProductName | limitTo: 65 }} @{{item.data.productInformation.ProductName.length > 65 ? '...' : ''}}</h4>

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
                    <div class="container full-620 fixed-sm">
                        <h3 class="pink">Reviews
                            (@if(isset($productInformation['Review'])){{count($productInformation['Review']) -1}}@endif)</h3>

                        <div class="col-sm-3">
                            <h6 class="grey">Critic Reviews</h6>
                            <b class="score critic-score pink">
                                @if(isset($productInformation['IdeaingReviewScore']))
                                    {{($productInformation['IdeaingReviewScore'])*20}} %
                                @endif
                            </b>
                        </div>
                        <div class="col-sm-9">
                            <table class="rating-lines">
                                <tbody>
                                @if(isset($productInformation['Review']))
                                    @foreach( array_slice($productInformation['Review'],1) as $review )
                                        <tr>
                                            <td class="name">
                                                <a href="@if(isset($review->link)){{$review->link}}@endif"
                                                   target="_blank">@if(isset($review->key)){{$review->key}}@endif
                                                    @if(isset($review->counter) && ($review->counter > 0))
                                                        ( {{$review->counter}} )@endif
                                                </a>
                                            </td>
                                            <td class="line">
                                                <div class="outer-line">
                                                    <div style="width: @if(isset($review->value)){{$review->value * 20}}@endif%"
                                                         class="inner-line"></div>
                                                </div>
                                            </td>
                                            <!-- TODO - the style has to come from Laravel-->

                                            <td class="score">@if(isset($review->value)){{$review->value * 20}}@endif%
                                            </td>
                                        </tr>

                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>

                        <div class="col-sm-3 col-md-offset-3 critic-quote">
                            <div>
                                @if(isset($productInformation['ReviewExtLink']))
                                    {!! $productInformation['ReviewExtLink'] !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </article>


            <section class="comments" id="comments">
                <div class="container">
                    <h4>211 Comments</h4>

                    <div class="single-comment">
                        <div class="col-md-1 col-sm-2 col-xs-3 comment-author">
                            <a class="author" href="#"></a>

                            <div><b class="comment-name">Carrie</b></div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-7">
                            <p>
                                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                                laboriosam, nisi ut aliquid ex ea commodi consequatur?
                            </p>
                            <time>August 2015</time>
                        </div>
                    </div>

                    <section class="add-comment">
                        <div class="single-comment">
                            <div class="col-md-1 col-sm-2 col-xs-3 comment-author">
                                <a class="author" href="#"></a>
                            </div>
                            <div class="col-xs-8 field-wrap">
                                <textarea class="form-control" name="comment" id="you-comment"
                                          placeholder="Share your thoughts"></textarea>

                                <div class="pull-right comment-controls">
                                    <a href="#" class="add-photo">Add a photo</a>
                                    <button class="btn btn-info">Post</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>


            <!-- /article -->


            <section class="related-items pale-grey-bg">
                <div class="container full-620 fixed-sm">
                    <div class="related-products col-xs-12">
                        <h3 class="green">Related Products</h3>

                        @if(isset($relatedProducts) && ($relatedProducts != null) )
                            @foreach( $relatedProducts as $product )
                                <div class="col-sm-4 col-xs-12 grid-box">
                                    <div class="wrap">
                                        <img class="img-responsive" src="{{ $product['Image'] }}">

                                        <div class="color-overlay">
                                            <h4>{{ $product['Name'] }}
                                                <a href="{{ $product['Permalink'] }}" class="get solid">Get it</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="like-wrap">
                                        <a href="#" class="social-pic likes">157</a>
                                        <a href="#" class="social-pic comment">89</a>
                                    </div>
                                    <time>{{ $product['UpdateTime'] }}</time>
                                </div>
                            @endforeach
                        @endif


                    </div>

                    <div class="related-ideas col-xs-12">
                        <h3 class="orange">Related Ideas</h3>

                        <div class="col-sm-4 col-xs-12 grid-box">
                            <div class="wrap">
                                <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">

                                <div class="color-overlay">
                                    <h4>Mr Coffee smart</h4>
                                </div>
                                <a class="author" href="#"></a>
                            </div>
                            <div class="like-wrap">
                                <a href="#" class="social-pic likes">157</a>
                                <a href="#" class="social-pic comment">89</a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 grid-box">
                            <div class="wrap">
                                <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">

                                <div class="color-overlay">
                                    <h4>Mr Coffee smart</h4>
                                </div>
                                <a class="author" href="#"></a>
                            </div>
                            <div class="like-wrap">
                                <a href="#" class="social-pic likes">157</a>
                                <a href="#" class="social-pic comment">89</a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 grid-box">
                            <div class="wrap">
                                <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">

                                <div class="color-overlay">
                                    <h4>Mr Coffee smart</h4>
                                </div>
                                <a class="author" href="#"></a>
                            </div>
                            <div class="like-wrap">
                                <a href="#" class="social-pic likes">157</a>
                                <a href="#" class="social-pic comment">89</a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>
    </div>
@stop