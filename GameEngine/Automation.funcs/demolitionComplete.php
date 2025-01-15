<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
    function demolitionComplete() {
        global $database;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
        $varray = $database->getDemolition();
        foreach($varray as $vil) {
            if ($vil['timetofinish'] <= time()) {
                $type = $database->getFieldType($vil['vref'],$vil['buildnumber']);
                $level = $database->getFieldLevel($vil['vref'],$vil['buildnumber']);
                $buildarray = $GLOBALS["bid".$type];
                if ($type==10 || $type==38) {
                    $q = "UPDATE `".TB_PREFIX."vdata` SET `maxstore`=`maxstore`-".($buildarray[$level]['attri']*STORAGE_MULTIPLIER)."+".(isset($buildarray[$level-1]['attri'])?$buildarray[$level-1]['attri']*STORAGE_MULTIPLIER:0)." WHERE wref=".$vil['vref'];
                    $database->query($q);
                    $q = "UPDATE ".TB_PREFIX."vdata SET `maxstore`=".STORAGE_BASE." WHERE `maxstore`<= ".STORAGE_BASE." AND wref=".$vil['vref'];
                    $database->query($q);
                }
                if ($type==11 || $type==39) {
                    $q = "UPDATE `".TB_PREFIX."vdata` SET `maxcrop`=`maxcrop`-".($buildarray[$level]['attri']*STORAGE_MULTIPLIER)."+".(isset($buildarray[$level-1]['attri'])?$buildarray[$level-1]['attri']*STORAGE_MULTIPLIER:0)." WHERE wref=".$vil['vref'];
                    $database->query($q);
                    $q = "UPDATE ".TB_PREFIX."vdata SET `maxcrop`=".STORAGE_BASE." WHERE `maxcrop`<=".STORAGE_BASE." AND wref=".$vil['vref'];
                    $database->query($q);
                }
                if ($level==1 && $type!=40) { $clear=",f".$vil['buildnumber']."t=0"; } else { $clear=""; }
                $q = "UPDATE ".TB_PREFIX."fdata SET f".$vil['buildnumber']."=".($level-1).$clear." WHERE vref=".$vil['vref'];
                $database->query($q);
                $pop=getPop($type,$level-1);
                $database->modifyPop($vil['vref'],$pop[0],1);
                $database->delDemolition($vil['vref']);
            }
        }
    }
?>
