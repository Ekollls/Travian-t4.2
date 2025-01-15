<?php
//echo 'start at '.date('H:i:s');
$showCropperOases = true;
$itemsPerPage = 20;
if(is_numeric($_GET['x']) AND is_numeric($_GET['y'])) {
	$coor2['x'] = $_GET['x'];
	$coor2['y'] = $_GET['y'];
} else {
	$wref2 = $village->wid;
	$coor2 = $database->getCoor($wref2);
}
?>
<h1 class="titleInHeader"><?php echo HEADER_CFTITLE; ?></h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?s" id="cropfinder_form">
	<div class="boxes boxesColor gray">
		<div class="boxes-tl"></div>
		<div class="boxes-tr"></div>
		<div class="boxes-tc"></div>
		<div class="boxes-ml"></div>
		<div class="boxes-mr"></div>
		<div class="boxes-mc"></div>
		<div class="boxes-bl"></div>
		<div class="boxes-br"></div>
		<div class="boxes-bc"></div>
		<div class="boxes-contents">
			<table class="transparent">
				<tbody>
					<tr>
						<td>
							<span class="coordInputLabel"><?php echo CF_COOR; ?></span>
							<div class="coordinatesInput">
								<div class="xCoord">
									<label for="xCoordInput">X:</label>
									<input maxlength="4" value="<?php print $coor2['x']; ?>" name="x" class="text">
								</div>
								<div class="yCoord">
									<label for="yCoordInput">Y:</label>
									<input maxlength="4" value="<?php print $coor2['y']; ?>" name="y" class="text">
								</div>
								<div class="clear"></div>
							</div>
							<span class="clear"></span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="type">
								<input type="radio" class="radio" name="type" value="15" <?php if($_GET['s'] == 1) { print 'checked="checked"'; } ?> />15 <?php echo CF_CROPPER; ?>
							</span>
							<span class="type">
								<input type="radio" class="radio" name="type" value="9" <?php if($_GET['s'] == 2) { print 'checked="checked"'; } ?> />9 <?php echo CF_CROPPER; ?>
							</span>
							<span class="type">
								<input type="radio" class="radio" name="type" value="both" <?php if($_GET['s'] == 3) { print 'checked="checked"'; } ?> /> <?php echo CF_BOTH; ?>
							</span>
						</td>
					</tr>
				</tbody>
				<br />
			</table><br />
		</div>
	</div>
	<button type="submit" value="<?php echo SEARCH; ?>" name="suchen" id="suchen">
		<div class="button-container">
			<div class="button-position">
				<div class="btl">
					<div class="btr">
						<div class="btc">
						</div>
					</div>
				</div>
				<div class="bml">
					<div class="bmr">
						<div class="bmc">
						</div>
					</div>
				</div>
				<div class="bbl">
					<div class="bbr">'
						<div class="bbc">
						</div>
					</div>
				</div>
			</div>
			<div class="button-contents"><?php echo SEARCH; ?></div>
		</div>
	</button>
	<div class="spacer"></div>
</form>

<?php
if(is_numeric($_GET['x']) AND is_numeric($_GET['y'])) {
	$coor['x'] = $_GET['x'];
	$coor['y'] = $_GET['y'];
} else {
	$coor = $database->getCoor($village->wid);
}

