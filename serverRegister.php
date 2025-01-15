<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
error_reporting(E_ALL);
if (!file_exists('GameEngine/config.php')) {
header("Location: install/");
}
       include ("GameEngine/Database.php");
       include ("GameEngine/Lang/".$result['lang'].".php");
	   $users1 = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users"));
	   $online1 = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (60*5) AND tribe!=5 AND tribe!=0"));
	   //$users2 = mysql_num_rows(mysql_query("SELECT * FROM s361_users"));
	   //$online2 = mysql_num_rows(mysql_query("SELECT * FROM s361_users WHERE " . time() . "-timestamp < (60*5) AND tribe!=5 AND tribe!=0"));
?>
<h3 class="pop popgreen bold"><?php echo JR_WELCOMETOTRAVIAN; ?></h3>
<h3><?php echo CHOOSE; ?></h3>
<br />
<div class="server serverA serverbig servernormal serverbignormal ">
<a class="link" onclick="" href="anmelden.php" title="<?php echo JR_REGON.' '.JR_SERVER1_NAME; ?>.">
<span class="name"><?php echo JR_SERVER1_NAME; ?></span>
<span class="player" title="<?php echo JR_PLAYERSINTOTAL.': '.$users1-4; ?>"><?php echo $users1-4; ?></span>
<span class="online" title="<?php echo JR_PLAYERSONLINE.': '.$online1; ?>"><?php echo $online1; ?></span>
<span class="start"><?php echo JR_SERVERSTARTED.': '.round((time()-COMMENCE)/86400).' '.JR_DAYSAGO;?></span>
<span class="mark"></span>
<img class="hover" src="img/x.gif">
</a>
</div>
<!--div class="server serverA serverbig servernormal serverbignormal ">
<a class="link" onclick="" href="t36/anmelden.php" title="<?php echo JR_REGON.' '.JR_SERVER2_NAME; ?>.">
<span class="name"><?php echo JR_SERVER2_NAME; ?></span>
<span class="player" title="<?php echo JR_PLAYERSINTOTAL.': '.$users2-4; ?>"><?php echo $users2-4; ?></span>
<span class="online" title="<?php echo JR_PLAYERSONLINE.': '.$online2; ?>"><?php echo $online2; ?></span>
<span class="start"><?php echo JR_SERVERSTARTED.': '.round((time()-COMMENCE)/86400).' '.JR_DAYSAGO;?></span>
<span class="mark"></span>
<img class="hover" src="img/x.gif">
</a>
</div-->