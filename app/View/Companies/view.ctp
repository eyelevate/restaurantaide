<div class="companies view">
<h2><?php  echo __('Company'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($company['Company']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($company['User']['id'], array('controller' => 'users', 'action' => 'view', $company['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($company['Company']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($company['Company']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo h($company['Company']['area']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($company['Company']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timed Login'); ?></dt>
		<dd>
			<?php echo h($company['Company']['timed_login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($company['Company']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($company['Company']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Company'), array('action' => 'edit', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Company'), array('action' => 'delete', $company['Company']['id']), null, __('Are you sure you want to delete # %s?', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoice Lineitems'), array('controller' => 'invoice_lineitems', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice Lineitem'), array('controller' => 'invoice_lineitems', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices'), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tax Infos'), array('controller' => 'tax_infos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tax Info'), array('controller' => 'tax_infos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Categories'); ?></h3>
	<?php if (!empty($company['Category'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Company Id'); ?></th>
		<th><?php echo __('Category List'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($company['Category'] as $category): ?>
		<tr>
			<td><?php echo $category['id']; ?></td>
			<td><?php echo $category['company_id']; ?></td>
			<td><?php echo $category['category_list']; ?></td>
			<td><?php echo $category['name']; ?></td>
			<td><?php echo $category['status']; ?></td>
			<td><?php echo $category['created']; ?></td>
			<td><?php echo $category['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'categories', 'action' => 'view', $category['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'categories', 'action' => 'edit', $category['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'categories', 'action' => 'delete', $category['id']), null, __('Are you sure you want to delete # %s?', $category['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Invoice Lineitems'); ?></h3>
	<?php if (!empty($company['InvoiceLineitem'])): ?>
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
		foreach ($company['InvoiceLineitem'] as $invoiceLineitem): ?>
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
<div class="related">
	<h3><?php echo __('Related Invoices'); ?></h3>
	<?php if (!empty($company['Invoice'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Invoice Number'); ?></th>
		<th><?php echo __('Company Id'); ?></th>
		<th><?php echo __('Before Tax'); ?></th>
		<th><?php echo __('After Tax'); ?></th>
		<th><?php echo __('Payment Type'); ?></th>
		<th><?php echo __('Payment Number'); ?></th>
		<th><?php echo __('Day Paid'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($company['Invoice'] as $invoice): ?>
		<tr>
			<td><?php echo $invoice['id']; ?></td>
			<td><?php echo $invoice['invoice_number']; ?></td>
			<td><?php echo $invoice['company_id']; ?></td>
			<td><?php echo $invoice['before_tax']; ?></td>
			<td><?php echo $invoice['after_tax']; ?></td>
			<td><?php echo $invoice['payment_type']; ?></td>
			<td><?php echo $invoice['payment_number']; ?></td>
			<td><?php echo $invoice['day_paid']; ?></td>
			<td><?php echo $invoice['created']; ?></td>
			<td><?php echo $invoice['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'invoices', 'action' => 'view', $invoice['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'invoices', 'action' => 'edit', $invoice['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'invoices', 'action' => 'delete', $invoice['id']), null, __('Are you sure you want to delete # %s?', $invoice['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Orders'); ?></h3>
	<?php if (!empty($company['Order'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Company Id'); ?></th>
		<th><?php echo __('Order List'); ?></th>
		<th><?php echo __('Category'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($company['Order'] as $order): ?>
		<tr>
			<td><?php echo $order['id']; ?></td>
			<td><?php echo $order['company_id']; ?></td>
			<td><?php echo $order['order_list']; ?></td>
			<td><?php echo $order['category']; ?></td>
			<td><?php echo $order['name']; ?></td>
			<td><?php echo $order['description']; ?></td>
			<td><?php echo $order['price']; ?></td>
			<td><?php echo $order['created']; ?></td>
			<td><?php echo $order['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['id']), null, __('Are you sure you want to delete # %s?', $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Printers'); ?></h3>
	<?php if (!empty($company['Printer'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Company Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($company['Printer'] as $printer): ?>
		<tr>
			<td><?php echo $printer['id']; ?></td>
			<td><?php echo $printer['company_id']; ?></td>
			<td><?php echo $printer['name']; ?></td>
			<td><?php echo $printer['created']; ?></td>
			<td><?php echo $printer['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'printers', 'action' => 'view', $printer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'printers', 'action' => 'edit', $printer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'printers', 'action' => 'delete', $printer['id']), null, __('Are you sure you want to delete # %s?', $printer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Tax Infos'); ?></h3>
	<?php if (!empty($company['TaxInfo'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Company Id'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($company['TaxInfo'] as $taxInfo): ?>
		<tr>
			<td><?php echo $taxInfo['id']; ?></td>
			<td><?php echo $taxInfo['company_id']; ?></td>
			<td><?php echo $taxInfo['state']; ?></td>
			<td><?php echo $taxInfo['rate']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tax_infos', 'action' => 'view', $taxInfo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tax_infos', 'action' => 'edit', $taxInfo['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tax_infos', 'action' => 'delete', $taxInfo['id']), null, __('Are you sure you want to delete # %s?', $taxInfo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tax Info'), array('controller' => 'tax_infos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
