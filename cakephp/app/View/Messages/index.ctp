<h1>Messages<h1>
<?php 
	if(!$userid) {
		echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
		echo "or";
		echo $this->Html->link('Create a new user', array('controller' => 'users', 'action' => 'add'));
	} else {
		echo "Logged in as " . $username;
		echo "<br />";
		echo $this->Html->link('<-- Back to reviews', array('controller' => 'reviews', 'action' => 'index'));
		echo "<br />";
		echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout'));
	}
?>
<table>
	<tr>
		<th>Title</th>
		<th>From</th>
		<th>Options</th>
		<th>Created</th>
	</tr>
	<!--<?php print_r($messages); ?>-->
	<?php foreach ($messages as $message): ?>
		<?php if($userid == $message['Message']['user_id']) { ?>
	<tr>
		<td><?php echo $this->Html->link($message['Message']['title'], array('controller'=>'messages', 'action'=>'view', $message['Message']['id'])); ?></td>
		<td><?php echo $message['Message']['sender_id']; ?></td>
		<td>
		<?php echo $this->Form->postlink('Delete', array('action' => 'delete', $message['Message']['id']), array('confirm' => 'Are you sure?')); ?>
		</td>
		<td><?php echo $message['Message']['created']; ?></td>
		<?php } ?>
	</tr>
	<?php endforeach; ?>
	<?php unset($message); ?>
</table>
