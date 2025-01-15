<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
if(!defined('_ADMINEXEC_')) die('Attack on '.__FILE__);
include('admin.model.php');
class adminController {
	public $model;
	function __construct(){
		global $database;
		$this->model = new adminModel();
		if(!$this->checkLogin()){
			if (isset($_POST['action']) && $_POST['action']=='login'){
				$username = $_POST['name'];
				$password = $_POST['pw'];
				$img = $_POST['img'];
				$this->login($username,$password,$img);
			} else {
				include('tpl/login.tpl');
			}
		} else {
			if (isset($_GET['action']) && $_GET['action']!='') $this->act($_GET);
			if (isset($_POST['action']) && $_POST['action']!='') $this->act($_POST);
			include('tpl/admin.tpl');
		}
	}
	
	function checkLogin(){
		if($_SESSION['access'] >= MULTIHUNTER and $_SESSION['id']){
			return true;
		}else{
			return false;
		}                
	}

	function act($req){
		global $database;
		switch($req['action']){
			case 'savegold':
				$req['gold'] = intval($req['gold']);$req['boughtgold'] = intval($req['boughtgold']);$req['giftgold'] = intval($req['giftgold']);
				$req['transferedgold'] = intval($req['transferedgold']);$req['seggold'] = intval($req['seggold']);
				$req['usedgold'] = intval($req['usedgold']);
				$this->model->saveGold($req);
				header("Location: ?p=player&uid=".$req['uid']); exit;
			break;
			case 'savesilver':
				$req['silver'] = intval($req['silver']);$req['giftsilver'] = intval($req['giftsilver']);$req['gessilver'] = intval($req['gessilver']);
				$req['bisilver'] = intval($req['bisilver']);$req['sisilver'] = intval($req['sisilver']);
				$this->model->saveSilver($req);
				header("Location: ?p=player&uid=".$req['uid']); exit;
			break;
			case 'ihr':
				$this->model->reviveHeroNow($req['uid']);
			break;
			case 'savetroops':
				$this->model->saveTroops($req);
				header("Location: ?p=village&did=".$req['id']); exit;
			break;
			case 'delGoldClub':
				$this->model->editGoldClub($req['uid'],0);
				header("Location: ?p=player&uid=".$req['uid']); exit;
			break;
			case 'addGoldClub':
				$this->model->editGoldClub($req['uid'],1);
				header("Location: ?p=player&uid=".$req['uid']); exit;
			break;
			case 'recountPop':$this->model->recountPop($req['did']); break;
			case 'recountPopUsr':$this->model->recountPopUser($req['uid']); break;
			case 'stopDel': break;
			case 'delVil':$this->model->delVillage($req['did']);break;
			case 'delBan':$this->model->delBan($req['uid']); break;
			case 'addBan':
				if($req['time']){$end = time()+$req['time']; }else{$end = '';}
				if(preg_match("/^[0-9]+$/",$req['uid'])){
					$req['uid'] = $req['uid'];
				}else{     
					$req['uid'] = $database->getUserField($req['uid'],'id',1);
				}
				$this->model->addBan($req['uid'],$end,$req['reason']);
				//add ban 
			break;
			case 'delOas':break;
			case 'logout':$this->logout(); header("Location: index.php"); exit; break;
			case 'delPlayer':
				$this->model->delPlayer($req['uid'],$req['pass']);
				header("Location: ?p=search&msg=ursdel"); exit;
			break;
			case 'punish':$this->model->punish($req);header("Location: ".$_SERVER['HTTP_REFERER']); exit;
			break;
			case 'addVillage':$this->model->addVillage($req);header("Location: ".$_SERVER['HTTP_REFERER']); exit;
			break;
		} 
		header("Location: ".$_SERVER['HTTP_REFERER']); exit;
	}

	function login($username,$password,$img){
		global $database;
		if($this->model->login($username,$password)){  
			if($img == $_SESSION['secimg']){
				//$_SESSION['username'] = $username; 
				$_SESSION['access'] = $database->getUserField($username,'access',1);   
				$_SESSION['id'] = $database->getUserField($username,'id',1); 
				header("Location: index.php"); exit;
			}else{
				header("Location: index.php?error=2"); exit;
			}
		}else{
			header("Location: index.php?error=1"); exit;
		}
	}
  
	function logout(){      
		$_SESSION['access'] = '';
		$_SESSION['id'] = '';
	}

	public function procResType($ref) {
		switch($ref) {
			case 1: $build = "Woodcutter"; break;
			case 2: $build = "Clay Pit"; break;
			case 3: $build = "Iron Mine"; break;
			case 4: $build = "Cropland"; break;
			case 5: $build = "Sawmill"; break;
			case 6: $build = "Brickyard"; break;
			case 7: $build = "Iron Foundry"; break;
			case 8: $build = "Grain Mill"; break;
			case 9: $build = "Bakery"; break;
			case 10: $build = "Warehouse"; break;
			case 11: $build = "Granary"; break;
			case 12: $build = "Blacksmith"; break;
			case 13: $build = "Armoury"; break;
			case 14: $build = "Tournament Square"; break;
			case 15: $build = "Main Building"; break;
			case 16: $build = "Rally Point"; break;
			case 17: $build = "Marketplace"; break;
			case 18: $build = "Embassy"; break;
			case 19: $build = "Barracks"; break;
			case 20: $build = "Stable"; break;
			case 21: $build = "Workshop"; break;
			case 22: $build = "Academy"; break;
			case 23: $build = "Cranny"; break;
			case 24: $build = "Town Hall"; break;
			case 25: $build = "Residence"; break;
			case 26: $build = "Palace"; break;
			case 27: $build = "Treasury"; break;
			case 28: $build = "Trade Office"; break;
			case 29: $build = "Great Barracks"; break;
			case 30: $build = "Great Stable"; break;
			case 31: $build = "City Wall"; break;
			case 32: $build = "Earth Wall"; break;
			case 33: $build = "Palisade"; break;
			case 34: $build = "Stonemason's Lodge"; break;
			case 35: $build = "Brewery"; break;
			case 36: $build = "Trapper"; break;
			case 37: $build = "Hero's Mansion"; break;
			case 38: $build = "Great Warehouse"; break;
			case 39: $build = "Great Granary"; break;
			case 40: $build = "Wonder of the World"; break;
			case 41: $build = "Horse Drinking Trough"; break;
			default: $build = "Error"; break;
		}
		return $build;
	}
}
?>