<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include_once("GameEngine/Village.php");
if($session->access != ADMIN) { 
	echo "شما ادمين نيستيد لطفا تلاش نکنيد."; 
} 
else{
   include "Templates/html.tpl";  

if(isset($_POST['id'])){
	$id = $_POST['id'];
}

elseif(isset($_GET['id'])){
	$id = $_GET['id'];
}
else{
	$id = 0;
}
if(isset($_GET['ok'])){
	$id = -1;
}
   
   

?>
<body class="v35 webkit chrome statistics">
<script type="text/javascript">
			window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
		</script>
	<div id="background"> 
			<div id="headerBar"></div>
			<div id="bodyWrapper"> 
				<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> 
				<div id="header"> 

<?php 
	include("Templates/topheader.tpl");
	include("Templates/toolbar.tpl");

?>

	</div>
	<div id="center">
		<a id="ingameManual" href="help.php">
		<img class="question" alt="Help" src="img/x.gif">
		</a>

		<?php include("Templates/sideinfo.tpl"); ?>

		<div id="contentOuterContainer"> 

		<?php include("Templates/res.tpl"); ?>
							<div class="contentTitle">&nbsp;</div> 
							<div class="contentContainer"> 



<div id="content" class="statistics">
                                		<script type="text/javascript"> 
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>

<h1 class="titleInHeader">گزارش ها<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>


<div id="div_1">
<h4 class="round space">جستجو گزارشات</h4>
در اين قسمت شما قادر خواهيد بود با وارد کردن آي دي (شماره گزارش) اقدام به مشاهده گزارش کنيد
<br>
<form action="payam.php" method="post">
<table>
	<thead>
		<th colspan="6">اطلاعات</th>
	</thead>
	<tbody>
		<tr>
			<td>شماره گزارش</td>
			<td><input type="text" placeholder="شماره گزارش را وارد کنيد" maxlength="100" width="100" name="id"></td>
		</tr>
		<th colspan="4"><center><input type="submit" name="submit" value="بياب"  id="submit"></center></th>
</tbody>
</table>
</form>
<?php

if($id == 0){
?>
<br><br>
<h4 class="round space">کلیه گزارش های سرور</h4>
<br><br>

<?php
$noticeClass = array("گزارش جاسوسی","پیروزی در حمله بدون تلفات.","پیروزی در حمله با تلفات.","شکست در حمله با تلفات.","پیروزی در دفاع بدون تلفات.","پیروزی در دفاع با تلفات.","شکست در دفاع با تلفات.","شکست در دفاع بدون تلفات","نیروی کمکی","گزارش ماجراجویی.","تاجران بیشتر چوب مبادله کردند.","تاجران بیشتر خشت مبادله کردند.","تاجران بیشتر آهن مبادله کردند.","تاجران بیشتر گندم مبادله کردند.","","حمله به نیروی کمکی");
$prefix = "".TB_PREFIX."ndata";
$sql = mysql_query("SELECT * FROM $prefix ORDER BY time DESC");
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
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=2">2</a>';
	
}elseif ($page == 1 && $lastPage == 3) {
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=2">2</a> ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=3">3</a>';
	
}elseif ($page == 1) {
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a> ';
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add2 . '">' . $add2 . '</a> ... ';
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $lastPage . '">' . $lastPage . '</a>';
	
} else if ($page == $lastPage && $lastPage == 2) {
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=1">1</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span>';
	
} else if ($page == $lastPage && $lastPage == 3) {
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=1">1</a> ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=2">2</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span>';
	
} else if ($page == $lastPage) {
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=1">1</a> ... ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub2 . '">' . $sub2 . '</a> ';
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span>';
	
} else if ($page == ($lastPage - 1) && $lastPage == 3) {
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=1">1</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $lastPage . '">' . $lastPage . '</a>';

} else if ($page > 2 && $page < ($lastPage - 1)) {
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=1">1</a> ... ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a> ... ';
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $lastPage . '">' . $lastPage . '</a>';
	
}else if ($page == ($lastPage - 1)) {
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=1">1</a> ... ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $lastPage . '">' . $lastPage . '</a>';

} else if ($page > 1 && $page < $lastPage && $lastPage == 3) {
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a>';
    
} else if ($page > 1 && $page < $lastPage) {
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a> ... ';
	$centerPages .= '<a class="number" href="' . $_SERVER['PHP_SELF'] . '?page=' . $lastPage . '">' . $lastPage . '</a>';
}




$limit = 'LIMIT ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 
$sql2 = mysql_query("SELECT * FROM $prefix ORDER BY time DESC $limit");
$paginationDisplay = "";
$nextPage = $_GET['page'] + 1;
$previous = $_GET['page'] - 1;

if ($page == "1" && $lastPage == "1"){
$paginationDisplay .=  '<img alt="صفحه اول" src="img/x.gif" class="first disabled"> ';
$paginationDisplay .=  '<img alt="صفحه قبل" src="img/x.gif" class="previous disabled">';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<img alt="صفحه بعد" src="img/x.gif" class="next disabled"> ';
$paginationDisplay .=  '<img alt="صفحه آخر" src="img/x.gif" class="last disabled">';

}elseif ($lastPage == 0){
$paginationDisplay .=  '<img alt="صفحه اول" src="img/x.gif" class="first disabled"> ';
$paginationDisplay .=  '<img alt="صفحه قبل" src="img/x.gif" class="previous disabled">';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<img alt="صفحه بعد" src="img/x.gif" class="next disabled"> ';
$paginationDisplay .=  '<img alt="صفحه آخر" src="img/x.gif" class="last disabled">';

}elseif ($page == "1" && $lastPage != "1"){
$paginationDisplay .=  '<img alt="صفحه اول" src="img/x.gif" class="first disabled"> ';
$paginationDisplay .=  '<img alt="صفحه قبل" src="img/x.gif" class="previous disabled">';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<a class="next" href="' . $_SERVER['PHP_SELF'] . '?page=2"><img alt="صفحه بعد" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="last" href="' . $_SERVER['PHP_SELF'] . '?page=3"><img alt="صفحه آخر" src="img/x.gif"></a>';

}elseif ($page != "1" && $page != $lastPage){
$paginationDisplay .=  '<a class="first" href="' . $_SERVER['PHP_SELF'] . '?page=1"><img alt="صفحه اول" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="previous" href="' . $_SERVER['PHP_SELF'] . '?page=' . $previous . '"><img alt="صفحه قبل" src="img/x.gif"></a>';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<a class="next" href="' . $_SERVER['PHP_SELF'] . '?page=' . $nextPage . '"><img alt="صفحه بعد" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="last" href="' . $_SERVER['PHP_SELF'] . '?page=' . $lastPage . '"><img alt="صفحه آخر" src="img/x.gif"></a>';

}elseif ($page == $lastPage){
$paginationDisplay .=  '<a class="first" href="' . $_SERVER['PHP_SELF'] . '?page=1"><img alt="صفحه اول" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="previous" href="' . $_SERVER['PHP_SELF'] . '?page=' . $previous . '"><img alt="صفحه قبل" src="img/x.gif"></a>';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<img alt="صفحه بعد" src="img/x.gif" class="next disabled"> ';
$paginationDisplay .=  '<img alt="صفحه آخر" src="img/x.gif" class="last disabled">';
}


$outputList = '';
$namee = 1;
if($query == 0) {        
    $outputList .= "<td colspan=\"4\" class=\"none\">هیچ گزارش جدیدی موجود نیست.</td>";
}else{
while($row = mysql_fetch_array($sql2)){ 
    $id = $row["id"];
    $uid = $row["uid"];
    $toWref = $row["toWref"];
    $topic = $row["topic"];
    $ntype = $row["ntype"];
    $data = $row["data"];
    $time = $row["time"];
    $viewed = $row["viewed"];
    $archive = $row["archive"];
	$type = (isset($_GET['t']) && $_GET['t'] == 5)? $archive : $ntype;
    $dataarray = explode(",",$data);
    
    
    $outputList .= "<tr><td><a href=\"spieler.php?uid=".$uid."\">".$database->getUserField($uid,'username',0)."</a></td><td class=\"sub\">";
    
    if($type==9){
    	$outputList .= "<img src=\"img/x.gif\" class=\"iReport iReport21\" alt=\"".$noticeClass[$ntype]."\" title=\"".$noticeClass[$ntype]."\" /> <div>";
    }else{
    	$outputList .= "<img src=\"img/x.gif\" class=\"iReport iReport$type\" alt=\"".$noticeClass[$type]."\" title=\"".$noticeClass[$type]."\" /> <div>";
    }

if($type==1 || $type==2 || $type==5 || $type==6 || $type==7){
    if ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28] == 0) {
    $style = "empty";
	} elseif ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28] != $dataarray[29]) {
    $style = "half";
    } else {
    $style = "full";
    }
    $carry = ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28])."/".$dataarray[29];
    
    $outputList .= "<div class=\"reportInfoIcon\"><img title=\"".$carry."\" src=\"img/x.gif\" class=\"reportInfo carry ".$style."\"></div>";
    
}elseif($type==9){
$btype = $dataarray[1];
$type = $dataarray[2];
include "Templates/Auction/alt.tpl";
$typeArray = array("","helmet","body","leftHand","rightHand","shoes","horse","bandage25","bandage33","cage","scroll","ointment","bucketOfWater","bookOfWisdom","lawTables","artWork");
	if($dataarray[1]!='dead'){
    	if($dataarray[1]!=''){
			$outputList .= "<div class=\"reportInfoIcon\"><img title=\"".$name." (".$dataarray[3]."x)\" src=\"img/x.gif\" class=\"reportInfo itemCategory itemCategory_".$typeArray[$dataarray[1]]."\"></div>";
        }
    }else{
		$outputList .= "<div class=\"reportInfoIcon\"><img src=\"img/x.gif\" class=\"reportInfo adventureDifficulty0\" title=\"قهرمان کشته شد\"></div>";
	}
}
    $outputList .= "<a href=\"repo.php?id=".$id."\">".$topic." </a> ";
    if($viewed == 0) { $outputList .= "(جدید)"; }
    $date = $generator->procMtime($time);
    $outputList .= "</div><div class=\"clear\"></div></td>
			<td class=\"dat\">".$date[0]." ".date('H:i',$time)."</td></tr>";
	$namee++;
}
 }


