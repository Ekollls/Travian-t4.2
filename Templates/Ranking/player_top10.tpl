<?php
    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }
    $result = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id > 3 ORDER BY ap DESC, id ASC LIMIT 10");
    $result2 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE username = '".$session->username."' ORDER BY ap DESC, id ASC LIMIT 1");
    $attRank = $ranking->getTop10AttRank($session->username);
    $defRank = $ranking->getTop10DefRank($session->username);
    //$clpRank = $ranking->getTop10ClpRank($session->username);
    $rrRank = $ranking->getTop10RobbersRank($session->username);
?>
<div class="contentNavi tabNavi">
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="statistiken.php?tid=1"><span class="tabItem"><?php echo OVERVIEW;?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="statistiken.php?tid=31"><span class="tabItem"><?php echo REPORT_ATTACKER;?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="statistiken.php?tid=32"><span class="tabItem"><?php echo REPORT_DEFENDER;?></span></a></div>
				</div>
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="statistiken.php?tid=7"><span class="tabItem"><?php echo TOP10;?></span></a></div>
				</div><div class="clear"></div>
</div>
<div id="statLeft" class="top10Wrapper">
<h4 class="round small  top top10_offs"><?php echo TOPATTACKERS;?></h4>
<table cellpadding="1" cellspacing="1" id="top10_offs" class="top10 row_table_data">
	<thead>
		<tr>
			<td><?php echo RANK;?></td>
			<td><?php echo PLAYER;?></td>
			<td><?php echo POINTS;?></td>
		</tr>
	</thead>
	<tbody>
<?php
	while($row = mysql_fetch_array($result)){
		if($row['username']==$session->username) {
			echo "<tr class=\"own hl hover\">";
        } else {
        	echo "<tr class=\"hover\">";
		}
		echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
		echo "<td class=\"pla hl\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
		echo "<td class=\"val lc\">".$row['ap']."</td>";
		echo "</tr>";
	}
?>
		<tr>
			<td colspan="3" class="empty"></td>
		</tr>
<?php
	while($row = mysql_fetch_array($result2)){
		if($attRank > 10) {
			echo "<tr class=\"none\"><td class=\"ra fc\">?&nbsp;</td>";
        } else {
        	echo "<tr class=\"own hl select\"><td class=\"ra fc\">".$attRank.".&nbsp;</td>";
        }
        
	  	if($attRank > 10) {
			echo "<td class=\"pla\">".$row['username']."</td>";
        } else {
        	echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
        }
		echo "<td class=\"val lc\">".$row['ap']."</td>";
		echo "</tr>";
	}
?>
         </tbody>
</table>
<?php
    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }
    $result = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id > 3 ORDER BY dp DESC, id ASC Limit 10");
    $result2 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE username = '".$session->username."' ORDER BY dp DESC, id ASC Limit 1");
?>
<h4 class="round small spacer top top10_defs"><?php echo TOPDEFENDERS;?></h4>
<table cellpadding="1" cellspacing="1" id="top10_defs" class="top10 row_table_data">
	<thead>
		<tr>
			<td><?php echo RANK;?></td>
			<td><?php echo PLAYER;?></td>
			<td><?php echo POINT;?></td>
		</tr>
	</thead>
	<tbody>
<?php
	while($row = mysql_fetch_array($result)){
		if($row['username']==$session->username) {
			echo "<tr class=\"own hl hover\">";
        } else {
        	echo "<tr class=\"hover\">";
		}
		echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
		echo "<td class=\"pla hl\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
		echo "<td class=\"val lc\">".$row['dp']."</td>";
		echo "</tr>";
	}
?>
		 <tr>
			<td colspan="3" class="empty"></td>
		</tr>
<?php
	while($row = mysql_fetch_array($result2)){
		if($defRank > 10) {
			echo "<tr class=\"none\"><td class=\"ra fc\">?&nbsp;</td>";
        } else {
        	echo "<tr class=\"own hl select\"><td class=\"ra fc\">".$defRank.".&nbsp;</td>";
        }
        
	  	if($defRank > 10) {
			echo "<td class=\"pla\">".$row['username']."</td>";
        } else {
        	echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
        }
		echo "<td class=\"val lc\">".$row['dp']."</td>";
		echo "</tr>";
	}
