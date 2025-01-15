<h1 class="titleInHeader"><?php echo B17;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>
<div id="build" class="gid17">
<div class="build_desc">
<a href="#" onClick="return Travian.Game.iPopup(17,4);" class="build_logo"> 
	<img class="building big white g17" src="img/x.gif" alt="<?php echo B17;?>" title="<?php echo B17;?>" /> 
</a> 
<?php echo B17_DESC;?></div> 
 
<?php
include("upgrade.tpl");
include("17_menu.tpl");
?>

<script language="JavaScript"> 
var haendler = <?php echo $market->merchantAvail(); ?>;
var carry = <?php echo $market->maxcarry; ?>;
</script>
<div class="boxes boxesColor gray traderCount"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"> <?php echo MERCHANTS.' '.$market->merchant; ?> / <?php echo $market->merchantAvail(); ?></div>
				</div><div class="clear"></div>
<?php
$checkexist = false;
for($i=1;$i<=4;$i++){if(!isset($_POST['r'.$i])){ $_POST['r'.$i]='';} else {$_POST['r'.$i] = intval($_POST['r'.$i]);}}
$allres = $_POST['r1']+$_POST['r2']+$_POST['r3']+$_POST['r4'];
if(isset($_POST['x']) && $_POST['x']!="" && isset($_POST['y']) && $_POST['y']!=""){
	$_POST['x'] = intval($_POST['x']);
	$_POST['y'] = intval($_POST['y']);
	$getwref = $database->getVilWref($_POST['x'],$_POST['y']);
	$checkexist = $database->checkVilExist($getwref);
}
else if(isset($_POST['dname']) && $_POST['dname']!=""){
	$getwref = $database->getVillageByName($_POST['dname']);
	$checkexist = $database->checkVilExist($getwref);
}
if(isset($_POST['ft'])=='check' && $allres!=0 && $allres <= $market->maxcarry*$market->merchantAvail() && (($_POST['x']!="" && $_POST['y']!="") or $_POST['dname']!="") && $checkexist){
?>
<form method="POST" name="snd" action="build.php"> 
<input type="hidden" name="ft" value="mk1">
<input type="hidden" name="repeat" value="<?=$_POST['repeat']?>">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="x" value="<?php echo $_POST['x']; ?>">
<input type="hidden" name="y" value="<?php echo $_POST['y']; ?>">
<input type="hidden" name="dname" value="<?php echo $_POST['dname']; ?>">
<table id="send_select" class="send_res" cellpadding="1" cellspacing="1">
	<tr>
		<td class="ico"><img class="r1" src="img/x.gif" alt="<?php echo LUMBER;?>" title="<?php echo LUMBER;?>" /></td> 
		<td class="nam"><?php echo LUMBER;?></td> 
		<td class="val"><input class="text disabled" type="text" name="r1" id="r1" value="<?php echo $_POST['r1']; ?>" readonly></td> 
		<td class="max"> / <span class="none"><B><?php echo $market->maxcarry; ?></B></span> </td> 
	</tr>
    <tr> 
		<td class="ico"><img class="r2" src="img/x.gif" alt="<?php echo CLAY;?>" title="<?php echo CLAY;?>" /></td> 
		<td class="nam"><?php echo CLAY;?></td> 
		<td class="val"><input class="text disabled" type="text" name="r2" id="r2" value="<?php echo $_POST['r2']; ?>" readonly></td> 
		<td class="max"> / <span class="none"><b><?php echo$market->maxcarry; ?></b></span> </td> 
	</tr>
    <tr> 
		<td class="ico"><img class="r3" src="img/x.gif" alt="<?php echo IRON;?>" title="<?php echo IRON;?>" /></td> 
		<td class="nam"><?php echo IRON;?></td> 
		<td class="val"><input class="text disabled" type="text" name="r3" id="r3" value="<?php echo $_POST['r3']; ?>" readonly> 
		</td> 
		<td class="max"> / <span class="none"><b><?php echo $market->maxcarry; ?></b></span> </td> 
	</tr>
    <tr> 
		<td class="ico"><img class="r4" src="img/x.gif" alt="<?php echo CROP;?>" title="<?php echo CROP;?>" /></td> 
		<td class="nam"><?php echo CROP;?></td> 
		<td class="val"> <input class="text disabled" type="text" name="r4" id="r4" value="<?php echo $_POST['r4']; ?>" readonly> 
		</td> 
		<td class="max"> / <span class="none"><B><?php echo $market->maxcarry; ?></B></span></td> 
	</tr></table> 
<table id="target_validate" class="res_target" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<th><?php echo CF_COOR;?>:</th>
        <?php
		if($_POST['x']!="" && $_POST['y']!=""){
        $getwref = $database->getVilWref($_POST['x'],$_POST['y']);
		$getvilname = $database->getVillageField($getwref, "name");
		$getvilowner = $database->getVillageField($getwref, "owner");
		$getvilcoor['y'] = $_POST['y'];
		$getvilcoor['x'] = $_POST['x'];
		$time = $generator->procDistanceTime($village->coor,$getvilcoor,$session->tribe,0);
		}
		else if($_POST['dname']!=""){
		$getwref = $database->getVillageByName($_POST['dname']);
		$getvilcoor = $database->getCoor($getwref);
		$getvilname = $database->getVillageField($getwref, "name");
		$getvilowner = $database->getVillageField($getwref, "owner");
		$time = $generator->procDistanceTime($village->coor,$getvilcoor,$session->tribe,0);
		}
	if(defined($getvilname)) $getvilname = constant($getvilname);
        ?>
		<td class="vil"><a href="position_details.php?x=<?php echo $getvilcoor['y']; ?>&y=<?php echo $getvilcoor['x']; ?>"><span class="coordinates coordinatesWithText"><span class="coordText"><?php echo $getvilname; ?></span></span><span class="clear"></span></a></td>
	</tr>
	<tr>
		<th>Player:</th>
		<td><a href="spieler.php?uid=<?php echo $getvilowner; ?>"><?php echo $database->getUserField($getvilowner,'username',0); ?></a></td>
	</tr>
	<tr>
		<th>duration:</th>
		<td><?php echo $generator->getTimeFormat($time); ?></td>
	</tr>
	<tr>
		<th><?php echo MERCHANTS;?>:</th>
		<td><?php
        $resource = array($_POST['r1'],$_POST['r2'],$_POST['r3'],$_POST['r4']); 
        echo ceil((array_sum($resource)-0.1)/$market->maxcarry); ?></td>
	</tr>
    <?php if($session->goldclub) {
						$repeat = 1;
				if($session->goldclub) {
					if($_POST['repeat'] > 0 && $_POST['repeat'] < 4) {
						$repeat = $_POST['repeat'];
					}
				}
 ?>
	<tr>
		<th>تکرار:</th>
		<td><?=$repeat?></td>
	</tr><?php } ?>

	<tr>
		<td colspan="2">
					</td>
	</tr>

</tbody></table>
<div class="clear"></div>
<p>
<button type="submit" value="ok" name="s1" id="btn_ok" class="dynamic_img" tabindex="8">
	<div class="button-container">
		<div class="button-position">
			<div class="btl"><div class="btr"><div class="btc"></div></div></div>
			<div class="bml"><div class="bmr"><div class="bmc"></div></div></div>
			<div class="bbl"><div class="bbr"><div class="bbc"></div></div></div>
		</div>
		<div class="button-contents"><?php echo JR_SEND;?></div>
	</div>
</button>
</p></form>
<?php }else{ ?>
<form method="POST" name="snd" action="build.php"> 
<input type="hidden" name="ft" value="check">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table id="send_select" class="send_res" cellpadding="1" cellspacing="1">

<tr>

		<td class="ico"> 
			<a href="#" onClick="upd_res(1,1); return Lumberlse;"><img class="r1" src="img/x.gif" alt="<?php echo LUMBER;?>" title="<?php echo LUMBER;?>" /></a> 
		</td> 
		<td class="nam"> 
			<?php echo LUMBER;?>
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r1" id="r1" value="<?php echo $_POST['r1']; ?>" maxlength="8" onKeyUp="upd_res(1)" tabindex="1"> 
		</td> 
		<td class="max"> 
			/ <a href="#" onMouseUp="add_res(1);" onClick="return Lumberlse;"><?php echo $market->maxcarry; ?></a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(2,1); return Lumberlse;"><img class="r2" src="img/x.gif" alt="<?php echo CLAY;?>" title="<?php echo CLAY;?>" /></a> 
		</td> 
		<td class="nam"> 
			<?php echo CLAY;?>
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r2" id="r2" value="<?php echo $_POST['r2']; ?>" maxlength="8" onKeyUp="upd_res(2)" tabindex="2"> 
		</td> 
		<td class="max"> 
			/ <a href="#" onMouseUp="add_res(2);" onClick="return Lumberlse;"><?php echo$market->maxcarry; ?></a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(3,1); return Lumberlse;"><img class="r3" src="img/x.gif" alt="<?php echo IRON;?>" title="<?php echo IRON;?>" /></a> 
		</td> 
		<td class="nam"> 
			<?php echo IRON;?>
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r3" id="r3" value="<?php echo $_POST['r3']; ?>" maxlength="8" onKeyUp="upd_res(3)" tabindex="3"> 
		</td> 
		<td class="max"> 
			/ <a href="#" onMouseUp="add_res(3);" onClick="return Lumberlse;"><?php echo $market->maxcarry; ?></a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(4,1); return Lumberlse;"><img class="r4" src="img/x.gif" alt="<?php echo CROP;?>" title="<?php echo CROP;?>" /></a> 
		</td> 
		<td class="nam"> 
			<?php echo CROP;?>
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r4" id="r4" value="<?php echo $_POST['r4']; ?>" maxlength="8" onKeyUp="upd_res(4)" tabindex="4"> 
		</td> 
		<td class="max"> 
			/ <a href="#" onMouseUp="add_res(4);" onClick="return Lumberlse;"><?php echo $market->maxcarry; ?></a> 
		</td> 
	</tr></table> 

<div class="destination">
	<div class="boxes boxesColor gray">
		<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
		<div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
		<div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
		<div class="boxes-contents">
<table cellpadding="0" cellspacing="0" class="transparent compact">
				<tbody>
					<tr>
						<td>
							<span><?php echo VILLAGENAME;?>:</span>
						</td>
						<td class="compactInput">
                        	<input class="text village" type="text" name="dname" value="<?php echo (isset($_POST['dname'])?$_POST['dname']:''); ?>" maxlength="20" tabindex="5">
						</td>
					</tr>
				</tbody>
			</table>

			<table cellpadding="0" cellspacing="0" class="transparent compact">
				<tbody>
					<tr>
						<td>
							<span class="or"><?php echo COORDINATES;?></span>
<?php
if(isset($_GET['z'])){
$coor = $database->getCoor($_GET['z']);
}
else{
$coor['x'] = "";
$coor['y'] = "";
}
?>			<div class="coordinatesInput">
				<div class="xCoord">
					<label for="xCoordInput">X:</label>
                    <input class="text coordinates x " type="text" name="x" id="x" value="<?php echo $coor['x']; ?>" maxlength="4" tabindex="6">
				</div>
				<div class="yCoord">
					<label for="yCoordInput">Y:</label>
                    <input class="text coordinates y " type="text" name="y" id="y" value="<?php echo $coor['y']; ?>" maxlength="4" tabindex="7">
				</div>
				<div class="clear"></div>
			</div>
									<div class="clear"></div>
						</td>
					</tr>
				</tbody>
			</table>
								</div>
				</div>	</div>
<div class="clear"></div>
<p><?php echo sprintf(MERCHANTCANCARRY,$market->maxcarry);?></p>
<p>
<?php
if($session->goldclub) {
?>
تکرار: 
<select name="repeat">
<option<?php if($_POST['repeat'] == "1") { echo ' selected="selected"'; } ?> value="1">1x</option>
<option<?php if($_POST['repeat'] == "2") { echo ' selected="selected"'; } ?> value="2">2x</option>
<option<?php if($_POST['repeat'] == "3") { echo ' selected="selected"'; } ?> value="3">3x</option>
</select><br><br>
<?php } ?>
<button type="submit" value="ok" name="s1" id="btn_ok" class="dynamic_img" tabindex="8">
	<div class="button-container">
		<div class="button-position">
			<div class="btl"><div class="btr"><div class="btc"></div></div></div>
			<div class="bml"><div class="bmr"><div class="bmc"></div></div></div>
			<div class="bbl"><div class="bbr"><div class="bbc"></div></div></div>
		</div>
		<div class="button-contents"><?php echo JR_SEND;?></div>
	</div>
</button>
</p>
</form>
<?php
$error = '';
if(isset($_POST['ft'])=='check'){

	if(!isset($checkexist) || !$checkexist){
		$error = '<span class="error"><b>'.NOCOORSELECTED.'</b></span>';
    }elseif($_POST['r1']==0 && $_POST['r2']==0 && $_POST['r3']==0 && $_POST['r4']==0){
		$error = '<span class="error"><b>'.NORESSELECTED.'</b></span>';
    }elseif(!$_POST['x'] && !$_POST['y'] && !$_POST['dname']){
		$error = '<span class="error"<b>'.COORORVILLAGE.'</b></span>';
    }elseif($allres <= $market->maxcarry){
		$error = '<span class="error"><b>'.FEWMERCHANT.'</b></span>';
    }
    echo $error;
}
?>
<p>
<?php } ?>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
		$('r1').focus();
	});
	var carry = <?php echo $market->maxcarry; ?>;
	var merchantRes = new Array(0,0,0,0,0);
	function add_res(resNr)
	{
		currentRes = resources['l' + resNr].value;
		merchantMax = haendler * carry;
		merchantRes[resNr] = res_max(merchantRes[resNr], currentRes , merchantMax , carry);
		$('r' + resNr).value = merchantRes[resNr];
	}
	function upd_res(resNr, max)
	{
		currentRes = resources['l' + resNr].value;
		merchantMax = haendler * carry;
		if (max)
		{
			inputRes = currentRes;
		}
		else
		{
			inputRes = parseInt($('r' + resNr).value);
		}
		if (isNaN(inputRes))
		{
			inputRes = 0;
		}
		merchantRes[resNr] = res_max(parseInt(inputRes), currentRes , merchantMax , 0);
		$('r' + resNr).value = merchantRes[resNr];
	}
	function res_max(_merchantRes, _actualRes , _merchantMax , _carry)
	{
		var res = Number(_merchantRes) + _carry;
		if (res > _actualRes)
		{
			res = _actualRes;
		}
		if (res > _merchantMax)
		{
			res = _merchantMax;
		}
		if (res == 0)
		{
			res = '';
		}
		return res;
	}
