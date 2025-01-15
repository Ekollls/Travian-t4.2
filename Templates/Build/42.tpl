<h1 class="titleInHeader"><?php echo B42;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>
    <div id="build" class="gid42">
		<div class="build_desc">
        <a href="#" onClick="return Travian.Game.iPopup(42,4);" class="build_logo">
			<img class="building big white g42" src="img/x.gif" alt="<?php echo B42;?>" title="<?php echo B42;?>"/>
		</a>
        <?php echo B42_DESC; ?>
	</div>
	<?php
	include("upgrade.tpl");
	?>
	<div class="clear"></div>
	<?php if ($building->getTypeLevel(42) > 0) { ?>
		<form method="POST" name="snd" action="build.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="ft" value="t3" />
            <div class="buildActionOverview trainUnits">
				<?php include("42_train.tpl");?>
				<div class="clear"></div>
			</div>
			<button type="submit" value="ok" name="s1" id="btn_train" value="ok" class="startTraining"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo TRAIN;?></div></div></button>
		</form>
	<?php
	} else {
		echo "<b>".NOUNITRESEARCHED."</b><br/>";
	}
    $trainlist = $technology->getTrainingList(7);
    if(count($trainlist) > 0) {
    //$timer = 2*count($trainlist);
    	echo "
        <h4 class=\"round spacer\">".TRAINING."</h4>
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
			echo '</tr><tr class="next"><td colspan="3">'.sprintf(EUWTI,'<span>'.$NextFinished.'</span>').'</td></tr>';
		} ?>
		</tbody></table>

<?php } ?>
</p></div>
<div class="clear">&nbsp;</div>
<div class="clear"></div>