<?php
class ReportsController extends AppController {

	public $name = 'Reports';
	public $helpers = array('Form', 'Html', 'Js','General');
	public $uses = array('Orderhistory','NewOrderhistory','Orderlog','Ecuser');
	public $components=array('Core');	
	
	function beforeFilter(){
		parent::beforeFilter();	
		 $this->Auth->allow(array('admin_importOrderHistory'));
	}
	function admin_importOrderHistory(){
		Configure::write('debug',0);
		$allPlacedOrder=$this->Orderhistory->find('all');
		$aArr=array('13.5""','12.5""','11.5""','10.5""','9.5""','9""','7.5""','7""');
		$rArr=array('13.5"','12.5"','11.5"','10.5"','9.5"','9"','7.5"','7"');
		//pr($allPlacedOrder);
		foreach($allPlacedOrder as $order){
			$firstRec=$this->NewOrderhistory->find('first',array('conditions'=>array('Sno'=>$order['Orderhistory']['SNo'])));
			$jsonstr=str_replace($aArr,$rArr,$order['Orderhistory']['OrderDetail']);
			$neworder['dealId']='';
			$orderDetail=json_decode($jsonstr,true);
			//echo $orderDetail['user']['email'];
			if(empty($firstRec['NewOrderhistory']['id'])){
				$neworder['Sno']=$order['Orderhistory']['SNo'];
				$neworder['storeId']=$orderDetail['storeId'];
				$neworder['coupon']=$orderDetail['coupon'];
				$neworder['couponDiscount']=$orderDetail['couponDiscount']?$orderDetail['couponDiscount']:0;
				foreach($orderDetail['order_details'] as $od){
					if($od['dealId']){
						$neworder['dealId']=$od['dealId'];
					}
				}
				$neworder['discount']=$orderDetail['discount'];
				$neworder['total_price']=$orderDetail['total_price'];
				$neworder['UserId']=$order['Orderhistory']['UserId'];
				$neworder['order_type']=$orderDetail['order_type'];
				$neworder['delivery_time']=$orderDetail['delivery_time'];
				$neworder['delivery_time_type']=$orderDetail['delivery_time_type'];
				$neworder['email']=$orderDetail['user']['email'];
				$neworder['phone']=$orderDetail['user']['phone'];
				$neworder['address']=json_encode($orderDetail['address']);
				$neworder['Created_data']=$order['Orderhistory']['CreatedAt'];
				$data['NewOrderhistory']=$neworder;
				
				$this->NewOrderhistory->create();
				$this->NewOrderhistory->save($data);
			}
		}
		echo 'Done';die;
	}
	
	
	function admin_index($sd=null,$ed=null){
		Configure::write('debug',0);
		$this->set('title_for_layout','Dashboard');
		$pageVar['title'] = 'Dashboard';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Dashboard</li>';
		$this->set('pageVar',$pageVar);
		
		$this->NewOrderhistory->virtualFields['count']='COUNT(id)';
		if(!empty($sd) && !empty($ed)){
			$totleStartedOrder=$this->Orderlog->find('count',array('conditions'=>array('created BETWEEN ? AND ?' => array($sd, $ed))));
			$totleOrder=$this->NewOrderhistory->find('count',array('conditions'=>array('storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed))));
			$totleUseCoupon=$this->NewOrderhistory->find('all',array('conditions'=>array('coupon !='=>'','storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>array('storeId','coupon'),'fields'=>array('storeId','coupon','count')));
			$totleStoreOrder=$this->NewOrderhistory->find('all',array('conditions'=>array('storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>'storeId','fields'=>array('storeId','count')));
			$this->NewOrderhistory->bindModel(array(
				'belongsTo' => array(
					'Ecuser' => array(
							'foreignKey' => 'UserId'
							)
						  )
					),
				false
			);
		$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>array('UserId'),'fields'=>array('UserId','count')));
		
		$repeatedUserbyStore=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>array('storeId','UserId'),'fields'=>array('UserId','storeId','count')));
		
			$this->NewOrderhistory->unbindModel(array(
					'belongsTo' => array('Ecuser')
                ),
            false
        );
			$repeatedUser2=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId'=>0,'storeId NOT IN'=>array('','1','Morningside'),'phone !='=>'','Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>array('phone'),'fields'=>array('UserId','count','phone','email','storeId')));
			
			
		}else{
			
			$totleStartedOrder=$this->Orderlog->find('count');
			$totleOrder=$this->NewOrderhistory->find('count',array('conditions'=>array('storeId NOT IN'=>array('','1','Morningside'))));
			$totleUseCoupon=$this->NewOrderhistory->find('all',array('conditions'=>array('coupon !='=>'','storeId NOT IN'=>array('','1','Morningside')),'group' =>array('storeId','coupon'),'fields'=>array('storeId','coupon','count')));
			$totleStoreOrder=$this->NewOrderhistory->find('all',array('conditions'=>array('storeId NOT IN'=>array('','1','Morningside')),'group' =>'storeId','fields'=>array('storeId','count')));
			$this->NewOrderhistory->bindModel(array(
				'belongsTo' => array(
					'Ecuser' => array(
							'foreignKey' => 'UserId'
							)
						  )
					),
				false
			);
		$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside')),'group' =>array('UserId'),'fields'=>array('UserId','count')));
		
		$repeatedUserbyStore=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside')),'group' =>array('storeId','UserId'),'fields'=>array('UserId','storeId','count')));
		
			$this->NewOrderhistory->unbindModel(array(
					'belongsTo' => array('Ecuser')
                ),
            false
        );
			$repeatedUser2=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId'=>0,'storeId NOT IN'=>array('','1','Morningside'),'phone !='=>''),'group' =>array('phone'),'fields'=>array('UserId','count','phone','email','storeId')));
			
		}
		
		
		if($totleUseCoupon){
			$count=0;
			$count_n=0;
			foreach($totleUseCoupon as $coupon){
				if(strpos($coupon['NewOrderhistory']['coupon'], 'NKDSCOT') !== false){
					$count += $coupon['NewOrderhistory']['count'];
					$coupon['NewOrderhistory']['count']=$count;
					$coupon['NewOrderhistory']['coupon']='NKDSCOT';
					$arr[$coupon['NewOrderhistory']['storeId']]['NKDSCOT']=$coupon['NewOrderhistory'];
				}else if(strpos($coupon['NewOrderhistory']['coupon'], 'NKD15') !== false || strpos($coupon['NewOrderhistory']['coupon'], 'Nkd15') !== false){
					$count_n += $coupon['NewOrderhistory']['count'];
					$coupon['NewOrderhistory']['count']=$count_n;
					$coupon['NewOrderhistory']['coupon']='NKD15';
					$arr[$coupon['NewOrderhistory']['storeId']]['NKD15']=$coupon['NewOrderhistory'];
				}else{
					$arr[$coupon['NewOrderhistory']['storeId']][]=$coupon['NewOrderhistory'];
				}
			}
		}
	
		
		$uC=0;
		foreach($repeatedUser as $user){
			if($user['NewOrderhistory']['count']>1){
				//$userArrRep[]=$user;
				$uC+=1;
				$userArrRep['count']=$uC;
			}
		}
		
		foreach($repeatedUserbyStore as $user){
			if($user['NewOrderhistory']['count']>1){
				$userArr[$user['NewOrderhistory']['storeId']][]=$user;
			}
		}
		
		$uC2=0;
		foreach($repeatedUser2 as $user2){
			if($user2['NewOrderhistory']['count']>1){
				$uC2+=1;
				$userArr2['count']=$uC2;
				$userArr3[$user2['NewOrderhistory']['storeId']][]=$user2;
			}
		}
		
		$out=array('startedOrder'=>$totleStartedOrder,'placedOrder'=>$totleOrder,'totleUseCoupon'=>$arr,'placedOrderByStore'=>$totleStoreOrder,'repeatedUser'=>$userArrRep,'repeatedUserbyStore'=>$userArr,'repeatedUser2'=>$userArr2,'guestRepeatedUser'=>$userArr3);
		$this->set('out',$out);
	}
	
	function admin_repeatedUser($id=null){
			Configure::write('debug',0);
			$totleOrder=$this->NewOrderhistory->virtualFields['count']='COUNT(id)';
			$this->NewOrderhistory->bindModel(array(
				'belongsTo' => array(
					'Ecuser' => array(
							'foreignKey' => 'UserId'
							)
						  )
					),
				false
			);
		if($id){
			if($this->request->query){
				$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId'=>$id,'Created_data BETWEEN ? AND ?' => array($this->request->query['sd'], $this->request->query['ed'])),'group' =>array('UserId'),'fields'=>array('UserId','count')));
			}else{
				$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId'=>$id),'group' =>array('UserId'),'fields'=>array('UserId','count')));
			}
			foreach($repeatedUser as $user){
				if($user['NewOrderhistory']['count']>1){
					$userArrRep[]=$user;
				}
			}
		}else{
			if($this->request->query){
					$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($this->request->query['sd'], $this->request->query['ed'])),'group' =>array('UserId'),'fields'=>array('UserId','count')));
				}else{
					$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside')),'group' =>array('UserId'),'fields'=>array('UserId','count')));
				}
					foreach($repeatedUser as $user){
						if($user['NewOrderhistory']['count']>1){
							$userArrRep[]=$user;
						}
					  }
				
		}
		$out=array('repeatedUser'=>$userArrRep,'store'=>$id);
		$this->set('out',$out);
	}
	
