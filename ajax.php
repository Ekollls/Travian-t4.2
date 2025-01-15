<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include("GameEngine/Village.php");

if($_GET['buyAdventure'] == "yes"){
	if($session->gold >= 1) {
		$herodetail = $database->getHero($session->uid);
		$aday = max(86400/SPEED,1800);
		$tenday = max(432000/SPEED,18000);
		$endat = $herodetail['lastadv']+$tenday;
		
		$dif = rand(0,10)>8;
		$database->addAdventure($database->getVFH($herodetail['uid']), $herodetail['uid'], $endat,$dif);
		$herodetail['lastadv'] += $aday;
		$endat += $aday;
		mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 1, usedgold=usedgold+1 WHERE `username`='".$session->username."'");
		header("Location: hero_adventure.php");
		echo "Why you have not redirected!?";
		exit();
	}
}

				if (isset($_GET['qact'])){
					$qact=$_GET['qact'];
				}else {
					$qact=null;
				}
				if (isset($_GET['qact2'])){
					$qact2=$_GET['qact2'];
				}else {
					$qact2=null;
				}

if($_GET['f'] == "qst") { include "Templates/Ajax/quest_core.tpl";exit(); }
if($_GET){
	if(isset($_GET['cmd'])){
		switch($_GET['cmd']) {
			case 'productionBoostPopup':
				$choosepack = 0;
				$advantages = 0;
				$earngold = 0;
				$plusSupport = 0;
				$choosepayment = 1;
				$userData = $database->getUser($session->username);
				$golds = $database->getUser($session->username, 0);
				$datetimep=$userData['plus'];
				$datetime1=$userData['b1'];
				$datetime2=$userData['b2'];
				$datetime3=$userData['b3'];
				$datetime4=$userData['b4'];
				$datetimeap=$userData['ap'];
				$datetimedp=$userData['dp'];
				$now=strtotime("NOW");

				include "Templates/Plus/25dialog.php";
			break;
						case 'viewTileDetails':
				$x = $_POST['x'];
				$y = $_POST['y'];
				ob_start(); // begin collecting output
				
				include 'Templates/Map/vildialog.php';
				$html = ob_get_clean(); // retrieve output from myfile.php, stop buffering				
				echo json_encode( array('response' => array('data'=>array('html' => $html))) );
			break;

			case 'changeVillageName':
				$_POST['name'] = addslashes($_POST['name']);
				if ($_POST['name']=='') return;
				$result = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE `wref` = '" . $_POST['did'] . "'");
				$row = mysql_fetch_array($result);
				$_POST['name'] = str_replace('[=]','',$_POST['name']);
				$_POST['name'] = str_replace('[|]','',$_POST['name']);
				$q = "UPDATE " . TB_PREFIX . "vdata SET `name` = '" . $_POST['name'] . "' where `wref` = '" . $_POST['did'] . "'";
				mysql_query($q);
				echo json_encode( array('response' => array('data' => array('name'=>$_POST['name'],'bname'=>$row['name']))) );
			break;
			
			case 'paymentWizard':
				include("Templates/Plus/price.tpl");
				$choosepack = 0;
				$advantages = 0;
				$earngold = 0;
				$plusSupport = 0;
				$choosepayment = 1;
				$userData = $database->getUser($session->username);
				$golds = $database->getUser($session->username, 0);
				$datetimep=$userData['plus'];
				$datetime1=$userData['b1'];
				$datetime2=$userData['b2'];
				$datetime3=$userData['b3'];
				$datetime4=$userData['b4'];
				$datetimeap=$userData['ap'];
				$datetimedp=$userData['dp'];
				$now=strtotime("NOW");
				if((!isset($_POST['goldProductId']) || $_POST['goldProductId']=='') && (!isset($_POST['goldProductLocation']) || $_POST['goldProductLocation']=='') && (!isset($_POST['location']) || $_POST['location']=='') && isset($_POST['activeTab']) && $_POST['activeTab']=='buyGold'){
					$choosepack = 1;
				}
				elseif((!isset($_POST['goldProductId']) || $_POST['goldProductId']=='') && (!isset($_POST['goldProductLocation']) || $_POST['goldProductLocation']=='') && (!isset($_POST['location']) || $_POST['location']=='') && isset($_POST['activeTab']) && $_POST['activeTab']=='pros'){
					$advantages = 1;
				}
				elseif((!isset($_POST['goldProductId']) || $_POST['goldProductId']=='') && (!isset($_POST['goldProductLocation']) || $_POST['goldProductLocation']=='') && (!isset($_POST['location']) || $_POST['location']=='') && isset($_POST['activeTab']) && $_POST['activeTab']=='earnGold'){
					$earngold = 1;
				}
				elseif((!isset($_POST['goldProductId']) || $_POST['goldProductId']=='') && (!isset($_POST['goldProductLocation']) || $_POST['goldProductLocation']=='') && (!isset($_POST['location']) || $_POST['location']=='') && isset($_POST['activeTab']) && $_POST['activeTab']=='plusSupport'){
					$plusSupport = 1;
				}
				elseif((!isset($_POST['goldProductId']) || $_POST['goldProductId'] < count($AppConfig['plus']['packages'])) && (!isset($_POST['goldProductLocation']) || $_POST['goldProductLocation']=='') && (!isset($_POST['location']) || $_POST['location']=='') && isset($_POST['activeTab']) && $_POST['activeTab']=='buyGold'){
					$choosepayment = 1;
					$package = $_POST['goldProductId'];
				}
				include("Templates/Ajax/payment.php");
				break;
			
			case 'premiumFeature':
				$fail = true;
				$success = false;
				$finishnowsuccess = false;
				$golds = $database->getUser($session->username, 0);
				include("Templates/Plus/price.tpl");
				if(isset($_POST['context']) && $_POST['context']=='paymentWizard' || $_POST['context']=='production' ||  $_POST['context']=='productionBoost' ){
					if(isset($_POST['featureKey']) && $_POST['featureKey']=='goldclub'){
						if($session->gold >= 100 && $golds['goldclub']==0) {
							mysql_query("UPDATE ".TB_PREFIX."users set goldclub = 1, gold = gold - 100 where `username`='".$session->username."'");
							$success = true;
						}
						elseif($golds['goldclub']==1){
							$success = true;
						}
					}
					elseif(isset($_POST['featureKey']) && $_POST['featureKey']=='plus'){
						if($session->gold >= 10) {
							if($golds['plus'] <= time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set plus = '0' where `username`='".$session->username."'") or die(mysql_error());
							}
							if($golds['plus'] == 0) {
								mysql_query("UPDATE ".TB_PREFIX."users set plus = ".time()."+".PLUS_TIME." where `username`='".$session->username."'") or die(mysql_error());
							} else {
								mysql_query("UPDATE ".TB_PREFIX."users set plus = plus + ".PLUS_TIME." where `username`='".$session->username."'") or die(mysql_error());
							}
							mysql_query("UPDATE ".TB_PREFIX."users set gold = gold-10, usedgold=usedgold+10 where `username`='".$session->username."'") or die(mysql_error());
							$success = true;
						}
					}
					elseif(isset($_POST['featureKey']) && $_POST['featureKey']=='productionboostWood'){
						if($session->gold >= 5) {
							/*
							if($golds['b1'] <= time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set b1 = '0' where `username`='".$session->username."'") or die(mysql_error());
							}
							*/
							if($golds['b1'] < time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set b1 = ".time()."+".PLUS_PRODUCTION." where `username`='".$session->username."'") or die(mysql_error());
							} else {
								mysql_query("UPDATE ".TB_PREFIX."users set b1 = b1 + ".PLUS_PRODUCTION." where `username`='".$session->username."'") or die(mysql_error());
							}
							mysql_query("UPDATE ".TB_PREFIX."users set gold = gold-5, usedgold=usedgold+5 where `username`='".$session->username."'") or die(mysql_error());
							$success = true;
						}
					}
					elseif(isset($_POST['featureKey']) && $_POST['featureKey']=='productionboostClay'){
						if($session->gold >= 5) {
							/*
							if($golds['b2'] <= time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set b2 = '0' where `username`='".$session->username."'") or die(mysql_error());
							}
							*/
							if($golds['b2'] <  time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set b2 = ".time()."+".PLUS_PRODUCTION." where `username`='".$session->username."'") or die(mysql_error());
							} else {
								mysql_query("UPDATE ".TB_PREFIX."users set b2 = b2 + ".PLUS_PRODUCTION." where `username`='".$session->username."'") or die(mysql_error());
							}
							mysql_query("UPDATE ".TB_PREFIX."users set gold = gold-5, usedgold=usedgold+5 where `username`='".$session->username."'") or die(mysql_error());
							$success = true;
						}
					}
					elseif(isset($_POST['featureKey']) && $_POST['featureKey']=='productionboostIron'){
						if($session->gold >= 5) {
							/*
							if($golds['b3'] <= time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set b3 = '0' where `username`='".$session->username."'") or die(mysql_error());
							}
							*/
							if($golds['b3'] <  time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set b3 = ".time()."+".PLUS_PRODUCTION." where `username`='".$session->username."'") or die(mysql_error());
							} else {
								mysql_query("UPDATE ".TB_PREFIX."users set b3 = b3 + ".PLUS_PRODUCTION." where `username`='".$session->username."'") or die(mysql_error());
							}
							mysql_query("UPDATE ".TB_PREFIX."users set gold = gold-5,usedgold=usedgold+5 where `username`='".$session->username."'") or die(mysql_error());
							$success = true;
						}					
					}
					elseif(isset($_POST['featureKey']) && $_POST['featureKey']=='productionboostCrop'){
						if($session->gold >= 5) {
							/*
							if($golds['b4'] <= time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set b4 = '0' where `username`='".$session->username."'") or die(mysql_error());
							}
							*/
							if($golds['b4'] < time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set b4 = ".time()."+".PLUS_PRODUCTION." where `username`='".$session->username."'") or die(mysql_error());
							} else {
								mysql_query("UPDATE ".TB_PREFIX."users set b4 = b4 + ".PLUS_PRODUCTION." where `username`='".$session->username."'") or die(mysql_error());
							}
							mysql_query("UPDATE ".TB_PREFIX."users set gold = gold-5,usedgold=usedgold+5 where `username`='".$session->username."'") or die(mysql_error());
							$success = true;
						}					
					}
				}
				elseif(isset($_POST['context']) && $_POST['context']=='infobox'){
					if(isset($_POST['featureKey']) && $_POST['featureKey']=='Plus'){
						if($session->gold >= 10) {
							if($golds['plus'] <= time()) {
								mysql_query("UPDATE ".TB_PREFIX."users set plus = '0' where `username`='".$session->username."'") or die(mysql_error());
							}
							if($golds['plus'] == 0) {
								mysql_query("UPDATE ".TB_PREFIX."users set plus = ".time()."+".PLUS_TIME." where `username`='".$session->username."'") or die(mysql_error());
							} else {
								mysql_query("UPDATE ".TB_PREFIX."users set plus = plus + ".PLUS_TIME." where `username`='".$session->username."'") or die(mysql_error());
							}
							mysql_query("UPDATE ".TB_PREFIX."users set gold = gold-10, usedgold=usedgold+10 where `username`='".$session->username."'") or die(mysql_error());
							$success = true;
						}
					}
				}
				elseif(isset($_POST['featureKey']) && $_POST['featureKey']=='finishNow'){
					if($session->gold >= 2) {
						foreach($building->buildArray as $jobs) {
						  $level = $database->getFieldLevel($jobs['wid'],$jobs['field']);
						  $level = ($level == -1) ? 0 : $level;
						  if($jobs['type'] != 25 AND $jobs['type'] != 26 AND $jobs['type'] != 40) {
								$resource = $building->resourceRequired($jobs['field'],$jobs['type']);
								$q = "UPDATE ".TB_PREFIX."fdata set f".$jobs['field']." = f".$jobs['field']." + 1, f".$jobs['field']."t = ".$jobs['type']." where vref = ".$jobs['wid'];
								if($database->query($q)) {
									
									$database->modifyPop($jobs['wid'],$resource['pop'],0);
									$database->addCP($jobs['wid'],$resource['cp']);
									$database->finishDemolition($village->wid);
									$database->addCLP($session->uid, 7);

									$q = "DELETE FROM ".TB_PREFIX."bdata where id = ".$jobs['id'];
									$database->query($q);
									if($jobs['type'] == 18) {
									  $owner = $database->getVillageField($jobs['wid'],"owner");
									  $max = $bid18[$level]['attri'];
									  $q = "UPDATE ".TB_PREFIX."alidata set max = $max where leader = $owner";
									  $database->query($q);
									}
									if($jobs['type'] == 10) {
									  $max=$database->getVillageField($jobs['wid'],"maxstore");
									  if($level=='0' && $building->getTypeLevel(10) != 20){ $max-=STORAGE_BASE; }
									  $max-=$bid10[$level]['attri']*STORAGE_MULTIPLIER;      
									  $max+=$bid10[$level+1]['attri']*STORAGE_MULTIPLIER;  
									  $database->setVillageField($jobs['wid'],"maxstore",$max);
									}

									if($jobs['type'] == 11) {
									  $max=$database->getVillageField($jobs['wid'],"maxcrop");
									  if($level=='0' && $building->getTypeLevel(11) != 20){ $max-=STORAGE_BASE; }
									  $max-=$bid11[$level]['attri']*STORAGE_MULTIPLIER;      
									  $max+=$bid11[$level+1]['attri']*STORAGE_MULTIPLIER; 
									  $database->setVillageField($jobs['wid'],"maxcrop",$max);
									}
									if($jobs['type'] == 38) {
									$max=$database->getVillageField($jobs['wid'],"maxstore");
									if($level=='0' && $building->getTypeLevel(38) != 20){ $max-=STORAGE_BASE; }
									$max-=$bid38[$level]['attri']*STORAGE_MULTIPLIER;      
									$max+=$bid38[$level+1]['attri']*STORAGE_MULTIPLIER;  
									$database->setVillageField($jobs['wid'],"maxstore",$max);
									}

									if($jobs['type'] == 39) {
									$max=$database->getVillageField($jobs['wid'],"maxcrop");
									if($level=='0' && $building->getTypeLevel(39) != 20){ $max-=STORAGE_BASE; }
									$max-=$bid39[$level]['attri']*STORAGE_MULTIPLIER;      
									$max+=$bid39[$level+1]['attri']*STORAGE_MULTIPLIER; 
									$database->setVillageField($jobs['wid'],"maxcrop",$max);
									}  			
								}
							}
						} 
						$technology->finishTech();
						$logging->goldFinLog($village->wid);
						$database->modifyGold($session->uid,2,0);
						$success = true;
						$finishnowsuccess = true;
					}					
				}
				include("Templates/Ajax/permium.tpl");
			break;
			case 'quest':
				$quest = "";
				$action = "";
				if(isset($_POST['questTutorialId'])){
					$quest = $_POST['questTutorialId'];
					if(isset($_POST['action'])){
						$action = $_POST['action'];
					}
					include("Templates/Ajax/quest_core.php");					
				}
				break;
			case 'heroEditor':
				$herodetail = $database->getHeroFace($session->uid);
				$getcolor = $herodetail['color'];
				if($herodetail['gender']==0) {$gstr='male';} else {$gstr='female';}
				$gender=$herodetail['gender'];
				$geteye = $herodetail['eye'];if ($gender==0) $geteye%=5;
				$geteyebrow = $herodetail['eyebrow'];if ($gender==0) $geteyebrow%=5;
				$getnose = $herodetail['nose'];if ($gender==0) $getnose%=5;
				$getear = $herodetail['ear'];if ($gender==0) $getear%=5;
				$getmouth = $herodetail['mouth'];if ($gender==0) $getmouth%=4;
				$getbeard = $herodetail['beard']; if ($gender==1) $getbeard=5;
				$gethair = $herodetail['hair'];if ($gender==0) $gethair%=5;
				$getface = $herodetail['face'];if ($gender==0) $getface%=5;
				$head = $_POST['attribs']['headProfile'];
				$color = $_POST['attribs']['hairColor'];
				$hair = $_POST['attribs']['hairStyle'];
				$ear = $_POST['attribs']['ears'];
				$eyebrow = $_POST['attribs']['eyebrow'];
				$eye = $_POST['attribs']['eyes'];
				$nose = $_POST['attribs']['nose'];
				$mouth = $_POST['attribs']['mouth'];
				$beard = $_POST['attribs']['beard'];
				if($beard == 5999) $beard = -1; // some fix
				if($head != $getface){					$atrface = $head;					if ($gender==0) $atrface%=5;				}
				else{					$atrface = $getface;				}
				if($hair != $gethair){					$atrhair = $hair;					if ($gender==0) $atrhair%=5;				}
				else{					$atrhair = $gethair;				}
				if($ear != $getear){					$atrear = $ear;					if ($gender==0) $atrear%=5;				}
				else{					$atrear = $getear;				}
				if($eye != $geteye){					$atreye = $eye;					if ($gender==0) $atreye%=5;				}
				else{					$atreye = $geteye;				}
				if($mouth != $getmouth){					$atrmouth = $mouth;					if ($gender==0) $atrmouth%=5;				}
				else{					$atrmouth = $getmouth;				}
				if($beard != $getbeard){					$atrbeard = $beard;					if ($gender==0) $atrbeard%=5;				}
				else{					$atrbeard = $getbeard;				}
				if($nose != $getnose){					$atrnose = $nose;					if ($gender==0) $atrnose%=5;				}
				else{					$atrnose = $getnose;				}
				if($eyebrow != $geteyebrow){					$atreyebrow = $eyebrow;					if ($gender==0) $atreyebrow%=5;				}
				else{					$atreyebrow = $geteyebrow;				}
				if($color != $getcolor){					$atrcolor = $color;		}
				else{					$atrcolor = $getcolor;				}
				if($atrcolor==0){
					$color = "black";
				}
				if($atrcolor==1){
					$color = "brown";
				}
				if($atrcolor==2){
					$color = "darkbrown";
				}
				if($atrcolor==3){
					$color = "yellow";
				}
				if($atrcolor==4){
					$color = "red";
				}
				include("Templates/Ajax/heroeditor.tpl");
			break;
			case 'overlay':
				include("Templates/Ajax/overlay.tpl");
			break;
			// soheil
			case 'quest':
				include("Templates/Ajax/quest_core.php");
			case 'finishNowPopup':
				include("Templates/Ajax/finishNowPopup.tpl");
			break;
			case 'mapLowRes':
				$x = $_POST['x'];
				$y = $_POST['y'];
				$xx = $_POST['width'];
				$yy = $_POST['height'];
				include("Templates/Ajax/mapscroll.tpl");
			break;
		}
	}

}
?>
