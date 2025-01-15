<?php
$units = $database->getMovement(3,$village->wid,0);
$total_for = count($units);
for($y=0;$y<$total_for;$y++){
$timer += 1;
$moveid = $units[$y]['moveid'];

if($units[$y]['attack_type'] == 2){
	$attack_type = "&#1606;&#1740;&#1585;&#1608;&#1740; &#1705;&#1605;&#1705;&#1740; &#1576;&#1607;";
	}
if($units[$y]['attack_type'] == 1){
	$attack_type = "&#1580;&#1575;&#1587;&#1608;&#1587;&#1740; &#1575;&#1586;";
	}
if($units[$y]['attack_type'] == 3){
	$attack_type = "&#1581;&#1605;&#1604;&#1607; &#1576;&#1607;";
	}
if($units[$y]['attack_type'] == 4){
	$attack_type = "&#1594;&#1575;&#1585;&#1578;";
	}
$isoasis = $database->isVillageOases($units[$y]['to']);
if ($isoasis ==0){ 	
$to = $database->getMInfo($units[$y]['to']);
} else {
$to = $database->getOMInfo($units[$y]['to']);}


if($units[$y]['attack_type'] == 2){ $style = ""; }else{ $style = "outRaid"; }
?>

<table class="troop_details <?php echo $style; ?>" cellpadding="1" cellspacing="1">            
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td>
			<td colspan="11" class="troopHeadline"><a href="karte.php?d=<?php echo $to['wref']."&c=".$generator->getMapCheck($to['wref']); ?>"><?php echo $attack_type." ".$to['name']; ?></a>
            <?php
            $coor = $database->getCoor($to['wref']);
            
            if($isoasis){
            	echo " (".$coor['x']."|".$coor['y'].")";
                }
            ?></td>
		</tr>
	</thead>
	<tbody class="units">
			<?php
				$tribe = $session->tribe;
                  $start = ($tribe == 1)? 1 : (($tribe == 2)? 11 : 21);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  $coor = $database->getCoor($village->wid);
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
                  	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" alt=\"".$technology->getUnitName(51)."\" /></td>";	
			?>
			</tr>
 <tr><th>&#1604;&#1588;&#1711;&#1585;&#1740;&#1575;&#1606;</th>
            <?php
            for($i=1;$i<=11;$i++) {
            	if($units[$y]['t'.$i] == 0) {
                	echo "<td class=\"none\">";
                }
                else {
                echo "<td>";
                }
                echo $units[$y]['t'.$i]."</td>";
            }
            
            ?>
           </tr></tbody>
		<tbody class="infos">
			<tr>
				<th>&#1586;&#1605;&#1575;&#1606; &#1585;&#1587;&#1740;&#1583;&#1606;</th>
				<td colspan="11">
				<?php
				    echo "<div class=\"in small\">&#1578;&#1575; <span id=timer$timer>".$generator->getTimeFormat($units[$y]['endtime']-time())."</span> &#1587;&#1575;&#1593;&#1578;</div>";
				    $datetime = $generator->procMtime($units[$y]['endtime']);
				    echo "<div class=\"at small\">";
				    echo "&#1583;&#1585; ".$datetime[1]."</div>";
    		?>
<?php
if((time()-$units[$y]['starttime'])<= (round(($units[$y]['endtime']-$units[$y]['starttime']))/3)) { ?>
    <div class="abort"><a href="build.php?id=39&a=4&aa=<?=$moveid?>"><img src="img/x.gif" class="del" title="لغو حمله ( بازگشت نیرو ها طی 2 دقیقه )" alt="لغو حمله ( بازگشت نیرو ها طی 2 دقیقه )" /></a>
<?php }; ?>
					</div>
				</td>
			</tr>
		</tbody>
</table>
		<?php
		}
		?>
