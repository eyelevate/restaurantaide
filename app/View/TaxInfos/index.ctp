<div class="taxInfos index">
	<h2><?php echo __('Tax Infos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('company_id'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($taxInfos as $taxInfo): ?>
	<tr>
		<td><?php echo h($taxInfo['TaxInfo']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($taxInfo['Company']['name'], array('controller' => 'companies', 'action' => 'view', $taxInfo['Company']['id'])); ?>
		</td>
		<td><?php echo h($taxInfo['TaxInfo']['state']); ?>&nbsp;</td>
		<td><?php echo h($taxInfo['TaxInfo']['rate']); ?>&nbsp;</td>
		<td><?php echo h($taxInfo['TaxInfo']['created']); ?>&nbsp;</td>
		<td><?php echo h($taxInfo['TaxInfo']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $taxInfo['TaxInfo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $taxInfo['TaxInfo']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $taxInfo['TaxInfo']['id']), null, __('Are you sure you want to delete # %s?', $taxInfo['TaxInfo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Tax Info'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
