<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
function sendAdventuresComplete() {
        global $database,$generator;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
	$q2 = "DELETE FROM ".TB_PREFIX."adventure WHERE end = 1";
	$database->query($q2);
        $time = time();
        $q = "SELECT * FROM ".TB_PREFIX."movement where proc = 0 and sort_type = 9 and endtime <= $time";
	$dataarray = $database->query_return($q);
	foreach($dataarray as $data) {
		$database->setMovementProc($data['moveid']);
		$fromMInfo = $database->getMInfo($data['from']);
		if (!isset($fromMInfo['owner']) || $fromMInfo['owner']==0 || !isset($fromMInfo['pop']) || $fromMInfo['pop'] <=0){
			// nothing to do
		} else {
			$ownerID = $fromMInfo['owner'];
			$getAdv = $database->getAdventure($ownerID, $data['to']);
			$database->editTableField('adventure', 'end', 1, 'id', $getAdv['id']);
			$toMInfo = $database->getAInfo($data['to']);
			$owner = $database->getUserField($ownerID,'username',0);
			$ally = $database->getUserField($ownerID,'alliance',0);
			$tribe = $database->getUserField($ownerID,'tribe',0);
			$coor = $database->getCoor($data['to']);
			$getHero = $database->getHero($ownerID);
			$database->modifyHero($ownerID, 0,'adv', 1, 1);
			$heroface = $database->getHeroFace($ownerID);
			if ($getHero['sucsadv']<=10) { $btype = rand(1,15); } elseif ($getHero['sucsadv']<=20) { $btype = rand(1,25); } 
			else { $btype = rand(1,max(20,45-$getHero['sucsadv'])); }
			$tear2 = max(COMMENCE+(604800/SPEED),COMMENCE+43200);
			$tear3 = max(COMMENCE+(1209600/SPEED),COMMENCE+86400);
			if($btype==1){
				if($time >= $tear3){$ntype = array(1=>1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
				}elseif($time >= $tear2){$ntype = array(1=>1,2,4,5,7,8,10,11,13,14);
				}else{$ntype = array(1=>1,4,7,10,13);}
			}elseif($btype==2){
				if($time >= $tear3){$ntype = array(1=>82,83,84,85,86,87,88,89,90,91,92,93);
				}elseif($time >= $tear2){$ntype = array(1=>82,83,85,86,88,89,91,92);
				}else{$ntype = array(1=>82,85,88,91);}
			}elseif($btype==3){
				if($time >= $tear3){$ntype = array(1=>61,62,63,64,65,66,67,68,69,73,74,75,76,77,78,79,80,81);
				}elseif($time >= $tear2){$ntype = array(1=>61,62,64,65,67,68,73,74,79,80);
				}else{$ntype = array(1=>61,64,67,73,79);}
			}elseif($btype==4){
				if($time >= $tear3){
					if($tribe==1){$ntype = array(1=>16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
					}elseif($tribe==2){$ntype = array(1=>46,47,48,49,50,51,52,53,54,55,56,57,58,59,60);
					}elseif($tribe==3){$ntype = array(1=>31,32,33,34,35,36,37,38,39,40,41,42,43,44,45);}
				}elseif($time >= $tear2){
					if($tribe==1){$ntype = array(1=>16,17,19,20,22,23,25,26,28,29);
					}elseif($tribe==2){$ntype = array(1=>46,47,49,50,52,53,55,56,58,59);
					}elseif($tribe==3){$ntype = array(1=>31,32,34,35,37,38,40,41,43,44);}
				}else{
					if($tribe==1){$ntype = array(1=>16,19,22,25,28);
					}elseif($tribe==2){$ntype = array(1=>46,49,52,55,58);
					}elseif($tribe==3){$ntype = array(1=>31,34,37,40,43);}
				}
			}elseif($btype==5){
				if($time >= $tear3){$ntype = array(1=>94,95,96,98,99,100,101,102);
				}elseif($time >= $tear2){$ntype = array(1=>94,95,97,98,100,101);
				}else{$ntype = array(1=>94,97,100);}
			}elseif($btype==6){
				if($time >= $tear3){$ntype = array(1=>103,104,105);
				}elseif($time >= $tear2){$ntype = array(1=>103,104);
				}else{$ntype = array(1=>103);}
			}elseif($btype==7){
				$ntype = array(1=>112);
			}elseif($btype==8){
				$ntype = array(1=>113);
			}elseif($btype==9){
				$ntype = array(1=>114);
			}elseif($btype==10){
				$ntype = array(1=>107);
			}elseif($btype==11){
				$ntype = array(1=>106);
			}elseif($btype==12){
				$ntype = array(1=>108);
			}elseif($btype==13){
				$ntype = array(1=>110);
			}elseif($btype==14){
				$ntype = array(1=>111);
			}elseif($btype==15){
				$ntype = array(1=>109);
			}else{
				$btype = 0;
			}
			$sgh = 1000;
			if($getAdv['dif']==0){
				$heroPureExp = rand(0,40);
				$sgh = 1000;
			}else{
				$heroPureExp = rand(10,80);
				$sgh = 2000;
			}
			$userActivateat = $database->getUserField($ownerID, 'activateat', 0);
			$sghMulti = abs((time()-$userActivateat)/(ROUNDLENGHT*86400))+1;
			$sgh *= $sghMulti;
			$heroBonusForExpgain = ($getHero['extraexpgain']*HEROATTRSPEED)+($getHero['itemextraexpgain']*ITEMATTRSPEED);
			$exp = round(($heroPureExp*(100+$heroBonusForExpgain))/100);
			$heroPureFS = 100+($getHero['fsperpoint']*$getHero['power'])+$getHero['itemfs'];
			$heroBonusForFS = $getHero['offBonus'];
			$heroBonusedFS = ((100+$heroBonusForFS)*$heroPureFS)/100;
			$heroPureDamage = round($sgh*3.007/$heroBonusedFS,1);
			$heroResist = $getHero['extraresist']*HEROATTRSPEED+$getHero['itemextraresist']*ITEMATTRSPEED;
			$damage = $heroPureDamage - $heroResist;
			if ($damage<0) $damage = 0;
			
			$database->modifyHero($ownerID, 0,'experience', $exp, 1);
			
			if(($getHero['health']-$damage)<=0){
				$database->modifyHero($ownerID, 0,'dead', 1, 0);
				$database->modifyHero($ownerID, 0,'health', 0, 0);
				$database->addNotice($ownerID,$data['to'],$ally,9,'REPORT_EXPL[=]'.addslashes($fromMInfo['name']).'[=]('.addslashes($coor['x']).'|'.addslashes($coor['y']).')',''.$fromMInfo['wref'].',dead,REPORT_HNS,,'.$damage.','.$exp.'',$data['endtime']);
			}else{
				if($btype==0){
					$database->addNotice($ownerID,$data['to'],$ally,9,'REPORT_EXPL[=]'.addslashes($fromMInfo['name']).'[=]'.addslashes($coor['x']).'|'.addslashes($coor['y']).')',''.$fromMInfo['wref'].',,'.'REPORT_EMPTYADV'.',,'.$damage.','.$exp.'',$data['endtime']);
				}else{
					# hero will bring more item if he has more sucsadv
					$database->modifyHero($ownerID, 0,'sucsadv', 1, 1);
					switch ($btype){
						case 1: case 2: case 3: case 4: case 5: case 6: case 12: case 13: case 15:
							$num = 1;
						break;
						case 7: case 8: case 10: case 11: case 14:
							$num = rand(20,50);
						break;
						case 9:
							$num = rand(6,20);
						break;
					}
					$s2 = rand(1, count($ntype));
					$nntype = $ntype[$s2];
						if($database->checkHeroItem($ownerID, $btype, $nntype)){
						$items = $database->getHeroItem(0,$ownerID, $btype, $nntype);
						$database->modifyHeroItem($items[0]['id'], 'num', $num, 1);
						$database->modifyHeroItem($items[0]['id'], 'proc', 0, 0);
					}else{
						$database->addHeroItem($ownerID, $btype, $nntype, $num);
					}
					$database->addNotice($ownerID,$data['to'],$ally,9,'REPORT_EXPL[=]'.addslashes($fromMInfo['name']).'[=]('.addslashes($coor['x']).'|'.addslashes($coor['y']).')',''.$fromMInfo['wref'].','.$btype.','.$nntype.','.$num.','.$damage.','.$exp.'',$data['endtime']);
				}
				$database->modifyHero($ownerID, 0,'health', $damage, 2);
				$ref = $database->addAttack($fromMInfo['wref'],0,0,0,0,0,0,0,0,0,0,1,3,0,0,0);
				$AttackArrivalTime = $data['endtime']; 
				$speeds = array();
				$heroPureSpeed = $getHero['speed']+$getHero['itemspeed'];
				$speeds[] = $heroPureSpeed;
				$endtime = $generator->procDistanceTime($fromMInfo,$toMInfo,min($speeds),1,$getHero,true) + $AttackArrivalTime;
				$database->addMovement(4,$data['to'],$data['from'],$ref,'0,0,0,0,0',$endtime);
			}
		}
		$database->setMovementProc($data['moveid']);
	}
	$q2 = "UPDATE ".TB_PREFIX."adventure SET end = 1 WHERE time <= ".time();
	$database->query($q2);
}
?>
