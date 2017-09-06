<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $components = array('Auth', 'Session','Email');	
	public $uses = array('User');

   	function beforeFilter(){ 
   		$PageVar = array();	 	  	
   		$admin = Configure::read('Routing.prefixes');
		$curPrefix=$this->params['prefix'];
   		
   		if(isset($this->params[$admin[0]]) && $curPrefix=='admin') {   
			/*-- Auth configration for admin user-- */
	   		$this->Auth->loginRedirect=array('controller'=>'home','action'=>'admin_choose_language','admin'=>true);
  			$this->Auth->logoutRedirect=array('controller'=>'logins','action'=>'admin_login','admin'=>true);
  	 		$this->Auth->loginAction = array('controller' => 'logins', 'action' => 'admin_login','admin'=>true);       
  			$this->Auth->authError='Access denied! Please login to access the resource.';
  			$this->Auth->authenticate = array(
				'Form' => array(
					'userModel' => 'Login',
					'fields' => array('username' => 'email','password' => 'password'),
					'scope' => array('user_status' =>'Active','user_role_id'=>1)
				)
			); 
		         			
       		$this->Auth->authorize = array('Controller');		       					
			/*-- Auth configration for admin user --*/
  		
  		}elseif(isset($this->params[$admin[1]]) && $curPrefix=='company'){  
			/*-- Auth configration for company admin user-- */ 
			$this->Auth->loginRedirect=array('controller'=>'home','action'=>'company_index','company' => true);
			$this->Auth->logoutRedirect=array('controller'=>'logins','action'=>'company_login','company' => true);
			$this->Auth->loginAction = array('controller' => 'logins', 'action' => 'company_login','company' => true);       
			$this->Auth->authError='Access denied! Please login to access the resource.';
			$this->Auth->authenticate = array(
				'Form' => array(
					'userModel' => 'Login',
					'fields' => array('username' => 'email','password' => 'password'),
					'scope' => array('user_status' =>'Active','user_role_id'=>2)
				)
			); 
		  
			$this->Auth->authorize = array('Controller');                   
			/*-- auth configration for company admin user--*/

		}else{ 		
			/*--auth configration for frontend user--*/
			$this->Auth->loginRedirect=array('controller'=>'customers','action'=>'profile','admin' => false);
			$this->Auth->logoutRedirect=array('controller'=>'home','action'=>'index','admin' => false);
	 		$this->Auth->loginAction = array('controller' => 'customers', 'action' => 'index','admin' => false);       
			$this->Auth->authError='Access denied! Please login to access the resource.';
			$this->Auth->authenticate = array(
				'Form' => array(
					'userModel' => 'Login',
					'fields' => array('username' => 'email','password' => 'password'),
					'scope' => array('user_status' =>'Active','user_role_id'=>3)
				)
			); 
	         			
			$this->Auth->authorize = array('Controller');		       					
			/*--/auth configration for frontend user--*/
		}

	}
  	
	function beforeRender(){
 		$this->set( 'loggedIn', $this->Auth->loggedIn());
 		$this->set( 'loggedUser', $this->Auth->user());   			
	}  	
   	
	function isAuthorized($user=null) {
		$admin = Configure::read('Routing.prefixes');
		$userRole = $this->Auth->user('user_role_id');
		if ((isset($this->params[$admin[0]]))) {
			$this->layout = 'admin';
			$userRole = $this->Auth->user('user_role_id');
			if (isset($userRole) && $userRole == 1) {
				return true;
			} else {
				$this->redirect($this->Auth->logout());
				die;
			}
		}elseif((isset($this->params[$admin[1]]))){  
			$this->layout = 'company';
			$userRole = $this->Auth->user('user_role_id');
			if (isset($userRole) && $userRole == 2) {
				return true;
			} else {
				$this->redirect($this->Auth->logout());
				die;
			}
		}else {
			$this->layout = 'default';
			return true;
		}               
   		
	}
  
	function sendEmail($to,$from,$subject,$content='',$template='default'){
		try{
		 $this->set('Content',$content);//content will be render on template
			$this->Email->to=$to;
			$this->Email->from=$from;
			$this->Email->subject=$subject;
		    $this->Email->message=$content;
			$this->Email->sendAs='html';
			$this->Email->template=$template;			

			if(constant('EMAIL_DELEVERY')=='smtp'){
					$this->Email->delivery = 'smtp';
			}

			if($this->Email->send($content)){
					return true;
			}
		}catch(Exception $e){
              echo '<pre>';
              print_r($e);
			return false;		
		}	
		return false;
		die;
    }
	
	
// 	function sendEmail($to,$from,$subject,$content='',$cc='',$template='default'){
		 
// 	 	App::uses('CakeEmail', 'Network/Email'); 
// 	 	$email = new CakeEmail('smtp');
// 	 	$email->from(array($from => 'Patient Care'))
// 	 		  ->to($to)
// 	 		  ->template($template)
// 	 		  ->emailFormat('html')
// 	 		  ->subject($subject)
// 	 		  ->send($content);	
		 
// 			$url = 'https://api.sendgrid.com/';
// 			$user = 'Pushpendra_Rajput';
// 			$pass = 'admin@123';
		  
// 			$params = array(
// 				'api_user'  => $user,
// 				'api_key'   => $pass,
// 				'to'        => $to,
// 				'subject'   => $subject,
// 				'html'      => $content,
// 				'text'      => $content,
// 				'from'      => $from,
// 	 		);
		  
// 			$request =  $url.'api/mail.send.json';

// 			// Generate curl request
// 			$session = curl_init($request);
// 			// Tell curl to use HTTP POST
// 			curl_setopt ($session, CURLOPT_POST, true);
// 			// Tell curl that this is the body of the POST
// 			curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// 			// Tell curl not to return headers, but do return the response
// 			curl_setopt($session, CURLOPT_HEADER, false);
// 			// Tell PHP not to use SSLv3 (instead opting for TLS)
// 			//	 	  curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
// 			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		  
// //	 	   obtain response
		 
// 			$response = curl_exec($session);
	 	  
// 			$arr = json_decode($response);
// 			if($arr->message=='success')
// 				return true;
// 			else
// 				return false;
// 			curl_close($session);
		  
// 			return true;
// 	 	die;
//    }
	
   function sendPhpEmail($to,$from,$subject,$content='',$cc=''){
	   	// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: " .$from."\r\n";
		$headers .= "Cc: " .$cc."\r\n";
		if(mail($to,$subject,$content,$headers)){
			return true;
		}else{
			return false;
		}
   }
}
