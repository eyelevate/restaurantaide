<div class="taxInfos form">
<?php echo $this->Form->create('TaxInfo'); ?>
	<fieldset>
		<legend><?php echo __('Edit Tax Info'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('company_id');
		echo $this->Form->input('state');
		echo $this->Form->input('rate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TaxInfo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TaxInfo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tax Infos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
