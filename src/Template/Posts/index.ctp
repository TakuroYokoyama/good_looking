<div class="wrapper">
	<?php
	$i = 0;
	foreach ($list as $obj): $i++; ?>
		<div class="index_img">
			<?=$this->Html->image("$obj.jpg", [
				'url' => ['controller' => 'Posts', 'action' => 'vote?value='.$obj]
				]); ?>
		</div>
	<?php endforeach; ?>
</div>
