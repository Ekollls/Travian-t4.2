<h1 class="titleInHeader"><?php echo B23;?> <span class="level"> <?php echo LVL.$village->resarray['f'.$id]; ?></span></h1>

<div id="build" class="gid23"><div class="build_desc">
<a href="#" onClick="return Travian.Game.iPopup(23,4);" class="build_logo">
	<img class="building big white g23" src="img/x.gif" alt="<?php echo B23;?>" title="<?php echo B23;?>" />
</a>
<?php echo B23_DESC; ?></div>

	<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th><?php echo ALLCRANNYSIZE;?>:</th>
		<td><b>
        <?php
	$confArtEff = $database->getArtEffConf($village->wid);
	$allCrannySize = 0;
	for($i=19;$i<=40;$i++){
		if($village->resarray['f'.$i.'t']==23){
			if($session->tribe == 3) {
				$allCrannySize += $bid23[$village->resarray['f'.$i]]['attri']*2*STORAGE_MULTIPLIER*$confArtEff;
			} else {
				$allCrannySize += $bid23[$village->resarray['f'.$i]]['attri']*STORAGE_MULTIPLIER*$confArtEff;
			}
		}
	}
	echo $allCrannySize;
        ?>        
        </b><?php echo UNITS;?></td>
	</tr>
	<tr>
		<th><?php echo CRANNYSIZE;?>:</th>
		<td><b>
        <?php
		if($session->tribe == 3) {
		echo $bid23[$village->resarray['f'.$id]]['attri']*2*STORAGE_MULTIPLIER*$confArtEff;
        } else {
        echo $bid23[$village->resarray['f'.$id]]['attri']*STORAGE_MULTIPLIER*$confArtEff;
        }
        ?>        
        </b><?php echo UNITS;?></td>
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
		<th><?php echo CRANNYSIZEAT.' '.($village->resarray['f'.$id]+$nc); ?>:</th>
		<td><b>
        <?php
		if($session->tribe == 3) {
		echo $bid23[$village->resarray['f'.$id]+$nc]['attri']*2*STORAGE_MULTIPLIER*$confArtEff;
        } else {
        echo $bid23[$village->resarray['f'.$id]+$nc]['attri']*STORAGE_MULTIPLIER*$confArtEff;
        }
        ?>
        
        </b><?php echo UNITS;?></td>
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
