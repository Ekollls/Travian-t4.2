<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
    function culturePoints() {
        global $database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
        $time = time()-(43200/SPEED);
        $array = array();
        $q = "SELECT ".TB_PREFIX."users.id, ".TB_PREFIX."users.lastupdate, cpproduction, itemcpproduction FROM "
			.TB_PREFIX."users,".TB_PREFIX."hero where ".TB_PREFIX."users.lastupdate < $time AND ".TB_PREFIX."hero.uid=".TB_PREFIX."users.id";
        $array = $database->query_return($q);
        foreach($array as $indi) {
            if($indi['lastupdate'] < $time){
				$cp = $database->getVSumField($indi['id'], 'cp');
				$cprate = ($indi['cpproduction']*HEROATTRSPEED+$indi['itemcpproduction']*ITEMATTRSPEED+100)/100;
				$cp *= $cprate;
				$part = (time()-$indi['lastupdate'])/86400;
				$cp *= $part;
                $newupdate = time();
                $q = "UPDATE ".TB_PREFIX."users set cp = cp + $cp, lastupdate = $newupdate where id = '".$indi['id']."'";
                $database->query($q);
            }
        }
    }
?>
