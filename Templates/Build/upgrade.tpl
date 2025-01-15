<?php
$bindicate = $building->canBuild($id,$village->resarray['f'.$id.'t']);
if($bindicate == 1) {
	echo "<p><span class=\"none\"><b>".constant('B'.$village->resarray['f'.$id.'t'])." ".COMPLETELYUPGRADED."</b></span></p>";
} else if($bindicate == 10) {
	echo "<p><span class=\"none\"><b>".constant('B'.$village->resarray['f'.$id.'t']).' '.GONNAFULLUPGRADED." </b></span></p>";
} else if($bindicate == 11) {
	echo "<p><span class=\"none\"><b>".constant('B'.$village->resarray['f'.$id.'t'])." ".UNDERDEMOLISH." </b></span></p>";
} else {
	$loopsame = $building->isCurrent($id)?1:0;
	 $doublebuild = 0;
        if ($loopsame>0 && $building->isLoop($id)) {
            $doublebuild = 1;
        }
	$uprequire = $building->resourceRequired($id,$village->resarray['f'.$id.'t'],($loopsame > 0 ? 2:1)+$doublebuild);
?>
<div id="contract" class="contractWrapper">
<div class="contractText"><?php echo sprintf(UPGRADECOST,($village->resarray['f'.$id]+($loopsame > 0 ? 2:1)+$doublebuild)); ?>: </div>
<div class="contractCosts">
<div class="showCosts">
<span class="resources r1"><img class="r1" src="img/x.gif" title="<?php echo WOOD;?>"><?php echo $uprequire['wood']; ?></span>
<span class="resources r2"><img class="r2" src="img/x.gif" title="<?php echo CLAY;?>"><?php echo $uprequire['clay']; ?></span>
<span class="resources r3"><img class="r3" src="img/x.gif" title="<?php echo IRON;?>"><?php echo $uprequire['iron']; ?></span>
<span class="resources r4"><img class="r4" src="img/x.gif" title="<?php echo CROP;?>"><?php echo $uprequire['crop']; ?></span>
<span class="resources r5"><img class="r5" src="img/x.gif" title="<?php echo UPKEEP;?>"><?php echo $uprequire['pop']; ?></span>
<div class="clear"></div>
<span class="clocks">
<img class="clock" src="img/x.gif" title="<?php echo DURATION;?>">
<?php
echo $generator->getTimeFormat($uprequire['time']);

$wood = round($village->awood);
$clay = round($village->aclay);
$iron = round($village->airon);
$crop = round($village->acrop);

$totalres = $uprequire['wood']+$uprequire['clay']+$uprequire['iron']+$uprequire['crop'];
$availres = $wood+$clay+$iron+$crop;
$disable = '';
if($session->userinfo['gold'] >= 3 && $availres >= $totalres){ $style = "npc"; } else { $style = "npc_inactive"; $disable = "disabled=\"disabled\""; }
if($session->plus) {
	if($building->getTypeLevel(17) >= 1) {
		echo "&nbsp;&nbsp;<button ".$disable." type=\"button\" value=\"npc\" class=\"icon\" onclick=\"window.location.href = 'build.php?gid=17&t=3&r1=".$uprequire['wood']."&r2=".$uprequire['clay']."&r3=".$uprequire['iron']."&r4=".$uprequire['crop']."'; return false;\"><img src=\"img/x.gif\" class=\"".$style."\" alt=\"NPC\"></button>";
	}

}
?></span>
<div class="clear"></div>
</div></div>
<?php
    if($bindicate == 20) {
	echo "<span class=\"none\">".ARTGRT_WW_LACK."</span></div>";
}else if($bindicate == 21) {
	echo "<span class=\"none\">".OWNARTBP_LACK."</span></div>";
}else if($bindicate == 22) {
	echo "<span class=\"none\">".ALLYARTBP_LACK."</span></div>";
}elseif($bindicate == 2) {
   		echo "<span class=\"none\">".FULLQUE."</span></div>";
    }
    else if($bindicate == 3) {
    	echo "<span class=\"none\">".FULLQUE."</span></div>";
    }
    else if($bindicate == 4) {
    	echo "<span class=\"none\">".FOODSHORTAGE."</span></div>";
    }
   
    else if($bindicate == 5) {
    	echo "<span class=\"none\">".UPGRADEWAREHOUSE."</span></div>";
    }
    else if($bindicate == 6) {
    	echo "<span class=\"none\">".UPGRADEGRANARY."</span></div>";
    }
    else if($bindicate == 7) {
    	$neededtime = $building->calculateAvaliable($id,$village->resarray['f'.$id.'t'],($loopsame > 0 ? 2:1));
    	echo "<span class=\"none\">".ENOUGHRESOURCEAT.": ".$neededtime[1]."</span></div>";
    }
    else if($bindicate == 8) {
    	if($id <= 18) {
    	echo "<button type=\"button\" value=\"Upgrade level\" class=\"build\" onclick=\"window.location.href = 'dorf1.php?a=$id&c=$session->checker'; return false;\">
<div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div>
<div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div>
</div><div class=\"button-contents\">".UPGRADETO.' ';
        }
        else {
        echo "<button type=\"button\" value=\"Upgrade level\" class=\"build\" onclick=\"window.location.href = 'dorf2.php?a=$id&c=$session->checker'; return false;\">
<div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div>
<div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div>
</div><div class=\"button-contents\">".UPGRADETO.' ';
        }
		echo $village->resarray['f'.$id]+1;
		echo " </div></div></button></div>";
    }
    else if($bindicate == 9) {
    	if($id <= 18) {
    		echo "<button type=\"button\" value=\"Upgrade level\" class=\"build\" onclick=\"window.location.href = 'dorf1.php?a=$id&c=$session->checker'; return false;\">
<div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div>
<div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div>
</div><div class=\"button-contents\">".UPGRADETO.' ';
        } else {
        	echo "<button type=\"button\" value=\"Upgrade level\" class=\"build\" onclick=\"window.location.href = 'dorf2.php?a=$id&c=$session->checker'; return false;\">
<div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div>
<div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div>
</div><div class=\"button-contents\">".UPGRADETO.' ';
        }
	echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1);
	echo "</div></div></button> <span class=\"none\">(".QUE.")</span></div>";
    }
}

?>

