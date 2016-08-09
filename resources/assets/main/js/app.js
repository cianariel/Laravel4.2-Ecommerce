(function ($, root, undefined) {

	$(function () {


// For the simple custom JS functions

        $('body').on('click', '[data-toggle]', function(e){
            e.preventDefault();
            var $that = $(this);
            var $show = $that.data('toggle');
            var $hide = $that.data('hide');
            var $overlay = $that.data('overlay');

            if($overlay){
                $('.page-overlay').fadeToggle();
            }

            if($hide){
                $($hide).hide();
                $that.siblings().removeClass('active');
                $($show).fadeIn();
                $that.toggleClass('active');
            }else{
                $($show).fadeToggle();
                $that.toggleClass('active');
            }
            return false;
        });

        $('body').on('click', '[data-switch]', function(e){
            e.preventDefault();
            var $that = $(this);
            var $show = $that.data('switch');
            var $hide = $that.data('hide');

            $($hide).fadeOut(
                function(){
                    $($show).fadeIn();
                }
            );

            if(!$that.hasClass('active')){
                $that.addClass('active');
                $that.siblings().not($that).removeClass('active');
            }
            return false;
        });

        $('body').on('click', '.search-toggle-button', function(e){
            e.preventDefault();
            var $show = $('.search-bar');
            //var $header = $('.top-nav-holder');

            if(!$show.hasClass('shown')){
                $(this).addClass('active');
                $show.show();
                $show.animate({
                    opacity: '1',
                    top: '50px',
                }, 600)
                //$header.animate({
                //}, 600);
                $show.addClass('shown');
                $show.find('input').focus();
            }else{
                $(this).removeClass('active');

                $show.animate({
                    top: '35px',
                    opacity: 0,
                }, 200);
                $show.fadeOut();
                //$header.animate({
                //}, 500);
                $show.removeClass('shown');
            }
        });

        $('body').on('click', '.hide-search', function(e){
            var $show = $('.search-bar');

            $show.animate({
                top: '35px',
                opacity: 0,
            }, 200);
            $show.blur();
            $show.fadeOut();
            $show.removeClass('shown');
        });



        $(document).click(function(event) {
            if(!$(event.target).closest('.hide-on-out').length) {
                if($('.hide-on-out').is(":visible")) {
                    $('.hide-on-out').fadeOut();
                    $('[data-hideonout]').removeClass('active');
                }
            }
        })

        $('.page-overlay, .login-signup-modal').click(function(event){
            if(event.target !== this){ // only fire if the block itself is clicked, not it's children (sometimes we need to hide the modal when anything outside it's main block is clickced
                return;
            }

            $('.modal, .page-overlay').fadeOut();

            var $hide = $('[data-overlay="true"]').data('toggle');

            if($hide){
                $($hide).hide();
            }
        });

        $('body').on('mouseover', '.rsContent .hero-tags .tag', function(){
            var extraHeroTagsHTML = "<div class='hero-tags extra'></div>";
            if(!$('#hero .hero-tags.extra').length){
                $('#hero .rsOverflow').append(extraHeroTagsHTML);
            }
            $("#hero .rsOverflow .hero-tags.extra ").html($(this)[0].outerHTML);
            $("#hero .rsOverflow .hero-tags.extra a, #hero .rsOverflow .hero-tags.extra .hover-box").show();
        })
        $('body').on('mouseleave', '.hero-tags.extra .tag', function(){
            $("#hero .rsOverflow .hero-tags.extra a, #hero .rsOverflow .hero-tags.extra .hover-box").hide();
        })





        $("#back-to-top").click(function() {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            return false;
        });

        $('[data-scrollto]').click(function() {
            var $scrollNode = $(this).data('scrollto');
            var $scrollTo   = $($scrollNode);
            var $offset     = $scrollTo.offset().top - 70;

            $('html, body').animate({ scrollTop: $offset }, 'slow');
            return false;
        });

        $("li.nested").click(function() {
            $(this).find('ul').fadeToggle();
        });




        $('[data-toggle="modal"]').click(function() {
            var $modal = $(this).data('target');
            $($modal).fadeToggle();
            $('.page-overlay:not(.picture-overlay)').fadeToggle();
            if($($modal).hasClass('login-signup-modal')){
                $('.picture-overlay').show();
            }
        });

        $('[data-dismiss="modal"]').click(function() {
           var $modal = $(this).parents('.modal');
            $modal.fadeOut();
            $('.page-overlay').fadeOut();
            return true;
        });

        $('.desktop-view .shop-by-category-item a.show-menus, .desktop-view .shop-by-category-item a.hide-menus').click(function(e){
            e.preventDefault();
            $('.shop-by-category-item').removeClass('selected');
            $('.shop-by-category-submneu').removeClass('selected');
            
            if($(this).hasClass('show-menus')){
                $(this).parent().addClass('selected');
                var submenu = $(this).parent().data('submenu');
                $('.shop-by-category-submneu.' + submenu).addClass('selected');
            }
        })
        $('.desktop-view .shop-by-category-item').mouseover(function(e){
            $('.shop-by-category-item').removeClass('selected');
            $('.shop-by-category-submneu').removeClass('selected');
            
//            if($(this).find('a').hasClass('show-menus')){
                $(this).addClass('selected');
                var submenu = $(this).data('submenu');
                $('.shop-by-category-submneu.' + submenu).addClass('selected');
//            }
        });
        
        $('.show-and-hide-grandchild').click(function(){
            if($(this).parent().hasClass('selected')){
                $(".shop-by-category-submneu > div").removeClass('selected');
            }else{
                $(".shop-by-category-submneu > div").removeClass('selected');
                $(this).parent().addClass('selected');
            }
        })
        
        
        $('#mobile-shop-by-category-items').change(function(){
            $('.shop-by-category-submneu').removeClass('active');
            var submenu = $(this).val();
            $('.shop-by-category-submneu.' + submenu).addClass('active');
        })

        $('.notification-holder').click(function(){
            if($('.notification-popup').is(":visible")){
                $('.notification-popup').hide();
            }else{
                $('.notification-popup').show();
            }
        })

        $('#top-nav .profile-photo').click(function(){
            if($('.profilelinks-popup').is(":visible")){
                $('.profilelinks-popup').hide();
            }else{
                $('.profilelinks-popup').show();
            }
        })
        $("#top-nav .profilelinks-popup a").click(function(){
            $('.profilelinks-popup').hide();
        })

        $(".show-hero-category").click(function(e){
            e.preventDefault();
            if($(".hideen-hero-category-menu").is(":visible")){
                $(".hideen-hero-category-menu").hide();
            }else{
                $(".hideen-hero-category-menu").show();
            }
        })
        
        $(".hideen-hero-category-menu a").click(function(){
            $(".hideen-hero-category-menu").hide();
        })

        $("body").on('click', '.mobile-show', function(){
            if($(this).find('.p-show').is(":visible")){
                $(this).parent().addClass('hover');
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $(this).parent().removeClass('un-hover');
                }                
                
                $(this).find('.p-show').hide();
                $(this).find('.p-close').show();
            }else{
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $(this).parent().addClass('un-hover');
                }                
                $(this).parent().removeClass('hover');
                $(this).find('.p-show').show();
                $(this).find('.p-close').hide();
            }
        })

        $("body").on('click', '.show-and-hide', function(){
            if($(this).parent().hasClass('active')){
                $('.shop-by-category-item').removeClass('active');
            }else{
                $('.shop-by-category-item').removeClass('active');
                $(this).parent().addClass('active');
            }
        })

        // scroll and stick the share bar
        function sticky_relocate() {

            if(window.innerWidth < 620){
                var div_top = $('#mobile-sticky-anchor').offset().top;
                var window_top = $(window).scrollTop();
                if (window_top > div_top) {
                    $('.ideas-sharing').fadeIn();
                } else {
                    $('.ideas-sharing').fadeOut();
                }
            }else{
                var div_top = $('#sticky-anchor').offset().top;
                var window_top = $(window).scrollTop();
                if (window_top > div_top) {
                    $('.sticks-on-scroll').addClass('stick');
                } else {
                    $('.sticks-on-scroll').removeClass('stick');
                } 
            }

        }

        $(function () {
            if($('#sticky-anchor').length){
                $(window).scroll(sticky_relocate);
                sticky_relocate();
            }
        });

        // Sticking headers
        //$(function () {
        //    $(window).scroll(function(){
        //        if($('.scroll-header').length){
        //            if($(window).scrollTop() < 0){
        //                $('.header-cloak').removeClass('scroll-header');
        //            }
        //        }
        //        //else if(($(window).scrollTop() > 700)){
        //        //    $('.header-cloak').addClass('scroll-header');
        //        //}
        //
        //    });
        //});

        $(function () {
            if(window.innerWidth < 620){
                return false;
            }
            var $showMe = $('.story-header');
            if($showMe.length){
                $(window).scroll(function(){
                    var window_top = $(window).scrollTop();
                    var div_top = $('#hero-nav').offset().top;
                    var $main_header = $('#top-nav');

                    if (window_top > div_top) {
                        $showMe.fadeIn();
                        $main_header.fadeOut();
                    } else {
                        $showMe.fadeOut();
                        $main_header.fadeIn();

                    }
                });
            }
        });

        $('.readmore').readmore({
            startOpen: false,
            collapsedHeight: 300,
            moreLink: '<a class="morelink" href="#">Read more</a>',
            lessLink: '<a class="morelink" href="#">Close</a>',
        });

        $(window).scroll(function() {

            if($(window).scrollTop() + $(window).height() == $(document).height()) {
                $('.bottom-load-more').click();
                $('.bottom-load-more').addClass('disabled').attr('disabled', true);
            }

            if(window.innerWidth > 620){
                return false;
            }

            var body = $('body');
            if(body.hasClass('home') || body.hasClass('room-landing')){
                var $percent = 0.4;
            }else{
                var $percent = 0.5;
            }

            if($('.bottom-block').is(':visible')){
                if($(window).scrollTop() + $(window).height() < $(document).height() * $percent) {
                    $('.bottom-block').fadeOut();
                }
            }else{
                if($(window).scrollTop() + $(window).height() > $(document).height() * $percent) {
                    $('.bottom-block').fadeIn();
                }
            }
            if($('.mobile-sharing').is(':visible')){
                if($(window).scrollTop() + $(window).height() < $(document).height() * 0.1) {
                    $('.mobile-sharing').fadeOut();
                }
            }else{
                if($(window).scrollTop() + $(window).height() > $(document).height() * 0.1) {
                    $('.mobile-sharing').fadeIn();
                }
            }
        });

        $(document).ready(function(){
            setTimeout(function(){
                $('.hero-login').slideDown();
                $('.login-wrap').fadeIn('slow');
            }, 7000)

            if(!$('body').hasClass('.giveaway-page')){
                setTimeout(function(){
                    $('#giveaway-popup').fadeIn('slow');
                }, 30000)
            }


            setInterval(function(){
                    $('.red-logo')
                        .animate({
                            opacity: 1,
                        }, 1000, function() {
                        })
                        .delay(2000)
                        .animate({
                            opacity: 0,
                        }, 1000, function() {
                        })
            }, 20000);
        });



	}); // global function()

    (function(Giveaway, $, undefined) {
        Giveaway.startCountDown = function(duration, display) {
            var timer = duration, days, hours, minutes, seconds;
            setInterval(function () {
                // get total seconds between the times
                var delta = timer;
                // calculate (and subtract) whole days
                var days = Math.floor(delta / 86400);
                delta -= days * 86400;
                // calculate (and subtract) whole hours
                var hours = Math.floor(delta / 3600) % 24;
                delta -= hours * 3600;
                // calculate (and subtract) whole minutes
                var minutes = Math.floor(delta / 60) % 60;
                delta -= minutes * 60;
                // what's left is seconds
                var seconds = delta % 60;  // in theory the modulus is not required

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.text(days + ' days, ' + hours + ' hours, ' + minutes + ' minutes and ' + seconds + ' seconds');

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        Giveaway.fireSlider = function () {
            $('.giveaway-slider-content ').royalSlider({
                arrowsNav: true,
                loop: false,
                keyboardNavEnabled: true,
                controlsInside: true,
                imageScaleMode: 'fit',
                arrowsNavAutoHide: false,
                navigateByClick: false,
                autoPlay: false,
                transitionType: 'move',
                globalCaption: false,
                deeplinking: {
                    enabled: true,
                    change: false
                },
                /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
                imgWidth: "100%",
                imageScaleMode: "fill",
                visibleNearby: {
                    enabled: true,
                    centerArea: 0.25,
                    center: false,
                    breakpoint: 620,
                    breakpointCenterArea: 0.9,
                }
            });
        }

    }( window.Giveaway = window.Giveaway || {}, jQuery ));

    if(window.innerWidth < 1070){ // mobile only
        $(window).scroll(function(){
            $('.homepage-grid .product-box, .related-items  .product-box').each(function(){
                var that = $(this);
                var imgTop = that.offset().top + 450;
                var imgBottom = imgTop + that.height() + 350;
                var window_top = $(window).scrollTop() + $(window).height();
                if (window_top > imgTop && window_top < imgBottom) { // we have scrolled over the element
                    that.addClass('hovered');
                }else if(that.hasClass('hovered')){
                    that.removeClass('hovered');
                }
            });
        });
    }

})(jQuery, this);
