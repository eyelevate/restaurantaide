$(document).ready(function(){
	dashboard.basicScripts();
	dashboard.selection();
	dashboard.numberformat();	
	
	dashboard.finishOrder();

});

/**
 * Functions
 */
dashboard = {
	basicScripts: function(){
		$("#cancelOrderButton").click(function(){
			if(confirm('This will cancel your order. Are you sure?')){
				location.reload();
			}
		});	
		$("#paymentButton").click(function(){
			var checkQty = $("#qtyTotalTd").html();
			if(checkQty ==''){
				checkQty = 0;
			} else {
				checkQty = parseInt(checkQty);
			}

			if(checkQty > 0){

				$("#paymentButton-modal").click()
			} else {

				alert('You must select an order before processing');
			}
		});
	},
	numberformat: function(){
		//number formatting

		$(".tendered").priceFormat({
			'prefix':'',
		});
	},
	selection: function(){
		$(".ordersButton").click(function(){
			var count = $(this).attr('count');
			var newCount = parseInt(count)+1;
			$(this).attr('count',newCount);
			var order_id = $(this).val();
			var order_name = $(this).attr('order_name');
			var price = $(this).attr('price');
			var cat_name = $(this).attr('cat_name');
			var cat_id = $(this).attr('category');
			var new_price = parseInt(newCount) * parseFloat(price);
			var new_price = new_price.toFixed(2);
			var tax_rate = parseFloat($("#tax_rate").val());
			
			var after_tax = afterTax(new_price, tax_rate);

			var addRow = newRow(newCount, order_id, order_name, cat_name, cat_id, new_price, after_tax);
			var editRow = updateRow(newCount, order_id, order_name, cat_name, cat_id, new_price, after_tax);

			if(newCount == 1){				
				$("#orderProcessingTable tbody").append(addRow);	
			} else {
				$("#orderProcessingTable tbody #orderTr-"+order_id).html(editRow);
			}
			
			dashboard.addScript(order_id);
			dashboard.totals();
		});
	}, 
	addScript: function(order_id){
		$("#remove-"+order_id).click(function(){
			if(confirm('Are you sure you want to delete order?')){
				$(this).parents('tr:first').remove();
				$("#ordersButton-"+order_id).attr('count','0');
				dashboard.totals();
			}
		});
		$("#cashTendered").keyup(function(){
			var cashDue = $("#cashDue").val();
			var cashTendered = $(this).val();
			var change = parseFloat(cashTendered) - parseFloat(cashDue);
			var change = change.toFixed(2);
			if(change < 0){
				$("#changeDue").parent().parent().parent().removeClass('success');				
				$("#changeDue").parent().parent().parent().addClass('error');
				$("#changeDue").parent().parent().parent().find('.help-block').html('Improper count of change. Please enter in a valid tender');	
				$("#cashTendered").parent().parent().parent().addClass('error');
				$("#cashTendered").parent().parent().parent().find('.help-block').html('');
			} else {
				$("#changeDue").parent().parent().parent().removeClass('error');
				$("#changeDue").parent().parent().parent().addClass('success');
				$("#changeDue").parent().parent().parent().find('.help-block').html('');
				
				$("#cashTendered").parent().parent().parent().removeClass('error');
				$("#cashTendered").parent().parent().parent().find('.help-block').html('');		
			}			
			$("#changeDue").val(change);
			
			//clear out other payment inputs
			$("#creditNumber").val('');
			$("#checkNumber").val('');
		});
		
		$(".quickCashButton").click(function(){
			var cashTendered = $(this).val();
			$("#cashTendered").val(cashTendered);
			var cashDue = $("#cashDue").val();
			var change = parseFloat(cashTendered) - parseFloat(cashDue);
			var change = change.toFixed(2);
			if(change < 0){
				$("#changeDue").parent().parent().parent().removeClass('success');				
				$("#changeDue").parent().parent().parent().addClass('error');
				$("#changeDue").parent().parent().parent().find('.help-block').html('Improper count of change. Please enter in a valid tender');	
				$("#cashTendered").parent().parent().parent().addClass('error');
				$("#cashTendered").parent().parent().parent().find('.help-block').html('');
			} else {
				$("#changeDue").parent().parent().parent().removeClass('error');
				$("#changeDue").parent().parent().parent().addClass('success');
				$("#changeDue").parent().parent().parent().find('.help-block').html('');
				
				$("#cashTendered").parent().parent().parent().removeClass('error');
				$("#cashTendered").parent().parent().parent().find('.help-block').html('');		
			}
			$("#changeDue").val(change);
		});
		
		$("#creditNumber").keyup(function(){
			$("#checkNumber").val('');
			$("#cashTendered").val('');
			$("#changeDue").val('');
		});
		$("#checkNumber").keyup(function(){
			$("#checkNumber").val('');
			$("#cashTendered").val('');
			$("#changeDue").val('');
		});

	},
	totals: function(){
		//first grab all of the rows from tbody get qty, pretax
		total_qty = 0;
		$("#orderProcessingTable tbody .qtyInput").each(function(){
			var qty = parseInt($(this).val());
			total_qty = total_qty+qty;
		});
		
		total_pre_tax = 0;
		$("#orderProcessingTable tbody .pretaxInput").each(function(){
			var pretax = parseFloat($(this).val());
			total_pre_tax = total_pre_tax +pretax;
		});
		
		total_after_tax = 0;
		$("#orderProcessingTable tbody .aftertaxInput").each(function(){
			var aftertax = parseFloat($(this).val());
			total_after_tax = total_after_tax +aftertax;
		});		
		total_tax = parseFloat(total_after_tax) - parseFloat(total_pre_tax);
		total_tax = total_tax.toFixed(2);
		total_pre_tax = total_pre_tax.toFixed(2);
		total_after_tax = total_after_tax.toFixed(2);
		
		
		$("#qtyTotalTd").html(total_qty);
		$("#pretaxTotalTd").html('$'+total_pre_tax);
		$("#taxTotalTd").html('$'+total_tax);
		$("#aftertaxTotalTd").html('$'+total_after_tax);
		
		//update the hidden input fields
		var tq = updateTotalQty(total_qty);
		var bt = updateTotalBeforeTax(total_pre_tax);
		var at = updateTotalAfterTax(total_after_tax);
		var tt = updateTotalTax(total_tax);
		
		$("#invoiceSummary").html(tq+bt+at+tt);
		
		//add to payment modal
		$(".totalDue").val(total_after_tax);
		
	},
	finishOrder: function(){
		$("#finishOrderButton").click(function(){
			var type = $("#paymentTypeUl .active").attr('row');
			$(".paymentTypeInput").val(type);

			//do printing scripts here
			switch(type){
				case 'cash':
					var tendered = $("#cashTendered").val();
					if(tendered =='' || tendered =='0.00'){
						$("#cashTendered").parent().parent().parent().addClass('error');
						$("#cashTendered").parent().parent().parent().find('.help-block').html('Not a valid tender amount');
					} else {
						$("#cashTendered").parent().parent().parent().removeClass('error');
						$("#cashTendered").parent().parent().parent().find('.help-block').html('');		
						var change = parseFloat($("#changeDue").val());
						var change = change.toFixed(2);
						if(change < 0){
							$("#changeDue").parent().parent().parent().removeClass('success');				
							$("#changeDue").parent().parent().parent().addClass('error');
							$("#changeDue").parent().parent().parent().find('.help-block').html('Improper count of change. Please enter in a valid tendered amount.');	
							$("#cashTendered").parent().parent().parent().addClass('error');
							$("#cashTendered").parent().parent().parent().find('.help-block').html('');
					
						} else {
							$("#changeDue").parent().parent().parent().removeClass('error');
							$("#changeDue").parent().parent().parent().addClass('success');
							$("#changeDue").parent().parent().parent().find('.help-block').html('');
							
							$("#cashTendered").parent().parent().parent().removeClass('error');
							$("#cashTendered").parent().parent().parent().find('.help-block').html('');
							dashboard.printSalesReciept();
						
									
						}						
					
					}
				break;
				
				case 'credit':
					dashboard.printSalesReciept();
				break;
				
				case 'check':
					dashboard.printSalesReciept();
				break;
			}
			
		});
	},
	printSalesReciept: function(){
		
		//alert('now printing')
		//print the copy and send the form
		dashboard.printSalesCopy();
		
	},
	printSalesCopy: function(){
		//alert('now sending')
		//send the form 
		$(".invoiceForm").submit();				
	}
}


