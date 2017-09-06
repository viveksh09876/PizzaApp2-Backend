<?php
App::uses('AppController', 'Controller');

class EmailTemplatesController extends AppController {

	function beforeFilter(){
		parent::beforeFilter();
	}
	

	public function company_index() {
		$pageVar['title'] = 'Email Templates';
		$pageVar['sub_title'] = 'List of email templates';
		$pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Email Templates</li>';

		$this->EmailTemplate->recursive = 0;
		$EmailTemplate = $this->paginate();

		$this->set(compact('EmailTemplate','pageVar'));
	}

	public function company_view($id = null) {
		$pageVar['title'] = 'Email Template Details';
		$pageVar['sub_title'] = 'Details of email template';
		$pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Email Template Details</li>';

		$this->EmailTemplate->id = $id;
		if (!$this->EmailTemplate->exists()) {
			throw new NotFoundException(__('Invalid Page'));
		}
		$EmailTemplate = $this->EmailTemplate->read(null, $id);
		$this->set(compact('EmailTemplate','pageVar'));
	}

	public function company_add() {
		$pageVar['title'] = 'Add New Template';
		$pageVar['sub_title'] = 'Add new email template';
		$pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add New Template</li>';

		if ($this->request->is('post')) {
			$this->EmailTemplate->create();
			$this->request->data['EmailTemplate']['template_added_date']=date('Y-m-d H:i:s');
			if ($this->EmailTemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The email template has been saved'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email template could not be saved. Please, try again.'),'default',array('class'=>'alert alert-danger'));
			}
		}
		$this->set(compact('pageVar'));
	}


	public function company_edit($id = null) {
		$pageVar['title'] = 'Edit Template';
		$pageVar['sub_title'] = 'Edit email template';
		$pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Template</li>';

		$this->EmailTemplate->id = $id;
		if (!$this->EmailTemplate->exists()) {
			throw new NotFoundException(__('Invalid Template'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['EmailTemplate']['template_modified_date']=date('Y-m-d H:i:s');
			if ($this->EmailTemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.'),'default',array('class'=>'alert alert-danger'));
			}
		} else {
			$this->request->data = $this->EmailTemplate->read(null, $id);
		}
		$this->set(compact('pageVar'));
	}

	public function company_delete($id = null) {
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->EmailTemplate->id = $id;
		if (!$this->EmailTemplate->exists()) {
			throw new NotFoundException(__('Invalid Template'));
		}
		if ($this->EmailTemplate->delete()) {
			$this->Session->setFlash(__('Template deleted'),'default',array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Template was not deleted'),'default',array('class'=>'alert alert-danger'));
		$this->redirect(array('action' => 'index'));
	}
}
