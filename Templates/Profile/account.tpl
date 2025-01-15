<form action="spieler.php" method="POST">
<input type="hidden" name="ft" value="p3">
<input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />
	
<h4 class="round"><?php echo CHANGEPASSWORD;?></h4>

<table cellpadding="1" cellspacing="1" id="change_pass" class="account transparent">
	<tbody>
		<tr>
			<th class="col1"><?php echo OLDPASSWORD;?></th>
			<td><input class="text" type="password" name="pw1" maxlength="20"></td>
		</tr>
		<tr>
			<th><?php echo NEWPASSWORD;?></th>
			<td><input class="text" type="password" name="pw2" maxlength="20"></td>
		</tr>
		<tr>
			<th><?php echo NEWPASSWORDAGAIN;?></th>
			<td><input class="text" type="password" name="pw3" maxlength="20"></td>
		</tr>

	</tbody>
</table>
<?php
if($form->getError("pw") != "") {
echo "<span class=\"error\">".$form->getError('pw')."</span>";
}
?>
	<h4 class="round spacer"><?php echo CHNAGEEMAILADDRESS;?></h4>
	<table id="change_mail" cellpadding="1" cellspacing="1" class="transparent">
		<tbody>
			<tr>
				<td colspan="2">
					<?php echo CHNAGEEMAILADDRESSDESC;?>
				</td>
			</tr>
			<tr>
				<th><?php echo OLDEMAIL;?>:</th>
				<td><input class="text" type="text" name="email_alt" maxlength="50" size="40"></td>
			</tr>
			<tr>
				<th><?php echo NEWEMAIL;?>:</th>
				<td><input class="text" type="text" name="email_neu" maxlength="50" size="40"></td>
			</tr>
		</tbody>
	</table>
    <?php
if($form->getError("email") != "") {
echo "<span class=\"error\">".$form->getError('email')."</span>";
}
?>
<h4 class="round spacer"><?php echo SITTERS;?></h4>
<input type="hidden" name="sitter_flag_posted" value="1">

<div class="text"><?php echo SITTERSDESC;?></div>

<script type="text/javascript">
function cloneName(obj, id)
{
	$(id).innerHTML = obj.value.stripTags();
}

</script>

<table class="sitters transparent">
				<tbody><tr>
		<th>
				<div class="boxes boxesColor lightGreen"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><span><?php echo SITTER1;?></span>	</div>
				</div>
		</th><td>
<?php

if($session->userinfo['sit1'] == 0) {
echo "<input class=\"text\" type=\"text\" name=\"v1\" maxlength=\"15\">";
}
if($session->userinfo['sit1'] != 0) {
	
    echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = 'spieler.php?s=3&e=3&id=".$session->userinfo['sit1']."&a=".$session->checker."&type=1'; return false;\"><img src=\"img/x.gif\" class=\"del\" alt=\"".SITTERS."\"></button>";
    echo "&nbsp;".$database->getUserField($session->userinfo['sit1'],"username",0)."";

}
?></td>
	</tr>
				<tr>
		<th>
				<div class="boxes boxesColor orange"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><span><?php echo SITTER2;?></span>	</div>
				</div>
		</th><td>
<?php
if($session->userinfo['sit2'] == 0) {
echo "<input class=\"text\" type=\"text\" name=\"v2\" maxlength=\"15\">";
}
if($session->userinfo['sit2'] != 0) {
	
    echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = 'spieler.php?s=3&e=3&id=".$session->userinfo['sit2']."&a=".$session->checker."&type=2'; return false;\"><img src=\"img/x.gif\" class=\"del\" alt=\"".SITTERS."\"></button>";
    echo "&nbsp;".$database->getUserField($session->userinfo['sit2'],"username",0)."";

}
?></td>
	</tr>
			</tbody></table>
            
<h4 class="round spacer"><?php echo ACCOUNTSYOUSIT;?></h4>
<input type="hidden" name="sitter_flag_posted" value="1">

<div class="text"><?php echo ACCOUNTSYOUSITDESC;?></div>

