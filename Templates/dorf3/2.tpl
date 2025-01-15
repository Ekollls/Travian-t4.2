<?php
include('menu.tpl');
?>
<table id="ressources" cellpadding="1" cellspacing="1">
<thead>
<tr>
<td> <?php echo VILLAGE;?> </td><td><img class="r1" src="img/x.gif" title="" alt=""></td><td><img class="r2" src="img/x.gif" title="" alt=""></td><td><img class="r3" src="img/x.gif" title="" alt=""></td><td><img class="r4" src="img/x.gif" title="" alt=""></td><td> <?php echo MERCHANTS;?> </td>
</tr></thead><tbody>
<?php
$woodSUM = $claySUM = $ironSUM = $cropSUM = 0;
$varray = $database->getProfileVillages($session->uid);  
foreach($varray as $vil){  
	$vid = $vil['wref'];
	$vdata = $database->getVillage($vid);   
	$totalmerchants = $building->getTypeLevel(17,$vid);
	$availmerchants = $totalmerchants - $database->totalMerchantUsed($vid);
	if($vdata['wood'] > $vdata['maxstore']) { $wood = $vdata['maxstore']; } else { $wood = $vdata['wood']; }
	if($vdata['clay'] > $vdata['maxstore']) { $clay = $vdata['maxstore']; } else { $clay = $vdata['clay']; }
	if($vdata['iron'] > $vdata['maxstore']) { $iron = $vdata['maxstore']; } else { $iron = $vdata['iron']; }
	if($vdata['crop'] > $vdata['maxcrop'] ) { $crop = $vdata['maxcrop'];  } else { $crop = $vdata['crop']; }
	if($vdata['capital'] == 1){$class = 'hl';}else{$class = 'hover';}
	$vname = $vdata['name'];
	if(defined($vname)) $vname = constant($vname);
	echo '
	<tr class="'.$class.'"> 
		<td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.$vname.'</a></td>
		<td class="lum">'.number_format(round($wood)).'</td>
		<td class="clay">'.number_format(round($clay)).'</td>
		<td class="iron">'.number_format(round($iron)).'</td>
		<td class="crop">'.number_format(round($crop)).'</td>
		<td class="tra lc">'.($totalmerchants>0?'<a href="build.php?newdid='.$vid.'&amp;gid=17">':'').$availmerchants.'/'.$totalmerchants.'</a></td>  
	</tr>
	';
	$woodSUM += $wood;  
	$claySUM += $clay;
	$ironSUM += $iron;
	$cropSUM += $crop;
}
?>

<tr><td colspan="6" class="empty"></td></tr>
<tr class="sum"><th> <?php echo TOTAL;?> </th><td class="lum"><?php echo number_format(round($woodSUM));?></td>
<td class="clay"><?php echo number_format(round($claySUM));?></td>
<td class="iron"><?php echo number_format(round($ironSUM));?></td>
<td class="crop"><?php echo number_format(round($cropSUM));?></td>
<td class="tra">&nbsp;</td>
</tr></tbody></table>
