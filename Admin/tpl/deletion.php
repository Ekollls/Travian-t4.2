<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       deletion.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<style>
.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);} 
</style>  

<?php
if($_GET['uid']){
$user = $database->getUserArray($_GET['uid'],1);  
$varray = $database->getProfileVillages($_GET['uid']);                
if($user){
$totalpop = 0;
foreach($varray as $vil) {
	$totalpop += $vil['pop'];
}

?>
<form action="" method="post">
<input type="hidden" name="action" value="DelPlayer">
<input type="hidden" name="uid" value="<?php echo $user['id'];?>">
<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    
    
    
    <ul class="tabs"><center>
		<li>&#1581;&#1584;&#1601; &#1576;&#1575;&#1586;&#1740;&#1705;&#1606; </li>
        </center>
	</ul>

    </tr>
  </thead> 
    <tr>
        <td>&#1606;&#1575;&#1605;</td>
        <td><a href="?p=player&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></td>
        <td>&#1587;&#1705;&#1607; &#1591;&#1604;&#1575;</td>
        <td><?php echo $user['gold'];?></td>
    </tr>
    <tr>
        <td>&#1580;&#1605;&#1593;&#1740;&#1578;</td>
        <td><?php echo $totalpop;?></td>
        <td>&#1606;&#1602;&#1585;&#1607;</td>
        <td><?php echo $user['silver'];?></td>
    </tr>
    <tr>
        <td>&#1583;&#1607;&#1705;&#1583;&#1607;</td>
        <td><?php

    $result = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."vdata WHERE owner = ".$user['id']."");
    $num_rows = mysql_num_rows($result);

    echo $num_rows;

    ?></td>
        <td><b><font color='#71D000'></font><font color='#FF6F0F'></font><font color='#71D000'></font><font color='#FF6F0F'>&#1662;&#1604;&#1575;&#1587;</font></b>:</td>
        <td><?php 
		$plus = date('d.m.Y H:i',$user['plus']);
		echo $plus;?></td>
    </tr> 
    <tr>
        <td>&#1575;&#1578;&#1581;&#1575;&#1583;</td>
        <td><?php echo $database->getAllianceName($user['alliance']);?></td>
        <td>&#1608;&#1590;&#1593;&#1740;&#1578;</td>
        <td>-</td>
    </tr>
    <tr>
    <td colspan="4" class="empty"></td>
    </tr>
    <tr>
        <td>&#1585;&#1605;&#1586; &#1593;&#1576;&#1608;&#1585;</td>
        <td><input type="text" name="pass"></td>
        <td colspan="2"><input type="submit" class="c5" value="&#1581;&#1584;&#1601;"></td>
    </tr>  
</table>
<br /><br /><font color="Red"><b>&#1575;&#1582;&#1591;&#1575;&#1585;: &#1575;&#1711;&#1585; &#1576;&#1575;&#1586;&#1740;&#1705;&#1606; &#1581;&#1584;&#1601; &#1588;&#1608;&#1583; &#1578;&#1605;&#1575;&#1605; &#1583;&#1607;&#1705;&#1583;&#1607; &#1607;&#1575; &#1608;&#1740; &#1581;&#1584;&#1601; &#1605;&#1740;&#1588;&#1608;&#1606;&#1583;</font></b><br /><br />
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

   
    <ul class="tabs"><center>
		<li>&#1583;&#1607;&#1705;&#1583;&#1607; &#1607;&#1575; </li>
        </center>
	</ul>

    <tr>
        <td>&#1606;&#1575;&#1605;</td>
        <td>&#1580;&#1605;&#1593;&#1740;&#1578;</td>
        <td>&#1605;&#1581;&#1578;&#1589;&#1575;&#1578;</td>
		<td></td>
    </tr>
<?php         
for ($i = 0; $i <= count($varray)-1; $i++) {
$coorproc = $database->getCoor($varray[$i]['wref']);
if($varray[$i]['capital']){
$capital = '<span class="c">(&#1662;&#1575;&#1740;&#1578;&#1582;&#1578;)</span>';
$delLink = '<a href="?action=delVil&did='.$varray[$i]['wref'].'" onClick="return del(\'did\','.$varray[$i]['wref'].');"><img src="../img/Admin/del.gif" class="del"></a>';
}else{
$capital = '';
$delLink = '<a href="?action=delVil&did='.$varray[$i]['wref'].'" onClick="return del(\'did\','.$varray[$i]['wref'].');"><img src="../img/Admin/del.gif" class="del"></a>';
  
}

echo '
    <tr>
        <td><a href="?p=village&did='.$varray[$i]['wref'].'">'.$varray[$i]['name'].'</a> '.$capital.'</td>
        <td>'.$varray[$i]['pop'].' <a href="?action=recountPop&did='.$varray[$i]['wref'].'">Check<a/></td>
        <td>('.$coorproc['x'].'|'.$coorproc['y'].')</td>
		<td>'.$delLink.' </td>
    </tr>  
'; 
}  

?>    
</form>
<?php
}
}  
?>
