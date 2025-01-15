<?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$allianceinfo = $database->getAlliance($aid);

$noticeArray = $database->readAlliNotice($aid);

 include("alli_menu.tpl"); 
?>
<h4 class="chartHeadline"><?php echo EVENTS;?></h4>
<table cellpadding="1" cellspacing="1" id="events"><thead>
<tr>
<td><?php echo EVENT;?></td>
<td><?php echo DATE;?></td>
</tr>
</thead>
<tbody>
<?php
foreach($noticeArray as $notice) {
$date = $generator->procMtime($notice['date']);
echo "<tr>";
echo "<td class=\"event\">".$notice['comment']."</td>";
echo "<td class=\"dat\"><center>".$date['0']." ".$date['1']."</center></td>";
echo "</tr>";
}
?>
</tbody>
</table>