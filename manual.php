<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

include("GameEngine/Protection.php");
include("GameEngine/Session.php");
?>

<html>
	<head>
	<title><?php echo SERVER_NAME; ?></title>
        <link REL="shortcut icon" HREF="favicon.ico"/>
	<meta name="content-language" content="<?php echo $_SESSION['lang']; ?>" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-core.js?0faaa" type="text/javascript"></script>
	<script src="mt-more.js?0faaa" type="text/javascript"></script>
	<script src="unx.js?0faaa" type="text/javascript"></script>
	<script src="new.js?0faaa" type="text/javascript"></script>
   	<link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/compact.css?f4b7c" rel="stylesheet" type="text/css" />
   	<link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>travian.css?f4b7c" rel="stylesheet" type="text/css" />
    	<link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/lang.css" rel="stylesheet" type="text/css" />	
       </head>
    <body class="manual">
<?php

if (!isset($_GET['s']) || !ctype_digit($_GET['s'])) {
	$_GET['s'] = "0";
}
if (!isset($_GET['typ']) || !ctype_digit($_GET['typ'])) {
	$_GET['typ'] = null;
}
if(!isset($_GET['typ']) && !isset($_GET['s'])) {
	include("Templates/Manual/00.tpl");
}
else if (!isset($_GET['typ']) && $_GET['s'] == 1) {
	include("Templates/Manual/00.tpl");
}
else if (!isset($_GET['typ']) && $_GET['s'] == 2) {
	include("Templates/Manual/direct.tpl");
}
else if (isset($_GET['typ']) && $_GET['typ'] == 5 && $_GET['s'] == 3) {
	include("Templates/Manual/medal.tpl");
}
else {
	if(isset($_GET['gid'])) {
		include("Templates/Manual/".$_GET['typ'].($_GET['gid']).".tpl");
	}
	else {
		if($_GET['typ'] == 4 && $_GET['s'] == 0) {
			$_GET['s'] = 1;
		}
	include("Templates/Manual/".$_GET['typ'].$_GET['s'].".tpl");
	}
}
?>
</body>

</html>
