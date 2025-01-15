&#65279;<?php
if(isset($_GET['gid']) && $_GET['gid']==37 && isset($_GET['del'])){
	$database->removeOases($_GET['del']);
    //header("Location: build.php?gid=37");
}

?>
<div class="clear"></div>
<h4><?php echo OCCUPIED.' '.OASIS.' '.REPORT_FROM_VIL.' '.$village->vname; ?></h4>

<table id="oasesOwned" cellpadding="1" cellspacing="1">
	<thead><tr><td><?php echo TYPE; ?></td><td><?php echo LOYALTY; ?></td><td><?php echo OCCUPIED; ?></td><td><?php echo COORDINATES; ?></td><td><?php echo RESOURCES; ?></td></tr></thead>
	<tbody>
		<?php
		$list['extra'] = 'distance<4.9497474683058326708059105347339';
		$order['by'] = 'distance';
		$coor = $database->getCoor($village->wid);
		$order['x'] = $coor['x'];
		$order['y'] = $coor['y'];
		$order['max'] = 2 * WORLD_MAX + 1;
		$rows = $database->getVillageOasis($list,30,$order);
		$conqOases = 0;
		foreach($rows as $row){ 
			if ($row['owner']==$session->uid){
				$conqOases++;
				$wref = $row["wref"];
				$type = $row["type"];
				$conqured = $row["conqured"];
				$lastupdated = $row["lastupdated"];
				$loyalty = $row["loyalty"];
				$owner = $row["owner"];?>
				<tr>
					<td class="type">
						<a onclick="return (function(){('<?php echo AREYOUSURE;?>').dialog({onOkay: function(dialog, contentElement){window.location.href = 'build.php?gid=37&amp;c=<?php echo $generator->getMapCheck($wref); ?>&amp;del=<?php echo $wref; ?>'}});return false;})()">
							<img class="del" src="img/x.gif" alt="&#1581;&#1584;&#1601;">
						</a>
						<?php
						switch($type) {
							case 1:	case 2: case 3:
								$tname =  WOOD;
							break;
							case 4:	case 5:	case 6:
								$tname =  CLAY;
							break;
							case 7:	case 8:	case 9:
								$tname =  IRON;
							break;
							case 10:case 11: case 12:
								$tname =  CROP;
							break;
						}
						?>
						<a href="karte.php?d=<?php echo $wref; ?>&c=<?php echo $generator->getMapCheck($wref); ?>"><?php echo $tname; ?></a>
					</td>
					<td class="zp"><?php echo $loyalty; ?>%</td>
					<td class="owned"><?php echo date('y.m.d.',$lastupdated); ?> <?php echo date('H:i',$lastupdated); ?></td>
					<td class="coords">
						<?php
						switch($type) {
							case 1:
								$tt =  "<span><img class='r1' src='img/x.gif' title=".WOOD."> 25%</span>";
							break;
							case 2:
								$tt =  "<span><img class='r1' src='img/x.gif' title=".WOOD."> 50%</span>";
							break;
							case 3:
								$tt =  "<span><img class='r1' src='img/x.gif' title=".WOOD."> 25%</span><span><img class='r4' src='img/x.gif' title=".CROP."> 25%</span>";
							break;
							case 4:
								$tt =  "<span><img class='r2' src='img/x.gif' title=".CLAY."> 25%</span>";
							break;
							case 5:
								$tt =  "<span><img class='r2' src='img/x.gif' title=".CLAY."> 50%</span>";
							break;
							case 6:
								$tt =  "<span><img class='r2' src='img/x.gif' title=".CLAY."> 25%</span><span><img class='r4' src='img/x.gif' title=".CROP."> 25%</span>";
							break;
							case 7:
								$tt =  "<span><img class='r3' src='img/x.gif' title=".IRON."> 25%</span>";
							break;
							case 8:
								$tt =  "<span><img class='r3' src='img/x.gif' title=".IRON."> 50%</span>";
							break;
							case 9:
								$tt =  "<span><img class='r3' src='img/x.gif' title=".IRON."> 25%</span><span><img class='r4' src='img/x.gif' title=".CROP."> 25%</span>";
							break;
							case 10: case 11:
								$tt =  "<span><img class='r4' src='img/x.gif' title=".CROP."> 25%</span>";
							break;
							case 12:
								$tt =  "<span><img class='r4' src='img/x.gif' title=".CROP."> 50%</span>";
							break;
						}
						?>
						<a class="" href="karte.php?x=<?php echo $row['x']; ?>&amp;y=<?php echo $row['y']; ?>">
							<span class="coordinates coordinatesAligned">
								<span class="coordinatesWrapper">
								<?php if (DIRECTION=='ltr') {?>
									<span class="coordinateX">(<?php echo $row['x']; ?></span>
									<span class="coordinatePipe">|</span>
									<span class="coordinateY"><?php echo $row['y']; ?>)</span>
								<?php } elseif (DIRECTION=='rtl') {?>
									<span class="coordinateY"><?php echo $row['y']; ?>)</span>
									<span class="coordinatePipe">|</span>
									<span class="coordinateX">(<?php echo $row['x']; ?></span>
								<?php } ?>
								</span>
							</span>
							<span class="clear"></span>
						</a>
					</td>
					<td class="res"><?php echo $tt; ?></td>
				</tr>
		<?php 
			}
		}
		?>
	</tbody>
