<div class="boxes buildingList">
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
			<?php 
			echo BUILDING_UPGRADING;
			?>
<div class="finishNow"><button type="button" value="<?php echo INSTANTCMLT; ?>" id="button526f68b2930cf" class="gold ">
	<div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo INSTANTCMLT; ?></div>
	</div>
</button>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
	if($('button526f68b2930cf'))
	{
		$('button526f68b2930cf').addEvent('click', function ()
		{
			window.fireEvent('buttonClicked', [this, {"type":"button","value":"<?php echo INSTANTCMLT; ?>","name":"","id":"button526f68b2930cf","class":"gold ","title":"More information about completing constructions immediately:","confirm":"","onclick":"","dialog":{"saveOnUnload":false,"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"data":{"cmd":"finishNowPopup"},"context":"finishNow","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=372#go2answer"}}]);
		});
	}
	});
</script>
</div>			
	<ul>		
				<?php 
				if(!isset($timer)) {
					$timer = 1;
				}
				foreach($building->buildArray as $jobs) {
					if($jobs['master'] == 0){
						echo "<li><a href=\"?d=".$jobs['id']."&a=0&c=$session->checker\">";
						echo "<img src=\"img/x.gif\" class=\"del\" title=\"cancel\" alt=\"cancel\" /></a><div class=\"name\">";
						echo constant('B'.$jobs['type'])." <span class=\"lvl\"> ".LVL." ".$jobs['level']."</span>";
						if($jobs['loopcon'] == 0) { $BuildFirst = $jobs['field']; }
						if($jobs['loopcon'] == 1) {
							echo ' '.WAITING_LOOP;
						}
						echo "</div><div class=\"buildDuration\">";
						echo sprintf(ENDDUR,"<span id=\"timer".$timer."\">"
							.$generator->getTimeFormat($jobs['timestamp']-time())
							."</span> ");
						echo " ".ENDAT.' '.date('H:i', $jobs['timestamp'])."</div></li><br>";
						$timer +=1;
					}else{
						echo "<li><a href=\"?d=".$jobs['id']."&a=0&c=$session->checker\">";
						echo "<img src=\"img/x.gif\" class=\"del\" title=\"cancel\" alt=\"cancel\" /></a><div class=\"name\">";
						echo constant('B'.$jobs['type'])."<span class=\"none\"> ".LVL." ".$jobs['level']."</span></div></li>";
					}
				} ?>
</ul>
</div>
</div>
<script type="text/javascript">var bld=[{"stufe":1,"gid":"1","aid":"3"}]</script>
