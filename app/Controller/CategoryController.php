<?php
App::uses('AppController', 'Controller');
class CategoryController extends AppController {
    public $components=array('Core');
    public $helper = array('General');

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('get_categories','getip'));
    }

    public function admin_index() {
        $pageVar['title'] = 'Categories';
        $pageVar['sub_title'] = 'List of categories';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Categories</li>';

        $conditions = array(
            'Category.store_id'=>$this->Auth->user('user_id')
        );
        $limit = 10;
        $qOptions = $this->Category->getCategories(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $Categories = $this->paginate('Category');
        $this->set(compact('Categories','pageVar'));
    }

    public function admin_add() {
        $pageVar['title'] = 'Add Category';
        $pageVar['sub_title'] = 'Add new category';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Category</li>';
        $pageVar['languages'] = $this->Core->getList('Language',array('id','name'),array('status'=>1));
        if ($this->request->is('post')) {
            $this->request->data['Category']['store_id'] = $this->Auth->user('user_id');

            if ($this->Category->addCategory($this->request->data)) {
                $this->Session->setFlash(__('The category has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }

    public function admin_edit($id = null) {
        $pageVar['title'] = 'Edit Category';
        $pageVar['sub_title'] = 'Edit category details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Category</li>';
        $pageVar['languages'] = $this->Core->getList('Language',array('id','name'),array('status'=>1));
        $this->Category->id = $id;
        $conditions = array('Category.id'=>$id);
        $limit = 10;
        $CategoryDetails = $this->Category->getCategories(false,$conditions,$limit);
        $data = $CategoryDetails[0];
        
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid Category'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Category']['store_id'] = $this->Auth->user('user_id');

            if ($this->Category->updateCategory($this->request->data)) {
                $this->Session->setFlash(__('The category has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }

    function get_sub_categories(){
        $this->layout = FALSE;
        $this->autoRender = FALSE;
        if($this->request->is('post')){
            $subcategories = array();
            if(isset($this->request->data['category_id'])){     
                $categoryId = $this->request->data['category_id'];
                $subcategories = $this->Core->getList('SubCategory',array('id','name'),array('SubCategory.status'=>1,'SubCategory.cat_id'=>$categoryId));
                return json_encode($subcategories);
            }else{
                return json_encode($subcategories);
            }
        }
    }

    public function company_index() {
        $pageVar['title'] = 'Categories';
        $pageVar['sub_title'] = 'List of categories';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Categories</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);
      
        $conditions = array();

        /* Apply filter */
        $store_id = $this->request->query('store_id');
        $category_name = $this->request->query('category_name');

        if(!empty($store_id)){
            $conditions = array('Category.store_id'=>$store_id);
            $this->request->data['Search']['store_id'] = $store_id;
        }

        if(!empty($category_name)){
            $conditions = array('Category.name LIKE'=>'%'.$category_name.'%');
            $this->request->data['Search']['category_name'] = $category_name;
        }

        if(!empty($store_id) && !empty($category_name)){
            $conditions = array('Category.store_id'=>$store_id,'Category.name LIKE'=>'%'.$category_name.'%');
            $this->request->data['Search']['store_id'] = $store_id;
            $this->request->data['Search']['category_name'] = $category_name;
        }
        /* End filters */

        $limit = 10;
        $qOptions = $this->Category->getCategories(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $Categories = $this->paginate('Category');
        $this->set(compact('Categories','pageVar'));
    }

    public function company_add(){
        $pageVar['title'] = 'Add Category';
        $pageVar['sub_title'] = 'Add new category';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Category</li>';
        $pageVar['languages'] = $this->Core->getList('Language',array('id','name'),array('status'=>1));
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        if ($this->request->is('post') || $this->request->is('put')) { 
            $storeIds = $this->request->data['Category']['store_id'];
            $name = $this->request->data['Category']['name'];
            $shortDesc = $this->request->data['Category']['short_description'];
            $sortOrder = $this->request->data['Category']['sort_order'];
            $slug = $this->request->data['Category']['slug'];
            $status = $this->request->data['Category']['status'];

            $storeCat = array();
            foreach ($storeIds as $key => $storeId) {
                $storeCat[] = array(
                    'store_id'=>$storeId,
                    'name'=>$name,
                    'short_description'=>$shortDesc,
                    'sort_order'=>$sortOrder,
                    'slug'=>$slug,
                    'status'=>$status
                );
            }
            
            if ($this->Category->saveAll($storeCat)) {
                $this->Session->setFlash(__('The category has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be added. Please, try again.'),'default',array('class'=>'error'));
            }
        } 

        $this->set('pageVar',$pageVar);
    }

    public function company_edit($id = null){
        $pageVar['title'] = 'Edit Category';
        $pageVar['sub_title'] = 'Edit category details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Category</li>';
        $pageVar['languages'] = $this->Core->getList('Language',array('id','name'),array('status'=>1));
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $this->Category->id = $id;
        
        $conditions = array('Category.id'=>$id);
        $limit = 10;
        $CategoryDetails = $this->Category->getCategories(false,$conditions,$limit);
        $data = $CategoryDetails[0];

        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid Category'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Category']['store_id']= $this->request->data['Category']['store_id'][0];
            if ($this->Category->updateCategory($this->request->data)) {
                $this->Session->setFlash(__('The category has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('company_add');
    }
}
