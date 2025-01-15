<?php 
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include("GameEngine/Database.php");
if(isset($_GET['uid'])){
    $uid =  $_GET['uid'];
} else {
    $uid = $session->uid;
}
$heroFace = $database->getHeroFace($uid);
//print_r($heroFace);
$gender = $heroFace['gender']; if ($gender==0) {$gdir='male';} else {$gdir='female';}
if($gender==1){
	if(isset($_GET['size'])){
		if($_GET['size']=='profile'){
			$size =  '160x205';
			$fsize = '31x40';
			$w = 81;
			$h = 25;
		}elseif($_GET['size']=='inventory'){
			$size =  '330x422';
			$fsize = '64x82';
			$w = 166;
			$h = 51;
		}
	} else {
		$size = "330x422";
		$fsize = '64x82';
		$w = 166;
		$h = 51;
	}
}else {
	if(isset($_GET['size'])){
		if($_GET['size']=='profile'){
			$size =  '160x205';
			$fsize = '31x40';
			$w = 79;
			$h = 18;
		}elseif($_GET['size']=='inventory'){
			$size =  '330x422';
			$fsize = '64x82';
			$w = 163;
			$h = 37;
		}
	} else {
		$size = "330x422";
		$fsize = '64x82';
		$w = 163;
		$h = 37;
	}
}
if($heroFace['color']==0){$color = "black";}
if($heroFace['color']==1){$color = "brown";}
if($heroFace['color']==2){$color = "darkbrown";}
if($heroFace['color']==3){$color = "yellow";}
if($heroFace['color']==4){$color = "red";}
$geteye = $heroFace['eye'];if ($gender==0) $geteye%=5;
$geteyebrow = $heroFace['eyebrow'];if ($gender==0) $geteyebrow%=5;
$getnose = $heroFace['nose'];if ($gender==0) $getnose%=5;
$getear = $heroFace['ear'];if ($gender==0) $getear%=5;
$getmouth = $heroFace['mouth'];if ($gender==0) $getmouth%=4;
$getbeard = $heroFace['beard'];if ($gender==1) $getbeard=5;
$gethair = $heroFace['hair'];if ($gender==0) $gethair%=5;
$getface = $heroFace['face'];if ($gender==0) $getface%=5;
$getfoot = $heroFace['foot'];

$gethelmet = 0;
if($heroFace['helmet']>0){$result = $database->getHeroItem($heroFace['helmet']);$gethelmet = $result['type'];}
$getbody = 0;
if($heroFace['body']>0){$result = $database->getHeroItem($heroFace['body']);$getbody = $result['type'];}
$getleftHand = 0;
if($heroFace['leftHand']>0){$result = $database->getHeroItem($heroFace['leftHand']);$getleftHand = $result['type'];}
$getrightHand = 0;
if($heroFace['rightHand']>0){$result = $database->getHeroItem($heroFace['rightHand']);$getrightHand = $result['type'];}
$getshoes = 0;
if($heroFace['shoes']>0){$result = $database->getHeroItem($heroFace['shoes']);$getshoes = $result['type'];}
$gethorse = 0;
if($heroFace['horse']>0){$result = $database->getHeroItem($heroFace['horse']);$gethorse = $result['type'];}
$getbag = 0;
if($heroFace['bag']>0){$result = $database->getHeroItem($heroFace['bag']);$getbag = $result['type'];}

// HERO FACE:
$face0 = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$fsize.'/face0.png');
$face = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$fsize.'/face/face'.$getface.'.png');
$ear = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$fsize.'/ear/ear'.$getear.'.png');
$eye = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$fsize.'/eye/eye'.$geteye.'.png');
$eyebrow = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$fsize.'/eyebrow/eyebrow'.$geteyebrow.(($gender==0)?'-'.$color:'').'.png');
if($gethair!=5){
	$hair = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$fsize.'/hair/hair'.$gethair.'-'.$color.'.png');
}
$mouth = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$fsize.'/mouth/mouth'.$getmouth.'.png');
$nose = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$fsize.'/nose/nose'.$getnose.'.png');
if($getbeard!=5){
	$beard = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$fsize.'/beard/beard'.$getbeard.'-'.$color.'.png');
}

if($gethelmet>=1 && $gethelmet<=3){
	$helmet = '0_'.($gethelmet-1);
}elseif($gethelmet>=4 && $gethelmet<=6){
	$helmet = '1_'.($gethelmet-4);
}elseif($gethelmet>=7 && $gethelmet<=9){
	$helmet = '2_'.($gethelmet-7);
}elseif($gethelmet>=10 && $gethelmet<=12){
	$helmet = '3_'.($gethelmet-10);
}elseif($gethelmet>=13 && $gethelmet<=15){
	$helmet = '4_'.($gethelmet-13);
}

if($getbody>=82 && $getbody<=84){
	$armor = '0_'.($getbody-82);
}elseif($getbody>=85 && $getbody<=87){
	$armor = '1_'.($getbody-85);
}elseif($getbody>=88 && $getbody<=90){
	$armor = '2_'.($getbody-88);
}elseif($getbody>=91 && $getbody<=93){
	$armor = '3_'.($getbody-91);
}

if($getshoes>=94 && $getshoes<=96){
	$shoes = '0_'.($getshoes-94);
}elseif($getshoes>=97 && $getshoes<=99){
	$shoes = '1_'.($getshoes-97);
}elseif($getshoes>=100 && $getshoes<=102){
	$shoes = '2_'.($getshoes-100);
}

