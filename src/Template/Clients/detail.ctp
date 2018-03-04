<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>社員詳細</title>
</head>
<body>
	<div id="detail_view">
		<div>
			<img src=/img/<?= $id ?>.jpg>
		</div>
		<div>
			<p>社員番号:<?= $id ?></p>
			<p>名前:<?= $name ?></p>
			<p>選択されて戻られた回数:<?= $return ?></p>
			<p>得票数:<?= $vote ?></p>
		</div>
	</div>
	<div>
		<?=$this->Form->create($entity,['url'=>['action'=>'regist']]) ?>
		<?=$this->Form->hidden('person_no', array('id'=>'person_no', 'value'=> $id)) ?>
		<?=$this->Form->button('編集する', array('class'=>'btn btn-danger center-block')) ?>
		<?=$this->Form->end() ?>
	</div>
</body>
</html>