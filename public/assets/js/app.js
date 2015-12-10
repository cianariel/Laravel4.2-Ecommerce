// For the simple custom JS functions

//if (screen.width < 992 && screen.width > 620) {
//    document.getElementById("viewport").setAttribute("content", "width=992");
//}

$('body').on('click', '[data-toggle]', function(e){
    e.preventDefault();
    var $that = $(this);
    var $show = $that.data('toggle');
    var $hide = $that.data('hide');

    if($hide){
        $($hide).hide();
        $that.siblings().removeClass('active');
    }

    $($show).fadeToggle();
    $that.addClass('active');
});

$('#overlay').click(function(){
    $('.modal, #overlay').fadeOut();
});

$("#back-to-top").click(function() {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    return false;
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