<div class="printers form">
<?php echo $this->Form->create('Printer'); ?>
	<fieldset>
		<legend><?php echo __('Add Printer'); ?></legend>
	<?php
		echo $this->Form->input('company_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
	<div class="formSep"></div>
<?php 
	echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary btn-large'));
	echo $this->Form->end(); 
?>
</div>
