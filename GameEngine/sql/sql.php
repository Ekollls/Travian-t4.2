<?php
include('GameEngine/Protection.php');
include('GameEngine/Database/connection.php');
include('GameEngine/config.php');
$connection = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB, $connection);

mysql_query("CREATE TABLE `%PREFIX%attack_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` int(11) NOT NULL DEFAULT '0',
  `from` int(11) NOT NULL DEFAULT '0',
  `to` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_2` (`ref`),
  KEY `ref` (`ref`) 
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
", $connection) or die ( mysql_error());
mysql_close($connection);


$time = time();
rename("sql.php","sql_".$time."_esi.php");

echo "<center>SQL import shod </center>";
?>