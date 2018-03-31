<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/nomalize.css" rel="stylesheet">
<link href="/css/login.css" rel="stylesheet">
<title>管理画面</title>
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
				<?=	$this->Form->button('Login', array('class'=>'btn btn-primary center-block')) ?>
		<?= $this->Form->end(); ?>
	</div>
</body>
</html>