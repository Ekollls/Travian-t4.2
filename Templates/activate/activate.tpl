<?php
if(isset($_GET['id']) && isset($_GET['q'])) {
$act2 = $database->getActivateField($_GET['id'],"act2",0);
	if($act2 == $_GET['q']){
		$show = '1';
		$name = $database->getActivateField($_GET['id'],"username",0);
		$email = $database->getActivateField($_GET['id'],"email",0);
	}
}

if(isset($show)){
?>
<div class="activation">
				<?php echo HELLO.' '.$name; ?>,
				<br>
				<br>
				<?php echo ACTEMAIL;?>
<br><br>
<?php echo EMAILSENTTO?>: <span class="email"><b><?php echo $email; ?></b></span>
			</div>
            
            <div class="activation">
				<?php echo ACTDESC;?>
			</div>
            
            <form action="activate.php" method="post">
				<div class="code"><b>
					<?php echo ACTCODE;?>:</b>
				</div>
				<div>
					<input class="text" type="text" name="id" maxlength="10" />
                    <button type="submit" value="<?php echo CONFIRM;?>" name="s1" id="btn_send" class="sendActivation">
                    <div class="button-container" style="padding:5px 14px;"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo CONFIRM;?></div></div></button></div>
			</form>
            <hr>
            
            <div class="no_mail">
				<a href="activate.php?id=<?php echo $_GET['id']; ?>&amp;c=<?php echo $generator->encodeStr($email,5); ?>"><?php echo ACTCODENOTSENT;?></a>
				<br>
				<?php echo EMAILINSPAM;?> <a href="activate.php?id=<?php echo $_GET['id']; ?>&amp;c=<?php echo $generator->encodeStr($email,5); ?>"><?php echo JR_HERE;?></a>!
			</div>
            
            <?php } else {
?>
			<div id="activation">
				<form action="activate.php" method="post">
						<b><?php echo ACTCODE;?>:</b><br />
					<input class="text" type="text" name="id" maxlength="10" />
                        <button type="submit" value="Send" name="s1" id="btn_send" onclick="document.snd.w.value=screen.width+':'+screen.height;">
       					 <div class="button-container" style="padding:5px 14px;">
                         <div class="button-position">
                         <div class="btl">
                         <div class="btr">
                         <div class="btc"></div></div></div>
                         <div class="bml">
                         <div class="bmr">
                         <div class="bmc"></div></div></div>
                         <div class="bbl">
                         <div class="bbr">
                         <div class="bbc"></div></div></div></div>
       					 <div class="button-contents"><?php echo CONFIRM;?></div></div>
        				</button>
                        <input type="hidden" name="ft" value="a2" />
				</form>
                </div>
			
<?php }
?>