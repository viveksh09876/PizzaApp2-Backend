<?php
class LoginsController extends AppController {

	public $name = 'Logins';
	public $helpers = array('Form', 'Html', 'Js');
	public $layout='login';
	public $uses=array('User','Login','EmailTemplate');
	public $components=array('Core','Email');
	
	public function beforeFilter(){
		parent::beforeFilter();		
		$this->Auth->allow(array('admin_login','admin_logout','admin_forgate_password','practitioner_login','company_login'));
	}
		
	
	function admin_login() {
		if($this->request->is('post')){	
		 	if($this->Auth->login()){			 	
			 	/*--update access logs--*/
			 	$this->User->validation=null;
			 	$arrData=array('User'=>
					array('last_login_ip'=>$this->request->clientIp(),
					'last_login_date'=>date('Y-m-d H:i:s')
				));
				$this->User->id=$this->Auth->user('user_id');
				$this->User->save($arrData,false);
				/*--update access logs--*/		
				$this->redirect(array('controller'=>'home','action'=>'admin_choose_language'));			
			 	// $this->redirect($this->Auth->redirect());			 	  
		 	}else{
			 	$this->Session->setFlash(__('Invalid username or password, please try again',true),'default',array('class'=>'alert alert-danger text-center'));
		 	}	
		}
		
		if($this->Auth->loggedIn()){
			$this->redirect($this->Auth->redirect());
		}
		
	}	

	function company_login() {
		if($this->request->is('post')){	
			// pr($this->request->data); die;
		 	if($this->Auth->login()){			 
			 	/*--update access logs--*/
			 	$this->User->validation=null;
			 	$arrData=array('User'=>
					array('last_login_ip'=>$this->request->clientIp(),
					'last_login_date'=>date('Y-m-d H:i:s')
				));
				
				$this->User->id=$this->Auth->user('user_id');
				$this->User->save($arrData,false);
				/*--update access logs--*/		
				$this->redirect(array('controller'=>'home','action'=>'company_choose_language'));		
			 	// $this->redirect($this->Auth->redirect());			 	  
		 	}else{
		 		$this->Session->setFlash(__('Invalid username or password, please try again',true),'default',array('class'=>'alert alert-danger text-center'));
		 	}	
		}
		
		if($this->Auth->loggedIn()){
			$this->redirect($this->Auth->redirect());
		}
		
	}	
	
	function admin_logout() {	
		$this->Session->destroy();	
		$this->redirect($this->Auth->logout());
	}	
	
	function company_logout() {	
		$this->Session->destroy();		
		$this->redirect($this->Auth->logout());
	}	
				
	function admin_forgot_password(){
		$this->layout='ajax';		
		$this->Login->set($this->request->data);
		if($this->Login->validates(array('fieldList'=>array('email')))){
		
			$rs=$this->Login->findByEmail($this->request->data['Login']['email']);
			if($rs){
						
				$email=$rs['Login']['email'];								
					
				$name=$rs['Login']['first_name'].' '.$rs['Login']['last_name'];
				$newPass=$this->Core->generatePassword();
				
				$from="admin@admin.com";
				$to="test@brandmakerz.com";//$email;
				$subject="Forgate Password Mail";
				$content="Your New Password is:".$newPass;
								
				/*-template asssignment if any*/
				$template = $this->EmailTemplate->find('first',
					 array('conditions' => array('template_key'=> 'forgot_password_email',
				  	 'template_status' =>'Active')));
						
				if($template){	
					$arrFind=array('{name}','{password}');
					$arrReplace=array($name,$newPass);
					
					$from=$template['EmailTemplate']['from_email'];
					$subject=$template['EmailTemplate']['email_subject'];
					$content=str_replace($arrFind, $arrReplace,$template['EmailTemplate']['email_body']);
					
					
				}
				/*-[end]template asssignment*/				
									
				$this->set('Content',$content);
								
				try{
					$this->Email->from=$from;
					$this->Email->to=$to;
					$this->Email->subject=$subject;
					$this->Email->sendAs='html';
					$this->Email->template='general';
					$this->Email->delivery = 'smtp';
						
					if($this->Email->send()){
						
						/*--update user password--*/
						$this->User->id=$rs['Login']['user_id'];
						$data=array('User'=>array('password'=>AuthComponent::password($newPass)));
						$this->User->save($data);
						/*--/update user password--*/
						
						echo "<h4 class='success forgot_pass'>New password is sent to your email.";
						echo "</h4>";
					}
				}catch(Exception $e){
					echo "<h4 class='error forgot_pass'>The email could not be sent.Please contact to admin.</h4>";
					die;
				}
				
								
			}else{
				echo "<h4 class='error forgot_pass'>User email does not exist</h4>";
			}
		}else{
			echo "<div class='error forgot_pass'>Please enter the email</div>";
		}
		die;
	}
	
}
