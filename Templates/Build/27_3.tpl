<h1 class="titleInHeader"><?php echo B27;?> <span class="level"><?php echo LVL.$village->resarray['f'.$id]; ?></span></h1>
<div id="build" class="gid27">
    <div class="build_desc">
        <a href="#" onClick="return Travian.Game.iPopup(27,4);" class="build_logo">
			<img class="building big white g27" src="img/x.gif" alt="<?php echo B27;?>" title="<?php echo B27;?>">
		</a>
        <?php echo B27_DESC;?>
	</div>
	<?php
	include("upgrade.tpl");
	include ("27_menu.tpl");
	?>
	<h4 class="round"><?php echo BIGARTES;?></h4>
	<table id="show_artefacts" cellpadding="1" cellspacing="1">
		<thead>
			<tr>
				<td></td>
				<td><?php echo ARTENAME;?></td>
				<td><?php echo VILLAGE;?></td>
				<td><?php echo DATE;?></td>
    		</tr>
    		</thead>
   		<tbody>
			<?php
			$sizes[]=2;
			$sizes[]=3;
			$artefacts = $database->getArtefactInfo($sizes);
			if(count($artefacts)==0) {
				echo '<td colspan="4" class="none">'.NOBIGARTES.'</td>';
			} else {
				$curtype = 0;
				foreach($artefacts as $artefact) {
					if($artefact['type']!=$curtype){
						echo '<tr><td colspan="4" class="empty"></td></tr>';
						echo '<tr><td colspan="4" class="empty"></td></tr>';
						$curtype = $artefact['type'];
					}
					echo '<tr>';
					echo '<td class="icon"><img class="artefact_icon_' . $artefact['type'] . '" src="img/x.gif" alt="" title=""></td>';
					echo '<td class="nam">';
					if(defined( preg_replace("/ /i","",$artefact['name']) )) { $artefact['name'] = constant(preg_replace("/ /i","",$artefact['name'])); } else{ $artefact['name'] = $artefact['name']; }
					echo '<a href="build.php?id=' . $id . '&show='.$artefact['id'].'">' . $artefact['name'] . '</a> <span class="bon">(' . $artefact['effect'] . ')</span>';
					echo '<div class="info">';
					if($artefact['size'] == 1) {
						$reqlvl = 10;
						$effect = ARTEAREAVILLAGE;
					} elseif($artefact['size'] == 2 or $artefact['size'] == 3) {
						$reqlvl = 20;
						$effect = ARTEAREAACCOUNT;
					}
					echo '<div class="info">'.B27.' <b>' . $reqlvl . '</b>, '.EFFECT.' <b>' . $effect . '</b>';
					echo '</div></td><td class="pla"><a href="karte.php?d=' . $artefact['vref'] . '&c=' . $generator->getMapCheck($artefact['vref']) . '">' . $database->getUserField($artefact['owner'], "username", 0) . '</a></td>';
					echo '<td class="date">'.($artefact['owner']!=2 ? date('Y-m-d H:i:s',$artefact['conquered']):'-').'</td>';
					echo '</tr>';
				}
			}
			?>
		</tbody>
	</table>
</div>
