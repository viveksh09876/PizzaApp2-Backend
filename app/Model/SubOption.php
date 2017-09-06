<?php
App::uses('AppModel', 'Model');
class SubOption extends AppModel {
	public $actsAs = array('Common');

	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter choice name.'				
			)
		)
	);   
	
	public function beforeSave($options = Array()){
		$languageId = CakeSession::read('language.id');
		$this->data['SubOption']['lang_id'] = $languageId;
	}

	public function beforeFind($queryData) {
      	if(CakeSession::check('language.id')){
			$languageId = CakeSession::read('language.id');
			$queryData['conditions']['SubOption.lang_id'] = $languageId;
      	}
		return $queryData;
	}

	public function getSubOptions($paginate,$conditions=array(),$limit=10){
		$categories = array();
		$qOpts = array(
			'conditions'=>$conditions,
			'limit'=>$limit,
			'order'=>'SubOption.id DESC'
		);

		if($paginate) {
	        return $qOpts; 
	    }else {
	        $data = $this->find('all', $qOpts);
	        return $data;
	    }
	}	

	function addSubOption($data){
		$this->create();  
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}

	function updateSubOption($data){ 
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}
}