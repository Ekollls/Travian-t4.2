<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
function updateResource(){
	global $database;
	//Villages
	$time = time();
	$q = 'SELECT * FROM '.TB_PREFIX .'vdata WHERE (woodp=0 AND clayp=0 AND ironp=0 AND cropp=0) OR '.
		'(woodp<>0 AND (3600/woodp)<=('.$time.'-lastupdate)) OR '.
		'(clayp<>0 AND (3600/clayp)<=('.$time.'-lastupdate)) OR '.
		'(ironp<>0 AND (3600/ironp)<=('.$time.'-lastupdate)) OR '.
		'(cropp<>0 AND (3600/ABS(cropp))<=('.$time.'-lastupdate))';
	$list = $database->query_return($q);
	if(!empty($list) && count($list)>0){ foreach($list as $l){ updateVResource($l['wref']);}}
}

function updateWrefResource($wref){
	global $database;
	$isoases = $database->isVillageOases($wref);
	if($isoases){updateOResource($wref);} else {updateVResource($wref);}
}

function updateOResource($wref){
	global $database;
	$woodp = $clayp = $ironp = $cropp = 1;
	$q = 'SELECT * FROM '.TB_PREFIX .'odata WHERE wref='.$wref;
	$queryResult = mysql_query($q);
	$row = mysql_fetch_assoc($queryResult);

	if($row['conqured']==0){
		switch($row['type']) {
			case 1:	$woodp += 1;break;case 2:$woodp += 2;break;case 3:$woodp += 1;$cropp += 1;break;
			case 4:$clayp += 1;break;case 5:$clayp += 2;break;case 6:$clayp += 1;$cropp += 1;break;
			case 7:$ironp += 1;break;case 8:$ironp += 2;break;case 9:$ironp += 1;$cropp += 1;break;
			case 10:case 11:$cropp += 1;break;case 12:$cropp += 2;break;
		}

		$woodp *= SPEED;
		$clayp *= SPEED;
		$ironp *= SPEED;
		$cropp *= SPEED;
		$timepast = time() - $row['lastupdated'];
		$nwood = (($woodp / 3600) * $timepast);
		$nclay = (($clayp / 3600) * $timepast);
		$niron = (($ironp / 3600) * $timepast);
		$ncrop = (($cropp / 3600) * $timepast);
		$database->modifyOasisResource($row['wref'],$nwood,$nclay,$niron,$ncrop,1);
	} elseif($row['conqured']!=0 && !$database->isVillageOases($row['conqured'])) {
		updateVResource($row['conqured']);
		/*
		$q2 = 'SELECT * FROM '.TB_PREFIX .'vdata WHERE wref='.$row['conqured'];
		$queryResult2 = mysql_query($q2);
		$row2 = mysql_fetch_assoc($queryResult2);
		$database->modifyOasisResource($row['wref'],$row2['wood']/3,$row2['clay']/3,$row2['iron']/3,$row2['crop']/3,1);
		$q3 = 'UPDATE '.TB_PREFIX .'odata SET `maxstore`='.$row2['maxstore'].', `maxcrop`='.$row2['maxcrop'].' WHERE wref='.$row['wref'];
		$queryResult2 = mysql_query($q2);*/
	}

	$database->updateOasis($row['wref']);
	fixOResource($row['wref']);
	//return array('woodp'=>$woodp,'clayp'=>$clayp,'ironp'=>$ironp,'cropp'=>$cropp,'upkeep'=>0);
}