var newRow = function(count, order_id, order_name, cat_name, cat_id, new_price, after_tax){

	var idx = $("#orderProcessingTable tbody tr").length;

	tr = 
		'<tr id="orderTr-'+order_id+'" class="orderTr" row="'+idx+'">'+
			'<td class="countTd">'+count+'</td>'+
			'<td class="categoryTd">'+cat_name+'</td>'+
			'<td class="orderNameTd">'+order_name+'</td>'+
			'<td class="pretaxTd" pretax="'+new_price+'">$'+new_price+'</td>'+
			'<td>'+
				'<button type="button" id="remove-'+order_id+'" class="btn btn-link btn-small" style="padding:0;">remove</button>'+
				'<div class="hiddenOrderForm hide">'+
					'<input class="qtyInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][quantity]" value="'+count+'"/>'+
					'<input class="catidInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][category]" value="'+cat_id+'"/>'+
					'<input class="orderidInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][order_id]" value="'+order_id+'"/>'+
					'<input class="pretaxInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][before_tax]" value="'+new_price+'"/>'+
					'<input class="aftertaxInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][after_tax]" value="'+after_tax+'"/>'+
				'<div>'+
			'</td>'+
		'</tr>';
	return tr;
}
var updateRow = function(count, order_id, order_name, cat_name, cat_id, new_price, after_tax){
	after_tax = after_tax.toFixed(2);
	var idx = $("#orderProcessingTable tbody #orderTr-"+order_id).attr('row');

	tr = 
		'<td class="countTd">'+count+'</td>'+
		'<td class="categoryTd">'+cat_name+'</td>'+
		'<td class="orderNameTd">'+order_name+'</td>'+
		'<td class="pretaxTd" pretax="'+new_price+'">$'+new_price+'</td>'+
		'<td>'+
			'<button type="button" id="remove-'+order_id+'" class="btn btn-link btn-small" style="padding:0;">remove</button>'+
			'<div class="hiddenOrderForm hide">'+
				'<input class="qtyInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][quantity]" value="'+count+'"/>'+
				'<input class="catidInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][category]" value="'+cat_id+'"/>'+
				'<input class="orderidInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][order_id]" value="'+order_id+'"/>'+
				'<input class="pretaxInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][before_tax]" value="'+new_price+'"/>'+
				'<input class="aftertaxInput" type="hidden" name="data[InvoiceLineitem]['+idx+'][after_tax]" value="'+after_tax+'"/>'+
			'<div>'+
		'</td>';
	return tr;	
}

var updateTotalQty = function(qty){
	input = 
		'<input type="hidden" name="data[Invoice][quantity]" value="'+qty+'"/>';
		
	return input;
}

var updateTotalBeforeTax = function(before_tax){
	input = 
		'<input type="hidden" name="data[Invoice][before_tax]" value="'+before_tax+'"/>';
		
	return input;
}

var updateTotalAfterTax = function(after_tax){

	input = 
		'<input type="hidden" name="data[Invoice][after_tax]" value="'+after_tax+'"/>';
		
	return input;
}

var updateTotalTax = function(tax){
	input = 
		'<input type="hidden" name="data[Invoice][tax]" value="'+tax+'"/>';
		
	return input;
}
var afterTax = function(before_tax, tax){
	var before_tax = parseFloat(before_tax);
	var tax = parseFloat(tax);
	var after_tax = before_tax * (1+tax);
	var after_tax = after_tax*100;
	var after_tax = Math.round(after_tax);
	var after_tax = after_tax / 100;	
	
	return after_tax;
}
