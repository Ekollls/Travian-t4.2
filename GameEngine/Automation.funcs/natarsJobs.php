<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
function natarsJobs() {
	global $natars,$database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
	$natars->doJobs();
}

?>