<?php
$adventures = $database->getMovement(9,$village->wid,0);   
if($adventures){
$total_for = count($adventures);

for($y=0;$y<$total_for;$y++){
$timer += 1;
    $coor = $database->getCoor($adventures[$y]['to']);
?>
<table class="troop_details inAttackOasis" cellpadding="1" cellspacing="1">            
    <thead>
        <tr>
            <td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td>
            <td colspan="11" class="troopHeadline"><a href="karte.php?d=<?php echo $adventures[$y]['to']."&c=".$generator->getMapCheck($adventures[$y]['to']); ?>">&#1605;&#1575;&#1580;&#1585;&#1575;&#1580;&#1608;&#1740;&#1740; (<?php echo $coor['x']."|".$coor['y']; ?>)</a></td>
        </tr>
    </thead>
    <tbody class="units">
            <?php
                $tribe = $session->tribe;
                 $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  
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
                  echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" alt=\"".$technology->getUnitName(51)."\" /></td>"; 
            ?>
            </tr>
 <tr><th>&#1604;&#1588;&#1711;&#1585;&#1740;&#1575;&#1606;</th>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td>1</td>

           </tr></tbody>
        <tbody class="infos">
            <tr>
                <th>&#1586;&#1605;&#1575;&#1606; &#1585;&#1587;&#1740;&#1583;&#1606;</th>
                <td colspan="11">
                <?php
                    echo "<div class=\"in small\">&#1578;&#1575; <span id=timer$timer>".$generator->getTimeFormat($adventures[$y]['endtime']-time())."</span> &#1587;&#1575;&#1593;&#1578;</div>";
                    $datetime = $generator->procMtime($adventures[$y]['endtime']);
                    echo "<div class=\"at small\">";
                    echo "&#1583;&#1585; ".$datetime[1]."</div>";
            ?>
<?php
if((time()-$units[$y]['starttime'])<= (round(($units[$y]['endtime']-$units[$y]['starttime']))/3)) { ?>
    <div class="abort"><a href="build.php?id=39&a=4&aa=<?=$moveid?>"><img src="img/x.gif" class="del" title="لغو حمله ( بازگشت نیرو ها طی 2 دقیقه )" alt="لغو حمله ( بازگشت نیرو ها طی 2 دقیقه )" /></a>
<?php }; ?>
                    </div>
                </td>
            </tr>
        </tbody>
</table>
        <?php
        }
        }
        ?>
<?php
$settlers = $database->getMovement(5,$village->wid,0);   
if($settlers){
$total_for = count($settlers);

for($y=0;$y<$total_for;$y++){
$timer += 1;
    $coor = $database->getCoor($settlers[$y]['to']);
?>
<table class="troop_details" cellpadding="1" cellspacing="1">            
    <thead>
        <tr>
            <td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td>
            <td colspan="10" class="troopHeadline"><a href="karte.php?d=<?php echo $settlers[$y]['to']."&c=".$generator->getMapCheck($settlers[$y]['to']); ?>">&#1576;&#1606;&#1575;&#1740; &#1583;&#1607;&#1705;&#1583;&#1607; &#1740; &#1580;&#1583;&#1740;&#1583; (<?php echo $coor['x']."|".$coor['y']; ?>)</a></td>
        </tr>
    </thead>
    <tbody class="units">
            <?php
                $tribe = $session->tribe;
                 $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  
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
            ?>
            </tr>
 <tr><th>&#1604;&#1588;&#1711;&#1585;&#1740;&#1575;&#1606;</th>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td class="none">0</td>
            <td>3</td>

           </tr></tbody>
        <tbody class="infos">
            <tr>
                <th>&#1586;&#1605;&#1575;&#1606; &#1585;&#1587;&#1740;&#1583;&#1606;</th>
                <td colspan="10">
                <?php
                    echo "<div class=\"in small\">&#1578;&#1575; <span id=timer$timer>".$generator->getTimeFormat($settlers[$y]['endtime']-time())."</span> &#1587;&#1575;&#1593;&#1578;</div>";
                    $datetime = $generator->procMtime($settlers[$y]['endtime']);
                    echo "<div class=\"at small\">";
                    echo "&#1583;&#1585; ".$datetime[1]."</div>";
            ?>
<?php
if((time()-$units[$y]['starttime'])<= (round(($units[$y]['endtime']-$units[$y]['starttime']))/3)) { ?>
    <div class="abort"><a href="build.php?id=39&a=4&aa=<?=$moveid?>"><img src="img/x.gif" class="del" title="لغو حمله ( بازگشت نیرو ها طی 2 دقیقه )" alt="لغو حمله ( بازگشت نیرو ها طی 2 دقیقه )" /></a>
<?php }; ?>
                    </div>
                </td>
            </tr>
        </tbody>
</table>
        <?php
        }
        }
        ?>

