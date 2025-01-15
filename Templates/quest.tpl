<?php 
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / www.20script.ir
/
*/


if ($database->getUserField($_SESSION['username'],'fquest','username')!=2047 && QUEST==true){
$currentQact = $database->getUserField($session->uid,'quest',0);
$_SESSION['qst'] = $currentQact;
$_SESSION['qstnew']='0';
if($_SESSION['qst']== 0){
	$_SESSION['qstnew']='1';
} elseif($_SESSION['qst']== 1){
	//Check one of Woodcutters is level 1 or upper 
	$tRes = $database->getResourceLevel($village->wid);
	$woodL=$tRes['f1']+$tRes['f3']+$tRes['f14']+$tRes['f17'];
	//check if you are building a woodcutter to level 1
	foreach($building->buildArray as $jobs) {if($jobs['type']==1){$woodL="99";}}
	if ($woodL>=1){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 2){
	//Check one of Croplands is level 1 or upper 
	$tRes = $database->getResourceLevel($village->wid);
	$cropL=$tRes['f2']+$tRes['f8']+$tRes['f9']+$tRes['f12']+$tRes['f13']+$tRes['f15'];
	//check if you are building a cropland to level 1
	foreach($building->buildArray as $jobs) {if($jobs['type']==4){$cropL="99";}}
	if ($cropL>=1){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 3){ 
	$vName=$village->vname;
	if ($vName!=$session->userinfo['username']."'s village"){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 4){ 
	$rallypoint = $building->getTypeLevel(16);
	foreach($building->buildArray as $jobs) {if($jobs['type']==16){$rallypoint="99";}}
	if ($rallypoint > 0){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 5){
	$villages = $database->getVillagesID($session->userinfo['id']);
	$sentOrCompeleteAdv = false;
	foreach($villages as $v){$r = $database->getAdvMovement($v);if ($r) {$sentOrCompeleteAdv = true;break;}}
	if ($sentOrCompeleteAdv){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 6){
	// Compare real player rank with submited rank
	$uname=$session->userinfo['username'];
	$rRes = $ranking->getUserRank($uname);
	if ($rRes==$rSubmited){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 7){
	//Check one of Iron Mines and one of Clay Pites are level 1 or upper 
	$tRes = $database->getResourceLevel($village->wid);
	$ironL=$tRes['f4']+$tRes['f7']+$tRes['f10']+$tRes['f11'];
	$clayL=$tRes['f5']+$tRes['f6']+$tRes['f16']+$tRes['f18'];
	if ($ironL>=1 && $clayL>=1){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 8){ 
	//Check message is viewed or no
	if (!$message->unread){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 9){
	$tRes = $database->getResourceLevel($village->wid);
	$ironL=0;$clayL=0;$woodL=0;$cropL=0;
	if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;};
	if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;};
	if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;};
	if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;};
	if ($ironL>=2 && $clayL>=2 && $woodL>=2 && $cropL>=2){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 10){
	$getvID = $database->getVillageID($session->uid);
	$coor = $database->getCoor($getvID);
	if (($_POST['x']==$coor[x])&&($_POST['y']==$coor[y])){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 11){
	$getvH = $database->getHero($session->uid);
	if ($getvH['rc']){$_SESSION['qstnew']='1';}
} elseif($_SESSION['qst']== 12){
	$veiwedreports = $database->getUsersNotice($session->userinfo['id'],9,1);
	if ($veiwedreports){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 13){
	$getvH = $database->getHero($session->uid);
	$sentOrCompeleteAdv = $getvH['adv'];
	if ($sentOrCompeleteAdv>=2){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 14){
	//Check all resource is lvl1 or upper
	$tRes = $database->getResourceLevel($village->wid);
	$ironL=0;$clayL=0;$woodL=0;$cropL=0;
	if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
	if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
	if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
	if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};
	if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}
	if ($ironL>=4 && $clayL>=4 && $woodL>=4 && $cropL>=6){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 15){ 
	//Check player Descriptions for [#0]
	$uArray = $database->getUser($session->uid,1);
	$Dave= strrpos($uArray['desc1'],'[#0]');
	$Dave2=strrpos($uArray['desc2'],'[#0]');
	if (is_numeric($Dave) || is_numeric($Dave2)){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 16){
	//Check cranny builded or no
	$cranny = $building->getTypeLevel(23);
	if ($cranny > 0){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 17){
	$tRes = $database->getResourceLevel($village->wid);
	$ironL=0;$clayL=0;$woodL=0;$cropL=0;
	if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
	if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
	if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
	if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};
	if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
	if ($ironL>=1 && $clayL>=1 && $woodL>=1 && $cropL>=1){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 18){
	//Check player submited number Barracks cost lumber
	if ($lSubmited==210){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 19){
	//Check main building lvl is 3 or upper
	$mainbuilding = $building->getTypeLevel(15);
	if ($mainbuilding>=3){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 20){
	// Compare real player rank with submited rank
	$uname=$session->userinfo['username'];
	$rRes = $ranking->getUserRank($uname);
	if ($rRes==$rSubmited){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 21){
	$_SESSION['qstnew']='1';
} elseif($_SESSION['qst']== 22){
	// Checking granary builded or no
	$granary = $building->getTypeLevel(11);
	if ($granary >0){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']==23){
	// Checking warehouse builded or no
	$warehouse = $building->getTypeLevel(10);
	if ($warehouse>0){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 24){
	// Checking market builded or no
	$market = $building->getTypeLevel(17);
	if ($market>0){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 25){
	// Checking barrack builded or no
	$barrack = $building->getTypeLevel(19);
	if ($barrack>0){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 26){
	// Checking 2 warrior trained or no
	$units = $village->unitall;
	$unarray=array("",U1, U11, U21);
	$unarray2=array("","u1", "u11","u21");
	if ($units[$unarray2[$session->userinfo['tribe']]]>=2){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 27){
	$wall = $village->resarray['f40'];
	if ($wall>0){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']== 28){
	if ($gSubmited==50){$_SESSION['qstnew']='1'; }
} elseif($_SESSION['qst']==29){
	$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
	if (!($fquest&1)){
		$tRes = $database->getResourceLevel($village->wid);
		$ironL=0;$clayL=0;$woodL=0;$cropL=0;
		if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
		if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
		if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
		if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
		if ($ironL>=4 && $clayL>=4 && $woodL>=4 && $cropL>=6){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&2)){
		$embassy = $building->getTypeLevel(18);
		if ($embassy > 0){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&4)){
		if ($session->alliance != 0){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&8)){
		$getHero = $database->getHero($session->uid);
		if ($getHero['adv'] >= 10){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&16)){
		$mainbuilding = $building->getTypeLevel(15);
		if ($mainbuilding >= 5){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&32)){
		$granary = $building->getTypeLevel(11);
		if ($granary >= 3){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&64)){
		$warehouse = $building->getTypeLevel(10);
		if ($warehouse >= 7){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&128)){
		$tRes = $database->getResourceLevel($village->wid);
		$ironL=0;$clayL=0;$woodL=0;$cropL=0;
		if($tRes['f4']>4){$ironL++;};if($tRes['f7']>4){$ironL++;};if($tRes['f10']>4){$ironL++;};if($tRes['f11']>4){$ironL++;}
		if($tRes['f5']>4){$clayL++;};if($tRes['f6']>4){$clayL++;};if($tRes['f16']>4){$clayL++;};if($tRes['f18']>4){$clayL++;}
		if($tRes['f1']>4){$woodL++;};if($tRes['f3']>4){$woodL++;};if($tRes['f14']>4){$woodL++;};if($tRes['f17']>4){$woodL++;}
		if($tRes['f2']>4){$cropL++;};if($tRes['f8']>4){$cropL++;};if($tRes['f9']>4){$cropL++;};if($tRes['f12']>4){$cropL++;};if($tRes['f13']>4){$cropL++;};if($tRes['f15']>4){$cropL++;}
		if ($ironL>=4 && $clayL>=4 && $woodL>=4 && $cropL>=6){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&256)){
		$residence = $building->getTypeLevel(25);
		$palace = $building->getTypeLevel(26);
		if (($palace>=10)||($residence>=10)){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&512)){
		$units = $village->unitall;
		$unarray2=array("","u10", "u20","u30");
		$vil = $database->getProfileVillages($session->uid);
		if ($units[$unarray2[$session->userinfo['tribe']]]>=3 || count($vil)>=2){$_SESSION['qstnew']='1'; }
	}
	if (!($fquest&1024)){
		$vil = $database->getProfileVillages($session->uid);
		if (count($vil)>=2){$_SESSION['qstnew']='1'; }
	}
}
?>
<div class="questMaster" style="display:none;">
	<div id="anm" style="width:120px; height:140px; visibility:hidden;"></div>
	<div id="qge">
		<?php if ($_SESSION['qst'] == 0 or $_SESSION['qstnew'] == 1){ ?>
		<img onclick="qst_handle();" src="img/x.gif" id="qgei" style="width:160px;height:195px;cursor:pointer;" class="q_l<?php echo $session->userinfo['tribe'];?>g" title="<?php echo Q_TOTHETASK;?>">
		<?php }else{ ?>
		<img onclick="qst_handle();" src="img/x.gif" id="qgei" style="width:160px;height:195px;cursor:pointer;" class="q_l<?php echo $session->userinfo['tribe'];?>" title="<?php echo Q_TOTHETASK;?>">
		<?php } ?>
	</div>
	<script type="text/javascript">
		<?php if ($_SESSION['qst']==0){ ?>
		quest.number=null;
		<?php }else{ ?>
		quest.number=0;
		<?php } ?>
		quest.last = 29;
	</script>						
</div>
<?php } ?>
<script type="text/javascript"> 
	Travian.Translation.add(
	{
		'close' : '&#1576;&#1587;&#1578;&#1606;'
	});
</script>
<!--
<div id="sideInfoCountdown"><div class="head"></div>
<div class="content">
<?php 
/*
$timestamp = $database->isDeleting($session->uid);
$displayarray = $database->getUser($session->uid,1);
if($displayarray['protect'] > time()){
	//echo "<div id=\"sideInfoCountdown\"><div class=\"head\"></div>";
	//echo "<div class=\"content\">";
	$uurover=$generator->getTimeFormat($displayarray['protect']-time());
	echo sprintf(PROTECTION_TIME,$uurover);
	//echo "</div></div>";
} elseif($timestamp) {
	//echo "<div id=\"sideInfoCountdown\"><div class=\"head\"></div>";
	//echo "<div class=\"content\">";
	$time=$generator->getTimeFormat(($timestamp-time()));
	echo sprintf(ACCOUNT_DELETION,$time);
	//echo "</div></div>";
}
*/
?>









</div></div>

-->