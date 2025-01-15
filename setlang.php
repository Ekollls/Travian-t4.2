<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include('GameEngine/Session.php');
if (isset($_GET['setlang']) && $_GET['setlang']!=''){
	if ($_GET['setlang']=='en'){
		$session->setlang('en');
	}elseif ($_GET['setlang']=='fa'){
		$session->setlang('fa');
	}
}
if ($_SERVER['HTTP_REFERER']!='' && stripos($_SERVER['HTTP_REFERER'],'setlang')===false){
	header('Location: '.$_SERVER['HTTP_REFERER']);
} else {
	header('Location: dorf1.php');
}
?>
