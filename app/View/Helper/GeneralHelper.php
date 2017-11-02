<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class GeneralHelper extends Helper {

	function get_top_conditions(){
		$Model = ClassRegistry::init('Condition');
		$condtions = $Model->find('list',array('fields'=>array('id','condition')));
		return $condtions;

	}

	public function getStoreNameById($userId){
		$userModel = ClassRegistry::init('UserStore');
		$storeId = $userModel->findByUserId($userId,array('store_id'));
		
		$Model = ClassRegistry::init('Store');
		$data = $Model->findById($storeId['UserStore']['store_id'],array('Store.store_name'));
		return (isset($data['Store']['store_name']))?$data['Store']['store_name']:'';
	}

	public function getCategoryNameById($categoryId){	
		$Model = ClassRegistry::init('Category');
		$data = $Model->findById($categoryId,array('Category.name'));
		return isset($data['Category']['name'])?$data['Category']['name']:'';
	}

	public function getDealItem($itemId){	
		$Model = ClassRegistry::init('DealItem');

		$joins = array(
            array(
                'table'=>'products',
                'alias'=>'Product',
                'type'=>'LEFT',
                'conditions'=>'Product.plu_code = DealItem.product_plu'
            )  
        );

		$data = $Model->find('first',array('conditions'=>array('DealItem.id'=>$itemId),'joins'=>$joins));
		return $data['Product']['title'];
	}

	public function getProductName($pluCode){
		$Model = ClassRegistry::init('Product');
		$data = $Model->find('first',array('conditions'=>array('Product.plu_code'=>$pluCode)));
		return isset($data['Product']['title'])?$data['Product']['title']:null;
	}

	public function getProductList($catId){
		$Model = ClassRegistry::init('Product');
		return $products = $Model->find('list',array('fields'=>array('id','title'),'conditions'=>array('status'=>1,'category_id'=>$catId)));
	}

}
