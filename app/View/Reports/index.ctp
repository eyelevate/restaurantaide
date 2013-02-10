<?php

//alerts on page
echo $this->TwitterBootstrap->flashes(array(
    "auth" => False,
    "closable"=>true
    )
);


$todayDate = 'todays date';
?>
<div class="row-fluid">
	<legend>Reports</legend>
	<ul>
		<li><?php echo $this->Html->link('Today',array('action'=>'today'));?></li>
		<li><?php echo $this->Html->link('This Week',array('action'=>'thisWeek'));?></li>
		<li><?php echo $this->Html->link('This Month',array('action'=>'thisMonth'));?></li>
		<li><?php echo $this->Html->link('This Year',array('action'=>'thisYear'));?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link('Yesterday',array('action'=>'yesterday'));?></li>
		<li><?php echo $this->Html->link('Last Week',array('action'=>'lastWeek'));?></li>
		<li><?php echo $this->Html->link('Last Month',array('action'=>'lastMonth'));?></li>
		<li><?php echo $this->Html->link('Last Year',array('action'=>'lastYear'));?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link('By Dates',array('action'=>'byDates'));?></li>
		<li><?php echo $this->Html->link('By Week',array('action'=>'byWeeks'));?></li>
		<li><?php echo $this->Html->link('By Month',array('action'=>'byMonth'));?></li>
		<li><?php echo $this->Html->link('By Year',array('action'=>'byYear'));?></li>
	</ul>
</div>
<?php



?>