<?php
App::uses('AppModel', 'Model');

class NewOrderhistory extends AppModel {
	public $name = 'NewOrderhistory';
    public $useTable = 'orderhistory';
    public $primaryKey = 'id';
	
}
