<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/


class Profile {
	
	public function procProfile($post) {
		if(isset($post['ft'])) {
			switch($post['ft']) {
				case "p1":
					$this->updateProfile($post);
				break;
				case "p3":
					$this->updateAccount($post);
				break;
			}
		}
		if(isset($post['s'])) {
			switch($post['s']) {
			case "4":
				$this->gpack($post);
			break;
			}
		}
	}
	
	public function procSpecial($get) {
		global $database,$session;
		if(isset($get['e'])) {
			switch($get['e']) {
				case 2:
					$this->removeMeSit($get);
				break;
				case 3:
					$this->removeSitter($get);
				break;
				case 4:
					$timestamp = $database->isDeleting($session->uid);
					$delduration = max(round(259200/sqrt(SPEED)),3600);
					$cancelduration = $delduration*2/3;
					if($timestamp > time()+$cancelduration) $this->cancelDeleting($get);
				break;
			}
		}
	}
	
	private function updateProfile($post) {  
		global $database;  
		if(!$session->is_sitter){
		$birthday = $post['jahr'].'-'.$post['monat'].'-'.$post['tag'];  
		$database->submitProfile($database->RemoveXSS($post['uid']),$database->RemoveXSS($post['mw']),$database->RemoveXSS($post['ort']),$database->RemoveXSS($birthday),$database->RemoveXSS($post['be2']),$database->RemoveXSS($post['be1']));  
		$varray = $database->getProfileVillages($post['uid']);  
		for($i=0;$i<=count($varray)-1;$i++) {  
		$post['dname'.$i] = preg_replace('/[^(\x20-\x7F)]*/','', $post['dname'.$i]);
			$post['dname'.$i] = filter_var($post['dname'.$i], FILTER_SANITIZE_EMAIL);
			
			$post['dname'.$i] = str_replace("&","",$post['dname'.$i]);
$post['dname'.$i] = trim($post['dname'.$i]);
			if(($post['dname'.$i] == "") || !isset($post['dname'.$i]) || preg_match('/[^0-9A-Za-z]/',$post['dname'.$i])){
				header("Location: dorf1.php");
			}
			else{
			
			$database->setVillageName($database->RemoveXSS($varray[$i]['wref']),$post['dname'.$i]);  
			}
		}  
		header("Location: ?uid=".$post['uid']); 	
				}		
		else{
			header("Location: dorf1.php"); 
		}
	}  	

	private function gpack($post) {
		global $database, $session;
		$database->gpack($database->RemoveXSS($session->uid),$database->RemoveXSS($post['custom_url']));
		header("Location: ?uid=".$session->uid);exit;
	}	
	private function updateAccount($post) {
		global $database,$session,$form;
		if($post['pw2'] == $post['pw3']) {
			if($database->login($session->username,$post['pw1'])) {
				$database->updateUserField($session->uid,"password",md5($post['pw2']),1);
				session_destroy();
			}
			else {
				$form->addError("pw",LOGIN_PW_ERROR);
			}
		}
		else {
			$form->addError("pw",PASS_MISMATCH);
		}

		if($post['email_alt'] == $session->userinfo['email']) {

			$database->updateUserField($session->uid,"email",$post['email_neu'],1);
		}
		else {
			$form->addError("email",EMAIL_ERROR);
		}
		if($post['del'] && md5($post['del_pw']) == $session->userinfo['password']) {
			if($database->isAllianceOwner($session->uid)) {
				$form->addError("del",ALLI_OWNER);
			}
			else {
				$database->setDeleting($session->uid,0);
			}
		}
		else {
			$form->addError("del",PASS_MISMATCH);
		}
		if($post['v1'] != "") {
			$sitid = $database->getUserField($post['v1'],"id",1);
			if($sitid == $session->userinfo['sit1'] || $sitid == $session->userinfo['sit2']) {
				$form->addError("sit",SIT_ERROR);
			}
			else {
				if($session->userinfo['sit1'] == 0) {
					$database->updateUserField($session->uid,"sit1",$sitid,1);
				}
				else if($session->userinfo['sit2'] == 0) {
					$database->updateUserField($session->uid,"sit2",$sitid,1);
				}
			}
		}
		$_SESSION['errorarray'] = $form->getErrors();
		header("Location: spieler.php?s=3");exit;
	}
	
	private function removeSitter($get) {
		global $database,$session;
		if($get['a'] == $session->checker) {
			if($session->userinfo['sit'.$get['type']] == $get['id']) {
				$database->updateUserField($session->uid,"sit".$get['type'],0,1);
			}
			$session->changeChecker();
		}
		header("Location: spieler.php?s=".$get['s']);exit;
	}
	
	private function cancelDeleting($get) {
		global $database,$session;
		$database->setDeleting($session->uid,1);
		header("Location: spieler.php?s=".$get['s']);exit;
	}
	
	private function removeMeSit($get) {
		global $database,$session;
		if($get['a'] == $session->checker) {
			$database->removeMeSit($get['owner'],$session->uid);
			$session->changeChecker();
		}
		header("Location: spieler.php?s=".$get['s']);exit;
	}
};
$profile = new Profile;
?>
