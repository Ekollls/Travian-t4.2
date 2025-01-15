<?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$allianceinfo = $database->getAlliance($aid);
$allianceInvitations = $database->getAliInvitations($aid);
echo "<h1>Alliance - ".$allianceinfo['tag']."</h1>";
include("alli_menu.tpl"); 
?>
<h4 class="round"><?php echo ALLIINV;?></h4>
<form method="post" action="allianz.php">
<input type="hidden" name="a" value="4">
<input type="hidden" name="o" value="4">
<input type="hidden" name="s" value="5">
		<table cellpadding="1" cellspacing="1" class="option invite transparent">
			<tbody>
				<tr>
					<th>
						<?php echo NAME;?></th>
					<td>
						<input class="name text" type="text" name="a_name" maxlength="20">
					</td>
				</tr>
			</tbody>
		</table>

<p class="option"><button type="submit" value="ok" name="s1" id="btn_ok"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo INVITE;?></div></div></button></p>
</form>
<p class="error"><?php echo $form->getError("error"); ?></p>
<h4 class="round"><?php echo INVITEDPLAYERS;?></h4>

<table cellpadding="1" cellspacing="1" class="option invitations transparent">
	<tbody>
<div>
<?php
if (count($allianceInvitations) == 0) {
    echo "<tr><td class=noData>".NOINVITES."</td></tr>";
    } else {
 	foreach($allianceInvitations as $invit) {
	$invited = $database->getUserField($invit['uid'],username,0);
    echo "<tr><td class=\"abo\">";
    echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = '?o=4&s=5&d=".$invit['id']."'; return false;\"><img class=\"del\" src=\"img/x.gif\" alt=\"".CANCEL."\" title=\"Cancel\" /></button></td><td>";    
	echo "<a class=\"a arrow\" href=spieler.php?uid=".$invit['uid'].">".INVITEFOR." ".$invited."";
    echo "</td></tr>";
	}   
}           
?>
	</tbody>
</table>
