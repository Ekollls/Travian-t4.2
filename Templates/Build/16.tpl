
<h1 class="titleInHeader"><?php echo B16;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>
<div id="build" class="gid16">
<div class="build_desc">
<a href="#" onClick="return Travian.Game.iPopup(16,4);" class="build_logo">
<img class="g16 big white" src="img/x.gif" alt="<?php echo B16;?>" title="<?php echo B16;?>" />
</a>
<?php echo B4_DESC; ?></div>
<?php include("upgrade.tpl"); ?>
<?php if(!$village->resarray['f'.$id] < 1){ ?>
<div class="contentNavi tabNavi">
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=<?php echo $id; ?>"><span class="tabItem"><?php echo JR_OVERVIEW;?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="a2b.php"><span class="tabItem"><?php echo SENDTROOPS;?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="warsim.php"><span class="tabItem"><?php echo COMBATSIMULATOR;?></span></a></div>
				</div>
                <div class="container">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=39&amp;t=99"><span class="tabItem"><?php echo FARMLIST;?></span></a></div>
				</div>
                <div class="container">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=39&amp;t=100"><span class="tabItem"><?php echo ESCAPE_GORIZ;?></span></a></div>
				</div>
</div>

<?php

include("16_incomming.tpl");


	include("16_walking.tpl"); 


?>
		
<h4 class="spacer"><?php echo TROOPSATHOME;?></h4>
        <table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td><td colspan="11">
            <a href="spieler.php?uid=<?php echo $session->uid; ?>">Units in village</a></td></tr></thead>
            <tbody class="units">
           <?php include("16_troops.tpl"); 
          
           ?>
            </tbody></table>
            
		<?php
		if(count($village->enforcetome) > 0) {
            foreach($village->enforcetome as $enforce) {
				$isoasis = $database->isVillageOases($enforce['from']);
				if ($isoasis){
					$fromVillage = $database->getOMInfo($enforce['from']);
					if ($fromVillage['conqured']){
						$fromVillage['name'] = OCCUPIEDOASES;
					} else {
						$fromVillage['name'] = UNOCCUPIEDOASES;
					}
					if (DIRECTION == 'ltr'){
						$fromVillage['name'] .=  '('.$fromVillage['x']."|".$fromVillage['y'].')';
					} elseif (DIRECTION == 'rtl'){
						$fromVillage['name'] .=  '('.$fromVillage['y']."|".$fromVillage['x'].')';
					}
				} else {
					$fromVillage = $database->getMInfo($enforce['from']);if(defined($fromVillage['name'])) $fromVillage['name'] = constant($fromVillage['name']);
				}
				$fromTribe = $database->getUserField($fromVillage["owner"],"tribe",0);
				echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
				<a href=\"spieler.php?uid=".$fromVillage['owner']."\">Units ".$database->getUserField($fromVillage['owner'],"username",0)."</a></td>";
                if($enforce['hero'] > 0){ echo "<td colspan=\"11\">"; }else{ echo "<td colspan=\"10\">"; }
				echo "<a href=\"position_details.php?x=".$fromVillage['x']."&y=".$fromVillage['y']."\">".$fromVillage['name']."</a>";
				echo "</td></tr></thead><tbody class=\"units\">";
				$start = ($fromTribe-1)*10+1;
				$end = ($fromTribe*10);
				echo '<tr><th class="coords"><span class="coordinates coordinatesAligned">';
				if(DIRECTION == 'ltr'){
					echo '<span class="coordinateX">('.$fromVillage['x'].'</span>'
						.'<span class="coordinatePipe">|</span>'
						.'<span class="coordinateY">'.$fromVillage['y'].')</span>';
				}elseif(DIRECTION == 'rtl'){
					echo '<span class="coordinateY">'.$fromVillage['y'].')</span>'
					.'<span class="coordinatePipe">|</span>'
					.'<span class="coordinateX">('.$fromVillage['x'].'</span>';
				}
				echo '</span><span class="clear"></span></th>';
				for($i=$start;$i<=($end);$i++) {
					echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" /></td>";	
				}
                if($enforce['hero'] > 0){
                echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" /></td>";
                }
				echo "</tr><tr><th>Csapatok</th>";
				for($i=$start;$i<=($start+9);$i++) {
					if($enforce['u'.$i] == 0) {
						echo "<td class=\"none\">";
					}
					else {
						echo "<td>";
					}
					echo $enforce['u'.$i]."</td>";
				}
                if($enforce['hero'] > 0){
                	if($enforce['hero'] == 0) { echo "<td class=\"none\">"; }else { echo "<td>"; }
					echo $enforce['hero']."</td>";
                }
				echo "</tr></tbody>
				<tbody class=\"infos\"><tr><th>".WHEATCONSUMPTION."</th>";
                if($enforce['hero'] > 0){ echo "<td colspan=\"11\">"; }else{ echo "<td colspan=\"10\">"; }
                echo "<div class='sup'>".$technology->getUpkeep($enforce,$fromTribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />per hour </div><div class='sback'><a href='a2b.php?w=".$enforce['id']."'>".SENDBACK."</a></div></td></tr>";
            
				echo "</tbody></table>";
			}
		}
        
            if(count($village->enforcetoyou) > 0) {
            echo "<h4 class=\"spacer\">".REPORT_REINF."</h4>";
            foreach($village->enforcetoyou as $enforce) {
			$isoasis = $database->isVillageOases($enforce['from']);
			if ($isoasis){
				$fromVillage = $database->getOMInfo($enforce['from']);
				if ($fromVillage['conqured']){
					$fromVillage['name'] = OCCUPIEDOASES;
				} else {
					$fromVillage['name'] = UNOCCUPIEDOASES;
				}
				if (DIRECTION == 'ltr'){
					$fromVillage['name'] .=  '('.$fromVillage['x']."|".$fromVillage['y'].')';
				} elseif (DIRECTION == 'rtl'){
					$fromVillage['name'] .=  '('.$fromVillage['y']."|".$fromVillage['x'].')';
				}
			} else {
				$fromVillage = $database->getMInfo($enforce['from']); if(defined($fromVillage['name'])) $fromVillage['name'] = constant($fromVillage['name']); 
			}
			$isoasis = $database->isVillageOases($enforce['vref']);
			if ($isoasis){
				$vrefVillage = $database->getOMInfo($enforce['vref']);
				if ($vrefVillage['conqured']){
					$vrefVillage['name'] = OCCUPIEDOASES;
				} else {
					$vrefVillage['name'] = UNOCCUPIEDOASES;
				}
				if (DIRECTION == 'ltr'){
					$vrefVillage['name'] .=  '('.$vrefVillage['x']."|".$vrefVillage['y'].')';
				} elseif (DIRECTION == 'rtl'){
					$vrefVillage['name'] .=  '('.$vrefVillage['y']."|".$vrefVillage['x'].')';
				}
			} else {
				$vrefVillage = $database->getMInfo($enforce['vref']); if(defined($vrefVillage['name'])) $vrefVillage['name'] = constant($vrefVillage['name']); 
			}

                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$enforce['from']."&c=".$generator->getMapCheck($enforce['from'])."\">".$fromVillage['name']."</a></td>";
                  if($enforce['hero'] > 0){ echo "<td colspan=\"11\">"; }else{ echo "<td colspan=\"10\">"; }
                  echo "<a href=\"karte.php?d=".$enforce['vref']."&c=".$generator->getMapCheck($enforce['vref'])."\">".REINFORCEMENTTO.' '.$vrefVillage["name"]." </a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($enforce['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  $coor = $database->getCoor($enforce['vref']);
                  echo "<tr>
                  <th class=\"coords\">
					<span class=\"coordinates coordinatesAligned\">
                    <span class=\"coordinateX\">(".$coor['x']."</span>
					<span class=\"coordinatePipe\">|</span>
					<span class=\"coordinateY\">".$coor['y'].")</span>
                    </span>
                    <span class=\"clear\"></span></th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
                  if($enforce['hero'] > 0){
                	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" /></td>";
                  }
                  echo "</tr><tr><th>Troops</th>";
                  for($i=$start;$i<=($start+9);$i++) {
                  	if($enforce['u'.$i] == 0) {
						echo "<td class=\"none\">";
                  	} else {
						echo "<td>";
                  	}
                    echo $enforce['u'.$i]."</td>";
                  }
                  if($enforce['hero'] > 0){
                	if($enforce['hero'] == 0) { echo "<td class=\"none\">"; }else { echo "<td>"; }
					echo $enforce['hero']."</td>";
                  }
                  echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>".WHEATCONSUMPTION."</th>";
            if($enforce['hero'] > 0){ echo "<td colspan=\"11\">"; }else{ echo "<td colspan=\"10\">"; }
            echo "<div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />Per hour</div><div class='sback'><a href='a2b.php?r=".$enforce['id']."'>".PULLBACK."</a></div></td></tr>";
            
                  echo "</tbody></table>";
            }
            }
            }


if(count($village->trappedinme) > 0) {
	echo "<h4 class=\"spacer\">".TRAPPED_INME."</h4>";
	foreach($village->trappedinme as $trappedinme) {
		$isoasis = $database->isVillageOases($trappedinme['from']);
		if ($isoasis){
			$fromVillage = $database->getOMInfo($trappedinme['from']);
			if ($fromVillage['conqured']){
				$fromVillage['name'] = OCCUPIEDOASES;
			} else {
				$fromVillage['name'] = UNOCCUPIEDOASES;
			}
			if (DIRECTION == 'ltr'){
				$fromVillage['name'] .=  '('.$fromVillage['x']."|".$fromVillage['y'].')';
			} elseif (DIRECTION == 'rtl'){
				$fromVillage['name'] .=  '('.$fromVillage['y']."|".$fromVillage['x'].')';
			}
		} else {
			$fromVillage = $database->getMInfo($trappedinme['from']); if(defined($fromVillage['name'])) $fromVillage['name'] = constant($fromVillage['name']); 
		}
		$fromTribe = $database->getUserField($fromVillage["owner"],"tribe",0);
		echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
			<a href=\"spieler.php?uid=".$fromVillage['owner']."\">Units ".$database->getUserField($fromVillage['owner'],"username",0)."</a></td>";
	        if($trappedinme['hero'] > 0){ echo "<td colspan=\"11\">"; }else{ echo "<td colspan=\"10\">"; }
		echo "<a href=\"position_details.php?x=".$fromVillage['x']."&y=".$fromVillage['y']."\">".$fromVillage['name']."</a>";
		echo "</td></tr></thead><tbody class=\"units\">";
		$start = ($fromTribe-1)*10+1;
		$end = ($fromTribe*10);
		echo '<tr><th class="coords"><span class="coordinates coordinatesAligned">';
		if(DIRECTION == 'ltr'){
			echo '<span class="coordinateX">('.$fromVillage['x'].'</span>'
				.'<span class="coordinatePipe">|</span>'
				.'<span class="coordinateY">'.$fromVillage['y'].')</span>';
		}elseif(DIRECTION == 'rtl'){
			echo '<span class="coordinateY">'.$fromVillage['y'].')</span>'
				.'<span class="coordinatePipe">|</span>'
				.'<span class="coordinateX">('.$fromVillage['x'].'</span>';
		}
		echo '</span><span class="clear"></span></th>';
		for($i=$start;$i<=($end);$i++) {
			echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" /></td>";	
		}
                if($trappedinme['hero'] > 0){
	                echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" /></td>";
                }
		echo "</tr><tr><th>Csapatok</th>";
		for($i=$start;$i<=($start+9);$i++) {
			if($trappedinme['u'.$i] == 0) {
				echo "<td class=\"none\">";
			} else {
				echo "<td>";
			}
			echo $trappedinme['u'.$i]."</td>";
		}
                if($trappedinme['hero'] > 0){
                	if($trappedinme['hero'] == 0) { echo "<td class=\"none\">"; }else { echo "<td>"; }
				echo $trappedinme['hero']."</td>";
                }
		echo "</tr></tbody>
			<tbody class=\"infos\"><tr><th>".WHEATCONSUMPTION."</th>";
                if($trappedinme['hero'] > 0){ echo "<td colspan=\"11\">"; }else{ echo "<td colspan=\"10\">"; }
                echo "<div class='sup'>0<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />per hour </div><div class='sback'><a href='a2b.php?f=".$trappedinme['id']."'>".TRAPPED_FREE."</a> ".OR_STR." <a href='a2b.php?k=".$trappedinme['id']."'>".TRAPPED_KILL."</a></div></td></tr>";
            
		echo "</tbody></table>";
	}
}

        
if(count($village->trappedinyou) > 0) {
	echo "<h4 class=\"spacer\">".TRAPPED_INYOU."</h4>";
	foreach($village->trappedinyou as $trappedinyou) {
		$fromVillage = $database->getMInfo($trappedinyou['from']); if(defined($fromVillage['name'])) $fromVillage['name'] = constant($fromVillage['name']);
		$vrefVillage = $database->getMInfo($trappedinyou['vref']); if(defined($vrefVillage['name'])) $vrefVillage['name'] = constant($vrefVillage['name']);
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
	                  <a href=\"karte.php?d=".$trappedinyou['from']."&c=".$generator->getMapCheck($trappedinyou['from'])."\">".$fromVillage["name"]."</a></td>";
                  if($trappedinyou['hero'] > 0){ echo "<td colspan=\"11\">"; }else{ echo "<td colspan=\"10\">"; }
                  echo "<a href=\"karte.php?d=".$trappedinyou['vref']."&c=".$generator->getMapCheck($trappedinyou['vref'])."\">".TRAPPED_IN.' '.$vrefVillage["name"]." </a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($trappedinyou['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  $coor = $database->getCoor($trappedinyou['vref']);
                  echo "<tr><th class=\"coords\"><span class=\"coordinates coordinatesAligned\"><span class=\"coordinateX\">(".$coor['x']."</span><span class=\"coordinatePipe\">|</span><span class=\"coordinateY\">".$coor['y'].")</span></span><span class=\"clear\"></span></th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
                  if($trappedinyou['hero'] > 0){
                	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" /></td>";
                  }
                  echo "</tr><tr><th>Troops</th>";
                  for($i=$start;$i<=($start+9);$i++) {
                  	if($trappedinyou['u'.$i] == 0) {
				echo "<td class=\"none\">";
                  	} else {
				echo "<td>";
                  	}
			echo $trappedinyou['u'.$i]."</td>";
                  }
                  if($trappedinyou['hero'] > 0){
                	if($trappedinyou['hero'] == 0) { echo "<td class=\"none\">"; }else { echo "<td>"; }
			echo $trappedinyou['hero']."</td>";
                  }
                  echo "</tr></tbody><tbody class=\"infos\"><tr><th>".WHEATCONSUMPTION."</th>";
		  if($trappedinyou['hero'] > 0){ echo "<td colspan=\"11\">"; }else{ echo "<td colspan=\"10\">"; }
            	  echo "<div class='sup'>".$technology->getUpkeep($trappedinyou,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />Per hour</div><div class='sback'><a href='a2b.php?k=".$trappedinyou['id']."'>".TRAPPED_ANARCHI."</a></div></td></tr>";
            
                  echo "</tbody></table>";
		}
	}

?>




</p></div>