function updateVResource($wref){
	global $database,$technology,$bid1,$bid2,$bid3,$bid4,$bid5,$bid6,$bid7,$bid8,$bid9;
	$woodp = $sawmill = $clayp = $brick = $ironp = $ifound = $cropp = $grain = $bake = 0;
	$ocrop = $oclay = $owood = $oiron = 0;
	$q = 'SELECT * FROM '.TB_PREFIX .'vdata,'.TB_PREFIX .'fdata WHERE '.TB_PREFIX .'vdata.wref='.$wref.' AND '.TB_PREFIX .'vdata.wref='.TB_PREFIX .'fdata.vref';
	$queryResult = mysql_query($q);
	$row = mysql_fetch_assoc($queryResult);

	// Oases sort
	$oasisowned = $database->getOasis($row['wref']);
	if (!empty($oasisowned)) {
		foreach ($oasisowned as $oasis) {
			switch($oasis['type']) {
				case 1:	$owood += 1;break;case 2:$owood += 2;break;case 3:$owood += 1;$ocrop += 1;break;
				case 4:$oclay += 1;break;case 5:$oclay += 2;break;case 6:$oclay += 1;$ocrop += 1;break;
				case 7:$oiron += 1;break;case 8:$oiron += 2;break;case 9:$oiron += 1;$ocrop += 1;break;
				case 10:case 11:$ocrop += 1;break;case 12:$ocrop += 2;break;
			}
		}
	}

	// production
	for($i=1;$i<=38;$i++) {
		if($row['f'.$i.'t'] == 1) { $woodp += $bid1[$row['f'.$i]]['prod']; continue;}
		if($row['f'.$i.'t'] == 5) { $sawmill = $row['f'.$i]; continue;}
		if($row['f'.$i.'t'] == 2) { $clayp += $bid2[$row['f'.$i]]['prod']; continue;}
		if($row['f'.$i.'t'] == 6) { $brick = $row['f'.$i]; continue;}
		if($row['f'.$i.'t'] == 3) { $ironp += $bid3[$row['f'.$i]]['prod']; continue;}
		if($row['f'.$i.'t'] == 7) { $ifound = $row['f'.$i]; continue;}
		if($row['f'.$i.'t'] == 4) { $cropp += $bid4[$row['f'.$i]]['prod']; continue;}
		if($row['f'.$i.'t'] == 8) { $grain = $row['f'.$i]; continue;}
		if($row['f'.$i.'t'] == 9) { $bake = $row['f'.$i]; continue;}
	}

	$exwoodp = $exclayp = $exironp = $excropp = $owoodp = $oclayp = $oironp = $ocropp = $bwoodp = $bclayp =
	$bironp = $bcropp = $hwoodp = $hclayp = $hironp = $hcropp = $hproduct = 0;

	if($sawmill>0) $exwoodp += $woodp /100 * $bid5[$sawmill]['attri']; if($owood>0) $owoodp += $woodp*$owood*0.25;	
	if($brick>0) $exclayp += $clayp /100 * $bid6[$brick]['attri']; if($oclay>0) $oclayp += $clayp*$oclay*0.25;
	if($ifound>0) $exironp += $ironp /100 * $bid7[$ifound]['attri']; if($oiron>0) $oironp += $ironp*$oiron*0.25;
	if($grain>0) $excropp += $cropp /100 * $bid8[$grain]['attri']; if($bake>0) $excropp += $cropp /100 * $bid9[$bake]['attri']; if($ocrop>0) $ocropp += $cropp*$ocrop*0.25;

	$heroData = $database->getHero($row['owner']);
	if($heroData['dead']==0 && $heroData['wref']==$row['wref']){
		$hwoodp += $heroData['r1']*10*$heroData['product']; $hclayp += $heroData['r2']*10*$heroData['product'];
		$hironp += $heroData['r3']*10*$heroData['product']; $hcropp += $heroData['r4']*10*$heroData['product'];
		$hproduct += $heroData['r0']*3*$heroData['product'];
	}

	$user = $database->getUser($row['owner'],1);
	if($user['b1']>time()) $bwoodp += $woodp*0.25;
	if($user['b2']>time()) $bclayp += $clayp*0.25;
	if($user['b3']>time()) $bironp += $ironp*0.25;
	if($user['b4']>time()) $bcropp += $cropp*0.25;

	$woodp += $exwoodp+$owoodp+$bwoodp+$hwoodp+$hproduct;
	$clayp += $exclayp+$oclayp+$bclayp+$hclayp+$hproduct;
	$ironp += $exironp+$oironp+$bironp+$hironp+$hproduct;
	$cropp += $excropp+$ocropp+$bcropp+$hcropp+$hproduct;


	$woodp *= SPEED;
	$clayp *= SPEED;
	$ironp *= SPEED;
	$cropp *= SPEED;
	
	if($row['name'] == "Farm") {
		$woodp = $clayp = $ironp = $cropp = $row['prodf'];
	}

	// Upkeep
	$allUnits = $technology->getAllUnits($row['wref']);
	$fieldArray = $database->getResourceLevel($row['wref']);
	$hdt = 0; $ownerTribe = $database->getUserField($row['owner'],'tribe',0);
	if($ownerTribe==1){for($i=1;$i<=40;$i++){if($fieldArray['f'.$i.'t']==41){$hdt=$fieldArray['f'.$i]; break;}}}
	$upkeep = $technology->getUpkeep($allUnits,0,$hdt);
	$dietArtEff = $database->getArtEffDiet($row['wref']);
	$upkeep *= $dietArtEff;

	$cropp -= $upkeep;
	$cropp -= $row['pop'];


	$timepast = time() - $row['lastupdate'];
	$nwood = (($woodp / 3600) * $timepast);
	$nclay = (($clayp / 3600) * $timepast);
	$niron = (($ironp / 3600) * $timepast);
	$ncrop = (($cropp / 3600) * $timepast);
	
	//if($row['cropp'] < 0) { $ncrop = 0; }
	
	
	$database->modifyResource($row['wref'],$nwood,$nclay,$niron,$ncrop,1);
	$database->modifyProduction($row['wref'],$woodp,$clayp,$ironp,$cropp,$upkeep);
	//starv($row['wref']);
	$database->updateVillage($row['wref']);
	fixResource($row['wref']);
	if($row['name'] == "Farm") {
		$database->query_return2("UPDATE ".TB_PREFIX."vdata SET maxstore = maxstoref WHERE Name = 'Farm'");
		$database->query_return2("UPDATE ".TB_PREFIX."vdata SET maxcrop = maxstoref WHERE Name = 'Farm'");
	}
	//return array('woodp'=>$woodp,'clayp'=>$clayp,'ironp'=>$ironp,'cropp'=>$cropp,'upkeep'=>$upkeep);
}

