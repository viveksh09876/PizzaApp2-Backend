<?php
class HomeController extends AppController {

	public $name = 'Home';
	public $helpers = array('Form', 'Html', 'Js','General');
	public $uses = array('Content','Testimonial','Service','Condition','SubCondition');	
	public $components=array('Core');	
	
	function beforeFilter(){
		parent::beforeFilter();		
	}	

	function admin_choose_language(){
		$this->layout = 'language';
		$this->set('title_for_layout','Language');
		$pageVar['languages'] = $this->Core->getList('Language',array('id','name'),array('status'=>1));
		if($this->request->is('post')&&(!empty($this->request->data))){
			$id = $this->request->data['Language']['id'];
			$data = $this->Core->getRecord('Language',array('id','name'),array('id'=>$id));
			$this->Session->write('language',$data['Language']);
			$this->redirect(array('controller'=>'reports','action'=>'index'));
		}
		$this->set('pageVar',$pageVar);
	}

	function company_choose_language(){
		$this->admin_choose_language();
		$this->render('admin_choose_language');
	}


	function admin_index() {
		if(!$this->Session->check('language')){
			$this->redirect('choose_language');
		}

		$this->set('title_for_layout','Dashboard');
		$pageVar['title'] = 'Dashboard';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Dashboard</li>';

        $pageVar['product_count'] = $this->Core->findCount('Product',array('Product.lang_id'=>CakeSession::read('language.id'),'Product.status'=>1));
        $pageVar['modifier_groups_count'] = $this->Core->findCount('Modifier',array('Modifier.lang_id'=>CakeSession::read('language.id'),'Modifier.status'=>1));
        $pageVar['modifier_count'] = $this->Core->findCount('Option',array('Option.lang_id'=>CakeSession::read('language.id'),'Option.status'=>1));
        $pageVar['choice_count'] = $this->Core->findCount('SubOption',array('SubOption.lang_id'=>CakeSession::read('language.id'),'SubOption.status'=>1));
        
		$this->set('pageVar',$pageVar);
	}

	function company_index() {
		if(!$this->Session->check('language')){
			$this->redirect('choose_language');
		}

		$this->set('title_for_layout','Company Dashboard');
		$pageVar['title'] = 'Company Dashboard';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Dashboard</li>';
		$this->set('pageVar',$pageVar);
	}
	
}
