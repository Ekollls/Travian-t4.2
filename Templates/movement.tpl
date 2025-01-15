<?php
$vm['v341'] = $database->getMovement(34,$village->wid,1); if(!is_array($vm['v341'])) $vm['v341'] = array();
$vm['v31'] = $database->getMovement(3,$village->wid,1); if(!is_array($vm['v31'])) $vm['v31'] = array();
$vm['v30'] = $database->getMovement(3,$village->wid,0); if(!is_array($vm['v30'])) $vm['v30'] = array();
$vm['v90'] = $database->getMovement(9,$village->wid,0); if(!is_array($vm['v90'])) $vm['v90'] = array();
$vm['v50'] = $database->getMovement(5,$village->wid,0); if(!is_array($vm['v50'])) $vm['v50'] = array();

$list['extra'] = 'distance<4.9497474683058326708059105347339';
$order['by'] = 'distance';
$coor = $database->getCoor($village->wid);
$order['x'] = $coor['x'];
$order['y'] = $coor['y'];
$order['max'] = 2 * WORLD_MAX + 1;
$oasats = $database->getVillageOasis($list,30,$order);
foreach($oasats as $os){
	if ($os['owner']==$session->uid){
		$vm['o341'] = $database->getMovement(34,$os['wref'],1); if(!is_array($vm['o341'])) $vm['o341'] = array();
		$vm['o31'] = $database->getMovement(3,$os['wref'],1); if(!is_array($vm['o31'])) $vm['o31'] = array();
		$vm['o30'] = $database->getMovement(3,$os['wref'],0); if(!is_array($vm['o30'])) $vm['o30'] = array();
		$vm['o90'] = $database->getMovement(9,$os['wref'],0); if(!is_array($vm['o90'])) $vm['o90'] = array();
		$vm['o50'] = $database->getMovement(5,$os['wref'],0); if(!is_array($vm['o50'])) $vm['o50'] = array();
	}
}
if(!isset($vm['o341']) || !is_array($vm['o341'])) $vm['o341'] = array();
if(!isset($vm['o31']) || !is_array($vm['o31'])) $vm['o31'] = array();
if(!isset($vm['o30']) || !is_array($vm['o30'])) $vm['o30'] = array();
if(!isset($vm['o90']) || !is_array($vm['o90'])) $vm['o90'] = array();
if(!isset($vm['o50']) || !is_array($vm['o50'])) $vm['o50'] = array();
$aantal = 0;
foreach($vm as $v){ if (!empty($v)){ $aantal+= count($v); } }
if($aantal != "") { $class = ''; } else { $class = 'hide'; }
?>
<div class="movements <?php echo $class ?>">
	<div class="boxes villageList movements">
		<div class="boxes-tl"></div>
		<div class="boxes-tr"></div>
		<div class="boxes-tc"></div>
		<div class="boxes-ml"></div>
		<div class="boxes-mr"></div>
		<div class="boxes-mc"></div>
		<div class="boxes-bl"></div>
		<div class="boxes-br"></div>
		<div class="boxes-bc"></div>
		<div class="boxes-contents cf">
			<table id="movements" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<th colspan="3">
							<?php echo TROOP_MOVEMENTS; ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						/* attack/raid on you! */
						$waves = array_merge($vm['v31'],$vm['o31']);//$database->getMovement(3,$village->wid,1);
						$waveCount = count($waves);
						for($i=0;$i<$waveCount;$i++){
							if($i>=0 && $waves[$i]['attack_type'] <= 2){
								$waveCount -= 1;
								array_splice($waves, $i, 1);
								$i--;
							}
						}
						if($waveCount > 0){
							$action = 'att1';
							$aclass = 'a1';
							$title = ''.ARRIVING_ATTACKING_TROOPS.'';
							$short = ''.ATTACK.'';
							$receive = $waves[0];
							echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'
								.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'
								.$aclass.'">&raquo;</span></td><td><div class="mov"><span class="'
								.$aclass.'">'.$waveCount.'&nbsp;'.$short.'</span></div><div class="dur_r">&nbsp;<span id="timer'
								.$timer.'">'.$generator->getTimeFormat($receive['endtime']-time())
								.'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
							$timer += 1;
						}
						/* Units send to reinf. (to another town) */
						$waves = array_merge($vm['v30'],$vm['o30']);//$database->getMovement(3,$village->wid,0);
						$waveCount = count($waves);
						for($i=0;$i<$waveCount;$i++){
							if($i>=0 && $waves[$i]['attack_type'] != 2){
								$waveCount -= 1;
								array_splice($waves, $i, 1);
								$i--;
							}
						}
						if($waveCount > 0){
							$action = 'def2';
							$aclass = 'd2';
							$title = ''.OWN_REINFORCING_TROOPS.'';
							$short = ''.ARRIVING_REINF_TROOPS_SHORT.'';
							$receive = $waves[0];
							echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'
								.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'
								.$aclass.'">&raquo;</span></td><td><div class="mov"><span class="'.$aclass.'">'.$waveCount.'&nbsp;'
								.$short.'</span></div><div class="dur_r">&nbsp;<span id="timer'.$timer.'">'
								.$generator->getTimeFormat($receive['endtime']-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
							$timer += 1;
						}

						/* Units send to reinf. (to my town) */
						$waves = array_merge($vm['v341'],$vm['o341']);//$database->getMovement(34,$village->wid,1);
						$waveCount = count($waves);
						for($i=0;$i<$waveCount;$i++){
							if($i>=0 && ($waves[$i]['attack_type'] != 2 && ($waves[$i]['vref']!=$village->wid || $waves[$i]['from']==$village->wid) && !($waves[$i]['vref']==$village->wid && $waves[$i]['from']==$village->wid))){
								$waveCount -= 1;
								array_splice($waves, $i, 1);
								$i--;
							}
						}
						if($waveCount > 0){
							$action = 'def1';
							$aclass = 'd1';
							$title = ''.OWN_REINFORCING_TROOPS.'';
							$short = ''.ARRIVING_REINF_TROOPS_SHORT.'';
							$receive = $waves[0];
							echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'
								.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'
								.$aclass.'">&raquo;</span></td><td><div class="mov"><span class="'.$aclass.'">'.$waveCount.'&nbsp;'
								.$short.'</span></div><div class="dur_r">&nbsp;<span id="timer'
								.$timer.'">'.$generator->getTimeFormat($receive['endtime']-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
							$timer += 1;
						}

						/* on attack, raid to another village*/
						$waves = array_merge($vm['v30'],$vm['o30']);//$database->getMovement(3,$village->wid,0);
						$waveCount = count($waves);
						for($i=0;$i<$waveCount;$i++){
							if($i>=0 && ($waves[$i]['attack_type'] != 3 && $waves[$i]['attack_type']!=4 && $waves[$i]['attack_type']!=1)){
								$waveCount -= 1;
								array_splice($waves, $i, 1);
								$i--;
							}
						}
						if($waveCount > 0){
							$action = 'att2';
							$aclass = 'a2';
							$title = ''.OWN_ATTACKING_TROOPS.'';
							$short = ''.ATTACK.'';
							$receive = $waves[0];
							echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'
								.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'
								.$aclass.'">&raquo;</span></td><td><div class="mov"><span class="'.$aclass.'">'.$waveCount.'&nbsp;'
								.$short.'</span></div><div class="dur_r">&nbsp;<span id="timer'
								.$timer.'">'.$generator->getTimeFormat($receive['endtime']-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
							$timer += 1;
						}

						$aantal2 = array_merge($vm['v50'],$vm['o50']);//$database->getMovement2(5,$village->wid,0);
						$aantal = count($aantal2);
						if($aantal > 0){
							foreach($aantal2 as $receive) {
								$action = 'att3';
								$aclass = 'a3';
								$title = NEWVILLAGE;
								$short = NEWVILLAGE;
							}
							echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'
								.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'
								.$aclass.'">&raquo;</span></td><td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'
								.$short.'</span></div><div class="dur_r">&nbsp;<span id="timer'
								.$timer.'">'.$generator->getTimeFormat($receive['endtime']-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
							$timer += 1;
						}

						$aantal2 = array_merge($vm['v90'],$vm['o90']);//$database->getMovement2(9,$village->wid,0);
						$aantal = count($aantal2);
						if($aantal > 0){
							foreach($aantal2 as $receive) {
								$action = 'att3';
								$aclass = 'a3';
								$title = JR_HEROADVENTURE;
								$short = JR_HEROADVENTURE;
							}
							echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'
								.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'
								.$aclass.'">&raquo;</span></td><td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'
								.$short.'</span></div><div class="dur_r">&nbsp;<span id="timer'
								.$timer.'">'.$generator->getTimeFormat($receive['endtime']-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
							$timer += 1;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
