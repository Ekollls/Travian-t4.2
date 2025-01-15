<?php
$coor = $database->getCoor($village->wid);
?>
<?php
if(isset($_GET['d']) && isset($_GET['c'])) {
	if($generator->getMapCheck($_GET['d']) == $_GET['c']) {
        $wref = $_GET['d'];
        $coor = $database->getCoor($wref);
        $x = $coor['x'];
        $y = $coor['y'];
	}
}
else if(isset($_GET['x']) && isset($_GET['y'])) {
    $x = $_GET['x'];
    $y = $_GET['y'];
    $bigmid = $generator->getBaseID($y,$x);
}
else if(isset($_POST['xp']) && isset($_POST['yp'])){
	$x = $_POST['xp'];
    $y = $_POST['yp'];
    $bigmid = $generator->getBaseID($x,$y);
}
else {
    $y = $village->coor['y'];
	$x = $village->coor['x'];
    $bigmid = $village->wid;
}
?>
<div id="content" class="map">
								<h1 class="titleInHeader"><?=MAP?></h1>
<div class="map2">
	<div id="mapContainer">
		<div class="innerShadow">
			<div class="innerShadow-tl">
				<div class="innerShadow-tr">
					<div class="innerShadow-tc"></div>
				</div>
			</div>
			<div class="innerShadow-ml">
				<div class="innerShadow-mr"></div>
			</div>
			<div class="innerShadow-bl">
				<div class="innerShadow-br">
					<div class="innerShadow-bc"></div>
				</div>
			</div>
		</div>
		<div id="toolbar" class="toolbar">
	<div class="ml">
		<div class="mr">
			<div class="mc">
				<div class="contents">
					<div class="iconButton zoomIn" title="zoom in"></div>
					<div class="iconButton zoomOut" title="zoom out"></div>

										<div class="dropdown">
						<div class="dataContainer">
															<div class="entry display">100%</div>
							 								<div class="entry hide">50%</div>
							 								<div class="entry hide">8%</div>
							 						</div>
						<div class="iconButton dropDownImage" title="zoom level"></div>
						<div class="clear"></div>
					</div>

											<div style="display:none" class="iconButton iconRequireGold" id="iconFullscreen">
							<div class="iconButton viewFullGold" title="Larger map||For this feature you need Travian Plus activated." ></div>
						</div>
					
										<div class="iconButton iconRequireGold" id="iconCropfinder">
						<a href="cropfinder.php"><div class="iconButton linkCropfinder" title="<?=CROPFINDER?>"></div></a>
					</div>
					

					
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="bl">
		<div class="br">
			<div class="bc"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	Travian.Game.Map.Options.Toolbar.filterPlayer.checked = true;
	Travian.Game.Map.Options.Toolbar.filterAlliance.checked =  false;
</script>

<script type="text/javascript">window.addEvent('domready', function() { $('iconFullscreen').addEvent('click',function () {window.fireEvent("buttonClicked", [this, {"plusDialog":{"featureKey":"fullScreen","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"}}]);})});</script><script type="text/javascript">window.addEvent('domready', function() { $('iconCropfinder').addEvent('click',function () {window.fireEvent("buttonClicked", [this, {"goldclubDialog":{"featureKey":"cropFinder","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"}}]);})});</script>		<form id="mapCoordEnter" action="karte.php" method="get" class="toolbar">
	<div class="ml">
		<div class="mr">
			<div class="mc">
				<div class="contents">
					
					
			<div class="coordinatesInput">
				<div class="xCoord">
					<label for="xCoordInputMap">X:</label>
					<input maxlength="4" value="<?=$coor['x']?>" name="x" id="xCoordInputMap" class="text coordinates x " />
				</div>
				<div class="yCoord">
					<label for="yCoordInputMap">Y:</label>
					<input maxlength="4" value="<?=$coor['y']?>" name="y" id="yCoordInputMap" class="text coordinates y " />
				</div>
				<div class="clear"></div>
			</div>
							<button  type="submit" value="OK" id="button52f7f04c27a1e" class="green small">
	<div class="button-container addHoverClick" style="margin:1px -3px;">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?=GO?></div>
	</div>
