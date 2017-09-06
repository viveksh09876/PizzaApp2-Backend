<?php
class UsersController extends AppController {

	public $name = 'Users';
	public $helpers = array('Form', 'Html', 'Js');
	public $paginate = array('limit' =>10);	
	public $uses=array('User','UserRole','Country','ContactInformation');
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$userRoleId=$this->Auth->user('user_role_id');
		if((int)$userRoleId>1){
			$this->Auth->deny('all');
		}
	}
	

	function admin_profile() {

		$this->layout='admin';
		
		$userId=$this->Auth->user('user_id');		
		$this->User->id = $userId;
		$this->User->validator()->remove('password');
		
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid User'));
		}
		if ($this->request->is('post') || $this->request->is('put')){
			
			$this->request->data['User']['user_modified_date']=date('Y-m-d H:i:s');
			
			unset($this->request->data['User']['email']);
			unset($this->request->data['User']['user_role_id']);
			unset($this->request->data['User']['user_status']);
			
			if(!empty($this->request->data['User']['password'])){
				$newPass=$this->request->data['User']['password'];
				$this->request->data['User']['password']=AuthComponent::password($newPass);
			}else{
				unset($this->request->data['User']['password']);
			}
			
			if($this->User->save($this->request->data)) {
				$data = $this->User->findByUserId($userId);
				$this->Auth->login($data['User']);
				$this->Session->setFlash(__('The user updated successfully',true),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('controller'=>'home','action' => 'index'));
			} else {
				$this->request->data['User']['password']=$newPass;
				$this->Session->setFlash(__('The user could not be saved. Please, try again.',true),'default',array('class'=>'alert alert-danger'));
			}
		}

		if(empty($this->request->data)){
			$data=$this->User->read(null, $this->User->id);
			$data['User']['password']='';
			$this->request->data=$data;
		}	
		
		$country=$this->Country->find('all');
		$this->set('Country',$country);
		
	}

	function practitioner_profile() {

		$userId=$this->Auth->user('user_id');		
		$this->User->id = $userId;
		$this->User->validator()->remove('password');
		
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid User'));
		}
		if ($this->request->is('post') || $this->request->is('put')){
			
			$this->request->data['User']['user_modified_date']=date('Y-m-d H:i:s');
			
			unset($this->request->data['User']['email']);
			unset($this->request->data['User']['user_role_id']);
			unset($this->request->data['User']['user_status']);
			
			if(!empty($this->request->data['User']['password'])){
				$newPass=$this->request->data['User']['password'];
				$this->request->data['User']['password']=AuthComponent::password($newPass);
			}else{
				unset($this->request->data['User']['password']);
			}
			
			if($this->User->save($this->request->data)) {
				$data = $this->User->findByUserId($userId);
				$this->Auth->login($data['User']);
				$this->Session->setFlash(__('The user updated successfully',true),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('controller'=>'home','action' => 'index'));
			} else {
				$this->request->data['User']['password']=$newPass;
				$this->Session->setFlash(__('The user could not be saved. Please, try again.',true),'default',array('class'=>'alert alert-danger'));
			}
		}

		if(empty($this->request->data)){
			$data=$this->User->read(null, $this->User->id);
			$data['User']['password']='';
			$this->request->data=$data;
		}	
		
		$country=$this->Country->find('all');
		$this->set('Country',$country);
		
	}
	
	function admin_index() {		
		$this->set('Users', $this->paginate());
	}
	
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User', true),'default',array('class'=>'error'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('User', $this->User->read(null, $id));
		
	}

	function admin_add(){
		
		if (!empty($this->request->data) && $this->request->is('post')) {
			$this->User->create();
			
			$this->request->data['User']['user_added_date']=date('Y-m-d H:i:s');
			$pass=$this->request->data['User']['password'];
			$this->request->data['User']['password']=AuthComponent::password($pass);
			
			if($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user added successfully',true),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data['User']['password']=$pass;
				$this->Session->setFlash(__('The user could not be saved. Please, try again.',true),'default',array('class'=>'alert alert-danger'));
			}
			
		}
		
		$roles=$this->UserRole->find('all',array('conditions'=>array('user_role_status'=>'Active'),'order'=>array('user_role_name'=>'asc')));
		$this->set('Roles',$roles);
		
		$country=$this->Country->find('all');
		$this->set('Country',$country);
		
	}

	
	function admin_edit($id = null) {
		
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid User'));
		}
		$this->User->validator()->remove('password');
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['User']['user_modified_date']=date('Y-m-d H:i:s');
			
			$newPass='';
			if(!empty($this->request->data['User']['password'])){
				$newPass=$this->request->data['User']['password'];
				$this->request->data['User']['password']=AuthComponent::password($newPass);
			}else{
				unset($this->request->data['User']['password']);
			}

			if($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user updated successfully',true),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data['User']['password']=$newPass;
				$this->Session->setFlash(__('The user could not be saved. Please, try again.',true),'default',array('class'=>'alert alert-danger'));
			}
		}
		
		if (empty($this->request->data)) {
			$data=$this->User->read(null, $id);
			unset($data['User']['password']);
			$this->request->data = $data;
		}
		
		$roles=$this->UserRole->find('all',array('conditions'=>array('user_role_status'=>'Active'),'order'=>array('user_role_name'=>'asc')));
		$this->set('Roles',$roles);
		
		$country=$this->Country->find('all');
		$this->set('Country',$country);
	}

	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true),'default',array('class'=>'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('The user deleted successfully', true),'default',array('class'=>'alert alert-success'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The user could not be deleted', true),'default',array('class'=>'alert alert-danger'));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_upload_pic(){
		
		$userId=$this->Auth->user('user_id');
		$imageData = $this->request->data['profile_pic'];
		unset($this->request->data['profile_pic']);
		list($type, $imageData) = explode(';', $imageData);
		list(, $imageData)      = explode(',', $imageData);
		$imageData = base64_decode($imageData);
		$filename = time().'.png';
		echo getcwd();
		file_put_contents(getcwd().'/img/admin/user/thumb/'.$filename, $imageData);
		$this->request->data['User']['profile_pic'] = $filename;
		$this->User->id = $userId;
		if($this->User->save($this->request->data)){
			$data = $this->User->findByUserId($userId);
			$this->Auth->login($data['User']);
			$this->Session->setFlash(__('Profile image updated successfully', true),'default',array('class'=>'alert alert-success'));
			echo '1';
		}else{
			$this->Session->setFlash(__('Profile image could not updated successfully, please try again', true),'default',array('class'=>'alert alert-danger'));
			echo '0';
		}
		die;
	}

	function practitioner_upload_pic(){
		
		$userId=$this->Auth->user('user_id');
		$imageData = $this->request->data['profile_pic'];
		unset($this->request->data['profile_pic']);
		list($type, $imageData) = explode(';', $imageData);
		list(, $imageData)      = explode(',', $imageData);
		$imageData = base64_decode($imageData);
		$filename = time().'.png';
		echo getcwd();
		file_put_contents(getcwd().'/img/practitioner/user/thumb/'.$filename, $imageData);
		$this->request->data['User']['profile_pic'] = $filename;
		$this->User->id = $userId;
		if($this->User->save($this->request->data)){
			$data = $this->User->findByUserId($userId);
			$this->Auth->login($data['User']);
			$this->Session->setFlash(__('Profile image updated successfully', true),'default',array('class'=>'alert alert-success'));
			echo '1';
		}else{
			$this->Session->setFlash(__('Profile image could not updated successfully, please try again', true),'default',array('class'=>'alert alert-danger'));
			echo '0';
		}
		die;
	}

	function practitioner_contact_information(){
		$userId=$this->Auth->user('user_id');
		$this->ContactInformation->id = $userId;
		if (($this->request->is('post')) || ($this->request->is('put'))) {

			$this->request->data['ContactInformation']['user_id'] = $userId;
			$this->request->data['ContactInformation']['updated_at'] = date('Y-m-d H:i:s');
			
			if($this->ContactInformation->save($this->request->data)) {
				$this->Session->setFlash(__('The contact information updated successfully',true),'default',array('class'=>'alert alert-success'));
			} else {
				$this->Session->setFlash(__('The contact information could not be saved. Please, try again.',true),'default',array('class'=>'alert alert-danger'));
			}
		}

		$country=$this->Country->find('all');
		$this->set('Country',$country);

		$data=$this->ContactInformation->findByUserId($userId);
		$this->request->data = $data;
	}
	
}
