<?php 
$varmedal = $database->getProfileMedal($session->uid);  ?>
<form action="spieler.php" method="POST">
    <input type="hidden" name="ft" value="p1" />
    <input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
		<h4 class="round"><?php echo EDITPROFILE;?></h4>
	<table cellpadding="1" cellspacing="1" id="editDetails" class="transparent">
		<tbody>
			<tr>
                <?php 
    if($session->userinfo['birthday'] != 0) {
   $bday = explode("-",$session->userinfo['birthday']);
   }
   else {
   $bday = array('','','');
   }
   ?>

				<th class="birth"><?php echo BIRTHDAY;?></th>
				<td class="birth">
					
					<input tabindex="3" type="text" name="jahr" value="<?php echo $bday[0]; ?>" maxlength="4" class="text year">
                    <select tabindex="2" name="monat" class="dropdown">
<option value="0"></option><option value="1" <?php if($bday[1] == 1) { echo "selected"; } ?>>January</option><option value="2"<?php if($bday[1] == 2) { echo "selected"; } ?>>Febuary</option><option value="3"<?php if($bday[1] == 3) { echo "selected"; } ?>>March</option><option value="4"<?php if($bday[1] == 4) { echo "selected"; } ?>>April</option><option value="5"<?php if($bday[1] == 5) { echo "selected"; } ?>>May</option><option value="6"<?php if($bday[1] == 6) { echo "selected"; } ?>>June</option><option value="7"<?php if($bday[1] == 7) { echo "selected"; } ?>>July</option><option value="8"<?php if($bday[1] == 8) { echo "selected"; } ?>>August</option><option value="9"<?php if($bday[1] == 9) { echo "selected"; } ?>>September</option><option value="10"<?php if($bday[1] == 10) { echo "selected"; } ?>>October</option><option value="11"<?php if($bday[1] == 11) { echo "selected"; } ?>>November</option><option value="12"<?php if($bday[1] == 12) { echo "selected"; } ?>>December</option>                	</select>
                    <input tabindex="1" class="text day" type="text" name="tag" value="<?php echo $bday[2]; ?>" maxlength="2">
                    </td>
				<th class="gender" rowspan="2"><?php echo GENDER;?></th>
				<td class="gender" rowspan="2">
					<label>
						<input class="radio" type="radio" name="mw" value="0" <?php if($session->userinfo['gender'] == 0) { echo "checked"; } ?>> <?php echo GENDER0;?></label><br>
					<label>
						<input class="radio" type="radio" name="mw" value="1" tabindex="5" <?php if($session->userinfo['gender'] == 1) { echo "checked"; } ?>> <?php echo GENDER1;?></label><br>
					<label>
						<input class="radio" type="radio" name="mw" value="2" <?php if($session->userinfo['gender'] == 2) { echo "checked"; } ?>><?php echo GENDER2;?></label>
				</td>
			</tr>
			<tr>
				<th><?php echo LOCATION;?></th>
				<td><input tabindex="4" type="text" name="ort" value="<?php echo $session->userinfo['location']; ?>" maxlength="30" class="text">
				</td>
			</tr>
		</tbody>
	</table>

		<h4 class="round spacer"><?php echo DESCRIPTION;?></h4>
	<textarea tabindex="6" style="text-align:center;" class="editDescription editDescription1" name="be1"><?php echo $session->userinfo['desc2']; ?></textarea>
	<textarea tabindex="7" style="text-align:center;" class="editDescription editDescription2" name="be2"><?php echo $session->userinfo['desc1']; ?></textarea>
	<div class="clear"></div>

				<div class="switchWrap">
			<div class="openedClosedSwitch switchClosed" id="switchMedals"><?php echo MEDALS;?></div>
			<div class="clear"></div>
		</div>

		<table cellpadding="1" cellspacing="1" id="medals" class="hide">
			<thead>
				<tr>
					<td><?php echo CATEGORY;?></td>
					<td><?php echo RANK;?></td>
					<td><?php echo WEEK;?></td>
					<td><?php echo BBCODE;?></td>
				</tr>
			</thead>
			<tbody>
									<tr>
													<td class="typ"><?php echo BEGINNERPROTECTION;?></td>
													<td class="ra"></td>
													<td class="we"></td>
													<td class="bb">[#0]</td>
											</tr>
            <?php
/******************************
INDELING CATEGORIEEN:
===============================
== 1. Aanvallers top 10      ==
== 2. Defence top 10         ==
== 3. Klimmers top 10        ==
== 4. Overvallers top 10     ==
== 5. In att en def tegelijk ==
== 6. in top 3 - aanval      ==
== 7. in top 3 - verdediging ==
== 8. in top 3 - klimmers    ==
== 9. in top 3 - overval     ==
******************************/				
				
				
	foreach($varmedal as $medal) {
	$titel=MEDALS;
	switch ($medal['categorie']) {
    case "1":
        $titel=AOFW;
        break;
    case "2":
        $titel=DOFW;
        break;
    case "3":
        $titel=COFW;
        break;
    case "4":
        $titel=ROFW;
        break;
    case "5":
        $titel=ADOFW;
        break;
    case "6":
        $titel=sprintf(TOP3AOFW,$medal['points']);
        break;
    case "7":
        $titel=sprintf(TOP3DOFW,$medal['points']);
        break;
    case "8":
        $titel=sprintf(TOP3COFW,$medal['points']);
        break;
    case "9":
        $titel=sprintf(TOP3COFW,$medal['points']);
        break;
    case "10":
        $titel=COFW;
        break;
    case "11":
        $titel=sprintf(TOP3COFW,$medal['points']);
        break;
    case "12":
        $titel=sprintf(TOP10AOFW,$medal['points']);
        break;
	}			
				 echo"<tr>
				   <td class=\"typ\"> ".$titel."</td>
				   <td class=\"ra\">".$medal['plaats']."</td>
				   <td class=\"we\">".$medal['week']."</td>
				   <td class=\"bb\">[#".$medal['id']."]</td>
			 	 </tr>";
				 } ?>				
				

			</tbody>
		</table>
	
		<h4 class="round spacer"><?php echo VILLAGES;?></h4>

	<table cellpadding="1" cellspacing="1" id="villages">
		<thead>
			<tr>
				<th class="name"><?php echo NAME;?></th>
                <th><?php echo OASIS;?></th>
				<th><?php echo POPUALTION;?></th>
                <th><?php echo COORDIANTES;?></th>
			</tr>
		</thead>
		<tbody>
<?php
$prefix = "".TB_PREFIX."vdata";
	$sql = mysql_query("SELECT * FROM $prefix WHERE owner = $session->uid ORDER BY pop DESC");
    $name = 0;

	while($row = mysql_fetch_array($sql)){ 
	$vname = $row['name'];
	if($row['owner']==2){$cVName = defined($vname);($cVName?constant($vname):$vname);}
    echo "<tr>";
    echo "<td class=\"name\"><input tabindex=\"6\" type=\"text\" name=\"dname$name\" value=\"".$vname."\" maxlength=\"20\" class=\"text\"> ";
    if($row['capital'] == 1) {
        echo "<span class=\"mainVillage\">(<?php echo CAPITAL;?>)</span>";
    }
    echo "</td>";
    echo "<td class=\"oases\">";
$prefix = "".TB_PREFIX."odata";
$sql2 = mysql_query("SELECT * FROM $prefix WHERE owner = ".$session->uid." AND conqured = ".$row['wref']."");
while($row2 = mysql_fetch_array($sql2)){
$type = $row2["type"];
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
    echo "<td class=\"inhabitants\"> ".$row['pop']." </td>";
    $prefix = "".TB_PREFIX."wdata";
    $sql2 = mysql_query("SELECT * FROM $prefix WHERE id = ".$row['wref']."");
    $coords = mysql_fetch_array($sql2);
    echo "<td class=\"coords\"><a href=\"karte.php?x=".$coords['y']."&y=".$coords['x']."\"><span class=\"coordinates coordinatesAligned\"><span class=\"coordinatesWrapper\">";
    if (DIRECTION == 'ltr'){
		echo "<span class=\"coordinateX\">(".$coords['x']."</span><span class=\"coordinatePipe\">|</span><span class=\"coordinateY\">".$coords['y'].")</span>";
	}elseif (DIRECTION == 'rtl'){
		echo "<span class=\"coordinateY\">".$coords['y'].")</span><span class=\"coordinatePipe\">|</span><span class=\"coordinateX\">(".$coords['x']."</span>";
	}
    echo "</span></span></td>";
    echo "</tr>";
    $name++;
    }
    ?>
					</tbody>
	</table>

	<div class="submitButtonContainer">
		<button type="submit" value="submit" name="s1" id="btn_ok" class="green ">
		<div class="button-container addHoverClick "><div class="button-background"><div class="buttonStart"><div class="buttonEnd"><div class="buttonMiddle"></div></div></div></div><div class="button-content"><?php echo SAVE;?></div></div></button></div>
</form><script type="text/javascript">
	window.addEvent('domready', function()
	{
		if ($('switchMedals'))
		{
			$('switchMedals').addEvent('click', function(e)
			{
				Travian.toggleSwitch($('medals'), $('switchMedals'));
			});
		}
	});


</script>
