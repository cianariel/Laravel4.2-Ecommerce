@include('header')

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <header class="story-header hidden-620 hidden-soft" >
            <div class="col-xs-1 col-sm-1">
                <a href="#" class="side-logo lamp-logo">
                </a>
            </div>
            <div class="col-xs-8 col-sm-3">
                <h1>
                    <span class="title">{{the_title()}}</span><br>
                    <ul class="social-stats center-block ">
                        <li class="social-stats__item">
                            <a href="#">
                                <i class="m-icon m-icon--heart"></i>
                                <span class="social-stats__text">1819</span>
                            </a>
                        </li>
                    </ul>
                    
    <!--                <a class="like-counter" href="#"><i class="m-icon m-icon--heart-solid"></i>&nbsp;<b>1819</b></a>-->
                </h1>
            </div>
            <div class="col-sm-8 hidden-xs">
                <ul class="share-buttons  pull-right">
                    <li class="all-shares"><b>120K </b>all shares</li>
                    <li><a class="fb" href="#"><i class="m-icon m-icon--facebook-id"></i><b>189</b></a></li>
                    <li><a class="twi" href="#"><i class="m-icon  m-icon--twitter-id"></i><b>189</b></a></li>
                    <li><a class="gp" href="#"><i class="m-icon m-icon--google-plus-id"></i><b>189</b></a></li>
                    <li><a class="pint" href="#"><i class="m-icon  m-icon--pinterest-id"></i> <b>189</b></a></li>
