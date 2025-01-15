<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include('GameEngine/Protection.php');
$gvresult = 2;
include('GameEngine/Database.php');
echo 'GVResult:\n';
$server = isset($_POST['server'])?$_POST['server']:'';
$username = isset($_POST['username'])?$_POST['username']:'';
$gold = isset($_POST['gold'])?intval($_POST['gold']):'';
$ref = isset($_POST['ref'])?$_POST['ref']:'';
if(strlen($server)>0 && strlen($username)>0 && $gold>0 && strlen($ref)>0){
	$sig = SECSIG;
	$myref = sha1($username.':sig'.$sig.':'.$server.'server:'.$gold);
	if($myref==$ref){
		$userData = $database->getUser($username);
		if (!empty($userData)) {
			$database->modifyUser($userData['id'],'gold',$userData['gold']+$gold,0);
			$database->modifyUser($userData['id'],'transferedgold',$userData['transferedgold']+$gold,0);
			$gvresult = 21;
		} else {
			$gvresult = 5;
		}
	} else {
		$gvresult = 4;
	}
} else {
	$gvresult = 3;
}

echo 'resultcode='.$gvresult.'\n';
?>
