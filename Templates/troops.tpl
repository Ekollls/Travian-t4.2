
<div class="boxes villageList units">
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
		<table id="troops" cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th colspan="3">
						<?php echo TROOPS_DORF; ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$units = $technology->getUnitList();
				$reinfs = $village->enforcetome;
				$reinfHeroCount = $database->getEnforceVillage($village->wid, 0);
				$unitHeroCount = $database->getUnit($village->wid);
				$heroamt = 0;
				$heroamt += $unitHeroCount['hero'];
				foreach($reinfHeroCount as $reinfhc) {$heroamt += $reinfhc['hero'];}
				if(count($units) == 0 && count($reinfs) == 0) {
					echo "<tr><td>".NOTROOPS."</td></tr>";
				} else {
					if($heroamt>0){
						echo "<tr><td class=\"ico\"><a href=\"build.php?id=39\"><img class=\"unit uhero\" src=\"img/x.gif\" alt=\""
							.U0."\" title=\"".U0
							."\" /></a></td><td class=\"num\">"
							.$heroamt."</td><td class=\"un\">".U0."</td></tr>";
    
					}
					foreach($units as $unit) {
						if($unit['id']!='hero'){
							echo "<tr><td class=\"ico\"><a href=\"build.php?id=39\"><img class=\"unit u"
								.$unit['id']."\" src=\"img/x.gif\" alt=\""
								.$unit['name']."\" title=\"".$unit['name']
								."\" /></a></td><td class=\"num\">"
								.$unit['amt']."</td><td class=\"un\">".$unit['name']."</td></tr>";
						}
        
					}
					if(count($reinfs)>0){
						$enf = array(1=>0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
						//$enf['hero'] = 0;
						foreach($reinfs as $reinf) {
							for($i=1;$i<=50;$i++){$enf[$i] += $reinf['u'.$i];}
							//$enf['hero'] += $reinf['hero'];
						}
						for($i=1;$i<=50;$i++){
							if($enf[$i]!=0){
							echo "<tr><td class=\"ico\"><a href=\"build.php?id=39\"><img class=\"unit u"
								.$i."\" src=\"img/x.gif\" title=\"".$technology->unarray[$i]
								."\" /></a></td><td class=\"num\">"
								.$enf[$i]."</td><td class=\"un\">".$technology->unarray[$i]."</td></tr>";
							}
						}
					}

				}
				?>
            </tbody>
		</table>
	</div> 
</div>
