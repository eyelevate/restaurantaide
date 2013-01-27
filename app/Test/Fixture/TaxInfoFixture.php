<?php
/**
 * TaxInfoFixture
 *
 */
class TaxInfoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'company_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'state' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'rate' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '6,4'),
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
			'company_id' => 1,
			'state' => '',
			'rate' => 1,
			'created' => '2013-01-27 13:42:32',
			'modified' => '2013-01-27 13:42:32'
		),
	);

}
