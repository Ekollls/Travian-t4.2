<?php 
$tribe = $_POST['result']['had']['defender']['tribe'];
$start = ($tribe-1)*10 + 1;$end = $tribe*10;
?>
<div class="fighterType">
	<div class="boxes boxesColor green">
		<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
		<div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
		<div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
		<div class="boxes-contents"><?php echo REPORT_DEFENDER.': '.constant('TRIBE'.$tribe)?></div>
	</div>
</div>
<div class="clear"></div>
<table class="results defender" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role"></td>
			<?php
			for($i=$start;$i<=$end;$i++){echo '<td><img src="img/x.gif" class="unit u'.$i.'" alt="'.constant('U'.$i).'" title="'.constant('U'.$i).'"></td>';}
			?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th><?php echo REPORT_TROOPS;?></th>
			<?php
			for($i=$start;$i<=$end;$i++){
				$u = $_POST['result']['had']['defender']['u'.$i];
				if (isset($u)&& $u!=0&& $u!='')echo '<td>'.$u.'</td>';	else echo '<td class="none">0</td>';
			}
			?>
		</tr>
		<tr>
			<th><?php echo REPORT_CASUALTIES;?></th>
			<?php
			for($i=$start;$i<=$end;$i++){
				$u = $_POST['result']['casualties']['defender']['u'.$i]; if (isset($u)&& $u!=0&& $u!='') echo '<td>'.$u.'</td>'; else echo '<td class="none">0</td>';
			}
			?>
		</tr>
	</tbody>
</table>

<?php 
$enforces = $_POST['result']['had']['enforces'];
if (count($enforces)>0){
	$enforcesCount = count($enforces);
	for($ec=0;$ec<$enforcesCount;$ec++){
		$tribe = $_POST['result']['had']['enforces'][$ec]['tribe'];
		$start = ($tribe-1)*10 + 1;
		$end = $tribe*10;
		?>
		<div class="fighterType">
			<div class="boxes boxesColor green">
				<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
				<div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
				<div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
				<div class="boxes-contents"><?php echo REPORT_REINF.': '.constant('TRIBE'.$tribe)?></div>
			</div>
		</div>
		<div class="clear"></div>
		<table class="results attacker" cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<td class="role"></td>
					<?php
					for($i=$start;$i<=$end;$i++){echo '<td><img src="img/x.gif" class="unit u'.$i.'" alt="'.constant('U'.$i).'" title="'.constant('U'.$i).'"></td>';}
					?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th><?php echo REPORT_TROOPS;?></th>
					<?php
					for($i=$start;$i<=$end;$i++){
						$u = $_POST['result']['had']['enforces'][$ec]['u'.$i];
						if (isset($u)&& $u!=0&& $u!='')echo '<td>'.$u.'</td>';	else echo '<td class="none">0</td>';
					}
					?>
				</tr>
				<tr>
					<th><?php echo REPORT_CASUALTIES;?></th>
					<?php
					for($i=$start;$i<=$end;$i++){
						$u = $_POST['result']['casualties']['enforces'][$ec]['u'.$i];
						if (isset($u)&& $u!=0&& $u!='') echo '<td>'.$u.'</td>'; else echo '<td class="none">0</td>';
					}
					?>
				</tr>
			</tbody>
		</table>
		<?php
	}
}
?>