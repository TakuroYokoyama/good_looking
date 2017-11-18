<div id="vote_wrapper">
    <p>1.この人の顔の気に入ったところをタップ！ハートが移動します。</p>
    <p>2.下の「投票する！」ボタンをタップしてください。</p>
    <div class="vote_img">
        <div id='target' style="background-image : url(/img/<?=$imgpath?>);width: 300px;height: 480px;">
            <img src="/img/heart.gif" id="heart" style="position:absolute;top:1px;left:1px;" />
        </div>
    </div>
    <div class="vote_bottom">
        <?=$this->Form->create($entity,['url'=>['action'=>'addRecord']]) ?>
        <?=$this->Form->hidden('person_no',array('id'=>'person_no', 'value'=>$person_no)) ?>
        <?=$this->Form->hidden('roc_x', array('id'=>'roc_x', 'value'=>'0')) ?>
        <?=$this->Form->hidden('roc_y', array('id'=>'roc_y', 'value'=>'0')) ?>
        <?=$this->Form->button('投票する！', array('class'=>'btn btn-danger center-block')) ?>
        <?=$this->Form->end() ?>
    </div>
</div>
