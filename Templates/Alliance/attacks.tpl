 <?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$allianceinfo = $database->getAlliance($aid);
include("alli_menu.tpl");

?>
<div class="boxes boxesColor gray reportFilter offDef"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
<button type="button" value="att_all" <?php if(isset($_GET['f']) && $_GET['f'] == '31') { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'allianz.php?s=3&f=31'; return false;"><img src="img/x.gif" class="att_all" alt="att_all"></button>
<button type="button" value="def_all" <?php if(isset($_GET['f']) && $_GET['f'] == '32') { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'allianz.php?s=3&f=32'; return false;"><img src="img/x.gif" class="def_all" alt="def_all"></button>
</div>
				</div>
                <div class="clear"></div>
<h4 class="chartHeadline"><?php echo HEADER_ATTACKS;?></h4>
<?php
	if($_GET['f']==31){
		include "Templates/Alliance/attack-attacker.tpl";
    }elseif($_GET['f']==32){
		include "Templates/Alliance/attack-defender.tpl";
    }else{

$prefix = "".TB_PREFIX."ndata";
$limit = " ntype<=7 OR ntype=14 OR ntype>=16";
$sql = mysql_query("SELECT * FROM $prefix WHERE ally = $session->alliance AND $limit ORDER BY time DESC LIMIT 20");
$query = mysql_num_rows($sql);

$noticeClass = array(NOTICE1,NOTICE2,NOTICE3,NOTICE4,NOTICE5,NOTICE6,NOTICE7,NOTICE8,NOTICE9,NOTICE10,NOTICE11,NOTICE12,NOTICE13,NOTICE14,NOTICE15,
				NOTICE16,NOTICE17,NOTICE18,NOTICE19,NOTICE20,NOTICE21,NOTICE22,NOTICE23);

$outputList = '';
$name = 1;
if($query == 0) {        
    $outputList .= "<td colspan=\"4\" class=\"none\"><?php echo NOATTACKS;?></td>";
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
		
		$name++;
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
<?php } ?>

