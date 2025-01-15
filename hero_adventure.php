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

$winner = $database->hasWinner();if($winner){header("Location: winner.php");}
if($session->access<2){header("Location: banned.php");}
$start = $generator->pageLoadTimeStart();
include "Templates/html.tpl";
$time = time();
$herodetail = $database->getHero($session->uid);
$aday = max(86400/SPEED,1800);
$tenday = max(432000/SPEED,18000);
if ($herodetail['lastadv']<=$time-$tenday) $herodetail['lastadv'] = $time-$tenday+$aday;
$endat = $herodetail['lastadv']+$tenday;
while($herodetail['lastadv']<=($time-$aday)) {
	$dif = rand(0,10)>8;
	$database->addAdventure($database->getVFH($herodetail['uid']), $herodetail['uid'], $endat,$dif);
	$herodetail['lastadv'] += $aday;
	$endat += $aday;
}
$database->modifyHero(0,$herodetail['heroid'],'lastadv',$herodetail['lastadv'],0);
?>
<body class="v35 webkit chrome hero_adventure">
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
<div id="content" class="hero_adventure">
<h1 class="titleInHeader"><?php echo U0; ?></h1>

<div class="contentNavi subNavi">
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_inventory.php"><span class="tabItem"><?php echo JR_HEROATTRIBUTES; ?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero.php"><span class="tabItem"><?php echo JR_HEROAPPEARANCE; ?></span></a></div>
				</div>
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_adventure.php"><span class="tabItem"><?php echo JR_HEROADVENTURE; ?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php"><span class="tabItem"><?php echo JR_HEROAUCTION; ?></span></a></div>
				</div><div class="clear"></div>
		</div><script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>
<table cellspacing="1" cellpadding="1">
	<thead>
		<tr>
			<th class="location" colspan="2"><?php echo JR_HEROLOCATION; ?></th>
			<th class="moveTime"><?php echo JR_HEROTIME; ?></th>
			<th class="difficulty"><?php echo JR_HERODIFFICULTY; ?></th>
			<th class="timeLeft"><?php echo JR_HEROTIMELEFT; ?></th>
			<th class="goTo"><?php echo JR_HEROLINK; ?></th>
		</tr>
	</thead>
	<tbody>
<?php

$sql = mysql_query("SELECT * FROM ".TB_PREFIX."adventure WHERE end = 0 and uid = ".$session->uid." ORDER BY time ASC");
$query = mysql_num_rows($sql);

$outputList = '';
$timer = 1;
if($query == 0) {        
    $outputList .= "<td colspan=\"6\" class=\"none\"><center>No adventure found.</center></td>";
}else{
	while($row = mysql_fetch_array($sql)){ 
include "Templates/Auction/alt.tpl";

//find slowest unit.

$eigen = $database->getCoor($herodetail['wref']);
$coor = $database->getCoor($row['wref']);
$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
$to = array('x'=>$coor['x'], 'y'=>$coor['y']);
$speed = $herodetail['speed']+$herodetail['itemspeed'];
$time = $generator->procDistanceTime($from,$to,$speed,1);

$isoasis = $database->isVillageOases($row['wref']);
if($isoasis){
	$get = $database->getOMInfo($row['wref']);
	$type = $get['type'];
}else{
	$get = $database->getMInfo($row['wref']);
	$type = $get['fieldtype'];
}
switch($type) {
case 1:
case 2:
case 3:
$tname =  JR_FOREST;
break;
case 4:
case 5:
case 6:
$tname =  JR_FIELD;
break;
case 7:
case 8:
case 9:
$tname =  JR_MOUNTAIN;
break;
case 10:
case 11:
case 12:
$tname =  JR_SEA;
break;
}

	$outputList .= "<tr id=\"adventure". $row['id'] ."\"><td class=\"location\">".$tname."</td>";
	
	$outputList .= '<td class="coords"><a href="karte.php?x='.$coor['x'].'&amp;y='.$coor['y'].'">';
	if (DIRECTION == 'ltr'){
		$outputList .= '<span class="coordinates coordinatesWrapper coordinatesAligned coordinatesLTR"><span class="coordinateX">('.$coor['x'].'</span><span class="coordinatePipe">|</span><span class="coordinateY">'.$coor['y'].')</span>';
	}elseif (DIRECTION == 'rtl'){
		$outputList .= '<span class="coordinates coordinatesWrapper coordinatesAligned coordinatesRTL"><span class="coordinateY">('.$coor['y'].'</span><span class="coordinatePipe">|</span><span class="coordinateX">'.$coor['x'].')</span>';
	}
    $outputList .= '</span><span class="clear"></span></a></td>';
    $outputList .= "<td class=\"moveTime\"> ".$generator->getTimeFormat($time)." </td>";
	if(!$row['dif']){
		$outputList .= "<td class='difficulty'><img src='img/x.gif' class='adventureDifficulty2' title='Normális' /></td>";
	}else{
		$outputList .= "<td class='difficulty'><img src='img/x.gif' class='adventureDifficulty0' title='Veszélyes' /></td>";	
	}
	$outputList .= "<td class=\"timeLeft\"><span id=\"timer".$timer."\">".$generator->getTimeFormat($row['time']-time())."</span></td>";
	$outputList .= "<td class=\"goTo\"><a class=\"gotoAdventure arrow\" href=\"a2b.php?id=".$row['wref']."&h=1\">".TOTHEADVENTURE."</a></td></tr>";	
    $timer++;
	}
}
echo $outputList;
?>
	
    </tbody>
</table>




		  <div class="clear">&nbsp;</div></div>							<div class="clear"></div>
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


