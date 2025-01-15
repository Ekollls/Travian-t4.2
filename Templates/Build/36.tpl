<h1 class="titleInHeader"><?php echo B36;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>

    <div id="build" class="gid36">
    <div class="build_desc">
        <a href="#" onClick="return Travian.Game.iPopup(36,4);" class="build_logo">
        <img class="building big white g36" src="img/x.gif" alt="<?php echo B36;?>" title="<?php echo B36;?>"/></a>
     <?php echo B36_DESC; ?></div>

<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th><?php echo CUR_TRAPNUM;?>:</th>

		<td><b><?php echo $bid36[$village->resarray['f'.$id]]['trapcount']; ?></b> تله</td>
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
		<th><?php echo NEXT_TRAPNUM.' '.($village->resarray['f'.$id]+$nc); ?>:</th>
		<td><b><?php echo $bid36[$village->resarray['f'.$id]+$nc]['trapcount']; ?></b> تله</td>
		</tr>
<?php
            }
			}
            ?>
	
</table>
<?php 
include("upgrade.tpl");
?>
<div class="clear"></div>
<form method="POST" name="snd" action="build.php"><input type="hidden" name="id" value="<?php echo $id;?>"><input type="hidden" name="ft" value="t1" />
<div class="buildActionOverview trainUnits">
<div class="action first">
شما دارید <b><?php echo $village->unitarray['u199'];?></b> تا تله که از این ها <b><?php echo $database->getFilledTrapCount($village->wid);?></b> تله شما در حال حاضر پر است..
				<div class="details">
<div class="tit"><a href="#" onclick="return Travian.Game.iPopup(36,4,'gid')"><img class="unit u199" src="img/x.gif" alt="<?php echo TRAP;?>"></a> <a href="#" onclick="return Travian.Game.iPopup(36,4,'gid')">تله</a>
<span class="furtherInfo">(<?php echo AVAILABLE;?>: 0)</span>
</div>
<?php
$maxtrap = $technology->maxTrap();
$maxtrapPlus = $technology->maxTrapPlus();
$each = $u199['time']*1000/ SPEED;
if ($each<2000){
	$eachStr = $generator->getMilisecFormat($each);
} else {
	$eachStr = $generator->getTimeFormat(round($each/1000));
}
?>
<div class="showCosts">
<?php
echo '<span class="resources r1"><img class="r1" src="img/x.gif" alt="'.WOOD.'">'.($u199['wood']).'</span><span class="resources r2"><img class="r2" src="img/x.gif" alt="'.CLAY.'">'.($u199['clay']).'</span><span class="resources r3"><img class="r3" src="img/x.gif" alt="'.IRON.'">'.($u199['iron']).'</span><span class="resources r4"><img class="r4" src="img/x.gif" alt="'.CROP.'">'.($u199['crop']).'</span><span class="resources r5"><img class="r5" src="img/x.gif" alt="'.UPKEEP.'">'.$u199['pop'].'</span>';
?>
<div class="clear"></div><span class="clocks"><img class="clock" src="img/x.gif" alt="<?php echo DURATION;?>">
<?php
echo $eachStr;
if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
	echo "&nbsp;&nbsp;<button type=\"button\" value=\"npc\" class=\"icon\" onclick=\"window.location.href = 'build.php?gid=17&t=3&r1=".($u199['wood']*$maxtrapPlus)."&r2=".($u199['clay']*$maxtrapPlus)."&r3=".($u199['iron']*$maxtrapPlus)."&r4=".($u199['crop']*$maxtrapPlus)."'; return false;\"><img src=\"img/x.gif\" class=\"npc\" alt=\"npc\"></button>";
}
?>
</span><div class="clear"></div></div>			<span class="value">حداکثر</span> <input type="text" class="text" name="t199" value="0" maxlength="4"><span class="value">
/ </span> <a href="#" onclick="$(this).getParent('div.details').getElement('input').value=<?php echo $maxtrap;?>; return false;"><?php echo $maxtrap;?></a>

</div>
<div class="clear"></div>
</div>
</div>

<button type="submit" value="ok" name="s1" id="btn_train" value="ok" class="startTraining"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo MAKE;?></div></div></button></form>

<?php
    $trainlist = $technology->getTrainingList(8);
    if(count($trainlist) > 0) {
    //$timer = 2*count($trainlist);
    	echo "
        <h4 class=\"round spacer\"><?php echo TRAINING;?></h4>
    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
		<thead><tr>
			<td>".UNIT."</td>
			<td>".DURATION."</td>
			<td>".FINISH."</td>
		</tr></thead>
		<tbody>";
		$TrainCount = 0;
        foreach($trainlist as $train) {
			$TrainCount++;
	        echo "<tr><td class=\"desc\">";
			echo "<img class=\"unit u".$train['unit']."\" src=\"img/x.gif\" alt=\"".$train['name']."\" title=\"".$train['name']."\" />";
			echo $train['amt']." ".$train['name']."</td><td class=\"dur\">";
			if ($TrainCount == 1 ) {
				echo "<span id=timer1>".$generator->getTimeFormat($train['endat']-time())."</span>";
			} else {
				echo $generator->getTimeFormat($train['endat']-$train['commence']);
			}
			echo "</td><td class=\"fin\">";
			$time = $generator->procMTime($train['endat']);
			echo " ".$time[1]." ".HRS."";
			if ($train['eachtime']<2000){
				$NextFinished = $generator->getMilisecFormat($train['eachtime']);
			} else {
				$NextFinished = $generator->getTimeFormat(round($train['eachtime']/1000));
			}
			echo '</tr><tr class="next"><td colspan="3">'.sprintf(EUWTI,(''.$NextFinished.'')).'</td></tr>';
		} ?>
		</tbody></table>

<?php } ?>
</p></div>
