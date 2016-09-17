<div id="hero-slider" class="slider home-hero-slider default-hero-slider heroSlider has-bullets 2" ng-show="ideaCategory == 'default'">
        <?php
         if(function_exists('is_single')){
             $sliderContent = getHeroSliderContent();
         }

        if($sliderContent){
        foreach($sliderContent as $item){ ?>
            <a  href="<?php echo $item['url']?>" class="box-item product-box slider-box text-center category-<?php echo $item['category_main']?>">
                <div class="color-overlay category-bg"></div>
                <div class="img-holder">
                        <img itemprop="image" src="{{$item['image']}}">
                        <img itemprop="image" class="rsTmb" src="{{$item['image']}}">
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
                    <li class="social-stats__item">
                        <i class="m-icon m-icon--flame ng-hide"></i>
                        <span class="social-stats__text pink ng-binding">87 views</span>
                    </li>
                    <li class="social-stats__item">
                        <a href="#">
                            <i class="m-icon m-icon--buble"></i>
                        </a>
                    </li>
                </ul>
            </a>
        <?php }
            }   ?>
</div>

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

