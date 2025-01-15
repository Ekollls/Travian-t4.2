<div class="cropBalanceContainer">
	<div class="productionBoostSpeechBubble">
		<div class="productionBoostResourceSpeechBubble">
	<div class="fluidSpeechBubble-container">
	<div class="fluidSpeechBubble">
		<div class="fluidSpeechBubble-tl"></div>
		<div class="fluidSpeechBubble-tr"></div>
		<div class="fluidSpeechBubble-tc"></div>
		<div class="fluidSpeechBubble-ml"></div>
		<div class="fluidSpeechBubble-mr"></div>
		<div class="fluidSpeechBubble-mc"></div>
		<div class="fluidSpeechBubble-bl"></div>
		<div class="fluidSpeechBubble-br"></div>
		<div class="fluidSpeechBubble-bc"></div>
		<div class="speechArrowBack"></div>
		<div class="fluidSpeechBubble-contents cf">
		<form id="fluidSpeechBubble" method="post" action="">
		<p><?=PRODUCTION_PROD_S5?><span class="bold"><?=($cropp1*SPEED*0.25)+(($hcropp+$hproduct)+$excropp+$cropp1+$ocropp)*SPEED?></span><?php if( $user['b4'] > time() ) { ?><br>25% تولیدات تقریبا تا <b><?=round(($user['b4']-time())/3600)?></b> ساعت دیگر ادامه دارد.<?php } ?></p>
        
			<div><?php if( $user['b4'] < time() ) { ?><button type="button" value="<?=ACTIVATE_NOW?>" id="button52fc8ff91b029" class="gold prosButton productionboostcrop" coins="5"><?php }else{ ?><button type="button" value="<?=RENEW?>" id="button52fc8ff91b029" class="gold prosButton productionboostcrop" coins="5"><?php } ?>
	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php if( $user['b4'] < time() ) { ?><?=ACTIVATE_NOW?><?php }else{ ?><?=RENEW?><?php } ?><img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">5</span></div>
	</div>
</button>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
	if($('button52fc8ff91b029'))
	{
		$('button52fc8ff91b029').addEvent('click', function ()
		{
			window.fireEvent('buttonClicked', [this, {"type":"button","value":"<?=ACTIVATE_NOW?>","name":"","id":"button52fc8ff91b029","class":"gold prosButton productionboostcrop","title":"<?=ACTIVATE_NOW?>\u0026lt;br \/\u0026gt;Bonus duration in days: \u0026lt;span class=\u0026quot;bold\u0026quot;\u0026gt;7\u0026lt;\/span\u0026gt;","confirm":"","onclick":"","coins":5,"wayOfPayment":{"featureKey":"productionboostCrop","context":"production"}}]);
		});
	}
	});
</script>
</div>
			<div class="productionBoostSpeechBubbleFurtherInfo">
				<p><?=PRODUCTION_PROD_S6?></p>
			</div></form></div>
	</div>
