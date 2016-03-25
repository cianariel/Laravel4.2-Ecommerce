@include('header')

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <div ng-app="publicApp" ng-controller="publicController">
    <header class="story-header hidden-620 hidden-soft">
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
            <h1>
                    <span class="title-holder"> 
                        <span class="title">{{the_title()}}</span>
                    <ul class="social-stats center-block ">
                        <li class="social-stats__item">
                            <a href="#" class="likes"
                               ng-init="heartCounterAction()"
                               ng-click="heartAction()"
                            >
                                <i ng-class="unHeart != false ? 'm-icon m-icon--heart-solid' : 'm-icon m-icon--ScrollingHeaderHeart'">
                                        <span class="m-hover">
                                            <span class="path1"></span><span class="path2"></span>
                                        </span>
                                </i>
                                <span class="social-stats__text" ng-bind="heartCounter">&nbsp; </span>
                            </a>
                        </li>
                    </ul>
                    </span>
            </h1>
        </div>
        <div class="col-sm-8 hidden-xs">
            <ul class="share-buttons pull-right">
                <?php loadLaravelView('share-buttons'); ?>
            </ul>
        </div>

    </header>
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
    <nav class="mid-nav">
        <div class="container">
            <ul class="wrap col-lg-9 ">
                <!--                    <li><a class="home-link" href="#">Home</a></li>-->
                @if(empty($mainCategory))
                <li class="box-link-ul   ">
                    <a href="{{get_site_url()}}" class="box-link active">
                        Smart Home
                        <span class="box-link-active-line"></span>
                    </a>
                </li>
                @else
                <li class=" box-link-ul  ">
                    <a href="{{get_site_url()}}/{{$mainCategory->slug}}"
                       class="box-link @if(!@$childCategory && !@$firstTag) active @endif">
                        {{$mainCategory->name}}
                        <span class="box-link-active-line"></span>
                    </a>
                </li>
                @if(@$childCategory)
                <li class="horizontal-line-holder hidden-xs ">
                    <span class="horizontal-line"></span>
                </li>
                <li class="box-link-ul"><a href="{{get_site_url()}}/{{$mainCategory->slug}}/{{$childCategory->slug}}"
                                           class="box-link @if(!@$firstTag) active @endif ">{{$childCategory->name}}</a>
                </li>
                @endif

                @if(@$firstTag)
                <li class="horizontal-line-holder hidden-xs ">
                    <span class="horizontal-line"></span>
                </li>
                <li class="box-link-ul"><a href="{{get_site_url()}}/tag/{{$firstTag->slug}}" class="box-link active">{{$firstTag->name}}</a>
                </li>
                @endif
                @endif
            </ul>
        </div>
    </nav>

    <section id="hero" class="details-hero">
        <div class="head-wrap">

            <h1 class="col-sm-8 col-xs-12"><span>{{the_title()}}</span></h1>
            <ul class="social-stats center-block hidden-soft shown-620">

            </ul>
        </div>

        <div class="hero-background" style="background-image:url( {{getThumbnailLink($post->ID)}} ) "></div>
        <!-- TODO - use as the hero-bg					--><?php //the_post_thumbnail(); // Fullsize image for the single post ?>
        <div class="color-overlay"></div>
    </section>
    <nav id="hero-nav" class="col-sm-12">
        <div class="container full-620  fixed-sm">

            <ul class="share-buttons hidden-xs col-lg-7 col-md-8 pull-right">
                <?php loadLaravelView('share-buttons'); ?>
                <li><a class="comment" data-scrollto=".comments" href="#"><i class="m-icon m-icon--comments-id"></i>
                        <b ng-init="initCommentCounter()" ng-bind="commentsCount">
                        </b>
                    </a>
                </li>
            </ul>

            <ul class="like-nav hidden-xs">
                <li>
                    <div class="social-stats  ">
                        <div class="social-stats__item">
                            <a href="#" class="likes"
                               ng-click="heartAction()"
                            >
                                <i ng-class="unHeart != false ? 'm-icon m-icon--heart-solid' : 'm-icon m-icon--ScrollingHeaderHeart'">
                                        <span class="m-hover">
                                            <span class="path1"></span><span class="path2"></span>
                                        </span>
                                </i>
                                <span class="social-stats__text" ng-bind="heartCounter">&nbsp; </span>
                            </a>
                        </div>
                    </div>

                </li>
                <li><a class="author" href="#"></a></li>
                <li><a class="author" href="#"></a></li>
                <li><a class="author" href="#"></a></li>
                <li><a class="likes" href="#">+ 186</a></li>
            </ul>


        </div>
    </nav>
