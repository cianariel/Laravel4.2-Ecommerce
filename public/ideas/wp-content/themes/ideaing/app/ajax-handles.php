<?php
/**
 * Ajax handles for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @since Boost up Integration 1.0
 */

 /**
  * Ajax handle for author posts
  *
  * @return return string
  */
 function ideaing_author_posts(){

  $site_url = site_url('wp-content');

  $cdn_url = 'https://d3f8t323tq9ys5.cloudfront.net';

  $author_id = isset($_REQUEST['author']) ? absint($_REQUEST['author']) : 0;

  $image_size = isset($_REQUEST['image_size']) ? trim($_REQUEST['image_size']) : 'full';

  if ( ! $author_id ) {

    wp_send_json_error( __('auhtor ID is required.') );
  }

  $data = array(
    'total' => 0,
    'posts' => array()
  );

  $query = new WP_Query( array( 'author' => $author_id ) );

  if ( $query->have_posts() ) {

  	while ( $query->have_posts() ) {

  		$query->the_post();
      $data['total']++;
      $data['posts'][] = array(
        'title' => get_the_title(),
        'link' => get_permalink(),
        'feed_image' => str_replace( $site_url, $cdn_url, wp_get_attachment_url(get_post_meta(get_the_ID(), 'feed_image', true)))
      );
  	}
    
  	wp_reset_postdata();
  }

  wp_send_json_success( $data );
 }
 add_action( 'wp_ajax_author_posts', 'ideaing_author_posts' );
 add_action( 'wp_ajax_nopriv_author_posts', 'ideaing_author_posts' );