<!--                    <li><a class="comment" href="#" data-scrollto=".comments"><i class="m-icon m-icon--comments-id"></i> <b>189</b></a></li>-->
                </ul>
            </div>

        </header>
    <?php
        $tags = wp_get_post_tags($post->ID);
        $categories = get_the_category($post->ID);
        $firstTag = $tags[0];

        foreach($categories as $cat){
            if($cat->name != 'Smart Home'){
                if($cat->category_parent == 0){
                    $mainCategory = $cat;
                }else{
                    $childCategory = $cat;
                }
            }

        }
    ?>
        <nav class="mid-nav hidden-xs" style="float: left">
                <div class="container">
                    <ul class="wrap col-xs-9">
                        <!--                    <li><a class="home-link" href="#">Home</a></li>-->
                    @if(empty($mainCategory))
                        <li class="kitchen">
                            <span class="box-link-active-line"></span>
                            <a href="{{get_site_url()}}" class="">
                                Smart Home
                            </a>
                        </li>
                    @else

                                <li class="kitchen">
                                    <span class="box-link-active-line"></span>
                                    <a href="{{get_site_url()}}/category/{{$mainCategory->slug}}" class="">
                                        {{$mainCategory->name}}
                                    </a>
                                </li>
                        @if($childCategory)
                                <li class="horizontal-line-holder hidden-xs hidden-sm">
                                    <span class="horizontal-line"></span>
                                </li>
                                <li><a href="{{get_site_url()}}/cateogry/{{$childCategory->slug}}" class="">{{$childCategory->name}}</a></li>
                        @endif

                        @if($firstTag)
                                <li class="horizontal-line-holder hidden-xs hidden-sm">
                                    <span class="horizontal-line"></span>
                                </li>
                                <li><a href="{{get_site_url()}}/tag/{{$firstTag->slug}}" class="">{{$firstTag->name}}</a></li>
                        endif
                    @endif
                    </ul>
                </div>
        </nav>

        <section id="hero" class="details-hero">
            <div class="head-wrap">
            
                <h1 class="col-sm-8 col-xs-12"><span>{{the_title()}}</span></h1>
                <ul class="social-stats center-block hidden-soft shown-620">
                    <li class="social-stats__item">
                        <a href="#">
                            <i class="m-icon m-icon--heart"></i>
                            <span class="social-stats__text">1819</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="hero-background" style="background-image:url( {{getThumbnailLink($post->ID)}} ) "></div>
            <!-- TODO - use as the hero-bg					--><?php //the_post_thumbnail(); // Fullsize image for the single post ?>
            <div class="color-overlay"></div>
        </section>
        <nav id="hero-nav" class="col-sm-12">
            <div class="container full-620  fixed-sm">

                <ul class="share-buttons hidden-xs col-lg-7 col-md-8 pull-right">
                    <li class="all-shares"><b>120K </b>all shares</li>
                    <li><a class="fb" href="#"><i class="m-icon m-icon--facebook-id"></i><b>189</b></a></li>
                    <li><a class="twi" href="#"><i class="m-icon  m-icon--twitter-id"></i><b>189</b></a></li>
                    <li><a class="gp" href="#"><i class="m-icon m-icon--google-plus-id"></i><b>189</b></a></li>
                    <li><a class="pint" href="#"><i class="m-icon  m-icon--pinterest-id"></i><b>189</b></a></li>
                    <li><a class="comment" data-scrollto=".comments" href="#"><i class="m-icon m-icon--comments-id"></i><b>189</b></a></li>
                </ul>

                <ul class="like-nav hidden-xs pull-right">
                    <li>
                        <div class="social-stats  ">
                            <div class="social-stats__item">
                                <a href="#">
                                    <i class="m-icon m-icon--heart"></i>
                                    <span class="social-stats__text">1819</span>
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
		<!-- article -->

        <div class="container full-620 main-container fixed-sm">

            <article id="post-<?php the_ID(); ?>" {{post_class('col-xs-11 col-md-offset-1 pull-right')}}>

                <header class="story-details col-lg-7  col-sm-8 col-xs-10 full-480">
                    <div class="author-image-big col-lg-3 col-sm-4 col-xs-5 full-480">
                       {{ get_avatar(get_the_author_meta('ID'), '170') }}
                    </div>
                    <div class="author-overview col-lg-5 col-sm-5 col-xs-6 full-480">
                        <h4 class="author-name">
                            <div id="sticky-anchor"></div>

                            by <b>{{ the_author_meta('first_name') }} {{ the_author_meta('last_name') }}</b>
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

            <div class="shown-620 hidden-soft">
                <?php loadLaravelView('share-bar'); ?>
            </div>

            <section class="article-content dropcapped">
                <?php the_content(); ?>
            </section>



            </article>
        </div>
                <div class="hidden-620">
                    <?php loadLaravelView('share-bar'); ?>
                </div>

    <section class="author-description">
                <div class="container">
                     <h4>About the Author, {{ the_author_meta('first_name') }} {{ the_author_meta('last_name') }}</h4>
                    <div class="col-md-1 col-sm-2 col-xs-3">
                        {{ get_avatar(get_the_author_meta('ID'), '80') }}
                    </div>
                    <div  class="col-sm-10 col-xs-9">
                        <p>
                            <?php the_author_meta( 'description' ); ?>
                        </p>
                    </div>
                </div>
            </section>


<!--			<span class="comments">--><?php //if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?><!--</span>-->
			<!-- /post details -->


			<?php // the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

<!--			<p>--><?php //// _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?><!--</p>-->

<!--			<p>--><?php ////  _e( 'This post was written by ', 'html5blank' ); the_author(); ?><!--</p>-->

			<?php // edit_post_link(); // Always handy to have Edit Post Links available ?>

<!--			--><?php //comments_template(); ?>

        <section class="comments">
            <div class="container">
                <h4>211 Comments</h4>

                <div class="single-comment">
                    <div class="col-md-1 col-sm-2 col-xs-3 comment-author">
                        <a class="author" href="#"></a>
                        <div><b class="comment-name">Carrie</b></div>
                    </div>
                    <div  class="col-md-8 col-sm-8 col-xs-7">
                        <p>
                            Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?
                        </p>
                        <time>August 2015</time>
                    </div>
                </div>

                <section class="add-comment">
                    <div class="single-comment">
                        <div class="col-md-1 col-sm-2 col-xs-3 comment-author">
                            <a class="author" href="#"></a>
                        </div>
                        <div  class="col-xs-8 field-wrap">
                            <textarea class="form-control" name="comment" id="you-comment" placeholder="Share your thoughts"></textarea>
                            <div class="pull-right comment-controls">
                                <a href="#" class="add-photo"><i class="m-icon m-icon--camera"></i>&nbsp;<span>Add a photo</span> </a>
                                <button class="btn btn-info">Post</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>


		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>



	<?php endif; ?>

    <section class="related-items pale-grey-bg">
        <div class="main-content container full-620 fixed-sm">
            <h3 class="orange">Related Ideas</h3><br>
            <div class="related-ideas  grid-box-3">

