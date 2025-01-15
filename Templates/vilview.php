<div id="content" class="positionDetails">
<?php
$d = $database->getVilWref($_GET['x'],$_GET['y']);
if($database->getOasisV($d)){
    $basearray = $database->getOMInfo($d);
}else{
    $basearray = $database->getMInfo($d);
}
if(defined($basearray['name'])){$basearray['name'] = constant($basearray['name']);}
?>


<h1 class="titleInHeader">
        <span class="coordinates coordinatesWithText">
        <span class="coordText">
        <?php if(!$basearray['occupied'] && $basearray['oasistype'] && !$basearray['fieldtype']){
        		echo UNOCCUPIEDOASIS;
            }elseif($basearray['occupied'] && $basearray['oasistype'] && !$basearray['fieldtype']){
            	echo OCCUPIEDOASIS;
            }elseif($basearray['occupied'] && !$basearray['oasistype'] && $basearray['fieldtype']){
            	echo $basearray['name'];
            }else{ echo ABANDONEDVALLEY; } ?>
        </span>
		<?php if(DIRECTION == 'ltr'){ ?>
			<span class="coordinateX"><?php echo "(".$basearray['x'].""; ?></span>
			<span class="coordinatePipe">|</span>
			<span class="coordinateY"><?php echo "".$basearray['y'].")"; ?></span>
		<?php }elseif(DIRECTION == 'rtl'){ ?>
			<span class="coordinateY"><?php echo "".$basearray['y'].")"; ?></span>
			<span class="coordinatePipe">|</span>
			<span class="coordinateX"><?php echo "(".$basearray['x'].""; ?></span>
		<?php } ?>
        </span>
        <span class="clear"> </span>
        <?php if(isset($basearray['occupied']) && $basearray['occupied'] && isset($basearray['capital']) && $basearray['capital']) { echo "<span class=\"mainVillage\">(&#1662;&#1575;&#1740;&#1578;&#1582;&#1578;)</span>"; } ?>
        <span class="clear">&nbsp;</span>
</h1>
<div id="tileDetails" class="village <?php echo ($basearray['fieldtype'] == 0)? 'oasis-'.$basearray['oasistype'] : 'village-'.$basearray['fieldtype'] ?>">
<div class="detailImage">
<div id="options">
<div class="option"><a href="karte.php?x=<?php echo $basearray['x']; ?>&y=<?php echo $basearray['y']; ?>" class="a arrow"><?php echo CENTERMAP;?></a></div>
 <?php if(!$basearray['occupied']) { ?>
 <div class="option">
 <?php 
      $mode = CP; 
      $total = count($database->getProfileVillages($session->uid)); 
      $need_cps = ${'cp'.$mode}[$total+1]; 
      $cps = $database->getUserField($session->uid, 'cp',0);      
      
      if($cps >= $need_cps) {
        $enough_cp = true;
      } else {
        $enough_cp = false;
      }
      
			$otext = ($basearray['occupied'] == 1)? OCCUPIEDOASES : UNOCCUPIEDOASES; 
			if($village->unitarray['u'.$session->tribe.'0'] >= 3 AND $enough_cp) {
        $test = "<a class=\"a arrow\" href=\"a2b.php?id=".$d."&amp;s=1\">".EXPAND."</a>";
      } elseif($village->unitarray['u'.$session->tribe.'0'] >= 3 AND !$enough_cp) {
        $test = "<span class=\"a arrow disabled\" title=\"(".$cps."/".$need_cps." culture points\">".EXPAND."</span>";
      } else {
        $test = "<span class=\"a arrow disabled\">".EXPAND."</span>";
      }
 	
		echo ($basearray['fieldtype']==0)? 
		($village->resarray['f39']==0)? 
		($basearray['owner'] == $session->uid)?
		
		
		"<a class=\"a arrow\" href=\"build.php?id=39\">".RAID.' '.$otext.' '.BUILDRALLYPOINTTORAID."</a>" : 
		"<span class=\"a arrow disabled\">".RAID.' '.$otext.' '.BUILDRALLYPOINTTORAID."</span>" : 
		
		
		"<a class=\"a arrow\" href=\"a2b.php?z=".$d."&o\">".RAID.' '.$otext."</a>" :
		"$test"
			?>
	</div>
    <?php } 
        else if ($basearray['occupied']==1 && $basearray['oasistype']==0 && $basearray['wref'] != $_SESSION['wid']) {
    ?>
    <div class="option">
          <?php 
          $query1 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `wref` = '.$d.'');
          $data1 = mysql_fetch_assoc($query1);
          $query2 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'users` WHERE `id` = '.$data1['owner'].'');
          $data2 = mysql_fetch_assoc($query2);
          
          if($database->checkBan($data2['id'])) {
			echo "<span class=\"a arrow disabled\" title=\"".PLAYERBANNED."\">".PLAYERBANNED."</span>";
          } else if($data2['protect'] < time()) {
            echo $village->resarray['f39']? "<a class=\"a arrow\" href=\"a2b.php?z=".$d."\">".SENDTROOPS.".</a>" : "<span class=\"a arrow disabled\" title=\"".BUILDRALLYPOINTTORAID."\">".SENDTROOPS.BUILDRALLYPOINTTORAID."</span>"; 
          } else {
            echo "<span class=\"a arrow disabled\" title=\"".BEGINNERPROTECTIONUNTIL."\">".BEGINNERPROTECTIONUNTIL.".</span>";//need to fix showing protection time
          }
          ?>
