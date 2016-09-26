<?php
/**
 * Page Title
 *
 * @since WooCommerce Integration 1.0
 */

if ( is_checkout() ) return; ?>

<header class="entry-header">
  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
</header><!-- .entry-header -->
