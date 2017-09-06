<?php
class CommonBehavior extends ModelBehavior {

    public function setup(Model $Model, $config = array())  {
      
    }

    public function beforeSave(Model $Model, $options = array()) {
    	if(isset($Model->data[$Model->name]['id'])){
    		$Model->data[$Model->name]['modified'] = date('Y-m-d H:i:s');
    	}else{
    		$Model->data[$Model->name]['created'] = date('Y-m-d H:i:s');
    		$Model->data[$Model->name]['modified'] = date('Y-m-d H:i:s');
    	}
	 	return true;
    }

    public function afterFind(Model $model, $results, $primary) {
        
    }
}