</div>
    <div class="option">
    <?php
    echo $building->getTypeLevel(17)? "<a class=\"a arrow\" href=\"build.php?z=".$d."&id=" . $building->getTypeField(17) . "\">".SENDMERCHANTS."</a>" : "<span class=\"a arrow disabled\" title=\"(build marketplace)\">".SENDMERCHANTS.".</span>"; ?>
    </div>
    <?php }else if ($basearray['occupied']==1 && $basearray['oasistype']!=0 && $basearray['wref'] != $_SESSION['wid']) { ?>
        
        <div class="option">
        <?php
            echo $village->resarray['f39']? "<a class=\"a arrow\" href=\"a2b.php?z=".$d."\">".SENDTROOPS.".</a>" : "<span class=\"a arrow disabled\" title=\"".SENDTROOPS."\">".SENDTROOPS.".</span>"; 
          ?>
          </div>
          <?php } ?>
    
</div>
			</div></div>
 <div id="map_details">
 <?php if($basearray['occupied'] && $basearray['oasistype'] && !$basearray['fieldtype']){ ?>
 <table cellpadding="0" cellspacing="0" id="village_info" class="transparent">
    <?php
    $uinfo = $database->getUser($basearray['owner'],1);
    $vilowner = $database->getVillage($basearray['conqured']);
    ?>
		<tbody>
			<tr class="first">
				<th><?php echo TRIBE;?>:</th>
				<td><?php switch($uinfo['tribe']) { case 1: echo TRIBE1; break; case 2: echo TRIBE2; break; case 3: echo TRIBE3; break; case 5: echo TRIBE5; break;} ?></td>
			</tr>
			<tr>
				<th><?php echo ALLIANCE;?>:</th>
				<?php if($uinfo['alliance'] == 0){
			echo '<td>-</td>';
			} else echo '
			<td><a href="allianz.php?aid='.$uinfo['alliance'].'">'.$database->getUserAlliance($basearray['owner']).'</a></td>'; ?>
			</tr>
			<tr>
				<th><?php echo OWNER;?>:</th>
				<td><a href="spieler.php?uid=<?php echo $basearray['owner']; ?>"><?php echo $database->getUserField($basearray['owner'],'username',0); ?></a></td>
			</tr>
			<tr>
				<th><?php echo VILLAGE;?>:</th>
				<td><a href="karte.php?z=<?php echo $basearray['wref']; ?>"><?php echo $vilowner['name']; ?></a></td>
			</tr>
		</tbody>
	</table><Br />
 <?php } ?>
	<h4><?php if(!$basearray['fieldtype'] && !$basearray['oasistype']){ echo ""; } else { echo LANDDISTRIBUTION; } ?></h4>
	<table cellpadding="0" cellspacing="0" id="distribution" class="transparent">       
		<tbody>
