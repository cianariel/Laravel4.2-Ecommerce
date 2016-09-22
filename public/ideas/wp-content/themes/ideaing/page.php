<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Ideaing
 * @since WooCommerce Integration 1.0
 */

$is_woocommmerce = apply_filters('is_ideaing_woocommerce_page', null, 'shop');

get_header( $is_woocommmerce ); ?>

<main id="main" class="site-main container" role="main">
	<div class="row">
		<div class="col-sm-7">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'template-parts/content', 'page' );

				// End of the loop.
			endwhile;
			?>
		</div><!--- .col-* -->
		<div class="col-sm-4 col-sm-offset-1">
			<?php get_sidebar( $is_woocommmerce ); ?>
		</div><!--- .col-* -->
	</div><!--- .row -->
</main><!-- .site-main -->

<?php get_footer(); ?>
