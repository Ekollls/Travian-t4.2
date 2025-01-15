<?php
$hero = $database->getHero($session->uid);
$heroface = $database->getHeroFace($session->uid);
$userarray = $database->getUser($session->uid, 1);
if($session->tribe == 1){
	$ttitle=TRIBE1; 
}elseif($session->tribe == 2){
	$ttitle=TRIBE2;
}elseif($session->tribe == 3){
	$ttitle=TRIBE3;
}else{
	$ttitle=TRIBE1;
}
$aid = $session->alliance;
$allianceinfo = $database->getAlliance($aid);
?>


<div id="sidebarBeforeContent" class="sidebar beforeContent">
	<div id="sidebarBoxHero" class="sidebarBox toggleable expanded ">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
				<button id="heroImageButton" onclick="window.location.href='hero_inventory.php';" class="heroImageButton " type="button">
		<img class="heroImage" src="hero_image.php?uid=<?php echo $session->uid; ?>&size=inventory&<?php echo $hero['hash']; ?>" alt="???">
	</button>
	<div class="playerName">
	<img src="img/x.gif" class="nation nation<?php echo $session->tribe; ?>" alt="<?php switch($session->tribe){
	case 1: 	echo TRIBE1; break;
	case 2: 	echo TRIBE2; break;
	case 3: 	echo TRIBE3; break;

	} ?>"><?php echo $session->username; ?></div>
	<button type="button" id="button5225ee283b159" class="layoutButton auctionWhite green  " onclick="return false;">
		<div class="button-container addHoverClick ">
			<img src="img/x.gif" alt="">
		</div>
		</button>

	<script type="text/javascript">
				window.addEvent('domready', function()
				{
					var button = $('button5225ee283b159');
					if (button)
					{
						var titleFunction = function()
						{
							button.removeEvent('mouseenter', titleFunction);
							Travian.Game.Layout.loadLayoutButtonTitle(button, 'hero', 'auctionWhite');
						};
						button.addEvent('mouseenter', titleFunction);
					}
				});
		
		if($('button5225ee283b159'))
		{
			$('button5225ee283b159').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":true,"boxId":"hero","disabled":false,"speechBubble":"","class":"","id":"button5225ee283b159","redirectUrl":"hero_auction.php","redirectUrlExternal":""}]);
			});
		}
	</script><button type="button" id="button5225ee283b28a" class="layoutButton adventureWhite green  " onclick="return false;">
		<div class="button-container addHoverClick ">
			<img src="img/x.gif" alt="">
		</div>
		<?php
		$adventures = $database->query_return("SELECT * FROM ". TB_PREFIX ."adventure WHERE `uid`='".$session->uid."' AND `end` = 0");
		if(count($adventures) > 0){
		?>	
		<div class="speechBubbleContainer ">
			<div class="speechBubbleBackground">
				<div class="start">
					<div class="end">
						<div class="middle"></div>
					</div>
				</div>
			</div>
			<div class="speechBubbleContent"><?php echo count($adventures); ?></div>
		</div>
	<?php } ?>
	<div class="clear"></div>	</button>

	<script type="text/javascript">
				window.addEvent('domready', function()
				{
					var button = $('button5225ee283b28a');
					if (button)
					{
						var titleFunction = function()
						{
							button.removeEvent('mouseenter', titleFunction);
							Travian.Game.Layout.loadLayoutButtonTitle(button, 'hero', 'adventureWhite');
						};
						button.addEvent('mouseenter', titleFunction);
					}
				});
		
		if($('button5225ee283b28a'))
		{
			$('button5225ee283b28a').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":true,"boxId":"hero","disabled":false,"speechBubble":"<?php echo count($adventures); ?>","class":"","id":"button5225ee283b28a","redirectUrl":"hero_adventure.php","redirectUrlExternal":""}]);
			});
		}
	</script>		</div>
	<?php
	$herodata = mysql_fetch_array($database->query("SELECT * FROM ". TB_PREFIX ."hero WHERE `uid`='".$session->uid."'"));

	?>
			<div class="innerBox content">
				<div class="heroStatusMessage">
					<?php
					if($herodata['dead']==1){
						$healtstat = '101';
						$status = HERO_DIED;
					}
					elseif($herodata['dead']==0 && $herodata['health']<100){
						$healtstat = '101Regenerate';
						$status = HERO_DIED;
					}
					elseif($herodata['dead']==0 && $herodata['health']==100){
						$healtstat = '100';
						$status = HERO_HEALTHY;
					}
	$units = mysql_fetch_array($database->query("SELECT * FROM ". TB_PREFIX ."units WHERE `vref`='".$herodata['wref']."'"));
	if($herodata['dead']==0){
		if($units['hero']!=0){
			$position = Elanat_dorf1;
		}
		elseif($units['hero']==0){
			$position = OUT_OF_HOME;
		}
	}
	else{
		$position = HERO_DIED;
	}

		?>

				
		<img alt="<?php echo $status; ?>" src="img/x.gif" class="heroStatus<?php echo $healtstat; ?>">
		<?php echo $position; ?></div>

	<div class="progressBars">
		<div class="heroHealthBarBox alive">
			<img src="img/x.gif" class="injury" alt="سلامتی">
			<div class="bar" style="width:<?php echo $herodata['health']; ?>%">&nbsp;</div>
		</div>

		<div class="heroXpBarBox">
			<img src="img/x.gif" class="iExperience" alt="تجربه">
			<div class="bar" style="width:<?php 
	if($herodata['level']==0){
		echo 0;
	}elseif($herodata['level']<100){
		echo round(100*($herodata['experience'] - $hero_levels[$herodata['level']-1]) / ($hero_levels[$herodata['level']] - $hero_levels[$herodata['level']-1])); 
	} else {
		echo HEROFULLLVL;
	}
									?>%">&nbsp;</div>
		</div>
	</div>		</div>
			<div class="innerBox footer">
					<button type="button" class="toggle" onclick="">
			<div class="button-container addHoverClick "></div>
		</button>

		<script type="text/javascript">
			window.addEvent('domready', function()
			{
				Travian.Translation.add(
				{
					'hero_collapsed': 'مشاهده اطلاعات بیشتر',
					'hero_expanded': 'پنهان کردن اطلاعات'
				});

				var box = $('sidebarBoxHero');
				box.down('button.toggle').addEvent('click', function(e)
				{
					Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'hero');
				});
			});
		</script>
			</div>
		</div>
	</div>							
	<div id="sidebarBoxAlliance" class="sidebarBox   ">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
				<button type="button" id="button5225ee283d5ac" class="layoutButton embassyWhite green <?php if(!$session->alliance) echo "disabled"?>" onclick="return false;">
		<div class="button-container addHoverClick">
			<img src="img/x.gif" alt="">
		</div>
		</button>

	<script type="text/javascript">
				window.addEvent('domready', function()
				{
					var button = $('button5225ee283d5ac');
					if (button)
					{
						var titleFunction = function()
						{
							button.removeEvent('mouseenter', titleFunction);
							Travian.Game.Layout.loadLayoutButtonTitle(button, 'alliance', 'embassyWhite');
						};
						button.addEvent('mouseenter', titleFunction);
					}
				});
		
		if($('button5225ee283d5ac'))
		{
			$('button5225ee283d5ac').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":true,"boxId":"alliance","disabled":true,"speechBubble":"","class":"","id":"button5225ee283d5ac","redirectUrl":"allianz.php?s=3","redirectUrlExternal":""}]);
			});
		}
	</script><button type="button" id="button5225ee283d789" class="layoutButton allianceForumWhite green  <?php if(!$session->alliance) echo "disabled"; ?> " onclick="return false;">
		<div class="button-container addHoverClick">
			<img src="img/x.gif" alt="">
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5225ee283d789'))
		{
			$('button5225ee283d789').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"","disabled":true,"speechBubble":"","class":"","id":"button5225ee283d789","redirectUrl":"allianz.php?s=2","redirectUrlExternal":""}]);
			});
		}
	</script><button type="button" id="button5225ee283d8f8" class="layoutButton overviewWhite green <?php if(!$session->alliance) echo "disabled"; ?> " onclick="return false;">
		<div class="button-container addHoverClick ">
			<img src="img/x.gif" alt="">
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5225ee283d8f8'))
		{
			$('button5225ee283d8f8').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"alliance","disabled":true,"speechBubble":"","class":"","id":"button5225ee283d8f8","redirectUrl":"allianz.php?s=4","redirectUrlExternal":""}]);
			});
		}
	</script><div class="clear"></div>

	<div class="boxTitle">
	<?php
	if($session->alliance == 0){ 
echo Ally_dorf1;
	}
	else{
		echo "<div class='sideInfoAlly'><a class='signLink' href='allianz.php' title='".SIDEINFO_ALLIANCE."'><span class='wrap'>".$allianceinfo['tag']."</span></a><a href='allianz.php?s=2' class='crest' title='".SIDEINFO_ALLY_FORUM."'><img src='img/x.gif'></a></div>";
	}
	?>
	</div>
			</div>
			<div class="innerBox content">
						</div>
			<div class="innerBox footer">
						</div>
		</div>
	</div>
