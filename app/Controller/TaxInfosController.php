<?php
App::uses('AppController', 'Controller');
/**
 * TaxInfos Controller
 *
 * @property TaxInfo $TaxInfo
 */
class TaxInfosController extends AppController {
	public $name = 'TaxInfos';
	public $uses = array('User','Group','TaxInfo');
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		//set the default layout
		$this->layout = 'admin';
		$this->set('username',AuthComponent::user('username'));
		$this->set('company_id',$this->Session->read('Company.company_id'));			

		//set the authorized pages
		$this->Auth->deny('*');
		$this->Auth->authError = 'You do not have access to this page. Please Login';
	}		
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$company_id = $this->Session->read('Company.company_id');
		$this->paginate = array(
			'conditions'=>array('company_id'=>$company_id),
		    'limit' => 10, // this was the option which you forgot to mention
		    'order' => array(
		        'id' => 'ASC')
		);	
		$taxInfos = $this->paginate('TaxInfo');	
		$this->TaxInfo->recursive = 0;
		$this->set('taxInfos', $taxInfos);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->TaxInfo->id = $id;
		if (!$this->TaxInfo->exists()) {
			throw new NotFoundException(__('Invalid tax info'));
		}
		$this->set('taxInfo', $this->TaxInfo->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$company_id = $this->Session->read('Company.company_id');
			$this->request->data['TaxInfo']['company_id'] = $company_id;
			$this->TaxInfo->create();
			if ($this->TaxInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The tax info has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tax info could not be saved. Please, try again.'));
			}
		}
		$companies = $this->TaxInfo->Company->find('list');
		$this->set(compact('companies'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->TaxInfo->id = $id;
		if (!$this->TaxInfo->exists()) {
			throw new NotFoundException(__('Invalid tax info'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TaxInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The tax info has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tax info could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TaxInfo->read(null, $id);
		}
		$companies = $this->TaxInfo->Company->find('list');
		$this->set(compact('companies'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->TaxInfo->id = $id;
		if (!$this->TaxInfo->exists()) {
			throw new NotFoundException(__('Invalid tax info'));
		}
		if ($this->TaxInfo->delete()) {
			$this->Session->setFlash(__('Tax info deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tax info was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
