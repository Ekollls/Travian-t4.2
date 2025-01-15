<h1 class="titleInHeader"><?php echo B25;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>
<div id="build" class="gid25">
<div class="build_desc">
        <a href="#" onClick="return Travian.Game.iPopup(25,4, 'gid');" class="build_logo">
        <img class="building big white g25" src="img/x.gif" alt="<?php echo B25;?>" title="<?php echo B25;?>" /> </a>
       <?php echo B25_DESC;?></div>
<?php
include("upgrade.tpl"); include("25_menu.tpl"); ?>
<?php echo sprintf(VILLAGELOYALTY,'<b>'.$database->getVillageField($village->wid, 'loyalty').'</b>%').'<br><br><b>'.CANTCAPTURECAPITALS.'</b></div>';?>