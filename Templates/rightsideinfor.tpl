<?php
$baracks = "disabled";
$workshop = "disabled";
$stable = "disabled";
$market = "disabled";
$builds = mysql_fetch_array($database->query("SELECT * FROM ". TB_PREFIX ."fdata WHERE `vref` = '". $village->wid ."'"));
for($i=19;$i<=40;$i++){
	if($builds['f'.$i.'t']==19){
		$baracks = "";
		$bid = $i;
	}
	if($builds['f'.$i.'t']==21){
		$workshop = "";
		$wid = $i;
	}
	if($builds['f'.$i.'t']==20){
		$stable = "";
		$sid = $i;
	}
	if($builds['f'.$i.'t']==17){
		$market = "";
		$mid = $i;
	}
}
?>
<div id="sidebarAfterContent" class="sidebar afterContent">
	<div id="sidebarBoxActiveVillage" class="sidebarBox   ">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
				<button type="button" id="button5229e5254faf9"	class="layoutButton workshopBlack gold <?php echo $workshop; ?>" onclick="return false;" title="<?php 
		if(!$session->plus){
			echo "". DIRECT_LINK ."||". NO_PLUS_ESI ."";	
			if($workshop==""){ echo "&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;کارگاه بنا شده است."; echo "&lt;/span&gt;";	} else{ echo "&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;". dorf1_villageNameBox_7 .". ". dorf1_villageNameBox_8 ."."; echo "&lt;/span&gt;";	}
		}else{
		if($workshop=="" && $session->plus){ echo "". dorf1_villageNameBox_14 ."&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;"; 
		
			$extra = $session->tribe == 3 ? 2 : 3;
			$min = (($session->tribe - 1) * 10 ) + 1 + $extra;
			$max = (($session->tribe - 1) * 10 ) + 8;
			$training = $database->query_return("SELECT * FROM ". TB_PREFIX ."training WHERE `unit` < '".$max."' AND `unit` >= '".$min."' ");
			echo count($training) . "". dorf1_villageNameBox_11 .".";	
		
		
		echo "&lt;/span&gt;";	} else{ echo "". dorf1_villageNameBox_7 .".&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt; ". dorf1_villageNameBox_8 ."."; echo "&lt;/span&gt;";	}}
		
		?>">
		<div class="button-container addHoverClick">
			<img src="img/x.gif" alt="" />
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5229e5254faf9'))
		{
			$('button5229e5254faf9').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"gold","onclick":"return false;","loadTitle":<?php if($workshop=="" && $session->plus){ echo "true"; } else{ echo "false"; } ?>,"boxId":"activeVillage","disabled":<?php if($workshop=="" && $session->plus){ echo "false"; } else{ echo "true"; } ?>,"speechBubble":"","class":"","id":"button5229e5254ffa5","redirectUrl":"<?php if($workshop=="" && $session->plus){ echo "build.php?id=" . $wid; } else{ echo ""; } ?>","redirectUrlExternal":""<?php if($workshop=="" && $session->plus){ echo ""; } else{ echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}"; } ?>}]);
			});
		}
	</script><button type="button" id="button5229e5254fc5c"	class="layoutButton stableBlack gold <?php echo $stable; ?> " onclick="return false;" title="<?php 
		if(!$session->plus){
			echo "". DIRECT_LINK ."||". NO_PLUS_ESI ."";	
			if($stable==""){ echo "&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;اصطبل بنا شده است."; echo "&lt;/span&gt;";	} else{ echo "&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;". dorf1_villageNameBox_5 .". ". dorf1_villageNameBox_6 ."."; echo "&lt;/span&gt;";	}
		}else{
		if($stable=="" && $session->plus){ echo "". dorf1_villageNameBox_12 ."&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;"; 
			$extra = $session->tribe == 3 ? 2 : 3;
			$min = (($session->tribe - 1) * 10 ) + 1 + $extra;
			$max = (($session->tribe - 1) * 10 ) + 8;
			$training = $database->query_return("SELECT * FROM ". TB_PREFIX ."training WHERE `unit` < '".$max."' AND `unit` >= '".$min."' ");
			echo count($training) . "". dorf1_villageNameBox_11 .".";	
		echo "&lt;/span&gt;";	} else{ echo "". dorf1_villageNameBox_5 .".&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt; ". dorf1_villageNameBox_6 ."."; echo "&lt;/span&gt;";	}}
		
		?>">
		<div class="button-container addHoverClick">
			<img src="img/x.gif" alt="" />
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5229e5254fc5c'))
		{
			$('button5229e5254fc5c').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"gold","onclick":"return false;","loadTitle":<?php if($stable=="" && $session->plus){ echo "true"; } else{ echo "false"; } ?>,"boxId":"activeVillage","disabled":<?php if($stable=="" && $session->plus){ echo "false"; } else{ echo "true"; } ?>,"speechBubble":"","class":"","id":"button5229e5254ffa5","redirectUrl":"<?php if($stable=="" && $session->plus){ echo "build.php?id=" . $sid; } else{ echo ""; } ?>","redirectUrlExternal":""<?php if($stable=="" && $session->plus){ echo ""; } else{ echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}"; } ?>}]);
			});
		}
	</script>
	<button type="button" id="button5229e5254fe6f"	class="layoutButton barracksBlack gold <?php echo $baracks; ?> " onclick="return false;" title="
	<?php 
		if(!$session->plus){
			echo "". DIRECT_LINK ."||". NO_PLUS_ESI ."";	
			if($baracks==""){ echo "&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;سرباز خانه بنا شده است."; echo "&lt;/span&gt;";	} else{ echo "&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;". dorf1_villageNameBox_3 .". ". dorf1_villageNameBox_4 ."."; echo "&lt;/span&gt;";	}
		}else{
		if($baracks=="" && $session->plus){ echo "". dorf1_villageNameBox_10 ."&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;"; 
			$min = (($session->tribe - 1) * 10 ) + 1;
			$max = $session->tribe == 3 ? 2 : 3;
			$max += $min;
			$training = $database->query_return("SELECT * FROM ". TB_PREFIX ."training WHERE `unit` < '".$max."' AND `unit` >= '".$min."' ");
			echo count($training) . "". dorf1_villageNameBox_11 .".";
		echo "&lt;/span&gt;";	} else{ echo "". dorf1_villageNameBox_3 .".&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt; ". dorf1_villageNameBox_4 ."."; echo "&lt;/span&gt;";	}}
		
		?>">
		<div class="button-container addHoverClick">
			<img src="img/x.gif" alt="" />
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5229e5254fe6f'))
		{
			$('button5229e5254fe6f').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"gold","onclick":"return false;","loadTitle":<?php if($baracks=="" && $session->plus){ echo "true"; } else{ echo "false"; } ?>,"boxId":"activeVillage","disabled":<?php if($baracks=="" && $session->plus){ echo "false"; } else{ echo "true"; } ?>,"speechBubble":"","class":"","id":"button5229e5254ffa5","redirectUrl":"<?php if($baracks=="" && $session->plus){ echo "build.php?id=" . $bid; } else{ echo ""; } ?>","redirectUrlExternal":""<?php if($baracks=="" && $session->plus){ echo ""; } else{ echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}"; } ?>}]);
			});
		}
	</script><button type="button" id="button5229e5254ffa5"	class="layoutButton marketBlack gold <?php echo $market; ?> " onclick="return false;" title="<?php 
		if(!$session->plus){
			echo "". DIRECT_LINK ."||". NO_PLUS_ESI ."";	
			if($market==""){ echo "&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;". dorf1_villageNameBox_2 ."."; echo "&lt;/span&gt;";	} else{ echo "&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;". dorf1_villageNameBox_1 .". ". dorf1_villageNameBox_2 ."."; echo "&lt;/span&gt;";	}
		}else{
		if($market=="" && $session->plus){ 
			echo "". dorf1_villageNameBox_9 ."&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt;";
			echo "&lt;/span&gt;";	
			} else{ echo "". dorf1_villageNameBox_1 .".&lt;br /&gt;&lt;span class=&quot;warning&quot;&gt; ". dorf1_villageNameBox_2 ."."; echo "&lt;/span&gt;";	}
		}
		?>">

		<div class="button-container addHoverClick">
			<img src="img/x.gif" alt="" />
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5229e5254ffa5'))
		{
			$('button5229e5254ffa5').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"gold","onclick":"return false;","loadTitle":<?php if($market=="" && $session->plus){ echo "true"; } else{ echo "false"; } ?>,"boxId":"activeVillage","disabled":<?php if($market=="" && $session->plus){ echo "false"; } else{ echo "true"; } ?>,"speechBubble":"","class":"","id":"button5229e5254ffa5","redirectUrl":"<?php if($market=="" && $session->plus){ echo "build.php?id=" . $mid; } else{ echo ""; } ?>","redirectUrlExternal":""<?php if($market=="" && $session->plus){ echo ""; } else{ echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}"; } ?>}]);
			});
		}
	</script>
	<div class="clear"></div>
			<div id="villageNameField" class="boxTitle"><?php echo $village->vname; ?></div>
			</div>
			<div class="innerBox content">
				<div class="loyalty medium">			
					<?php echo LOYALTY; ?>: <span>‏ <?php echo $village->loyalty; ?>%‏</span>
				</div>		
			</div>
			<div class="innerBox footer">
				<button type="button" id="button5229e5255021d"	class="layoutButton editWhite green  " onclick="return false;" title="<?php echo dorf1_villageNameBox_16; ?>">
					<div class="button-container addHoverClick">
						<img src="img/x.gif" alt="" />
					</div>
				</button>
			<script type="text/javascript">
				
				if($('button5229e5255021d'))
				{
					$('button5229e5255021d').addEvent('click', function ()
					{
						window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"","disabled":false,"speechBubble":"","class":"","id":"button5229e5255021d","redirectUrl":"","redirectUrlExternal":"","title":"\u0627\u0646\u0642\u0631 \u0647\u0646\u0627 \u0645\u0631\u062a\u064a\u0646 \u0644\u062a\u063a\u064a\u0651\u0631 \u0627\u0633\u0645 \u0642\u0631\u064a\u062a\u0643","villageDialog":{"title":"<?=CHANGING_YOUR_VILLAGE_NAME?>:","description":"<?=NEW_NAME?>:","saveText":"<?=SAVE?>","villageId":"<?php echo $village->wid;?>"}}]);
					});
				}
			</script>		
			</div>
		</div>
	</div>							
	<div id="sidebarBoxVillagelist" class="sidebarBox toggleable collapsed ">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
				<button type="button" id="button5229e52550643"	class="layoutButton toggleCoordsWhite green  toggle" onclick="return false;" title="<?php echo dorf1_villageNameBox2_2; ?>">
		<div class="button-container addHoverClick">
			<img src="img/x.gif" alt="" />
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5229e52550643'))
		{
			$('button5229e52550643').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"","disabled":false,"speechBubble":"","class":"toggle","id":"button5229e52550643","redirectUrl":"","redirectUrlExternal":""}]);
			});
		}
	</script><button type="button" id="button5229e52550762"	class="layoutButton overviewWhite green  " onclick="return false;" title="<?php echo dorf1_villageNameBox2_1; ?>">
		<div class="button-container addHoverClick">
			<img src="img/x.gif" alt="" />
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5229e52550762'))
		{
			$('button5229e52550762').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"","disabled":false,"speechBubble":"","class":"","id":"button5229e52550762","redirectUrl":"dorf3.php","redirectUrlExternal":""}]);
			});
		}
	</script>
	<div class="clear"></div>
	<?php

	$villages = $database->getProfileVillages($session->uid);
	$count = count($villages);
	$mode = CP;

	?>

	<div class="expansionSlotInfo" title="<?php echo dorf1_villageNameBox2_3; ?> :  1/<?php echo $count; ?> ‏</br><?php echo dorf1_villageNameBox2_5;?> <?php echo ${'cp'.$mode}[$count+1];?> / <?php echo $database->getUserField($session->uid, "cp", 0);?>">
		<div class="boxTitleAdditional">‏1/<?php echo $count; ?>‏</div>
		<div class="boxTitle"><?php echo dorf1_villageNameBox2_3; ?></div>
		<div class="villageListBarBox">
	<?php
	if(($database->getUserField($session->uid, "cp", 0) / ${'cp'.$mode}[$count+1]) > 1) $percent = "100.0"; else  $percent = (($database->getUserField($session->uid, "cp", 0) / ${'cp'.$mode}[$count+1]) * 100);
	?>	
			<div class="bar" style="width:<?php echo $percent;?>%">&nbsp;</div>
		</div>
	</div>

	<script type="text/javascript">
		window.addEvent('domready', function()
		{
					Travian.Translation.add(
			{
				'villagelist_collapsed': '<?php echo dorf1_villageNameBox2_2; ?>',
				'villagelist_expanded': '<?php echo dorf1_villageNameBox2_4; ?>'
			});

			var box = $('sidebarBoxVillagelist');
			box.down('button.toggle').addEvent('click', function(e)
			{
				Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'villagelist');
			});
		});
		</script>		</div>
			<div class="innerBox content">
					<ul>
	<?php
	foreach($villages as $vil){ 
		$wdata = mysql_fetch_array($database->query("SELECT * FROM `". TB_PREFIX ."wdata` WHERE `id` = '". $vil['wref'] ."'"));
	?>
						<li class=" <?php if($vil['wref'] == $village->wid){ echo "active"; } ?>" title="<?php echo $vil['name']; ?> &rlm;&amp;#x202e;&lt;span class=&quot;coordinates coordinatesWrapper coordinatesAligned coordinatesRTL&quot;&gt;&lt;span class=&quot;coordinateX&quot;&gt;(<?php echo $wdata['x']; ?>&lt;/span&gt;&lt;span class=&quot;coordinatePipe&quot;&gt;|&lt;/span&gt;&lt;span class=&quot;coordinateY&quot;&gt;<?php echo $wdata['y']; ?>)&lt;/span&gt;&lt;/span&gt;&amp;#x202c;&rlm;">
									<a  href="?newdid=<?php echo $vil['wref']; ?>" accesskey="b" class="active">
						<img src="img/x.gif" alt="" />
						<div id="vul_<?php echo $vil['name']; ?>" class="name"><?php echo $vil['name']; ?></div>
						‏&#x202e;<span class="coordinates coordinatesWrapper coordinatesAligned coordinatesRTL"><span class="coordinateX">(<?php echo $wdata['x']; ?></span><span class="coordinatePipe">|</span><span class="coordinateY"><?php echo $wdata['y']; ?>)</span></span>&#x202c;‏				</a>
				</li>
	<?php }
	?>
				</ul>
			</div>
			<div class="innerBox footer">
						</div>
		</div>
	</div>							
    		<?php if ($database->getUserField($_SESSION['username'],'fquest','username')!=2047 && QUEST==true){ ?>


	<div id="sidebarBoxQuestmaster" class="sidebarBox   ">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
            
				<button onClick="qst_handle();" id="questmasterButton" title="<?=LN_QUEST?>" class="forceDisplayElement vid_<?php echo $session->tribe; ?>" type="button">
					<img class="border" alt="" src="img/x.gif" />
					<img class="animation" alt="" src="img/x.gif" />
					<img class="mentor" alt="" src="img/x.gif" />
				</button>
	<button type="button" id="button5229e525518b8"	class="layoutButton bulbWhite green  " onclick="return false;" title="<?=SHOW_HINTS_PANEL?>">
		<div class="button-container addHoverClick">
			<img src="img/x.gif" alt="" />
		</div>
		</button>

	<script type="text/javascript">
		
		if($('button5229e525518b8'))
		{
			$('button5229e525518b8').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"","disabled":false,"speechBubble":"","class":"","id":"button5229e525518b8","redirectUrl":"","redirectUrlExternal":"","overlay":[]}]);
			});
		}
	</script><div class="clear"></div>
	<div class="boxTitle"><?=WELCOME?>!</div>
	<div>
		<script type="text/javascript">
		
							Travian.Game.Quest.createHighlights();
							Travian.Game.Quest.toggleHighlights(true);

							$$('.questInformation .iconButton.small.cancel').addEvent('click', function()
							{
								setTimeout(function() {
									Travian.Game.Quest.createHighlights();
									Travian.Game.Quest.toggleHighlights(true);
								}, 500);
							});
						</script></div>		</div>
			<div class="innerBox content">
				<ul id="mentorTaskList" class="notClickable">

		
									<li id="sidebar_qst_title"><?php echo sprintf(constant('Q'.($_SESSION['qst'])),SERVER_NAME); ?></li>
				<script type="text/javascript">
		Travian.Translation.add('answers.tutorial_01_title', "Travian Answers");
	</script>

