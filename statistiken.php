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

if(isset($_POST['name'])) $_POST['name'] = strval($_POST['name']);
if(isset($_POST['rank'])) $_POST['rank'] = intval($_POST['rank']);

if((!isset($_POST['name']) || (isset($_POST['name']) && $_POST['name']=='')) && (!isset($_POST['rank']) || (isset($_POST['rank']) && ($_POST['rank']=='' || $_POST['rank']==0))) ){
	unset($_POST['name']); unset($_POST['rank']);
}
$start = $generator->pageLoadTimeStart();
if(isset($_GET['rank'])){ $_POST['rank']==$_GET['rank']; }
if(isset($_GET['newdid'])) {
    $_SESSION['wid'] = $_GET['newdid'];
    header("Location: ".$_SERVER['PHP_SELF']);
}
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome statistics">
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
	include("Templates/topheader.tpl"); // mehdi jan injaro man edit kardam bordam tu hamin file ke berim baghie ja ha ham include konim!
	include("Templates/toolbar.tpl"); // mehdi jan injaro man edit kardam bordam tu hamin file ke berim baghie ja ha ham include konim!

?>

</div> 
</div>
					<div id="center">
		<?php include("Templates/sideinfo.tpl"); ?>

<div id="contentOuterContainer">
		<?php include("Templates/res.tpl"); ?>

<div class="contentTitle">&nbsp;</div> 
    <div class="contentContainer"> 
								<div id="content" class="statistics">
                                		<script type="text/javascript"> 
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>

<h1 class="titleInHeader">
	<?php 
	echo HEADER_STATS;
	if($session->access == ADMIN) { echo " <a href=\"medals.php\"></a>"; } 
	?>
</h1>
<div class="contentNavi subNavi">
				<div title="" <?php if(!isset($_GET['tid']) || (isset($_GET['tid']) && ($_GET['tid'] == 1 || $_GET['tid'] == 31 || $_GET['tid'] == 32 || $_GET['tid'] == 7))) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="statistiken.php"><span class="tabItem"><?php echo JR_OVERVIEW;?></span></a></div> 
				</div> 
				<div title="" <?php if(isset($_GET['tid']) && ($_GET['tid'] == 4 || $_GET['tid'] == 41 || $_GET['tid'] == 42 || $_GET['tid'] == 43)) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div> 
					<div class="content"><a href="statistiken.php?tid=4"><span class="tabItem"><?php echo SIDEINFO_ALLIANCE;?></span></a></div> 
				</div> 
				<div title="" <?php if(isset($_GET['tid']) && $_GET['tid'] == 2) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div> 
					<div class="content"><a href="statistiken.php?tid=2"><span class="tabItem"><?php echo MULTI_V_HEADER;?></span></a></div> 
				</div> 
				<div title="" <?php if(isset($_GET['tid']) && $_GET['tid'] == 8) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div> 
					<div class="content"><a href="statistiken.php?tid=8"><span class="tabItem"><?php echo U0;?></span></a></div> 
				</div> 
				<div title="" <?php if(isset($_GET['tid']) && $_GET['tid'] == 0) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div> 
					<div class="content"><a href="statistiken.php?tid=0"><span class="tabItem"><?php echo JR_GENERAL;?></span></a></div> 
				</div> 
                				<div title="" <?php if(isset($_GET['tid']) && $_GET['tid'] == 98) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div> 
					<div class="content"><a href="statistiken.php?tid=98"><span class="tabItem"><?=FARMLIST?></span></a></div> 
				</div> 

				<?php if(SHOWWW2 == true){ include "Templates/Ranking/ww2.tpl"; }?>
				<div class="clear"></div>
</div>
<?php
if(isset($_GET['tid'])) {
	switch($_GET['tid']) {
		 case 31:
        include("Templates/Ranking/player_attack.tpl");
        break;
        case 32:
        include("Templates/Ranking/player_defend.tpl");
        break;
        case 7:
        include("Templates/Ranking/player_top10.tpl");
        break;
        case 2:
        include("Templates/Ranking/villages.tpl");
        break;
        case 4:
        include("Templates/Ranking/alliance.tpl");
        break;
        case 8:
        include("Templates/Ranking/heroes.tpl");
        break;
        case 11:
        include("Templates/Ranking/player_1.tpl");
        break;
        case 12:
        include("Templates/Ranking/player_2.tpl");
        break;
        case 13:
        include("Templates/Ranking/player_3.tpl");
        break;
        case 41:
        include("Templates/Ranking/alliance_attack.tpl");
        break;
        case 42:
        include("Templates/Ranking/alliance_defend.tpl");
        break;
        case 43:
        include("Templates/Ranking/ally_top10.tpl");
        break;
        case 0:
        include("Templates/Ranking/general.tpl");
        break;
        case 1:
        default:
        include("Templates/Ranking/overview.tpl");
        break;
        case 98:
        include("Templates/Ranking/farmlist.tpl");
        break;
        case 99:
        default:
        include("Templates/Ranking/ww.tpl");
        break;
	}
}
else {
	include("Templates/Ranking/overview.tpl");
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


