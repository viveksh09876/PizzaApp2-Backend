<?php
class CommonController extends AppController {

	public $name = 'Common';
	public $helpers = array('Form', 'Html', 'Js');
	public $paginate = array('limit' =>10);	
	public $uses=array('Condition');
	public $components=array('Core');	
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('get_conditions','get_sub_conditions'));
	}
			
}
