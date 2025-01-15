 <?php
    $trainlist = $technology->getTrainingList(4);
    if(count($trainlist) > 0) {
    	echo "
    <br /><table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
		<thead><tr>
			<td>&#1587;&#1585;&#1576;&#1575;&#1586;</td>
			<td>&#1605;&#1583;&#1578; &#1586;&#1605;&#1575;&#1606;</td>
			<td>&#1578;&#1605;&#1575;&#1605; &#1588;&#1583;&#1607; &#1583;&#1585;</td>
		</tr></thead>
		<tbody>";
		$TrainCount = 0;
        foreach($trainlist as $train) {
			$TrainCount++;
	        echo "<tr><td class=\"desc\">";
			echo "<img class=\"unit u".$train['unit']."\" src=\"img/x.gif\" alt=\"".$train['name']."\" title=\"".$train['name']."\" />";
			echo $train['amt']." ".$train['name']."</td><td class=\"dur\">";
			if ($TrainCount == 1 ) {
				echo "<span id=timer1>".$generator->getTimeFormat($train['endat']-time())."</span>";
			} else {
				echo $generator->getTimeFormat($train['endat']-$train['commence']);
			}
			echo "</td><td class=\"fin\">";
			$time = $generator->procMTime($train['endat']);
			echo " ".$time[1]." ".HRS."";
			if ($train['eachtime']<2000){
				$NextFinished = $generator->getMilisecFormat($train['eachtime']);
			} else {
				$NextFinished = $generator->getTimeFormat(round($train['eachtime']/1000));
			}
			echo '</tr><tr class="next"><td colspan="3">'.sprintf(EUWTI,'<span>'.$NextFinished.'</span>').' </td></tr>';
		} ?>
		</tbody></table>

<?php } ?>