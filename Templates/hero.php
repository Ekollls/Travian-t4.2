<?php 
$hero_levels = $GLOBALS["hero_levels"];

$hero = $database->getHero($session->uid);
$tribe = $session->tribe;
$hero_t = $GLOBALS["hero_t".$tribe];
$heroid = $hero['heroid'];
if(isset($_GET['r'])==1 && $hero['dead']==1){
	$each = ($hero_t[$hero['level']]['time']/SPEED);
	$hwood = $hero_t[$hero['level']]['wood'];$hclay = $hero_t[$hero['level']]['clay'];$hiron = $hero_t[$hero['level']]['iron'];$hcrop = $hero_t[$hero['level']]['crop'];
	//var_dump($hwood);die;
	$endat = time()+$each;
	$each *= 1000;
	$database->trainHero($village->wid, $each,$endat, 0);
	$database->modifyResource($village->wid,$hwood,$hclay,$hiron,$hcrop,0);
    $database->modifyHero($session->uid,0,'wref', $village->wid, 0);
}
if(isset($_GET['add'])){
	if($hero['points']>0){
		if(isset($_GET['add']) && $_GET['add']=='power' && $hero['power']<100){
			$database->modifyHero(0,$heroid, 'power', 1, 1);
			$database->modifyHero(0,$heroid, 'points', 1, 2);
		}elseif(isset($_GET['add']) && $_GET['add']=='offBonus' && $hero['offBonus']<100){
			$database->modifyHero(0,$heroid, 'offBonus', 1, 1);
			$database->modifyHero(0,$heroid, 'points', 1, 2);
		}elseif(isset($_GET['add']) && $_GET['add']=='defBonus' && $hero['defBonus']<100){
			$database->modifyHero(0,$heroid, 'defBonus', 1, 1);
			$database->modifyHero(0,$heroid, 'points', 1, 2);
		}elseif(isset($_GET['add']) && $_GET['add']=='productionPoints' && $hero['product']<100){
			$database->modifyHero(0,$heroid, 'product', 1, 1);
			$database->modifyHero(0,$heroid, 'points', 1, 2);
		}
	}
}

if(isset($_GET['product'])){
	for($i=0;$i<=4;$i++){
    	if($_GET['product'] == 'r'.$i){
    		$database->modifyHero(0,$heroid, 'r'.$i, 1, 0);
        }else{
        	$database->modifyHero(0,$heroid, 'r'.$i, 0, 0);
        }
    }
}

$hero = $database->getHero($session->uid);
$powerPStyle = " hidden";
$offBonusPStyle = " hidden";
$defBonusPStyle = " hidden";
$productPStyle = " hidden";
if($hero['points'] > 0){
	if($hero['power'] < 100) $powerPStyle = "";
	if($hero['offBonus'] < 100) $offBonusPStyle = "";
	if($hero['defBonus'] < 100) $defBonusPStyle = "";
	if($hero['product'] < 100) $productPStyle = "";
}
$plevel = $hero['level']-1;
$heroWrefC = $generator->getMapCheck($hero['wref']);
$rp = 3*SPEED*$hero['product'];


