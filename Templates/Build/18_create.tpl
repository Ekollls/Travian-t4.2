<form method="post" action="build.php">
	<table cellpadding="1" cellspacing="1" id="found" class="transparent">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="hidden" name="ft" value="ali1">
        
         <div class="clear"></div>
        <h4 class="round"><?php echo CREATEALLIANCE;?></h4>
	<tbody><tr>
		<th><?php echo TAG;?>:</th>
		<td class="tag">
			<input class="text" name="ally1" value="<?php echo $form->getValue("ally1"); ?>" maxlength="8">
			<span class="error"><?php echo $form->getError("ally1"); ?></span>

		</td>
	</tr>
	<tr>
		<th><?php echo NAME;?>:</th>
		<td class="nam">
			<input class="text" name="ally2" value="<?php echo $form->getValue("ally2"); ?>" maxlength="25">
			<span class="error"><?php echo $form->getError("ally2"); ?></span>
		</td>

	</tr></tbody>
	</table>
	<p>
    <button type="submit" id="btn_ok" name="btn_ok" value="btn_ok" class="build">
<div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div>
<div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div>
</div><div class="button-contents">&#1578;&#1575;&#1587;&#1740;&#1587;</div></div></button>
    </p>
    </form>
    
