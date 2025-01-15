<?php
$displayarray = $database->getUser($_GET['uid'],1);
$varmedal = $database->getProfileMedal($_GET['uid']);
$profiel="".$displayarray['desc1']."".md5('skJkev3')."".$displayarray['desc2']."";
require("medal.php");
$profiel=explode("".md5('skJkev3')."", $profiel);
$varray = $database->getProfileVillages($_GET['uid']);
$totalpop = 0;
foreach($varray as $vil) {
	$totalpop += $vil['pop'];
}

$heroface = $database->getHeroFace($_GET['uid']);
?>

<h4 class="round"><?php echo REPORT_INFORMATION;?></h4>
<?php
if($_GET['uid']==2){
	echo '<img src="gpack/travian_Travian_4.2_BigBang/img/t/t10_2.jpg" border="0">';
} else {
	echo '<img class="heroImage" style="width:160px;height:205px;" src="hero_body.php?uid='.$_GET['uid'].'&size=profile&'.md5($_GET['uid']).'&'.$heroface['hash'].'" alt="hero">';
}
?>
<table cellpadding="1" cellspacing="1" id="details" class="transparent">
	<tr>
		<th><?php echo RANK;?></th>
		<td><?php echo $ranking->getUserRank($displayarray['username']); ?></td>
	</tr>
	<tr>
		<th><?php echo TRIBE;?></th>
		<td>
			<?php 
			if($displayarray['tribe'] == 1) {
				echo TRIBE1;
			}elseif($displayarray['tribe'] == 2) {
				echo TRIBE2;
			}elseif($displayarray['tribe'] == 3) {
				echo TRIBE3;
			}elseif($displayarray['tribe'] == 4) {
				echo TRIBE4;
			}elseif($displayarray['tribe'] == 5) {
				echo TRIBE5;
			}
			?>
		</td>
	</tr>
	<tr>
		<th><?php echo ALLIANCE;?></th>
		<td>
			<?php
			if($displayarray['alliance'] == 0) {
                echo "-";
            }
			else {
                $displayalliance = $database->getAllianceName($displayarray['alliance']);
                echo "<a href=\"allianz.php?aid=".$displayarray['alliance']."\">".$displayalliance."</a>";
			}
			?>
		</td>
	</tr>
	<tr>
		<th><?php echo VILLAGES;?></th>
		<td><?php echo count($varray);?></td>
	</tr>
	<tr>
		<th><?php echo POPULATION;?></th>
		<td><?php echo $totalpop;?></td>
	</tr>
    <?php 
			//Date of Birth
            if(isset($displayarray['birthday']) && $displayarray['birthday'] != 0) {
			$age = date('Y') - substr($displayarray['birthday'],0,4);
				if ((date('m') - substr($displayarray['birthday'],5,2)) < 0){$age --;}
				elseif ((date('m') - substr($displayarray['birthday'],5,2)) == 0){
					if(date('d') < substr($displayarray['birthday'],8,2)){$age --;}
				}
            echo "<tr><th>".BIRTHDAY."</th><td>$age</td></tr>";
            }
			//Gender
            if(isset($displayarray['gender']) && $displayarray['gender'] != 0) {
            $gender = ($displayarray['gender']== 1)? GENDER1 : GENDER2;
            echo "<tr><th>".Gender."</th><td>".$gender."</td></tr>";
            }
			//Location
            if($displayarray['location'] != "") {
            echo "<tr><th>".LOCATION.":</th><td>".$displayarray['location']."</td></tr>";
            }
            ?>
    		<tr>
        	<?php
            	if($_GET['uid'] == $session->uid) {
                	if($session->is_sitter){
            			echo "<td colspan=\"2\"> <span class=\"a arrow disabled\">".EDITPROFILE."</span></td>";
                    }else{
                    	echo "<td colspan=\"2\"> <a class=\"arrow\" href=\"spieler.php?s=1\">".EDITPROFILE."</a></td>";
                    }
                } else {
            		echo "<td colspan=\"2\"> <a class=\"message messageStatus messageStatusUnread\" href=\"nachrichten.php?t=1&amp;id=".$_GET['uid']."\">".SENDMESSAGE."</a></td>";
			 	}
             ?>
	</tr>
</table>

	
<div class="clear"></div>
<br />

<h4 class="round"><?php echo DESCRIPTION;?></h4>

<div class="description description1"><?php echo nl2br($profiel[1]); ?></div>
<div class="description description2"><?php echo nl2br($profiel[0]); ?></div>

<div class="clear"></div>


<h4 class="round"><?php echo VILLAGES;?></h4>

<table cellpadding="1" cellspacing="1" id="villages">
	<thead>
		<tr>
			<th class="name"><?php echo NAME;?></th>
            <th><?php echo OASIS;?></th>
			<th><?php echo POPULATION;?></th>
			<th><?php echo LOCATION;?></th>
		</tr>
	</thead>
	<tbody>
        <?php 
    foreach($varray as $vil) {
    	$coor = $database->getCoor($vil['wref']);
	$vname = $vil['name'];
	if(defined($vname)){$vname=constant($vname);}
    	echo "<tr><td class=\"name\"><a href=\"position_details.php?x=".$coor['x']."&amp;y=".$coor['y']."\">".$vname."</a> ";
        if($vil['capital'] == 1) {
        echo "<span class=\"mainVillage\">(".CAPITAL.")</span>";
        }
        echo "</td><td class=\"oases\">";
        
$prefix = "".TB_PREFIX."odata";
$uid = $_GET['uid']; $wref = $vil['wref'];
$sql2 = mysql_query("SELECT * FROM $prefix WHERE owner = $uid AND conqured = $wref");
while($row = mysql_fetch_array($sql2)){
$type = $row["type"];
switch($type) {
case 1:
case 2:
echo  "<img class='r1' src='img/x.gif' title='".WOOD."'>";
break;
case 3:
echo  "<img class='r1' src='img/x.gif' title='".WOOD."'> <img class='r4' src='img/x.gif' title='".CROP."'>";
break;
case 4:
case 5:
echo  "<img class='r2' src='img/x.gif' title='".CLAY."'>";
break;
case 6:
echo  "<img class='r2' src='img/x.gif' title='".CLAY."'> <img class='r4' src='img/x.gif' title='".CROP."'>";
case 7:
case 8:
echo  "<img class='r3' src='img/x.gif' title='".IRON."'>";
break;
case 9:
echo  "<img class='r3' src='img/x.gif' title='".IRON."'> <img class='r4' src='img/x.gif' title='".CROP."'>";
break;
case 10:
case 11:
case 12:
echo  "<img class='r4' src='img/x.gif' title='".CROP."'>";
break;
}
}
        echo "</td>";
        echo "<td class=\"inhabitants\">".$vil['pop']."</td><td class=\"coords\">";
        echo "<a href=\"karte.php?x=".$coor['x']."&amp;y=".$coor['y']."\"><span class=\"coordinates coordinatesAligned\">";
        if (DIRECTION == 'ltr'){
			echo "<span class=\"coordinateX\">(".$coor['x']."</span><span class=\"coordinatePipe\">|</span><span class=\"coordinateY\">".$coor['y'].")</span>";
		}elseif (DIRECTION == 'rtl'){
			echo "<span class=\"coordinateY\">".$coor['y'].")</span><span class=\"coordinatePipe\">|</span><span class=\"coordinateX\">(".$coor['x']."</span>";
		}
        echo "</span><span class=\"clear\">?</span></td></tr>";
    }
    ?>
</tbody>
</table>
