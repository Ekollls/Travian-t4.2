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
	$message->noticeType($_GET);
	$message->procNotice($_POST);
}
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome reports">
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
<div id="content" class="reports">
<h1 class="titleInHeader"><?php echo HEADER_REPORTS;?></h1>
<div class="contentNavi subNavi">
				<div title="" class="container <?php if (!isset($_GET['t'])) { echo "active"; }else{ echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="berichte.php"><span class="tabItem"><?php echo HEADER_ALL;?></span></a></div>
				</div>
				<div title="" class="container <?php if (isset($_GET['t']) && $_GET['t'] == 1) { echo "active"; }else{ echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="berichte.php?t=1"><span class="tabItem"><?php echo HEADER_TRADE;?></span></a></div>
				</div>
				<div title="" class="container <?php if (isset($_GET['t']) && $_GET['t'] == 2) { echo "active"; }else{ echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="berichte.php?t=2"><span class="tabItem"><?php echo HEADER_REINFORCEMENT;?></span></a></div>
				</div>
				<div title="" class="container <?php if (isset($_GET['t']) && $_GET['t'] == 3) { echo "active"; }else{ echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="berichte.php?t=3"><span class="tabItem"><?php echo HEADER_MISCELLANEOUS;?></span></a></div>
				</div>
                <?php if($session->plus) { ?>
				<div title="" class="container <?php if (isset($_GET['t']) && $_GET['t'] == 4) { echo "active"; }else{ echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="berichte.php?t=4"><span class="tabItem"><?php echo ARCHIVE;?></span></a></div>
				</div> <?php } ?>
<div class="clear"></div>
</div>
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

if(isset($_GET['n1']) && isset($_GET['del'])==1) {
	$database->delNotice($_GET['n1'], $session->uid);
	header("Location: berichte.php");
}
if(isset($_GET['aid'])){
	if($session->alliance==$_GET['aid']){
		if(isset($_GET['id'])) {
			$type = $database->getNotice2($_GET['id'], 'ntype');
			switch ($type){
				case 0: case 1: case 2: case 3: $type = 1; break;
				case 4: case 5: case 6: case 7: $type = 4; break;
				case 10: case 11: case 12: case 13: case 14: $type = 10; break;
				case 15: case 16: case 17: case 18: case 19: $type = 1; break;
			}
			include("Templates/Notice/".$type.".tpl");
		}
	}
} else {
	if(isset($_GET['t'])) {
		include("Templates/Notice/t_".$_GET['t'].".tpl");
	}
	elseif(isset($_GET['id'])) {
		if($database->getNotice2($_GET['id'], 'uid') == $session->uid || $session->access>=MULTIHUNTER){
			$type = ($message->readingNotice['ntype'] == 5)? $message->readingNotice['archive'] : $message->readingNotice['ntype'];
			switch ($type){
				case 0: case 1: case 2: case 3: $type = 1; break;
				case 4: case 5: case 6: case 7: $type = 4; break;
				case 10: case 11: case 12: case 13: case 14: $type = 10; break;
				case 15: case 16: case 17: case 18: case 19: $type = 1; break;
			}
			include("Templates/Notice/".$type.".tpl");
		}
	} else {
		include("Templates/Notice/all.tpl");
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
</div>
</body>
</html>