	function admin_ordersDetail($id){
		 $this->NewOrderhistory->bindModel(array(
            'belongsTo' => array(
                'Ecuser' => array(
						'foreignKey' => 'UserId'
						)
                      )
                ),
            false
        );
		$repeatedUserOrdersDetail=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId'=>$id,'storeId NOT IN'=>array('','1','Morningside'))));
		$out=array('repeatedUserOrdersDetail'=>$repeatedUserOrdersDetail);
		$this->set('out',$out);
	}
	
	public function admin_users($limit=null,$sd,$ed){
		Configure::write('debug',0);
		if(empty($limit)){
			$limit=25;
		}
		if($limit=='all'){
			$limit=0;
		}
		
		if($sd && $ed){
			$this->paginate = array(
				'conditions'=>array('CollectionDate BETWEEN ? AND ?'=>array($sd,$ed)),
				'order' => array(
					'Ecuser.Id' => 'desc'
					),
				'limit'=>$limit
			);
		}else{
			$this->paginate = array(
				'order' => array(
					'Ecuser.Id' => 'desc'
					),
				'limit'=>$limit
			);
		}
		$users=$this->paginate('Ecuser');
		$out=array('users'=>$users);
		$this->set('out',$out);
	}
	
	public function admin_guestUsers($limit=null,$sd,$ed){
		Configure::write('debug',0);
		if(empty($limit)){
			$limit=25;
		}
		if($limit=='all'){
			$limit=0;
		}
		if($sd && $ed){
			$this->paginate = array(
				'conditions'=>array('UserId'=>0,'storeId NOT IN'=>array('','1','Morningside'),'phone !='=>'','Created_data BETWEEN ? AND ?' => array($sd, $ed)),
				'order' => array(
					'NewOrderhistory.id' => 'desc'
					),
				'limit'=>$limit,
				'group' =>array('phone'),
				'fields'=>array('phone','email','storeId','address')
			);
			
		}else{
			$this->paginate = array(
				'conditions'=>array('UserId'=>0,'storeId NOT IN'=>array('','1','Morningside'),'phone !='=>''),
				'order' => array(
					'NewOrderhistory.id' => 'desc'
					),
				'limit'=>$limit,
				'group' =>array('phone'),
				'fields'=>array('phone','email','storeId','address')
			);
		}
		$users=$this->paginate('NewOrderhistory');
		$out=array('users'=>$users);
		$this->set('out',$out);
	}
	