<?php 
switch($basearray['fieldtype']) {
case 1:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 3</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 3</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 3</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 9</td>";

break;
case 2:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 3</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 4</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 5</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 6</td>";
break;
case 3:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 4</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 4</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 4</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 6</td>";
break;
case 4:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 4</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 5</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 3</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 6</td>";
break;
case 5:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 5</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 3</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 4</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 6</td>";
break;
case 6:
$tt = "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 1</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 1</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 1</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 15</td>";
break;
case 7:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 4</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 4</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 3</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 7</td>";
break;
case 8:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 3</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 4</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 4</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 7</td>";
break;
case 9:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 4</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 3</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 4</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 7</td>";
break;
case 10:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 3</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 5</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 4</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 6</td>";
break;
case 11:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 4</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 3</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 5</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 6</td>";
break;
case 12:
$tt =  "
<td><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"> 5</td>
<td><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"> 4</td>
<td><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"> 3</td>
<td><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"> 6</td>";
break;
case 0:
switch($basearray['oasistype']) {
case 1:
$tt =  "
<td class=\"ico\"><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".LUMBER."</td>";
break;
case 2:
$tt =  "
<td class=\"ico\"><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"></td>
<td class=\"val\">50%</td><td class=\"desc\">".LUMBER."</td>";
break;
case 3:
$tt =  "
<tr><td class=\"ico\"><img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".LUMBER."</td></tr>
<tr><td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".CROP."</td></tr>";
break;
case 4:
$tt =  "
<td class=\"ico\"><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".CLAY."</td>";
break;
case 5:
$tt =  "
<td class=\"ico\"><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"></td>
<td class=\"val\">50%</td><td class=\"desc\">".CLAY."</td>";
break;
case 6:
$tt =  "
<tr><td class=\"ico\"><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".CLAY."</td></tr>
<tr><td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".CROP."</td></tr>";
break;
case 7:
$tt =  "
<td class=\"ico\"><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".IRON."</td>";
break;
case 8:
$tt =  "
<td class=\"ico\"><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"></td>
<td class=\"val\">50%</td><td class=\"desc\">".IRON."</td>";
break;
case 9:
$tt =  "
<tr><td class=\"ico\"><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".IRON."</td></tr>
<tr><td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".CROP."</td></tr>";
break;
case 10:
case 11:
$tt =  "
<td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"></td>
<td class=\"val\">25%</td><td class=\"desc\">".CROP."</td>";
break;
case 12:
$tt =  "
<td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\"></td>
<td class=\"val\">50%</td><td class=\"desc\">".CROP."</td>";
break;
}
break;
}
echo $tt;
?>

			</tbody>
	</table>
    <?php if($basearray['fieldtype'] == 0 && !$basearray['occupied']) {
	?><br />
	<h4><?php echo TROOPS;?>:</h4>
    <table cellpadding="0" cellspacing="0" id="troop_info" class="transparent">
		<tbody>
            <?php         
        $unit = $database->getUnit($d);
        $unarray = array(31=>U31,U32,U33,U34,U35,U36,U37,U38,U39,U40);     
        $a = 0;
        for ($i = 31; $i <= 40; $i++) {
          if($unit['u'.$i]){
            echo '<tr>';
                      echo '<td class="ico"><img class="unit u'.$i.'" src="img/x.gif" alt="'.$unarray[$i].'" title="'.$unarray[$i].'" /></td>';
                      echo '<td class="val">'.$unit['u'.$i].'</td>';
                      echo '<td class="desc">'.$unarray[$i].'</td>';
                      echo '</tr>';                                             
                  }else{
            $a = $a+1;
          }
        }
        if($a == 10){
        echo '<tr><td>'.THEREARENOUNITS.'</td></tr>';
        }

     
      ?>
        </tbody>
	</table>
    <?php
}
else if ($basearray['occupied'] && !$basearray['oasistype']){
?><br />
    <h4>مشخصات بازیکن</h4>
	<table cellpadding="0" cellspacing="0" id="village_info" class="transparent">
    <?php $uinfo = $database->getUser($basearray['owner'],1); ?>
		<tbody>
			<tr class="first">
				<th><?php echo TRIBE;?></th>
				<td><?php switch($uinfo['tribe']) { case 1: echo TRIBE1; break; case 2: echo TRIBE2; break; case 3: echo TRIBE3; break; case 5: echo TRIBE5; break;} ?></td>
			</tr>
			<tr>
				<th><?php echo ALLIANCE;?></th>
				<?php if($uinfo['alliance'] == 0){
			echo '<td>-</td>';
			} else echo '
			<td><a href="allianz.php?aid='.$uinfo['alliance'].'">'.$database->getUserAlliance($basearray['owner']).'</a></td>'; ?>
			</tr>
			<tr>
				<th><?php echo OWNER;?></th>
				<td><a href="spieler.php?uid=<?php echo $basearray['owner']; ?>"><?php echo $database->getUserField($basearray['owner'],'username',0); ?></a></td>
			</tr>
			<tr>
				<th><?php echo POPULATION;?></th>
				<td><?php echo $basearray['pop']; ?></td>
			</tr>
		</tbody>
	</table>
    <?php } ?>
<br />

<h4><?php echo HEADER_REPORTS;?></h4>
    <table cellpadding="0" cellspacing="0" id="troop_info" class="rep transparent">
    <tbody>
<?php

$noticeClass = array(NOTICE1,NOTICE2,NOTICE3,NOTICE4,NOTICE5,NOTICE6,NOTICE7,NOTICE8,NOTICE9,NOTICE10,NOTICE11,NOTICE12,NOTICE13,NOTICE14,NOTICE15,
				NOTICE16,NOTICE17,NOTICE18,NOTICE19,NOTICE20,NOTICE21,NOTICE22,NOTICE23);
if($session->uid == $database->getVillage($d)){
	$limit = "ntype=0 and ntype=4 and ntype=5 and ntype=6 and ntype=7";
}else{
	$limit = "ntype!=8 and ntype!=9 and ntype!=10 and ntype!=11 and ntype!=12 and ntype!=13 and ntype!=14";
    }

$result = mysql_query("SELECT * FROM ".TB_PREFIX."ndata WHERE $limit AND uid = ".$session->uid." AND toWref = ".$d." ORDER BY time DESC Limit 5");

while($row = mysql_fetch_array($result)){
	$dataarray = explode(",",$row['data']);
	$type = $row['ntype'];
	echo "<tr><td>";
    echo "<img src=\"img/x.gif\" class=\"iReport iReport".$row['ntype']."\" title=\"".$noticeClass[$type]."\"> ";
    $date = $generator->procMtime($row['time']);
    echo "<a href=\"berichte.php?id=".$row['id']."\">".$date[0]." ".date('H:i',$row['time'])."</a> ";
    echo "</td></tr>";
}
?>
    </tbody>

</table>
</div></div>
<div class="clear"></div>
