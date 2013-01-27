<?php
App::uses('AppController', 'Controller');
/**
 * TaxInfos Controller
 *
 * @property TaxInfo $TaxInfo
 */
class TaxInfosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TaxInfo->recursive = 0;
		$this->set('taxInfos', $this->paginate());
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
