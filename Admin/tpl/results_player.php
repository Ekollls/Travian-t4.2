<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       results_player.tpl                                          ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php
$result = $admin->search_player($_POST['s']);
?>
<table id="member">
  <thead>
    <tr>
    
    <ul class="tabs"><center>
		<li>تعداد بازیکنان (<?php echo count($result);?>)</li>
        </center>
	</ul>
</div>
    
    
    

    </tr>
  </thead> 

</table>
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 


   
    <tr>
        <td class="b">اکانت</td>
        <td class="b">نام</td>
        <td class="b">دهکده</td>
        <td class="b">جمعیت</td>
    </tr>
<?php      
if($result){  
for ($i = 0; $i <= count($result)-1; $i++) {    
$varray = $database->getProfileVillages($result[$i]["id"]);
$totalpop = 0;
foreach($varray as $vil) {
	$totalpop += $vil['pop'];
}
echo '
    <tr>
        <td>'.$result[$i]["id"].'</td>
        <td><a href="?p=player&uid='.$result[$i]["id"].'">'.$result[$i]["username"].'</a></td>
        <td>'.count($varray).'</td>
        <td>'.$totalpop.'</td>
    </tr>  
'; 
}}
else{  
echo '
    <tr>
        <td colspan="4">هیچ بازیکنی موجود نیست</td>  
    </tr>  
';
}
?>    
  
</table>
