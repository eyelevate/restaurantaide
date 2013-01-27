<?php
App::uses('TaxInfo', 'Model');

/**
 * TaxInfo Test Case
 *
 */
class TaxInfoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tax_info',
		'app.company',
		'app.user',
		'app.group',
		'app.category',
		'app.invoice_lineitem',
		'app.invoice',
		'app.order',
		'app.printer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TaxInfo = ClassRegistry::init('TaxInfo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TaxInfo);

		parent::tearDown();
	}

}
