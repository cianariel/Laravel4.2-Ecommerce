<?php
function CarbobFormatTime($timestamp)
{
	// Get time difference and setup arrays
	$difference = time() - $timestamp;
	$periods = array("second", "minute", "hour", "day", "week", "month", "years");
	$lengths = array("60","60","24","7","4.35","12");
 
	// Past or present
	if ($difference >= 0) 
	{
		$ending = "ago";
	}
	else
	{
		$difference = -$difference;
		$ending = "to go";
	}
 
	// Figure out difference by looping while less than array length
	// and difference is larger than lengths.
	$arr_len = count($lengths);
	for($j = 0; $j < $arr_len && $difference >= $lengths[$j]; $j++)
	{
		$difference /= $lengths[$j];
	}
 
	// Round up		
	$difference = round($difference);
 
	// Make plural if needed
	if($difference != 1) 
	{
		$periods[$j].= "s";
	}
 
	// Default format
	$text = "$difference $periods[$j] $ending";
 
	// over 24 hours
	if($j > 2)
	{
		// future date over a day formate with year
		if($ending == "to go")
		{
			if($j == 3 && $difference == 1)
			{
				$text = "Tomorrow at ". date("g:i a", $timestamp);
			}
			else
			{
				$text = date("F j, Y \a\\t g:i a", $timestamp);
			}
			return $text;
		}
 
		if($j == 3 && $difference == 1) // Yesterday
		{
			$text = "Yesterday at ". date("g:i a", $timestamp);
		}
		else if($j == 3) // Less than a week display -- Monday at 5:28pm
		{
			$text = date("l \a\\t g:i a", $timestamp);
		}
		else if($j < 6 && !($j == 5 && $difference == 12)) // Less than a year display -- June 25 at 5:23am
		{
			$text = date("F j \a\\t g:i a", $timestamp);
		}
		else // if over a year or the same month one year ago -- June 30, 2010 at 5:34pm
		{
			$text = date("F j, Y \a\\t g:i a", $timestamp);
		}
	}
 
	return $text;
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
$timestamp = strtotime($datepublishstring);
$datepublish = CarbobFormatTime($timestamp);
$data['date'] = $datepublish;
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
$data['is_featured'] = get_post_custom_values('is_featured',$ID);
//$data['feed_image'] = get_post_custom_values('feed_image',$ID);
$data['feed_image'] = get_field('feed_image');
$datam[]= $data;
endwhile;
echo json_encode($datam);
//print_r(json_decode(json_encode($data)));
?>