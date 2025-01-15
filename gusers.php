<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
error_reporting(0);
@include("GameEngine/Database/connection.php");
@$con = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
@mysql_select_db(SQL_DB, $con);
$users = array();
$users['total'] = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users"));
$users['active'] = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (3600*24) AND tribe!=5 AND tribe!=0"));
$users['online'] = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (60*60) AND tribe!=5 AND tribe!=0"));
mysql_close($con);
switch($_GET['type']) {
	case "active": echo $users['active']; break;
	case "online": echo $users['online']; break;
	case "total": echo $users['total']-4; break;
}
?>
