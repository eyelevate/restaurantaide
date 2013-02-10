
<div class="categories form">
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php echo __('Add Category'); ?></legend>
	<?php

		//echo $this->Form->input('category_list');
		echo $this->Form->input('name',array(
			'label'=>'Category Label <span class="f_req">*</span>',
			'placeholder'=>'Name of the category',
			'class'=>'span6',
			'div'=>'control-group',
			'error'=>array('attributes' => array('class' => 'help-block')),
			
		));
		//echo $this->Form->input('status');
	?>
	</fieldset>
<?php
	echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary'));
	echo $this->Form->end(); 
?>
</div>
