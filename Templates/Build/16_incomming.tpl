<?php

$units = $database->getMovement("34",$village->wid,1);
$total_for = count($units);

for($y=0;$y < $total_for;$y++){
$timer += 1;
if ($units[$y]['sort_type']==3){
	if ($units[$y]['attack_type']==3){
		$actionType = "&#1583;&#1585; &#1581;&#1575;&#1604; &#1581;&#1605;&#1604;&#1607; &#1576;&#1607; ";
	} else if ($units[$y]['attack_type']==4){
		$actionType = "&#1583;&#1585; &#1581;&#1575;&#1604; &#1594;&#1575;&#1585;&#1578; ";
	} else if ($units[$y]['attack_type']==2){
		$actionType = "&#1606;&#1740;&#1585;&#1608;&#1740; &#1705;&#1605;&#1705;&#1740; &#1576;&#1607; ";
	}

	if($units[$y]['attack_type'] != 1){
		echo "<table class=\"troop_details ";
        
        if($units[$y]['attack_type'] != 2){ echo "inRaid"; } else { echo "inReturn"; }
        	echo"\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$units[$y]['from']."&c=".$generator->getMapCheck($units[$y]['from'])."\">".$database->getVillageField($units[$y]['from'],"name")."</a></td>
                  <td colspan=\"11\" class=\"troopHeadline\">";
                  echo "<a href=\"spieler.php?uid=".$database->getVillageField($units[$y]['to'],"owner")."\">";
                  echo $actionType ." ". $village->vname;
                  echo "</a></td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($units[$y]['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  $coor = $database->getCoor($units[$y]['from']);
                  echo "<tr><th class=\"coords\">
					<span class=\"coordinates coordinatesAligned\">
                    <span class=\"coordinateY\">".$coor['x'].")</span>
                    <span class=\"coordinatePipe\">|</span>
                    <span class=\"coordinateX\">(".$coor['y']."</span>
                    </span>
                    <span class=\"clear\">&#8206;</span></th>";
                  for($i=$start;$i<=$end;$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
                  echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" alt=\"".$technology->getUnitName(51)."\" /></td>";	
                  echo "</tr><tr><th>&#1604;&#1588;&#1711;&#1585;&#1740;&#1575;&#1606;</th>";
                  
                  

if($village->resarray['f39'] >= 5){
	for($t=1;$t<=11;$t++){
        if($units[$y]['t'.$t]){
        	if($t!=7 or $t!=8 or $t!=8){
				echo "<td>?</td>";
            }
		}else{
			echo "<td class=\"none\">?</td>";
		}
    }
}else{
	for($t=1;$t<=11;$t++){
		echo "<td class=\"none\">?</td>";
	}
}
                  
                  echo "</tr></tbody>";
                  echo '
                  <tbody class="infos">
									<tr>
										<th>&#1586;&#1605;&#1575;&#1606; &#1585;&#1587;&#1740;&#1583;&#1606;</th>
										<td colspan="11">
										<div class="in small">&#1578;&#1575; <span id=timer'.$timer.'>'.$generator->getTimeFormat($units[$y]['endtime']-time()).'</span> &#1587;&#1575;&#1593;&#1578;.</div>';
										    $datetime = $generator->procMtime($units[$y]['endtime']);
										    echo "<div class=\"at small\">";
										    echo "&#1583;&#1585; ".$datetime[1]." &#1587;&#1575;&#1593;&#1578;</div>
											</div>
										</td>
									</tr>
								</tbody>";
		echo "</table>";
        
	} 
}elseif ($units[$y]['sort_type']==4){
	if ($units[$y]['attack_type']==1){
		$actionType = "&#1576;&#1575;&#1586;&#1711;&#1588;&#1578; &#1576;&#1607; ";
	} else if ($units[$y]['attack_type']==2){
		$actionType = "&#1606;&#1740;&#1585;&#1608;&#1740; &#1705;&#1605;&#1705;&#1740; &#1576;&#1607; ";
	} else if ($units[$y]['attack_type']==3){
		$actionType = "&#1576;&#1575;&#1586;&#1711;&#1588;&#1578; &#1576;&#1607; ";
	} else if ($units[$y]['attack_type']==4){
		$actionType = "&#1576;&#1575;&#1586;&#1711;&#1588;&#1578; &#1576;&#1607; ";
	}

$to = $database->getMInfo($units[$y]['vref']);
?>
<table class="troop_details inReturn" cellpadding="1" cellspacing="1">            
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td>
            <?php if($units[$y]['t11']!=0){ $colspan = '11'; }else{ $colspan = '10'; } ?>
			<td colspan="<?php echo $colspan; ?>" class="troopHeadline"><a href="karte.php?d=<?php echo $to['wref']."&c=".$generator->getMapCheck($to['wref']); ?>"><?php echo $actionType ." ". $to['name']; ?></a></td>
		</tr>
	</thead>
	<tbody class="units">
			<?php
				$tribe = $session->tribe;
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  $coor = $database->getCoor($units[$y]['vref']);
                  echo "<tr><th class=\"coords\">
					<span class=\"coordinates coordinatesAligned\">
                    <span class=\"coordinateY\">".$coor['x'].")</span>
                    <span class=\"coordinatePipe\">|</span>
                    <span class=\"coordinateX\">(".$coor['y']."</span>
                    </span>
                    <span class=\"clear\">&#8206;</span></th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
                  if($units[$y]['t11']!=0){
                  echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" alt=\"".$technology->getUnitName(51)."\" /></td>";
                  }	
			?>
			</tr>
 <tr><th>&#1604;&#1588;&#1711;&#1585;&#1740;&#1575;&#1606;</th>
            <?php
            for($i=1;$i<=10;$i++) {
            	if($units[$y]['t'.$i] == 0) {
                	echo "<td class=\"none\">";
                }else {
                echo "<td>";
                }
                echo $units[$y]['t'.$i]."</td>";
            }
            if($units[$y]['t11']!=0){
            	if($units[$y]['t11'] == 0) {
                	echo "<td class=\"none\">";
                }else {
                	echo "<td>";
                }
                echo $units[$y]['t11']."</td>";
            }
            ?>
           </tr>

           </tbody>
		<tbody class="infos">
        <?php
        if($units[$y]['attack_type']==3 || $units[$y]['attack_type']==4){        
        $dataarray = explode(",",$units[$y]['data']);
        
        ?>
    <tr><th>&#1594;&#1606;&#1575;&#1574;&#1605;</th>
    <td colspan="<?php echo $colspan; ?>">
    <div class="res">
    <span class="resource" title="&#1670;&#1608;&#1576;"><img class="r1" src="img/x.gif" alt="&#1670;&#1608;&#1576;"><?php echo $dataarray['0']; ?></span>
    <span class="resource" title="&#1582;&#1588;&#1578;"><img class="r2" src="img/x.gif" alt="&#1582;&#1588;&#1578;"><?php echo $dataarray['1']; ?></span>
    <span class="resource" title="&#1570;&#1607;&#1606;"><img class="r3" src="img/x.gif" alt="&#1570;&#1607;&#1606;"><?php echo $dataarray['2']; ?></span>
    <span class="resource" title="&#1711;&#1606;&#1583;&#1605;"><img class="r4" src="img/x.gif" alt="&#1711;&#1606;&#1583;&#1605;"><?php echo $dataarray['3']; ?></span>
    </div>
    <div class="carry">
    <?php
    if ($dataarray[0]+$dataarray[1]+$dataarray[2]+$dataarray[3] == 0) {
    echo"<img title=\"";
    echo ($dataarray[0]+$dataarray[1]+$dataarray[2]+$dataarray[3])."/".$dataarray[4];
    echo"\" src=\"img/x.gif\" class=\"carry empty\">";
	} elseif ($dataarray[0]+$dataarray[1]+$dataarray[2]+$dataarray[3] != $dataarray[4]) {
    echo "<img title=\"";
    echo ($dataarray[0]+$dataarray[1]+$dataarray[2]+$dataarray[3])."/".$dataarray[4];
    echo"\" src=\"img/x.gif\" class=\"carry half\">";
    } else {
    echo"<img title=\"";
    echo ($dataarray[0]+$dataarray[1]+$dataarray[2]+$dataarray[3])."/".$dataarray[4];
    echo"\" src=\"img/x.gif\" class=\"carry full\">";
    }

    ?>
    <?php echo ($dataarray[0]+$dataarray[1]+$dataarray[2]+$dataarray[3])."/".$dataarray[4]; ?>
    </td>
    </tr>
    <?php } ?>
			<tr>
				<th>&#1586;&#1605;&#1575;&#1606; &#1585;&#1587;&#1740;&#1583;&#1606;</th>
				<td colspan="<?php echo $colspan; ?>">
				<?php
                
				    echo "<div class=\"in small\">&#1578;&#1575; <span id=timer".$timer.">".$generator->getTimeFormat($units[$y]['endtime']-time())."</span> &#1587;&#1575;&#1593;&#1578;.</div>";
				    $datetime = $generator->procMtime($units[$y]['endtime']);
				    echo "<div class=\"at small\">";
				    echo "&#1583;&#1585; ".$datetime[1]."</div>";
    		?>
					</div>
				</td>
			</tr>
		</tbody>
</table>
<?php	

	}
}


?>