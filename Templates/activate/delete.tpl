<div class="activation">
			<?php echo EMAILCIRCDESC;?>
			<br>
			<br>
			<?php echo FAILEDEMAILREASON;?>:

			<ul>
				<li><?php echo EMAILWR1;?></li>
				<li><?php echo EMAILWR2;?></li>
				<li><?php echo EMAILWR3;?></li>
				<li><?php echo EMAILWR4;?></li>
			</ul>
			<?php echo EMAILSOL;?>
		</div>
        <hr>
        <h4><?php echo DELACC;?></h4>
        <form action="activate.php" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
		<input type="hidden" name="ft" value="a3" />
			<div class="boxes activation boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
				<table cellpadding="1" cellspacing="1" class="transparent">
					<tbody><tr class="top">
						<th><?php echo NAME;?>:</th>
						<td class="name"><?php echo $database->getActivateField($_GET['id'],"username",0); ?></td>
					</tr>
					<tr class="btm">
						<th>کلمه عبور:</th>
						<td><input class="text" type="password" name="pw" maxlength="20"></td>
					</tr>
				</tbody></table>
				</div>
				</div>
			<div class="clear"></div><button type="submit" value="<?php echo DELETE;?>" name="delreports" id="btn_delete" onclick="document.snd.w.value=screen.width+':'+screen.height;"><div class="button-container" style="padding:5px 14px;"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo DELETE;?></div></div></button>
		</form>