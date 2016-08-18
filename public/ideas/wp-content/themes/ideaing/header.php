<!DOCTYPE html>
<html  lang="en" class="no-js idea-stories">
	<head>
        <title><?php the_title()?></title>
		<?php wp_head(); ?>

        <?php loadLaravelView('head'); ?>
	</head>
	<body  ng-app="rootApp" <?php body_class(); ?>>
    <div class="over-wrap" id="o-wrapper">

    <?php loadLaravelView('header'); ?>