</table>
<?php
	if($conqOases < 1){
    	echo '<div class="nextOases none">1. '.NEXTOASISHEROMANSION.' 10</div>';
	}
	if($conqOases < 2){
    	echo '<div class="nextOases none">2. '.NEXTOASISHEROMANSION.' 15</div>';
	}
	if($conqOases < 3){
    	echo '<div class="nextOases none">3. '.NEXTOASISHEROMANSION.' 20</div>';
    }
?>
<h4 class="spacer">Other oasis </h4>
<table id="oasesSurround" cellpadding="1" cellspacing="1">
	<thead><tr><td><?php echo TYPE; ?></td><td><?php echo LOYALTY; ?></td><td><?php echo OCCUPIED; ?></td><td><?php echo COORDINATES; ?></td><td><?php echo RESOURCES; ?></td></tr></thead>
	<tbody>
		<?php
		foreach($rows as $row) {
			if ($row['distance']<=4.949747468305832670805910534733){
				echo "<tr><td class=\"type\">";
				switch($row['type']) {
					case 1: case 2: case 3:
						$tname =  WOOD;
					break;
					case 4: case 5: case 6:
						$tname =  CLAY;
					break;
					case 7: case 8: case 9:
						$tname =  IRON;
					break;
					case 10: case 11: case 12:
						$tname =  CROP;
					break;
				}
				echo "<a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">".$tname."</a></td>";
				if($row['owner']==3){
					$oOwner = "-";
				}else{
					$oOwner = $database->getUser($row['owner'],1);
				}
				//print_r($oOwner);
				echo "<td class=\"nam\">".(isset($oOwner['username'])?("<a href=\"spieler.php?uid=".$oOwner['id']."\">".$oOwner['username']."</a>"):$oOwner)."</td>";
				if($row['conqured']==0){
					$oVillage = "-";
				}else{
					$oVillage = $database->getVillage($row['conqured']);
				}
				echo "<td class=\"vil\">".(isset($oVillage['name'])?("<a href=\"karte.php?d=".$oVillage['wref']."&c=".$generator->getMapCheck($oVillage['wref'])."\">".$oVillage['name']."</a>"):$oVillage)."</td>";
				echo "<td class=\"coords\">";
				echo "<a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">
					<span class=\"coordinates coordinatesAligned\"><span class=\"coordinatesWrapper\">";
				if (DIRECTION=='ltr') {
					echo '<span class="coordinateX">('.$row['x'].'</span><span class="coordinatePipe">|</span><span class="coordinateY">'.$row['y'].')</span>';
				} elseif (DIRECTION=='rtl') {
					echo '<span class="coordinateY">'.$row['y'].')</span><span class="coordinatePipe">|</span><span class="coordinateX">('.$row['x'].'</span>';
				}
				echo "</span></span><span class=\"clear\">&#8206;</span></a>";
				echo "</td>";
				switch($row['type']) {
					case 1:
						$ttt =  "<span><img class='r1' src='img/x.gif' title=".WOOD."> 25%</span>";
					break;
					case 2:
						$ttt =  "<span><img class='r1' src='img/x.gif' title=".WOOD."> 50%</span>";
						break;
					case 3:
						$ttt =  "<span><img class='r1' src='img/x.gif' title=".WOOD."> 25%</span><span><img class='r4' src='img/x.gif' title=".CROP."> 25%</span>";
					break;
					case 4:
						$ttt =  "<span><img class='r2' src='img/x.gif' title=".CLAY."> 25%</span>";
					break;
					case 5:
						$ttt =  "<span><img class='r2' src='img/x.gif' title=".CLAY."> 50%</span>";
					break;
					case 6:
						$ttt =  "<span><img class='r2' src='img/x.gif' title=".CLAY."> 25%</span><span><img class='r4' src='img/x.gif' title=".CROP."> 25%</span>";
					break;
					case 7:
						$ttt =  "<span><img class='r3' src='img/x.gif' title=".IRON."> 25%</span>";
						break;
					case 8:
						$ttt =  "<span><img class='r3' src='img/x.gif' title=".IRON."> 50%</span>";
					break;
					case 9:
						$ttt =  "<span><img class='r3' src='img/x.gif' title=".IRON."> 25%</span><span><img class='r4' src='img/x.gif' title=".CROP."> 25%</span>";
					break;
					case 10:
					case 11:
						$ttt =  "<span><img class='r4' src='img/x.gif' title=".CROP."> 25%</span>";
					break;
					case 12:
						$ttt =  "<span><img class='r4' src='img/x.gif' title=".CROP."> 50%</span>";
					break;
				}
				echo "<td class=\"res\">".$ttt."</td>";
				echo "</tr>";
			}
		}
		?>
	</tbody>
</table>
