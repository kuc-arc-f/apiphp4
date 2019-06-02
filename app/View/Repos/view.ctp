<div class="repos view">
<h2><?php echo __('Repo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($repo['Repo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($repo['Repo']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($repo['Repo']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($repo['Repo']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uid'); ?></dt>
		<dd>
			<?php echo h($repo['Repo']['uid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Up Date'); ?></dt>
		<dd>
			<?php echo h($repo['Repo']['up_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Repo'), array('action' => 'edit', $repo['Repo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Repo'), array('action' => 'delete', $repo['Repo']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $repo['Repo']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Repos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Repo'), array('action' => 'add')); ?> </li>
	</ul>
</div>
