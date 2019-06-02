<div class="repos index">
	<h2><?php echo __('Repos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('uid'); ?></th>
			<th><?php echo $this->Paginator->sort('up_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($repos as $repo): ?>
	<tr>
		<td><?php echo h($repo['Repo']['id']); ?>&nbsp;</td>
		<td><?php echo h($repo['Repo']['name']); ?>&nbsp;</td>
		<td><?php echo h($repo['Repo']['content']); ?>&nbsp;</td>
		<td><?php echo h($repo['Repo']['url']); ?>&nbsp;</td>
		<td><?php echo h($repo['Repo']['uid']); ?>&nbsp;</td>
		<td><?php echo h($repo['Repo']['up_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $repo['Repo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $repo['Repo']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $repo['Repo']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $repo['Repo']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Repo'), array('action' => 'add')); ?></li>
	</ul>
</div>
