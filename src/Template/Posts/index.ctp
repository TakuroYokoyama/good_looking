<div class="wrapper">
	<p>投票したい人を選んでください</p>
	<div class="index_img">
	<?php foreach($list as $obj): ?>
			<?=$this->Html->image("$obj.jpg", [
				'url' => ['controller' => 'Posts', 'action' => 'vote?value='.$obj]
				]); ?>
	<?php endforeach; ?>
	</div>
</div>
