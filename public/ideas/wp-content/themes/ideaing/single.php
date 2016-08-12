
@include('header')
<div ng-app="publicApp" ng-controller="publicController" ng-cloak>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <div>
   <!-- <header class="story-header hidden-620 hidden-soft">
        <div class="col-xs-1 col-sm-1">
            <a href="#" class="side-logo lamp-logo">
                <i class="m-icon m-icon--bulb2 scroll-logo">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span
                        class="path4"></span><span class="path5"></span><span class="path6"></span><span
                        class="path7"></span><span class="path8"></span><span class="path9"></span><span
                        class="path10"></span>
                </i>
            </a>
        </div>
        <div class="col-xs-8 col-sm-3">
            <h2>
                    <span class="title-holder"> 
                        <span class="title">{{the_title()}}</span>
                    <ul class="social-stats center-block ">
                        <li class="social-stats__item">
                            <a href="#" class="likes"
                               ng-init="heartCounterAction()"
                               ng-click="heartAction()"
                            >
                                <i class="category-color" ng-class="unHeart != false ? 'm-icon m-icon--heart-solid' : 'm-icon m-icon--ScrollingHeaderHeart'">
                                        <span class="m-hover">
                                            <span class="path1"></span><span class="path2"></span>
                                        </span>
                                </i>
                                <span class="social-stats__text category-color" ng-bind="heartCounter">&nbsp; </span>
                            </a>
                        </li>
                    </ul>
                    </span>
            </h2>
        </div>
        <div class="col-sm-8 hidden-xs">
            <ul class="share-buttons pull-right">
                <?php loadLaravelView('share-buttons'); ?>
            </ul>
        </div>

    </header> -->

    <?php
    $tags = wp_get_post_tags($post->ID);
    $categories = get_the_category($post->ID);
    $firstTag = $tags[0];

    foreach ($categories as $cat) {
        if ($cat->name != 'Smart Home') {
            if ($cat->category_parent == 0) {
                $mainCategory = $cat;
            } else {
                $childCategory = $cat;
            }
        }

    }
    ?>

    <section id="hero" class="details-hero">
        <div class="head-wrap">

            <h1 class="col-sm-8 col-xs-12 category-bg-trans"><span>{{the_title()}}</span></h1>
            <ul class="social-stats center-block hidden-soft shown-620">

            </ul>
        </div>

        <div class="container absolute details-wrap">
            <header class="story-details col-lg-7 col-sm-8 col-xs-10 full-480" ng-init="getAuthorInfoByEmail('{{get_the_author_meta('user_email')}}')">

                <?php include('/var/www/ideaing/public/ideas/wp-content/themes/ideaing/author-info.php') ?>

                <div class="author-overview col-lg-5 col-sm-5 col-xs-6 full-480">
                    <h4 class="author-name">
                        <div id="sticky-anchor"></div>
                        <b ng-bind="authorName" class="author-name text-uppercase"></b>
                    </h4>
                    <time datetime="{{the_date('Y-m-d')}}">{{the_time( get_option( 'date_format' ) )}}</time>

                </div>

                <div class="view-counter social-stats__item">
                            @if(getPostViews(get_the_ID()) >= 100)
                                <i class="m-icon m-icon--flame"></i>
                            @else
                                <i class="m-icon m-icon--eye"></i>
                            @endif
                            <span class="grey value">{{getPostViews(get_the_ID())}} views</span>
                </div>
                <div class="hero-sharing horizontal-sharing hidden-soft shown-620 col-xs-12 overhid">
                    <ul class="share-buttons">
                        <?php loadLaravelView('share-buttons'); ?>
                    </ul>
                </div>
            </header>
        </div>

        <div class="hero-background" style="background-image:url( <?php echo str_replace('ideaing-ideas.s3.amazonaws.com', 'd3f8t323tq9ys5.cloudfront.net', getThumbnailLink($post->ID)) ?> ) "></div>
        <div class="color-overlay"></div>
    </section>
    <nav id="hero-nav" class="col-sm-12">
            <div class="container ">
                <ul class="like-nav center-block" ng-init="heartUsers('ideas')">
                <li class="heart-item">
                    <div class="social-stats">
                        <div class="social-stats__item">
                                <a href="#" class="likes" ng-click="heartAction()" >
                                <i class="category-color" ng-class="unHeart != false ? 'm-icon m-icon--heart-solid' : 'm-icon m-icon--ScrollingHeaderHeart'">
                                        <span class="m-hover">
                                            <span class="path1"></span><span class="path2"></span>
                                        </span>
                                </i>
                                <span class="social-stats__text category-color heart-number" ng-bind="heartCounter">&nbsp;  </span>
                            </a>
                        </div>
                    </div>
                </li>
                    <?php include('/var/www/ideaing/public/ideas/wp-content/themes/ideaing/heart-user-img.php') ?>
                </ul>

            </div>
    </nav>




        <div class="container main-container">
            <article id="post-<?php the_ID(post_class('col-xs-11 col-md-offse-1 pull-right'))?>">
                <div class="shown-620 hidden-soft">
                    <?php loadLaravelView('share-bar'); ?>
                    </div>
            <div id="mobile-stcky-anchor"></div>
            <div class="row">
                    <div class="col-lg-12">
                        <section class="article-content dropcapped">
                            <?php
                              //echo do_shortcode('[product_thumbs id="1266"]');
                            ?>
                            <?php the_content(); ?>
                        </section>
                    </div>
            </div>
            </article>
        </div>
    </div>
    <div class="ideas-sharing">
        <?php loadLaravelView('share-bar'); ?>
    </div>

        @if(!@@$userData['login'])
        <section class="email-banner">
                <div class="col-lg-5 col-md-7 col-sm-8 center-block">
                                <h4 class="blue">Subscribe to the world’s finest Smart Home & interior design Ideas, Tips and Freebies</h4>
                            <p>Join and get exclusive coupons and giveaways on Smart Home devices</p>
                            <div>
    <!--                            <h5>Enter your email</h5>-->
                                <strong class="red" ng-bind="responseMessage"></strong>

                            </div>
                            <div class="col-xs-12 col-sm-9">
                                <span class="email-input-holder ">
                                    <i class="m-icon m-icon--email-form-id black"></i>
                                        <input class="form-control" ng-model="data.SubscriberEmail" placeholder="me@email.com" type="text">
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <a class="btn btn-success form-control" ng-click="subscribe(data)">SUBSCRIBE</a>
                            </div>
                  <!--  <div class="img-holder head-image-holder"><img src="/assets/images/emailpopupimg.png"></div> -->
            </div>
        </section>
    @endif 

    <section class="author-description">
        <div class="container">
            <div>

                <?php include('/var/www/ideaing/public/ideas/wp-content/themes/ideaing/author-desc.php') ?>
            </div>
            <div class="col-sm-10 col-xs-9">
                <p ng-bind="authorBio">
                    <?php //the_author_meta('description'); ?>
                </p>
            </div>
        </div>
    </section>

    <?php
    //loadLaravelView('comments-product');
    loadLaravelView('comments-ideas');

    ?>


    <!-- /article -->

