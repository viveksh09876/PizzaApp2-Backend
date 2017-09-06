<?php
class Login extends AppModel {
	var $name = 'Login';
	var $primaryKey = 'user_id';
	var $useTable="users";
	var $validate = array(
	
	'email' =>array(
			array('rule' => 'notEmpty',
				'message' => 'Please enter the email'
			),
			array('rule' => 'email',
				'message' => 'Invalid email'
			)
		),

	'password' => 
		array(
			'rule' => 'notEmpty',
			'message' => 'Please enter the password' 
		)
	);


	function verifyLogin($reqData){
		$result=$this->findByEmailAndPasswordAndUserStatus($reqData['Login']['email'],md5($reqData['Login']['password']),'Active');
		if($result){
			return $result;
		}else{
			return false;
		}
	}
		
}
