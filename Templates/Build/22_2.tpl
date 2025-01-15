<?php 
$fail = $success = 0;
$acares = $technology->grabAcademyRes();
for($i=12;$i<=19;$i++) {
	if($technology->meetRRequirement($i) && !$technology->getTech($i) && !$technology->isResearch($i,1)) {
    	echo "<div class=\"build_details researches\">
        <div class=\"&#1578;&#1581;&#1602;&#1740;&#1602; &#1705;&#1585;&#1583;&#1606;\">
			<div class=\"bigUnitSection\">
				<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
					<img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
				</a>
				<a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.");\">
					<img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\">
				</a>
			</div>
			<div class=\"information\">
<div class=\"title\">
<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\"></a>
<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">".$technology->getUnitName($i)."</a>
</div>
<div class=\"costs\">
<div class=\"showCosts\">
                    <span class=\"resources r1 little_res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Fa\">".${'r'.$i}['wood']."</span>
                    <span class=\"resources r2 little_res\"><img class=\"r2\" src=\"img/x.gif\" alt=\"".CLAY."\">".${'r'.$i}['clay']."</span>
                    <span class=\"resources r3 little_res\"><img class=\"r3\" src=\"img/x.gif\" alt=\"".IRON."\">".${'r'.$i}['iron']."</span>
                    <span class=\"resources r4 little_res\"><img class=\"r4\" src=\"img/x.gif\" alt=\"".CROP."\">".${'r'.$i}['crop']."</span>
                    <div class=\"clear\"></div>
                    <span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"duration\">";
                    echo $generator->getTimeFormat(round(${'r'.$i}['time'] * ($bid22[$village->resarray['f'.$id]]['attri'] / 100)/SPEED));
                    echo "</span>";
                    if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) > 1) {
                   echo "<button type=\"button\" value=\"npc\" class=\"icon\" onclick=\"window.location.href = 'build.php?gid=17&t=3&r1=".${'r'.$i}['wood']."&r2=".${'r'.$i}['clay']."&r3=".${'r'.$i}['iron']."&r4=".${'r'.$i}['crop']."'; return false;\"><img src=\"img/x.gif\" class=\"npc\" alt=\"npc\"></button>
                    <div class=\"clear\"></div>";
                   }
                   if(${'r'.$i}['wood'] > $village->maxstore || ${'r'.$i}['clay'] > $village->maxstore || ${'r'.$i}['iron'] > $village->maxstore) {
                    echo "<br><div class=\"contractLink\"><span class=\"none\">".UPGRADEWAREHOUSE."</span></div>
</div>
<div class=\"clear\">&nbsp;</div>
</div></div>";
echo "<div class=\"clear\">&nbsp;</div></div></div>";
                }
                else if(${'r'.$i}['crop'] > $village->maxcrop) {
                    echo "<br><div class=\"contractLink\"><span class=\"none\">".UPGRADEGRANARY."</span></div>
</div>
<div class=\"clear\">&nbsp;</div>
</div></div>";
                    echo "<div class=\"clear\">&nbsp;</div></div></div>";
                }
                   else if(${'r'.$i}['wood'] > $village->awood || ${'r'.$i}['clay'] > $village->aclay || ${'r'.$i}['iron'] > $village->airon || ${'r'.$i}['crop'] > $village->acrop) {
                   	$time = $technology->calculateAvaliable(22,${'r'.$i});
                    echo "<br><div class=\"contractLink\"><span class=\"none\">".sprintf(NORESAV_AVON,''.$time[1].'')."</span></div>
</div>
<div class=\"clear\">&nbsp;</div>
</div></div>";
                    echo "<div class=\"clear\">&nbsp;</div></div></div>";
                }
                else if ( count($acares) > 0 ) {
                echo "<br><div class=\"contractLink\"><span class=\"none\">
                    Fejlesztés folyamatban</span></div></div></div></div>
                    <div class=\"clear\">&nbsp;</div>
                    </div></div>";
                }
                else {
                
                
                    echo "<div class=\"contractLink\"><button type=\"button\" value=\"Fejlesztés\" class=\"build\" onclick=\"window.location.href = 'build.php?id=$id&amp;a=$i&amp;c=".$session->mchecker."'; return false;\">
<div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div>
<div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div>
</div><div class=\"button-contents\">&#1578;&#1581;&#1602;&#1740;&#1602; &#1705;&#1585;&#1583;&#1606;</div></div></button></div>
</div>
<div class=\"clear\">&nbsp;</div>
</div></div><div class=\"clear\">&nbsp;</div></div></div>";
                }
                $success += 1;
   }
    else {
    $fail += 1;
    }
}
if($success == 0) {
echo "<div class=\"build_details researches\"><div class=\"noResearchPossible\"><span class=\"none\">".NORESEARCHAVAILABLE."</span></div></div>";
}
?>		
<?php
if($fail > 0) { 
	echo "<p class=\"switch\"><a class=\"openedClosedSwitch switchOpened\" id=\"researchFutureLink\" href=\"#\" onclick=\"return $('researchFuture').toggle();\">&#1580;&#1586;&#1574;&#1740;&#1575;&#1578; &#1576;&#1740;&#1588;&#1578;&#1585;</a></p>
    <div id=\"researchFuture\" class=\"researches hide \">";
    for($uc=13;$uc<=19;$uc++){
			if(!$technology->meetRRequirement($uc) && !$technology->getTech($uc)) {
			echo"<div class=\"&#1578;&#1581;&#1602;&#1740;&#1602; &#1705;&#1585;&#1583;&#1606;\"><div class=\"bigUnitSection\"><a href=\"#\" onclick=\"return Travian.Game.iPopup(".$uc.",1);\"><img class=\"unitSection u".$uc."Section\" src=\"img/x.gif\" alt=\"".constant('U'.$uc)."\"></a><a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$uc.");\"><img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\"></a></div><div class=\"information\"><div class=\"title\"><a href=\"#\" onclick=\"return Travian.Game.iPopup(".$uc.",1);\"><img class=\"unit u".$uc."\" src=\"img/x.gif\" alt=\"".constant('U'.$uc)."\"></a><a href=\"#\" onclick=\"return Travian.Game.iPopup(".$uc.",1);\">".constant('U'.$uc)."</a></div><div class=\"costs\"><div class=\"showCosts\"><span class=\"resources r1 little_res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"".WOOD."\">".${r.$uc}['wood']."</span><span class=\"resources r2 little_res\"><img class=\"r2\" src=\"img/x.gif\" alt=\"".CLAY."\">".${r.$uc}['clay']."</span><span class=\"resources r3 little_res\"><img class=\"r3\" src=\"img/x.gif\" alt=\"".IRON."\">".${r.$uc}['iron']."</span><span class=\"resources r4 little_res\"><img class=\"r4\" src=\"img/x.gif\" alt=\"".CROP."\">".${r.$uc}['crop']."</span><div class=\"clear\"></div><span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"".HRS."\">";
			echo $generator->getTimeFormat(round(${r.$uc}['time'] * ($bid22[$village->resarray['f'.$id]]['attri'] / 100)/SPEED));
			switch($uc){
				case 13:echo"</span><div class=\"clear\"></div></div></div><div class=\"contractLink\"><a href=\"#\">".B22."</a><span class=\"level\"> ".LVL." 3</span>, <a href=\"#\"> ".B13." </a><span class=\"level\"> ".LVL." 1</span></div></div><div class=\"clear\"></div></div><hr>";break;
				case 14:echo"</span><div class=\"clear\"></div></div></div><div class=\"contractLink\"><a href=\"#\">".B22."</a><span class=\"level\"> ".LVL." 1</span>, <a href=\"#\"> ".B15." </a><span class=\"level\"> ".LVL." 5</span></div></div><div class=\"clear\"></div></div><hr>";break;
				case 15:echo"</span><div class=\"clear\"></div></div></div><div class=\"contractLink\"><a href=\"#\">".B22."</a><span class=\"level\"> ".LVL." 5</span>, <a href=\"#\"> ".B20." </a><span class=\"level\"> ".LVL." 5</span></div></div><div class=\"clear\"></div></div><hr>";break;
				case 16:echo"</span><div class=\"clear\"></div></div></div><div class=\"contractLink\"><a href=\"#\">".B22."</a><span class=\"level\"> ".LVL." 15</span>, <a href=\"#\"> ".B20." </a><span class=\"level\"> ".LVL." 10</span></div></div><div class=\"clear\"></div></div><hr>";break;
				case 17:echo"</span><div class=\"clear\"></div></div></div><div class=\"contractLink\"><a href=\"#\">".B22."</a><span class=\"level\"> ".LVL." 10</span>, <a href=\"#\"> ".B21." </a><span class=\"level\"> ".LVL." 1</span></div></div><div class=\"clear\"></div></div><hr>";break;
				case 18:echo"</span><div class=\"clear\"></div></div></div><div class=\"contractLink\"><a href=\"#\">".B22."</a><span class=\"level\"> ".LVL." 15</span>, <a href=\"#\">  ".B21."  </a><span class=\"level\"> ".LVL." 10</span></div></div><div class=\"clear\"></div></div><hr>";break;
				case 19: echo"</span><div class=\"clear\"></div></div></div><div class=\"contractLink\"><a href=\"#\">".B22."</a><span class=\"level\"> ".LVL." 20</span>, <a href=\"#\"> ".B16." </a><span class=\"level\"> ".LVL." 5</span></div></div><div class=\"clear\"></div></div>";break;
			}
		}
	}
