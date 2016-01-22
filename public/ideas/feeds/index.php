<?php
function timeAgo($time_ago)
{
	$d1 = new DateTime($datepublishstring);
	$d1 = $d1->format('M, d Y');
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
    	return $d1;
        /*if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }*/
    }
    //Years
    else{
    	return $d1;
    	/*
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }*/
    }
}

function carbon_the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = strip_tags($content);
	if (strlen($_GET['p']) > 0) {
		return $content;
	}
	else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
		$content = substr($content, 0, $espacio);
		$content = $content;
		return $content."&nbsp;&nbsp;&nbsp;&nbsp;[...]";
	}
	else {
		return $content;
	}
}
require_once('../wp-load.php');
$postCount = $_REQUEST['count']; // The number of posts to show in the feed
$onlyfeatured = $_REQUEST['only-featured'];
$no_featured = $_REQUEST['no-featured'];

$postCat = $_REQUEST['category-id'];
$posts = query_posts('cat='.$postCat.'&showposts=' . $postCount);
$datam = array();
$data = array();
while(have_posts()) : the_post();
$ID = get_the_ID();
$data['title'] = get_the_title();
$data['content'] = carbon_the_content_limit(200);
$cats = get_the_category();
$data['category'] = $cat_name = $cats[0]->name;
//$tags = get_the_tags();
$the_list = '';
$cat_names = array();

$filter = 'rss';
if ( 'atom' == $type )
    $filter = 'raw';

if ( !empty($cats) ) foreach ( (array) $cats as $category ) {
    $cat_names[] = sanitize_term_field('name', $category->name, $category->term_id, 'category', $filter);
}

/*if ( !empty($tags) ) foreach ( (array) $tags as $tag ) {
    $cat_names[] = sanitize_term_field('name', $tag->name, $tag->term_id, 'post_tag', $filter);
}*/

$cat_names = array_unique($cat_names);
$data['category_all'] = $cat_names;
$data['url'] = get_the_permalink();
$datepublishstring = get_the_time('Y-m-d H:i:s');
$datepublish = timeAgo($datepublishstring);
$data['date'] = $datepublish;
$data['updated_at'] = $datepublish;
if( has_post_thumbnail( $ID ) ) {
        $image = get_the_post_thumbnail_url( $ID, 'large', false );
    }
	else
	{
		$files = get_children('post_parent='.$ID .'&post_type=attachment&post_mime_type=image');
	  if($files) :
		$keys = array_reverse(array_keys($files));
		$j=0;
		$num = $keys[$j];
		$image=wp_get_attachment_image_url($num, 'large', false);
	  endif;
	}
$data['image'] = $image;
$data['author'] = get_the_author();
$data['authorlink'] = get_author_posts_url( get_the_author_meta( 'ID' ) );
$data['author_id'] = get_the_author_meta( 'ID' );
$data['avator'] = get_avatar_url( get_the_author_email(), '80' );
$data['type'] = 'idea';
$get_is_featured = get_post_custom_values('is_featured',$ID);
$is_featured = false;
if($get_is_featured[0] == "Yes")
{
	if(isset($no_featured))
	{
		continue;
	}
	$is_featured = true;
}
else
{
	if(isset($onlyfeatured))
	{
		continue;
	}
	
}
$data['is_featured'] = $is_featured;

//$data['feed_image'] = get_post_custom_values('feed_image',$ID);
$data['feed_image'] = get_field('feed_image');
$datam[]= $data;
endwhile;
echo json_encode($datam);
//print_r(json_decode(json_encode($data)));
?>