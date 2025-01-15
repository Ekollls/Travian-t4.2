<?php
    $result = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE Name='Farm' ORDER BY created DESC");
?>
<h4 class="round"><?=FARMLIST?></h4>
<?php
if ($session->access >= 8) {
	//echo 'برای مدیریت فارم ها <a href="efarm.php" target="_blank">اینجا</a> کلیک کنید.<br><br>';
}
?>
<table cellpadding="1" cellspacing="1" id="wonder" style="width:97%;">
		<thead><tr><td>#</td><td><img class="r1" src="img/x.gif" title="<?=WOOD?>"></td><td><img class="r2" src="img/x.gif" title="<?=CLAY?>"></td><td><img class="r3" src="img/x.gif" title="<?=IRON?>"></td><td><img class="r4" src="img/x.gif" title="<?=CROP?>"></td><td><?=PROD_HEADER?></td><td><?=WAREHOUSE?></td><td><?=LOCATION?></td></tr></thead>
	<tbody>
        <?php
        $cont = 1;
        if(mysql_num_rows($result)>0){}else{echo '<tr><td colspan="8"><center>'.NO_FARM.'</center></td></tr>';};
    while($row = mysql_fetch_array($result))
    
      {
      $result2 = mysql_query ("SELECT * FROM ".TB_PREFIX."wdata WHERE id = ". $row['wref']);
      $row2 = mysql_fetch_array($result2);
              $coor = $database->getCoor($row['wref']);

      
      ?>
			<tr class="hover">
				<td class="ra"><?php echo $cont; $cont++;?></td>
                <td><?=round($row['wood'])?></td>
                <td><?=round($row['clay'])?></td>
                <td><?=round($row['iron'])?></td>
                <td><?=round($row['crop'])?></td>
                <td><?=$row['prodf']?></td>
                <td><?=$row['maxstoref']?></td>
                <td><a href="karte.php?x=<?=$coor['x']?>&y=<?=$coor['y']?>">(<?=$coor['x']?>,<?=$coor['y']?>)</td>
			</tr>
       <?php }
        ?>
	</tbody>
</table>
<?=FARMLIST_FOOTER?>