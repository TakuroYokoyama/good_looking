<!DOCTYPE html>
<html lang="ja">
<head>
	<?=$this->Html->charset(); ?>
	<title>
		<?=$this->fetch('title') ?>
	</title>
	<?php
	echo $this->Html->css('post');
	echo $this->Html->script('post');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header"></div>
	</div>
	<div id-"content">
		<?=$this->fetch('content') ?>
	</div>
	<div id="footer"></div>
</body>
</html>