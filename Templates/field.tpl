<map name="rx" id="rx">
<?php 
    if (DIRECTION == 'ltr'){
		$coorarray = array(1=>"180,80,28","269,81,28","338,93,28","122,119,28","235,132,28","292,139,28","377,137,28","62,170,28","143,171,28","333,171,28","420,171,28","70,231,28","143,221,28","279,257,28","401,226,28","174,311,28","265,316,28","355,293,28");
		$stylecoorarray = array(1=>array(180,80),array(269,81),array(338,93),array(122,119),array(235,132),array(292,139),array(377,137),array(62,170),array(143,171),array(333,171),array(420,171),array(70,231),array(143,221),array(279,257),array(401,226),array(174,311),array(265,316),array(355,293));
    } else if(DIRECTION == 'rtl'){
		$coorarray = array(1=>"304,80,28","215,81,28","146,93,28","362,119,28","249,132,28","192,139,28","107,137,28","422,170,28","341,171,28","151,171,28","64,171,28","414,231,28","341,221,28","205,257,28","83,226,28","310,311,28","219,316,28","129,293,28");
		$stylecoorarray = array(1=>array(296,82),array(207,83),array(138,95),array(354,121),array(241,134),array(184,141),array(99,139),array(414,172),array(333,173),array(143,173),array(56,173),array(406,233),array(333,223),array(197,259),array(75,228),array(302,313),array(211,318),array(121,295));
	}
	for($i=1;$i<=18;$i++) {
		$loopsame = $building->isCurrent($i)?1:0;
		$doublebuild = 0;
        if ($loopsame>0 && $building->isLoop($i)) {$doublebuild = 1;}
		$uprequire = $building->resourceRequired($i,$village->resarray['f'.$i.'t'],($loopsame > 0 ? 2:1)+$doublebuild);
		$bindicate = $building->canBuild($i,$village->resarray['f'.$i.'t']);
		echo '<area href="build.php?id='.$i.'" coords="'.$coorarray[$i].'" shape="circle" title="<div style=\'color:#FFF\'><b>'.constant('B'.$village->resarray['f'.$i.'t']).'</b> '.LVL.' '.$village->resarray['f'.$i].'</div> ';
		if($bindicate!=10 && $bindicate!=1) echo sprintf(UPGRADECOST,($village->resarray['f'.$i]+($loopsame > 0 ? 2:1)+$doublebuild)).':<br/>
 <span class=\'resources r1\'> <img class=\'r1\' src=\'img/x.gif\' > '.$uprequire['wood'].' </span> 
 <span class=\'resources r2\'> <img class=\'r2\' src=\'img/x.gif\' > '.$uprequire['clay'].' </span> 
 <span class=\'resources r3\'> <img class=\'r3\' src=\'img/x.gif\' > '.$uprequire['iron'].' </span> 
 <span class=\'resources r4\'> <img class=\'r4\' src=\'img/x.gif\' > '.$uprequire['crop'].' </span> ';
 echo '"/>';
	}
?>
<area href="dorf2.php" coords="250,191,32" shape="circle" title="<?php echo BUILDINGS; ?>">
</map>

<div id="village_map" class="f<?php echo $village->type; ?>">
    <div id="village_circles"></div>

<?php 
for($i=1;$i<=18;$i++) {
    if($village->resarray['f'.$i.'t'] != 0) {
		$text = "";
		$hlpls = $building->isCurrent($i)?1:0; $fands = 0;
		if ($building->isLoop($i)) {$fands = 1;}
		$nli = ($hlpls > 0 ? 2:1)+$fands;
		if($nli>1) {$style = 'font-weight:bold;background-image:url(gpack/travian_Travian_4.2_BigBang/img/g/circleo.png);';}
		else {$style = 'background-image:url(gpack/travian_Travian_4.2_BigBang/img/g/circle.png);';}
		$style .= 'left:'.($stylecoorarray[$i][0]).'px;top:'.($stylecoorarray[$i][1]).'px;padding-top:3px;';
		
		//if($village->resarray['f'.$i] != 0) {
			echo "<div class='level' style=\"".$style." \">".($village->resarray['f'.$i]==0?'':$village->resarray['f'.$i])."</div> ";
		//}
    }
}
?>     
	<img id="resfeld" usemap="#rx" src="img/x.gif" alt="">
</div> 