function starv($wref) {
	global $database; 
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
	$stVil = $database->getVillage($wref);
	if(!empty($stVil) && isset($stVil['crop']) && $stVil['crop']<0){
		$maxcount = $maxtype = $enfid = $trpid = $mvid = 0;
		$movement = $database->getVillageMovementArray($wref);
		if(!empty($movement)) {
			if(count($movement) > 0) {
				foreach($movement as $mv) {
					for($i=1;$i<=10;$i++) {
						if(isset($mv['u'.$i]) && $mv['u'.$i] > $maxcount){
							$maxcount = $mv['u'.$i];
							$maxtype = $i;
							$mvid = $mv['id']; $attid = $mv['ref'];
						}
					}
				}
				if (isset($mvid)){
					$mvArray = $database->getMovementById($mvid);
					$mvUnitCount = 0;
					if(!empty($mvArray) && count($mvArray)>0){for($i = 1 ; $i <= 11 ; $i++){$mvUnitCount += $mvArray['u'.$i];}}
					$difcrop = -1*$stVil['crop'];
					global ${'u'.$maxtype}; $ud = ${'u'.$maxtype}; $starvcost = $ud['wood']+$ud['clay']+$ud['iron']+$ud['crop'];
					$killunits = intval(ceil($difcrop/$starvcost));
					$killunits = min($maxcount,$killunits);
					if ($mvUnitCount>$killunits){
						$database->modifyAttack($attid, $maxtype, $killunits);
					}else{
						$database->setMovementProc($mvid);
					}
				}
			}
		} else {
			$mytrappedunits = $database->getTrappedFrom($wref);
			if(count($mytrappedunits) > 0) {
				foreach($mytrappedunits as $trapped) {
					for($i=1;$i<=50;$i++) {
						if($trapped['u'.$i] > $maxcount){
							$maxcount = $trapped['u'.$i];
							$maxtype = $i;
							$trpid = $trapped['id'];
						}
					}
				}
				if (isset($trpid)){
					$trpArray = $database->getTrapped($trpid);
					$trpUnitCount = 0;
					for($i = 1 ; $i <= 50 ; $i++){$trpUnitCount += $trpArray['u'.$i];} $trpUnitCount += $trpArray['hero'];
					$difcrop = -1*$stVil['crop'];
					global ${'u'.$maxtype}; $ud = ${'u'.$maxtype}; $starvcost = $ud['wood']+$ud['clay']+$ud['iron']+$ud['crop'];
					$killunits = intval(ceil($difcrop/$starvcost));
					$killunits = min($maxcount,$killunits);
					if ($trpUnitCount>$killunits){
						$database->modifyTrapped($trpid, $maxtype, $killunits, 0);
					}else{
						$database->removeTrapped($trpid);
					}
				}
			} else {
				$list['extra'] = ''; $order['by'] = 'distance'; $coor = $database->getCoor($wref);$order['x'] = $coor['x'];$order['y'] = $coor['y'];
				$order['max'] = 2 * WORLD_MAX + 1;
				$oasats = $database->getVillageOasis($list,30,$order); $oea = array();
				foreach($oasats as $os){$ea = $database->getEnforceVillage($os['wref'],0); $oea = array_merge($oea,$ea);}
				if(count($oea)>0){
					foreach ($oea as $oe){
						for($i = 1 ; $i <= 50 ; $i++){
							if($oe['u'.$i] > $maxcount){
								$maxcount = $oe['u'.$i];
								$maxtype = $i;
								$enfid = $oe['id'];
							}
						}
					}
				} else {
					$enforcearray = $database->getEnforceVillage($wref,0);
					if(count($enforcearray)>0){
						foreach ($enforcearray as $enforce){
							for($i = 1 ; $i <= 50 ; $i++){
								if($enforce['u'.$i] > $maxcount){
									$maxcount = $enforce['u'.$i];
									$maxtype = $i;
									$enfid = $enforce['id'];
								}
							}
						}
					}else{
						$unitarray = $database->getUnit($wref);
						for($i = 1 ; $i <= 50 ; $i++){
							if($unitarray['u'.$i] > $maxcount){
								$maxcount = $unitarray['u'.$i];
								$maxtype = $i;
							}
						}
					}
				}
				$difcrop = -1*$stVil['crop'];
				if ($maxtype>0 && $maxcount>0){
					global ${'u'.$maxtype}; $ud = ${'u'.$maxtype}; $starvcost = $ud['wood']+$ud['clay']+$ud['iron']+$ud['crop'];
					$killunits = intval(ceil($difcrop/$starvcost));
					$killunits = min($maxcount,$killunits);
					if (isset($enfid)){
						$enfArray = $database->getEnforceArray($enfid,0);
						$enfUnitCount = 0;
						for($i = 1 ; $i <= 50 ; $i++){$enfUnitCount += $enfArray['u'.$i];}
						$enfUnitCount += $enfArray['hero'];
						if ($enfUnitCount>$killunits){
							$database->modifyEnforce($enfid, $maxtype, $killunits, 0);
						}else{
							$database->deleteReinf($enfid);
						}
					}else{
						$database->modifyUnit($wref, $maxtype, $killunits, 0);
					}
					$newcrop = ($killunits * $starvcost) - $difcrop;
					$database->setVillageField($wref, 'crop', $newcrop);
				}
			}
		}
	}
}

