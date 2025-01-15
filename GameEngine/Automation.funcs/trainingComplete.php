<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
function trainingComplete() {
	villageTrain();
	oasesTrain();
}
function villageTrain() {
        global $database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
    $trainlist = $database->getTrainingList();
    if(count($trainlist) > 0) {
		$time = time();
		foreach($trainlist as $train) {
			if ($train['unit']!=0){
				$trained = 0;
				if ($train['endat']<=$time){
					$trained = $train['amt'];
				} else {
					$timepast = $time - $train['commence'];
					if($timepast>0){
						$timepast *= 1000;
						$eachtime = $train['eachtime'];
						if($eachtime == 0) { $eachtime = 1; }
						$trained = floor($timepast/$eachtime);
						if($trained > $train['amt']) {$trained = $train['amt'];}
						if($trained>0){
							$newcommence = $train['commence'] + floor(($trained*$train['eachtime'])/1000);
							$database->modifyCommence($train['id'],$newcommence);
						}
					}
				}
				if($trained > 0) {
					$database->updateTraining($train['id'],$trained);
					$unit = $train['unit'];
					if($unit>60 && $unit<110) $unit -=60;
					$database->modifyUnit($train['vref'],$unit,$trained,1);
				}
			}
		}
	}
	
	$time = time();
	$q2 = "SELECT * FROM ".TB_PREFIX."training WHERE unit = 0 AND endat<=".$time;
	$dataarray2 = $database->query_return($q2);
	foreach($dataarray2 as $data3) {
		$getVil = $database->getMInfo($data3['vref']);
		$database->modifyHero($getVil['owner'],0,'dead', 0, 0);
		$database->modifyHero($getVil['owner'],0,'health', 100, 0);
		$database->editTableField('units', 'hero', 1, 'vref', $data3['vref']);
		$database->trainHero($data3['id'],0,0,1);
	}
	
	$database->removeZeroTrain();
}

function oasesTrain($wref){
	global $database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
	$time = time();
	$tdiff = ($time-COMMENCE)/(ROUNDLENGHT*86400);
	$tm = pow(SPEED*INCREASE_SPEED,1/5); $htc = round(500*$tdiff*$tm);
	$htc = min(max($htc,15),1100);
	$tm = min(max($htc,2),10);
	$q = 'SELECT * FROM '.TB_PREFIX.'odata WHERE owner=3 AND wref='.$wref;
	$oasesList = $database->query_return($q);
	if(!empty($oasesList) && count($oasesList)>0){
		foreach($oasesList as $oases){
			$units = $database->getUnit($oases['wref']);
			$totc = 0; for($i=31;$i<=40;$i++){$totc += $units['u'.$i];}
			if($totc<$htc){
				$trcount = round(($time-max($oases['lasttrain'],$oases['lastfarmed']))/3600);// die($trcount);
				if($trcount>12){
					$i= rand(31,36);
					if($units['u'.($i)]<10) {$units['u'.($i)]+=(rand(1,3) * 10);}elseif($units['u'.($i)]<25*$tm) {$units['u'.($i)]+=(rand(3,5) * 10);}else {$units['u'.($i)]+=(1 * 10);}
					for(;$i<=40;$i++){
						if($units['u'.($i-1)]>35*$tm) {$units['u'.$i]+=round($units['u'.($i-1)]/10);}
						elseif($units['u'.($i-1)]>25*$tm) {$units['u'.$i]+=rand(1,2);}
						elseif($units['u'.($i-1)]>10*$tm) {$units['u'.$i]+=rand(0,1);}
						$randShift = rand(10,80)*$tm; $rsh = rand(1,40)*$tm;
						if($units['u'.($i-1)]>$randShift) {$rsv = abs(round(($units['u'.($i-1)]-($randShift+$rsh))/5));$units['u'.$i]+=$rsv;$units['u'.($i-1)]-=($randShift+$rsh); $units['u'.($i-1)] = max(0,$units['u'.($i-1)]);}
					}
					$q = 'UPDATE '.TB_PREFIX.'units SET '; for($i=31;$i<=40;$i++){$q.=' u'.($i).'='.$units['u'.$i].',';} $q.=' u1=0 WHERE vref='.$oases['wref'];
					mysql_query($q);
					$database->oasesUpdateLastTrain($oases['wref']);
				}
			}
		}
	}
}
?>