</div>
    <!-- article -->

    <div class="container full-620 main-container fixed-sm">

        <article id="post-<?php the_ID(); ?>" {{post_class(
        'col-xs-11 col-md-offset-1 pull-right')}}>

        <div ng-app="publicApp"
             ng-controller="publicController">
            <header class="story-details col-lg-7  col-sm-8 col-xs-10 full-480"
                    ng-init="getAuthorInfoByEmail('{{get_the_author_meta('user_email')}}')">

                <div ng-init="getAuthorInfoByEmail('{{get_the_author_meta('user_email')}}')">&nbsp;</div>
                <?php include('/var/www/ideaing/public/ideas/wp-content/themes/ideaing/author-info.php') ?>

                <div class="author-overview col-lg-5 col-sm-5 col-xs-6 full-480">
                    <h4 class="author-name">
                        <div id="sticky-anchor"></div>

                        by <b ng-bind="authorName"></b>
                        <!--                            <a class="like-counter" href="#">189</a>-->

                    </h4>
                    <time datetime="{{the_date('Y-m-d')}}">{{the_time( get_option( 'date_format' ) )}}</time>
                    <!--                        <div class="content-tags">-->
                    <!--                            <ul>-->
                    <!--                                <li><a href="#" class="ideas-link">12 Ideas</a></li>-->
                    <!--                                <li><a href="#" class="products-link">95 Products</a></li>-->
                    <!--                                <li><a href="#" class="photos-link">255 photos</a></li>-->
                    <!--                            </ul>-->
                    <!--                        </div>-->
                </div>


            </header>
        </div>

            <div class="shown-620 hidden-soft">
                <?php loadLaravelView('share-bar'); ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="article-content dropcapped">
                        <?php the_content(); ?>
                    </section>
                </div>
            </div>


        </article>
    </div>
    <div class="hidden-620">
        <?php loadLaravelView('share-bar'); ?>
    </div>

    <section class="author-description">
        <div class="container">
            <div ng-app="publicApp" ng-controller="publicController" ng-init="getAuthorInfoByEmail('{{get_the_author_meta('user_email')}}')">

                <?php include('/var/www/ideaing/public/ideas/wp-content/themes/ideaing/author-desc.php') ?>
            </div>
            <div class="col-sm-10 col-xs-9">
                <p>
                    <?php the_author_meta('description'); ?>
                </p>
            </div>
        </div>
    </section>

    <?php
    //loadLaravelView('comments-product');
    loadLaravelView('comments-ideas');

    ?>


    <!-- /article -->

<?php endwhile; ?>

<?php else: ?>


<?php endif; ?>

<section class="related-items pale-grey-bg">
    <div class="main-content full-620 fixed-sm">
        <?php
        $limit = 10;
        $offset = 0;
        $url = str_replace('/ideas', "", get_site_url()) . '/api/paging/get-grid-content/1/3/' . $firstTag->name . '/product';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);
        $json = json_decode($json);
        $relatedProducts = $json->regular;
        ?>
        @if(isset($relatedProducts) && ($relatedProducts != null) && count($relatedProducts)>0 )
        <h3 class="green">Related Products</h3>
        <div class="related-products grid-box-3">
            @foreach( $relatedProducts as $product )
            <div class="box-item product-box ">
                <img class="img-responsive" src="{{ $product->media_link_full_path }}">
                <span class="box-item__time">{{ $product->updated_at }}</span>
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
                    <a href="/product/{{$product->product_permalink}}"
                       class="box-item__label box-item__label--clear ">{{ $product->product_name }}</a>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>
                    <a target="_blank" href="/product/{{ $product->product_permalink }}" class="box-item__get-it">
                        Get it
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <h3 class="orange">Related Ideas</h3><br/>
        <div class="related-ideas  grid-box-3">

            <!--                <section class="col-sm-12 related-stories">-->

            <?php
            //                    Get 3 posts with similar tags. If there are no tags, get any 3 posts
            wp_reset_query();

            $args = [
                'post__not_in' => array($post->ID),
                'posts_per_page' => 3,
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
                    ?>

                    <div class="box-item">
                        <div class="img-holder">
                            <img src="{{$image['url']}}">
                        </div>

                        <!--                <span class="box-item__time">{{$item->updated_at}}</span>-->
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
                            <!--<li class="social-stats__item">
                                <a href="#">
                                    <i class="m-icon m-icon--buble"></i>
                                    <span class="social-stats__text">157</span>
                                </a>
                            </li>-->
                        </ul>

                        <div class="round-tag round-tag--idea">
                            <i class="m-icon m-icon--item"></i>
                            <span class="round-tag__label">Idea</span>
                        </div>

                        <div class="box-item__label-idea">
                            <a href="{{the_permalink()}}" class="box-item__label">{{the_title()}}</a>
                            <div class="clearfix"></div>
                            <a href="{{the_permalink()}}" class="box-item__read-more">Read More</a>
                        </div>

                        <div class="box-item__author">
                            <a href="{{get_author_posts_url( get_the_author_meta( 'ID' ) )}}" class="user-widget">
                                <img class="user-widget__img" src="{{get_avatar_url( get_the_author_email(), '80' )}}">
                                <span class="user-widget__name">{{get_the_author()}}</span>
                            </a>
                        </div>
                    </div>

                    <?php
//                            $data['author'] = get_the_author();
//                            $data['authorlink'] = get_author_posts_url( get_the_author_meta( 'ID' ) );
//                            $data['author_id'] = get_the_author_meta( 'ID' );
//                            $data['avator'] = get_avatar_url( get_the_author_email(), '80' );
                endwhile;
            }
            ?>
        </div>
    </div>
</section>


<?php get_footer(); ?>
<!-- <script type="text/javascript" src="/assets/product/js/custom.product.js"></script> -->