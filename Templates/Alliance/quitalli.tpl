<?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$allianceinfo = $database->getAlliance($aid);
include("alli_menu.tpl"); 
?>

<h4 class="round"><?php echo QUITALLI;?></h4>

<p class="option"><?php echo QUITALLIPASSDESC;?></p>

<form method="post" action="allianz.php">
<input type="hidden" name="a" value="11">
<input type="hidden" name="o" value="11">
<input type="hidden" name="s" value="5">
		<table cellpadding="1" cellspacing="1" class="option quit transparent">
			<tbody>
				<tr>
					<th>
						<?php echo LOGIN_PASSWORD;?>:</th>
					<td>
						<input class="pass text" type="password" name="pw" maxlength="20">
					</td>
				</tr>
			</tbody>
		</table>

		<p class="option">
			<button type="submit" value="ok" name="s1" id="btn_ok"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo QUITALLI;?></div></div></button>
            </p>
	</form>
<p class="error"><?php echo $form->getError("error"); ?></p>