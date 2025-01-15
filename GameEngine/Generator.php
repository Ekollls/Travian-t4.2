<?php
date_default_timezone_set('Asia/Tehran');
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

class Generator {
	
	public function generateRandID(){
		return md5($this->generateRandStr(16));
	}

	public function generateRandStr($length){
		$randstr = "";
		for($i=0; $i<$length; $i++){
			$randnum = mt_rand(0,61);
			if($randnum < 10){$randstr .= chr($randnum+48);}else if($randnum < 36){$randstr .= chr($randnum+55);}else{$randstr .= chr($randnum+61);}
      		}
		return $randstr;
	}
   
	public function encodeStr($str,$length) {
		$encode = md5($str);
		return substr($encode,0,$length);
	}
   
	public function procDistance($from,$to) {
		global $database;
		$xdistance = ABS($to['x'] - $from['x']);
		if($xdistance > WORLD_MAX) {
			$xdistance = (2 * WORLD_MAX + 1) - $xdistance;
		}
		$ydistance = ABS($to['y'] - $from['y']);
		if($ydistance > WORLD_MAX) {
			$ydistance = (2 * WORLD_MAX + 1) - $ydistance;
		}
		$distance = SQRT(POW($xdistance,2)+POW($ydistance,2));
		return $distance;
	}
   
	public function procDistanceTime($from,$to,$ref,$mode,$hero=array(),$isreturn=false) {
		global $bid28,$bid14,$building,$database;
		$distance = $this->procDistance($from,$to);
		$fromID = $this->getBaseID($from['x'],$from['y']);
		$resarray = $database->getResourceLevel($fromID);
		if(!$mode) {
			if($ref==1){$speed = 16;}else if($ref==2) {$speed = 12;}else if($ref==3) {$speed = 24;}elseif($ref==300){$speed = 5;}else{$speed = 1;}
		}
		else {
			$speed = $ref;
			$isoasis = $database->isVillageOases($fromID);
			if ($distance>TS_THRESHOLD){
				if(!$isoasis && $this->getsort_typeLevel(14,$resarray) != 0) {
					$speed=$speed*((TS_THRESHOLD+($distance-TS_THRESHOLD)*$bid14[$this->getsort_typeLevel(14,$resarray)]['attri']/100)/$distance);
				}
				if(!empty($hero)){
					$heroBonusForLongWaySpeed = ($hero['longwaymspeed']*HEROATTRSPEED+$hero['itemlongwaymspeed']*ITEMATTRSPEED+100)/100;
					$speed=$speed*((TS_THRESHOLD+($distance-TS_THRESHOLD)*$heroBonusForLongWaySpeed)/$distance);
				}
			}
			if(!empty($hero) && $isreturn){
				$speed = $speed*(($hero['returnmspeed']*HEROATTRSPEED+$hero['itemreturnmspeed']*ITEMATTRSPEED+100)/100);
			}
			$artSpeed = $database->getArtEffMSpeed($fromID);
			$speed *= $artSpeed;
		}
		return round(($distance/$speed) * 3600 / INCREASE_SPEED);
	}
	
	private function getsort_typeLevel($tid,$resarray) {
        global $village;
        $keyholder = array();
        foreach(array_keys($resarray,$tid) as $key) {
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
                    array_push($temparray,$resarray['f'.$keyholder[$i]]);
                }
                foreach ($temparray as $key => $val) {
                    if ($val == max($temparray)) 
                    $target = $key; 
                }
            }
            else {
                for($i=0;$i<=$element-1;$i++) {
                    //if($resarray['f'.$keyholder[$i]] != $this->getsort_typeMaxLevel($tid)) {
                    //    $target = $i;
                    //}
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
            return $resarray['f'.$keyholder[$target]];
        }
        else {
            return 0;
        }
    }
   
	public function getTimeFormat($sec) {
		$min = 0;
		$hr = 0;
		$days = 0;
		while($sec >= 60) :
			$sec -= 60;
			$min += 1;
		endwhile;
		while ($min >= 60) :
			$min -= 60;
			$hr += 1;
		endwhile;
		if ($min < 10) {
			$min = "0".$min;
		}
		if($sec < 10) {
			$sec = "0".$sec;
		}
		return $hr.":".$min.":".$sec;
	}

	public function getMilisecFormat($ms) {
		$sec = intval(floor($ms/1000)) ;
		$ms = $ms%1000;
		$min = intval(floor($sec/60)) ;
		$sec = $sec%60;
		$hr = intval(floor($min/60)) ;
		$min = $min%60;

		$res = sprintf("%02d:%02d:%02d (+ %d ms)",$hr,$min,$sec,$ms);
		
		return $res;
	}
	
	public function procMtime($time) {
		/*$timezone = 7;
		switch($timezone) {
			case 7:
			$time -= 3600;
			break;
		}*/
		$today = date('d',time())-1;
		$todayy = date('d',time())-2;
		
		if (date('Y/m/d',time()) == date('Y/m/d',$time)) {
		//if ((time()-$time) < 24*60*60 && (time()-$time) > 0) {
			$day = TODAY;
		}elseif($today == date('d',$time)){
			$day = YESTERDAY;
		}elseif($todayy == date('d',$time)){
			$day = BYESTERDAY;
		}
		else {
			$pref = 3;
			switch($pref) {
			case 1:
			$day = date("m/j/y",$time);
			break;
			case 2:
			$day = date("j/m/y",$time);
			break;
			case 3:
			$day = date("j/m/y",$time);
			break;
			default:
			$day = date("y/m/j",$time);
			break;
			}
		}
		$new = date("H:i:s",$time);
		return array($day,$new);
	}
   
	public function getBaseID($x,$y) {
	return ((WORLD_MAX-$y) * (WORLD_MAX*2+1)) + (WORLD_MAX +$x + 1);
	}
   
	public function getMapCheck($wref) {
		return substr(md5($wref),5,2);
	}
   
	public function pageLoadTimeStart() {
		$starttime = microtime();
		$startarray = explode(" ", $starttime);
		//$starttime = $startarray[1] + $startarray[0];
		return $startarray[0];
	}

	public function pageLoadTimeEnd() {
		$endtime = microtime();
		$endarray = explode(" ", $endtime);
		//$endtime = $endarray[1] + $endarray[0];
		return $endarray[0];
	}
	
};
$generator = new Generator;
