<div>
	<h2></h2>
	<table>
		<tbody>
				<tr>
					<td>
						<?= $this->Html->link($this->Html->image('1.jpg'),array('controller'=>'posts','action'=>'vote'),array('escape'=>false)); ?>
					</td>
					<td>
						<?= $this -> Html -> image('2.jpg'); ?>
					</td>
					<td>
						<?= $this -> Html -> image('3.jpg'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?= $this -> Html -> image('4.jpg'); ?>
					</td>
					<td>
						<?= $this -> Html -> image('5.jpg'); ?>
					</td>
					<td>
						<?= $this -> Html -> image('6.jpg'); ?>
					</td>
				</tr>
		</tbody>
	</table>
</div>