function fixResource($wref){
	global $database,$bid10,$bid11,$bid38,$bid39;
	
	$q = 'SELECT * FROM '.TB_PREFIX .'vdata WHERE '.TB_PREFIX .'vdata.wref='.$wref;
	$queryResult = mysql_query($q);
	if($queryResult){
		$row = mysql_fetch_assoc($queryResult);
		$fq = 'SELECT * FROM '.TB_PREFIX .'fdata WHERE vref='.$wref;
		$fqueryResult = mysql_query($fq);
		if($fqueryResult){
			$frow = mysql_fetch_assoc($fqueryResult);
			if($frow){
				$maxstore = 0;
				$maxcrop = 0;
				for($i=1;$i<=40;$i++){
					if ($frow['f'.$i.'t']==10 && $frow['f'.$i]>0) $maxstore += $bid10[$frow['f'.$i]]['attri']*STORAGE_MULTIPLIER;
					if ($frow['f'.$i.'t']==11 && $frow['f'.$i]>0) $maxcrop += $bid11[$frow['f'.$i]]['attri']*STORAGE_MULTIPLIER;
					if ($frow['f'.$i.'t']==38 && $frow['f'.$i]>0) $maxstore += $bid38[$frow['f'.$i]]['attri']*STORAGE_MULTIPLIER;
					if ($frow['f'.$i.'t']==39 && $frow['f'.$i]>0) $maxcrop += $bid39[$frow['f'.$i]]['attri']*STORAGE_MULTIPLIER;
				}
				if(STORAGE_BASE>$maxstore) {$maxstore = STORAGE_BASE;}
				if ($maxstore!=$row['maxstore']) {$q = 'UPDATE '.TB_PREFIX .'vdata SET `maxstore`='.$maxstore.' WHERE `wref`='.$wref;	mysql_query($q);}
				if(STORAGE_BASE>$maxcrop) {$maxcrop = STORAGE_BASE;}
				if ($maxcrop!=$row['maxcrop']) {$q = 'UPDATE '.TB_PREFIX .'vdata SET `maxcrop`='.$maxcrop.' WHERE `wref`='.$wref;	mysql_query($q);}
			}
		}
		$q = '';
		if($row['wood']>$row['maxstore']) {$q.=' `wood`=`maxstore`, ';} elseif($row['wood']<0) {$q.=' `wood`=0, ';}
		if($row['clay']>$row['maxstore']) {$q.=' `clay`=`maxstore`, ';} elseif($row['clay']<0) {$q.=' `clay`=0, ';}
		if($row['iron']>$row['maxstore']) {$q.=' `iron`=`maxstore`, ';} elseif($row['iron']<0) {$q.=' `iron`=0, ';}
		if($row['crop']>$row['maxcrop'])  {$q.=' `crop`=`maxcrop`, ';} elseif($row['crop']<0) {$q.=' `crop`=0, ';}

		if($q!='') {
			$q = substr($q,0,strlen($q)-2);
			$q = 'UPDATE '.TB_PREFIX .'vdata SET '.$q.' WHERE `wref`='.$wref;
			mysql_query($q);
		}	
	}
}

