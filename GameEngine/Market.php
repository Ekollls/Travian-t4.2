<?php 
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
class Market { 
     
    public $onsale,$onmarket,$sending,$recieving,$return = array(); 
    public $maxcarry,$merchant,$used; 
     
    public function procMarket($post) { 
	global $session;
        $this->loadMarket(); 
        if(isset($_SESSION['loadMarket'])) { 
            $this->loadOnsale(); 
            unset($_SESSION['loadMarket']); 
        } 
        if(isset($post['ft'])) { 
            switch($post['ft']) { 
                case "mk1":
				$repeat = 1;
				if($session->goldclub) {
					if($post['repeat'] > 0 && $post['repeat'] < 4) {
						$repeat = $post['repeat'];
					}
				}
				for($i=1;$i<=$repeat;$i++) {
					$this->sendResource($post);
				}
		        header("Location: build.php?id=".$post['id']); exit;
                break;
                case "mk2":
                $this->addOffer($post);
                break;
                case "mk3":
                $this->tradeResource($post);
                break;
            } 
        } 
    } 
     
    public function procRemove($get) { 
        global $database,$village,$session; 
        if(isset($get['t']) && $get['t'] == 1) { 
            $this->filterNeed($get); 
        } 
        else if(isset($get['t']) && $get['t'] ==2 && isset($get['a']) && $get['a'] == 5 && isset($get['del'])) { 
            //GET ALL FIELDS FROM MARKET 
            $type = $database->getMarketField($village->wid,"gtype"); 
            $amt = $database->getMarketField($village->wid,"gamt"); 
            $vref = $village->wid; 
            $database->getResourcesBack($vref,$type,$amt); 
            $database->addMarket($village->wid,$get['del'],0,0,0,0,0,0,1); 
            header("Location: build.php?id=".$get['id']."&t=".$get['t']); exit;
        } 
        if(isset($get['t']) && $get['t'] == 1 && isset($get['a']) && $get['a'] == $session->mchecker && !isset($get['del'])) { 
            $session->changeChecker(); 
            $this->acceptOffer($get); 
        } 
    } 
     
    public function merchantAvail() { 
        return $this->merchant - $this->used; 
    } 
     
    private function loadMarket() { 
        global $session,$building,$bid28,$bid17,$database,$village; 
        $this->recieving = $database->getMovement(0,$village->wid,1); 
        $this->sending = $database->getMovement(0,$village->wid,0); 
        $this->return  = $database->getMovement(1,$village->wid,1); 
        $this->merchant = ($building->getTypeLevel(17) > 0)? $bid17[$building->getTypeLevel(17)]['attri'] : 0; 
        $this->used = $database->totalMerchantUsed($village->wid); 
        $this->onmarket = $database->getMarket($village->wid,0); 
        $this->maxcarry = ($session->tribe == 1)? 500 : (($session->tribe == 2)? 1000 : 750);
		$this->maxcarry *= SPEED;
	if (STORAGE_MULTIPLIER>0) $this->maxcarry *= STORAGE_MULTIPLIER;
        if($building->getTypeLevel(28) != 0) { 
            $this->maxcarry *= $bid28[$building->getTypeLevel(28)]['attri'] / 100; 
        } 
    } 
     
    private function sendResource($post) { 
        global $database,$village,$session,$generator,$logging; 
        $wtrans = (isset($post['r1']) && $post['r1'] != "")? $post['r1'] : 0; 
        $ctrans = (isset($post['r2']) && $post['r2'] != "")? $post['r2'] : 0; 
        $itrans = (isset($post['r3']) && $post['r3'] != "")? $post['r3'] : 0; 
        $crtrans = (isset($post['r4']) && $post['r4'] != "")? $post['r4'] : 0; 
        $wtrans = str_replace("-", "", $wtrans); 
        $ctrans = str_replace("-", "", $ctrans); 
        $itrans = str_replace("-", "", $itrans); 
        $crtrans = str_replace("-", "", $crtrans); 
        $availableWood = $database->getWoodAvailable($village->wid); 
        $availableClay = $database->getClayAvailable($village->wid); 
        $availableIron = $database->getIronAvailable($village->wid); 
        $availableCrop = $database->getCropAvailable($village->wid); 
        if($availableWood >= $post['r1'] AND $availableClay >= $post['r2'] AND $availableIron >= $post['r3'] AND $availableCrop >= $post['r4']){ 
         
        $resource = array($wtrans,$ctrans,$itrans,$crtrans); 
        $reqMerc = ceil((array_sum($resource)-0.1)/$this->maxcarry); 

        if($this->merchantAvail() != 0 && $reqMerc <= $this->merchantAvail()) { 
                if(isset($post['dname']) && $post['dname'] != "") { 
                    $id = $database->getVillageByName($post['dname']); 
                    $coor = $database->getCoor($id); 
                } 
                if(isset($post['x']) && isset($post['y']) && $post['x'] != "" && $post['y'] != "") { 
                    $coor = array('x'=>$post['x'], 'y'=>$post['y']); 
                    $id = $generator->getBaseID($coor['x'],$coor['y']); 
                }else if(isset($post['dname']) && $post['dname'] != "") { 
                    $id = $database->getVillageByName($post['dname']); 
                    $coor = $database->getCoor($id); 
                } 
                if($database->getVillageState($id)) {
					$resdata = "".$resource[0].",".$resource[1].",".$resource[2].",".$resource[3]."";
					$timetaken = $generator->procDistanceTime($village->coor,$coor,$session->tribe,0); 
	                $reference = $database->sendResource($resource[0],$resource[1],$resource[2],$resource[3],$reqMerc); 
		            $database->modifyResource($village->wid,$resource[0],$resource[1],$resource[2],$resource[3],0); 
			        $database->addMovement(0,$village->wid,$id,$reference,$resdata,time()+$timetaken); 
				    $logging->addMarketLog($village->wid,1,array($resource[0],$resource[1],$resource[2],$resource[3],$id));
				}
        } 
        header("Location: build.php?id=".$post['id']); exit;
    } else {} 
    } 
     
