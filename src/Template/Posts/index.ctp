<div class="wrapper">
	<div class="logo_frame">
		<?=$this->Html->image('logo.gif', array('class'=>'center-block')); ?>
	</div>
	<h2></h2>
	<table>
		<tbody>
			<?php
			$i = 0;
			foreach ($list as $obj):
			$i++; ?>
			<?php
			if((($i + 3) % 3) == 1 ) {
				echo "<tr>";
			}; ?>
				<td class="index_img">
					<a href=/posts/vote?value=<?=$obj ?>> <img src=/img/<?=$obj ?>.jpg>
				</td>
			<?php
			if(($i % 3) == 0 ) {
				echo "</tr>";
			}; 
			?>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?=$this->Form->create('',['url'=>['action'=>'result']]) ?>
	<?=$this->Form->button('結果を見る',array('class'=>'btn btn-success center-block')) ?>
	<?=$this->Form->end() ?>
</div>