</ul>

<script type="text/javascript">
	window.addEvent('domready', function()
	{
		Travian.Game.Quest.setOptions(
		{
			tipsTurnoffAjaxTrigger: false,
			listData: [],
			tutorialData: {"id":"Tutorial_01","name":"questV2.tutorial_01_name","category":"tutorial","stepType":"task","currentStep":0,"stepCount":1,"steps":[{"stepId":0,"type":"task","stepDescription":"questV2.tutorial_01_step_01_layoutdescription"}],"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=332#go2answer"},
			highlightSelectors: [{"selector":".dialog.questInformation .questButtonNext","renderer":"rectangle"},{"selector":"#questmasterButton","renderer":"rectangle"}]		});

		Travian.Game.Quest.bindMentorListDelegation();
		Travian.Game.Quest.createHighlights();
		Travian.Game.Quest.initializeQuests();
	});
</script>
			</div>
			<div class="innerBox footer">
						</div>
		</div>
	</div>
																		<div class="clear"></div>
                                                                        <?php }; ?>
<div id="side_server_info" class="sidebarBox">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
				<div class="boxTitle"><br>
<?=SERVER_INFO?>
</div>
			</div>
			<div class="innerBox content">
            <?php /* ?>
            <center><h3>اسکریپت نمایشی</h3>
            برای مشاهده اطلاعات اسکریپت <?=LN_AND?> آخرین تغییرات <a style="color:#0C0;font-weight:bold;" href="about.php">کلیک کنید</a>.
            <br><b>
            * * *</b>
            </center>
			<?php */ ?>
            <br>
