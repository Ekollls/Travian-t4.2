<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

include("GameEngine/Protection.php");
 
        include_once ("GameEngine/Session.php");
        include_once ("GameEngine/config.php");

        mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
        mysql_select_db(SQL_DB);

/**
 * If user is not administrator, access is denied!
 */
        if($session->access < ADMIN)
        	die(JR_NOT_ADMIN);

/**
 * Functions
 */
        function generateBase($kid, $uid, $username) {
        	global $database, $message;
        	if($kid == 0) {
        		$kid = rand(1, 4);
        	} else {
        		$kid = $_POST['kid'];
        	}

        	$wid = $database->generateBase($kid);
        	$database->setFieldTaken($wid);
        	$database->addVillage($wid, $uid, $username, 1);
        	$database->addResourceFields($wid, $database->getVillageType($wid));
        	$database->addUnits($wid);
        	$database->addTech($wid);
        	$database->addABTech($wid);
        	$database->updateUserField($uid, "access", USER, 1);
        	$message->sendWelcome($uid, $username);
        }

/**
 * Creating account & capital village
 */
        $username = "Natars";
        $password = md5('013ab00e4' . rand(999999999999, 9999999999999999999999999) . 'f248588ed');
        $email = "natars@travianx.com";
        $tribe = 5;
        $desc = "[#natars]";

        $q = "INSERT INTO " . TB_PREFIX . "users (id,username,password,access,email,timestamp,tribe,location,act,protect) VALUES (3, '$username', '$password', " . USER . ", '$email', ".time().", $tribe, '', '', 0)";
        mysql_query($q);
        unset($q);
        $uid = $database->getUserField($username, 'id', 1);
        generateBase(0, $uid, $username);
        $wid = mysql_fetch_assoc(mysql_query("SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = $uid"));
        $q = "UPDATE " . TB_PREFIX . "vdata SET pop = " . rand(700, 950) . " WHERE owner = $uid";
        mysql_query($q) or die(mysql_error());
        $q2 = "UPDATE " . TB_PREFIX . "users SET access = 0 WHERE id = $uid";
        mysql_query($q2) or die(mysql_error());
        if(SPEED > 3) {
        	$speed = 5;
        } else {
        	$speed = SPEED;
        }
        $q3 = "UPDATE " . TB_PREFIX . "units SET u41 = " . (64700 * $speed) . ", u42 = " . (295231 * $speed) . ", u43 = " . (180747 * $speed) . ", u44 = " . (7 * $speed) . ", u45 = " . (364401 * $speed) . ", u46 = " . (217602 * $speed) . ", u47 = " . (2034 * $speed) . ", u48 = " . (1040 * $speed) . " , u49 = " . (1 * $speed) . ", u50 = " . (9 * $speed) . " WHERE vref = " . $wid['wref'] . "";
        mysql_query($q3) or die(mysql_error());
        $q4 = "UPDATE " . TB_PREFIX . "users SET desc2 = '$desc' WHERE id = $uid";
        mysql_query($q4) or die(mysql_error());


/**
 * SMALL ARTEFACTS
 */
        function Artefact($uid, $type, $size, $art_name, $village_name, $desc, $effect, $img) {
        	global $database;
        	$kid = rand(1, 4);
        	$wid = $database->generateBase($kid);
        	$database->addArtefact($wid, $uid, $type, $size, $art_name, $desc, $effect, $img);
        	$database->setFieldTaken($wid);
        	$database->addVillage($wid, $uid, $village_name, '0');
        	$database->addResourceFields($wid, $database->getVillageType($wid));
        	$database->addUnits($wid);
        	$database->addTech($wid);
        	$database->addABTech($wid);
        	mysql_query("UPDATE " . TB_PREFIX . "vdata SET pop = " . rand(10, 200) . " WHERE wref = $wid");
        	mysql_query("UPDATE " . TB_PREFIX . "vdata SET name = '$village_name' WHERE wref = $wid");
        	if(SPEED > 3) {
        		$speed = 5;
        	} else {
        		$speed = SPEED;
        	}
        	if($size == 1) {
        		mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . (rand(1000, 2000) * $speed) . ", u42 = " . (rand(1500, 2000) * $speed) . ", u43 = " . (rand(2300, 2800) * $speed) . ", u44 = " . (rand(25, 75) * $speed) . ", u45 = " . (rand(1200, 1900) * $speed) . ", u46 = " . (rand(1500, 2000) * $speed) . ", u47 = " . (rand(500, 900) * $speed) . ", u48 = " . (rand(100, 300) * $speed) . " , u49 = " . (rand(1, 5) * $speed) . ", u50 = " . (rand(1, 5) * $speed) . " WHERE vref = " . $wid . "");
        		mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 10, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
        	} elseif($size == 2) {
        		mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . (rand(2000, 4000) * $speed) . ", u42 = " . (rand(3000, 4000) * $speed) . ", u43 = " . (rand(4600, 5600) * $speed) . ", u44 = " . (rand(50, 150) * $speed) . ", u45 = " . (rand(2400, 3800) * $speed) . ", u46 = " . (rand(3000, 4000) * $speed) . ", u47 = " . (rand(1000, 1800) * $speed) . ", u48 = " . (rand(200, 600) * $speed) . " , u49 = " . (rand(2, 10) * $speed) . ", u50 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");
        		mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
        	} elseif($size == 3) {
        		mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . (rand(4000, 8000) * $speed) . ", u42 = " . (rand(6000, 8000) * $speed) . ", u43 = " . (rand(9200, 11200) * $speed) . ", u44 = " . (rand(100, 300) * $speed) . ", u45 = " . (rand(4800, 7600) * $speed) . ", u46 = " . (rand(6000, 8000) * $speed) . ", u47 = " . (rand(2000, 3600) * $speed) . ", u48 = " . (rand(400, 1200) * $speed) . " , u49 = " . (rand(4, 20) * $speed) . ", u50 = " . (rand(4, 20) * $speed) . " WHERE vref = " . $wid . "");
        		mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
        	}
        }

