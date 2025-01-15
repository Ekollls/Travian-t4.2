<h1 class="titleInHeader"><?php echo B12;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>
<div id="build" class="gid13">
<div class="build_desc">
<a href="#" onClick="return Travian.Game.iPopup(12,4);" class="build_logo">
<img class="building big white g13" src="img/x.gif" alt="<?php echo B12;?>" title="<?php echo B12;?>" />
</a>
<?php
echo B12_DESC;
include("upgrade.tpl");
	if ($building->getTypeLevel(12) > 0) {
		include("12_upgrades.tpl");
	} else {
		echo "<p><b>The last level is possible.</b><br>\n";
	}
?>
</div>
</div>
