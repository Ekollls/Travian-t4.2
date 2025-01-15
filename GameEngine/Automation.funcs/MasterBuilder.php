<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
    function MasterBuilder() {
        global $database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
        $q = "SELECT * FROM ".TB_PREFIX."bdata WHERE master = 1";
        $array = $database->query_return($q);
	    foreach($array as $master) {
		$villwood = $database->getVillageField($master['wid'],'wood');
		$villclay = $database->getVillageField($master['wid'],'clay');
		$villiron = $database->getVillageField($master['wid'],'iron');
		$villcrop = $database->getVillageField($master['wid'],'crop');
		$type = $master['type'];
		$level = $master['level'];
		$buildarray = $GLOBALS["bid".$type];
		$buildwood = $buildarray[$level]['wood'];
		$buildclay = $buildarray[$level]['clay'];
		$buildiron = $buildarray[$level]['iron'];
		$buildcrop = $buildarray[$level]['crop'];
        $ww = count($database->getBuildingByType($master['wid'],40));
		if($master['field'] < 19){
		$bdata = count($database->getDorf1Building($master['wid']));
		$bbdata = count($database->getDorf2Building($master['wid']));
		$bdata1 = $database->getDorf1Building($master['wid']);
		}else{
		$bdata = count($database->getDorf2Building($master['wid']));
		$bbdata = count($database->getDorf1Building($master['wid']));
		$bdata1 = $database->getDorf2Building($master['wid']);
		}
		$owner = $database->getVillageField($master['wid'],'owner');
		if($database->getUserField($owner,'plus',0) > time() or $ww > 0){
		if($bbdata < 2){
		$inbuild = 2;
		}else{
		$inbuild = 1;
		}
		}else{
		$inbuild = 1;
		}
		$usergold = $database->getUserField($owner,'gold',0);
		if($bdata < $inbuild && $buildwood < $villwood && $buildclay < $villclay && $buildiron < $villiron && $buildcrop < $villcrop && $usergold > 0){
		$time = $master['timestamp']+time();
		if(!empty($bdata1)){
	    foreach($bdata1 as $master1) {
		$time += ($master1['timestamp']-time());
		}
		}
		if($bdata == 0){
		$database->updateBuildingWithMaster($master['id'],$time,0);
		}else{
		$database->updateBuildingWithMaster($master['id'],$time,1);
		}
		$gold = $usergold-1;
		$database->updateUserField($owner,'gold',$gold,1);
		$database->modifyResource($master['wid'],$buildwood,$buildclay,$buildiron,$buildcrop,0);
		}
		}
    }
?>
