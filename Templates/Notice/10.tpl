<?php
if(isset($_GET['aid']) && $_GET['aid']==$session->alliance){
	$dataarray = explode(",",$database->getNotice2($_GET['id'], 'data'));
    $rowtopic = $database->getNotice2($_GET['id'], 'topic');
	$topics = explode('[=]',$rowtopic); $topCount = count($topics);// var_dump($topCount); die;
	if($topCount==2) {if(defined($topics[1]))$topics[1]=constant($topics[1]);$topic = sprintf(constant($topics[0]),$topics[1]);} elseif($topCount==3) {$t1 = explode('[|]',$topics[1]); if(defined($t1[0]))$t1[0]=constant($t1[0]); for($i=1;$i<count($t1);$i++) $t1[0].=$t1[$i];
		$t2 = explode('[|]',$topics[2]); if(defined($t2[0]))$t2[0]=constant($t2[0]); for($i=1;$i<count($t2);$i++) $t2[0].=$t2[$i];
		$topic = sprintf(constant($topics[0]),$t1[0],$t2[0]);} else {$topic = $rowtopic;}
    $time = $database->getNotice2($_GET['id'], 'time');
}else{
	$dataarray = explode(",",$message->readingNotice['data']);
    $rowtopic = $message->readingNotice['topic'];
	$topics = explode('[=]',$rowtopic); $topCount = count($topics);// var_dump($topCount); die;
	if($topCount==2) {$topic = sprintf(constant($topics[0]),$topics[1]);} elseif($topCount==3) {$t1 = explode('[|]',$topics[1]); if(defined($t1[0]))$t1[0]=constant($t1[0]); for($i=1;$i<count($t1);$i++) $t1[0].=$t1[$i];
		$t2 = explode('[|]',$topics[2]); if(defined($t2[0]))$t2[0]=constant($t2[0]); for($i=1;$i<count($t2);$i++) $t2[0].=$t2[$i];
		$topic = sprintf(constant($topics[0]),$t1[0],$t2[0]);} else {$topic = $rowtopic;}
    $time = $message->readingNotice['time'];
}

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

					<div class="clear"></div></div><div class="clear"></div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr><td colspan="2" class="report_content">
			<img src="img/x.gif" class="reportImage reportType3" alt="">
<?php
		$SenderData = $database->getVillage($dataarray[0]);
        $senderID = $SenderData['owner'];
		$sender = $database->getUser($senderID,1);
        
        $ReceiveData = $database->getVillage($dataarray[1]);
        $receiveID = $ReceiveData['owner'];
		$receive = $database->getUser($receiveID,1);

if(defined($SenderData['name'])) $SenderData['name'] = constant($SenderData['name']);
if(defined($ReceiveData['name'])) $ReceiveData['name'] = constant($ReceiveData['name']);

?>
<table cellspacing="0" cellpadding="0" class="tbg">
	<tbody>
		<tr>
			<td class="s7">
				<div class="boxes boxesColor gray support"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><div class="headline"><?php echo REPORT_SENDER; ?></div>
					<a href="spieler.php?uid=<?php echo $senderID; ?>"><?php echo $sender['username']; ?></a><?php
                   		if($sender['alliance']!=0) {
                        echo " ".REPORT_FROM_ALLY."<br><a href=\"allianz.php?aid=".$sender['alliance']."\">".$database->getAllianceName($sender['alliance'])."</a>";
                        }
                        ?>
                    </div>
				</div>
              </td>
			<td class="f16">
				<img src="img/x.gif" class="bigArrow" alt="">
			</td>
			<td class="s7">
				<div class="boxes boxesColor gray support"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><div class="headline"><?php echo REPORT_RECEIVER; ?></div>
                <a href="spieler.php?uid=<?php echo $receiveID; ?>"><?php echo $receive['username']; ?></a><?php
                   		if($receive['alliance']!=0) {
                        echo " ".REPORT_FROM_ALLY."<br><a href=\"allianz.php?aid=".$receive['alliance']."\">".$database->getAllianceName($receive['alliance'])."</a>";
                        }
                        ?>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>
            

<table cellpadding="0" cellspacing="0" id="trade">
	<thead>
		<tr>
			<td colspan="2" class="troopHeadline">
				<?php
					echo sprintf(SEND_RES,
						'<a href="karte.php?d='.$dataarray[0].'&c='.$generator->getMapCheck($dataarray[0]).'">'.$SenderData['name'].'</a>',
						'<a href="karte.php?d='.$dataarray[1].'&c='.$generator->getMapCheck($dataarray[1]).'">'.$ReceiveData['name'].'</a>');
				?>
			</td>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td class="empty" colspan="2"></td>
		</tr>
		<tr>
			<th><?php echo REPORT_RESOURCES; ?></th>
			<td>
						<div class="rArea">
						<img class="r1" src="img/x.gif" title="<?php echo WOOD; ?>">
						<?php echo $dataarray[2]; ?></div>
									<div class="rArea">
						<img class="r2" src="img/x.gif" title="<?php echo CLAY; ?>">
						<?php echo $dataarray[3]; ?></div>
									<div class="rArea">
						<img class="r3" src="img/x.gif" title="<?php echo IRON; ?>">
						<?php echo $dataarray[4]; ?></div>
									<div class="rArea">
						<img class="r4" src="img/x.gif" title="<?php echo CROP; ?>">
						<?php echo $dataarray[5]; ?></div>
							</td>
		</tr>
		<tr>
			<td class="empty" colspan="2"></td>
		</tr>
		<tr>
			<th><?php echo REPORT_CLOCK; ?></th>
			<td><img src="img/x.gif" class="clock" title="<?php echo REPORT_CLOCK; ?>"> 
            0:00:00</td></tr>
	</tbody>
</table>
            

</td></tr></tbody></table>
<div class="clear">&nbsp;</div>