    private function addOffer($post) { 
        global $database,$village,$session;
		$post['rid1'] = intval($post['rid1']);
		if($post['rid1']>4) $post['rid1'] = 4;
		if($post['rid1']<1) $post['rid1'] = 1;
		$post['rid2'] = intval($post['rid2']);
		if($post['rid2']>4) $post['rid2'] = 4;
		if($post['rid2']<1) $post['rid2'] = 1;
		if($post['rid1']==$post['rid2']) $post['rid2'] += 1;
		if($post['rid2']>4) $post['rid2'] = 1;
		$post['m1'] = intval($post['m1']);
		if($post['m1']<1) $post['m1'] = 1;
		$post['m2'] = intval($post['m2']);
		if($post['m2']<1) $post['m2'] = 1;
        $wood = ($post['rid1'] == 1)? $post['m1'] : 0; 
        $clay = ($post['rid1'] == 2)? $post['m1'] : 0; 
        $iron = ($post['rid1'] == 3)? $post['m1'] : 0; 
        $crop = ($post['rid1'] == 4)? $post['m1'] : 0; 
        $availableWood = $database->getWoodAvailable($village->wid); 
        $availableClay = $database->getClayAvailable($village->wid); 
        $availableIron = $database->getIronAvailable($village->wid); 
        $availableCrop = $database->getCropAvailable($village->wid);
        $resAvailability = ($wood==0 or $availableWood >= $wood) and
							($clay==0 or $availableClay >= $clay) and
							($iron==0 or $availableIron >= $iron) and
							($iron==0 or $availableCrop >= $crop) and
							(($wood+$clay+$iron+$crop)>0);
		
        if($resAvailability){ 
			$reqMerc = 1; 
			if(($wood+$clay+$iron+$crop) > $this->maxcarry) { 
				$reqMerc = round(($wood+$clay+$iron+$crop)/$this->maxcarry); 
				if(($wood+$clay+$iron+$crop) > $this->maxcarry*$reqMerc) { 
					$reqMerc += 1; 
				}
			}
			if($this->merchantAvail() != 0 && $reqMerc <= $this->merchantAvail()) {
				if ($database->modifyResource($village->wid,$wood,$clay,$iron,$crop,0)) {
					$time = 0;
					if(isset($_POST['d1'])) {
						$time = $_POST['d2'] * 3600;
					}
					$alliance = (isset($post['ally']) && $post['ally'] == 1)? $session->userinfo['alliance'] : 0;
					$database->addMarket($village->wid,$post['rid1'],$post['m1'],$post['rid2'],$post['m2'],$time,$alliance,$reqMerc,0);
				}
			}
			header("Location: build.php?id=".$post['id']."&t=".$post['t']);exit;
		} else {}
    }
     
