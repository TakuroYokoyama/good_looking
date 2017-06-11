<div>

	<?= $this -> Html -> image('99.jpg'); ?>
	<br>
	<?=$this->Form->create($entity,['url'=>['action'=>'addRecord']]) ?>
	<?=$this->Form->hidden('person_no',array('value'=>'99')) ?>
	<?=$this->Form->hidden('roc_x', array('value'=>'1')) ?>
	<?=$this->Form->hidden('roc_y', array('value'=>'1')) ?>
	<?=$this->Form->button("投票する") ?>
	<?=$this->Form->end() ?>

</div>