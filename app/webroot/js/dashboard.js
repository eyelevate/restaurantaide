$(document).ready(function(){
	
	dashboard.selection();


});

/**
 * Functions
 */
dashboard = {
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
			var addRow = newRow(newCount, order_id, order_name, cat_name, cat_id, new_price);
			var editRow = updateRow(newCount, order_id, order_name, cat_name, cat_id, new_price);

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
			alert('clicked');
			dasboard.totals();
		});
	},
	totals: function(){
		//first grab all of the rows from tbody get qty, pretax
		
	}
}

var newRow = function(count, order_id, order_name, cat_name, cat_id, new_price){
	tr = 
		'<tr id="orderTr-'+order_id+'" class="orderTr">'+
			'<td class="countTd">'+count+'</td>'+
			'<td class="categoryTd">'+cat_name+'</td>'+
			'<td class="orderNameTd">'+order_name+'</td>'+
			'<td class="pretaxTd" pretax="'+new_price+'">$'+new_price+'</td>'+
			'<td><button type="button" id="remove-'+order_id+'" class="btn btn-link btn-small" style="padding:0;">remove</button></td>'+
		'</tr>';
	return tr;
}
var updateRow = function(count, order_id, order_name, cat_name, cat_id, new_price){
	tr = 
		'<td class="countTd">'+count+'</td>'+
		'<td class="categoryTd">'+cat_name+'</td>'+
		'<td class="orderNameTd">'+order_name+'</td>'+
		'<td class="pretaxTd" pretax="'+new_price+'">$'+new_price+'</td>'+
		'<td><button type="button" id="remove-'+order_id+'" class="btn btn-link btn-small" style="padding:0;">remove</button></td>';
	return tr;	
}

