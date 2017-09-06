<?php
App::uses('AppModel', 'Model');
class Option extends AppModel {
	public $actsAs = array('Common');

	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter modifier name.'				
			)
		),
		'plu_code' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter PLU code.'				
			)
		)
	);

	public $hasMany = array(
		'OptionSuboption'=>array(
			'className' => 'OptionSuboption',
			'foreignKey' => 'option_id',
			'dependent' => false
		)
	);

	public function beforeSave($options = Array()){
		$languageId = CakeSession::read('language.id');
		$this->data['Option']['lang_id'] = $languageId;
	}

	public function beforeFind($queryData) {
        if(CakeSession::check('language.id')){
	      	$languageId = CakeSession::read('language.id');
	      	$queryData['conditions']['Option.lang_id'] = $languageId;
        }
	    return $queryData;
	}

	public function getOptions($paginate,$conditions=array(),$limit=10){
		$categories = array();
		$qOpts = array(
			'conditions'=>$conditions,
			'limit'=>$limit,
			'order'=>'Option.id DESC'
		);

		if($paginate) {
			return $qOpts; 
		}else {
			$data = $this->find('all', $qOpts);
			return $data;
		}
	}	

	function addOption($data){
		$this->create();  
		if ($this->save($data)) {
		   return true;
		} else {
		   return false;
		}
	}

	function updateOption($data){ 
		if ($this->save($data)) {
		   return true;
		} else {
		   return false;
		}
	}
}