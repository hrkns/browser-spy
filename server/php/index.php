<?php
	$users = array_slice(scandir("db/users"), 2);
	?>
	<h3>:)</h3>	
	<ul>
	<?php
		foreach ($users as $key => $value) {
			?>
			<li>
			<a href = "collected.php?u=<?php echo $value;?>"><?php echo $value;?></a>
			</li>
			<?php
		}
	?>
	</ul>