<?php
$wood = round(($village->awood * 100) / $village->maxstore);
$clay = round(($village->aclay * 100) / $village->maxstore);
$iron = round(($village->airon * 100) / $village->maxstore);
$crop = round(($village->acrop * 100) / $village->maxcrop);

?>
<ul id="stockBar">
	<li id="stockBarWarehouseWrapper" class="stock" title="انبار">
		<img class="warehouse" src="img/x.gif" alt="انبار" />
		<span class="value" id="stockBarWarehouse"><?php echo $village->maxstore; ?></span>
	</li>
			<li id="stockBarResource1" class="stockBarButton" title="چوب||تولیدات : <?php echo $village->getProd("wood"); ?>">
			<div class="begin"></div>
			<div class="middle">
				<img class="res r1Big" src="img/x.gif" alt="چوب"/>
								<span id="l1" class="value"><?php echo round($village->awood); ?></span>
				<div class="barBox">
										<div id="lbar1" class="bar" style="width:<?php echo $wood;?>%;"></div>
				</div>
				<a href="production.php?t=1" title="چوب||تولیدات : <?php echo $village->getProd("wood"); ?>"><img src="img/x.gif" alt="" /></a>
			</div>
			<div class="end"></div>
		</li>
			<li id="stockBarResource2" class="stockBarButton" title="خشت||تولیدات : <?php echo $village->getProd("clay"); ?>">
			<div class="begin"></div>
			<div class="middle">
				<img class="res r2Big" src="img/x.gif" alt="خشت"/>
								<span id="l2" class="value"><?php echo round($village->aclay); ?></span>
				<div class="barBox">
										<div id="lbar2" class="bar" style="width:<?php echo $clay;?>%;"></div>
				</div>
				<a href="production.php?t=2" title="خشت||تولیدات : <?php echo $village->getProd("clay"); ?>"><img src="img/x.gif" alt="" /></a>
			</div>
			<div class="end"></div>
		</li>
			<li id="stockBarResource3" class="stockBarButton" title="آهن||تولیدات : <?php echo $village->getProd("iron"); ?>">
			<div class="begin"></div>
			<div class="middle">
				<img class="res r3Big" src="img/x.gif" alt="آهن"/>
								<span id="l3" class="value"><?php echo round($village->airon); ?></span>
				<div class="barBox">
										<div id="lbar3" class="bar" style="width:<?php echo $iron;?>%;"></div>
				</div>
				<a href="production.php?t=3" title="آهن||تولیدات : <?php echo $village->getProd("iron"); ?>"><img src="img/x.gif" alt="" /></a>
			</div>
			<div class="end"></div>
		</li>
	
	<li id="stockBarGranaryWrapper" class="stock" title="انبار گندم">
		<img class="granary" src="img/x.gif" alt="انبار گندم" />
		<span class="value" id="stockBarGranary"><?php echo $village->maxcrop; ?></span>
	</li>

	
	<li id="stockBarResource4" class="stockBarButton">
		<div class="begin"></div>
		<div class="middle">
			<img class="res r4Big" src="img/x.gif" alt="گندم"/>
						<span id="l4" class="value"><?php echo round($village->acrop); ?></span>
			<div class="barBox">
								<div id="lbar4" class="bar" style="width:<?php echo $crop;?>%;"></div>
			</div>
			<a href="production.php?t=4" title=""><img src="img/x.gif" alt="" /></a>
		</div>
		<div class="end"></div>
	</li>

		<li id="stockBarFreeCropWrapper" class="stockBarButton r5">
		<div class="begin"></div>
		<div class="middle">
			<img class="res r5Big" src="img/x.gif" alt="مصرف گندم"/>
			<span id="stockBarFreeCrop" class="value"><?php echo ($village->pop+$technology->getUpkeep($village->unitall,0)); ?></span>
			<a href="production.php?t=5" title=""><img src="img/x.gif" alt="" /></a>
		</div>
		<div class="end"></div>
	</li>
	<li class="clear">&nbsp;</li>
</ul>


<?php
$totalproduction = $village->allcrop; // all crops + bakery + grain mill
$crop = floor($village->acrop);
?>


<script type="text/javascript">
	var resources = new Object();

	resources.production = {
		"l1": <?php echo $village->getProd("wood"); ?>,"l2": <?php echo $village->getProd("clay"); ?>,"l3": <?php echo $village->getProd("iron"); ?>,"l4": <?php echo $village->getProd("crop"); ?>,"l5": <?php echo ($village->pop+$technology->getUpkeep($village->unitall,0)); ?>	};
	resources.storage = {
		"l1": <?php echo $village->awood; ?>,"l2": <?php echo $village->aclay; ?>,"l3": <?php echo $village->airon; ?>,"l4": <?php echo $village->acrop; ?>	};
	resources.maxStorage = {
		"l1": <?php echo $village->maxstore; ?>,"l2": <?php echo $village->maxstore; ?>,"l3": <?php echo $village->maxstore; ?>,"l4": <?php echo $village->maxcrop; ?>	};

	$$('li.stockBarButton').each(function(element)
	{
		Travian.addMouseEvents(element, element);
	});

	var stockBarWarehouse   = $('stockBarWarehouse');
	var stockBarGranary     = $('stockBarGranary');
	var stockBarFreeCrop = $('stockBarFreeCrop');
	var numberFormatter = new Travian.Formatter({forceDecimal:false});

	stockBarWarehouse.set('html', numberFormatter.getFormattedNumber(parseInt(stockBarWarehouse.get('html'))));
	stockBarGranary.set('html', numberFormatter.getFormattedNumber(parseInt(stockBarGranary.get('html'))));
	stockBarFreeCrop.set('html', numberFormatter.getFormattedNumber(parseInt(stockBarFreeCrop.get('html'))));

</script>