if($getleftHand==0){
	$leftHand = 'leftHand';
}elseif($getleftHand>=61 && $getleftHand<=63){
	$leftHand = 'map0';
}elseif($getleftHand>=64 && $getleftHand<=66){
	$leftHand = 'flag0';
}elseif($getleftHand>=67 && $getleftHand<=69){
	$leftHand = 'flag1';
}elseif($getleftHand>=73 && $getleftHand<=75){
	$leftHand = 'sack0';
}elseif($getleftHand>=76 && $getleftHand<=78){
	$leftHand = 'shield0';
}elseif($getleftHand>=79 && $getleftHand<=81){
	$leftHand = 'horn0';
}

if($getrightHand==0){
	$rightHand = 'rightHand';
}elseif($getrightHand>=16 && $getrightHand<=18){
	$rightHand = 'sword0';
}elseif($getrightHand>=19 && $getrightHand<=21){
	$rightHand = 'sword1';
}elseif($getrightHand>=22 && $getrightHand<=24){
	$rightHand = 'sword2';
}elseif($getrightHand>=25 && $getrightHand<=27){
	$rightHand = 'sword3';
}elseif($getrightHand>=28 && $getrightHand<=30){
	$rightHand = 'lance0';
}elseif($getrightHand>=31 && $getrightHand<=33){
	$rightHand = 'spear0';
}elseif($getrightHand>=34 && $getrightHand<=36){
	$rightHand = 'sword4';
}elseif($getrightHand>=37 && $getrightHand<=39){
	$rightHand = 'bow0';
}elseif($getrightHand>=40 && $getrightHand<=42){
	$rightHand = 'staff0';
}elseif($getrightHand>=43 && $getrightHand<=45){
	$rightHand = 'spear1';
}elseif($getrightHand>=46 && $getrightHand<=48){
	$rightHand = 'club0';
}elseif($getrightHand>=49 && $getrightHand<=51){
	$rightHand = 'spear2';
}elseif($getrightHand>=52 && $getrightHand<=54){
	$rightHand = 'axe0';
}elseif($getrightHand>=55 && $getrightHand<=57){
	$rightHand = 'hammer0';
}elseif($getrightHand>=58 && $getrightHand<=60){
	$rightHand = 'sword5';
}

$bag = 0;
if($getbag>=112 && $getbag<=114){
	$bag = $getbag;
}

// HERO BODY: 
$body = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/body/'.$size.'/hero_body0.png'); 
if($gethelmet!=0){
	$helmet = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/body/'.$size.'/helmet'.$helmet.'.png'); 
}
if($getbody!=0){
	$armor = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/body/'.$size.'/shirt'.$armor.'.png'); 
}
$leftHand = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/body/'.$size.'/'.$leftHand.'.png'); 
$rightHand = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/body/'.$size.'/'.$rightHand.'.png');
if($getshoes!=0){
	$shoes = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/body/'.$size.'/shoes'.$shoes.'.png'); 
}
if($gethorse!=0){
	$horse = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/body/'.$size.'/horse0.png'); 
}
if($getbag!=0){
	$bag = imagecreatefromgif('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/items/item'.$getbag.'.gif'); 
}


if($gethorse!=0){
	$database->imagecopymerge_alpha($horse, $body, 0, 0, 0, 0, imagesx($body), imagesy($body),100);
	$body = $horse;
}

$database->imagecopymerge_alpha($body, $face0, $w, $h, 0, 0, imagesx($face0), imagesy($face0),100); 
$database->imagecopymerge_alpha($body, $face, $w, $h, 0, 0, imagesx($face), imagesy($face),100); 
$database->imagecopymerge_alpha($body, $ear, $w, $h, 0, 0, imagesx($ear), imagesy($ear),100);
$database->imagecopymerge_alpha($body, $eye, $w, $h, 0, 0, imagesx($eye), imagesy($eye),100);
$database->imagecopymerge_alpha($body, $eyebrow, $w, $h, 0, 0, imagesx($eyebrow), imagesy($eyebrow),100);
if(!($gender==0 && $gethair==5) && !isset($helmet)){
	$database->imagecopymerge_alpha($body, $hair, $w, $h, 0, 0, imagesx($hair), imagesy($hair),100);
}
$database->imagecopymerge_alpha($body, $mouth, $w, $h, 0, 0, imagesx($mouth), imagesy($mouth),100);
$database->imagecopymerge_alpha($body, $nose, $w, $h, 0, 0, imagesx($nose), imagesy($nose),100);
if($getbeard!=5){
	$database->imagecopymerge_alpha($body, $beard, $w, $h, 0, 0, imagesx($beard), imagesy($beard),100);
}
if($getshoes!=0){
	$database->imagecopymerge_alpha($body, $shoes, 0, 0, 0, 0, imagesx($shoes), imagesy($shoes),100); 
}
if($getbody!=0){
	$database->imagecopymerge_alpha($body, $armor, 0, 0, 0, 0, imagesx($armor), imagesy($armor),100); 
}
$database->imagecopymerge_alpha($body, $rightHand, 0, 0, 0, 0, imagesx($rightHand), imagesy($rightHand),100);
$database->imagecopymerge_alpha($body, $leftHand, 0, 0, 0, 0, imagesx($leftHand), imagesy($leftHand),100); 
if($gethelmet!=0){
	$database->imagecopymerge_alpha($body, $helmet, 0, 0, 0, 0, imagesx($helmet), imagesy($helmet),100); 
}
if(($getbag!=0) and ($_GET['size']=='inventory')){
	//$database->imagecopymerge_alpha($body, $bag, 0, 0, 0, 0, imagesx($bag), imagesy($bag),100); 
}

// OUTPUT IMAGE: 
header("Content-Type: image/png"); 
imagesavealpha($body, true); 
imagepng($body, NULL); 
?>
