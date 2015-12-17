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
                $('#overlay').fadeToggle();
            }

            $($show).fadeToggle();
            $that.toggleClass('active');
        });

        $('#overlay').click(function(){
            $('.modal, #overlay').fadeOut();

            var $hide = $('[data-overlay="true"]').data('toggle');

            if($hide){
                $($hide).hide();
            }
        });

        $("#back-to-top").click(function() {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            return false;
        });

        $("li.nested").click(function() {
            $(this).find('ul').fadeToggle();
        });




        $('[data-toggle="modal"]').click(function() {
            $modal = $(this).data('target');
            $($modal).fadeToggle()
            $('#overlay').fadeToggle();

        });

        $('[data-dismiss="modal"]').click(function() {
            $modal = $(this).parents('.modal');
            $modal.fadeOut();
            $('#overlay').fadeOut();
            return true;
        });

        // scroll and stick the share bar
        function sticky_relocate() {
            if(window.innerWidth < 1300){
                console.log(window.innerWidth)
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




	}); // global function()

})(jQuery, this);

