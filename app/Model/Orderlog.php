<?php
App::uses('AppModel', 'Model');

class Orderlog extends AppModel {
	
	public $name = 'Orderlog';
    public $useTable = 'orderlogs';
    public $primaryKey = 'id';
	
}
