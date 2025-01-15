<?php
$_SESSION['qstnew']='0';
$uArray = $database->getUser($_SESSION['username'],0);

if($message->unread && !$message->nunread) { $messagelol = "i2"; }
else if(!$message->unread && $message->nunread) { $messagelol = "i3"; }
else if($message->unread && $message->nunread) { $messagelol = "i1"; }
else { $messagelol = "i4"; }
$qi=1;
$qi=3; $rewards[$qi]['plus'] = 1;
$qi=4; $rewards[$qi]['wood'] = 30;$rewards[$qi]['clay'] = 60;$rewards[$qi]['iron'] = 30;$rewards[$qi]['crop'] = 20;
$qi=5; $rewards[$qi]['wood'] = 80;$rewards[$qi]['clay'] = 90;$rewards[$qi]['iron'] = 60;$rewards[$qi]['crop'] = 40;
$qi=6;
$qi=7; $rewards[$qi]['wood'] = 85;$rewards[$qi]['clay'] = 95;$rewards[$qi]['iron'] = 55;$rewards[$qi]['crop'] = 25;
$qi=8; $rewards[$qi]['wood'] = 150;$rewards[$qi]['clay'] = 160;$rewards[$qi]['iron'] = 130;$rewards[$qi]['crop'] = 130;
$qi=9; $rewards[$qi]['gold'] = 20;
$qi=10; $rewards[$qi]['wood'] = 110;$rewards[$qi]['clay'] = 130;$rewards[$qi]['iron'] = 60;$rewards[$qi]['crop'] = 45;
$qi=11; $rewards[$qi]['wood'] = 60;$rewards[$qi]['clay'] = 40;$rewards[$qi]['iron'] = 40;$rewards[$qi]['crop'] = 90;
$qi=12; $rewards[$qi]['wood'] = 60;$rewards[$qi]['clay'] = 30;$rewards[$qi]['iron'] = 40;$rewards[$qi]['crop'] = 90;
$qi=13; $rewards[$qi]['wood'] = 75;$rewards[$qi]['clay'] = 120;$rewards[$qi]['iron'] = 30;$rewards[$qi]['crop'] = 50;
$qi=14; $rewards[$qi]['plus'] = 1;
$qi=15; $rewards[$qi]['wood'] = 120;$rewards[$qi]['clay'] = 150;$rewards[$qi]['iron'] = 80;$rewards[$qi]['crop'] = 70;
$qi=16; $rewards[$qi]['wood'] = 80;$rewards[$qi]['clay'] = 70;$rewards[$qi]['iron'] = 60;$rewards[$qi]['crop'] = 30;
$qi=17; $rewards[$qi]['wood'] = 50;$rewards[$qi]['clay'] = 60;$rewards[$qi]['iron'] = 55;$rewards[$qi]['crop'] = 35;
$qi=18; $rewards[$qi]['wood'] = 80;$rewards[$qi]['clay'] = 95;$rewards[$qi]['iron'] = 80;$rewards[$qi]['crop'] = 50;
$qi=19; $rewards[$qi]['wood'] = 200;$rewards[$qi]['clay'] = 250;$rewards[$qi]['iron'] = 160;$rewards[$qi]['crop'] = 140;
$qi=20; $rewards[$qi]['wood'] = 120;$rewards[$qi]['clay'] = 135;$rewards[$qi]['iron'] = 70;$rewards[$qi]['crop'] = 45;
$qi=21; $rewards[$qi]['wood'] = 55;$rewards[$qi]['clay'] = 70;$rewards[$qi]['iron'] = 50;$rewards[$qi]['crop'] = 30;
$qi=22; $rewards[$qi]['wood'] = 80;$rewards[$qi]['clay'] = 90;$rewards[$qi]['iron'] = 60;$rewards[$qi]['crop'] = 40;
$qi=23; $rewards[$qi]['wood'] = 130;$rewards[$qi]['clay'] = 160;$rewards[$qi]['iron'] = 130;$rewards[$qi]['crop'] = 100;
$qi=24; $rewards[$qi]['wood'] = 120;$rewards[$qi]['clay'] = 150;$rewards[$qi]['iron'] = 100;$rewards[$qi]['crop'] = 60;
$qi=25; $rewards[$qi]['wood'] = 150;$rewards[$qi]['clay'] = 200;$rewards[$qi]['iron'] = 180;$rewards[$qi]['crop'] = 100;
$qi=26; $rewards[$qi]['wood'] = 175;$rewards[$qi]['clay'] = 175;$rewards[$qi]['iron'] = 175;$rewards[$qi]['crop'] = 175;
$qi=27; $rewards[$qi]['wood'] = 240;$rewards[$qi]['clay'] = 200;$rewards[$qi]['iron'] = 130;$rewards[$qi]['crop'] = 90;
$qi=28; $rewards[$qi]['wood'] = 75;$rewards[$qi]['clay'] = 75;$rewards[$qi]['iron'] = 75;$rewards[$qi]['crop'] = 20;
$qi=29; $rewards[$qi]['wood'] = 50;$rewards[$qi]['clay'] = 50;$rewards[$qi]['iron'] = 50;$rewards[$qi]['crop'] = 50;
// fquest part
$qi=30; $rewards[$qi]['gold'] = 15;
$qi=31; $rewards[$qi]['wood'] = 130;$rewards[$qi]['clay'] = 160;$rewards[$qi]['iron'] = 130;$rewards[$qi]['crop'] = 100;
$qi=32; $rewards[$qi]['wood'] = 350;$rewards[$qi]['clay'] = 260;$rewards[$qi]['iron'] = 230;$rewards[$qi]['crop'] = 190;
$qi=33; $rewards[$qi]['silver'] = 500;
$qi=34; $rewards[$qi]['wood'] = 235;$rewards[$qi]['clay'] = 275;$rewards[$qi]['iron'] = 200;$rewards[$qi]['crop'] = 300;
$qi=35; $rewards[$qi]['wood'] = 380;$rewards[$qi]['clay'] = 460;$rewards[$qi]['iron'] = 350;$rewards[$qi]['crop'] = 400;
$qi=36; $rewards[$qi]['wood'] = 1550;$rewards[$qi]['clay'] = 1860;$rewards[$qi]['iron'] = 1500;$rewards[$qi]['crop'] = 900;
$qi=37; $rewards[$qi]['wood'] = 1300;$rewards[$qi]['clay'] = 1700;$rewards[$qi]['iron'] = 1300;$rewards[$qi]['crop'] = 700;
$qi=38; $rewards[$qi]['wood'] = 4350;$rewards[$qi]['clay'] = 6800;$rewards[$qi]['iron'] = 5500;$rewards[$qi]['crop'] = 4800;
$qi=39; $rewards[$qi]['wood'] = 750;$rewards[$qi]['clay'] = 750;$rewards[$qi]['iron'] = 750;$rewards[$qi]['crop'] = 750;
$qi=40; $rewards[$qi]['wood'] = 1000;$rewards[$qi]['clay'] = 1000;$rewards[$qi]['iron'] = 1000;$rewards[$qi]['crop'] = 1000;

