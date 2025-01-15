<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
echo "MPSTCSResult:\n";
include(dirname(__FILE__).'/GameEngine/config.php');
$connection = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
$hasconf = mysql_query('SELECT * FROM '.TB_PREFIX.'config');
if ($hasconf) $sconf = mysql_fetch_array($hasconf);
if ($sconf) {
	echo 'name='.($sconf['server_name'])."\n";
	echo 'commence='.($sconf['commence'])."\n";
	echo 'speed='.($sconf['speed'])."\n";
}
echo 'users='.(mysql_num_rows(mysql_query('SELECT * FROM '.TB_PREFIX.'users WHERE tribe>=1 AND tribe<=3')))."\n";
echo 'active='.(mysql_num_rows(mysql_query('SELECT * FROM '.TB_PREFIX.'users WHERE ' . time() . "-timestamp < (3600*24) AND tribe>=1 AND tribe<=3")))."\n";
echo 'online='.(mysql_num_rows(mysql_query('SELECT * FROM '.TB_PREFIX.'users WHERE ' . time() . "-timestamp < (60*5) AND tribe>=1 AND tribe<=3")))."\n";
mysql_close($connection); 
?>
