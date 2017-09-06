<?php
App::uses('AppController', 'Controller');
class SubCategoryController extends AppController {
    public $components=array('Core');
    public $uses = array('SubCategory','CategorySubcategory');

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('get_sub_categories'));
    }

    public function admin_index() {
        $pageVar['title'] = 'Sub Categories';
        $pageVar['sub_title'] = 'List of sub categories';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Sub Categories</li>';
        $conditions = array(
            'SubCategory.store_id'=>$this->Auth->user('user_id')
        );
        $limit = 10;
        $qOptions = $this->SubCategory->getSubCategories(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $SubCategories = $this->paginate('SubCategory');
        $this->set(compact('SubCategories','pageVar'));
    }

    public function admin_add() {
        $pageVar['title'] = 'Add Sub Category';
        $pageVar['sub_title'] = 'Add new sub category';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Sub Category</li>';
        $pageVar['languages'] = $this->Core->getList('Language',array('id','name'),array('status'=>1));
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));
        if ($this->request->is('post')) {
            $this->request->data['SubCategory']['store_id'] = $this->Auth->user('user_id');	
            if ($this->SubCategory->addSubCategory($this->request->data)) {
                $this->Session->setFlash(__('The sub category has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sub category could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }

    public function admin_edit($id = null) {
        $pageVar['title'] = 'Edit Sub Category';
        $pageVar['sub_title'] = 'Edit sub category details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Sub Category</li>';
        $pageVar['languages'] = $this->Core->getList('Language',array('id','name'),array('status'=>1));
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));
        $this->SubCategory->id = $id;
        $conditions = array('SubCategory.id'=>$id);
        $limit = 10;
        $CategoryDetails = $this->SubCategory->getSubCategories(false,$conditions,$limit);
        $data = $CategoryDetails[0];

        if (!$this->SubCategory->exists()) {
            throw new NotFoundException(__('Invalid Sub Category'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['SubCategory']['store_id'] = $this->Auth->user('user_id');

            if ($this->SubCategory->updateSubCategory($this->request->data)) {
                $this->Session->setFlash(__('The sub category has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sub category could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }

    public function company_index() {
        $pageVar['title'] = 'Sub Categories';
        $pageVar['sub_title'] = 'List of sub categories';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Sub Categories</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);
        $conditions = array();
        /* Apply filters */
        $store_id = $this->request->query('store_id');
        $category_name = $this->request->query('category_name');

        if(!empty($store_id)){
            $conditions = array('SubCategory.store_id'=>$store_id);
            $this->request->data['Search']['store_id'] = $store_id;
        }

        if(!empty($category_name)){
            $conditions = array('SubCategory.name LIKE'=>'%'.$category_name.'%');
            $this->request->data['Search']['category_name'] = $category_name;
        }

        if(!empty($store_id) && !empty($category_name)){
            $conditions = array('SubCategory.store_id'=>$store_id,'SubCategory.name LIKE'=>'%'.$category_name.'%');
            $this->request->data['Search']['store_id'] = $store_id;
            $this->request->data['Search']['category_name'] = $category_name;
        }
        /* End Filters */

        $limit = 10;
        $qOptions = $this->SubCategory->getSubCategories(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $SubCategories = $this->paginate('SubCategory');
        $this->set(compact('SubCategories','pageVar'));
    }

    public function company_add() {
        $pageVar['title'] = 'Add Sub Category';
        $pageVar['sub_title'] = 'Add new sub category';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Sub Category</li>';
        $pageVar['languages'] = $this->Core->getList('Language',array('id','name'),array('status'=>1));
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        if ($this->request->is('post')) {
            $storeIds = $this->request->data['SubCategory']['store_id'];
            $name = $this->request->data['SubCategory']['name'];
            $shortDesc = $this->request->data['SubCategory']['short_description'];
            $sortOrder = $this->request->data['SubCategory']['sort_order'];
            $slug = $this->request->data['SubCategory']['slug'];
            $status = $this->request->data['SubCategory']['status'];
            $catId = $this->request->data['SubCategory']['cat_id'];

            $storeCat = array();
            foreach ($storeIds as $key => $storeId) {
                $storeCat[] = array(
                    'store_id'=>$storeId,
                    'cat_id'=>$catId,
                    'name'=>$name,
                    'short_description'=>$shortDesc,
                    'sort_order'=>$sortOrder,
                    'slug'=>$slug,
                    'status'=>$status
                );
            }

            if ($this->SubCategory->saveAll($storeCat)) {
                $this->Session->setFlash(__('The sub category has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sub category could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set('pageVar',$pageVar);
    }

    public function company_edit($id = null) {
        $pageVar['title'] = 'Edit Sub Category';
        $pageVar['sub_title'] = 'Edit sub category details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Sub Category</li>';
        $pageVar['languages'] = $this->Core->getList('Language',array('id','name'),array('status'=>1));
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $this->SubCategory->id = $id;
        $conditions = array('SubCategory.id'=>$id);
        $limit = 10;
        $CategoryDetails = $this->SubCategory->getSubCategories(false,$conditions,$limit);
        $data = $CategoryDetails[0];
    
        if (!$this->SubCategory->exists()) {
            throw new NotFoundException(__('Invalid Sub Category'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['SubCategory']['store_id']= $this->request->data['SubCategory']['store_id'][0];
            if ($this->SubCategory->updateSubCategory($this->request->data)) {
                $this->Session->setFlash(__('The sub category has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sub category could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('company_add');
    }

}
