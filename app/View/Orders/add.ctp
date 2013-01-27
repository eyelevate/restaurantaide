<div class="orders form">
<?php echo $this->Form->create('Order'); ?>
	<fieldset class="formSep">
		<legend><?php echo __('Add Order'); ?></legend>
	<?php
		$options = array(''=>'Select Category');

		foreach ($categories as $cat) {
			$cat_id = $cat['Category']['id'];
			$cat_name = $cat['Category']['name'];

			$options[$cat_id] = $cat_name;
		}
		echo $this->Form->input('category',array(
			'label'=>'<label>Category <span class="f_req">*</span></label>',
			'options'=>$options,
        	'error' => array('attributes' => array('class' => 'text-error'))
		));
		echo $this->Form->input('name',array(
			'label'=>'<label>Order Name <span class="f_req">*</span></label>',
        	'error' => array('attributes' => array('class' => 'text-error'))		
		));
		echo $this->Form->input('description',array(
        	'error' => array('attributes' => array('class' => 'text-error'))
		));

		echo $this->Form->input('price',array(
        	'div' => array('class' => 'control-group', 'id'=>'priceDiv'),
        	'label' => false,
        	'before' => '<label class="control-label">Price <span class="f_req">*</span></label><div class="input-prepend"><span class="add-on">$</span>',
        	'after'=>'</div><span class="help-block"></span>',
        	'class' => 'price',
        	'error' => array('attributes' => array('class' => 'text-error')),
        	'placeholder'=>'Enter Price Here'
					
		));
	?>
	</fieldset>

<?php
echo $this->Form->submit('Add Order',array('class'=>array('btn btn-large btn-primary')));
echo $this->Form->end(); 
?>	


</div>
