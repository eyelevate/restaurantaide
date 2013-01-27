<div class="taxInfos view">
<h2><?php  echo __('Tax Info'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($taxInfo['TaxInfo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($taxInfo['Company']['name'], array('controller' => 'companies', 'action' => 'view', $taxInfo['Company']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($taxInfo['TaxInfo']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($taxInfo['TaxInfo']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($taxInfo['TaxInfo']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($taxInfo['TaxInfo']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tax Info'), array('action' => 'edit', $taxInfo['TaxInfo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tax Info'), array('action' => 'delete', $taxInfo['TaxInfo']['id']), null, __('Are you sure you want to delete # %s?', $taxInfo['TaxInfo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tax Infos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tax Info'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
