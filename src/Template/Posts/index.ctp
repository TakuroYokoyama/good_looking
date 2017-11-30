<div class="wrapper">
	<h2></h2>
	<table>
		<tbody>
			<?php
			$i = 0;
			foreach ($list as $obj):
			$i++; ?>
			<?php
			if((($i + 4) % 4) == 1 ) {
				echo "<tr>";
			}; ?>
				<td class="index_img">
					<a href=/posts/vote?value=<?=$obj ?>> <img src=/img/<?=$obj ?>.jpg>
				</td>
			<?php
			if((($i % 4) == 0) || ($obj === end($list))) {
            	echo "</tr>";
            };
			?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
