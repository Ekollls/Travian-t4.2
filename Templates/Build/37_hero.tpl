<div id="attributes">
	<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
    	<div class="attribute headline">
			<div class="attributesHeadline">Specifikációk</div>
			<div class="pointsHeadline">Pontok</div>
			<div class="clear"></div>
		</div>

		<div class="clear"></div>

  <div class="attribute power tooltip" title="Támadó er&#337;||A h&#337;s támadási ereje a védelmi erejének és a támadó erejének kombinációja. Minnél több ez az er&#337; annál kevesebb sérülést kap a kalandnál a h&#337;s.<br><font color='#5dcbfb'>Támadási er&#337;: <?php echo $hero_info['attack']; ?></font>">
			<div class="element attribName">Támadási er&#337;</div>
			<div class="element current power"><?php echo $hero_info['attack']; ?></div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo intval($hero_info['attack']/100)-1; ?>%;"></div>
				</div>
			</div>
			<div class="element add">
        <?php
        if($hero_info['points'] > 0){
            echo "<a class=\"setPoint\" href=\"hero_inventory.php?add=off\"></a>";
        }else {
            echo "<a class=\"setPoint hidden\" href=\"hero_inventory.php?add=off\"></a>";
        }
        ?>
			</div>
			<div class="element points"><?php echo intval($hero_info['attack']/150); ?></div>
		</div>

		<div class="clear"></div>
  <div class="attribute offBonus tooltip" title="<font color=white><b>Támadó pont</b></font><br>A támadópont növeli a h&#337;s életben maradási esélyeit<br><font color='#5dcbfb'>Támadó bónusz: <?php echo ($hero_info['attackbonus']/200); ?>%</font>">
			<div class="element attribName">Támadó bónusz</div>
			<div class="element current power"><span class="value"><?php echo ($hero_info['attackbonus']/200); ?></span>%</div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo intval($hero_info['attackbonus']/100); ?>%;"></div>
				</div>
			</div>
			<div class="element add">
            <?php
        if($hero_info['points'] > 0){
            echo "<a class=\"setPoint\" href=\"hero_inventory.php?add=obonus\"></a>";
        }else {
            echo "<a class=\"setPoint hidden\" href=\"hero_inventory.php?add=obonus\"></a>";
        }
        ?>
			</div>
			<div class="element points"><?php echo intval($hero_info['attackbonus']/100); ?></div>
		</div>

		<div class="clear"></div>

  <div class="attribute defBonus tooltip" title="<font color=white><b>&#1575;&#1605;&#1578;&#1740;&#1575;&#1586; &#1583;&#1601;&#1575;&#1593;&#1740;</b></font><br>&#1576;&#1575;&#1593;&#1579; &#1575;&#1601;&#1586;&#1575;&#1740;&#1588; &#1602;&#1583;&#1585;&#1578; &#1583;&#1601;&#1575;&#1593;&#1740; &#1578;&#1605;&#1575;&#1605;&#1740; &#1604;&#1588;&#1705;&#1585;&#1740;&#1575;&#1606;&#1740; &#1582;&#1608;&#1575;&#1607;&#1583; &#1588;&#1583; &#1705;&#1607; &#1607;&#1605;&#1585;&#1575;&#1607; &#1602;&#1607;&#1585;&#1605;&#1575;&#1606; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1606;&#1583;.<br><font color='#5dcbfb'>&#1575;&#1605;&#1578;&#1740;&#1575;&#1586; &#1583;&#1601;&#1575;&#1593;&#1740;: <?php echo ($hero_info['defencebonus']/200); ?>%</font>">
			<div class="element attribName">&#1575;&#1605;&#1578;&#1740;&#1575;&#1586; &#1583;&#1601;&#1575;&#1593;&#1740;</div>
			<div class="element current power"><span class="value"><?php echo ($hero_info['defencebonus']/200); ?></span>%</div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo intval($hero_info['defencebonus']/100); ?>%;"></div>
				</div>
			</div>
			<div class="element add">
            <?php
        if($hero_info['points'] > 0){
            echo "<a class=\"setPoint\" href=\"hero_inventory.php?add=dbonus\"></a>";
        }else {
            echo "<a class=\"setPoint hidden\" href=\"hero_inventory.php?add=dbonus\"></a>";
        }
        ?>
			</div>
			<div class="element points"><?php echo intval($hero_info['defencebonus']/100); ?></div>
		</div>

		<div class="clear"></div>

  <div class="attribute productionPoints tooltip" title="<font color=white><b>&#1605;&#1606;&#1575;&#1576;&#1593;</b></font><br>&#1576;&#1575;&#1593;&#1579; &#1575;&#1601;&#1586;&#1575;&#1740;&#1588; &#1578;&#1608;&#1604;&#1740;&#1583; &#1605;&#1606;&#1575;&#1576;&#1593; &#1583;&#1607;&#1705;&#1583;&#1607;&#8204;&#1575;&#1740; &#1582;&#1608;&#1575;&#1607;&#1583; &#1588;&#1583; &#1705;&#1607; &#1602;&#1607;&#1585;&#1605;&#1575;&#1606; &#1583;&#1585; &#1581;&#1575;&#1604; &#1581;&#1575;&#1590;&#1585; &#1583;&#1585; &#1570;&#1606; &#1605;&#1602;&#1740;&#1605; &#1575;&#1587;&#1578;.
