<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Company $Company
 */
class Category extends AppModel {
	public $name = 'Category';
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
            	'rule'    => 'notEmpty',
            	'message' => 'This field cannot be left blank'
             ),
			// 'unique'=>array(
				// 'rule'    => 'isUnique',
				// 'message' => 'This name has already been taken.'
			// )
		)
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
	
	public function getCategoryName($category_id)
	{
		$categories = $this->find('all',array('conditions'=>array('Category.id'=>$category_id)));
		if(count($categories) > 0){
			foreach ($categories as $c) {
				$category_name = $c['Category']['name'];
			}
		}
		
		return $category_name;
	}
}
