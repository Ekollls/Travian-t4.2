<h1 class="titleInHeader"><?php echo B25;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>
<div id="build" class="gid25">
<div class="build_desc">
        <a href="#" onClick="return Travian.Game.iPopup(25,4, 'gid');" class="build_logo">
        <img class="building big white g25" src="img/x.gif" alt="<?php echo B25;?>" title="<?php echo B25;?>" /> </a>
       <?php echo B25_DESC;?></div>

<?php
include("upgrade.tpl");
include("25_menu.tpl");
if ($village->capital == 1) {
        echo "<p class=\"none\">&#1583;&#1607;&#1705;&#1583;&#1607; &#1662;&#1575;&#1740;&#1578;&#1582;&#1578; &#1575;&#1587;&#1578;.</p>";
}
if($village->resarray['f'.$id] >= 10){
        include ("25_train.tpl");
}
else{
        echo '<div class="c">'.TOFINDNEWVIL.'</div>';
}



?>
</div><div class="clear">&nbsp;</div>
    <div class="clear"></div>