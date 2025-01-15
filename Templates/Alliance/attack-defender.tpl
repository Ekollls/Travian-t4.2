<?php
$prefix = "".TB_PREFIX."ndata";
$limit = " (ntype>=4 AND ntype<=7) OR (ntype>17)";
$sql = mysql_query("SELECT * FROM $prefix WHERE ally = $session->alliance AND $limit ORDER BY time DESC LIMIT 20");
$query = mysql_num_rows($sql);

$noticeClass = array(NOTICE1,NOTICE2,NOTICE3,NOTICE4,NOTICE5,NOTICE6,NOTICE7,NOTICE8,NOTICE9,NOTICE10,NOTICE11,NOTICE12,NOTICE13,NOTICE14,NOTICE15,
				NOTICE16,NOTICE17,NOTICE18,NOTICE19,NOTICE20,NOTICE21,NOTICE22,NOTICE23);

if($query == 0) {        
    $outputList .= "<td colspan=\"4\" class=\"none\">".NOATTACKS."</td>";
}else{
	while($row = mysql_fetch_array($sql)){ 
		$dataarray = explode(",",$row['data']);
		$id = $row["id"];
		$toWref = $row["toWref"];
		$ally = $row["ally"];
		$topic = $row["topic"];
		$ntype = $row["ntype"];
		$data = $row["data"];
		$time = $row["time"];
		$viewed = $row["viewed"];
		$archive = $row["archive"];
		
		$outputList .= "<tr>";
		$outputList .= "<td class=\"sub\">";
		if($ntype==4 || $ntype==5 || $ntype==6 || $ntype==7){
			$type2 = '32';
		}else{
			$type2 = '31';
		}
		$outputList .= "<a href=\"allianz.php?s=3&f=".$type2."\">";
		$type = (isset($_GET['t']) && $_GET['t'] == 5)? $archive : $ntype;
		$outputList .= "<img src=\"img/x.gif\" class=\"iReport iReport$type\" title=\"".$noticeClass[$type]."\">";
		$outputList .= "</a>";
		$outputList .= "<div><a href=\"berichte.php?id=".$id."&aid=".$ally."\">";
		$attuname = $database->getUserField($dataarray[0],'username',0);
		if($dataarray['0']==3){ $attuname = TRIBE4; }elseif($dataarray['0']==3){ $attuname = TRIBE5; }
		$defuname = $database->getUserField($dataarray['30'],'username',0);
		if($dataarray['30']==3){ $defuname = TRIBE4; }elseif($dataarray['30']==3){ $defuname = TRIBE5; }
		
		if($ntype>15){  $outputList .= sprintf(REPORT_SCOUT,$attuname,$defuname); }else{ $outputList .= sprintf(REPORT_NORMALATTACK,$attuname,$defuname); }
		
		$outputList .= "</a></div></td>";

		$attAllyId = $database->getUserField($dataarray[0],'alliance',0);
		$attAllyName = $database->getAllianceName($attAllyId);
		if(!$attAllyId){
			$attTDName = "-";
		}else{
			$attTDName = "<a href=\"allianz.php?aid=".$attAllyId."\">".$attAllyName."</a>";
		}
		
		$defAllyId = $database->getUserField($dataarray[30],'alliance',0);
		$defAllyName = $database->getAllianceName($defAllyId);
		if(!$defAllyId){
			$defTDName = "-";
		}else{
			$defTDName = "<a href=\"allianz.php?aid=".$defAllyId."\">".$defAllyName."</a>";
		}
		
		$outputList .= "<td class=\"al\">".$attTDName.' vs '.$defTDName."</td>";
		$date = $generator->procMtime($time);
		$outputList .= "<td class=\"dat\">".$date[0]." ".date('H:i',$time)."</td>";
		$outputList .= "</tr>";
		
	}
}


?>
<table cellpadding="1" cellspacing="1" id="offs">
<thead>
<tr>
<td><?php echo PLAYER;?></td>
<td><?php echo SIDEINFO_ALLIANCE;?></td>
<td><?php echo DATE;?></td>
</tr>
</thead>

<tbody>
<?php echo $outputList; ?>
</tbody>
</table>
