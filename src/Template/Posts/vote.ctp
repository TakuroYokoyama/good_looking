<div class="vote_img">
<div id='target' style="background-image : url(/img/<?=$imgpath?>);width: 300px;height: 480px;">
<img src="/img/heart.gif" id="myIMG" style="position:absolute;top:1px;left:1px;" />
</div>
</div>
<div class="vote_bottom" align= "center" >
	<?=$this->Form->create($entity,['url'=>['action'=>'addRecord']]) ?>
	<?=$this->Form->hidden('person_no',array('id'=>'person_no', 'value'=>$person_no)) ?>
	<br>
	<p>あなたのイニシャル・性別・学校名を入力してください</p>
	<div>
		<p>
		姓:
		<?php
			echo $this->Form->select('f_name',
			['A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D', 'E'=>'E', 'F'=>'F', 'G'=>'G', 'H'=>'H', 'I'=>'I', 'J'=>'J', 'K'=>'K', 'L'=>'L', 'M'=>'M', 'N'=>'N', 'O'=>'O', 'P'=>'P', 'Q'=>'Q', 'R'=>'R', 'S'=>'S', 'T'=>'T', 'U'=>'U', 'V'=>'V', 'W'=>'W', 'X'=>'X', 'Y'=>'Y', 'Z'=>'Z'],
			array('default' => 'A'));
		?>
		名:
		<?php
			echo $this->Form->select('l_name',
			['A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D', 'E'=>'E', 'F'=>'F', 'G'=>'G', 'H'=>'H', 'I'=>'I', 'J'=>'J', 'K'=>'K', 'L'=>'L', 'M'=>'M', 'N'=>'N', 'O'=>'O', 'P'=>'P', 'Q'=>'Q', 'R'=>'R', 'S'=>'S', 'T'=>'T', 'U'=>'U', 'V'=>'V', 'W'=>'W', 'X'=>'X', 'Y'=>'Y', 'Z'=>'Z'],
			array('default' => 'A'));
		?>
		</p>
		<?php
		$options = array('0'=>'男性', '1'=>'女性');
		echo $this->Form->radio('gender',$options,array('legend' => false,'default' => '0'));
		?>
		<p>学校名:<?=$this->Form->text('univ', array('id'=>'univ', 'required aria-required'=>'true', 'errormessage'=>'学校名を入力して下さい。')) ?></p>
		<?php $date = date("Y/m/d H:i:s"); ?>
		<?=$this->Form->hidden('date', array('id'=>'date', 'value'=>$date)) ?>
		<?=$this->Form->hidden('roc_x', array('id'=>'roc_x', 'value'=>'0')) ?>
		<?=$this->Form->hidden('roc_y', array('id'=>'roc_y', 'value'=>'0')) ?>
		<?=$this->Form->button('投票する！', array('class'=>'btn btn-danger center-block')) ?>
		<?=$this->Form->end() ?>
		<?=$this->Form->create('',['url'=>['action'=>'index']]) ?>
		<?=$this->Form->button('考え直す',array('class'=>'btn btn-info center-block')) ?>
		<?=$this->Form->end() ?>
	</div>
</div>
