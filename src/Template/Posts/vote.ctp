
<div class="vote_img">
<div id='target' style="background-image : url(/img/<?=$imgpath?>);width: 300px;height: 480px;">
<img src="/img/heart.gif" id="myIMG" style="position:absolute;top:1px;left:1px;" />
</div>
</div>
<div>
	<br>
	<?=$this->Form->create($entity,['url'=>['action'=>'addRecord']]) ?>
	<?=$this->Form->hidden('person_no',array('id'=>'person_no', 'value'=>$person_no)) ?>
	<?=$this->Form->hidden('roc_x', array('id'=>'roc_x', 'value'=>'0')) ?>
	<?=$this->Form->hidden('roc_y', array('id'=>'roc_y', 'value'=>'0')) ?>
	<?=$this->Form->button("投票する") ?>
	<?=$this->Form->end() ?>
</div>