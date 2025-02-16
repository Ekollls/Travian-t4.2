<?php

/*
|--------------------------------------------------------------------------
|   PLEASE DO NOT REMOVE THIS COPYRIGHT NOTICE!
|--------------------------------------------------------------------------  
|
|   Project owner:   Dzoki < dzoki.travian@gmail.com >
|  
|   This script is property of TravianX Project. You are allowed to change
|   its source and release it under own name, not under name `TravianX`. 
|   You have no rights to remove copyright notices.
|
|   TravianX All rights reserved
|
*/

       class Alliance {

       	public $gotInvite = false;
       	public $inviteArray = array();
       	public $allianceArray = array();
       	public $userPermArray = array();

       	public function procAlliance($get) {
       		global $session, $database;

       		if($session->alliance != 0) {
       			$this->allianceArray = $database->getAlliance($session->alliance);
       			// Permissions Array
       			// [id] => id [uid] => uid [alliance] => alliance [opt1] => X [opt2] => X [opt3] => X [opt4] => X [opt5] => X [opt6] => X [opt7] => X [opt8] => X
       			$this->userPermArray = $database->getAlliPermissions($session->uid, $session->alliance);
       		} else {
       			$this->inviteArray = $database->getInvitation($session->uid);
       			$this->gotInvite = count($this->inviteArray) == 0 ? false : true;
       		}
       		if(isset($get['a'])) {
       			switch($get['a']) {
       				case 2:
       					$this->rejectInvite($get);
       					break;
       				case 3:
       					$this->acceptInvite($get);
       					break;
       				default:
       					break;
       			}
       		}
       		if(isset($get['o'])) {
       			switch($get['o']) {
       				case 4:
       					$this->delInvite($get);
       					break;
       				default:
       					break;
       			}
       		}
       	}

       	public function procAlliForm($post) {
       		if(isset($post['ft'])) {
       			switch($post['ft']) {
       				case "ali1":
       					$this->createAlliance($post);
       					break;
       			}

       		}
       		if(isset($_POST['dipl']) and isset($_POST['a_name'])) {
       			$this->changediplomacy($post);
       		}

       		if(isset($post['s'])) {
       			if(isset($post['o'])) {
       				switch($post['o']) {
       					case 1:
       						if(isset($_POST['a'])) {
       							$this->changeUserPermissions($post);
       						}
       						break;
       					case 2:
       						if(isset($_POST['a_user'])) {
       							$this->kickAlliUser($post);
       						}
       						break;
       					case 4:
       						if(isset($_POST['a']) && $_POST['a'] == 4) {
       							$this->sendInvite($post);
       						}
       						break;
       					case 3:
       						$this->updateAlliProfile($post);
       						break;
       					case 11:
       						$this->quitally($post);
       						break;
       					case 100:
       						$this->changeAliName($post);
       						break;
       				}
       			}
       		}
       	}

       	/*****************************************
       	Function to process of sending invitations
       	*****************************************/
       	public function sendInvite($post) {
       		global $form, $database, $session;
       		// \xBFEl campo posee informacion?
       		if(!isset($post['a_name']) || $post['a_name'] == "") {
       			$form->addError("name1", NAME_EMPTY);
       		}
       		// \xBFExiste el usuario?
       		if(!$database->checkExist($post['a_name'], 0)) {
       			$form->addError("name2", NAME_NO_EXIST);
       		}
       		// \xBFLa invitacion es a si mismo?
       		if($post['a_name'] == ($session->username)) {
       			$form->addError("name3", SAME_NAME);
       		}
       		// \xBFEsta ya invitado a la alianza?
       		$UserData = $database->getUserArray($post['a_name'], 0);
       		if($database->getInvitation($UserData['id'])) {
       			$form->addError("name4", OLRADY_INVITED);
       		}
       		// \xBFEsta ya en la alianza?
       		$UserData = $database->getUserArray($post['a_name'], 0);
       		if($UserData['alliance'] == $session->alliance) {
       			$form->addError("name5", OLRADY_IN_ALLY);
       		}
       		// \xBFLa invitaci\xF3n la envia un autorizado?
       		if($this->userPermArray['opt4'] == 0) {
       			$form->addError("perm", NO_PERMISSION);
       		}
       		if($form->returnErrors() != 0) {
       			$_SESSION['errorarray'] = $form->getErrors();
       			$_SESSION['valuearray'] = $post;
       			print_r($form->getErrors());
       		} else {
       			// Obtenemos la informacion necesaria
       			$aid = $session->alliance;
       			// Insertamos invitacion
       			$database->sendInvitation($UserData['id'], $aid, $session->uid);
       			// Log the notice
       			$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1576;&#1575;&#1586;&#1740;&#1705;&#1606;  <a href="spieler.php?uid=' . $UserData['id'] . '">' . $UserData['username'] . '</a> &#1585;&#1575; &#1576;&#1607; &#1575;&#1578;&#1581;&#1575;&#1583; &#1583;&#1593;&#1608;&#1578; &#1705;&#1585;&#1583;.');
       		}
       	}

       	/*****************************************
       	Function to reject an invitation
       	*****************************************/
       	private function rejectInvite($get) {
       		global $database, $session;
       		foreach($this->inviteArray as $invite) {
       			if($invite['id'] == $get['d']) {
       				$database->removeInvitation($get['d']);
       				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1583;&#1593;&#1608;&#1578; &#1585;&#1575; &#1662;&#1587; &#1711;&#1585;&#1601;&#1578;.');
       			}
       		}
       		//header("Location: build.php?id=".$get['id']);
       	}

       	/*****************************************
       	Function to del an invitation
       	*****************************************/
       	private function delInvite($get) {
       		global $database, $session;
       		$inviteArray = $database->getAliInvitations($session->alliance);
       		foreach($inviteArray as $invite) {
       			if($invite['id'] == $get['d']) {
       				$database->removeInvitation($get['d']);
       				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1583;&#1593;&#1608;&#1578; &#1585;&#1575; &#1662;&#1587; &#1711;&#1585;&#1601;&#1578;.');
       			}
       		}
       		//header("Location: build.php?id=".$get['id']);
       	}

       	/*****************************************
       	Function to accept an invitation
       	*****************************************/
       	private function acceptInvite($get) {
       		global $database, $session;
       		foreach($this->inviteArray as $invite) {
       			if($invite['id'] == $get['d']) {
       				$database->removeInvitation($database->RemoveXSS($get['d']));
       				$database->updateUserField($database->RemoveXSS($invite['uid']), "alliance", $database->RemoveXSS($invite['alliance']), 1);
       				$database->createAlliPermissions($database->RemoveXSS($invite['uid']), $database->RemoveXSS($invite['alliance']), '', '0', '0', '0', '0', '0', '0', '0', '0');
       				// Log the notice
       				$database->insertAlliNotice($invite['alliance'], '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1576;&#1607; &#1575;&#1578;&#1581;&#1575;&#1583;&#1740;&#1607; &#1662;&#1740;&#1608;&#1587;&#1578;.');
       			}
       		}
       		header("Location: build.php?id=" . $get['id']);
       	}

       	/*****************************************
       	Function to create an alliance
       	*****************************************/
       	private function createAlliance($post) {
       		global $form, $database, $session, $bid18, $village;
       		if(!isset($post['ally1']) || $post['ally1'] == "") {
       			$form->addError("ally1", ATAG_EMPTY);
       		}
       		if(!isset($post['ally2']) || $post['ally2'] == "") {
       			$form->addError("ally2", ANAME_EMPTY);
       		}
       		if($database->aExist($post['ally1'], "tag")) {
       			$form->addError("ally1", ATAG_EXIST);
       		}
       		if($database->aExist($post['ally2'], "name")) {
       			$form->addError("ally2", ANAME_EXIST);
       		}
       		if($form->returnErrors() != 0) {
       			$_SESSION['errorarray'] = $form->getErrors();
       			$_SESSION['valuearray'] = $post;

       			header("Location: build.php?id=" . $post['id']);
       		} else {
       			$max = $bid18[$village->resarray['f' . $post['id']]]['attri'];
       			$aid = $database->createAlliance($database->RemoveXSS($post['ally1']), $database->RemoveXSS($post['ally2']), $session->uid, $max);
       			$database->updateUserField($database->RemoveXSS($session->uid), "alliance", $database->RemoveXSS($aid), 1);
       			// Asign Permissions
       			$database->createAlliPermissions($database->RemoveXSS($session->uid), $database->RemoveXSS($aid), 'moder', '1', '1', '1', '1', '1', '1', '1', '1');
       			// log the notice
       			$database->insertAlliNotice($session->alliance, '&#1575;&#1578;&#1581;&#1575;&#1583; &#1578;&#1608;&#1587;&#1591; <a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1578;&#1575;&#1587;&#1740;&#1587; &#1588;&#1583;.');
       			header("Location: build.php?id=" . $post['id']);
       		}
       	}

       	/*****************************************
       	Function to change the alliance name
       	*****************************************/
       	private function changeAliName($get) {
       		global $form, $database, $session;
       		if(!$database->isAllianceOwner($session->uid)) {
       			$form->addError("owner", NO_OWNER);
       		}
       		if(!isset($get['ally1']) || $get['ally1'] == "") {
       			$form->addError("ally1", ATAG_EMPTY);
       		}
       		if(!isset($get['ally2']) || $get['ally2'] == "") {
       			$form->addError("ally2", ANAME_EMPTY);
       		}
       		if($database->aExist($get['ally1'], "tag")) {
       			$form->addError("tag", ATAG_EXIST);
       		}
       		if($database->aExist($get['ally2'], "name")) {
       			$form->addError("name", ANAME_EXIST);
       		}
       		if($this->userPermArray['opt3'] == 0) {
       			$form->addError("perm", NO_PERMISSION);
       		}
       		if($form->returnErrors() != 0) {
       			$_SESSION['errorarray'] = $form->getErrors();
       			$_SESSION['valuearray'] = $post;
       			//header("Location: build.php?id=".$post['id']);
       		} else {
       			$database->setAlliName($database->RemoveXSS($session->alliance), $database->RemoveXSS($get['ally2']), $database->RemoveXSS($get['ally1']));
       			// log the notice
       			$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1606;&#1575;&#1605; &#1575;&#1578;&#1581;&#1575;&#1583; &#1585;&#1575; &#1578;&#1594;&#1740;&#1740;&#1585; &#1583;&#1575;&#1583;.');
       		}
       	}

       	/*****************************************
       	Function to create/change the alliance description
       	*****************************************/
       	private function updateAlliProfile($post) {
       		global $database, $session, $form;
       		if($this->userPermArray['opt3'] == 0) {
       			$form->addError("perm", NO_PERMISSION);
       		}
       		if($form->returnErrors() != 0) {
       			$_SESSION['errorarray'] = $form->getErrors();
       			$_SESSION['valuearray'] = $post;
       			//header("Location: build.php?id=".$post['id']);
       		} else {
       			$database->submitAlliProfile($database->RemoveXSS($session->alliance), $database->RemoveXSS($post['be2']), $database->RemoveXSS($post['be1']));
       			// log the notice
       			$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1578;&#1608;&#1590;&#1740;&#1581;&#1575;&#1578; &#1575;&#1578;&#1581;&#1575;&#1583; &#1585;&#1575; &#1578;&#1594;&#1740;&#1740;&#1585; &#1583;&#1575;&#1583;');
       		}
       	}

       	/*****************************************
       	Function to change the user permissions
       	*****************************************/
       	private function changeUserPermissions($post) {
       		global $database, $session, $form;
       		if($this->userPermArray['opt1'] == 0) {
       			$form->addError("perm", NO_PERMISSION);
       		}
       		if($form->returnErrors() != 0) {
       			$_SESSION['errorarray'] = $form->getErrors();
       			$_SESSION['valuearray'] = $post;
       			//header("Location: build.php?id=".$post['id']);
       		} else {
       			$database->updateAlliPermissions($post['a_user'], $session->alliance, $post['a_titel'], $post['e1'], $post['e2'], $post['e3'], $post['e4'], $post['e5'], $post['e6'], $post['e7']);
       			// log the notice
       			$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1583;&#1587;&#1578;&#1585;&#1587;&#1740; &#1607;&#1575; &#1585;&#1575; &#1578;&#1594;&#1740;&#1740;&#1585; &#1583;&#1575;&#1583;.');
       		}

       	}
       	/*****************************************
       	Function to kick a user from alliance
       	*****************************************/
       	private function kickAlliUser($post) {
       		global $database, $session, $form;

       		if($this->userPermArray['opt2'] == 0) {
       			$form->addError("perm", NO_PERMISSION);
       		}
       		if($form->returnErrors() != 0) {
       			$_SESSION['errorarray'] = $form->getErrors();
       			$_SESSION['valuearray'] = $post;
       			//header("Location: build.php?id=".$post['id']);
       		} else {
       			$database->updateUserField($post['a_user'], 'alliance', 0, 1);
       			$database->deleteAlliPermissions($post['a_user']);
       			// log the notice
       			$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1576;&#1575;&#1586;&#1740;&#1705;&#1606; <a href="spieler.php?uid=' . $post['a_user'] . '">' . $UserData['username'] . '</a> &#1585;&#1575; &#1575;&#1582;&#1585;&#1575;&#1580; &#1705;&#1585;&#1583;.');
       			//header("Location: build.php?id=".$post['id']);
       		}
       	}
       	/*****************************************
       	Function to quit from alliance
       	*****************************************/
       	private function quitally($post) {
       		global $database, $session, $form;
       		if(!isset($post['pw']) || $post['pw'] == "") {
       			$form->addError("pw1", PW_EMPTY);
       		} elseif(md5($post['pw']) !== $session->userinfo['password']) {
       			$form->addError("pw2", PW_ERR);
       		} else {
       			$database->updateUserField($session->uid, 'alliance', 0, 1);
       			$database->deleteAlliPermissions($session->uid);
       			$database->deleteAlliance($session->alliance);
       			$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> &#1575;&#1578;&#1581;&#1575;&#1583;&#1740;&#1607; &#1585;&#1575; &#1578;&#1585;&#1705; &#1705;&#1585;&#1583;');
       			header("Location: dorf1.php");
       		}
       	}

       	private function changediplomacy($post) {
       		global $database, $session, $form;

       		$aName = $database->RemoveXSS($_POST['a_name']);
       		$aType = (int)intval($_POST['dipl']);
       		if($database->aExist($aName, "tag")) {
       			if($database->getAllianceID($aName) != $session->alliance) {
       				if($aType >= 1 and $aType <= 3) {
       					if(!$database->diplomacyInviteCheck($database->getAllianceID($aName), $session->alliance)) {
       						$database->diplomacyInviteAdd($session->alliance, $database->getAllianceID($aName), $aType);
       						$form->addError("name", "&#1583;&#1593;&#1608;&#1578;&#1606;&#1575;&#1605;&#1607; &#1601;&#1585;&#1587;&#1578;&#1575;&#1583;&#1607; &#1588;&#1583;");
       					} else {
       						$form->addError("name", "&#1602;&#1576;&#1604;&#1575; &#1583;&#1593;&#1608;&#1578;&#1606;&#1575;&#1605;&#1607; &#1601;&#1585;&#1587;&#1578;&#1575;&#1583;&#1607; &#1588;&#1583;&#1607; &#1576;&#1608;&#1583;");
       					}

       				} else {
       					$form->addError("name", "&#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1575;&#1588;&#1578;&#1576;&#1575;&#1607; &#1587;&#1575;&#1582;&#1578;&#1607; &#1588;&#1583;&#1607; &#1575;&#1587;&#1578;");
       				}
       			} else {
       				$form->addError("name", "&#1606;&#1605;&#1740;&#1578;&#1608;&#1575;&#1606;&#1740;&#1583; &#1583;&#1593;&#1608;&#1578; &#1705;&#1606;&#1740;&#1583;");
       			}
       		} else {
       			$form->addError("name", "&#1575;&#1578;&#1581;&#1575;&#1583; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583;");
       		}
       	}
       }

       $alliance = new Alliance;

?>