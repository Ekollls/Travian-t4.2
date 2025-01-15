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
<?php
$id = $_GET['uid'];
if(isset($id)){        
$user = $database->getUserArray($id,1);    
$varray = $database->getProfileVillages($id);
$varmedal = $database->getProfileMedal($id);
?>
<br />
<form action="../GameEngine/Admin/Mods/editUser.php" method="POST">
    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
    <thead>
    <tr>
    
    
    <ul class="tabs"><center>
		<li>&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1662;&#1585;&#1608;&#1601;&#1575;&#1740;&#1604; &#1576;&#1575;&#1586;&#1740;&#1705;&#1606; <?php echo $user['username'];?></li>
        </center>
	</ul>
    


    </tr>                                       
    <tr>
        <td>&#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578;</td>
        <td>&#1578;&#1608;&#1590;&#1740;&#1581;&#1575;&#1578;</td>
    </tr>
    </thead><tbody>
    <tr>
        <td class="empty"></td><td class="empty"></td>
    </tr>
    <tr>
        <td class="details">
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
            <tr><th>&#1606;&#1688;&#1575;&#1583;</th>
                <td><select name="tribe">
				<option value="1" <?php if($user['tribe'] == 1) { echo "selected='selected'"; } else { echo ''; } ?>>&#1585;&#1608;&#1605;&#1740; &#1607;&#1575;</option>
				<option value="2" <?php if($user['tribe'] == 2) { echo "selected='selected'"; } else { echo ''; } ?>>&#1578;&#1608;&#1578;&#1606; &#1607;&#1575;</option>
				<option value="3" <?php if($user['tribe'] == 3) { echo "selected='selected'"; } else { echo ''; } ?>>&#1711;&#1608;&#1604; &#1607;&#1575;</option>
				</select></td>
            </tr>
            <?php                    
            echo "<tr><th>&#1605;&#1608;&#1602;&#1593;&#1740;&#1578;</th><td><input class=\"fm\" name=\"location\" value=\"".$user['location']."\"></td></tr>";
            echo "<tr><th>&#1575;&#1740;&#1605;&#1740;&#1604;</th><td><input class=\"fm\" name=\"email\" value=\"".$user['email']."\"></td></tr>";
            echo '<tr><td colspan="2" class="empty"></td></tr>';
            echo '<tr><td colspan="2"><a href="?p=player&uid='.$user['id'].'"><span class="rn2" >&raquo;</span> &#1576;&#1575;&#1586;&#1711;&#1588;&#1578;</a></td></tr>';
			echo '<tr><td colspan="2" class="empty"></td></tr>';
            echo '<tr><td colspan="2" class="desc2"><textarea cols="25" rows="14" tabindex="1" name="desc1">'.nl2br($user['desc1']).'</textarea></td></tr>';
            ?>      


            </table>
        </td>
        <td class="desc1">
		<textarea tabindex="8" cols="30" rows="20" name="desc2"><?php echo nl2br($user['desc2']); ?></textarea>
        </td>
    </tr>
	<tr><td colspan="2" class="empty"></td></tr>
    </tbody>
</table>

<p>
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 



		<tr>

<ul class="tabs"><center>
		<li>&#1605;&#1583;&#1575;&#1604; &#1607;&#1575;&#1740; &#1576;&#1575;&#1586;&#1740;&#1705;&#1606; <?php echo $user['username'];?></li>
        </center>
	</ul>



		<tr>
			<td>Category</td>
			<td>Rang</td>
			<td>Week</td>
			<td>BB-Code</td>
		</tr>
				<?php
/******************************
INDELING CATEGORIEEN:
===============================
== 1. Aanvallers top 10      ==
== 2. Defence top 10         ==
== 3. Klimmers top 10        ==
== 4. Overvallers top 10     ==
== 5. In att en def tegelijk ==
== 6. in top 3 - aanval      ==
== 7. in top 3 - verdediging ==
== 8. in top 3 - klimmers    ==
== 9. in top 3 - overval     ==
******************************/				
				
				
	foreach($varmedal as $medal) {
	$titel="Bonus";
	switch ($medal['categorie']) {
    case "1":
        $titel="Attacker of the Week";
        break;
    case "2":
        $titel="Defender of the Week";
        break;
    case "3":
        $titel="Climber of the week";
        break;
    case "4":
        $titel="Robber of the week";
        break;
	}			
				 echo"<tr>
				   <td> ".$titel."</td>
				   <td>".$medal['plaats']."</td>
				   <td>".$medal['week']."</td>
				   <td>[#".$medal['id']."]</td>
			 	 </tr>";
				 } ?>
				 <tr>
				   <td>Beginners Protection</td>
				   <td></td>
				   <td></td>
				   <td>[#0]</td>
			 	 </tr>
				 </table></p>
				 
			<br><br>
		 <center>
            	<button name="submit" type="submit" value="submit" id="submit" class="submit"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">&#1584;&#1582;&#1740;&#1585;&#1607;</div></div></button>
                
            </center>	
			
				 

    </center></form>
<?php } ?>