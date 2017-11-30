
<div class="vote_img">
<div id='target' style="background-image : url(/img/<?=$imgpath?>);width: 300px;height: 480px;">
</div>
</div>
<div class="vote_bottom">
	<?=$this->Form->create($entity,['url'=>['action'=>'addRecord']]) ?>
	<?=$this->Form->hidden('person_no',array('id'=>'person_no', 'value'=>$person_no)) ?>
	<?=$this->Form->hidden('roc_x', array('id'=>'roc_x', 'value'=>'0')) ?>
	<?=$this->Form->hidden('roc_y', array('id'=>'roc_y', 'value'=>'0')) ?>
	<?=$this->Form->button('投票する！', array('class'=>'btn btn-danger center-block')) ?>
	<?=$this->Form->end() ?>
	<?=$this->Form->create('',['url'=>['action'=>'index']]) ?>
	<?=$this->Form->button('考え直す',array('class'=>'btn btn-info center-block')) ?>
	<?=$this->Form->end() ?>
</div>
