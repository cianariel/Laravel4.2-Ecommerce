<div id="hero-slider" class="slider heroSlider has-bullets">
        <?php
         if(function_exists('is_single')){
             $sliderContent = getHeroSliderContent();
         }

        foreach($sliderContent as $item){ ?>
            <div class="box-item product-box text-center">
                <div class="img-holder">
                    <img src="<?php echo $item['image']?>">
                </div>
                <div class="box-item__label-idea">
                    <a href="<?php echo $item['url']?>" class="box-item__label"><?php echo $item['title']?></a>
                    <div class="clearfix"></div>
                    <a href="<?php echo $item['url']?>" class="box-item__read-more">Read More</a>
                </div>
                <div class="box-item__author">
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
                var args = {
                    arrowsNav: true,
                        loop: true,
                        loopRewind: true,
                        keyboardNavEnabled: true,
                        controlsInside: true,
                        controlNavigation: 'bullets',
                        arrowsNavAutoHide: false,
                        slidesSpacing: 0,
                        imageScaleMode: 'none',
                        imgWidth: 1175,
                        imageAlignCenter: true,
                        autoScaleSliderWidth: 1180,
                        autoScaleSliderHeight: 394,
                        thumbsFitInViewport: false,
                        navigateByClick: true,
                        startSlideId: 0,
                        autoPlay: false,
                        transitionType: 'move',
                        globalCaption: false,
                          addActiveClass:true,
                        deeplinking: {
                            enabled: true,
                            change: false
                },
            };
//
            if (window.innerWidth < 1176) {
                args.visibleNearby = {
                    enabled: false,
                    center: false,
                }
            }else{
                args.visibleNearby = {
                    enabled: true,
                    center: true,
                    navigateByCenterClick: true
                }
            }

                $('#hero-slider').royalSlider(args);
        });
    </script>