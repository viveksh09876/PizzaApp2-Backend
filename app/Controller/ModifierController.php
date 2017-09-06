<?php
App::uses('AppController', 'Controller');

class ModifierController extends AppController{
	public $components=array('Core');
    public $uses = array('Modifier','Option','ModifierOption','SubOption','OptionSuboption','ProductModifier');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array());
	}

	public function admin_index(){
		$pageVar['title'] = 'Modifier Groups';
		$pageVar['sub_title'] = 'List modifier groups';
		$pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Modifier Groups</li>';

		$this->paginate = array(
            'limit' => 10,
        );
        $Modifiers = $this->paginate('Modifier');
        $this->set(compact('Modifiers','pageVar'));
	}

    public function company_index(){
        $pageVar['title'] = 'Modifier Groups';
        $pageVar['sub_title'] = 'List modifier groups';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Modifier Groups</li>';

        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $conditions = array();
        /* Apply filter */
        $store_id = $this->request->query('store_id');
        $name = $this->request->query('name');

        if(!empty($store_id)){
            $conditions = array('Modifier.store_id'=>$store_id);
            $this->request->data['Search']['store_id'] = $store_id;
        }

        if(!empty($name)){
            $conditions = array('Modifier.title LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['name'] = $name;
        }

        if(!empty($store_id) && !empty($name)){
            $conditions = array('Modifier.store_id'=>$store_id,'Modifier.title LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['store_id'] = $store_id;
            $this->request->data['Search']['name'] = $name;
        }
        /* End filters */
        $limit = 10;
        $this->paginate = $this->Modifier->getModifiers(true,$conditions,$limit);
        $Modifiers = $this->paginate('Modifier');
        $this->set(compact('Modifiers','pageVar'));
    }

	public function admin_add(){
		$pageVar['title'] = 'Add Modifier Group';
		$pageVar['sub_title'] = 'Add new modifier group';
		$pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Modifier Group</li>';
		if ($this->request->is('post')) {
            $options = (!empty($this->request->data['Modifier']['options']))?$this->request->data['Modifier']['options']:array();

            $this->Modifier->create();	

            if(!empty($this->request->data['Modifier']['image']) && !empty($this->request->data['Modifier']['image']['name'])){
                $file = explode('.',$this->request->data['Modifier']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/modifiers/'.$file; 
                move_uploaded_file($this->request->data['Modifier']['image']['tmp_name'], $newPath);
                $this->request->data['Modifier']['image'] = $newPath;     
            }else{
                unset($this->request->data['Modifier']['image']);
            }	
            
            if ($this->Modifier->save($this->request->data)) {
                $modifierId = $this->Modifier->getLastInsertId(); 
                if(!empty($options)){
                    $data = array();
                    foreach ($options as $key => $option) {
                        $data[$key] = array(
                            'modifier_id'=>$modifierId,
                            'option_id'=>$option
                        );
                    }
                    $this->ModifierOption->saveAll($data);   
                }

                $this->Session->setFlash(__('The modifier group has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The modifier group could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }

		$this->set('pageVar',$pageVar);
	}

    public function company_add(){
        $pageVar['title'] = 'Add Modifier Group';
        $pageVar['sub_title'] = 'Add new modifier group';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Modifier Group</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        if ($this->request->is('post')) {
            $storeIds = $this->request->data['Modifier']['store_id'];
            $title = $this->request->data['Modifier']['title'];
            $sortOrder = $this->request->data['Modifier']['sort_order'];
            $short_description = $this->request->data['Modifier']['short_description'];
            $status = $this->request->data['Modifier']['status'];

            $options = (!empty($this->request->data['Modifier']['options']))?$this->request->data['Modifier']['options']:array();

            $this->Modifier->create();  

            if(!empty($this->request->data['Modifier']['image']) && !empty($this->request->data['Modifier']['image']['name'])){
                $file = explode('.',$this->request->data['Modifier']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/modifiers/'.$file; 
                move_uploaded_file($this->request->data['Modifier']['image']['tmp_name'], $newPath);
                $image = $newPath;     
            }else{
                $image = '';
                unset($this->request->data['Modifier']['image']);
            }   
            $modifierData = array();
            foreach ($storeIds as $key => $storeId) {
                $modifierData['Modifier'] = array(
                    'store_id'=>$storeId,
                    'title'=>$title,
                    'short_description'=>$short_description,
                    'sort_order'=>$sortOrder,
                    'image'=>$image,
                    'status'=>$status
                );
                $this->Modifier->create();
                if ($this->Modifier->save($modifierData)) {
                    $modifierId = $this->Modifier->getLastInsertId(); 
                    if(!empty($options)){
                        $data = array();
                        foreach ($options as $key => $option) {
                            $data[$key] = array(
                                'modifier_id'=>$modifierId,
                                'option_id'=>$option
                            );
                        }
                        $this->ModifierOption->saveAll($data);   
                    }
                }
            }

            $this->Session->setFlash(__('The modifier group has been added'),'default',array('class'=>'alert alert-success'));
            $this->redirect(array('action' => 'index'));
        }

        $this->set('pageVar',$pageVar);
    }

	public function admin_edit($id = null){
		$pageVar['title'] = 'Edit Modifier Group';
        $pageVar['sub_title'] = 'Edit modifier group details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Modifier Group</li>';
        $this->Modifier->id = $id;
        $data = $this->Modifier->read(null,$id);
        foreach ($data['ModifierOption'] as $key => $value) {
            $data['Modifier']['option'][] = $value['option_id']; 
        }
        
        if (!$this->Modifier->exists()) {
            throw new NotFoundException(__('Invalid Modifier Group'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $options = (!empty($this->request->data['Modifier']['options']))?$this->request->data['Modifier']['options']:array();
            if(!empty($this->request->data['Modifier']['image']) && !empty($this->request->data['Modifier']['image']['name'])){
                $file = explode('.',$this->request->data['Modifier']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/modifiers/'.$file;
                $prevpath = 'img/admin/modifiers/'.$data['Modifier']['image'];
                if(file_exists($prevpath)){
                    unlink($prevpath); 
                }
                move_uploaded_file($this->request->data['Modifier']['image']['tmp_name'], $newPath);
                $this->request->data['Modifier']['image'] = $newPath; 
            }else{
                unset($this->request->data['Modifier']['image']);
            }

            if ($this->Modifier->save($this->request->data)) {
                $modifierId = $this->Modifier->id; 
                if(!empty($options)){
                    $data = array();
                    foreach ($options as $key => $option) {
                        $data[$key] = array(
                            'modifier_id'=>$modifierId,
                            'option_id'=>$option
                        );
                    }
                    $this->ModifierOption->deleteAll(array('modifier_id'=>$modifierId));
                    $this->ModifierOption->saveALl($data);
                }
                $this->Session->setFlash(__('The modifier group has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The modifier group could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
	}

    public function company_edit($id = null){
        $pageVar['title'] = 'Edit Modifier Group';
        $pageVar['sub_title'] = 'Edit modifier group details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Modifier Group</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);
        $this->Modifier->id = $id;
        $data = $this->Modifier->read(null,$id);
        foreach ($data['ModifierOption'] as $key => $value) {
            $data['Modifier']['option'][] = $value['option_id']; 
        }
        
        if (!$this->Modifier->exists()) {
            throw new NotFoundException(__('Invalid Modifier Group'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Modifier']['store_id']= $this->request->data['Modifier']['store_id'][0];
            $options = (!empty($this->request->data['Modifier']['options']))?$this->request->data['Modifier']['options']:array();
            if(!empty($this->request->data['Modifier']['image']) && !empty($this->request->data['Modifier']['image']['name'])){
                $file = explode('.',$this->request->data['Modifier']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/modifiers/'.$file;
                $prevpath = 'img/admin/modifiers/'.$data['Modifier']['image'];
                if(file_exists($prevpath)){
                    unlink($prevpath); 
                }
                move_uploaded_file($this->request->data['Modifier']['image']['tmp_name'], $newPath);
                $this->request->data['Modifier']['image'] = $newPath; 
            }else{
                unset($this->request->data['Modifier']['image']);
            }

            if ($this->Modifier->save($this->request->data)) {
                $modifierId = $this->Modifier->id; 
                if(!empty($options)){
                    $data = array();
                    foreach ($options as $key => $option) {
                        $data[$key] = array(
                            'modifier_id'=>$modifierId,
                            'option_id'=>$option
                        );
                    }
                    $this->ModifierOption->deleteAll(array('modifier_id'=>$modifierId));
                    $this->ModifierOption->saveALl($data);
                }
                $this->Session->setFlash(__('The modifier group has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The modifier group could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('company_add');
    }

    function admin_options(){
        $pageVar['title'] = 'Modifiers';
        $pageVar['sub_title'] = 'List modifiers';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Modifiers</li>';

        $conditions = array('Option.store_id'=>$this->Auth->user('user_id'));

        /* Apply filter */
        $name = $this->request->query('name');

        if(!empty($name)){
            $conditions = array('Option.name LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['name'] = $name;
        }

        /* End filters */
        $limit = 10;
        $qOptions = $this->Option->getOptions(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $Options = $this->paginate('Option');
        $this->set(compact('Options','pageVar'));
    }

    function company_options(){
        $pageVar['title'] = 'Modifiers';
        $pageVar['sub_title'] = 'List modifiers';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Modifiers</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $conditions = array();
        /* Apply filter */
        $store_id = $this->request->query('store_id');
        $name = $this->request->query('name');

        if(!empty($store_id)){
            $conditions = array('Option.store_id'=>$store_id);
            $this->request->data['Search']['store_id'] = $store_id;
        }

        if(!empty($category_name)){
            $conditions = array('Option.name LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['name'] = $name;
        }

        if(!empty($store_id) && !empty($name)){
            $conditions = array('Option.store_id'=>$store_id,'Option.name LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['store_id'] = $store_id;
            $this->request->data['Search']['name'] = $name;
        }
        /* End filters */
        $limit = 10;
        $this->paginate = $this->Option->getOptions(true,$conditions,$limit);
        $Options = $this->paginate('Option');
        $this->set(compact('Options','pageVar'));
    }

    function admin_add_option(){
        $pageVar['title'] = 'Add Modifier';
        $pageVar['sub_title'] = 'Add new modifier';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Modifier</li>';
        $pageVar['modifiers'] = $this->Core->getList('Modifier',array('Modifier.id','Modifier.title'),array('Modifier.lang_id'=>CakeSession::read('language.id'),'Modifier.status'=>1));

        if ($this->request->is('post')) {
            $this->Option->create();  
            $suboptions = (!empty($this->request->data['Option']['sub_options']))?$this->request->data['Option']['sub_options']:array();
            
            if(!empty($this->request->data['Option']['image']) && !empty($this->request->data['Option']['image']['name'])){
                $file = explode('.',$this->request->data['Option']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/modifiers/'.$file; 
                move_uploaded_file($this->request->data['Option']['image']['tmp_name'], $newPath);
                $this->request->data['Option']['image'] = $newPath;     
            }else{
                unset($this->request->data['Option']['image']);
            }   

            if ($this->Option->save($this->request->data)) {
                $optionId = $this->Option->getLastInsertId();
                if(!empty($suboptions)){
                    $data = array();
                    foreach ($suboptions as $key => $suboption) {
                        $data[$key] = array(
                            'suboption_id'=>$suboption,
                            'option_id'=>$optionId
                        );
                    }
                    $this->OptionSuboption->saveAll($data);
                }

                $this->Session->setFlash(__('The modifier has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'options'));
            } else {
                $this->Session->setFlash(__('The modifier could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }

        $this->set('pageVar',$pageVar);
    }

    function company_add_option(){
        $pageVar['title'] = 'Add Modifier';
        $pageVar['sub_title'] = 'Add new modifier';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Modifier</li>';
        $pageVar['modifiers'] = $this->Core->getList('Modifier',array('Modifier.id','Modifier.title'),array('Modifier.lang_id'=>CakeSession::read('language.id'),'Modifier.status'=>1));
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);


        if ($this->request->is('post')) {
            $storeIds = $this->request->data['Option']['store_id'];
            $name = $this->request->data['Option']['name'];
            $pluCode = $this->request->data['Option']['plu_code'];
            $sortOrder = $this->request->data['Option']['sort_order'];
            $dependent_modifier_id = $this->request->data['Option']['dependent_modifier_id'];
            $dependent_modifier_option_id = $this->request->data['Option']['dependent_modifier_option_id'];
            $dependent_modifier_count = $this->request->data['Option']['dependent_modifier_count'];
            $status = $this->request->data['Option']['status'];
            $suboptions = (!empty($this->request->data['Option']['sub_options']))?$this->request->data['Option']['sub_options']:array();
            
            if(!empty($this->request->data['Option']['image']) && !empty($this->request->data['Option']['image']['name'])){
                $file = explode('.',$this->request->data['Option']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/modifiers/'.$file; 
                move_uploaded_file($this->request->data['Option']['image']['tmp_name'], $newPath);
                $image = $newPath;     
            }else{
                $image = '';  
                unset($this->request->data['Option']['image']);
            }   

            $storeCat = array();
           
            foreach ($storeIds as $key => $storeId) {
                $storeCat['Option'] = array(
                    'store_id'=>$storeId,
                    'name'=>$name,
                    'plu_code'=>$pluCode,
                    'dependent_modifier_id'=>$dependent_modifier_id,
                    'dependent_modifier_option_id'=>$dependent_modifier_option_id,
                    'dependent_modifier_count'=>$dependent_modifier_count,
                    'sort_order'=>$sortOrder,
                    'image'=>$image,
                    'status'=>$status
                );
                $this->Option->create();
                if ($this->Option->save($storeCat)) {
                    $optionId = $this->Option->getLastInsertId();
                    if(!empty($suboptions)){
                        $data = array();
                        foreach ($suboptions as $key => $suboption) {
                            $data[$key] = array(
                                'suboption_id'=>$suboption,
                                'option_id'=>$optionId
                            );
                        }
                        $this->OptionSuboption->saveAll($data);
                    }
                } 

            }

            $this->Session->setFlash(__('The modifier has been added'),'default',array('class'=>'alert alert-success'));
                    $this->redirect(array('action' => 'options'));
        }

        $this->set('pageVar',$pageVar);
    }

    function admin_edit_option($id = null){
        $pageVar['title'] = 'Edit Modifier';
        $pageVar['sub_title'] = 'Edit modifier details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Modifier</li>';
        $pageVar['modifiers'] = $this->Core->getList('Modifier',array('Modifier.id','Modifier.title'),array('Modifier.status'=>1));
        $this->Option->id = $id;
        $data = $this->Option->read(null,$id);
       
        foreach ($data['OptionSuboption'] as $key => $value) {
            $data['Option']['sub_options'][] = $value['suboption_id']; 
        }

        if (!$this->Option->exists()) {
            throw new NotFoundException(__('Invalid Option'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $suboptions = (!empty($this->request->data['Option']['sub_options']))?$this->request->data['Option']['sub_options']:array();
            if(!empty($this->request->data['Option']['image']) && !empty($this->request->data['Option']['image']['name'])){
                $file = explode('.',$this->request->data['Option']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/modifiers/'.$file;
                $prevpath = 'img/admin/modifiers/'.$data['Option']['image'];
                if(file_exists($prevpath)){
                    unlink($prevpath); 
                }
                move_uploaded_file($this->request->data['Option']['image']['tmp_name'], $newPath);
                $this->request->data['Option']['image'] = $newPath; 
            }else{
                unset($this->request->data['Option']['image']);
            }

            if ($this->Option->save($this->request->data)) {
                $optionId = $this->Option->id; 
                if(!empty($suboptions)){
                    $data = array();
                    foreach ($suboptions as $key => $suboption) {
                        $data[$key] = array(
                            'suboption_id'=>$suboption,
                            'option_id'=>$optionId
                        );
                    }
                }
                $this->OptionSuboption->deleteAll(array('OptionSuboption.option_id'=>$optionId));
                $this->OptionSuboption->saveAll($data);
                
                $this->Session->setFlash(__('The modifier has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'options'));
            } else {
                $this->Session->setFlash(__('The modifier could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add_option');
    }

    function company_edit_option($id = null){
        $pageVar['title'] = 'Edit Modifier';
        $pageVar['sub_title'] = 'Edit modifier details';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Modifier</li>';
        $pageVar['modifiers'] = $this->Core->getList('Modifier',array('Modifier.id','Modifier.title'),array('Modifier.status'=>1));
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $this->Option->id = $id;
        $conditions = array('Option.id'=>$id);
        $limit = 10;
        $OptionDetails = $this->Option->getOptions(false,$conditions,$limit);
        $data = $OptionDetails[0];
       
        foreach ($data['OptionSuboption'] as $key => $value) {
            $data['Option']['sub_options'][] = $value['suboption_id']; 
        }

        if (!$this->Option->exists()) {
            throw new NotFoundException(__('Invalid Option'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
             $this->request->data['Option']['store_id']= $this->request->data['Option']['store_id'][0];
            $suboptions = (!empty($this->request->data['Option']['sub_options']))?$this->request->data['Option']['sub_options']:array();
            if(!empty($this->request->data['Option']['image']) && !empty($this->request->data['Option']['image']['name'])){
                $file = explode('.',$this->request->data['Option']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/modifiers/'.$file;
                $prevpath = 'img/admin/modifiers/'.$data['Option']['image'];
                if(file_exists($prevpath)){
                    unlink($prevpath); 
                }
                move_uploaded_file($this->request->data['Option']['image']['tmp_name'], $newPath);
                $this->request->data['Option']['image'] = $newPath; 
            }else{
                unset($this->request->data['Option']['image']);
            }

            if ($this->Option->save($this->request->data)) {
                $optionId = $this->Option->id; 
                if(!empty($suboptions)){
                    $data = array();
                    foreach ($suboptions as $key => $suboption) {
                        $data[$key] = array(
                            'suboption_id'=>$suboption,
                            'option_id'=>$optionId
                        );
                    }

                    $this->OptionSuboption->deleteAll(array('OptionSuboption.option_id'=>$optionId));
                    $this->OptionSuboption->saveAll($data);
                }
                
                $this->Session->setFlash(__('The modifier has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'options'));
            } else {
                $this->Session->setFlash(__('The modifier could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('company_add_option');
    }

    function get_modifier_options(){
        $this->layout = FALSE;
        $this->autoRender = FALSE;
        if($this->request->is('post')){
            
            if(isset($this->request->data['modifier_id'])){   
                $modifierId = $this->request->data['modifier_id'];

                $conditions = array(
                    'ModifierOption.modifier_id'=>$modifierId
                );
                $fields = array(
                    'ModifierOption.modifier_id',
                    'ModifierOption.option_id',
                    'OptionSuboption.suboption_id',
                    'SubOption.id',
                    'SubOption.name',
                    'Option.id',
                    'Option.name'
                );
                $joins = array(
                    array(
                        'table'=>'option_suboptions',
                        'alias'=>'OptionSuboption',
                        'type'=>'LEFT',
                        'conditions'=>'OptionSuboption.option_id = ModifierOption.option_id'
                    ),
                    array(
                        'table'=>'sub_options',
                        'alias'=>'SubOption',
                        'type'=>'LEFT',
                        'conditions'=>'SubOption.id = OptionSuboption.suboption_id'
                    )       
                );

                $this->ModifierOption->unbindModel(array('belongsTo'=>array('Modifier')));
                $mdOpts = $this->ModifierOption->find('all',array('fields'=>$fields,'conditions'=>$conditions,'joins'=>$joins));

                $options = array();
                $subOpt = '';
                foreach ($mdOpts as $key => $value) {
                    $key = $value['Option']['id'];
                    if(array_key_exists($key, $options)){
                        $subOpt = $value['SubOption']['name'].', '.$subOpt;
                    }else{
                        $subOpt = $value['SubOption']['name'];
                    }
                
                    if(isset($subOpt)){
                        $options[$value['Option']['id']] = $value['Option']['name'].' ('.$subOpt.')';
                    }else{
                        $options[$value['Option']['id']] = $value['Option']['name']; 
                    }
                }

                return json_encode($options);
            }else{
                $this->Option->recursive = 2;
                $optionsArr = $this->Option->find('all',array('conditions'=>array('Option.status'=>1)));
                foreach ($optionsArr as $key => $value) {
                    $subOpt = array();
                    foreach ($value['OptionSuboption'] as $k => $v) {
                        $subOpt[] = $v['SubOption']['name'];
                    }
                    $subOpt = implode(', ', $subOpt);
                    if(!empty($subOpt)){
                        $options[$value['Option']['id']] = $value['Option']['name'].' ('.$subOpt.')';
                    }else{
                        $options[$value['Option']['id']] = $value['Option']['name']; 
                    }
                }
                return json_encode($options);
            }
        }
    }

    function get_modifiers(){
        $this->layout = FALSE;
        $this->autoRender = FALSE;
        if($this->request->is('post')){
            $this->Modifier->recursive = 2;
            $optionsArr = $this->Modifier->find('all',array('conditions'=>array('Modifier.status'=>1)));
            foreach ($optionsArr as $key => $value) {
                $subOpt = array();
                foreach ($value['ModifierOption'] as $k => $v) {
                    $subOpt[] = $v['Option']['name'];
                }
                $subOpt = implode(', ', $subOpt);
                if(!empty($subOpt)){
                    $options[$value['Modifier']['id']] = $value['Modifier']['title'].' ('.$subOpt.')';
                }else{
                    $options[$value['Modifier']['id']] = $value['Modifier']['title']; 
                }
            }
            return json_encode($options);
        }
    }

    function get_included_modifiers(){
        $this->layout = FALSE;
        if($this->request->is('post')){
            $fields = array('ModifierOption.id','Modifier.title','Option.name');
            $this->ModifierOption->recursive =3;
            $ModifierOptions = $this->ModifierOption->find('all',array('fields'=>'*'));
           
            $selOptions = array();
            foreach ($ModifierOptions as $key => $value) {
                $keys = array_keys($selOptions);
                if(in_array($value['Modifier']['title'], $keys)){
                    $subOpt = array();
                    foreach ($value['Option']['OptionSuboption'] as $k => $v) {
                        $subOpt[] = $v['SubOption']['name'];
                    }
                    $subOpt = implode(', ', $subOpt);
                    if(!empty($subOpt)){
                        $selOptions[$value['Modifier']['title']][$value['ModifierOption']['id']] = $value['Option']['name'].' ('.$subOpt.')';
                    }else{
                        $selOptions[$value['Modifier']['title']][$value['ModifierOption']['id']] = $value['Option']['name']; 
                    }
                }else{
                    $subOpt = array();
                    foreach ($value['Option']['OptionSuboption'] as $k => $v) {
                        $subOpt[] = $v['SubOption']['name'];
                    }
                    $subOpt = implode(', ', $subOpt);
                    if(!empty($subOpt)){
                        $selOptions[$value['Modifier']['title']][$value['ModifierOption']['id']] = $value['Option']['name'].' ('.$subOpt.')';   
                    }else{
                        $selOptions[$value['Modifier']['title']][$value['ModifierOption']['id']] = $value['Option']['name'];  
                    }
                }
            }
        }
        $this->set('selOptions',$selOptions);
    }

    function get_addtional_info(){
        $this->layout = FALSE;
        if($this->request->is('post')){
            if(!empty($this->request->data['modifier_id'])){
                $modifierIds = $this->request->data['modifier_id'];
                $productId = $this->request->data['product_id']; 
            }else{
                $productId = $this->request->data['product_id']; 
            }

            $productModifiers = $this->ProductModifier->find(
                'all',array(
                    'fields'=>array('*'),
                    'conditions'=>array(
                        'ProductModifier.product_id'=>$productId
                    ),
                    'order'=>'ProductModifier.id ASC'
                )
            );

            $alreadyData['Product']['added'] = array(); 
            foreach ($productModifiers as $key => $value) {
                $productModifierIds[] = $value['ProductModifier']['modifier_id'];

                $alreadyData['Product']['added'][$value['ProductModifier']['modifier_id']]['default_option_id'] = $value['ProductModifier']['default_option_id'];
                $alreadyData['Product']['added'][$value['ProductModifier']['modifier_id']]['is_required'] = $value['ProductModifier']['is_required'];
                $alreadyData['Product']['added'][$value['ProductModifier']['modifier_id']]['choice'] = $value['ProductModifier']['choice'];
                $alreadyData['Product']['added'][$value['ProductModifier']['modifier_id']]['min_choice'] = $value['ProductModifier']['min_choice'];
                $alreadyData['Product']['added'][$value['ProductModifier']['modifier_id']]['max_choice'] = $value['ProductModifier']['max_choice'];
                 $alreadyData['Product']['added'][$value['ProductModifier']['modifier_id']]['free'] = $value['ProductModifier']['free'];
                $alreadyData['Product']['added'][$value['ProductModifier']['modifier_id']]['display_price'] = $value['ProductModifier']['display_price'];
                $alreadyData['Product']['added'][$value['ProductModifier']['modifier_id']]['sort_order'] = $value['ProductModifier']['sort_order'];
            }
            
            $modifierIds = (!empty($modifierIds))?$modifierIds:array_values($productModifierIds);
            $this->request->data = $alreadyData; 


            foreach ($modifierIds as $key => $modifierId) {
                $this->Modifier->recursive = 0;
                $modifierInfo = $this->Core->getRecord('Modifier',array('Modifier.title','Modifier.id'),array('Modifier.id'=>$modifierId));
                $pageVar[$modifierId]['modifierInfo'] = $modifierInfo;

                $optionIds = $this->Core->getList('ModifierOption',array('id','option_id'),array('ModifierOption.modifier_id'=>$modifierId));
                $optionList = $this->Core->getList('Option',array('id','name'),array('Option.id'=>array_values($optionIds),'Option.status'=>1));
                $pageVar[$modifierId]['optionList'] = $optionList;
                
            }
        }
        $this->set('pageVar',$pageVar);
    }

    function get_sub_options(){
        $this->layout = FALSE;
        $this->autoRender = FALSE;
        if($this->request->is('post')){
            $suboptions = $this->Core->getList('SubOption',array('id','name'),array('SubOption.lang_id'=>CakeSession::read('language.id'),'SubOption.status'=>1));
            echo json_encode($suboptions);

        }
    }
    
    function admin_sub_options(){
        $pageVar['title'] = 'Modifier Choices';
        $pageVar['sub_title'] = 'List modifier choices';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Modifier Choices</li>';

        $conditions = array('SubOption.store_id'=>$this->Auth->user('user_id'));
        $limit = 10;
        $this->paginate = $this->SubOption->getSubOptions(TRUE,$conditions,$limit);

        $SubOptions= $this->paginate('SubOption');
        $this->set(compact('SubOptions','pageVar'));
    }

    function company_sub_options(){
        $pageVar['title'] = 'Modifier Choices';
        $pageVar['sub_title'] = 'List modifier choices';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Modifier Choices</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $conditions = array();
        /* Apply filter */
        $store_id = $this->request->query('store_id');
        $name = $this->request->query('name');

        if(!empty($store_id)){
            $conditions = array('SubOption.store_id'=>$store_id);
            $this->request->data['Search']['store_id'] = $store_id;
        }

        if(!empty($name)){
            $conditions = array('SubOption.name LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['name'] = $name;
        }

        if(!empty($store_id) && !empty($name)){
            $conditions = array('SubOption.store_id'=>$store_id,'SubOption.name LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['store_id'] = $store_id;
            $this->request->data['Search']['name'] = $name;
        }
        /* End filters */   
    
        $limit = 10;
        $this->paginate = $this->SubOption->getSubOptions(TRUE,$conditions,$limit);
        $SubOptions= $this->paginate('SubOption');
        $this->set(compact('SubOptions','pageVar'));
    }

    function admin_add_sub_option(){
        $pageVar['title'] = 'Add Modifier Choice';
        $pageVar['sub_title'] = 'add new modifier choice';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Modifier Choice</li>';

         if ($this->request->is('post')) {
            $this->request->data['SubOption']['store_id'] = $this->Auth->user('user_id');
            $this->SubOption->create();  
            if ($this->SubOption->save($this->request->data)) {
                $this->Session->setFlash(__('The modifier choice has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'sub_options'));
            } else {
                $this->Session->setFlash(__('The modifier choice could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set(compact('pageVar'));
   }

    function company_add_sub_option(){
        $pageVar['title'] = 'Add Modifier Choice';
        $pageVar['sub_title'] = 'add new modifier choice';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Modifier Choice</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

         if ($this->request->is('post')) {
            $storeIds = $this->request->data['SubOption']['store_id'];
            $name = $this->request->data['SubOption']['name'];
            $shortDesc = $this->request->data['SubOption']['short_description'];
            $sortOrder = $this->request->data['SubOption']['sort_order'];
            $status = $this->request->data['SubOption']['status'];

            $storeCat = array();
            foreach ($storeIds as $key => $storeId) {
                $storeCat[] = array(
                    'store_id'=>$storeId,
                    'name'=>$name,
                    'short_description'=>$shortDesc,
                    'sort_order'=>$sortOrder,
                    'status'=>$status
                );
            }
            if ($this->SubOption->saveAll($storeCat)) {
                $this->Session->setFlash(__('The modifier choice has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'sub_options'));
            } else {
                $this->Session->setFlash(__('The modifier choice could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set(compact('pageVar'));
   }

   function admin_edit_sub_option($id=null){
        $pageVar['title'] = 'Edit Modifier Choice';
        $pageVar['sub_title'] = 'Edit modifier choice details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit modifier choice</li>';
        
        $this->SubOption->id = $id;
        $data = $this->SubOption->read(null,$id);
        if (!$this->SubOption->exists()) {
            throw new NotFoundException(__('Invalid Modifier Choice'));
        }

         if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['SubOption']['store_id'] = $this->Auth->user('user_id');
            if ($this->SubOption->save($this->request->data)) {
                $this->Session->setFlash(__('The modifier choice has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'sub_options'));
            } else {
                $this->Session->setFlash(__('The modifier choice could not be updated. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }else{
          $this->request->data = $data;
        }
	
        $this->set('pageVar',$pageVar);
        $this->render('admin_add_sub_option');

   }
	
   function company_edit_sub_option($id=null){
        $pageVar['title'] = 'Edit Modifier Choice';
        $pageVar['sub_title'] = 'Edit modifier choice details';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit modifier choice</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $this->SubOption->id = $id;
        $conditions = array('SubOption.id'=>$id);
        $limit = 10;
        $SubOptionDetails = $this->SubOption->getSubOptions(false,$conditions,$limit);
        $data = $SubOptionDetails[0];

        if (!$this->SubOption->exists()) {
            throw new NotFoundException(__('Invalid Modifier Choice'));
        }

         if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['SubOption']['store_id']= $this->request->data['SubOption']['store_id'][0];
            if ($this->SubOption->updateSubOption($this->request->data)) {
                $this->Session->setFlash(__('The modifier choice has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'sub_options'));
            } else {
                $this->Session->setFlash(__('The modifier choice could not be updated. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }else{
          $this->request->data = $data;
        }
    
        $this->set('pageVar',$pageVar);
        $this->render('company_add_sub_option');

   }
}