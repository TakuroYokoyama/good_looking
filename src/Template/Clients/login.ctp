<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ログイン</title>
</head>
<body>
<?= $this->Form->create("login",['url'=>['action'=>'login', 'type'=>'post']]) ?>
	<h1>ログイン</h1>
	<?php if($this->request->is('post')): ?>
		<p><?= $loginErrMessage ?></p>
	<?php endif; ?>
	<?= $this->Form->input('id',["type"=>"text","label"=>"ID:"]); ?>
	<?=	$this->Form->input("pass",["type"=>"password","label"=>"パスワード:"]);?>
	<?=	$this->Form->button('Login');?>
<?= $this->Form->end(); ?>
</body>
</html>