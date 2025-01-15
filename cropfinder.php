<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

include("GameEngine/Protection.php");
   include ("GameEngine/Village.php");
if($session->access<2){header("Location: banned.php");}
   if($session->plus == 0) {
       header("Location: plus.php?id=3");
   }

   if($_POST['type'] == 15) {
       header("Location: ".$_SERVER['PHP_SELF']."?s=1&x=" . $_POST['x'] . '&y=' . $_POST['y']);
   } elseif($_POST['type'] == 9) {
       header("Location: ".$_SERVER['PHP_SELF']."?s=2&x=" . $_POST['x'] . '&y=' . $_POST['y']);
   } elseif($_POST['type'] == 'both') {
       header("Location: ".$_SERVER['PHP_SELF']."?s=3&x=" . $_POST['x'] . '&y=' . $_POST['y']);
   }
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome cropfinder">
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
								<div id="content" class="cropfinder">

<?php include "Templates/cropfinder.tpl"; ?>



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

