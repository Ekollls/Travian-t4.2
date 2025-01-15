<?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$playerData = $database->getAlliPermissions($_POST['a_user'], $session->alliance);
$playername = $database->getUserField($_POST['a_user'],'username',0);

$allianceinfo = $database->getAlliance($aid);
echo "<h1>Alliance - ".$allianceinfo['tag']."</h1>";
include("alli_menu.tpl"); 
?>
<h4 class="round"><?php echo ASSIGNPOS;?></h4>
<p><?php echo ASSIGNPOSDESC;?></p>
<form method="post" action="allianz.php">
			<table cellpadding="1" cellspacing="1" id="memberAdministration">
				<thead>
					<tr>
						<th><?php echo NAME;?></th>
						<th><img src="img/x.gif" class="allyRight allyRightPosition" alt="<?php echo ASSIGNPOS;?>" title="<?php echo ASSIGNPOS;?>"></th>
						<th><img src="img/x.gif" class="allyRight allyRightDisband" alt="<?php echo KICK;?>" title="<?php echo KICK;?>"></th>
						<th><img src="img/x.gif" class="allyRight allyRightDescription" alt="<?php echo CHANGEDESC;?>" title="<?php echo CHANGEDESC;?>"></th>
						<th><img src="img/x.gif" class="allyRight allyRightDiplomacy" alt="<?php echo ALLIDIPLO;?>" title="<?php echo ALLIDIPLO;?>"></th>
						<th><img src="img/x.gif" class="allyRight allyRightMessage" alt="<?php echo ALLIIGMS;?>" title="<?php echo ALLIIGMS;?>"></th>
						<th><img src="img/x.gif" class="allyRight allyRightInvite" alt="<?php echo ALLIINV;?>" title="<?php echo ALLIINV;?>"></th>
						<th><img src="img/x.gif" class="allyRight allyRightForum" alt="<?php echo FORUM;?>" title="<?php echo FORUM;?>"></th>
						<th>Position Name</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="name"><?php echo $playername; ?></td>
						<td class="right"><input class="check" type="checkbox" name="e1" value="1" <?php if ($playerData[opt1]) { echo "checked=checked"; } ?> ></td>
						<td class="right"><input class="check" type="checkbox" name="e2" value="1" <?php if ($playerData[opt2]) { echo "checked=checked"; } ?> ></td>
						<td class="right"><input class="check" type="checkbox" name="e3" value="1" <?php if ($playerData[opt3]) { echo "checked=checked"; } ?> ></td>
						<td class="right"><input class="check" type="checkbox" name="e6" value="1" <?php if ($playerData[opt6]) { echo "checked=checked"; } ?> ></td>
						<td class="right"><input class="check" type="checkbox" name="e7" value="1" <?php if ($playerData[opt7]) { echo "checked=checked"; } ?> ></td>
						<td class="right"><input class="check" type="checkbox" name="e4" value="1" <?php if ($playerData[opt4]) { echo "checked=checked"; } ?> ></td>
						<td class="right"><input class="check" type="checkbox" name="e5" value="1" <?php if ($playerData[opt5]) { echo "checked=checked"; } ?> ></td>
						<td class="title"><input class="text" type="text" name="a_titel" value="<?php echo $playerData[rank]; ?>" maxlength="20" /></td>
					</tr>
				</tbody>
			</table>
			<p>
						<input type="hidden" name="a" value="1">
						<input type="hidden" name="o" value="1">
						<input type="hidden" name="s" value="5">
					  <input type="hidden" name="a_user" value="<?php echo $_POST['a_user']; ?>">
				<button type="submit" value="ok" name="s1" id="btn_ok"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo JR_SAVE;?></div></div></button>
			</p>
		</form>
        <p class="error3"><?php echo $form->getError("error"); ?></p>
