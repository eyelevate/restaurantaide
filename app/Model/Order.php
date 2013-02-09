<?php
App::uses('AppModel', 'Model');
/**
 * Order Model
 *
 * @property Company $Company
 * @property InvoiceLineitem $InvoiceLineitem
 */
class Order extends AppModel {
	public $name = 'Order';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'company_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'InvoiceLineitem' => array(
			'className' => 'InvoiceLineitem',
			'foreignKey' => 'order_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
/**
 * afterFindOrder action
 *  @return array
 */
	public function afterFindOrder($results, $company_id)
	{
	    foreach ($results as $key => $val) {


			if (isset($val['Order']['price'])){
				$results[$key]['Order']['price'] = $this->moneyFormat($val['Order']['price']);
			}
			if(isset($val['Order']['category'])){
				$results[$key]['Order']['category'] = $this->categoryFind($val['Order']['category'], $company_id);
			}

	    }
	    return $results;		
	}
	
	public function moneyFormat($value){
		if ($value >= 0) {
			return '$'.$value;	
		} else {
			return '($'.$value.')';
		}
	}
	
	public function categoryFind($value, $company_id)
	{
		$category = $this->Category->findAllByIdAndCompany_id($value, $company_id);
		
		$category_count = count($category);
		if ($category_count>0) {
			foreach ($category as $row) {
				return $row['Category']['name'];
			}
		} 
		
	}
	/**
	 * get category id method
	 * @param category name & company_id
	 * @return id
	 */
	public function findCategoryId($value,$company_id)
	{
		$category = $this->Category->findAllByNameAndCompany_id($value, $company_id);
		
		$category_count = count($category);
		if ($category_count>0) {
			foreach ($category as $row) {
				return $row['Category']['id'];
			}
		} 		
	}
	public function organizeOrderByCategory($categories, $company_id)
	{
		$orders_array = array();
		foreach ($categories as $category) {
			$category_id = $category['Category']['id'];
			$find = $this->query('SELECT `Order`.`id`, `Order`.`name`, `Order`.`description`, `Order`.`price` 
								  FROM `restaurantaide`.`orders` AS `Order`
								  WHERE `Order`.`company_id` = '.$company_id.'
								  AND `Order`.`category` ='.$category_id.'
								  ORDER BY `Order`.`order_list` ASC');
			$orders_array[$category_id] = $find;
		}
		return $orders_array;
	}

}
