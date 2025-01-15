<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
		date_default_timezone_set("Asia/Tehran");
        if(file_exists("include/constant.php") && file_exists("include/connection.php")) {
        	include ("include/database.php");
        }
        class Process {

        	function Process() {
        		if(isset($_POST['subconst'])) {
        			$this->constForm();
        		} elseif(isset($_POST['substruc'])) {
        			$this->createStruc();
        		} elseif(isset($_POST['subwdata'])) {
        			$this->createWdata();
        		} elseif(isset($_POST['subacc'])) {
        			$this->createAcc();
        		} else {
        			header("Location: index.php");
        		}
        	}

        	function constForm() {
				global $database;
				
        		$myFile = "include/constant.php";
        		$fh = fopen($myFile, 'w') or die("<br/><br/><br/>Can't open file: install\include\constant.php");
        		$text = file_get_contents("data/constant_format.tpl");
        		$text = preg_replace("'%UTRACK%'", $_POST['trackusers'], $text);
        		$text = preg_replace("'%UTOUT%'", $_POST['timeout'], $text);
        		$text = preg_replace("'%AUTOD%'", $_POST['autodel'], $text);
        		$text = preg_replace("'%AUTODT%'", $_POST['autodeltime'], $text);
        		$text = preg_replace("'%MAX%'", $_POST['wmax'], $text);
        		$text = preg_replace("'%ANAME%'", $_POST['aname'], $text);
        		$text = preg_replace("'%ARANK%'", $_POST['admin_rank'], $text);
        		$text = preg_replace("'%STARTTIME%'", time(), $text);
        		$text = preg_replace("'%LIMIT_MAILBOX%'", $_POST['limit_mailbox'], $text);
        		$text = preg_replace("'%MAX_MAILS%'", $_POST['max_mails'], $text);
        		$text = preg_replace("'%VILLAGE_EXPAND%'", $_POST['village_expand'], $text);
        		$text = preg_replace("'%ERROR%'", $_POST['error'], $text);
        		$text = preg_replace("'%GREAT_WKS%'", $_POST['great_wks'], $text);
        		$text = preg_replace("'%TS_THRESHOLD%'", $_POST['ts_threshold'], $text);
				$text = preg_replace("'%REG_OPEN%'", $_POST['reg_open'], $text);
				$text = preg_replace("'%PEACE%'", $_POST['peace'], $text);
        		fwrite($fh, $text);
				fclose($fh);
				
				$myFile = "include/connection.php";
        		$fh = fopen($myFile, 'w') or die("<br/><br/><br/>Can't open file: install\include\connection.php");
        		$text = file_get_contents("data/connection.tpl");
        		$text = preg_replace("'%SSERVER%'", $_POST['sserver'], $text);
        		$text = preg_replace("'%SUSER%'", $_POST['suser'], $text);
        		$text = preg_replace("'%SPASS%'", $_POST['spass'], $text);
        		$text = preg_replace("'%SDB%'", $_POST['sdb'], $text);
        		$text = preg_replace("'%PREFIX%'", $_POST['prefix'], $text);
        		$text = preg_replace("'%CONNECTT%'", $_POST['connectt'], $text);

        		fwrite($fh, $text);
        		if(file_exists("include/constant.php") && file_exists("include/connection.php")) {
					
					include 'include/database.php';
					$str = file_get_contents("data/config.sql");
        			$str = preg_replace("'%PREFIX%'", TB_PREFIX, $str);
					if(DB_TYPE) {
        				$database->connection->multi_query($str);
        			} else {
        				$database->mysql_exec_batch($str);
        			}
					$qry="CREATE TABLE ".TB_PREFIX."hits(ID int NOT NULL AUTO_INCREMENT,PRIMARY KEY (ID),uid int,IP text,timestamp int,target int) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
					mysql_query($qry);
					$qry="CREATE TABLE ".TB_PREFIX."ads(ID int NOT NULL AUTO_INCREMENT,PRIMARY KEY (ID),url text,banner text) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
					mysql_query($qry);
					$qry="CREATE TABLE ".TB_PREFIX."pitems(ID int NOT NULL AUTO_INCREMENT,PRIMARY KEY (ID),name text,alias text,coin int,status text) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
					mysql_query($qry);
					$q = "INSERT into ".$_POST['prefix']."config (`zmultiplier`,`serial`,`yid`,`relArte`,`relns`,`eachArte`,`server_name`,`lang`,`speed`,`roundlenght`,`gp_locate`,`increase`,`heroattrspeed`,"
						."`itemattrspeed`,`demolish_lvl`,`taskmaster`,`minprotecttime`,`maxprotecttime`,`auctiontime`,`ww`,`auth_email`,`plus_time`,`plus_prodtime`,"
						."`great_wks`,`ts_threshold`,`log_build`,`log_tech`,`log_login`,`log_gold`,`log_admin`,`log_war`,`log_market`,`log_illegal`,"
						."`newsbox1`,`newsbox2`,`newsbox3`,`admin_email`,`domain_url`,`homepage_url`,`server_url`,`natars_max`,`medalinterval`,`commence`,`storagemultiplier`,`secsig`,`blevel`,`cages`) values ('".$_POST['zmultiplier']."','".$_COOKIE['serial']."','".$_POST['yid']."','". (time()+(7*24*60*60)) ."','".(time()+(8*24*60*60))."','43200','"
						.$_POST['servername']."', '".$_POST['lang']."', '".$_POST['speed']."', '".$_POST['roundlenght']."', 'gpack/travian_Travian_4.2_BigBang/', '"
						.$_POST['incspeed']."', '".$_POST['heroattrspeed']."', '".$_POST['itemattrspeed']."', '".$_POST['demolish']."', '"
						.$_POST['quest']."', '".$_POST['minbeginner']."', '".$_POST['maxbeginner']."', '".$_POST['auction_time']."', '".$_POST['ww']."', '"
						.$_POST['activate']."', '".$_POST['plus_time']."', '".$_POST['plus_production']."', '"
						.$_POST['great_wks']."', '".$_POST['ts_threshold']."', '"
						.$_POST['log_build']."', '".$_POST['log_tech']."', '".$_POST['log_login']."', '".$_POST['log_gold_fin']."', '"
						.$_POST['log_admin']."', '".$_POST['log_war']."', '".$_POST['log_market']."', '".$_POST['log_illegal']."', '"
						.$_POST['box1']."', '".$_POST['box2']."', '".$_POST['box3']."', '".$_POST['aemail']."', '".$_POST['domain']."', '".$_POST['homepage']."', '".$_POST['server_url']."', '".$_POST['natars_max']."', '".$_POST['medalinterval']."', '".($_POST['commencediff']+time())."', '".($_POST['storagemultiplier'])."', '".$_POST['secsig']."', '".$_POST['blevel']."', '".$_POST['cages']."')";
					mysql_query($q);
					
					
					
									
					
					
					
					
					
        			header("Location: index.php?s=2");
        		} else {
        			header("Location: index.php?s=1&c=1");
        		}

        		fclose($fh);
        	}

        	function createStruc() {
        		global $database;
        		$str = file_get_contents("data/sql.sql");
        		$str = preg_replace("'%PREFIX%'", TB_PREFIX, $str);
        		if(DB_TYPE) {
        			$result = $database->connection->multi_query($str);
        		} else {
        			$result = $database->mysql_exec_batch($str);
        		}
        		if($result) {
        			header("Location: index.php?s=3");
        		} else {
        			header("Location: index.php?s=2&c=1");
        		}
        	}

        	function createWdata() {
        		header("Location: include/wdata.php");
        	}
            
        }
        ;

        $process = new Process;

?>
