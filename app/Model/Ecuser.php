<?php
App::uses('AppModel', 'Model');
class Ecuser extends AppModel {
	
	public $name = 'Ecuser';
	public $primaryKey = 'id';
	public $useTable = 'ECUser';
	
	public $useDbConfig = 'db2';
	
}
