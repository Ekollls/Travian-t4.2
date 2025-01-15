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
	$building->procBuild($_GET);
}
include "Templates/html.tpl";

## Get Rankings for Ranking Section
$sql = $ranking->procUsersRanking(); $pop[] = mysql_fetch_assoc($sql);$pop[] = mysql_fetch_assoc($sql); $pop[] = mysql_fetch_assoc($sql);
$sql = $ranking->procUsersAttRanking(); $attacker[] = mysql_fetch_assoc($sql); $attacker[] = mysql_fetch_assoc($sql); $attacker[] = mysql_fetch_assoc($sql);
$sql = $ranking->procUsersDefRanking(); $defender[] = mysql_fetch_assoc($sql); $defender[] = mysql_fetch_assoc($sql); $defender[] = mysql_fetch_assoc($sql);

## Get WW Winner Details
$sql = mysql_fetch_assoc(mysql_query("SELECT vref FROM ".TB_PREFIX."fdata WHERE f99 = '100' and f99t = '40'"));
$vref = $sql['vref'];

$sql = mysql_fetch_assoc(mysql_query("SELECT name FROM ".TB_PREFIX."vdata WHERE wref = '$vref'"));
$winningvillagename = $sql['name'];

$sql = mysql_fetch_assoc(mysql_query("SELECT owner FROM ".TB_PREFIX."vdata WHERE wref = '$vref'"));
$owner = $sql['owner'];

$sql = mysql_fetch_assoc(mysql_query("SELECT username FROM ".TB_PREFIX."users WHERE id = '$owner'"));
$username = $sql['username'];

$sql = mysql_fetch_assoc(mysql_query("SELECT alliance FROM ".TB_PREFIX."users WHERE id = '$owner'"));
$allianceid = $sql['alliance'];

$sql = mysql_fetch_assoc(mysql_query("SELECT name, tag FROM ".TB_PREFIX."alidata WHERE id = '$allianceid'"));
$winningalliance = $sql;

$sql = mysql_fetch_assoc(mysql_query("SELECT tag FROM ".TB_PREFIX."alidata WHERE id = '$allianceid'"));
$winningalliancetag = $sql['tag'];

$winner = $database->hasWinner();

if($winner){
?>
<body class="v35 webkit chrome plus">
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
						<div id="content" class="plus">
                        <script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>
<img src="gpack/travian_Travian_4.2_BigBang/img/g/g40_100-<?php echo DIRECTION;?>.png" <?php if (DIRECTION=='ltr') {echo 'align="right"';} else {echo 'align="left"';}?> style="padding-top: 40px;">
<p>
<?php 
	echo sprintf(WINNER_STR,SERVER_NAME,$vref,$generator->getMapCheck($vref),$winningvillagename,date('H:i:s',WINMOMENT),date('Y-m-d',WINMOMENT),$allianceid,$winningalliancetag,$owner,$username,$owner,$username,$pop[0]['userid'],$pop[0]['totalvillages'],$pop[0]['totalpop'],$pop[0]['username'],
	$pop[1]['userid'],$pop[1]['totalvillages'],$pop[1]['totalpop'],$pop[1]['username'],
	$pop[2]['userid'],$pop[2]['totalvillages'],$pop[2]['totalpop'],$pop[2]['username'],
	$attacker[0]['userid'],$attacker[0]['totalvillages'],$attacker[0]['apall'],$attacker[0]['username'],
	$defender[0]['userid'],$defender[0]['totalvillages'],$defender[0]['dpall'],$defender[0]['username'],SERVER_NAME);

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


<?php
}else{
	header("Location: dorf1.php");
}
?>
