<div id="goldSilver">
	<div class="gold">
		<img src="img/x.gif" alt="<?php echo HEADER_GOLD; ?>" title="<?php echo HEADER_GOLD; ?>" class="gold" onclick="window.fireEvent('startPaymentWizard', {data:{activeTab: 'pros'}}); return false;" />
		<span id="ajaxReplaceableGoldAmount_2" class="ajaxReplaceableGoldAmount"><?php echo "$session->gold"; ?></span>
	</div>
	<div class="silver">
		<a href="hero_auction.php"><img src="img/x.gif" alt="<?php echo HEADER_SILVER; ?>" title="<?php echo HEADER_SILVER; ?>" class="silver" /></a>
		<span class="ajaxReplaceableSilverAmount"><?php echo "$session->silver"; ?></span>
	</div>
</div>
	<ul id="outOfGame" class="RTL">
			<li class="profile">
			<a href="spieler.php">
				<img src="img/x.gif" alt="????? ???????">
			</a>
		</li>
<?php if($session->access == ADMIN){ ?>		<li class="options">
						<a href="admin.php">
					<img src="img/x.gif" alt="??????">
				</a>
				</li> <?php } ?>
		<li class="help">
			<a href="help.php">
				<img src="img/x.gif" alt="<?=HELP?>">
			</a>
		</li>
		<li class="logout ">
			<a href="logout.php">
				<img src="img/x.gif" alt="<?=LOGOUT?>">
			</a>
		</li>
		<li class="logout ">
        
			<select name="sellang" id="sellang" onchange="changeLanguage();">
				<option value="en" <?php if ($_SESSION['lang']=='en') echo 'selected="selected"';?>>English</option>
				<option value="fa" <?php if ($_SESSION['lang']=='fa') echo 'selected="selected"';?>>فارسی</option>
			</select>
        
		</li>
		<li class="clear">&nbsp;</li>
		
		
	</ul>

	
	<script type="text/javascript">
	$$('#outOfGame li.logout a').addEvent('click', function(){
		Travian.WindowManager.getWindows().each(function($dialog){
			Travian.WindowManager.unregister($dialog);
		});
	});
	</script>



