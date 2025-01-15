<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include ("GameEngine/Data/unitdata.php");
include ("GameEngine/Database.php");
include ("GameEngine/Generator.php");

$winner = $database->hasWinner();if($winner){header("Location: winner.php");}
if($session->access<2){header("Location: banned.php");}

$slots = $_POST['slot'];
$lid = $_POST['lid'];
$getFLData = $database->getFLData($lid);
$tribe = $database->getUserField($getFLData["owner"], "tribe", 0);
$start = ($tribe-1)*10;
$end = ($tribe*10);

$sql = mysql_query("SELECT * FROM ".TB_PREFIX."raidlist WHERE lid = ".$lid."");
while($row = mysql_fetch_array($sql)){
	$sid = $row['id'];
	if($slots[$sid]=='on'){
		$avunits = $database->getUnit($getFLData['wref']);
		$towref = $row['towref'];
		$isoasis = $database->isVillageOases($towref);
		$vdata['owner']=0;
		if(!$isoasis) $vdata = $database->getMInfo($towref);
		if(!$isoasis && $vdata['owner']==0){
			$database->delSlotFarm($sid);
			continue;
		}
		$eigen = $database->getCoor($getFLData['wref']);
		$fromXY = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
		$ander = $database->getCoor($towref);
		$toXY = array('x'=>$ander['x'], 'y'=>$ander['y']);

		$speeds = array();
		$canRaid = false;
		//find slowest unit.			
		for($i=1;$i<=10;$i++){
			if($row['t'.$i] > 0){
				if ($avunits['u'.($start+$i)]>=$row['t'.$i]){
					$avunits['u'.($start+$i)] = $avunits['u'.($start+$i)]-$row['t'.$i];
					$database->modifyUnit($getFLData['wref'],($start+$i),$row['t'.$i],0);
					if($unitarray) { reset($unitarray); }
					$unitarray = $GLOBALS["u".($start+$i)];
					$speeds[] = $unitarray['speed'];
					$canRaid = true;
				} else {
					$canRaid = false; break;
				}
			}
		}
		if ($canRaid==false) continue;

		$timedif = $generator->procDistanceTime($fromXY,$toXY,min($speeds),1);
		$reference = $database->addAttack($getFLData['wref'],$row['t1'],$row['t2'],$row['t3'],$row['t4'],$row['t5'],
				$row['t6'],$row['t7'],$row['t8'],$row['t9'],$row['t10'],0,4,255,255,0);

		$database->addMovement(3,$getFLData['wref'],$towref,$reference,0,($timedif+time()));
	}	
}
header("Location: build.php?id=39&t=99");
?>
