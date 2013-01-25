<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }
/**
 * Before save method
 * 
 */
	public function beforeSave($options = array())
	{
	    $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
	    return true;
	}
/**
 * Permissions
 */
	///Validation array
	public $validate = array(
		'group_id'=>array(
			'rule'=>'notEmpty',
			'message'=>'This field cannot be left blank'
		),
		'username' =>array(
			'notEmpty'=>array(
		        'rule'    => 'notEmpty',
		        'message' => 'This field cannot be left blank'
			)
		), 
		'password'=>array(
			'notEmpty'=>array(
		        'rule'    => 'notEmpty',
		        'message' => 'This field cannot be left blank'
			)
		),
		'retypePassword'=>array(
			'notEmpty'=>array(
		        'rule'    => 'notEmpty',
		        'message' => 'This field cannot be left blank'
			), 
			'identicalPasswordCheck'=>array(
				'rule' => array('identicalPasswordCheck','password'),
				'message' => 'Your passwords do not match. Please try again'
			)	
		),
		'email'=>array(
			'notEmpty'=>array(
		        'rule'    => 'notEmpty',
		        'message' => 'This field cannot be left blank'
			)
		)
	);
/**
 * validation custom functions
 */
	public function identicalPasswordCheck($field = array(),$field_name)
	{
		foreach ($field as $key => $value) {
			$v1 = $value;
			$v2 = $this->data[$this->name][$field_name];
			if($v1 !== $v2 ){
				return FALSE;
			} else {
				continue;
			}
		}
		
		return TRUE;
	}
}
