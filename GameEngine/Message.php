<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

        class Message {

        	public $unread, $nunread = false;
        	public $note;
        	public $inbox, $sent, $reading, $reply, $archived, $noticearray, $readingNotice = array();
        	private $totalMessage, $totalNotice;
        	public $allNotice = array();

        	function Message() {
        		$this->getMessages();
        		$this->getNotice();
        		if($this->totalMessage > 0) {
        			$this->unread = $this->checkUnread();
        		}
        		if($this->totalNotice > 0) {
        			$this->nunread = $this->checkNUnread();
        		}
        		if(isset($_SESSION['reply'])) {
        			$this->reply = $_SESSION['reply'];
        			unset($_SESSION['reply']);
        		}
        	}

        	public function procMessage($post) {
        		if(isset($post['ft'])) {
        			switch($post['ft']) {
        				case "m1":
        					$this->quoteMessage($post['id']);
        					break;
        				case "m2":
						include_once "./securimage/securimage.php";
						$securimage = new Securimage();
						if ($securimage->check($_POST['captcha'])) {
							if(strlen($post['be']) > 0 ) {
								if ($post['an'] == "[ally]"){
								$this->sendAMessage($post['an'],$post['be'],$post['message']);
								}else{
								$this->sendMessage($post['an'],$post['be'],$post['message']);
								}header("Location: nachrichten.php?t=2");exit;
							}else{
								echo '<script>alert("نامه نمی تواند بدون موضوع باشد!");</script>';
							};
					
						}else{
							echo '<script>alert("کد امنیتی اشتباه می باشد.");</script>';
						}
        					break;
        				case "m3":
        				case "m4":
        				case "m5":
						//var_dump($post);
        					if(isset($post['delmsg'])) {
        						$this->removeMessage($post);
        					}
        					if(isset($post['archive'])) {
        						$this->archiveMessage($post);
        					}
        					if(isset($post['start'])) {
        						$this->unarchiveMessage($post);
        					}
        					break;
        				case "m6":
        					$this->createNote($post);
        					break;
        			}
        		}
        	}

        	public function noticeType($get) {
        		global $session;
        		if(isset($get['t'])) {
        			if($get['t'] == 4 && !$session->plus) {
        				header("Location: berichte.php");exit;
        			}elseif($get['t'] == 3) {
        				$atttype = array(1, 2, 3, 4, 5, 6, 7);
        				$this->noticearray = $this->filter_by_value($this->allNotice, "ntype", $atttype);
        			}elseif($get['t'] == 1){
        				$type = 8; $this->noticearray = $this->filter_by_value($this->allNotice, "ntype", array($type));
        			} elseif($get['t'] == 2) {
        				$type = 9; $this->noticearray = $this->filter_by_value($this->allNotice, "ntype", array($type));
        			}
        		}
        		if(isset($get['id'])) {
        			$this->readingNotice = $this->getReadNotice($get['id']);
        		}
        	}

        	public function procNotice($post) {
        		if(isset($post["delntc"])) {
        			$this->removeNotice($post);
        		}
        		if(isset($post['archive'])) {
        			$this->archiveNotice($post);
        		}
        		if(isset($post['start'])) {
        			$this->unarchiveNotice($post);
        		}
        	}

        	public function quoteMessage($id) {
        		foreach($this->inbox as $message) {
        			if($message['id'] == $id) {
        				$this->reply = $_SESSION['reply'] = $message;
        				header("Location: nachrichten.php?t=1&id=" . $message['owner']);exit;
        			}
        		}
        	}

        	public function loadMessage($id) {
        		global $database, $session;
        		if($this->findInbox($id)) {
        			foreach($this->inbox as $message) {
        				if($message['id'] == $id) {
        					$this->reading = $message;
        				}
        			}
        		}
        		if($this->findSent($id)) {
        			foreach($this->sent as $message) {
        				if($message['id'] == $id) {
        					$this->reading = $message;
        				}
        			}
        		}
        		if($session->plus && $this->findArchive($id)) {
        			foreach($this->archived as $message) {
        				if($message['id'] == $id) {
        					$this->reading = $message;
        				}
        			}
        		}
        		if($this->reading['viewed'] == 0) {
        			$database->getMessage($id, 4);
        		}
        	}

        	private function filter_by_value_except($array, $index, $value) {
        		$newarray = array();
        		if(is_array($array) && count($array) > 0) {
        			foreach(array_keys($array) as $key) {
        				$temp[$key] = $array[$key][$index];

        				if($temp[$key] != $value) {
        					array_push($newarray, $array[$key]);
        					//$newarray[$key] = $array[$key];
        				}
        			}
        		}
        		return $newarray;
        	}

        	private function filter_by_value($array, $index, $value) {
        		$newarray = array();
        		if(is_array($array) && count($array) > 0) {
        			foreach(array_keys($array) as $key) {
        				$temp[$key] = $array[$key][$index];

        				if(in_array($temp[$key], $value)) {
        					array_push($newarray, $array[$key]);
        					//$newarray[$key] = $array[$key];
        				}
        			}
        		}
        		return $newarray;
        	}

        	private function getNotice() {
        		global $database, $session;
				$this->allNotice = $database->getNotice($session->uid);
        		$this->noticearray = $this->filter_by_value_except($this->allNotice, "ntype", 9);
        		$this->totalNotice = count($this->allNotice);
        	}

        	private function removeMessage($post) {
        		global $database;
        		for($i = 1; $i <= 10; $i++) {
        			if(isset($post['n'.$i]) and is_numeric($post['n'.$i])) {
						$database->delMessage($post['n' . $i]);
        			}
        		}
        		header("Location: nachrichten.php".((isset($_GET['t']) and is_numeric($_GET['t']))?('?t='.$_GET['t']):''));exit;
        	}

        	private function archiveMessage($post) {
        		global $database;
        		for($i = 1; $i <= 10; $i++) {
        			if(isset($post['n'.$i]) and is_numeric($post['n'.$i])) {
        				$database->setArchived($post['n' . $i]);
        			}
        		}
        		header("Location: nachrichten.php".(isset($post['t'])?'?t='.$post['t']:''));exit;
        	}

        	private function unarchiveMessage($post) {
        		global $database;
        		for($i = 1; $i <= 10; $i++) {
        			if(isset($post['n' . $i])) {
        				$database->setNorm($post['n' . $i]);
        			}
        		}
        		header("Location: nachrichten.php".(isset($post['t'])?'?t='.$post['t']:''));exit;
        	}

        	private function removeNotice($post) {
        		global $database;
        		for($i = 1; $i <= 10; $i++) {
        			if(isset($post['n' . $i])) {
        				$database->removeNotice($post['n' . $i], 5);
        			}
        		}
				if(isset($post['t'])){
					header("Location: berichte.php?t=".$post['t']."");exit;
				}else{
					header("Location: berichte.php");exit;
				}
				
        	}

        	private function archiveNotice($post) {
        		global $database;
        		for($i = 1; $i <= 10; $i++) {
        			if(isset($post['n' . $i])) {
        				$database->archiveNotice($post['n' . $i]);
        			}
        		}
        		header("Location: berichte.php".(isset($post['t'])?'?t='.$post['t']:''));exit;
        	}

        	private function unarchiveNotice($post) {
        		global $database;
        		for($i = 1; $i <= 10; $i++) {
        			if(isset($post['n' . $i])) {
        				$database->unarchiveNotice($post['n' . $i]);
        			}
        		}
        		header("Location: berichte.php".(isset($post['t'])?'?t='.$post['t']:''));exit;
        	}

        	private function getReadNotice($id) {
        		global $database;
        		foreach($this->allNotice as $notice) {
        			if($notice['id'] == $id) {
        				$database->noticeViewed($notice['id']);
        				return $notice;
        			}
        		}
        	}

        	public function loadNotes() {
        		global $session;
        		if(file_exists("GameEngine/Notes/" . md5($session->username) . ".txt")) {
        			$this->note = file_get_contents("GameEngine/Notes/" . md5($session->username) . ".txt");
        		} else {
        			$this->note = "";
        		}
        	}

        	private function createNote($post) {
        		global $session;
        		if($session->plus) {
        			$ourFileHandle = fopen("GameEngine/Notes/" . md5($session->username) . ".txt", 'w');
        			fwrite($ourFileHandle, $post['notizen']);
        			fclose($ourFileHandle);
        		}
			header("Location: nachrichten.php".(isset($post['t'])?'?t='.$post['t']:''));exit;
        	}

        	private function getMessages() {
        		global $database, $session;
        		$this->inbox = $database->getMessage($session->uid, 1);
        		$this->sent = $database->getMessage($session->uid, 2);
        		if($session->plus) {
        			$this->archived = $database->getMessage($session->uid, 6);
        		}
        		$this->totalMessage = count($this->inbox) + count($this->sent);
        	}
            
            private function sendAMessage($recieve,$topic,$text) {
                global $session,$database;
                $allmembersQ = mysql_query("SELECT id FROM ".TB_PREFIX."users WHERE alliance='".$session->alliance."'");
                $userally = $database->getUserField($recieve,"alliance",1);
                $permission=mysql_fetch_array(mysql_query("SELECT opt7 FROM ".TB_PREFIX."ali_permission WHERE uid='".$session->uid."'"));
       
                if(WORD_CENSOR) {
                $topic = $this->wordCensor($topic);
                $text = $this->wordCensor($text);
                }
                if($topic == "") {
                $topic = NOSUBJECT;
                }
                if($permission[opt7]==1){  
                if ($userally != 0) {
                while ($allmembers = mysql_fetch_array($allmembersQ)) {
                $database->sendMessage($allmembers[id],$session->uid,$topic,$text,0);
                }        
                    }
                    }
            }
            
        	private function sendMessage($recieve, $topic, $text) {
        		global $session, $database;
        		$user = $database->getUserField($recieve, "id", 1);
        		if(WORD_CENSOR) {
        			$topic = $this->wordCensor($topic);
        			$text = $this->wordCensor($text);
        		}
        		if($topic == "") {
        			$topic = NOSUBJECT;
        		}
        		//if to multihunter
        		if($user == "0") {
        			//make mail server
        			$database->sendMessage($user, $session->uid, $topic, $text, 0);
        			} else {
        			$database->sendMessage($user, $session->uid, $topic, $text, 0);
        			}
        	}

        	//7 = village, attacker, att tribe, u1 - u10, lost %, w,c,i,c , cap
        	//8 = village, attacker, att tribe, enforcement
        	private function sendNotice($from, $vid, $fowner, $owner, $type, $extra) {

        	}

        	public function sendWelcome($uid, $username) {
        		global $database;
        		$welcomemsg = file_get_contents("Templates/welcome.tpl");
        		$welcomemsg = preg_replace("'%USER%'", $username, $welcomemsg);
        		$welcomemsg = preg_replace("'%START%'", date("Y/m/d", COMMENCE), $welcomemsg);
        		$welcomemsg = preg_replace("'%TIME%'", date("H:i", COMMENCE), $welcomemsg);
        		$welcomemsg = preg_replace("'%PLAYERS%'", $database->countUser(), $welcomemsg);
        		$welcomemsg = preg_replace("'%ALLI%'", $database->countAlli(), $welcomemsg);
        		return $database->sendwlcMessage($uid, 0, WEL_TOPIC, $welcomemsg, 0);
        	}

        	private function wordCensor($text) {
        		$censorarray = explode(",", CENSORED);
        		foreach($censorarray as $key => $value) {
        			$censorarray[$key] = "/" . $value . "/i";
        		}
        		return preg_replace($censorarray, "****", $text);
        	}

        	private function checkUnread() {
        		foreach($this->inbox as $message) {
        			if($message['viewed'] == 0) {
        				return true;
        			}
        		}
        		return false;
        	}

        	private function checkNUnread() {
        		foreach($this->allNotice as $notice) {
        			if($notice['viewed'] == 0) {
        				return true;
        			}
        		}
        		return false;
        	}

        	private function findInbox($id) {
        		foreach($this->inbox as $message) {
        			if($message['id'] == $id) {
        				return true;
        			}
        		}
        		return false;
        	}

        	private function findSent($id) {
        		foreach($this->sent as $message) {
        			if($message['id'] == $id) {
        				return true;
        			}
        		}
        		return false;
        	}

        	private function findArchive($id) {
        			if($this->archived['id'] == $id) {
        				return true;
        			}
        		return false;
        	}

        }
        ;

?>
