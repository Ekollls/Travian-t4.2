<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Session.php");
date_default_timezone_set('Asia/Tehran');

if( !$session->username ) {
	header("Location: index.php");
	exit();
}


$go = @mysql_real_escape_string($_GET['go']);
$result = @mysql_query("SELECT * FROM ".TB_PREFIX."ads WHERE ID='$go'");
if(mysql_num_rows($result) > 0) {
	$row = mysql_fetch_array($result);
	$url = $row['url'];
}else{
	exit("Invalid target.");
}


if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
//check for ip from share internet
$remote_ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
// Check for the Proxy User
$remote_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
$remote_ip = $_SERVER["REMOTE_ADDR"];
};
$ip = $remote_ip;
if ( $session->uid ) {
	$uid = $session->uid;
}else{
	$uid = "undefined";
}
// get config
$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$row = mysql_fetch_array($result);
$ads = array(	
				"maxHits"		=>		$row['ads_maxhits'],
				"sil"			=>		$row['ads_silver'],
				"delay"			=>		$row['ads_delay'],
				"active"		=>		$row['ads_active']
			);



// -/ get config
/*   Check if bouns silver is applicable */
$time = time();
$time2 = ( date("H",$time) * 60 * 60 ) +  ( date("i",$time) * 60 ) + ( date("s",$time) );
$time3 = $time - $time2;
$time4 = $time3 + 24*60*60;
$result = @mysql_query("SELECT * FROM ".TB_PREFIX."hits WHERE uid='$uid' AND target='$go' AND timestamp > $time3 AND timestamp < $time4");
if($ads['active'] == "yes") {
	if(@mysql_num_rows($result) >= $ads['maxHits']) {
		$applicable = false;
		
		
		
		
	}else{
		$applicable = true;
	}
}else{
	$applicable = false;
}
// Give the bouns silver
if($applicable) {
	mysql_query("UPDATE ".TB_PREFIX."users SET silver=silver+".$ads['sil']." WHERE id='$uid'");
	mysql_query("UPDATE ".TB_PREFIX."users SET giftsilver=giftsilver+".$ads['sil']." WHERE id='$uid'");
	$notif = $ads['sil']." واحد نقره به شما هدیه داده شد.";	
}else{
	$notif = "هدیه ای به شما تعلق نگرفت! فردا تلاش کنید.";	
}
/* -/Check if bouns silver is applicable */
mysql_query("INSERT INTO ".TB_PREFIX."hits(uid,target,IP,timestamp) VALUES('$uid','".$go."','$ip','$time')");



if($ads['delay']<1) {
	header("Location: $url");
}
?>
<html>
<head>
<script type="text/javascript">
setInterval(function() {
window.location = '<?=$url?>';
},
<?=$ads['delay']?>
);
</script>
</head>
<body style="direction:rtl;font-size:13px;font-family:Tahoma;">
درحال انتقال...<br>
<?=@$notif?>
</body>
</html>