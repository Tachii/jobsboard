<div class="users form">
<?php echo $this->Form->create($user); ?>
	<fieldset>
		<legend><?= __('Create New User'); ?></legend>
		<?php 
			echo $this->Form->input('first_name');
			echo $this->Form->input('last_name');
			echo $this->Form->input('email',array('type'=>'email'));
			echo $this->Form->input('username');
			echo $this->Form->input('password',array('type'=>'password'));
			echo $this->Form->input('confirm_password',array('type'=>'password'));
			echo $this->Form->input('role',array(
									'type' => 'select',
									'options' => ['Employer'=>'Employer','Job Seeker'=>'Job Seeker'],
									'empty' => 'Select Role'
									));	
		?>
	</fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>