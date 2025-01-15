<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include("GameEngine/Village.php");
include("GameEngine/Inventory.php");
include("GameEngine/Units.php");
if($session->access<2){header("Location: banned.php");}
$start = $generator->pageLoadTimeStart();
include "Templates/html.tpl";

$uid = $session->uid;
$heroFace = $database->getHeroFace($uid);


///////////////////////////////////
$heroIsHere = false;
$isha = 0;
foreach($session->villages as $vill) {
	if($database->getHUnit($vill)) { 
		$isha ++;
		$tvwhe = $vill;
	}
}
if($isha > 0) {
	if( $village->wid == $tvwhe ) {
		$heroIsHere = true;
	}
}
/////////////////////////////////////



if($heroFace['gender']==0) {$gstr = 'male';} else {$gstr = 'female';}

if($heroIsHere) {
	
	if(isset($_GET['inventory'])){
		if(isset($_GET['helmet'])){
			$item = $database->getHeroItem($heroFace['helmet']);
			if ($item){
				switch  ($item['type']){
					case 1:	$database->modifyHero($uid,0,"itemextraexpgain",15,2); break;
					case 2:	$database->modifyHero($uid,0,"itemextraexpgain",20,2); break;
					case 3:	$database->modifyHero($uid,0,"itemextraexpgain",25,2); break;
					case 4: $database->modifyHero($uid,0,"itemautoregen",10,2);	break;
					case 5:	$database->modifyHero($uid,0,"itemautoregen",15,2);	break;
					case 6:	$database->modifyHero($uid,0,"itemautoregen",20,2);	break;
					case 7:	$database->modifyHero($uid,0,"itemcpproduction",5,2);	break;
					case 8:	$database->modifyHero($uid,0,"itemcpproduction",10,2);	break;
					case 9:	$database->modifyHero($uid,0,"itemcpproduction",15,2);	break;
					case 10: $database->modifyHero($uid,0,"itemcavalrytrain",10,2);	break;
					case 11: $database->modifyHero($uid,0,"itemcavalrytrain",15,2);	break;
					case 12: $database->modifyHero($uid,0,"itemcavalrytrain",20,2);	break;
					case 13: $database->modifyHero($uid,0,"iteminfantrytrain",10,2); break;
					case 14: $database->modifyHero($uid,0,"iteminfantrytrain",15,2); break;
					case 15: $database->modifyHero($uid,0,"iteminfantrytrain",20,2); break;
				}
				$database->modifyHeroItem($heroFace['helmet'], 'proc', 0, 0);
				$database->modifyHeroItem($heroFace['helmet'], 'num', 1, 1);
				$database->modifyHeroFace($uid, "helmet", 0);
			}
		}elseif(isset($_GET['body'])){
			$item = $database->getHeroItem($heroFace['body']);
			if ($item){
				switch  ($item['type']){
					case 82: $database->modifyHero($uid,0,"itemautoregen",20,2); break;
					case 83: $database->modifyHero($uid,0,"itemautoregen",30,2); break;
					case 84: $database->modifyHero($uid,0,"itemautoregen",40,2); break;
					case 85: $database->modifyHero($uid,0,"itemautoregen",10,2); $database->modifyHero($uid,0,"itemextraresist",4,2); break;
					case 86: $database->modifyHero($uid,0,"itemautoregen",15,2); $database->modifyHero($uid,0,"itemextraresist",6,2); break;
					case 87: $database->modifyHero($uid,0,"itemautoregen",20,2); $database->modifyHero($uid,0,"itemextraresist",8,2); break;
					case 88: $database->modifyHero($uid,0,"itemfs",500,2); break;
					case 89: $database->modifyHero($uid,0,"itemfs",1000,2); break;
					case 90: $database->modifyHero($uid,0,"itemfs",1500,2); break;
					case 91: $database->modifyHero($uid,0,"itemfs",250,2); $database->modifyHero($uid,0,"itemextraresist",3,2); break;
					case 92: $database->modifyHero($uid,0,"itemfs",500,2); $database->modifyHero($uid,0,"itemextraresist",4,2); break;
					case 93: $database->modifyHero($uid,0,"itemfs",750,2); $database->modifyHero($uid,0,"itemextraresist",5,2); break;
				}
				$database->modifyHeroItem($heroFace['body'], 'proc', 0, 0);
				$database->modifyHeroItem($heroFace['body'], 'num', 1, 1);
				$database->modifyHeroFace($uid, "body", 0);
			}
		}elseif(isset($_GET['leftHand'])){
			$item = $database->getHeroItem($heroFace['leftHand']);
			if ($item){
				switch  ($item['type']){
					case 61: $database->modifyHero($uid,0,"itemreturnmspeed",30,2); break;
					case 62: $database->modifyHero($uid,0,"itemreturnmspeed",40,2); break;
					case 63: $database->modifyHero($uid,0,"itemreturnmspeed",50,2); break;
					case 64: $database->modifyHero($uid,0,"itemaccountmspeed",30,2); break;
					case 65: $database->modifyHero($uid,0,"itemaccountmspeed",40,2); break;
					case 66: $database->modifyHero($uid,0,"itemaccountmspeed",50,2); break;
					case 67: $database->modifyHero($uid,0,"itemallymspeed",15,2); break;
					case 68: $database->modifyHero($uid,0,"itemallymspeed",20,2); break;
					case 69: $database->modifyHero($uid,0,"itemallymspeed",25,2); break;
					case 73: $database->modifyHero($uid,0,"itemrob",10,2); break;
					case 74: $database->modifyHero($uid,0,"itemrob",15,2); break;
					case 75: $database->modifyHero($uid,0,"itemrob",20,2); break;
					case 76: $database->modifyHero($uid,0,"itemfs",500,2); break;
					case 77: $database->modifyHero($uid,0,"itemfs",1000,2); break;
					case 78: $database->modifyHero($uid,0,"itemfs",1500,2); break;
					case 79: $database->modifyHero($uid,0,"itemvsnatars",25,2); break;
					case 80: $database->modifyHero($uid,0,"itemvsnatars",50,2); break;
					case 81: $database->modifyHero($uid,0,"itemvsnatars",75,2); break;
				}
				$database->modifyHeroItem($heroFace['leftHand'], 'proc', 0, 0);
				$database->modifyHeroItem($heroFace['leftHand'], 'num', 1, 1);
				$database->modifyHeroFace($uid, "leftHand", 0);
			}
		}elseif(isset($_GET['rightHand'])){
			$item = $database->getHeroItem($heroFace['rightHand']);
			if ($item){
				switch  ($item['type']){
					case 16: case 19: case 22: case 25: case 28: case 31: case 34: case 37: case 40: case 43: case 46: case 49: case 52: case 55: case 58:
						$database->modifyHero($uid,0,"itemfs",500,2);
					break;
					case 17: case 20: case 23: case 26: case 29: case 32: case 35: case 38: case 41: case 44: case 47: case 50: case 53: case 56: case 59:
						$database->modifyHero($uid,0,"itemfs",1000,2);
					break;
					case 18: case 21: case 24: case 27: case 30: case 33: case 36: case 39: case 42: case 45: case 48: case 51: case 54: case 57: case 60:
						$database->modifyHero($uid,0,"itemfs",1500,2);
					break;
				}
				$database->modifyHeroItem($heroFace['rightHand'], 'proc', 0, 0);
				$database->modifyHeroItem($heroFace['rightHand'], 'num', 1, 1);
				$database->modifyHeroFace($uid, "rightHand", 0);
			}
		}elseif(isset($_GET['shoes'])){
			$item = $database->getHeroItem($heroFace['shoes']);
			if ($item){
				switch  ($item['type']){
					case 94: $database->modifyHero($uid,0,"itemautoregen",10,2); break;
					case 95: $database->modifyHero($uid,0,"itemautoregen",15,2); break;
					case 96: $database->modifyHero($uid,0,"itemautoregen",20,2); break;
					case 97: $database->modifyHero($uid,0,"itemattackmspeed",25,2); break;
					case 98: $database->modifyHero($uid,0,"itemattackmspeed",50,2); break;
					case 99: $database->modifyHero($uid,0,"itemattackmspeed",75,2); break;
					case 100: $database->modifyHero($uid,0,"itemspeed",3,2); break;
					case 101: $database->modifyHero($uid,0,"itemspeed",4,2); break;
					case 102: $database->modifyHero($uid,0,"itemspeed",5,2); break;
				}
				$database->modifyHeroItem($heroFace['shoes'], 'proc', 0, 0);
				$database->modifyHeroItem($heroFace['shoes'], 'num', 1, 1);
				$database->modifyHeroFace($uid, "shoes", 0);
			}
		}elseif(isset($_GET['horse'])){
			$item = $database->getHeroItem($heroFace['horse']);
			if ($item){
				switch  ($item['type']){
					case 103: $database->modifyHero($uid,0,"itemspeed",14,2); break;
					case 104: $database->modifyHero($uid,0,"itemspeed",17,2); break;
					case 105: $database->modifyHero($uid,0,"itemspeed",20,2); break;
				}
				$database->modifyHeroItem($heroFace['horse'], 'proc', 0, 0);
				$database->modifyHeroItem($heroFace['horse'], 'num', 1, 1);
				$database->modifyHeroFace($uid, "horse", 0);
			}
		}elseif(isset($_GET['bag'])){
			$database->modifyHeroItem($heroFace['bag'], 'num', $heroFace['num'], 1);
			$database->modifyHeroItem($heroFace['bag'], 'proc', 0, 0);
			$database->modifyHeroFace($uid, "bag", 0);
			$database->modifyHeroFace($uid, "num", 0);
		}
	}
}
if(isset($_GET['showhero'])){
	$database->modifyHero($session->uid,0,'hide', 0);
}
if(isset($_GET['hidehero'])){
	$database->modifyHero($session->uid,0,'hide', 1, 0);
}

