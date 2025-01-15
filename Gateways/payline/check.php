<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>نتیجه پرداخت</title>
<style>
body {
	direction:rtl;font-family:tahoma;font-size:13px;
}
</style>
</head>
<body>
<br>
<center>
<?php
error_reporting(0);
if(file_exists("../../GameEngine/Config.php")) {
	include "../../GameEngine/Config.php";
}else{
	include "../../GameEngine/config.php";
}
include "../../Templates/Plus/price.tpl";
$api = $AppConfig['plus']['payments']['payline']['api'];

@header('Content-Type: text/html; charset=utf-8');
function get($a,$b,$c,$d){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$a);
	curl_setopt($ch,CURLOPT_POSTFIELDS,"api=$b&id_get=$d&trans_id=$c");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}
$url = 'http://payline.ir/payment/gateway-result-second';
if($AppConfig['plus']['payments']['payline']['test']) {
	$url = 'http://payline.ir/payment-test/gateway-result-second';
}
$trans_id = $_POST['trans_id'];
$id_get = $_POST['id_get'];
$result = get($url,$api,$trans_id,$id_get);
mysql_query("UPDATE payment_payline SET trans_id='$trans_id' WHERE id_get='$id_get'");
switch($result) {
	default: { echo "خطایی نامشخص رخ داد"; break; };
	case "-1": { echo "api ارسالی با نوع api تعریف شده در payline سازگار نیست"; break; };
	case "-2": { echo "trans_id ارسال شده معتبر نمی باشد"; break; };
	case "-3": { echo "id_get ارسال شده معتبر نمی باشد"; break; };
	case "-4": { echo "چنین تراکنشی در سیستم وجود ندارد و یا موفقیت آمیز نبوده است"; break; };
	case "1": { $success = true; break; };
}

if ($success) {
	$result = mysql_query("SELECT * FROM payment_payline WHERE id_get='$id_get'");
	$row = mysql_fetch_array($result);
	if(@$row['status']=="pending") {
		mysql_query("UPDATE payment_payline SET status='paid' WHERE id_get='$id_get'");
		mysql_query("UPDATE payment_payline SET paid='".time()."' WHERE id_get='$id_get'");
		$gold = 0;
		foreach ($AppConfig['plus']['packages'] as $pkg) {
			if ($row['amount']==$pkg['cost']) {
				$gold = $pkg['gold'];
				break;
			}
		}
		mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold + $gold, boughtgold = boughtgold + $gold WHERE username='".$row['user']."'");
		// ADD CREDIT TO USER's ACCOUNT
		echo "پرداخت شما به مبلغ ".$row['amount']." تومان با موفقیت انجام شد";
	}else{
		echo "این پرداخت قبلا محاسبه شده است.";
	}
}

?>
</center>
</body>
</html>