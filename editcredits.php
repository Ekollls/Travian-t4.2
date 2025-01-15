<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include_once("GameEngine/Village.php");
if($session->access != ADMIN) { 
	die( "شما ادمين نيستيد لطفا تلاش نکنيد." ); 
} 
if (isset($_POST['method'])) {
	if (is_numeric($_POST['amount']) && $_POST['amount']>0) {
		$amount = $_POST['amount'];
		if (strlen($_POST['uname'])>0) {
			$uname = $_POST['uname'];
			$result = mysql_query("SELECT * FROM ". TB_PREFIX ."users WHERE username='$uname'");
			if (@mysql_num_rows($result)>=1) {
				$row = mysql_fetch_array($result);
				$gold = $row['gold'];
				$silver = $row['silver'];
				switch($_POST['method']) {
					default: echo "Unknown method2<br>";
					case "addgold": {
						$gold = $gold + $amount;
						echo "مقدار ".$amount." واحد طلا به کاربر \"".$uname."\" اضافه شد. مقدار کل طلا: ".$gold."<br>";
						mysql_query("UPDATE ". TB_PREFIX ."users SET gold=".$gold." WHERE username='$uname'");
						break;
					}
					case "addsilver": {
						$silver = $silver + $amount;
						echo "مقدار ".$amount." واحد نقره به کاربر \"".$uname."\" اضافه شد. مقدار کل نقره: ".$silver."<br>";
						mysql_query("UPDATE ". TB_PREFIX ."users SET silver=".$silver." WHERE username='$uname'");
						break;
					}
				}
			}
		}
	}else{
		echo "Unknown method.<br>";
		
		
	}
}
?>
<h2 style="border-bottom:1px black solid;">طلا</h1>
<table>
<tr>
<td>عمل</td><td>مقدار</td><td>کاربر</td><td>عملیات</td>
</tr>
<tr>
<form action="" method="post">
<input type="hidden" value="addgold" name="method" >
<td>اظافه کردن</td><td><input type="number" value="" name="amount"></td><td><input type="text" value="" name="uname"></td><td><input type="submit" value="انجام"></td>
</tr>
</form>
</table>
<br>
<h2 style="border-bottom:1px black solid;">نقره</h1>
<table>
<tr>
<td>عمل</td><td>مقدار</td><td>کاربر</td><td>عملیات</td>
</tr>
<tr>
<form action="" method="post">
<input type="hidden" value="addsilver" name="method" >
<td>اظافه کردن</td><td><input type="number" value="" name="amount"></td><td><input type="text" value="" name="uname"></td><td><input type="submit" value="انجام"></td>
</tr>
</form>
</table>