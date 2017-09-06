<?php
App::uses('AppController', 'Controller');

class ProductController extends AppController{
	public $components = array('Core');
    public $uses = array('Product','ProductIncludedModifier','ProductModifier','Category');

	public function beforeFilter(){
		Configure::write('debug', 2);
		parent::beforeFilter();
		$this->Auth->allow(array());
	}

	public function admin_index(){
		$pageVar['title'] = 'Items';
		$pageVar['sub_title'] = 'List Items';
		$pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Items</li>';
        $pageVar['categories'] = $this->Core->getList('Category',array('Category.id','Category.name'),array());

        $conditions = array('Product.store_id'=>$this->Auth->user('user_id'));

        /* Apply filter */
        $categoryId = $this->request->query('category_id');
        $name = $this->request->query('name');

        if(!empty($categoryId)){
            $conditions = array('Product.category_id'=>$categoryId);
            $this->request->data['Search']['category_id'] = $categoryId;
        }

        if(!empty($name)){
            $conditions = array('Product.title LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['name'] = $name;
        }

        if(!empty($categoryId) && !empty($name)){
            $conditions = array('Product.category_id'=>$categoryId,'Product.title LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['category_id'] = $categoryId;
            $this->request->data['Search']['name'] = $name;
        }
        /* End filters */

        $limit = 10;
        $qOptions = $this->Product->getProducts(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $Products = $this->paginate('Product');
        $this->set(compact('Products','pageVar'));
	}

    public function company_index(){
        $pageVar['title'] = 'Items';
        $pageVar['sub_title'] = 'List Items';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Items</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $conditions = array();

        /* Apply filter */
        $store_id = $this->request->query('store_id');
        $name = $this->request->query('name');

        if(!empty($store_id)){
            $conditions = array('Product.store_id'=>$store_id);
            $this->request->data['Search']['store_id'] = $store_id;
        }

        if(!empty($name)){
            $conditions = array('Product.title LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['name'] = $name;
        }

        if(!empty($store_id) && !empty($name)){
            $conditions = array('Product.store_id'=>$store_id,'Product.title LIKE'=>'%'.$name.'%');
            $this->request->data['Search']['store_id'] = $store_id;
            $this->request->data['Search']['name'] = $name;
        }
        /* End filters */

        $limit = 10;
        $qOptions = $this->Product->getProducts(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $Products = $this->paginate('Product');
        $this->set(compact('Products','pageVar'));
    }

	public function admin_add(){
		$pageVar['title'] = 'Add Item';
		$pageVar['sub_title'] = 'Add new item';
		$pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Item</li>';
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));
		if ($this->request->is('post')) {
            $this->request->data['Product']['store_id'] = $this->Auth->user('user_id');
            $included = (!empty($this->request->data['Product']['included']))?$this->request->data['Product']['included']:array();
            $added = (!empty($this->request->data['Product']['added']))?$this->request->data['Product']['added']:array();
            $this->Product->create();	
            if(!empty($this->request->data['Product']['image']) && !empty($this->request->data['Product']['image']['name'])){
                $file = explode('.',$this->request->data['Product']['image']['name']);
                $file[0] = strtolower($file[0]).time();
                $file = implode('.',$file);
                $newPath = 'img/admin/products/'.$file; 
                move_uploaded_file($this->request->data['Product']['image']['tmp_name'], $newPath);
                $this->request->data['Product']['image'] = $newPath;     
            }else{
                unset($this->request->data['Product']['image']);
            }

            if(!empty($this->request->data['Product']['thumb_image']) && !empty($this->request->data['Product']['thumb_image']['name'])){
                $file = explode('.',$this->request->data['Product']['thumb_image']['name']);
                $file[0] = strtolower($file[0]).time();
                $file = implode('.',$file);
                $newPath = 'img/admin/products/'.$file; 
                move_uploaded_file($this->request->data['Product']['thumb_image']['tmp_name'], $newPath);
                $this->request->data['Product']['thumb_image'] = $newPath;    
            }else{
                unset($this->request->data['Product']['thumb_image']);
            }	

            if ($this->Product->save($this->request->data)) {
                $productId = $this->Product->getLastInsertId(); 

                if(!empty($included)){
                    $includedData = array();
                    foreach ($included as $key => $includedVal) {
                        $includedData[$key] = array(
                            'product_id'=>$productId,
                            'modifier_option_id'=>$includedVal
                        );
                    }
                    $this->ProductIncludedModifier->saveAll($includedData); 
                }
                
                if(!empty($added)){
                    $addedData = array();
                    foreach ($added as $key => $addedVal) {
                        $addedData[] = array(
                            'product_id'=>$productId,
                            'modifier_id'=>$key,
                            'default_option_id'=>$addedVal['default_option_id'][0],
                            'is_required'=>$addedVal['is_required'][0],
                            'choice'=>$addedVal['choice'][0],
                            'min_choice'=>$addedVal['min_choice'][0],
                            'max_choice'=>$addedVal['max_choice'][0],
                            'free'=>(!empty($addedVal['free'][0]))?$addedVal['free'][0]:0,
                            'display_price'=>$addedVal['display_price'][0],
                            'sort_order'=>$addedVal['sort_order'][0]
                        );
                    }
                    $this->ProductModifier->saveAll($addedData);
                }

                $this->Session->setFlash(__('The item has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The item could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }

		$this->set('pageVar',$pageVar);
	}

    public function company_add(){
        $pageVar['title'] = 'Add Item';
        $pageVar['sub_title'] = 'Add new item';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Item</li>';
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        if ($this->request->is('post')) {
            $included = (!empty($this->request->data['Product']['included']))?$this->request->data['Product']['included']:array();
            $added = (!empty($this->request->data['Product']['added']))?$this->request->data['Product']['added']:array();
            if(!empty($this->request->data['Product']['image']) && !empty($this->request->data['Product']['image']['name'])){
                $file = explode('.',$this->request->data['Product']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/products/'.$file; 
                move_uploaded_file($this->request->data['Product']['image']['tmp_name'], $newPath);
                $image = $newPath;     
            }else{
                $image = '';
                unset($this->request->data['Product']['image']);
            }

            if(!empty($this->request->data['Product']['thumb_image']) && !empty($this->request->data['Product']['thumb_image']['name'])){
                $file = explode('.',$this->request->data['Product']['thumb_image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/products/'.$file; 
                move_uploaded_file($this->request->data['Product']['thumb_image']['tmp_name'], $newPath);
                $thumb_image = $newPath;    
            }else{
                $thumb_image = '';
                unset($this->request->data['Product']['thumb_image']);
            }   

            $storeIds = $this->request->data['Product']['store_id'];
            $category_id = $this->request->data['Product']['category_id'];
            $sub_category_id = $this->request->data['Product']['sub_category_id'];
            $plu_code = $this->request->data['Product']['plu_code'];
            $title = $this->request->data['Product']['title'];
            $price_title = $this->request->data['Product']['price_title'];
            $slug = $this->request->data['Product']['slug'];
            $sort_order = $this->request->data['Product']['sort_order'];
            $special_instruction = $this->request->data['Product']['special_instruction'];
            $short_description = $this->request->data['Product']['short_description'];
            $status = $this->request->data['Product']['status'];

            $productData = array();
            foreach ($storeIds as $key => $storeId) {
                $productData['Product'] = array(
                    'store_id'=>$storeId,
                    'category_id'=>$category_id,
                    'sub_category_id'=>$sub_category_id,
                    'plu_code'=>$plu_code,
                    'title'=>$title,
                    'price_title'=>$price_title,
                    'slug'=>$slug,
                    'image'=>$image,
                    'thumb_image'=>$thumb_image,
                    'sort_order'=>$sort_order,
                    'special_instruction'=>$special_instruction,
                    'short_description'=>$short_description,
                    'status'=>$status
                );

                $this->Product->create();
                if ($this->Product->save($productData)) {
                    $productId = $this->Product->getLastInsertId(); 

                    if(!empty($included)){
                        $includedData = array();
                        foreach ($included as $key => $includedVal) {
                            $includedData[$key] = array(
                                'product_id'=>$productId,
                                'modifier_option_id'=>$includedVal
                            );
                        }
                        $this->ProductIncludedModifier->saveAll($includedData); 
                    }
                    
                    if(!empty($added)){
                        $addedData = array();
                        foreach ($added as $key => $addedVal) {
                            $addedData[] = array(
                                'product_id'=>$productId,
                                'modifier_id'=>$key,
                                'default_option_id'=>$addedVal['default_option_id'][0],
                                'is_required'=>$addedVal['is_required'][0],
                                'choice'=>$addedVal['choice'][0],
                                'min_choice'=>$addedVal['min_choice'][0],
                                'max_choice'=>$addedVal['max_choice'][0],
                                'free'=>(!empty($addedVal['free'][0]))?$addedVal['free'][0]:0,
                                'display_price'=>$addedVal['display_price'][0],
                                'sort_order'=>$addedVal['sort_order'][0]
                            );
                        }
                        $this->ProductModifier->saveAll($addedData);
                    }
                } 
            }

            $this->Session->setFlash(__('The item has been added'),'default',array('class'=>'alert alert-success'));
            $this->redirect(array('action' => 'index'));
        }

        $this->set('pageVar',$pageVar);
    }

	public function admin_edit($id = null){
		$pageVar['title'] = 'Edit Item';
        $pageVar['sub_title'] = 'Edit item details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Item</li>';
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));
        $this->Product->id = $id;
        $this->Product->bindModel(array('hasMany'=>array('ProductIncludedModifier','ProductModifier')));
        $data = $this->Product->read(null,$id);
        foreach ($data['ProductIncludedModifier'] as $key => $value) {
            $data['Product']['ProductIncludedModifier'][] = $value['modifier_option_id']; 
        }

        foreach ($data['ProductModifier'] as $key => $value) {
            $data['Product']['ProductModifier'][] = $value['modifier_id']; 
        }

        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid Item'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Product']['store_id'] = $this->Auth->user('user_id');
            $included = (!empty($this->request->data['Product']['included']))?$this->request->data['Product']['included']:array();
            $added = (!empty($this->request->data['Product']['added']))?$this->request->data['Product']['added']:array();
            if(!empty($this->request->data['Product']['image']) && !empty($this->request->data['Product']['image']['name'])){
                $file = explode('.',$this->request->data['Product']['image']['name']);
                $file[0] = strtolower($file[0]).time();
                $file = implode('.',$file);
                $newPath = 'img/admin/products/'.$file;
                $prevpath = 'img/admin/products/'.$data['Product']['image'];
                if(file_exists($prevpath)){
                    unlink($prevpath); 
                }
                move_uploaded_file($this->request->data['Product']['image']['tmp_name'], $newPath);
                $this->request->data['Product']['image'] = $newPath; 
            }else{
                unset($this->request->data['Product']['image']);
            }

            if(!empty($this->request->data['Product']['thumb_image']) && !empty($this->request->data['Product']['thumb_image']['name'])){
                $file = explode('.',$this->request->data['Product']['thumb_image']['name']);
                $file[0] = strtolower($file[0]).time();
                $file = implode('.',$file);
                $newPath = 'img/admin/products/'.$file; 
                move_uploaded_file($this->request->data['Product']['thumb_image']['tmp_name'], $newPath);
                $this->request->data['Product']['thumb_image'] = $newPath;    
            }else{
                unset($this->request->data['Product']['thumb_image']);
            }
            
            if ($this->Product->save($this->request->data)) {
                $productId = $this->Product->id; 
                if(!empty($included)){
                    $includedData = array();
                    foreach ($included as $key => $includedVal) {
                        $includedData[$key] = array(
                            'product_id'=>$productId,
                            'modifier_option_id'=>$includedVal
                        );
                    }
                }
                $this->ProductIncludedModifier->deleteAll(array('ProductIncludedModifier.product_id'=>$productId));
                if(!empty($includedData)){
                    $this->ProductIncludedModifier->saveAll($includedData); 
                }
                
                if(!empty($added)){
                    $addedData = array();
                    foreach ($added as $key => $addedVal) {
                        $addedData[] = array(
                            'product_id'=>$productId,
                            'modifier_id'=>$key,
                            'default_option_id'=>$addedVal['default_option_id'][0],
                            'is_required'=>$addedVal['is_required'][0],
                            'choice'=>$addedVal['choice'][0],
                            'min_choice'=>$addedVal['min_choice'][0],
                            'max_choice'=>$addedVal['max_choice'][0],
                            'free'=>(!empty($addedVal['free'][0]))?$addedVal['free'][0]:0,
                            'display_price'=>$addedVal['display_price'][0],
                            'sort_order'=>$addedVal['sort_order'][0]
                        );
                    }
                }
                $this->ProductModifier->deleteAll(array('ProductModifier.product_id'=>$productId));
                if(!empty($addedData)){
                    $this->ProductModifier->saveAll($addedData);
                }

                $this->Session->setFlash(__('The Item has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Item could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
	}	

    public function company_edit($id = null){
        $pageVar['title'] = 'Edit Item';
        $pageVar['sub_title'] = 'Edit item details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Item</li>';
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $this->Product->id = $id;
        $this->Product->bindModel(array('hasMany'=>array('ProductIncludedModifier','ProductModifier')));
        $data = $this->Product->read(null,$id);
        foreach ($data['ProductIncludedModifier'] as $key => $value) {
            $data['Product']['ProductIncludedModifier'][] = $value['modifier_option_id']; 
        }

        foreach ($data['ProductModifier'] as $key => $value) {
            $data['Product']['ProductModifier'][] = $value['modifier_id']; 
        }

        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid Item'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Product']['store_id']= $this->request->data['Product']['store_id'][0];
            $included = (!empty($this->request->data['Product']['included']))?$this->request->data['Product']['included']:array();
            $added = (!empty($this->request->data['Product']['added']))?$this->request->data['Product']['added']:array();
            if(!empty($this->request->data['Product']['image']) && !empty($this->request->data['Product']['image']['name'])){
                $file = explode('.',$this->request->data['Product']['image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/products/'.$file;
                $prevpath = 'img/admin/products/'.$data['Product']['image'];
                if(file_exists($prevpath)){
                    unlink($prevpath); 
                }
                move_uploaded_file($this->request->data['Product']['image']['tmp_name'], $newPath);
                $this->request->data['Product']['image'] = $newPath; 
            }else{
                unset($this->request->data['Product']['image']);
            }

            if(!empty($this->request->data['Product']['thumb_image']) && !empty($this->request->data['Product']['thumb_image']['name'])){
                $file = explode('.',$this->request->data['Product']['thumb_image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/products/'.$file; 
                move_uploaded_file($this->request->data['Product']['thumb_image']['tmp_name'], $newPath);
                $this->request->data['Product']['thumb_image'] = $newPath;    
            }else{
                unset($this->request->data['Product']['thumb_image']);
            }

            if ($this->Product->save($this->request->data)) {
                $productId = $this->Product->id; 
                if(!empty($included)){
                    $includedData = array();
                    foreach ($included as $key => $includedVal) {
                        $includedData[$key] = array(
                            'product_id'=>$productId,
                            'modifier_option_id'=>$includedVal
                        );
                    }
                }
                $this->ProductIncludedModifier->deleteAll(array('ProductIncludedModifier.product_id'=>$productId));
                if(!empty($includedData)){
                    $this->ProductIncludedModifier->saveAll($includedData); 
                }
                
                if(!empty($added)){
                    $addedData = array();
                    foreach ($added as $key => $addedVal) {
                        $addedData[] = array(
                            'product_id'=>$productId,
                            'modifier_id'=>$key,
                            'default_option_id'=>$addedVal['default_option_id'][0],
                            'is_required'=>$addedVal['is_required'][0],
                            'choice'=>$addedVal['choice'][0],
                            'min_choice'=>$addedVal['min_choice'][0],
                            'max_choice'=>$addedVal['max_choice'][0],
                            'free'=>(!empty($addedVal['free'][0]))?$addedVal['free'][0]:0,
                            'display_price'=>$addedVal['display_price'][0],
                            'sort_order'=>$addedVal['sort_order'][0]
                        );
                    }
                }
                $this->ProductModifier->deleteAll(array('ProductModifier.product_id'=>$productId));
                if(!empty($addedData)){
                    $this->ProductModifier->saveAll($addedData);
                }

                $this->Session->setFlash(__('The Item has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Item could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('company_add');
    }   

    public function update_sort_order(){
        $this->layout = FALSE;
        $this->autoRender = FALSE;
        if($this->request->is('post')){    
            if(isset($this->request->data['product_id'])){ 
                $productId = $this->request->data['product_id'];
                echo $productId;

            }
        }
    }
}