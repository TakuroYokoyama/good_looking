<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ログイン</title>
</head>
<body>
<?= $this->Form->create("login",['url'=>['action'=>'login', 'type'=>'post']]) ?>
	<div class="login">
		<h1>ログイン</h1>
		<?php if($this->request->is('post')): ?>
			<p><?= $loginErrMessage ?></p>
		<?php endif; ?>
		<?= $this->Form->input("",["id"=>"id", "type"=>"text", "placeholder"=>"ID"]); ?>
		<?=	$this->Form->input("",["id"=>"pass", "type"=>"password", "placeholder"=>"password"]);?>
		<?=	$this->Form->button('Login');?>
	</div>
<?= $this->Form->end(); ?>
</body>
</html>