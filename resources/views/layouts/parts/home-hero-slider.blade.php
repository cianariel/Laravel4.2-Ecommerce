<div id="hero-slider" class="slider home-hero-slider heroSlider has-bullets 2">
        <?php
         if(function_exists('is_single')){
             $sliderContent = getHeroSliderContent();
         }

        if($sliderContent){
        foreach($sliderContent as $item){ ?>
            <a  href="<?php echo $item['url']?>" class="box-item product-box slider-box text-center">
                <div class="color-overlay"></div>
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
            </a>
        <?php }
            }   ?>
</div>
