<div class="boxes villageList production">
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
	<table id="production" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="4"> <?php echo PROD_HEADER; ?> </th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="ico">
				<div><img class="r1Big" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" /></div>
			</td>
			<td class="res"><?php echo LUMBER; ?>:</td>
			<td class="num"><?php echo $village->getProd("wood"); ?></td>
		</tr>
		<tr>
			<td class="ico">		
				<div><img class="r2Big" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" /></div>
			</td>
			<td class="res"><?php echo CLAY; ?>:</td>
			<td class="num"><?php echo $village->getProd("clay"); ?></td>
		</tr>
		<tr>
			<td class="ico">
				<div>					<img class="r3Big" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" />									</div>
			</td>
			<td class="res">				<?php echo IRON; ?>:			</td>
			<td class="num">				<?php echo $village->getProd("iron"); ?>			</td>
		</tr>
		<tr>
			<td class="ico">
				<div>					<img class="r4Big" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" />									</div>
			</td>
			<td class="res">				<?php echo CROP; ?>:			</td>
			<td class="num">				<?php echo $village->getProd("crop"); ?>‏			</td>
		</tr>
	</tbody>
</table>

<div>
	<button  type="button" value="‏25%‏" id="button5229e52541034REMOVE" onClick="window.fireEvent('startPaymentWizard', {data:{activeTab: 'pros'}}); return false;" class="gold productionBoostButton" title="<?=MORE_INFO_25_BUTTON?>">
	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">‏&#x202e;&#43;&#x202d;25&#x202c;&#37;&#x202c;‏</div>
	</div>
</button>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
	if($('button5229e52541034'))
	{
		$('button5229e52541034').addEvent('click', function ()
		{
			window.fireEvent('buttonClicked', [this, {"type":"button","value":"\u200f\u0026#x202e;\u0026#43;\u0026#x202d;25\u0026#x202c;\u0026#37;\u0026#x202c;\u200f","name":"","id":"button5229e52541034","class":"gold productionBoostButton","title":"\u0645\u0639\u0644\u0648\u0645\u0627\u062a \u0625\u0636\u0627\u0641\u064a\u0629 \u062d\u0648\u0644 \u0645\u064a\u0632\u0629 \u0632\u064a\u0627\u062f\u0629 \u0627\u0644\u0627\u0646\u062a\u0627\u062c\u064a\u0629","confirm":"","onclick":"","productionBoostDialog":{"infoIcon":"http:\/\/t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer"}}]);
		});
	}
	});
</script>
</div>
	</div>
</div>