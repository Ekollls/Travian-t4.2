<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       villages.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<style>
.del {width:12px; height:12px; background-image: url(fmg/del.gif);} 
</style>  
<table id="member" border="1" cellpadding="3" align="center" dir="rtl">
  <thead>
    <tr>
    
    <ul class="tabs"><center>
		<li>&#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1583;&#1607;&#1705;&#1583;&#1607;</li>
        </center>
	</ul>
    
    

    </tr>
  </thead> 

</table>
<table id="member" border="1" cellpadding="3" align="center" dir="rtl">   
    <tr>
        <td>&#1606;&#1575;&#1605;</td>
        <td>&#1580;&#1605;&#1593;&#1740;&#1578;</td>
        <td>&#1605;&#1582;&#1578;&#1589;&#1575;&#1578;</td>
		<td></td>
    </tr>
<?php         
for ($i = 0; $i <= count($varray)-1; $i++) {
$coorproc = $database->getCoor($varray[$i]['wref']);
if($varray[$i]['capital']){
$capital = '<span class="c">(&#1662;&#1575;&#1740;&#1578;&#1582;&#1578;)</span>';
$delLink = '<a href="#"><img src="../img/Admin/del_g.gif" class="del"></a>'; 
}else{
$capital = '';
	if($_SESSION['access'] == ADMIN){
$delLink = '<a href="?action=delVil&did='.$varray[$i]['wref'].'" onClick="return del(\'did\','.$varray[$i]['wref'].');"><img src="../img/Admin/del.gif" class="del"></a>';
  }else if($_SESSION['access'] == MULTIHUNTER){
  $delLink = '<a href="#"><img src="../img/Admin/del_g.gif" class="del"></a>';
	}
}

echo '
    <tr>
        <td><a href="?p=village&did='.$varray[$i]['wref'].'">'.$varray[$i]['name'].'</a> '.$capital.'</td>
        <td>'.$varray[$i]['pop'].' <a href="?action=recountPop&did='.$varray[$i]['wref'].'"><a/></td>
        <td>('.$coorproc['x'].'|'.$coorproc['y'].')</td>
		<td>'.$delLink.' </td>
    </tr>  
'; 
}  

?>    
  
</table>
