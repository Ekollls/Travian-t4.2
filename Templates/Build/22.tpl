<h1 class="titleInHeader"><?php echo B22;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>

<div id="build" class="gid22">
<div class="build_desc">
<a href="#" onClick="return Travian.Game.iPopup(22,4);" class="build_logo">

	<img class="building big white g22" src="img/x.gif" alt="<?php echo B22;?>" title="<?php echo B22;?>" />
</a><?php echo B22_DESC;?></div>
<?php
include("upgrade.tpl");
?>
<div class="clear"></div>

<?php
	if ($building->getTypeLevel(22) > 0) {
		include("22_".$session->tribe.".tpl");
	} else {
		echo "<p><b>".NORESEARCHAVAILABLE."</b><br></p>";
	}
?>

         </div>
<div class="clear">&nbsp;</div>
<div class="clear"></div>