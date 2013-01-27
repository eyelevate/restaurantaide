<?php
//add scripts to header
echo $this->Html->script(array('dashboard.js'),FALSE);
//alerts on page
echo $this->TwitterBootstrap->flashes(array(
    "auth" => False,
    "closable"=>true
    )
);

?>
<div class="row-fluid span12">
	<div class="row">
		<div class="span6">
			<h3 class="heading">Order Selection</h3>
			<?php
			echo $this->element('/dashboard/order_selection',array(
				'categories'=>$categories,
				'orders'=>$orders
			));
			?>
		</div>	
		<div class="span6">
			<h3 class="heading">Order Processing</h3>
			<?php
			echo $this->element('/dashboard/order_processing',array(
			));
			?>
		</div>		
	</div>

</div>