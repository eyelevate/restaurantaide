<?php
/**
 * InvoiceFixture
 *
 */
class InvoiceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'invoice_number' => array('type' => 'integer', 'null' => false, 'default' => null),
		'company_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'before_tax' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '11,2'),
		'after_tax' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '11,2'),
		'payment_type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'payment_number' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 12),
		'day_paid' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'invoice_number' => 1,
			'company_id' => 1,
			'before_tax' => 1,
			'after_tax' => 1,
			'payment_type' => 'Lorem ipsum dolor ',
			'payment_number' => 1,
			'day_paid' => 'Lorem ip',
			'created' => '2013-01-27 14:13:17',
			'modified' => '2013-01-27 14:13:17'
		),
	);

}
