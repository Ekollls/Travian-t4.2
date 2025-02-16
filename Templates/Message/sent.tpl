<?php
$prefix = "".TB_PREFIX."mdata";
$sql = mysql_query("SELECT * FROM $prefix WHERE owner = $session->uid ORDER BY time DESC");
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
$sql2 = mysql_query("SELECT * FROM $prefix WHERE owner = $session->uid ORDER BY time DESC $limit");
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
$paginationDisplay .=  '<a class="next" href="' . $_SERVER['PHP_SELF'] . '?page=' . $nextPage . '"><img alt="'.NEXTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="last" href="' . $_SERVER['PHP_SELF'] . '?page=' . $lastPage . '"><img alt="'.LASTPAGE.'" src="img/x.gif"></a>';

}elseif ($page != "1" && $page != $lastPage){
$paginationDisplay .=  '<a class="first" href="' . $_SERVER['PHP_SELF'] . '?page=1"><img alt="'.FIRSTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="previous" href="' . $_SERVER['PHP_SELF'] . '?page=' . $previous . '"><img alt="'.PREVPAGE.'" src="img/x.gif"></a>';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<a class="next" href="' . $_SERVER['PHP_SELF'] . '?page=' . $nextPage . '"><img alt="'.NEXTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="last" href="' . $_SERVER['PHP_SELF'] . '?page=' . $lastPage . '"><img alt="'.LASTPAGE.'" src="img/x.gif"></a>';

}elseif ($page == $lastPage){
$paginationDisplay .=  '<a class="first" href="' . $_SERVER['PHP_SELF'] . '?page=1"><img alt="'.FIRSTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="previous" href="' . $_SERVER['PHP_SELF'] . '?page=' . $previous . '"><img alt="'.PREVPAGE.'" src="img/x.gif"></a>';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<img alt="'.NEXTPAGE.'" src="img/x.gif" class="next disabled"> ';
$paginationDisplay .=  '<img alt="'.LASTPAGE.'" src="img/x.gif" class="last disabled">';
}


$outputList = '';
$name = 1;
if($query == 0) {        
    $outputList .= "<td colspan=\"4\" class=\"none\">".NOMSGINBOX."</td>";
}else{
while($row = mysql_fetch_array($sql2)){ 
    $id = $row["id"];
    $target = $row["target"];
    $owner = $row["owner"];
    $topic = $row["topic"];
    $message = $row["message"];
    $viewed = $row["viewed"];
    $archived = $row["archived"];
    $send = $row["send"];
    $time = $row["time"];
	
    
    $outputList .= "<tr><td class=\"sel\"><input class=\"check\" type=\"checkbox\" name=\"n".$name."\" value=\"".$id."\" /></td><td class=\"subject\"><div class=\"subjectWrapper\">";
	if($viewed == 0) {
		$viewedclass = "Unread";
		$viewed = UNREAD;
	} else { 
		$viewedclass = "Read";
		$viewed = READ;
	}
    $outputList .= "<img src=\"img/x.gif\" class=\"messageStatus messageStatus".$viewedclass."\" alt=\"".$viewed."\">
				<a href=\"nachrichten.php?id=".$id."\">".$topic."</a></div></td>";
    $date = $generator->procMtime($time);
    if($owner <= 1) {
    $outputList .= "<td class=\"send\"><a><u>".$database->getUserField($target,'username',0)."</u></a></td><td class=\"dat\">".$date[0]." ".$date[1]."</td>";
    }else {
    $outputList .= "<td class=\"send\"><a href=\"spieler.php?uid=".$target."\">".$database->getUserField($target,'username',0)."</a></td><td class=\"dat\">".$date[0]." ".date('H:i',$time)."</td>";
    }
    
	$name++;
}
 }


?>
<form method="post" action="nachrichten.php?t=2" name="msg">

<table cellpadding="1" cellspacing="1" id="overview" class="inbox">
		<thead>
			<tr>
				<th colspan="2"><?php echo SUBJECT;?></th>
				<th class="send"><?php echo REPORT_SENDER;?></th>
				<th class="dat"><b><?php echo REPORT_SENT;?></b></th>
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

<div class="administration">
<?php if($session->plus) { ?>
			<div class="checkAll">
			<input class="check" type="checkbox" id="sAll" onclick="
				$(this).up('form').getElements('input[type=checkbox]').each(function(element)
				{
					element.checked = this.checked;
				}, this);
			">
			<span><label for="sAll"><?php echo SELECTALL;?></label></span>
            </div>
<?php } ?>

	  <div class="paginator">
	  <?php echo $paginationDisplay; ?>
      </div>
    <div class="clear"></div>
</div><p>
<input type="hidden" name="t" value="2"/>
<?php if(!$session->is_sitter) { ?>
<button name="delmsg" type="submit" value="del" id="del" class="green delete">
	<div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">
<?php echo DELETE;?></div></div>
</button>
                    
<?php if($session->plus) { ?>
<button name="archive" type="submit" value="archive" id="archive" class="green delete">
	<div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">
<?php echo ARCHIVE;?></div></div>
</button>
<input name="ft" value="m3" type="hidden" />

<?php } } ?>

</form>
