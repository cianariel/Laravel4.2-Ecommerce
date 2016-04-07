<div style="background-image: url('https://d234pm57oy3062.cloudfront.net/homehero/11/homehero-image-56f8ffa2244c6-landing-hero-3.jpg'); background-size: cover;background-repeat: no-repeat;position: absolute;width: 100%;height: 100%; padding-top: 80px;" id="hero-slider">
        <?php
         if(function_exists('is_single')){
             $sliderContent = getHeroSliderContent();
         }

        foreach($sliderContent as $item){ ?>
            <div class="box-item product-box text-center" style="float:left;">
                <div class="img-holder">
                    <img src="<?php echo $item['image']?>">
                </div>
                <div class="box-item__label-idea">
                    <a style="float: none;" href="<?php echo $item['url']?>" class="box-item__label"><?php echo $item['title']?></a>
                    <div class="clearfix"></div>
                    <a href="<?php echo $item['url']?>" class="box-item__read-more">Read More</a>
                </div>
                <div class="box-item__author" style="position: relative; margin: 0 auto; width: 193px;top: -75px;">
                    <a href="/user/profile/<?php echo $item['authorlink']?>" class="user-widget">
                        <img class="user-widget__img" src="<?php echo $item['avator']?>">
                        <span class="user-widget__name"><?php echo $item['author']?></span>
                    </a>
                </div>
            </div>
        <?php } ?>
</div>
    <script>
        jQuery(document).ready(function($) {
                $('#hero-slider').royalSlider({
                            arrowsNav: true,
                    loop: true,
                    loopRewind: true,
                    keyboardNavEnabled: true,
                    controlsInside: false,
                    imageScaleMode: 'fill',
                    arrowsNavAutoHide: false,
//                        autoScaleSlider: true,
//                    controlNavigation: 'thumbnails',
//                    autoScaleSlider: true,
                    autoScaleSliderWidth: 1480,
//                    autoScaleSliderHeight: 394,
                    thumbsFitInViewport: false,
                    navigateByClick: true,
                    startSlideId: 0,
                    autoPlay: false,
                    transitionType: 'move',
                    globalCaption: false,
                    deeplinking: {
                        enabled: true,
                        change: false
                    },
                  visibleNearby: {
                    enabled: true,
//                    centerArea: 0.3,
                    center: true,
//                    breakpoint: 650,
//                    breakpointCenterArea: 0.64,
                    navigateByCenterClick: true
                }

//                        imgWidth: 1400,
//                        imgHeight: 680
                });
//            }
        });
    </script>