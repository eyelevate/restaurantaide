<?php
App::uses('InvoiceLineitem', 'Model');

/**
 * InvoiceLineitem Test Case
 *
 */
class InvoiceLineitemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.invoice_lineitem'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InvoiceLineitem = ClassRegistry::init('InvoiceLineitem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InvoiceLineitem);

		parent::tearDown();
	}

}
