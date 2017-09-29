<?php
class CoreComponent extends Component  {
    function __construct($collection, $settings){
        $this->Controller = $collection->getController();
    }

    function generatePassword ($length = 10){ 
        // inicializa variables 
        $password = ""; 
        $i = 0; 
        $possible = "0123456789abcdefghijklmnopqrstuvwxyz[]*()=_-+#@!";  
        
        // agrega random 
        while ($i < $length){ 
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);          
            if (!strstr($password, $char)) {  
                $password .= $char; 
                $i++; 
            } 
        } 
        return $password; 
    }	
    
    function findCount($model,$condtions=array()){
        $model = ClassRegistry::init($model);
        return $model->find('count',array('conditions'=>$condtions));
    }

    function getList($model, $fields=array(), $conditions=array(),$joins=array()){
        $recordList = array();
        $model = ClassRegistry::init($model);
        $recordList  = $model->find('list',array(
            'fields' => $fields,
            'conditions' => $conditions,
            'joins'=>$joins
            )
        );
        return $recordList;
    }

    function getRecord($model, $fields=array(), $conditions=array()){
        $recordList = array();
        $model = ClassRegistry::init($model);
        $recordList  = $model->find('first',array(
            'fields' => $fields,
            'conditions' => $conditions
            )
        );
        return $recordList;
    }

    function getAllRecords($model, $fields=array(), $conditions=array(),$recursive=0){
        $recordList = array();
        $model = ClassRegistry::init($model);
        $model->recursive = $recursive;
        $recordList  = $model->find('all',array(
            'fields' => $fields,
            'conditions' => $conditions
            )
        );
        return $recordList;
    }

    function getUserStoreList($model, $fields=array(), $conditions=array(),$recursive=0){
        $recordList = array();
        $model = ClassRegistry::init($model);
        $model->recursive = $recursive;
        $recordList  = $model->find('all',array(
            'fields' => $fields,
            'conditions' => $conditions
            )
        );
        foreach ($recordList as $key => $value) {
            $List[$value['UserStore']['user_id']] = $value['Store']['store_name'];
        }
        return $List;
    }
}
