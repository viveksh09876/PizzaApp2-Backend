<?php
App::uses('AppController', 'Controller');

class ContentsController extends AppController {
	public $uses = array('Content');
	public $paginate = array('limit' =>1);	

	function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function company_index() {
		$pageVar['title'] = 'Pages';
		$pageVar['sub_title'] = 'List of pages';
		$pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Pages</li>';

		$this->Content->recursive = 0;
		$this->paginate = array(
         	'order' =>'Content.page_id DESC'
     	);
     	$contents = $this->paginate('Content');
     	$this->set(compact('contents','pageVar'));
	}

	public function company_view($id = null) {
		$pageVar['title'] = 'Page Details';
		$pageVar['sub_title'] = 'Details of pages';
		$pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Page Details</li>';

		$this->Content->id = $id;
		if (!$this->Content->exists()) {
			throw new NotFoundException(__('Invalid Page'));
		}

		$Content = $this->Content->read(null, $id);
		$this->set(compact('Content','pageVar'));
	}


	public function company_add() {
		$pageVar['title'] = 'Add Page';
		$pageVar['sub_title'] = 'Add Page Details';
		$pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Page</li>';

		if ($this->request->is('post')) {
			$this->Content->create();
			$this->request->data['Content']['page_added_date']=date('Y-m-d H:i:s');
			if ($this->Content->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'),'default',array('class'=>'alert alert-danger'));
			}
		}
		$this->set(compact('pageVar'));
	}


	public function company_edit($id = null) {
		$pageVar['title'] = 'Edit Page';
		$pageVar['sub_title'] = 'Edit Page Details';
		$pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Page</li>';

		$this->Content->id = $id;
		if (!$this->Content->exists()) {
			throw new NotFoundException(__('Invalid Page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Content']['page_modified_date']=date('Y-m-d H:i:s');
			$this->request->data['Content']['page_id'] = $id;
			if ($this->Content->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'),'default',array('class'=>'alert alert-danger'));
			}
		} else {
			$this->set(compact('pageVar'));
			$this->request->data = $this->Content->read(null, $id);
		}
		$this->render('company_add');
	}


	public function company_delete($id = null) {
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Content->id = $id;
		if (!$this->Content->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->Content->delete()) {
			$this->Session->setFlash(__('Page deleted'),'default',array('class'=>'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Page was not deleted'),'default',array('class'=>'error'));
		$this->redirect(array('action' => 'index'));
	}
	
	
	/*-front end actions-*/
	
	
	
	
	/*-[end]front end actions-*/
}
