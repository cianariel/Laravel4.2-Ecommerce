@extends('layouts.main')

@section('content')
    <script type="text/javascript">
        var urlParam = "{{$permalink}}";
    </script>
    <div ng-app="productApp" data-ng-controller="productController" ng-cloak>
        <header class="story-header hidden-620 hidden-soft">
            <a href="#" class="side-logo lamp-logo">
            </a>

            <h1>@{{productInformation.ProductName}}</h1>

            <ul class="social-rounds hidden-sm hidden-xs pull-right">
                <li><a class="fb" href="#"></a></li>
                <li><a class="twi" href="#"></a></li>
                <li><a class="gp" href="#"></a></li>
                <li><a class="pint" href="#"></a></li>
            </ul>

            <ul class="like-nav hidden-xs pull-right pull-right">
                <li><a class="like-counter" href="#"><span></span><b>189</b></a></li>
            </ul>

            <div class="icon-wrap pull-right">
                <a class="get solid" ng-href="@{{productInformation.AffiliateLink}}" target="_blank">
                    Get it
                </a>
                <img class="vendor-logo" src="/assets/images/dummies/amazon-black.png">
                <b class="price">$@{{productInformation.Price}}</b>
            </div>
        </header>

        <section id="hero" class="product-hero">
            <div class="hero-background" style="background-image: url('@{{selfImages.heroImage}}')"></div>
            <div class="color-overlay"></div>

            <div class="container fixed-sm full-480">
                <nav class="breadcrumbs">
                    <ul>
                        <li ng-repeat="category in productInformation.CatTree">
                            <a href="/category/@{{ category.CategoryPermalink }}"
                               ng-class="{'current':$last}">@{{ category.CategoryName }}</a>
                        </li>
                    </ul>
                </nav>

                <div class="average-score">
                    <div class="score">98%</div>
                    <span class="caption">Average Ideaing Score</span>
                </div>

                <h1>@{{productInformation.ProductName}}</h1>

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
                                    imageScaleMode: 'fill',
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
                                        imageScaleMode: 'fill',
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
//                        imgWidth: 1400,
//                        imgHeight: 680
                                    });
                                });

                            }
                        });
                    </script>

                    <div id="gallery" class="royalSlider rsDefault" royal-slider>

                        <!-- NEED TO CHECK  ROYALSLIDER WITH ANGULAR -->
                            <img class="rsImg" ng-repeat="item in selfImages.picture" ng-src="@{{ item.link }}" />

                        <a  ng-repeat="item in selfImages.picture" class="rsImg" data-rsbigimg="@{{ item.link }}" href="@{{ item.link }}">
                            <img itemprop="image" class="rsTmb"
                                 ng-src="@{{ item.link }}">
                        </a>

                        <a class="rsImg" data-rsbigimg="/assets/images/dummies/slider/PC220020-1024x683.jpg"
                           href="/assets/images/dummies/slider/PC220020-1024x683.jpg">
                            <img itemprop="image" class="rsTmb"
                                 src="/assets/images/dummies/slider/PC220020-1024x683.jpg">
                        </a>

                    </div>

                    <div class="slider-side-block">
                        <div class="top">
                            <a class="get solid" ng-href="@{{productInformation.AffiliateLink}}" target="_blank">
                                Get it
                            </a>
                            <img class="vendor-logo" src="/assets/images/dummies/amazon-2.png">
                            <b class="price">$@{{productInformation.Price}}</b>
                        </div>
                        <div class="table">
                            <ul>
                                <li>
                                    <a href="#">
                                        <span class="name">Amazon</span>
                                        <span class="price">$@{{productInformation.SellPrice}}</span>
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
                        $@{{productInformation.Description}}
                    </section>
                </div>

                <section class="pale-grey-bg product-specs" id="specs">
                    <div class="container">

                        <h3 class="green">Specifications</h3>

                        <p>
                            Nest Cam and IFTTT, this $99/£89 detector is the best connected one we've seen yet. Nest Cam
                            and IFTTT, this $99/£89 Nest Cam and IFTTT, this $99/£89. Ut enim ad minima veniam, quis
                            nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
                            consequatur?
                        </p>


                        <div class="card small col-sm-3 col-xs-6">
                            <div>
                                <h4>@{{ productInformation.Specifications[0].key }}</h4>
                                <span>@{{ productInformation.Specifications[0].value }}</span>
                            </div>
                        </div>
                        <div class="card small col-sm-3 col-xs-6">
                            <div>
                                <h4>@{{ productInformation.Specifications[1].key }}</h4>
                                <span>@{{ productInformation.Specifications[1].value }}</span>
                            </div>
                        </div>
                        <div class="card small col-sm-3 col-xs-6">
                            <div>
                                <h4>@{{ productInformation.Specifications[2].key }}</h4>
                                <span>@{{ productInformation.Specifications[2].value }}</span>
                            </div>
                        </div>
                        <div class="card small col-sm-3 col-xs-6">
                            <div>
                                <h4>@{{ productInformation.Specifications[3].key }}</h4>
                                <span>@{{ productInformation.Specifications[3].value }}</span>
                            </div>
                        </div>

                        <div class="card big col-sm-6 col-xs-12">
                            <div>
                                <h4>Pricing and Availiability</h4>
                                <ul>
                                    <li><b>Avaliability</b> <i>Pre-release</i></li>
                                    <li><b>Announced (US)</b><i>September 29, 2015</i></li>
                                    <li><b>Original Price</b> <i>@{{ productInformation.SellPrice }}</i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card small col-sm-3 col-xs-6">
                            <div>
                                <h4>@{{ productInformation.Specifications[4].key }}</h4>
                                <span>@{{ productInformation.Specifications[4].value }}</span>
                            </div>
                        </div>
                        <div class="card small col-sm-3 col-xs-6">
                            <div>
                                <h4>@{{ productInformation.Specifications[5].key }}</h4>
                                <span>@{{ productInformation.Specifications[5].value }}</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="comparison" id="compare">
                    <div class="container">
                        <h3 class="purple">Comparisons</h3>

                        <button class="arrow arrow-left"></button>

                        <div class="col-sm-3 col-xs-6 comparison-tab">
                            <section class="search-bar">
                                <input class="form-control" type="text" name="search" value="Search to add products"/>
                            </section>
                        </div>

                        <div class="col-sm-3 col-xs-6 comparison-tab">
                            <div>
                                <img class="img-responsive" src="/assets/images/dummies/nest-2.png"/>

                                <div class="tab-wrap">
                                    <h4>Next Project <br>(second generation)</h4>
                                    <i>Announced 29 October 2015</i>
                                    <b class="score">9.0</b>

                                    <div class="star-raiting">
                                        <span class="stars">(543)</span>
                                    </div>
                                    <div class="btn purple-bg price-badge">
                                        <span>Amazon</span> <b>$375</b>
                                    </div>
                                    <a class="btn-none">More Info</a>
                                </div>
                                <span class="close-button">✕</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6 comparison-tab">
                            <div>
                                <img class="img-responsive" src="/assets/images/dummies/nest-3.png"/>

                                <div class="tab-wrap">
                                    <h4>Next Project <br>(second generation)</h4>
                                    <i>Announced 29 October 2015</i>
                                    <b class="score">9.0</b>

                                    <div class="star-raiting">
                                        <span class="stars">(543)</span>
                                    </div>
                                    <div class="btn purple-bg price-badge">
                                        <span>Amazon</span> <b>$375</b>
                                    </div>
                                    <a class="btn-none">More Info</a>
                                </div>
                                <span class="close-button">✕</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6 comparison-tab">
                            <div>
                                <a class="purple add-more">
                                    <span class="plus">+</span>
                                    <span>Add Product</span>
                                </a>
                            </div>
                        </div>

                        <button class="arrow arrow-right"></button>

                        <div class="crearfix"></div>

                        <h5>Compared (2 products) <a>&#43;</a></h5>

                        <div class="col-sm-3 col-xs-6 comparison-tab table-heads">
                            <h4></h4>
                            <hr>

                            <b>Connections</b>
                            <b>Original Pricing</b>
                            <b>Pricing Range</b>
                            <b>Dimensions</b>
                            <b>Weight</b>
                        </div>
                        <div class="col-sm-3 col-xs-6 comparison-tab table-cells">
                            <h4>Next Project <br>(second generation)</h4>
                            <hr>
                            <div class="bordered">
                                <b>3.5mm stereo</b>
                                <b>$375.00</b>
                                <b>$375.00 - $500</b>
                                <b>8.03 x 14.33</b>
                                <b>14 lbs</b>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6 comparison-tab table-cells">
                            <h4>Next Project <br>(second generation)</h4>
                            <hr>
                            <div class="bordered">
                                <b>3.5mm stereo</b>
                                <b>$375.00</b>
                                <b>$375.00 - $500</b>
                                <b>8.03 x 14.33</b>
                                <b>14 lbs</b>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6 comparison-tab table-cells">
                            <h4></h4>
                            <hr>
                            <div class="bordered">
                                <b></b>
                                <b></b>
                                <b></b>
                                <b></b>
                                <b></b>
                            </div>
                        </div>
                        <a href="#" class="view-all grey">View all</a>
                    </div>
                </section>
                <!-- TODO - use two (three?) columns -->

                <section class="pale-grey-bg reviews" id="reviews">
                    <div class="container full-620 fixed-sm">
                        <h3 class="pink">Reviews (4)</h3>

                        <div class="col-sm-3">
                            <h6 class="grey">Critic Reviews</h6>
                            <b class="score critic-score pink">
                                @{{ productInformation.Review[0].value }} / 5
                            </b>
                        </div>
                        <div class="col-sm-9">
                            <table class="rating-lines">
                                <tbody>
                                <tr ng-repeat="review in productInformation.Review" ng-if="$index >= 1">
                                    <td class="name">
                                        <a href="@{{ review.link }}" target="_blank">@{{ review.key }}</a>

                                    </td>
                                    <td class="line">
                                        <div class="outer-line">
                                            <div style="width: @{{ review.value * 20}}%" class="inner-line"></div>
                                        </div>
                                    </td>
                                    <!-- TODO - the style has to come from Laravel-->

                                    <td class="score">@{{ review.value }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="col-sm-3 col-md-offset-3 critic-quote">
                            <b>Every home needs this</b>
                            <span class="quote-author grey">Pete McBride</span>
                            <span class="light-grey">CNET Editor</span>
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

                        <div class="col-sm-4 col-xs-12 grid-box" ng-repeat="product in relatedProducts">
                            <div class="wrap">
                                <img class="img-responsive" src="@{{ product.Image }}">

                                <div class="color-overlay">
                                    <h4>@{{ product.Name }}
                                        <a href="@{{ product.Permalink }}" class="get solid">Get it</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="like-wrap">
                                <a href="#" class="social-pic likes">157</a>
                                <a href="#" class="social-pic comment">89</a>
                            </div>
                            <time>@{{ product.UpdateTime }}</time>
                        </div>


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


                    <div ng-init="loadProductDetails(urlParam)">&nbsp;</div>

                </div>
            </section>
        </main>
    </div>
@stop