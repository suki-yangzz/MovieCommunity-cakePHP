<h1>Add Review</h1>
<?php
	echo $this->Form->create('Review');
	echo $this->Form->input('title');
	echo $this->Form->input('rating');
	echo $this->Form->input('media');
	echo $this->Form->input('body', array('rows' => '3'));
	echo $this->Form->end('Save Review');
?>
