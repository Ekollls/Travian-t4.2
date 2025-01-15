<?php

$dorf1 = "";
$dorf2 = "";
$karte = "";
$statistiken = "";
$berichte = "";
$nachrichten = "";
$file = explode("/",$_SERVER['SCRIPT_NAME']);
$count = count($file);
$i =  $count - 1;
if($file[$i] == 'dorf1.php'){
	$dorf1 = "active";
}
elseif($file[$i] == 'dorf2.php'){
	$dorf2 = "active";
}
elseif($file[$i] == 'karte.php'){
	$karte = "active";
}
elseif($file[$i] == 'statistiken.php'){
	$statistiken = "active";
}
elseif($file[$i] == 'berichte.php'){
	$berichte = "active";
}
elseif($file[$i] == 'nachrichten.php'){
	$nachrichten = "active";
}

?>

<a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME ?>"></a>
<ul id="navigation">
<li id="n1" class="villageResources">
	<a class=" <?php echo $dorf1; ?>" href="dorf1.php" accesskey="1" title="<?php echo HEADER_DORF1; ?>"></a>
</li>
<li id="n2" class="villageBuildings">
	<a class=" <?php echo $dorf2; ?>" href="dorf2.php" accesskey="2" title="<?php echo HEADER_DORF2; ?>"></a>
</li>
<li id="n3" class="map">
	<a class=" <?php echo $karte; ?>" href="karte.php" accesskey="3" title="<?php echo HEADER_MAP; ?>"></a>
</li>
<li id="n4" class="statistics">
	<a class=" <?php echo $statistiken; ?>" href="statistiken.php" accesskey="4" title="<?php echo HEADER_STATS; ?>"></a>
</li>
<?php
if(count($database->getMessage($session->uid,7)) >= 1000) {
	$unmsg = "+1000";
} else { $unmsg = count($database->getMessage($session->uid,7)); }

if(count($database->getMessage($session->uid,8)) >= 1000) {
	$unnotice = "+1000";
} else { $unnotice = count($database->getMessage($session->uid,8)); }
?>
<li id="n5" class="reports"> 
<a href="berichte.php" accesskey="5" title="<?php echo HEADER_NOTICES; ?><?php if($message->nunread){ echo' ('.count($database->getMessage($session->uid,8)).')'; } ?>"></a>
<?php
if($message->nunread){
		echo "
		<div class=\"speechBubbleContainer \">
			<div class=\"speechBubbleBackground\">
				<div class=\"start\">
					<div class=\"end\">
						<div class=\"middle\"></div>
					</div>
				</div>
			</div>
			<div class=\"speechBubbleContent\">".$unnotice."</div>
		</div>";
}
?>
</li>
<li id="n6" class="messages"> 
	<a href="nachrichten.php" accesskey="6" title="<?php echo HEADER_MESSAGES; ?><?php if($message->unread){ echo' ('.count($database->getMessage($session->uid,7)).')'; } ?>"></a> 
	<?php
	if($message->unread) {
		echo "
		<div class=\"speechBubbleContainer \">
			<div class=\"speechBubbleBackground\">
				<div class=\"start\">
					<div class=\"end\">
						<div class=\"middle\"></div>
					</div>
				</div>
			</div>
			<div class=\"speechBubbleContent\">".$unmsg."</div>
		</div>";
	}
	?>
</li>
<li id="n7" class="gold">
		<a href="#" accesskey="7" onclick="window.fireEvent('startPaymentWizard', {}); this.blur(); return false;" class=""></a>
	</li>
</ul>

<script type="text/javascript">
	window.addEvent('domready', function()
	{
		Travian.Game.Layout.goldButtonAnimation();
	});
</script>