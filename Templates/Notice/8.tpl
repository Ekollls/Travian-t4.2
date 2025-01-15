<?php
if(isset($_GET['aid']) && $_GET['aid']==$session->alliance){
	$dataarray = explode(",",$database->getNotice2($_GET['id'], 'data'));
    $rowtopic = $database->getNotice2($_GET['id'], 'topic');
	$topics = explode('[=]',$rowtopic); $topCount = count($topics);// var_dump($topCount); die;
	if($topCount==2) {if(defined($topics[1]))$topics[1]=constant($topics[1]);$topic = sprintf(constant($topics[0]),$topics[1]);}
	elseif($topCount==3) {
		$t1 = explode('[|]',$topics[1]); if(defined($t1[0]))$t1[0]=constant($t1[0]); for($i=1;$i<count($t1);$i++) $t1[0].=$t1[$i];
		$t2 = explode('[|]',$topics[2]); if(defined($t2[0]))$t2[0]=constant($t2[0]); for($i=1;$i<count($t2);$i++) $t2[0].=$t2[$i];
		$topic = sprintf(constant($topics[0]),$t1[0],$t2[0]);} else {$topic = $rowtopic;}
    $time = $database->getNotice2($_GET['id'], 'time');
}else{
	$dataarray = explode(",",$message->readingNotice['data']);
    $rowtopic = $message->readingNotice['topic'];
	$topics = explode('[=]',$rowtopic); $topCount = count($topics);// var_dump($topCount); die;
	if($topCount==2) {if(defined($topics[1]))$topics[1]=constant($topics[1]);$topic = sprintf(constant($topics[0]),$topics[1]);}
	elseif($topCount==3) {
		$t1 = explode('[|]',$topics[1]); if(defined($t1[0]))$t1[0]=constant($t1[0]); for($i=1;$i<count($t1);$i++) $t1[0].=$t1[$i];
		$t2 = explode('[|]',$topics[2]); if(defined($t2[0]))$t2[0]=constant($t2[0]); for($i=1;$i<count($t2);$i++) $t2[0].=$t2[$i];
		$topic = sprintf(constant($topics[0]),$t1[0],$t2[0]);} else {$topic = $rowtopic;}
    $time = $message->readingNotice['time'];
}
$da0name = $database->getVillageField($dataarray[0],'name');
if(defined($da0name)) $da0name = constant($da0name);
$isoasis = $database->isVillageOases($dataarray[14]);
if ($isoasis){
	$to = $database->getOMInfo($dataarray[14]);
	if ($to['conqured']){
		$to['name'] = OCCUPIEDOASES;
	} else {
		$to['name'] = UNOCCUPIEDOASES;
	}
	if (DIRECTION == 'ltr'){
		$to['name'] .=  '('.$to['x']."|".$to['y'].')';
	} elseif (DIRECTION == 'rtl'){
		$to['name'] .=  '('.$to['y']."|".$to['x'].')';
	}
} else {
	$to = $database->getMInfo($dataarray[14]);if(defined($to['name'])) $to['name'] = constant($to['name']); 
}
$da14name = $to['name'];
?>
				<table cellpadding="1" cellspacing="1" id="report_surround">
				<thead class="theader">
					<tr>
						<th colspan="2">
							<div id="subject">
								<div class="header label"><?php echo REPORT_SUBJECT; ?></div>
								<div class="header text"><?php echo $topic; ?></div>
								<div class="clear"></div>
							</div>

							<div id="time">
                            <?php $date = $generator->procMtime($time); ?>
								<div class="header label"><?php echo REPORT_SENT; ?></div>
								<div class="header text"><?php echo $date[0]."<span> ".REPORT_AT." ".$date[1]; ?></span></div>
                                
                                <div class="toolList">
<?php if($session->plus){ ?>
					<button type="button" value="reportButton delete" class="icon" title="<?php echo REPORT_DEL_BTN; ?>" onclick="return (function(){
				('<?php echo REPORT_DEL_QST; ?>').dialog(
				{
					onOkay: function(dialog, contentElement)
					{
						window.location.href = '?n1=<?php echo $_GET['id']; ?>&amp;del=1'}
				});
				return false;
			})()"><img src="img/x.gif" class="reportButton delete" alt="reportButton delete" /></button>
