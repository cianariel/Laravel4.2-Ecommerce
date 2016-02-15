(function ($, root, undefined) {

	$(function () {


// For the simple custom JS functions

        $('body').on('click', '[data-toggle]', function(e){
            e.preventDefault();
            var $that = $(this);
            var $show = $that.data('toggle');
            var $hide = $that.data('hide');
            var $overlay = $that.data('overlay');

            if($hide){
                $($hide).hide();
                $that.siblings().removeClass('active');
            }

            if($overlay){
                $('.page-overlay').fadeToggle();
            }

            $($show).fadeToggle();
            $that.toggleClass('active');
        });

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
            $('.page-overlay').fadeToggle();
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

        $('.shop-by-category-item a').click(function(e){
            e.preventDefault();
            $('.shop-by-category-item').removeClass('active');
            $('.shop-by-category-submneu').removeClass('active');
            
            if($(this).hasClass('show-menus')){
                $(this).parent().addClass('active');
                var submenu = $(this).parent().data('submenu');
                $('.shop-by-category-submneu.' + submenu).addClass('active');
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

        $('.profile-photo').click(function(){
            if($('.profilelinks-popup').is(":visible")){
                $('.profilelinks-popup').hide();
            }else{
                $('.profilelinks-popup').show();
            }
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

        // scroll and stick the share bar
        function sticky_relocate() {
            if(window.innerWidth < 620){
                return false;
            }

            var window_top = $(window).scrollTop();
            var div_top = $('#sticky-anchor').offset().top;
            if (window_top > div_top) {
                $('.sticks-on-scroll').addClass('stick');
            } else {
                $('.sticks-on-scroll').removeClass('stick');
            }
        }

        $(function () {
            if($('#sticky-anchor').length){
                $(window).scroll(sticky_relocate);
                sticky_relocate();
            }
        });

        // Sticking headers
        $(function () {
            $(window).scroll(function(){
                if($('.scroll-header').length){
                    if($(window).scrollTop() < 60){
                        $('header.colophon').removeClass('scroll-header');
                    }
                }else if(($(window).scrollTop() > 60)){
                    $('header.colophon').addClass('scroll-header');
                }

            });
        });

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

        $('#about-button').click(function(){
            $("html, body").animate({ scrollTop: $(document).height() }, "slow");
        });

        //$('.main-content-filter a').click(function(event){
        //    event.preventDefault();
        //    var $contentBox = $('.main-content');
        //    var $type = $(this).data('filterby');
        //
        //    $contentBox.attr('data-only', $type);
        //    //
        //    //$contentBox.removeClass('only-*');
        //    //$contentBox.addClass('only-' + $type);
        //});


	}); // global function()

})(jQuery, this);

//(function() {
//
//    'use strict';
//
//    var loadMore = angular.module('loadMore', [])
//
//    angular
//        .module('loadMore')
//        .factory('content', content);
//
//    content();
//
//    function content($resource) {
//
//        // ngResource call to the API for the users
//        var Content = $resource('paging/get-content');
//
//        // Query the users and return the results
//        function getContent() {
//            return Content.query().$promise.then(function(results) {
//                return results;
//                console.log(results)
//            }, function(error) {
//                console.log(error);
//            });
//        }
//
//        return {
//            getUsers: getContent
//        }
//    }
//})();
