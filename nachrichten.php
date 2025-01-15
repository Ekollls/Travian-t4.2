<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include("GameEngine/Village.php");
$start = $generator->pageLoadTimeStart();
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
else {
	$message->procMessage($_POST);
}
include "Templates/html.tpl";
?>
 
<body class="v35 webkit chrome messages">
<script type="text/javascript">
			window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
		</script>
	<div id="background"> 
		<div id="headerBar"></div>	
		<div id="bodyWrapper"> 
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> 
			<div id="header"> 
				<div id="mtop">
<?php 
	include("Templates/topheader.tpl");
	include("Templates/toolbar.tpl");

?>


				</div> 
</div>
					<div id="center">
		<?php include("Templates/sideinfo.tpl"); ?>
						<div id="contentOuterContainer"> 
		<?php include("Templates/res.tpl"); ?>
							<div class="contentTitle">&nbsp;</div>
							<div class="contentContainer"> 
								<div id="content" class="messages">
<h1 class="titleInHeader"><?php echo HEADER_MESSAGES; ?></h1>
<?php 
include("Templates/Message/menu.tpl");
?>
<script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
</script>
<?php
if(isset($_GET['id']) && !isset($_GET['t'])) {
	$message->loadMessage($_GET['id']);
	include("Templates/Message/read.tpl");
}elseif(isset($_GET['n1']) && !isset($_GET['t'])) {
	$database->delMessage($_GET['n1']);
	header("Location: nachrichten.php");
}
else if(isset($_GET['t'])) {
	switch($_GET['t']) {
		case 1:
		if(isset($_GET['id'])) {
		$id = $_GET['id'];
		}
		include("Templates/Message/write.tpl");
		break;
		case 2:
		include("Templates/Message/sent.tpl");
		break;
		case 3:
		if($session->plus) {
			include("Templates/Message/archive.tpl");
		}
		break;
		case 4:
		if($session->plus) {
			$message->loadNotes();
			include("Templates/Message/notes.tpl");
		}
		break;
		default:
		include("Templates/Message/inbox.tpl");
		break;
	}
}
else {
	include("Templates/Message/inbox.tpl");
}
?>

<div id="map_details">



<div class="clear"></div>

</div>

<div class="clear"></div>

								<div class="clear">&nbsp;</div>							</div>							<div class="clear"></div>

						</div> 						<div class="contentFooter">&nbsp;</div>

					</div>
<?php  
include("Templates/rightsideinfor.tpl");		

?>
				<div class="clear"></div>
			</div>
<?php

include("Templates/footer.tpl");
include("Templates/header.tpl");
?>			
<?php
include("Templates/time.tpl");
?>
<div id="ce"></div>
</div>
</body>
</html>