/***************************** HERO's POSTION <START> *****************************/
$isha = 0;
foreach($session->villages as $vill) {
	if($database->getHUnit($vill)) { 
		$isha ++;
		$tvwhe = $vill;
	}
}
if($isha > 0) {
	$vill = $database->getVillage($tvwhe);
	$villc = $database->getCoor($vill['wref']);
	$hLoc = VILLAGE." <a href='karte.php?x=".$villc['x']."&y=".$villc['y']."'>". $vill['name']."</a>";
}else{
	$foundHero = "no";
	foreach($session->villages as $villagee) {
		$result = mysql_query("SELECT * FROM ".TB_PREFIX."movement WHERE `from` = '".$villagee."' OR `to` = '".$villagee."' AND proc = 0");
		while($row = mysql_fetch_array($result)) {
			$result2 = mysql_query("SELECT * FROM ".TB_PREFIX."attacks WHERE id = ".$row['ref']." AND t11 = 1");
			if(mysql_num_rows($result2) > 0) {
				$foundHero = "yes";
				$hgt = $row;
				$from = $database->getVillage($hgt['from']);
				$to = $database->getVillage($hgt['to']);
				$fromc = $database->getCoor($from['wref']);
				$toc = $database->getCoor($to['wref']);
				
				if(strlen($to['name']) < 1) {
					$to['name'] = UNOCCUPIEDOASES;
					$result3 = mysql_query("SELECT * FROM ".TB_PREFIX."wdata WHERE id = ".$hgt['to']);
					$row3 = mysql_fetch_array($result3);
					$to['x'] = $row3['x'];
					$to['y'] = $row3['y'];
				}
				if(strlen($to['x']) < 1 || strlen($to['y']) < 1) {
					$result3 = mysql_query("SELECT * FROM ".TB_PREFIX."wdata WHERE id = ".$hgt['to']);
					$row3 = mysql_fetch_array($result3);
					$to['x'] = $row3['x'];
					$to['y'] = $row3['y'];
				}
				$hLoc = MOVING_FROM." <a href='karte.php?x=".$fromc['x']."&y=".$fromc['y']."'>".$from['name']."</a> ".LN_TO." <a href='karte.php?x=".$to['x']."&y=".$to['y']."'>".$to['name']."</a>";
			}else{
				$heroia = "yes";
			}
			if($foundHero == "yes") { break; }
		}
		if($foundHero == "yes") { break; }
	}
	
	if($heroia == "yes" && !$to['x'] && !$to['y']) {
		// fix here...
		$foundHero = "yes";
		$vill = $database->getVillage($hero['wref']);
		$villc = $database->getCoor($vill['wref']);
		//$hLoc = "در حال حرکت از دهکده <a href='karte.php?x=". $villc['x'] ."&y=". $villc['y'] ."'>". $vill['name']."</a> به ماجراجویی";
		$hLoc = IS_ON_ADVENTURE;
	}
}




if($hero['health'] == "0" || $hero['dead'] == "1") {
	//$hLoc = "قهرمان مرده است!";
	$vill = $database->getVillage($hero['wref']);
	$villc = $database->getCoor($vill['wref']);
	$hLoc = VILLAGE." <a href='karte.php?x=".$villc['x']."&y=".$villc['y']."'>". $vill['name']."</a>";

}

/***************************** HERO's POSTION </END> *****************************/

ob_start();
?>
<div id="attributes">
<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">

