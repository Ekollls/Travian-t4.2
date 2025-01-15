<div class="productionContainer">
	<div class="productionPerHour">
	<h4><?=PROD_HEADER?>:</h4>
	<table cellspacing="1" cellpadding="1" class="row_table_data">
		<thead>
			<tr>
				<td><?=PRODUCTION_FIELD?></td>
				<td><?=PRODUCTION?></td>
				<td><?=PRODUCTION_BONUS2?></td>
			</tr>
		</thead>
		<tbody>
						<tr><?php
							$q = 'SELECT * FROM '.TB_PREFIX .'vdata,'.TB_PREFIX .'fdata WHERE '.TB_PREFIX .'vdata.wref='.$wref.' AND '.TB_PREFIX .'vdata.wref='.TB_PREFIX .'fdata.vref';
	$queryResult = mysql_query($q);
	$row = mysql_fetch_assoc($queryResult);

$prodSum = 0;
for($i=1;$i<=38;$i++) {
	if($row['f'.$i.'t'] == 3) { 
		$prodSum += $bid3[$row['f'.$i]]['prod']*SPEED; 
		echo '<tr><td>'.PRODUCTION_PROD_S3.' '.$row['f'.$i].'</td><td class="numberCell">'.$bid3[$row['f'.$i]]['prod']*SPEED.'</td><td class="numberCell">'. ((($bid6[$ifound]['attri'])+($oiron))/100 * $bid3[$row['f'.$i]]['prod']*SPEED + ($oiron*SPEED) ).'</td></tr>';
	}
}
?>
						<tr class="productionSum">
				<td><?=PRODUCTION_TOTAL?></td>
				<td class="numberCell"><?=$prodSum?></td>
				<td class="numberCell"><?=($exironp+$oironp)*SPEED?></td>
			</tr>
		</tbody>
	</table>
</div>
	<div class="productionBoostSpeechBubble">
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
		<div class="fluidSpeechBubble-contents cf"><h5><?=PRODUCTION_BONUS?>:</h5>
<table cellspacing="0" cellpadding="0" class="row_table_data">
	<tbody>
				<tr class="inactive">
			<td><?=PRODUCTION_PROD_T4?> <?=$ifound?>:</td>
			<td class="numberCell"><?=0+$bid6[$ifound]['attri']?>%</td>
		</tr>
				<tr class="inactive">
			<td><?=PRODUCTION_PROD_T2?> (x<?=count($oasisowned)?>)</td>
			<td class="numberCell"><?=$oiron?>%</td>
		</tr>
		<tr>
			<td class="bold"><?=PRODUCTION_TOTAL_BONUS?></td>
			<td class="bold numberCell"><?=($bid6[$ifound]['attri'])+($oiron)?>%</td>
		</tr>
	</tbody>
</table></div>
	</div>
</div>
	</div>
</div>

<div class="Total productionContainer">
	<div class="productionPerHourTotal">
	<h4><?=PRODUCTION_PROD_TOTAL?></h4>
	<table cellspacing="0" cellpadding="0" class="row_table_data">
		<tbody>
			<tr>
				<td><?=PRODUCTION?></td>
				<td class="numberCell"><?=$ironp1*SPEED?></td>
			</tr>
			<tr>
				<td><?=PRODUCTION_BONUS2?></td>
				<td class="numberCell"><?=($exironp+$oironp)*SPEED?></td>
			</tr>
			<tr>
				<td><?=PRODUCTION_HP?></td>
				<td class="numberCell"><?=($hironp+$hproduct)*SPEED?></td>
			</tr>
			<tr class="subTotal">
				<td class="bold"><?=PRODUCTION_BALANCE?> =</td>
				<td class="numberCell bold"><?=(($hironp+$hproduct)+$exironp+$ironp1+$oironp)*SPEED?></td>
			</tr>
			
			<tr class="<?php if($bironp > 0){}else{echo'inactive';};?>">
				<td><?=PRODUCTION_P25?><?php if($bironp > 0){}else{echo' ( '.PRODUCTION_INACTIVE.' )';};?></td>
				<td class="numberCell"><?=$ironp1*SPEED*0.25?></td>
			</tr>
			<tr class="Total bold">
				<td class="bold"><?=PRODUCTION_TOTAL?></td>
				<td class="numberCell bold"><?=$ironp?></td>
			</tr>
		</tbody>
	</table>
</div>	
<?php
if(/*$bironp <= 0*/ true){
?>

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
		<p><?=PRODUCTION_PROD_S5?><span class="bold"><?=($ironp1*SPEED*0.25)+(($hironp+$hproduct)+$exironp+$ironp1+$oironp)*SPEED?></span><?php if( $user['b3'] > time() ) { ?><?php echo sprintf(PRODUCTION_REMAINING_PRODUCTION,round(($user['b3']-time())/3600));?><?php } ?></p>
        
			<div><?php if( $user['b3'] < time() ) { ?><button type="button" value="<?=ACTIVATE_NOW?>" id="button52fc8ff91b029" class="gold prosButton productionboostiron" coins="5"><?php }else{ ?><button type="button" value="<?=RENEW?>" id="button52fc8ff91b029" class="gold prosButton productionboostiron" coins="5"><?php } ?>
	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php if( $user['b3'] < time() ) { ?><?=ACTIVATE_NOW?><?php }else{ ?><?=RENEW?><?php } ?><img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">5</span></div>
	</div>
</button>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
	if($('button52fc8ff91b029'))
	{
		$('button52fc8ff91b029').addEvent('click', function ()
		{
			window.fireEvent('buttonClicked', [this, {"type":"button","value":"<?=ACTIVATE_NOW?>","name":"","id":"button52fc8ff91b029","class":"gold prosButton productionboostiron","title":"<?=ACTIVATE_NOW?>\u0026lt;br \/\u0026gt;Bonus duration in days: \u0026lt;span class=\u0026quot;bold\u0026quot;\u0026gt;7\u0026lt;\/span\u0026gt;","confirm":"","onclick":"","coins":5,"wayOfPayment":{"featureKey":"productionboostIron","context":"production"}}]);
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
</div><?php } ?></div>								<div class="clear"></div>

