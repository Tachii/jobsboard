<!-- Loading Search Element -->
<?php echo $this->element('search'); ?>

<p>
	<h3>Latest Jobs</h3>
</p>
<ul id="listings">
	<?php foreach($jobs as $job) : ?> 
	<li>
		<div class="type">
			<span style="background: <?php echo $job->type->color; ?>">
				<?php echo $job->type->name; ?>
			</span>
		</div>
		<div class="Description">
			<h5><?php echo $job->title; ?> (<?php echo $job->city; ?>)</h5>
			<span id="list_date">
				<p>
				<?php echo $job->created->nice(); ?>
				</p>
			</span>
			<?php echo $this->Text->truncate($job->description,200,['ellipsis' => '...','exact' => false]); ?> 
			<br /><?php echo $this->Html->link('Read More',['controller' => 'jobs', 'action' => 'view', $job->id]); ?> <i class="fa fa-file-text"> </i> </a>
		</div>
	</li>
	<?php endforeach; ?>
</ul>