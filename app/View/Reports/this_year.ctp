<?php
//css links
$this->Html->css(array('frames_reports','content','tables','pagination','forms','buttons','style','navigation'),'stylesheet', array('inline' => false)); 
//jquery script
echo $this->Html->script(array('events.js','FusionCharts.js'),FALSE);

/**
 * Header Content
 */
$headerContent =  $this->Html->div('loginInfoDiv',

	$this->Html->para('companyLogout',
		$company_info['company_name'].', '.$this->Html->link('Logout',array('controller'=>'companies','action'=>'logout'))).
	$this->Html->para('userLogout',
		$logged_user.', '.$this->Html->link('Logout',array('controller'=>'users','action'=>'logout'))).
	$this->Html->link('Back',array('controller'=>'reports','action'=>'index'),array('class'=>'backToReportsLink')),
	FALSE
);

$this->set('headerContent',$headerContent);
	

?>
<h1 class="reportH1">Select A Chart Type To View</h1>
<div id="selectYearTypeDiv">
	<select id="selectYearChart">
		<option class="optionYearChart" value="day">By Days</option>
		<option class="optionYearChart" value="week">By Weeks</option>
		<option class="optionYearChart" value="month">By Month</option>
	</select>	
</div>

<div id="yearChart-day" class="chart" name="selected">
	<?php echo $this->FusionCharts->render('Line2D Chart'); ?>
</div>
<div id="yearChart-week" class="chart" name="notselected">
	<?php echo $this->FusionCharts->render('Area2D Chart'); ?>
</div>
<div id="yearChart-month" class="chart" name="notselected">
	<?php echo $this->FusionCharts->render('Column3DLineDY Chart'); ?>
</div>
<div class="reportSummary">
	<h1>This Year Report - <?php echo date('Y');?></h1>
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
		<table class="reportTable">
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
				<tr>
					<td class="reportTableTfootTd-empty"></td>
					<td class="reportTableTfootTd-empty"></td>
					<td class="reportTableTfootTd">Total Quantity</td>
					<td><?php echo $category_quantity;?></td>
				</tr>
				<tr>
					<td class="reportTableTfootTd-empty"></td>
					<td class="reportTableTfootTd-empty"></td>
					<td class="reportTableTfootTd">Total Before Tax</td>
					<td><?php echo '$'.$category_before_tax;?></td>
				</tr>
				<tr>
					<td class="reportTableTfootTd-empty"></td>
					<td class="reportTableTfootTd-empty"></td>
					<td class="reportTableTfootTd">Total Tax</td>
					<td><?php echo '$'.$category_sum_tax;?></td>
				</tr>	
				<tr>
					<td class="reportTableTfootTd-empty"></td>
					<td class="reportTableTfootTd-empty"></td>
					<td class="reportTableTfootTd">Total After Tax</td>
					<td><?php echo '$'.$category_after_tax;?></td>
				</tr>
			</tfoot>
		</table>
		<?php
	}
	?>
	<h2>End of day Totals</h2>
	<table class="reportTable">
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
				<td class="reportTableTfootTd-empty"></td>
				<td class="reportTableTfootTd-empty"></td>
				<td class="reportTableTfootTd">Total Quantity</td>
				<td><?php echo $eod_quantity;?></td>
			</tr>
			<tr>
				<td class="reportTableTfootTd-empty"></td>
				<td class="reportTableTfootTd-empty"></td>
				<td class="reportTableTfootTd">Total Before Tax</td>
				<td><?php echo '$'.$eod_before_tax;?></td>
			</tr>
			<tr>
				<td class="reportTableTfootTd-empty"></td>
				<td class="reportTableTfootTd-empty"></td>
				<td class="reportTableTfootTd">Total Tax</td>
				<td><?php echo '$'.$eod_sum_tax;?></td>
			</tr>	
			<tr>
				<td class="reportTableTfootTd-empty"></td>
				<td class="reportTableTfootTd-empty"></td>
				<td class="reportTableTfootTd">Total After Tax</td>
				<td><?php echo '$'.$eod_after_tax;?></td>
			</tr>
		</tfoot>
	</table>	
</div>