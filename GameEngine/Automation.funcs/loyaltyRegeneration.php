<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
function loyaltyRegeneration() {
	global $database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
	$array = array();
	$q = "SELECT * FROM ".TB_PREFIX."vdata WHERE loyalty < 100";
	$array = $database->query_return($q);
	if(!empty($array)) { 
		foreach($array as $loyalty) {
			if(getTypeLevel(25,$loyalty['wref']) >= 1){ $value = getTypeLevel(25,$loyalty['wref']);
			}elseif(getTypeLevel(26,$loyalty['wref']) >= 1){ $value = getTypeLevel(26,$loyalty['wref']);
			} else {$value = 0;}
			$newloyalty = min(100,$loyalty['loyalty']+$value*(time()-$loyalty['lastupdate'])*SPEED/(3600));
			$q = "UPDATE ".TB_PREFIX."vdata SET loyalty = $newloyalty WHERE wref = '".$loyalty['wref']."'";
			$database->query($q);
		}
        }
        $array = array();
        $q = "SELECT * FROM ".TB_PREFIX."odata WHERE loyalty<100";
        $array = $database->query_return($q);
	if(!empty($array)) { 
		foreach($array as $loyalty) {
			if(getTypeLevel(25,$loyalty['conqured']) >= 1){ $value = getTypeLevel(25,$loyalty['conqured']);
			}elseif(getTypeLevel(26,$loyalty['conqured']) >= 1){ $value = getTypeLevel(26,$loyalty['conqured']);
			} else { $value = 0;}
			$newloyalty = min(100,$loyalty['loyalty']+$value*(time()-$loyalty['lastupdate'])*SPEED/(60*60));
			$q = "UPDATE ".TB_PREFIX."odata SET loyalty = $newloyalty WHERE wref = '".$loyalty['wref']."'";
			$database->query($q);
		}
	}

	$q = "UPDATE ".TB_PREFIX."vdata SET loyalty = 125 WHERE loyalty>125";
	$database->query($q);
}
?>
