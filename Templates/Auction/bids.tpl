<span class="error"><?php if(isset($bidError)) echo $bidError; ?></span>
<div id="auction">
<div id="filter">
	<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
    <div class="wrapper">

<div class="silver"><img title="<?php echo TTWARSILVERCOIN;?>" class="silver" src="img/x.gif"> <?php $now = $database->getAuctionSilver($session->uid); echo ($session->silver - $now['silver']); ?> / <?php echo $session->silver; ?></div>

<div class="filterContainer">
<button title="<?php echo FILTER1;?>" type="button" value="itemCategory itemCategory_helmet" <?php if(isset($_GET['filter']) && $_GET['filter'] == 1) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=1'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_helmet" alt="itemCategory itemCategory_helmet"></button>
<button title="<?php echo FILTER2;?>" type="button" value="itemCategory itemCategory_body" <?php if(isset($_GET['filter']) && $_GET['filter'] == 2) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=2'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_body" alt="itemCategory itemCategory_body"></button>
<button title="<?php echo FILTER3;?>" type="button" value="itemCategory itemCategory_leftHand" <?php if(isset($_GET['filter']) && $_GET['filter'] == 3) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=3'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_leftHand" alt="itemCategory itemCategory_leftHand"></button>
<button title="<?php echo FILTER4;?>" type="button" value="itemCategory itemCategory_rightHand" <?php if(isset($_GET['filter']) && $_GET['filter'] == 4) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=4'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_rightHand" alt="itemCategory itemCategory_rightHand"></button>
<button title="<?php echo FILTER5;?>" type="button" value="itemCategory itemCategory_shoes" <?php if(isset($_GET['filter']) && $_GET['filter'] == 5) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=5'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_shoes" alt="itemCategory itemCategory_shoes"></button>
<button title="<?php echo FILTER6;?>" type="button" value="itemCategory itemCategory_horse" <?php if(isset($_GET['filter']) && $_GET['filter'] == 6) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=6'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_horse" alt="itemCategory itemCategory_horse"></button>
<button title="<?php echo FILTER7;?>" type="button" value="itemCategory itemCategory_bandage25" <?php if(isset($_GET['filter']) && $_GET['filter'] == 7) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=7'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_bandage25" alt="itemCategory itemCategory_bandage25"></button>
<button title="<?php echo FILTER8;?>" type="button" value="itemCategory itemCategory_bandage33" <?php if(isset($_GET['filter']) && $_GET['filter'] == 8) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=8'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_bandage33" alt="itemCategory itemCategory_bandage33"></button>
<button title="<?php echo FILTER9;?>" type="button" value="itemCategory itemCategory_cage" <?php if(isset($_GET['filter']) && $_GET['filter'] == 9) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=9'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_cage" alt="itemCategory itemCategory_cage"></button>
<button title="<?php echo FILTER10;?>" type="button" value="itemCategory itemCategory_scroll" <?php if(isset($_GET['filter']) && $_GET['filter'] == 10) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=10'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_scroll" alt="itemCategory itemCategory_scroll"></button>
<button title="<?php echo FILTER11;?>" type="button" value="itemCategory itemCategory_ointment" <?php if(isset($_GET['filter']) && $_GET['filter'] == 11) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=11'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_ointment" alt="itemCategory itemCategory_ointment"></button>
<button title="<?php echo FILTER12;?>" type="button" value="itemCategory itemCategory_bucketOfWater" <?php if(isset($_GET['filter']) && $_GET['filter'] == 12) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=12'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_bucketOfWater" alt="itemCategory itemCategory_bucketOfWater"></button>
<button title="<?php echo FILTER13;?>" type="button" value="itemCategory itemCategory_bookOfWisdom" <?php if(isset($_GET['filter']) && $_GET['filter'] == 13) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=13'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_bookOfWisdom" alt="itemCategory itemCategory_bookOfWisdom"></button>
<button title="<?php echo FILTER14;?>" type="button" value="itemCategory itemCategory_lawTables" <?php if(isset($_GET['filter']) && $_GET['filter'] == 14) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=14'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_lawTables" alt="itemCategory itemCategory_lawTables"></button>
<button title="<?php echo FILTER15;?>" type="button" value="itemCategory itemCategory_artWork" <?php if(isset($_GET['filter']) && $_GET['filter'] == 15) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = '?action=bids&amp;filter=15'; return false;"><img src="img/x.gif" class="itemCategory itemCategory_artWork" alt="itemCategory itemCategory_artWork"></button>
</div>
	<div class="clear"></div>
		</div></div></div></div>
