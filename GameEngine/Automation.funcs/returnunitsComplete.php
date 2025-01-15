<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
	function returnunitsComplete() {
        global $database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
        $time = time();
        $q = "SELECT * FROM ".TB_PREFIX."movement, ".TB_PREFIX."attacks where ".TB_PREFIX."movement.proc = '0' and ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id and ".TB_PREFIX."movement.sort_type = '4' and endtime <= $time";
        $dataarray = $database->query_return($q);
        
        foreach($dataarray as $data) {
			$database->setMovementProc($data['moveid']);		
			$isoasis = $database->isVillageOases($data['to']);
			if ($isoasis){
				$toMInfo = $database->getOMInfo($data['to']);
			} else {
				$toMInfo = $database->getMInfo($data['to']);
			}
			if(!isset($toMInfo['owner']) || $toMInfo['owner']==0 || (!$isoasis && $toMInfo['owner']!=3 && $toMInfo['pop']<=0)){
				//nothing to do
			} else {
				$tribe = $database->getUserField($toMInfo["owner"],"tribe",0);
				if($tribe == 1){ $u = ""; } elseif($tribe == 2){ $u = "1"; } elseif($tribe == 3){ $u = "2"; } elseif($tribe == 4){ $u = "3"; } else{ $u = "4"; }
				$database->modifyUnit($data['to'],$u."1",$data['t1'],1);
				$database->modifyUnit($data['to'],$u."2",$data['t2'],1);
				$database->modifyUnit($data['to'],$u."3",$data['t3'],1);
				$database->modifyUnit($data['to'],$u."4",$data['t4'],1);
				$database->modifyUnit($data['to'],$u."5",$data['t5'],1);
				$database->modifyUnit($data['to'],$u."6",$data['t6'],1);
				$database->modifyUnit($data['to'],$u."7",$data['t7'],1);
				$database->modifyUnit($data['to'],$u."8",$data['t8'],1);
				$database->modifyUnit($data['to'],$u."9",$data['t9'],1);
				$database->modifyUnit($data['to'],$tribe."0",$data['t10'],1);
				$database->modifyUnit($data['to'],"hero",$data['t11'],1);
			}
			$database->setMovementProc($data['moveid']);
        }
        
        // Recieve the bounty on type 6.
        $q = "SELECT * FROM ".TB_PREFIX."movement, ".TB_PREFIX."send where ".TB_PREFIX."movement.ref = ".TB_PREFIX."send.id and ".TB_PREFIX."movement.proc = 0 and sort_type = 6 and endtime <= $time";
        $dataarray = $database->query_return($q);
        foreach($dataarray as $data) {
            $isoasis = $database->isVillageOases($data['to']);
			if ($isoasis){
				$toMInfo = $database->getOMInfo($data['to']);
			} else {
				$toMInfo = $database->getMInfo($data['to']);
			}
			if(!isset($toMInfo['owner']) || $toMInfo['owner']==0 || ($toMInfo['owner']!=3 && $toMInfo['pop']<=0)){
				//nothing to do
			} else {
				$database->modifyResource($data['to'],$data['wood'],$data['clay'],$data['iron'],$data['crop'],1);
			}
            $database->setMovementProc($data['moveid']);
			updateWrefResource($data['to']);
        }
    }           
?>
