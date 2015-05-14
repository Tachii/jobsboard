<!DOCTYPE html>
<html>
<head>
<?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('kickstart') ?>
    <?= $this->Html->css('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') ?>
	<?= $this->Html->css('style') ?>
	<?= $this->Html->script('jquery') ?>
	<?= $this->Html->script('kickstart') ?>
	<?= $this->Html->script('jquery') ?>
	
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div id="container" class="grid">
	<header>
		<div class="col_6 column">
			<h1><a href="<?php echo $this->request->webroot; ?>"><strong>Job</strong>Board</a></h1>	
		</div>
		
	<!-- Loading Add New Job Element -->
	
	<?php
			echo $this->element('addJob');
	?>
	<br />
		
		
	</header>
	
	<div class="col_12 column">
		
		<!-- Menu Horizontal -->
		<ul class="menu">
		<li <?php echo ($this->request->here == '/' || $this->request->here == '/jobs')? 'class="current"' : '' ?>><a href="<?php echo $this->request->webroot; ?>"><i class="fa fa-home"> </i> Home</a></li>
		<li <?php echo ($this->request->here == '/jobs/browse')? 'class="current"' : '' ?>><a href="<?php echo $this->request->webroot; ?>jobs/browse"><i class="fa fa-search"> </i> Browse Jobs</a></li>
		<?php if(!isset($UserData)) : ?>
			<li <?php echo ($this->request->here == '/users/register')? 'class="current"' : '' ?>><a href="<?php echo $this->request->webroot; ?>users/register"><i class="fa fa-user"> </i> Register</a></li>
			<li <?php echo ($this->request->here == '/users/login')? 'class="current"' : '' ?>><a href="<?php echo $this->request->webroot; ?>users/login"><i class="fa fa-key"> </i> Login</a></li>
		<?php else : ?>
			<li <?php echo ($this->request->here == '/users/logout')? 'class="current"' : '' ?>><a href="<?php echo $this->request->webroot; ?>users/logout"><i class="fa fa-key"> </i> Logout</a></li>
		<?php endif ; ?>
		</ul>
	</div>
	
	<?php if(isset($UserData)) : ?>
	<div class="col_12 column">
		<?php echo "Welcome <strong>".$UserData['first_name']."</strong>!";   ?>
	</div>
	<?php endif ; ?>
	
	<!-- Loading Main Content -->
	<div class="col_12 column">
		<?php echo $this->Flash->render() ?>
		<?php echo $this->fetch('content'); ?>
	</div>
	
	<div class="clearfix"> </div>
	<footer>
		<p>Copyright <i class="fa fa-copyright"> </i> 2015 Gleb Zaveruha, All Rights Reserved</p>
	</footer>
	
</div> <!-- End Grid -->
</body>
</html>