</button>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
	if($('button52f7f04c27a1e'))
	{
		$('button52f7f04c27a1e').addEvent('click', function ()
		{
			window.fireEvent('buttonClicked', [this, {"type":"submit","value":"OK","name":"","id":"button52f7f04c27a1e","class":"green small","title":"","confirm":"","onclick":""}]);
		});
	}
	});
</script>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">window.addEvent('domready', function() { $('iconCropfinder').addEvent('click',function () {window.fireEvent("buttonClicked", [this, {"goldclubDialog":{"featureKey":"cropFinder","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"}}]);})});</script>		<div id="minimapContainer">
	<div class="background"></div>
	<div class="headline">
		<div class="title"><?=MINIMAP?></div>
		<div class="iconButton small"></div>
		<div class="clear"></div>
	</div>
	<div id="miniMap">
		<img class="map" style="width: 185px; height: 109px;" src="minimap.php" alt="<?=MINIMAP?>" />
	</div>

	<div class="bl">
		<div class="br">
			<div class="bc"></div>
		</div>
	</div>
</div>		<div id="outline">
	<div class="tl">
		<div class="tr">
			<div class="tc"></div>
		</div>
	</div>
	<div class="background"></div>
	<div id="mapMarks">
		<div class="headline">
			<div class="title"><?=GO_TO?></div>
			<div style="display:none;" class="iconButton small"></div>
			<div class="clear"></div>
		</div>
		<div class="tabContainer">
			<div class="tab">
				<div class="entry selected">
					<div class="tab-container">
						<div class="tab-position">
							<div class="tab-tl">
								<div class="tab-tr">
									<div class="tab-tc"></div>
								</div>
							</div>
							<div class="tab-ml">
								<div class="tab-mr">
									<div class="tab-mc"></div>
								</div>
							</div>
						</div>
						<div class="tab-contents">
							<a href="#" onclick="
								if (!$(this).up('.entry').hasClass('selected'))
								{
									$('tabPlayer').show();
									$('tabAlliance').hide();
									$(this).up('.entry').toggleClass('selected').next('.entry').toggleClass('selected');
								}
								$('mapContainer')._map.mapMarks.player.update(false);
								return false;
							">Players</a>
						</div>
					</div>
				</div>

								<div class="clear"></div>
			</div>

			<div id="tabPlayer" class="dataTab"></div>
			<div id="tabAlliance" class="dataTab"></div>
		</div>
	</div>
</div>	</div>
	<div id="contextmenu" style="">
	<div class="background">
		<div class="background-tl">
			<div class="background-tr">
				<div class="background-tc"></div>
			</div>
		</div>
		<div class="background-ml">
			<div class="background-mr">
				<div class="background-mc"></div>
			</div>
		</div>
		<div class="background-bl">
			<div class="background-br">
				<div class="background-bc"></div>
			</div>
		</div>
	</div>
    	<div class="background-content">
		<div>
			<div class="tl">
				<div class="tr">
					<div class="tc"></div>
				</div>
			</div>
			<div class="ml">
				<div class="mr">
					<div class="mc">
						<div class="contents">
							<div id="contextMenuSendTroops" class="entry">
								<a href="#flag">send troops</a>
							</div>
							<div id="contextMenuSendTraders" class="entry">
								<a href="#flag">send merchants</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bl">
				<div class="br">
					<div class="bc"></div>
				</div>
			</div>
		</div>
		<div class="separator separatorActions"></div>

		<div>
			<div class="tl">
				<div class="tr">
					<div class="tc"></div>
				</div>
			</div>
			<div class="ml">
				<div class="mr">
					<div class="mc">
						<div class="contents">
							<div class="hideIE6 title">
								Players							</div>
							<div id="contextMenuMarkPlayerAlliance" class="hideIE6 entry">
								<a href="#flag">mark alliance</a>
							</div>
							<div id="contextMenuMarkPlayerPlayer" class="hideIE6 entry">
								<a href="#flag">mark player</a>
							</div>
							<div id="contextMenuFlagPlayer" class="hideIE6 entry">
								<a href="#flag">mark field</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bl">
				<div class="br">
					<div class="bc"></div>
				</div>
			</div>
		</div>

			</div>
