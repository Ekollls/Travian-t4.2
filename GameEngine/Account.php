<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("Session.php");
include_once "./securimage/securimage.php";
$securimage = new Securimage();

class Account {
	function getremoteip() {
		global $_SERVER;
			if (!empty($_SERVER["HTTP_CLIENT_IP"]))
		{
		 //check for ip from share internet
		 $remote_ip = $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
		 // Check for the Proxy User
		 $remote_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		else
		{
		 $remote_ip = $_SERVER["REMOTE_ADDR"];
		};
		return $remote_ip;
	}

	function Account() {
		global $session;
		if(isset($_POST['ft'])) {
			switch($_POST['ft']) {
				case "a1":
				$this->Signup();
				break;
				case "a2":
				$this->Activate();
				break;
				case "a3":
				$this->Unreg();
				break;
				case "a4":
				$this->Login();
				break;
			}
		}
		if(isset($_POST['forgotPassword']) && $_POST['forgotPassword'] == 1) {
			$this->forgotPassword($_POST['pw_email']);
		}
		if(isset($_GET['code'])) {
			$_POST['id'] = $_GET['code']; $this->Activate();
		} else {
			if($session->logged_in && in_array("logout.php",explode("/",$_SERVER['PHP_SELF']))) {
				$this->Logout();
			}
		}
	}
	
	private function Signup() {
		global $database,$form,$mailer,$generator,$session;
		$ip = $this->getremoteip();
		if(!isset($_POST['name']) || $_POST['name'] == "") {
			$form->addError("name",USRNM_EMPTY);
		} else {
			
			if(strlen($_POST['name']) < USRNM_MIN_LENGTH) {
				$form->addError("name",USRNM_SHORT);
			}
			else if(!USRNM_SPECIAL && !preg_match("/^([a-z0-9\s\-_]|[پچجحخهعغفقثصضشسيبلاآتنمکگوئدذرزطظًٌٍَُِّ?ةيژؤإأء])+$/i",$_POST['name']) || (strpos($_POST['name'],'<')!==false || strpos($_POST['name'],'>')!==false )) {
				$form->addError("name",USRNM_CHAR);
			}
			

			else if( preg_match('/ /i',$_POST['name']) ) {
				$form->addError("name",USRNM_CHAR);
			}
			else if($database->checkExist($_POST['name'],0)) {
				$form->addError("name",USRNM_TAKEN);
			}
			else if($database->checkExist_activate($_POST['name'],0)) {
				$form->addError("name",USRNM_TAKEN);
			}
			
		}
		if(!isset($_POST['pw']) || $_POST['pw'] == "") {
			$form->addError("pw",PW_EMPTY);
		} else {
			if(strlen($_POST['pw']) < PW_MIN_LENGTH) {
				$form->addError("pw",PW_SHORT);
			}
			else if($_POST['pw'] == $_POST['name']) {
				$form->addError("pw",PW_INSECURE);
			}
		}
		if(!isset($_POST['email'])) {
			$form->addError("email",EMAIL_EMPTY);
		} else {
			if(!$this->validEmail($_POST['email'])) {
				$form->addError("email",EMAIL_INVALID);
			}
			else if($database->checkExist($_POST['email'],1)) {
				$form->addError("email",EMAIL_TAKEN);
			}
			else if($database->checkExist_activate($_POST['email'],1)) {
				$form->addError("email",EMAIL_TAKEN);
			}
		}
		if(!isset($_POST['vid']) ) {
			$form->addError("tribe",TRIBE_EMPTY);
		}
		if(!isset($_POST['agb'])) {
			$form->addError("agree",AGREE_ERROR);
		}
		/* multi acc */
		if(!$database->checkip($ip)) {
			$form->addError("agree","مولتی اکانت مجاز نیست!");
		}
		/* multi acc */
		if($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
			
			header("Location: anmelden.php");exit;
		} else {
			if(AUTH_EMAIL){
				$act = $generator->generateRandStr(10);
				$act2 = $generator->generateRandStr(5);
				$uid = $database->activate($_POST['name'],md5($_POST['pw']),$_POST['email'],$_POST['vid'],$_POST['kid'],$act,$act2);
			
				if($uid) {
					$mailer->sendActivate($_POST['email'],$_POST['name'],$_POST['pw'],$act);
					header("Location: activate.php?id=$uid&q=$act2");exit;
				}
			} else {
				$uid = $database->register($_POST['name'],md5($_POST['pw']),$_POST['email'],$_POST['vid'],$_POST['kid'],$act,time(),$_POST['anc']);
				$frandom0 = rand(0,3);$frandom1 = rand(0,3);$frandom2 = rand(0,4);$frandom3 = rand(0,3);
				
				if($uid) {
					$database->addHeroFace($uid,$frandom0,$frandom1,$frandom2,$frandom3,$frandom3,$frandom2,$frandom1,$frandom0,$frandom2);
					$database->addHero($uid);
				
					setcookie("COOKUSR",$_POST['name'],time()+COOKIE_EXPIRE,COOKIE_PATH);
					setcookie("COOKEMAIL",$_POST['email'],time()+COOKIE_EXPIRE,COOKIE_PATH);
	
					$database->updateUserField($uid,"act","",1);
					header("Location: login.php");exit;
				}
			}
		}
	}
	
	private function Activate() {
		global $database;
		$q = "SELECT * FROM ".TB_PREFIX."activate where act = '".$_POST['id']."'";
		$result = mysql_query($q, $database->connection);
		$dbarray = mysql_fetch_array($result);
		if($dbarray['act'] == $_POST['id']) {
			$uid = $database->register($dbarray['username'],$dbarray['password'],$dbarray['email'],$dbarray['tribe'],$dbarray['location'],"",time(),$dbarray['ancestor']);
			$frandom0 = rand(0,4);$frandom1 = rand(0,3);$frandom2 = rand(0,4);$frandom3 = rand(0,3);
			if($uid) {
				$database->unreg($dbarray['username']);
				$database->addHeroFace($uid,$frandom0,$frandom1,$frandom2,$frandom3,$frandom3,$frandom2,$frandom1,$frandom0,$frandom2);
				$database->addHero($uid);
				
				header("Location: login.php");exit;
			}
		}
		else {
			header("Location: activate.php?e=3");exit;
		}
	}
	
	private function Unreg() {
		global $database;
		$q = "SELECT * FROM ".TB_PREFIX."activate where id = '".$_POST['id']."'";
		$result = mysql_query($q, $database->connection);
		$dbarray = mysql_fetch_array($result);
		if(md5($_POST['pw']) == $dbarray['password']) {
			$database->unreg($dbarray['username']);
			header("Location: anmelden.php");exit;
		}
		else {
			header("Location: activate.php?e=3");exit;
		}
	}
	
	private function Login() {
		global $database,$session,$form,$securimage;
		if(!isset($_POST['user']) || $_POST['user'] == "") {
			$form->addError("user",LOGIN_USR_EMPTY);
		}
		else if(!$database->checkExist($_POST['user'],0)) {
			$form->addError("user",USR_NT_FOUND);
		}
		if(!isset($_POST['pw']) || $_POST['pw'] == "") {
			$form->addError("pw",LOGIN_PASS_EMPTY);
		}
		else if(!$database->login($_POST['user'],$_POST['pw']) && !$database->sitterLogin($_POST['user'],$_POST['pw'])) {
			$form->addError("pw",LOGIN_PW_ERROR);
		}
		if($database->getUserField($_POST['user'],"act",1) != "") {
			$form->addError("activate",$_POST['user']);
		}
		if($securimage->check($_POST['captcha'])) {}else{
			$form->addError("captcha","کد امنیتی صحیح نیست!");
		}

		if($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
			
			header("Location: login.php");exit;
		}
		else {
			setcookie("COOKUSR",$_POST['user'],time()+COOKIE_EXPIRE,COOKIE_PATH);
			if($database->sitterLogin($_POST['user'],$_POST['pw'])){
				$database->UpdateOnline("login" ,$_POST['user'],1);
			}else{
				$database->UpdateOnline("login" ,$_POST['user'],0);
			}
			$session->login($_POST['user']);
		}
	}
	
	private function Logout() {
		global $session,$database;
		unset($_SESSION['wid']);
		$database->activeModify(addslashes($session->username),1);
		$database->UpdateOnline("logout");// or die(mysql_error());
		$session->Logout();
	}
	
	private function forgotPassword($email) {
		global $database,$generator,$form,$mailer;
		$npw = $generator->generateRandStr(6);
		$act = $generator->generateRandStr(10);
		$getData = $database->getUserWithEmail($email);
		if($email == "") {
			$form->addError("pw_email",EMAIL_EMPTY);
		}
		elseif($database->checkProcExist($getData['id'])){
			if($database->checkExist($email,1)){
				$database->addNewProc($getData['id'], $npw, 0, $act, 0);
				$mailer->sendPassword($email, $getData['id'], $getData['username'], $npw, $act);
			}else{
				$form->addError("pw_email",EMAIL_NOTEXIST);
			}
		}else{
			$form->addError("pw_email",EMAIL_TAKEN);
		}
		if($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
		}else{
			header("Location: login.php?action=forgotPassword&finish=true");exit;
		}
	}
	
	private function validEmail($email) {
	  $regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
	  if ( !preg_match($regexp, $email) ) {
		   return false;
	  }
	  return true;
	}
	
	function generateBase($kid,$uid,$username, $mode = 0) {
		global $database,$message;
		if ($mode == 0 ) {
			if($kid == 0) {
				$kid = rand(1,4);
			}  else{
				$kid = $_POST['kid'];
			}
		}else{}
		
		$wid = $database->generateBase($kid);
		$database->setFieldTaken($wid);
		$database->addVillage($wid,$uid,$username,1);
		$database->addResourceFields($wid,$database->getVillageType($wid));
		$database->addUnits($wid);
		$database->addTech($wid);
		$database->addABTech($wid);
		$database->updateUserField($uid,"access",USER,1);
		$database->updateUserField($uid,"location","",1);
		$message->sendWelcome($uid,$username);
			$sath = B_LEVEL;
			mysql_query("UPDATE ".TB_PREFIX."fdata SET `f1`='".$sath."',`f2`='".$sath."',`f3`='".$sath."',`f4`='".$sath."',`f5`='".$sath."',`f6`='".$sath."',`f7`='".$sath."',`f8`='".$sath."',`f9`='".$sath."',`f10`='".$sath."',`f11`='".$sath."',`f12`='".$sath."',`f13`='".$sath."',`f14`='".$sath."',`f15`='".$sath."',`f16`='".$sath."',`f17`='".$sath."',`f18`='".$sath."' WHERE vref = '".$wid."'");
			$pop = $this->getALLPop($sath);
			$pop = $pop[0];$cp = $pop[1];
			mysql_query("UPDATE ".TB_PREFIX."vdata set `pop` = `pop` + '".$pop."' where wref = '".$wid."'");
			mysql_query( "UPDATE ".TB_PREFIX."vdata set `cp` = `cp` + '".$cp."' where wref = '".$wid."'");
	}
	private function getALLPop($sath) {
		$pop = 0;
		$cp = 0;
		$i = 0;
		for($i=1;$i<=18;++$i){
			$name = "bid".$i;
			$dataarray = $$name;
			foreach($dataarray as $id => $value){
				$pop += $dataarray[$id]['pop'];
				$cp += $dataarray[$id]['cp'];
				$i++;
				if($i >= $sath){
					break;
				}
			}
			return array($pop,$cp);
		}
	}
	
	
};
$account = new Account;
?>
