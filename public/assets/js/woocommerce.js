( function( $ ) {

  'use strict';

  function ideaingCheckout(){

    this.isCheckout = function(){
      return typeof wc_checkout_params === 'undefined' ? false : true;
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

      $('#ship-to-different-address').toggleClass('on-add-billing');

      self.trigger(document.body, 'country_to_state_changed', []);
    });

    $( document ).on('change', '#createaccount', function(){

      $(this).parents('.create-account').toggleClass('on-create-account');
    });

    $( document ).on('click', '.on2', function( e ){

      $( document.body ).toggleClass('on-2');

      self.trigger(document.body, 'update_checkout', []);
    });

    $( document.body ).on('update_checkout', function(){

      self.review();
    });

    self.update();
    setTimeout(function(){ self.update(); }, 50 );
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

  ideaingCheckout.prototype.review = function ( el ) {

    $('[data-live]').each( function(){

      var live = $(this),
          look = live.attr('data-live'),
          target = $(look);

      live.html('');

      if (target.length) {

        target.each(function(){

          var s = $(this),
              v = s.val();

          switch ( live.attr('data-live-type') ){

            case 'radio':

              v = $('[for="'+$('[name="'+ s.attr('name') +'"]:checked').attr('id')+'"]').html();

            break;

            case 'select':

              v = s.find('option:selected').text();

            break;

          }

          live.html(v);
        });
      }
    });
  };

  $(document).ready(function(){
    var icheckout = new ideaingCheckout();
  });

} )( jQuery );