<?php 
$timestamp = $database->isDeleting($session->uid);
$displayarray = $database->getUser($session->uid,1);
if($displayarray['protect'] > time()){
	//echo "<div id=\"sideInfoCountdown\"><div class=\"head\"></div>";
	//echo "<div class=\"content\">";
	$uurover=$generator->getTimeFormat($displayarray['protect']-time());
	echo sprintf(PROTECTION_TIME,$uurover);
	//echo "</div></div>";
} elseif($timestamp) {
	//echo "<div id=\"sideInfoCountdown\"><div class=\"head\"></div>";
	//echo "<div class=\"content\">";
	$time=$generator->getTimeFormat(($timestamp-time()));
	echo sprintf(ACCOUNT_DELETION,$time);
	//echo "</div></div>";
}
									$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");

$row = mysql_fetch_array($result);
?>
<?php
if( $row['relArte'] > time() ) {
?>
<?=SIDE_I_1?><br>
<center>
<span id="cntdwn" style="display:block;margin-<?=DIRECTION_2?>:0px;">

									<script language="JavaScript">
									dthen = <?php 
									$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");

$row = mysql_fetch_array($result);

echo $row['relArte'];			
									
									?>; var dnow = <?php echo time()?>; CountActive = true; CountStepper = -1; LeadingZero = true; ;
									FinishMessage = "<?=SIDE_I_3?>";

									function calcage(secs, num1, num2) {
									  s = ((Math.floor(secs/num1))%num2).toString();
									  if (LeadingZero && s.length < 2) s = "0" + s;
									  return "" + s + "";
									}

									function CountBack(secs) {
									  if (secs < 0) { /*window.location="dorf1.php";*/ return; }
									  if(Number(calcage(secs,86400,100000)) > 0) {
										  DisplayFormat = "%%D%% <?php echo DAYS;?> <?=LN_AND?> %%H%%:%%M%%:%%S%% <?=HOUR?>"
									  }else{
										  DisplayFormat = "%%H%%:%%M%%:%%S%% <?=HOUR?>"
									  }
									  DisplayStr = DisplayFormat.replace(/%%D%%/g, Number(calcage(secs,86400,100000)));
									  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
									  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
									  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

									  document.getElementById("cntdwn").innerHTML = DisplayStr;
									  if (CountActive) setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
									}

									function putspan(backcolor, forecolor) { document.write("<div class='activationTime' id='cntdwn'></div>");}

									if (typeof(BackColor)=="undefined") BackColor = "white";
									if (typeof(ForeColor)=="undefined") ForeColor= "black";

									CountStepper = Math.ceil(CountStepper);
									if (CountStepper == 0)
									  CountActive = false;
									var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
									putspan(BackColor, ForeColor);
									var dnow = <?php echo time()?>;
									if(CountStepper>0)
									  ddiff = new Date(dnow-dthen);
									else
									  ddiff = new Date(dthen-dnow);
									gsecs = Math.floor(ddiff);
									CountBack(gsecs);
									</script>


</span>
</center>
<span style="padding-<?=DIRECTION_2?>:55px;"><?=SIDE_I_2?></span>
<?php }else{ ?>
<?=SIDE_I_3?>
<?php }; ?>
<br>----------------------------------------<br>
<?php
if( $row['relns'] > time() ) {
?>
<?=SIDE_I_4?><br>
<center>
<span id="cntdwn2" style="display:block;margin-<?=DIRECTION_2?>:0px;">

									<script language="JavaScript">
									dthen2 = <?php 
									$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$row = mysql_fetch_array($result);
echo $row['relns'];			
									
									?>; var dnow2 = <?php echo time()?>; CountActive2 = true; CountStepper2 = -1; LeadingZero2 = true; ;
									FinishMessage2 = "<?=SIDE_I_5?>";

									function calcage2(secs, num1, num2) {
									  s = ((Math.floor(secs/num1))%num2).toString();
									  if (LeadingZero2 && s.length < 2) s = "0" + s;
									  return "" + s + "";
									}

									function CountBack2(secs) {
									  if (secs < 0) { /*window.location="dorf1.php";*/ return; }
									  if(Number(calcage2(secs,86400,100000)) > 0) {
										  DisplayFormat = "%%D%% <?php echo DAYS;?> <?=LN_AND?> %%H%%:%%M%%:%%S%% <?=HOUR?>"
									  }else{
										  DisplayFormat = "%%H%%:%%M%%:%%S%% <?=HOUR?>"
									  }
									  DisplayStr = DisplayFormat.replace(/%%D%%/g, Number(calcage2(secs,86400,100000)));
									  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage2(secs,3600,24));
									  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage2(secs,60,60));
									  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage2(secs,1,60));

									  document.getElementById("cntdwn2").innerHTML = DisplayStr;
									  if (CountActive2) setTimeout("CountBack2(" + (secs+CountStepper2) + ")", SetTimeOutPeriod2);
									}

									function putspan2(backcolor, forecolor) { document.write("<div class='activationTime' id='cntdwn'></div>");}

									if (typeof(BackColor)=="undefined") BackColor = "white";
									if (typeof(ForeColor)=="undefined") ForeColor= "black";

									CountStepper2 = Math.ceil(CountStepper2);
									if (CountStepper2 == 0)
									  CountActive2 = false;
									var SetTimeOutPeriod2 = (Math.abs(CountStepper2)-1)*1000 + 990;
									putspan2(BackColor, ForeColor);
									var dnow2 = <?php echo time()?>;
									if(CountStepper2>0)
									  ddiff2 = new Date(dnow2-dthen2);
									else
									  ddiff2 = new Date(dthen2-dnow2);
									gsecs2 = Math.floor(ddiff2);
									CountBack2(gsecs2);
									</script>


