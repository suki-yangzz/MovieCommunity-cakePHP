<?php
class Message extends AppModel {
	public $validate = array(
		'title' => array('rule' => 'notEmpty'), 
		'body' => array('rule' => 'notEmpty')
	);

	public $belongsTo = 'User';
}
?>
