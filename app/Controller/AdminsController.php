<?php
App::uses('AppController', 'Controller');
/**
 * Admins Controller
 * @property Admin $Admin
 */
class AdminsController extends AppController {

	public $name = 'Admins';
	public $uses = array('User','Group','Category','Order','Company');


	public function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->set('username',AuthComponent::user('username'));
		$this->set('company_id',$this->Session->read('Company.company_id'));

		//set the authorized pages
		$this->Auth->allow('login','logout');
		$this->Auth->authError = 'You do not have access to this page. Please Login';
	}



/**
 * Displays login
 * 
 * @return void
 */
	public function login()
	{
		$this->layout = 'admin_login';
		//set autherror to page
		$this->set('authError',$this->Auth->authError);
		
		//set the title
 		if ($this->request->is('post')) {
	    	//check to see if the username, company_id, password bring back a row
	    	$username = $this->request->data['User']['username'];
			//login User with auth component
	        if ($this->Auth->login()) {
				$id = AuthComponent::user('id');
				$companies = $this->User->find('all',array('conditions'=>array('User.id'=>$id)));
				foreach ($companies as $cid) {
					$company_id = $cid['User']['company_id'];
				} 
				$this->Session->write('Company.company_id',$company_id);
				//debug($this->Session->read('Company.company_id'));
	            return $this->redirect($this->Auth->redirect());
	        } else {
	        //the password is incorrect 
	            $this->Session->setFlash(__('Password is incorrect'));  
			}
		}		
	}
/**
 * logsout and sends back to PagesContoller=>index
 * 
 * @return void
 */
	public function logout()
	{
		$this->Session->setFlash(__('You have successfully logged out.'));
		$this->redirect($this->Auth->logout());
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		//set the default layout
		$this->layout = 'admin';

		//set username
		$username = $this->Auth->user('username');
		$this->set('username',$username);
		//set the action levels
		$group_id = $this->Auth->user('group_id');
		$company_id = $this->Session->read('Company.company_id');
		$categories = $this->Category->find('all',array('conditions'=>array('company_id'=>$company_id)));
		$orders = $this->Order->find('all',array('conditions'=>array('company_id'=>$company_id)));
		$this->set('categories',$categories);
		$this->set('orders',$orders);
		
	}

}
