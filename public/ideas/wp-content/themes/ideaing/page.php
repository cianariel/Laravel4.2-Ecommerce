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

get_header(); ?>

<main id="main" class="site-main container" role="main">

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		// Include the page content template.
		get_template_part( 'template-parts/content', 'page' );

		// End of the loop.
	endwhile;
	?>

</main><!-- .site-main -->

<?php get_footer(); ?>
