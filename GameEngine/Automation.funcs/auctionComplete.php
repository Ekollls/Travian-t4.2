<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
function auctionComplete() {
	global $database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
        $time = time();
        $q = "SELECT * FROM ".TB_PREFIX."auction where finish = 0 and time <= $time";
        $dataarray = $database->query_return($q);
        foreach($dataarray as $data) {
		$ownerID = $data['owner'];$biderID = $data['uid'];
		$silver = $data['silver'];$btype = $data['btype'];
		$type = $data['type'];
		$silverdiff = $data['maxsilver']-$data['silver'];
		if ($silverdiff<0) $silverdiff = 0;
		if($biderID != 0){
			$id = $database->checkHeroItem($biderID, $btype, $type);
			if($id){
				$database->modifyHeroItem($id, 'num', $data['num'], 1);
				$database->modifyHeroItem($id, 'proc', 0, 0);
			}else{
				$database->addHeroItem($biderID, $data['btype'], $data['type'], $data['num']);
			}
			$database->setSilver($biderID, $silverdiff, 1);
			$q = 'UPDATE '.TB_PREFIX.'users SET bisilver=bisilver-'.$silverdiff.' WHERE id='.$biderID; mysql_query($q);
		}
		$database->setSilver($ownerID, $silver, 1);
		$q = 'UPDATE '.TB_PREFIX.'users SET sisilver=sisilver+'.$silver.' WHERE id='.$ownerID; mysql_query($q);
		$q = "UPDATE ".TB_PREFIX."auction set finish=1 where id = ".$data['id'];
		$database->query($q);
        }
}
?>