<?php 
$i = 0;
$timestamp = $database->isDeleting($session->uid);
$displayarray = $database->getUser($session->uid,1);
$conf = $database->config();
$first = '';
if($displayarray['protect'] > time()){
$i++;
if($first == ''){
$first = 'protect';
}
}
elseif($timestamp) {
$i++;
if($first == ''){
$first = 'delete';
}
}
if($displayarray['plus'] > time()){
$i++;
if($first == ''){
$first = 'plus';
}
}
if($conf['newsbox3']==1){
$i++;
if($first == ''){
$first = 'news';
}
}
if($i > 0){
?>
	<div id="sidebarBoxInfobox" class="sidebarBox toggleable expanded">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
				<div class="boxTitle"><?php echo infobox_desc_text_1; ?></div>
				<span class="messageShortInfo">
<?php 
echo $i;
?>
					‎‭‭‬×‬‎<img class="messages" src="img/x.gif" alt="Total messages: 2">
				</span>
			</div>
			<div class="innerBox content">
				<ul>
<?php 
$k = 0;
if($displayarray['protect'] > time()){
$k++;
	$uurover=$generator->getTimeFormat($displayarray['protect']-time());
?>
					<li id="infoID_<?php echo $i; ?>"<?php if($first == 'protect'){ echo "  class=\"firstElement\""; }?>><?php echo sprintf(PROTECTION_TIME,$uurover);?></li>
<?php
}
elseif($timestamp) {
$k++;
	$time=$generator->getTimeFormat(($timestamp-time()));
?>
					<li id="infoID_<?php echo $i; ?>"<?php if($first == 'delete'){ echo "  class=\"firstElement\""; }?>><?php echo sprintf(ACCOUNT_DELETION,$time);?></li>
<?php
}
if($displayarray['plus'] > time()){
$k++;
	$uurover=$generator->getTimeFormat($displayarray['plus']-time());
?>
					<li id="infoID_<?php echo $i; ?>"<?php if($first == 'plus'){ echo "  class=\"firstElement\""; }?>><?php echo sprintf(PLUS_TIME_ENABLE,round(($displayarray['plus']-time())/3600,1));?>
<button type="button" value="extend" id="button5236e9e89e568" class="gold " coins="10">
	<div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?=RENEW?><img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">10</span></div>
	</div>
</button>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
	if($('button5236e9e89e568'))
	{
		$('button5236e9e89e568').addEvent('click', function ()
		{
			window.fireEvent('buttonClicked', [this, {"type":"button","value":"extend","name":"","id":"button5236e9e89e568","class":"gold ","title":"","confirm":"","onclick":"","coins":10,"wayOfPayment":{"featureKey":"Plus","context":"infobox"}}]);
		});
	}
	});
