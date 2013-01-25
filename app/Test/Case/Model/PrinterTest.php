<?php
App::uses('Printer', 'Model');

/**
 * Printer Test Case
 *
 */
class PrinterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.printer',
		'app.company',
		'app.user',
		'app.group',
		'app.category',
		'app.invoice_lineitem',
		'app.invoice',
		'app.order',
		'app.tax_info'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Printer = ClassRegistry::init('Printer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Printer);

		parent::tearDown();
	}

}
