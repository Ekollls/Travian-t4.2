<?php
    for ($i=($session->tribe-1)*10+1;$i<=($session->tribe-1)*10+4;$i++) {
        if ($i <> 4 && $i <> 23 && $i <> 24 && ($technology->getTech($i) || $i%10 == 1)) {
				echo "<div class=\"action first\">
                	<div class=\"bigUnitSection\">
						<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
							<img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
						</a>
						<a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.");\">
							<img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\">
						</a>
					</div>
					<div class=\"details\">
						<div class=\"tit\">
							<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\"><img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\"></a>
							<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">".$technology->getUnitName($i)."</a>
							<span class=\"furtherInfo\">(".AVAILABLE.": ".$village->unitarray['u'.$i].")</span>
						</div>
                        <div class=\"showCosts\">
                        <span class=\"resources r1\"><img class=\"r1\" src=\"img/x.gif\" alt=\"".WOOD."\">".(${'u'.$i}['wood'])."</span>
                        <span class=\"resources r2\"><img class=\"r2\" src=\"img/x.gif\" alt=\"".CLAY."\">".(${'u'.$i}['clay'])."</span>
                        <span class=\"resources r3\"><img class=\"r3\" src=\"img/x.gif\" alt=\"".IRON."\">".(${'u'.$i}['iron'])."</span>
                        <span class=\"resources r4\"><img class=\"r4\" src=\"img/x.gif\" alt=\"".CROP."\">".(${'u'.$i}['crop'])."</span>
                        <span class=\"resources r5\"><img class=\"r5\" src=\"img/x.gif\" alt=\"".UPKEEP."\">".${'u199'}['pop']."</span>
                        <div class=\"clear\"></div>
                        <span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"".HRS."\">";
                        $each = $bid19[$village->resarray['f'.$id]]['attri'];
						$hero = $database->getHero($session->uid);
						$heroBonusEffect = 1;
						if ($hero['dead']!=1 && $village->wid==$hero['wref']){
							$heroBonusEffect = 100/(($hero['infantrytrain']*HEROATTRSPEED)+($hero['iteminfantrytrain']*ITEMATTRSPEED)+100);
						}
						$each *= $heroBonusEffect;
						$each /= 100;
						$trainArteEff = $database->getArtEffTrain($village->wid);
						$each *= (${'u'.$i}['time'] * $trainArteEff * 1000)/ SPEED;
						if ($each<2000){
							echo $generator->getMilisecFormat($each);
						} else {
							echo $generator->getTimeFormat(round($each/1000));
						}
						if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
							echo "&nbsp;&nbsp;<button type=\"button\" value=\"npc\" class=\"icon\" onclick=\"window.location.href = 'build.php?gid=17&t=3&r1=".((${'u'.$i}['wood'])*$technology->maxUnitPlus($i))."&r2=".((${'u'.$i}['clay'])*$technology->maxUnitPlus($i))."&r3=".((${'u'.$i}['iron'])*$technology->maxUnitPlus($i))."&r4=".((${'u'.$i}['crop'])*$technology->maxUnitPlus($i))."'; return false;\"><img src=\"img/x.gif\" class=\"npc\" alt=\"npc\"></button>";
						}
						echo "</span><div class=\"clear\"></div></div><span class=\"value\"> </span>
						<input type=\"text\" class=\"text\" name=\"t".$i."\" value=\"0\" maxlength=\"4\">
                        <span class=\"value\"> / </span>
						<a href=\"#\" onClick=\"document.snd.t".$i.".value=".$technology->maxUnit($i,false)."; return false;\">".$technology->maxUnit($i,false)."</a>
					</div></div>
					<div class=\"clear\"></div><br />";
        }
    }
?>
