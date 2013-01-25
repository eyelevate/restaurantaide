<div class="orders view">
<h2><?php  echo __('Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Company']['name'], array('controller' => 'companies', 'action' => 'view', $order['Company']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order List'); ?></dt>
		<dd>
			<?php echo h($order['Order']['order_list']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($order['Order']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($order['Order']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($order['Order']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($order['Order']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($order['Order']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($order['Order']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoice Lineitems'), array('controller' => 'invoice_lineitems', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice Lineitem'), array('controller' => 'invoice_lineitems', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Invoice Lineitems'); ?></h3>
	<?php if (!empty($order['InvoiceLineitem'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Invoice Number'); ?></th>
		<th><?php echo __('Category'); ?></th>
		<th><?php echo __('Company Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Before Tax'); ?></th>
		<th><?php echo __('After Tax'); ?></th>
		<th><?php echo __('Day Paid'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($order['InvoiceLineitem'] as $invoiceLineitem): ?>
		<tr>
			<td><?php echo $invoiceLineitem['id']; ?></td>
			<td><?php echo $invoiceLineitem['invoice_number']; ?></td>
			<td><?php echo $invoiceLineitem['category']; ?></td>
			<td><?php echo $invoiceLineitem['company_id']; ?></td>
			<td><?php echo $invoiceLineitem['order_id']; ?></td>
			<td><?php echo $invoiceLineitem['quantity']; ?></td>
			<td><?php echo $invoiceLineitem['before_tax']; ?></td>
			<td><?php echo $invoiceLineitem['after_tax']; ?></td>
			<td><?php echo $invoiceLineitem['day_paid']; ?></td>
			<td><?php echo $invoiceLineitem['created']; ?></td>
			<td><?php echo $invoiceLineitem['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'invoice_lineitems', 'action' => 'view', $invoiceLineitem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'invoice_lineitems', 'action' => 'edit', $invoiceLineitem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'invoice_lineitems', 'action' => 'delete', $invoiceLineitem['id']), null, __('Are you sure you want to delete # %s?', $invoiceLineitem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Invoice Lineitem'), array('controller' => 'invoice_lineitems', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