<?php 
    setPostViews(get_the_ID());
    endwhile; 

?>

<?php// else: ?>
<?php endif; ?>

<section class="related-items pale-grey-bg">
    <div class="main-content full-620 fixed-sm">
        <fieldset class="shoplanding-title">
            <legend align="center"><h3 class="pale-grey-bg">You Have to Read These</h3></legend>
        </fieldset>
        <div class="related-ideas grid-box-2 grid-wrap">

            <?php
            //                    Get 3 posts with similar tags. If there are no tags, get any 3 posts
            wp_reset_query();

            $args = [
                'post__not_in' => array($post->ID),
                'tag__not_in' => [29],
                'posts_per_page' => 2,
                'caller_get_posts' => 1
            ];

            $tags = wp_get_post_tags($post->ID);
            if ($tags) {
                $first_tag = $tags[0]->term_id;
                foreach ($tags as $tag) {
                    $allTags = $tag->slug;
                }
            }
            $args['tag_slug__in'] = $allTags;

            $my_query = new WP_Query($args);

            if ($tags && (!$my_query->have_posts() || $myquery->found_posts < 3)) { // if there are not posts with similar tags, get just any posts
                unset($args['tag_slug__in']);
                $my_query = new WP_Query($args);
            }

            if ($my_query->have_posts()) {
                while ($my_query->have_posts()) : $my_query->the_post();
                    $image = get_field('feed_image');

                    $datepublishstring = get_the_time('Y-m-d H:i:s');
                    $relatedItem['updated_at'] = timeAgo($datepublishstring);

                    $relatedItem['author'] = get_the_author();
                    $relatedItem['author_id'] = get_the_author_meta('ID');

                    $laravelUser = file_get_contents('https://ideaing.com/api/info-raw/' . get_the_author_email());
                    $laravelUser = json_decode($laravelUser, true);

                    $relatedItem['authorlink'] = $laravelUser['permalink'];

                    if (isset($laravelUser['medias'][0])) {
                        $relatedItem['avator'] = $laravelUser['medias'][0]['media_link'];
                    } else {
                        $relatedItem['avator'] = get_avatar_url(get_the_author_email(), '80');
                    }

                    $cats = get_the_category();
                    $relatedItem['category'] = $cats[0]->name;
                    $relatedItem['categorySlug'] = strtolower(str_replace(' ', '-', $relatedItem['category']));


                    ?>

                    <div class="box-item idea-box">
                        <div class="img-holder">
                            <img src="{{$image['url']}}">
                        </div>
                        <div class="category-{{$relatedItem['categorySlug']}}">
                            <div class="idea-meta">
                                <div class="box-item__label-idea">
                                    <a href="{{the_permalink()}}" class="box-item__label" itemprop="name">{{the_title()}}</a>
                                </div>

                                <a href="/ideas">
                                    <span class="round-tag__label in" itemprop="articleSection">In {{$relatedItem['category']}}, Ideas <i class="m-icon m-icon--bulb"></i></span>
                                </a>
                                <div class="box-item__author">
                                    <a href="/user/profile/{{$relatedItem['authorlink']}}"  class="user-widget">
                                        <img class="user-widget__img" src="{{$relatedItem['avator']}}">
                                        <span class="user-widget__name" itemprop="author">{{$relatedItem['author']}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <span class="box-item__time text-uppercase"  itemprop="dateCreated">{{$relatedItem['updated_at']}}</span>

                        <a href="{{the_permalink()}}">
                            <div class="box-item__overlay"></div>
                        </a>
                    </div>

                    <?php
                endwhile;
            }
            ?>
            <div ng-init="readSingleNotification(<?php echo $userId ?>,'{{ $urlTmp }}')"></div>
        </div>
        <?php
        $limit = 10;
        $offset = 0;
        $prelatedTag =  get_field('related-products-tag') ?: $firstTag->name;
        $url = str_replace('/ideas', "", get_site_url()) . '/api/paging/get-content/1/3/' . strtoupper( str_replace(' ', '%20', $prelatedTag)) . '/product';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);
        $json = json_decode($json);
        $relatedProducts = $json->content;
        ?>

        @if(isset($relatedProducts) && ($relatedProducts != null) && count($relatedProducts)>0 )
        <fieldset class="shoplanding-title">
            <legend align="center"><h3 class="pale-grey-bg">Awesome Products</h3></legend>
        </fieldset>
        <div class="related-products grid-box-3">
            @foreach( $relatedProducts as $product )
            <div class="box-item product-box ">
                <div class="img-holder">
                    <img class="img-responsive" src="{{ $product->media_link_full_path }}">
                </div>

                <div class="category-{{$product->master_category_name}}">
                    <div class="idea-meta product  category-bg">

                        <div class="box-item__label-product">
                            <a href="/product/{{$product->product_permalink}}" class="box-item__label box-item__label--clear" itemprop="name">{{ $product->product_name }}</a>
                        </div>

                        <a  href="/products">
                            <span class="round-tag__label in" itemprop="articleSection">In {{($product->master_category_name && $product->master_category_name != $product->category_name) ? $product->master_category_name . ', ' : '' }}{{$product->master_category_name}} <i class="m-icon m-icon--shopping-bag-light-green white"></i></span>
                        </a>

                    </div>
                </div>
                <span class="box-item__time text-uppercase">{{ $product->updated_at }}</span>
                <div class="box-item__overlay" ng-click="openProductPopup({{$product->id}})"></div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
 <div class="mobile-sharing horizontal-sharing hidden-soft">
     <ul class="share-buttons">
         <h5>Sharing is caring</h5>
         <?php loadLaravelView('share-buttons'); ?>
     </ul>
 </div>

    <script>
        $(document).ready(function(){ // add Get It Button overlay on images that link to vendors
            $('.article-content').find('img').each(function(){
                if(!$(this).parents('.get-it-inner').length){
                    var theLinkNode = $(this).parent('a');
                    theLinkNode.attr('target', '_blank').wrap('<div class="get-it-inner"></div>');
                    var strong = theLinkNode.parents('.thumb-box').find('strong a');
                    var text = strong.text();

                    if(text.indexOf('$') == -1){ // price is not hardcoded into the name
                        var href =  theLinkNode.attr('href');
                        postData = false;

                        if(href && href.indexOf('/open/') > -1 && href.indexOf('/idea/') == -1){
                            productID = href.replace(/\D/g,'');
                            postData = {'id': productID};

                        }else if(href && href.indexOf('/product/') > -1){
                            productURL = href.substr(href.lastIndexOf('/') + 1);
                            postData = {'url': productURL};
                        }

                        if(postData){ 
                            $.post( "/api/product/get-for-thumb", postData)
                              .success(function( postResp ) {
                                    var getItNode = theLinkNode.parents('.get-it-inner');
                                        getItNode.append('<span class="merchant-widget__price">$'+ Math.round(postResp.sale_price) +'</span>');   
                                        getItNode.append('<div class="merchant-widget__logo trans-all"><span class="white">from <img class="vendor-logo img-responsive merchant-widget__store" src="' + postResp.storeLogo + '"></span></div>');
                                        var width = getItNode.width();
                                        if(width < 320){
                                        getItNode.addClass('smallish');    
                                        }
                            }); 
                        }
                     }
                }
                if($(this).parents('p').next('p').find('a.vendor-link').length){
                    $(this).parents('p').each(function(){
                        $(this).next('p').andSelf().wrapAll('<div class="thumb-box"></div>');
                    });
                }else if($(this).parents('p').find('a.vendor-link').length){
                    $(this).parents('.get-it-inner').each(function(){
                        $(this).parents('p').find('a.vendor-link').andSelf().wrapAll('<div class="thumb-box"></div>');
                    });
                }
            });

            $('.thumb-box').each(function(){
                if(!$(this).parents('.float-thumbs').length){
                    $(this).next('.thumb-box').andSelf().wrapAll('<div class="float-thumbs"></div>');
                }
            });

        });

            if(window.innerWidth < 1070){ // mobile only
                $(window).scroll(function(){
                    $('.article-content .get-it-inner').each(function(){
                        var that = $(this);
                        var imgTop = that.offset().top + 450;
                        var imgBottom = imgTop + that.height() + 350;
                        var window_top = $(window).scrollTop() + $(window).height();
                        if (window_top > imgTop && window_top < imgBottom) { // we have scrolled over the element
                            that.addClass('hovered');
                        }else if(that.hasClass('hovered')){
                            that.removeClass('hovered');
                        }
                    });
                });
            }


        function showImages(el) {
            var windowHeight = jQuery( window ).height();
            $(el).each(function(){
                var thisPos = $(this).offset().top;

                var topOfWindow = $(window).scrollTop();
                if (topOfWindow + windowHeight - 200 > thisPos ) {
                    $(this).addClass("fadeIn");
                }
            });
        }

        // if the image in the window of browser when the page is loaded, show that image
        $(document).ready(function(){
            showImages('.article-content img');
        });

        // if the image in the window of browser when scrolling the page, show that image
        $(window).scroll(function() {
            showImages('.article-content img');
        });
    </script>

    <?php loadLaravelView('giveaway-popup'); ?>
    <?php loadLaravelView('product-popup'); ?>

</div>
<?php get_footer(); ?>
<!-- <script type="text/javascript" src="/assets/product/js/custom.product.js"></script> -->