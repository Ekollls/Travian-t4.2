<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
		date_default_timezone_set("Asia/Tehran");

		define('_ADMINEXEC_',1);
        include ("../../Admin/admin.model.php");
		
        include ("../../GameEngine/config.php");
        include ("../../GameEngine/Database/db_MYSQL.php");
        include ("../../GameEngine/lang/en.php");

        mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
        mysql_select_db(SQL_DB);
		
		$StartNatars = true;
		$admin = new adminModel();
		$database = new MYSQL_DB;
/**
 * Functions
 */
        
        if(isset($_POST['mhpw'])) {
        	$password = $_POST['mhpw'];
        	mysql_query("UPDATE " . TB_PREFIX . "users SET password = '" . md5($password) . "' WHERE username = 'Multihunter'");
			mysql_query("UPDATE " . TB_PREFIX . "users SET password = '" . md5($password) . "' WHERE username = 'Support'");
        	$wid = $admin->getWref(1, 0);
        	$uid = 4;
        	$status = $database->getVillageState($wid);
        	if($status == 0) {
        		$database->setFieldTaken($wid);
        		$database->addVillage($wid, $uid, 'Multihunter', '1');
        		$database->addResourceFields($wid, $database->getVillageType($wid));
        		$database->addUnits($wid);
        		$database->addTech($wid);
        		$database->addABTech($wid);
        	}
        }


if($StartNatars){
		$username = "Natars";
        $password = $_POST['mhpw'];
        $email = "natars@trvin.ir";
        $desc = "[#natars]";
		$uid = 2;

        mysql_query("INSERT INTO " . TB_PREFIX . "users (id,username,password,access,email,timestamp,desc2,tribe,location,act,protect,quest,fquest) VALUES ('$uid', 'Natars', '" . md5($password) . "', 2, '$email', ".time().", '$desc', 5, '', '', 0, 25, 35)");
        
        $wid = $admin->getWref(0, 0);
        $status = $database->getVillageState($wid);
        if($status == 0) {
        	$database->setFieldTaken($wid);
        	$database->addVillage($wid, $uid, 'Natars', '1');
        	$database->addResourceFields($wid, $database->getVillageType($wid));
        	$database->addUnits($wid);
        	$database->addTech($wid);
        	$database->addABTech($wid);
        }
        mysql_query("UPDATE " . TB_PREFIX . "vdata SET pop = '781' WHERE owner = $uid") or die(mysql_error());
        mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . (274700 * SPEED) . ", u42 = " . (995231 * SPEED) . ", u43 = 10000, u44 = " . (3048 * SPEED) . ", u45 = " . (964401 * SPEED) . ", u46 = " . (617602 * SPEED) . ", u47 = " . (6034 * SPEED) . ", u48 = " . (3040 * SPEED) . " , u49 = 1, u50 = 9 WHERE vref = " . $wid['wref'] . "") or die(mysql_error());

	for($i=1;$i<=13;$i++){
		$nareadis = NATARS_MAX;
		do{
			$x = rand(3,intval(floor(NATARS_MAX)));if(rand(1,10)>5)$x = $x*-1;
			$y = rand(3,intval(floor(NATARS_MAX)));if(rand(1,10)>5)$y = $y*-1;
			$dis = sqrt(($x*$x)+($y*$y));
			$wid = $admin->getWref($x, $y);
			$status = $database->getVillageState($wid);
		}while(($dis>$nareadis) || $status!=0);
        if($status == 0) {
        	$database->setFieldTaken($wid);
        	$database->addVillage($wid, $uid, 'Natars', '1');
        	$database->addResourceFields($wid, $database->getVillageType($wid));
        	$database->addUnits($wid);
        	$database->addTech($wid);
        	$database->addABTech($wid);
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET pop = '238' WHERE wref = '$wid'");
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET name = 'دهکده شگفتی جهان' WHERE wref = '$wid'");
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET capital = 0 WHERE wref = '$wid'");
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET natar = 1 WHERE wref = '$wid'");
			//mysql_query("INSERT INTO " . TB_PREFIX . "fdata(vref) VALUES('".$wid."')"); // this is the fix :|
			mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = 10000, u42 = 12000, u43 = 1000, u44 = 500, u45 = 200, u46 = 700, u47 = 800, u48 = 900 , u49 = 0, u50 = 9 WHERE vref = " . $wid . "");
			mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 10, f19t = 23, f19 = 10, f99t = 40, f26 = 0, f26t = 0, f21 = 1, f21t = 15, f39 = 1, f39t = 16 WHERE vref = " . $wid . "");
        }
	}
}

        header("Location: ../index.php?s=5");

?>