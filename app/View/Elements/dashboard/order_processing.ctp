<?php
/**
 * Order Processing
 * 
 */

?>
<div>
	<table id="orderProcessingTable" class="table table-condensed table-hover table-striped table-bordered">
		<thead>
			<tr>
				<th>Quantity</th>
				<th>Category</th>
				<th>Name</th>
				<th>Price</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
		<tfoot>
			<tr>
				<th class="" colspan="3" style="border-top:1px solid #5e5e5e;"></th>
				<th style="border-top:1px solid #5e5e5e;">Quantity</th>
				<td id="qtyTotalTd" style="border-top:1px solid #5e5e5e;"></td>
			</tr>
			<tr>
				<th class="" colspan="3" style="border-top:none"></th>
				<th>Pre-tax</th>
				<td id="pretaxTotalTd"></td>
			</tr>
			<tr>
				<th class="" colspan="3" style="border-top:none"></th>
				<th>Tax</th>
				<td id="taxTotalTd"></td>
			</tr>
			<tr>
				<th class="" colspan="3" style="border-top:none"></th>
				<th>Total</th>
				<td id="aftertaxTotalTd"></td>
			</tr>
		</tfoot>
	</table>
</div>
