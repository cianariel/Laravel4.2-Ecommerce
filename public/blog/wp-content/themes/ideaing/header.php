<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
<!--        <link href="--><?php //echo get_template_directory_uri(); ?><!--/img/icons/favicon.ico" rel="shortcut icon">-->
<!--        <link href="--><?php //echo get_template_directory_uri(); ?><!--/img/icons/touch.png" rel="apple-touch-icon-precomposed">-->

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <script>
            if (screen.width < 992 && screen.width > 620) {
                document.getElementById("viewport").setAttribute("content", "width=980");
            }
        </script>

		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

        <link rel="stylesheet" href="/assets/css/app.css">

        <script>
        // conditionizr.com
        // configure environment tests
//        conditionizr.config({
//            assets: '<?php //echo get_template_directory_uri(); ?>//',
//            tests: {}
//        });
        </script>

	</head>
	<body <?php body_class(); ?>>

    <?php loadLaravelView('header'); ?>
