<div>
	<h2></h2>
	<table cellspacing="40px">
		<tbody>
			<?php foreach ($list as $obj): ?>
			<?php
			if((($obj + 3) % 3) == 1 ) {
				echo "<tr>";
			}; ?>
				<td class="index_img">
					<a href=/posts/vote?value=<?=$obj ?>> <img src=/img/<?=$obj ?>.jpg>
				</td>
			<?php
			if(($obj % 3) == 0 ) {
				echo "</tr>";
			}; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>