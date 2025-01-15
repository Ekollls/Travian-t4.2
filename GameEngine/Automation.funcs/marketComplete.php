<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
    function marketComplete() {
        global $database,$generator;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
		//Sent merchants
        $time = time();
        $q = "SELECT * FROM ".TB_PREFIX."movement, ".TB_PREFIX."send where ".TB_PREFIX."movement.ref = ".TB_PREFIX."send.id and ".TB_PREFIX."movement.proc = 0 and sort_type = 0 and endtime <= $time";
        $dataarray = $database->query_return($q);
        foreach($dataarray as $data) {
            $toMInfo = $database->getMInfo($data['to']);
			if(!isset($toMInfo['owner']) || $toMInfo['owner']==0 || $toMInfo['pop']<=0) $toMInfo['owner']=3;
            $fromMInfo = $database->getMInfo($data['from']);
			if(!isset($fromMInfo['owner']) || $fromMInfo['owner']==0 || $fromMInfo['pop']<=0){
				//nothing to do
			} else {
				$toAlly = $database->getUserField($toMInfo['owner'],'alliance',0);
				$fromAlly = $database->getUserField($fromMInfo['owner'],'alliance',0);
				if($data['wood'] >= $data['clay'] && $data['wood'] >= $data['iron'] && $data['wood'] >= $data['crop']){ $sort_type = "10"; }
				elseif($data['clay'] >= $data['wood'] && $data['clay'] >= $data['iron'] && $data['clay'] >= $data['crop']){ $sort_type = "11"; }
				elseif($data['iron'] >= $data['wood'] && $data['iron'] >= $data['clay'] && $data['iron'] >= $data['crop']){ $sort_type = "12"; }
				elseif($data['crop'] >= $data['wood'] && $data['crop'] >= $data['clay'] && $data['crop'] >= $data['iron']){ $sort_type = "13"; }
				$database->addNotice($fromMInfo['owner'],$toMInfo['wref'],$toAlly,$sort_type,'SEND_RES[=]'.addslashes($fromMInfo['name']).'[=]'.addslashes($toMInfo['name']).'',''.$fromMInfo['wref'].','.$toMInfo['wref'].','.$data['wood'].','.$data['clay'].','.$data['iron'].','.$data['crop'].'',$data['endtime']); 
				if($fromMInfo['owner'] != $toMInfo['owner']) {
					$database->addNotice($toMInfo['owner'],$toMInfo['wref'],$fromAlly,$sort_type,'SEND_RES[=]'.addslashes($fromMInfo['name']).'[=]'.addslashes($toMInfo['name']).'',''.$fromMInfo['wref'].','.$toMInfo['wref'].','.$data['wood'].','.$data['clay'].','.$data['iron'].','.$data['crop'].'',$data['endtime']);
				}
				if ($toMInfo['owner']!=3) $database->modifyResource($data['to'],$data['wood'],$data['clay'],$data['iron'],$data['crop'],1);
				$tocoor = $database->getCoor($data['from']);
				$fromcoor = $database->getCoor($data['to']);
				$targettribe = $database->getUserField($fromMInfo['owner'],"tribe",0);
				$endtime = $generator->procDistanceTime($tocoor,$fromcoor,$targettribe,0) + $data['endtime'];
				$database->addMovement(1,$data['to'],$data['from'],$data['id'],$data['data'],$endtime);
				updateWrefResource($data['to']);
			}
            $database->setMovementProc($data['moveid']);
            $database->removeSend($data['id']);
        }
		
		//Returned merchants
		$time = time();
        $q = "SELECT * FROM ".TB_PREFIX."movement, ".TB_PREFIX."send where ".TB_PREFIX."movement.ref = ".TB_PREFIX."send.id and ".TB_PREFIX."movement.proc = 0 and sort_type = 1 and endtime <= $time";
        $dataarray = $database->query_return($q);
        foreach($dataarray as $data) {
            $database->setMovementProc($data['moveid']);
            $database->removeSend($data['id']);
        }
    }
?>