?>
         </tbody>
</table>
</div>

<div id="statRight" class="top10Wrapper">
<?php
    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }
    $result = $ranking->procUsersTop10PopRank();
?>
<h4 class="round small  top top10_climbers"><?php echo TOPCLIMBERS;?></h4>
<table cellpadding="1" cellspacing="1" id="top10_climbers" class="top10 row_table_data">
	<thead>
		<tr>
			<td><?php echo RANK;?></td>
			<td><?php echo PLAYER;?></td>
			<td><?php echo POINTS;?></td>
		</tr>
	</thead>
	<tbody>
<?php
	$myrank = 0;
	$mytop10popchange = 0;
	for($i=1;$row = mysql_fetch_array($result);$i++){
		if($i<=10) {
			if($row['username']==$session->username) {
				echo "<tr class=\"own hl hover\">";
				$myrank = $i;
				$mytop10popchange = $row['top10popchange'];
			} else {
				echo "<tr class=\"hover\">";
			}
			echo "<td class=\"ra fc\">".$i.".&nbsp;</td>";
			echo "<td class=\"pla hl\"><a href='spieler.php?uid=".$row['userid']."'>".$row['username']."</a></td>";
			echo "<td class=\"val lc\">".$row['top10popchange']."</td>";
			echo "</tr>";
		} elseif($row['username']==$session->username){
			$myrank = $i;
			$mytop10popchange = $row['top10popchange'];
			break;
		}
	}
	echo '<tr><td colspan="3" class="empty"></td></tr>';
	if($myrank<=10 && $myrank!=0){
		echo "<tr class=\"own hl select\"><td class=\"ra fc\">".$myrank.".&nbsp;</td>";
		echo "<td class=\"pla\"><a href='spieler.php?uid=".$session->uid."'>".$session->username."</a></td>";
	}else {
		echo "<tr class=\"none\"><td class=\"ra fc\">?&nbsp;</td>";
		echo "<td class=\"pla\">".$session->username."</td>";
	}
	echo "<td class=\"val lc\">".$mytop10popchange."</td>";
	echo "</tr>";
?>
    </tbody>
</table>
<?php
    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }
    $result = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id>3 ORDER BY RR DESC, id ASC Limit 10");
    $result2 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE username = '".$session->username."' ORDER BY RR DESC, id ASC Limit 1");
?>
<h4 class="round small spacer top top10_raiders"><?php echo TOPRAIDERS;?></h4>
<table cellpadding="1" cellspacing="1" id="top10_raiders" class="top10 row_table_data">
	<thead>
		<tr>
			<td><?php echo RANK;?></td>
			<td><?php echo PLAYER;?></td>
			<td><?php echo RESOURCES;?></td>
		</tr>
	</thead>
	<tbody>
<?php
	while($row = mysql_fetch_array($result)){
		if($row['username']==$session->username) {
			echo "<tr class=\"own hl hover\">";
        } else {
        	echo "<tr class=\"hover\">";
		}
		echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
		echo "<td class=\"pla hl\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
		echo "<td class=\"val lc\">".$row['RR']."</td>";
		echo "</tr>";
	}
?>
		 <tr>
			<td colspan="3" class="empty"></td>
		</tr>
<?php
	while($row = mysql_fetch_array($result2)){
		if($rrRank > 10) {
			echo "<tr class=\"none\"><td class=\"ra fc\">?&nbsp;</td>";
        } else {
        	echo "<tr class=\"own hl select\"><td class=\"ra fc\">".$rrRank.".&nbsp;</td>";
        }
        
	  	if($rrRank > 10) {
			echo "<td class=\"pla\">".$row['username']."</td>";
        } else {
        	echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
        }
		echo "<td class=\"val lc\">".$row['RR']."</td>";
		echo "</tr>";
	}
?>
    </tbody>
</table>
</div>
<div class="clear">&nbsp;</div>