if(isset($_GET['s'])) {?>
<div class="spacer"></div>
<h4 class="round"><?php echo CROPPERS; ?></h4>
<table cellpadding="1" cellspacing="1" id="croplist">
	<thead>
		<tr>
			<th><?php echo DISTANCE; ?></th>
			<th><?php echo POSITION; ?></th>
			<th><?php echo TYPE; ?></th>
			<?php if ($showCropperOases) echo '<th>'.OASIS.'</th>';  ?>
			<th><?php echo OCCUPIEDBY; ?></th>
		</tr>
	</thead>
	<?php
	$order['by'] = 'distance';
	$order['x'] = $coor['x'];
	$order['y'] = $coor['y'];
	$order['max'] = 2 * WORLD_MAX + 1;;
	switch ($_GET['s']){
		case 1:
			$list['fieldtype'] = 6;
		break;
		case 2:
			$list['fieldtype'] = 1;
		break;
		default:
			$list['extra'] = '(fieldtype = 1 OR fieldtype = 6)';
		break;
	}
	$rowsCount = $database->getVillagesListCount($list);
	if(!isset($_GET['page'])) $_GET['page'] = 1;
	if (isset($_GET['page'])) {
		$page = preg_replace('#[^0-9]#i', '', $_GET['page']);
	} else {
		$page = 1;
	}
	
	$lastPage = ceil($rowsCount / $itemsPerPage);
	if ($page < 1) {
		$page = 1;
	} elseif ($page > $lastPage) {
		$page = $lastPage;
	}
	$limit = (($page - 1) * $itemsPerPage).',' .$itemsPerPage; 
	$rows = $database->getVillagesList($list,$limit,$order);
	foreach($rows as $row) {
		if ($showCropperOases) {
			unset($avOases);
			$avOases = Array();
			unset($order);
			unset($list);
			$order['by'] = 'distance';
			$order['x'] = $row['x'];
			$order['y'] = $row['y'];
			$order['max'] = 2 * WORLD_MAX + 1;
			$oases = $database->getVillageOasis($list,20,$order);
			foreach($oases as $o){ 
				if (($o['distance']<=4.9497474683058326708059105347339)){
					switch($o['type']) {
						case 3:
							$avOases[] = 25;
						break;
						case 6:
							$avOases[] = 25;
						break;
						case 9:
							$avOases[] = 25;
						break;
						case 10: case 11:
							$avOases[] = 25;
						break;
						case 12:
							$avOases[] = 50;
						break;
					}
				}
			}
			sort($avOases);
			$oPercent = 0;
			for($i=0;$i<3;$i++){
				if (isset($avOases[$i])) $oPercent += $avOases[$i];
			}
		}
		echo "<tr>";
		echo "<td class=\"dist\">".$row['distance']."</td>";
		echo "<td class=\"coords\">";
		echo "<a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">";
		echo "<span class=\"coordinateX\">(".$row['x']."|".$row['y'].")</span></a></td>";
		echo "<td class=\"typ\">".($row['fieldtype']==6?'15 ':'9 ').CF_CROPPER."</td>";
		if ($showCropperOases) echo "<td class=\"oase\"><span><img class='r4' src='img/x.gif' title='wheat'>".$oPercent."%</span></td>";
		if($row['occupied'] == 0) {
			echo "<td class=\"owned\"><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">----</a></td>";
		} else {
			echo "<td class=\"owned\"><a href=\"spieler.php?uid=".$database->getVillageField($row['id'], "owner")."\">".$database->getUserField($database->getVillageField($row['id'], "owner"), "username", 0)."</a></td>";
		}
		echo "</tr>";
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
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=2">2</a>';
	}elseif ($page == 1 && $lastPage == 3) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=2">2</a> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=3">3</a>';
	}elseif ($page == 1) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $add1 . '">' . $add1 . '</a> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $add2 . '">' . $add2 . '</a> ... ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $lastPage . '">' . $lastPage . '</a>';
	} elseif ($page == $lastPage && $lastPage == 2) {
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=1">1</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
	} elseif ($page == $lastPage && $lastPage == 3) {
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=1">1</a> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=2">2</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
	} elseif ($page == $lastPage) {
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $sub2 . '">' . $sub2 . '</a> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
	} elseif ($page == ($lastPage - 1) && $lastPage == 3) {
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=1">1</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $lastPage . '">' . $lastPage . '</a>';
	} elseif ($page > 2 && $page < ($lastPage - 1)) {
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $add1 . '">' . $add1 . '</a> ... ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $lastPage . '">' . $lastPage . '</a>';
	}elseif ($page == ($lastPage - 1)) {
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $lastPage . '">' . $lastPage . '</a>';
	} elseif ($page > 1 && $page < $lastPage && $lastPage == 3) {
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $add1 . '">' . $add1 . '</a>';
	} elseif ($page > 1 && $page < $lastPage) {
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $add1 . '">' . $add1 . '</a> ... ';
		$centerPages .= '<a class="number" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $lastPage . '">' . $lastPage . '</a>';
	}
	
	$paginationDisplay = "";
	$nextPage = $_GET['page'] + 1;
	$previous = $_GET['page'] - 1;

	if ($page == "1" && $lastPage == "1"){
		$paginationDisplay .=  '<img alt="Elso oldal" src="img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="Elozo oldal" src="img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="K\xF6vetkezo oldal" src="img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="Utols\xF3 oldal" src="img/x.gif" class="last disabled">';
	}elseif ($lastPage == 0){
		$paginationDisplay .=  '<img alt="Elso oldal" src="img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="Elozo oldal" src="img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="K\xF6vetkezo oldal" src="img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="Utols\xF3 oldal" src="img/x.gif" class="last disabled">';
	}elseif ($page == "1" && $lastPage != "1"){
		$paginationDisplay .=  '<img alt="Elso oldal" src="img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="Elozo oldal" src="img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<a class="next" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $nextPage . '"><img alt="K\xF6vetkezo oldal" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $lastPage . '"><img alt="Utols\xF3 oldal" src="img/x.gif"></a>';
	}elseif ($page != "1" && $page != $lastPage){
		$paginationDisplay .=  '<a class="first" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=1"><img alt="Elso oldal" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $previous . '"><img alt="Elozo oldal" src="img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<a class="next" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $nextPage . '"><img alt="K\xF6vetkezo oldal" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $lastPage . '"><img alt="Utols\xF3 oldal" src="img/x.gif"></a>';
	}elseif ($page == $lastPage){
		$paginationDisplay .=  '<a class="first" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=1"><img alt="Elso oldal" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="?'.($_GET['s']?'s='.$_GET['s']:'').($_GET['x']?'&x='.$_GET['x']:'').($_GET['y']?'&y='.$_GET['y']:'').'&page=' . $previous . '"><img alt="Elozo oldal" src="img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="K\xF6vetkezo oldal" src="img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="Utols\xF3 oldal" src="img/x.gif" class="last disabled">';
	}
?>
</table>
<div id="search_navi">
	<div class="paginator"><?php echo $paginationDisplay; ?></div>
</div>
<div class="clear">&nbsp;</div>

<?php } 
//echo 'end at '.date('H:i:s');
?>

<div class="clear">&nbsp;</div>