<div class="repos form">
<?php echo $this->Form->create('Repo'); ?>
	<fieldset>
		<legend><?php echo __('Add Repo'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('content');
		echo $this->Form->input('url');
		echo $this->Form->input('uid');
		echo $this->Form->input('up_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Repos'), array('action' => 'index')); ?></li>
	</ul>
</div>
