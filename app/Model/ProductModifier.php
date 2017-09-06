<?php
App::uses('AppModel', 'Model');
class ProductModifier extends AppModel {
	public $actsAs = array('Common');

	public function beforeSave($options = Array()){
		$languageId = CakeSession::read('language.id');
		$this->data['ProductModifier']['lang_id'] = $languageId;

		$userId = CakeSession::read('Auth.User.user_id');
		$this->data['ProductModifier']['store_id'] = $userId;
	}

}