<?php } ?>
					<div class="clear"></div></div><div class="clear"></div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr><td colspan="2" class="report_content">
			<img src="img/x.gif" class="reportImage reportType1" alt=""><table cellspacing="0" cellpadding="0" class="tbg">
	<tbody>
	<tr>
	<td class="s7">
    <div class="boxes boxesColor gray trade"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
    
    <div class="headline"><?php echo REPORT_SENDER; ?></div>
    <a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[1],"id",0); ?>"><?php echo ($dataarray[1] == 0)? TASKMASTER : $database->getUserField($dataarray[1],"username",0); ?></a> <?php echo REPORT_FROM_VIL; ?><br>
<?php
if($dataarray[0] == 0){
	echo NONE;
}else{
	echo "<a href='karte.php?d=".$dataarray[0]."&amp;c=".$generator->getMapCheck($dataarray[0])."'>".$da0name."</a>";
}
?>
    </div>
</div></td><td class="f16"><img src="img/x.gif" class="bigArrow" alt=""></td><td class="s7"><div class="boxes boxesColor gray trade"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">

<div class="headline"><?php echo REPORT_RECEIVER; ?></div>
<a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[15],"id",0); ?>"><?php if($database->getUserField($dataarray['15'],"id",0)==2){ echo TRIBE5; }else{ echo $database->getUserField($dataarray['15'],"username",0); } ?></a> <?php echo REPORT_FROM_VIL; ?><br>
<a href="<?php echo "karte.php?d=".$dataarray[14]."&amp;c=".$generator->getMapCheck($dataarray[14]).""; ?>"><?php echo $da14name; ?></a>
</div>
				</div></td>
	</tr>
	</tbody>
	</table><table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
<td class="role"></td>
<td class="troopHeadline" colspan="11">
<a href="karte.php?z=<?php echo $dataarray[0]; ?>"><?php echo $da0name; ?></a> <?php echo REPORT_SEND_REINF_TO; ?> <a href="karte.php?z=<?php echo $da14name; ?>"><?php echo $da14name; ?></a>
</td>
</tr></thead>
<tbody class="units"><tr>
<th class="coords"></th>
<?php
$start = $dataarray[2] == 1? 1 : (($dataarray[2] == 2)? 11 : (($dataarray[2] == 3)? 21 : (($dataarray[2] == 4)? 31 : 41)));
for($i=$start;$i<=($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName(51)."\" alt=\"".$technology->getUnitName(51)."\" /></td>";

echo "</tr></tbody><tbody class=\"units last\"><tr><th>".REPORT_TROOPS."</th>";
for($i=3;$i<13;$i++) {
$unitarray['u'.($i-3+$start).''] = $dataarray[$i];
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}

if($dataarray[13] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    echo "<td class=\"unit last\">".$dataarray[13]."</td>";
    }
    
?></tr></tbody>

<tbody class="infos">
<tr><td class="empty" colspan="12"></td></tr>
<tr><th><?php echo REPORT_CLOCK; ?></th>
<?php
$fromcoor = $database->getCoor($dataarray[0]);
$from = array('x'=>$fromcoor['x'], 'y'=>$fromcoor['y']);
$tocoor = $database->getCoor($dataarray[14]);
$to = array('x'=>$tocoor['x'], 'y'=>$tocoor['y']);
$time = $generator->procDistanceTime($from,$to,300,0);
?>
<td colspan="11">
<img src="img/x.gif" class="clock" title="<?php echo REPORT_CLOCK; ?>"><?php echo $generator->getTimeFormat($time); ?></td>
</tr></tbody>

<tbody class="infos">
<tr><td class="empty" colspan="12"></td></tr>
<tr><th><?php echo REPORT_UPKEEP; ?></th>
<td colspan="11">
<?php echo $technology->getUpkeep($unitarray,$dataarray[2]); ?> <img src="img/x.gif" class="r4" title="<?php echo CROP; ?>"><?php echo REPORT_PER_HOURS; ?></td>
</tr></tbody></table></td></tr></tbody></table>
