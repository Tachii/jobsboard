<div id="category_block" style="padding-bottom: 55px;">
	<ul class="horizontal"> 
		<?php foreach($categories as $category) : ?>
			<li><?php echo $this->Html->link($category->name,array('action' => 'browse', $category->id));?></li>
		<?php endforeach ; ?>
	</ul>
</div>
