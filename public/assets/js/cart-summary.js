( function( $ ) {

  'use strict';

  function ideaingCartSummay(){

    this.isCart = function(){
      return typeof wc_cart_params === 'undefined' ? false : true;
    }

    this.isCheckout = function(){
      return typeof wc_checkout_params === 'undefined' ? false : true;
    }

    this.isVisible = function(){
      return $( document.body ).hasClass('ics--active');
    }

    this.init();
  }

  ideaingCartSummay.prototype.trigger = function( el, event, options ){

    if (window.CustomEvent) {
      var e = new CustomEvent(event, {detail: options});
    } else {
      var e = document.createEvent('CustomEvent');
      e.initCustomEvent(event, true, true, options);
    }

    el.dispatchEvent(e);
  };

  ideaingCartSummay.prototype.init = function () {

    var self = this;

    $( document ).on('click', '.ics--toggle', function(){
      self.toggle();
    });

    $( document ).on('click', '.ics--open', function(){
      self.open();
    });

    $( document ).on('click', '.ics--close', function(){
      self.close();
    });

    $( document ).on('keyup', function(e){
      console.log(e);
      //self.close();
    });

    setTimeout(function(){ self.build(); }, 0 );
  };

  ideaingCartSummay.prototype.build = function () {

    var self = this;

    self.element = document.createElement('div');
    self.element.id = 'ideaing-g-cart-summary';
    self.element.className = 'global-cart-summary';

    self.element.innerHTML = [
      '<div class="ics--close overlay"></div>',
      '<aside>',
        '<header>',
          '<div class="row">',
            '<div class="col-xs-4">',
              '<label class="ics--close m-icon--arrow_forward"></label>',
            '</div>', // .col-*
            '<div class="col-xs-4">',
              '<strong>Cart</strong>',
            '</div>', // .col-*
            '<div class="col-xs-4 u--i">',
              //'<span class="u--n">Hey Bunny</span>',
              '<span class="u--c">',
                '<span class="m-icon--shopping-bag-light-green"></span>',
                // '<mark>2</mark>',
            '</div>', // .col-*
          '</div>', // .row
        '</header>',

        '<div class="loader">',
          '<div>',
            '<div class="loader">',
              '<ul class="bokeh">',
                '<li></li>',
                '<li></li>',
                '<li></li>',
                '<li></li>',
              '</ul>',
            '</div>',
          '</div>',
        '</div>',
        // '<section>',
        //   'content',
        // '</section>',
        // '<footer>',
        //   'button',
        // '</footer>',
      '</aside>',
    ].join('');

    document.body.appendChild(self.element);


    /////////////////// dummy activation button should be removed in production
    self.dummy = document.createElement('div');
    self.dummy.id = 'dummy-g-cart-summary';
    self.dummy.className = 'ics--open';
    document.body.appendChild(self.dummy);
    ///////////////////
  };

  ideaingCartSummay.prototype.open = function () {

    var self = this;

    console.log('close', self.switching);

    if ( self.switching ) return;

    self.switching = true;

    $( document.body ).addClass('ics--active');

    setTimeout(function(){

      $( document.body ).addClass('ics--on');

      self.switching = false;

    }, 20 );
  };

  ideaingCartSummay.prototype.close = function () {

    var self = this;

    console.log('close', self.switching);

    if ( self.switching ) return;

    self.switching = true;

    $( document.body ).addClass('ics--off');

    setTimeout(function(){

      $( document.body ).removeClass('ics--on ics--off ics--active');

      self.switching = false;

    }, 400 );
  };

  ideaingCartSummay.prototype.toggle = function () {

    this.isVisible() ? this.close() : this.open();
  };

  ideaingCartSummay.prototype.update = function ( data ) {

    var self = this;
  };

  try {

    new ideaingCartSummay();

  } catch (e) {

    console.error(e);
  }

} )( jQuery );
