<?php 
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
$heroinfo = $database->getHero($session->uid);

$herounit = array('atk'=>$heroinfo['power'],'off'=>$heroinfo['offBonus'],'def'=>$heroinfo['defBonus'],'product'=>$heroinfo['r0'],'wood'=>$heroinfo['r1'],'clay'=>$heroinfo['r2'],'iron'=>$heroinfo['r3'],'crop'=>$heroinfo['r4'],'pop'=>6,'speed'=>$heroinfo['speed']);

?>
