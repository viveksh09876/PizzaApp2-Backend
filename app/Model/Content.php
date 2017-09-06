<?php
App::uses('AppModel', 'Model');

class Content extends AppModel {

	public $primaryKey='page_id';
	public $displayField = 'page_title';

	public $validate = array(
		'page_title' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the page title'				
			)
		),
		'page_slug' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enrt the page slug'
			),
			'checkSlugAvailbility' => array(
				'rule' => 'checkSlugAvailbility',
				'message' => 'The given slug is already exist'				
			),
		)
	);
	
	
	function checkSlugAvailbility(){
		$result=false;
		
		if(isset($this->data['Content']['page_id'])){
			$result=$this->find('all',array('conditions'=>array('page_slug'=>$this->data['Content']['page_slug'],'page_id NOT'=>$this->data['Content']['page_id']),'fields'=>array('page_id')));
		}else{
			$result=$this->find('all',array('conditions'=>array('page_slug'=>$this->data['Content']['page_slug']),'fields'=>array('page_id')));
			
		}	

		if($result){
			return false;
		}else{
			return true;
		}
	
	}
}
