@include('header')

<?php
$categories = get_categories();
?>
<nav class="mid-nav" >
    <div class="container hidden-xs">
        <ul class="wrap col-lg-7">
            @foreach($categories as $cat)
                @if($cat->category_parent == 0)
                    <li class="box-link-ul">
                        <a href="/ideas/{{$cat->slug}}" class="box-link">
                            {{$cat->name}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="container mobile-menu visible-xs ">
        <ul class="wrap col-lg-7">
            <?php $key=0; ?>
            @foreach($categories as $cat)
                @if($cat->category_parent == 0)
                    <?php
                        if($key>=3)
                            break;                    
                    ?>
                        
                    <li class="box-link-ul">
                        <a href="/ideas/{{$cat->slug}}" class="box-link">
                            {{$cat->name}}
                        </a>
                    </li>
                    <?php $key++ ?>
                @endif
            @endforeach
        </ul>
        <a class="right-menu-arrow pull-right" data-toggle="#mobile-ideas-menu" href="#">
            <i class="m-icon--Header-Dropdown down"></i>
            <i class="m-icon--footer-up-arrow up"></i>
        </a>

    </div>
</nav>

<div id="mobile-ideas-menu" class="mobile-top-menu mobile-mid-menu ">
    <ul>
        <?php $key=0; ?>
        @foreach($categories as $cat)
            @if($cat->category_parent == 0)
                <?php
                    if($key<3){
                        $key++;
                        continue;                    
                    }
                ?>
                    
                <li class="box-link-ul">
                    <a href="/ideas/{{$cat->slug}}" class="box-link">
                        {{$cat->name}}
                    </a>
                </li>
                <?php $key++ ?>
            @endif
        @endforeach
    </ul>
</div>


<section id="hero" class="landing-hero" >
        <?php loadLaravelView('hero-slider'); ?>
    <div class="color-overlay"></div>
</section>




<div class="app-wrap" id="pagingApp" ng-app="pagingApp" ng-controller="pagingController" ng-cloak>
<!--    <nav id="hero-nav" class="col-sm-12">-->
<!---->
<!--    </nav>-->
    <div class="clearfix"></div>
    <div class="homepage-grid center-block" style="min-height:1000px">
        <div class="loader loader-abs" cg-busy="firstLoad"></div>
        <div class="loader loader-fixed" cg-busy="nextLoad"></div>
            <?php include('/var/www/ideaing/resources/views/grid/grid.blade.php') ?>
    </div>
    <div class="container">
        <a ng-show="hasMore" ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12">Load More</a>
    </div>
</div>

<?php get_footer(); ?>