/**
 * THE CONSTRUCTION PLANS
 */
		$arttitle = JR_CONSTRUCTION_PLANS_TITLE;
        $vname = JR_CONSTRUCTION_PLANS_VNAME;
		$desc = JR_CONSTRUCTION_PLANS_DESC;
        $effect = '';
        for($i > 1; $i < 10; $i++) {
        	Artefact($uid, 1, 1, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type1.gif');
        }


/**
 * ARCHITECTS
 */
        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_ARCHITECTS_SLIGHT_TITLE;
        $vname = JR_ART_ARCHITECTS_SLIGHT_VNAME;
		$desc = JR_ART_ARCHITECTS_SLIGHT_DESC;
        $effect = '4x';
        for($i > 1; $i < 6; $i++) {
        	Artefact($uid, 2, 1, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_ARCHITECTS_GREAT_TITLE;
        $vname = JR_ART_ARCHITECTS_GREAT_VNAME;
		$desc = JR_ART_ARCHITECTS_GREAT_DESC;
        $effect = '3x';
        for($i > 1; $i < 4; $i++) {
        	Artefact($uid, 2, 2, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_ARCHITECTS_UNIQUE_TITLE;
        $vname = JR_ART_ARCHITECTS_UNIQUE_VNAME;
		$desc = JR_ART_ARCHITECTS_UNIQUE_DESC;
        $effect = '5x';
        for($i > 1; $i < 1; $i++) {
        	Artefact($uid, 2, 3, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
        }


/**
 * THE MILITARY HASTE
 */
        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_MILITARYHASTE_SLIGHT_TITLE;
        $vname = JR_ART_MILITARYHASTE_SLIGHT_VNAME;
		$desc = JR_ART_MILITARYHASTE_SLIGHT_DESC;
        $effect = '2x';
        for($i > 1; $i < 6; $i++) {
        	Artefact($uid, 4, 1, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_MILITARYHASTE_GREAT_TITLE;
        $vname = JR_ART_MILITARYHASTE_GREAT_VNAME;
		$desc = JR_ART_MILITARYHASTE_GREAT_DESC;
        $effect = '1.5x';
        for($i > 1; $i < 4; $i++) {
        	Artefact($uid, 4, 2, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_MILITARYHASTE_UNIQUE_TITLE;
        $vname = JR_ART_MILITARYHASTE_UNIQUE_VNAME;
		$desc = JR_ART_MILITARYHASTE_UNIQUE_DESC;
        $effect = '3x';
        for($i > 1; $i < 1; $i++) {
        	Artefact($uid, 4, 3, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
        }


/**
 * HAWK'S EYESIGHT
 */


        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_HAWKSEYESIGHT_SLIGHT_TITLE;
        $vname = JR_ART_HAWKSEYESIGHT_SLIGHT_VNAME;
		$desc = JR_ART_HAWKSEYESIGHT_SLIGHT_DESC;
        $effect = '5x';
        for($i > 1; $i < 5; $i++) {
        	Artefact($uid, 5, 1, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_HAWKSEYESIGHT_GREAT_TITLE;
        $vname = JR_ART_HAWKSEYESIGHT_GREAT_VNAME;
		$desc = JR_ART_HAWKSEYESIGHT_GREAT_DESC;
        $effect = '3x';
        for($i > 1; $i < 4; $i++) {
        	Artefact($uid, 5, 2, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_HAWKSEYESIGHT_UNIQUE_TITLE;
        $vname = JR_ART_HAWKSEYESIGHT_UNIQUE_VNAME;
		$desc = JR_ART_HAWKSEYESIGHT_UNIQUE_DESC;
        $effect = '10x';
        for($i > 1; $i < 1; $i++) {
        	Artefact($uid, 5, 3, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
        }


/**
 * THE DIET
 */
        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_THEDIET_SLIGHT_TITLE;
        $vname = JR_ART_THEDIET_SLIGHT_VNAME;
		$desc = JR_ART_THEDIET_SLIGHT_DESC;
        $effect = '1/2';
        for($i > 1; $i < 6; $i++) {
        	Artefact($uid, 6, 1, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_THEDIET_GREAT_TITLE;
        $vname = JR_ART_THEDIET_GREAT_VNAME;
		$desc = JR_ART_THEDIET_GREAT_DESC;
        $effect = '3/4';
        for($i > 1; $i < 4; $i++) {
        	Artefact($uid, 6, 2, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
        }
		
		unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_THEDIET_UNIQUE_TITLE;
        $vname = JR_ART_THEDIET_UNIQUE_VNAME;
		$desc = JR_ART_THEDIET_UNIQUE_DESC;
        $effect = '1/2';
        for($i > 1; $i < 4; $i++) {
        	Artefact($uid, 6, 2, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
        }


/**
 * ACADEMIC ADVANCEMENT
 */
		unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_ACADEMICADVANCEMENT_SLIGHT_TITLE;
        $vname = JR_ART_ACADEMICADVANCEMENT_SLIGHT_VNAME;
		$desc = JR_ART_ACADEMICADVANCEMENT_SLIGHT_DESC;
		$effect = '1/2';
        for($i > 1; $i < 6; $i++) {
        	Artefact($uid, 8, 1, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_ACADEMICADVANCEMENT_GREAT_TITLE;
        $vname = JR_ART_ACADEMICADVANCEMENT_GREAT_VNAME;
		$desc = JR_ART_ACADEMICADVANCEMENT_GREAT_DESC;
		$effect = '3/4';
        for($i > 1; $i < 4; $i++) {
        	Artefact($uid, 8, 2, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_ACADEMICADVANCEMENT_UNIQUE_TITLE;
        $vname = JR_ART_ACADEMICADVANCEMENT_UNIQUE_VNAME;
		$desc = JR_ART_ACADEMICADVANCEMENT_UNIQUE_DESC;
		$effect = '1/2';
        for($i > 1; $i < 1; $i++) {
        	Artefact($uid, 8, 3, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
        }


/**
 * RIVAL'S CONFUSION
 */
        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_RIVALSCONFUSION_SLIGHT_TITLE;
        $vname = JR_ART_RIVALSCONFUSION_SLIGHT_VNAME;
		$desc = JR_ART_RIVALSCONFUSION_SLIGHT_DESC;
        $effect = '200x';
        for($i > 1; $i < 6; $i++) {
        	Artefact($uid, 7, 1, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_RIVALSCONFUSION_GREAT_TITLE;
        $vname = JR_ART_RIVALSCONFUSION_GREAT_VNAME;
		$desc = JR_ART_RIVALSCONFUSION_GREAT_DESC;
        $effect = '100x';
        for($i > 1; $i < 4; $i++) {
        	Artefact($uid, 7, 2, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_RIVALSCONFUSION_UNIQUE_TITLE;
        $vname = JR_ART_RIVALSCONFUSION_UNIQUE_VNAME;
		$desc = JR_ART_RIVALSCONFUSION_UNIQUE_DESC;
        $effect = '500x';
        for($i > 1; $i < 1; $i++) {
        	Artefact($uid, 7, 3, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
        }


/**
 * STORAGE MASTER PLAN
 */
		unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_STORAGEMASTERPLAN_SLIGHT_TITLE;
        $vname = JR_ART_STORAGEMASTERPLAN_SLIGHT_VNAME;
		$desc = JR_ART_STORAGEMASTERPLAN_SLIGHT_DESC;
        $effect = '';
        for($i > 1; $i < 6; $i++) {
        	Artefact($uid, 9, 1, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type9.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_STORAGEMASTERPLAN_GREAT_TITLE;
        $vname = JR_ART_STORAGEMASTERPLAN_GREAT_VNAME;
		$desc = JR_ART_STORAGEMASTERPLAN_GREAT_DESC;
        $effect = '';
        for($i > 1; $i < 4; $i++) {
        	Artefact($uid, 9, 2, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type9.gif');
        }


/**
 * ARTEFACT OF THE FOOL
 */
		unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_ARTEFACTOFTHEFOOL_SLIGHT_TITLE;
        $vname = JR_ART_ARTEFACTOFTHEFOOL_SLIGHT_VNAME;
		$desc = JR_ART_ARTEFACTOFTHEFOOL_SLIGHT_DESC;
        $effect = '2x';
        for($i > 1; $i < 6; $i++) {
        	Artefact($uid, 3, 1, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
        }

        unset($i);
        unset($arttitle);
        unset($vname);
		unset($desc);
        unset($effect);
		$arttitle = JR_ART_ARTEFACTOFTHEFOOL_UNIQUE_TITLE;
        $vname = JR_ART_ARTEFACTOFTHEFOOL_UNIQUE_VNAME;
		$desc = JR_ART_ARTEFACTOFTHEFOOL_UNIQUE_DESC;
        $effect = '5x';
        for($i > 1; $i < 1; $i++) {
        	Artefact($uid, 3, 3, $arttitle, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
        }
header("Location: dorf1.php");