<?php // print_r($_COOKIE); die();?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js idea-stories">
	<head>
        <title><?php the_title()?></title>
		<?php wp_head(); ?>

        <?php loadLaravelView('head'); ?>


	</head>
	<body  ng-app="rootApp" <?php body_class(); ?>>




    <?php loadLaravelView('header'); ?>
