<?php
$start=21;
$t32 = explode('[|]',$dataarray[32]); if(defined($t32[0])) $t32[0]=constant($t32[0]); for($i=1;$i<count($t32);$i++) $t32[0].=$t32[$i];
$dataarray[32] = $t32[0];
?>	
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<td class="role">
				<div class="boxes boxesColor green">
					<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
					<div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
					<div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
					<div class="boxes-contents">
						<div class="role"><?php echo REPORT_DEFENDER; ?></div>
					</div>
				</div>
			</td>
            <td class="troopHeadline" colspan="<?php if($dataarray[93]){ echo '11'; }else{ echo '10'; } ?>">
				<?php
				if($targettribe=='3'){
					echo '<a href="spieler.php?uid='.$database->getUserField($dataarray[30],"id",0).'">';
					echo $database->getUserField($dataarray[30],"username",0);
					echo '</a> '.REPORT_FROM_VIL.' <a href="karte.php?d='.$dataarray[31].'&amp;c='.$generator->getMapCheck($dataarray[31]).'">
					'.stripslashes($dataarray[32]).'</a>';
				} else {
					echo REPORT_REINF;
				}
				?>
            </td>
		</tr>
	</thead>
    <tbody class="units">
		<tr>
			<th class="coords"></th>
			<?php
			for($i=$start;$i<=($start+9);$i++) {
				if($i==($start+9) && !$dataarray[93]){ $last = ' last'; }else{ $last = ''; }
				echo "<td class=\"uniticon".$last."\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
			}
			if($dataarray[93]){
				echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" alt=\"".$technology->getUnitName(51)."\" /></td>";
			}
			?>
		</tr>
	</tbody>
	<tbody class="units">
		<tr>
			<th><?php echo REPORT_TROOPS; ?></th>
			<?php
			$type = $database->getNotice2($_GET['id'], 'ntype');
			if (($type == 3)||($type == 17)) $attackerFailed = true; else $attackerFailed = false;
			for($i=83;$i<=92;$i++) {
				if($i==92 && !$dataarray[93]){ $last = ' last'; }else{ $last = ''; }
				if($dataarray[$i] == 0) {
					echo "<td class=\"unit none ".$last."\">".($attackerFailed?'?':0)."</td>";
				} else {
					echo "<td class=\"unit".($attackerFailed?' none ':'').$last."\">".($attackerFailed?'?':$dataarray[$i])."</td>";
				}
			}
			if($dataarray[93]) {
				echo "<td class=\"unit ".($attackerFailed?' none ':'')." last\">".($attackerFailed?'?':$dataarray[93])."</td>";
			}
			?>
		</tr>
	</tbody>
	<tbody class="units last">
		<tr>
			<th><?php echo REPORT_CASUALTIES; ?></th>
			<?php
			for($i=94;$i<=103;$i++) {
				if($i==103 && !$dataarray[93]){ $last2 = ' last'; }else{ $last2 = ''; }
				if($dataarray[$i] == 0) {
					echo "<td class=\"unit none ".$last2."\">".($attackerFailed?'?':0)."</td>";
				} else {
					echo "<td class=\"unit".($attackerFailed?' none ':'').$last2."\">".($attackerFailed?'?':$dataarray[$i])."</td>";
				}
			}
			if($dataarray[93]) {
				if($dataarray[104] == 0) {
					echo "<td class=\"unit none last\">".($attackerFailed?'?':0)."</td>";
				} else {
					echo "<td class=\"unit ".($attackerFailed?' none ':'')." last\">".($attackerFailed?'?':$dataarray[104])."</td>";
				}
			}
			?>
		</tr>
	</tbody>
</table>
