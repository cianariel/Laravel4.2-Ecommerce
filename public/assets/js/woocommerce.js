( function( $ ) {

  'use strict';

  function ideaingCheckout(){

    this.isCheckout = function(){
      return $('body').hasClass('checkout') && $('.form-row').length
    }

    this.init();
  }

  ideaingCheckout.prototype.trigger = function( el, event, options ){

    if (window.CustomEvent) {
      var e = new CustomEvent(event, {detail: options});
    } else {
      var e = document.createEvent('CustomEvent');
      e.initCustomEvent(event, true, true, options);
    }

    el.dispatchEvent(e);
  };

  ideaingCheckout.prototype.init = function () {

    var self = this;

    if ( ! self.isCheckout() ) return;

    $( document ).on('focus', '.form-row input', function(){
      $(this).parent('.form-row').addClass('focus');
    });

    $( document ).on('blur', '.form-row input', function(){
      $(this).parent('.form-row').removeClass('focus');
    });

    $( document ).on('keyup change', '.form-row input', function(){
      self.update();
    });

    $( document ).on('click', '.ship-to-diff-address', function(){
      var checkbox = $('#ship-to-different-address-checkbox'),
          checked = checkbox.prop('checked'),
          label = $(this),
          labeled = $(this).hasClass('same-address');

      if ( checked != labeled ) return;

      checkbox.prop('checked', !labeled).change();
    });

    $( document ).on('change', '#ship-to-different-address-checkbox', function(){

      $('#ship-to-different-address').toggleClass('on-add-billing')
      self.trigger(document.body, 'country_to_state_changed', []);
    });


    // $( document ).on('click', '.ct', function( e ){
    //
    //   e.preventDefault();
    //
    //   self.tab( $(this) );
    //
    // });

    self.update();
  };

  ideaingCheckout.prototype.update = function () {

    var self = this;

    $('.form-row').each( function(){

      self.fielded( $(this).find('input') );
    });
  };

  ideaingCheckout.prototype.fielded = function ( el ) {

    if ( el.val() ){

      el.parent('.form-row').addClass('active');

    } else {

      el.parent('.form-row').removeClass('active');
    }
  };

  $(document).ready(function(){
    var icheckout = new ideaingCheckout();
  });

} )( jQuery );