<br><font color='#5dcbfb'>&#1575;&#1601;&#1586;&#1575;&#1740;&#1588; &#1578;&#1608;&#1604;&#1740;&#1583; &#1605;&#1606;&#1575;&#1576;&#1593;: <?php echo ($hero_info['resource']); ?>%</font>">
			<div class="element attribName">&#1605;&#1606;&#1575;&#1576;&#1593;</div>
			<div class="element current power"><?php echo ($hero_info['resource']/10); ?></div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo intval($hero_info['resource']); ?>%;"></div>
				</div>
			</div>
			<div class="element add">
             <?php
        if($hero_info['points'] > 0){
            echo "<a class=\"setPoint\" href=\"hero_inventory.php?add=resource\"></a>";
        }else {
            echo "<a class=\"setPoint hidden\" href=\"hero_inventory.php?add=resource\"></a>";
        }
        ?>
			</div>
			<div class="element points"><?php echo intval($hero_info['resource']/10); ?></div>
		</div>

		<div class="clear"></div>
		</div>
  </div>
	<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">	<div class="attribute res" id="setResource">
		<div class="changeResourcesHeadline">
			&#1578;&#1594;&#1740;&#1740;&#1585; &#1606;&#1608;&#1593; &#1578;&#1608;&#1604;&#1740;&#1583; &#1605;&#1606;&#1575;&#1576;&#1593; &#1575;&#1586; &#1591;&#1585;&#1601; &#1602;&#1607;&#1585;&#1605;&#1575;&#1606;		</div>
		<div class="clear"></div>
		<div class="resource">
		  <input type="radio" name="resource" value="0" id="resourceHero0" checked="checked">
			<label for="resourceHero0">
				<img alt="&#1578;&#1605;&#1575;&#1605;&#1740; &#1605;&#1606;&#1575;&#1576;&#1593;" class="r0" src="img/x.gif">				<span class="current">0</span>
			</label>
		</div>
				<div class="resource">
			<input type="radio" name="resource" value="1" id="resourceHero1">
			<label for="resourceHero1">
				<img alt="&#1670;&#1608;&#1576;" class="r1" src="img/x.gif">				<span class="current">0</span>
			</label>
		</div>
				<div class="resource">
			<input type="radio" name="resource" value="2" id="resourceHero2">
			<label for="resourceHero2">
				<img alt="&#1582;&#1588;&#1578;" class="r2" src="img/x.gif">				<span class="current">0</span>
			</label>
		</div>
				<div class="resource">
			<input type="radio" name="resource" value="3" id="resourceHero3">
			<label for="resourceHero3">
				<img alt="&#1570;&#1607;&#1606;" class="r3" src="img/x.gif">				<span class="current">0</span>
			</label>
		</div>
				<div class="resource">
			<input type="radio" name="resource" value="4" id="resourceHero4">
			<label for="resourceHero4">
				<img alt="&#1711;&#1606;&#1583;&#1605;" class="r4" src="img/x.gif">				<span class="current">0</span>
			</label>
		</div>
			</div>
	<div class="clear"></div>
		</div>
  </div>
	<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
    