<?php
$prefix = "".TB_PREFIX."auction";
	if(isset($_GET['filter'])){ $mmm = "AND btype=".$_GET['filter']; }else{ $mmm = ""; }
$sql = mysql_query("SELECT * FROM $prefix WHERE finish = 0 and uid = $session->uid $mmm ORDER BY time ASC");
$query = mysql_num_rows($sql); // دریافت تعداد کوئری ها از دیتابیس

if(isset($_GET['filter'])){ $mmm = "AND btype=".$_GET['filter']; }else{ $mmm = ""; }
$sql2 = mysql_query("SELECT * FROM $prefix WHERE finish = 0 and uid = $session->uid $mmm ORDER BY time ASC");


$typeArray = array("","helmet","body","leftHand","rightHand","shoes","horse","bandage25","bandage33","cage","scroll","ointment","bucketOfWater","bookOfWisdom","lawTables","artWork");


$outputList = '';
$timer = 1;
if($query == 0) {        
    $outputList .= "<td colspan=\"7\" class=\"none\"><center>Items not found.</center></td>";
}else{
while($row = mysql_fetch_array($sql2)){ 
$id = $row["id"];$owner = $row["owner"];$btype = $row["btype"];$type = $row["type"];$num = $row["num"];$uid = $row["uid"];$bids = $row["bids"];$silver = $row["silver"];$time = $row["time"];

include "Templates/Auction/alt.tpl";
    
    if(isset($_GET['a']) && $_GET['a']==$id){
    	$sStyle = " selected";
        $switchStyle = "Opened";
        }else{
        $sStyle = "";
        $switchStyle = "Closed";
        }
	$outputList .= "<tr><td class=\"".$sStyle."\"></td><td class=\"icon".$sStyle."\"><img class=\"itemCategory itemCategory_".$typeArray[$btype]."\" src=\"img/x.gif\" title=\"".$name."||".$title."\"></td>";
	
	$outputList .= "<td class=\"name".$sStyle."\">".$num." x ".$name."</td>";
	$outputList .= "<td class=\"bids".$sStyle."\">";
    if($bids==0){ $outputList .= "<span class=\"none\">".$bids."</span>"; }else{ $outputList .= $bids; }
    $outputList .= "</td>";
	$outputList .= "<td class=\"silver".$sStyle."\" title=\"".round($silver/$num, 2)." ".FOREACHUNIT."\">".$silver."</td>";
	$outputList .= "<td class=\"time".$sStyle."\"><span id=\"timer".$timer."\">".$generator->getTimeFormat($time-time())."</span></td>";
	$outputList .= "";
    
    if($session->silver > $silver){
    	if(isset($_GET['page'])){
        	$pURL = "&page=".$_GET['page'];
        }
        if(isset($_GET['filter'])){
        	$fURL = "&filter=".$_GET['filter'];
        }
    	if($session->uid == $uid){ $bidd = CHANGEBID; }else{ $bidd = BID; }
   
    	$outputList .= "<td class=\"bid".$sStyle."\"><a class=\"bidButton openedClosedSwitch switch".$switchStyle."\" href=\"?action=bids".$pURL."".$fURL."&a=".$id."\">".$bidd."</a></td>";
    }else{
    	$outputList .= "<td class=\"notEnoughSilver".$sStyle."\">".SILVERSHORTAGE."</td>";
    }
	$outputList .= "</tr>";
    
	if(isset($_GET['a']) && $_GET['a']==$id){
    $outputList .= "<tr><td class=\"icon selected\"></td><td class=\"icon selected\"></td><td colspan=\"5\" class=\"name selected detail\">";
	$outputList .= "<form class=\"auctionDetails\" id=\"auctionDetails".$_GET['a']."\" action=\"hero_auction.php\" method=\"POST\">";
    $outputList .= "<input type=\"hidden\" name=\"page\" value=\"".$_GET['page']."\">";
    $outputList .= "<input type=\"hidden\" name=\"filter\" value=\"".$_GET['filter']."\">";
    $outputList .= "<input type=\"hidden\" name=\"action\" value=\"".$_GET['action']."\">";
    $outputList .= "<input type=\"hidden\" name=\"z\" value=\"1ce\">";
    $outputList .= "<input type=\"hidden\" name=\"silver\" value=\"".$silver."\">";
    $outputList .= "<input type=\"hidden\" name=\"a\" value=\"".$_GET['a']."\">";
    $outputList .= "<div class=\"bidHeadline\">".BIDFOR." ".$num." × ".$name."</div><div>";
    $outputList .=  CURRENTBID.": <img title=\"".TTWARSILVERCOIN."\" class=\"silver\" src=\"img/x.gif\"> <span>".$silver."</span><br>".CURRENTBIDDER.": ";
    if($uid!=0){ $outputList .= "".$database->getUserField($uid,username,0).""; }
    if($session->uid == $uid){ $bidvalue = $silver; }else{ $bidvalue = ""; }
    $outputList .= "<span></span><br>".MAXBID.":<input class=\"maxBid text\" type=\"text\" name=\"maxBid\" value=\"".$bidvalue."\">";
    $outputList .= "<span> (".MINBID." <img title=\"".TTWARSILVERCOIN."\" class=\"silver\" src=\"img/x.gif\"> ".$silver.")</span>";
    $outputList .= '<div class="submitBid"><button type="submit" value="'.BID.'" class="green "><div class="button-container addHoverClick "><div class="button-background"><div class="buttonStart"><div class="buttonEnd"><div class="buttonMiddle"></div></div></div></div><div class="button-content">'.BID.'</div></div></button></div></div></form></td></tr>';
	}
    
    $timer++;
}
 }


