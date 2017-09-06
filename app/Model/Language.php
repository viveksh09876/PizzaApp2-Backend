<?php
App::uses('AppModel', 'Model');
class Language extends AppModel {
 	public $actsAs = array('Common');
 	
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter language name.'				
			)
		)
	);
}
