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
include("GameEngine/Units.php");

$winner = $database->hasWinner();if($winner){header("Location: winner.php");}
if($session->access<2){header("Location: banned.php");}

$start = $generator->pageLoadTimeStart();
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
else {
$building->procBuild($_GET);
}
if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
if(isset($_GET['bid'])) {
	$bid = $_GET['bid'];
	$dbarray = $database->getNoticeData($bid);
	$dataarray = explode(",",$dbarray);
	$isoases = $database->isVillageOases($dataarray['31']);
	if($isoases){
		$too = $database->getOMInfo($dataarray['31']);
		if($too['conqured'] == 0){$disabledr ="disabled=disabled";}else{$disabledr ="";}
		$disabled ="disabled=disabled";
	} else {
		$disabledr="";$disabled="";
	}
	$checked="checked=checked";
}
if(isset($_GET['w'])) {
	$w = $_GET['w'];
}
if(isset($_GET['r'])) {
	$r = $_GET['r'];
}
if(isset($_GET['o'])) {
    $o = $_GET['o'];
    $oid = $_GET['z'];
    $isconqured = $database->getOasisField($oid,"conqured");
    if($isconqured == 0){$disabledr ="disabled=disabled";}else{
    $disabledr ="";
    }
    $disabled ="disabled=disabled";
    $checked  ="checked=checked";
}
if(isset($_GET['z'])) {
    $oid = $_GET['z'];
    $isoases = $database->isVillageOases($oid);
	if($isoases){
		$too = $database->getOMInfo($oid);
		if($too['conqured'] == 0){$disabledr ="disabled=disabled";}else{$disabledr ="";}
		$disabled ="disabled=disabled";
	} else {
		$disabledr="";$disabled="";
	}
	$checked="checked=checked";
}

if ($building->getTypeLevel(16)<20) $_POST['ctar2'] = 255;
$process = $units->procUnits($_POST);
$units->fixHeroE();
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome a2b">
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
							<div class="contentTitle">&nbsp;</div> 
							<div class="contentContainer"> 
								<div id="content" class="a2b">


<?php

        if(!empty($id)) {
			if(isset($_GET['s'])){
        		include "Templates/a2b/newdorf.tpl";
			}
			if(isset($_GET['h'])){
        		include "Templates/a2b/adventure.tpl";
			}
        } else
		if(isset($_GET['f']) || isset($_GET['k'])){
			$units2->procTrapped($_GET);
		} elseif(isset($w)) {
        		$enforce = $database->getEnforceArray($w, 0);
        		if($enforce['vref'] == $village->wid) {
        			$to = $database->getVillage($enforce['from']);
        			$ckey = $w;
        			include ("Templates/a2b/sendback.tpl");
        		} else {
        			include ("Templates/a2b/units_" . $session->tribe . ".tpl");
        			include ("Templates/a2b/search.tpl");
        		}
        	} elseif(isset($r)) {
        			$enforce = $database->getEnforceArray($r, 0);
        			if($enforce['from'] == $village->wid) {
        				$to = $database->getVillage($enforce['from']);
        				$ckey = $r;
        				include ("Templates/a2b/sendback.tpl");
        			} else {
        				include ("Templates/a2b/units_" . $session->tribe . ".tpl");
        				include ("Templates/a2b/search.tpl");
        			}
        		} else {
        			if(isset($process['0'])) {
        				$coor = $database->getCoor($process['0']);
        				include ("Templates/a2b/attack.tpl");
        			} else {
        				include ("Templates/a2b/units_" . $session->tribe . ".tpl");
        				include ("Templates/a2b/search.tpl");
        			}
        		}

?>


<div class="clear">&nbsp;</div>
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

