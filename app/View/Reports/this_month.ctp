
<div class="chart">

<?php echo $this->FusionCharts->render('Column3D Chart'); ?>
</div>

<div class="reportSummary formSep">
	<h1>This Month's Report - <?php echo date('F Y');?></h1>
	<h2>By Category</h2>
	<?php
	//set report variables here
	$category_count = count($category);
	$eod_quantity = $endOfDay['quantity'];
	$eod_before_tax = $endOfDay['before_tax'];
	$eod_sum_tax = $endOfDay['tax'];
	$eod_after_tax = $endOfDay['after_tax'];
	for ($i=0; $i < $category_count; $i++) { 
		$category_name = $category[$i]['Category']['name'];
		$category_before_tax = $category_totals[$i]['before_tax'];
		$category_after_tax = $category_totals[$i]['after_tax'];
		$category_quantity =$category_totals[$i]['quantity'];
		$category_sum_tax = $category_totals[$i]['tax'];
		?>
		<h3><?php echo $category_name;?></h3>
		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>Item</th>
					<th>Category</th>
					<th>Quantity</th>
					<th>Before Tax</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$orders_report_count = count($orders_report[$category_name]);
				for ($b=1; $b < $orders_report_count+1; $b++) { 
					$item_name[$category_name][$b] = $orders_report[$category_name][$b]['name'];
					$item_quantity[$category_name][$b] = $orders_report[$category_name][$b]['quantity'];
					$item_before_tax[$category_name][$b] = $orders_report[$category_name][$b]['total'];
					?>
					<tr>
						<td><?php echo $item_name[$category_name][$b];?></td>					
						<td><?php echo $category_name;?></td>
						<td><?php echo $item_quantity[$category_name][$b];?></td>
						<td><?php echo '$'.$item_before_tax[$category_name][$b];?></td>
					</tr>
					<?php
					
				}
				
				?>

			</tbody>
			<tfoot>
				<tr class="reportsTfootTrTop">
					<td class="" style="border-top:1px solid #000000;"></td>
					<td class="" style="border-top:1px solid #000000; border-left:none"></td>
					<td class="" style="border-top:1px solid #000000;"><strong>Total Quantity</strong></td>
					<td style="border-top:1px solid #000000;"><?php echo $category_quantity;?></td>
				</tr>
				<tr>
					<td class="" style="border-top:none; "></td>
					<td class="" style="border-top:none; border-left:none;"></td>
					<td class=""><strong>Total Before Tax</strong></td>
					<td ><?php echo '$'.$category_before_tax;?></td>
				</tr>
				<tr>
					<td style="border-top:none;"></td>
					<td style="border-top:none; border-left:none;"></td>
					<td ><strong>Total Tax</strong></td>
					<td><?php echo '$'.$category_sum_tax;?></td>
				</tr>	
				<tr>
					<td style="border-top:none;"></td>
					<td style="border-top:none; border-left:none;"></td>
					<td><strong>Total After Tax</strong></td>
					<td><?php echo '$'.$category_after_tax;?></td>
				</tr>
			</tfoot>
		</table>
		<?php
	}
	?>
	<h2>End of day Totals</h2>
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th>Category</th>
				<th>Quantity</th>
				<th>Before Tax</th>
				<th>After Tax</th>
			</tr>

		</thead>
		<tbody>
			<?php
			for ($i=0; $i < $category_count; $i++) {
				$category_name = $category[$i]['Category']['name']; 
				$category_before_tax = $category_totals[$i]['before_tax'];
				$category_after_tax = $category_totals[$i]['after_tax'];
				$category_quantity =$category_totals[$i]['quantity'];
				$category_sum_tax = $category_totals[$i]['tax'];
				?>
			<tr>
				<td><?php echo $category_name;?></td>
				<td><?php echo $category_quantity;?></td>
				<td><?php echo '$'.$category_before_tax;?></td>
				<td><?php echo '$'.$category_after_tax;?></td>
			</tr>
				<?php
			
			}
			?>
			
		</tbody>
		<tfoot>
			<tr>
				<td style="border-top:1px solid #000000;"></td>
				<td style="border-top:1px solid #000000; border-left:none"></td>
				<td style="border-top:1px solid #000000;"><strong>Total Quantity</strong></td>
				<td style="border-top:1px solid #000000;"><?php echo $eod_quantity;?></td>
			</tr>
			<tr>
				<td style="border-top:none;"></td>
				<td style="border-top:none; border-left:none;" ></td>
				<td ><strong>Total Before Tax</strong></td>
				<td><?php echo '$'.$eod_before_tax;?></td>
			</tr>
			<tr>
				<td style="border-top:none;"></td>
				<td style="border-top:none; border-left:none;"></td>
				<td ><strong>Total Tax</strong></td>
				<td><?php echo '$'.$eod_sum_tax;?></td>
			</tr>	
			<tr>
				<td style="border-top:none;"></td>
				<td style="border-top:none; border-left:none;"></td>
				<td ><strong>Total After Tax</strong></td>
				<td><?php echo '$'.$eod_after_tax;?></td>
			</tr>
		</tfoot>
	</table>		
</div>
<div>
	<button id="printReport-this_month" type="button" class="printReport btn btn-primary btn-large">Print Report</button>
</div>