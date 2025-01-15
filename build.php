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

if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF'].(isset($_GET['id'])?'?id='.$_GET['id']:(isset($_GET['gid'])?'?gid='.$_GET['gid']:'')));
}
$start = $generator->pageLoadTimeStart();
$alliance->procAlliForm($_POST);
$technology->procTech($_POST);
$market->procMarket($_POST);	
if(isset($_GET['gid'])) {
	$_GET['id'] = strval($building->getTypeField($_GET['gid']));
} else if(isset($_POST['id'])) {
	$_GET['id'] = $_POST['id'];
}
if(isset($_POST['t'])){
	$_GET['t'] = $_POST['t'];
}

if(isset($_GET['id'])) {
	if (!ctype_digit($_GET['id'])){
        $_GET['id'] = "1";
    }
	if($village->resarray['f'.$_GET['id'].'t'] == 17) {
		$market->procRemove($_GET);
	}
	if($village->resarray['f'.$_GET['id'].'t'] == 18) {
		$alliance->procAlliance($_GET);
	}
	if($village->resarray['f'.$_GET['id'].'t'] == 12 || $village->resarray['f'.$_GET['id'].'t'] == 13 || $village->resarray['f'.$_GET['id'].'t'] == 22) {
		$technology->procTechno($_GET);
	}
	if($_GET['id']==39 && isset($_GET['a']) && $_GET['a']==4 && isset($_GET['aa'])){
		$aaId = intval($_GET['aa']);
		$theMov = $database->getMovementById($aaId);
		if($theMov["from"]==$village->wid && (time()-$theMov['starttime'])<=(max(20,floor(90/pow(INCREASE_SPEED,1/3))))){
			$database->cancelMovement($aaId,$theMov['to'],$theMov['from']);
		}
	}
}
if (isset($_POST['h']) && $_POST['a'] == 'adventure'){  
	$units->Adventures($_POST);
}elseif (isset($_POST['a']) == 533374 && isset($_POST['id']) == 39){  
	$units->Settlers($_POST);
}
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome build gidRessources perspectiveResources">
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
						<div id="content" class="build" >
<?php

if(isset($_GET['id'])) {
	if(isset($_GET['s']))
	{
		if (!ctype_digit($_GET['s'])) {
			$_GET['s'] = null;
		}
	}
	if(isset($_GET['t']))
	{
		if (!ctype_digit($_GET['t'])) {
			$_GET['t'] = null;
		}
	}
	if (!ctype_digit($_GET['id'])) {
		$_GET['id'] = "1";
	}
	$id = $_GET['id'];
	if(($village->resarray['f99t'] == 40) && ($id=='26' || $id=='30' || $id=='31' || $id=='32')){
		$id = 99; $_GET['id'] = 99;
	}
	if($id=='99'){
		if($village->resarray['f99t'] == 40){include("Templates/Build/ww.tpl");}
		else {header('Location: dorf2.php');exit;}
	} elseif($village->resarray['f'.$_GET['id'].'t'] == 0 && $_GET['id'] >= 19) {
		include("Templates/Build/avaliable.tpl");
	}
	else {
		if(isset($_GET['t'])) {
			if($_GET['t'] == 1) {
			$_SESSION['loadMarket'] = 1;
			}
			include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['t'].".tpl");
		} else
		if(isset($_GET['s'])) {
			include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['s'].".tpl");
		}
		else {
			//echo "Templates/Build/".$village->resarray['f'.$_GET['id'].'t'].".tpl";
			//die();
			include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t'].".tpl");
		}
		if(isset($_GET['t'])==99) {
			
			if(isset($_GET['action']) && $_GET['action'] == 'addList') {
				include("Templates/goldClub/farmlist_add.tpl");
			}
			if(isset($_GET['action']) && $_GET['action'] == 'showSlot' && $_GET['lid']) {
				include("Templates/goldClub/farmlist_addraid.tpl");
			}elseif(isset($_GET['action']) && $_GET['action'] == 'showSlot' && $_GET['eid']) {
				include("Templates/goldClub/farmlist_editraid.tpl");
			}
			if(isset($_GET['action']) && $_GET['action'] == 'deleteList') {
				$database->delFarmList($_GET['lid'], $session->uid);
    			header("Location: build.php?id=39&t=99");
			}elseif(isset($_GET['action']) && $_GET['action'] == 'deleteSlot') {
				$database->delSlotFarm($_GET['eid']);
   				header("Location: build.php?id=39&t=99");
    		}
		}
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

?>			
<?php
include("Templates/time.tpl");
?>

<div id="ce"></div>
</div></div>

</body>
</html>


