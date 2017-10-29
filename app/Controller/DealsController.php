<?php
App::uses('AppController', 'Controller');
class DealsController extends AppController {
    public $components=array('Core','Email');
    public $uses = array('EmailTemplate','Deal','ProductModifier','DealItem','DealGroup','DealCombination','FinalDeal');
    public $helders = array('Ajax','General');

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }

    public function admin_index() {
        $pageVar['title'] = 'Deals';
        $pageVar['sub_title'] = 'List of deals';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Deals</li>';

        $qOpts = array(
            'conditions'=>array(),
            'limit'=>10,
            'order'=>'Deal.id DESC'
        );
        $this->paginate = $qOpts;
        $Deals = $this->paginate('Deal');
        $this->set(compact('Deals','pageVar'));
    }

    public function admin_add($dealId=null) {
        $pageVar['title'] = 'Add Deal';
        $pageVar['sub_title'] = 'Add new deal';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Deal</li>';
        $pageVar['sizes'] = array('999991'=>'Small','999992'=>'Medium','999993'=>'Large');
        $pageVar['crusts'] = array('I100'=>'Original Crust','I101'=>'Skinny Crust','I102'=>'Glueten Free');
        $pageVar['categories'] = $this->Core->getList('Category',array('id','name'),array('status'=>1));
        $pageVar['dealId'] = $dealId;

        if ($this->request->is('post')) {           
             if(!empty($this->request->data['Deal']['image']) && !empty($this->request->data['Deal']['image']['name'])){
                $file = explode('.',$this->request->data['Deal']['image']['name']);
                $file[0] = strtolower($file[0]).time();
                $file = implode('.',$file);
                $newPath = 'img/admin/deals/'.$file; 
                move_uploaded_file($this->request->data['Deal']['image']['tmp_name'], $newPath);
                $this->request->data['Deal']['image'] = $file;     
            }else{
                unset($this->request->data['Deal']['image']);
            }

            if(!empty($this->request->data['Deal']['thumbnail']) && !empty($this->request->data['Deal']['thumbnail']['name'])){
                $file = explode('.',$this->request->data['Deal']['thumbnail']['name']);
                $file[0] = strtolower($file[0]).time();
                $file = implode('.',$file);
                $newPath = 'img/admin/deals/'.$file; 
                move_uploaded_file($this->request->data['Deal']['thumbnail']['tmp_name'], $newPath);
                $this->request->data['Deal']['thumbnail'] = $file;     
            }else{
                unset($this->request->data['Deal']['thumbnail']);
            }

            $this->request->data['Deal']['store_id'] = $this->Auth->user('user_id');
            if ($this->Deal->addDeal($this->request->data)) {
                $dealId = $this->Deal->getLastInsertId();
                $this->redirect('add/'.$dealId);
            } else {
                $this->Session->setFlash(__('Sorry! deal not added.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        if(isset($dealId)){
            $this->request->data = $this->Deal->find('first',array('conditions'=>array('id'=>$dealId)));
        }
        $this->set('pageVar',$pageVar);
        $this->render('admin_add');
    }

    public function admin_add_item(){
        $this->layout = $this->autoRender = false;
        $dataArr = $modifierArr = $products = array();
        if(isset($this->request->data)){
            $data = $this->request->data;
            if(!empty($data['DealItem']['size'])){
                $sizeArr = $data['DealItem']['size'];
                foreach ($sizeArr as $key => $value) {
                    $modifierArr[] = array(
                        'modifierId'=>1,
                        'modOptionPlu'=>$value
                    );     
                }
            }

            if(!empty($data['DealItem']['crust'])){
                $crustArr = $data['DealItem']['crust'];
                foreach ($crustArr as $key => $value) {
                    $modifierArr[] = array(
                        'modifierId'=>2,
                        'modOptionPlu'=>$value
                    );     
                }
            }

            if(!empty($data['DealItem']['product'])){
                $products = $data['DealItem']['product'];
            }
            
            $posCount = $this->DealItem->find('count',array('conditions'=>array('DealItem.deal_id'=>$data['DealItem']['deal_id'])));

            $categoryId = $data['DealItem']['category'];
            
            $dataArr['DealItem']['deal_id'] = $data['DealItem']['deal_id'];
            $dataArr['DealItem']['cat_id'] = $data['DealItem']['category'];
            $dataArr['DealItem']['cat_text'] = $data['DealItem']['cat_text'];
            $dataArr['DealItem']['products'] = implode(',',$products);
            $dataArr['DealItem']['modifiers'] = json_encode($modifierArr);
            $dataArr['DealItem']['quantity'] = $data['DealItem']['quantity'];
            $dataArr['DealItem']['item_count'] = $data['DealItem']['quantity'];
            $dataArr['DealItem']['item_condition'] = $data['DealItem']['condition'];
            $dataArr['DealItem']['status'] = $data['DealItem']['status'];
            $dataArr['DealItem']['pos'] = $posCount;
            

            if($this->DealItem->save($dataArr)){
                echo json_encode(array('success'=>1,'deal_id'=>$data['DealItem']['deal_id']));
            }else{
                echo json_encode(array('success'=>0));
            }

        }
    }

    public function getProductList($catId){
        $this->layout = false;
        $this->autoRender = false;
        $products = $this->Core->getList('Product',array('id','title','id'),array('status'=>1,'category_id'=>$catId));
        return json_encode($products);
    }

    public function getDealItemList($dealId){
        $this->layout = false;
        $dealitems = $this->DealItem->find('all',array('fields'=>array('*'),'conditions'=>array('DealItem.deal_id'=>$dealId)));
        $pageVar['dealItems'] = $dealitems;

        $joins = array(
            array(
                'table'=>'deal_items',
                'alias'=>'DealItem1',
                'type'=>'LEFT',
                'conditions'=>'DealItem1.id = DealGroup.item1'
            ),
            array(
                'table'=>'deal_items',
                'alias'=>'DealItem2',
                'type'=>'LEFT',
                'conditions'=>'DealItem2.id = DealGroup.item2'
            )  
        );

        $dealgroups = $this->DealGroup->find('all',array('fields'=>array('*'),'conditions'=>array('DealGroup.deal_id'=>$dealId),'joins'=>$joins));
        $pageVar['dealGroups'] = $dealgroups;

         $joins = array(
            array(
                'table'=>'deal_items',
                'alias'=>'DealItem1',
                'type'=>'LEFT',
                'conditions'=>'DealItem1.id = DealCombination.item1'
            ),
            array(
                'table'=>'deal_items',
                'alias'=>'DealItem2',
                'type'=>'LEFT',
                'conditions'=>'DealItem2.id = DealCombination.item2'
            ),
            array(
                'table'=>'deal_groups',
                'alias'=>'DealGroup1',
                'type'=>'LEFT',
                'conditions'=>'DealGroup1.id = DealCombination.group1'
            ),
            array(
                'table'=>'deal_groups',
                'alias'=>'DealGroup2',
                'type'=>'LEFT',
                'conditions'=>'DealGroup2.id = DealCombination.group2'
            ),
            array(
                'table'=>'deal_items',
                'alias'=>'DealGroup1Item1',
                'type'=>'LEFT',
                'conditions'=>'DealGroup1Item1.id = DealGroup1.item1'
            ),
            array(
                'table'=>'deal_items',
                'alias'=>'DealGroup1Item2',
                'type'=>'LEFT',
                'conditions'=>'DealGroup1Item2.id = DealGroup1.item2'
            ),
            array(
                'table'=>'deal_items',
                'alias'=>'DealGroup2Item1',
                'type'=>'LEFT',
                'conditions'=>'DealGroup2Item1.id = DealGroup2.item1'
            ),
            array(
                'table'=>'deal_items',
                'alias'=>'DealGroup2Item2',
                'type'=>'LEFT',
                'conditions'=>'DealGroup2Item2.id = DealGroup2.item2'
            ),
        );

        $dealcombinations = $this->DealCombination->find('all',array('fields'=>array('*'),'conditions'=>array('DealCombination.deal_id'=>$dealId),'joins'=>$joins));
        $pageVar['dealCombinations'] = $dealcombinations;
        $this->set('pageVar',$pageVar);
    }

    public function admin_save_deal(){
        $this->layout = false;
        $this->autoRender = false;
        $dataArr = array();
        if(!empty($this->request->data)){
            $data = $this->request->data;
            $dataArr['FinalDeal']['deal_id'] = $data['DealGroup']['deal_id']; 
            $dataArr['FinalDeal']['item1'] = (isset($data['DealGroup']['deal_item_id'][0])?$data['DealGroup']['deal_item_id'][0]:null); 
            $dataArr['FinalDeal']['item2'] = (isset($data['DealGroup']['deal_item_id'][1])?$data['DealGroup']['deal_item_id'][1]:null); 
            $dataArr['FinalDeal']['group1'] = (isset($data['DealGroup']['deal_group_id'][0])?$data['DealGroup']['deal_group_id'][0]:null); 
            $dataArr['FinalDeal']['group2'] = (isset($data['DealGroup']['deal_group_id'][1])?$data['DealGroup']['deal_group_id'][1]:null); 
            $dataArr['FinalDeal']['combination1'] = (isset($data['DealGroup']['deal_combination_id'][0])?$data['DealGroup']['deal_combination_id'][0]:null); 
            $dataArr['FinalDeal']['combination2'] = (isset($data['DealGroup']['deal_combination_id'][1])?$data['DealGroup']['deal_combination_id'][1]:null); 
            $dataArr['FinalDeal']['cond'] = $data['DealGroup']['condition']; 
            if($this->FinalDeal->save($dataArr)){
                echo json_encode(array('isSuccess'=>1));
            }else{
                echo json_encode(array('isSuccess'=>0));
            }
        }
    }
    public function admin_make_group(){
        $this->layout = false;
        $this->autoRender = false;

        if(!empty($this->request->data)){
            $data = $this->request->data;
            if(!empty($data['DealGroup']['deal_group_id'])){
                $dealId = $data['DealGroup']['deal_id'];
                $dataArr['DealCombination']['deal_id'] = $dealId;
                $dataArr['DealCombination']['group1'] = (isset($data['DealGroup']['deal_group_id'][0])?$data['DealGroup']['deal_group_id'][0]:null);
                $dataArr['DealCombination']['group2'] = (isset($data['DealGroup']['deal_group_id'][1])?$data['DealGroup']['deal_group_id'][1]:null);
                $dataArr['DealCombination']['item1'] = (isset($data['DealGroup']['deal_item_id'][0])?$data['DealGroup']['deal_item_id'][0]:null);
                $dataArr['DealCombination']['item2'] = (isset($data['DealGroup']['deal_item_id'][1])?$data['DealGroup']['deal_item_id'][1]:null);
                $dataArr['DealCombination']['cond'] = $data['DealGroup']['condition'];
                if($this->DealCombination->save($dataArr)){

                    echo json_encode(array('success'=>1,'deal_id'=>$dealId));
                }else{
                    echo json_encode(array('success'=>0));
                }
            }else{
                $dealId = $data['DealGroup']['deal_id'];
                $dataArr['DealGroup']['deal_id'] = $dealId;
                $dataArr['DealGroup']['item1'] = $data['DealGroup']['deal_item_id'][0];
                $dataArr['DealGroup']['item2'] = $data['DealGroup']['deal_item_id'][1];
                $dataArr['DealGroup']['cond'] = $data['DealGroup']['condition'];
                if($this->DealGroup->save($dataArr)){
                    echo json_encode(array('success'=>1,'deal_id'=>$dealId));
                }else{
                    echo json_encode(array('success'=>0));
                }
            }
        }
    }

    public function getModifierList($productId){
        $this->layout = false;
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

    function admin_delete($dealId){
        $this->Deal->id = $dealId;
        if($this->Deal->delete()){
            $this->DealItem->deleteAll(array('DealItem.deal_id' => $dealId), false);
            $this->DealGroup->deleteAll(array('DealGroup.deal_id' => $dealId), false);
            $this->DealCombination->deleteAll(array('DealCombination.deal_id' => $dealId), false);
            $this->FinalDeal->deleteAll(array('FinalDeal.deal_id' => $dealId), false);
            $this->Session->setFlash(__('Deal deleted successfully.'),'default',array('class'=>'alert alert-success'));
            $this->redirect(array('action' => 'index'));
        }
    }  
}
