<?php
App::uses('AppModel', 'Model');
class SubCategory extends AppModel {
	public $actsAs = array('Common');

	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter sub category name.'				
			)
		),
		'cat_id' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please select parent category.'				
			)
		)
	);

	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'cat_id',
			'dependent' => false				
		),
		'User'=>array(
			'className' => 'User',
			'foreignKey' => 'store_id',
			'dependent' => false
		)		
	);

	public function beforeSave($options = Array()){
		$slug = $this->data['SubCategory']['slug'];
		$name = $this->data['SubCategory']['name'];
		$id = (!empty($this->data['SubCategory']['id']))?$this->data['SubCategory']['id']:0;

		$languageId = CakeSession::read('language.id');
		$this->data['SubCategory']['lang_id'] = $languageId;

		$slug = (!empty($slug))?str_replace(' ', '-', strtolower($slug)):str_replace(' ', '-', strtolower($name));
		
		$count = $this->isSlugExits($slug,$id);
		if($count>0){
			$this->data['SubCategory']['slug'] = $slug.'-'.$count;
		}else{
			$this->data['SubCategory']['slug'] = $slug;
		}
	}

	public function isSlugExits($slug,$id){
		$count = $this->find('count',array('conditions'=>array('SubCategory.slug'=>$slug, 'SubCategory.id !='=>$id)));
		if($count>0){
			return $this->find('count');
		}else{
			return $count;
		}
	}	

	public function beforeFind($queryData) {
        if(CakeSession::check('language.id')){
	    	$languageId = CakeSession::read('language.id');
	    	$queryData['conditions']['SubCategory.lang_id'] = $languageId;
        }
	    return $queryData;
	}

	public function getSubCategories($paginate,$conditions=array(),$limit=10){
		$categories = array();
		$qOpts = array(
			'conditions'=>$conditions,
			'limit'=>$limit,
			'order'=>'SubCategory.id DESC'
		);

		if($paginate) {
	        return $qOpts; 
	    }else {
	        $data = $this->find('all', $qOpts);
	        return $data;
	    }
	}	

	function addSubCategory($data){
		$this->create();  
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}

	function updateSubCategory($data){ 
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}
}
