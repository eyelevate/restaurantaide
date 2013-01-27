<?php
App::uses('AppController', 'Controller');
/**
 * Companies Controller
 *
 * @property Company $Company
 */
class CompaniesController extends AppController {
	public $name = 'Companies';
	public $uses = array('User','Group','Category','Order','Company');
	
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
		$this->Company->recursive = 0;
		$this->set('companies', $this->paginate('Company'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Company->id = $id;
		if (!$this->Company->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->set('company', $this->Company->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Company->create();
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash(__('The company has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.'));
			}
		}
		$users = $this->Company->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Company->id = $id;
		if (!$this->Company->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash(__('The company has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Company->read(null, $id);
		}
		$users = $this->Company->User->find('list');
		$this->set(compact('users'));
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
		$this->Company->id = $id;
		if (!$this->Company->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		if ($this->Company->delete()) {
			$this->Session->setFlash(__('Company deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Company was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
