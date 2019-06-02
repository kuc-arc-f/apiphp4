<div class="todos view">
<h2><?php echo __('Todo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($todo['Todo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($todo['Todo']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($todo['Todo']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Complete'); ?></dt>
		<dd>
			<?php echo h($todo['Todo']['complete']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uid'); ?></dt>
		<dd>
			<?php echo h($todo['Todo']['uid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Up Date'); ?></dt>
		<dd>
			<?php echo h($todo['Todo']['up_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Todo'), array('action' => 'edit', $todo['Todo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Todo'), array('action' => 'delete', $todo['Todo']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $todo['Todo']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Todos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Todo'), array('action' => 'add')); ?> </li>
	</ul>
</div>
