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
if(isset($_GET['ok'])){
	$database->updateUserField($session->username,'ok','0','0'); $_SESSION['ok'] = '0'; }
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
else {
	$building->procBuild($_GET);
}
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome village2 perspectiveBuildings">
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
		<div id="content" class="village2">
<?php
include("Templates/dorf2.tpl");
if($building->NewBuilding) {
	include("Templates/Building.tpl");
}
?>
</div>
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

?>			
<?php
include("Templates/time.tpl");
?>
<div id="ce"></div>
</div>
</body>
</html>

