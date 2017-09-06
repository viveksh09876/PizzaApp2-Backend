<?php
App::uses('AppModel', 'Model');
class CategorySubcategory extends AppModel {
	public $actsAs = array('Common');

	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter category name.'				
			)
		)
	);

	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'dependent' => false				
		),
		'SubCategory' => array(
			'className' => 'SubCategory',
			'foreignKey' => 'subcategory_id',
			'dependent' => false				
		),
		'Language' => array(
			'className' => 'Language',
			'foreignKey' => 'lang_id',
			'dependent' => false				
		)			
	);

	public function beforeSave($options = Array()){
		$user_id = CakeSession::read('Auth.User.user_id');
		if(!empty($user_id)){
			$this->data['CategorySubcategory']['store_id'] = $user_id;
		}
		return true;
	}
}
