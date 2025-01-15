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
//include("GameEngine/Session.php");
if(isset($_GET['uid'])){
    $uid =  $_GET['uid'];
} else {
    $uid = $session->uid;
}
if(isset($_GET['size'])){
	if($_GET['size']=='profile'){
    		$size =  '31x40';
	}elseif($_GET['size']=='inventory'){
    		$size =  '64x82';
			
	}elseif($_GET['size']=='sideinfo'){
    		$size =  '119x136';
	}else{
    		$size =  '119x136';
	}
} else {
    $size = "119x136";
}
$herodetail = $database->getHeroFace($uid);
if($herodetail['color']==0){
	$color = "black";
}
if($herodetail['color']==1){
	$color = "brown";
}
if($herodetail['color']==2){
	$color = "darkbrown";
}
if($herodetail['color']==3){
	$color = "yellow";
}
if($herodetail['color']==4){
	$color = "red";
}
$gender = $herodetail['gender']; if ($gender==0) {$gdir='male';} else {$gdir='female';}
$geteye = $herodetail['eye'];if ($gender==0) $geteye%=5;
$geteyebrow = $herodetail['eyebrow'];if ($gender==0) $geteyebrow%=5;
$getnose = $herodetail['nose'];if ($gender==0) $getnose%=5;
$getear = $herodetail['ear'];if ($gender==0) $getear%=5;
$getmouth = $herodetail['mouth'];if ($gender==0) $getmouth%=4;
$getbeard = $herodetail['beard']; if ($gender==1) $getbeard=5;
$gethair = $herodetail['hair'];if ($gender==0) $gethair%=5;
$getface = $herodetail['face'];if ($gender==0) $getface%=5;



// USAGE EXAMPLE: 
$body = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$size.'/face0.png');
if($getbeard!=5){
	$beard = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$size.'/beard/beard'.$getbeard.'-'.$color.'.png');
}
$eye = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$size.'/eye/eye'.$geteye.'.png');
$eyebrow = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$size.'/eyebrow/eyebrow'.$geteyebrow.(($gender==0)?'-'.$color:'').'.png');
if(!($gender==0 && $gethair==5)){
	$hair = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$size.'/hair/hair'.$gethair.'-'.$color.'.png');
}

$ear = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$size.'/ear/ear'.$getear.'.png');
$mouth = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$size.'/mouth/mouth'.$getmouth.'.png');
$nose = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$size.'/nose/nose'.$getnose.'.png');
$face = imagecreatefrompng('gpack/travian_Travian_4.2_BigBang/img/hero/'.$gdir.'/head/'.$size.'/face/face'.$getface.'.png');



// SAME COMMANDS: 
if($gethair!=5){
$database->imagecopymerge_alpha($body, $hair, 0, 0, 0, 0, imagesx($hair), imagesy($hair),100);
}

$database->imagecopymerge_alpha($body, $eye, 0, 0, 0, 0, imagesx($eye), imagesy($eye),100);
$database->imagecopymerge_alpha($body, $eyebrow, 0, 0, 0, 0, imagesx($eyebrow), imagesy($eyebrow),100);
$database->imagecopymerge_alpha($body, $face, 0, 0, 0, 0, imagesx($face), imagesy($face),100); 
$database->imagecopymerge_alpha($body, $ear, 0, 0, 0, 0, imagesx($ear), imagesy($ear),100);
$database->imagecopymerge_alpha($body, $mouth, 0, 0, 0, 0, imagesx($mouth), imagesy($mouth),100);
$database->imagecopymerge_alpha($body, $nose, 0, 0, 0, 0, imagesx($nose), imagesy($nose),100);
if($getbeard!=5){
$database->imagecopymerge_alpha($body, $beard, 0, 0, 0, 0, imagesx($beard), imagesy($beard),100);
}


// OUTPUT IMAGE: 
header("Content-Type: image/png"); 
imagesavealpha($body, true); 
imagepng($body);

?>