if (isset($qact)){
	$currentQact = $database->getUserField($session->uid,'quest',0);
	$_SESSION['qst'] = $currentQact;
	switch($qact) {
		case 'enter':
			if($currentQact==0){
				$database->updateUserField($_SESSION['username'],'quest','1',0);
				$_SESSION['qst']= 1;
			}
		break;
		
		//case 'skip':
		//	$database->updateUserField($_SESSION['username'],'quest','23',0);
		//	$_SESSION['qst']= 23;
		//	$gold=$database->getUserField($_SESSION['username'],'gold','username');
		//	$gold+=25;
		//	$database->updateUserField($_SESSION['username'],'gold',$gold,0);
		//	$skiped=true;
		//break;

		case '2':
			//Check one of Woodcutters is level 1 or upper 
			$tRes = $database->getResourceLevel($village->wid);
			$woodL=$tRes['f1']+$tRes['f3']+$tRes['f14']+$tRes['f17'];
			//check if you are building a woodcutter to level 1
			foreach($building->buildArray as $jobs) {if($jobs['type']==1){$woodL="99";}}
			if ($currentQact==1 && $woodL>0){
				$database->updateUserField($_SESSION['username'],'quest','2',0);		
				$_SESSION['qst']= 2;
				$database->FinishWoodcutter($village->wid);
			}
		break;

		case '3':
			$tRes = $database->getResourceLevel($village->wid);
			$cropL=$tRes['f2']+$tRes['f8']+$tRes['f9']+$tRes['f12']+$tRes['f13']+$tRes['f15'];
			//check if you are building a cropland to level 1
			foreach($building->buildArray as $jobs) {if($jobs['type']==4){$cropL="99";}}
			if ($cropL>0 && $currentQact==2){
				$database->updateUserField($_SESSION['username'],'quest','3',0);
				$_SESSION['qst']= 3;
				$plus = $database->getUserField($session->uid,'plus',0);
				$time = time();
				if ($plus<=$time) $plus=$time;
				$plus += round($rewards[$qact]['plus']*3600*24/REWARD_MULTIPLIER); 
				mysql_query("UPDATE ".TB_PREFIX."users set plus = '".$plus."' where `id`='".$session->uid."'") or die(mysql_error());
			}
		break;

		case '4':
			$vName=$village->vname;
			if ($vName!=$session->userinfo['username']."'s village" && $currentQact==3){
				$database->updateUserField($_SESSION['username'],'quest','4',0);
				$_SESSION['qst']= 4;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}		
		break;
		
		case '5':
			$rallypoint = $building->getTypeLevel(16);
			foreach($building->buildArray as $jobs) {if($jobs['type']==16){$rallypoint="99";}}
			if ($rallypoint > 0 && $currentQact==4){
				$database->updateUserField($_SESSION['username'],'quest','5',0);
				$_SESSION['qst']= 5;
				//Give Reward
				$database->finishBuildings($village->wid);
			}
		break;
		
		case '6':
			$villages = $database->getVillagesID($session->userinfo['id']);
			$sentOrCompeleteAdv = false;
			foreach($villages as $v){$r = $database->getAdvMovement($v);if ($r) {$sentOrCompeleteAdv = true;break;}}
			if ($sentOrCompeleteAdv && $currentQact==5){
				$database->updateUserField($_SESSION['username'],'quest','6',0);
				$_SESSION['qst']= 6;
			}
		break;

		case 'rank':
			$rSubmited=$qact2;
		break;

		case '7':
			if($currentQact==6){
				$database->updateUserField($_SESSION['username'],'quest','7',0);
				$_SESSION['qst']= 7;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '8':
			$tRes = $database->getResourceLevel($village->wid);
			$ironL=$tRes['f4']+$tRes['f7']+$tRes['f10']+$tRes['f11'];
			$clayL=$tRes['f5']+$tRes['f6']+$tRes['f16']+$tRes['f18'];
			if ($ironL>0 && $clayL>0 && $currentQact==7){
				$database->updateUserField($_SESSION['username'],'quest','8',0);
				$_SESSION['qst']= 8;
				$Subject=JR_TMMESSUBJECT;
				$Message=JR_TMMESSCONTENT;
				$database->sendMessage($session->userinfo['id'],0,$Subject,$Message,0);
				$RB=true;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '9':
			if (!$message->unread && $RB!=true && $currentQact==8){
				$database->updateUserField($_SESSION['username'],'quest','9',0);
				$_SESSION['qst']= 9;
				//Give Reward
				$gold=$database->getUserField($_SESSION['username'],'gold','username');
				$gold+=floor($rewards[$qact]['gold']*REWARD_MULTIPLIER);
				$database->updateUserField($_SESSION['username'],'gold',$gold,0);
				$giftgold=$database->getUserField($_SESSION['username'],'giftgold','username');
				$giftgold+=floor($rewards[$qact]['gold']*REWARD_MULTIPLIER);
				$database->updateUserField($_SESSION['username'],'giftgold',$giftgold,0);
			}
		break;
		
		case '10':
			$tRes = $database->getResourceLevel($village->wid);
			$ironL=0;$clayL=0;$woodL=0;$cropL=0;
			if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;};
			if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;};
			if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;};
			if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;};
			if ($ironL>1 && $clayL>1 && $woodL>1 && $cropL>1 && $currentQact==9){
				$database->updateUserField($_SESSION['username'],'quest','10',0);
				$_SESSION['qst']= 10;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;

		case 'coor':
			$x=$qact2;
		break;
		

		case '11':
			if($currentQact==10){
				$database->updateUserField($_SESSION['username'],'quest','11',0);
				$_SESSION['qst']= 11;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '12':
			$getvH = $database->getHero($session->uid);
			if ($getvH['rc'] && $currentQact==11){
				$database->updateUserField($_SESSION['username'],'quest','12',0);
				$_SESSION['qst']= 12;
				//Give Reward
				$getvH = $database->getHero($session->uid);
				if ($getvH['r1']) {
					$clay = $iron = $crop = 0;
					$wood = 400*REWARD_MULTIPLIER;
				}elseif ($getvH['r2']) {
					$wood = $iron = $crop = 0;
					$clay = 400*REWARD_MULTIPLIER;
				}elseif ($getvH['r3']) {
					$clay = $wood = $crop = 0;
					$iron = 400*REWARD_MULTIPLIER;
				}elseif ($getvH['r4']) {
					$clay = $iron = $wood = 0;
					$crop = 400*REWARD_MULTIPLIER;
				} else{$wood = $clay = $iron = $crop = 120*REWARD_MULTIPLIER;}
				$database->modifyResource($village->wid,$wood,$clay,$iron,$crop,1);
			}
		break;

		case '13':
			$veiwedreports = $database->getUsersNotice($session->userinfo['id'],9,1);
			if ($veiwedreports && $currentQact==12){
				$database->updateUserField($_SESSION['username'],'quest','13',0);
				$_SESSION['qst']= 13;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '14':
			$getvH = $database->getHero($session->uid);
			if ($getvH['adv']>=2 && $currentQact==13){
				$database->updateUserField($_SESSION['username'],'quest','14',0);
				$_SESSION['qst']= 14;
				//Give Reward
				$plus = $database->getUserField($session->uid,'plus',0);
				$time = time();
				if ($plus<=$time) $plus=$time;
				$plus += $rewards[$qact]['plus']*3600*24/REWARD_MULTIPLIER; 
				mysql_query("UPDATE ".TB_PREFIX."users set plus = '".$plus."' where `id`='".$session->uid."'") or die(mysql_error());
			}
		break;

		case '15':
			$tRes = $database->getResourceLevel($village->wid);
			$ironL=0;$clayL=0;$woodL=0;$cropL=0;
			if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
			if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
			if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
			if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};
			if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}
			if ($ironL>=4 && $clayL>=4 && $woodL>=4 && $cropL>=6 && $currentQact==14){
				$database->updateUserField($_SESSION['username'],'quest','15',0);
				$_SESSION['qst']= 15;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;

		case '16':
			$Dave= strrpos($uArray['desc1'],'[#0]');
			$Dave2=strrpos($uArray['desc2'],'[#0]');
			if ((is_numeric($Dave) || is_numeric($Dave2)) && $currentQact==15){
				$database->updateUserField($_SESSION['username'],'quest','16',0);
				$_SESSION['qst']= 16;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '17':
			$cranny = $building->getTypeLevel(23);
			if ($cranny>0 && $currentQact==16){
				$database->updateUserField($_SESSION['username'],'quest','17',0);
				$_SESSION['qst']= 17;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '18':
			$tRes = $database->getResourceLevel($village->wid);
			$ironL=0;$clayL=0;$woodL=0;$cropL=0;
			if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
			if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
			if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
			if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};
			if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
			if ($ironL>=1 && $clayL>=1 && $woodL>=1 && $cropL>=1 && $currentQact==17) { 
				$database->updateUserField($_SESSION['username'],'quest','18',0);
				$_SESSION['qst']= 18;
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;

		case 'lumber':
			$lSubmited=$qact2;
		break;

		case '19':
			if ($currentQact==18) {
				$database->updateUserField($_SESSION['username'],'quest','19',0);
				$_SESSION['qst']= 19;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;

		case '20':
			$mainbuilding = $building->getTypeLevel(15);
			if ($mainbuilding>=3 && $currentQact==19){
				$database->updateUserField($_SESSION['username'],'quest','20',0);
				$_SESSION['qst']= 20;
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '21':
			if ($currentQact==20){
				$database->updateUserField($_SESSION['username'],'quest','21',0);
				$_SESSION['qst']= 21;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '22':
			if ($currentQact==21){
				$database->updateUserField($_SESSION['username'],'quest','22',0);
				$_SESSION['qst']= 22;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '23':
			$granary = $building->getTypeLevel(11);
			if ($granary>0 && $currentQact==22){
				$database->updateUserField($_SESSION['username'],'quest','23',0);
				$_SESSION['qst']= 23;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '24':
			$warehouse = $building->getTypeLevel(10);
			if ($warehouse>0 && $currentQact==23){
				$database->updateUserField($_SESSION['username'],'quest','24',0);
				$_SESSION['qst']= 24;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '25':
			if ($currentQact==21){
				$database->updateUserField($_SESSION['username'],'quest','25',0);
				$_SESSION['qst']= 25;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '26':
			$barrack = $building->getTypeLevel(19);
			if ($barrack>0 && $currentQact==25){
				$database->updateUserField($_SESSION['username'],'quest','26',0);
				$_SESSION['qst']= 26;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;
		
		case '27':
			$units = $village->unitall;
			$unarray=array("",U1, U11, U21);
			$unarray2=array("","u1", "u11","u21");
			if ($units[$unarray2[$session->userinfo['tribe']]]>=2 && $currentQact==26) {
				$database->updateUserField($_SESSION['username'],'quest','27',0);
				$_SESSION['qst']= 27;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;

		case '28':
			$wall = $village->resarray['f40'];
			$market = $building->getTypeLevel(17);
			if ($wall>0 && $currentQact==27){
				$database->updateUserField($_SESSION['username'],'quest','28',0);
				$_SESSION['qst']= 28;
				$gSubmited=$qact2;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			} elseif ($market>0 && $currentQact==24){
				$database->updateUserField($_SESSION['username'],'quest','28',0);
				$_SESSION['qst']= 28;
				$gSubmited=$qact2;
				//Give Reward
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;

		case 'gold':
			$gSubmited=$qact2;
		break;

		case '29':
			if ($currentQact==28){
				$database->updateUserField($_SESSION['username'],'quest','29',0);
				$_SESSION['qst']= 29;
				$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
			}
		break;

		case '330':
			$_SESSION['qst']= 30;
		break;
		case '331':
			$_SESSION['qst']= 31;
		break;
		case '332':
			$_SESSION['qst']= 32;
		break;
		case '333':
			$_SESSION['qst']= 33;
		break;
		case '334':
			$_SESSION['qst']= 34;
		break;
		case '335':
			$_SESSION['qst']= 35;
		break;
		case '336':
			$_SESSION['qst']= 36;
		break;
		case '337':
			$_SESSION['qst']= 37;
		break;
		case '338':
			$_SESSION['qst']= 38;
		break;
		case '339':
			$_SESSION['qst']= 39;
		break;
		case '340':
			$_SESSION['qst']= 40;
		break;
		
		case '30':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&1)){
				$tRes = $database->getResourceLevel($village->wid);
				$ironL=0;$clayL=0;$woodL=0;$cropL=0;
				if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
				if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
				if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
				if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
				if ($ironL>=4 && $clayL>=4 && $woodL>=4 && $cropL>=6){
					$fquest = $fquest | 1; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$gold=$database->getUserField($_SESSION['username'],'gold','username');
					$gold+=floor($rewards[$qact]['gold']*REWARD_MULTIPLIER);
					$database->updateUserField($_SESSION['username'],'gold',$gold,0);
					$giftgold=$database->getUserField($_SESSION['username'],'gold','username');
					$giftgold+=floor($rewards[$qact]['gold']*REWARD_MULTIPLIER);
					$database->updateUserField($_SESSION['username'],'giftgold',$giftgold,0);
				}
			}
		break;
		
		case '31':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&2)){
				$embassy = $building->getTypeLevel(18);
				if ($embassy > 0){
					$fquest = $fquest | 2; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
				}
			}
		break;
		
		case '32':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&4)){
				if ($session->alliance != 0){
					$fquest = $fquest | 4; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
				}
			}
		break;
		
		case '33':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&8)){
				$getHero = $database->getHero($session->uid);
				if ($getHero['adv'] >= 10){
					$fquest = $fquest | 8; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$silver=$database->getUserField($_SESSION['username'],'silver','username');
					$silver+=$rewards[$qact]['silver']*REWARD_MULTIPLIER;
					$database->updateUserField($_SESSION['username'],'silver',$silver,0);
					$giftsilver=$database->getUserField($_SESSION['username'],'giftsilver','username');
					$giftsilver+=$rewards[$qact]['silver']*REWARD_MULTIPLIER;
					$database->updateUserField($_SESSION['username'],'giftsilver',$giftsilver,0);
				}
			}
		break;
		
		case '34':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&16)){
				$mainbuilding = $building->getTypeLevel(15);
				if ($mainbuilding >= 5){
					$fquest = $fquest | 16; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
				}
			}
		break;
		
		case '35':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&32)){
				$granary = $building->getTypeLevel(11);
				if ($granary >= 3){
					$fquest = $fquest | 32; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
				}
			}
		break;
		
		case '36':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&64)){
				$granary = $building->getTypeLevel(10);
				if ($granary >= 7){
					$fquest = $fquest | 64; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
				}
			}
		break;
		
		case '37':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&128)){
				$tRes = $database->getResourceLevel($village->wid);
				$ironL=0;$clayL=0;$woodL=0;$cropL=0;
				if($tRes['f4']>4){$ironL++;};if($tRes['f7']>4){$ironL++;};if($tRes['f10']>4){$ironL++;};if($tRes['f11']>4){$ironL++;}
				if($tRes['f5']>4){$clayL++;};if($tRes['f6']>4){$clayL++;};if($tRes['f16']>4){$clayL++;};if($tRes['f18']>4){$clayL++;}
				if($tRes['f1']>4){$woodL++;};if($tRes['f3']>4){$woodL++;};if($tRes['f14']>4){$woodL++;};if($tRes['f17']>4){$woodL++;}
				if($tRes['f2']>4){$cropL++;};if($tRes['f8']>4){$cropL++;};if($tRes['f9']>4){$cropL++;};if($tRes['f12']>4){$cropL++;};if($tRes['f13']>4){$cropL++;};if($tRes['f15']>4){$cropL++;}
				if ($ironL>=4 && $clayL>=4 && $woodL>=4 && $cropL>=6){
					$fquest = $fquest | 128; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
				}
			}
		break;
		
		case '38':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&256)){
				$residence = $building->getTypeLevel(25);
				$palace = $building->getTypeLevel(26);
				if (($palace>=10|| $residence>=10)){
					$fquest = $fquest | 256; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
				}
			}
		break;
		
		case '39':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&512)){
				$units = $village->unitall;
				$unarray2=array("","u10", "u20","u30");
				$vil = $database->getProfileVillages($session->uid);
				if ($units[$unarray2[$session->userinfo['tribe']]]>=3 || count($vil)>=2){
					$fquest = $fquest | 512; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
				}
			}
		break;
		
		case '40':
			$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
			if ($currentQact==29 && !($fquest&1024)){
				$vil = $database->getProfileVillages($session->uid);
				if (count($vil)>=2){
					$fquest = $fquest | 1024; 
					$database->updateUserField($_SESSION['username'],'fquest',$fquest,0);
					$_SESSION['qst']= 29;
					//Give Reward
					$database->modifyResource($village->wid,
						$rewards[$qact]['wood']*REWARD_MULTIPLIER,
						$rewards[$qact]['clay']*REWARD_MULTIPLIER,
						$rewards[$qact]['iron']*REWARD_MULTIPLIER,
						$rewards[$qact]['crop']*REWARD_MULTIPLIER,
						1);
				}
			}
		break;
	}

}

