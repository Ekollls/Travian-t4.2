<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
		date_default_timezone_set("Asia/Tehran");
if (file_exists(dirname(__FILE__)."/constant.php")) {
	include(dirname(__FILE__)."/constant.php");
} else {
	die('Cant find constant.php in /install/include/database.php');
}

class MYSQLi_DB {
	
	var $connection;
	
	function MYSQLi_DB() {
		$this->connection = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB) or die(mysqli_error());
	}
		function query($query) {
		return $this->connection->query($query);
		}
		
};

class MYSQL_DB {
	
	var $connection;
	
	function MYSQL_DB() {
		$this->connection = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS) or die(mysql_error());
		mysql_select_db(SQL_DB, $this->connection) or die(mysql_error());
		mysql_set_charset('utf8');
	}
	
	function mysql_exec_batch ($p_query, $p_transaction_safe = true) {
  if ($p_transaction_safe) {
      $p_query = 'START TRANSACTION;' . $p_query . '; COMMIT;';
    };
  $query_split = preg_split ("/[;]+/", $p_query);
  foreach ($query_split as $command_line) {
    $command_line = trim($command_line);
    if ($command_line != '') {
      $query_result = mysql_query($command_line);
      if ($query_result == 0) {
        break;
      };
    };
  };
  return $query_result;
} 

	function query($query) {
		return mysql_query($query, $this->connection);
	}
};

if(DB_TYPE) {
	$database = new MYSQLi_DB;
}
else {
	$database = new MYSQL_DB;
}
?>