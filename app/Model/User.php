<?php
class User extends AppModel {
	public $name = 'User';
	public $primaryKey = 'user_id';
	public $displayField = 'user_id';
	public $useTable = 'users'; 
	
	public $belongsTo = array(
		'UserRole' => array(
			'className' => 'UserRole',
			'foreignKey' => 'user_role_id',
			'dependent' => false				
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'dependent' => false				
		)			
	);

	public $hasOne = array(
		'UserStore' => array(
			'className' => 'UserStore',
			'foreignKey' => 'user_id',
			'dependent' => false				
		)		
	);
		
	public $validate = array(
		'user_role_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select the user type'
		),
		'password' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter the password',
		),
		'email' =>array(
			array('rule' => 'notEmpty',
				'message' => 'Please enter the email'
			),
			array('rule' => 'email',
				'message' => 'Invalid email'
			),
			'checkEmailAvailbility' => array(
				'rule' => 'checkEmailAvailbility',
				'message' => 'The given user name/email already exist'				
			)
		),
		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter the first name',
		),
		'last_name' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter the last name',
		)
	);
	
	
	
	function checkEmailAvailbility(){
		$result=false;
		
		if(isset($this->data['User']['user_id'])){
			$result=$this->find('all',array('conditions'=>array('email'=>$this->data['User']['email'],'user_id NOT'=>$this->data['User']['user_id']),'fields'=>array('user_id')));
		}else{
			$result=$this->find('all',array('conditions'=>array('email'=>$this->data['User']['email']),'fields'=>array('user_id')));
			
		}	

		if($result){
			return false;
		}else{
			return true;
		}
	
	}
	
	
}
