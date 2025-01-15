<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
ob_start();
include("GameEngine/Protection.php");
include_once("GameEngine/Village.php");
$ok = $database->getUserField($session->uid, 'ok', 0);
if($ok){

include "Templates/html.tpl";  
?>

<body class="v35 webkit chrome messages">
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
								



<div id="content" class="messages">
                                		<script type="text/javascript"> 
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>

<h1 class="titleInHeader"><?php echo PUBMSGTITLE; ?></h1>
<div class="paper">
	<div class="layout">
		<div class="paperTop">
			<div class="paperContent">
			<?php
			if($database->checkBan($session->uid)){
				echo sprintf(BANMSG,$session->username);
			}else{?>
					
				<div id="subject">
					<div class="header text"><?php echo HELLO.' '.$session->username; ?></div>
					<div class="clear"></div>
				</div>
				<div class="separator"></div>
				<div id="message"><?php include("Templates/text.tpl"); ?></div>

		<div id="answer">
<button type="submit" value="<?php echo GOTOMYVILLAGE; ?>" name="s1" id="s1" class="green " onclick="window.location.href = 'dorf1.php?ok'">
	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo GOTOMYVILLAGE; ?></div>
	</div>
</button>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
	if($('s1'))
	{
		$('s1').addEvent('click', function ()
		{
			window.fireEvent('buttonClicked', [this, {"type":"submit","value":"<?php echo GOTOMYVILLAGE; ?>","name":"s1","id":"s1","class":"green ","title":"","confirm":"","onclick":"window.location.href = 'dorf1.php?ok'"}]);
		});
	}
	});
</script>
					<div class="clear"></div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>












</div>
<div id="side_info" class="outgame">
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
include("Templates/header.tpl");
?>
</div>
<div id="ce"></div>
</div>
</body>
</html>
<?php
} 
else{
header("Location: dorf1.php");
}
ob_flush();
?>
