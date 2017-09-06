<?php
App::uses('AppController', 'Controller');
class LanguagesController extends AppController {
    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('get_languages'));
    }

    public function admin_index() {
        $pageVar['title'] = 'Languages';
        $pageVar['sub_title'] = 'List of languages';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Languages</li>';
        $this->paginate = array(
            'limit' => 10,
        );
        $Languages = $this->paginate();
        $this->set(compact('Languages','pageVar'));
    }

    public function admin_add() {
        $pageVar['title'] = 'Add Language';
        $pageVar['sub_title'] = 'Add new language';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Language</li>';
        if ($this->request->is('post')) {
            $this->Language->create();		
            if ($this->Language->save($this->request->data)) {
                $this->Session->setFlash(__('The language has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The language could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }

    public function admin_edit($id = null) {
        $pageVar['title'] = 'Edit Language';
        $pageVar['sub_title'] = 'Edit language details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Language</li>';
        $this->Language->id = $id;
        $data = $this->Language->read(null,$id);
        if (!$this->Language->exists()) {
            throw new NotFoundException(__('Invalid Language'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Language->save($this->request->data)) {
                $this->Session->setFlash(__('The language has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The language could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }
}
