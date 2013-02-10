<?php
//add scripts to header
echo $this->Html->css(array('dashboard'),FALSE);
echo $this->Html->script(array(
	'print.js',
	'dashboard.js',
	'admin/plugins/jquerypriceformat/jquery.price_format.1.7.min.js',
	),
	FALSE
);
//alerts on page
echo $this->TwitterBootstrap->flashes(array(
    "auth" => False,
    "closable"=>true
    )
);

foreach ($taxes as $tax) {
	$tax_rate = $tax['TaxInfo']['rate'] / 100;
}

echo $this->Form->create('Invoice',array('class'=>'invoiceForm'));
echo $this->Form->input('tax',array('type'=>'hidden','disabled'=>'disabled', 'value'=>$tax_rate,'id'=>'tax_rate'));
?>
<div class="hide">
	<applet name="jZebra" code="jzebra.RawPrintApplet.class" archive="js/jzebra/jzebra.jar" width="100" height="100"></applet>	
</div>
<div class="row-fluid span12">
	<div class="row">
		<div class="span6">
			<h3 class="heading">Order Selection</h3>
			<?php
			echo $this->element('/dashboard/order_selection',array(
				'categories'=>$categories,
				'orders'=>$orders
			));
			?>
		</div>	
		<div class="span6">
			<h3 class="heading">Order Processing</h3>
			<?php	
			echo $this->element('/dashboard/order_processing',array(
			));
			?>
		<div>
			<button id="cancelOrderButton" class="btn btn-danger btn-large" type="button">Cancel</button>
		
			<div id="paymentButton-modal" step="1" class="btn btn-primary btn-large pull-right hide" href="#processPayment" role="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" >Payment</div>
			<div id="paymentButton" class="btn btn-primary btn-large pull-right">Payment</div>
		</div>
		</div>	
	
	</div>

</div>
 
<!-- Modal -->
<div id="processPayment" row="1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="sampleWarningLabel" aria-hidden="true">
	<div class="stepValidationErrors">
		<div class="modal-header">
			<h3 id="sampleWarningLabel">Payment</h3>
	  	</div>
	 	<div class="modal-body">
			<div class="tabbable tabs-left">
				<ul id="paymentTypeUl" class="nav nav-tabs">
					<li class="active" row="cash">
						<a id="payment-cash" data-toggle="tab" href="#tab_cash">Cash</a>
					</li>
					<li row="credit">
						<a id="payment-credit" data-toggle="tab" href="#tab_credit">Credit</a>
					</li>
					<li row="check">
						<a id="payment-check" data-toggle="tab" href="#tab_check">Check</a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="tab_cash" class="tab-pane active">
						<div class="form-horizontal">
							<div class="control-group">
								<label class="control-label">Due:</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">$</span>
										<input id="cashDue" type="text" class="totalDue span2" disabled="disabled"/>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tendered:</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">$</span>
										<input id="cashTendered" type="text" class="tendered span2"/>
									</div>
									<span class="help-block"></span>
								</div>

							</div>
							<div class="control-group">
								<div class="controls">
									<ul class="unstyled">
										<li class="">
											<button id="oneDollar" class="quickCashButton btn btn-large btn-success" type="button" value="1.00">$1.00</button>
											<button id="fiveDollars" class="quickCashButton btn btn-large btn-success" type="button" value="5.00">$5.00</button>
											<button id="tenDollars" class="quickCashButton btn btn-large btn-success" type="button" value="10.00">$10.00</button>
										</li>
										<li>
											<button id="twentyDollars" class="quickCashButton btn btn-large btn-success" type="button" value="20.00">$20.00</button>
											<button id="fiftyDollars" class="quickCashButton btn btn-large btn-success" type="button" value="50.00">$50.00</button>
											<button id="onehundredDollars" class="quickCashButton btn btn-large btn-success" type="button" value="100.00">$100.00</button>
										</li>
									</ul>
								</div>								
							</div>
							<div class="control-group">
								<label id="" class="control-label">Change:</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">$</span>
										<input id="changeDue" type="text" class="span2" disabled="disabled"/>
									</div>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
					</div>
					<div id="tab_credit" class="tab-pane">
						<div class="form-horizontal">
							<div class="control-group">
								<label class="control-label">Due:</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">$</span>
										<input id="creditDue" type="text" class="totalDue span2" disabled="disabled"/>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Last 4 Digits:</label>
								<div class="controls">
									<div class="input-append">
										<input id="creditNumber" type="text" name="data[Invoice][credit_number]" class="span2"/>
										<span class="add-on">#</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="tab_check" class="tab-pane">
						<div class="form-horizontal">
							<div class="control-group">
								<label class="control-label">Due:</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">$</span>
										<input id="checkDue" type="text" class="totalDue span2" disabled="disabled"/>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Check #:</label>
								<div class="controls">
									<div class="input-append">
										<input id="checkNumber" type="text" class="span2" name="data[Invoice][check_number]"/>
										<span class="add-on">#</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	    
		</div>
		
	  	<div class="modal-footer">
			<button class="btn btn-large pull-left" data-dismiss="modal" aria-hidden="true">Cancel</button>
			<button id="finishOrderButton" type="button" class="btn btn-primary btn-large pull-right" >Finish & Print</button>
	  	</div>
	  	
	</div>

</div>

<div id="invoiceSummary"></div>
<?php
echo $this->Form->input('payment_type',array('type'=>'hidden','class'=>'paymentTypeInput'));
echo $this->Form->end();
?>