</script>
<script language="JavaScript" type="text/javascript"> 
//<!--
document.snd.r1.focus();
//-->
</script>

<?php
$timer = 1;
if(count($market->recieving) > 0) { 
echo "<h4>".RECMERCHANT.":</h4>";
    foreach($market->recieving as $recieve) {
       echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
    $ownerid = $database->getVillageField($recieve['from'],"owner");
    $ownername = $database->getUserField($ownerid,"username",0);
    $sendtovil = $database->getVillage($recieve['from']);
	if(defined($sendtovil['name'])) $sendtovil['name'] = constant($sendtovil['name']);
	$villageowner = $database->getVillageField($recieve['from'],"owner");
	echo "<thead><tr><td><a href=\"spieler.php?uid=".$ownerid."\">".$ownername."</a></td>";
    echo "<td class=\"dorf\">".RESRECFROM." <a href=\"karte.php?d=".$recieve['from']."&c=".$generator->getMapCheck($recieve['from'])."\">".$sendtovil['name']."</a></td>";
    echo "</tr></thead><tbody><tr><th>".DURATION."</th><td>";
    echo "<div class=\"in\"><span id=timer$timer>".$generator->getTimeFormat($recieve['endtime']-time())."</span> ".HRS."</div>";
    $datetime = $generator->procMtime($recieve['endtime']);
    echo "<div class=\"at\">";

    echo $datetime[1]."</div>";
    echo "</td></tr></tbody> <tr class=\"res\"> <th>".RESOURCE."</th> <td colspan=\"2\"><span class=\"f10\">";
    echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" /> ".$recieve['wood']." <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" /> ".$recieve['clay']." <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" /> ".$recieve['iron']." <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" /> ".$recieve['crop']."</td></tr></tbody>";
    echo "</table>";
    $timer +=1;
    }
}
if(count($market->sending) > 0) {
	echo "<h4>".MERCHANTSOTW.":</h4>";
    foreach($market->sending as $send) {
        $ownerid = $database->getVillageField($send['to'],"owner");
        $ownername = $database->getUserField($ownerid,"username",0);
        $sendtovil = $database->getVillage($send['to']);
	if(defined($sendtovil['name'])) $sendtovil['name'] = constant($sendtovil['name']);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td><a href=\"spieler.php?uid=".$ownerid."\">".$ownername."</a></td>";
        echo "<td class=\"dorf\">".RESSENTTO." <a href=\"karte.php?d=".$send['to']."&c=".$generator->getMapCheck($send['to'])."\">".$sendtovil['name']."</a></td>";
        echo "</tr></thead> <tbody><tr> <th>".DURATION."</th> <td>";
        echo "<div class=\"in\"><span id=timer".$timer.">".$generator->getTimeFormat($send['endtime']-time())."</span> ".HRS."</div>";
        $datetime = $generator->procMtime($send['endtime']);
        echo "<div class=\"at\">";

        echo $datetime[1]."</div>";
        echo "</td> </tr> <tr class=\"res\"> <th>".RESOURCE."</th><td>";
        echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" /> ".$send['wood']." <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" /> ".$send['clay']." <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" /> ".$send['iron']." <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" /> ".$send['crop']."</td></tr></tbody>";
        echo "</table>";
        $timer += 1;
    }
}
if(count($market->return) > 0) {
	echo "<h4>".MERCHRETURN.":</h4>";
    foreach($market->return as $return) {
        $villageowner = $database->getVillageField($return['from'],"owner");
        $ownername = $database->getUserField($villageowner,"username",0);
	$retfromvil = $database->getVillage($return['from']);
	if(defined($retfromvil['name'])) $retfromvil['name'] = constant($retfromvil['name']);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td></td>";
        echo "<td class=\"dorf\">".MERCHRETURN." <a href=\"karte.php?d=".$return['from']."&c=".$generator->getMapCheck($return['from'])." \">".$retfromvil['name']."</a></td>";
        echo "</tr></thead> <tbody><tr> <th>".DURATION."</th> <td>";
        echo "<div class=\"in\"><span id=timer".$timer.">".$generator->getTimeFormat($return['endtime']-time())."</span> ".HRS."</div>";
        $datetime = $generator->procMtime($return['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
        echo $datetime[0]." ";
        }
        echo $datetime[1]."</div>";
        echo "</td> </tr> <tr class=\"res\"> <th>".RESOURCE."</th><td>";
                echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".$return['wood']." | <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$return['clay']." | <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$return['iron']." | <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$return['crop']."</td></tr></tbody>";

        echo "</tbody></table>";
        $timer += 1;
    }
}
?>

</p><Br /></div> 
