<h1 class="titleInHeader">&#1570;&#1587;&#1740;&#1575;&#1576; <span class="level">&#1587;&#1591;&#1581; <?php echo $village->resarray['f'.$id]; ?></span></h1>
<div id="build" class="gid8">
<div class="build_desc">
<a href="#" onClick="return Travian.Game.iPopup(8,4);" class="build_logo">
	<img class="building big white g8" src="img/x.gif" alt="&#1570;&#1587;&#1740;&#1575;&#1576;" title="&#1570;&#1587;&#1740;&#1575;&#1576;" />
</a>
<?php echo B8_DESC; ?></div>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CUR_INC_PROD; ?>:</th>
			<td><b><?php echo $bid8[$village->resarray['f'.$id]]['attri']?$bid8[$village->resarray['f'.$id]]['attri']:'0'; ?></b>%</td>
		</tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
			$loopsame = $building->isCurrent($id)?1:0; $doublebuild = 0;
			if ($loopsame>0 && $building->isLoop($id)) {$doublebuild = 1;}
			$nli = ($loopsame > 0 ? 2:1)+$doublebuild;
			$bindicate = $building->canBuild($id,$village->resarray['f'.$id.'t']);
			$ll = $nli;
			if ($bindicate==10 || $bindicate==1) $ll -= 1;
			for($nc=1;$nc<=$ll;$nc++){?>
				<tr <?php if($nc<$nli) echo 'style="color:#F88C1F;"';?>>
				<th><?php echo NEXT_INC_PROD; echo $village->resarray['f'.$id]+$nc; ?>:</th>
				<td><b><?php echo $bid8[$village->resarray['f'.$id]+$nc]['attri']; ?></b>%</td>
				</tr>
            <?php
			}
        }
        ?>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>