<?php
App::uses('AppController', 'Controller');
class StoreController extends AppController {
    public $components = array('Core','Email');
    public $uses = array('Store','User','UserStore','EmailTemplate','StoreTime');
    function beforeFilter(){
        parent::beforeFilter();
        // $this->Auth->allow(array('get_slides'));
    }

    public function company_index() {
        $pageVar['title'] = 'Stores';
        $pageVar['sub_title'] = 'List of stores';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Stores</li>';
        $this->paginate = array(
            'limit' => 10,
        );
        $Stores = $this->paginate();
        $this->set(compact('Stores','pageVar'));
    }

    public function company_add() {
        $pageVar['title'] = 'Add Store';
        $pageVar['sub_title'] = 'Add new store';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Store</li>';
        if ($this->request->is('post')) {
            $timeSlots = $this->request->data['Store']['Timeslot'];
            $this->Store->create();	

            if(!empty($this->request->data['Store']['store_image']) && !empty($this->request->data['Store']['store_image']['name'])){
                $file = explode('.',$this->request->data['Store']['store_image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/stores/'.$file; 
                move_uploaded_file($this->request->data['Store']['store_image']['tmp_name'], $newPath);
                $this->request->data['Store']['store_image'] = $newPath;     
            }else{
                unset($this->request->data['Store']['store_image']);
            }

            if(!empty($this->request->data['Store']['store_connection_certificate']) && !empty($this->request->data['Store']['store_connection_certificate']['name'])){
                $file = explode('.',$this->request->data['Store']['store_connection_certificate']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'files/admin/stores/'.$file; 
                move_uploaded_file($this->request->data['Store']['store_connection_certificate']['tmp_name'], $newPath);
                $this->request->data['Store']['store_connection_certificate'] = $newPath;     
            }else{
                unset($this->request->data['Store']['store_connection_certificate']);
            }

            $store_email = $this->request->data['Store']['store_email'];
            $store_name = $this->request->data['Store']['store_name'];
            $store_address = $this->request->data['Store']['store_address'];
            $store_phone = $this->request->data['Store']['store_phone'];
            if ($this->Store->save($this->request->data)) {
                $storeId = $this->Store->getLastInsertId();
                // $newPass=$this->Core->generatePassword();
                $newPass='admin@123';
                $userData['User'] = array(
                    'email'=>$store_email,
                    'password'=>AuthComponent::password($newPass),
                    'first_name'=>$store_name,
                    'user_role_id'=>1,
                    'address'=>$store_address,
                    'phone'=>$store_phone,
                    'user_added_date'=>date('Y-m-d H:i:s'),
                    'user_modified_date'=>date('Y-m-d H:i:s'),
                    'last_login_ip'=>$this->request->clientIp()
                );
                $this->User->save($userData);
                $userId = $this->User->getLastInsertId();

                $userStore['UserStore'] = array(
                    'user_id'=>$userId,
                    'store_id'=>$storeId
                );
                $this->UserStore->save($userStore);
                /* #Start inset store business time */

                $slotCounts = count($timeSlots['from_day']);
                $timeSlotData = array();
                for($i=0;$i<$slotCounts;$i++){
                    $timeSlotData[$i]['store_id'] = $storeId;
                    $timeSlotData[$i]['from_day']=$timeSlots['from_day'][$i];
                    $timeSlotData[$i]['from_time']=$timeSlots['from_time'][$i];
                    $timeSlotData[$i]['from_minutes']=$timeSlots['from_minutes'][$i];
                    $timeSlotData[$i]['to_day']=$timeSlots['to_day'][$i];
                    $timeSlotData[$i]['to_time']=$timeSlots['to_time'][$i];
                    $timeSlotData[$i]['to_minutes']=$timeSlots['to_minutes'][$i];
                }
                $this->StoreTime->saveAll($timeSlotData);

                /* #end */

                /*-template asssignment if any*/
                $template = $this->EmailTemplate->find('first',
                     array(
                        'conditions' => array(
                            'template_key'=> 'store_registration',
                            'template_status' =>'Active'
                        )
                    ));
                        
                if($template){  
                    $arrFind=array('{store_name}','{email}','{password}');
                    $arrReplace=array($store_name,$store_email,$newPass);
                    
                    $from=$template['EmailTemplate']['from_email'];
                    $subject=$template['EmailTemplate']['email_subject'];
                    $content=str_replace($arrFind, $arrReplace,$template['EmailTemplate']['email_body']);
                }


                $this->set('Content',$content);
                                
                try{
                    $this->Email->from=$from;
                    $this->Email->to=$store_email;
                    $this->Email->subject=$subject;
                    $this->Email->sendAs='html';
                    $this->Email->template='general';
                    $this->Email->delivery = 'smtp';
                        
                    if($this->Email->send()){
                        $this->Session->setFlash(__('The store has been added, a registration mail has been sent to your register email address.'),'default',array('class'=>'alert alert-success'));        
                    }
                }catch(Exception $e){
                    $this->Session->setFlash(__('The store has been added'),'default',array('class'=>'alert alert-success'));
                }
                /*-[end]template asssignment*/  

                $this->redirect(array('action' => 'index'));
                
            } else {
                $this->Session->setFlash(__('The store could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set('pageVar',$pageVar);
    }

    public function company_edit($id = null) {
        $pageVar['title'] = 'Edit Store';
        $pageVar['sub_title'] = 'Edit store details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Store</li>';
        $this->Store->id = $id;
        $data = $this->Store->read(null,$id);
        $pageVar['blockCount'] = $this->Core->findCount('StoreTime',array('StoreTime.store_id'=>$id));
        if (!$this->Store->exists()) {
            throw new NotFoundException(__('Invalid Store'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $timeSlots = $this->request->data['Store']['Timeslot'];
            if(!empty($this->request->data['Store']['store_image']) && !empty($this->request->data['Store']['store_image']['name'])){
                $file = explode('.',$this->request->data['Store']['store_image']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'img/admin/stores/'.$file; 
                move_uploaded_file($this->request->data['Store']['store_image']['tmp_name'], $newPath);
                $this->request->data['Store']['store_image'] = $newPath;     
            }else{
                unset($this->request->data['Store']['store_image']);
            }

            if(!empty($this->request->data['Store']['store_connection_certificate']) && !empty($this->request->data['Store']['store_connection_certificate']['name'])){
                $file = explode('.',$this->request->data['Store']['store_connection_certificate']['name']);
                $file[0] = time();
                $file = implode('.',$file);
                $newPath = 'files/admin/stores/'.$file; 
                move_uploaded_file($this->request->data['Store']['store_connection_certificate']['tmp_name'], $newPath);
                $this->request->data['Store']['store_connection_certificate'] = $newPath;     
            }else{
                unset($this->request->data['Store']['store_connection_certificate']);
            }
            
            if ($this->Store->save($this->request->data)) {

                $slotCounts = count($timeSlots['from_day']);
                $timeSlotData = array();
                for($i=0;$i<$slotCounts;$i++){
                    $timeSlotData[$i]['store_id'] = $id;
                    $timeSlotData[$i]['from_day']=$timeSlots['from_day'][$i];
                    $timeSlotData[$i]['from_time']=$timeSlots['from_time'][$i];
                    $timeSlotData[$i]['from_minutes']=$timeSlots['from_minutes'][$i];
                    $timeSlotData[$i]['to_day']=$timeSlots['to_day'][$i];
                    $timeSlotData[$i]['to_time']=$timeSlots['to_time'][$i];
                    $timeSlotData[$i]['to_minutes']=$timeSlots['to_minutes'][$i];
                }
                $this->StoreTime->deleteAll(array('StoreTime.store_id'=>$id));
                $this->StoreTime->saveAll($timeSlotData);

                $this->Session->setFlash(__('The store has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The store could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('company_add');
    }	

    public function company_view($id = null) {
        $pageVar['title'] = 'View Store';
        $pageVar['sub_title'] = 'view store details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">View Store</li>';
        $data = $this->Store->read(null,$id);
        $pageVar['storeData'] = $data;
        $this->set('pageVar',$pageVar);
    }   

    public function get_time_slots(){
        $this->layout = false;
        if($this->request->is('post')){
            $pageVar['block'] = $this->request->data['block'];
        }
        $this->set('pageVar',$pageVar);
        $this->render('time_slots');
    }

    public function render_time_slots(){
        $this->layout = false;
        if($this->request->is('post')){
            $storeId= $this->request->data['store_id'];
            $storeTimes = $this->StoreTime->find('all',array('conditions'=>array('StoreTime.store_id'=>$storeId)));
            $pageVar['storeTimes'] = $storeTimes;
        }
        $this->set('pageVar',$pageVar);
        $this->render('render_time_slots');
    }
}
