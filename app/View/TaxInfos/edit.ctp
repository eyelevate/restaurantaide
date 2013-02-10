<div class="taxInfos form">
<?php echo $this->Form->create('TaxInfo'); ?>
	<fieldset class="formSep">
		<legend><?php echo __('Add Tax Info'); ?></legend>
	<?php
		//echo $this->Form->input('company_id');
		echo $this->Form->input('state');
		echo $this->Form->input('rate',array(
			'label'=>false,
			'before'=>'<label>Tax Rate <span class="f_req">*</span></label><div class="input-append">',
			'after'=>'<span class="add-on">%</span></div><span class="help-block"></span>',
			'error' => array('attributes' => array('class' => 'text-error')),
			'placeholder'=>'i.e. 9.50'
		));
	?>
	</fieldset>
<?php 
echo $this->Form->submit('Set Tax Rate',array('class'=>'btn btn-primary btn-large'));
echo $this->Form->end(); 
?>
</div>

