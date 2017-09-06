<?php
App::uses('AppModel', 'Model');
class Question extends AppModel {
	public $actsAs = array('Common');

	public $validate = array(
		'question' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter question.'				
			)
		)
	);

	public function beforeSave($options = Array()){
		$languageId = CakeSession::read('language.id');
		$this->data['Question']['lang_id'] = $languageId;
	}

	public function beforeFind($queryData) {
        if(CakeSession::check('language.id')){
	      	$languageId = CakeSession::read('language.id');
	      	$queryData['conditions']['Question.lang_id'] = $languageId;
        }
	    return $queryData;
	}

	public function getQuestions($paginate,$conditions=array(),$limit=10){
		$categories = array();
		$qOpts = array(
			'conditions'=>$conditions,
			'limit'=>$limit
		);

		if($paginate) {
	        return $qOpts; 
	    }else {
	        $data = $this->find('all', $qOpts);
	        return $data;
	    }
	}	

	function addQuestion($data){
		$this->create();  
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}

	function updateQuestion($data){ 
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}
}