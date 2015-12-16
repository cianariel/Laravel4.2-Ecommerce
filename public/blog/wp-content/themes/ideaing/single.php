@include('header')

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <section id="hero" class="landing-hero">
                <h1>{{the_title()}}</h1>
            <div class="hero-background" style="background-image:url( {{getThumbnailLink($post->ID)}} ) "></div>
            <!-- TODO - use as the hero-bg					--><?php //the_post_thumbnail(); // Fullsize image for the single post ?>
            <div class="color-overlay"></div>
        </section>
        <nav id="hero-nav" class="col-sm-12">
            <div class="container full-620  fixed-sm">
                <ul class="left-nav hidden-620">
                    <li class="col-xs-2"><a class="home-link" href="">Home</a></li>
                    <li class="col-xs-2"><a href="" class="kitchen-link">Kitchen</a></li>
                    <li class="col-xs-2 active"><a href="" class="ideas-link">Ideas</a></li>
                </ul>
                <ul class="like-nav hidden-620 pull-right">
                    <li><a class="like-counter" href="#">189</a></li>
                    <li><a class="author" href="#"></a></li>
                    <li><a class="author" href="#"></a></li>
                    <li><a class="author" href="#"></a></li>
                    <li><a class="likes" href="#">and 186 others</a></li>
                </ul>
            </div>
        </nav>
		<!-- article -->

        <div class="container full-620 main-container fixed-sm">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="story-details">
                    <div class="author-image-big">
                       {{ get_avatar(get_the_author_meta('ID'), '210') }}
                    </div>
                    <div class="author-name">
                        {{ the_author_meta('first_name') }} {{ the_author_meta('last_name') }}
                    </div>
                    <div> Reporter: @nytimes & @NYTmag</div>
                    <div class="content-tags">
                        <ul>
                            <li>12 Ideas</li>
                            <li>95 Products</li>
                            <li>255 photos</li>
                        </ul>
                    </div>
                    <!--			<span class="date">--><?php //the_time('F j, Y'); ?><!-- --><?php //the_time('g:i a'); ?><!--</span>-->
                </header>

                <section class="article-content">
                    <?php the_content(); ?>
                </section>

            </article>
        </div>

        <section class="about-author">
           {{ get_avatar(get_the_author_meta('ID'), '80') }}
            <h3>About the host, {{ the_author_meta('first_name') }} {{ the_author_meta('last_name') }}</h3>

            <p><?php the_author_meta( 'description' ); ?></p>
            </section>
        </section>


<!--			<span class="comments">--><?php //if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?><!--</span>-->
			<!-- /post details -->


			<?php // the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

<!--			<p>--><?php //// _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?><!--</p>-->

<!--			<p>--><?php ////  _e( 'This post was written by ', 'html5blank' ); the_author(); ?><!--</p>-->

			<?php // edit_post_link(); // Always handy to have Edit Post Links available ?>

			<?php comments_template(); ?>
        <button>Add a photo</button>
        <button>Post</button>

		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

    <section class="related-products">
        <div class="container full-620 fixed-sm">

            <div class="related-products">
                <h3>Related Products</h3>

                <section class="col-sm-12 related-stories">

                    <?php
                    //Get 3 posts with similar tags. If there are no tags, get any 3 posts

                    $args= [
                        'post__not_in' => array($post->ID),
                        'posts_per_page'=> 3,
                        'caller_get_posts'=> 1
                    ];

                    $tags = wp_get_post_tags($post->ID);
                    if($tags) {
                        $first_tag = $tags[0]->term_id;
                        $args['tag__in'] = [$first_tag];
                    }
                    $my_query = new WP_Query($args);

                    //                    if($tags && !$my_query->have_posts() ){ // if there are not posts with similar tags, get just any posts
                    unset($args['tag__in']);
                    $my_query = new WP_Query($args);
                    //                    }

                    if( $my_query->have_posts() ) {
                        while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            <div class="<div class="col-xs-3 grid-box">
                                <?php
                                echo '<a href="';
                                the_permalink() ;
                                echo '" title="';
                                the_title_attribute();
                                echo '">';

                                if ( has_post_thumbnail() ){
                                    echo  '<div class="img-wrap">';
                                     the_post_thumbnail('medium',['class' => 'thumbnail img-responsive']);
                                    echo '<div class="thumbnail img-responsive">
                                            <div class="circle-3">
                                                <div class="circle-2">
                                                     <div class="circle-1">Get it</div>
                                                </div>
                                             </div>
                                        </div>';
                                }else{
                                    echo  '<div class="img-wrap">
                                                <div class="thumbnail img-responsive">
                                                    <div class="circle-3">
                                                        <div class="circle-2">
                                                             <div class="circle-1">Get it</div>
                                                        </div>
                                                     </div>
                                            </div>';
                                }
                                echo '</a>';
                                ?>
                                <a href="<?php the_permalink() ?>">
                                    <?php the_title(); ?>
                                </a>
                            </div>
                            <?php
                        endwhile;
                    }
                    wp_reset_query();
                    ?>
                </section>

                <div class="col-xs-3 grid-box">
                    <a href="#">
                            <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                                <h4>Mr Coffee smart</h4>
                                <b>Wifi-Enabled</b>
                                    <div class="circle-3">
                                        <div class="circle-2">
                                            <div class="circle-1">Get it</div>
                                        </div>
                                    </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3 grid-box full-620">
                    <a href="#">
                        <div class="img-wrap">
                            <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                                <h4>Mr Coffee smart</h4>
                                <b>Wifi-Enabled</b>
                                    <div class="circle-3">
                                        <div class="circle-2">
                                            <div class="circle-1">Get it</div>
                                        </div>
                                    </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3 grid-box full-620">
                    <a href="#">
                        <div class="img-wrap">
                            <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                                <h4>Mr Coffee smart</h4>
                                <b>Wifi-Enabled</b>
                                    <div class="circle-3">
                                        <div class="circle-2">
                                            <div class="circle-1">Get it</div>
                                        </div>
                                    </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="related-ideas">
                <h3>Related Ideas</h3>

                <div class="col-xs-3 grid-box full-620">
                    <a href="#">
                        <div class="img-wrap">
                            <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                                <h4>Mr Coffee smart</h4>
                                <b>Wifi-Enabled</b>
                                    <div class="circle-3">
                                        <div class="circle-2">
                                            <div class="circle-1">Get it</div>
                                        </div>
                                    </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3 grid-box full-620">
                    <a href="#">
                        <div class="img-wrap">
                            <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                                <h4>Mr Coffee smart</h4>
                                <b>Wifi-Enabled</b>
                                    <div class="circle-3">
                                        <div class="circle-2">
                                            <div class="circle-1">Get it</div>
                                        </div>
                                    </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3 grid-box full-620">
                    <a href="#">
                        <div class="img-wrap">
                            <img class="img-responsive" src="/assets/images/dummies/box-image-dummy.png">
                                <h4>Mr Coffee smart</h4>
                                <b>Wifi-Enabled</b>
                                    <div class="circle-3">
                                        <div class="circle-2">
                                            <div class="circle-1">Get it</div>
                                        </div>
                                    </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
