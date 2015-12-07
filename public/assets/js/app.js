// For the simple custom JS functions

$('body').on('click', '[data-toggle]', function(e){
    var $that = $(this);
    var $show = $that.data('toggle');
    var $hide = $that.data('hide');

    if($hide){
        $($hide).hide();
        $that.siblings().removeClass('active');
    }

    $($show).toggle();
    $that.addClass('active');
});

$("#back-to-top").click(function() {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    return false;
});