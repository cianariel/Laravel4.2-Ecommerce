<?php

function timeAgo($time_ago)
{
    $d1 = new DateTime($time_ago);
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
        return "now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "1 minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "1 hour ago";
        }else{
            return "$hours hours ago";
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
            return "1 week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        return $d1;
    }
    //Years
    else{
        return $d1;
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
if($postCount==0)
{
    $postCount = -1;
}

$onlyfeatured = @$_REQUEST['only-featured'];
$no_featured = $_REQUEST['no-featured'];
$is_featured = "";

if(isset($no_featured))
{
    $is_featured = "No";
}
if(isset($onlyfeatured))
{
    $is_featured = "Yes";
}
$offset = $_REQUEST['offset'];
$postCat = $_REQUEST['category-id'];
$args = array(
'cat' => $postCat,
'showposts' => $postCount, 
'offset' => $offset,);

if(isset($_REQUEST['category-name']) && $catName = $_REQUEST['category-name']){
    if($catName == 'smart-home'){
        $catName = 'smarthome';
    }
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $catName,
        ));
}

if($byTags = $_REQUEST['tag']){
    $args['tag'] = $byTags;
}

 if(isset($_REQUEST['no-deals'])){
    $args['tag__not_in'] = [29];
}

 if(isset($_REQUEST['author_name'])){
    $args['author_name'] = $_REQUEST['author_name'];
}

$args['date_query'] = [];

if(isset($_REQUEST['daysback'])){
    $dateQuery['after'] = $_REQUEST['daysback'] . ' days ago';
}else{
    if(isset($_REQUEST['year'])){
        $dateQuery['year'] = $_REQUEST['year'];
    }
    if(isset($_REQUEST['monthnum'])){
        $dateQuery['monthnum'] = $_REQUEST['monthnum'];
    }
    if(isset($_REQUEST['day'])){
        $dateQuery['day'] = $_REQUEST['day'];
    }
}

if(isset($dateQuery)){
    $args['date_query'] = [$dateQuery];
}

if($excludeID = $_REQUEST['excludeid']){
    $args['post__not_in'] = array($excludeID);
}

//$args['meta_query'] = [
//    'relation'  => 'AND'
//];


if($is_featured != "")
{
    $args['meta_query'][] = [
            'key'  => 'is_featured',
            'value' => $is_featured,
            'compare' => '='
];
//    array_push($args['meta_query'], $push);
}

if(isset($_REQUEST['most-popular'])){
    $args['meta_query'][] = [
        'key'  => 'post_views_count',
        'value' => 100,
        'type'    => 'numeric',
        'compare' => '>'
    ];
//    array_push($args['meta_query'], $push);
}

if(isset($_REQUEST['only-slider'])){
    $args['meta_query'][] = [
        'key'  => 'slider_content',
            'value' => 'yes',
            'compare' => '='
    ];
//    array_push($args['meta_query'], $push);
}


//$posts = query_posts($args);
$posts = new WP_Query( $args );

if ( $posts->have_posts() ) {

    if(isset($args['tag_slug__in']) && !have_posts()){ // if there are not posts with similar tags, get just any posts
        unset($args['tag_slug__in']);
        $posts = new WP_Query( $args );
    }
    $datam = array();
    $data = array();
        while ($posts->have_posts()) {
            $posts->the_post();
            $ID = get_the_ID();
            $data['id'] = $ID;
            $data['title'] = get_the_title();
            $data['views'] = getPostViews($ID);
            $data['is_deal'] = has_tag('deal');


            if (isset($_REQUEST['full_content'])) {
                $data['content'] = get_the_content();
            } else {
                $data['content'] = carbon_the_content_limit(200);
            }

            $cats = get_the_category();
            $data['category'] = $data['is_deal'] ? 'Deals' : $cats[0]->name;
            $the_list = '';
            $cat_names = array();

            $filter = 'rss';
            if ('atom' == $type)
                $filter = 'raw';

            if (!empty($cats)) foreach ((array)$cats as $category) {
                $cat_names[] = sanitize_term_field('name', $category->name, $category->term_id, 'category', $filter);
            }

            $cat_names = array_unique($cat_names);
            $data['category_all'] = $cat_names;



            if($data['is_deal']){
                $data['category_main'] = 'deals';
            }elseif(in_array('Smart Body', $cat_names)){
                $data['category_main'] = 'smart-body';
            }elseif(in_array('Smart Travel', $cat_names)){
                $data['category_main'] = 'smart-travel';
            }elseif(in_array('Smart Entertainment', $cat_names)){
                $data['category_main'] = 'smart-entertainment';
            }else{
                $data['category_main'] = 'smarthome';
            }
            $allTags = get_tags();

            $data['url'] = get_the_permalink();
            $datepublishstring = get_the_time('Y-m-d H:i:s');
            $datepublish = timeAgo($datepublishstring);
            $data['raw_creation_date'] = $datepublishstring;
            $data['creation_date'] = $datepublish;
            $data['updated_at'] = $datepublish;
            if (has_post_thumbnail($ID)) {
                $image = get_the_post_thumbnail_url($ID, 'full', false);
            } else {
                $files = get_children('post_parent=' . $ID . '&post_type=attachment&post_mime_type=image');
                if ($files) :
                    $keys = array_reverse(array_keys($files));
                    $j = 0;
                    $num = $keys[$j];
                    $image = wp_get_attachment_image_url($num, 'full', false);
                endif;
            }
            $data['image'] = str_replace('ideaing-ideas.s3.amazonaws.com', 'd3f8t323tq9ys5.cloudfront.net', $image);
            $data['author'] = get_the_author();
            $data['author_id'] = get_the_author_meta('ID');

            if(is_connected()){
                $laravelUser = file_get_contents('https://ideaing.com/api/info-raw/' . get_the_author_email());
                $laravelUser = json_decode($laravelUser, true);
            }else{
                $laravelUser = false;
            }



            $data['authorlink'] = $laravelUser['permalink'];

            if (isset($laravelUser['medias'][0])) {
                $data['avator'] = $laravelUser['medias'][0]['media_link'];
            } else {
                $data['avator'] = get_avatar_url(get_the_author_email(), '80');
            }

            $data['type'] = 'idea';
            $get_is_featured = get_post_custom_values('is_featured', $ID);
            $is_featured = false;
            if ($get_is_featured[0] == "Yes") {
                $is_featured = true;
            }
            $data['is_featured'] = $is_featured;
            $data['feed_image'] = get_field('feed_image');

            $data['feed_image']['url'] = str_replace('ideaing-ideas.s3.amazonaws.com', 'd3f8t323tq9ys5.cloudfront.net', $data['feed_image']['url']);

            if (isset($_REQUEST['with_tags'])) {
                $data['tags_all'] = wp_get_post_tags($post->ID, array('fields' => 'names'));;
            }

            $datam['posts'][] = $data;
        }

}

//if(isset($_REQUEST['get-total-count'])){
    $args['showposts'] = -1;
    $countPosts = new WP_Query($args);
    $datam['totalCount'] = count($countPosts->posts);
//}

echo json_encode($datam);
//print_r(json_decode(json_encode($data)));
?>