<div class="contentNavi tabNavi">
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == buy) { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=buy"><span class="tabItem"><?php echo BUY;?></span></a></div>
				</div>
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == sell) { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=sell"><span class="tabItem"><?php echo SELL;?></span></a></div>
				</div>
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == bids) { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=bids"><span class="tabItem"><?php echo BIDS;?></span></a></div>
				</div>
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == exchange) { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=exchange"><span class="tabItem"><?=EXCHANGEOFFICE?></span></a></div>
				</div><div class="clear"></div>
</div>