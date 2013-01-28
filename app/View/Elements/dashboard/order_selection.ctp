<?php
/**
 * Content for order selection goes here
 */
?>
<div class="tabbable tabbable-bordered">
	<ul class="nav nav-tabs">
		<?php
		$idx = -1;
		foreach ($categories as $cat) {
			$idx = $idx+1;
			$cat_id = $cat['Category']['id'];
			$cat_name = $cat['Category']['name'];
			
			if($idx == 0){
			?>
			<li class="active"><a data-toggle="tab" href="#tab_br<?php echo $cat_id;?>"><?php echo $cat_name;?></a></li>
			<?php
			} else {
			?>
			<li><a data-toggle="tab" href="#tab_br<?php echo $cat_id;?>"><?php echo $cat_name;?></a></li>
			<?php				
			}
		}
		?>
	</ul>
	<div class="tab-content">
		<?php
		$idx = -1;
		foreach ($categories as $cat) {
			$idx = $idx+1;
			$cat_id = $cat['Category']['id'];
			$cat_name = $cat['Category']['name'];
			
			if($idx == 0){
			?>
			<div id="tab_br<?php echo $cat_id;?>" class="tab-pane active">
			<?php
			foreach ($orders as $order) {
				$idx = $idx+1;
				$category = $order['Order']['category'];
				$order_id = $order['Order']['id'];
				$order_name = $order['Order']['name'];
				$order_price = $order['Order']['price'];
				if($category==$cat_id){
				?>
				<button id="ordersButton-<?php echo $order_id;?>" class="ordersButton btn btn-large" type="button" category="<?php echo $category;?>" cat_name="<?php echo $cat_name;?>" count="0" value="<?php echo $order_id;?>" order_name="<?php echo $order_name;?>" price="<?php echo $order_price;?>">
					<?php echo $order_name;?>
					<br/><br/>
					<span class="badge badge-inverse">$<?php echo $order_price;?></span>
				</button>
				<?php
				}
				?>
				
				<?php
			}			
			?>
			</div>
			<?php
			} else {
			?>
			<div id="tab_br<?php echo $cat_id;?>" class="tab-pane">
			<?php
			foreach ($orders as $order) {
				$idx = $idx+1;
				$category = $order['Order']['category'];
				$order_id = $order['Order']['id'];
				$order_name = $order['Order']['name'];
				$order_price = $order['Order']['price'];
				if($category==$cat_id){
				?>
				<button id="ordersButton-<?php echo $order_id;?>" class="ordersButton btn btn-large" type="button" category="<?php echo $category;?>" cat_name="<?php echo $cat_name;?>" count="0" value="<?php echo $order_id;?>" order_name="<?php echo $order_name;?>" price="<?php echo $order_price;?>">
					<?php echo $order_name;?>
					<br/><br/>
					<span class="badge badge-inverse">$<?php echo $order_price;?></span>
				</button>
				<?php
				}
				?>
				
				<?php
			}			
			?>				
			</div>
			<?php				
			}
		}
		?>
	</div>
</div>