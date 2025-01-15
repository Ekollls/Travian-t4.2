<?php
include ("GameEngine/Data/unitdata.php");
include ("GameEngine/Database.php");
include ("GameEngine/Generator.php");

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
		$towref = $row['towref'];
		$eigen = $database->getCoor($getFLData['wref']);
		$fromXY = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
		$ander = $database->getCoor($towref);
		$toXY = array('x'=>$ander['x'], 'y'=>$ander['y']);

		$speeds = array();
		//find slowest unit.			
		for($i=1;$i<=10;$i++){
			if($row['t'.$i] > 0){
				$database->modifyUnit($getFLData['wref'],($start+$i),$row['t'.$i],0);
				if($unitarray) { reset($unitarray); }
				$unitarray = $GLOBALS["u".($start+$i)];
				$speeds[] = $unitarray['speed'];
			}
		}

		$timedif = $generator->procDistanceTime($fromXY,$toXY,min($speeds),1);
		$reference = $database->addAttack(($getFLData['wref']),$row['t1'],$row['t2'],$row['t3'],$row['t4'],$row['t5'],
				$row['t6'],$row['t7'],$row['t8'],$row['t9'],$row['t10'],0,4,255,255,0);

		$database->addMovement(3,$getFLData['wref'],$towref,$reference,0,($timedif+time()));
	}	
}
header("Location: build.php?id=39&t=99");
?>