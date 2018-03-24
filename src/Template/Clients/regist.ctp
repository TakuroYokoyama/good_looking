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
			<script>
		    function submitChkadd() {
		        /* 確認ダイアログ表示 */
		        var flag = confirm ( "登録してもよろしいですか？\n\n送信したくない場合は[キャンセル]ボタンを押して下さい");
		        /* send_flg が TRUEなら送信、FALSEなら送信しない */
		        return flag;
		    }
			</script>
	 		<?= $this->Form->create($entity, ['enctype' => 'multipart/form-data', 'type' => 'file', 'url' => ['action' => 'addEmployeeRecord'],'onsubmit'=>"return submitChkadd()"]) ?>
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
			<script>
			 function submitChkdel() {
		        /* 確認ダイアログ表示 */
		        var flag = confirm ( "削除してもよろしいですか？\n\n削除したくない場合は[キャンセル]ボタンを押して下さい");
		        /* send_flg が TRUEなら送信、FALSEなら送信しない */
		        return flag;
		    }
		    </script>
			<?php
				if($id != null){
			 		echo $this->Form->create($entity, ['enctype' => 'multipart/form-data','type' => 'file', 'url' => ['action' => 'delEmployeeRecord'],'onsubmit'=>"return submitChkdel()"]); 
			 		echo $this->Form->hidden('person_no',array('id'=>'person_no','value'=> $id));
			 		echo $this->Form->hidden('del_flg',array('id'=>'del_flg','value'=> 1));
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