function fixOResource($wref){
	global $database;
	$q = 'SELECT * FROM '.TB_PREFIX .'odata WHERE '.TB_PREFIX .'odata.wref='.$wref;
	$queryResult = mysql_query($q);
	$row = mysql_fetch_assoc($queryResult);

	$q = '';
	if(STORAGE_BASE>$row['maxstore']) {$q.=' `maxstore`='.STORAGE_BASE.', ';}
	if(STORAGE_BASE>$row['maxcrop'])  {$q.=' `maxcrop`='.STORAGE_BASE.', ';}

	if($q!='') {
		$q = substr($q,0,strlen($q)-2);
		$q = 'UPDATE '.TB_PREFIX .'odata SET '.$q.' WHERE `wref`='.$wref;
		mysql_query($q);
	}

	$q = 'SELECT * FROM '.TB_PREFIX .'odata WHERE '.TB_PREFIX .'odata.wref='.$wref;
	$queryResult = mysql_query($q);
	$row = mysql_fetch_assoc($queryResult);
	$q = '';
	if($row['wood']>$row['maxstore']) {$q.=' `wood`=`maxstore`, ';} elseif($row['wood']<0) {$q.=' `wood`=0, ';}
	if($row['clay']>$row['maxstore']) {$q.=' `clay`=`maxstore`, ';} elseif($row['clay']<0) {$q.=' `clay`=0, ';}
	if($row['iron']>$row['maxstore']) {$q.=' `iron`=`maxstore`, ';} elseif($row['iron']<0) {$q.=' `iron`=0, ';}
	if($row['crop']>$row['maxcrop'])  {$q.=' `crop`=`maxcrop`, ';} elseif($row['crop']<0) {$q.=' `crop`=0, ';}

	if($q!='') {
		$q = substr($q,0,strlen($q)-2);
		$q = 'UPDATE '.TB_PREFIX .'odata SET '.$q.' WHERE `wref`='.$wref;
		mysql_query($q);
	}
}

?>