?>
<table class="currentBid" cellspacing="1" cellpadding="1">
	<thead>
		<tr>
			<th class="name" colspan="3"><?php echo DESCRIPTION;?></th>
			<th class="bids"><img alt="<?php echo BIDS;?>" class="bids" src="img/x.gif"></th>
			<th class="silver"><img alt="<?php echo TTWARSILVERCOIN;?>" class="silver" src="img/x.gif"></th>
			<th class="time"><img alt="<?php echo DURATION;?>" class="clock" src="img/x.gif"></th>
			<th class="bid"><?php echo AUCTIONS;?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $outputList; ?> 
	</tbody>
</table>
<?php
$prefix = "".TB_PREFIX."auction";
$sql = mysql_query("SELECT * FROM $prefix WHERE finish = 1 and uid = $session->uid ORDER BY time DESC");
$query = mysql_num_rows($sql); // دریافت تعداد کوئری ها از دیتابیس

if (isset($_GET['page'])) { // دریافت شماره صفحه
    $page = preg_replace('#[^0-9]#i', '', $_GET['page']); // فیلتر کردن همه چیز به جز اعداد
} else {
    $page = 1;
} 

$itemsPerPage = 10; //تعداد آیتم های قابل نمایش در هر صفحه
$lastPage = ceil($query / $itemsPerPage); // دریافت مقدار آخرین صفحه

if ($page < 1) {
    $page = 1;
} else if ($page > $lastPage) {
    $page = $lastPage;
} 
$centerPages = "";
$sub1 = $page - 1;
$sub2 = $page - 2;
$sub3 = $page - 3;
$add1 = $page + 1;
$add2 = $page + 2;
$add3 = $page + 3;

