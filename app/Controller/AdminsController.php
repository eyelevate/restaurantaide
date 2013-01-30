<?php
App::uses('AppController', 'Controller');
/**
 * Admins Controller
 * @property Admin $Admin
 */
class AdminsController extends AppController {

	public $name = 'Admins';
	public $uses = array('Menu','Menu_item','User','Group','Category','Order','Company','TaxInfo','Invoice','InvoiceLineitem');


	public function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->set('username',AuthComponent::user('username'));
		$this->set('company_id',$this->Session->read('Company.company_id'));
		//set the navigation menu_id		
		$menu_ids = $this->Menu->find('all',array('conditions'=>array('name'=>'Super Administrator')));
		$menu_id = $menu_ids[0]['Menu']['id'];		
		$this->Session->write('Admin.menu_id',$menu_id);
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
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/admins/index';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);
		//set username
		$username = $this->Auth->user('username');
		$this->set('username',$username);
		//set the action levels
		$group_id = $this->Auth->user('group_id');
		$company_id = $this->Session->read('Company.company_id');
		$categories = $this->Category->find('all',array('conditions'=>array('company_id'=>$company_id)));
		$orders = $this->Order->find('all',array('conditions'=>array('company_id'=>$company_id)));
		$taxes = $this->TaxInfo->find('all',array('conditions'=>array('company_id'=>$company_id)));
		$this->set('categories',$categories);
		$this->set('orders',$orders);
		$this->set('taxes',$taxes);
		
		if($this->request->is('post')){
			//debug($this->request->data);
			//get the invoice_number 
			$find_new_id = $this->Invoice->find('all',array(
				'conditions'=>array('Invoice.company_id'=>$company_id),
				'order'=>'id desc',
				'limit'=>'0,1'
			));
			if(count($find_new_id) >0){
				foreach ($find_new_id as $fid) {
					$new_id = $fid['Invoice']['invoice_number'] + 1;
				}
			} else {
				$new_id = 1;
			}
			$this->request->data['Invoice']['invoice_number'] = $new_id;
			$this->request->data['Invoice']['company_id'] = $company_id;
			if($this->Invoice->save($this->request->data['Invoice'])){
				foreach ($this->request->data['InvoiceLineitem'] as $key => $value) {
					$this->request->data['InvoiceLineitem'][$key]['invoice_number'] = $new_id;
				}
				$this->InvoiceLineitem->saveAll($this->request->data['InvoiceLineitem']);
				
				$this->Session->setFlash(__('Successfully completed order #'.$new_id),'default',array(),'success');
	
			}
			
		}
		
	}

	public function retract()
	{
		
	}

}
