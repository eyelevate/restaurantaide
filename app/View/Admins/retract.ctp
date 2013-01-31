<?php
//alerts on page
echo $this->TwitterBootstrap->flashes(array(
    "auth" => False,
    "closable"=>true
    )
);
?>
<div class="admins index">
	<h2><?php echo __('Retract Order'); ?></h2>
	<table class="table table-striped table-bordered table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('invoice_number'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_type'); ?></th>
			<th><?php echo $this->Paginator->sort('credit_number'); ?></th>
			<th><?php echo $this->Paginator->sort('check_number'); ?></th>
			<th><?php echo $this->Paginator->sort('before_tax'); ?></th>
			<th><?php echo $this->Paginator->sort('after_tax'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($invoices as $inv): ?>
	<tr>
		<td><?php echo h($inv['Invoice']['invoice_number']); ?>&nbsp;</td>
		<td><?php echo h($inv['Invoice']['payment_type']); ?>&nbsp;</td>
		<td><?php echo h($inv['Invoice']['credit_number']); ?>&nbsp;</td>
		<td><?php echo h($inv['Invoice']['check_number']); ?>&nbsp;</td>
		<td>$<?php echo h($inv['Invoice']['before_tax']); ?>&nbsp;</td>
		<td>$<?php echo h($inv['Invoice']['after_tax']); ?>&nbsp;</td>
		<td><?php echo h($inv['Invoice']['created']); ?>&nbsp;</td>
		<td><?php echo h($inv['Invoice']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $inv['Invoice']['id'])); ?>

			<?php echo $this->Form->postLink(__('Retract'), array('action' => 'delete', $inv['Invoice']['id']), null, __('Are you sure you want to retract # %s?', $inv['Invoice']['invoice_number'])); ?>
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

