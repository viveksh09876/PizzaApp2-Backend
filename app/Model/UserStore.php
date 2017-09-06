<?php
App::uses('AppModel', 'Model');
class UserStore extends AppModel {
	public $actsAs = array('Common');

	public $belongsTo = array(
		'Store' => array(
			'className' => 'Store',
			'foreignKey' => 'store_id',
			'dependent' => false				
		)			
	);
}