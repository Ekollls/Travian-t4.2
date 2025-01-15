<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
$config_file = file_get_contents("GameEngine/config.php");
if ( preg_match('/NOT_INSTALLED/is',$config_file) ) {
	header("Location: install/");
}

include("GameEngine/Protection.php");
include("GameEngine/Village.php");
include("GameEngine/Units.php");

if (COMMENCE>time()) {
	header("Location: logout.php");
}
$start = $generator->pageLoadTimeStart();
if(isset($_GET['ok'])){
	$database->updateUserField($session->username,'ok','0','0'); $_SESSION['ok'] = '0'; }
	
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
else {
	$building->procBuild($_GET);
}
$units->fixHeroE();
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome village1 perspectiveResources">
<script type="text/javascript">
			window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
		</script>
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
								<div class="contentTitle">
								&nbsp;</div> 
									<div class="contentContainer"> 
										<div id="content" class="village1">

<?php
$ok = $database->getUserField($session->uid, 'ok', 0);
if($ok){include("Templates/usm.tpl");}
else{
	include("Templates/field.tpl");
	$timer = 1;
	if($building->NewBuilding) {
		include("Templates/Building.tpl");
	}
	echo '<div id="map_details">';
	echo '<div class="movements">';
	include("Templates/movement.tpl");
	echo '</div>';
	include("Templates/production.tpl");
	include("Templates/troops.tpl");
	echo '<div class="clear"></div>';
	echo '</div>';
}


?>

		</div></div>
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


