<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>社員登録/変更</title>
</head>
<body>
<div>
    <h3><?= $title ?></h3>
    <p><?= $message ?></p>
    <div>
		<?=$pass ?>
	</div>
	<div>
	    <div>
	 		<?= $this->Form->create($entity, ['enctype' => 'multipart/form-data', 'type' => 'file', 'url' => ['action' => 'addEmployeeRecord']]) ?>
	 		<?= $this->Form->input('person_no',array('id'=>'person_no','type'=>'number','label'=>'社員番号:','default' => $id)) ?>
			<?= $this->Form->input('name_initial',array('id'=>'name_initial','type'=>'text','label'=>'イニシャル:','default' => $name)) ?>
			<?= $this->Form->hidden('del_flg',array('id'=>'del_flg','value'=>'0')) ?>
			<?= $this->Form->file('UploadData') ?>
			<br>
			<?= $this->Form->button('登録') ?>
			<?= $this->Form->end() ?>
			</form>
		</div>
		<div>
			<?php
				if($id != null){
			 		echo $this->Form->create($entity, ['enctype' => 'multipart/form-data','type' => 'file', 'url' => ['action' => 'delEmployeeRecord']]); 
			 		echo $this->Form->hidden('person_no',array('id'=>'person_no','value'=> $id));
			 		echo $this->Form->button('削除');
					echo $this->Form->end();
				}
			?>
			</form>
		</div>
	</div>
</div>
</body>
</html>