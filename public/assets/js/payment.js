(function(){

	var StripeBilling = {
		init: function(){
		//	alert('hi');
			this.form = $('#billing-form');
			this.submitButton = this.form.find('input[type=submit]');

			var stripeKey = $('#pub').val();

			Stripe.setPublishableKey(stripeKey);
		}
	};

	StripeBilling.init();
})();