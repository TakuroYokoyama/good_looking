<!DOCTYPE html>
<html lang="ja">
<head>
	<?= $this->Html->charset(); ?>
	<title>
		<?= $this->fetch('title') ?>
	</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
	<?php
	echo $this->Html->css('post');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?= $this->Html->image('logo.png', array('id'=>'title_logo')); ?>
		</div>
	</div>
	<div id="content">
		<?= $this->Flash->render() ?>
		<?= $this->fetch('content') ?>
	</div>
	<div id="footer"></div>
</body>
</html>
