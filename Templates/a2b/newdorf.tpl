<?php

$founder = $database->getVillage($village->wid);
$newvillage = $database->getMInfo($_GET['id']);
$eigen = $database->getCoor($village->wid);
$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
$to = array('x'=>$newvillage['x'], 'y'=>$newvillage['y']);
$time = $generator->procDistanceTime($from,$to,3,0);

echo '<pre>';
//print_r($founder);
echo '</pre>';
?>

<h1><?php echo EXPAND;?></h1>
<!--<p>De kolonisten kunnen nog niet vertrekken.<br> Voor het stichten van een nieuw dorp is er nog 750 grondstoffen hout, klei, ijzer en graan nodig.</p>-->
				<form method="POST" action="build.php">
				<input type="hidden" name="a" value="new" />
				<input type="hidden" name="c" value="5" />
				<input type="hidden" name="s" value="<?php echo $_GET['id']; ?>" />
				<input type="hidden" name="id" value="39" />
				<input type="hidden" name="timestamp" value="<?php echo time()+$time ?>" />
		<table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $founder['0']; ?>&c=<?php echo $generator->getMapCheck($founder['0']); ?>"><?php echo $database->getUserField($session->uid,'username',0); ?></a></td><td colspan="10"><a href="karte.php?d=<?php echo $newvillage['id']; ?>&c=<?php echo $generator->getMapCheck($newvillage['0']) ?>"> <?php echo NEWVILLAGE;?> (<?php echo $newvillage['x']; ?>|<?php echo $newvillage['y']; ?>)</a></td>
		</tr>
	</thead>
	<tbody class="units">
		<tr>
			<th>&nbsp;</th>
				<?php for($i=($session->tribe-1)*10+1;$i<=$session->tribe*10;$i++) {
					echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
				} ?>
		</tr>
		<tr>
			<th><?php echo TROOPS;?></th>
				<?php for($i=1;$i<=9;$i++) {
					echo "<td class=\"none\">0</td>";
				} ?>
				<td>3</td>
		</tr>
	</tbody>
	<tbody class="infos">
		<tr>
			<th><?php echo DURATION;?></th>
				<td colspan="10"><img class="clock" src="img/x.gif" alt="<?php echo DURATION;?>" title="<?php echo DURATION;?>" /> <?php echo $generator->getTimeFormat($time); ?></td>
		</tr>
	</tbody>
	<tbody class="infos">
		<tr>
			<th><?php echo RESOURCES;?></th>
				<td colspan="10">
				<img class="r1" src="img/x.gif" alt="<?php echo WOOD;?>" title="<?php echo WOOD;?>" /> 750 | 
				<img class="r2" src="img/x.gif" alt="<?php echo CLAY;?>" title="<?php echo CLAY;?>" /> 750 | 
				<img class="r3" src="img/x.gif" alt="<?php echo IRON;?>" title="<?php echo IRON;?>" /> 750 | 
				<img class="r4" src="img/x.gif" alt="<?php echo CROP;?>" title="<?php echo CROP;?>" /> 750 </td>
		</tr>
	</tbody>
</table>

<p class="button">
<?php
$mode = CP; 
$total = count($database->getProfileVillages($session->uid)); 
$need_cps = ${'cp'.$mode}[$total];
$cps = $database->getUserField($session->uid, 'cp',0);
$wood = round($village->awood);
$clay = round($village->aclay);
$iron = round($village->airon);
$crop = round($village->acrop);
if($cps >= $need_cps) {
	if($wood>=750 && $clay>=750 && $iron>=750 && $crop>=750){
?>

<button type="submit" value="ok" name="s1" id="btn_ok"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo NEWVILLAGE;?></div></div></button>
<?php
	}else {
		echo "<span class=\"none\">".LOWRESTOEXPAND."</span>";
	}
} else {
  print "<span class=\"none\">$cps/$need_cps ".CULTUREPOINTS."</span>";
}
?>
</form>
</p>



