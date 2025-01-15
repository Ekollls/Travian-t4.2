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
include ("GameEngine/Chat.php");
global $session;
if (!isset($_GET['aid']) && $session->alliance == 0) {
	header('Location: dorf1.php');
	exit;
}
$start = $generator->pageLoadTimeStart();
$alliance->procAlliance($_GET);
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome alliance">
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
       if(isset($_GET['s']) && $_GET['s'] == 2) {
       	echo '<div id="content" class="forum">';
       } else {
       	echo '<div id="content" class="alliance">';
       }

       if(isset($_GET['s'])) {
	   if($_GET['s'] != 5 or $session->is_sitter == 0){
       	switch($_GET['s']) {
       		case 2:
       			include ("Templates/Alliance/forum.tpl");
       			break;
       		case 3:
       			include ("Templates/Alliance/attacks.tpl");
       			break;
       		case 4:
       			include ("Templates/Alliance/news.tpl");
       			break;
       		case 5:
       			include ("Templates/Alliance/option.tpl");
       			break;
       		case 6:
       			include ("Templates/Alliance/chat.tpl");
       			break;
       		case 1:
       		default:
       			include ("Templates/Alliance/overview.tpl");
       			break;
       	}
       	// Options
       }else{
		header("Location: ".$_SERVER['PHP_SELF']);
	   }} elseif(isset($_POST['o'])) {
       	switch($_POST['o']) {
       		case 1:
       			if(isset($_POST['s']) == 5 && isset($_POST['a_user'])) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/changepos.tpl");
       			} else {
       				include ("Templates/Alliance/assignpos.tpl");
       			}
       			break;
       		case 2:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 2) {
       				$alliance->procAlliForm($_POST);
       				include ("Templates/Alliance/kick.tpl");
       			} else {
       				include ("Templates/Alliance/kick.tpl");
       			}
       			break;
       		case 3:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 3) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/allidesc.tpl");
       			} else {
       				include ("Templates/Alliance/allidesc.tpl");
       			}
       			break;
       		case 4:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 4) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/invite.tpl");
       			} else {
       				include ("Templates/Alliance/invite.tpl");
       			}
       			break;
       		case 5:
       			include ("Templates/Alliance/linkforum.tpl");
       			break;
       		case 6:
       			if(isset($_POST['dipl']) and isset($_POST['a_name'])) {
       				$alliance->procAlliForm($_POST);
       				include ("Templates/Alliance/chgdiplo.tpl");
       			} else {
       				include ("Templates/Alliance/chgdiplo.tpl");
       			}
       			break;
       		case 11:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 11) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/quitalli.tpl");
       			} else {
       				include ("Templates/Alliance/quitalli.tpl");
       			}
       			break;
       		default:
       			include ("Templates/Alliance/option.tpl");
       			break;
       		case 100:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 100) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/changename.tpl");
       			} else {
       				include ("Templates/Alliance/changename.tpl");
       			}
       			break;
       		case 101:
       			$post = $_POST['id'];
       			$database->diplomacyCancelOffer($post);
       			include ("Templates/Alliance/chgdiplo.tpl");
       			break;
       		case 102:
       			$post = $_POST['id'];
       			$post2 = $_POST['alli2'];
       			$database->diplomacyInviteDenied($post, $post2);
       			include ("Templates/Alliance/chgdiplo.tpl");
       			break;
       		case 103:
       			$post = $_POST['id'];
       			$post2 = $_POST['alli2'];
       			$database->diplomacyInviteAccept($post, $post2);
       			include ("Templates/Alliance/chgdiplo.tpl");
       			break;
       		case 104:
       			$post = $_POST['id'];
       			$post2 = $_POST['alli2'];
       			$database->diplomacyCancelExistingRelationship($post, $post2);
       			include ("Templates/Alliance/chgdiplo.tpl");
				break;
       		case 105:
       			$database->sendAmessage($_POST);
       			include ("Templates/Alliance/sendAmessage.tpl");
				break;
       	}
       } else {

       	include ("Templates/Alliance/overview.tpl");
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

