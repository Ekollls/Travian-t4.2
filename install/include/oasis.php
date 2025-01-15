<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
		date_default_timezone_set("Asia/Tehran");
	define('_ADMINEXEC_',1);
        include ("../../Admin/admin.model.php");
        include ("../../GameEngine/config.php");
        include ("../../GameEngine/Database/db_MYSQL.php");

        mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
        mysql_select_db(SQL_DB);
		$database = new MYSQL_DB;
		$admin = new adminModel();
        $database->poulateOasisdata();  
        $database->populateOasis();
		$database->populateOasisUnitsLow();
		header("Location: ../index.php?s=6");
?>