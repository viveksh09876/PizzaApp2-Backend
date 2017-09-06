<?php
App::uses('AppModel', 'Model');

class EmailTemplate extends AppModel {

	public $primaryKey='template_id';
	public $displayField = 'template_name';
	public $layout='admin';

	public $validate = array(
		'template_name' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the template name'				
			)
		),
		'template_key' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enrt the template slug/key'
			)
		),
		'email_body' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'Please enrt the email body body'
			)
		)
	);
}
