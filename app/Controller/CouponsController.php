<?php
App::uses('AppController', 'Controller');
class CouponsController extends AppController {
    public $components=array('Core','Email');
    public $helper = array('General');
    public $uses = array('EmailTemplate','Coupon');

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
        $pageVar['title'] = 'Add Coupon';
        $pageVar['sub_title'] = 'Add new coupon';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Coupon</li>';

        if ($this->request->is('post')) {
            $this->request->data['Coupon']['store_id'] = $this->Auth->user('user_id');

            $coupon_name = $this->request->data['Coupon']['coupon_name'];
            $coupon_code = $this->request->data['Coupon']['coupon_code'];
            $application = $this->request->data['Coupon']['application'];
            $description = $this->request->data['Coupon']['description'];

            if ($this->Coupon->addCoupon($this->request->data)) {

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
                $this->Session->setFlash(__('The coupon could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
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
