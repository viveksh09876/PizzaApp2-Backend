<?php
App::uses('AppModel', 'Model');
class Coupon extends AppModel {
	public $actsAs = array('Common');

	public $validate = array(
		'coupon_name' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter coupon name.'				
			)
		),
		'coupon_code' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter coupon code.'				
			)
		)
	);

	public function beforeSave($options = Array()){
		$languageId = CakeSession::read('language.id');
		$this->data['Coupon']['lang_id'] = $languageId;
	}

	public function beforeFind($queryData) {
        if(CakeSession::check('language.id')){
	      	$languageId = CakeSession::read('language.id');
	      	$queryData['conditions']['Coupon.lang_id'] = $languageId;
        }
	    return $queryData;
	}

	public function getCoupons($paginate,$conditions=array(),$limit=10){
		$categories = array();
		$qOpts = array(
			'conditions'=>$conditions,
			'limit'=>$limit,
			'order'=>'Coupon.id DESC'
		);

		if($paginate) {
	        return $qOpts; 
	    }else {
	        $data = $this->find('all', $qOpts);
	        return $data;
	    }
	}	

	function addCoupon($data){
		$this->create();  
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}

	function updateCoupon($data){ 
        if ($this->save($data)) {
           return true;
        } else {
           return false;
        }
	}
}