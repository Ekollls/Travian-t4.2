<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
if(!defined('_ADMINEXEC_')) die('Attack on '.__FILE__);
ini_set('display_errors', 1);
class adminModel {
	var $connection;
	function __construct(){
		$this->connection = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS) or die(mysql_error());
		mysql_select_db(SQL_DB, $this->connection) or die(mysql_error()); 	            		
	}
	
	function login($username,$password) {
		$q = "SELECT * FROM ".TB_PREFIX."users where username = '$username' and access >= ".MULTIHUNTER;
		$result = mysql_query($q, $this->connection);
		$dbarray = mysql_fetch_array($result);
		if($dbarray['password'] == md5($password)) {
			mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$dbarray['id'].",'$username logged in (IP: <b>".$_SERVER['REMOTE_ADDR']."</b>)',".time().")");
			return true;
		} else {
			mysql_query("Insert into ".TB_PREFIX."admin_log values (0,'X','<font color=\'red\'><b>IP: ".$_SERVER['REMOTE_ADDR']." tried to log in with username <u> $username</u> but access was denied!</font></b>',".time().")");
			return false;
		}
	}
	
	function saveGold($req){
		$q = "UPDATE ".TB_PREFIX."users SET "
			."`gold`=".$req['gold'].",`boughtgold`=".$req['boughtgold']
			.",`giftgold`=".$req['giftgold'].",`transferedgold`=".$req['transferedgold'].",`seggold`=".$req['seggold'].",`usedgold`=".$req['usedgold']
			." WHERE `id`=".$req['uid'];
		$this->query($q);
	}
	
	function saveSilver($req){
		$q = "UPDATE ".TB_PREFIX."users SET "
			."`silver`=".$req['silver'].",`giftsilver`=".$req['giftsilver']
			.",`gessilver`=".$req['gessilver'].",`sisilver`=".$req['sisilver'].",`bisilver`=".$req['bisilver']
			." WHERE `id`=".$req['uid'];
		$this->query($q);
	}
	
	function reviveHeroNow($uid){
		global $database;
		$varray = $database->getProfileVillages($uid);
		foreach($varray as $vil){
			$q = "UPDATE ".TB_PREFIX."units SET hero = 0 WHERE `vref`=".$vil['wref'];$database->query($q);
			$q = "UPDATE ".TB_PREFIX."enforcement SET hero = 0 WHERE `from`=".$vil['wref'];$database->query($q);
			$q = "UPDATE ".TB_PREFIX."trapped SET hero = 0 WHERE `from`=".$vil['wref'];$database->query($q);
			$q = "UPDATE ".TB_PREFIX."attacks SET t11 = 0  WHERE `from`".$vil['wref'];$database->query($q);
		}
		$heroData = $database->getHero($uid);
		$q = "UPDATE ".TB_PREFIX."units SET hero = 1 WHERE `vref`=".$heroData['wref'];$database->query($q);
		$database->modifyHero($uid,0,'health', 100, 0);
	}
	
	function saveTroops($req){
		global $database;
		$id = $req['id'];
		$village = $database->getVillage($id);  
		$user = $database->getUser($village['owner'],1);  
		$coor = $database->getCoor($village['wref']); 
		$varray = $database->getProfileVillages($village['owner']); 
		$type = $database->getVillageType($village['wref']);
		$fdata = $database->getResourceLevel($village['wref']);
		$units = $database->getUnit($village['wref']);

		$u1 = $req['u1'];$u2 = $req['u2'];$u3 = $req['u3'];$u4 = $req['u4'];$u5 = $req['u5'];
		$u6 = $req['u6'];$u7 = $req['u7'];$u8 = $req['u8'];$u9 = $req['u9'];$u10 = $req['u10'];
		////////////////////
		$u11 = $req['u11'];$u12 = $req['u12'];$u13 = $req['u13'];$u14 = $req['u14'];$u15 = $req['u15'];
		$u16 = $req['u16'];$u17 = $req['u17'];$u18 = $req['u18'];$u19 = $req['u19'];$u20 = $req['u20'];
		////////////////////
		$u21 = $req['u21'];$u22 = $req['u22'];$u23 = $req['u23'];$u24 = $req['u24'];$u25 = $req['u25'];
		$u26 = $req['u26'];$u27 = $req['u27'];$u28 = $req['u28'];$u29 = $req['u29'];$u30 = $req['u30'];
		////////////////////
		$u31 = $req['u31'];$u32 = $req['u32'];$u33 = $req['u33'];$u34 = $req['u34'];$u35 = $req['u35'];
		$u36 = $req['u36'];$u37 = $req['u37'];$u38 = $req['u38'];$u39 = $req['u39'];$u40 = $req['u40'];
		////////////////////
		$u41 = $req['u41'];$u42 = $req['u42'];$u43 = $req['u43'];$u44 = $req['u44'];$u45 = $req['u45'];
		$u46 = $req['u46'];$u47 = $req['u47'];$u48 = $req['u48'];$u49 = $req['u49'];$u50 = $req['u50'];

		if($user['tribe'] == 1){
			$q = "UPDATE ".TB_PREFIX."units SET u1 = $u1, u2 = $u2, u3 = $u3, u4 = $u4, u5 = $u5, u6 = $u6, u7 = $u7, u8 = $u8, u9 = $u9, u10 = $u10 WHERE vref = $id";
			mysql_query($q);
		} else if($user['tribe'] == 2){
			$q = "UPDATE ".TB_PREFIX."units SET u11 = '$u11', u12 = '$u12', u13 = '$u13', u14 = '$u14', u15 = '$u15', u16 = '$u16', u17 = '$u17', u18 = '$u18', u19 = '$u19', u20 = '$u20' WHERE vref = $id";
			mysql_query($q);
		} else if($user['tribe'] == 3){
			$q = "UPDATE ".TB_PREFIX."units SET u21 = '$u21', u22 = '$u22', u23 = '$u23', u24 = '$u24', u25 = '$u25', u26 = '$u26', u27 = '$u27', u28 = '$u28', u29 = '$u29', u30 = '$u30' WHERE vref = $id";
			mysql_query($q);
		} else if($user['tribe'] == 4){
			$q = "UPDATE ".TB_PREFIX."units SET u31 = '$u31', u32 = '$u32', u33 = '$u33', u34 = '$u34', u35 = '$u35', u36 = '$u36', u37 = '$u37', u38 = '$u38', u39 = '$u39', u40 = '$u40' WHERE vref = $id";
			mysql_query($q);
		} else if($user['tribe'] == 5){
			$q = "UPDATE ".TB_PREFIX."units SET u41 = '$u41', u42 = '$u42', u43 = '$u43', u44 = '$u44', u45 = '$u45', u46 = '$u46', u47 = '$u47', u48 = '$u48', u49 = '$u49', u50 = '$u50' WHERE vref = $id";
			mysql_query($q);
		}

		mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Changed troop anmount in village <a href=\'index.php?p=village&did=$id\'>".$village['name']."</a> ',".time().")");

	}
	
	function editGoldClub($uid,$v){
		$q = "UPDATE ".TB_PREFIX."users SET `goldclub`=$v WHERE `id`=".$uid;
		$this->query($q);
	}
	function recountPopUser($uid){
		global $database;
		$villages = $database->getProfileVillages($uid);
		for ($i = 0; $i <= count($villages)-1; $i++) {  
			$vid = $villages[$i]['wref'];
			$this->recountPop($vid);
		}
	}
	
	function recountPop($vid){
		global $database;
		$fdata = $database->getResourceLevel($vid); 
		$popTot = 0;
		for ($i = 1; $i <= 40; $i++) {
			$lvl = $fdata["f".$i];
			$building = $fdata["f".$i."t"];
			if($building){
				$popTot += $this->buildingPOP($building,$lvl);
			}
		}        
		$q = "UPDATE ".TB_PREFIX."vdata set pop = $popTot where wref = $vid";
		mysql_query($q, $this->connection);
	}
  
	function buildingPOP($f,$lvl){
		$name = "bid".$f;
		global $$name;        
		$popT = 0;
		$dataarray = $$name;      
		for ($i = 0; $i <= $lvl; $i++) {
			$popT += $dataarray[$i]['pop'];
		}
		return $popT;
	}
	
	function getWref($x,$y) {
		$q = "SELECT id FROM ".TB_PREFIX."wdata where x = $x and y = $y";      
		$result = mysql_query($q, $this->connection);
		$r = mysql_fetch_array($result);
		return $r['id'];
	}
	
	function addVillage($post){
		global $database;
		$wid = $this->getWref($post['x'],$post['y']);
		$uid = $post['uid'];
		$status = $database->getVillageState($wid);
		$status = 0;
		if($status == 0){
			mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Added new village <b><a href=\'index.php?p=village&did=$wid\'>$wid</a></b> to user <b><a href=\'index.php?p=player&uid=$uid\'>$uid</a></b>',".time().")");
			$database->setFieldTaken($wid);
			$database->addVillage($wid,$uid,'\xCF\xE5\x98\xCF\xE5 \xCC\xCF\xED\xCF','0');
			$database->addResourceFields($wid,$database->getVillageType($wid));
			$database->addUnits($wid);
			$database->addTech($wid);
			$database->addABTech($wid);       
		} 
	}
	
	function punish($post){
		global $database;  
		$villages = $database->getProfileVillages($post['uid']);
		$admid = $post['admid'];
		$user = $database->getUser($post['uid'],1);    
		for ($i = 0; $i <= count($villages)-1; $i++) {  
			$vid = $villages[$i]['wref'];
			if($post['punish']){
				$popOld = $villages[$i]['pop'];
				$proc = 100-$post['punish'];
				$pop = floor(($popOld/100)*($proc));
				if($pop <= 1 ){$pop = 2;}
				$this->punishBuilding($vid,$proc,$pop);   
				
			}  
            if($post['del_troop']){
                if($user['tribe'] == 1) {
                  $unit = 1;
                }else if($user['tribe'] == 2) {
                  $unit = 11;
                }else if($user['tribe'] == 3) {
                  $unit = 21;
                } 
                  $this->delUnits($villages[$i]['wref'],$unit);
            }
			if($post['clean_ware']){
				$time = time();                   
				$q = "UPDATE ".TB_PREFIX."vdata SET `wood` = '0', `clay` = '0', `iron` = '0', `crop` = '0', `lastupdate` = '$time' WHERE wref = $vid;"; 
				mysql_query($q, $this->connection); 
			}  
		}   
		mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Punished user: <a href=\'index.php?p=player&uid=".$post['uid']."\'>".$post['uid']."</a> with <b>-".$post['punish']."%</b> population',".time().")");
	}
  
	function punishBuilding($vid,$proc,$pop){
		global $database;
		$q = "UPDATE ".TB_PREFIX."vdata set pop = $pop where wref = $vid;";
		mysql_query($q, $this->connection); 
			$fdata = $database->getResourceLevel($vid);       
		for ($i = 1; $i <= 40; $i++) {     
			if($fdata['f'.$i]>1){   
				$zm = ($fdata['f'.$i]/100)*$proc;
				if($zm < 1){$zm = 1;}else{$zm = floor($zm);}
				$q = "UPDATE ".TB_PREFIX."fdata SET `f$i` = '$zm' WHERE `vref` = $vid;";
				mysql_query($q, $this->connection);     
			}
		}  
	}
  
	function delUnits($vid,$unit){
		for ($i = $unit; $i <= 9+$unit; $i++) {
			$this->delUnits2($vid,$unit);
		}     
	}
  
	function delUnits2($vid,$unit){
		$q = "UPDATE ".TB_PREFIX."units SET `u$unit` = '0' WHERE `vref` = $vid;";
		mysql_query($q, $this->connection); 
	}
	
	function delPlayer($uid,$pass){
		global $database;  
		$ID = $_SESSION['id'];//$database->getUserField($_SESSION['username'],'id',1);	 
		if($this->checkPass($pass,$ID)){
			$villages = $database->getProfileVillages($uid);
			for ($i = 0; $i <= count($villages)-1; $i++) {
				$this->delVillage($villages[$i]['wref']);
			}  
			$name = $database->getUserField($uid,"username",0);
			mysql_query("Insert into ".TB_PREFIX."admin_log values (0,$ID,'Deleted user <a>$name</a>',".time().")");
			$q = "DELETE FROM ".TB_PREFIX."users WHERE `id` = $uid;";
			mysql_query($q, $this->connection);     
		}
	}
  
	function getUserActive() {
		$time = time() - (60*5);
		$q = "SELECT * FROM ".TB_PREFIX."users where timestamp > $time and username != 'support'";
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
	
	function getAllUsers() {
		$q = "SELECT * FROM ".TB_PREFIX."users where username != 'support'";
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
  
	function checkPass($password,$uid){       
		$q = "SELECT password FROM ".TB_PREFIX."users where id = '$uid' and access = ".ADMIN;
		$result = mysql_query($q, $this->connection);
		$dbarray = mysql_fetch_array($result);
		if($dbarray['password'] == md5($password)) { 
			return true;
		}else{
			return false;
		}
	}
	
	function delVillage($wref){
		$q = "SELECT * FROM ".TB_PREFIX."vdata WHERE `wref` = $wref and capital = 1;";
		$result = mysql_query($q, $this->connection);    	  
		if(mysql_num_rows($result) > 0){ 
			mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Deleted village <b>$wref</b>',".time().")");
			$q = "DELETE FROM ".TB_PREFIX."vdata WHERE `wref` = $wref and capital = 1;";
			mysql_query($q, $this->connection);
			$q = "DELETE FROM ".TB_PREFIX."units WHERE `vref` = $wref;";
			mysql_query($q, $this->connection);  
			$q = "DELETE FROM ".TB_PREFIX."bdata WHERE `wid` = $wref;";
			mysql_query($q, $this->connection); 
			$q = "DELETE FROM ".TB_PREFIX."abdata WHERE `wid` = $wref;";
			mysql_query($q, $this->connection);    
			$q = "DELETE FROM ".TB_PREFIX."fdata WHERE `vref` = $wref;";
			mysql_query($q, $this->connection);
			$q = "DELETE FROM ".TB_PREFIX."training WHERE `vref` = $wref;";
			mysql_query($q, $this->connection); 
			$q = "DELETE FROM ".TB_PREFIX."movement WHERE `from` = $wref;";
			mysql_query($q, $this->connection);       
			$q = "UPDATE ".TB_PREFIX."wdata SET `occupied` = '0' WHERE `id` = $wref;";
			mysql_query($q, $this->connection);  
		}
	}
	
	function delBan($uid){
		global $database;
		$name = $database->getUserField($uid,"username",0);
		mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Unbanned user <a href=\'index.php?p=player&uid=$uid\'>$name</a>',".time().")");
		$q = "UPDATE ".TB_PREFIX."users SET `access` = '".USER."' WHERE `id` = $uid;";
		mysql_query($q, $this->connection);
		$q = "UPDATE ".TB_PREFIX."banlist SET `active` = '0' WHERE `uid` = $uid;";
		mysql_query($q, $this->connection);        
	}
  
	function addBan($uid,$end,$reason){
		global $database;
		$name = $database->getUserField($uid,"username",0);
		mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Banned user <a href=\'index.php?p=player&uid=$uid\'>$name</a>',".time().")");
		$q = "UPDATE ".TB_PREFIX."users SET `access` = '0' WHERE `id` = $uid;";  
		mysql_query($q, $this->connection);
		$time = time();
		$admin = $_SESSION['id'];
		$q = "INSERT INTO ".TB_PREFIX."banlist (`uid`, `name`, `reason`, `time`, `end`, `admin`, `active`) VALUES ($uid, '$name' , '$reason', '$time', '$end', '$admin', '1');";
		mysql_query($q, $this->connection);
	}

	function search_player($player){
		$q = "SELECT id,username FROM ".TB_PREFIX."users WHERE `username` LIKE '%$player%' and username != 'support'";
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
  
	function search_email($email){
		$q = "SELECT id,email FROM ".TB_PREFIX."users WHERE `email` LIKE '%$email%' and username != 'support'";
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
  
	function search_village($village){
		$q = "SELECT * FROM ".TB_PREFIX."vdata WHERE `name` LIKE '%$village%' or `wref` LIKE '%$village%'";
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
  
	function search_alliance($alliance){
		$q = "SELECT * FROM ".TB_PREFIX."alidata WHERE `name` LIKE '%$alliance%' or `tag` LIKE '%$alliance%' or `id` LIKE '%$alliance%'";
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
  
	function search_ip($ip){
		$q = "SELECT * FROM ".TB_PREFIX."login_log WHERE `ip` LIKE '%$ip%'";
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
  
	function search_banned(){
		$q = "SELECT * FROM ".TB_PREFIX."banlist where active = '1'";
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
  
	function del_banned(){
		//$q = "SELECT * FROM ".TB_PREFIX."banlist";
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}

	/***************************
	Function to process MYSQLi->fetch_all (Only exist in MYSQL)
	References: Result
	***************************/
	function mysql_fetch_all($result) {
		$all = array();
		if($result) {
		while ($row = mysql_fetch_assoc($result)){ $all[] = $row; }
		return $all;
		}
	}
	
	function query_return($q) {
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
	
	/***************************
	Function to do free query
	References: Query
	***************************/
	function query($query) {
		return mysql_query($query, $this->connection);
	}
	
}
?>