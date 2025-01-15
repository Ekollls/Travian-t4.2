<?php if($session->plus) { ?>
<div id="content" class="map">

<div class="t2"></div>

<?php
if(isset($_GET['d']) && isset($_GET['c'])) {
	if($generator->getMapCheck($_GET['d']) == $_GET['c']) {
        $wref = $_GET['d'];
        $coor = $database->getCoor($wref);
        $x = $coor['x'];
        $y = $coor['y'];
	}
}
else if(isset($_GET['x']) && isset($_GET['y'])) {
    $x = $_GET['x'];
    $y = $_GET['y'];
    $bigmid = $generator->getBaseID($x,$y);
}
else if(isset($_POST['xp']) && isset($_POST['yp'])){
	$x = $_POST['xp'];
    $y = $_POST['yp'];
    $bigmid = $generator->getBaseID($x,$y);
}
else {
    $y = $village->coor['y'];
	$x = $village->coor['x'];
    $bigmid = $village->wid;
}


$yarray = array();
for($i=5;$i>=-5;$i--){
	$tmp = $y+$i;
	if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
	if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
	$yarray[] = $tmp;
}

$xarray = array();
for($i=-10;$i<=11;$i++){
	$tmp = $x+$i;
	if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
	if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
	$xarray[] = $tmp;
}
//print_r($xarray);
//print_r($yarray);

$maparray = array();
for($i=0;$i<=10;$i++) {
    for($j=0;$j<=21;$j++) {
    	array_push($maparray,$database->getMInfo($generator->getBaseID($xarray[$j],$yarray[$i])));
	}
}
echo "<h1 dir=\"rtl\">".HEADER_MAP." (<span id=\"x\">".$x."</span>|<span id=\"y\">".$y."</span>)</h1>";
$row = 0;
$coorindex = 0;
?>

<div class="map2 lowRes">
	<div id="mapContainer" class="lowRes" style="position:absolute;left:-5px;top:0px; width:1320px; height: 600px; display: block; ">
<div class="mapContainerData" id="mapData" style="width:1320px;height:600px; margin-right:-18px;">
<?php

$nareadis = sqrt(NATARS_MAX*NATARS_MAX);
for($i=0;$i<=241;$i++) {
	$maparray[$i]['zerodis'] = sqrt(($maparray[$i]['x']*$maparray[$i]['x'])+($maparray[$i]['y']*$maparray[$i]['y']));
	if ($maparray[$i]['zerodis']<=$nareadis) {$maparray[$i]['isgraytile']=true;} else {$maparray[$i]['isgraytile']=false;}
}

$index = 0;
$row1 = 0;
for($i=0;$i<=241;$i++) {
	$targetalliance = 0;
	$tribe = -1;
	$username = '';
	$oasisowner = '';
	$confedarray = array();
	$atwararray = array();
	$naparray = array();
	if($maparray[$index]['occupied'] > 0) {
		$targetalliance = $database->getUserField($maparray[$index]['owner'],"alliance",0);
		$tribe = $database->getUserField($maparray[$index]['owner'],"tribe",0);
		$username = $database->getUserField($maparray[$index]['owner'],"username",0);
		$oasisowner = $database->getUserField($maparray[$index]['owner'],"username",0);
    }
	
	$bgcolorclass = 'tilebgcolor';
	$bgimgclass0 = 'tilespbgimg';
	$bgimgclass1 = '';
	$bgimgclass2 = '';
	$bgimgclass3 = '';
	$borderclass = 'border';
	$wallclass = 'wall'.$tribe;
	$popclass = 'pop';

	if($tribe==1) {
    	$tribename = "Roman";
    }elseif($tribe==2) {
    	$tribename = "Teuton";
    }elseif($tribe==3) {
    	$tribename = "Gaul";
    }elseif($tribe==5) {
    	$tribename = "Natar";
    }
	
	if($maparray[$index]['pop']<=0){
		$popclass .= $maparray[$index]['image'];
	} elseif($maparray[$index]['pop']<100){
		$popclass .= '99';
	} elseif($maparray[$index]['pop']<250){
		$popclass .= '249';
	} elseif($maparray[$index]['pop']<500){
		$popclass .= '499';
	} else {
		$popclass .= '500';
	}
	if($maparray[$index]['owner']==$session->uid){
		$borderclass .= 'own';
	}elseif($targetalliance != 0 && $session->alliance == $targetalliance){
		$borderclass .= 'confed';
	}elseif($targetalliance != 0 && in_array($targetalliance,$confedarray)){
		$borderclass .= 'confed';
	}elseif($targetalliance != 0 && in_array($targetalliance,$naparray)){
		$borderclass .= 'nap';
	}elseif($targetalliance != 0 && in_array($targetalliance,$atwararray)){
		$borderclass .= 'atwar';
	}else{
		$borderclass .= 'neutr';
	}
	switch($maparray[$index]['fieldtype']) {
		case 1:$tt =  "3-3-3-9";break;
		case 2:$tt =  "3-4-5-6";break;
		case 3:$tt =  "4-4-4-6";break;
		case 4:$tt =  "4-5-3-6";break;
		case 5:$tt =  "5-3-4-6";break;
		case 6:$tt =  "1-1-1-15";break;
		case 7:$tt =  "4-4-3-7";break;
		case 8:$tt =  "3-4-4-7";break;
		case 9:$tt =  "4-3-4-7";break;
		case 10:$tt =  "3-5-4-6";break;
		case 11:$tt =  "4-3-5-6";break;
		case 12:$tt =  "5-4-3-6";break;
		case 0:
			switch($maparray[$index]['oasistype']) {
				case 1:$tt =  "<img class='r1' src='img/x.gif' /> ".WOOD." 25%"; $bgimgclass3 = 'o1';break;
				case 2:$tt =  "<img class='r1' src='img/x.gif' /> ".WOOD." 50%"; $bgimgclass3 = 'o2';break;
				case 3:$tt =  "<img class='r1' src='img/x.gif' /> ".WOOD." 25%<br><img class='r4' src='img/x.gif' /> ".CROP." 25%"; $bgimgclass3 = 'o3';break;
				case 4:$tt =  "<img class='r2' src='img/x.gif' /> ".CLAY." 25%"; $bgimgclass3 = 'o4';break;
				case 5:$tt =  "<img class='r2' src='img/x.gif' /> ".CLAY." 50%"; $bgimgclass3 = 'o5';break;
				case 6:$tt =  "<img class='r2' src='img/x.gif' /> ".CLAY." 25%<br><img class='r4' src='img/x.gif' /> ".CROP." 25%"; $bgimgclass3 = 'o6';break;
				case 7:$tt =  "<img class='r3' src='img/x.gif' /> ".IRON." 25%"; $bgimgclass3 = 'o7';break;
				case 8:$tt =  "<img class='r3' src='img/x.gif' /> ".IRON." 50%"; $bgimgclass3 = 'o8';break;
				case 9:$tt =  "<img class='r3' src='img/x.gif' /> ".IRON." 25%<br><img class='r4' src='img/x.gif' /> ".CROP." 25%"; $bgimgclass3 = 'o9';break;
				case 10:case 11:$tt =  "<img class='r4' src='img/x.gif' /> ".CROP." 25%"; $bgimgclass3 = 'o10';break;
				case 12:$tt =  "<img class='r4' src='img/x.gif' /> ".CROP." 50%"; $bgimgclass3 = 'o12';break;
			}
			if($maparray[$index]['occupied']){
				$bgimgclass3 .= "o";
			}
		break;
	}
				
    if($targetalliance!=0) {
    	$allyname = $database->getAllianceName($targetalliance);
    } else {$allyname='';}
        
    $odata = $database->getOMInfo($maparray[$index]['id']);
    $uinfo = $database->getUserField($odata['owner'],'username',0);
    if (DIRECTION == 'ltr'){
			$targetXYText = '('.$maparray[$index]['x']."|".$maparray[$index]['y'].')';
	} elseif (DIRECTION == 'rtl'){
			$targetXYText = '('.$maparray[$index]['y']."|".$maparray[$index]['x'].')';
	}
	if(defined($maparray[$index]['name'])){$maparray[$index]['name'] = constant($maparray[$index]['name']);}
    if($maparray[$index]['fieldtype'] > 0 && $maparray[$index]['occupied'] == 1) {
		$targettitle = "<font color='white'><b>".VILLAGE.": ".$maparray[$index]['name']."</b></font><br>".$targetXYText."<br>".PLAYER.": ".$username."<br>".POPULATION.": ".$maparray[$index]['pop']."<br>".ALLIANCE.": ".$allyname."<br>".TRIBE.": ".$tribename."";
    }
    if($maparray[$index]['oasistype'] == 0 && $maparray[$index]['occupied'] == 0) {
		$targettitle = "<font color='white'><b>".ABANDONEDVALLEY." ".$tt."</b></font><br>".$targetXYText;
    }
    
    if($maparray[$index]['fieldtype'] == 0 && $maparray[$index]['oasistype'] > 0 && $maparray[$index]['occupied'] == 0) {
		$targettitle = "<font color='white'><b>".UNOCCUPIEDOASIS."</b></font><br />".$targetXYText."<br />".$tt."";
    }elseif($maparray[$index]['fieldtype'] == 0 && $maparray[$index]['oasistype'] > 0 && $maparray[$index]['occupied'] > 0) {
		$targettitle = "<font color='white'><b>".OCCUPIEDOASIS."</b></font><br /> ".$targetXYText."<br />".$tt."<br>".PLAYER.": ".$uinfo."<br>".ALLIANCE.": ".$allyname."<br>".TRIBE.": ".$tribename."";
    }

    if(!$maparray[$index]['fieldtype'] && $maparray[$index]['oasistype'] && $maparray[$index]['occupied']){
    	$occupied = "-s";
    }else{
		$occupied = "";
	}
	
	if($maparray[$index]['isgraytile']){
		if ($maparray[$index]['x']==-1 && $maparray[$index]['y']==1){$bgimgclass2 = 'volcano volcano1';
		}elseif ($maparray[$index]['x']==0 && $maparray[$index]['y']==1){$bgimgclass2 = 'volcano volcano2';
		}elseif ($maparray[$index]['x']==1 && $maparray[$index]['y']==1){$bgimgclass2 = 'volcano volcano3';
		}elseif ($maparray[$index]['x']==-2 && $maparray[$index]['y']==0){$bgimgclass2 = 'volcano volcano4';
		}elseif ($maparray[$index]['x']==-1 && $maparray[$index]['y']==0){$bgimgclass2 = 'volcano volcano5';
		}elseif ($maparray[$index]['x']==0 && $maparray[$index]['y']==0){
			$bgimgclass2 = 'volcano volcano6';
			$wallclass = '';
			$popclass = '';
			$targettitle = "<font color='white'><b>".ABANDONEDVALLEY." ".$tt."</b></font><br>(".$maparray[$index]['x']."|".$maparray[$index]['y'].")";
		}elseif ($maparray[$index]['x']==1 && $maparray[$index]['y']==0){$bgimgclass2 = 'volcano volcano7';
		}elseif ($maparray[$index]['x']==2 && $maparray[$index]['y']==0){$bgimgclass2 = 'volcano volcano8';
		}elseif ($maparray[$index]['x']==-2 && $maparray[$index]['y']==-1){$bgimgclass2 = 'volcano volcano9';
		}elseif ($maparray[$index]['x']==-1 && $maparray[$index]['y']==-1){$bgimgclass2 = 'volcano volcano10';
		}elseif ($maparray[$index]['x']==0 && $maparray[$index]['y']==-1){$bgimgclass2 = 'volcano volcano11';
		}elseif ($maparray[$index]['x']==1 && $maparray[$index]['y']==-1){$bgimgclass2 = 'volcano volcano12';
		}elseif ($maparray[$index]['x']==2 && $maparray[$index]['y']==-1){$bgimgclass2 = 'volcano volcano13';
		}elseif ($maparray[$index]['x']==-2 && $maparray[$index]['y']==-2){$bgimgclass2 = 'volcano volcano14';
		}elseif ($maparray[$index]['x']==-1 && $maparray[$index]['y']==-2){$bgimgclass2 = 'volcano volcano15';
		}elseif ($maparray[$index]['x']==0 && $maparray[$index]['y']==-2){$bgimgclass2 = 'volcano volcano16';
		}elseif ($maparray[$index]['x']==1 && $maparray[$index]['y']==-2){$bgimgclass2 = 'volcano volcano17';
		}elseif ($maparray[$index]['x']==2 && $maparray[$index]['y']==-2){$bgimgclass2 = 'volcano volcano18';
		}else{
			for($rc=0;$rc<3;$rc++){
				for($tc=0;$tc<3;$tc++){
					$cx = $maparray[$index]['x']+$tc-1;
					$cy = $maparray[$index]['y']-$rc+1;
					$cdis = sqrt(($cx*$cx)+($cy*$cy));
					if ($cdis<=$nareadis) {	$bgimgclass0 .= '1';} else {$bgimgclass0 .= '0';}
				}
			}
		}
		$bgcolorclass .= 'gray';
	}
	
	$bgimgclass1 = $maparray[$index]['image'];

    echo '<a href="position_details.php?x='.$maparray[$index]['x'].'&y='.$maparray[$index]['y'].'" style="cursor:deLumberult;">'
		.'<div class="tile tile-'.$i.'-row'.$row1.' '.$bgcolorclass.'" title="'.$targettitle.'">'
		.'<div class="timg '.$bgimgclass0.'">'
		.'<div class="timg '.$bgimgclass1.'">'
		.'<div class="timg '.$bgimgclass2.'">'
		.'<div class="timg '.$bgimgclass3.'">'
		.'<div class="timg '.$borderclass.'">'
		.'<div class="timg '.$wallclass.'">'
		.'<div class="timg '.$popclass.'">';
    if($session->plus) {
    	$wref = $village->wid;
        $toWref = $maparray[$index]['id'];
    	if ($database->checkAttack($wref,$toWref) != 0) {
			echo '<img style="margin-right:45px;" class="att1" src="img/x.gif" />';
		}
    }
    echo '</div></div></div></div></div></div></div></div></a>';
    
    
	if($i == 8 || $i == 17 || $i == 26 && $row1 <= 5) {
		$row1 += 1;
	}
	
	$index+=1;
}
?>

<div class="clear"></div>
	<div class="ruler x" style="background-color:#FFF; height:23px;">
		<div class="rulerContainer">
			<?php
			for($i=0;$i<=21;$i++) {
				echo "<div class=\"coordinate zoom1\">".$xarray[$i]."</div>\n";
			}
			?>
			<div class="clear"></div>
		</div>
	</div>
	<div class="ruler y" style="height:660px;">
		<div class="rulerContainer">
			<?php
			for($i=0;$i<=10;$i++) {
				echo "<div class=\"coordinate zoom1\">".$yarray[$i]."</div>\n";
			}
			?>
		</div>
	</div>
</div>
		<div class="navigation" style="margin-bottom: -65px;">
			<a href="karte2.php?x=<?php echo $xarray[9]; ?>&y=<?php echo $yarray[5]; ?>" id="navigationMoveLeft" class="moveLeft"><img src="img/x.gif" title="move left"></a>
			<a href="karte2.php?x=<?php echo $xarray[11]; ?>&y=<?php echo $yarray[5]; ?>" id="navigationMoveRight" class="moveRight"><img src="img/x.gif" title="move right"></a>
			<a href="karte2.php?x=<?php echo $xarray[10]; ?>&y=<?php echo $yarray[4]; ?>" id="navigationMoveUp" class="moveUp"><img src="img/x.gif" title="move up"></a>
			<a href="karte2.php?x=<?php echo $xarray[10]; ?>&y=<?php echo $yarray[6]; ?>" id="navigationMoveDown" class="moveDown"><img src="img/x.gif" title="move down"></a>
			<a href="karte.php?x=<?php echo $xarray[9];?>&y=<?php echo $yarray[5];?>" id="navigationFullScreen" class="viewFullScreen normal"><img src="img/x.gif" alt="normál" title="normál térkép"></a>
		</div>
		<form id="mapCoordEnter" name="map_coords" method="post" action="karte2.php" class="toolbar" style="margin-bottom: -60px;">
	<div class="ml">
		<div class="mr">
			<div class="mc">
				<div class="contents">
			<div class="coordinatesInput">
            <?php
            if(isset($_GET['x']) && isset($_GET['y'])) {
					$x = $_GET['x'];
					$y = $_GET['y'];
            }else{
				//$x = "0";
				//$y = "0";
            }
            ?>
				<div class="xCoord">
					<label for="xCoordInputMap">X:</label>
                    <input id="mcx" class="text" name="xp" value="<?php echo $x;?>" maxlength="4"/>
				</div>
				<div class="yCoord">
					<label for="yCoordInputMap">Y:</label>
					<input id="mcy" class="text" name="yp" value="<?php echo $y;?>" maxlength="4"/>
				</div>
			</div>
			<button type="submit" value="OK" class="small"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo OK;?></div></div></button><div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</form>	</div>
</div>
<script type="text/javascript">
		window.addEvent('domready', function()
	{
		
		Travian.Game.Map.LowRes.Options.DeLumberult.tileDisplayInformation.type = 'dialog';
		new Travian.Game.Map.LowRes.Container($merge(Travian.Game.Map.LowRes.Options.DeLumberult,
		{
			fullScreen:	true,
			mapInitialPosition:
			{
				x:	<?php echo $x; ?>,
				y:	<?php echo $y; ?>			}
		}));
	});
</script></div> <?php } ?>
