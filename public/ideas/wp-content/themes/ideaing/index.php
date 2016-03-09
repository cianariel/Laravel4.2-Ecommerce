@include('header')

<?php
$categories = get_categories();
?>
<nav class="mid-nav" >
    <div class="container">
        <ul class="wrap col-lg-6">
            @foreach($categories as $cat)
                @if($cat->category_parent == 0)
                    <li class="box-link-ul">
                        <a href=" {{$cat->slug}}" class="box-link">
                            {{$cat->name}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>

<section id="hero" class="landing-hero">
    <div class="hero-background" style="background-image: url('/assets/images/ideas-hero.jpg')"></div>
    <div class="color-overlay"></div>
</section>
<div class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>
    <nav id="hero-nav" class="col-sm-12">

    </nav>
    <div class="clearfix"></div>
    <div class="homepage-grid center-block" style="min-height:1000px">
        <div class="loader loader-abs" cg-busy="firstLoad"></div>
        <div class="loader loader-fixed" cg-busy="nextLoad"></div>
            <?php include('/var/www/ideaing/resources/views/grid/grid.blade.php') ?>
    </div>
    <div class="container">
        <a ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12">Load More</a>
    </div>
</div>

<?php get_footer(); ?>