</div>
</div>	</div>
	<div class="balanceCropBalancePart">
	<table cellspacing="0" cellpadding="0" class="row_table_data">
		<tbody>
			<tr>
				<td>تولیدات ساختمان ها و آبادی ها</td>
				<td class="numberCell">18</td>
			</tr>
			<tr>
				<td>جمعیت و صف ساخت ساختمان</td>
				<td class="numberCell">&lrm;&#8237;-&#8237;2&#8236;&#8236;&lrm;</td>
			</tr>
			<tr class="subTotal">
				<td class="bold">گندم آزاد</td>
				<td class="bold numberCell">16</td>
			</tr>
			<tr>
				<td>ساختمان های در صف ساخت</td>
				<td class="numberCell"><?=$upkeep?></td>
			</tr>
			<tr>
				<td><?=PRODUCTION_HP?></td>
				<td class="numberCell"><?=($hcropp+$hproduct)*SPEED?></td>
			</tr>
			<tr class="<?php if($bcropp > 0){}else{echo'inactive';};?>">
				<td>+25% تولیدات<?php if($bcropp > 0){}else{echo' ( غیر فعال )';};?></td>
				<td class="numberCell"><?=$cropp1*SPEED*0.25?></td>
			</tr>
			<tr class="subTotal">
				<td class="bold"><?=PRODUCTION_BALANCE?> =</td>
				<td class="bold numberCell">46</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="balanceCropBalancePart balanceTroops">
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
	<div class="boxes-contents cf"><div class="switchDown  " id="ownBalanceTroops">
	<div class="switchDownCloseStateContainer ">
		<div class="switchClosed headline">مصرف سرباز های خودی</div>
		<div class="switchDownContent">
			<span class="bold">&lrm;&#8237;-&#8237;6&#8236;&#8236;&lrm;</span>		</div>
		<div class="clear"></div>
	</div>
	<div class="switchDownOpenStateContainer hide">
		<div class="switchOpened headline">مصرف سرباز های خودی</div>
		<div class="clear"></div>
		<div class="switchDownContent">
			<table>
	<tbody>
		<tr>
			<td class="troopLabel">- در دهکده</td>
			<td class="numberCell">&lrm;&#8237;-&#8237;6&#8236;&#8236;&lrm;</td>
		</tr>
		<tr>
			<td class="troopLabel">- در آبادی</td>
			<td class="numberCell">&lrm;&#8237;&#8237;0&#8236;&#8236;&lrm;</td>
		</tr>
				<tr>
			<td class="troopLabel">- در راه</td>
			<td class="numberCell">&lrm;&#8237;&#8237;0&#8236;&#8236;&lrm;</td>
		</tr>
		<tr>
			<td class="troopLabel">- زندانی ها</td>
			<td class="numberCell">&lrm;&#8237;&#8237;0&#8236;&#8236;&lrm;</td>
		</tr>
				<tr class=" inactive">
			<td class="troopLabel">جایزه کتیبه ها</td>
			<td class="numberCell">0</td>
		</tr>
		        		<tr class="subTotal">
			<td class="bold"><?=PRODUCTION_TOTAL?></td>
			<td class="numberCell bold">&lrm;&#8237;-&#8237;6&#8236;&#8236;&lrm;</td>
		</tr>
	</tbody>
</table>		</div>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
		$$('#ownBalanceTroops').each(function(element)
		{
			new Travian.Game.SwitchDown(element);
		});
	});
</script>	</div>
</div></div><div class="balanceCropBalancePart balanceTroops">
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
	<div class="boxes-contents cf"><div class="switchDown  " id="foraignBalanceTroops">
	<div class="switchDownCloseStateContainer ">
		<div class="switchClosed headline">مصرف سرباز های غیر خودی</div>
		<div class="switchDownContent">
			<span class="bold">&lrm;&#8237;&#8237;0&#8236;&#8236;&lrm;</span>		</div>
		<div class="clear"></div>
	</div>
	<div class="switchDownOpenStateContainer hide">
		<div class="switchOpened headline">مصرف سرباز های غیر خودی</div>
		<div class="clear"></div>
		<div class="switchDownContent">
			<table>
	<tbody>
		<tr>
			<td class="troopLabel">- در دهکده</td>
			<td class="numberCell">&lrm;&#8237;&#8237;0&#8236;&#8236;&lrm;</td>
		</tr>
		<tr>
			<td class="troopLabel">- در آبادی</td>
			<td class="numberCell">&lrm;&#8237;&#8237;0&#8236;&#8236;&lrm;</td>
		</tr>
				<tr class=" inactive">
			<td class="troopLabel">جایزه کتیبه ها</td>
			<td class="numberCell">0</td>
		</tr>
		        		<tr class="subTotal">
			<td class="bold"><?=PRODUCTION_TOTAL?></td>
			<td class="numberCell bold">&lrm;&#8237;&#8237;0&#8236;&#8236;&lrm;</td>
		</tr>
	</tbody>
</table>		</div>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
		$$('#foraignBalanceTroops').each(function(element)
		{
			new Travian.Game.SwitchDown(element);
		});
	});
</script>	</div>
</div></div><div class="balanceCropBalancePart">
	<table cellspacing="0" cellpadding="0" class="row_table_data">
		<tbody>
			<tr class="Total">
				<td class="bold">تعادل گندم = </td>
				<td class="bold numberCell"><?=$upkeep?></td>
			</tr>
		</tbody>
	</table>
</div><div class="clear"></div>
</div>								<div class="clear"></div>
