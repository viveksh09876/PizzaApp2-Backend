<?php
App::uses('AppController', 'Controller');
class SlidesController extends AppController {
    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('get_slides'));
    }

    public function admin_index() {
        $pageVar['title'] = 'Slides';
        $pageVar['sub_title'] = 'List of slides';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Slides</li>';
        $this->paginate = array(
            'limit' => 10,
            'order'=>'id DESC'
        );
        $Slides = $this->paginate();
        $this->set(compact('Slides','pageVar'));
    }

    public function admin_add() {
        $pageVar['title'] = 'Add Slide';
        $pageVar['sub_title'] = 'Add new slide';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Slide</li>';
        if ($this->request->is('post')) {
            $this->Slide->create();
            $image = $this->request->data['Slide']['image'];
            if(!empty($this->request->data['Slide']['image']) && !empty($this->request->data['Slide']['image']['name'])){
                $file = explode('.',$this->request->data['Slide']['image']['name']);
                $file[0] = strtolower($file[0]).time();
                $file = implode('.',$file);
                $newPath = 'img/admin/slides/'.$file; 
                move_uploaded_file($this->request->data['Slide']['image']['tmp_name'], $newPath);
                $this->request->data['Slide']['image'] = $file;		
            }else{
                unset($this->request->data['Slide']['image']);
            }

            if(!empty($this->request->data['Slide']['text_image']) && !empty($this->request->data['Slide']['text_image']['name'])){
                $file = explode('.',$this->request->data['Slide']['text_image']['name']);
                $file[0] = strtolower($file[0]).time();
                $file = implode('.',$file);
                $newPath = 'img/admin/slides/'.$file;
                $prevpath = 'img/admin/slides/'.$data['Slide']['text_image'];
                if(file_exists($prevpath)){
                    unlink($prevpath); 
                } 
                move_uploaded_file($this->request->data['Slide']['text_image']['tmp_name'], $newPath);
                $this->request->data['Slide']['text_image'] = $file; 
            }else{
                unset($this->request->data['Slide']['text_image']);
            }			
            if ($this->Slide->save($this->request->data)) {
                $this->Session->setFlash(__('The slide has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The slide could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }

    public function admin_edit($id = null) {
        $pageVar['title'] = 'Edit Slide';
        $pageVar['sub_title'] = 'Edit slide details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Slide</li>';
        $this->Slide->id = $id;
        $data = $this->Slide->read(null,$id);
        if (!$this->Slide->exists()) {
            throw new NotFoundException(__('Invalid Slide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if(!empty($this->request->data['Slide']['image']) && !empty($this->request->data['Slide']['image']['name'])){
                $file = explode('.',$this->request->data['Slide']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/slides/'.$file;
                $prevpath = 'img/admin/slides/'.$data['Slide']['image'];
                if(file_exists($prevpath)){
                    unlink($prevpath); 
                }
                move_uploaded_file($this->request->data['Slide']['image']['tmp_name'], $newPath);
                $this->request->data['Slide']['image'] = $file;	
            }else{
                unset($this->request->data['Slide']['image']);
            }

            if(!empty($this->request->data['Slide']['text_image']) && !empty($this->request->data['Slide']['text_image']['name'])){
                $file = explode('.',$this->request->data['Slide']['text_image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/slides/'.$file;
                $prevpath = 'img/admin/slides/'.$data['Slide']['text_image'];
                if(file_exists($prevpath)){
                    unlink($prevpath); 
                }
                move_uploaded_file($this->request->data['Slide']['text_image']['tmp_name'], $newPath);
                $this->request->data['Slide']['text_image'] = $file; 
            }else{
                if(!empty($this->request->data['Slide']['oldtext_image'])){
                    unset($this->request->data['Slide']['text_image']);
                }else{
                   $this->request->data['Slide']['text_image'] = ''; 
                }
                // unset($this->request->data['Slide']['text_image']);
            }

            if ($this->Slide->save($this->request->data)) {
                $this->Session->setFlash(__('The slide has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The slide could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }	

}
