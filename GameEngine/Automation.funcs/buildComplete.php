<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
    function buildComplete() {
	global $database,$bid18,$bid10,$bid11,$bid38,$bid39;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
        $time = time();
        $array = array();
        $q = "SELECT * FROM ".TB_PREFIX."bdata where timestamp <= $time";
        $array = $database->query_return($q);
        foreach($array as $indi) {
            $q = "UPDATE ".TB_PREFIX."fdata set f".$indi['field']." = ".$indi['level'].", f".$indi['field']."t = ".$indi['type']." where vref = ".$indi['wid'];
		if($indi['level']==100 && $indi['type']==40) {
        		$cfg = $database->query_return("SELECT * FROM ".TB_PREFIX."config");
			if($cfg[0]['winmoment']<=0){ $database->query("UPDATE ".TB_PREFIX."config set winmoment = ".time());}
		}
            if($database->query($q)) {
                $level = $database->getFieldLevel($indi['wid'],$indi['field']);
                $pop = getPop($indi['type'],($level-1));
                $database->modifyPop($indi['wid'],$pop[0],0);
                $database->addCP($indi['wid'],$pop[1]);
                if($indi['type'] == 18) {
                    $owner = $database->getVillageField($indi['wid'],"owner");
                    $max = $bid18[$level]['attri'];
                    $q = "UPDATE ".TB_PREFIX."alidata set max = $max where leader = $owner";
                    $database->query($q);
                }

                    if($indi['type'] == 10) {
                      $max=$database->getVillageField($indi['wid'],"maxstore");
                      if($level=='1' && $max==STORAGE_BASE){ $max-=STORAGE_BASE; }
                      if($level>1) $max-=$bid10[$level-1]['attri']*STORAGE_MULTIPLIER;      
                      $max+=$bid10[$level]['attri']*STORAGE_MULTIPLIER;  
                      $database->setVillageField($indi['wid'],"maxstore",$max);
                    }
                    
                    if($indi['type'] == 11) {
                      $max=$database->getVillageField($indi['wid'],"maxcrop");
                      if($level=='1' && $max==STORAGE_BASE){ $max-=STORAGE_BASE; }
                      if($level>1) $max-=$bid11[$level-1]['attri']*STORAGE_MULTIPLIER;      
                      $max+=$bid11[$level]['attri']*STORAGE_MULTIPLIER; 
                      $database->setVillageField($indi['wid'],"maxcrop",$max);
                    }
                    if($indi['type'] == 38) {
                    $max=$database->getVillageField($indi['wid'],"maxstore");
                    if($level=='1' && $max==STORAGE_BASE){ $max-=STORAGE_BASE; }
                    if($level>1)$max-=$bid38[$level-1]['attri']*STORAGE_MULTIPLIER;      
                    $max+=$bid38[$level]['attri']*STORAGE_MULTIPLIER;  
                    $database->setVillageField($indi['wid'],"maxstore",$max);
                    }

                    if($indi['type'] == 39) {
                    $max=$database->getVillageField($indi['wid'],"maxcrop");
                    if($level=='1' && $max==STORAGE_BASE){ $max-=STORAGE_BASE; }
                    if($level>1)$max-=$bid39[$level-1]['attri']*STORAGE_MULTIPLIER;      
                    $max+=$bid39[$level]['attri']*STORAGE_MULTIPLIER; 
                    $database->setVillageField($indi['wid'],"maxcrop",$max);
                    }      
          
                $q4 = "UPDATE ".TB_PREFIX."bdata set loopcon = 0 where loopcon = 1 and wid = ".$indi['wid'];
                $database->query($q4);
                $q = "DELETE FROM ".TB_PREFIX."bdata where id = ".$indi['id'];
                $database->query($q);
            }
        }
    }

?>
