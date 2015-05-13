<?php echo $this->Form->create($job); ?>
	<fieldset>
		<legend><?= __('Edit Job Listing'); ?></legend>
		<?php 
			echo $this->Form->input('title');
			echo $this->Form->input('company_name');
			echo $this->Form->input('category_id',array(
									'type' => 'select',
									'options' => $categories,
									'empty' => 'Select Category'
									));	
			echo $this->Form->input('type_id',array(
									'type' => 'select',
									'options' => $types,
									'empty' => 'Select Type'
									));	
			echo $this->Form->input('description', array('type' => 'textarea'));
			echo $this->Form->input('city');
			echo $this->Form->input('contact_email');	
		?>
	</fieldset>
<?php 
	echo $this->Form->button('Add');
	$this->Form->end(); 
?>