    private function acceptOffer($get) { 
        global $database,$village,$session,$logging,$generator; 
        $infoarray = $database->getMarketInfo($get['g']); 
        $reqMerc = 1; 
        if($infoarray['wamt'] > $this->maxcarry) { 
            $reqMerc = round($infoarray['wamt']/$this->maxcarry); 
            if($infoarray['wamt'] > $this->maxcarry*$reqMerc) { 
                $reqMerc += 1; 
            } 
        } 
		$myresource = $hisresource = array(1=>0,0,0,0); 
		$myresource[$infoarray['wtype']] = $infoarray['wamt']; 
		$mysendid = $database->sendResource($myresource[1],$myresource[2],$myresource[3],$myresource[4],$reqMerc); 
		$hisresource[$infoarray['gtype']] = $infoarray['gamt']; 
		$hissendid = $database->sendResource($hisresource[1],$hisresource[2],$hisresource[3],$hisresource[4],$infoarray['merchant']); 
		$hiscoor = $database->getCoor($infoarray['vref']); 
		$mytime = $generator->procDistanceTime($village->coor,$hiscoor,$session->tribe,0); 
		$targettribe = $database->getUserField($database->getVillageField($infoarray['vref'],"owner"),"tribe",0); 
		$histime = $generator->procDistanceTime($hiscoor,$village->coor,$targettribe,0); 
		$database->addMovement(0,$village->wid,$infoarray['vref'],$mysendid,'',$mytime+time()); 
		$database->addMovement(0,$infoarray['vref'],$village->wid,$hissendid,'',$histime+time()); 
		$resource = array(1=>0,0,0,0); 
		$resource[$infoarray['wtype']] = $infoarray['wamt']; 
		$database->modifyResource($village->wid,$resource[1],$resource[2],$resource[3],$resource[4],0); 
		$database->setMarketAcc($get['g']); 
		 
		$database->removeAcceptedOffer($get['g']); 
		$logging->addMarketLog($village->wid,2,array($infoarray['vref'],$get['g'])); 
		 
		 
		header("Location: build.php?id=".$get['id']."&t=".$get['t']); exit;
    } 
     
    private function loadOnsale() { 
        global $database,$village,$session,$multisort,$generator; 
        $displayarray = $database->getMarket($village->wid,1); 
        $holderarray = array(); 
        foreach($displayarray as $value) { 
            $targetcoor = $database->getCoor($value['vref']); 
            $duration = $generator->procDistanceTime($targetcoor,$village->coor,$session->tribe,0); 
            if($duration <= $value['maxtime'] || $value['maxtime'] == 0) { 
                  $value['duration'] = $duration; 
                  array_push($holderarray,$value); 
            } 
        } 
        $this->onsale = $multisort->sorte($holderarray, "'duration'", true, 2); 
    } 
     
    private function filterNeed($get) { 
        if(isset($get['v']) || isset($get['s']) || isset($get['b'])) { 
            $holder = $holder2 = array(); 
            if(isset($get['v']) && $get['v'] == "1:1") { 
                foreach($this->onsale as $equal) { 
                    if($equal['wamt'] <= $equal['gamt']) { 
                        array_push($holder,$equal); 
                    } 
                } 
            } 
            else { 
                $holder = $this->onsale; 
            } 
            foreach($holder as $sale) { 
                if(isset($get['s']) && isset($get['b'])) { 
                    if($sale['gtype'] == $get['s'] && $sale['wtype'] == $get['b']) { 
                        array_push($holder2,$sale); 
                    } 
                } 
                else if(isset($get['s']) && !isset($get['b'])) { 
                    if($sale['gtype'] == $get['s']) { 
                        array_push($holder2,$sale); 
                    } 
                } 
                else if(isset($get['b']) && !isset($get['s'])) { 
                    if($sale['wtype'] == $get['b']) { 
                        array_push($holder2,$sale); 
                    } 
                } 
                else { 
                    $holder2 = $holder; 
                } 
            } 
            $this->onsale = $holder2; 
        } 
        else {  
         $this->loadOnsale(); 
        } 
    } 
     
    private function tradeResource($post) { 
        global $session,$database,$village; 
        if($session->userinfo['gold'] >= 3) { 
            //kijken of ze niet meer gs invoeren dan ze hebben
			$wholeM = $post['m2'][0]+$post['m2'][1]+$post['m2'][2]+$post['m2'][3];
			$wholeAvailable = (round($village->awood)+round($village->aclay)+round($village->airon)+round($village->acrop));
			
			$mArray = array('wood'=>$post['m2'][0],'clay'=>$post['m2'][1],'iron'=>$post['m2'][2],'crop'=>$post['m2'][3]);
			$dif = $wholeAvailable - $wholeM;
			$sign = ($dif<0?-1:($dif==0?0:1));
			while($dif!=0){
				$key = array_search(max($mArray),$mArray);
				$mArray[$key] += $sign;
				$dif -= $sign;
			}
            $database->setVillageField($village->wid,"wood",$mArray['wood']); 
			$database->setVillageField($village->wid,"clay",$mArray['clay']); 
			$database->setVillageField($village->wid,"iron",$mArray['iron']); 
			$database->setVillageField($village->wid,"crop",$mArray['crop']); 
			$database->query("UPDATE ".TB_PREFIX."users set gold = gold-3,usedgold=usedgold+3 where `username`='".$session->username."'"); 
			header("Location: build.php?id=".$post['id']."&t=3&c"); exit;
        } else {         
            header("Location: build.php?id=".$post['id']."&t=3");exit; 
        } 
    } 
     
}; 
$market = new Market; 
?>
