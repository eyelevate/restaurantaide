$(document).ready(function(){
	orders.numberformat();
});


/**
 *Functions
 *  
 */

orders = {
	numberformat: function(){
		//number formatting

		$(".price").priceFormat({
			'prefix':'',
		});
	},
}
