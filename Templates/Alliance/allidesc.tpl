<?php  

if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
} 
$varmedal = $database->getProfileMedalAlly($aid); 
$allianceinfo = $database->getAlliance($aid);
$memberlist = $database->getAllMember($aid);
$totalpop = 0;
foreach($memberlist as $member) {
	$totalpop += $database->getVSumField($member['id'],"pop");
}

echo "<h1>".ALLIANCE." - ".$allianceinfo['tag']."</h1>";
include("alli_menu.tpl");  
  
?>
<h4 class="round"><?php echo DESCRIPTION;?></h4>
<form method="post" action="allianz.php">
<input type="hidden" name="a" value="3">
<input type="hidden" name="o" value="3">
<input type="hidden" name="s" value="5">
		<textarea class="editDescription editDescription1" tabindex="1" name="be1"><?php echo $allianceinfo['desc']; ?></textarea>
		<textarea class="editDescription editDescription2" tabindex="2" name="be2"><?php echo $allianceinfo['notice']; ?></textarea>
		<div class="clear"></div>
    <script type="text/javascript">
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
				<div class="switchWrap">
			<div class="openedClosedSwitch switchClosed" id="switchMedals"><?php echo MEDALS;?></div>
			<div class="clear"></div>
		</div>
<br />
        <table cellpadding="1" cellspacing="1" id="medals" class="hide">
				<tr>
					<td><?php echo JR_CATEGORY;?></td>
					<td><?php echo RANK;?></td>
					<td><?php echo WEEK;?></td>
					<td><?php echo BBCODE;?></td>
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
    $titel="جایزه";
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
        $titel=sprintf(TOP3ROFW,$medal['points']);
        break;
    case "10":
        $titel=COFW;
        break;
    case "11":
        $titel=sprintf(TOP3COFW,$medal['points']);
        break;
    case "12":
        $titel=sprintf(TOP3AOFW,$medal['points']);
        break;
    }            
                 echo"<tr>
                   <td> ".$titel."</td>
                   <td>".$medal['plaats']."</td>
                   <td>".$medal['week']."</td>
                   <td>[#".$medal['id']."]</td>
                  </tr>";
                 } ?>
                 </table></p>

	<p class="btn">
		<button type="submit" value="save" name="s1" id="btn_save" tabindex="3"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo JR_SAVE;?></div></div></button>
		</p>
	</form>

<p class="error"><?php echo $form->getError("error"); ?></p>