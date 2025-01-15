<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       add_village.tpl                                             ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<style>
.del {width:12px; height:12px; background-image: url(fmg/del.gif);} 
</style>  
<form method="post" action="index.php">
<input name="action" type="hidden" value="addVillage">
<input name="uid" type="hidden" value="<?php echo $user['id'];?>">
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    
    
    <ul class="tabs"><center>
		<li>&#1575;&#1592;&#1575;&#1601;&#1607; &#1705;&#1585;&#1583;&#1606; &#1583;&#1607;&#1705;&#1583;&#1607;</li>
        </center>
	</ul>

    </tr>
  </thead>   
  
	<tr>
        <td colspan="2"><center>&#1605;&#1582;&#1578;&#1589;&#1575;&#1578;: (<b>X</b>|<b>Y</b>)</center></td>
    </tr>  
    
	<tr>
        <td>&#1605;&#1582;&#1578;&#1589;&#1575;&#1578; X</td>
        <td><input name="x" class="fm" value="" type="input" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>></td>
    </tr>
	
    <tr>
        <td>&#1605;&#1582;&#1578;&#1589;&#1575;&#1578; Y</td>
        <td><input name="y" class="fm" value="" type="input" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>></td>
    </tr>
	
    <tr>
        <td colspan="2"><center><input value="Add Village" type="submit" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>></center></td>
    </tr> 
	
</table>
</form>