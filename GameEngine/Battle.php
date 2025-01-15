<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
if(function_exists("set_time_limit")){
set_time_limit(0);
}

class Battle {
	
	public function procSim($post) {
		global $form;
		// Recivimos el formulario y procesamos
		if(isset($post['attackertribe']) && isset($post['defendertribe'])) {
			$enforcestribes = array();
			for($i=1;$i<=5;$i++) { if(isset($post['reinf_'.$i])) { array_push($enforcestribes,$i);}}
			$participantstribes = array();
			for($i=1;$i<=5;$i++) { if(isset($post['parti_'.$i])) { array_push($participantstribes,$i);}}
			$_POST['enforcestribes'] = $enforcestribes;
			$post['enforcestribes'] = $enforcestribes;
			$_POST['participantstribes'] = $participantstribes;
			$post['participantstribes'] = $participantstribes;
			//var_dump($post);
			$_POST['result'] = $this->simulate($post);
			$post['result'] = $_POST['result'];
			$form->valuearray = $post;
		}
	}
	
	private function getBattleHero($uid) {
		$uid = intval($uid);
		global $database;
		$q = "SELECT * FROM ".TB_PREFIX."hero WHERE uid = ".$uid."";
        $heroarray = $database->query_return($q);
        
        $h_atk = (100+$heroarray['fsperpoint']*$heroarray['power'])+$heroarray['itemfs'];
        $h_di = $heroarray['offBonus']/5;
        $h_dc = $heroarray['defBonus']/5;
        $h_ob = 1 + 0.002 * $heroarray['power'];
        $h_db = 1 + 0.002 * ((100+$heroarray['fsperpoint']*$heroarray['power'])+$heroarray['itemfs']);

        return array('heroid'=>$heroarray['heroid'],'power'=>$h_atk,'off'=>$h_di,'def'=>$h_dc,'power'=>$h_ob,'power'=>$h_db,'health'=>$heroarray['health']);
    }
	
	private function simulate($post) {
		$Enforces = array();
		$Participants = array();
		$Attacker['attackdata']['attack_type'] = $post['attack_type'];
		$Attacker['uid'] = 0;
		$Attacker['tribe'] = $post['attackertribe'];
		$Attacker['inhabitants'] = max(1,isset($post['a_inh'])?$post['a_inh']:0);
		$start = ($Attacker['tribe']-1)*10+1;
		$end = ($Attacker['tribe'])*10;
		for($i=$start;$i<=$end;$i++){
			$Attacker['u'.$i] = isset($post['au_'.$i])?$post['au_'.$i]:0;
			$Attacker['smithy']['b'.($i-$start+1)] = isset($post['ab_'.($i-$start+1)])?$post['ab_'.($i-$start+1)]:0;
		}
		$Attacker['hero']['itemfs'] = isset($post['a_h_fs'])?$post['a_h_fs']:0;
		$Attacker['hero']['offBonus'] = isset($post['a_h_ob'])?$post['a_h_ob']:0;
		$participantsCount = count($post['participantstribes']);
		for($pc=0;$pc<$participantsCount;$pc++){
			$Participants[$pc]['tribe'] = $post['participantstribes'][$pc];
			$start = ($Participants[$pc]['tribe']-1)*10+1;
			$end = ($Participants[$pc]['tribe'])*10;
			for($i=$start;$i<=$end;$i++){
				$Participants[$pc]['u'.$i] = $post['pu_'.$i];
				$Participants[$pc]['smithy']['b'.($i-$start+1)] = $post['pb_'.($i-$start+1)];
			}
		}
		$Defender['uid'] = 0;
		$Defender['tribe'] = $post['defendertribe'];
		$Defender['inhabitants'] = max(1,isset($post['d_inh'])?$post['d_inh']:0);
		$start = ($Defender['tribe']-1)*10+1;
		$end = ($Defender['tribe'])*10;
		for($i=$start;$i<=$end;$i++){
			$Defender['u'.$i] = isset($post['du_'.$i])?$post['du_'.$i]:0;
			$Defender['smithy']['a'.($i-$start+1)] = isset($post['da_'.($i-$start+1)])?$post['da_'.($i-$start+1)]:0;
		}
		$Defender['hero']['itemfs'] = isset($post['d_h_fs'])?$post['d_h_fs']:0;
		$Defender['hero']['defBonus'] = isset($post['d_h_db'])?$post['d_h_db']:0;
		$enforcesCount = count($post['enforcestribes']);
		for($ec=0;$ec<$enforcesCount;$ec++){
			$Enforces[$ec]['tribe'] = $post['enforcestribes'][$ec];
			$start = ($Enforces[$ec]['tribe']-1)*10+1;
			$end = ($Enforces[$ec]['tribe'])*10;
			for($i=$start;$i<=$end;$i++){
				$Enforces[$ec]['u'.$i] = $post['eu_'.$i];
				$Enforces[$ec]['smithy']['a'.($i-$start+1)] = $post['ea_'.($i-$start+1)];
			}
			$Enforces[$ec]['hero']['itemfs'] = $post['e_h_fs'.$Enforces[$ec]['tribe']];
			$Enforces[$ec]['hero']['defBonus'] = $post['e_h_db'.$Enforces[$ec]['tribe']];
		}
		$Defender['buildings']['f40'] = isset($post['wall'])?$post['wall']:0;
		switch ($Defender['tribe']){
			case 1: $Defender['buildings']['f40t'] = 31; break;
			case 2: case 5: $Defender['buildings']['f40t'] = 32; break;
			case 3: $Defender['buildings']['f40t'] = 33; break;
		}
		$Defender['buildings']['f19'] = isset($post['stonemason'])?$post['stonemason']:0;
		$Defender['buildings']['f19t'] = 34;
		
		$Attacker['attackdata']['ctar1'] = 15;
		$Attacker['attackdata']['ctar2'] = 255;
		$Defender['buildings']['f20'] = isset($post['ctar1'])?$post['ctar1']:0;
		$Defender['buildings']['f20t'] = 15;
		
		
		
		if(!isset($post['kata']) || $post['kata'] == "") {
			$post['kata'] = 0;
		}

		// check scout

		$scout = 1;		
		for($i=$start;$i<=($start+9);$i++) {
			if($i == 4 || $i == 14 || $i == 23 || $i == 34 || $i == 44)
			{}
			else{
				if($Attacker['u'.$i]>0) {
					$scout = 0;
					break;
				}
			}
		}

		return $this->calculateBattle($Attacker,$Defender,$Enforces,$Participants);

	}


