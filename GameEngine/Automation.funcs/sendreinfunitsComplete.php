<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
    function sendreinfunitsComplete() {
        global $database,$generator;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
        $time = time();
        $q = "SELECT * FROM ".TB_PREFIX."movement, ".TB_PREFIX."attacks where ".TB_PREFIX."movement.proc = '0' and ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id and ".TB_PREFIX."movement.sort_type = '3' and ".TB_PREFIX."attacks.attack_type = '2' and endtime <= $time";
        $dataarray = $database->query_return($q);
        
        foreach($dataarray as $data) {
            //set base things
			$database->setMovementProc($data['moveid']);			
			$istooasis = $database->isVillageOases($data['to']);
			if ($istooasis){
				$toVillage = $database->getOMInfo($data['to']);
				if ($toVillage['conqured']){
					$toVillage['name'] = 'OCCUPIEDOASES';
				} else {
					$toVillage['name'] = 'UNOCCUPIEDOASES';
				}
				$toVillage['name'] .= '[|]('.$toVillage['x'].'|'.$toVillage['y'].')';
			} else {
				$toVillage = $database->getMInfo($data['to']);
			}
			$isfromoasis = $database->isVillageOases($data['from']);
			if ($isfromoasis){
				$fromVillage = $database->getOMInfo($data['from']);
				if ($fromVillage['conqured']){
					$fromVillage['name'] = 'OCCUPIEDOASES';
				} else {
					$fromVillage['name'] = 'UNOCCUPIEDOASES';
				}
				$fromVillage['name'] .= '[|]('.$fromVillage['x'].'|'.$fromVillage['y'].')';
			} else {
				$fromVillage = $database->getMInfo($data['from']);
			}
			$Attacker['tribe'] = $database->getUserField($fromVillage["owner"],"tribe",0);
			$Defender['tribe'] = $database->getUserField($toVillage["owner"],"tribe",0);
			if (!isset($fromVillage['owner']) || $fromVillage['owner']==0 || (!$isfromoasis && $fromVillage['pop']<=0) ){
				//nothing to do;
			} elseif (!isset($toVillage['owner']) || $toVillage['owner']==0 || (!$istooasis && $toVillage['pop']<=0) ){
				$tribedStart = ($Attacker['tribe']-1)*10;
				$speeds = array();
				for($i=1;$i<=10;$i++){
					if ($data['t'.$i]>0){
						global ${'u'.($i+$tribedStart)};
						$speeds[] = ${'u'.($i+$tribedStart)}['speed'];
					}
				}
				if ($data['t11']>0){
					$fromHero = $database->getHero($fromVillage["owner"]);
					$heroPureSpeed = $fromHero['speed']+$fromHero['itemspeed'];
					$speeds[] = $heroPureSpeed;
					$pdtHero = $fromHero;
				} else {$pdtHero = array();}
				$endtime = $generator->procDistanceTime($fromVillage,$toVillage,min($speeds),1,$pdtHero,true) + $data['endtime'];
				$database->addMovement(4,$data['to'],$data['from'],$data['ref'],'0,0,0,0,0',$endtime);
			} else {
				if($data['t11'] != 0) {
					//check to see if we're only sending a hero between own villages and there's a Mansion at target village
					if((!$isfromoasis and $fromVillage["owner"] == $toVillage["owner"]) and getTypeLevel(37,$toVillage['wref'])>0){
						$database->modifyUnit($data['to'],'hero',1,2);
						$database->modifyHero($fromVillage["owner"], 0,'wref', $toVillage['wref'], 0);
					} else {
						$check = $database->checkEnforce($toVillage['wref'],$fromVillage['wref']);
						if(!empty($check) && $check['id']!=0){
							$database->modifyEnforce($check['id'],'hero',1,1);
						}else{
							$database->addHeroEnforce($data);
						}
					}
				}

				$atI = ($Attacker['tribe']-1)*10;
				for($i=1;$i<=10;$i++){
					if($data['t'.$i]>0){
						$check = $database->checkEnforce($toVillage['wref'],$fromVillage['wref']);
						if(!empty($check) && $check['id']!=0){
							$database->modifyEnforce($check['id'], ($i+$atI),$data['t'.$i],1);
						}else{
							$database->addEnforce($data);
							break;
						}
					}
				}

				//send rapport
				$unitssend_att = ''.$data['t1'].','.$data['t2'].','.$data['t3'].','.$data['t4'].','.$data['t5'].','.$data['t6'].','.$data['t7'].','.$data['t8'].','.$data['t9'].','.$data['t10'].','.$data['t11'].'';
				$data_fail = ''.$fromVillage['wref'].','.$fromVillage['owner'].','.$Attacker['tribe'].','.$unitssend_att.','.$toVillage['wref'].','.$toVillage['owner'].'';
				$fromAlly = $database->getUserField($fromVillage['owner'],'alliance',0);
				$database->addNotice($fromVillage['owner'],$toVillage['wref'],$fromAlly,8,'SENTREINFTO[=]'.addslashes($fromVillage['name']).'[=]'.addslashes($toVillage['name']),$data_fail,$data['endtime']);
				if($fromVillage['owner'] != $toVillage['owner']) {
					$toAlly = $database->getUserField($fromVillage['owner'],'alliance',0);
					$database->addNotice($toVillage['owner'],$toVillage['wref'],$toAlly,8,'SENTREINFTO[=]'.addslashes($fromVillage['name']).'[=]'.addslashes($toVillage['name']),$data_fail,$data['endtime']);
				}
			}
            //update status
            $database->setMovementProc($data['moveid']); 
        }
		
    }

?>