<!--                <section class="col-sm-12 related-stories">-->

                    <?php
//                    Get 3 posts with similar tags. If there are no tags, get any 3 posts
                    wp_reset_query();

                    $args= [
                        'post__not_in' => array($post->ID),
                        'posts_per_page'=> 3,
                        'caller_get_posts'=> 1
                    ];

                    $tags = wp_get_post_tags($post->ID);
                    if($tags) {
                        $first_tag = $tags[0]->term_id;
                        foreach($tags as $tag){
                            $allTags = $tag->slug;
                        }
                    }
                    $args['tag_slug__in'] = $allTags;

                    $my_query = new WP_Query($args);

                    if($tags && (!$my_query->have_posts() || $myquery->found_posts < 3)){ // if there are not posts with similar tags, get just any posts
                        unset($args['tag_slug__in']);
                        $my_query = new WP_Query($args);
                    }

                    if( $my_query->have_posts() ) {
                        while ($my_query->have_posts()) : $my_query->the_post();
                            $image = get_field('feed_image');
                            ?>

                                    <div class="box-item" >
                                        <div class="img-holder">
                                            <img src="{{$image['url']}}">
                                        </div>

                        <!--                <span class="box-item__time">{{$item->updated_at}}</span>-->
                                        <div class="box-item__overlay"></div>

                                        <ul class="social-stats">
                                            <li class="social-stats__item">
                                                <a href="#">
                                                    <i class="m-icon m-icon--heart"></i>
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
<!--                </section>-->

<!--                <div class="col-md-3 col-sm-4 col-xs-12 grid-box">-->
<!--                    <div class="wrap">-->
<!--                        <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">-->
<!--                        <div class="color-overlay">-->
<!--                            <h4>Mr Coffee smart <div class="get solid">Get it</div></h4>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                @for($i=0; $i<3; $i++)-->
<!--                <div class="box-item product-box">-->
<!--                    <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">-->
<!--                    <span class="box-item__time ng-binding">5 hours ago</span>-->
<!--                    <div class="box-item__overlay"></div>-->
<!--                    <ul class="social-stats">-->
<!--                        <li class="social-stats__item">-->
<!--                            <a href="#">-->
<!--                                <i class="m-icon m-icon--heart"></i>-->
<!--                                <span class="social-stats__text">52</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                    <div class="round-tag round-tag--product">-->
<!--                        <i class="m-icon m-icon--item"></i>-->
<!--                        <span class="round-tag__label">Product</span>-->
<!--                    </div>-->
<!--                    <div class="box-item__label-prod">-->
<!--                        <a href="#" class="box-item__label box-item__label--clear ng-binding">Mr Coffee smart</a>-->
<!--                        <div class="clearfix"></div>-->
<!--                        <div class="merchant-widget">-->
<!--                            <span class="merchant-widget__price ng-binding">$259.95</span>-->
<!--                            <span>from</span>-->
<!--                            <img class="merchant-widget__store" src="/assets/images/dummies/amazon-black.png">-->
<!--                        </div>-->
<!--                        <div class="clearfix"></div>-->
<!--                        <a target="_blank" href="#" class="box-item__get-it">Get it</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                @endfor-->
                
            </div>


        </div>
    </section>

<!--<aside class="share-bar sticks-on-scroll mobile">-->
<!--    <ul>-->
<!--        <li class="fb"><a href="#">55</a></li>-->
<!--        <li class="twi"><a href="#">120</a></li>-->
<!--        <li class="gp"><a href="#">521</a></li>-->
<!--        <li class="email"><a href="#">Email</a></li>-->
<!--        <li class="heart"><a href="#">12.5</a></li>-->
<!--        <li class="comment"><a href="#">322</a></li>-->
<!--    </ul>-->
<!--</aside>-->


<?php get_footer(); ?>
