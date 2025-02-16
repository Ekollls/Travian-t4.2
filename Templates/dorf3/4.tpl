<?php
include('menu.tpl');
?>
<table id="culture_points" cellpadding="1" cellspacing="1">
<thead>
<tr><td> <?php echo VILLAGE;?> </td><td> <?php echo CULTUREPOINTS;?>/Day </td><td> <?php echo CELEBRATION;?> </td><td> <?php echo UNITS;?> </td><td> <?php echo SLOTS;?> </td></tr>
</thead>
<tbody>
<?php
$gesexp = $gesdorf = $gescp = $gessied = $gessen = 0;
$timer = 0;
$varray = $database->getProfileVillages($session->uid); 
foreach($varray as $vil){
	$vid = $vil['wref'];
	$cp = $database->getVillageField($vid, 'cp');
	$exp = 0;
	for($i=1;$i<=3;$i++) {
		${'slot'.$i} = $database->getVillageField($vid, 'exp'.$i);
		if(${'slot'.$i} != 0) { $exp++;	}
	}
	$lvlTH = $building->getTypeLevel(24,$vid);
	$lvlRes = $building->getTypeLevel(25,$vid);
	$lvlPal = $building->getTypeLevel(26,$vid);
	$maxslots = ($lvlRes>=10?floor($lvlRes/10):0)+($lvlPal>=10?floor(($lvlPal-5)/5):0);
	$hasCel = $database->getVillageField($vid,'celebration');
	if ($hasCel <> 0) { $timer++; }

	if($vil['capital'] == 1) { $class = 'hl'; } else {$class = 'hover'; }              
	$vname = $vil['name'];
	if(defined($vname)) $vname = constant($vname);
	echo '<tr class="'.$class.'"><td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.$vname.'</a></td>';
	echo '<td class="cps">'.$cp.'</td>';
	echo '<td class="cel">'.($lvlTH>0?'<a href="build.php?newdid='.$vid.'&amp;gid=24">'.($hasCel<>0?'<span id="timer'.$timer.'">'.$generator->getTimeFormat($hasCel-time()).'</span>':'<span class="dot">●</span>').'</a>':'<span class="none">-</span>').'</td>';
	echo '<td class="tro"><span class="">';
	$unit = $database->getUnit($vid);
	$tribe = $session->tribe;
	$siedler = $unit['u'.$tribe*10];
	$siedlerp = '<img src="img/un/u/'.($tribe*10).'.gif" title="تعداد: '.$gessied.'" />';
	$senator = $unit['u'.(($tribe-1)*10+9)];
	$senatorp = '<img src="img/un/u/'.(($tribe-1)*10+9).'.gif" title="تعداد: '.$gessen.'" />';
	$i=1;
	while($i <=$siedler) {
		echo $siedlerp;
		$i++;
	}
	$s=1;
	while($s <=$senator) {
		echo $senatorp;
		$s++;
	}		
		
	echo '</span></td>';
	echo '<td class="slo lc">'.$exp.'/'.$maxslots.'</td>';
	$gesexp = $gesexp + $exp;
	$gesdorf = $gesdorf + $maxslots;
	$gescp = $gescp + $cp;
	$gessied = $gessied + $siedler;
	$gessen = $gessen + $senator;
	echo '</tr>';    
}
?>

<tr><td colspan="5" class="empty"></td></tr>

<tr class="sum">
	<th class="vil"><?php echo TOTAL;?></th>
	<td class="cps"><?php echo $gescp;?></td>
	<td class="cel none">-</td>

	<td class="tro">
	<?php 	
	echo $siedlerp;
	echo '&nbsp;';
	echo $senatorp;
	?></td>
	<td class="slo"><?php echo $gesexp;echo '/';echo $gesdorf;?></td>
</tr></tbody></table>
