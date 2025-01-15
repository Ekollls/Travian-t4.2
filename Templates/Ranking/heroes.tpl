<?php
if (isset($_POST['name']) && $_POST['name']!=''){
	$mydata = $database->getUser($_POST['name'],0);
	if(empty($mydata)){ $_POST['name']=$session->username; $err = USR_NT_FOUND;}
	$mydata = $database->getUser($_POST['name'],0);
} elseif (isset($_POST['rank'])){
	$aha = $database->getHeroRanking($limit);
	$hc = count($aha);
	if($_POST['rank']>$hc){ $_POST['rank']=$hc;} elseif($_POST['rank']<=0){ $_POST['rank']=1;}
	$myrank = $_POST['rank'];
	$i=0; $myid = $session->uid;
	foreach($aha as $row){$i+=1;if($i==$myrank) { $myid=$row['uid'];break;}}
	$mydata = $database->getUser($myid,1);
} else {
	$mydata = $database->getUser($session->username);
}

$aha = $database->getHeroRanking();
$myrank = 0;
foreach($aha as $row){
	$myrank++;
	if($row['uid']==$mydata['id']){break;}
}
if(!isset($_GET['page'])){
    if($myrank > 20){
        $_GET['page'] = intval(($myrank/20)+1);
    }else{
        $_GET['page'] = 1;
    }
}

?>
<h4 class="round"><?php echo TOPHEROS;?></h4>
<?php if(isset($err)) echo '<h5 style="color:#f00;">'.$err.'</h5>';?>
		<table cellpadding="1" cellspacing="1" id="heroes" class="row_table_data">
			<thead>
		<tr><td></td><td><?php echo NAME;?></td><td><?php echo LEVEL;?></td><td><?php echo EXPERIENCE;?></td></tr>
		</thead><tbody>
<?php

if (isset($_GET['page'])) {
    $page = preg_replace('#[^0-9]#i', '', $_GET['page']);
} else {
    $page = 1;
} 

$itemsPerPage = 20;
$ahaCount = count($aha);
$lastPage = ceil($ahaCount / $itemsPerPage);

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
    $centerPages .= '<a class="number" href="?tid=8&page=2">2</a>';
	
}elseif ($page == 1 && $lastPage == 3) {
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?tid=8&page=2">2</a> ';
    $centerPages .= '<a class="number" href="?tid=8&page=3">3</a>';
	
}elseif ($page == 1) {
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?tid=8&page=' . $add1 . '">' . $add1 . '</a> ';
	$centerPages .= '<a class="number" href="?tid=8&page=' . $add2 . '">' . $add2 . '</a> ... ';
	$centerPages .= '<a class="number" href="?tid=8&page=' . $lastPage . '">' . $lastPage . '</a>';
	
} else if ($page == $lastPage && $lastPage == 2) {
	$centerPages .= '<a class="number" href="?tid=8&page=1">1</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span>';
	
} else if ($page == $lastPage && $lastPage == 3) {
	$centerPages .= '<a class="number" href="?tid=8&page=1">1</a> ';
    $centerPages .= '<a class="number" href="?tid=8&page=2">2</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span>';
	
} else if ($page == $lastPage) {
	$centerPages .= '<a class="number" href="?tid=8&page=1">1</a> ... ';
    $centerPages .= '<a class="number" href="?tid=8&page=' . $sub2 . '">' . $sub2 . '</a> ';
	$centerPages .= '<a class="number" href="?tid=8&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span>';
	
} else if ($page == ($lastPage - 1) && $lastPage == 3) {
    $centerPages .= '<a class="number" href="?tid=8&page=1">1</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
	$centerPages .= '<a class="number" href="?tid=8&page=' . $lastPage . '">' . $lastPage . '</a>';

} else if ($page > 2 && $page < ($lastPage - 1)) {
    $centerPages .= '<a class="number" href="?tid=8&page=1">1</a> ... ';
    $centerPages .= '<a class="number" href="?tid=8&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?tid=8&page=' . $add1 . '">' . $add1 . '</a> ... ';
	$centerPages .= '<a class="number" href="?tid=8&page=' . $lastPage . '">' . $lastPage . '</a>';
	
}else if ($page == ($lastPage - 1)) {
    $centerPages .= '<a class="number" href="?tid=8&page=1">1</a> ... ';
    $centerPages .= '<a class="number" href="?tid=8&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
	$centerPages .= '<a class="number" href="?tid=8&page=' . $lastPage . '">' . $lastPage . '</a>';

} else if ($page > 1 && $page < $lastPage && $lastPage == 3) {
    $centerPages .= '<a class="number" href="?tid=8&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?tid=8&page=' . $add1 . '">' . $add1 . '</a>';
    
} else if ($page > 1 && $page < $lastPage) {
    $centerPages .= '<a class="number" href="?tid=8&page=' . $sub1 . '">' . $sub1 . '</a> ';
    $centerPages .= '<span class="number currentPage">' . $page . '</span> ';
    $centerPages .= '<a class="number" href="?tid=8&page=' . $add1 . '">' . $add1 . '</a> ... ';
	$centerPages .= '<a class="number" href="?tid=8&page=' . $lastPage . '">' . $lastPage . '</a>';
}



