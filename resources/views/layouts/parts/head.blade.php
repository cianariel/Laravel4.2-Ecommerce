<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (! preg_match("/\/ideas\//", $actual_link))
{
?>
<title>{{ MetaTag::get('title') }}</title>
{!! MetaTag::tag('description') !!}
<?php
}
?>
<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


<?php // TODO ?>
<meta charset="<?php // bloginfo('charset'); ?>">

<!--		<link href="//www.google-analytics.com" rel="dns-prefetch">-->
<!--        <link href="--><?php //echo get_template_directory_uri(); ?><!--/img/icons/favicon.ico" rel="shortcut icon">-->
<!--        <link href="--><?php //echo get_template_directory_uri(); ?><!--/img/icons/touch.png" rel="apple-touch-icon-precomposed">-->

<script>
    // conditionizr.com
    // configure environment tests
    //        conditionizr.config({
    //            assets: '<?php //echo get_template_directory_uri(); ?>//',
//            tests: {}
//        });
</script>


<script>
if (screen.width < 992 && screen.width > 620) {
    document.getElementById("viewport").setAttribute("content", "width=980");
}
</script>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<link rel="stylesheet" href="/assets/css/app.css">
<link rel="stylesheet" href="/assets/fonts/ideaing/style.css">

<script src="/assets/js/vendor/jquery-1.11.3.min.js"></script>

<!-- basic stylesheet -->
<link rel="stylesheet" href="/assets/js/vendor/royalslider/royalslider.css">

<!-- skin stylesheet (change it if you use another) -->
<link rel="stylesheet" href="/assets/js/vendor/royalslider/skins/default/rs-default.css">

<!-- Main slider JS script file -->
<!-- Create it with slider online build tool for better performance. -->
<script src="/assets/js/vendor/royalslider/jquery.royalslider.min.js"></script>

<!-- Custom script and css link for Application -->
<link rel="stylesheet" href="/assets/css/autocomplete.css">

<script src="/assets/js/vendor/angular.min.js"></script>

{{--

<script src="/assets/js/vendor/textAngular-sanitize.min.js"></script>

<script src="/assets/js/vendor/angular-confirm.js"></script>

<script src="/assets/js/vendor/textAngular-rangy.min.js"></script>

<script src="/assets/js/vendor/textAngular.min.js"></script>

<script src="/assets/js/vendor/ng-tags-input.min.js"></script>
--}}


