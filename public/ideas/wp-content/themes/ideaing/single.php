@include('header')

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <header class="story-header hidden-620 hidden-soft" >
            <a href="#" class="side-logo lamp-logo">
            </a>
            <h1>
                {{the_title()}}
                <a class="like-counter" href="#"><span>Liked by</span><b>189</b></a>
            </h1>

            <ul class="share-buttons hidden-xs col-lg-6 col-sm-7 pull-right">
                <li class="all-shares"><b>120K </b>all shares</li>
                <li><a class="fb" href="#"><span></span><b>189</b></a></li>
                <li><a class="twi" href="#"><span></span><b>189</b></a></li>
                <li><a class="gp" href="#"><span></span><b>189</b></a></li>
                <li><a class="pint" href="#"><span></span><b>189</b></a></li>
                <li><a class="comment" href="#"><span></span><b>189</b></a></li>
            </ul>
        </header>
        <nav class="mid-nav hidden-620">
                <div class="container">
                    <ul class="left-nav breadcrumbs hidden-620">
                        <!--                    <li><a class="home-link" href="#">Home</a></li>-->
                        <li class="active"><a href="#" class="larger-text allcaps orange">Ideas</a></li>
                        <li><a href="#" class="orange box-link">Kitchen</a></li>
                        <li><a href="#" class="orange box-link">Style</a></li>
                    </ul>
                </div>
        </nav>

        <section id="hero" class="details-hero">
                <div class="head-wrap">
                    <h1 class="col-sm-8 col-xs-12"><span>{{the_title()}}</span></h1>
                    <a class="like-counter hidden-soft shown-620" href="#"><span>Liked by</span><b>189</b></a>
                </div>

            <div class="hero-background" style="background-image:url( {{getThumbnailLink($post->ID)}} ) "></div>
            <!-- TODO - use as the hero-bg					--><?php //the_post_thumbnail(); // Fullsize image for the single post ?>
            <div class="color-overlay"></div>
        </section>
        <nav id="hero-nav" class="col-sm-12">
            <div class="container full-620  fixed-sm">

                <ul class="share-buttons hidden-xs col-lg-6 col-sm-8 pull-right">
                    <li class="all-shares"><b>120K </b>all shares</li>
                    <li><a class="fb" href="#"><span></span><b>189</b></a></li>
                    <li><a class="twi" href="#"><span></span><b>189</b></a></li>
                    <li><a class="gp" href="#"><span></span><b>189</b></a></li>
                    <li><a class="pint" href="#"><span></span><b>189</b></a></li>
                    <li><a class="comment" href="#"><span></span><b>189</b></a></li>
                </ul>

                <ul class="like-nav hidden-xs pull-right">
                    <li><a class="like-counter" href="#"><span></span><b>189</b></a></li>
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
                    <div class="author-image-big col-lg-4 col-sm-6 col-xs-5 full-480">
                       {{ get_avatar(get_the_author_meta('ID'), '170') }}
                    </div>
                    <div class="author-overview col-lg-5 col-sm-6 col-xs-7 full-480">
                        <h4 class="author-name">
                            <div id="sticky-anchor"></div>

                            by <span>{{ the_author_meta('first_name') }} {{ the_author_meta('last_name') }}</span>
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
                                <a href="#" class="add-photo">Add a photo</a>
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
        <div class="container full-620 fixed-sm">
            <div class="related-products  col-xs-12">
                <h3 class="green">Related Products</h3>

<!--                <section class="col-sm-12 related-stories">-->

                    <?php
                    //Get 3 posts with similar tags. If there are no tags, get any 3 posts
//
//                    $args= [
//                        'post__not_in' => array($post->ID),
//                        'posts_per_page'=> 3,
//                        'caller_get_posts'=> 1
//                    ];
//
//                    $tags = wp_get_post_tags($post->ID);
//                    if($tags) {
//                        $first_tag = $tags[0]->term_id;
//                        $args['tag__in'] = [$first_tag];
//                    }
//                    $my_query = new WP_Query($args);
//
//                    //                    if($tags && !$my_query->have_posts() ){ // if there are not posts with similar tags, get just any posts
//                    unset($args['tag__in']);
//                    $my_query = new WP_Query($args);
//                    //                    }
//
//                    if( $my_query->have_posts() ) {
//                        while ($my_query->have_posts()) : $my_query->the_post(); ?>
<!--                            <div class="<div class="col-xs-3 grid-box">-->
<!--                                --><?php
//                                echo '<a href="';
//                                the_permalink() ;
//                                echo '" title="';
//                                the_title_attribute();
//                                echo '">';
//
//                                if ( has_post_thumbnail() ){
//                                    echo  '<div class="img-wrap">';
//                                     the_post_thumbnail('medium',['class' => 'thumbnail img-responsive']);
//                                    echo '<div class="thumbnail img-responsive">
//                                            <div class="circle-3">
//                                                <div class="circle-2">
//                                                     <div class="circle-1">Get it</div>
//                                                </div>
//                                             </div>
//                                        </div>';
//                                }else{
//                                    echo  '<div class="img-wrap">
//                                                <div class="thumbnail img-responsive">
//                                                    <div class="circle-3">
//                                                        <div class="circle-2">
//                                                             <div class="circle-1">Get it</div>
//                                                        </div>
//                                                     </div>
//                                            </div>';
//                                }
//                                echo '</a>';
//                                ?>
<!--                                <a href="--><?php //the_permalink() ?><!--">-->
<!--                                    --><?php //the_title(); ?>
<!--                                </a>-->
<!--                            </div>-->
<!--                            --><?php
//                        endwhile;
//                    }
//                    wp_reset_query();
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
                <div class="col-sm-4 col-xs-12 grid-box">
                    <div class="wrap">
                        <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                        <div class="color-overlay">
                            <h4>Mr Coffee smart <div class="get solid">Get it</div></h4>
                        </div>
                    </div>
                    <div class="like-wrap">
                        <a href="#" class="social-pic likes">157</a>
                        <a href="#" class="social-pic comment">89</a>
                    </div>
                    <time>5 hours ago</time>
                </div>
                <div class="col-sm-4 col-xs-12 grid-box">
                    <div class="wrap">
                        <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                        <div class="color-overlay">
                            <h4>Mr Coffee smart <div class="get solid">Get it</div></h4>
                        </div>
                    </div>
                    <div class="like-wrap">
                        <a href="#" class="social-pic likes">157</a>
                        <a href="#" class="social-pic comment">89</a>
                    </div>
                    <time>5 hours ago</time>
                </div>
                <div class="col-sm-4 col-xs-12 grid-box">
                    <div class="wrap">
                        <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                        <div class="color-overlay">
                            <h4>Mr Coffee smart <div class="get solid">Get it</div></h4>
                        </div>
                    </div>
                    <div class="like-wrap">
                        <a href="#" class="social-pic likes">157</a>
                        <a href="#" class="social-pic comment">89</a>
                    </div>
                    <time>5 hours ago</time>
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
<!--                <div class="col-md-3  hidden-sm hidden-xs grid-box">-->
<!--                    <div class="wrap">-->
<!--                        <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">-->
<!--                        <div class="color-overlay">-->
<!--                            <h4>Mr Coffee smart</h4>-->
<!--                        </div>-->
<!--                        <a class="author" href="#"></a>-->
<!--                    </div>-->
<!--                </div>-->

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