	//1 raid 0 normal
	function calculateBattle($Attacker,$Defender,$Enforces,$Participants = null) {
		global $bid34,$database;
		// Definieer de array met de eenheden
		$cavalryArray = array(4,5,6,15,16,23,24,25,26,35,36,45,46);
		$catapultArray = array(8,18,28,38,48);
		$ramArray = array(7,17,27,37,47);
		$spyarray = array(4,14,23,34,44);
		$catpCount = $ramCount = 0;
		// Array om terug te keren met het resultaat van de berekening
		$result = array();
		$involve = 0;
		$winner = false;
		// bij 0 alle deelresultaten
		$cavalryAP = $infantryAP = $infantryDP = $cavalryDP = $totalAP = $totalDP = 0;

		//
        // Berekenen het totaal aantal punten van Aanvaller
        //
		if ($Attacker['attackdata']['attack_type'] != 1 && $Defender['tribe']==3 && isset($Defender['u199']) && $Defender['u199']>0){
			$trapCount = $Defender['u199'];
			$trappedCount = 0;
			$tribe = $Attacker['tribe']; $start = ($tribe-1)*10 + 1; $end = $tribe*10; $marr = array(); $trapped = array();
			for($i=$start;$i<=$end;$i++) {$marr['u'.$i] = $Attacker['u'.$i];$trapped['u'.$i] = 0;}
			do{
				$max = max($marr); $key = array_search($max,$marr);
				if ($marr[$key]>0){
					$Attacker[$key] = $Attacker[$key] - 1;
					$marr[$key] = $marr[$key] - 1;
					$trapCount = $trapCount - 1;
					$trapped[$key] = $trapped[$key] + 1;
					$trappedCount = $trappedCount + 1;
				}
			}while($max>0 && $trapCount>0);
			if ($trapCount>0 && isset($Attacker['hero']) && !empty($Attacker['hero'])){
				$trapCount = $trapCount - 1;
				$trapped['hero'] = $Attacker['hero'];
				$Attacker['hero'] = null;
				$trappedCount = $trappedCount + 1;
			}
			$result['trap']['trapcount'] = $Defender['u199'];
			$result['trap']['trapped'] = $trapped;
			$result['trap']['trappedcount'] = $trappedCount;
		}
		$result['had']['attacker']['attackdata'] = $Attacker['attackdata'];
		$result['had']['attacker']['uid'] = $Attacker['uid'];
		$result['had']['attacker']['tribe'] = $Attacker['tribe'];
		$result['had']['attacker']['alliance'] = $Attacker['alliance'];
		$result['had']['attacker']['inhabitants'] = $Attacker['inhabitants'];
		$result['had']['attacker']['villagearties'] = $Attacker['villagearties'];
		$result['had']['attacker']['accountarties'] = $Attacker['accountarties'];
		$result['had']['defender']['uid'] = $Defender['uid'];
		$result['had']['defender']['tribe'] = $Defender['tribe'];
		$result['had']['defender']['alliance'] = $Defender['alliance'];
		$result['had']['defender']['isoasis'] = $Defender['isoasis'];
		$result['had']['defender']['res_array'] = $Defender['res_array'];
		$result['had']['defender']['buildings'] = $Defender['buildings'];
		$result['had']['defender']['inhabitants'] = $Defender['inhabitants'];
		$result['had']['defender']['villagearties'] = $Defender['villagearties'];
		$result['had']['defender']['tocapturearties'] = $Defender['tocapturearties'];
		$result['had']['defender']['accountarties'] = $Defender['accountarties'];
		$result['chief']['hadloyalty'] = $Defender['loyalty'];
		$result['chief']['iscapital'] = $Defender['iscapital'];
		$result['had']['defender']['count'] = 0;
		$result['had']['defender']['pop'] = 0;
		$result['had']['attacker']['count'] = 0;
		$result['had']['attacker']['pop'] = 0;
		$enforcesCount = count($Enforces);
		$tmpAAP = 1;
		for($i=1;$i<=50;$i++){
			$result['had']['defender']['u'.$i] = 0;
			$result['had']['attacker']['u'.$i] = 0;
			for($ec=1;$ec<$enforcesCount;$ec++){
				$result['had']['enforces'][$ec]['u'.$i] = 0;
				$result['had']['enforces'][$ec]['count'] = 0;
				$result['had']['enforces'][$ec]['pop'] = 0;
			}
			$result['had']['defender']['overall']['u'.$i] = 0;
			$result['had']['defender']['overall']['count'] = 0;
			$result['had']['defender']['overall']['pop'] = 0;
			$result['had']['attacker']['overall']['u'.$i] = 0;
			$result['had']['attacker']['overall']['count'] = 0;
			$result['had']['attacker']['overall']['pop'] = 0;
			for ($j=1;$j<=5;$j++){
				$result['had']['defender']['tribedoverall'][$j]['u'.$i] = 0;
				$result['had']['defender']['tribedoverall'][$j]['count'] = 0;
				$result['had']['defender']['tribedoverall'][$j]['pop'] = 0;
				$result['had']['attacker']['tribedoverall'][$j]['u'.$i] = 0;
				$result['had']['attacker']['tribedoverall'][$j]['count'] = 0;
				$result['had']['attacker']['tribedoverall'][$j]['pop'] = 0;
			}
		}
		if($Attacker['attackdata']['attack_type'] == 1){
			switch ($Attacker['tribe']){
				case 1: $y = 4; $addInf = false; break;
				case 2: $y = 14; $addInf = true; break;
				case 3: $y = 23; $addInf = false; break;
				case 4: $y = 34; $addInf = false; break;
				case 5: $y = 44; $addInf = false; break;
			}
			$tribe = $Attacker['tribe'];
			$start = ($tribe-1)*10 + 1;
			$end = $tribe*10;
			if ($Attacker['u'.$y]>0){
				global ${'u'.$y};
				if ($addInf) {
					if ($Attacker['smithy']['b'.($y-$start+1)]){
						$infantryAP +=  (20 + (20 + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $Attacker['smithy']['b'.($y-$start+1)]))) * $Attacker['u'.$y];
					} else {
						$infantryAP +=  20 * $Attacker['u'.$y];
					}
				} else {
					if ($Attacker['smithy']['b'.($y-$start+1)]){
						$cavalryAP +=  (20 + (20 + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $Attacker['smithy']['b'.($y-$start+1)]))) * $Attacker['u'.$y];
					} else {
						$cavalryAP +=  20 * $Attacker['u'.$y];
					}
				}
				$involve += $Attacker['u'.$y];
			}
			switch ($Defender['tribe']){
				case 1: $y = 4; break;
				case 2: $y = 14; break;
				case 3: $y = 23; break;
				case 4: $y = 34; break;
				case 5: $y = 44; break;
			}
			$tribe = $Defender['tribe'];
			$start = ($tribe-1)*10 + 1;
			$end = $tribe*10;
			if ($Defender['u'.$y]>0){
				global ${'u'.$y};
				if ($Defender['smithy']['a'.($y-$start+1)]) {
					$infantryDP +=  (${'u'.$y}['di'] + (${'u'.$y}['di'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $Defender['smithy']['a'.($y-$start+1)]))) * $Defender['u'.$y];
					$cavalryDP += (${'u'.$y}['dc'] + (${'u'.$y}['dc'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $Defender['smithy']['a'.($y-$start+1)]))) * $Defender['u'.$y];
				} else {
					$infantryDP += (${'u'.$y}['di']) * $Defender['u'.$y];
					$cavalryDP += (${'u'.$y}['dc']) * $Defender['u'.$y];
				}
				$involve += $Defender['u'.$y];
			}
			if (isset($Enforces) && count($Enforces)>0){
				$enforcesCount = count($Enforces);
				for($ec=0;$ec<$enforcesCount;$ec++){
					$enforce = $Enforces[$ec];
					$tribe = $enforce['tribe'];
					$start = ($tribe-1)*10 + 1;
					$end = $tribe*10;
					switch ($enforce['tribe']){
						case 1: $y = 4; $addInf = false; break;
						case 2: $y = 14; $addInf = true; break;
						case 3: $y = 23; $addInf = false; break;
						case 4: $y = 34; $addInf = false; break;
						case 5: $y = 44; $addInf = false; break;
					}
					if ($enforce['u'.$y]>0){
						global ${'u'.$y};
						if($enforce['smithy']['a'.($y-$start+1)]){
							$infantryDP +=  (${'u'.$y}['di'] + (${'u'.$y}['di'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $enforce['smithy']['a'.($y-$start+1)]))) * $enforce['u'.$y];
							$cavalryDP += (${'u'.$y}['dc'] + (${'u'.$y}['dc'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $enforce['smithy']['a'.($y-$start+1)]))) * $enforce['u'.$y];
						} else {
							$infantryDP += (${'u'.$y}['di']) * $enforce['u'.$y];
							$cavalryDP += (${'u'.$y}['dc']) * $enforce['u'.$y];
						}
						$involve += $enforce['u'.$y];
					}
				}
			}
		}//else
		
		{
			$tribe = $Attacker['tribe'];
			$start = ($tribe-1)*10 + 1;
			$end = $tribe*10;
			for($i=$start;$i<=$end;$i++) {
				if ($Attacker['u'.$i]>0){
					global ${'u'.$i};
					if($Attacker['attackdata']['attack_type'] != 1){
						if(in_array($i,$cavalryArray)) {
							if($Attacker['smithy']['b'.($i-$start+1)]){
								$cavalryAP += (${'u'.$i}['atk'] + (${'u'.$i}['atk'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, $Attacker['smithy']['b'.($i-$start+1)]))) * $Attacker['u'.$i];
							} else {
								$cavalryAP += (${'u'.$i}['atk']) * $Attacker['u'.$i];
							}
						} else {
							if($Attacker['smithy']['b'.($i-$start+1)]){
								$infantryAP += (${'u'.$i}['atk'] + (${'u'.$i}['atk'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, $Attacker['smithy']['b'.($i-$start+1)]))) * $Attacker['u'.$i];
							} else {
								$infantryAP += (${'u'.$i}['atk']) * $Attacker['u'.$i];
							}
						}
						// Punten van de catavult van de aanvaller
						if(in_array($i,$catapultArray)) {
							$catpCount += $Attacker['u'.$i];
						}
						 // Punten van de Rammen van de aanvaller
						if(in_array($i,$ramArray)) {
							$ramCount += $Attacker['u'.$i];
						}
						$involve += $Attacker['u'.$i];
					}
					$result['had']['attacker']['u'.$i] += $Attacker['u'.$i];
					$result['had']['attacker']['count'] += $Attacker['u'.$i];
					$result['had']['attacker']['pop'] += $Attacker['u'.$i]* ${'u'.$i}['pop'];
					$result['had']['attacker']['tribedoverall'][$Attacker['tribe']]['u'.$i] += $Attacker['u'.$i];
					$result['had']['attacker']['tribedoverall'][$Attacker['tribe']]['count'] += $Attacker['u'.$i];
					$result['had']['attacker']['tribedoverall'][$Attacker['tribe']]['pop'] += $Attacker['u'.$i]* ${'u'.$i}['pop'];
					$result['had']['attacker']['overall']['u'.$i] += $Attacker['u'.$i];
					$result['had']['attacker']['overall']['count'] += $Attacker['u'.$i];
					$result['had']['attacker']['overall']['pop'] += $Attacker['u'.$i]* ${'u'.$i}['pop'];
				}
            }
			$tribe = $Defender['tribe'];
			$start = ($tribe-1)*10 + 1;
			$end = $tribe*10;
			for($i=$start;$i<=$end;$i++) {
				if ($Defender['u'.$i]>0){
					global ${'u'.$i};
					if($Attacker['attackdata']['attack_type'] != 1){
						if(!isset($Defender['smithy']['a'.($i-$start+1)])) $Defender['smithy']['a'.($i-$start+1)] = 0;
						if($Defender['smithy']['a'.($i-$start+1)]){
							$infantryDP +=  (${'u'.$i}['di'] + (${'u'.$i}['di'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, $Defender['smithy']['a'.($i-$start+1)]))) * $Defender['u'.$i];
							$cavalryDP += (${'u'.$i}['dc'] + (${'u'.$i}['dc'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, $Defender['smithy']['a'.($i-$start+1)]))) * $Defender['u'.$i];
						} else {
							$infantryDP += (${'u'.$i}['di']) * $Defender['u'.$i];
							$cavalryDP += (${'u'.$i}['dc']) * $Defender['u'.$i];
						}
						$involve += $Defender['u'.$i];
					}
					$result['had']['defender']['u'.$i] += $Defender['u'.$i];
					$result['had']['defender']['count'] += $Defender['u'.$i];
					$result['had']['defender']['pop'] += $Defender['u'.$i]* ${'u'.$i}['pop'];
					$result['had']['defender']['tribedoverall'][$Defender['tribe']]['u'.$i] += $Defender['u'.$i];
					$result['had']['defender']['tribedoverall'][$Defender['tribe']]['count'] += $Defender['u'.$i];
					$result['had']['defender']['tribedoverall'][$Defender['tribe']]['pop'] += $Defender['u'.$i]* ${'u'.$i}['pop'];
					$result['had']['defender']['overall']['u'.$i] += $Defender['u'.$i];
					$result['had']['defender']['overall']['count'] += $Defender['u'.$i];
					$result['had']['defender']['overall']['pop'] += $Defender['u'.$i]* ${'u'.$i}['pop'];
				}
			}

			if (isset($Enforces) && count($Enforces)>0){
				$enforcesCount = count($Enforces);
				for($ec=0;$ec<$enforcesCount;$ec++){
					$enforce = $Enforces[$ec];
					$tribe = $enforce['tribe'];
					$start = ($tribe-1)*10 + 1;
					$end = $tribe*10;
					$result['had']['enforces'][$ec]['id'] = $enforce['id'];
					$result['had']['enforces'][$ec]['from'] = $enforce['from'];
					$result['had']['enforces'][$ec]['vref'] = $enforce['vref'];
					$result['had']['enforces'][$ec]['uid'] = $enforce['uid'];
					$result['had']['enforces'][$ec]['tribe'] = $enforce['tribe'];
					$result['had']['enforces'][$ec]['alliance'] = $enforce['alliance'];
					for($i=$start;$i<=$end;$i++) {
						if ($enforce['u'.$i]>0){
							global ${'u'.$i};
							if($Attacker['attackdata']['attack_type'] != 1){
								if ($enforce['smithy']['a'.($i-$start+1)]) {
									$infantryDP +=  (${'u'.$i}['di'] + (${'u'.$i}['di'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, $enforce['smithy']['a'.($i-$start+1)]))) * $enforce['u'.$i];
									$cavalryDP += (${'u'.$i}['dc'] + (${'u'.$i}['dc'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, $enforce['smithy']['a'.($i-$start+1)]))) * $enforce['u'.$i];
								} else {
									$infantryDP += (${'u'.$i}['di']) * $enforce['u'.$i];
									$cavalryDP += (${'u'.$i}['dc']) * $enforce['u'.$i];
								}
								$involve += $enforce['u'.$i];
							}
							
							if(!isset($result['had']['enforces'][$ec]['u'.$i])){$result['had']['enforces'][$ec]['u'.$i]=0;}
							$result['had']['enforces'][$ec]['u'.$i] += $enforce['u'.$i];
							//if(isset($result['had']['enforces'][$ec]['u'.$i])&& $result['had']['enforces'][$ec]['u'.$i]>0)throw new Exception(__FILE__." $ec: $i: ". ($result['had']['enforces'][$ec]['u'.$i]));
							if(!isset($result['had']['enforces'][$ec]['count'])){$result['had']['enforces'][$ec]['count']=0;}
							$result['had']['enforces'][$ec]['count'] += $enforce['u'.$i];
							if(!isset($result['had']['enforces'][$ec]['pop'])){$result['had']['enforces'][$ec]['pop']=0;}
							$result['had']['enforces'][$ec]['pop'] += $enforce['u'.$i]* ${'u'.$i}['pop'];
							$result['had']['defender']['tribedoverall'][$enforce['tribe']]['u'.$i] += $enforce['u'.$i];
							$result['had']['defender']['tribedoverall'][$enforce['tribe']]['count'] += $enforce['u'.$i];
							$result['had']['defender']['tribedoverall'][$enforce['tribe']]['pop'] += $enforce['u'.$i]* ${'u'.$i}['pop'];
							$result['had']['defender']['overall']['u'.$i] += $enforce['u'.$i];
							$result['had']['defender']['overall']['count'] += $enforce['u'.$i];
							$result['had']['defender']['overall']['pop'] += $enforce['u'.$i]* ${'u'.$i}['pop'];
						}
					}
				}
			}
        }

		$attackHeroBonus = $defenseHeroBonus = 0;
		if($Attacker['hero']) {
			$result['had']['attacker']['hero'] = $Attacker['hero'];
			$result['had']['attacker']['count'] += 1;
			$result['had']['attacker']['pop'] += 6;
			$result['had']['attacker']['tribedoverall'][$Attacker['tribe']]['hero'][] = $Attacker['hero'];
			$result['had']['attacker']['tribedoverall'][$Attacker['tribe']]['count'] += 1;
			$result['had']['attacker']['tribedoverall'][$Attacker['tribe']]['pop'] += 6;
			$result['had']['attacker']['overall']['hero'][] = $Attacker['hero'];
			$result['had']['attacker']['overall']['count'] += 1;
			$result['had']['attacker']['overall']['pop'] += 6;
			if($Attacker['attackdata']['attack_type'] != 1){
				$involve += 1;
				$atkheroface = $Attacker['heroface'];
				$atkhero = $Attacker['hero'];
				if ($atkheroface['horse'] != 0) {
					$cavalryAP += ($atkhero['power']*$atkhero['fsperpoint']+$atkhero['itemfs'])*2/3;
					$infantryAP += ($atkhero['power']*$atkhero['fsperpoint']+$atkhero['itemfs'])/3;
				} else {
					$cavalryAP += ($atkhero['power']*$atkhero['fsperpoint']+$atkhero['itemfs'])/3;
					$infantryAP += ($atkhero['power']*$atkhero['fsperpoint']+$atkhero['itemfs'])*2/3;// + ($atkhero['power']*$atkhero['fsperpoint'] + 300 * 6 / 7) * (pow(1.007, $atkhero['offBonus']) - 1);
				}
				$attackHeroBonus += $atkhero['offBonus']*0.2;
				if ($atkheroface['rightHand'] != 0) {
					$rightHand = $database->getHeroItem($atkheroface['rightHand']);
					switch ($rightHand){
						case 16: $addP=3; case 17: $addP=4; case 18: $addP=5; $uindex = 'u1'; $addtoinf = true; break;
						case 19: $addP=3; case 20: $addP=4; case 21: $addP=5; $uindex = 'u2'; $addtoinf = true; break;
						case 22: $addP=3; case 23: $addP=4; case 24: $addP=5; $uindex = 'u3'; $addtoinf = true; break;
						case 25: $addP=6; case 26: $addP=7; case 27: $addP=8; $uindex = 'u5'; $addtoinf = false; break;
						case 28: $addP=6; case 29: $addP=7; case 30: $addP=8; $uindex = 'u6'; $addtoinf = false; break;
						case 31: $addP=3; case 32: $addP=4; case 33: $addP=5; $uindex = 'u21'; $addtoinf = true; break;
						case 34: $addP=3; case 35: $addP=4; case 36: $addP=5; $uindex = 'u22'; $addtoinf = true; break;
						case 37: $addP=6; case 38: $addP=7; case 39: $addP=8; $uindex = 'u24'; $addtoinf = false; break;
						case 40: $addP=6; case 41: $addP=7; case 42: $addP=8; $uindex = 'u25'; $addtoinf = false; break;
						case 43: $addP=6; case 44: $addP=7; case 45: $addP=8; $uindex = 'u26'; $addtoinf = false; break;
						case 46: $addP=3; case 47: $addP=4; case 48: $addP=5; $uindex = 'u11'; $addtoinf = true; break;
						case 49: $addP=3; case 50: $addP=4; case 51: $addP=5; $uindex = 'u12'; $addtoinf = true; break;
						case 52: $addP=3; case 53: $addP=4; case 54: $addP=5; $uindex = 'u13'; $addtoinf = true; break;
						case 55: $addP=6; case 56: $addP=7; case 57: $addP=8; $uindex = 'u15'; $addtoinf = false; break;
						case 58: $addP=6; case 59: $addP=7; case 60: $addP=8; $uindex = 'u16'; $addtoinf = false; break;
					}
					if (isset($uindex) && isset($result['had']['attacker']['overall'][$uindex])){
						if ($addtoinf) {
							$infantryAP += $result['had']['attacker']['overall'][$uindex]*$addP;
						} else {
							$cavalryAP += $result['had']['attacker']['overall'][$uindex]*$addP;
						}
					}
				}
			}
		}

		if(isset($Defender['hero'])) {
			$result['had']['defender']['hero'] = $Defender['hero'];
			$result['had']['defender']['count'] += 1;
			$result['had']['defender']['pop'] += 6;
			$result['had']['defender']['tribedoverall'][$Defender['tribe']]['hero'][] = $Defender['hero'];
			$result['had']['defender']['tribedoverall'][$Defender['tribe']]['count'] += 1;
			$result['had']['defender']['tribedoverall'][$Defender['tribe']]['pop'] += 6;
			$result['had']['defender']['overall']['hero'][] = $Defender['hero'];
			$result['had']['defender']['overall']['count'] += 1;
			$result['had']['defender']['overall']['pop'] += 6;
			if($Attacker['attackdata']['attack_type'] != 1){
				$involve += 1; 
				$defhero = $Defender['hero'];
				$defheroface = $Defender['heroface'];
				if ($defheroface['horse'] != 0) {
					$cavalryDP += ($defhero['power']*$defhero['fsperpoint']+$defhero['itemfs'])*2/3;
					$infantryDP += ($defhero['power']*$defhero['fsperpoint']+$defhero['itemfs'])/3;
				} else {
					$cavalryDP += ($defhero['power']*$defhero['fsperpoint']+$defhero['itemfs'])/3;
					$infantryDP += ($defhero['power']*$defhero['fsperpoint']+$defhero['itemfs'])*2/3;
				}
				$defenseHeroBonus += ($defhero['defBonus']*0.002);
				if ($defheroface['rightHand'] != 0) {
					$rightHand = $database->getHeroItem($defheroface['rightHand']);
					switch ($rightHand){
						case 16: $addP=3; case 17: $addP=4; case 18: $addP=5; $uindex = 'u1'; $addtoinf = true; break;
						case 19: $addP=3; case 20: $addP=4; case 21: $addP=5; $uindex = 'u2'; $addtoinf = true; break;
						case 22: $addP=3; case 23: $addP=4; case 24: $addP=5; $uindex = 'u3'; $addtoinf = true; break;
						case 25: $addP=6; case 26: $addP=7; case 27: $addP=8; $uindex = 'u5'; $addtoinf = false; break;
						case 28: $addP=6; case 29: $addP=7; case 30: $addP=8; $uindex = 'u6'; $addtoinf = false; break;
						case 31: $addP=3; case 32: $addP=4; case 33: $addP=5; $uindex = 'u21'; $addtoinf = true; break;
						case 34: $addP=3; case 35: $addP=4; case 36: $addP=5; $uindex = 'u22'; $addtoinf = true; break;
						case 37: $addP=6; case 38: $addP=7; case 39: $addP=8; $uindex = 'u24'; $addtoinf = false; break;
						case 40: $addP=6; case 41: $addP=7; case 42: $addP=8; $uindex = 'u25'; $addtoinf = false; break;
						case 43: $addP=6; case 44: $addP=7; case 45: $addP=8; $uindex = 'u26'; $addtoinf = false; break;
						case 46: $addP=3; case 47: $addP=4; case 48: $addP=5; $uindex = 'u11'; $addtoinf = true; break;
						case 49: $addP=3; case 50: $addP=4; case 51: $addP=5; $uindex = 'u12'; $addtoinf = true; break;
						case 52: $addP=3; case 53: $addP=4; case 54: $addP=5; $uindex = 'u13'; $addtoinf = true; break;
						case 55: $addP=6; case 56: $addP=7; case 57: $addP=8; $uindex = 'u15'; $addtoinf = false; break;
						case 58: $addP=6; case 59: $addP=7; case 60: $addP=8; $uindex = 'u16'; $addtoinf = false; break;
					}
					if (isset($uindex) && isset($result['had']['defender']['overall'][$uindex])){
						if ($addtoinf) {
							$infantryDP += $result['had']['defender']['overall'][$uindex]*$addP;
						} else {
							$cavalryDP += $result['had']['defender']['overall'][$uindex]*$addP;
						}
					}
				}
			}
		}
		
		if (isset($Enforces) && count($Enforces)>0){
			$enforcesCount = count($Enforces);
			for($ec=0;$ec<$enforcesCount;$ec++){
				$enforce = $Enforces[$ec];
				if($enforce['hero']) {
					$result['had']['enforces'][$ec]['hero'] = $enforce['hero'];
					if(!isset($result['had']['enforces'][$ec]['count'])) $result['had']['enforces'][$ec]['count'] = 0;
					$result['had']['enforces'][$ec]['count'] += 1;
					if(!isset($result['had']['enforces'][$ec]['pop'])) $result['had']['enforces'][$ec]['pop'] = 0;
					$result['had']['enforces'][$ec]['pop'] += 6;
					$result['had']['defender']['tribedoverall'][$enforce['tribe']]['hero'][] = $enforce['hero'];
					if(!isset($result['had']['defender']['tribedoverall'][$enforce['tribe']]['count'])) $result['had']['defender']['tribedoverall'][$enforce['tribe']]['count'] = 0;
					$result['had']['defender']['tribedoverall'][$enforce['tribe']]['count'] += 1;
					if(!isset($result['had']['defender']['tribedoverall'][$enforce['tribe']]['pop'])) $result['had']['defender']['tribedoverall'][$enforce['tribe']]['pop'] = 0;
					$result['had']['defender']['tribedoverall'][$enforce['tribe']]['pop'] += 6;
					$result['had']['defender']['overall']['hero'] = $enforce['hero'];
					if(!isset($result['had']['defender']['overall']['count'])) $result['had']['defender']['overall']['count'] = 0;
					$result['had']['defender']['overall']['count'] += 1;
					if(!isset($result['had']['defender']['overall']['pop'])) $result['had']['defender']['overall']['pop'] = 0;
					$result['had']['defender']['overall']['pop'] += 6;
					if($Attacker['attackdata']['attack_type'] != 1){
						$involve += 1;
						$enforcehero = $enforce['hero'];
						$enforceheroface = $enforce['heroface'];
						if ($enforceheroface['horse'] != 0) {
							$cavalryDP += ($enforcehero['power']*$enforcehero['fsperpoint']+$enforcehero['itemfs'])*2/3;
							$infantryDP += ($enforcehero['power']*$enforcehero['fsperpoint']+$enforcehero['itemfs'])/3;
						} else {
							$cavalryDP += ($enforcehero['power']*$enforcehero['fsperpoint']+$enforcehero['itemfs'])/3;
							$infantryDP += ($enforcehero['power']*$enforcehero['fsperpoint']+$enforcehero['itemfs'])*2/3;
						}
						$defenseHeroBonus += ($enforcehero['defBonus']*0.002);
						if ($enforceheroface['rightHand'] != 0) {
							$rightHand = $database->getHeroItem($enforceheroface['rightHand']);
							switch ($rightHand){
								case 16: $addP=3; case 17: $addP=4; case 18: $addP=5; $uindex = 'u1'; $addtoinf = true; break;
								case 19: $addP=3; case 20: $addP=4; case 21: $addP=5; $uindex = 'u2'; $addtoinf = true; break;
								case 22: $addP=3; case 23: $addP=4; case 24: $addP=5; $uindex = 'u3'; $addtoinf = true; break;
								case 25: $addP=6; case 26: $addP=7; case 27: $addP=8; $uindex = 'u5'; $addtoinf = false; break;
								case 28: $addP=6; case 29: $addP=7; case 30: $addP=8; $uindex = 'u6'; $addtoinf = false; break;
								case 31: $addP=3; case 32: $addP=4; case 33: $addP=5; $uindex = 'u21'; $addtoinf = true; break;
								case 34: $addP=3; case 35: $addP=4; case 36: $addP=5; $uindex = 'u22'; $addtoinf = true; break;
								case 37: $addP=6; case 38: $addP=7; case 39: $addP=8; $uindex = 'u24'; $addtoinf = false; break;
								case 40: $addP=6; case 41: $addP=7; case 42: $addP=8; $uindex = 'u25'; $addtoinf = false; break;
								case 43: $addP=6; case 44: $addP=7; case 45: $addP=8; $uindex = 'u26'; $addtoinf = false; break;
								case 46: $addP=3; case 47: $addP=4; case 48: $addP=5; $uindex = 'u11'; $addtoinf = true; break;
								case 49: $addP=3; case 50: $addP=4; case 51: $addP=5; $uindex = 'u12'; $addtoinf = true; break;
								case 52: $addP=3; case 53: $addP=4; case 54: $addP=5; $uindex = 'u13'; $addtoinf = true; break;
								case 55: $addP=6; case 56: $addP=7; case 57: $addP=8; $uindex = 'u15'; $addtoinf = false; break;
								case 58: $addP=6; case 59: $addP=7; case 60: $addP=8; $uindex = 'u16'; $addtoinf = false; break;
							}
							if (isset($uindex) && isset($result['had']['defender']['overall'][$uindex])){
								if ($addtoinf) {
									$infantryDP += $result['had']['defender']['overall'][$uindex]*$addP;
								} else {
									$cavalryDP += $result['had']['defender']['overall'][$uindex]*$addP;
								}
							}
						}
					}
				}
			}
		}
		
		////////////////EDIT EDIT EDIT EDIT///////// 
		$result['reminders']['defender']['buildings'] = $result['had']['defender']['buildings'];
		/////////////////////////////////////////////
		if (!$Defender['isoasis']){
			$buildarray =  $result['had']['defender']['buildings'];
			$wall = $buildarray['f40'];
			$residence = 0;
			for($i=19;$i<=39;$i++){
				if(($buildarray['f'.$i.'t']==25)||($buildarray['f'.$i.'t']==26)){
					$residence = $buildarray['f'.$i];
					break;
				}
			}
		} else {
			$wall = 0;
			$residence = 0;
		}
		
		// Formule voor de berekening van de bonus verdedigingsmuur "en" Residence ";
		//
		$wallDefBonus = 1;
		$factor = ($Defender['tribe'] == 1)? 1.030 : (($Defender['tribe'] == 2)? 1.020 : 1.025);
		if($wall>0)	$wallDefBonus = pow($factor,$wall);

		// Berekening van de Basic defence bonus "Residence"
		$residenceDefense = 2*(pow($residence,2));

		if ($Attacker['hero']){
			$hero = $Attacker['hero'];
			if ($Defender['tribe'] == 5){
				$attackHeroBonus += $hero['vsnatars']*HEROATTRSPEED + $hero['itemvsnatars']*ITEMATTRSPEED;
			}
		}
		$breweryAttBonus = 1;
		if (isset($Attacker['capbrewery']) && $Attacker['capbrewery']>0) {
			$breweryAttBonus = ($Attacker['capbrewery']+100)/100;
			if ($Attacker['attackdata']['ctar1']!=255) $Attacker['attackdata']['ctar1'] = 0;
			if ($Attacker['attackdata']['ctar2']!=255) $Attacker['attackdata']['ctar2'] = 0;
		}

		$confArteEff = 1; $hasConfArte = false;
		if(isset($Defender['villagearties']) && !empty($Defender['villagearties'])){
			foreach($Defender['villagearties'] as $arte){if($arte['effecttype']==5) {$confArteEff = $arte['effect']; $hasConfArte = true;}}
		}
		if($confArteEff == 1 && isset($Defender['accountarties']) && !empty($Defender['accountarties'])){
			foreach($Defender['accountarties'] as $arte){
				if($arte['effecttype']==5) {
					$confArteEff = $arte['effect']; $hasConfArte = true; if ($arte['aoe']==3) break;
				}
			}
		}
		if ($hasConfArte) {
			if ($Attacker['attackdata']['ctar1']!=255) $Attacker['attackdata']['ctar1'] = 0;
			if ($Attacker['attackdata']['ctar2']!=255) $Attacker['attackdata']['ctar2'] = 0;
		}
		$attackHeroBonus /= 100;
		$infantryAP = $infantryAP*($attackHeroBonus + $breweryAttBonus);
		$cavalryAP = $cavalryAP*($attackHeroBonus + $breweryAttBonus);
		$totalAP = $infantryAP+$cavalryAP;
		
		//
		// Formule voor de berekening van Defensive Punten
		//
		$infantryDP = ($infantryDP+($residenceDefense/2))*($wallDefBonus + $defenseHeroBonus);
		$cavalryDP = ($cavalryDP+($residenceDefense/2))*($wallDefBonus + $defenseHeroBonus);
		if ($totalAP==0) {
			$totalDP = ($infantryDP) + ($cavalryDP) + 10;
		}else{             
			$totalDP = ($infantryDP * ($infantryAP/$totalAP)) + ($cavalryDP * ($cavalryAP/$totalAP)) + 10;
		}
		
		//
		// En de Winnaar is....:
		//
		$result['Attack_points'] = $totalAP;
		$result['Defend_points'] = $totalDP;
		
		$winner = ($totalAP > $totalDP);

		$result['Winner'] = ($winner)? "attacker" : "defender";

		// Formule voor de berekening van de Moraal
		if($Attacker['inhabitants'] > $Defender['inhabitants']) {
			if ($totalAP < $totalDP) {
				$moralbonus = min(1.5, pow($Attacker['inhabitants'] / $Defender['inhabitants'], (0.2*($totalAP/$totalDP))));
			}
			else {
				$moralbonus = min(1.5, pow($Attacker['inhabitants'] / $Defender['inhabitants'], 0.2));
			}
		} else {
			$moralbonus = 1.0;
		}

		if($involve >= 1000) {
			$Mfactor = round(2*(1.8592-pow($involve,0.015)),4);
		} else {
			$Mfactor = 1.5;
		}
		// Formule voor het berekenen verloren drives
		if($Attacker['attackdata']['attack_type'] == 1){
			$defSpyArteEff = 1;
			if(isset($Defender['villagearties']) && !empty($Defender['villagearties'])){
				foreach($Defender['villagearties'] as $arte){if($arte['effecttype']==5) {$defSpyArteEff = $arte['effect'];}}
			}
			if($defSpyArteEff == 1 && isset($Defender['accountarties']) && !empty($Defender['accountarties'])){
				foreach($Defender['accountarties'] as $arte){
					if($arte['effecttype']==5) {
						$defSpyArteEff = $arte['effect']; if ($arte['aoe']==3) break;
					}
				}
			}
			$attSpyArteEff = 1;
			if(isset($Attacker['villagearties']) && !empty($Attacker['villagearties'])){
				foreach($Attacker['villagearties'] as $arte){if($arte['effecttype']==5) {$attSpyArteEff = $arte['effect'];}}
			}
			if($attSpyArteEff == 1 && isset($Attacker['accountarties']) && !empty($Attacker['accountarties'])){
				foreach($Attacker['accountarties'] as $arte){
					if($arte['effecttype']==5) {
						$attSpyArteEff = $arte['effect']; if ($arte['aoe']==3) break;
					}
				}
			}
			$totalAP *= $attSpyArteEff;
			$totalDP *= $defSpyArteEff;
			$totalAP = max($totalAP,1);
			$holder = pow((($totalDP*$moralbonus)/$totalAP),$Mfactor);
			$holder = $holder / (1 + $holder);
			// Attacker
			$result[1] = $holder;
			// Defender
			$result[2] = 0;
			$result[1]= max(0,min(1,$result[1]));
			$result[2]= max(0,min(1,$result[2]));
		} elseif($Attacker['attackdata']['attack_type'] == 2){
		} elseif($Attacker['attackdata']['attack_type'] == 3) {
			// Attacker
			$result[1] = ($winner)? pow((($totalDP*$moralbonus)/$totalAP),$Mfactor) : 1;
			$result[1] = round($result[1],8);
			// Defender
			$result[2] = (!$winner)?  pow(($totalAP/($totalDP*$moralbonus)),$Mfactor) : 1;
			$result[2] = round($result[2],8);
			$result[1]= max(0,min(1,$result[1]));
			$result[2]= max(0,min(1,$result[2]));
			// Als aangevallen met "Hero"
			$ku = ($Attacker['tribe']-1)*10+9;
            $kings = $Attacker['u'.$ku];
            $aviables= $kings-round($kings*$result[1]);
			if ($aviables>0){
				switch($aviables){
				case 1: $fealthy = rand(20,30); break;
				case 2: $fealthy = rand(40,60); break;
				case 3: $fealthy = rand(60,80); break;
				case 4: $fealthy = rand(80,100); break;
				default: $fealthy = 100; break;
				}
				$result['health'] = $fealthy;
			}
			$ramCount -= round($ramCount*$result[1]);
            //$catpCount -= round($catpCount*$result[1]);
			$ctpMul = pow($totalAP / $totalDP,1.5);
			if($ctpMul > 1) {$ctpMul = 1 - 0.5 / $ctpMul;
			} else {$ctpMul = 0.5 * $ctpMul;}
			$catpCount *= $ctpMul;
		} elseif($Attacker['attackdata']['attack_type'] == 4) {
			$holder = ($winner) ? pow((($totalDP*$moralbonus)/$totalAP),$Mfactor) : pow(($totalAP/($totalDP*$moralbonus)),$Mfactor);
			$holder = $holder / (1 + $holder);
			// Attacker
			$result[1] = $winner ? $holder : 1 - $holder;
			// Defender
			$result[2] = $winner ? 1 - $holder : $holder;
			$result[1]= max(0,min(1,$result[1]));
			$result[2]= max(0,min(1,$result[2]));
			$ramCount -= round($ramCount*$result[1]);
            //$catpCount -= round($catpCount*$result[1]);
			$ctpMul = pow($totalAP / $totalDP,1.5);
			if($ctpMul > 1) {$ctpMul = 1 - 0.5 / $ctpMul;
			} else {$ctpMul = 0.5 * $ctpMul;}
			$catpCount *= $ctpMul;
		}
		if($Attacker['attackdata']['attack_type'] == 3) {
			// Formule voor de berekening van katapulten nodig
			$targetBuilding = array(0=>array('f'=>0,'ft'=>0,'lvl'=>0),
									1=>array('f'=>0,'ft'=>0,'lvl'=>0));
			$stonemasonPower = 1;
			$archArtePower = 1;
			if (!$Defender['isoasis']){
				if(isset($Defender['villagearties']) && !empty($Defender['villagearties'])){
						foreach($Defender['villagearties'] as $arte){if($arte['effecttype']==2) {$archArtePower = $arte['effect'];}}
				}
				if($archArtePower == 1 && isset($Defender['accountarties']) && !empty($Defender['accountarties'])){
						foreach($Defender['accountarties'] as $arte){
							if($arte['effecttype']==2) {
								$archArtePower = $arte['effect']; if ($arte['aoe']==3) break;
							}
						}
				}
				global $bid34;
				$buildarray = $result['had']['defender']['buildings'];
				for($i=19;$i<=39;$i++){
					if($buildarray['f'.$i.'t']==34){
						$stonemasonPower = (1 + $bid34[$buildarray['f'.$i]]['attri']);
						break;
					}
				}
				$indexArray = range(1,39);
				$indexArray[]=99;
				if ($Attacker['attackdata']['ctar1']>0 && $Attacker['attackdata']['ctar1']!=255){
					shuffle($indexArray);
					for($i=0;$i<=39;$i++){
						if($buildarray['f'.$indexArray[$i].'t']==$Attacker['attackdata']['ctar1'] && $buildarray['f'.$indexArray[$i]]!=0){
							$targetBuilding[0]['f'] = $indexArray[$i]; $targetBuilding[0]['ft'] = $buildarray['f'.$indexArray[$i].'t'];
							$targetBuilding[0]['lvl'] = $buildarray['f'.$indexArray[$i]];break;
						}
					}
					if ($targetBuilding[0]['f']==0) {
						$targetBuilding[0]['ft'] = $Attacker['attackdata']['ctar1'];
					}
				} elseif($Attacker['attackdata']['ctar1']==0) {
					shuffle($indexArray);
					for($i=0;$i<=39;$i++){
						if($buildarray['f'.$indexArray[$i].'t']!=0 && $buildarray['f'.$indexArray[$i]]!=0){
							$targetBuilding[0]['f'] = $indexArray[$i]; $targetBuilding[0]['ft'] = $buildarray['f'.$indexArray[$i].'t'];
							$targetBuilding[0]['lvl'] = $buildarray['f'.$indexArray[$i]];break;
						}
					}
				}
				if ($Attacker['attackdata']['ctar2']>0  && $Attacker['attackdata']['ctar2']!=255){
					shuffle($indexArray);
					for($i=0;$i<=39;$i++){
						if($buildarray['f'.$indexArray[$i].'t']==$Attacker['attackdata']['ctar2'] && $buildarray['f'.$indexArray[$i]]!=0){
							$targetBuilding[1]['f'] = $indexArray[$i]; $targetBuilding[1]['ft'] = $buildarray['f'.$indexArray[$i].'t'];
							$targetBuilding[1]['lvl'] = $buildarray['f'.$indexArray[$i]];break;
						}
					}
					if ($targetBuilding[1]['f']==0) {
						$targetBuilding[1]['ft'] = $Attacker['attackdata']['ctar2'];
					}
				} elseif ($Attacker['attackdata']['ctar2']==0) {
					shuffle($indexArray);
					for($i=0;$i<=39;$i++){
						if($buildarray['f'.$indexArray[$i].'t']!=0 && $buildarray['f'.$indexArray[$i]]!=0 && $buildarray['f'.$indexArray[$i]]!=$targetBuilding[0]['f']){
							$targetBuilding[1]['f'] = $indexArray[$i]; $targetBuilding[1]['ft'] = $buildarray['f'.$indexArray[$i].'t'];
							$targetBuilding[1]['lvl'] = $buildarray['f'.$indexArray[$i]];break;
						}
					}
				}
			}
			
			$result['had']['defender']['ctar'] = $targetBuilding;
			if($catpCount > 0 && ($targetBuilding[0]['f'] != 0 || $targetBuilding[1]['f'] != 0 || $targetBuilding[0]['ft'] != 0 || $targetBuilding[1]['ft'] != 0)) {
				$catapultMoralBonus = min(3,max(1, pow($Attacker['inhabitants'] / $Defender['inhabitants'], 0.3)));
				$wctp = pow(($totalAP/$totalDP),1.5);
				$wctp = ($wctp >= 1)? 1-0.5/$wctp : 0.5*$wctp;
				$wctp *= $catpCount;
				$result[4] = $wctp;
				$result[5] = $catapultMoralBonus;
				$result[6] = $Attacker['smithy']['b8'];
				$catpGrpCnt = 0;
				if ($Attacker['attackdata']['ctar1']!=255) $catpGrpCnt += 1;
				if ($Attacker['attackdata']['ctar2']!=255) $catpGrpCnt += 1;
				$catpCount1 = 0; if ($Attacker['attackdata']['ctar1']!=255) $catpCount1 = round($catpCount/$catpGrpCnt);
				$catpCount2 = 0; if ($Attacker['attackdata']['ctar2']!=255) $catpCount2 = round($catpCount/$catpGrpCnt);
				$BuildLevelStrength=array(0=>0,1,2,2,3,4,6,8,10,12,14,17,20,23,27,31,35,39,43,48,53);
				if($catpCount1 > 0 && ($targetBuilding[0]['f'] != 0 || $targetBuilding[0]['ft'] != 0) && $Attacker['attackdata']['ctar1']!=255) {
					if($targetBuilding[0]['ft']==40) {$tmpAAP = 1;} else {$tmpAAP = $archArtePower;}
					$need = round((($Defender['inhabitants'] < $Attacker['inhabitants'] ? min(3,pow($Attacker['inhabitants'] / $Defender['inhabitants'],0.3)) : 1) * (pow($targetBuilding[0]['lvl'],2) + $targetBuilding[0]['lvl'] + 1) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8'])) / 200) / max(1,($Attacker['attackdata']['ctar1']>=18?max(1,$stonemasonPower + $tmpAAP):1)))) + 0.5);
					$BuildingLevelMax = 20;
					if(($Defender['iscapital'] != 1 && $Attacker['attackdata']['ctar1'] <= 18) || $Attacker['attackdata']['ctar1']==36) { $BuildingLevelMax = 10; }
					if($Attacker['attackdata']['ctar1']>=5 && $Attacker['attackdata']['ctar1']<=9) { $BuildingLevelMax = 5; }
					if($Attacker['attackdata']['ctar1']==40) { $BuildingLevelMax = 100; }
					$needMax = round((($Defender['inhabitants'] < $Attacker['inhabitants'] ? min(3,pow($Attacker['inhabitants'] / $Defender['inhabitants'],0.3)) : 1) * (pow($targetBuilding[0]['lvl'],2) + $targetBuilding[0]['lvl'] + 1) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8'])) / 200) / max(1,($Attacker['attackdata']['ctar1']>=18?max(1,$stonemasonPower + $tmpAAP):1)))) + 0.5);
					//$need = round(((($catapultMoralBonus * (pow($targetBuilding[0]['lvl'],2) + $targetBuilding[0]['lvl'] + 1)) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8']))/200) / ($stonemasonPower*$tmpAAP))) + 0.5)/$breweryAttBonus);
					// Number of catapults to take down the building
					$result['had']['defender']['cataneed1'] = $need;
					if ($catpCount1>=$need){
						$targetBuilding[0]['lvl'] = 0;
					} else {
						$tmpNeed = 0;
						while ($targetBuilding[0]['lvl']>0){
							//$tmpNeed = round(((($catapultMoralBonus * (pow($targetBuilding[0]['lvl'],2) + $targetBuilding[0]['lvl'] + 1)) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8']))/200) / ($stonemasonPower*$tmpAAP))) + 0.5)/$breweryAttBonus);
							//$tmpNeed -= round(((($catapultMoralBonus * (pow($targetBuilding[0]['lvl']-1,2) + $targetBuilding[0]['lvl'])) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8']))/200) / ($stonemasonPower*$tmpAAP))) + 0.5)/$breweryAttBonus);
							$tmpNeed = ($BuildLevelStrength[$targetBuilding[0]['lvl']] - $BuildLevelStrength[$targetBuilding[0]['lvl']-1]) * $needMax / $BuildLevelStrength[$BuildingLevelMax];
							echo $tmpNeed.': '.$catpCount1.'<br/>';
							if ($catpCount1>=$tmpNeed){
								$targetBuilding[0]['lvl'] -= 1;
								$catpCount1 -= $tmpNeed;
							} else {
								break;
							}
						}
					}
				}
				if($catpCount2 > 0 && ($targetBuilding[1]['f'] != 0 || $targetBuilding[1]['ft'] != 0) && $Attacker['attackdata']['ctar2']!=255){
					if($targetBuilding[1]['ft']==40) {$tmpAAP = 1;} else {$tmpAAP = $archArtePower;}
					$need = round(((($catapultMoralBonus * (pow($targetBuilding[1]['lvl'],2) + $targetBuilding[1]['lvl'] + 1)) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8']))/200) / ($stonemasonPower*$tmpAAP))) + 0.5)/$breweryAttBonus);
					// Number of catapults to take down the building
					$result['had']['defender']['cataneed2'] = $need;
					if ($catpCount2>=$need){
						$targetBuilding[1]['lvl'] = 0;
					} else {
						while ($targetBuilding[1]['lvl']!=0){
							$tmpNeed = round(((($catapultMoralBonus * (pow($targetBuilding[1]['lvl'],2) + $targetBuilding[1]['lvl'] + 1)) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8']))/200) / ($stonemasonPower*$tmpAAP))) + 0.5)/$breweryAttBonus);
							$tmpNeed -= round(((($catapultMoralBonus * (pow($targetBuilding[1]['lvl']-1,2) + $targetBuilding[1]['lvl'])) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8']))/200) / ($stonemasonPower*$tmpAAP))) + 0.5)/$breweryAttBonus);
							if ($catpCount2>=$tmpNeed){
								$targetBuilding[1]['lvl'] -= 1;
								$catpCount2 -= $tmpNeed;
							} else {
								break;
							}
						}
					}
				}
				for($i=0;$i<=1;$i++){
					$ctar = $targetBuilding[$i];
					if ($ctar['f']||$ctar['ft']) {
						$result['casualties']['defender']['ctar'][$i] = $ctar;
						$result['casualties']['defender']['ctar'][$i]['lvl'] = $result['had']['defender']['ctar'][$i]['lvl']-$ctar['lvl'];
						$result['reminders']['defender']['buildings']['f'.$ctar['f']] = $ctar['lvl'];
						if ($ctar['lvl']==0) $result['reminders']['defender']['buildings']['f'.$ctar['f'].'t'] = 0;
					}
				}
			}
			$result['had']['defender']['wall'] = $wall;
			if($ramCount > 0 && $wall!= 0) {
				$wctp = pow(($totalAP/$totalDP),1.5);
				$wctp = ($wctp >= 1)? 1-0.5/$wctp : 0.5*$wctp;
				$wctp *= $ramCount;
				$need = round(((($moralbonus * (pow($wall,2) + $wall + 1)) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b7']))/200) / ($stonemasonPower*$tmpAAP))) + 0.5)/$breweryAttBonus);
				$result['had']['attacker']['ramneed'] = $need;
				if ($ramCount>=$need){
					$wall = 0;
				} else {
					while ($wall!=0){
						$tmpNeed = round(((($moralbonus * (pow($wall,2) + $wall + 1)) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8']))/200) / ($stonemasonPower*$tmpAAP))) + 0.5)/$breweryAttBonus);
						$tmpNeed -= round(((($moralbonus * (pow($wall-1,2) + $wall)) / (8 * (round(200 * pow(1.0205,$Attacker['smithy']['b8']))/200) / ($stonemasonPower*$tmpAAP))) + 0.5)/$breweryAttBonus);
						if ($ramCount>=$tmpNeed){
							$wall -= 1;
							$ramCount -= $tmpNeed;
						} else {
							break;
						}
					}
				}
				$result['casualties']['defender']['wall'] = $result['had']['defender']['wall'] - $wall;
				$result['reminders']['defender']['buildings']['f40'] = $wall;
				if ($wall==0) $result['reminders']['defender']['buildings']['f40t'] = 0;
				
				// Number of rams that act
				$result[8] = $wctp;
			}
			
			$chiefCount = $result['had']['attacker']['overall']['u9']
						+ $result['had']['attacker']['overall']['u19']
						+ $result['had']['attacker']['overall']['u29']
						+ $result['had']['attacker']['overall']['u39']
						+ $result['had']['attacker']['overall']['u49'];
			$chiefCount -= round($result['had']['attacker']['overall']['u9']*$result[1])+
						round($result['had']['attacker']['overall']['u19']*$result[1])+
						round($result['had']['attacker']['overall']['u29']*$result[1])+
						round($result['had']['attacker']['overall']['u39']*$result[1])+
						round($result['had']['attacker']['overall']['u49']*$result[1]);
			if ($chiefCount>0){
				if ($Defender['iscapital']){
					$result['chief']['loyaltychange'] = 0;
					$result['chief']['captured'] = 0;
					$result['chief']['msg'] = 'REPORT_CANTCAPTURECAPITAL';
				} else {
					global ${'cp'.CP};
					if (${'cp'.CP}[$Attacker['villagecount']+1]>$Attacker['cp']){
						$result['chief']['loyaltychange'] = 0;
						$result['chief']['captured'] = 0;
						$result['chief']['msg'] = 'REPORT_LOWCP';
					} else{
						$buildarray = $result['reminders']['defender']['buildings'];
						$rplvl = 0;
						for($i=19;$i<=40;$i++){
							if (($buildarray['f'.$i.'t']==25) || ($buildarray['f'.$i.'t']==26)){
								$rplvl = $buildarray['f'.$i];
							}
						}
						if ($rplvl>0){
							$result['chief']['loyaltychange'] = 0;
							$result['chief']['captured'] = 0;
							$result['chief']['msg'] = 'REPORT_CHIEFFAILED_REDIDENCEEXIST';
						} else {
							$baseLoyaltyChange = array( 1 => rand(19,25),
													2 => rand(15,21),
													3 => rand(15,20),
													4 => rand(5,10),
													5 => rand(80,120));
							$totalBaseLC = 0;
							for($i=1;$i<=5;$i++){
								$totalBaseLC += $baseLoyaltyChange[$i]
									*($result['had']['attacker']['overall']['u'.(($i*10)-1)]-
									round(($result['had']['attacker']['overall']['u'.(($i*10)-1)])*$result[1]));
							}
							$result['chief']['loyaltychange'] = $totalBaseLC + ($Attacker['hasgcel']?rand(1,5):0) - ($Defender['hasgcel']?rand(1,5):0);
							$result['chief']['loyaltyreminders'] = $Defender['loyalty'] - $result['chief']['loyaltychange'];
							if ($result['chief']['loyaltyreminders'] <= 0) {
								if ( $Attacker['avexpslots'] <= 0){
									$result['chief']['captured'] = 0;
									$result['chief']['msg'] = 'REPORT_LOWSLOT';
								} else {
									$result['chief']['captured'] = 1;
									$result['chief']['msg'] = 'REPORT_CHIEFSUCCESS';
								}
							} else {
								$result['chief']['captured'] = 0;
								$result['chief']['msg'] = 'REPORT_LOYALTYLOWERED[=]'.$Defender['loyalty'].'[=]'.$result['chief']['loyaltyreminders'];
							}
						}
					}
				}
			}
		}

		$result[6] = pow($totalAP/$totalDP*$moralbonus,$Mfactor);

		$result['casualties']['attacker']['uid'] = $Attacker['uid'];
		$result['casualties']['attacker']['tribe'] = $Attacker['tribe'];
		$result['casualties']['attacker']['alliance'] = $Attacker['alliance'];
		$result['reminders']['attacker']['uid'] = $Attacker['uid'];
		$result['reminders']['attacker']['tribe'] = $Attacker['tribe'];
		$result['reminders']['attacker']['alliance'] = $Attacker['alliance'];
		$result['casualties']['defender']['uid'] = $Defender['uid'];
		$result['casualties']['defender']['tribe'] = $Defender['tribe'];
		$result['casualties']['defender']['alliance'] = $Defender['alliance'];
		$result['reminders']['defender']['uid'] = $Defender['uid'];
		$result['reminders']['defender']['tribe'] = $Defender['tribe'];
		$result['reminders']['defender']['alliance'] = $Defender['alliance'];
		for($i=1;$i<=50;$i++){
			global ${'u'.$i};
			if ($result['had']['attacker']['u'.$i]>0){
				$result['casualties']['attacker']['u'.$i] = round($result[1]*$result['had']['attacker']['u'.$i]);
				$result['reminders']['attacker']['u'.$i] = $result['had']['attacker']['u'.$i]-$result['casualties']['attacker']['u'.$i];
			}
			if ($result['had']['defender']['u'.$i]>0){
				$result['casualties']['defender']['u'.$i] = round($result[2]*$result['had']['defender']['u'.$i]);
				$result['reminders']['defender']['u'.$i] = $result['had']['defender']['u'.$i]-$result['casualties']['defender']['u'.$i];
			}
			if($result['had']['attacker']['overall']['u'.$i]){
				$result['casualties']['attacker']['overall']['u'.$i] = round($result[1]*$result['had']['attacker']['overall']['u'.$i]);
				$result['reminders']['attacker']['overall']['u'.$i] = $result['had']['attacker']['overall']['u'.$i]-$result['casualties']['attacker']['overall']['u'.$i];
			}
			if($result['had']['defender']['overall']['u'.$i]){
				$result['casualties']['defender']['overall']['u'.$i] = round($result[2]*$result['had']['defender']['overall']['u'.$i]);
				$result['reminders']['defender']['overall']['u'.$i] = $result['had']['defender']['overall']['u'.$i]-$result['casualties']['defender']['overall']['u'.$i];
			}
			for($tc=1;$tc<=5;$tc++){
				if($result['had']['attacker']['tribedoverall'][$tc]['u'.$i]){
					$result['casualties']['attacker']['tribedoverall'][$tc]['u'.$i] = round($result[1]*$result['had']['attacker']['tribedoverall'][$tc]['u'.$i]);
					$result['reminders']['attacker']['tribedoverall'][$tc]['u'.$i] = $result['had']['attacker']['tribedoverall'][$tc]['u'.$i]-$result['casualties']['attacker']['tribedoverall'][$tc]['u'.$i];
				}
				if($result['had']['defender']['tribedoverall'][$tc]['u'.$i]){
					$result['casualties']['defender']['tribedoverall'][$tc]['u'.$i] = round($result[2]*$result['had']['defender']['tribedoverall'][$tc]['u'.$i]);
					$result['reminders']['defender']['tribedoverall'][$tc]['u'.$i] = $result['had']['defender']['tribedoverall'][$tc]['u'.$i]-$result['casualties']['defender']['tribedoverall'][$tc]['u'.$i];
				}
			}
		}
		
		if (isset($result['chief']['captured']) && $result['chief']['captured']==1){
			for($i=1;$i<=5;$i++){
				if (isset($result['reminders']['attacker']['overall']['u'.(($i*10)-1)]) && $result['reminders']['attacker']['overall']['u'.(($i*10)-1)]>=1){
					$result['reminders']['attacker']['overall']['u'.(($i*10)-1)] -= 1;
					break;
				}
			}
		}
		
		if (isset($Enforces) && count($Enforces)>0){
			$enforcesCount = count($Enforces);
			for($ec=0;$ec<$enforcesCount;$ec++){
				$enforce = $Enforces[$ec];
				$result['casualties']['enforces'][$ec]['id'] = $enforce['id'];
				$result['casualties']['enforces'][$ec]['from'] = $enforce['from'];
				$result['casualties']['enforces'][$ec]['vref'] = $enforce['vref'];
				$result['casualties']['enforces'][$ec]['uid'] = $enforce['uid'];
				$result['casualties']['enforces'][$ec]['tribe'] = $enforce['tribe'];
				$result['casualties']['enforces'][$ec]['alliance'] = $enforce['alliance'];
				$result['reminders']['enforces'][$ec]['id'] = $enforce['id'];
				$result['reminders']['enforces'][$ec]['from'] = $enforce['from'];
				$result['reminders']['enforces'][$ec]['vref'] = $enforce['vref'];
				$result['reminders']['enforces'][$ec]['uid'] = $enforce['uid'];
				$result['reminders']['enforces'][$ec]['tribe'] = $enforce['tribe'];
				$result['reminders']['enforces'][$ec]['alliance'] = $enforce['alliance'];
				for($i=1;$i<=50;$i++){
					if(!isset($result['casualties']['enforces'][$ec]['u'.$i])){$result['casualties']['enforces'][$ec]['u'.$i]=0;}
					$result['casualties']['enforces'][$ec]['u'.$i] += round($result[2]*(isset($result['had']['enforces'][$ec]['u'.$i])?$result['had']['enforces'][$ec]['u'.$i]:0));
					if(!isset($result['reminders']['enforces'][$ec]['u'.$i])){$result['reminders']['enforces'][$ec]['u'.$i]=0;}
					$result['reminders']['enforces'][$ec]['u'.$i] += (isset($result['had']['enforces'][$ec]['u'.$i])?$result['had']['enforces'][$ec]['u'.$i]:0)-$result['casualties']['enforces'][$ec]['u'.$i];
					if(!isset($result['casualties']['enforces'][$ec]['count'])){$result['casualties']['enforces'][$ec]['count']=0;}
					$result['casualties']['enforces'][$ec]['count'] += round($result[2]*(isset($result['had']['enforces'][$ec]['count'])?$result['had']['enforces'][$ec]['count']:2));
					if(!isset($result['reminders']['enforces'][$ec]['count'])){$result['reminders']['enforces'][$ec]['count']=0;}
					$result['reminders']['enforces'][$ec]['count'] += (isset($result['had']['enforces'][$ec]['count'])?$result['had']['enforces'][$ec]['count']:0)-$result['casualties']['enforces'][$ec]['count'];
					if(!isset($result['casualties']['enforces'][$ec]['pop'])){$result['casualties']['enforces'][$ec]['pop']=0;}
					$result['casualties']['enforces'][$ec]['pop'] += round($result[2]*(isset($result['had']['enforces'][$ec]['pop'])?$result['had']['enforces'][$ec]['pop']:0));
					if(!isset($result['reminders']['enforces'][$ec]['pop'])){$result['reminders']['enforces'][$ec]['pop']=0;}
					$result['reminders']['enforces'][$ec]['pop'] += (isset($result['had']['enforces'][$ec]['pop'])?$result['had']['enforces'][$ec]['pop']:0)-$result['casualties']['enforces'][$ec]['pop'];
				}
			}
		}
		
		$result['casualties']['attacker']['count'] = round($result[1]*$result['had']['attacker']['count']);
		$result['reminders']['attacker']['count'] = $result['had']['attacker']['count']-$result['casualties']['attacker']['count'];
		$result['casualties']['attacker']['pop'] = round($result[1]*$result['had']['attacker']['pop']);
		$result['reminders']['attacker']['pop'] = $result['had']['attacker']['pop']-$result['casualties']['attacker']['pop'];
		$result['casualties']['attacker']['overall']['pop'] = round($result[1]*$result['had']['attacker']['overall']['pop']);
		$result['reminders']['attacker']['overall']['pop'] = $result['had']['attacker']['overall']['pop']-$result['casualties']['attacker']['overall']['pop'];
		$result['casualties']['attacker']['overall']['count'] = round($result[1]*$result['had']['attacker']['overall']['count']);
		$result['reminders']['attacker']['overall']['count'] =$result['had']['attacker']['overall']['count']-$result['casualties']['attacker']['overall']['count'];
		for($tc=1;$tc<=5;$tc++){
			$result['casualties']['attacker']['tribedoverall'][$tc]['pop'] = round($result[1]*$result['had']['attacker']['tribedoverall'][$tc]['pop']);
			$result['reminders']['attacker']['tribedoverall'][$tc]['pop'] = $result['had']['attacker']['tribedoverall'][$tc]['pop']-$result['casualties']['attacker']['tribedoverall'][$tc]['pop'];
			$result['casualties']['attacker']['tribedoverall'][$tc]['count'] = round($result[1]*$result['had']['attacker']['tribedoverall'][$tc]['count']);
			$result['reminders']['attacker']['tribedoverall'][$tc]['count'] = $result['had']['attacker']['tribedoverall'][$tc]['count']-$result['casualties']['attacker']['tribedoverall'][$tc]['count'];
		}
		
		$result['casualties']['defender']['count'] = round($result[2]*$result['had']['defender']['count']);
		$result['reminders']['defender']['count'] = $result['had']['defender']['count']-$result['casualties']['defender']['count'];
		$result['casualties']['defender']['pop'] = round($result[2]*$result['had']['defender']['pop']);
		$result['reminders']['defender']['pop'] = $result['had']['defender']['pop']-$result['casualties']['defender']['pop'];
		$result['casualties']['defender']['overall']['pop'] = round($result[2]*$result['had']['defender']['overall']['pop']);
		$result['reminders']['defender']['overall']['pop'] = $result['had']['defender']['overall']['pop']-$result['casualties']['defender']['overall']['pop'];
		$result['casualties']['defender']['overall']['count'] = round($result[2]*$result['had']['defender']['overall']['count']);
		$result['reminders']['defender']['overall']['count'] = $result['had']['defender']['overall']['count']-$result['casualties']['defender']['overall']['count'];
		for($tc=1;$tc<=5;$tc++){
			$result['casualties']['defender']['tribedoverall'][$tc]['pop'] = round($result[2]*$result['had']['defender']['tribedoverall'][$tc]['pop']);
			$result['reminders']['defender']['tribedoverall'][$tc]['pop'] = $result['had']['defender']['tribedoverall'][$tc]['pop']-$result['casualties']['defender']['tribedoverall'][$tc]['pop'];
			$result['casualties']['defender']['tribedoverall'][$tc]['count'] = round($result[2]*$result['had']['defender']['tribedoverall'][$tc]['count']);
			$result['reminders']['defender']['tribedoverall'][$tc]['count'] = $result['had']['defender']['tribedoverall'][$tc]['count']-$result['casualties']['defender']['tribedoverall'][$tc]['count'];
		}

        if ($Attacker['hero']){
            $hero = $Attacker['hero'];
			$heroBonusExp = (($hero['extraexpgain']*HEROATTRSPEED)+($hero['itemextraexpgain']*ITEMATTRSPEED))/100;
			$expGained = ($result['casualties']['defender']['overall']['pop'])*(1+$heroBonusExp);
			$hero['experience'] += $expGained;
			$damage_health=round(100*$result[1]);
			if ($damage_health<0) $damage_health = 0;
			$hero['health'] -= $damage_health;
            if ($hero['health']<=0){
				$hero['dead'] = 1;
				$hero['health'] = 0;
				$result['casualties']['attacker']['hero'] = $hero;
				$result['casualties']['attacker']['tribedoverall'][$Attacker['tribe']]['hero'][] = $hero;
				$result['casualties']['attacker']['overall']['hero'][] = $hero;
            } else {
				$heroresist = $hero['extraresist']+$hero['itemextraresist'];
				$hero['health'] -= $heroresist;
				$result['reminders']['attacker']['hero'] = $hero;
				$result['reminders']['attacker']['tribedoverall'][$Attacker['tribe']]['hero'][] = $hero;
				$result['reminders']['attacker']['overall']['hero'][] = $hero;
			}
			
        }
		

        if (isset($Defender['hero'])){
            $hero = $Defender['hero'];
			$heroBonusExp = $hero['extraexpgain']+$hero['itemextraexpgain'];
			$expGained = ($result['casualties']['attacker']['overall']['pop'])*(1+$heroBonusExp);
			$hero['experience'] += $expGained;
			$damage_health=round(100*$result[2]);
			if ($damage_health<0) $damage_health = 0;
			$hero['health'] -= $damage_health;
            if ($hero['health']<=0){
				$hero['dead'] = 1;
				$hero['health'] = 0;
				$result['casualties']['defender']['hero'] = $hero;
				$result['casualties']['defender']['tribedoverall'][$Defender['tribe']]['hero'][] = $hero;
				$result['casualties']['defender']['overall']['hero'][] = $hero;
            } else {
				$heroresist = $hero['extraresist']+$hero['itemextraresist'];
				$hero['health'] -= $heroresist;
				$result['reminders']['defender']['hero'] = $hero;
				$result['reminders']['defender']['tribedoverall'][$Defender['tribe']]['hero'][] = $hero;
				$result['reminders']['defender']['overall']['hero'][] = $hero;
			}
			
        }
		
		if (isset($Enforces) && count($Enforces)>0) {
			$enforcesCount = count($Enforces);
			for($ec=0;$ec<$enforcesCount;$ec++){
				$enforce = $Enforces[$ec];
				if($enforce['hero']) {
					$hero = $enforce['hero'];
					$heroBonusExp = $hero['extraexpgain']+$hero['itemextraexpgain'];
					$expGained = ($result['casualties']['attacker']['overall']['pop'])*(1+$heroBonusExp);
					$hero['experience'] += $expGained;
					$damage_health=round(100*$result[2]);
					if ($damage_health<0) $damage_health = 0;
					$hero['health'] -= $damage_health;
					if ($hero['health']<=0){
						$hero['dead'] = 1;
						$hero['health'] = 0;
						$result['casualties']['enforce'][$ec]['hero'] = $hero;
						$result['casualties']['defender']['tribedoverall'][$enforce['tribe']]['hero'][] = $hero;
						$result['casualties']['defender']['overall']['hero'][] = $hero;
					} else{
						$heroresist = $hero['extraresist']+$hero['itemextraresist'];
						$hero['health'] -= $heroresist;
						$result['reminders']['enforce'][$ec]['hero'] = $hero;
						$result['reminders']['defender']['tribedoverall'][$enforce['tribe']]['hero'][] = $hero;
						$result['reminders']['defender']['overall']['hero'][] = $hero;
					}
				}
			}
		}
		
		if($Attacker['attackdata']['attack_type'] == 3) {
			if((!isset($result['chief']['captured']) || $result['chief']['captured']==0) && isset($Defender['tocapturearties']) && !empty($Defender['tocapturearties']) && isset($result['reminders']['attacker']['hero'])){
				$dBuildingArray = $result['reminders']['defender']['buildings'];
				$dTreasury = 0;
				for($i=19;$i<=39;$i++){
					if($dBuildingArray['f'.$i.'t']==27){
						$dTreasury = $dBuildingArray['f'.$i];
						break;
					}
				}
				if ($dTreasury<=0){
					$aBuildingArray = $Attacker['buildings'];
					$aTreasury = 0;
					for($i=19;$i<=39;$i++){
						if($aBuildingArray['f'.$i.'t']==27){
							$aTreasury = $aBuildingArray['f'.$i];
							break;
						}
					}
					foreach($Defender['tocapturearties'] as $art){
						if (($aTreasury>=10 && $art['size']==1) || $aTreasury>=20){
							$result['hero']['claimarties'][] = $art; break;
						}
					}
					$claimedArtCount = 0;
					if(isset($result['hero'])) $claimedArtCount = count($result['hero']['claimarties']);
					if ($claimedArtCount>0){
						$result['hero']['msg'] = 'REPORT_ARTIESCLAIMED[=]'.$claimedArtCount.''; 
					}
				}
			}
		}
		
		if($Attacker['attackdata']['attack_type'] == 4) {
			if ($Defender['isoasis'] && $result['reminders']['defender']['overall']['count']<=0){
				$toOases = $database->getOMInfo($Attacker['attackdata']['to']);
				$fromVillage = $database->getMInfo($Attacker['attackdata']['from']);
				$difx = $toOases['x']-$fromVillage['x'];$dify = $toOases['y']-$fromVillage['y'];
				$distance = sqrt(($difx*$difx)+($dify*$dify));
				if ($distance<4.9497474683058326708059105347339){
					if (isset($result['reminders']['attacker']['hero'])) {
						if ($Attacker['avoasisslots']<=0){
							$result['hero']['loyaltychange'] = 0;
							$result['hero']['captured'] = 0;
							$result['hero']['msg'] = 'REPORT_HEROMANSIONLOWSLOT';
						} else {
							if ($Defender['uid'] == 3){$result['hero']['loyaltychange'] = 100;}
							else {$result['hero']['loyaltychange'] = floor(100 / min(3,(4-$database->VillageOasisCount($Attacker['attackdata']['to']))));}
							$result['hero']['loyaltyreminders'] = $Defender['loyalty']-$result['hero']['loyaltychange'];
							if ($result['hero']['loyaltyreminders']>0){
								$result['hero']['captured'] = 0;
								$result['hero']['msg'] = 'REPORT_LOYALTYLOWERED['.$Defender['loyalty'].']['.$result['hero']['loyaltyreminders'].']';
							} else {
								$result['hero']['captured'] = 1;
								$result['hero']['msg'] = 'REPORT_SUCCESSOASISCAPTURED';
							}
						}
					}
				}
			}
		}

		// Work out bounty
        $max_bounty = 0;
		for($i=1;$i<=50;$i++) {
			if (isset($result['casualties']['attacker']['u'.$i])) 
				$max_bounty += ($Attacker['u'.$i]-$result['casualties']['attacker']['u'.$i])*${'u'.$i}['cap'];
		}
		
		if($Attacker['hero']){
			$hero = $Attacker['hero'];
			$heroBonusRob = $hero['rob']*HEROATTRSPEED+$hero['itemrob']*ITEMATTRSPEED;
			$max_bounty = $max_bounty*(1+$heroBonusRob);
		}
		$max_bounty = floor($max_bounty);
		$result['reminders']['attacker']['bounty_cap'] = $max_bounty;
		// calculate rob
		if ($result['had']['defender']['res_array']){
			if (!$Defender['isoasis']){
				// get toatal cranny value:
				global $bid23;
				$buildarray = $result['reminders']['defender']['buildings'];
				$cranny_eff = 0;    
				for($i=19;$i<=39;$i++){
					if($buildarray['f'.$i.'t']==23){
						if($buildarray['f'.$i.'']>0) $cranny_eff += $bid23[$buildarray['f'.$i.'']]['attri'];
					}
				}
				$cranny_eff *= STORAGE_MULTIPLIER*$confArteEff;
				//cranny efficiency
				$atk_bonus = ($Attacker['tribe'] == 2)? (4/5) : 1;
				$def_bonus = ($Defender['tribe'] == 3)? 2 : 1;
				$cranny_eff = $cranny_eff * $atk_bonus *$def_bonus;
			} else {
				$cranny_eff = 0;
			}
			$had_array = $result['had']['defender']['res_array'];
			foreach($had_array as $key=>$value) { $av_array[$key] = max($value-$cranny_eff,0);}
			$totalAvRes = $av_array['wood'] + $av_array['clay'] + $av_array['iron'] + $av_array['crop'];
			$steal = array('wood'=>0, 'clay'=>0, 'iron'=>0, 'crop'=>0);
			$bounty = $max_bounty;
			if ($bounty>0){
				if ($bounty>=$totalAvRes){
					$steal = $av_array;
				} else {
					while($bounty>0){
						$key = array_search(max($av_array),$av_array);
						$steal[$key] += 1;
						$av_array[$key] -= 1;
						$bounty -= 1;
					}
				}
			}
			$result['casualties']['defender']['res_array'] = $steal;
			$result['reminders']['defender']['res_array'] = $av_array;
			$result['reminders']['attacker']['bounty_array'] = $steal;
		}
		return $result;
	}	
};

$battle = new Battle;
?>
