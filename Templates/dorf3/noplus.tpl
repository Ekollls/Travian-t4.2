<div class="contentNavi subNavi">
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="dorf3.php"><span class="tabItem"><?php echo OVERVIEW;?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><span class="tabItem"><?php echo RESOURCE;?></span></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><span class="tabItem"><?php echo B10;?></span></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><span class="tabItem"><?php echo CULTUREPOINTS;?></span></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><span class="tabItem"><?php echo TROOPS;?></span></div>
				</div><div class="clear"></div>
</div>
<center><font color="#FF0000"><?=NO_PLUS_ESI?></font></center><br>
<table cellpadding="1" cellspacing="1" id="overview">
<thead>
<tr>
	<td><?php echo VILLAGE;?></td>
	<td><?php //echo ATTACKS;?>حملات</td>
	<td><?php echo BUILDINGS;?></td> 
	<td><?php echo TROOPS;?></td>
	<td><?php echo MERCHANTS;?></td>
</tr></thead><tbody>
<?php
$varray = $database->getProfileVillages($session->uid);  
foreach($varray as $vil){  
  $vid = $vil['wref'];
  $vdata = $database->getVillage($vid);
  if($vdata['capital'] == 1){$class = 'hl';}else{$class = '';}
  $vname = $vdata['name'];
  $cVName = constant($vname);
  echo '
  <tr class="'.$class.'">
		   <td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.($cVName?$cVName:$vname).'</a></td>
		   <td class="att"><span class="none">?</span></td>
		   <td class="bui"><span class="none">?</span></td> 
		   <td class="tro"><span class="none">?</span></td>
		   <td class="tra lc"><a href="build.php?gid=17">?/?</a></td>
	</tr> 
  ';
}
?>   
     </tbody>
</table>
