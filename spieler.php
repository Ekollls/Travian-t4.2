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
$profile->procProfile($_POST);
$profile->procSpecial($_GET);
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
if(isset($_GET['uid'])) $_GET['uid'] = intval($_GET['uid']);
if(!isset($_GET['uid']) && !isset($_GET['s'])) $_GET['uid'] = $session->uid;
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome spieler" onload="javascript:matchHeight('contentOuterContainer','center')">
	<div id="background"> 
			<div id="headerBar"></div>
			<div id="bodyWrapper"> 
				<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> 
				<div id="header"> 

<?php 
	include("Templates/topheader.tpl");
	include("Templates/toolbar.tpl");

?>

	</div>
	<div id="center">
		<a id="ingameManual" href="help.php">
		<img class="question" alt="Help" src="img/x.gif">
		</a>

		<?php include("Templates/sideinfo.tpl"); ?>

		<div id="contentOuterContainer"> 

		<?php include("Templates/res.tpl"); ?>
							<div class="contentTitle">&nbsp;</div>
<div class="contentContainer">
<div id="content" class="player">
<?php $username = $database->getUserField($_GET['uid'],"username",0); ?>
<h1 class="titleInHeader">
	<?php 
	echo PLAYERPROFILE;
	if(isset($_GET['uid']) && is_numeric($_GET['uid'])){ echo "- ".$username; } ?>
</h1>
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
if((isset($_GET['uid']) && $_GET['uid'] == $session->uid) || !isset($_GET['uid'])) {
	include("Templates/Profile/menu.tpl");
}
if(isset($_GET['uid'])) {
	if($_GET['uid'] >= 4 && $_GET['uid']!=2) {
		$user = $database->getUser($_GET['uid'],1);
		if(isset($user['id'])){
			include("Templates/Profile/overview.tpl");
		} else {
			include("Templates/Profile/notfound.tpl");
		}
	} else {
		include("Templates/Profile/special.tpl");
	}
}
else if (isset($_GET['s'])) {
	if($_GET['s'] == 1) {
		include("Templates/Profile/profile.tpl");
	}
	if($_GET['s'] == 2) {
		include("Templates/Profile/preference.tpl");
	}
	if($_GET['s'] == 3) {
		include("Templates/Profile/account.tpl");
	}
	if($_GET['s'] == 4) {
		include("Templates/Profile/graphic.tpl");
	}
	if($_GET['s'] > 4 or $session->is_sitter == 1) {
	header("Location: ".$_SERVER['PHP_SELF']."?uid=".preg_replace("/[^a-zA-Z0-9_-]/","",$session->uid));
	}
}

?><div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>
</div>
<div class="contentFooter">&nbsp;</div>

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

</div>
<div id="ce"></div>
</div>
</body>
</html>


