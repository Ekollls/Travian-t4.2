<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include_once("Database.php");
include_once("Generator.php");
include_once("Data/buidata.php");

include_once("Database/db_MYSQL.php");
$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
if(@mysql_num_rows($result)){
$row = mysql_fetch_array($result);
define("relArte",$row['relArte']);
define("relns",$row['relns']);
define("eachArte",$row['eachArte']);
define("NATARS_EXPANTION_INT",43200/* $row['eachArte']  43200*/);//IN SEC
define("NATARS_POPUP_INT",1800);//IN SEC

// Activate artefacts ***
$result2 = mysql_query("SELECT * FROM ".TB_PREFIX."artefacts");
while($row2 = mysql_fetch_array($result2)) {
	if( time() > ($row2['conquered']+eachArte) ) {
		if($row2['owner'] == "2") {
			// is natar :|
		}else{
			mysql_query("UPDATE ".TB_PREFIX."artefacts SET status = 1 WHERE id=".$row2['id']);
		}
	}
}





class Natars {
	function Natars() {
	}
	
	public function doJobs() {
		global $database;
		$np = $database->getNatarsProgress();
		$np['lastexpandat'] = max(isset($np['lastexpandat'])?$np['lastexpandat']:0, COMMENCE);
		$np['lastpopupat'] = max(isset($np['lastpopupat'])?$np['lastpopupat']:0, COMMENCE);
		$np['wwbpreleasedat'] = max(isset($np['wwbpreleasedat'])?$np['wwbpreleasedat']:0, COMMENCE);
/*
		$expint = max(1800,NATARS_EXPANTION_INT/SPEED);
		while(($np['lastexpandat']+$expint)<time()){
			$np['lastexpandat']+=$expint;
			$this->expand();
		}
		$database->setNatarsProgress('lastexpandat',$np['lastexpandat']);
		
		$nvs = $database->getNatarsExpansions();
		$count = count($nvs);
		$popupint = max(600,NATARS_POPUP_INT/SPEED);
		if((($np['lastpopupat']+$popupint)<time())&&($count>0)){
			while (($np['lastpopupat']+$popupint)<time()){
				if ($np['lastpopupedvillage']>=$count) $np['lastpopupedvillage'] = 0;
				$toPopup = $nvs[$np['lastpopupedvillage']];
				$wref = $toPopup['wref'];
				if ($wref) $this->upgradeVillage($wref);
				$np['lastpopupat']+=$popupint;
				$np['lastpopupedvillage']++;
			}
			$database->setNatarsProgress('lastpopupat',$np['lastpopupat']);
			$database->setNatarsProgress('lastpopupedvillage',$np['lastpopupedvillage']);
		}
*/
		if(time()>relArte){
			if ($np['artefactreleased']==0 &&(time()>relArte)/*(COMMENCE+(ROUNDLENGHT*86400/3)))*/){
				$this->releaseArtefacts();
				$database->setNatarsProgress('artefactreleased',1);
				$database->setNatarsProgress('artefactreleasedat',time());
			}
		}
		if(time()>relns){
			if ($np['wwbpreleased']==0 &&(time()>relns)/*&&(time()>(COMMENCE+(ROUNDLENGHT*86400*2/3)))*/){
				$this->releaseWWBP();
				$database->setNatarsProgress('wwbpreleased',1);
				$database->setNatarsProgress('wwbpreleasedat',time());
			}
		}
	}
	
	public function checkGrayAreaInvasion($id){
		global $database,$generator;
		$wdataState = $database->getVillageState($id);
		if ($wdataState==true){
			$village = $database->getMInfo($id);
			$distance = sqrt(($village['x']*$village['x'])+($village['y']*$village['y']));
			if ($distance<=NATARS_MAX){
				$nc = $database->getNatarsCapital();
				$data = array();
				for($i=1;$i<=3;$i++){
					$data['u1'] = rand(1000,1200)*SPEED; $data['u2'] = rand(2000,3000)*SPEED; $data['u3'] = 10000; $data['u4'] = rand(5,10)*SPEED;
					$data['u5'] = rand(600,800)*SPEED; $data['u6'] = rand(500,1000)*SPEED;
					$data['u7'] = rand(100,150)*SPEED; $data['u8'] = rand(10,15)*SPEED; $data['u9'] = 0; $data['u10'] = 9; $data['u11'] = 0;
					//$database->modifyUnit($nc['wref'],"u41",$data['u1'],0); $database->modifyUnit($nc['wref'],"u42",$data['u2'],0);
					//$database->modifyUnit($nc['wref'],"u43",$data['u3'],0); $database->modifyUnit($nc['wref'],"u44",$data['u4'],0);
					//$database->modifyUnit($nc['wref'],"u45",$data['u5'],0); $database->modifyUnit($nc['wref'],"u46",$data['u6'],0);
					//$database->modifyUnit($nc['wref'],"u47",$data['u7'],0); $database->modifyUnit($nc['wref'],"u48",$data['u8'],0);
					//$database->modifyUnit($nc['wref'],"u49",$data['u9'],0); $database->modifyUnit($nc['wref'],"u50",$data['u10'],0);
					//$database->modifyUnit($nc['wref'],"hero",$data['u11'],0);
					$reference = $database->addAttack($nc['wref'],$data['u1'],$data['u2'],$data['u3'],$data['u4'],$data['u5'],
						$data['u6'],$data['u7'],$data['u8'],$data['u9'],$data['u10'],$data['u11'],3,0,0,0);
					$time = max(86400/SPEED,300);
					$database->addMovement(3,$nc['wref'],$id,$reference,0,($time+time()));
				}
			}
		}
	}
	
	private function expand() {
		global $database;
		$wref = $database->generateBase(0);
		$database->setFieldTaken($wref);
		$database->addNatarsVillage($wref,2,'Natars','0');
		$database->addResourceFields($wref,$database->getVillageType($wref));
		$database->addUnits($wref);
		$database->addTech($wref);
		$database->addABTech($wref);
		return $wref;
	}
	
	private function upgradeVillage($wref) {
		global $database;
		$upCatched = false;
		if ($wref) {
			//mainbuilding to 10
			if(!$upCatched){
				$f = ''; $fv = 0; $ft = ''; $ftv = 15;
				$mainbuilding = $this->getTypeLevel($ftv,$wref);
				if ($mainbuilding<=0){$f = 'f26'; $fv = 1; $ft = $f.'t'; $upCatched = true;
				}elseif ($mainbuilding<5){$f = 'f26'; $fv = 5; $ft = $f.'t'; $upCatched = true;
				}elseif ($mainbuilding<10){$f = 'f26'; $fv = 10; $ft = $f.'t'; $ftv = 15;$upCatched = true;
				}
			}
			//rallypoint to 16
			if(!$upCatched){
				$f = ''; $fv = 0; $ft = ''; $ftv = 16;
				$rallypoint = $this->getTypeLevel($ftv,$wref);
				if ($rallypoint<=0){$f = 'f39';	$fv = 1; $ft = $f.'t'; $upCatched = true;
				}elseif ($rallypoint<8){$f = 'f39';	$fv = 5; $ft = $f.'t'; $upCatched = true;
				}elseif ($rallypoint<16){$f = 'f39'; $fv = 10; $ft = $f.'t'; $upCatched = true;
				}
			}
			
			if ($f != '') $database->setVillageLevel($wref, $f, $fv);
			if ($ft != '') $database->setVillageLevel($wref, $ft, $ftv);
			$this->recountPop($wref);
		}
	}
	
	private function recountPop($vid){
		global $database;
        $fdata = $database->getResourceLevel($vid); 
        $popTot = 0;
        for ($i = 1; $i <= 40; $i++) {
            $lvl = $fdata["f".$i];
            $building = $fdata["f".$i."t"];
            if($building){
                $popTot += $this->buildingPOP($building,$lvl);
            }       
        }
        $database->setVillageField($vid, 'pop', $popTot);
        return $popTot;
    }
	
	private function buildingPOP($f,$lvl){
		$name = "bid".$f;
		global $$name;        
		$popT = 0;
		$dataarray = $$name;
		for ($i = 1; $i <= $lvl; $i++) {
			if (isset($dataarray[$i]['pop'])) {$popT += $dataarray[$i]['pop'];}
		}
		return $popT;
    }
	
	private function getTypeLevel($tid,$vid=0) {
		global $database;
		$keyholder = array();
		$resourcearray = $database->getResourceLevel($vid);

		foreach(array_keys($resourcearray,$tid) as $key) {
			if(strpos($key,'t')) {
				$key = preg_replace("/[^0-9]/", '', $key);
				array_push($keyholder, $key);
			}	 
		}
		$element = count($keyholder);
		if($element >= 2) {
			if($tid <= 4) {
				$temparray = array();
				for($i=0;$i<=$element-1;$i++) {
					array_push($temparray,$resourcearray['f'.$keyholder[$i]]);
				}
				foreach ($temparray as $key => $val) {
					if ($val == max($temparray)) 
					$target = $key; 
				}
			}
			else {
				$target = 0;
				for($i=1;$i<=$element-1;$i++) {
					if($resourcearray['f'.$keyholder[$i]] > $resourcearray['f'.$keyholder[$target]]) {
						$target = $i;
					}
				}
			}
		}
		else if($element == 1) {
			$target = 0;
		}
		else {
			return 0;
		}
		if($keyholder[$target] != "") {
			return $resourcearray['f'.$keyholder[$target]];
		}
		else {
			return 0;
		}
	}
	
	private function releaseWWBP() {
		global $database;
		$myFile = dirname(__FILE__)."/../Templates/text.tpl";
		$fh = fopen($myFile, 'w');
		$text = file_get_contents(dirname(__FILE__)."/../Templates/text_format.tpl");
		$text = preg_replace("'%TEKST%'",'WWBPRELEASED',$text);
		fwrite($fh, $text);
		fclose($fh);
		$database->query("UPDATE ".TB_PREFIX."users SET ok = '1' WHERE 1");
		$WWs = $database->getNatarsWWVillages();
		$WWsCount = count($WWs);
		$BPCount = max($WWsCount*2,10);
		$arttitle = html_entity_decode(JR_ART_BPTTL);
        	$vname = html_entity_decode(JR_ART_BPVN);
		$desc = html_entity_decode(JR_ART_BPDES);
        	$effect = '1';
		for($i = 1; $i <= $BPCount; $i++) {
			$this->createArtefactVillage(2, 11, 3, $arttitle, $vname, $desc, 11, $effect, 2, 'type11.gif');
        	}
	}
	
	private function releaseArtefacts() {
		global $database;
		$myFile = dirname(__FILE__)."/../Templates/text.tpl";
		$fh = fopen($myFile, 'w');
		$text = file_get_contents(dirname(__FILE__)."/../Templates/text_format.tpl");
		$text = preg_replace("'%TEKST%'",'ARTEFACTSRELEASED',$text);
		fwrite($fh, $text);
		fclose($fh);
		$database->query("UPDATE ".TB_PREFIX."users SET ok = '1' WHERE 1");
		$this->releaseArchitects();
		$this->releaseMilitaryHaste();
		$this->releaseHawksEyesight();
		$this->releaseTheDiet();
		$this->releaseAcademicAdvancement();
		$this->releaseRivalsConfusion();
		$this->releaseStorageMasterPlan();
		$this->releaseArtefactOfTheFool();
	}
	
	private function createArtefactVillage($uid=2, $type, $size, $art_name, $village_name, $desc, $effecttype, $effect, $aoe, $img) {
		global $database;
		$wref = $this->expand();
		$database->addArtefact($wref, $uid, $type, $size, $art_name, $desc, $effecttype, $effect, $aoe, $img);
		$database->setVillageField($wref,'name',$village_name);
		$speed = SPEED/10;
		$fq = ' vref = vref';
		$residence = $this->getTypeLevel(25,$wref);
		$treasury = $this->getTypeLevel(27,$wref);
		if($size == 1) {
			$uq = " u41 = " . (rand(1000, 2000) * $speed) . ", u42 = " . (rand(1500, 2000) * $speed) . ", u43 = " . (rand(2300, 2800) * $speed) 
				. ", u44 = " . (rand(25, 75) * $speed) . ", u45 = " . (rand(1200, 1900) * $speed) . ", u46 = " . (rand(1500, 2000) * $speed) 
				. ", u47 = " . (rand(500, 900) * $speed) . ", u48 = " . (rand(100, 300) * $speed) . " , u49 = " . (rand(1, 5) * $speed) 
				. ", u50 = " . (rand(1, 5) * $speed);
			if ($residence<10){	$fq .= ", f28t = 25, f28 = 10 ";}
			if ($treasury<10){$fq .= ", f22t = 27, f22 = 10 ";}
		} elseif($size == 2) {
			$uq = " u41 = " . (rand(2000, 4000) * $speed) . ", u42 = " . (rand(3000, 4000) * $speed) . ", u43 = " . (rand(4600, 5600) * $speed) 
				. ", u44 = " . (rand(50, 150) * $speed) . ", u45 = " . (rand(2400, 3800) * $speed) . ", u46 = " . (rand(3000, 4000) * $speed) 
				. ", u47 = " . (rand(1000, 1800) * $speed) . ", u48 = " . (rand(200, 600) * $speed) . " , u49 = " . (rand(2, 10) * $speed) 
				. ", u50 = " . (rand(2, 10) * $speed);
			if ($residence<10){$fq .= ", f28t = 25, f28 = 10 ";}
			if ($treasury<20){$fq .= ", f22t = 27, f22 = 20 ";}
		} elseif($size == 3) {
			$uq = " u41 = " . (rand(4000, 8000) * $speed) . ", u42 = " . (rand(6000, 8000) * $speed) . ", u43 = " . (rand(9200, 11200) * $speed) 
				. ", u44 = " . (rand(100, 300) * $speed) . ", u45 = " . (rand(4800, 7600) * $speed) . ", u46 = " . (rand(6000, 8000) * $speed) 
				. ", u47 = " . (rand(2000, 3600) * $speed) . ", u48 = " . (rand(400, 1200) * $speed) . " , u49 = " . (rand(4, 20) * $speed) 
				. ", u50 = " . (rand(4, 20) * $speed);
			if ($residence<20){$fq .= ", f28t = 25, f28 = 20 ";}
			if ($treasury<20){$fq .= ", f22t = 27, f22 = 20 ";}
		}
		$database->query("UPDATE " . TB_PREFIX . "units SET ".$uq." WHERE vref = ".$wref);
		if ($fq!=' vref = vref') $database->query("UPDATE " . TB_PREFIX . "fdata SET ".$fq." WHERE vref = ".$wref);
		$this->recountPop($wref);
	}
	
	private function releaseArchitects() {
		$type = 2;
        	$effecttype = '2';
		$arttitle = html_entity_decode(ART_AR_STTL);
        	$vname = html_entity_decode(ART_AR_SVN);
		$desc = html_entity_decode(ART_AR_SDES);
		$effect = '4';
		$aoe = 1;
        	for($i = 1; $i <= 6; $i++) {$this->createArtefactVillage(2, $type, 1, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type2.gif');}
		
		$arttitle = html_entity_decode(ART_AR_GTTL);
        	$vname = html_entity_decode(ART_AR_GVN);
		$desc = html_entity_decode(ART_AR_GDES);
        	$effect = '3';
		$aoe = 2;
        	for($i = 1; $i <= 4; $i++) {$this->createArtefactVillage(2, $type, 2, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type2.gif');}

		$arttitle = html_entity_decode(ART_AR_UTTL);
        	$vname = html_entity_decode(ART_AR_UVN);
		$desc = html_entity_decode(ART_AR_UDES);
        	$effect = '5';
		$aoe = 3;
        	for($i = 1; $i <= 1; $i++) {$this->createArtefactVillage(2, $type, 3, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type2.gif');}
	}
	
	private function releaseMilitaryHaste() {
		$type = 4;
        	$effecttype = '4';
		$arttitle = html_entity_decode(ART_MH_STTL);
        	$vname = html_entity_decode(ART_MH_SVN);
		$desc = html_entity_decode(ART_MH_SDES);
        	$effect = '2';
		$aoe = 1;
        	for($i = 1; $i <= 6; $i++) {$this->createArtefactVillage(2, $type, 1, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type4.gif');}

		$arttitle = html_entity_decode(ART_MH_GTTL);
		$vname = html_entity_decode(ART_MH_GVN);
		$desc = html_entity_decode(ART_MH_GDES);
        	$effect = '1.5';
		$aoe = 2;
        	for($i = 1; $i <= 4; $i++) {$this->createArtefactVillage(2, $type, 2, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type4.gif');}

		$arttitle = html_entity_decode(ART_MH_UTTL);
        	$vname = html_entity_decode(ART_MH_UVN);
		$desc = html_entity_decode(ART_MH_UDES);
        	$effect = '3';
		$aoe = 3;
        	for($i = 1; $i <= 1; $i++) {$this->createArtefactVillage(2, $type, 3, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type4.gif');}
	}
	
	private function releaseHawksEyesight() {
		$type = 5;
        	$effecttype = 5;
		$arttitle = html_entity_decode(ART_HS_STTL);
        	$vname = html_entity_decode(ART_HS_SVN);
		$desc = html_entity_decode(ART_HS_SDES);
        	$effect = '5';
		$aoe = 1;
        	for($i = 1; $i <= 5; $i++) {$this->createArtefactVillage(2, $type, 1, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type5.gif');}

		$arttitle = html_entity_decode(ART_HS_GTTL);
        	$vname = html_entity_decode(ART_HS_GVN);
		$desc = html_entity_decode(ART_HS_GDES);
        	$effect = '3';
		$aoe = 2;
		for($i = 1; $i <= 4; $i++) {$this->createArtefactVillage(2, $type, 2, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type5.gif');}

		$arttitle = html_entity_decode(ART_HS_UTTL);
        	$vname = html_entity_decode(ART_HS_UVN);
		$desc = html_entity_decode(ART_HS_UDES);
		$effect = '10';
		$aoe = 3;
		for($i = 1; $i <= 1; $i++) {$this->createArtefactVillage(2, $type, 3, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type5.gif');}
	}
	
	private function releaseTheDiet() {
		$type = 6;
        	$effecttype = 6;
		$arttitle = html_entity_decode(ART_TD_STTL);
        	$vname = html_entity_decode(ART_TD_SVN);
		$desc = html_entity_decode(ART_TD_SDES);
        	$effect = 0.5;
		$aoe = 1;
        	for($i = 1; $i <= 6; $i++) {$this->createArtefactVillage(2, $type, 1, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type6.gif');}

		$arttitle = html_entity_decode(ART_TD_GTTL);
        	$vname = html_entity_decode(ART_TD_GVN);
		$desc = html_entity_decode(ART_TD_GDES);
        	$effect = 0.75;
		$aoe = 2;
        	for($i = 1; $i <= 4; $i++) {$this->createArtefactVillage(2, $type, 2, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type6.gif');}

		$arttitle = html_entity_decode(ART_TD_UTTL);
        	$vname = html_entity_decode(ART_TD_UVN);
		$desc = html_entity_decode(ART_TD_UDES);
        	$effect = 0.5;
		$aoe = 3;
        	for($i = 1; $i <= 4; $i++) {$this->createArtefactVillage(2, $type, 3, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type6.gif');}
	}
	
	private function releaseAcademicAdvancement() {
		$type = 8;
        	$effecttype = 8;
		$arttitle = html_entity_decode(ART_AA_STTL);
        	$vname = html_entity_decode(ART_AA_SVN);
		$desc = html_entity_decode(ART_AA_SDES);
		$effect = 0.5;
		$aoe = 1;
        	for($i = 1; $i <= 6; $i++) {$this->createArtefactVillage(2, $type, 1, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type8.gif');}

		$arttitle = html_entity_decode(ART_AA_GTTL);
        	$vname = html_entity_decode(ART_AA_GVN);
		$desc = html_entity_decode(ART_AA_GDES);
		$effect = 0.75;
		$aoe = 2;
        	for($i = 1; $i <= 4; $i++) {$this->createArtefactVillage(2, $type, 2, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type8.gif');}

		$arttitle = html_entity_decode(ART_AA_UTTL);
        	$vname = html_entity_decode(ART_AA_UVN);
		$desc = html_entity_decode(ART_AA_UDES);
		$effect = 0.5;
		$aoe = 3;
		for($i = 1; $i <= 1; $i++) {$this->createArtefactVillage(2, $type, 3, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type8.gif');}
	}
	
	private function releaseRivalsConfusion() {
		$type = 7;
        	$effecttype = 7;
		$arttitle = html_entity_decode(ART_RC_STTL);
        	$vname = html_entity_decode(ART_RC_SVN);
		$desc = html_entity_decode(ART_RC_SDES);
        	$effect = '200';
		$aoe = 1;
		for($i = 1; $i <= 6; $i++) {$this->createArtefactVillage(2, $type, 1, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type7.gif');}

		$arttitle = html_entity_decode(ART_RC_GTTL);
        	$vname = html_entity_decode(ART_RC_GVN);
		$desc = html_entity_decode(ART_RC_GDES);
        	$effect = '100';
		$aoe = 2;
		for($i = 1; $i <= 4; $i++) {$this->createArtefactVillage(2, $type, 2, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type7.gif');}

		$arttitle = html_entity_decode(ART_RC_UTTL);
		$vname = html_entity_decode(ART_RC_UVN);
		$desc = html_entity_decode(ART_RC_UDES);
        	$effect = '500';
		$aoe = 3;
		for($i = 1; $i <= 1; $i++) {$this->createArtefactVillage(2, $type, 3, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type7.gif');}
	}
	
	private function releaseStorageMasterPlan() {
		$type = 9;
        	$effecttype = 9;
		$arttitle = html_entity_decode(ART_SP_STTL);
        	$vname = html_entity_decode(ART_SP_SVN);
		$desc = html_entity_decode(ART_SP_SDES);
        	$effect = '1';
		$aoe = 1;
        	for($i = 1; $i <= 6; $i++) {$this->createArtefactVillage(2, $type, 1, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type9.gif');}

		$arttitle = html_entity_decode(ART_SP_GTTL);
        	$vname = html_entity_decode(ART_SP_GVN);
		$desc = html_entity_decode(ART_SP_GDES);
        	$effect = '1';
		$aoe = 2;
        	for($i = 1; $i <= 4; $i++) {$this->createArtefactVillage(2, $type, 2, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type9.gif');}
	}
	
	private function releaseArtefactOfTheFool() {
		$type = 3;
        	$effecttype = 3;
		$arttitle = html_entity_decode(ART_AF_STTL);
        	$vname = html_entity_decode(ART_AF_SVN);
		$desc = html_entity_decode(ART_AF_SDES);
        	$effect = '1';
		$aoe = 1;
        	for($i = 1; $i <= 6; $i++) {$this->createArtefactVillage(2, $type, 1, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type3.gif');}
		$arttitle = html_entity_decode(ART_AF_UTTL);
        	$vname = html_entity_decode(ART_AF_UVN);
		$desc = html_entity_decode(ART_AF_UDES);
        	$effect = '1';
		$aoe = 1;
        	for($i = 1; $i <= 1; $i++) {$this->createArtefactVillage(2, $type, 3, $arttitle, $vname, $desc, $effecttype, $effect, $aoe, 'type3.gif');}
	}
	
};
$natars = new Natars;
};
?>
