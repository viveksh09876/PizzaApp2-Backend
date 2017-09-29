<?php
App::uses('AppController', 'Controller');
class DealsController extends AppController {
    public $components=array('Core','Email');
    public $uses = array('EmailTemplate','Deal','ProductModifier','DealItem');
    public $helders = array('Ajax');

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }

    public function admin_index() {
        $pageVar['title'] = 'Coupons';
        $pageVar['sub_title'] = 'List of coupons';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Coupons</li>';

        $conditions = array(
            'Coupon.store_id'=>$this->Auth->user('user_id')
        );

        /* Apply filter */
        $coupon_name = $this->request->query('coupon_name');
        $coupon_code = $this->request->query('coupon_code');

        if(!empty($coupon_name)){
            $conditions = array('Coupon.coupon_name LIKE'=>'%'.$coupon_name.'%');
            $this->request->data['Search']['coupon_name'] = $coupon_name;
        }

        if(!empty($coupon_code)){
            $conditions = array('Coupon.coupon_code LIKE'=>'%'.$coupon_code.'%');
            $this->request->data['Search']['coupon_code'] = $coupon_code;
        }

        if(!empty($coupon_name) && !empty($coupon_code)){
            $conditions = array('Coupon.coupon_name LIKE'=>'%'.$coupon_name.'%','Coupon.coupon_code LIKE'=>'%'.$coupon_code.'%');
            $this->request->data['Search']['coupon_name'] = $coupon_name;
            $this->request->data['Search']['coupon_code'] = $coupon_code;
        }
        /* End filters */

        $limit = 10;
        $qOptions = $this->Coupon->getCoupons(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $Coupons = $this->paginate('Coupon');
        $this->set(compact('Coupons','pageVar'));
    }

    public function admin_add() {
        $pageVar['title'] = 'Add Deal';
        $pageVar['sub_title'] = 'Add new deal';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Deal</li>';
        $pageVar['sizes'] = array('999991'=>'Small','999992'=>'Medium','999993'=>'Large');
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));

        if ($this->request->is('post')) {
            $this->request->data['Deal']['store_id'] = $this->Auth->user('user_id');
            if ($this->Deal->addDeal($this->request->data)) {
                echo $this->Deal->getLastInsertId();
                die;
            } else {
                echo 0; die;
            }
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }

    public function admin_add_item(){
        $this->loyout = $this->autoRender = false;
        $dataArr = array();
        if(isset($this->request->data)){
            $data = $this->request->data;
            $dataArr['DealItem']['deal_id'] = $data['DealItem']['deal_id'];
            $dataArr['DealItem']['cat_id'] = $data['DealItem']['category'];
            $dataArr['DealItem']['size'] = $data['DealItem']['size'];
            $dataArr['DealItem']['product_plu'] = $data['DealItem']['product'];
            $dataArr['DealItem']['modifier_plu'] = $data['DealItem']['modifier'];
            $dataArr['DealItem']['quantity'] = $data['DealItem']['quantity'];

            if($this->DealItem->save($dataArr)){
                echo json_encode(array('success'=>1,'deal_id'=>$data['DealItem']['deal_id']));
            }else{
                echo json_encode(array('success'=>0));
            }

        }
    }

    public function getProductList($catId){
        $this->loyout = false;
        $this->autoRender = false;
        $products = $this->Core->getList('Product',array('plu_code','title','id'),array('status'=>1,'category_id'=>$catId));
        return json_encode($products);
    }

    public function getDealItemList($dealId){
        $this->loyout = false;
        $this->autoRender = false;
        // $joins = array(
        //     array(
        //         'table'=>'modifier_options',
        //         'alias'=>'ModifierOption',
        //         'type'=>'INNER',
        //         'conditions'=>'ModifierOption.modifier_id = ProductModifier.modifier_id'
        //     ),
        //     array(
        //         'table'=>'options',
        //         'alias'=>'Option',
        //         'type'=>'INNER',
        //         'conditions'=>'Option.id = ModifierOption.option_id'
        //     )       
        // );

        $joins = array(
            array(
                'table'=>'products',
                'alias'=>'Product',
                'type'=>'LEFT',
                'conditions'=>'Product.plu_code = DealItem.product_plu'
            )  
        );

        $data = $this->DealItem->find('all',array('fields'=>array('*'),'conditions'=>array('DealItem.deal_id'=>$dealId),'joins'=>$joins));
        return json_encode($data);
    }

    public function admin_make_group(){
        $this->loyout = false;
        $this->autoRender = false;

        if(!empty($this->request->data)){
            $data = $this->request->data();
            $dataArr['DealGroup']['deal_id'] = 1;
            $dataArr['DealGroup']['item1'] = $data[0];
            $dataArr['DealGroup']['item2'] = $data[1];
            $dataArr['DealGroup']['cond'] = $data['condition'];
            $this->DealGroup->save();
        }
        pr($this->request->data);
    }

    public function getModifierList($productId){
        $this->loyout = false;
        $this->autoRender = false;
        $joins = array(
            array(
                'table'=>'modifier_options',
                'alias'=>'ModifierOption',
                'type'=>'INNER',
                'conditions'=>'ModifierOption.modifier_id = ProductModifier.modifier_id'
            ),
            array(
                'table'=>'options',
                'alias'=>'Option',
                'type'=>'INNER',
                'conditions'=>'Option.id = ModifierOption.option_id'
            )       
        );

        $modifierOpts = $this->Core->getList('ProductModifier',array('Option.plu_code','Option.name'),array('ProductModifier.product_id'=>$productId),$joins);
        return json_encode($modifierOpts);
    }

    public function admin_edit($id = null) {
        $pageVar['title'] = 'Edit Coupon';
        $pageVar['sub_title'] = 'Edit coupon details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Coupon</li>';

        $this->Coupon->id = $id;
        $conditions = array('Coupon.id'=>$id);
        $limit = 10;
        $CouponDetails = $this->Coupon->getCoupons(false,$conditions,$limit);
        $data = $CouponDetails[0];
        
        if (!$this->Coupon->exists()) {
            throw new NotFoundException(__('Invalid Coupon'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Coupon']['store_id'] = $this->Auth->user('user_id');

            if ($this->Coupon->updateCoupon($this->request->data)) {
                $this->Session->setFlash(__('The coupon has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The coupon could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }

    public function company_index() {
        $pageVar['title'] = 'Coupons';
        $pageVar['sub_title'] = 'List of coupons';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Coupons</li>';
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);
      
        $conditions = array();

        /* Apply filter */
        $store_id = $this->request->query('store_id');
        $coupon_code = $this->request->query('coupon_code');

        if(!empty($store_id)){
            $conditions = array('Coupon.store_id'=>$store_id);
            $this->request->data['Search']['store_id'] = $store_id;
        }

        if(!empty($coupon_code)){
            $conditions = array('Coupon.coupon_code LIKE'=>'%'.$coupon_code.'%');
            $this->request->data['Search']['coupon_code'] = $coupon_code;
        }

        if(!empty($store_id) && !empty($coupon_code)){
            $conditions = array('Coupon.store_id'=>$store_id,'Coupon.coupon_code LIKE'=>'%'.$coupon_code.'%');
            $this->request->data['Search']['store_id'] = $store_id;
            $this->request->data['Search']['coupon_code'] = $coupon_code;
        }
        /* End filters */

        $limit = 10;
        $qOptions = $this->Coupon->getCoupons(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $Coupons = $this->paginate('Coupon');
        $this->set(compact('Coupons','pageVar'));
    }

    public function company_add(){
        $pageVar['title'] = 'Add Coupon';
        $pageVar['sub_title'] = 'Add new coupon';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Coupon</li>';

        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        if ($this->request->is('post') || $this->request->is('put')) { 
            $storeIds = $this->request->data['Coupon']['store_id'];
            $coupon_name = $this->request->data['Coupon']['coupon_name'];
            $coupon_code = $this->request->data['Coupon']['coupon_code'];
            $application = $this->request->data['Coupon']['application'];
            $description = $this->request->data['Coupon']['description'];
            $status = $this->request->data['Coupon']['status'];

            $storeCat = array();
            foreach ($storeIds as $key => $storeId) {
                $storeCat[] = array(
                    'store_id'=>$storeId,
                    'coupon_name'=>$coupon_name,
                    'coupon_code'=>$coupon_code,
                    'application'=>$application,
                    'description'=>$description,
                    'status'=>$status
                );
            }
            
            if ($this->Coupon->saveAll($storeCat)) {
                
                 /*-template asssignment if any*/
                $template = $this->EmailTemplate->find('first',array(
                        'conditions' => array(
                            'template_key'=> 'coupon_notification',
                            'template_status' =>'Active'
                        )
                    )
                );
                
                if($template){  
                    $arrFind=array('{coupon_name}','{coupon_code}','{application}','{description}');
                    $arrReplace=array($coupon_name,$coupon_code,$application,$description);
                    
                    $from=$template['EmailTemplate']['from_email'];
                    $subject=$template['EmailTemplate']['email_subject'];
                    $content=str_replace($arrFind, $arrReplace,$template['EmailTemplate']['email_body']);
                }

                $this->set('Content',$content);   

                try{
                    $this->Email->from=$from;
                    $this->Email->to=SUPPORT_EMAIL;
                    $this->Email->subject=$subject;
                    $this->Email->sendAs='html';
                    $this->Email->template='general';
                    $this->Email->delivery = 'smtp';
                    $this->Email->send();
                }catch(Exception $e){
                    echo 'Sorry email not sent.';
                }

                /*-[end]template asssignment*/ 
                $this->Session->setFlash(__('The coupon has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The coupon could not be added. Please, try again.'),'default',array('class'=>'error'));
            }
        } 

        $this->set('pageVar',$pageVar);
    }

    public function company_edit($id = null){
        $pageVar['title'] = 'Edit Coupon';
        $pageVar['sub_title'] = 'Edit coupon details';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Coupon</li>';
        
        $pageVar['stores'] = $this->Core->getUserStoreList('UserStore',array('UserStore.user_id','Store.store_name'),array(),2);

        $this->Coupon->id = $id;
        
        $conditions = array('Coupon.id'=>$id);
        $limit = 10;
        $CouponDetails = $this->Coupon->getCoupons(false,$conditions,$limit);
        $data = $CouponDetails[0];

        if (!$this->Coupon->exists()) {
            throw new NotFoundException(__('Invalid Coupon'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Coupon']['store_id']= $this->request->data['Coupon']['store_id'][0];
            if ($this->Coupon->updateCoupon($this->request->data)) {
                $this->Session->setFlash(__('The coupon has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The coupon could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('company_add');
    }
}
