<!doctype html>
<html <?php language_attributes(); ?> class="no-js idea-stories">
	<head>
        <title><?php the_title()?></title>
		<?php wp_head(); ?>

        <?php loadLaravelView('head'); ?>


	</head>
	<body <?php body_class(); ?>>

    <?php loadLaravelView('header'); ?>