if ($page <= 1 && $lastPage <= 1) {
    $centerPages .= '<span class="number currentPage">1</span>';
	
}elseif ($page == 1 && $lastPage == 2) {
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?action=bids&page=2">2</a>';
	
}elseif ($page == 1 && $lastPage == 3) {
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?action=bids&page=2">2</a> ';
    $centerPages .= '<a class="number" href="?action=bids&page=3">3</a>';
	
}elseif ($page == 1) {
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?action=bids&page=' . $add1 . '">' . $add1 . '</a> ';
	$centerPages .= '<a class="number" href="?action=bids&page=' . $add2 . '">' . $add2 . '</a> ... ';
	$centerPages .= '<a class="number" href="?action=bids&page=' . $lastPage . '">' . $lastPage . '</a>';
	
} else if ($page == $lastPage && $lastPage == 2) {
	$centerPages .= '<a class="number" href="?action=bids&page=1">1</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span>';
	
} else if ($page == $lastPage && $lastPage == 3) {
	$centerPages .= '<a class="number" href="?action=bids&page=1">1</a> ';
    $centerPages .= '<a class="number" href="?action=bids&page=2">2</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span>';
	
} else if ($page == $lastPage) {
	$centerPages .= '<a class="number" href="?action=bids&page=1">1</a> ... ';
    $centerPages .= '<a class="number" href="?action=bids&page=' . $sub2 . '">' . $sub2 . '</a> ';
	$centerPages .= '<a class="number" href="?action=bids&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span>';
	
} else if ($page == ($lastPage - 1) && $lastPage == 3) {
    $centerPages .= '<a class="number" href="?action=bids&page=1">1</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
	$centerPages .= '<a class="number" href="?action=bids&page=' . $lastPage . '">' . $lastPage . '</a>';

} else if ($page > 2 && $page < ($lastPage - 1)) {
    $centerPages .= '<a class="number" href="?action=bids&page=1">1</a> ... ';
    $centerPages .= '<a class="number" href="?action=bids&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?action=bids&page=' . $add1 . '">' . $add1 . '</a> ... ';
	$centerPages .= '<a class="number" href="?action=bids&page=' . $lastPage . '">' . $lastPage . '</a>';
	
}else if ($page == ($lastPage - 1)) {
    $centerPages .= '<a class="number" href="?action=bids&page=1">1</a> ... ';
    $centerPages .= '<a class="number" href="?action=bids&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
	$centerPages .= '<a class="number" href="?action=bids&page=' . $lastPage . '">' . $lastPage . '</a>';

} else if ($page > 1 && $page < $lastPage && $lastPage == 3) {
    $centerPages .= '<a class="number" href="?action=bids&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?action=bids&page=' . $add1 . '">' . $add1 . '</a>';
    
} else if ($page > 1 && $page < $lastPage) {
    $centerPages .= '<a class="number" href="?action=bids&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?action=bids&page=' . $add1 . '">' . $add1 . '</a> ... ';
	$centerPages .= '<a class="number" href="?action=bids&page=' . $lastPage . '">' . $lastPage . '</a>';
}



$paginationDisplay = "";
$nextPage = isset($_GET['page'])? $_GET['page'] + 1:0;
$previous = isset($_GET['page'])? $_GET['page'] - 1:0;

if ($page == "1" && $lastPage == "1"){
$paginationDisplay .=  '<img alt="'.FIRSTPAGE.'" src="img/x.gif" class="first disabled"> ';
$paginationDisplay .=  '<img alt="'.PREVPAGE.'" src="img/x.gif" class="previous disabled">';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<img alt="'.NEXTPAGE.'" src="img/x.gif" class="next disabled"> ';
$paginationDisplay .=  '<img alt="'.LASTPAGE.'" src="img/x.gif" class="last disabled">';

}elseif ($lastPage == 0){
$paginationDisplay .=  '<img alt="'.FIRSTPAGE.'" src="img/x.gif" class="first disabled"> ';
$paginationDisplay .=  '<img alt="'.PREVPAGE.'" src="img/x.gif" class="previous disabled">';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<img alt="'.NEXTPAGE.'" src="img/x.gif" class="next disabled"> ';
$paginationDisplay .=  '<img alt="'.LASTPAGE.'" src="img/x.gif" class="last disabled">';

}elseif ($page == "1" && $lastPage != "1"){
$paginationDisplay .=  '<img alt="'.FIRSTPAGE.'" src="img/x.gif" class="first disabled"> ';
$paginationDisplay .=  '<img alt="'.PREVPAGE.'" src="img/x.gif" class="previous disabled">';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<a class="next" href="?action=bids&page=' . $nextPage . '"><img alt="'.NEXTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="last" href="?action=bids&page=' . $lastPage . '"><img alt="'.LASTPAGE.'" src="img/x.gif"></a>';

}elseif ($page != "1" && $page != $lastPage){
$paginationDisplay .=  '<a class="first" href="?action=bids&page=1"><img alt="'.FIRSTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="previous" href="?action=bids&page=' . $previous . '"><img alt="'.PREVPAGE.'" src="img/x.gif"></a>';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<a class="next" href="?action=bids&page=' . $nextPage . '"><img alt="'.NEXTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="last" href="?action=bids&page=' . $lastPage . '"><img alt="'.LASTPAGE.'" src="img/x.gif"></a>';

}elseif ($page == $lastPage){
$paginationDisplay .=  '<a class="first" href="?action=bids&page=1"><img alt="'.FIRSTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="previous" href="?action=bids&page=' . $previous . '"><img alt="'.PREVPAGE.'" src="img/x.gif"></a>';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<img alt="'.NEXTPAGE.'" src="img/x.gif" class="next disabled"> ';
$paginationDisplay .=  '<img alt="'.LASTPAGE.'" src="img/x.gif" class="last disabled">';
}

