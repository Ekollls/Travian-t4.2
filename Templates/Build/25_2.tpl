<h1 class="titleInHeader"><?php echo B25;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>
<div id="build" class="gid25">
<div class="build_desc">
        <a href="#" onClick="return Travian.Game.iPopup(25,4, 'gid');" class="build_logo">
        <img class="building big white g25" src="img/x.gif" alt="<?php echo B25;?>" title="<?php echo B25;?>" /> </a>
       <?php echo B25_DESC;?></div>

<?php
include("upgrade.tpl");
include("25_menu.tpl"); ?>

<p><?php echo CPNEEDEDTOEXPAND;?></p>

<table cellpadding="1" cellspacing="1" id="build_value">
<tr>
    <th><?php echo THISCPPRO;?>:</th>
    <td><b><?php echo $database->getVillageField($village->wid, 'cp'); ?></b><?php echo CULTUREPOINTS;?></td>
</tr>
<tr>
    <th><?php echo ALLCPPRO;?>:</th>
    <td><b><?php echo $database->getVSumField($session->uid, 'cp'); ?></b><?php echo CULTUREPOINTS;?></td>
</tr>
<tr>
    <th><?php echo HEROCPPRO;?>:</th>
    <td>
		<b>
			<?php
			$uhero = $database->getHero($session->uid);
			$sumcp = $database->getVSumField($session->uid, 'cp');
			$heroproduction = round(($uhero['cpproduction']*HEROATTRSPEED+$uhero['itemcpproduction']*ITEMATTRSPEED)*$sumcp/100);
			echo $heroproduction;
			?>
		</b><?php echo CULTUREPOINTS;?>
	</td>
</tr>
<tr>
    <th><?php echo TOTALCPPRO;?>:</th>
    <td>
		<b>
			<?php
			echo $heroproduction+$sumcp;
			?>
		</b> &#1575;&#1605;&#1578;&#1740;&#1575;&#1586; &#1601;&#1585;&#1607;&#1606;&#1711;&#1740;
	</td>
</tr>
</table>
<?php $mode = CP; $total = count($database->getProfileVillages($session->uid));?>
<p><?php echo sprintf(NEEDEDCP,'<b>'.(${'cp'.$mode}[$total+1]).'</b>').' '.CULTUREPOINTS.'. '.sprintf(YOUHAVECP,'<b>'.$database->getUserField($session->uid, 'cp',0).'</b>');?> </p>
</div><div class="clear">&nbsp;</div>
    <div class="clear"></div>