<?php
App::uses('AppModel', 'Model');
class Deal extends AppModel {
	public $actsAs = array('Common');

	public $validate = array(
		'title' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter deal title.'				
			)
		),
		'code' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter deal code.'				
			)
		)
	);

	public function beforeSave($options = Array()){
		$languageId = CakeSession::read('language.id');
		$this->data['Deal']['lang_id'] = $languageId;
	}

	public function beforeFind($queryData) {
        if(CakeSession::check('language.id')){
	      	$languageId = CakeSession::read('language.id');
	      	$queryData['conditions']['Deal.lang_id'] = $languageId;
        }
	    return $queryData;
	}

	function addDeal($data){
		$this->create();  
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}

	function updateDeal($data){ 
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}
}