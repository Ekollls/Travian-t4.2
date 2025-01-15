<?php
error_reporting(0);
include("GameEngine/Protection.php");
include("GameEngine/Village.php");
include("Templates/Plus/price.tpl");
if(!isset($_GET['c'])) { exit('Undefined package'); };
$c = @mysql_real_escape_string($_GET['c']);
foreach ($AppConfig['plus']['packages'] as $pkg) {
	if ($c==$pkg['id']) {
		break;
	}
}
?>
<!doctype html>
<html>
<head>
<script src="jquery.js"></script>
<meta charset="utf-8">
<title>پرداخت</title>
</head>
<body style="direction:rtl;font-family:tahoma;background-color:#CCC;">
<div style="background-color:#FFF;padding:5px;min-height:500px;">
<table>
<tr><td>مبلغ: </td><td><b><?=$pkg['cost']?></b> تومان</td></tr>
<tr><td>توضیحات: </td><td>خرید بسته <b><?=$pkg['name']?></b> شامل تعداد <b><?=$pkg['gold']?></b> سکه طلای تراوین</td></tr>
<tr><td>کاربر: </td><td><b><?=$session->username;?></b></td></tr>
<tr><td>تایم استامپ: </td><td><?=time()?></td></tr>
</table>
<form id="form" action="" method="post">
<input type="hidden" name="timestamp" value="<?=time()?>">
<input type="hidden" name="package" value="<?=$pkg['id']?>">
<input type="hidden" name="cost" value="<?=$pkg['cost']?>">
<input type="hidden" name="user" value="<?=$session->username;?>">
<table>
<?php


for($i=0;$i<=5;$i++) {
	if( file_exists("Gateways/".$i."/info.php") && file_exists("Gateways/".$i."/icon.png")) {
		include "Gateways/".$i."/info.php";
		echo '<tr><td><input name="gw" type="radio" onClick="'.'$(\'#form\').attr(\'action\',\''."Gateways/".$i."/start.php".'\')" value="">پرداخت از طریق درگاه '.$gw['name'].'</td><td><img src="'."Gateways/".$i."/icon.png".'"></td>';
		
		
		
		
		
	}
}








?>
</table>
<center>
<input style="font-family:tahoma;width:300px;" type="submit" value="پرداخت">
</center>
</form>
</div>
</body>
</html>