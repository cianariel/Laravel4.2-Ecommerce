@include('header')

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <section id="hero" class="landing-hero">
            <div class="hero-background"></div>
            <!-- TODO - use as the hero-bg					--><?php //the_post_thumbnail(); // Fullsize image for the single post ?>

            <div class="color-overlay"></div>

            <div class="container fixed-sm full-480">
               <h1>11 Kitchen Gadgets You Need Now</h1>
            </div>
        </section>
        <nav id="hero-nav" class="col-sm-12">
            <div class="container full-620  fixed-sm">
                <ul class="left-nav  hidden-620">
                    <li class="col-xs-2"><a class="home-link" href="">Home</a></li>
                    <li class="col-xs-2 active"><a href="" class="kitchen-link">Kitchen</a></li>
                    <li class="col-xs-2 "><a href="" class="ideas-link">Ideas</a></li>
                </ul>
            </div>
        </nav>
		<!-- article -->

        <div class="container full-620 main-container fixed-sm">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="story-details">
                    <img class="img-responsive author-pic .img-circle">
                    <div class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></div> <?php // TODO - use Author WP data ?>
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

                <section class="col-sm-11">
                    <?php //the_content(); // Dynamic Content ?>
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
                    </p>
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
                    </p>
                </section>
                <section class="social--side-bar">
                    <button class="facebook-share">55</button>
                    <button class="twitter-share">120</button>
                    <button class="google-share">521</button>
                    <button class="email-share">Email</button>
                    <button class="ideaing-like">12.5K</button>
                    <button class="ideaing-comment">322</button>
                </section>

                <h2>1. Crockpot</h2>
                <img class="img-responsve" src="">
                <p>
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                </p>
                <h2>2. Crockpot</h2>
                <img class="img-responsve" src="">
                <p>
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                </p>
            </article>
        </div>

        <section class="about-author">
            <h3>About the host, Anna</h3>
            <b>San Francisco, California, United States</b>
            <b>Member since June 2011</b>
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
