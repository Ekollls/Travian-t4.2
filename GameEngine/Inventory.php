<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include "Data/hero_full.php";

if($_POST && $_POST['a']=='inventory'){
	$data = $_POST;
	$data['amount'] = intval($data['amount']);
	$data['id'] = intval($data['id']);
	if (isset($data['amount']) && ($data['amount']<0)) $data['amount'] = 1;
	if (!isset($data['amount'])) $data['amount'] = 1;
	$uid = $session->uid;
	$heroFace = $database->getHeroFace($uid);
	$heroData = $database->getHero($uid);
	$itemData = $database->getHeroItem($data['id']);
	if($itemData['num']>0 && $itemData['proc']==0){
		if($data['amount'] > $itemData['num']) $data['amount'] = $itemData['num'];
		if ($itemData['uid']==$session->uid){
			switch ($itemData['btype']){
				case 1:
					if ($data['amount']>1) $data['amount'] = 1;
					if($data['amount'] >= $itemData['num']){
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					if($heroFace['helmet']!=0){
						$database->modifyHeroItem($heroFace['helmet'], 'proc', 0, 0);
						$database->modifyHeroItem($heroFace['helmet'], 'num', 1, 1);
						$currentItem = $database->getHeroItem($heroFace['helmet']);
						switch  ($currentItem['type']){
							case 1:	$database->modifyHero($uid,0,"itemextraexpgain",15,2);	break;
							case 2:	$database->modifyHero($uid,0,"itemextraexpgain",20,2);	break;
							case 3:	$database->modifyHero($uid,0,"itemextraexpgain",25,2);	break;
							case 4:	$database->modifyHero($uid,0,"itemautoregen",10,2);	break;
							case 5:	$database->modifyHero($uid,0,"itemautoregen",15,2);	break;
							case 6:	$database->modifyHero($uid,0,"itemautoregen",20,2);	break;
							case 7:	$database->modifyHero($uid,0,"itemcpproduction",5,2);	break;
							case 8:	$database->modifyHero($uid,0,"itemcpproduction",10,2);	break;
							case 9:	$database->modifyHero($uid,0,"itemcpproduction",15,2);	break;
							case 10: $database->modifyHero($uid,0,"itemcavalrytrain",10,2);	break;
							case 11: $database->modifyHero($uid,0,"itemcavalrytrain",15,2);	break;
							case 12: $database->modifyHero($uid,0,"itemcavalrytrain",20,2);	break;
							case 13: $database->modifyHero($uid,0,"iteminfantrytrain",10,2); break;
							case 14: $database->modifyHero($uid,0,"iteminfantrytrain",15,2); break;
							case 15: $database->modifyHero($uid,0,"iteminfantrytrain",20,2); break;
						}
					}
					switch  ($itemData['type']){
						case 1:	$database->modifyHero($uid,0,"itemextraexpgain",15,1);	break;
						case 2:	$database->modifyHero($uid,0,"itemextraexpgain",20,1);	break;
						case 3:	$database->modifyHero($uid,0,"itemextraexpgain",25,1);	break;
						case 4:	$database->modifyHero($uid,0,"itemautoregen",10,1);	break;
						case 5: $database->modifyHero($uid,0,"itemautoregen",15,1);	break;
						case 6:	$database->modifyHero($uid,0,"itemautoregen",20,1);	break;
						case 7:	$database->modifyHero($uid,0,"itemcpproduction",5,1);	break;
						case 8:	$database->modifyHero($uid,0,"itemcpproduction",10,1);	break;
						case 9:	$database->modifyHero($uid,0,"itemcpproduction",15,1);	break;
						case 10: $database->modifyHero($uid,0,"itemcavalrytrain",10,1);	break;
						case 11: $database->modifyHero($uid,0,"itemcavalrytrain",15,1);	break;
						case 12: $database->modifyHero($uid,0,"itemcavalrytrain",20,1);	break;
						case 13: $database->modifyHero($uid,0,"iteminfantrytrain",10,1); break;
						case 14: $database->modifyHero($uid,0,"iteminfantrytrain",15,1); break;
						case 15: $database->modifyHero($uid,0,"iteminfantrytrain",20,1); break;
					}
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					$database->modifyHeroFace($uid, 'helmet', $itemData['id']);
				break;
		
				case 2:
					if ($data['amount']>1) $data['amount'] = 1;
					if($data['amount'] >= $itemData['num']){
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					if($heroFace['body']!=0){
						$database->modifyHeroItem($heroFace['body'], 'proc', 0, 0);
						$database->modifyHeroItem($heroFace['body'], 'num', 1, 1);
						$currentItem = $database->getHeroItem($heroFace['body']);
						switch  ($currentItem['type']){
							case 82: $database->modifyHero($uid,0,"itemautoregen",20,2); break;
							case 83: $database->modifyHero($uid,0,"itemautoregen",30,2); break;
							case 84: $database->modifyHero($uid,0,"itemautoregen",40,2); break;
							case 85: $database->modifyHero($uid,0,"itemautoregen",10,2); $database->modifyHero($uid,0,"itemextraresist",4,2); break;
							case 86: $database->modifyHero($uid,0,"itemautoregen",15,2); $database->modifyHero($uid,0,"itemextraresist",6,2); break;
							case 87: $database->modifyHero($uid,0,"itemautoregen",20,2); $database->modifyHero($uid,0,"itemextraresist",8,2); break;
							case 88: $database->modifyHero($uid,0,"itemfs",500,2); break;
							case 89: $database->modifyHero($uid,0,"itemfs",1000,2); break;
							case 90: $database->modifyHero($uid,0,"itemfs",1500,2); break;
							case 91: $database->modifyHero($uid,0,"itemfs",250,2); $database->modifyHero($uid,0,"itemextraresist",3,2); break;
							case 92: $database->modifyHero($uid,0,"itemfs",500,2); $database->modifyHero($uid,0,"itemextraresist",4,2); break;
							case 93: $database->modifyHero($uid,0,"itemfs",750,2); $database->modifyHero($uid,0,"itemextraresist",5,2); break;
						}
					}
					switch  ($itemData['type']){
						case 82: $database->modifyHero($uid,0,"itemautoregen",20,1); break;
						case 83: $database->modifyHero($uid,0,"itemautoregen",30,1); break;
						case 84: $database->modifyHero($uid,0,"itemautoregen",40,1); break;
						case 85: $database->modifyHero($uid,0,"itemautoregen",10,1); $database->modifyHero($uid,0,"itemextraresist",4,1); break;
						case 86: $database->modifyHero($uid,0,"itemautoregen",15,1); $database->modifyHero($uid,0,"itemextraresist",6,1); break;
						case 87: $database->modifyHero($uid,0,"itemautoregen",20,1); $database->modifyHero($uid,0,"itemextraresist",8,1); break;
						case 88: $database->modifyHero($uid,0,"itemfs",500,1); break;
						case 89: $database->modifyHero($uid,0,"itemfs",1000,1); break;
						case 90: $database->modifyHero($uid,0,"itemfs",1500,1); break;
						case 91: $database->modifyHero($uid,0,"itemfs",250,1); $database->modifyHero($uid,0,"itemextraresist",3,1); break;
						case 92: $database->modifyHero($uid,0,"itemfs",500,1); $database->modifyHero($uid,0,"itemextraresist",4,1); break;
						case 93: $database->modifyHero($uid,0,"itemfs",750,1); $database->modifyHero($uid,0,"itemextraresist",5,1); break;
					}
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					$database->modifyHeroFace($uid, 'body', $itemData['id']);
				break;
		
				case 3:
					if ($data['amount']>1) $data['amount'] = 1;
					if($data['amount'] >= $itemData['num']){
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					if($heroFace['leftHand']!=0){
						$database->modifyHeroItem($heroFace['leftHand'], 'proc', 0, 0);
						$database->modifyHeroItem($heroFace['leftHand'], 'num', 1, 1);
						$currentItem = $database->getHeroItem($heroFace['leftHand']);
						switch  ($currentItem['type']){
							case 61: $database->modifyHero($uid,0,"itemreturnmspeed",30,2); break;
							case 62: $database->modifyHero($uid,0,"itemreturnmspeed",40,2); break;
							case 63: $database->modifyHero($uid,0,"itemreturnmspeed",50,2); break;
							case 64: $database->modifyHero($uid,0,"itemaccountmspeed",30,2); break;
							case 65: $database->modifyHero($uid,0,"itemaccountmspeed",40,2); break;
							case 66: $database->modifyHero($uid,0,"itemaccountmspeed",50,2); break;
							case 67: $database->modifyHero($uid,0,"itemallymspeed",15,2); break;
							case 68: $database->modifyHero($uid,0,"itemallymspeed",20,2); break;
							case 69: $database->modifyHero($uid,0,"itemallymspeed",25,2); break;
							case 73: $database->modifyHero($uid,0,"itemrob",10,2); break;
							case 74: $database->modifyHero($uid,0,"itemrob",15,2); break;
							case 75: $database->modifyHero($uid,0,"itemrob",20,2); break;
							case 76: $database->modifyHero($uid,0,"itemfs",500,2); break;
							case 77: $database->modifyHero($uid,0,"itemfs",1000,2); break;
							case 78: $database->modifyHero($uid,0,"itemfs",1500,2); break;
							case 79: $database->modifyHero($uid,0,"itemvsnatars",25,2); break;
							case 80: $database->modifyHero($uid,0,"itemvsnatars",50,2); break;
							case 81: $database->modifyHero($uid,0,"itemvsnatars",75,2); break;
						}
					}
					switch  ($itemData['type']){
						case 61: $database->modifyHero($uid,0,"itemreturnmspeed",30,1); break;
						case 62: $database->modifyHero($uid,0,"itemreturnmspeed",40,1); break;
						case 63: $database->modifyHero($uid,0,"itemreturnmspeed",50,1); break;
						case 64: $database->modifyHero($uid,0,"itemaccountmspeed",30,1); break;
						case 65: $database->modifyHero($uid,0,"itemaccountmspeed",40,1); break;
						case 66: $database->modifyHero($uid,0,"itemaccountmspeed",50,1); break;
						case 67: $database->modifyHero($uid,0,"itemallymspeed",15,1); break;
						case 68: $database->modifyHero($uid,0,"itemallymspeed",20,1); break;
						case 69: $database->modifyHero($uid,0,"itemallymspeed",25,1); break;
						case 73: $database->modifyHero($uid,0,"itemrob",10,1); break;
						case 74: $database->modifyHero($uid,0,"itemrob",15,1); break;
						case 75: $database->modifyHero($uid,0,"itemrob",20,1); break;
						case 76: $database->modifyHero($uid,0,"itemfs",500,1); break;
						case 77: $database->modifyHero($uid,0,"itemfs",1000,1); break;
						case 78: $database->modifyHero($uid,0,"itemfs",1500,1); break;
						case 79: $database->modifyHero($uid,0,"itemvsnatars",25,1); break;
						case 80: $database->modifyHero($uid,0,"itemvsnatars",50,1); break;
						case 81: $database->modifyHero($uid,0,"itemvsnatars",75,1); break;
					}
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					$database->modifyHeroFace($uid, 'leftHand', $itemData['id']);
				break;
		
				case 4:
					if ($data['amount']>1) $data['amount'] = 1;
					if($data['amount'] >= $itemData['num']){
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					if($heroFace['rightHand']!=0){
						$database->modifyHeroItem($heroFace['rightHand'], 'proc', 0, 0);
						$database->modifyHeroItem($heroFace['rightHand'], 'num', 1, 1);
						$currentItem = $database->getHeroItem($heroFace['rightHand']);
						switch  ($currentItem['type']){
							case 16: case 19: case 22: case 25: case 28: case 31: case 34: case 37: case 40: case 43: case 46: case 49: case 52: case 55: case 58:
								$database->modifyHero($uid,0,"itemfs",500,2);
							break;
							case 17: case 20: case 23: case 26: case 29: case 32: case 35: case 38: case 41: case 44: case 47: case 50: case 53: case 56: case 59:
								$database->modifyHero($uid,0,"itemfs",1000,2);
							break;
							case 18: case 21: case 24: case 27: case 30: case 33: case 36: case 39: case 42: case 45: case 48: case 51: case 54: case 57: case 60:
								$database->modifyHero($uid,0,"itemfs",1500,2);
							break;
						}
					}
					switch  ($itemData['type']){
						case 16: case 19: case 22: case 25: case 28: case 31: case 34: case 37: case 40: case 43: case 46: case 49: case 52: case 55: case 58:
							$database->modifyHero($uid,0,"itemfs",500,1);
						break;
						case 17: case 20: case 23: case 26: case 29: case 32: case 35: case 38: case 41: case 44: case 47: case 50: case 53: case 56: case 59:
							$database->modifyHero($uid,0,"itemfs",1000,1);
						break;
						case 18: case 21: case 24: case 27: case 30: case 33: case 36: case 39: case 42: case 45: case 48: case 51: case 54: case 57: case 60:
							$database->modifyHero($uid,0,"itemfs",1500,1);
						break;
					}
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					$database->modifyHeroFace($uid, 'rightHand', $itemData['id']);
				break;
		
				case 5:
					if ($data['amount']>1) $data['amount'] = 1;
					if($data['amount'] >= $itemData['num']){
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					if($heroFace['shoes']!=0){
						$database->modifyHeroItem($heroFace['shoes'], 'proc',0 , 0);
						$database->modifyHeroItem($heroFace['shoes'], 'num',1 , 1);
						$currentItem = $database->getHeroItem($heroFace['shoes']);
						switch  ($currentItem['type']){
							case 94: $database->modifyHero($uid,0,"itemautoregen",10,2); break;
							case 95: $database->modifyHero($uid,0,"itemautoregen",15,2); break;
							case 96: $database->modifyHero($uid,0,"itemautoregen",20,2); break;
							case 97: $database->modifyHero($uid,0,"itemattackmspeed",25,2); break;
							case 98: $database->modifyHero($uid,0,"itemattackmspeed",50,2); break;
							case 99: $database->modifyHero($uid,0,"itemattackmspeed",75,2); break;
							case 100: $database->modifyHero($uid,0,"itemspeed",3,2); break;
							case 101: $database->modifyHero($uid,0,"itemspeed",4,2); break;
							case 102: $database->modifyHero($uid,0,"itemspeed",5,2); break;
						}
					}
					switch  ($itemData['type']){
						case 94: $database->modifyHero($uid,0,"itemautoregen",10,1); break;
						case 95: $database->modifyHero($uid,0,"itemautoregen",15,1); break;
						case 96: $database->modifyHero($uid,0,"itemautoregen",20,1); break;
						case 97: $database->modifyHero($uid,0,"itemattackmspeed",25,1); break;
						case 98: $database->modifyHero($uid,0,"itemattackmspeed",50,1); break;
						case 99: $database->modifyHero($uid,0,"itemattackmspeed",75,1); break;
						case 100: $database->modifyHero($uid,0,"itemspeed",3,1); break;
						case 101: $database->modifyHero($uid,0,"itemspeed",4,1); break;
						case 102: $database->modifyHero($uid,0,"itemspeed",5,1); break;
					}
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					$database->modifyHeroFace($uid, 'shoes', $itemData['id']);
				break;
		
				case 6:
					if ($data['amount']>1) $data['amount'] = 1;
					if($data['amount'] >= $itemData['num']){
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					if($heroFace['horse']!=0){
						$database->modifyHeroItem($heroFace['horse'], 'proc', 0, 0);
						$database->modifyHeroItem($heroFace['horse'], 'num', 1, 1);
						$currentItem = $database->getHeroItem($heroFace['horse']);
						switch  ($currentItem['type']){
							case 103: $database->modifyHero($uid,0,"itemspeed",14,2); break;
							case 104: $database->modifyHero($uid,0,"itemspeed",17,2); break;
							case 105: $database->modifyHero($uid,0,"itemspeed",20,2); break;
						}
					}
					switch  ($itemData['type']){
						case 103: $database->modifyHero($uid,0,"itemspeed",14,1); break;
						case 104: $database->modifyHero($uid,0,"itemspeed",17,1); break;
						case 105: $database->modifyHero($uid,0,"itemspeed",20,1); break;
					}
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					$database->modifyHeroFace($uid, 'horse', $itemData['id']);
				break;
		
				case 7:	case 8:	case 9:
					if($heroFace['bag']!=0 && $heroFace['bag']!=$itemData['id']){
						$database->modifyHeroItem($heroFace['bag'], 'num', $heroFace['num'], 1);
						$database->modifyHeroItem($heroFace['bag'], 'proc', 0, 0);
					}
					if ($data['amount'] >= $itemData['num']){
						$data['amount'] = $itemData['num'];
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					if($heroFace['bag']!=0 && $heroFace['bag']==$itemData['id']){
						$data['amount'] += $heroFace['num'];
					}
					$database->modifyHeroFace($uid, 'num', $data['amount']);
					$database->modifyHeroFace($uid, 'bag', $itemData['id']);
				break;
		
				case 10:
					if($data['amount'] >= $itemData['num']){
						$data['amount'] = $itemData['num'];
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					$value = ($data['amount']*10*ITEMATTRSPEED);
					$heroData['experience'] += $value;
					$database->modifyHero($uid,0,'experience', $value, 1);
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					usleep(1000010);
				break;
		
				case 11:
					if($heroData['health']<100){
						if($data['amount'] > $itemData['num']){
							$data['amount'] = $itemData['num'];
						}
						$health = round($heroData['health']);
						if(($health+$data['amount'])>100){
							$data['amount'] = intval(100-$health);
						}
						if ($data['amount'] >= $itemData['num']) $database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
						$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
						$database->modifyHero($uid,0,'health', $data['amount'], 1);
					}
				break;
		
				case 12:
					if ($data['amount']>1) $data['amount'] = 1;
					if($heroData['dead']==1){
						$database->modifyHero($uid,0,'dead', 0, 0);
						$database->modifyHero($uid,0,'health', 100, 0);
						$database->modifyHero($uid,0,'wref', $village->wid, 0);
						$database->modifyUnit($village->wid, 'hero', 1, 2);
						global $session;
						//var_dump($session->villages);
						foreach($session->villages as $k=>$v){
							$ht = $database->getHeroTrain($v);
							$database->trainHero($ht['id'], 0, 0, 1);
						}
						if($data['amount'] >= $itemData['num']){
							$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
						}
						$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					}
				break;
		
				case 13:
					if ($data['amount']>1) $data['amount'] = 1;
					$rp = 30;
					$powerPoints = $heroData['power'];
					$offPoints = $heroData['offBonus'];
					$defPoints = $heroData['defBonus'];
					$productPoints = $heroData['product'];
				
					$AllPoints = ($heroData['level']*4)+4;
				
					$database->modifyHero($uid,0,'points', $AllPoints, 0);
					$database->modifyHero($uid,0,'power', 0, 0);
					$database->modifyHero($uid,0,'offBonus', 0, 0);
					$database->modifyHero($uid,0,'defBonus', 0, 0);
					$database->modifyHero($uid,0,'product', 0, 0);
					for($i=0;$i<=4;$i++){
						$database->modifyHero($uid,0,'r'.$i, 0, 0);
					}
					if($data['amount'] >= $itemData['num']){
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
				break;
		
				case 14:
					if($village->loyalty<125){
						if($data['amount'] >= $itemData['num']){
							$data['amount'] = $itemData['num'];
						}
						if(($village->loyalty+$data['amount'])>125){
							$data['amount'] = intval(125-$village->loyalty);
						}
						$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
						$database->setVillageField($village->wid, 'loyalty', ($village->loyalty+$data['amount']));
						if($data['amount'] >= $itemData['num']){
							$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
						}
						$village->loyalty = ($village->loyalty+$data['amount']);
					}
				break;
		
				case 15:
					if($data['amount'] >= $itemData['num']){
						$data['amount'] = $itemData['num'];
						$database->modifyHeroItem($itemData['id'], 'proc', 1, 0);
					}
					$value = ($data['amount']*$database->getVSumField($uid, 'cp'));
					$database->modifyHeroItem($itemData['id'], 'num', $data['amount'], 2);
					$database->updateUserField($uid, 'cp', $value, 2);
				break;
		
			}
		}
	}
}
?>