$limit = 'LIMIT ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 
$sql2 = mysql_query("SELECT * FROM $prefix WHERE finish = 1 and uid = $session->uid ORDER BY time DESC $limit");


$typeArray = array('','helmet','body','leftHand','rightHand','shoes','horse','bandage25','bandage33','cage','scroll'
			,'ointment','bucketOfWater','bookOfWisdom','lawTables','artWork');


$outputList = '';
$idd = 1;
if($query == 0) {        
    $outputList .= "<td colspan=\"7\" class=\"none\"><center>".NOITEM."</center></td>";
}else{
while($row = mysql_fetch_array($sql2)){ 
$id = $row["id"];$owner = $row["owner"];$btype = $row["btype"];$type = $row["type"];$num = $row["num"];$uid = $row["uid"];$bids = $row["bids"];$silver = $row["silver"];$time = $row["time"];

include "Templates/Auction/alt.tpl";
        
	$outputList .= "<tr><td class=\"delete\"><input type=\"checkbox\" name=\"b".$idd."\" value=\"".$id."\"></td>";
	$outputList .= "<td class=\"icon\"><img class=\"itemCategory itemCategory_".$typeArray[$btype]."\" src=\"img/x.gif\" title=\"".$name."||".$title."\"></td>";
	$outputList .= "<td class=\"name\">".$num." x ".$name."</td>";
	$outputList .= "<td class=\"bids\">".$bids."</td>";
	$outputList .= "<td class=\"silver win\">".$silver."</td>";
	$outputList .= "<td class=\"time\">Time</td>";
	$outputList .= "<td class=\"bid win\">Won</td></tr>";
    $idd++;
}
 }


?>
<form method="post" action="hero_auction.php">
	<h4 class="auctionEnded"><?php echo FINISHEDAUCTIONS;?></h4>
	<table cellspacing="1" cellpadding="1">
		<thead>
			<tr>
				<th class="name" colspan="3"><?php echo DESCRIPTION;?></th>
				<th class="bids"><img alt="<?php echo BIDS;?>" class="bids" src="img/x.gif"></th>
				<th class="silver"><img alt="<?php echo TTWARSILVERCOIN;?>" class="silver" src="img/x.gif"></th>
				<th class="time"><img alt="<?php echo DURATION;?>" class="clock" src="img/x.gif"></th>
				<th class="bid"><?php echo AUCTIONS;?></th>
			</tr>
		</thead>
		<tbody>
			
            <?php echo $outputList; ?>
		
        </tbody>
	</table>

	<div class="footer">
		<div id="markAll">
			<input class="check" type="checkbox" id="sAll" onclick="
				$(this).up('form').getElements('input[type=checkbox]').each(function(element)
				{
					element.checked = this.checked;
				}, this);
			">
			<span><label for="sAll"><?php echo SELECTALL;?></label></span>
		</div>
		<div class="paginator"><?php echo $paginationDisplay; ?></div>		<div class="clear"></div>
	</div>

	<div>
		<button type="submit" value="<?php echo DELETE;?>" name="del" id="del" class="green ">
	<div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">
		<?php echo DELETE;?></div></div></button>
        <input type="hidden" name="action" value="bids">
		<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
		<input type="hidden" name="filter" value="<?php echo $_GET['filter']; ?>">
	</div>
</form></div>
