<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
    function clearAndDeleting() {
        global $database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
        $needDelete = $database->getNeedDelete();
        if(count($needDelete) > 0) {
            foreach($needDelete as $need) {
                $needVillage = $database->getVillagesID($need['uid']); //wref
                foreach($needVillage as $village) {
                    $q = "UPDATE ".TB_PREFIX."vdata SET `pop`=-100 where wref = ".$village;
                    $database->query($q);
                }
                $q = "DELETE FROM ".TB_PREFIX."mdata where target = ".$need['uid']." or owner = ".$need['uid'];
                $database->query($q);
                $q = "DELETE FROM ".TB_PREFIX."ndata where uid = ".$need['uid'];
                $database->query($q);

		$userData = $database->getUser($need['uid'],1);
		$gold = min($userData['gold'],$userData['boughtgold']);
		if($gold>0){
			if(DEVEL_MODE==1){
				$remoteHost    = '192.168.92.1';// Domain name
				$target  = '/newHome/gva.php';// Specific program
			} else {
				$remoteHost    = HOMEPAGE;// Domain name 
				$remoteHost = str_ireplace('http://','',$remoteHost);
				$target  = '/gva.php';// Specific program
			}
			$timeout = 30; $port = 80;
			$thisServer = SERVER_NAME;
			$username = $userData['username'];
			$email = $userData['email'];
			$userLang = $userData['lang'];
			$sig = SECSIG;
			$ref = sha1($username.':sig'.$sig.':'.$thisServer.'server:'.$gold.':'.$email);
			$posts = array('server' => $thisServer,
					'username' => $username,
					'email' => $email,
					'lang' => $userLang,
					'gold' => $gold,
					'ref' => $ref); 
			$postValues='';
			foreach($posts as $k=>$v){ 
				$postValues .= urlencode($k)."=".urlencode($v).'&'; 
			} 
			$postValues = substr($postValues, 0, -1); 

			$request  = "POST $target HTTP/1.1\r\n"; 
			$request .= "Host: $remoteHost\r\n";
			$request .= "Connection: close\r\n";

			$lenght = strlen($postValues); 
			$request .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
			$request .= "Content-Length: $lenght\r\n"; 
			$request .= "\r\n"; 
			$request .= $postValues; 

			$socket  = fsockopen($remoteHost, $port, $errno, $errstr, $timeout); 
			fputs($socket,$request); 
			$page = '';
			while (!feof($socket)) {
				$page .= fgets($socket);
			}
			fclose($socket);
			$needle =  'GTAResult:';
			$result = substr($page,stripos($page,$needle)+strlen($needle));
			$resArr = explode('\n',$result);

			$uarr = array();
			foreach($resArr as $ra){
				$tmp = explode('=',$ra);
				if(count($tmp)>=2) $uarr[$tmp[0]]= $tmp[1];
			}

			if (!isset($uarr['resultcode']) || $uarr['resultcode']!='1'){
				$dirname = dirname(__FILE__);
				if(!file_exists($dirname.'/deletingerr.log')){fclose(fopen($dirname.'/deletingerr.log','w'));}
				file_put_contents($dirname.'/deletingerr.log',date('[Y-m-d H:i:s]').' '.$postValues.' ---> ReturnCode:'.(isset($uarr['resultcode'])?$uarr['resultcode']:'NOCODE').PHP_EOL,FILE_APPEND);
			}
		}
                $q = "DELETE FROM ".TB_PREFIX."users where id = ".$need['uid'];
                $database->query($q);
            }
        }

	//ClearUser()

	//if(AUTO_DEL_INACTIVE) {
        //    $time = time()+UN_ACT_TIME;
        //    $q = "DELETE from ".TB_PREFIX."users where timestamp >= $time and act != ''";
        //    $database->query($q);
        //}
		$q = "DELETE FROM ".TB_PREFIX."hero WHERE (SELECT count(id) FROM ".TB_PREFIX."users WHERE ".TB_PREFIX."users.id=".TB_PREFIX."hero.uid)<=0";
        $database->query($q);
		$q = "DELETE FROM ".TB_PREFIX."heroface WHERE (SELECT count(id) FROM ".TB_PREFIX."users WHERE ".TB_PREFIX."users.id=".TB_PREFIX."heroface.uid)<=0";
        $database->query($q);
		$q = "DELETE FROM ".TB_PREFIX."heroitems WHERE (SELECT count(id) FROM ".TB_PREFIX."users WHERE ".TB_PREFIX."users.id=".TB_PREFIX."heroitems.uid)<=0";
        $database->query($q);
	
	//ClearInactive()
        //if(TRACK_USR) {
        //    $timeout = time()-USER_TIMEOUT*60;
        //    $q = "DELETE FROM ".TB_PREFIX."active WHERE timestamp < $timeout";
        //    $database->query($q);
    	//}
    }
?>
