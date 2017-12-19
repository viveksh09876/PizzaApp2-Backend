<?php
App::uses('AppModel', 'Model');

class Orderhistory extends AppModel {
	
	public $name = 'Orderhistory';
    public $useTable = 'OrderHistory';
    public $primaryKey = 'Sno';
     
    public $useDbConfig = 'db2';
	
	
}
