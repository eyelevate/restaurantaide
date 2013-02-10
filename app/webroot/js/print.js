$(document).ready(function(){
	printing.findPrinter();
	
	printing.printSalesReciept();
	printing.printSalesCopy();
	
	
});


/**
 *Functions 
 */


printing = {
	findPrinter: function(){
		var mainPrinter = $("#mainPrinter").val();	
		document.jzebra.findPrinter(mainPrinter);
	},
	printSalesReciept: function(){
		
	},
	printSalesCopy: function(){
		
	}
}