</script>					
					</li>
<?php
}
?>
				</ul>
			</div>
			<div class="innerBox footer">
				<button type="button" class="toggle" onclick="">
					<div class="button-container addHoverClick "></div>
				</button>
		<script type="text/javascript">
			window.addEvent('domready', function()
			{
				Travian.Translation.add(
				{
					'infobox_collapsed': 'نشان دادن پیام',
					'infobox_expanded': 'نشان ندادن پیام'
				});

				var box = $('sidebarBoxInfobox');
				box.down('button.toggle').addEvent('click', function(e)
				{
					Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'infobox');
				});
			});
		</script>

	<script type="text/javascript">
			window.addEvent('domready', function()
			{
				Travian.Game.Layout.setInfoboxItemsRead();
			});
	</script>		
			</div>
		</div>
	</div>	
<?php } ?>
	<div id="sidebarBoxLinklist" class="sidebarBox   ">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
				<button type="button" id="button5225ee283eff4" class="layoutButton editBlack gold  " onclick="window.location='spieler.php?s=2'; return false;">
		<div class="button-container addHoverClick ">
			<img src="img/x.gif" alt="">
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5225ee283eff4'))
		{
			$('button5225ee283eff4').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"gold","onclick":"return false;","loadTitle":false,"boxId":"","disabled":false,"speechBubble":"","class":"","id":"button5225ee283eff4","redirectUrl":"","redirectUrlExternal":"","plusDialog":{"featureKey":"linkList","infoIcon":"http:\/\/t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer"},"title":"\u0642\u0627\u0626\u0645\u0629 \u0627\u0644\u0631\u0648\u0627\u0628\u0637 || \u062a\u0631\u0627\u0641\u064a\u0627\u0646 \u0628\u0644\u0627\u0633 \u064a\u062e\u0648\u0651\u0644\u0643 \u0639\u0645\u0644 \u0642\u0627\u0626\u0645\u0629 \u0631\u0648\u0627\u0628\u0637"}]);
			});
		}
	</script><div class="clear"></div>
	<div class="boxTitle"><?php echo dorf1_links; ?></div>		</div>
			<div class="innerBox content">
					<div class="linklistNotice">
					<?php 
					if($session->plus) {
						$links = $database->getLinks($session->uid);
						$query = count($links);
						if($query>0){
							echo '<div id="linkList" class="listing"><div class="list none">';
							foreach($links as $link) {
							   echo '<ul><li class="entry">'; 
							   echo '<a href="'.$link['url'].'" title="'.$link['name'].'">'.$link['name'].'</a></li></ul>';
							}
							echo '<div class="pager"><a href="#" class="back" style="display: none; "></a><a href="#" class="next" style="display: none; "></a></div></div>';
							echo '<script type="text/javascript">new Travian.Game.PageScroller({elementPrev: $(\'linkList\').down(\'a.back\'),elementNext: $(\'linkList\').down(\'a.next\'),elementList: $(\'linkList\').down(\'div.list\'),elementBackground: $(\'linkList\').down(\'div.list\')});</script></div>';
						}
					}else{
						echo Link_desc_text_1;
					}
					?>					
					</div>
			</div>
			<div class="innerBox footer">
						</div>
		</div>
	</div>												
<div class="clear"></div>
					</div>