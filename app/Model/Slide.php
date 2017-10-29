<?php
App::uses('AppModel', 'Model');
class Slide extends AppModel {
	public $actsAs = array('Common');
	public $validate = array(
		'slide_title' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the slide title'				
			)
		)
	);

	public function beforeSave($options = Array()){
		$languageId = CakeSession::read('language.id');
		$this->data['Slide']['lang_id'] = $languageId;
	}

	public function beforeFind($queryData) { 
        if(CakeSession::check('language.id')){
            $languageId = CakeSession::read('language.id');
            $queryData['conditions']['Slide.lang_id'] = $languageId;
        } 
	    return $queryData;
	}

}