header("Content-Type: application/json;");

if($_SESSION['qst']== 0){
	if($session->userinfo['tribe'] == 1) {
		$tribes = "Romans";
	} elseif($session->userinfo['tribe'] == 2) {
                $tribes = "Teutons";
	} elseif($session->userinfo['tribe'] == 3) {
                $tribes = "Gauls";
	}
?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo sprintf(Q0,SERVER_NAME); ?>!<\/h1><br \/><i>&rdquo;<?php echo Q0_DESC;?>&rdquo;<\/i><br \/><br \/><span id=\"qst_accpt\"><a class=\"qle\" href=\"javascript: qst_next('','enter'); \"><?php echo Q0_OPT1;?><\/a><a class=\"qri\" href=\"javascript: qst_fhandle();\"><?php echo Q0_OPT2;?><\/a><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><br \/><br \/><br \/><a class=\"qri\" href=\"\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":null,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":1}

<?php } elseif($_SESSION['qst']== 1){
	//Check one of Woodcutters is level 1 or upper 
	$tRes = $database->getResourceLevel($village->wid);
	$woodL=$tRes['f1']+$tRes['f3']+$tRes['f14']+$tRes['f17'];
	//check if you are building a woodcutter to level 1
	foreach($building->buildArray as $jobs) {
			if($jobs['type']==1){
				$woodL="99";
			}	
      	}
	if ($woodL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q1; ?><\/h1><br \/><i>&rdquo;<?php echo Q1_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q1_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wood\"><\/div>\n\t\t","number":"-1","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q1; ?><\/h1><br \/><i>&rdquo;<?php echo Q1_RESP; ?>&rdquo;<\/i><br \/><br \/><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD; ?><\/p><?php echo Q1_REWARD; ?><br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','2');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wood\"><\/div>\n\t\t","number":"-1","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
	<?php }?>

<?php } elseif($_SESSION['qst']== 2){
	//Check one of Croplands is level 1 or upper 
	$tRes = $database->getResourceLevel($village->wid);
	$cropL=$tRes['f2']+$tRes['f8']+$tRes['f9']+$tRes['f12']+$tRes['f13']+$tRes['f15'];
	//check if you are building a cropland to level 1
	foreach($building->buildArray as $jobs) {
		if($jobs['type']==4){
			$cropL="99";
		}	
      	}
	if ($cropL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q2; ?><\/h1><br \/><i>&rdquo;<?php echo Q2_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q2_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"farm\"><\/div>\n\t\t","number":"-2","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q2; ?><\/h1><br \/><i>&rdquo;<?php echo Q2_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q2_REWARD,$rewards[3]['plus']/REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','3');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"farm\"><\/div>\n\t\t","number":2,"reward":{"plus":1},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
	<?php }?>

<?php } elseif($_SESSION['qst']== 3){ 
	$vName=$village->vname;
	if ($vName==$session->userinfo['username']."'s village"){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q3; ?><\/h1><br \/><i>&rdquo;<?php echo Q3_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q3_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"village_name\"><\/div>\n\t\t","number":"-3","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q3; ?><\/h1><br \/><i>&rdquo;<?php echo Q3_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q3_REWARD,$rewards[4]['wood']*REWARD_MULTIPLIER,$rewards[4]['clay']*REWARD_MULTIPLIER,$rewards[4]['iron']*REWARD_MULTIPLIER,$rewards[4]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','4');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"village_name\"><\/div>\n\t\t","number":3,"reward":{"wood":30,"clay":60,"iron":30,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
	<?php }?>

<?php } elseif($_SESSION['qst']== 4){ 
	$rallypoint = $building->getTypeLevel(16);
	foreach($building->buildArray as $jobs) {if($jobs['type']==16){$rallypoint="99";}}
	if ($rallypoint == 0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q4; ?><\/h1><br \/><i>&rdquo;<?php echo Q4_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q4_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rally\"><\/div>\n\t\t","number":"-4","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q4; ?><\/h1><br \/><i>&rdquo;<?php echo Q4_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q4_REWARD,$rewards[5]['wood']*REWARD_MULTIPLIER,$rewards[5]['clay']*REWARD_MULTIPLIER,$rewards[5]['iron']*REWARD_MULTIPLIER,$rewards[5]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','5');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rally\"><\/div>\n\t\t","number":4,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
	<?php } ?>

<?php } elseif($_SESSION['qst']== 5){
	$villages = $database->getVillagesID($session->userinfo['id']);
	$sentOrCompeleteAdv = false;
	foreach($villages as $v){
		$r = $database->getAdvMovement($v);
		if ($r) {
			$sentOrCompeleteAdv = true;
			break;
		}
	}
	if (!$sentOrCompeleteAdv){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q5; ?><\/h1><br \/><i>&rdquo;<?php echo Q5_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q5_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"first_adventure\"><\/div>\n\t\t","number":"-5","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q5; ?><\/h1><br \/><i>&rdquo;<?php echo Q5_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo Q5_REWARD; ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','6');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"first_adventure\"><\/div>\n\t\t","number":5,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
	<?php } ?>

<?php } elseif($_SESSION['qst']== 6){
	// Compare real player rank with submited rank
	$uname=$session->userinfo['username'];
	$rRes = $ranking->getUserRank($uname);
	if ($rRes!=$rSubmited){?>
{"markup":"\n\t\<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q6; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q6_DESC; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q6_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/><button type=\"button\" value=\"<?php echo Q_COMPLETE; ?>\" class=\"\" onclick=\"javascript: qst_next('','rank',document.getElementById('qst_val').value);\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"><\/div><\/div><\/div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"><\/div><\/div><\/div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"><\/div><\/div><\/div><\/div><div class=\"button-contents\"><?php echo Q_COMPLETE; ?><\/div><\/div><\/button><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank1\"><\/div>\n\t\t","number":"-6","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q6; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q6_RESP; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q6_REWARD,$rewards[7]['wood']*REWARD_MULTIPLIER,$rewards[7]['clay']*REWARD_MULTIPLIER,$rewards[7]['iron']*REWARD_MULTIPLIER,$rewards[7]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a class=\"arrow\" href=\"javascript: qst_next('','7');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank1\"><\/div>\n\t\t","number":6,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
	<?php }?>

<?php } elseif($_SESSION['qst']== 7){
	//Check one of Iron Mines and one of Clay Pites are level 1 or upper 
	$tRes = $database->getResourceLevel($village->wid);
	$ironL=$tRes['f4']+$tRes['f7']+$tRes['f10']+$tRes['f11'];
	$clayL=$tRes['f5']+$tRes['f6']+$tRes['f16']+$tRes['f18'];
	if ($ironL<1 || $clayL<1){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q7; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q7_DESC; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q7_ORDER; ?><\/div><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"clay_iron\"><\/div>\n\t\t","number":-7,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q7; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q7_RESP; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q7_REWARD,$rewards[8]['wood']*REWARD_MULTIPLIER,$rewards[8]['clay']*REWARD_MULTIPLIER,$rewards[8]['iron']*REWARD_MULTIPLIER,$rewards[8]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a class=\"arrow\" href=\"javascript: qst_next('','8');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"clay_iron\"><\/div>\n\t\t","number":7,"reward":{"wood":150,"clay":160,"iron":130,"crop":130},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
	<?php }?>

<?php } elseif($_SESSION['qst']== 8){ 
	//Check message is viewed or no
	if ($message->unread || $RB==true){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q8; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q8_DESC; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q8_ORDER; ?><\/div><span id=\"qst_accpt\"><\/span><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"msg\"><\/div>\n\t\t","number":"-8","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"i2","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q8; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q8_RESP; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q8_REWARD,$rewards[9]['gold']*REWARD_MULTIPLIER); ?><\/div><span id=\"qst_accpt\"><a class=\"arrow\" href=\"javascript: qst_next('','9');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"msg\"><\/div>\n\t\t","number":8,"reward":{"gold":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
	<?php }?>

<?php } elseif($_SESSION['qst']== 9){
$tRes = $database->getResourceLevel($village->wid);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;};
if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;};
if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;};
if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;};
if ($ironL<2 || $clayL<2 || $woodL<2 || $cropL<2){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q9; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q9_DESC; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q9_ORDER; ?><\/div><span id=\"qst_accpt\"><\/span><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"res_one_of_each\"><\/div>\n\t\t","number":-9,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q9; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q9_RESP; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q9_REWARD,$rewards[10]['wood']*REWARD_MULTIPLIER,$rewards[10]['clay']*REWARD_MULTIPLIER,$rewards[10]['iron']*REWARD_MULTIPLIER,$rewards[10]['crop']*REWARD_MULTIPLIER); ?><\/div><br><span id=\"qst_accpt\"><a class=\"arrow\" href=\"javascript: qst_next('','10');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"res_one_of_each\"><\/div>\n\t\t","number":9,"reward":{"wood":100,"clay":120,"iron":40,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 10){
$getvID = $database->getVillageID($session->uid);
$coor = $database->getCoor($getvID);
if (($_POST['x']!=$coor[x])||($_POST['y']!=$coor[y])){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q10; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo sprintf(Q10_DESC,$village->vname); ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo sprintf(Q10_ORDER,$village->vname); ?><\/div><div class=\"coordinatesInput\"><div class=\"xCoord\"><label for=\"xCoordInputQuest\">X:<\/label><input maxlength=\"4\" value=\"\" name=\"x\" id=\"xCoordInputQuest\" class=\"text coordinates x \"><\/div><div class=\"yCoord\"><label for=\"yCoordInputQuest\">Y:<\/label><input maxlength=\"4\" value=\"\" name=\"y\" id=\"yCoordInputQuest\" class=\"text coordinates y \"><\/div><div class=\"clear\"><\/div><\/div><button type=\"button\" value=\"<?php echo Q_COMPLETE; ?>\" class=\"coordinatesButton\" onclick=\"qst_enter_coords()\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"><\/div><\/div><\/div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"><\/div><\/div><\/div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"><\/div><\/div><\/div><\/div><div class=\"button-contents\"><?php echo Q_COMPLETE; ?><\/div><\/div><\/button><span id=\"qst_accpt\"><\/span><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":-10,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q10; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo sprintf(Q10_RESP,$village->vname); ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q10_REWARD,$rewards[11]['wood']*REWARD_MULTIPLIER,$rewards[11]['clay']*REWARD_MULTIPLIER,$rewards[11]['iron']*REWARD_MULTIPLIER,$rewards[11]['crop']*REWARD_MULTIPLIER); ?><\/div><br><span id=\"qst_accpt\"><a class=\"arrow\" href=\"javascript: qst_next('','11');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":10,"reward":{"wood":60,"clay":30,"iron":40,"crop":90},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 11){
$getvH = $database->getHero($session->uid);
if (!$getvH['rc']){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q11; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q11_DESC; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q11_ORDER; ?><\/div><span id=\"qst_accpt\"><\/span><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"heroproduction\"><\/div>\n\t\t","number":-11,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php 
}else{ 
	$_SESSION['qstnew']='1';
	$res = Q11_RESPr0;$wood = $clay = $iron = $crop = 120*REWARD_MULTIPLIER;
	if ($getvH['r1']) {
		$res = Q11_RESPr1;$clay = $iron = $crop = 0;$wood = 400*REWARD_MULTIPLIER;
	}elseif ($getvH['r2']) {
		$res = Q11_RESPr2;$wood = $iron = $crop = 0;$clay = 400*REWARD_MULTIPLIER;
	}elseif ($getvH['r3']) {
		$res = Q11_RESPr3;$clay = $wood = $crop = 0;$iron = 400*REWARD_MULTIPLIER;
	}elseif ($getvH['r4']) {
		$res = Q11_RESPr4;$clay = $iron = $wood = 0;$crop = 400*REWARD_MULTIPLIER;
	}
?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q11; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo sprintf(Q11_RESP,$res); ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q11_REWARD,$wood,$clay,$iron,$crop); ?><\/div><br><span id=\"qst_accpt\"><a class=\"arrow\" href=\"javascript: qst_next('','12');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"heroproduction\"><\/div>\n\t\t","number":11,"reward":{"wood":60,"clay":30,"iron":40,"crop":90},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 12){
$getHero = $database->getHero($session->userinfo['id']);
$compeletedAdv = $getHero['adv']>0?true:false;
$veiwedreports = $database->getUsersNotice($session->userinfo['id'],9,1);
if (!$veiwedreports){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q12; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo ($compeletedAdv?Q12_DESC2:Q12_DESC1); ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><\/p><?php echo Q12_ORDER; ?><\/div><span id=\"qst_accpt\"><\/span><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"adventure_report\"><\/div>\n\t\t","number":-12,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q12; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q12_RESP; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q12_REWARD,$rewards[13]['wood']*REWARD_MULTIPLIER,$rewards[13]['clay']*REWARD_MULTIPLIER,$rewards[13]['iron']*REWARD_MULTIPLIER,$rewards[13]['crop']*REWARD_MULTIPLIER);; ?><\/div><br><span id=\"qst_accpt\"><a class=\"arrow\" href=\"javascript: qst_next('','13');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"adventure_report\"><\/div>\n\t\t","number":12,"reward":{"wood":75,"clay":120,"iron":30,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 13){
$getvH = $database->getHero($session->uid);
if ($getvH['adv']<2){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q13; ?><\/h1><br \/><i>&rdquo;<?php echo Q13_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q13_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"first_adventure\"><\/div>\n\t\t","number":"-13","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q13; ?><\/h1><br \/><i>&rdquo;<?php echo Q13_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q13_REWARD,$rewards[14]['plus']/REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','14');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"first_adventure\"><\/div>\n\t\t","number":13,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 14){
//Check all resource is lvl1 or upper
$tRes = $database->getResourceLevel($village->wid);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};
if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q14; ?><\/h1><br \/><i>&rdquo;<?php echo Q14_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q14_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"res_all_one\"><\/div>\n\t\t","number":"-14","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q14; ?><\/h1><br \/><i>&rdquo;<?php echo Q14_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q14_REWARD,$rewards[15]['wood']*REWARD_MULTIPLIER,$rewards[15]['clay']*REWARD_MULTIPLIER,$rewards[15]['iron']*REWARD_MULTIPLIER,$rewards[15]['crop']*REWARD_MULTIPLIER);; ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','15');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"res_all_one\"><\/div>\n\t\t","number":14,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 15){ 
//Check player Descriptions for [#0]
$Dave= strrpos ($uArray['desc1'],'[#0]');
$Dave2=strrpos ($uArray['desc2'],'[#0]');
if (!is_numeric($Dave) and !is_numeric($Dave2)){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q15; ?><\/h1><br \/><i>&rdquo;<?php echo Q15_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q15_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":"-15","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q15; ?><\/h1><br \/><i>&rdquo;<?php echo Q15_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q15_REWARD,$rewards[16]['wood']*REWARD_MULTIPLIER,$rewards[16]['clay']*REWARD_MULTIPLIER,$rewards[16]['iron']*REWARD_MULTIPLIER,$rewards[16]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','16');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":15,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 16){
//Check cranny builded or no
$cranny = $building->getTypeLevel(23);
if ($cranny == 0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q16; ?><\/h1><br \/><i>&rdquo;<?php echo Q16_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q16_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cranny\"><\/div>\n\t\t","number":"-16","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q16; ?><\/h1><br \/><i>&rdquo;<?php echo Q16_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q16_REWARD,$rewards[17]['wood']*REWARD_MULTIPLIER,$rewards[17]['clay']*REWARD_MULTIPLIER,$rewards[17]['iron']*REWARD_MULTIPLIER,$rewards[17]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','17');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cranny\"><\/div>\n\t\t","number":16,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 17){
$tRes = $database->getResourceLevel($village->wid);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};
if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<1 || $clayL<1 || $woodL<1 || $cropL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q17; ?><\/h1><br \/><i>&rdquo;<?php echo Q17_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q17_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"res_two_of_each\"><\/div>\n\t\t","number":"-17","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q17; ?><\/h1><br \/><i>&rdquo;<?php echo Q17_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q17_REWARD,$rewards[18]['wood']*REWARD_MULTIPLIER,$rewards[18]['clay']*REWARD_MULTIPLIER,$rewards[18]['iron']*REWARD_MULTIPLIER,$rewards[18]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','18');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"res_two_of_each\"><\/div>\n\t\t","number":17,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 18){
//Check player submited number Barracks cost lumber
if ($lSubmited!=210){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q18; ?><\/h1><br \/><i>&rdquo;<?php echo Q18_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q18_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <button type=\"button\" value=\"<?php echo Q_COMPLETE; ?>\" class=\"\" onclick=\"javascript: qst_next('','lumber',document.getElementById('qst_val').value);\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"><\/div><\/div><\/div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"><\/div><\/div><\/div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"><\/div><\/div><\/div><\/div><div class=\"button-contents\"><?php echo Q_COMPLETE; ?><\/div><\/div><\/button><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cost\"><\/div>\n\t\t","number":"-18","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q18; ?><\/h1><br \/><i>&rdquo;<?php echo Q18_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q18_REWARD,$rewards[19]['wood']*REWARD_MULTIPLIER,$rewards[19]['clay']*REWARD_MULTIPLIER,$rewards[19]['iron']*REWARD_MULTIPLIER,$rewards[19]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','19');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cost\"><\/div>\n\t\t","number":18,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 19){
//Check main building lvl is 3 or upper
$mainbuilding = $building->getTypeLevel(15);
if ($mainbuilding<3){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q19; ?><\/h1><br \/><i>&rdquo;<?php echo Q19_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q19_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":"-19","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q19; ?><\/h1><br \/><i>&rdquo;<?php echo Q19_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q19_REWARD,$rewards[20]['wood']*REWARD_MULTIPLIER,$rewards[20]['clay']*REWARD_MULTIPLIER,$rewards[20]['iron']*REWARD_MULTIPLIER,$rewards[20]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','20');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":19,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 20){
// Compare real player rank with submited rank
$uname=$session->userinfo['username'];
$rRes = $ranking->getUserRank($uname);
if ($rRes!=$rSubmited){?>
{"markup":"\n\t\<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q20; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q20_DESC; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q20_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <button type=\"button\" value=\"<?php echo Q_COMPLETE; ?>\" class=\"\" onclick=\"javascript: qst_next('','rank',document.getElementById('qst_val').value);\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"><\/div><\/div><\/div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"><\/div><\/div><\/div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"><\/div><\/div><\/div><\/div><div class=\"button-contents\"><?php echo Q_COMPLETE; ?><\/div><\/div><\/button><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank2\"><\/div>\n\t\t","number":"-20","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q20; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q20_RESP; ?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q20_REWARD,$rewards[21]['wood']*REWARD_MULTIPLIER,$rewards[21]['clay']*REWARD_MULTIPLIER,$rewards[21]['iron']*REWARD_MULTIPLIER,$rewards[21]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a class=\"arrow\" href=\"javascript: qst_next('','21');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank2\"><\/div>\n\t\t","number":20,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 21){
// Ask plyer ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q21; ?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q21_DESC; ?>&rdquo;<\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><button type=\"button\" value=\"<?php echo Q_ECONOMY; ?>\" class=\"qb1 granary_barracks\" onclick=\"javascript: qst_next('','22');\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"><\/div><\/div><\/div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"><\/div><\/div><\/div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"><\/div><\/div><\/div><\/div><div class=\"button-contents\"><?php echo Q_ECONOMY; ?><\/div><\/div><\/button><button type=\"button\" value=\"<?php echo Q_MILITARY; ?>\" class=\"qb2 granary_barracks\" onclick=\"javascript: qst_next('','25');\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"><\/div><\/div><\/div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"><\/div><\/div><\/div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"><\/div><\/div><\/div><\/div><div class=\"button-contents\"><?php echo Q_MILITARY; ?><\/div><\/div><\/button><div class=\"clear\"><\/div><span id=\"qst_accpt\"><\/span><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_barracks\"><\/div>\n\t\t","number":"-21","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}

<?php } elseif($_SESSION['qst']== 22){
// Checking granary builded or no
$granary = $building->getTypeLevel(11);
if ($granary ==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q22; ?><\/h1><br \/><i>&rdquo;<?php echo Q22_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q22_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_barracks1\"><\/div>\n\t\t","number":"-22","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q22; ?><\/h1><br \/><i>&rdquo;<?php echo Q22_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q22_REWARD,$rewards[23]['wood']*REWARD_MULTIPLIER,$rewards[23]['clay']*REWARD_MULTIPLIER,$rewards[23]['iron']*REWARD_MULTIPLIER,$rewards[23]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','23');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_barracks1\"><\/div>\n\t\t","number":22,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']==23){
// Checking warehouse builded or no
$warehouse = $building->getTypeLevel(10);
if ($warehouse==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q23; ?><\/h1><br \/><i>&rdquo;<?php echo Q23_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q23_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":"-23","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q23; ?><\/h1><br \/><i>&rdquo;<?php echo Q23_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q23_REWARD,$rewards[24]['wood']*REWARD_MULTIPLIER,$rewards[24]['clay']*REWARD_MULTIPLIER,$rewards[24]['iron']*REWARD_MULTIPLIER,$rewards[24]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','24');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":23,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 24){
// Checking market builded or no
$market = $building->getTypeLevel(17);
if ($market==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q24; ?><\/h1><br \/><i>&rdquo;<?php echo Q24_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q24_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":"-24","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q24; ?><\/h1><br \/><i>&rdquo;<?php echo Q24_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q24_REWARD,$rewards[25]['wood']*REWARD_MULTIPLIER,$rewards[25]['clay']*REWARD_MULTIPLIER,$rewards[25]['iron']*REWARD_MULTIPLIER,$rewards[25]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','28');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":24,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 25){
// Checking barrack builded or no
$barrack = $building->getTypeLevel(19);
if ($barrack==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q25; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_barracks2\"><\/div>\n\t\t","number":"-25","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q25; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q25_REWARD,$rewards[26]['wood']*REWARD_MULTIPLIER,$rewards[26]['clay']*REWARD_MULTIPLIER,$rewards[26]['iron']*REWARD_MULTIPLIER,$rewards[26]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','26');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_market_barracks2\"><\/div>\n\t\t","number":25,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 26){
// Checking 2 warrior trained or no
$units = $village->unitall;
$unarray=array("",U1, U11, U21);
$unarray2=array("","u1", "u11","u21");
if ($units[$unarray2[$session->userinfo['tribe']]]<2){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q26; ?><\/h1><br \/><i>&rdquo;<?php echo sprintf(Q26_DESC,$unarray[$session->userinfo['tribe']]); ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo sprintf(Q26_ORDER,$unarray[$session->userinfo['tribe']]); ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":"-26","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q26; ?><\/h1><br \/><i>&rdquo;<?php echo Q26_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q26_REWARD,$rewards[27]['wood']*REWARD_MULTIPLIER,$rewards[27]['clay']*REWARD_MULTIPLIER,$rewards[27]['iron']*REWARD_MULTIPLIER,$rewards[27]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','27');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":26,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 27){
$wall = $village->resarray['f40'];
if ($wall==0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q27; ?><\/h1><br \/><i>&rdquo;<?php echo Q27_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q27_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wall<?php echo $session->tribe;?>\"><\/div>\n\t\t","number":"-27","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q27; ?><\/h1><br \/><i>&rdquo;<?php echo Q27_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q27_REWARD,$rewards[28]['wood']*REWARD_MULTIPLIER,$rewards[28]['clay']*REWARD_MULTIPLIER,$rewards[28]['iron']*REWARD_MULTIPLIER,$rewards[28]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','28');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wall<?php echo $session->tribe;?>\"><\/div>\n\t\t","number":27,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 28){
if ($gSubmited!=50){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q28; ?><\/h1><br \/><i>&rdquo;<?php echo Q28_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q28_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <button type=\"button\" value=\"<?php echo Q_COMPLETE; ?>\" class=\"\" onclick=\"javascript: qst_next('','gold',document.getElementById('qst_val').value);\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"><\/div><\/div><\/div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"><\/div><\/div><\/div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"><\/div><\/div><\/div><\/div><div class=\"button-contents\"><?php echo Q_COMPLETE; ?><\/div><\/div><\/button><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"freunde\"><\/div>\n\t\t","number":"-28","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q28; ?><\/h1><br \/><i>&rdquo;<?php echo Q28_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><?php echo sprintf(Q28_REWARD,$rewards[29]['wood']*REWARD_MULTIPLIER,$rewards[29]['clay']*REWARD_MULTIPLIER,$rewards[29]['iron']*REWARD_MULTIPLIER,$rewards[29]['crop']*REWARD_MULTIPLIER); ?><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','29');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"freunde\"><\/div>\n\t\t","number":28,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } ?>

<?php
$fquest = $database->getUserField($_SESSION['username'],'fquest','username');
if ($fquest&1){
$ff30 = "<div class=none><b>".Q30."<\/b><\/div>";
} else { $ff30 = "<a onclick=qst_next('','330')>".Q30."<\/a>"; }

if ($fquest&2){
$ff31 = "<div class=none><b>".Q31."<\/b><\/div>";
} else { $ff31 = "<a onclick=qst_next('','331')>".Q31."<\/a>"; }

if ($fquest&4){
$ff32 = "<div class=none><b>".Q32."<\/b><\/div>";
} else { $ff32 = "<a onclick=qst_next('','332')>".Q32."<\/a>"; }

if ($fquest&8){
$ff33 = "<div class=none><b>".Q33."<\/b><\/div>";
} else { $ff33 = "<a onclick=qst_next('','333')>".Q33."<\/a>"; }

if ($fquest&16){
$ff34 = "<div class=none><b>".Q34."<\/b><\/div>";
} else { $ff34 = "<a onclick=qst_next('','334')>".Q34."<\/a>"; }

if ($fquest&32){
$ff35 = "<div class=none><b>".Q35."<\/b><\/div>";
} else { $ff35 = "<a onclick=qst_next('','335')>".Q35."<\/a>"; }

if ($fquest&64){
$ff36 = "<div class=none><b>".Q36."<\/b><\/div>";
} else { $ff36 = "<a onclick=qst_next('','336')>".Q36."<\/a>"; }

if ($fquest&128){
$ff37 = "<div class=none><b>".Q37."<\/b><\/div>";
} else { $ff37 = "<a onclick=qst_next('','337')>".Q37."<\/a>"; }

if ($fquest&256){
$ff38 = "<div class=none><b>".Q38."<\/b><\/div>";
} else { $ff38 = "<a onclick=qst_next('','338')>".Q38."<\/a>"; }

if ($fquest&512){
$ff39 = "<div class=none><b>".Q39."<\/b><\/div>";
} else { $ff39 = "<a onclick=qst_next('','339')>".Q39."<\/a>"; }

if ($fquest&1024){
$ff40 = "<div class=none><b>".Q40."<\/b><\/div>";
} else { $ff40 = "<a onclick=qst_next('','340')>".Q40."<\/a>"; }


if($_SESSION['qst']== 29){ ?>

{"markup":"\n\t\t<div id=\"popup3\"><div><h4><?php echo Q29;?><\/h4><ul><input type=\"hidden\" id=\"qst_val\" value=\"\"><li><?php echo $ff30;?><\/li><li><?php echo $ff31;?><\/li><li><?php echo $ff32;?><\/li><li><?php echo $ff33;?><\/li><li><?php echo $ff34;?><\/li><li><?php echo $ff35;?><\/li><li><?php echo $ff36;?><\/li><li><?php echo $ff37;?><\/li><li><?php echo $ff38;?><\/li><li><?php echo $ff39;?><\/li><li><?php echo $ff40;?><\/li><\/ul><\/div><\/div>\n\t\t\n\t\t","number":"-25","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}


<?php } elseif($_SESSION['qst']== 30){

$tRes = $database->getResourceLevel($village->wid);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q30;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q30_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q30_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q30_REWARD,$rewards[30]['gold']*REWARD_MULTIPLIER);?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_res_all_two\" id=\"qstbg\"><\/div>\n\t\t","number":"-30","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q30;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q30_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q30_REWARD,$rewards[30]['gold']*REWARD_MULTIPLIER);?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','30');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_res_all_two\"><\/div>\n\t\t","number":30,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 31){
$embassy = $building->getTypeLevel(18);
if ($embassy == 0){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q31;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q31_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q31_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q31_REWARD,$rewards[31]['wood']*REWARD_MULTIPLIER,$rewards[31]['clay']*REWARD_MULTIPLIER,$rewards[31]['iron']*REWARD_MULTIPLIER,$rewards[31]['crop']*REWARD_MULTIPLIER);?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_dispatch\" id=\"qstbg\"><\/div>\n\t\t","number":"-31","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q31;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q31_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q31_REWARD,$rewards[31]['wood']*REWARD_MULTIPLIER,$rewards[31]['clay']*REWARD_MULTIPLIER,$rewards[31]['iron']*REWARD_MULTIPLIER,$rewards[31]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','31');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_dispatch\"><\/div>\n\t\t","number":31,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 32){
//$aid = $session->alliance;
//$allianceinfo = $database->getAlliance($aid);
if ($session->alliance == 0){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q32;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q32_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q32_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q32_REWARD,$rewards[32]['wood']*REWARD_MULTIPLIER,$rewards[32]['clay']*REWARD_MULTIPLIER,$rewards[32]['iron']*REWARD_MULTIPLIER,$rewards[32]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_alliance\" id=\"qstbg\"><\/div>\n\t\t","number":"-32","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q32;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q32_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q32_REWARD,$rewards[32]['wood']*REWARD_MULTIPLIER,$rewards[32]['clay']*REWARD_MULTIPLIER,$rewards[32]['iron']*REWARD_MULTIPLIER,$rewards[32]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','32');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_alliance\"><\/div>\n\t\t","number":32,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 33){
$getHero = $database->getHero($session->uid);
if ($getHero['adv'] < 10){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q33;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q33_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q33_ORDER.sprintf(Q33_ORDER2,$getHero['adv']);?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q33_REWARD,$rewards[33]['silver']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_finished_ten_adventures\" id=\"qstbg\"><\/div>\n\t\t","number":"-33","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q33;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q33_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q33_REWARD,$rewards[33]['silver']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','33');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_finished_ten_adventures\"><\/div>\n\t\t","number":33,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 34){
$mainbuilding = $building->getTypeLevel(15);
if ($mainbuilding < 5){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q34;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q34_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q34_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q34_REWARD,$rewards[34]['wood']*REWARD_MULTIPLIER,$rewards[34]['clay']*REWARD_MULTIPLIER,$rewards[34]['iron']*REWARD_MULTIPLIER,$rewards[34]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_main_on_five\" id=\"qstbg\"><\/div>\n\t\t","number":"-34","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q34;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q34_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q34_REWARD,$rewards[34]['wood']*REWARD_MULTIPLIER,$rewards[34]['clay']*REWARD_MULTIPLIER,$rewards[34]['iron']*REWARD_MULTIPLIER,$rewards[34]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','34');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_main_on_five\"><\/div>\n\t\t","number":34,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 35){
$granary = $building->getTypeLevel(11);
if ($granary < 3){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q35;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q35_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q35_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q35_REWARD,$rewards[35]['wood']*REWARD_MULTIPLIER,$rewards[35]['clay']*REWARD_MULTIPLIER,$rewards[35]['iron']*REWARD_MULTIPLIER,$rewards[35]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_granary_on_three\" id=\"qstbg\"><\/div>\n\t\t","number":"-35","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q35;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q35_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q35_REWARD,$rewards[35]['wood']*REWARD_MULTIPLIER,$rewards[35]['clay']*REWARD_MULTIPLIER,$rewards[35]['iron']*REWARD_MULTIPLIER,$rewards[35]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','35');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_granary_on_three\"><\/div>\n\t\t","number":35,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 36){
$warehouse = $building->getTypeLevel(10);
if ($warehouse < 7){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q36;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q36_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q36_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q36_REWARD,$rewards[36]['wood']*REWARD_MULTIPLIER,$rewards[36]['clay']*REWARD_MULTIPLIER,$rewards[36]['iron']*REWARD_MULTIPLIER,$rewards[36]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_warehouse_on_seven\" id=\"qstbg\"><\/div>\n\t\t","number":"-36","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q36;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q36_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q36_REWARD,$rewards[36]['wood']*REWARD_MULTIPLIER,$rewards[36]['clay']*REWARD_MULTIPLIER,$rewards[36]['iron']*REWARD_MULTIPLIER,$rewards[36]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','36');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_warehouse_on_seven\"><\/div>\n\t\t","number":36,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 37){
//Check one of each resource is lvl5 or upper
$tRes = $database->getResourceLevel($village->wid);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>4){$ironL++;};if($tRes['f7']>4){$ironL++;};if($tRes['f10']>4){$ironL++;};if($tRes['f11']>4){$ironL++;}
if($tRes['f5']>4){$clayL++;};if($tRes['f6']>4){$clayL++;};if($tRes['f16']>4){$clayL++;};if($tRes['f18']>4){$clayL++;}
if($tRes['f1']>4){$woodL++;};if($tRes['f3']>4){$woodL++;};if($tRes['f14']>4){$woodL++;};if($tRes['f17']>4){$woodL++;}
if($tRes['f2']>4){$cropL++;};if($tRes['f8']>4){$cropL++;};if($tRes['f9']>4){$cropL++;};if($tRes['f12']>4){$cropL++;};if($tRes['f13']>4){$cropL++;};if($tRes['f15']>4){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q37;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q37_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q37_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q37_REWARD,$rewards[37]['wood']*REWARD_MULTIPLIER,$rewards[37]['clay']*REWARD_MULTIPLIER,$rewards[37]['iron']*REWARD_MULTIPLIER,$rewards[37]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_res_all_five\" id=\"qstbg\"><\/div>\n\t\t","number":"-37","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q37;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q37_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q37_REWARD,$rewards[37]['wood']*REWARD_MULTIPLIER,$rewards[37]['clay']*REWARD_MULTIPLIER,$rewards[37]['iron']*REWARD_MULTIPLIER,$rewards[37]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','37');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_res_all_five\"><\/div>\n\t\t","number":37,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 38){
$residence = $building->getTypeLevel(25);
$palace = $building->getTypeLevel(26);
if (($palace<10)&&($residence<10)){?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q38;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q38_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q38_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q38_REWARD,$rewards[38]['wood']*REWARD_MULTIPLIER,$rewards[38]['clay']*REWARD_MULTIPLIER,$rewards[38]['iron']*REWARD_MULTIPLIER,$rewards[38]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_palace_or_residence\" id=\"qstbg\"><\/div>\n\t\t","number":"-38","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q38;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q38_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q38_REWARD,$rewards[38]['wood']*REWARD_MULTIPLIER,$rewards[38]['clay']*REWARD_MULTIPLIER,$rewards[38]['iron']*REWARD_MULTIPLIER,$rewards[38]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','38');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_palace_or_residence\"><\/div>\n\t\t","number":38,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 39){
// Checking 3 settlers trained or no
$units = $village->unitall;
$unarray2=array("","u10", "u20","u30");
$vil = $database->getProfileVillages($session->uid);
if ($units[$unarray2[$session->userinfo['tribe']]]<3 && count($vil)<2){ ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q39;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q39_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q39_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q39_REWARD,$rewards[39]['wood']*REWARD_MULTIPLIER,$rewards[39]['clay']*REWARD_MULTIPLIER,$rewards[39]['iron']*REWARD_MULTIPLIER,$rewards[39]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_three_settlers\" id=\"qstbg\"><\/div>\n\t\t","number":"-39","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q39;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q39_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q39_REWARD,$rewards[39]['wood']*REWARD_MULTIPLIER,$rewards[39]['clay']*REWARD_MULTIPLIER,$rewards[39]['iron']*REWARD_MULTIPLIER,$rewards[39]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','39');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_three_settlers\"><\/div>\n\t\t","number":39,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 40){
$vil = $database->getProfileVillages($session->uid);
if (count($vil)<2){ ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q40;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q40_DESC;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q40_ORDER;?><\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q40_REWARD,$rewards[40]['wood']*REWARD_MULTIPLIER,$rewards[40]['clay']*REWARD_MULTIPLIER,$rewards[40]['iron']*REWARD_MULTIPLIER,$rewards[40]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"javascript: qst_next('','29');\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><div class=\"clear\"><\/div><\/div><\/div>\n\t\t<div class=\"quest_new_village\" id=\"qstbg\"><\/div>\n\t\t","number":"-40","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"popup3\"><div id=\"qstd\"><h4><?php echo Q40;?><\/h4><div class=\"spoken\">&rdquo;<?php echo Q40_RESP;?>&rdquo;<\/div><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q_REWARD;?><\/p><?php echo sprintf(Q40_REWARD,$rewards[40]['wood']*REWARD_MULTIPLIER,$rewards[40]['clay']*REWARD_MULTIPLIER,$rewards[40]['iron']*REWARD_MULTIPLIER,$rewards[40]['crop']*REWARD_MULTIPLIER); ?><div class=\"clear\"><\/div><\/div><input type=\"hidden\" id=\"qst_val\" value=\"\"><a href=\"#\" onclick=\"qst_next('','29')\" class=\"qle arrow\"><?php echo Q_BACKTOOVERVIEW;?><\/a><a href=\"javascript: qst_next('','40');\" class=\"qri arrow\"><?php echo Q_COMPLETE;?><\/a><div class=\"clear\"><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"quest_new_village\"><\/div>\n\t\t","number":40,"reward":{"wood":140,"clay":200,"iron":180,"crop":200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

// End tasks message
<?php } ?>
