<?php print_r($review); ?>

<br>

<?php echo $this->Html->link("<--Back to all reviews", array('controller'=>'reviews', 'action'=>'index')); ?>

<h3><?php echo h($review['Review']['title']); ?><h3>
<h2><?php echo "By: " . h($review['User']['username']); ?><h2>
<h1><?php echo "Created: " . $review['Review']['created']; ?><h1>
<p><small><?php echo "Rating: " . $review['Review']['rating']?></small></p>
<p><small><?php echo "Type: " . $review['Review']['media']?></small></p>
<p><?php echo h($review['Review']['body']); ?></p>

<?php echo $this->Html->link("Send a message to " . h($review['User']['username']), array('controller'=>'messages', 'action'=>'sendmsm', h($review['User']['id']))); ?>


<p>Comments: </p>
<?php foreach($review['Comment'] as $comment): ?>
	<?php if($comment['review_id'] == $review['Review']['id']) { ?>
		<p><?php echo h($comment['body']); ?></p>
		<p><?php echo "by: " . h($comment['user_id']); ?></p>
		<?php if($comment['user_id'] == $currentuser) { ?>
			<p><?php echo $this->Html->link("Edit", array('controller' => 'comments', 'action' => 'edit', h($comment['id']))); echo $this->Form->postlink('Delete', array('controller' => 'comments', 'action' => 'delete', $comment['id']), array('confirm' => 'Are you sure?')); ?></p>
		<?php } ?>
	<?php } ?>
<?php endforeach; ?>
<?php unset($comment); ?>
<?php echo $this->Html->link("Add a new Comment", array('controller'=>'comments', 'action'=>'add', h($review['Review']['id']))); ?>
