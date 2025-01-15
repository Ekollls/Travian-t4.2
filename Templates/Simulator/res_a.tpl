<?php
$tribe = $_POST['result']['had']['attacker']['tribe'];
$start = ($tribe-1)*10 + 1;$end = $tribe*10;
?>
<div class="fighterType">
	<div class="boxes boxesColor red">
		<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
		<div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
		<div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
		<div class="boxes-contents"><?php echo REPORT_ATTACKER.': '.constant('TRIBE'.$tribe)?></div>
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
				$u = $_POST['result']['had']['attacker']['u'.$i];
				if (isset($u)&& $u!=0&& $u!='')echo '<td>'.$u.'</td>';	else echo '<td class="none">0</td>';
			}
			?>
		</tr>
		<tr>
			<th><?php echo REPORT_CASUALTIES;?></th>
			<?php
			for($i=$start;$i<=$end;$i++){
				$u = $_POST['result']['casualties']['attacker']['u'.$i]; if (isset($u)&& $u!=0&& $u!='') echo '<td>'.$u.'</td>'; else echo '<td class="none">0</td>';
			}
			?>
		</tr>
	</tbody>
</table>
<?php
if ($_POST['attack_type']==3 && $_POST['ctar1']>0){ //cata
	$catapultArray = array(8,18,28,38,48);
	$catp_pic = $catapultArray[$tribe-1];
	$build_pic = $_POST['result']['casualties']['defender']['ctar'][0]['ft'];
?>
	<table class="results attacker" cellpadding="1" cellspacing="1">
		<tbody class="goods">
			<tr>
				<td colspan="11">
					<?php echo REPORT_INFORMATION; ?>
					<img class="unit u<?php echo $catp_pic; ?>" src="img/x.gif" alt="<?php echo constant('U'.$catp_pic); ?>" title="<?php echo constant('U'.$catp_pic); ?>" />
					<img class="unit ucata" src="img/x.gif" />
					<?php echo sprintf(REPORT_BUILDINGDAMAGED,WARSIM_CTAR1
										,$_POST['result']['had']['defender']['ctar'][0]['lvl']
										, $_POST['result']['had']['defender']['ctar'][0]['lvl']-$_POST['result']['casualties']['defender']['ctar'][0]['lvl']); ?>
				</td>
			</tr>
		</tbody>
	</table>
<?php }
if ($_POST['attack_type']==3 && $_POST['wall']>0){ //cata
	$ramArray = array(7,17,27,37,47);
	$ram_pic = $ramArray[$_POST['result']['had']['defender']['tribe']-1];
	switch ($_POST['result']['had']['defender']['tribe']){
		case 1: $title = B31;$class = "g31Icon"; break;
		case 2: case 4: case 5: $title = B32;$class = "g32Icon"; break;
		case 3: $title = B33;$class = "g33Icon"; break;
	}
?>
	<table class="results attacker" cellpadding="1" cellspacing="1">
		<tbody class="goods">
			<tr>
				<td colspan="11">
					<?php echo REPORT_INFORMATION; ?>
					<img class="unit u<?php echo $ram_pic; ?>" src="img/x.gif" alt="<?php echo $technology->unarray[$ram_pic]; ?>" title="<?php echo $technology->unarray[$ram_pic]; ?>" />
					<img class="unit <?php echo $class;?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="img/x.gif" />
					<?php echo sprintf(REPORT_WALLDAMAGEDED,$_POST['result']['had']['defender']['wall']
										, $_POST['result']['had']['defender']['wall']-$_POST['result']['casualties']['defender']['wall']); ?>
				</td>
			</tr>
		</tbody>
	</table>
<?php }
$participants = $_POST['result']['had']['participants'];
if (count($participants)>0){
	$participantsCount = count($participants);
	for($pc=0;$pc<$participantsCount;$pc++){
		$tribe = $_POST['result']['had']['participants'][$pc]['tribe'];
		$start = ($tribe-1)*10 + 1;
		$end = $tribe*10;
		?>
		<div class="fighterType">
			<div class="boxes boxesColor red">
				<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
				<div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
				<div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
				<div class="boxes-contents"><?php echo REPORT_PARTICIPANT.': '.constant('TRIBE'.$tribe)?></div>
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
						$u = $_POST['result']['had']['participants'][$pc]['u'.$i];
						if (isset($u)&& $u!=0&& $u!='')echo '<td>'.$u.'</td>';	else echo '<td class="none">0</td>';
					}
					?>
				</tr>
				<tr>
					<th><?php echo REPORT_CASUALTIES;?></th>
					<?php
					for($i=$start;$i<=$end;$i++){
						$u = $_POST['result']['casualties']['participants'][$pc]['u'.$i];
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