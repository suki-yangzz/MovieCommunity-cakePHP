<h1>Send Message</h1>
<?php
	echo $this->Form->create('Message');
	echo $this->Form->input('title');
	echo $this->Form->input('body', array('rows' => '3'));
	echo $this->Form->input('receiver_id', array('type' => 'hidden'));
	echo $this->Form->end('Save Message');
?>