<div class="attribute health tooltip" title="<font color=white><b>&#1587;&#1604;&#1575;&#1605;&#1578;&#1740;</b></font><br>&#1576;&#1575;&#1586;&#1587;&#1575;&#1586;&#1740; &#1602;&#1607;&#1585;&#1605;&#1575;&#1606; &#1588;&#1605;&#1575;: 20% &#1576;&#1585;&#1575;&#1740; &#1607;&#1585; &#1585;&#1608;&#1586;
<br><font color='#5dcbfb'>&#1587;&#1604;&#1575;&#1605;&#1578;&#1740;: 20% &#1583;&#1585; &#1585;&#1608;&#1586; &#1575;&#1586; &#1602;&#1607;&#1585;&#1605;&#1575;&#1606;</font>">
			<div class="element attribName">&#1587;&#1604;&#1575;&#1605;&#1578;&#1740;</div>
			<div class="element current power"><span class="value"><?php echo floor($hero_info['health']); ?></span>%</div>
			<div class="element progress">
				<div class="bar-bg">
                <?php
                if($hero_info['health']>=90){
                $color = '#006900';
                } elseif($hero_info['health']>50){
                $color = '#99c01a';
                }
                if($hero_info['health']<=50 && $hero_info['health']>35){
                $color = '#FFFF00';
                }
                if($hero_info['health']<=35 && $hero_info['health']>15){
                $color = '#F0B300';
                } elseif($hero_info['health']<=15) {
                $color = '#f00000';
                }
                ?>
              <font color="#006900"></font>
					<div class="bar" style="width:<?php echo floor($hero_info['health']); ?>%;background-color:<?php echo $color; ?>"></div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
			</div>
  </div>
	<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
    
<div class="attribute experience tooltip" title="<font color=white><b>&#1578;&#1580;&#1585;&#1576;&#1607; <?php echo floor($hero_info['level']/2); ?>%</b></font><br>&#1576;&#1585;&#1575;&#1740; &#1585;&#1587;&#1740;&#1583;&#1606; &#1576;&#1607; Szint <?php echo ($hero_info['experience']+1); ?> &#1602;&#1607;&#1585;&#1605;&#1575;&#1606; &#1588;&#1605;&#1575; &#1576;&#1607; <?php echo (150-$hero_info['level']); ?> &#1578;&#1580;&#1585;&#1576;&#1607; &#1606;&#1740;&#1575;&#1586; &#1583;&#1575;&#1585;&#1583;.">
			<div class="element attribName">&#1578;&#1580;&#1585;&#1576;&#1607;</div>
			<div class="element current power"><?php echo $hero_info['level']; ?></div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo floor($hero_info['level']); ?>%;"></div>
				</div>
			</div>
			<div class="element add"></div>
			<div class="element points"><?php echo intval($hero_info['points']); ?></div>
			<div class="clear"></div>
		</div>





  <div class="attribute level tooltip" title="<font color=white><b>Szint &#1602;&#1607;&#1585;&#1605;&#1575;&#1606;</b></font><br>Szint &#1602;&#1607;&#1585;&#1605;&#1575;&#1606; &#1588;&#1605;&#1575;<br><font color='#5dcbfb'>&#1602;&#1583;&#1585;&#1578; &#1607;&#1580;&#1608;&#1605;&#1740; &#1602;&#1607;&#1585;&#1605;&#1575;&#1606; &#1588;&#1605;&#1575; &#1576;&#1585;&#1575;&#1740; &#1607;&#1585; &#1575;&#1605;&#1578;&#1740;&#1575;&#1586;&#1740; &#1705;&#1607; &#1576;&#1607; &#1570;&#1606; &#1583;&#1575;&#1583;&#1607; &#1605;&#1740;&#8204;&#1588;&#1608;&#1583; &#1576;&#1607; &#1580;&#1575;&#1740; &#1575;&#1740;&#1606;&#1705;&#1607; &#1576;&#1607; &#1605;&#1740;&#1586;&#1575;&#1606; 80 &#1575;&#1601;&#1586;&#1575;&#1740;&#1588; &#1740;&#1575;&#1576;&#1583; &#1576;&#1607; &#1605;&#1740;&#1586;&#1575;&#1606; 100 &#1575;&#1601;&#1586;&#1575;&#1740;&#1588; &#1582;&#1608;&#1575;&#1607;&#1583; &#1740;&#1575;&#1601;&#1578;.</font>">
			<div class="element attribName">Szint &#1602;&#1607;&#1585;&#1605;&#1575;&#1606;</div>
			<div class="element current power"><?php echo $hero_info['experience']; ?></div>
			<div class="element progress">
				<div class="bar-bg">
					<div class="bar" style="width:<?php echo min(100,$hero_info['experience']); ?>%"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>

		</div>
  </div></div>
    