</div></div>

<script type="text/javascript">
		Travian.Translation.add(
	{
		'k.spieler':		'بازیکن',
		'k.einwohner':		'جمعیت',
		'k.allianz':		'اتحاد',
		'k.volk':			'نژاد',
		'k.dt':				'دهکده',
		'k.bt':				'آبادی تسخیر شده',
		'k.fo':				'آبادی تسخیر نشده',
		'k.vt':				'دهکده تسخیر نشده',
		'k.loadingData':	'<?=PLEASE_WAIT?>',

		'a.v1':		'رومن ها',
		'a.v2':		'توتن ها',
		'a.v3':		'گول ها',
		'a.v4':		'طبیعت',
		'a.v5':		'ناتار ها',

		'k.f1':		'3-3-3-9',
		'k.f2':		'3-4-5-6',
		'k.f3':		'4-4-4-6',
		'k.f4':		'4-5-3-6',
		'k.f5':		'5-3-4-6',
		'k.f6':		'1-1-1-15',
		'k.f7':		'4-4-3-7',
		'k.f8':		'3-4-4-7',
		'k.f9':		'4-3-4-7',
		'k.f10':	'3-5-4-6',
		'k.f11':	'4-3-5-6',
		'k.f12':	'5-4-3-6',
		'k.f99':	'Natarian village',

		'b.ri1':	'Won as attacker without losses.',
		'b.ri2':	'Won as attacker with losses.',
		'b.ri3':	'Lost as attacker.',
		'b.ri4':	'Won as defender without losses.',
		'b.ri5':	'Won as defender with losses.',
		'b.ri6':	'Lost as defender with losses.',
		'b.ri7':	'Lost as defender without losses.',

		'b:ri1':	'&lt;img src="img/x.gif" class="iReport iReport1"/&gt;'.unescapeHtml(),
		'b:ri2':	'&lt;img src="img/x.gif" class="iReport iReport2"/&gt;'.unescapeHtml(),
		'b:ri3':	'&lt;img src="img/x.gif" class="iReport iReport3"/&gt;'.unescapeHtml(),
		'b:ri4':	'&lt;img src="img/x.gif" class="iReport iReport4"/&gt;'.unescapeHtml(),
		'b:ri5':	'&lt;img src="img/x.gif" class="iReport iReport5"/&gt;'.unescapeHtml(),
		'b:ri6':	'&lt;img src="img/x.gif" class="iReport iReport6"/&gt;'.unescapeHtml(),
		'b:ri7':	'&lt;img src="img/x.gif" class="iReport iReport7"/&gt;'.unescapeHtml(),

		'b:bi0':	'&lt;img class="carry empty" src="img/x.gif" alt="Bounty" /&gt;'.unescapeHtml(),
		'b:bi1':	'&lt;img class="carry half" src="img/x.gif" alt="Bounty" /&gt;'.unescapeHtml(),
		'b:bi2':	'&lt;img class="carry" src="img/x.gif" alt="Bounty" /&gt;'.unescapeHtml(),

		'a.r1':		'چوب',
		'a.r2':		'خشت',
		'a.r3':		'آهن',
		'a.r4':		'گندم',

									'a.atm1':	'Adventure 1',
							'a.atm2':	'Adventure 2',
							'a.atm3':	'Adventure 3',
							'a.atm4':	'Adventure 4',
							'a.atm5':	'Adventure 5',
							'a.atm6':	'Adventure 6',
							'a.atm7':	'Adventure 7',
							'a.atm8':	'Adventure 8',
							'a.atm9':	'Adventure 9',
							'a.atm10':	'Adventure 10',
							'a.atm11':	'Adventure 11',
							'a.atm12':	'Adventure 12',
							'a.atm13':	'Adventure 13',
						'a.ad':		'Difficulty:',
			'a.ad0':	'hard',
			'a.ad1':	'normal',
			'a.ad2':	'normal',
			'a.ad3':	'normal',
		
		'a:r1':		'&lt;img alt="Lumber" src="img/x.gif" class="r1"&gt;'.unescapeHtml(),
		'a:r2':		'&lt;img alt="Clay" src="img/x.gif" class="r2"&gt;'.unescapeHtml(),
		'a:r3':		'&lt;img alt="Iron" src="img/x.gif" class="r3"&gt;'.unescapeHtml(),
		'a:r4':		'&lt;img alt="Crop" src="img/x.gif" class="r4"&gt;'.unescapeHtml(),

		'k.arrival':	'arrival at',
		'k.ssupport':	'reinforcement',
		'k.sspy':		'scouting',
		'k.sreturn':	'return',
		'k.sraid':		'raid',
		'k.sattack':	'attack'
	});
