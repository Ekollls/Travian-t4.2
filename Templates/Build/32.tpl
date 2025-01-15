<h1 class="titleInHeader"><?php echo B32;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>

    <div id="build" class="gid32">
    <div class="build_desc">
        <a href="#" onClick="return Travian.Game.iPopup(32,4);" class="build_logo">
        <img class="building big white g32" src="img/x.gif" alt="<?php echo B32;?>" title="<?php echo B32;?>"/></a>
        <?php echo B32_DESC; ?> </div>

<table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th>
<?php echo CUR_DEFBON;?>:</th>
            <td><b><?php echo $bid32[$village->resarray['f'.$id]]['attri']?$bid32[$village->resarray['f'.$id]]['attri']:'0'; ?>%</b></td>
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
			<th><?php echo NEXT_DEFBON.' '.($village->resarray['f'.$id]+$nc); ?> </th>
            <td><b><?php echo $bid32[$village->resarray['f'.$id]+$nc]['attri']; ?>%</b></td>
			</tr>
            <?php
            }
		}
            ?>
        </table>
<?php 
include("upgrade.tpl");
?>
        </p>
         </div>