?>
<script type="text/javascript">
        //<![CDATA[
            $("researchFuture").toggle = (function()
            {
                this.toggleClass("hide");

                $("researchFutureLink").set("text",
                    this.hasClass("hide")
                    ?   "More"
                    :   "Close More"
                );

                return false;
            }).bind($("researchFuture"));
        //]]>
</script>
<?php
     echo "<div class=\"clear\"></div></div>";
}

if(count($acares) > 0) {
    echo "<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\"><thead><tr><td>".TRAINING."</td><td>".DURATION."</td><td>".FINISH."</td></tr>
    </thead><tbody>";
            $timer = 1;
    foreach($acares as $aca) {
        $unit = substr($aca['tech'],1,2);
        echo "<tr><td class=\"desc\"><img class=\"unit u$unit\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\" title=\"".$technology->getUnitName($unit)."\" />".$technology->getUnitName($unit)."</td>";
            echo "<td class=\"dur\"><span id=\"timer$timer\">".$generator->getTimeFormat($aca['timestamp']-time())."</span></td>";
            $date = $generator->procMtime($aca['timestamp']);
            echo "<td class=\"fin\"><span>".$date[1]."</span><span> Hour</span></td>";
        echo "</tr>";
        $timer +=1;
    }
    echo "</tbody></table>";
}

/*if()  {
    echo "</div></div><div class=\"clear\"></div>";
}*/

?>
