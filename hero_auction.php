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

// limit for advs.
$hdq = mysql_query("SELECT * FROM ".TB_PREFIX."hero WHERE uid='".$session->uid."'");
$hd = mysql_fetch_array($hdq);
$no_of_advs = $hd['sucsadv'];
$max_advs = 10; // hade aghal tedade morede nazar


?>
<body class="v35 webkit chrome hero_auction">
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
								<div id="content" class="hero_auction"><h1 class="titleInHeader"><?php echo U0; ?></h1>

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
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_adventure.php"><span class="tabItem"><?php echo JR_HEROADVENTURE; ?></span></a></div>
				</div>
				<div class="container active">
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

<?php		

if(isset($_GET['action']) && $_GET['action']=='sell' && isset($_GET['abort']) && $_GET['abort']){
	$aucData = $database->getAuctionData($_GET['abort']);
	$usedtime = AUCTIONTIME-($aucData["time"]-time()); $bids = $aucData["bids"];
	if ($aucData['owner']==$session->uid && !(($usedtime>(AUCTIONTIME/10)) || ($bids!=0))) 
		$database->delAuction($_GET['abort']);
}
$sql = mysql_query("SELECT * FROM ".TB_PREFIX."auction WHERE finish = 0 and owner = '".$session->uid."'");
$query = mysql_num_rows($sql);
if(isset($_GET['action']) && $_GET['action']=='sell' && isset($_POST['a']) && $_POST['a']=='e45'){
	$_POST['amount'] = intval($_POST['amount']);
	$_POST['id'] = intval($_POST['id']);
	$useraccess = $database->getUserField($session->uid,'access',0);
	if(($query < MAXSELL) || ($useraccess==9)){
		$data = $database->getHeroItem($_POST['id']);
		if ($data['uid']==$session->uid && $_POST['amount']>0 && $_POST['amount']<=$data['num'])
			$database->addAuction($session->uid, $_POST['id'], $data['btype'], $data['type'], $_POST['amount']);
	}
}

if((isset($_POST['a']) && isset($_POST['action']) && $_POST['action']=='buy') || (isset($_POST['a']) && isset($_POST['action']) && $_POST['action']=='bids')){
	$_POST['a'] = intval($_POST['a']);
	$getBidData = $database->getBidData($_POST['a']);
	if ($getBidData['owner']!=$session->uid){
		$bidError = 0;
		if(!isset($getBidData) || $getBidData==null){
			$bidError = 6;
		}elseif($getBidData['finish']==1 || $getBidData['time']<time()){
			$bidError = 5;
		}else{
			$_POST['maxBid'] = intval($_POST['maxBid']);
			if ($_POST['maxBid']<=0) $_POST['maxBid'] = 0;
			$userData = $database->getUser($session->uid,1);
			if(($getBidData['uid']==$session->uid && $_POST['maxBid'] < $getBidData['silver'])||
			  ($getBidData['uid']!=$session->uid && $_POST['maxBid'] <= $getBidData['silver'])){
				$bidError = 1;
			}else{
				$newtime = time()+max(min(300,AUCTIONTIME),$getBidData['time']-time());
				if($getBidData['uid']==0){
					if($_POST['maxBid'] > $session->silver){
						$bidError = 3;
					} else {
						$database->addBid($_POST['a'], $session->uid, $getBidData['silver']+1, $_POST['maxBid'],$newtime);
						$database->setSilver($session->uid,$_POST['maxBid'],0);
						$q = 'UPDATE '.TB_PREFIX.'users SET bisilver=bisilver+'.$_POST['maxBid'].' WHERE id='.$session->uid; mysql_query($q);
					}
				}elseif($getBidData['uid']==$session->uid){
					$maxsilverchange = ($_POST['maxBid'] - $getBidData['maxsilver']);
					if($maxsilverchange > $session->silver){
						$bidError = 3;
					} else {
						$database->editBid($_POST['a'], $_POST['maxBid']);
						if($maxsilverchange>0){
							$database->setSilver($session->uid,$maxsilverchange,0);
							$q = 'UPDATE '.TB_PREFIX.'users SET bisilver=bisilver+'.$maxsilverchange.' WHERE id='.$session->uid; mysql_query($q);
						} elseif($maxsilverchange<0) {
							$maxsilverchange *= -1;
							$database->setSilver($session->uid,$maxsilverchange,1);
							$q = 'UPDATE '.TB_PREFIX.'users SET bisilver=bisilver-'.$maxsilverchange.' WHERE id='.$session->uid; mysql_query($q);
						}
					}
				}else{
					if($_POST['maxBid'] > $session->silver){
						$bidError = 3;
					} else {
						if($_POST['maxBid'] <= $getBidData['maxsilver']){
							$database->addBid($_POST['a'], $getBidData['uid'], $_POST['maxBid'], $getBidData['maxsilver'],$newtime);
							$bidError = 4;
						} else {
							$database->setSilver($getBidData['uid'],$getBidData['maxsilver'],1);
							$q = 'UPDATE '.TB_PREFIX.'users SET bisilver=bisilver-'.$getBidData['maxsilver'].' WHERE id='.$getBidData['uid']; mysql_query($q);
							$database->addBid($_POST['a'], $session->uid, $getBidData['maxsilver']+1, $_POST['maxBid'],$newtime);
							$database->setSilver($session->uid,$_POST['maxBid'],0);
							$q = 'UPDATE '.TB_PREFIX.'users SET bisilver=bisilver+'.$_POST['maxBid'].' WHERE id='.$session->uid; mysql_query($q);
						}
					}
				}
			}
		}
	}
	if(isset($_POST['page']) && $_POST['page']){ $page = "&page=".$_POST['page']; }else{ $page = ""; }
	if($_POST['action']=='bids'){ $ssss = 'bids'; } elseif($_POST['action']=='buy'){ $ssss = 'buy'; }
	if($bidError){ $err = '&err='.$bidError; } else{ $err = ''; }
	header("Location: ?action=".$ssss.$page."&a=".$_POST['a'].$err);
}

include("Templates/Auction/menu.tpl");
if(isset($_GET['action'])){
	if($_GET['action'] == 'buy'){
		include("Templates/Auction/buy.tpl");
	} elseif($_GET['action'] == 'sell'){
		include("Templates/Auction/sell.tpl");
	} elseif($_GET['action'] == 'bids'){
		include("Templates/Auction/bids.tpl");
	} elseif($_GET['action'] == 'exchange'){
		include("Templates/Auction/exchangesilv.tpl");
	}
} else {
		include("Templates/Auction/buy.tpl");
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