<table class="sitters transparent">
				<tbody><tr>
		<th>
				<div class="boxes boxesColor lightGreen"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><span><?php echo ACCOUNT1;?></span></div>
				</div>
		</th><td>
<?php
if(!$database->getSitee1($session->uid)){
	echo '<span class="none">'.NOTSITTING.'</span>';
    }else{
    $getsit1 = $database->getSitee1($session->uid);
    echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = 'spieler.php?s=3&e=2&id=".$session->uid."&owner=".$getsit1[id]."&a=".$session->checker."&type=3'; return false;\"><img src=\"img/x.gif\" class=\"del\" alt=\"".SITTERS."\"></button>";
    echo "&nbsp;".$getsit1['username']."";
    }
	
?>
</td>
	</tr>
				<tr>
		<th>
				<div class="boxes boxesColor orange"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><span><?php echo ACCOUNT2;?></span></div>
				</div>
		</th><td>
<?php
if(!$database->getSitee2($session->uid)){
	echo '<span class="none">'.NOTSITTING.'</span>';
    }else{
    $getsit2 = $database->getSitee2($session->uid);
    echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = 'spieler.php?s=3&e=2&id=".$session->uid."&owner=".$getsit2[id]."&a=".$session->checker."&type=3'; return false;\"><img src=\"img/x.gif\" class=\"del\" alt=\"".SITTERS."\"></button>";
    echo "&nbsp;".$getsit2['username']."";
    }
	
?></td>
	</tr>
			</tbody></table>
            
<h4 class="round spacer"><?php echo DELETEACCOUNT;?></h4>
<table cellpadding="1" cellspacing="1" id="del_acc" class="account transparent">
	<tbody>
		<tr>
			<td colspan="2"><?php echo DELETEACCOUNTDESC;?></td>
		</tr>
        
        
<?php
$timestamp = $database->isDeleting($session->uid);
if($timestamp) {
	echo "<tr><td colspan=\"2\" class=\"count\">";
	$delduration = max(round(259200/SPEED),3600);
	$cancelduration = $delduration*2/3;
	if($timestamp > time()+$cancelduration) {
		echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = 'spieler.php?s=3&id=".$session->uid."&a=1&e=4'; return false;\">
			<img src=\"img/x.gif\" class=\"del\" alt=\"del\"></button>";
	}
	$time=$generator->getTimeFormat(($timestamp-time()));
	echo DELETEIN." <span id=\"timer1\">".$time."</span></td></tr>";
} else {?>
	<tr>
		<th><?php echo CONFIRMDELETEACC;?></th>
		<td class="del_selection">
			<label><input class="radio" type="radio" name="del" value="1"><?php echo JR_YES;?></label>
			<label><input class="radio" type="radio" name="del" value="0" checked="checked"><?php echo JR_NO;?></label>
		</td>
	</tr>
    <tr>
		<th><?php echo CONFIRMPASSWORD;?></th>
		<td><input class="text" type="password" name="del_pw" maxlength="20"></td>
	</tr>
	<?php
}
if($form->getError("del") != "") {
	echo "<tr><td><span class=\"error\">".$form->getError("del")."</span></td></tr>";
}
?>
    </tbody>
</table>

<h4 class="round spacer"><?php echo HEADER_GOLD;?></h4>
<table cellpadding="1" cellspacing="1" class="newsletter transparent">
		<tbody>
<tr>
				<td colspan="2">
					<?php
						$udata = $database->getUser($session->uid, 1);
						echo sprintf(YOURGOLDAMOUNT
							,'<img src="img/x.gif" class="gold" alt="'.HEADER_GOLD.'">'.($udata['gold'])
							,'<img src="img/x.gif" class="gold" alt="'.HEADER_GOLD.'">'.min($udata['boughtgold'],$udata['gold']));
					?>
				</td>
				</tr>
					</tbody>
	</table>
<br />
<div class="save_button">
<button type="submit" value="save" class="green">
<div class="button-container addHoverClick "><div class="button-background"><div class="buttonStart"><div class="buttonEnd"><div class="buttonMiddle"></div></div></div></div><div class="button-content"><?php echo JR_SAVE;?></div></div></button></div>

</form>