$paginationDisplay = "";
$nextPage = $_GET['page'] + 1;
$previous = $_GET['page'] - 1;

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
$paginationDisplay .=  '<a class="next" href="?tid=8&page=' . $nextPage . '"><img alt="'.NEXTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="last" href="?tid=8&page=' . $lastPage . '"><img alt="'.LASTPAGE.'" src="img/x.gif"></a>';

}elseif ($page != "1" && $page != $lastPage){
$paginationDisplay .=  '<a class="first" href="?tid=8&page=1"><img alt="'.FIRSTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="previous" href="?tid=8&page=' . $previous . '"><img alt="'.PREVPAGE.'" src="img/x.gif"></a>';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<a class="next" href="?tid=8&page=' . $nextPage . '"><img alt="'.NEXTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="last" href="?tid=8&page=' . $lastPage . '"><img alt="'.LASTPAGE.'" src="img/x.gif"></a>';

}elseif ($page == $lastPage){
$paginationDisplay .=  '<a class="first" href="?tid=8&page=1"><img alt="'.FIRSTPAGE.'" src="img/x.gif"></a> ';
$paginationDisplay .=  '<a class="previous" href="?tid=8&page=' . $previous . '"><img alt="'.PREVPAGE.'" src="img/x.gif"></a>';
$paginationDisplay .= $centerPages;
$paginationDisplay .=  '<img alt="'.NEXTPAGE.'" src="img/x.gif" class="next disabled"> ';
$paginationDisplay .=  '<img alt="'.LASTPAGE.'" src="img/x.gif" class="last disabled">';
}

	$limit = 'LIMIT ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 
	$ha = $database->getHeroRanking($limit);
    if(isset($_GET['page']) && $_GET['page'] > 1){
		$rank = ($_GET['page']-1)*20+1;
    }else{
    	$rank = 1;
    }
	foreach($ha as $row){ 
		if($row['uid'] == $mydata['id']) {
			echo "<tr class=\"hl\"><td class=\"ra fc\" >".$rank.".</td>";
		}else {
			echo "<tr class=\"hover\"><td class=\"ra \" >".$rank.".</td>";
		}
		echo "<td class=\"pla \" ><a href=\"spieler.php?uid=".$row['uid']."\">".$database->getUserField($row['uid'], 'username', 0)."</a></td>"; 
		echo "<td class=\"lev \" >".$row['level']."</td>";
        
        echo "<td class=\"xp \">".$row['experience']."</td></tr>";
    
		$rank++;
	}


?>
	</tbody>
</table>

<?php
if(!isset($_GET['tid'])){ $_GET['tid']='1'; }
?>
<div id="search_navi">
	<form method="post" action="statistiken.php?tid=<?php echo isset($_GET['tid'])? $_GET['tid'] : 1; ?>">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents w292">
            <table class="transparent">
                <tbody><tr>
                    <td>
                        <span><?php echo RANK;?> <input type="text" class="text ra" maxlength="5" name="rank" value="" /></span>
                    </td>
                    <td>
                        <span><?php echo NAME;?> <input type="text" class="text name" maxlength="20" name="name" value="" /></span>
                    </td>
                    <td>
                        <input type="hidden" name="ft" value="r<?php echo isset($_GET['tid'])? $_GET['tid'] : 1; ?>" />
<?php include("Templates/Ranking/ranksearch.tpl"); ?>
                    </td>
                </tr>
                </tbody>
            </table>
		</div>
		</div>
	</form>
<div class="paginator"><?php echo $paginationDisplay; ?></div>
</div>
<div class="clear">&nbsp;</div>
