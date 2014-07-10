<?php echo $this->Html->link("<--Back to all messages", array('controller'=>'messages', 'action'=>'index')); ?>

<h3><?php echo h($message['Message']['title']); ?><h3>
<h2><?php echo "From: " . h($message['Message']['sender_id']); ?><h2>
<h1><?php echo "Sent time: " . h($message['Message']['created']); ?><h1>
<p><?php echo h($message['Message']['body']); ?></p>

