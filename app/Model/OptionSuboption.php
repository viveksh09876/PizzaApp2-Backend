<?php
App::uses('AppModel', 'Model');
class OptionSuboption extends AppModel {
	public $actsAs = array('Common');

	public $belongsTo = array(
		'SubOption'=>array(
			'className' => 'SubOption',
			'foreignKey' => 'suboption_id',
			'dependent' => false
		)
	);

}