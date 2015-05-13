<div class="col_12 column">
		<h3><?php echo $job->title; ?></h3>
		<ul>
			<li>
				<strong>Location:</strong> <?php echo $job->city; ?>
			</li>
			<li>
				<strong>Job Category:</strong> <?php echo $job->category->name; ?>
			</li>
			<li>
				<strong>Job Type:</strong> <?php echo $job->type->name; ?>
			</li>
			<li>
				<strong>Date Added:</strong> <?php echo $job->created->nice(); ?>
			</li>
			<li>
				<strong>Description:</strong> <p><?php echo $job->description; ?></p>
			</li>
			<li>
				<strong>Contact Email:</strong> <a href="<?php echo "mailto:".$job->contact_email; ?>"><?php echo $job->contact_email; ?></a>
			</li>
		</ul>
</div>
<p>
	<a class="button green" href="<?php echo $this->request->webroot ?>jobs">Back To Jobs</a>
</p>
<br/><br/><br/>
<?php
if($job->user_id == $UserData['id']){
	echo $this->Html->Link('Edit',	array('action'=>'edit', $job->id),
									array('class' => 'button blue'));
	echo $this->Form->postLink('Delete',	array('controller' => 'Jobs','action' => 'delete', $job->id),
										array('confirm' => 'Are You Sure?','class' => 'button red'));
}
?>