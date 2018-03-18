<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="/css/nomalize.css" rel="stylesheet">
<link href="/css/login.css" rel="stylesheet">
<title>ログイン</title>
</head>
<body>
	<div class="login">
		<?= $this->Form->create("login",['url'=>['action'=>'login', 'type'=>'post'], "class"=>"loginContainer"]) ?>
			<h1 class="loginHeader">ログイン</h1>
				<?php if($this->request->is('post')): ?>
					<p><?= $loginErrMessage ?></p>
				<?php endif; ?>
				<div class="inputForm">
					<?= $this->Form->input("id",["type"=>"text", "label"=>"ID："]); ?>
					<?=	$this->Form->input("pass",["type"=>"password", "label"=>"password："]);?>
				</div>
				<?=	$this->Form->button('Login');?>
		<?= $this->Form->end(); ?>
	</div>
</body>
</html>