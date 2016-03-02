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
        <link href="/favicon.png" rel="shortcut icon">
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
<script src="/assets/js/vendor/ui-bootstrap.min.js"></script>
<script src="/assets/js/vendor/textAngular-sanitize.min.js"></script>
<script src="/assets/admin/js/angular-file-upload.min.js"></script>


<style>
    .homepage-grid{
       transition: opacity 1s;
    }
    .homepage-grid.hidden{
        opacity:0;
    }
</style>
<!--

<script src="/assets/js/vendor/textAngular-sanitize.min.js"></script>

<script src="/assets/js/vendor/angular-confirm.js"></script>

<script src="/assets/js/vendor/textAngular-rangy.min.js"></script>

<script src="/assets/js/vendor/textAngular.min.js"></script>

<script src="/assets/js/vendor/ng-tags-input.min.js"></script>
-->

<meta name="google-site-verification" content="xiWn24mA3aZopoTkElR97n-HdvsfctffW493Q6x_vZU" />

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-70081627-1', 'auto');
    ga('send', 'pageview');

</script>

<!-- Facebook Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','//connect.facebook.net/en_US/fbevents.js');

    fbq('init', '1695690547327420');
    fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
   src="https://www.facebook.com/tr?id=1695690547327420&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->