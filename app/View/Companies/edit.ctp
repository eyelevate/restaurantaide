<div class="companies form">
<?php echo $this->Form->create('Company'); ?>
	<fieldset>
		<legend><?php echo __('Edit Company'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('area');
		echo $this->Form->input('address');
		echo $this->Form->input('suite');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
		echo $this->Form->input('phone');
		echo $this->Form->input('fax');
		echo $this->Form->input('email');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

