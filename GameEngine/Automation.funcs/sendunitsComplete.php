<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
function buildingPOP($f,$lvl){
	$name = "bid".$f; global $$name;        
	$popT = 0; $dataarray = $$name;
	for ($i = 0; $i <= $lvl; $i++) { if (isset($dataarray[$i]['pop'])) $popT += $dataarray[$i]['pop']; }
	return $popT;
}
	
function recountPop($vid){
	global $database;
	$fdata = $database->getResourceLevel($vid);
	$popTot = 0;
	for ($i = 1; $i <= 40; $i++) { $lvl = $fdata["f".$i]; $building = $fdata["f".$i."t"]; if($building){ $popTot += buildingPOP($building,$lvl); }}
	$database->setVillageField($vid, 'pop', $popTot);
	return $popTot;
}

function sendunitsComplete() {
		global $database,$battle,$generator;
		if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
        $time = time();
        $q = "SELECT * FROM ".TB_PREFIX."movement, ".TB_PREFIX."attacks where ".TB_PREFIX."movement.proc = '0' and ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id and ".TB_PREFIX."movement.sort_type = '3' and ".TB_PREFIX."attacks.attack_type != '2' and endtime <= $time ORDER BY endtime ASC";
        $dataarray = $database->query_return($q);
        
        foreach($dataarray as $data) {
			$database->setMovementProc($data['moveid']);		
			unset($Attacker);
			unset($Defender);
			unset($Enforces);
			unset($battleresult);
			$fromVillage = $database->getMInfo($data['from']);
			updateWrefResource($data['to']);
			$isoasis = $database->isVillageOases($data['to']);
			if ($isoasis){
				oasesTrain($data['to']);
				$toVillage = $database->getOMInfo($data['to']);
				if ($toVillage['owner']==3) {
					$database->oasesUpdateLastFarm($data['to']);
					// if attack is to a nature oases and hero has cage, we must do simple jobs
					if (cagedAttack($data)) {
						$database->setMovementProc($data['moveid']);
						continue;
					}
				}
			} else {	
				$toVillage = $database->getMInfo($data['to']);
			}
			
			//get attack units
			$Attacker['uid'] = $database->getVillageField($data['from'],"owner");
			$Attacker['inhabitants'] = $database->getVillageField($data['from'],"pop");
			$Attacker['tribe'] = $database->getUserField($Attacker['uid'],"tribe",0);
			$Attacker['alliance'] = $database->getUserField($Attacker['uid'],"alliance",0);
			$Attacker['cp'] = $database->getUserField($Attacker['uid'],"cp",0);
			$Attacker['villagecount'] = count($database->getProfileVillages($Attacker['uid']));
			$Attacker['villagearties'] = $database->getVillageActiveArte($data['from']);
			$Attacker['accountarties'] = $database->getAccountActiveArte($Attacker['uid']);
			$start = ($Attacker['tribe']-1)*10+1;
			$end = ($Attacker['tribe']*10);
			$u = (($Attacker['tribe']-1)*10);
			$catpCount =  0;
			$ramCount = 0;
			$chiefCount = 0;
			$spyCount = 0;
			$catapultArray = array(8,18,28,38,48);
			$ramArray = array(7,17,27,37,47);
			$chiefArray = array(9,19,29,39,49);
			$spyArray = array(4,14,23,34,44);
			for($i=$start;$i<=$end;$i++) {
				$y = $i-$u;
				$Attacker['u'.$i] = $data['t'.$y];
				if(in_array($i,$catapultArray)) { // catas
					$catpCount += $Attacker['u'.$i];
					$catp_pic = $i;
				}
				if(in_array($i,$ramArray)) { // rams
					$ramCount += $Attacker['u'.$i];
					$ram_pic = $i;
				}
				if(in_array($i,$chiefArray)) { // chiefs
					$chiefCount += $Attacker['u'.$i];
					$chief_pic = $i;
				}
				if(in_array($i,$spyArray)) { // spys
					$spyCount += $Attacker['u'.$i];
					$spy_pic = $i;
				}
			}
			if ($data['t11']!=0){
				$Attacker['hero'] = $database->getHero($Attacker['uid']);
				$Attacker['heroface'] = $database->getHeroFace($Attacker['uid']);
			} else {
				$Attacker['hero'] = null;
				$Attacker['heroface'] = null;
			}
			$hero_pic = "hero";

			$Attacker['inhabitants'] = $fromVillage['pop'];
			if ($Attacker['inhabitants']<=0){
				$database->setMovementProc($data['moveid']);
				continue;
			}
			$Attacker['buildings'] = $database->getResourceLevel($data['from']);
			$Attacker['attackdata'] = $data;
			$Attacker['smithy'] = $database->getABTech($data['from']);
			$Attacker['hasgcel'] = $database->getActiveGCel($data['from']);
			$attackerBuildings = $database->getResourceLevel($data['from']);
			$aResidence = 0;
			$aPalace = 0;
			for($i=19;$i<=39;$i++){
				if ($attackerBuildings['f'.$i.'t'] == 25){
					$aResidence = $attackerBuildings['f'.$i];
					break;
				} elseif ($attackerBuildings['f'.$i.'t'] == 26){
					$aPalace = $attackerBuildings['f'.$i];
					break;
				}
			}
			$aExpCount = ($fromVillage['exp1']>0?1:0)+($fromVillage['exp2']>0?1:0)+($fromVillage['exp3']>0?1:0);
			$aLVLSlots = ($aResidence? floor($aResidence/10):($aPalace?floor(($aPalace-5)/5):0));
			$Attacker['avexpslots'] = max(0,$aLVLSlots-$aExpCount);
			$aHeroMansion = 0;
			for($i=19;$i<=39;$i++){
				if ($attackerBuildings['f'.$i.'t'] == 37){
					$aHeroMansion = $attackerBuildings['f'.$i];
					break;
				}
			}
			$aOCount = count($database->getOasis($data['from']));
			$aLVLOasisSlots = $aHeroMansion? floor(($aHeroMansion-5)/5) : 0;
			$Attacker['avoasisslots'] = max(0,$aLVLOasisSlots-$aOCount);
			$Attacker['capbrewery'] = $database->getCapBrewery($Attacker['uid']);

			$Defender = array();	$rom = $ger = $gal = $nature = $natar = 0;
			
			$Defender['uid'] = $toVillage["owner"];
			$Defender['uid'] = ($Defender['uid']?$Defender['uid']:3);
			$evasion = $database->getUserField($Defender['uid'],"escape",0);
			$Defender['tribe'] = $database->getUserField($Defender['uid'],"tribe",0);
			$Defender['alliance'] = $database->getUserField($Defender['uid'],"alliance",0);
			$Defender['isoasis'] = $isoasis;
			if (!$isoasis){
				$totwood = $database->getVillageField($data['to'],'wood');$totclay = $database->getVillageField($data['to'],'clay');
				$totiron = $database->getVillageField($data['to'],'iron');$totcrop = $database->getVillageField($data['to'],'crop');
			} else {
				$conqResult = mysql_query('SELECT * FROM '.TB_PREFIX .'odata WHERE wref='.$data['to']);
				$conqRow = mysql_fetch_assoc($conqResult);
				if($conqRow['conqured']==0){
					$totwood = $database->getOasisField($data['to'],'wood');$totclay = $database->getOasisField($data['to'],'clay');
					$totiron = $database->getOasisField($data['to'],'iron');$totcrop = $database->getOasisField($data['to'],'crop');  
				} elseif($conqRow['conqured']!=0 && !$database->isVillageOases($conqRow['conqured'])) {
					$conqResult2 = mysql_query('SELECT * FROM '.TB_PREFIX .'vdata WHERE wref='.$conqRow['conqured']);
					$conqRow2 = mysql_fetch_assoc($conqResult2);
					$totwood = $conqRow2['wood']/3;$totclay = $conqRow2['clay']/3;
					$totiron = $conqRow2['iron']/3;$totcrop = $conqRow2['crop']/3;
				}
			}
			$avwood = floor($totwood);$avwood = ($avwood < 0)? 0 : $avwood;$avclay = floor($totclay);$avclay = ($avclay < 0)? 0 : $avclay;
			$aviron = floor($totiron);$aviron = ($aviron < 0)? 0 : $aviron;$avcrop = floor($totcrop);$avcrop = ($avcrop < 0)? 0 : $avcrop;
			$avarray = array('wood'=>$avwood, 'clay'=>$avclay, 'iron'=>$aviron, 'crop'=>$avcrop);
			$Defender['res_array'] = $avarray;
			//need to set these variables.
			if ($isoasis){
				$Defender['buildings'] = null;
				$Defender['inhabitants'] = 100;
				$Defender['iscapital'] = 0;
				$stonemason = 0;
			} else {
				$Defender['inhabitants'] = isset($toVillage['pop'])?$toVillage['pop']:0;
				$Defender['iscapital'] = isset($toVillage['capital'])?$toVillage['capital']:0;
				$Defender['buildings'] = isset($toVillage['pop'])?$database->getResourceLevel($data['to']):array();
			}
			if ($Defender['inhabitants']<=0){
				$speeds = array();
				if (isset($Attacker['hero'])) {
					$speeds[] = $Attacker['hero']['speed']+$Attacker['hero']['itemspeed'];
					$pdtHero = $Attacker['hero'];
				} else {$pdtHero=array();}
				$atI = ($Attacker['tribe']-1)*10;
				for($i=1;$i<=10;$i++){if ($data['t'.$i]>0){global ${'u'.($i+$atI)};$speeds[] = ${'u'.($i+$atI)}['speed'];}}
				$returntime = $generator->procDistanceTime($fromVillage,$toVillage,min($speeds),1,$pdtHero,true) + time();
				$database->setMovementProc($data['moveid']);
				$database->addMovement(4,$fromVillage['wref'],$fromVillage['wref'],$data['ref'],'0,0,0,0,0',$returntime);
				$database->setMovementProc($data['moveid']);
				continue;
			}

			$Defender['loyalty'] = $toVillage['loyalty'];
			$Defender['hasgcel'] = $database->getActiveGCel($data['to']);
			$Defender['villagearties'] = $database->getVillageActiveArte($data['to']);
			$Defender['tocapturearties'] = $database->getOwnArtefactInfo($data['to']);
			$Defender['accountarties'] = $database->getAccountActiveArte($Defender['uid']);
			//$Defender['expandedfrom'] = $database->getVillageField($data['to'], 'expandedfrom');

			//get defence units
			$defenceUnits = $database->getUnit($data['to']);
			if (isset($defenceUnits)){
				foreach($defenceUnits as $key=>$value){
					if($evasion==0){
						$Defender[$key] = $value;;
					}
					else{
						$Defender[$key] = 0;
					}
				}
				$Defender['u199'] -= $database->getFilledTrapCount($data['to']);
				$Defender['u199'] = rand(round($Defender['u199']*TRAP_MIN_EFFECT), round($Defender['u199']*TRAP_MAX_EFFECT));
			}
			if ($Defender['hero']!=0){
				$hero = $database->getHero($Defender['uid']);
				if ($hero['hide']==0){
					$Defender['hero'] = $hero;
					$Defender['heroface'] = $database->getHeroFace($Defender['uid']);
				} else {
					unset($Defender['heroface']);
					unset($Defender['hero']);
				}
			} else {
				unset($Defender['heroface']);
				unset($Defender['hero']);
			}
			
			$Defender['smithy'] = $database->getABTech($data['to']);
			$Enforces = array();
			$enforcementarray = $database->getEnforceVillage($data['to'],0);
			$enforcesCount = count($enforcementarray);
			if($enforcesCount > 0) {
				foreach($enforcementarray as $enf){
					$enf['uid'] = $database->getVillageField($enf['from'],"owner");
					if($enf['uid']==0) $enf['uid']=3;
					$enf['tribe'] = $database->getUserField($enf['uid'],"tribe",0);
					if($enf['tribe']==0) $enf['tribe']=4;
					$enf['alliance'] = $database->getUserField($enf['uid'],"alliance",0);
					if ($enf['hero']!=0){
						$enf['heroface'] = $database->getHeroFace($enf['uid']);
						$enf['hero'] = $database->getHero($enf['uid']);
					} else {
						$enf['heroface'] = null;
						$enf['hero'] = null;
					}
					$enf['smithy'] = $database->getABTech($enf['from']);
					$Enforces[] = $enf;
				}
			}
			$database->setMovementProc($data['moveid']);
            $battleresult = $battle->calculateBattle($Attacker,$Defender,$Enforces);
			$battleresult['attackdata'] = $data;
			operateBattleResult($battleresult);
			$database->setMovementProc($data['moveid']);
			updateWrefResource($data['to']);
        }
    }

    function cagedAttack($data) {
		global $database, $generator;
		$iscaged = false;
		$fromVillage = $database->getMInfo($data['from']);
		$toVillage = $database->getOMInfo($data['to']);
		if ($toVillage['owner']==3){
			if ($data['t11']!=0){
				$attHero = $database->getHero($fromVillage['owner']);
				$attHeroface = $database->getHeroFace($fromVillage['owner']);
				if ($attHeroface['bag']!=0 && $attHeroface['num']>0){
					$bag = $database->getHeroItem($attHeroface['bag']);
					if ($bag['btype']==9 and $bag['type']==114){ // great, the hero has cage
					
					$attHeroface['num'] *= CAGE_NUMBER;
						$iscaged = true;
						$cu = array();
						$oasesUnits = $database->getUnit($toVillage['wref']);
						unset($oasesUnits['vref']);unset($oasesUnits['hero']);
						$ouCount = 0;foreach($oasesUnits as $k=>$ou){$ouCount += $ou;$cu[$k]=0;}
						if ($ouCount>0){
							while($ouCount>0 and $attHeroface['num']>0){
								$key = array_search(max($oasesUnits),$oasesUnits);
								$oasesUnits[$key]-=1;$ouCount-=1; $attHeroface['num']-=1;
								$cu[$key]+=1;
								$z++;
							}
							$attHeroface['num'] /= CAGE_NUMBER;
							$attHeroface['num']  -= $z;
							if($attHeroface['num']<=0){$database->modifyHeroFace($fromVillage['owner'],'bag',0);}
							$database->modifyHeroFace($fromVillage['owner'],'num',$attHeroface['num']);
							$speeds = array();
							for($i=31;$i<=40;$i++){
								if ($cu['u'.$i]>0){
									global ${'u'.$i};
									$speeds[] = ${'u'.$i}['speed'];
									$database->modifyUnit($toVillage['wref'], $i, $cu['u'.$i], 0);
								}
							}
							$ref = $database->addAttack($toVillage['wref'],$cu['u31'],$cu['u32'],$cu['u33'],$cu['u34'],$cu['u35'],$cu['u36'],$cu['u37'],$cu['u38'],$cu['u39'],$cu['u40'],0, 2, 0, 0, 0);
							$returntime = $generator->procDistanceTime($fromVillage,$toVillage,min($speeds),1) + $data['endtime'];
							$database->addMovement(3,$toVillage['wref'],$fromVillage['wref'],$ref,'0,0,0,0,0',$returntime);
							$database->setMovementProc($data['moveid']);
						}
						$attackerUnits=array(1=>0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
						$attackerTribe = $database->getUserField($fromVillage['owner'],"tribe",0);
						$atI = ($attackerTribe-1)*10; $speeds = array(); $speeds[] = $attHero['speed']+$attHero['itemspeed'];
						for($i=1;$i<=10;$i++){if ($data['t'.$i]>0){global ${'u'.($i+$atI)};$speeds[] = ${'u'.($i+$atI)}['speed'];}}
						$returntime = $generator->procDistanceTime($fromVillage,$toVillage,min($speeds),1,$attHero,true) + $data['endtime'];
						$database->addMovement(4,$toVillage['wref'],$fromVillage['wref'],$data['ref'],'0,0,0,0,0',$returntime);
						$database->setMovementProc($data['moveid']);
					}
				}
			}
		}
			
		return $iscaged;
	}
    function operateBattleResult(&$battleresult) {
		//var_dump($battleresult);
		$data = $battleresult['attackdata'];
		// report battle
		sendBattleReports($battleresult);
		
		// Effect Battle LossGain
		effectBattleLossGain($battleresult);

	}

    function effectBattleLossGain(&$battleresult) {
		global $database,$generator;
		
		$data = $battleresult['attackdata'];
		$isoasis = $database->isVillageOases($data['to']);
		if ($isoasis){
			$toVillage = $database->getOMInfo($data['to']);
		} else {
			$toVillage = $database->getMInfo($data['to']);
		}
		$fromVillage = $database->getMInfo($data['from']);
		//////////////////////////////
		//		Unit start			//
		//////////////////////////////
		// set defender units
		if(isset($battleresult['trap']['trapped']) && count($battleresult['trap']['trapped'])>0 && $battleresult['trap']['trappedcount']>0){
			$trapId = $database->addTrapped($data['to'],$data['from']);
			foreach($battleresult['trap']['trapped'] as $k=>$v){
				if ($k=='hero') $v=1;
				$database->modifyTrapped($trapId, $k, $v, 1);
			}
		}
		for($i=1;$i<=50;$i++){if(isset($battleresult['casualties']['defender']['u'.$i])) $database->modifyUnit($data['to'], $i, $battleresult['casualties']['defender']['u'.$i], 0);}
		if (isset($battleresult['casualties']['defender']['hero'])){
			if ($battleresult['casualties']['defender']['hero']['dead'] == 1){$database->modifyUnit($data['to'], 'hero', 1, 0);}
		}elseif (isset($battleresult['reminders']['defender']['hero'])){//bandage part
			$defHeroface = $database->getHeroFace($toVillage['owner']);
			if ($defHeroface['bag']!=0 && $defHeroface['num']>0){
				$bag = $database->getHeroItem($defHeroface['bag']);
				if (($bag['btype']==8 and $bag['type']==113) or ($bag['btype']==7 and $bag['type']==112)){ // great, the hero has bandage
					$unitsToHeal = array(1=>0,0,0,0,0,0,0,0,0,0);
					$deadUnits = array(1=>0,0,0,0,0,0,0,0,0,0);
					$bandageCount = $defHeroface['num'];
					if (($bag['btype']==8 and $bag['type']==113)) $bandageCount = 2*$defHeroface['num'];
					$ti = ($battleresult['casualties']['defender']['tribe']-1)*10;
					$deadUnitsCount = 0;
					for ($i=1;$i<=10;$i++){$deadUnits[$i]=(isset($battleresult['casualties']['defender']['u'.($ti+$i)])?$battleresult['casualties']['defender']['u'.($ti+$i)]:0);$deadUnitsCount+=$deadUnits[$i];}
					while($deadUnitsCount>0 and $bandageCount>0){
						$key = array_search(max($deadUnits),$deadUnits);
						$deadUnits[$key]-=1;$deadUnitsCount-=1;$bandageCount-=1;
						$unitsToHeal[$key]+=1;
					}
					if($bandageCount<=0){$database->modifyHeroFace($toVillage['owner'],'bag',0);}
					if (($bag['btype']==8 and $bag['type']==113)) $bandageCount = round($defHeroface['num']/2);
					$database->modifyHeroFace($toVillage['owner'],'num',$bandageCount);
					$ref = $database->addAttack($toVillage['wref'],$unitsToHeal['1'],$unitsToHeal['2'],$unitsToHeal['3'],$unitsToHeal['4'],
							$unitsToHeal['5'],$unitsToHeal['6'],$unitsToHeal['7'],$unitsToHeal['8'],$unitsToHeal['9'],$unitsToHeal['10'],
							0, 3, 0, 0, 0);
					$returntime = (86400/INCREASE_SPEED) + $data['endtime'];
					$database->addMovement(4,$toVillage['wref'],$toVillage['wref'],$ref,'0,0,0,0,0',$returntime);
					$database->setMovementProc($data['moveid']);
				}
			}
		}
		
		// set enforcements units
		if (isset($battleresult['casualties']['enforces'])){
			$enforcesCount = count($battleresult['had']['enforces']);
			for($ec=0;$ec<$enforcesCount;$ec++){
				for($i=1;$i<=50;$i++){if(isset($battleresult['casualties']['enforces'][$ec]['u'.$i]) && $battleresult['casualties']['enforces'][$ec]['u'.$i]>0){$database->modifyEnforce($battleresult['casualties']['enforces'][$ec]['id'], $i, $battleresult['casualties']['enforces'][$ec]['u'.$i], 0);}}
				if (isset($battleresult['casualties']['enforces'][$ec]['hero']) && !empty($battleresult['casualties']['enforces'][$ec]['hero'])){
					if ($battleresult['casualties']['enforces'][$ec]['hero']['dead'] == 1){$database->modifyEnforce($battleresult['casualties']['enforces'][$ec]['id'], 'hero', 1, 0);}
				}
				$ea = $database->getEnforceArray($battleresult['casualties']['enforces'][$ec]['id'],0); $eatc = $ea['hero'];
				for($i=1;$i<=50;$i++) $eatc += $ea['u'.$i];
				if ($eatc<=0)$database->deleteReinf($battleresult['casualties']['enforces'][$ec]['id']);
				if ($ea['hero']>0){//bandage part
					$isoasis = $database->isVillageOases($ea['from']);
					if ($isoasis){
						$enfVillage = $database->getOMInfo($ea['from']);
					} else {
						$enfVillage = $database->getMInfo($ea['from']);
					}
					$enfHeroface = $database->getHeroFace($enfVillage['owner']);
					if ($enfHeroface['bag']!=0 && $enfHeroface['num']>0){
						$bag = $database->getHeroItem($enfHeroface['bag']);
						if (($bag['btype']==8 and $bag['type']==113) or ($bag['btype']==7 and $bag['type']==112)){ // great, the hero has bandage
							$unitsToHeal = array(1=>0,0,0,0,0,0,0,0,0,0);
							$deadUnits = array(1=>0,0,0,0,0,0,0,0,0,0);
							$bandageCount = $enfHeroface['num'];
							if (($bag['btype']==8 and $bag['type']==113)) $bandageCount = 2*$enfHeroface['num'];
							$ti = ($battleresult['casualties']['enforces'][$ec]['tribe']-1)*10;
							$deadUnitsCount = 0;
							for ($i=1;$i<=10;$i++){$deadUnits[$i]=isset($battleresult['casualties']['enforces'][$ec]['u'.($ti+$i)])?$battleresult['casualties']['enforces'][$ec]['u'.($ti+$i)]:0;$deadUnitsCount+=$deadUnits[$i];}
							while($deadUnitsCount>0 and $bandageCount>0){
								$key = array_search(max($deadUnits),$deadUnits);
								$deadUnits[$key]-=1;$deadUnitsCount-=1;$bandageCount-=1;
								$unitsToHeal[$key]+=1;
							}
							if($bandageCount<=0){$database->modifyHeroFace($enfVillage['owner'],'bag',0);}
							if (($bag['btype']==8 and $bag['type']==113)) $bandageCount = round($enfHeroface['num']/2);
							$database->modifyHeroFace($enfVillage['owner'],'num',$bandageCount);
							$ref = $database->addAttack($enfVillage['wref'],$unitsToHeal['1'],$unitsToHeal['2'],$unitsToHeal['3'],$unitsToHeal['4'],
									$unitsToHeal['5'],$unitsToHeal['6'],$unitsToHeal['7'],$unitsToHeal['8'],$unitsToHeal['9'],$unitsToHeal['10'],
									0, 3, 0, 0, 0);
							$returntime = (86400/INCREASE_SPEED) + $data['endtime'];
							$database->addMovement(4,$enfVillage['wref'],$enfVillage['wref'],$ref,'0,0,0,0,0',$returntime);
							$database->setMovementProc($data['moveid']);
						}
					}
				}
			}
		}
		
		//set attakcers units
		$ti = ($battleresult['casualties']['attacker']['tribe']-1)*10;
		for ($i=1;$i<=10;$i++){
			if(isset($battleresult['casualties']['attacker']['u'.($ti+$i)])) 
				$database->modifyAttack($battleresult['attackdata']['ref'],$i,$battleresult['casualties']['attacker']['u'.($ti+$i)]);
			if(isset($battleresult['trap']['trapped']['u'.($ti+$i)])) 
				$database->modifyAttack($battleresult['attackdata']['ref'],$i,$battleresult['trap']['trapped']['u'.($ti+$i)]);
		}
		if ((isset($battleresult['casualties']['attacker']['hero']) && $battleresult['casualties']['attacker']['hero']['dead'] == 1) ||
			(isset($result['trap']['trapped']['hero']) && !empty($result['trap']['trapped'])) ){
			$database->modifyAttack($battleresult['attackdata']['ref'], 11, 1);
		}elseif (isset($battleresult['reminders']['attacker']['hero'])){//bandage part
			$attHero = $database->getHero($fromVillage['owner']);
			$attHeroface = $database->getHeroFace($fromVillage['owner']);
			if ($attHeroface['bag']!=0 && $attHeroface['num']>0){
				$bag = $database->getHeroItem($attHeroface['bag']);
				if (($bag['btype']==8 and $bag['type']==113) or ($bag['btype']==7 and $bag['type']==112)){ // great, the hero has bandage
					$unitsToHeal = array(1=>0,0,0,0,0,0,0,0,0,0);
					$deadUnits = array(1=>0,0,0,0,0,0,0,0,0,0);
					$bandageCount = $attHeroface['num'];
					if (($bag['btype']==8 and $bag['type']==113)) $bandageCount = 2*$attHeroface['num'];
					$ti = ($battleresult['casualties']['attacker']['tribe']-1)*10;
					$deadUnitsCount = 0;
					for ($i=1;$i<=10;$i++){$deadUnits[$i]=isset($battleresult['casualties']['attacker']['u'.($ti+$i)])?$battleresult['casualties']['attacker']['u'.($ti+$i)]:0;$deadUnitsCount+=$deadUnits[$i];}
					while($deadUnitsCount>0 and $bandageCount>0){
						$key = array_search(max($deadUnits),$deadUnits);
						$deadUnits[$key]-=1;$deadUnitsCount-=1;$bandageCount-=1;
						$unitsToHeal[$key]+=1;
					}
					if($bandageCount<=0){$database->modifyHeroFace($fromVillage['owner'],'bag',0);}
					if (($bag['btype']==8 and $bag['type']==113)) $bandageCount = round($attHeroface['num']/2);
					$database->modifyHeroFace($fromVillage['owner'],'num',$bandageCount);
					$ref = $database->addAttack($fromVillage['wref'],$unitsToHeal['1'],$unitsToHeal['2'],$unitsToHeal['3'],$unitsToHeal['4'],
							$unitsToHeal['5'],$unitsToHeal['6'],$unitsToHeal['7'],$unitsToHeal['8'],$unitsToHeal['9'],$unitsToHeal['10'],
							0, 3, 0, 0, 0);
					$returntime = (86400/INCREASE_SPEED) + $data['endtime'];
					$database->addMovement(4,$fromVillage['wref'],$fromVillage['wref'],$ref,'0,0,0,0,0',$returntime);
					$database->setMovementProc($data['moveid']);
				}
			}
		}

		if (!isset($battleresult['chief']['captured']) || $battleresult['chief']['captured']!=1){
			if ($battleresult['reminders']['attacker']['count']>0 || (isset($battleresult['reminders']['attacker']['hero']) && $battleresult['reminders']['attacker']['hero']['dead']==0)){
				$steal = $battleresult['reminders']['attacker']['bounty_array'];
				$stealStr = "".$steal['wood'].','.$steal['clay'].','.$steal['iron'].','.$steal['crop'].",".$battleresult['reminders']['attacker']['bounty_cap']."";
				$speeds = array();
				for($i=1;$i<=50;$i++){
					if (isset($battleresult['reminders']['attacker']['u'.$i]) && $battleresult['reminders']['attacker']['u'.$i]>0){
						global ${'u'.$i};
						$speeds[] = ${'u'.$i}['speed'];
					}
				}
				if (isset($battleresult['reminders']['attacker']['hero'])){
					$hero = $battleresult['reminders']['attacker']['hero'];
					$speeds[] = $hero['speed']+$hero['itemspeed'];
					$pdtHero = $hero;
				} else {$pdtHero = array();}
				if (count($speeds)==0) $speeds[] = 1;
				$returntime = $generator->procDistanceTime($fromVillage,$toVillage,min($speeds),1,$pdtHero,true) + $data['endtime'];
				$database->addMovement(4,$toVillage['wref'],$fromVillage['wref'],$data['ref'],$stealStr,$returntime);
				$database->setMovementProc($data['moveid']);
				
				//		Rob part
				$totalSteal = 0;
				foreach($steal as $key=>$value) { $totalSteal += $value;}
				if ($totalSteal>0){
					$reference = $database->sendResource($steal['wood'],$steal['clay'],$steal['iron'],$steal['crop'],0);
					if($isoasis==0){
						$database->modifyResource($toVillage['wref'],$steal['wood'],$steal['clay'],$steal['iron'],$steal['crop'],0);
					}else{
						if($toVillage['conqured']==0){
							$database->modifyOasisResource($toVillage['wref'],$steal['wood'],$steal['clay'],$steal['iron'],$steal['crop'],0);
						} elseif($toVillage['conqured']!=0  && !$database->isVillageOases($toVillage['conqured'])){
							$database->modifyResource($toVillage['conqured'],$steal['wood'],$steal['clay'],$steal['iron'],$steal['crop'],0);
						}
					}
					$database->addMovement(6,$toVillage['wref'],$fromVillage['wref'],$reference,$stealStr,$returntime);
					$database->setMovementProc($data['moveid']);
				}
			}
		}
		
		
		//////////////////////////////
		//		Unit end			//
		//////////////////////////////		
		//		Hero start			//
		//////////////////////////////
		//defender hero
		$hero = (isset($battleresult['casualties']['defender']['hero']))?
			$battleresult['casualties']['defender']['hero']:(isset($battleresult['reminders']['defender']['hero'])&&$battleresult['reminders']['defender']['hero']>0?
					$battleresult['reminders']['defender']['hero']:0);
		if ($hero){
			foreach ($hero as $key=>$value) {$database->modifyHero($hero['uid'],0, $key, $value, 0);}
		}
		//enforce hero
		if (isset($battleresult['casualties']['enforces'])){
			foreach ($battleresult['casualties']['enforces'] as $enforce) {
				$hero = (isset($enforce['hero']) && !empty($enforce['hero']))? $enforce['hero']:0;
				if ($hero){
					foreach ($hero as $key=>$value) {$database->modifyHero($hero['uid'],0, $key, $value, 0);}
				}
			}
		}
		if (isset($battleresult['reminders']['enforces'])){
			foreach ($battleresult['reminders']['enforces'] as $enforce) {
				$hero = (isset($enforce['hero']) && !empty($enforce['hero']))? $enforce['hero']:0;
				if ($hero){
					foreach ($hero as $key=>$value) {$database->modifyHero($hero['uid'],0, $key, $value, 0);}
				}
			}
		}
		//attacker hero
		$hero = (isset($battleresult['casualties']['attacker']['hero']))?
			$battleresult['casualties']['attacker']['hero']:(isset($battleresult['reminders']['attacker']['hero'])?
					$battleresult['reminders']['attacker']['hero']:0);
		if ($hero){
			foreach ($hero as $key=>$value) {$database->modifyHero($hero['uid'],0, $key, $value, 0);}
			if($data['attack_type']==3 && isset($battleresult['hero']['claimarties']) && !empty($battleresult['hero']['claimarties'])){
				foreach($battleresult['hero']['claimarties'] as $art){
					$database->captureArtefact($art['id'],$data['from'],$battleresult['had']['attacker']['uid']);
				}
			}
			if($data['attack_type']==4){
				if (isset($battleresult['hero']['captured']) && $battleresult['hero']['captured']==1){
					$database->conquerOasis($data['from'],$data['to']);
				} elseif (isset($battleresult['hero']['loyaltychange']) && $battleresult['hero']['loyaltychange']>0){
					$database->modifyOasisLoyalty($data['to']);
				}
			}
		}
		//////////////////////////////
		//		Hero end			//
		//////////////////////////////
		//		Building start		//
		//////////////////////////////
		
		if ($data['attack_type']==3){
			// set cata effect
			
			if (isset($battleresult['casualties']['defender']['ctar'])) {
				$ctarCount = count($battleresult['casualties']['defender']['ctar']);
				for($i=0;$i<$ctarCount;$i++){
					$ctar = $battleresult['casualties']['defender']['ctar'][$i];var_dump($ctar);
					$database->setVillageLevel($data['to'], 'f'.$ctar['f'], $battleresult['reminders']['defender']['buildings']['f'.$ctar['f']]);
					if ($battleresult['reminders']['defender']['buildings']['f'.$ctar['f']]<=0 && $ctar['f']>18 && $ctar['f']!=99) {
						$database->setVillageLevel($data['to'], 'f'.$ctar['f'].'t', 0);
					}
				}
				//die;
			}
			
			// set ram effect
			if (isset($battleresult['casualties']['defender']['wall']) && $battleresult['casualties']['defender']['wall']>0){
				if ($battleresult['reminders']['defender']['buildings']['f40']<=0){
					$database->setVillageLevel($data['to'], 'f40', 0);
					$database->setVillageLevel($data['to'], 'f40t', 0);
				} else {
					$database->setVillageLevel($data['to'], 'f40', $battleresult['reminders']['defender']['buildings']['f40']);
				}
			}
		}
		
		//////////////////////////////
		//		Building end		//
		//////////////////////////////
		//		Village start		//
		//////////////////////////////
		if (isset($battleresult['chief']['captured']) && $battleresult['chief']['captured'] == 1){
			$database->setVillageField($data['to'], 'owner', $battleresult['had']['attacker']['uid']);
			// from expansion slots
			$exp1 = $database->getVillageField($data['from'],'exp1');
			$exp2 = $database->getVillageField($data['from'],'exp2');
			$exp3 = $database->getVillageField($data['from'],'exp3');
			if($exp1 == 0){	$exp = 'exp1';}	elseif($exp2 == 0){	$exp = 'exp2';}else{$exp = 'exp3';}
			$database->setVillageField($data['from'],$exp,$data['to']);
			// expanded from expansion slots
			if ($toVillage['expandedfrom']!=0){
				$exp1 = $database->getVillageField($toVillage['expandedfrom'],'exp1');
				$exp2 = $database->getVillageField($toVillage['expandedfrom'],'exp2');
				$exp3 = $database->getVillageField($toVillage['expandedfrom'],'exp3');
				if($exp1 == $data['to']){$exp = 'exp1';}elseif($exp2 == $data['to']){$exp = 'exp2';}else{$exp = 'exp3';}
				$database->setVillageField($toVillage['expandedfrom'],$exp,0);
			}
			// def village expanded from
			$database->setVillageField($data['to'], 'expandedfrom', $data['from']);
			$database->clearABTech($data['to']);
			$database->clearTech($data['to']);
			$database->deleteReinfFrom($data['to']);
			$database->deleteAttacksFrom($data['to']);
			$database->deleteMovementsFrom($data['to']);
			$database->removeTribeSpecificFields($data['to']);
			foreach($battleresult['had']['defender']['tocapturearties'] as $art){
				$database->arteIsMine($art['id'],$data['to'],$battleresult['had']['attacker']['uid']);
			}
			$database->setVillageField($data['to'], 'loyalty', 0);
			$q = "UPDATE " . TB_PREFIX . "attacks SET `attack_type` = 2 WHERE id = ".$data['ref']; $database->query($q);
			$database->modifyAttack($data['ref'],'9',1);
			$database->addMovement(3,$data['from'],$data['to'],$data['ref'],'0,0,0,0,0',time());
		} elseif (isset($battleresult['chief']['loyaltychange']) && $battleresult['chief']['loyaltychange']>0){
			$l = max(0,$battleresult['chief']['loyaltyreminders']);
			$database->setVillageField($data['to'], 'loyalty', $l);
		}

		//////////////////////////////
		//		Village end			//
		//////////////////////////////
		//		Artefact start		//
		//////////////////////////////

		//////////////////////////////
		//		Artefact end		//
		//////////////////////////////
		
		$database->modifyPoints($battleresult['had']['defender']['uid'],'dp',$battleresult['casualties']['attacker']['overall']['pop']);
		$database->modifyPoints($battleresult['had']['defender']['uid'],'dpall',$battleresult['casualties']['attacker']['overall']['pop']);
		$database->modifyPoints($battleresult['had']['attacker']['uid'],'ap',$battleresult['casualties']['defender']['overall']['pop']);
		$database->modifyPoints($battleresult['had']['attacker']['uid'],'apall',$battleresult['casualties']['defender']['overall']['pop']);

		$database->modifyPointsAlly($battleresult['had']['defender']['alliance'],'dp',$battleresult['casualties']['attacker']['overall']['pop']);
		$database->modifyPointsAlly($battleresult['had']['defender']['alliance'],'Adp',$battleresult['casualties']['attacker']['overall']['pop']);
		$database->modifyPointsAlly($battleresult['had']['attacker']['alliance'],'Aap',$battleresult['casualties']['defender']['overall']['pop']);
		$database->modifyPointsAlly($battleresult['had']['attacker']['alliance'],'ap',$battleresult['casualties']['defender']['overall']['pop']);
		
		$steal = $battleresult['reminders']['attacker']['bounty_array'];
		$stealOverall = $steal['wood']+$steal['clay']+$steal['iron']+$steal['crop'];
		
		$database->modifyPoints($battleresult['had']['defender']['uid'],'RR',-$stealOverall);
		$database->modifyPoints($battleresult['had']['attacker']['uid'],'RR',$stealOverall);

		$database->modifyPointsAlly($battleresult['had']['defender']['alliance'],'RR',-$stealOverall);
		$database->modifyPointsAlly($battleresult['had']['attacker']['alliance'],'RR',$stealOverall);

		recountPop($data['to']);
	}
	
    function sendBattleReports(&$battleresult) {
		global $database,$bid23;
		$steal['wood']=$steal['clay']=$steal['iron']=$steal['crop']=0;
		$data = $battleresult['attackdata'];
		$isoasis = $database->isVillageOases($data['to']);
		if ($isoasis){
			$toVillage = $database->getOMInfo($data['to']);
			if ($toVillage['conqured']){
				$toVillage['name'] = 'OCCUPIEDOASES';
			} else {
				$toVillage['name'] = 'UNOCCUPIEDOASES';
			}
			$toVillage['name'] .=  '[|]('.$toVillage['x']."|".$toVillage['y'].')';
		} else {
			$toVillage = $database->getMInfo($data['to']);
		}
		$ifrsoasis = $database->isVillageOases($data['from']);
		if ($ifrsoasis){
			$fromVillage = $database->getOMInfo($data['from']);
			if ($fromVillage['conqured']){
				$fromVillage['name'] = 'OCCUPIEDOASES';
			} else {
				$fromVillage['name'] = 'UNOCCUPIEDOASES';
			}
			$fromVillage['name'] .=  '[|]('.$fromVillage['x']."|".$fromVillage['y'].')';
		} else {
			$fromVillage = $database->getMInfo($data['from']);
		}

		$attackerUnitsReportStr = '';
		$attackerCasualtiesReportStr = '';
		$tribeUnitIndex = ($battleresult['casualties']['attacker']['tribe']-1)*10;
		for ($i=1;$i<=10;$i++){
			$attackerUnitsReportStr .= ($battleresult['had']['attacker']['u'.($tribeUnitIndex+$i)]?$battleresult['had']['attacker']['u'.($tribeUnitIndex+$i)]:'0').',';
			$attackerCasualtiesReportStr .= (isset($battleresult['casualties']['attacker']['u'.($tribeUnitIndex+$i)])?$battleresult['casualties']['attacker']['u'.($tribeUnitIndex+$i)]:'0').',';
		}
		if (isset($battleresult['had']['attacker']['hero'])){ $attackerUnitsReportStr .= '1'; } else { $attackerUnitsReportStr .= '0'; }
		if (isset($battleresult['casualties']['attacker']['hero'])){ $attackerCasualtiesReportStr .= '1'; } else { $attackerCasualtiesReportStr .= '0'; }
		
		for($tc=1;$tc<=5;$tc++){
			$defIsTribeInStr[$tc] = (isset($battleresult['had']['defender']['tribedoverall'][$tc]['count'])&&$battleresult['had']['defender']['tribedoverall'][$tc]['count']>0)?1:0;
			$defenderTribedUnitReportStr[$tc] = '';
			$defenderTribedCasualtiesReportStr[$tc] = '';
			for($i=1;$i<=10;$i++){
				$defenderTribedUnitReportStr[$tc] .= ($battleresult['had']['defender']['tribedoverall'][$tc]['u'.(($tc-1)*10+$i)]?$battleresult['had']['defender']['tribedoverall'][$tc]['u'.(($tc-1)*10+$i)]:'0').',';
				$defenderTribedCasualtiesReportStr[$tc] .= (isset($battleresult['casualties']['defender']['tribedoverall'][$tc]['u'.(($tc-1)*10+$i)])?$battleresult['casualties']['defender']['tribedoverall'][$tc]['u'.(($tc-1)*10+$i)]:'0').',';
			}
			$defenderTribedUnitReportStr[$tc] .= (isset($battleresult['had']['defender']['tribedoverall'][$tc]['hero'])?count($battleresult['had']['defender']['tribedoverall'][$tc]['hero']):'0');
			$defenderTribedCasualtiesReportStr[$tc] .= (isset($battleresult['casualties']['defender']['tribedoverall'][$tc]['hero'])?count($battleresult['casualties']['defender']['tribedoverall'][$tc]['hero']):'0');
		}
		
		///// In some situations defender should not be notified
		$sendDefenderReport = true;
		$sendEnforceOwnerReport = true;
		///////////////////////////
		$info_ram = '';
		$info_spy = '';
		$info_cat = '';
		$info_chief = '';
		$info_hero = '';
		$info_trap = '';
		switch ($battleresult['had']['attacker']['attackdata']['attack_type']) {
			case 1:
				$attackTypeStr = 'REPORT_SCOUT';
				$spyUnitsIndex = array(4,14,23,34,44);
				$spy_pic = $spyUnitsIndex[$battleresult['had']['attacker']['tribe']];
				if ($battleresult['reminders']['attacker']['overall']['count']==0){$attackerReportType = 17;}
				elseif ($battleresult['casualties']['attacker']['overall']['count']>0){$attackerReportType = 16;}
				else {$attackerReportType = 15;$sendDefenderReport = false;$sendEnforceOwnerReport = false;}
				if ($battleresult['reminders']['attacker']['overall']['count']==0){$defenderReportType = 18;}
				else {$defenderReportType = 19;}
				$buildarray = $battleresult['reminders']['defender']['buildings'];
				$cranny_eff = 0;    
				for($i=19;$i<39;$i++){
					if($buildarray['f'.$i.'t']==23){
						$cranny_eff += $bid23[$buildarray['f'.$i.'']]['attri'];
					}
				}
				$av_res_array = $battleresult['had']['defender']['res_array'];
				
				if ($battleresult['had']['attacker']['attackdata']['spy'] == 1){
					$info_spy = $spy_pic.',REPORT_RESFRMT[=]'.round($av_res_array['wood']).'[=]'.round($av_res_array['clay']).'[=]'.round($av_res_array['iron']).'[=]'.round($av_res_array['crop']).'[=]'.$cranny_eff;
				} elseif ($battleresult['had']['attacker']['attackdata']['spy'] == 2){
					$wallLVL = 0;
					$residencePalaceLVL = 0;
					if ($isoasis == 0){
						$resarray = $battleresult['had']['defender']['buildings'];
						for($j=19;$j<=40;$j++) {
							if($resarray['f'.$j.'t'] == 25 || $resarray['f'.$j.'t'] == 26 ) {$residencePalaceLVL = $resarray['f'.$j];}
							if($resarray['f'.$j.'t'] == 40) {$wallLVL = $residencePalaceLVL = $resarray['f'.$j];}
						}
					}
					$defenderTribe = $battleresult['had']['defender']['tribe'];
					if($defenderTribe == 1){$walltitle = 'CITY_WALL';$wallid = 31;}
					elseif($defenderTribe == 2){$walltitle = 'EARTH_WALL';$wallid = 32;}
					elseif($defenderTribe == 3){$walltitle = 'PALISADE';$wallid = 33;}
					elseif($defenderTribe == 4){$walltitle = 'EARTH_WALL';$wallid = 32;}
					elseif($defenderTribe == 5){$walltitle = 'EARTH_WALL';$wallid = 32;}
					$info_spy = $spy_pic.',REPORT_SPPART[=]'.$residencePalaceLVL.'[=]'.$wallid.'[=]'.$wallLVL;
				}
				if ($info_spy != '') $info_spy .= ',';
			break;
			case 2:
			break;
			case 3:
				$attackTypeStr = 'REPORT_NORMALATTACK';
				$steal = $battleresult['reminders']['attacker']['bounty_array'];
				if ($battleresult['reminders']['attacker']['overall']['count']==0){$attackerReportType = 3;}
				elseif ($battleresult['casualties']['attacker']['overall']['count']>0){$attackerReportType = 2;}
				else {$attackerReportType = 1;}
				if ($battleresult['reminders']['defender']['overall']['count']==0){
					if ($battleresult['had']['defender']['overall']['count']==0){$defenderReportType = 7;}
					else {$defenderReportType = 6;}
				} elseif ($battleresult['casualties']['defender']['overall']['count']>0){$defenderReportType = 5;}
				else {$defenderReportType = 4;}
				
				$ramArray = array(7,17,27,37,47);
				$ram_pic = $ramArray[$battleresult['had']['attacker']['tribe']-1];
				switch($battleresult['had']['attacker']['tribe']){
					case 1: case 2: case 3: $wall_pic = '3'.($battleresult['had']['attacker']['tribe']); break;
					case 4: $wall_pic = ''; break;
					case 5: $wall_pic = '32';
				}
				
				if ($battleresult['had']['defender']['wall']===0){
					$info_ram = $ram_pic.",,".'REPORT_NOWALL';
				} elseif (isset($battleresult['casualties']['defender']['wall']) && $battleresult['casualties']['defender']['wall']==$battleresult['had']['defender']['wall']){
					$info_ram = $ram_pic.",".$wall_pic.",".'REPORT_WALLDESTROYED';
				} elseif (isset($battleresult['casualties']['defender']['wall']) && $battleresult['casualties']['defender']['wall']>0){
					$info_ram = $ram_pic.",".$wall_pic.",".('REPORT_WALLDAMAGEDED[=]'.$battleresult['had']['defender']['wall'].'[=]'.$battleresult['had']['defender']['wall']-$battleresult['casualties']['defender']['wall']);
				} elseif (isset($battleresult['casualties']['defender']['wall']) && $battleresult['casualties']['defender']['wall']===0) {
					$info_ram = $ram_pic.",".$wall_pic.",".'REPORT_WALLNODAMAGE';
				}
				if ($info_ram != '') $info_ram .= ',';
				
				$catapultArray = array(8,18,28,38,48);
				$catp_pic = $catapultArray[$battleresult['had']['attacker']['tribe']-1];
				
				if ($battleresult['had']['defender']['ctar']){
					if($battleresult['had']['defender']['inhabitants']<=0){
						$info_cat = $catp_pic.",,".'REPORT_NOVILLAGE'.',,,,';
					} else {
						$info_cat = '';
						$ctc = count($battleresult['had']['defender']['ctar']);
						$ad = 0;
						for($i=0;$i<$ctc;$i++){
							$build_pic = isset($battleresult['casualties']['defender']['ctar'][$i]['ft'])?$battleresult['casualties']['defender']['ctar'][$i]['ft']:'';
							if (isset($battleresult['casualties']['defender']['ctar'][$i]['ft']) && $battleresult['casualties']['defender']['ctar'][$i]['ft']!=0 
								&& $battleresult['casualties']['defender']['ctar'][$i]['ft'] !=''
								&& ($battleresult['casualties']['defender']['ctar'][$i]['lvl'] == $battleresult['had']['defender']['ctar'][$i]['lvl'])) {
								$info_cat .= $catp_pic.','.$build_pic.','.('REPORT_BUILDINGDESTROYED[=]'.('B'.$battleresult['casualties']['defender']['ctar'][$i]['ft'])).',';
								$ad++;
							} elseif (isset($battleresult['casualties']['defender']['ctar'][$i]['lvl']) && $battleresult['casualties']['defender']['ctar'][$i]['lvl']>0) {
								$info_cat .= $catp_pic.','.$build_pic.','.('REPORT_BUILDINGDAMAGED[=]'.('B'.$battleresult['casualties']['defender']['ctar'][$i]['ft']).'[=]'.$battleresult['had']['defender']['ctar'][$i]['lvl'].'[=]'.$battleresult['had']['defender']['ctar'][$i]['lvl']-$battleresult['casualties']['defender']['ctar'][$i]['lvl']).',';
								$ad++;
							} elseif (isset($battleresult['casualties']['defender']['ctar'][$i]['lvl']) && $battleresult['casualties']['defender']['ctar'][$i]['lvl']===0){
								$info_cat .= $catp_pic.','.$build_pic.','.('REPORT_BUILDINGNODAMAGE[=]'.('B'.$battleresult['casualties']['defender']['ctar'][$i]['ft'])).',';
								$ad++;
							}
						}
					}
				}
				$infcatarray = explode(",",$info_cat);
				$icac = count($infcatarray);
				for ($i=$icac;$i<=6;$i++) $info_cat .= ',';
				
				$chiefArray = array(9,19,29,39,49);
				$chief_pic = $chiefArray[$battleresult['had']['attacker']['tribe']-1];
				
				if(isset($battleresult['chief']['msg'])){
					//$battleresult['chief']['msg'] = constant($battleresult['chief']['msg']);
					$info_chief = $chief_pic.','.$battleresult['chief']['msg'].',';
				}
				if(isset($battleresult['hero']['msg'])){
					//$battleresult['hero']['msg'] = constant($battleresult['hero']['msg']);
					$info_hero = 'hero,'.$battleresult['hero']['msg'].',';
				}
			break;
			case 4:
				$attackTypeStr = 'REPORT_RAID';
				$steal = $battleresult['reminders']['attacker']['bounty_array'];
				if ($battleresult['reminders']['attacker']['overall']['count']==0){$attackerReportType = 3;}
				elseif ($battleresult['casualties']['attacker']['overall']['count']>0){$attackerReportType = 2;}
				else {$attackerReportType = 1;}
				if ($battleresult['reminders']['defender']['overall']['count']==0){
					if ($battleresult['had']['defender']['overall']['count']==0){$defenderReportType = 7;}
					else {$defenderReportType = 6;}
				} elseif ($battleresult['casualties']['defender']['overall']['count']>0){$defenderReportType = 5;}
				else {$defenderReportType = 4;}
				if(isset($battleresult['hero']['msg'])){
					//$battleresult['hero']['msg'] = constant($battleresult['hero']['msg']);
					$info_hero = 'hero,'.$battleresult['hero']['msg'].',';
				}
			break;
		}

		$info_trap .= ((isset($battleresult['trap']['trappedcount']) && $battleresult['trap']['trappedcount']>0)?$battleresult['trap']['trappedcount']:'0').',';
		$tribeUnitIndex = ($battleresult['had']['attacker']['tribe']-1)*10;
		for ($i=1;$i<=10;$i++)	$info_trap .= (isset($battleresult['trap']['trapped']['u'.($tribeUnitIndex+$i)])?$battleresult['trap']['trapped']['u'.($tribeUnitIndex+$i)]:'0').',';

		$info_trap .= ((isset($battleresult['trap']['trapped']['hero']) && !empty($battleresult['trap']['trapped']['hero']))?'1':'0').',';

		if ($info_ram == ''){$info_ram = ',,,';}
		if ($info_cat == ''){$info_cat = ',,,,,,';}
		if ($info_chief == ''){$info_chief = ',,';}
		if ($info_spy == ''){$info_spy = ',,';}
		if ($info_hero == ''){$info_hero = ',,';}
		$info_str = $info_ram.$info_cat.$info_chief.$info_spy.$info_hero.$info_trap;

		$reportUnitsStr = ''.$fromVillage['owner'].','.$fromVillage['wref'].','.$battleresult['had']['attacker']['tribe'].','
			.$attackerUnitsReportStr.','.$attackerCasualtiesReportStr.','
			.$steal['wood'].','.$steal['clay'].','.$steal['iron'].','.$steal['crop'].','.$battleresult['reminders']['attacker']['bounty_cap']
			.','.$toVillage['owner'].','.$toVillage['wref'].','.addslashes($toVillage['name']).','.$battleresult['had']['defender']['tribe'].',,,'
			.$defIsTribeInStr[1].','.$defenderTribedUnitReportStr[1].','.$defenderTribedCasualtiesReportStr[1].','
			.$defIsTribeInStr[2].','.$defenderTribedUnitReportStr[2].','.$defenderTribedCasualtiesReportStr[2].','
			.$defIsTribeInStr[3].','.$defenderTribedUnitReportStr[3].','.$defenderTribedCasualtiesReportStr[3].','
			.$defIsTribeInStr[4].','.$defenderTribedUnitReportStr[4].','.$defenderTribedCasualtiesReportStr[4].','
			.$defIsTribeInStr[5].','.$defenderTribedUnitReportStr[5].','.$defenderTribedCasualtiesReportStr[5].','
			.$info_str;
		
		// report the Attacker
		$database->addNotice($fromVillage['owner'],$toVillage['wref'],$battleresult['had']['attacker']['alliance']
					,$attackerReportType,($attackTypeStr.'[=]'.addslashes($fromVillage['name']).'[=]'.addslashes($toVillage['name'])),$reportUnitsStr,$data['endtime']);
		
		// report the Defender
		if ($sendDefenderReport){
			$database->addNotice($toVillage['owner'],$toVillage['wref'],$battleresult['had']['defender']['alliance']
						,$defenderReportType,($attackTypeStr.'[=]'.addslashes($fromVillage['name']).'[=]'.addslashes($toVillage['name'])),$reportUnitsStr,$data['endtime']);
		}
		
		// report Participant owners
		
		// report Enforcement owners
		if ($sendEnforceOwnerReport){
			if (isset($battleresult['had']['enforces'])){
				$enforcesCount = count($battleresult['had']['enforces']);
				for($ec=0;$ec<$enforcesCount;$ec++){
					if ($battleresult['had']['enforces'][$ec]['uid'] != $battleresult['had']['defender']['uid']) {
						unset($enfIsTribeInStr);
						unset($enforceTribedUnitReportStr);
						unset($enforceTribedCasualtiesReportStr);
						$tc = $battleresult['had']['enforces'][$ec]['tribe'];
						$enfIsTribeInStr[$tc] = 1;
						$enforceTribedUnitReportStr[$tc] = '';
						$enforceTribedCasualtiesReportStr[$tc] = '';
						for($i=1;$i<=10;$i++){
							$enforceTribedUnitReportStr[$tc] .= (isset($battleresult['had']['enforces'][$ec]['u'.(($tc-1)*10+$i)])?$battleresult['had']['enforces'][$ec]['u'.(($tc-1)*10+$i)]:'0').',';
							$enforceTribedCasualtiesReportStr[$tc] .= (isset($battleresult['casualties']['enforces'][$ec]['u'.(($tc-1)*10+$i)])?$battleresult['casualties']['enforces'][$ec]['u'.(($tc-1)*10+$i)]:'0').',';
						}
						$enforceTribedUnitReportStr[$tc] .= (isset($battleresult['had']['enforces'][$ec]['hero'])?'1':'0');
						$enforceTribedCasualtiesReportStr[$tc] .= (isset($battleresult['casualties']['enforces'][$ec]['hero'])?'1':'0');
						
						for($i=1;$i<=5;$i++){
							if($i!=$tc){
								$enfIsTribeInStr[$i] = 0;
								$enforceTribedUnitReportStr[$i] = '?,?,?,?,?,?,?,?,?,?,?';
								$enforceTribedCasualtiesReportStr[$i] = '?,?,?,?,?,?,?,?,?,?,?';
							}
						}
						$attackerUnitsReportStr = '?,?,?,?,?,?,?,?,?,?,?';
						$attackerCasualtiesReportStr = '?,?,?,?,?,?,?,?,?,?,?';
						$reportUnitsStr = ''.$fromVillage['owner'].','.$fromVillage['wref'].','.$battleresult['had']['attacker']['tribe'].','
							.$attackerUnitsReportStr.','.$attackerCasualtiesReportStr.',,,,,,'
							.$toVillage['owner'].','.$toVillage['wref'].','.addslashes($toVillage['name']).','.$battleresult['had']['defender']['tribe'].',,,'
							.$enfIsTribeInStr[1].','.$enforceTribedUnitReportStr[1].','.$enforceTribedCasualtiesReportStr[1].','
							.$enfIsTribeInStr[2].','.$enforceTribedUnitReportStr[2].','.$enforceTribedCasualtiesReportStr[2].','
							.$enfIsTribeInStr[3].','.$enforceTribedUnitReportStr[3].','.$enforceTribedCasualtiesReportStr[3].','
							.$enfIsTribeInStr[4].','.$enforceTribedUnitReportStr[4].','.$enforceTribedCasualtiesReportStr[4].','
							.$enfIsTribeInStr[5].','.$enforceTribedUnitReportStr[5].','.$enforceTribedCasualtiesReportStr[5].','
							.$info_ram.','.$info_cat.','.$info_chief.','.$info_spy.'';
						$database->addNotice($battleresult['had']['enforces'][$ec]['uid'],$toVillage['wref'],$battleresult['had']['defender']['alliance'],$defenderReportType,'REPORT_REINFATTACKED[=]'.addslashes($toVillage['name']),$reportUnitsStr,$data['endtime']);
					}
				}
			}
		}
		
	}
?>
