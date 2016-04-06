<div style="background-image: url('https://d234pm57oy3062.cloudfront.net/homehero/11/homehero-image-56f8ffa2244c6-landing-hero-3.jpg'); background-size: cover;background-repeat: no-repeat;position: absolute;width: 100%;height: 100%;">
    <div class="rsContent" style="padding-top: 50px; width: 140%; margin-left: -20%;">

        <?php
         if(function_exists('is_single')){
             $sliderContent = getHeroSliderContent();
         }

        foreach($sliderContent as $item){ ?>
            <div class="box-item product-box text-center" style="max-width: 33%;float:left;">
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
</div>
    <script>
//        jQuery(document).ready(function($) {
//            if (window.innerWidth < 480) {
//
//                $('#gallery').royalSlider({
//                    arrowsNav: true,
//                    keyboardNavEnabled: true,
//                    controlsInside: false,
//                    imageScaleMode: 'fit',
//                    arrowsNavAutoHide: false,
//                    autoScaleSlider: true,
//                    controlNavigation: 'thumbnails',
//                    thumbsFitInViewport: false,
//                    navigateByClick: true,
//                    startSlideId: 0,
//                    autoPlay: false,
//                    transitionType: 'move',
//                    globalCaption: false,
//                    deeplinking: {
//                        enabled: true,
//                        change: false
//                    },
//                    thumbs: {
//                        appendSpan: true,
//                        firstMargin: false,
////                                orientation: 'horizntal',
//                    },
//                    loop: true
////                            imgWidth: 1400,
////                            imgHeight: 680
//                });
//            } else {
//                $('#gallery').royalSlider({
////                            arrowsNav: true,
//                    loop: false,
//                    keyboardNavEnabled: true,
//                    controlsInside: false,
//                    imageScaleMode: 'fit',
//                    arrowsNavAutoHide: false,
////                        autoScaleSlider: true,
//                    controlNavigation: 'thumbnails',
//                    thumbsFitInViewport: false,
//                    navigateByClick: true,
//                    startSlideId: 0,
//                    autoPlay: false,
//                    transitionType: 'move',
//                    globalCaption: false,
//                    deeplinking: {
//                        enabled: true,
//                        change: false
//                    },
//                    thumbs: {
//                        arrows: true,
//                        appendSpan: true,
//                        firstMargin: false,
//                        orientation: 'vertical'
//                    },
//                    loop: true
//
////                        imgWidth: 1400,
////                        imgHeight: 680
//                });
//            }
//        });
    </script>