<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
function getPop($tid,$level) {
	$name = "bid".$tid;
	global $$name;
	$dataarray = $$name;
	$pop = $dataarray[($level+1)]['pop'];
	$cp = $dataarray[($level+1)]['cp'];
	return array($pop,$cp);
}
?>
