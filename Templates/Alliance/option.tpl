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
<h4 class="round"><?php echo OPTIONS;?></h4>
<form method="POST" action="allianz.php">
<input type="hidden" name="s" value="5">
<ul class="options">

<?php
if ($alliance->userPermArray['opt3']==1){
?>        
		<label><li><input class="radio" type="radio" name="o" value="100"><?php echo CHANGENAME;?></li></label>
<?php
}
if ($alliance->userPermArray['opt3']==1){
?>        

		<label><li><input class="radio" type="radio" name="o" value="3"><?php echo CHANGEDESCRIPTION;?></li></label>
<?php
}
if ($alliance->userPermArray['opt1']==1){
?>		
        <label><li><input class="radio" type="radio" name="o" value="1"><?php echo ASSIGNPOSITION;?></li></label>
<?php
} 
if ($alliance->userPermArray['opt4']==1){
?>        
		<label><li><input class="radio" type="radio" name="o" value="4"><?php echo ALLIINV;?></li></label>
<?php
}
if ($alliance->userPermArray['opt6']==1){
?>         
		<label><li><input class="radio" type="radio" name="o" value="6"><?php echo ALLIDIPLO;?></li></label>
<?php
}
if ($alliance->userPermArray['opt2']==1){
?>        
		<label><li><input class="radio" type="radio" name="o" value="2"><?php echo KICK;?></li></label>

<?php
}
if ($alliance->userPermArray['opt2']==1){
?>        
		<label><li><input class="radio" type="radio" name="o" value="105" onClick="/*window.location = 'allianz.php?s=105'*/"><?php echo SEND_TO_ALL;?></li></label>

<?php
}
?>                
		<label><li><input class="radio" type="radio" name="o" value="11"><?php echo LEAVEALLI;?></li></label>
        
</ul>

	<p><button type="submit" value="ok" name="s1" id="btn_ok"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo LOGIN_PW_BTN;?></div></div></button></p></form>