</script>
<script type="text/javascript">
		window.addEvent('domready', function()
	{
				var containerViewSize = {
			width:	540,
			height: 401
		};
		
		
		var fnDelayMe = function()
		{
			
			var fnInit = function()
			{
				Travian.Game.Map.Options.Rulers.steps = Object.merge({}, Travian.Game.Map.Options.Rulers.steps, {"x":{"1":1,"2":1,"3":10,"4":20},"y":{"1":1,"2":1,"3":10,"4":20}});
				Travian.Game.Map.Options.Default.dataStore = Object.merge({}, Travian.Game.Map.Options.Default.dataStore, {"cachingTimeForType":{"blocks":1800000,"symbol":600000,"tile":600000,"tooltip":300000},"persistentStorage":false,"useStorageForType":{"blocks":false,"symbol":false,"tile":false,"tooltip":false},"clearStorageForType":{"blocks":false,"symbol":false,"tile":false,"tooltip":false}});
				Travian.Game.Map.Options.Default.updater = Object.merge({}, Travian.Game.Map.Options.Default.updater, {"maxRequestCount":5,"requestDelayTime":{"multiple":100,"position":300},"url":"map_ajax.php","positionOptions":{"areaAroundPosition":{"1":{"left":-5,"top":-4,"right":5,"bottom":4},"2":{"left":-10,"top":-8,"right":10,"bottom":8},"3":{"left":-15,"top":-15,"right":15,"bottom":15},"4":{"left":-15,"top":-15,"right":15,"bottom":15}}}});
				Travian.Game.Map.Options.Default.tileDisplayInformation.type = 'dialog';

				Travian.Game.Map.Options.MapMark.Flag.dialog.html = '<div class=\"mapMarkField\">\n	<div class=\"flag {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\" />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\" />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\">\n		<input id=\"coordinateDialogText\" class=\"text {inputText}\" type=\"text\" />\n	<\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
				Travian.Game.Map.Options.MapMark.Mark.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\" />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\" />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';

				Travian.Game.Map.Options.Default.mapMarks.player.layers.alliance.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\" />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\" />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
				Travian.Game.Map.Options.Default.mapMarks.player.layers.player.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\" />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\" />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
				Travian.Game.Map.Options.Default.mapMarks.alliance.layers.alliance.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\" />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\" />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
				Travian.Game.Map.Options.Default.mapMarks.alliance.layers.player.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\" />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\" />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';

				Travian.Game.Map.Options.Default.mapMarks.player.layers.flag.dialog.html = '<div class=\"mapMarkField\">\n	<div class=\"flag {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\" />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\" />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\">\n		<input id=\"coordinateDialogText\" class=\"text {inputText}\" type=\"text\" />\n	<\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
				Travian.Game.Map.Options.Default.mapMarks.alliance.layers.flag.dialog.html = '<div class=\"mapMarkField\">\n	<div class=\"flag {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\" />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\" />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\">\n		<input id=\"coordinateDialogText\" class=\"text {inputText}\" type=\"text\" />\n	<\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';

				Travian.Game.Map.Tips.tooltipHtml = '‎&#x202d;<span class=\"coordinates coordinatesWrapper\"><span class=\"coordinateX\">(&#x202d;&#x202d;{x}&#x202c;&#x202c;<\/span><span class=\"coordinatePipe\">|<\/span><span class=\"coordinateY\">&#x202d;&#x202d;{y}&#x202c;&#x202c;)<\/span><\/span>&#x202c;‎';
				Travian.Game.Map.Options.Default.block.tooltipHtml = '‎&#x202d;<span class=\"coordinates coordinatesWrapper\"><span class=\"coordinateX\">(&#x202d;&#x202d;{x}&#x202c;&#x202c;<\/span><span class=\"coordinatePipe\">|<\/span><span class=\"coordinateY\">&#x202d;&#x202d;{y}&#x202c;&#x202c;)<\/span><\/span>&#x202c;‎<br />{k.loadingData}';
				Travian.Game.Map.Options.MiniMap.tooltipHtml = '‎&#x202d;<span class=\"coordinates coordinatesWrapper\"><span class=\"coordinateX\">(&#x202d;&#x202d;{x}&#x202c;&#x202c;<\/span><span class=\"coordinatePipe\">|<\/span><span class=\"coordinateY\">&#x202d;&#x202d;{y}&#x202c;&#x202c;)<\/span><\/span>&#x202c;‎';

				
				new Travian.Game.Map.Container(Object.merge({}, Travian.Game.Map.Options.Default,
				{
					blockOverflow: 1,
					blockSize:
					{
						width:	600,
						height:	600					},
					containerViewSize:	containerViewSize,
					mapInitialPosition:
					{
						x:	<?=$x?>,
						y:	<?=$y?>					},
					transition:
					{
						zoomOptions:
						{
							level:  1,
							sizes:	[{"x":10,"y":10},{"x":20,"y":20},{"x":120,"y":120}]		                }
					},
					/* check */
					data: {"elements":[{"x":-45,"y":132,"s":[{"dataId":"adventure5923611","x":"-45","y":"132","type":"adventure","parameters":{"difficulty":"3"},"title":"Adventure","text":"{a.atm1}\u003Cbr \/\u003E{a.ad} {a.ad3}"}]},{"x":-43,"y":135,"s":[{"dataId":"adventure5923612","x":"-43","y":"135","type":"adventure","parameters":{"difficulty":"0"},"title":"Adventure","text":"{a.atm2}\u003Cbr \/\u003E{a.ad} {a.ad0}"}]},{"x":-38,"y":126,"s":[{"dataId":"adventure5923613","x":"-38","y":"126","type":"adventure","parameters":{"difficulty":"1"},"title":"Adventure","text":"{a.atm3}\u003Cbr \/\u003E{a.ad} {a.ad1}"}]},{"x":-44,"y":129,"s":[{"dataId":"adventure5923614","x":"-44","y":"129","type":"adventure","parameters":{"difficulty":"2"},"title":"Adventure","text":"{a.atm4}\u003Cbr \/\u003E{a.ad} {a.ad2}"}]},{"x":-48,"y":132,"s":[{"dataId":"adventure5923615","x":"-48","y":"132","type":"adventure","parameters":{"difficulty":"3"},"title":"Adventure","text":"{a.atm5}\u003Cbr \/\u003E{a.ad} {a.ad3}"}]},{"x":-24,"y":129,"s":[{"dataId":"adventure5923616","x":"-24","y":"129","type":"adventure","parameters":{"difficulty":"0"},"title":"Adventure","text":"{a.atm6}\u003Cbr \/\u003E{a.ad} {a.ad0}"}]},{"x":-40,"y":132,"s":[{"dataId":"adventure5923617","x":"-40","y":"132","type":"adventure","parameters":{"difficulty":"1"},"title":"Adventure","text":"{a.atm7}\u003Cbr \/\u003E{a.ad} {a.ad1}"}]},{"x":-42,"y":135,"s":[{"dataId":"adventure5923618","x":"-42","y":"135","type":"adventure","parameters":{"difficulty":"2"},"title":"Adventure","text":"{a.atm8}\u003Cbr \/\u003E{a.ad} {a.ad2}"}]},{"x":-40,"y":136,"s":[{"dataId":"adventure5923619","x":"-40","y":"136","type":"adventure","parameters":{"difficulty":"3"},"title":"Adventure","text":"{a.atm9}\u003Cbr \/\u003E{a.ad} {a.ad3}"}]},{"x":-50,"y":128,"s":[{"dataId":"adventure5923620","x":"-50","y":"128","type":"adventure","parameters":{"difficulty":"0"},"title":"Adventure","text":"{a.atm10}\u003Cbr \/\u003E{a.ad} {a.ad0}"}]},{"x":-49,"y":135,"s":[{"dataId":"adventure5923621","x":"-49","y":"135","type":"adventure","parameters":{"difficulty":"1"},"title":"Adventure","text":"{a.atm11}\u003Cbr \/\u003E{a.ad} {a.ad1}"}]},{"x":-45,"y":138,"s":[{"dataId":"adventure5923622","x":"-45","y":"138","type":"adventure","parameters":{"difficulty":"2"},"title":"Adventure","text":"{a.atm12}\u003Cbr \/\u003E{a.ad} {a.ad2}"}]},{"x":-44,"y":125,"s":[{"dataId":"adventure5923623","x":"-44","y":"125","type":"adventure","parameters":{"difficulty":"3"},"title":"Adventure","text":"{a.atm13}\u003Cbr \/\u003E{a.ad} {a.ad3}"}]}],"blocks":{"-60":{"110":{"-51":{"119":{"version":"76"}}},"120":{"-51":{"129":{"version":"22"}}},"130":{"-51":{"139":{"version":"53"}}},"140":{"-51":{"149":{"version":"11"}}}},"-50":{"110":{"-41":{"119":{"version":"66"}}},"120":{"-41":{"129":{"version":"63"}}},"130":{"-41":{"139":{"version":"37"}}},"140":{"-41":{"149":{"version":"16"}}}},"-40":{"110":{"-31":{"119":{"version":"79"}}},"120":{"-31":{"129":{"version":"54"}}},"130":{"-31":{"139":{"version":"27"}}},"140":{"-31":{"149":{"version":"19"}}}},"-30":{"110":{"-21":{"119":{"version":"75"}}},"120":{"-21":{"129":{"version":"42"}}},"130":{"-21":{"139":{"version":"21"}}},"140":{"-21":{"149":{"version":"16"}}}}}},
					mapMarks:
					{
						player:
						{
							data: [],
							layers:
							{
								alliance:
								{
																		title:	'Alliance',
									dialog:
									{
										title: 'Own alliance marks.',
										textOkay: 'save',
										textCancel:	'cancel'
									},
									optionsData:
									{
										urlLink: 'allianz.php?aid={markId}'
									}
								},
								player:
								{
																		title: 'Players',
									dialog:
									{
										title: 'Own player marks.',
										textOkay: 'save',
										textCancel: 'cancel'
									},
									optionsData:
									{
										urlLink: 'spieler.php?uid={markId}'
									}
								},
								flag:
								{
																		title: 'flags',
									dialog:
									{
										title: 'Own field marks.',
										textOkay: 'save',
										textCancel: 'cancel'
									}
								}
							}
						},
						alliance:
						{
														enabled: false,
														data: null,
							layers:
							{
								alliance:
								{
																		editable: false,
																		title: 'Alliance',
									dialog:
									{
										title: 'Alliance marks for my alliance.',
										textOkay: 'save',
										textCancel: 'cancel'
									},
									optionsData:
									{
										urlLink: 'allianz.php?aid={markId}'
									}
								},
								player:
								{
																		editable:	false,
																		title: 'Players',
									dialog:
									{
										title: 'Player marks for my alliance.',
										textOkay: 'save',
										textCancel: 'cancel'
									},
									optionsData:
									{
										urlLink: 'spieler.php?uid={markId}'
									}
								},
								flag:
								{
																		editable: false,
																		title: 'flags',
									dialog:
									{
										title: 'Field marks for my alliance.',
										textOkay: 'save',
										textCancel: 'cancel'
									}
								}
							}
						}
					}
				}));
			};

						if ((!Browser.safari && !Browser.chrome) || $('mapContainer').getSize().y == containerViewSize.height)
			{
				fnInit();
			}
			else
			{
				fnDelayMe.delay(100);
			}
		};
		fnDelayMe();
	});
</script>
								<div class="clear"></div>
							</div>