	function company_index($sd=null,$ed=null){
		Configure::write('debug',0);
		$this->set('title_for_layout','Dashboard');
		$pageVar['title'] = 'Dashboard';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Dashboard</li>';
		$this->set('pageVar',$pageVar);
		
		$this->NewOrderhistory->virtualFields['count']='COUNT(id)';
		if(!empty($sd) && !empty($ed)){
			$totleStartedOrder=$this->Orderlog->find('count',array('conditions'=>array('created BETWEEN ? AND ?' => array($sd, $ed))));
			
			$totleOrder=$this->NewOrderhistory->find('count',array('conditions'=>array('storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed))));
			$totleUseCoupon=$this->NewOrderhistory->find('all',array('conditions'=>array('coupon !='=>'','storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>array('storeId','coupon'),'fields'=>array('storeId','coupon','count')));
			$totleStoreOrder=$this->NewOrderhistory->find('all',array('conditions'=>array('storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>'storeId','fields'=>array('storeId','count')));
			$this->NewOrderhistory->bindModel(array(
				'belongsTo' => array(
					'Ecuser' => array(
							'foreignKey' => 'UserId'
							)
						  )
					),
				false
			);
		$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>array('UserId'),'fields'=>array('UserId','count')));
		
		$repeatedUserbyStore=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>array('storeId','UserId'),'fields'=>array('UserId','storeId','count')));
		
			$this->NewOrderhistory->unbindModel(array(
					'belongsTo' => array('Ecuser')
                ),
            false
        );
			$repeatedUser2=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId'=>0,'storeId NOT IN'=>array('','1','Morningside'),'phone !='=>'','Created_data BETWEEN ? AND ?' => array($sd, $ed)),'group' =>array('phone'),'fields'=>array('UserId','count','phone','email','storeId')));
			
			
		}else{
			
			$totleStartedOrder=$this->Orderlog->find('count');
			$totleOrder=$this->NewOrderhistory->find('count',array('conditions'=>array('storeId NOT IN'=>array('','1','Morningside'))));
			$totleUseCoupon=$this->NewOrderhistory->find('all',array('conditions'=>array('coupon !='=>'','storeId NOT IN'=>array('','1','Morningside')),'group' =>array('storeId','coupon'),'fields'=>array('storeId','coupon','count')));
			$totleStoreOrder=$this->NewOrderhistory->find('all',array('conditions'=>array('storeId NOT IN'=>array('','1','Morningside')),'group' =>'storeId','fields'=>array('storeId','count')));
			$this->NewOrderhistory->bindModel(array(
				'belongsTo' => array(
					'Ecuser' => array(
							'foreignKey' => 'UserId'
							)
						  )
					),
				false
			);
		$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside')),'group' =>array('UserId'),'fields'=>array('UserId','count')));
		
		$repeatedUserbyStore=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside')),'group' =>array('storeId','UserId'),'fields'=>array('UserId','storeId','count')));
		
			$this->NewOrderhistory->unbindModel(array(
					'belongsTo' => array('Ecuser')
                ),
            false
        );
			$repeatedUser2=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId'=>0,'storeId NOT IN'=>array('','1','Morningside'),'phone !='=>''),'group' =>array('phone'),'fields'=>array('UserId','count','phone','email','storeId')));
			
		}
		
		
		if($totleUseCoupon){
			$count=0;
			$count_n=0;
			foreach($totleUseCoupon as $coupon){
				if(strpos($coupon['NewOrderhistory']['coupon'], 'NKDSCOT') !== false){
					$count += $coupon['NewOrderhistory']['count'];
					$coupon['NewOrderhistory']['count']=$count;
					$coupon['NewOrderhistory']['coupon']='NKDSCOT';
					$arr[$coupon['NewOrderhistory']['storeId']]['NKDSCOT']=$coupon['NewOrderhistory'];
				}else if(strpos($coupon['NewOrderhistory']['coupon'], 'NKD15') !== false || strpos($coupon['NewOrderhistory']['coupon'], 'Nkd15') !== false){
					$count_n += $coupon['NewOrderhistory']['count'];
					$coupon['NewOrderhistory']['count']=$count_n;
					$coupon['NewOrderhistory']['coupon']='NKD15';
					$arr[$coupon['NewOrderhistory']['storeId']]['NKD15']=$coupon['NewOrderhistory'];
				}else{
					$arr[$coupon['NewOrderhistory']['storeId']][]=$coupon['NewOrderhistory'];
				}
			}
		}
	
		
		$uC=0;
		foreach($repeatedUser as $user){
			if($user['NewOrderhistory']['count']>1){
				//$userArrRep[]=$user;
				$uC+=1;
				$userArrRep['count']=$uC;
			}
		}
		
		foreach($repeatedUserbyStore as $user){
			if($user['NewOrderhistory']['count']>1){
				$userArr[$user['NewOrderhistory']['storeId']][]=$user;
			}
		}
		
		$uC2=0;
		foreach($repeatedUser2 as $user2){
			if($user2['NewOrderhistory']['count']>1){
				$uC2+=1;
				$userArr2['count']=$uC2;
				$userArr3[$user2['NewOrderhistory']['storeId']][]=$user2;
			}
		}
		
		$out=array('startedOrder'=>$totleStartedOrder,'placedOrder'=>$totleOrder,'totleUseCoupon'=>$arr,'placedOrderByStore'=>$totleStoreOrder,'repeatedUser'=>$userArrRep,'repeatedUserbyStore'=>$userArr,'repeatedUser2'=>$userArr2,'guestRepeatedUser'=>$userArr3);
		$this->set('out',$out);
	}
	
	
	function company_repeatedUser($id=null){
			Configure::write('debug',0);
			$totleOrder=$this->NewOrderhistory->virtualFields['count']='COUNT(id)';
			$this->NewOrderhistory->bindModel(array(
				'belongsTo' => array(
					'Ecuser' => array(
							'foreignKey' => 'UserId'
							)
						  )
					),
				false
			);
		if($id){
			if($this->request->query){
				$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId'=>$id,'Created_data BETWEEN ? AND ?' => array($this->request->query['sd'], $this->request->query['ed'])),'group' =>array('UserId'),'fields'=>array('UserId','count')));
			}else{
				$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId'=>$id),'group' =>array('UserId'),'fields'=>array('UserId','count')));
			}
			foreach($repeatedUser as $user){
				if($user['NewOrderhistory']['count']>1){
					$userArrRep[]=$user;
				}
			}
		}else{
			if($this->request->query){
					$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside'),'Created_data BETWEEN ? AND ?' => array($this->request->query['sd'], $this->request->query['ed'])),'group' =>array('UserId'),'fields'=>array('UserId','count')));
				}else{
					$repeatedUser=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId !='=>0,'storeId NOT IN'=>array('','1','Morningside')),'group' =>array('UserId'),'fields'=>array('UserId','count')));
				}
					foreach($repeatedUser as $user){
						if($user['NewOrderhistory']['count']>1){
							$userArrRep[]=$user;
						}
					  }
				
		}
		$out=array('repeatedUser'=>$userArrRep,'store'=>$id);
		$this->set('out',$out);
	}
	
	function company_ordersDetail($id){
		 $this->NewOrderhistory->bindModel(array(
            'belongsTo' => array(
                'Ecuser' => array(
						'foreignKey' => 'UserId'
						)
                      )
                ),
            false
        );
		$repeatedUserOrdersDetail=$this->NewOrderhistory->find('all',array('conditions'=>array('UserId'=>$id,'storeId NOT IN'=>array('','1','Morningside'))));
		$out=array('repeatedUserOrdersDetail'=>$repeatedUserOrdersDetail);
		$this->set('out',$out);
	}
	
	public function company_users($limit=null,$sd,$ed){
		Configure::write('debug',0);
		if(empty($limit)){
			$limit=25;
		}
		if($limit=='all'){
			$limit=0;
		}
		
		if($sd && $ed){
			$this->paginate = array(
				'conditions'=>array('CollectionDate BETWEEN ? AND ?'=>array($sd,$ed)),
				'order' => array(
					'Ecuser.Id' => 'desc'
					),
				'limit'=>$limit
			);
		}else{
			$this->paginate = array(
				'order' => array(
					'Ecuser.Id' => 'desc'
					),
				'limit'=>$limit
			);
		}
		$users=$this->paginate('Ecuser');
		$out=array('users'=>$users);
		$this->set('out',$out);
	}
	
	public function company_guestUsers($limit=null,$sd,$ed){
		Configure::write('debug',0);
		if(empty($limit)){
			$limit=25;
		}
		if($limit=='all'){
			$limit=0;
		}
		if($sd && $ed){
			$this->paginate = array(
				'conditions'=>array('UserId'=>0,'storeId NOT IN'=>array('','1','Morningside'),'phone !='=>'','Created_data BETWEEN ? AND ?' => array($sd, $ed)),
				'order' => array(
					'NewOrderhistory.id' => 'desc'
					),
				'limit'=>$limit,
				'group' =>array('phone'),
				'fields'=>array('phone','email','storeId','address')
			);
			
		}else{
			$this->paginate = array(
				'conditions'=>array('UserId'=>0,'storeId NOT IN'=>array('','1','Morningside'),'phone !='=>''),
				'order' => array(
					'NewOrderhistory.id' => 'desc'
					),
				'limit'=>$limit,
				'group' =>array('phone'),
				'fields'=>array('phone','email','storeId','address')
			);
		}
		$users=$this->paginate('NewOrderhistory');
		$out=array('users'=>$users);
		$this->set('out',$out);
	}
	
}
