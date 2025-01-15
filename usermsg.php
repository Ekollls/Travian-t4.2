<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include_once("GameEngine/Session.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (mysql_num_rows(mysql_query("SELECT id FROM ".TB_PREFIX."users WHERE access = 9 AND id = ".$session->uid)) != '1') die("Hacking attempt!");

if(isset($_GET['from']) && isset($_GET['to'])){
	$res = mysql_query("select * from ".TB_PREFIX."mdata where `owner`=".$_GET['from']." and `target`=".$_GET['to'])  or die(mysql_error());
	while($row = mysql_fetch_array($res)){
		foreach($row as $k=>$v){
			echo '[ '.$k.': '.$v.' ]';
		}
		echo '</br></br>';
	}
}

if(isset($_GET['id'])){
	$res = mysql_query("select * from ".TB_PREFIX."mdata where `id`=".$_GET['id'])  or die(mysql_error());
	while($row = mysql_fetch_array($res)){
		foreach($row as $k=>$v){
			echo '[ '.$k.': '.$v.' ]';
		}
		echo '</br></br>';
	}
}


mysql_close(); ?>
