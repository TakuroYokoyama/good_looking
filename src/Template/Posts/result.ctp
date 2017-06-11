<div>
	<h2></h2>
	<table>
		<tbody>
				<tr>
					<td class="index_img">
						<div class='result_img' style="background-image : url('/img/1.jpg');width: 300px;height: 480px;">
						<?php foreach ($img[1] as $obj1): ?>
							<img src="/img/heart.gif" style="position:absolute;top: <?=$obj1->roc_y ?>px;left: <?=$obj1->roc_x ?>px;" >
						<?php endforeach; ?>
						</div>
					</td>
					<td class="index_img">
						<div class='result_img' style="background-image : url('/img/2.jpg');width: 300px;height: 480px;">
						<?php foreach ($img[2] as $obj2): ?>
							<img src="/img/heart.gif" style="position:absolute;top: <?=$obj2->roc_y ?>px;left: <?=$obj2->roc_x ?>px;" >
						<?php endforeach; ?>						
						</div>
					</td>
					<td class="index_img">
						<div class='result_img' style="background-image : url('/img/3.jpg');width: 300px;height: 480px;">
						<?php foreach ($img[3] as $obj3): ?>
							<img src="/img/heart.gif" style="position:absolute;top: <?=$obj3->roc_y ?>px;left: <?=$obj3->roc_x ?>px;" >
						<?php endforeach; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td class="count">
						<?=$count[1] ?>
					</td>
					<td class="count">
						<?=$count[2] ?>
					</td>
					<td class="count">
						<?=$count[3] ?>
					</td>					
				</tr>
				<tr>
					<td class="index_img">
						<div class='result_img' style="background-image : url('/img/4.jpg');width: 300px;height: 480px;">
						<?php foreach ($img[4] as $obj4): ?>
							<img src="/img/heart.gif" style="position:absolute;top: <?=$obj4->roc_y ?>px;left: <?=$obj4->roc_x ?>px;" >
						<?php endforeach; ?>

						</div>
					</td>
					<td class="index_img">
						<div class='result_img' style="background-image : url('/img/5.jpg');width: 300px;height: 480px;">
						<?php foreach ($img[5] as $obj5): ?>
							<img src="/img/heart.gif" style="position:absolute;top: <?=$obj5->roc_y ?>px;left: <?=$obj5->roc_x ?>px;" >
						<?php endforeach; ?>						
						</div>
					</td>
					<td class="index_img">
						<div class='result_img' style="background-image : url('/img/6.jpg');width: 300px;height: 480px;">
						<?php foreach ($img[6] as $obj6): ?>
							<img src="/img/heart.gif" style="position:absolute;top: <?=$obj6->roc_y ?>px;left: <?=$obj6->roc_x ?>px;" >
						<?php endforeach; ?>						
						</div>
					</td>
				</tr>
				<tr>
					<td class="count">
						<?=$count[4] ?>
					</td>
					<td class="count">
						<?=$count[5] ?>
					</td>
					<td class="count">
						<?=$count[6] ?>
					</td>					
				</tr>

		</tbody>
	</table>
</div>