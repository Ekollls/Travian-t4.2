<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include("GameEngine/Village.php");
include("Templates/Plus/price.tpl");
if(isset($_GET['product']) && isset($_GET['provider']) && is_string($_GET['provider']) && ctype_digit($_GET['product'])){
	$prod = $_GET['product'];
	$prov = $_GET['provider'];
	if(isset($AppConfig['plus']['packages'][$prod]) && isset($AppConfig['plus']['payments'][$prov])){
		$prod = $AppConfig['plus']['packages'][$prod];
		$prov = $AppConfig['plus']['payments'][$prov];
		include $prov['start'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>پرداخت - <?=$prov['name']?></title>
<style>
body {
	direction:rtl;font-family:tahoma;font-size:13px;
}
</style>
</head>
<body>
<br>
<center>
<img src="img/plus/<?=$prov['image']?>"><br><br>
در حال تهیه <strong><?=$prod['name']?></strong> دارای <strong><?=$prod['gold']?></strong> طلا با قیمت <strong><?=$prod['cost']?></strong> تومان<br>
<?php
if(strlen($g_url) > 2) {
?>
تا چند لحظه دیگر به <strong><?=$prov['name']?></strong> منتقل می شوید<br><br>
لطفا کمی صبر کنید...<br>
<img src="img/plus/loading.gif">
</center>
<script type="text/javascript">
window.setTimeout(function() {
location.href = '<?=$g_url?>';
}, 6000);
</script>
<?php }else{
?>
<br>
<a style="color:#F00">خطا در پردازش درگاه: <?=$g_error?></a></center>
<?php } ?>
</body>
</html>
<?php
	}else{exit("Something went wrong...");}
}else{exit("Something went wrong...");}
?>