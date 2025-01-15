<?php
$ownartefacts = $database->getOwnArtefactInfo($village->wid);
?>
<div class="gid27">
	<h4 class="round"><?php echo YOURARTES;?></h4>
    <table id="own" cellpadding="1" cellspacing="1">
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
			if(count($ownartefacts)==0) {
				echo '<tr><td colspan="4" class="none">'.YOUHAVENOARTE.'</td></tr>';
			} else {
				foreach($ownartefacts as $artefact){
					if($artefact['size'] == 1) {
						$reqlvl = 10;
						$effect = ARTEAREAVILLAGE;
					} elseif($artefact['size'] == 2 or 3) {
						$reqlvl = 20;
						$effect = ARTEAREAACCOUNT;
					}
					echo '<tr>';
					if(defined( preg_replace("/ /i","",$artefact['name']) )) { $artefact['name'] = constant(preg_replace("/ /i","",$artefact['name'])); } else{ $artefact['name'] = $artefact['name']; }
					echo '<td class="icon"><img class="artefact_icon_' . $artefact['type'] . '" src="img/x.gif"></td>';
					echo '<td class="nam">
									<a href="build.php?id=' . $id . '&show='.$artefact['id'].'">' . $artefact['name'] . '</a> <span class="bon">(' . $artefact['effect'] . ')</span>
									<div class="info">
										'.B27.' <b>' . $reqlvl . '</b>, '.EFFECT.' <b>' . $effect . '</b>
									</div>
								</td>';
					$avname = $database->getVillageField($artefact['vref'], "name");
					if(defined($avname)) $avname = constant($avname);
					echo '<td class="pla"><a href="karte.php?d=' . $artefact['vref']. '&c=' . $generator->getMapCheck($artefact['vref']).'">'.$avname.'</a></td>';
					echo '<td class="dist">' . date("Y.m.d H:i", $artefact['conquered']) . '</td>';
					echo '</tr>';
				}
			}
			?>
        </tbody>
    </table>
	<?php
	$wref = $village->wid;
	$coor = $database->getCoor($wref); $coor['max'] = WORLD_MAX;
	$artefacts = $database->getArtefactInfoByDistance($coor,20,null);
	?>
	<br /><h4 class="round"><?php echo ARTESNEARBY.' '.(count($artefacts));?></h4>
    <table id="near" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <td></td>
                <td><?php echo ARTENAME;?></td>
                <td><?php echo PLAYER;?></td>
                <td><?php echo DISTANCE;?></td>
            </tr>
        </thead>
        <tbody>
			<?php
			if(count($artefacts) == 0) {
				echo '<td colspan="4" class="none">'.NOARTENEARYOU.'</td>';
			} else {
				foreach($artefacts as $artefact) {
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
					echo '<td class="dist">'.$artefact['distance'].'</td>';
					echo '</tr>';
				}
			}
			?>
        </tbody>
    </table>
</div>