?>
	<table cellpadding="1" cellspacing="1" id="overview" class="row_table_data">
		<thead>
		<tr>
		<th colspan="1">بازیکن</th>
		<th colspan="1">موضوع:</th>
		<th class="sent">فرستاده شده</th>
		</tr>
		</thead>
        <tbody>
   <?php 

    if(isset($_GET['s'])) {
    $s = $_GET['s'];
    }
    else {
    $s = 0;
    }
    
    print "$outputList";
    
    ?>

      
      
</tbody>
</table>

<div class="footer">

	  <div class="paginator">
	  <?php echo $paginationDisplay; ?>
      </div>

    <div class="clear"></div>
</div>
<?php
}
elseif($id > 0){
?>
<h4 class="round space">مشاهده گزارش</h4>
<br><br>

<?php

$inf = $database->mygetnitoce($id);
if(!empty($inf)){
$dataarray = explode(",",$inf['data']);
?>
				<table cellpadding="1" cellspacing="1" id="report_surround">
				<thead class="theader">
					<tr>
						<th colspan="2">
							<div id="subject">
								<div class="header label"><?php echo REPORT_SUBJECT; ?></div>
								<div class="header text"><?php echo $inf['topic']; ?></div>
								<div class="clear"></div>
							</div>

							<div id="time">
                            <?php $date = $generator->procMtime($inf['time']); ?>
								<div class="header label"><?php echo REPORT_SENT; ?></div>
								<div class="header text"><?php echo $date[0]."<span> ".REPORT_AT." ".$date[1]; ?></span></div>
                                <div class="clear"></div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr><td colspan="2" class="report_content">
			<img src="img/x.gif" class="reportImage reportType1" alt="">
            <table id="attacker" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<td class="role">
            <div class="boxes boxesColor red"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><div class="role"><?php echo REPORT_ATTACKER; ?></div></div></div>
            </td>
            <td class="troopHeadline" colspan="11">
            <a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[0],"id",0); ?>"><?php echo $database->getUserField($dataarray[0],"username",0); ?></a> <?php echo REPORT_FROM_VIL; ?> <a href="karte.php?d=<?php echo $dataarray[1]."&amp;c=".$generator->getMapCheck($dataarray[1]); ?>"><?php echo $database->getVillageField($dataarray[1],"name"); ?></a>

<div class="toolList">
<?php if($session->plus){ ?>
<button type="button" value="reportButton warsim" class="icon" title="<?php echo REPORT_WARSIM; ?>" onclick="window.location.href = 'warsim.php?bid=<?php echo $_GET[id]; ?>'; return false;"><img src="img/x.gif" class="reportButton warsim" alt="reportButton warsim" /></button>
<button type="button" value="reportButton repeat" class="icon" title="<?php echo REPORT_ATK_AGAIN; ?>" onclick="window.location.href = 'a2b.php?bid=<?php echo $_GET[id]; ?>'; return false;"><img src="img/x.gif" class="reportButton repeat" alt="reportButton repeat" /></button>
<?php } ?>
<div class="clear"></div></div>

</td></tr></thead>

<tbody class="units">
<tr><th class="coords"></th>
<?php
function getUnitName($i) {   
$unarray = array(1=>U1,U2,U3,U4,U5,U6,U7,U8,U9,U10,U11,U12,U13,U14,U15,U16,U17,U18,U19,U20,U21,U22,U23,U24,U25,U26,U27,U28,U29,U30,U31,U32,U33,U34,U35,U36,U37,U38,U39,U40,U41,U42,U43,U44,U45,U46,U47,U48,U49,U50,U0);  	  	
return $unarray[$i];  	
}  	   

if($dataarray[2] == 1){
$start = 1;
}
elseif($dataarray[2] == 2){
$start = 11;
}
 elseif($dataarray[2] == 3){
 $start = 21;
}
else{
$start = 41;
}
for($i=$start;$i<=($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".getUnitName($i)."\" alt=\"".getUnitName($i)."\" /></td>";
}
echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".getUnitName(51)."\" alt=\"".getUnitName(51)."\" /></td>";
echo "</tr><tr><th>".REPORT_TROOPS."</th>";
for($i=3;$i<=12;$i++) {
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
echo "</tr></tbody>";
echo "<tbody class=\"units last\"><tr><th>".REPORT_CASUALTIES."</th>";
for($i=14;$i<=23;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
	if($dataarray[24] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[24]."</td>";
    }

echo "</tr></tbody>";
if ($dataarray[151]!='' and $dataarray[152]!=''){ //ram

?>
	<tbody><tr><td class="empty" colspan="12"></td></tr></tbody>
    <tbody class="goods"><tr><th><?php echo REPORT_INFORMATION; ?></th><td style="text-align:right" colspan="11">
	<img class="unit u<?php echo $dataarray[151]; ?>" src="img/x.gif" alt="<?php echo $technology->unarray[$dataarray[151]]; ?>" title="<?php echo $technology->unarray[$dataarray[151]]; ?>" />
	<?php echo $dataarray[152]; ?>
    </td></tr></tbody>
<?php } 
if ($dataarray[153]!='' and $dataarray[154]!=''){ //cata
?>
	<tbody><tr><td class="empty" colspan="12"></td></tr></tbody>
    <tbody class="goods"><tr><th><?php echo REPORT_INFORMATION; ?></th><td style="text-align:right" colspan="11">
	<img class="unit g<?php echo $dataarray[153]; ?>Icon" src="img/x.gif" alt="<?php echo $technology->unarray[$dataarray[153]]; ?>" title="<?php echo $technology->unarray[$dataarray[153]]; ?>" />
	<?php echo $dataarray[154]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[155]!='' and $dataarray[156]!=''){ //chief
?>
	<tbody><tr><td class="empty" colspan="12"></td></tr></tbody>
    <tbody class="goods"><tr><th><?php echo REPORT_INFORMATION; ?></th><td style="text-align:right" colspan="11">
	<img class="unit u<?php echo $dataarray[155]; ?>" src="img/x.gif" alt="<?php echo $technology->unarray[$dataarray[155]]; ?>" title="<?php echo $technology->unarray[$dataarray[155]]; ?>" />
	<?php echo $dataarray[156]; ?>
    </td></tr></tbody>
<?php } ?>
<?php if ($dataarray[157]!='' and $dataarray[158]!=''){ //spy
?>
    <tbody><tr><td class="empty" colspan="12"></td></tr></tbody>
    <tbody class="goods"><tr><th><?php echo REPORT_INFORMATION; ?></th><td style="text-align:right" colspan="11">
    <?php echo $dataarray[158]; ?>
    </td></tr></tbody>
<?php } ?>


<tbody><tr><td class="empty" colspan="12"></td></tr></tbody>
<tbody class="goods">
	<tr><th><?php echo REPORT_BOUNTY; ?></th>
    <td colspan="11">
    <div class="res">
    <div class="rArea">
    <img class="r1" src="img/x.gif" title="<?php echo LUMBER; ?>"><?php echo $dataarray[25]; ?></div>
    <div class="rArea">
    <img class="r2" src="img/x.gif" title="<?php echo CLAY; ?>"><?php echo $dataarray[26]; ?></div>
    <div class="rArea">
    <img class="r3" src="img/x.gif" title="<?php echo IRON; ?>"><?php echo $dataarray[27]; ?></div>
    <div class="rArea">
    <img class="r4" src="img/x.gif" title="<?php echo CROP; ?>"><?php echo $dataarray[28]; ?></div>
    </div>
    <div class="clear"></div>
    <div class="carry">
    <?php
    if ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28] == 0) {
    echo"<img title=\"";
    echo ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28])."/".$dataarray[29];
    echo"\" src=\"img/x.gif\" class=\"carry empty\">";
	} elseif ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28] != $dataarray[29]) {
    echo "<img title=\"";
    echo ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28])."/".$dataarray[29];
    echo"\" src=\"img/x.gif\" class=\"carry half\">";
    } else {
    echo"<img title=\"";
    echo ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28])."/".$dataarray[29];
    echo"\" src=\"img/x.gif\" class=\"carry full\">";
    }
    ?>
    <?php echo ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28])."/".$dataarray[29]; ?>
    </div>
    </td>
    </tr>
</tbody>
</table>

<?php
include "GameEngine/Technology.php";
$targettribe = $dataarray['33'];
if(isset($targettribe)){
$ddd = '36';
include "Templates/Notice/tribe_".$targettribe.".tpl";
for($s=1;$s<=5;$s++){
	if($s != $targettribe){
    	if($dataarray[$ddd]==1){
    		include "Templates/Notice/tribe_".$s.".tpl";
        }
    }
    $ddd += '23';
}
}
?>	
</td></tr></tbody></table>
<div class="clear">&nbsp;</div>								

<?php

}
else{
echo "نامه ای با این مشخصات موجود نیست";

}
}
?>

<div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>


</div>
<div class="contentFooter">&nbsp;</div>

					</div>
<?php  
include("Templates/rightsideinfor.tpl");		
?>
				<div class="clear"></div>
</div>
<?php 
include("Templates/footer.tpl"); 
include("Templates/header.tpl");
?>
</div>
<div id="ce"></div>
</div>
</body>
</html>
<?php }
?>