</span>
</center>
<span style="padding-<?=DIRECTION_2?>:55px;"><?=SIDE_I_7?></span>
<?php }else{ ?>
<?=SIDE_I_5?>
<?php }; ?>
<br>----------------------------------------<br>
<?php
if( true ) {
?>
<?=SIDE_I_6?><br>
<center>
<span id="cntdwn3" style="display:block;margin-<?=DIRECTION_2?>:0px;">

									<script language="JavaScript">
									dthen3 = <?php 
									$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$row = mysql_fetch_array($result);
echo $row['m_int']+$row['m_lastpt'];			
									
									?>; var dnow3 = <?php echo time()?>; CountActive3 = true; CountStepper3 = -1; LeadingZero3 = true; ;
									FinishMessage3 = "نقشه های ساخت آزاد شدند.";

									function calcage3(secs, num1, num2) {
									  s = ((Math.floor(secs/num1))%num2).toString();
									  if (LeadingZero3 && s.length < 2) s = "0" + s;
									  return "" + s + "";
									}

									function CountBack3(secs) {
									  if (secs < 0) { /*window.location="dorf1.php";*/ return; }
									  if(Number(calcage3(secs,86400,100000)) > 0) {
										  DisplayFormat = "%%D%% <?php echo DAYS;?> <?=LN_AND?> %%H%%:%%M%%:%%S%% <?=HOUR?>"
									  }else{
										  DisplayFormat = "%%H%%:%%M%%:%%S%% <?=HOUR?>"
									  }
									  DisplayStr = DisplayFormat.replace(/%%D%%/g, Number(calcage3(secs,86400,100000)));
									  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage3(secs,3600,24));
									  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage3(secs,60,60));
									  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage3(secs,1,60));

									  document.getElementById("cntdwn3").innerHTML = DisplayStr;
									  if (CountActive3) setTimeout("CountBack3(" + (secs+CountStepper3) + ")", SetTimeOutPeriod3);
									}

									function putspan3(backcolor, forecolor) { document.write("<div class='activationTime' id='cntdwn'></div>");}

									if (typeof(BackColor)=="undefined") BackColor = "white";
									if (typeof(ForeColor)=="undefined") ForeColor= "black";

									CountStepper3 = Math.ceil(CountStepper3);
									if (CountStepper3 == 0)
									  CountActive3 = false;
									var SetTimeOutPeriod3 = (Math.abs(CountStepper3)-1)*1000 + 990;
									putspan3(BackColor, ForeColor);
									var dnow3 = <?php echo time()?>;
									if(CountStepper3>0)
									  ddiff3 = new Date(dnow3-dthen3);
									else
									  ddiff3 = new Date(dthen3-dnow3);
									gsecs3 = Math.floor(ddiff3);
									CountBack3(gsecs3);
									</script>


</span>
</center>
<span style="padding-<?=DIRECTION_2?>:55px;"><?=SIDE_I_7?></span>
<?php } ?>


			</div>
			<div class="innerBox footer">

			</div>
		</div>
	</div>
</div>	
<?php
include "Templates/quest.tpl";
?>
