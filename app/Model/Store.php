<?php
App::uses('AppModel', 'Model');
class Store extends AppModel {
	public $actsAs = array('Common');
	public $validate = array(
		'store_email' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the store email.'				
			)
		),
		'store_name' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the store name.'				
			)
		),
		'store_address' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the store address.'				
			)
		)
	);

	public $hasMany = array(
		'StoreTime'=>array(
			'className' => 'StoreTime',
			'foreignKey' => 'store_id',
			'dependent' => false
		)
	);

	public function beforeSave($options = Array()){
		$languageId = CakeSession::read('language.id');
		$this->data['Store']['lang_id'] = $languageId;
	}

	public function beforeFind($queryData) { 
        if(CakeSession::check('language.id')){
            $languageId = CakeSession::read('language.id');
            $queryData['conditions']['Store.lang_id'] = $languageId;
        } 
	    return $queryData;
	}
}
