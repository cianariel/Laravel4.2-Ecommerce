@include('header')

<?php
$categories = get_categories();
$currentCat = get_the_category();

$cat = get_category( get_query_var( 'cat' ) );
$currentCat = $cat->slug;



//foreach((get_the_category()) as $i => $category) {
//    if ($category->category_parent == 0) {
//        $currentCat = $category->slug;
//        break;
//    }
//}

//print_r(get_the_category());die();

?>
<nav class="mid-nav" >
    <div class="container">
        <ul class="wrap col-lg-7">
            @foreach($categories as $cat)
            @if($cat->category_parent == 0)
            <li class="box-link-ul">
                <a href="{{$cat->slug}}" class="box-link {{$cat->slug == $currentCat ? 'active' : ''}}">
                    {{$cat->name}}
                </a>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</nav>

<!--<section id="hero" class="landing-hero">-->
<!--    <div class="hero-background" style="background-image: url('/assets/images/ideas-hero.jpg')"></div>-->
<!--    <div class="color-overlay"></div>-->
<!--</section>-->
<div style="padding-top: 50px" class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>
    <nav id="hero-nav" class="col-sm-12">

    </nav>
    <div class="clearfix"></div>
    <div class="homepage-grid center-block" style="min-height:1000px">
        <div class="loader loader-abs" cg-busy="firstLoad"></div>
        <div class="loader loader-fixed" cg-busy="nextLoad"></div>
        <?php include('/var/www/ideaing/resources/views/grid/grid.blade.php') ?>
    </div>
    <?php loadLaravelView('load-more'); ?>
</div>

<?php get_footer(); ?>