$units->fixHeroE();

?>
<body class="v35 webkit chrome hero_inventory">
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
							<div id="content" class="hero_inventory">
								<h1 class="titleInHeader"><?php echo U0; ?></h1>
								<div class="contentNavi subNavi">
									<div class="container active">
										<div class="background-start">&nbsp;</div>
										<div class="background-end">&nbsp;</div>
										<div class="content">
											<a href="hero_inventory.php"><span class="tabItem"><?php echo JR_HEROATTRIBUTES; ?></span></a>
										</div>
									</div>
									<div class="container normal">
										<div class="background-start">&nbsp;</div>
										<div class="background-end">&nbsp;</div>
										<div class="content">
											<a href="hero.php"><span class="tabItem"><?php echo JR_HEROAPPEARANCE; ?></span></a>
										</div>
									</div>
									<div class="container normal">
										<div class="background-start">&nbsp;</div>
										<div class="background-end">&nbsp;</div>
										<div class="content">
											<a href="hero_adventure.php"><span class="tabItem"><?php echo JR_HEROADVENTURE; ?></span></a>
										</div>
									</div>
									<div class="container normal">
										<div class="background-start">&nbsp;</div>
										<div class="background-end">&nbsp;</div>
										<div class="content">
											<a href="hero_auction.php"><span class="tabItem"><?php echo JR_HEROAUCTION; ?></span></a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
								<script type="text/javascript">
									window.addEvent('domready', function(){
										$$('.subNavi').each(function(element){
											new Travian.Game.Menu(element);
										});
									});
								</script>
								<div class="clear"></div>
								<?php
								include("Templates/hero.tpl");
								$heroface = $database->getHeroFace($session->uid);
								?>
								<div id="bodyOptions">
									<div id="hero_body_container">
										<div id="hero_body">
											<img class="heroBody" src="hero_body.php?uid=<?php echo $session->uid; ?>&amp;size=inventory&<?php echo $heroface['hash']; ?>"/>
											<div class="clear"></div>
										</div>
										<div id="hero_body_content">
											<div class="content">
												<?php
												$gi = $database->getHeroFace($session->uid);
												$dis = '';
												if($hero['dead']==1){
													$dis = ' disabled';
												}
												if($gi['helmet']!=0){
													$data = $database->getHeroItem($gi['helmet']);
													$item = '<a href="?inventory&helmet='.$data['id'].'"><div id="item_helmet" class="item item_'.$gstr.'_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
													echo '<div id="helmet" class="draggable">'.$item.'</div>';
												}else{
													echo '<div id="helmet" class="draggable"></div>';
												}

												if($gi['leftHand']!=0){
													$data = $database->getHeroItem($gi['leftHand']);
													$item = '<a href="?inventory&leftHand='.$data['id'].'"><div id="item_leftHand" class="item item_'.$gstr.'_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
													echo '<div id="leftHand" class="draggable">'.$item.'</div>';
												}else{
													echo '<div id="leftHand" class="draggable"></div>';
												}

												if($gi['rightHand']!=0){
													$data = $database->getHeroItem($gi['rightHand']);
													$item = '<a href="?inventory&rightHand='.$data['id'].'"><div id="item_rightHand" class="item item_'.$gstr.'_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
													echo '<div id="rightHand" class="draggable">'.$item.'</div>';
												}else{
													echo '<div id="rightHand" class="draggable"></div>';
												}

												if($gi['body']!=0){
													$data = $database->getHeroItem($gi['body']);
													$item = '<a href="?inventory&body='.$data['id'].'"><div id="item_body" class="item item_'.$gstr.'_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
													echo '<div id="body" class="draggable">'.$item.'</div>';
												}else{
													echo '<div id="body" class="draggable"></div>';
												}

												if($gi['shoes']!=0){
													$data = $database->getHeroItem($gi['shoes']);
													$item = '<a href="?inventory&shoes='.$data['id'].'"><div id="item_shoes" class="item item_'.$gstr.'_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
													echo '<div id="shoes" class="draggable">'.$item.'</div>';
												}else{
													echo '<div id="shoes" class="draggable"></div>';
												}

												if($gi['horse']!=0){
													$data = $database->getHeroItem($gi['horse']);
													$item = '<a href="?inventory&horse='.$data['id'].'"><div id="item_horse" class="item item_'.$gstr.'_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
													echo '<div id="horse" class="draggable">'.$item.'</div>';
												}else{
													echo '<div id="horse" class="draggable"></div>';
												}

												if($gi['bag']!=0){
													$data = $database->getHeroItem($gi['bag']);
													$faceData = $database->getHeroFace($session->uid);
													$item = '<a href="?inventory&bag='.$data['id'].'"><div id="item_bag" class="item item_'.$gstr.'_'.$data['type'].' onHero" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$faceData['num'].'</div></div></a>';
													echo '<div id="bag" class="draggable">'.$item.'</div>';
												}else{
													echo '<div id="bag" class="draggable"></div>';
												}
												?>
											</div>
										</div>
									</div>
									<div class="heroHidden">
										<?php if($hero['hide'] == 1){ ?>
											<input type="checkbox" class="check" name="hideShow" onclick="window.location.href = '?showhero=<?php echo $hero['heroid'];?>';" checked="checked"> <?php echo JR_HEROEVASION;?>
										<?php }else{ ?>
											<input type="checkbox" class="check" name="hideShow" onclick="window.location.href = '?hidehero=<?php echo $hero['heroid'];?>';"> <?php echo JR_HEROEVASION;?>
										<?php } ?>
									</div>
								</div>
								<div id="hero_inventory">
									<div class="boxes boxesColor gray">
										<div class="boxes-tl"></div>
										<div class="boxes-tr"></div>
										<div class="boxes-tc"></div>
										<div class="boxes-ml"></div>
										<div class="boxes-mr"></div>
										<div class="boxes-mc"></div>
										<div class="boxes-bl"></div>
										<div class="boxes-br"></div>
										<div class="boxes-bc"></div>
										<div class="boxes-contents cf">
											<div id="itemsToSale">
												<?php
												$sql = $database->getHeroItem(0, $session->uid,0,0,0);
												$outputList = '';
												$inv = 1;
												foreach($sql as $row){ 
													$id = $row["id"];$uid = $row["uid"];$btype = $row["btype"];$type = $row["type"];$num = $row["num"];$proc = $row["proc"];
													include "Templates/Auction/alt.tpl";
													if($btype<=11 or $btype==13){
														if($hero['dead']==1){
															$dis = ' disabled';
															$deadTitle = "<span class='itemNotMoveable'>".JR_HERODEADORNOTHERE."</span><br>";
														}else{
															$dis = '';
															$deadTitle = '';
														}
													}else{
														$dis = '';
														$deadTitle = '';
													}
																										////////////
													if($heroIsHere) {}else{
															$dis = ' disabled';
															$deadTitle = "<span class='itemNotMoveable'>".JR_HERODEADORNOTHERE."</span><br>";
													}
													//////////////

													if($num==1){$amount = '';}else{$amount = '('.$num.') ';}
													$outputList .= "<div id=\"inventory_".$inv."\" class=\"inventory draggable\">";
													$outputList .= "<div id=\"item_".$id."\" title=\"".$amount."".$name."||".$deadTitle."".$title."\" class=\"item item_".$gstr.'_'.$item."".$dis."\" style=\"position:relative;left:0px;top:0px;\">";
													$outputList .= "<div class=\"amount\">".$num."</div>";
													$outputList .= "</div>";
													$outputList .= '</div>';
													$inv++;	
												}
												echo $outputList;
												if($inv <= 12){
													for($i=$inv;$i<=(12);$i++){
														echo '<div id="inventory_'.$i.'" class="inventory draggable"></div>';
													}
												}else{
													echo '<div id="inventory_'.$inv.'" class="inventory draggable"></div>';
												}
												?>
												<div class="market">
													<a class="buy arrow" href="hero_auction.php?action=buy"><?php echo JR_HEROBUYITEMS; ?></a>
													<a class="sell arrow" href="hero_auction.php?action=sell"><?php echo JR_HEROSELLITEMS; ?></a>
													<div class="clear"></div>
												</div>
												<div class="clear"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="clear"></div>
								<div id="placeHolder"></div>
								<form id="HeroInventory" method="post" action="hero_inventory.php">
									<input type="hidden" name="a" value="inventory">
									<input type="hidden" name="id" value="<?php echo isset($_POST['id'])?$_POST['id']:''; ?>">
									<input type="hidden" name="amount" value="<?php echo isset($_POST['amount'])?$_POST['amount']:''; ?>">
									<input type="hidden" name="btype" value="<?php echo isset($_POST['btype'])?$_POST['btype']:''; ?>">
									<input type="hidden" name="type" value="<?php echo isset($_POST['type'])?$_POST['type']:''; ?>">
								</form>
								<script type="text/javascript">
									Travian.Game.Hero.Inventory = 
										new (new Class({
											b10: <?php echo '\'<p><div style="color:#F90">'
												.JR_HEROEXP.':'.$hero['experience'].'<br/>'.JR_HEROEXPGROW.': 10<br/>'
												.JR_HEROEXPWILLBE.':'.($hero['experience']+10).'<br/></div></p>\'';?>,
											
											b15: <?php echo '\'<table id="heroInventoryDataDialog" class="transparent" cellspacing="0" cellpadding="0"><tbody><tr class="rowBeforeUse"><th>'
												.JR_HEROCURRENTCP.'</th><td>'.$database->getUserField($session->uid, 'cp',0)
												.'</td></tr><tr class="rowUseValue"><th>'.JR_HEROCPVALUE
												.':</th><td class="displayUseValue">'.$database->getVSumField($session->uid, 'cp')
												.'</td></tr><tr class="rowAfterUse"><th>'.JR_HEROCPAFTERUSE
												.':</th><td class="displayAfterUse">'.($database->getUserField($session->uid, 'cp',0)+$database->getVSumField($session->uid, 'cp'))
												.'</td></tr></tbody></table>\'';?>,
											alreadyOpen: false,
											textSingle: <?php echo '\''.JR_HEROWANNAWEAR.'\''; ?>,
											textMulti: '<?php echo JR_HEROTIU; ?>: &lt;input class=\"text\" id=\"amount\" type=\"text\" value=\"\" /&gt;'.unescapeHtml(),
											initialize: function() {
												var $this = this;
												<?php
												$sql2 = $database->getHeroItem(0, $session->uid,0,0,0);
												foreach($sql2 as $row2){ 
													$id = $row2["id"];$num = $row2["num"];$btype = $row2["btype"];$type = $row2["type"];
													if($btype<=11 || $btype==13){
														if($hero['dead']==0){
															switch($btype){
																case 1: case 2: case 3: case 4: case 5: case 6: case 12: case 13: case 14:
															?>
																$('item_<?php echo $id; ?>').addEvent('click', function() { $this.showItem(<?php echo $id; ?>,<?php echo $num; ?>,<?php echo $btype; ?>,<?php echo $type; ?>);});															   
															<?php 
																break;
																case 7: case 8: case 9: case 10: case 11: case 15:
															?>
																$('item_<?php echo $id; ?>').addEvent('click', function() { $this.sellItem(<?php echo $id; ?>,<?php echo $num; ?>,<?php echo $btype; ?>,<?php echo $type; ?>);});
															<?php
																break;
															}
														}
													}else{
														?>
														$('item_<?php echo $id; ?>').addEvent('click', function() { $this.sellItem(<?php echo $id; ?>,<?php echo $num; ?>,<?php echo $btype; ?>,<?php echo $type; ?>);});
														<?php
													}
												}
												?>
											},
											showItem: function (id, amount, btype, type){
												var $this = this;
												$('HeroInventory').id.value = id;
												$('HeroInventory').amount.value = amount;
												$('HeroInventory').btype.value = btype;
												$('HeroInventory').type.value = type;
												$('HeroInventory').submit();
											},
											sellItem: function (id, amount, btype, type){
												var html = '';
												var $this = this;
												if (this.alreadyOpen){
													return;
												}
												this.alreadyOpen = true;
												$('HeroInventory').id.value = id;
												$('HeroInventory').amount.value = amount;
												$('HeroInventory').btype.value = btype;
												$('HeroInventory').type.value = type;
												if (amount == 1){
													if(btype == 10){
														html = $this.textSingle;
														html += this.b10;
													}else
													if(btype == 15){
														html = $this.textSingle;
														html += this.b15;
													}else{
														html = $this.textSingle;
													}
												}else{
													if(btype == 10){
														exp_a = '<?php echo $hero['experience']; ?>';
														exp_b = amount*10;
														exp_total = <?php echo $hero['experience']; ?>+exp_b;
														html = $this.textMulti;
														html += '<table id="heroInventoryDataDialog" class="transparent" cellspacing="0" cellpadding="0"><tbody><tr class="rowBeforeUse"><th><?php echo JR_HEROEXP; ?>:</th><td>'+exp_a+'</td></tr><tr class="rowUseValue"><th><?php echo JR_HEROEXPGROW; ?>:</th><td class="displayUseValue">'+exp_b+'</td></tr><tr class="rowAfterUse"><th><?php echo JR_HEROEXPWILLBE; ?>:</th><td class="displayAfterUse">'+exp_total+'</td></tr></tbody></table>';

													}else
													if(btype == 15){
														cp = '<?php echo $database->getUserField($session->uid, 'cp',0); ?>';
														cp_b = (cp*amount);
														cp_total = <?php echo $database->getUserField($session->uid, 'cp',0); ?>+cp_b;
														html = $this.textMulti;
														html += '<table id="heroInventoryDataDialog" class="transparent" cellspacing="0" cellpadding="0"><tbody><tr class="rowBeforeUse"><th><?php echo JR_HEROCURRENTCP; ?>:</th><td>'+cp+'</td></tr><tr class="rowUseValue"><th><?php echo JR_HEROCPVALUE; ?>:</th><td class="displayUseValue">'+cp_b+'</td></tr><tr class="rowAfterUse"><th><?php echo JR_HEROCPAFTERUSE; ?>:</th><td class="displayAfterUse">'+cp_total+'</td></tr></tbody></table>';
														
													}else{
														html = $this.textMulti;
													}
												}
												html.dialog({
													relativeTo:			$('content'),
													elementFoucs:		'inventoryAmount',
													buttonTextOk:		'<?php echo JR_OK; ?>',
													buttonTextCancel:	'<?php echo JR_CANCEL; ?>',
													title:				'<?php echo JR_CONSUMPTION; ?>',
													onOpen: function(dialog, contentElement){
														if ($('amount')){
															$('amount').value = amount;
															$('amount').addEvent('change', function(){
																$('HeroInventory').amount.value = $('amount').value;
															});
														}
													},
													onOkay: function(dialog, contentElement){
														if ($('amount')){
															$('HeroInventory').amount.value = $('amount').value;
														}
														$('HeroInventory').submit();
													},
													onClose: function(dialog, contentElement){
														$this.alreadyOpen = false;
													}
												});
											}
										}));
									</script>

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


