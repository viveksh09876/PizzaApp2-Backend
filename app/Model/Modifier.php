<?php
App::uses('AppModel', 'Model');
class Modifier extends AppModel {
	public $actsAs = array('Common');

	public $validate = array(
		'title' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter modifier title.'				
			)
		)
	);

	public $hasMany = array(
		'ModifierOption'=>array(
			'className' => 'ModifierOption',
			'foreignKey' => 'modifier_id',
			'dependent' => false
		)
	);

	public function beforeSave($options = Array()){
		$languageId = CakeSession::read('language.id');
		$this->data['Modifier']['lang_id'] = $languageId;
	}	

	public function beforeFind($queryData) {
        if(CakeSession::check('language.id')){
		  	$languageId = CakeSession::read('language.id');
		 	$queryData['conditions']['Modifier.lang_id'] = $languageId;
        }
		return $queryData;
	}

	public function getModifiers($paginate,$conditions=array(),$limit=10){
		$categories = array();
		$qOpts = array(
			'conditions'=>$conditions,
			'limit'=>$limit,
			'order'=>'Modifier.id DESC'
		);

		if($paginate) {
			return $qOpts; 
		}else {
			$data = $this->find('all', $qOpts);
			return $data;
		}
	}	

	function addModifier($data){
		$this->create();  
		if ($this->save($data)) {
		   return true;
		} else {
		   return false;
		}
	}

	function updateModifier($data){ 
		if ($this->save($data)) {
		   return true;
		} else {
		   return false;
		}
	}

}