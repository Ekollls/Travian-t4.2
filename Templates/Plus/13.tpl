<!---<?php
/*include("Templates/Plus/pmenu.tpl");
    $MyVilId = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE `wref`='".$village->wid."'") or die(mysql_error());
    $uuVilid = mysql_fetch_array($MyVilId);
    $totalR = ($uuVilid['6']+$uuVilid['7']+$uuVilid['8']+$uuVilid['10']);
    $quart = ($totalR / 4);
	*/
?>

<form method="get" action="plus.php">
<input name="id" value="14" type="hidden"> 
<div align="center">
	<table border="1" width="50%" cellspacing="0" cellpadding="0">
		<tr>
			<?php echo '<td align="center" width="25%"><img class="r1" src="img/x.gif" alt="'.WOOD.'" title="'.WOOD.'" />'.WOOD.'</td>';?>
			<?php echo '<td align="center" width="25%"><img class="r2" src="img/x.gif" alt="'.CLAY.'" title="'.CLAY.'" />'.CLAY.'</td>';?>
			<?php echo '<td align="center" width="25%"><img class="r3" src="img/x.gif" alt="'.IRON.'" title="'.IRON.'" />'.IRON.'</td>';?>
			<?php echo '<td align="center" width="25%"><img class="r4" src="img/x.gif" alt="'.CROP.'" title="'.CROP.'" />'.CROP.'</td>';?>
		</tr>
		<tr>
			<td align="center">
<?php
	/* $MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `username`='".$session->username."'") or die(mysql_error());
    $golds = mysql_fetch_array($MyGold);

    $MyId = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `username`='".$session->username."'") or die(mysql_error());
    $uuid = mysql_fetch_array($MyId);

	echo "<input type='text' name='T1' size='6' value=".$quart."></td>";
			echo "<td align='center'>";
	echo "<input type='text' name='T2' size='6' value=".$quart."></td>";
			echo "<td align='center'>";
	echo "<input type='text' name='T3' size='6' value=".$quart."></td>";
			echo "<td align='center'>";
	echo "<input type='text' name='T4' size='6' value=".$quart."></td>";
mysql_query("UPDATE ".TB_PREFIX."users set gold = ".($session->gold-1)." where `username`='".$session->username."'") or die(mysql_error());
 */
?>
		</tr>
		<tr>
			<td colspan="4" align="center">
			<input type="submit" value="<?php echo HEADER_TRADE;?> 1:1" name="B1"></td>
		</tr>
	</table>
</div>
</form>-->