<div class="attribute health tooltip">

			<div class="element attribName"><?=LOCATION?></div>
			<div class="element"><span><?=$hLoc?></span></div>
			

		</div>

		<div class="clear"></div>
			</div>
  </div>	<div class="boxes boxesColor gray">
		<div class="boxes-tl"></div>
		<div class="boxes-tr"></div>
		<div class="boxes-tc"></div>
		<div class="boxes-ml"></div>
		<div class="boxes-mr"></div>
		<div class="boxes-mc"></div>
		<div class="boxes-bl"></div>
		<div class="boxes-br"></div>
		<div class="boxes-bc"></div>
		<div class="boxes-contents">
			<div class="attribute headline">
				<div class="attributesHeadline"><?php echo JR_HEROATTRIBUTES; ?></div>
				<div class="pointsHeadline"><?php echo POINT; ?></div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="attribute power tooltip" title="<?php echo FSTITLE.': <font color=\'#11ff44\'>'.($hero['itemfs']+100+$hero['fsperpoint']*$hero['power']).'</font>'; ?><br/><font color='#5dcbfb'><?php echo FS.': '.(100+$hero['fsperpoint']*$hero['power']).' '.FH; ?> + <?php echo ($hero['itemfs']?$hero['itemfs']:'0').' '.BFI; ?></font>">
			<div class="element attribName"><?php echo FS; ?></div>
			<div class="element current power"><?php echo 100+$hero['fsperpoint']*$hero['power']+$hero['itemfs']; ?></div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo $hero['power']; ?>%;"></div>
				</div>
			</div>
			<div class="element add">
				<a class="setPoint<?php echo $powerPStyle; ?>" href="?add=power&a=<?php echo $plevel; ?>&c=<?php echo $heroWrefC; ?>"></a>
			</div>
			<div class="element points"><?php echo $hero['power']; ?></div>
		</div>
		<div class="clear"></div>
		<div class="attribute offBonus tooltip" title="<?php echo OBTITLE; ?><br/><font color='#5dcbfb'><?php echo OB.' '.($hero['offBonus']/5); ?>%</font>">
			<div class="element attribName"><?php echo OB; ?></div>
			<div class="element current power"><span class="value"><?php echo ($hero['offBonus']/5); ?></span>%</div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo $hero['offBonus']; ?>%;"></div>
				</div>
			</div>
			<div class="element add">
				<a class="setPoint<?php echo $offBonusPStyle; ?>" href="?add=offBonus&a=<?php echo $plevel; ?>&c=<?php echo $heroWrefC; ?>"></a>
			</div>
			<div class="element points"><?php echo $hero['offBonus']; ?></div>
		</div>
		<div class="clear"></div>
		<div class="attribute defBonus tooltip" title="<?php echo DBTITLE; ?><br/><font color='#5dcbfb'><?php echo DB.' '.($hero['defBonus']/5); ?>%</font>">
			<div class="element attribName"><?php echo DB; ?></div>
			<div class="element current power"><span class="value"><?php echo ($hero['defBonus']/5); ?></span>%</div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo $hero['defBonus']; ?>%;"></div>
				</div>
			</div>
			<div class="element add">
				<a class="setPoint<?php echo $defBonusPStyle; ?>" href="?add=defBonus&a=<?php echo $plevel; ?>&c=<?php echo $heroWrefC; ?>"></a>
			</div>
			<div class="element points"><?php echo $hero['defBonus']; ?></div>
		</div>
		<div class="clear"></div>
		<div class="attribute productionPoints tooltip" title="<?php echo RBTITLE; ?><br/><font color='#5dcbfb'><?php echo RB; ?> : <?php if($hero['r0']!=0) {echo $rp;} elseif($hero['r1']!=0) {echo $hero['r1']*10*SPEED;} elseif($hero['r2']!=0) {echo $hero['r2']*10*SPEED;} elseif($hero['r3']!=0) {echo $hero['r3']*10*SPEED;} elseif($hero['r4']!=0) {echo $hero['r4']*10*SPEED;} ?></font>">
			<div class="element attribName"><?php echo RESOURCES; ?></div>
			<div class="element current power"><?php echo $hero['product']; ?></div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo $hero['product']; ?>%;"></div>
				</div>
			</div>
			<div class="element add">
				<a class="setPoint<?php echo $productPStyle; ?>" href="?add=productionPoints&a=<?php echo $plevel; ?>&c=<?php echo $heroWrefC; ?>"></a>
			</div>
			<div class="element points"><?php echo $hero['product']; ?></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="boxes boxesColor gray">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents">
		<div class="attribute res" id="setResource">
			<div class="changeResourcesHeadline"><?php echo CHANGEHERORP; ?></div>
			<div class="clear"></div>
			<div class="resource">
				<input type="radio" onclick="window.location.href = '?product=r0';" name="resource" value="0" id="resourceHero0" <?php if($hero['r0']!=0){ echo $checked="checked"; } ?>>
				<label for="resourceHero0">
					<img title="<?php echo ALLRESTITLE; ?>" class="r0" src="img/x.gif">
					<span class="current"> <?php echo $rp; ?></span>
				</label>
			</div>
			<div class="resource">
				<input type="radio" onclick="window.location.href = '?product=r1';" name="resource" value="1" id="resourceHero1" <?php if($hero['r1']!=0){ echo $checked="checked"; } ?> <?php echo $form->getRadio('resource',1); ?>>
				<label for="resourceHero1">
					<img title="<?php echo LUMBER; ?>" class="r1" src="img/x.gif">
					<span class="current"> <?php echo $hero['product']*10*SPEED; ?></span>
				</label>
			</div>
			<div class="resource">
				<input type="radio" onclick="window.location.href = '?product=r2';" name="resource" value="2" id="resourceHero2" <?php if($hero['r2']!=0){ echo $checked="checked"; } ?> <?php echo $form->getRadio('resource',2); ?>>
				<label for="resourceHero2">
					<img title="<?php echo CLAY; ?>" class="r2" src="img/x.gif">
					<span class="current"> <?php echo $hero['product']*10*SPEED; ?></span>
				</label>
			</div>
			<div class="resource">
				<input type="radio" onclick="window.location.href = '?product=r3';" name="resource" value="3" id="resourceHero3" <?php if($hero['r3']!=0){ echo $checked="checked"; } ?> <?php echo $form->getRadio('resource',3); ?>>
				<label for="resourceHero3">
					<img title="<?php echo IRON; ?>" class="r3" src="img/x.gif">
					<span class="current"> <?php echo $hero['product']*10*SPEED; ?></span>
				</label>
			</div>
			<div class="resource">
				<input type="radio" onclick="window.location.href = '?product=r4';" name="resource" value="4" id="resourceHero4" <?php if($hero['r4']!=0){ echo $checked="checked"; } ?> <?php echo $form->getRadio('resource',4); ?>>
				<label for="resourceHero4">
					<img title="<?php echo CROP; ?>" class="r4" src="img/x.gif">
					<span class="current"> <?php echo $hero['product']*10*SPEED; ?></span>
				</label>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="boxes boxesColor gray">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents">
		<?php echo '<div class="attribute health tooltip" title="'.HEROREG.': <font color=\'#11ff44\'>'.($hero['autoregen']*HEROATTRSPEED+$hero['itemautoregen']*ITEMATTRSPEED).'% '.PERDAY.'</font><br/><font color=\'#5dcbfb\'>'.($hero['autoregen']*HEROATTRSPEED).'% '.FH.' + '.($hero['itemautoregen']*ITEMATTRSPEED).'% '.BFI.'</font>">'; ?>
			<?php if($hero['dead']==0){ ?>
				<div class="element attribName"><?php echo HEALTH; ?></div>
				<div class="element current power"><span class="value"><?php echo ceil($hero['health']); ?></span>%</div>
				<div class="element progress">
					<div class="bar-bg">
						<?php
						if($hero['health']<=10){
							$color = '#F00';
						}elseif($hero['health']<=25){
							$color = '#F0B300';
						}elseif($hero['health']<=50){
							$color = '#FFFF00';
						}elseif($hero['health']<=90){
							$color = '#99C01A';
						}else{
							$color = '#006900';
						}
						?>
						<div class="bar" style="width:<?php echo ceil($hero['health']); ?>%;background-color:<?php echo $color; ?>"></div>
					</div>
				</div>
			<?php }else{ ?>
				<div class="attributesHeadline"> <?php echo REVIVEHERO; ?> </div>
				<div class="clear"></div>
				<?php
					$vRes = ($village->awood+$village->aclay+$village->airon+$village->acrop);
					$hRes = ($hero_t[$hero['level']]['wood']+$hero_t[$hero['level']]['clay']+$hero_t[$hero['level']]['iron']+$hero_t[$hero['level']]['crop']);
					$checkT = $database->getHeroTrain($hero['wref']);
					if(empty($checkT) || !$checkT){
						if($village->awood < $hero_t[$hero['level']]['wood'] || $village->aclay < $hero_t[$hero['level']]['clay'] || $village->airon < $hero_t[$hero['level']]['iron'] || $village->acrop < $hero_t[$hero['level']]['crop']){
							echo '<span class="none">'.NERTREVIVEHERO.'</span>';
						}else{
							echo "<span class=\"regeneratebtn\"><button type=\"submit\" value=\"".REVIVE."\" onclick=\"window.location.href = 'hero_inventory.php?r=1'; return false;\" name=\"save\" id=\"save\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".REVIVE."</div></div></button></span>";
							//echo '<a href="hero_inventory.php?r=1">'.REVIVE.'</a>';
						}
					}else{
						$duration = $checkT['endat'] - time();
						echo HEROREADYIN." <span id='timer1'>".$generator->getTimeFormat(round($duration))."</span>";
					}
				?>
				<div class="regenerateCosts">
					<div class="showCosts">
						<span class="resources r1 little_res" title="<?php echo LUMBER; ?>">
							<img class="r1" src="img/x.gif" title="<?php echo LUMBER; ?>" />
							<?php echo $hero_t[$hero['level']]['wood']; ?>
						</span>
						<span class="resources r2 little_res" title="<?php echo CLAY; ?>">
							<img class="r2" src="img/x.gif" title="<?php echo CLAY; ?>" />
							<?php echo $hero_t[$hero['level']]['clay']; ?>
						</span>
						<span class="resources r3 little_res" title="<?php echo IRON; ?>">
							<img class="r3" src="img/x.gif" title="<?php echo IRON; ?>" />
							<?php echo $hero_t[$hero['level']]['iron']; ?>
						</span>
						<span class="resources r4 little_res" title="<?php echo CROP; ?>">
							<img class="r4" src="img/x.gif" title="<?php echo CROP; ?>" />
							<?php echo $hero_t[$hero['level']]['crop']; ?>
						</span>
						<span class="resources r5" title="<?php echo CROPCONSUMPTION; ?>">
							<img class="r5" src="img/x.gif" title="<?php echo CROPCONSUMPTION; ?>" />
							6
						</span>
						<div class="clear"></div>
						<span class="clock">
							<img class="clock" src="img/x.gif" title="<?php echo DURATION; ?>">
							<?php echo $generator->getTimeFormat(round($hero_t[$hero['level']]['time']/SPEED)); ?>
						</span>
						<?php
						if($session->plus) {
							if($building->getTypeLevel(17) >= 1) {
								echo '<button type="button" value="" class="icon" onclick="window.location.href = \'build.php?gid=17&amp;t=3&amp;r1='.$hero_t[$hero['level']]['wood'].'&amp;r2='.$hero_t[$hero['level']]['clay'].'&amp;r3='.$hero_t[$hero['level']]['iron'].'&amp;r4='.$hero_t[$hero['level']]['crop'].'\'; return false;"><img src="img/x.gif" class="npc" alt="npc"></button>';
							}
						}
						?>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
				<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="boxes boxesColor gray">
		<div class="boxes-tl"></div>
		<div class="boxes-tr"></div>
		<div class="boxes-tc"></div>
		<div class="boxes-ml"></div>
		<div class="boxes-mr"></div>
		<div class="boxes-mc"></div>
		<div class="boxes-bl"></div>
		<div class="boxes-br"></div>
		<div class="boxes-bc"></div>
		<div class="boxes-contents">
			<div class="attribute experience tooltip" title="
				<?php 
					if($hero['level']<100){
						echo sprintf(NEEDMOREEXP,'<font color=\'#5dcbfb\'>'.($hero_levels[$hero['level']]-$hero['experience']).'</font>','<font color=\'#5dcbfb\'>'.($hero['level']+1).'</font>');
					} else {
						echo HEROFULLLVL;
					}
				?>">
				<div class="element attribName"><?php echo EXPERIENCE; ?></div>
				<div class="element current power"><?php echo $hero['experience']; ?></div>
				<div class="element progress">
					<div class="bar-bg">
						<div class="bar" style="width:<?php 
								if($hero['level']==0){
									echo 0;
								}elseif($hero['level']<100){
									echo round(100*($hero['experience'] - $hero_levels[$hero['level']-1]) / ($hero_levels[$hero['level']] - $hero_levels[$hero['level']-1])); 
								} else {
									echo HEROFULLLVL;
								}
							?>%;"></div>
					</div>
				</div>
				<div class="element add"></div>
				<div class="element points"><?php echo intval($hero['points']); ?></div>
				<div class="clear"></div>
			</div>
			<div class="attribute level tooltip" title="<?php echo HIGHERHERO.': <font color=\'#11ff44\'>'.(($hero['extraexpgain']*HEROATTRSPEED)+($hero['itemextraexpgain']*ITEMATTRSPEED)).'% </font> <br/><font color=\'#5dcbfb\'>'.($hero['extraexpgain']*HEROATTRSPEED).'% '.FH.' + '.($hero['itemextraexpgain']*ITEMATTRSPEED).'% '.BFI.'</font>';?>">
				<div class="element attribName"><?php echo HEROLVL; ?></div>
				<div class="element current power"><?php echo $hero['level']; ?></div>
				<div class="element progress">
					<div class="bar-bg">
						<div class="bar" style="width:<?php echo min(100,$hero['level']); ?>%"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="boxes boxesColor lightGreen">
		<div class="boxes-tl"></div>
		<div class="boxes-tr"></div>
		<div class="boxes-tc"></div>
		<div class="boxes-ml"></div>
		<div class="boxes-mr"></div>
		<div class="boxes-mc"></div>
		<div class="boxes-bl"></div>
		<div class="boxes-br"></div>
		<div class="boxes-bc"></div>
		<div class="boxes-contents">
			<div class="attribute speed tooltip" title="<?php echo HEROSPEEDTITLE.': <font color=\'#11ff44\'>'.($hero['speed']*INCREASE_SPEED+$hero['itemspeed']*INCREASE_SPEED).' '.FPH.'</font><br/><font color=\'#5dcbfb\'>'.$hero['speed']*INCREASE_SPEED.' '.FPH.' '.FH.' + '.$hero['itemspeed']*INCREASE_SPEED.' '.FPH.' '.BFI.'</font>'; ?></font>">
				<div class="element attribName"><?php echo HEROMOVSPEED; ?></div>
				<div class="element power">
					<span class="currect"><?php echo ($hero['speed']*INCREASE_SPEED+$hero['itemspeed']*INCREASE_SPEED).' '.FPH; ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="attribute accountmspeed tooltip" title="<?php echo HEROACCOUNTMSPEEDTITLE.': <font color=\'#11ff44\'>'.($hero['accountmspeed']*HEROATTRSPEED+$hero['itemaccountmspeed']*ITEMATTRSPEED).'% </font><br/><font color=\'#5dcbfb\'>'.($hero['accountmspeed']*HEROATTRSPEED).'% '.FH. ' + '.($hero['itemaccountmspeed']*ITEMATTRSPEED).'% '.BFI.'</font>'; ?></font>">
				<div class="element attribName"><?php echo HEROACCOUNTMSPEED; ?></div>
				<div class="element accountmspeed">
					<span class="currect"><?php echo ($hero['accountmspeed']*HEROATTRSPEED+$hero['itemaccountmspeed']*ITEMATTRSPEED).'% '; ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="attribute allymspeed tooltip" title="<?php echo HEROALLYMSPEEDTITLE.': <font color=\'#11ff44\'>'.($hero['allymspeed']*HEROATTRSPEED+$hero['itemallymspeed']*ITEMATTRSPEED).'% </font><br/><font color=\'#5dcbfb\'>'.($hero['allymspeed']*HEROATTRSPEED).'% '.FH.' + '.($hero['itemallymspeed']*ITEMATTRSPEED).'% '.BFI.'</font>'; ?></font>">
				<div class="element attribName"><?php echo HEROALLYMSPEED; ?></div>
				<div class="element allymspeed">
					<span class="currect"><?php echo ($hero['allymspeed']*HEROATTRSPEED+$hero['itemallymspeed']*ITEMATTRSPEED).'% '; ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="attribute longwaymspeed tooltip" title="<?php echo HEROLONGWAYMSPEEDTITLE.': <font color=\'#11ff44\'>'.($hero['longwaymspeed']*HEROATTRSPEED+$hero['itemlongwaymspeed']*ITEMATTRSPEED).'% </font><br/><font color=\'#5dcbfb\'>'.($hero['longwaymspeed']*HEROATTRSPEED).'% '.FH.' + '.($hero['itemlongwaymspeed']*ITEMATTRSPEED).'% '.BFI.'</font>'; ?></font>">
				<div class="element attribName"><?php echo HEROLONGWAYMSPEED; ?></div>
				<div class="element longwaymspeed">
					<span class="currect"><?php echo ($hero['longwaymspeed']*HEROATTRSPEED+$hero['itemlongwaymspeed']*ITEMATTRSPEED).'% '; ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="attribute returnmspeed tooltip" title="<?php echo HERORETURNMSPEEDTITLE.': <font color=\'#11ff44\'>'.($hero['returnmspeed']*HEROATTRSPEED+$hero['itemreturnmspeed']*ITEMATTRSPEED).'% </font><br/><font color=\'#5dcbfb\'>'.($hero['returnmspeed']*HEROATTRSPEED).'% '.FH.' + '.($hero['itemreturnmspeed']*ITEMATTRSPEED).'% '.BFI.'</font>'; ?></font>">
				<div class="element attribName"><?php echo HERORETURNMSPEED; ?></div>
				<div class="element returnmspeed">
					<span class="currect"><?php echo ($hero['returnmspeed']*HEROATTRSPEED+$hero['itemreturnmspeed']*ITEMATTRSPEED).'% '; ?></span>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="boxes boxesColor orange">
		<div class="boxes-tl"></div>
		<div class="boxes-tr"></div>
		<div class="boxes-tc"></div>
		<div class="boxes-ml"></div>
		<div class="boxes-mr"></div>
		<div class="boxes-mc"></div>
		<div class="boxes-bl"></div>
		<div class="boxes-br"></div>
		<div class="boxes-bc"></div>
		<div class="boxes-contents">
			<div class="attribute cp tooltip" title="<?php echo HEROCPPRODUCTIONTITLE.': <font color=\'#11ff44\'>'.($hero['cpproduction']*HEROATTRSPEED+$hero['itemcpproduction']*ITEMATTRSPEED).'% </font><br/><font color=\'#5dcbfb\'>'.($hero['cpproduction']*HEROATTRSPEED).'% '.FH.' + '.($hero['itemcpproduction']*ITEMATTRSPEED).'% '.BFI.'</font>'; ?></font>">
				<div class="element attribName"><?php echo HEROCPSPEED; ?></div>
				<div class="element cp">
					<span class="currect"><?php echo ($hero['cpproduction']*HEROATTRSPEED+$hero['itemcpproduction']*ITEMATTRSPEED).'%'; ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="attribute rob tooltip" title="<?php echo HEROROBTITLE.': <font color=\'#11ff44\'>'.($hero['rob']*HEROATTRSPEED+$hero['itemrob']*ITEMATTRSPEED).'% </font><br/><font color=\'#5dcbfb\'>'.($hero['rob']*HEROATTRSPEED).'% '.FH.' + '.($hero['itemrob']*ITEMATTRSPEED).'% '.BFI.'</font>'; ?></font>">
				<div class="element attribName"><?php echo HEROROB; ?></div>
				<div class="element rob">
					<span class="currect"><?php echo ($hero['rob']*HEROATTRSPEED+$hero['itemrob']*ITEMATTRSPEED).'%'; ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="attribute extraresist tooltip" title="<?php echo HEROEXTRARESISTTITLE.': <font color=\'#11ff44\'>'.($hero['extraresist']*HEROATTRSPEED+$hero['itemextraresist']*ITEMATTRSPEED).' '.DAMAGEPOINTS.' </font><br/><font color=\'#5dcbfb\'>'.($hero['extraresist']*HEROATTRSPEED).' '.DAMAGEPOINTS.' '.FH.' + '.($hero['itemextraresist']*ITEMATTRSPEED).' '.DAMAGEPOINTS.' '.BFI.'</font>'; ?></font>">
				<div class="element attribName"><?php echo HEROEXTRARESIST; ?></div>
				<div class="element extraresist">
					<span class="currect"><?php echo ($hero['extraresist']*HEROATTRSPEED+$hero['itemextraresist']*ITEMATTRSPEED).' '.DAMAGEPOINTS; ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="attribute vsnatars tooltip" title="<?php echo HEROVSNATARSTITLE.': <font color=\'#11ff44\'>'.($hero['vsnatars']*HEROATTRSPEED+$hero['itemvsnatars']*ITEMATTRSPEED).'% </font><br/><font color=\'#5dcbfb\'>'.($hero['vsnatars']*HEROATTRSPEED).'% '.FH.' + '.($hero['itemvsnatars']*ITEMATTRSPEED).'% '.BFI.'</font>'; ?></font>">
				<div class="element attribName"><?php echo HEROVSNATARS; ?></div>
				<div class="element vsnatars">
					<span class="currect"><?php echo ($hero['vsnatars']*HEROATTRSPEED+$hero['itemvsnatars']*ITEMATTRSPEED).'% '; ?></span>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

