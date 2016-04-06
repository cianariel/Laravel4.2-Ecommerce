@include('header')

<?php
$categories = get_categories();
?>
<nav class="mid-nav" >
    <div class="container">
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
</nav>


<?php
$sliderContent = getHeroSliderContent();
?>

<section id="hero" class="landing-hero">
        <div class="rsContent" style="padding-top: 50px">
            @foreach($sliderContent as $item)
                <div class="box-item product-box text-center" style="max-width: 33%;float:left;">
                    <div class="img-holder">
                        <img src="{{$item['image']}}">
                    </div>
                    <div class="box-item__label-idea">
                        <a href="{{$item['url']}}" class="box-item__label">{{$item['title']}}</a>
                        <div class="clearfix"></div>
                        <a href="{{$item['url']}}" class="box-item__read-more">Read More</a>
                    </div>
                    <div class="box-item__author">
                        <a href="/user/profile/{{$item['authorlink']}}" class="user-widget">
                            <img class="user-widget__img" src="{{$item['avator']}}">
                            <span class="user-widget__name">{{$item['author']}}</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
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
        <a ng-show="hasMore" ng-click="loadMore()" class="btn btn-success bottom-load-more col-xs-12">Load More</a>
    </div>
</div>

<?php get_footer(); ?>



