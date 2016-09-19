{{--<div id="hero-slider" class="slider home-hero-slider default-hero-slider heroSlider has-bullets 2" ng-show="ideaCategory == 'default'">--}}

<?php
if(function_exists('is_single')){
    $sliderContent = getHeroSliderContent();
} ?>
 
<article id="hero-slider"  class="ideaing-home-slider slider home-hero-slider heroSlider has-bullets" ng-if="ideaCategory == 'default'">
<input checked="" type="radio" name="slider" id="slide1">
<input type="radio" name="slider" id="slide2">
<input type="radio" name="slider" id="slide3">
<input type="radio" name="slider" id="slide4">
<input type="radio" name="slider" id="slide5">

<div id="slides">
    <div id="overflow">
        <div class="inner">
            <?php if($sliderContent){
                $i = 0;
                foreach($sliderContent as $item){ ?>
                    $i++;
                            <article >
                                <a  href="<?php echo $item['url']?>" class="box-item product-box slider-box text-center category-<?php echo $item['category_main']?>">
                                    <div class="color-overlay category-bg"></div>
                                    <div class="img-holder">
                                        <img itemprop="image" src="{{$item['image']}}">
                                    </div>
                                    <div class="box-item__label-idea">
                                        <span href="<?php echo $item['url']?>" class="slider-heading"><?php echo $item['title']?></span>
                                    </div>
                                    <div class="box-item__author">
                    <span href="/user/profile/<?php echo $item['authorlink']?>" class="user-widget">
                        <img class="user-widget__img" src="<?php echo $item['avator']?>">
                        <span class="user-widget__name"><?php echo $item['author']?></span>
                    </span>
                                    </div>
                                    <ul class="social-stats">
                                        <?php if($item['views'] >= 100){ ?>
                                        <li class="social-stats__item views">
                                            <b><i class="m-icon m-icon--flame white"></i></b>
                                            <b><span class="social-stats__text white"><?php echo $item['views']?> views</span></b>
                                        </li>
                                        <?php } ?>

                                        <?php
                                        switch($item['category_main']){
                                            case 'smart-body':
                                                $smartIcon =  'wearables';
                                                break;
                                            case 'smart-entertainment':
                                                $smartIcon =  'video';
                                                break;
                                            case 'smart-travel':
                                                $smartIcon =  'travel';
                                                break;
                                            case 'deals':
                                                $smartIcon =  'deals';
                                                break;
                                            default:
                                                $smartIcon =  'smart-home';
                                        }
                                        ?>

                                        <li class="social-stats__item category-tag white">
                                            <b><i class="m-icon m-icon--<?php echo $smartIcon ?> white"></i></b>
                                        </li>
                                    </ul>
                                </a>
                            </article>
                <?php }
                }   ?>
            </div> <!-- .inner -->
        </div> <!-- #overflow -->
    </div> <!-- #slides -->

    <div id="controls">

        <label for="slide1" data-slidenum="1"></label>
        <label for="slide2" data-slidenum="2"></label>
        <label for="slide3" data-slidenum="3"></label>

    </div> <!-- #controls -->

    <div id="active">

        <label for="slide1">
            <div class="progress-bar"></div>
        </label>
        <label for="slide2">
            <div class="progress-bar"></div>
        </label>
        <label for="slide3">
            <div class="progress-bar"></div>
        </label>


    </div> <!-- #active -->

</article> <!-- #slider -->



<div ng-if="readContent.staticSliderContent" id="hero-slider" class="slider home-hero-slider heroSlider has-bullets">
    <a ng-repeat="item in readContent.staticSliderContent"  href="@{{item.url}}" class="box-item product-box slider-box text-center category-@{{item.category_main}}">
        <div class="color-overlay category-bg"></div>
        <div class="img-holder">
            <img itemprop="image" src="@{{item.image}}">
            <img itemprop="image" class="rsTmb" src="@{{item.image}}">
        </div>
        <div class="box-item__label-idea">
            <span href="@{{item.url}}" class="slider-heading">@{{item.title}}</span>
        </div>
        <div class="box-item__author">
                    <span href="/user/profile/@{{item.authorlink}}" class="user-widget">
                        <img class="user-widget__img" src="@{{item.avator}}">
                        <span class="user-widget__name">@{{item.author}}</span>
                    </span>
        </div>
    </a>
</div>