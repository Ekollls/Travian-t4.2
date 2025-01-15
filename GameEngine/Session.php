<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
        if(file_exists(dirname(__FILE__).'/config.php')){
			include(dirname(__FILE__)."/config.php");
        } else {
			die('Server configuration is not completed,wait...');
		}

        include("Database.php");
		include("Data/buidata.php");
        include("Data/cp.php");
        include("Data/cel.php");
        include("Data/resdata.php");
        include("Data/unitdata.php");
        include("Data/hero_full.php");
		include("Data/bounty.php");
        include("Mailer.php");
        include("Battle.php");
        include("Form.php");
        include("Generator.php");
		include("Natars.php");
        include("Logging.php");
        include("Message.php");
        include("Multisort.php");
        include("Ranking.php");
        include("Alliance.php");
        include("Profile.php");
		

        class Session {

        	private $time;
        	var $logged_in = false;
        	var $referrer, $url;
        	var $username, $uid, $access, $plus, $tribe, $isAdmin, $alliance, $gold, $oldrank, $gpack;
        	var $bonus = 0;
        	var $bonus1 = 0;
        	var $bonus2 = 0;
        	var $bonus3 = 0;
        	var $bonus4 = 0;
        	var $checker, $mchecker;
        	public $userinfo = array();
        	private $userarray = array();
        	var $villages = array();

        	function Session() {
        		global $database;
				$this->time = time();
        		@session_start();
				
        		$this->logged_in = $this->checkLogin();
				if (!isset($_SESSION['lang']) || $_SESSION['lang']=='') $_SESSION['lang'] = constant('LANG');
				if($this->logged_in){
					$uLang = $database->getUserField($this->username, 'lang', 1);
					//$uLang = 'fa'; // Force 'fa'
					if (isset($uLang) && $uLang!='')$_SESSION['lang'] = $uLang;
				}
				if(isset($_COOKIE['lang']) and $_COOKIE['lang']!='' &&(!isset($_SESSION['lang']) || $_SESSION['lang']==''))$_SESSION['lang'] = $_COOKIE['lang'];
				if (!isset($_SESSION['lang']) || $_SESSION['lang']=='' || $_SESSION['lang']=='LANG') $_SESSION['lang'] = 'fa';
				include("Lang/" . $_SESSION['lang'] . ".php");
				//include("Automation.php");
        		if($this->logged_in && TRACK_USR) {
        			$database->updateActiveUser($this->username, $this->time);
        		}
        		if(isset($_SESSION['url'])) {
        			$this->referrer = $_SESSION['url'];
        		} else {
        			$this->referrer = "/";
        		}
				//$_SESSION['lang'] = 'fa'; // makes the lang static
        		$this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
        		$this->SurfControl();
				if($this->logged_in) { $this->checkGoldSilverHack();}
        	}

        	public function Login($user) {
        		global $database, $generator, $logging;
        		$this->logged_in = true;
        		$_SESSION['username'] = $user;
        		$_SESSION['sessid'] = $database->getUserField($_SESSION['username'], "sessid", 1);
        		$_SESSION['md5'] = $database->getUserField($_SESSION['username'], "password", 1);
        		$_SESSION['checker'] = $generator->generateRandStr(3);
        		$_SESSION['mchecker'] = $generator->generateRandStr(5);
        		$_SESSION['qst'] = $database->getUserField($_SESSION['username'], "quest", 1);
        		if(!isset($_SESSION['wid'])) {
        			$query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $database->getUserField($_SESSION['username'], "id", 1) . ' LIMIT 1');
        			$data = mysql_fetch_assoc($query);
        			$_SESSION['wid'] = $data['wref'];
        		} else
        			if($_SESSION['wid'] == '') {
        				$query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $database->getUserField($_SESSION['username'], "id", 1) . ' LIMIT 1');
        				$data = mysql_fetch_assoc($query);
        				$_SESSION['wid'] = $data['wref'];
        			}
        		$this->PopulateVar();

        		$logging->addLoginLog($this->uid, $_SERVER['REMOTE_ADDR']);
        		$database->addActiveUser($_SESSION['username'], $this->time);
        		//$database->updateUserField($_SESSION['username'], "sessid", $_SESSION['sessid'], 0);
			$q = "SELECT `sessid` FROM " . TB_PREFIX . "users WHERE username = '".$_SESSION['username']."'";
			$result = mysql_query($q);
			$dbarray = mysql_fetch_array($result);
			if ($dbarray['sessid'] != ''){$sessid = $dbarray['sessid'].'+'.$_SESSION['sessid'];}else{$sessid = $_SESSION['sessid'];}
				$tribe = $database->getUserField($_POST['user'],"tribe",true);
				$location = $database->getUserField($_POST['user'],"location",true);
				$settedup = $database->getUserField($_POST['user'],"settedup",true);
				if ($tribe == 0 || $location == 0) {
					if(!$settedup == "yes" && !$session->uid <= 4) {
						header("Location: first.php");
						exit();
					}
				}
        		header("Location: dorf1.php");exit;
        	}

        	public function Logout() {
        		global $database;
        		$this->logged_in = false;
        		$database->updateUserField($_SESSION['username'], "sessid", "", 0);
        		if(ini_get("session.use_cookies")) {
        			$params = session_get_cookie_params();
        			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        			setcookie('lang', $_SESSION['lang'], time() + 86400, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        		}
        		session_destroy();
        		session_start();
        	}

        	public function changeChecker() {
        		global $generator;
        		$this->checker = $_SESSION['checker'] = $generator->generateRandStr(3);
        		$this->mchecker = $_SESSION['mchecker'] = $generator->generateRandStr(5);
        	}
        	public function setlang($lang='fa') {
        		global $database;
				$_SESSION['lang'] = $lang;
				$database->modifyUser($_SESSION['username'],'lang',$lang,1);
				setcookie('lang', $_SESSION['lang'], time() + 86400, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        	}

        	private function checkLogin() {
        		global $database;
        		if(isset($_SESSION['username']) && isset($_SESSION['sessid'])) {
					if($_SESSION['md5'] ==  $database->getUserField($_SESSION['username'], "password", 1)) {
					}else{
						return false;
					}
        			if(!$database->checkActiveSession($_SESSION['username'], $_SESSION['sessid'])) {
        				$this->Logout();
        				return false;
        			} else {
        				//Get and Populate Data
        				$this->PopulateVar();
        				//update database
        				$database->addActiveUser($_SESSION['username'], $this->time);
        				$database->updateUserField($_SESSION['username'], "timestamp", $this->time, 0);
        				return true;
        			}
        		} else {
        			return false;
        		}
        	}

        	private function PopulateVar() {
        		global $database;
        		$this->userarray = $this->userinfo = $database->getUser($_SESSION['username'], 0);
        		$this->username = $this->userarray['username'];
        		$this->uid = $this->userarray['id'];
        		$this->gpack = $this->userarray['gpack'];
        		$this->access = $this->userarray['access'];
        		$this->plus = ($this->userarray['plus'] > $this->time);
				$this->goldclub = $this->userarray['goldclub'];
        		$this->villages = $database->getVillagesID($this->uid);
        		$this->tribe = $this->userarray['tribe'];
        		$this->isAdmin = $this->access >= 9;
        		$this->alliance = $this->userarray['alliance'];
        		$this->checker = $_SESSION['checker'];
        		$this->mchecker = $_SESSION['mchecker'];
        		$this->gold = $this->userarray['gold'];
				$this->is_sitter = $database->checkSitter($_SESSION['username']);
				$this->silver = $this->userarray['silver'];
				$this->cp = $this->userarray['cp'];
        		$this->oldrank = $this->userarray['oldrank'];
        		$_SESSION['ok'] = $this->userarray['ok'];
        		if($this->userarray['b1'] > $this->time) {
        			$this->bonus1 = 1;
        		}
        		if($this->userarray['b2'] > $this->time) {
        			$this->bonus2 = 1;
        		}
        		if($this->userarray['b3'] > $this->time) {
        			$this->bonus3 = 1;
        		}
        		if($this->userarray['b4'] > $this->time) {
        			$this->bonus4 = 1;
        		}
        	}

        	private function SurfControl() {
				global $database;
				$conf = $database->config();
        		if(SERVER_WEB_ROOT) {
        			$page = $_SERVER['SCRIPT_NAME'];
        		} else {
        			$explode = explode("/", $_SERVER['SCRIPT_NAME']);
        			$i = count($explode) - 1;
					$maintenance = "maintenance.php";
        			$page = $explode[$i];

        		}
        		$pagearray = array("index.php", "anleitung.php", "tutorial.php", "login.php", "activate.php", "anmelden.php");
        		if(!$this->logged_in) {
        			if(!in_array($page, $pagearray) && $page != "setlang.php" && $page != "contact.php") {
						header("Location: login.php");exit;
        			}
        		} else {
					if (($conf['maintenance']) && ($this->access != 0) && ($this->access != 9) && ($page != $maintenance)) {
						header("Location: maintenance.php");
					}						
        			elseif(in_array($page, $pagearray)) {
        				header("Location: dorf1.php");exit;
        			}

        		}
        	}

		private function checkGoldSilverHack(){
			// global $database;
			// $ud = $database->getUser($this->uid,1);
			// $pgold = $ud['boughtgold']+$ud['giftgold']+$ud['seggold']+$ud['transferedgold']; $ngold = $ud['usedgold'];
			// $gb = $pgold-$ngold;
			// if($ud['gold']<0 || $ud['gold']>$gb){
				// $gb = max(0,$gb);
				// $database->modifyUser($this->uid,'gold',$gb,0);
				// $this->access = 0;
			// }
			// $psilver = $ud['giftsilver']+$ud['gessilver']+$ud['sisilver']; $nsilver = $ud['bisilver'];
			// $sb = $psilver-$nsilver;
			// if($ud['silver']<0 || $ud['silver']>$sb){
				// $database->modifyUser($this->uid,'access',0,0);
				// $this->access = 0;
			// }
		}
        }
        ;

        $session = new Session;
        $form = new Form;
        $message = new Message;

        include("Automation.php");
?>
