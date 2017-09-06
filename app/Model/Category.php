<?php
App::uses('AppModel', 'Model');
class Category extends AppModel {
	public $actsAs = array('Common');

	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter category name.'				
			)
		)
	);

	public function beforeSave($options = Array()){
		$slug = $this->data['Category']['slug'];
		$name = $this->data['Category']['name'];
		$id = (!empty($this->data['Category']['id']))?$this->data['Category']['id']:0;
		
		$languageId = CakeSession::read('language.id');
		$this->data['Category']['lang_id'] = $languageId;

		$slug = (!empty($slug))?str_replace(' ', '-', strtolower($slug)):str_replace(' ', '-', strtolower($name));
		
		$count = $this->isSlugExits($slug,$id);
		if($count>0){
			$this->data['Category']['slug'] = $slug.'-'.$count;
		}else{
			$this->data['Category']['slug'] = $slug;
		}
	}

	public function isSlugExits($slug,$id){
		$count = $this->find('count',array('conditions'=>array('Category.slug'=>$slug,'Category.id !='=>$id)));
		if($count>0){
			return $this->find('count');
		}else{
			return $count;
		}
	}

	public function beforeFind($queryData) {
        if(CakeSession::check('language.id')){
	      	$languageId = CakeSession::read('language.id');
	      	$queryData['conditions']['Category.lang_id'] = $languageId;
        }
	    return $queryData;
	}

	public function getCategories($paginate,$conditions=array(),$limit=10){
		$categories = array();
		$qOpts = array(
			'conditions'=>$conditions,
			'limit'=>$limit,
			'order'=>'Category.id DESC'
		);

		if($paginate) {
	        return $qOpts; 
	    }else {
	        $data = $this->find('all', $qOpts);
	        return $data;
	    }
	}	

	function addCategory($data){
		$this->create();  
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}

	function updateCategory($data){ 
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}
}