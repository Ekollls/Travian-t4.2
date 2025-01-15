<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       player.tpl                                                  ##
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

if($user){

$totalpop = 0;

foreach($varray as $vil) {

	$totalpop += $vil['pop'];

}



?>

<?php

$deletion = false;

if($deletion){

?>  



<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
<div align="center">
	<ul class="tabs"><center>
		<li>مدیریت بازیکن</li>
        </center>
	</ul>
</div>

  <tr>

    <td>The account will be deleted in <span class="c2">79:56:11</span>

      <a href="?action=StopDel&uid=<?php echo $user['id'];?>" onClick="return del('stopDel','<?php echo $user['username'];?>');"><img src="img/x.gif" class="del"></a>

    </td>

  </tr>

</table>

<?php

}

?>

<br>

<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

    <thead>

    <tr>
    

	<ul class="tabs"><center>
		<li>مدیریت بازیکن (<?php echo $user['username'];?>)</li>
        </center>
	</ul>




    </tr>                                       

    <tr>

        <td>اطلاعات</td>

        <td>توضیحات</td>



    </tr>

    </thead><tbody>

    <tr>

        <td class="empty"></td><td class="empty"></td>

    </tr>

    <tr>

        <td class="details">

           <table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

            <tr>



                <th>رتبه:</th>

                <td><?php //echo $ranking->searchRank($displayarray['username'],"username"); ?></td>

            </tr>

            <tr>

                <th>نژاد:</th>

                <td><?php                        

                if($user['tribe'] == 1) {

                echo "رومی ها";

                }

                else if($user['tribe'] == 2) {

                echo "توتن ها";

                }

                else if($user['tribe'] == 3) {

                echo "گول ها";

                }

                else if($user['tribe'] == 4) {

                echo "ناتار ها";

                } ?></td>

            </tr>



            <tr>

                <th>اتحاد:</th>

                <td>

                <?php if($user['alliance'] == 0) {

                  echo "-";

                }

                else {

                  echo "<a href=\"?p=alliance&aid=".$user['alliance']."\">".$database->getAllianceName($user['alliance'])."</a>";

                } ?>

                </td>

            </tr>

            <tr>

                <th>دهکده:</th>

                <td><?php echo count($varray);?></td>



            </tr>

            <tr>

                <th>جمعیت</th>

                <td><?php echo $totalpop;?> <a href="?action=recountPopUsr&uid=<?php echo $user['id'];?>"></a></td>

            </tr>

            <?php 

            if(isset($user['birthday']) && $user['birthday'] != 0) {

            $age = date("Y")-substr($user['birthday'],0,4);

            echo "<tr><th>Age</th><td>$age</td></tr>";

            }

            if(isset($user['gender']) && $user['gender'] != 0) {

            $gender = ($user['gender']== 1)? "Male" : "Female";

            echo "<tr><th>Gender</th><td>".$gender."</td></tr>";

            }

                        

            echo "<tr><th>Location</th><td><input disabled class=\"fm\" name=\"location\" value=\"".$user['location']."\"></td></tr>";

            echo "<tr><th><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b></th><td>";
			if(date('d.m.Y H:i',$user['plus']) == '01.01.1970 00:00') {
			echo "غیر فعال</tr></th>";
			} else { echo "".date('d.m.Y H:i',$user['plus']+3600*2)."</tr></th>"; }

            echo "<tr><th>ایمیل:</th><td><input disabled class=\"fm\" name=\"email\" value=\"".$user['email']."\"></td></tr>";

            echo '<tr><td colspan="2" class="empty"></td></tr>';
			
			if($_SESSION['access'] == ADMIN){
            echo '<tr><td colspan="2"><a href="?p=editUser&uid='.$user['id'].'">&raquo; ویرایش پروفایل</a></td></tr>';
			} else if($_SESSION['access'] == MULTIHUNTER){
			echo '';
			}

            echo '<tr><td colspan="2"> <a href="?p=Newmessage&uid='.$user['id'].'">&raquo; نوشتن نامه</a></td></tr>';
			 
			 if($_SESSION['access'] == ADMIN){
            echo '<tr><td colspan="2"> <a class="rn3" href="?p=deletion&uid='.$user['id'].'">&raquo; حذف بازیکن</a></td></tr>';
			 } else if($_SESSION['access'] == MULTIHUNTER){
			echo '';
			}
			
            echo '<tr><td colspan="2"> <a href="?p=ban&uid='.$user['id'].'">&raquo; توقیف بازیکن</a></td></tr>';

            echo '<tr><td colspan="2" class="desc2"><div class="desc2div"><center>'.nl2br($user['desc1']).'</center></div></td></tr>';

            ?>      

          

            

            </table>



        </td>

        <td class="desc1">
<center><?php echo nl2br($user['desc2']); ?></center>
        </td>



    </tr>

    </tbody>

</table>


<!-- ADDITIONAL USER INFORMATION -->
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    
    	<ul class="tabs"><center>
		<li>اطلاعات</li>
        </center>
	</ul>
    
    

    </tr>
  </thead>    
    <tr>
        <td>دسترسی</td>
        <td><?php 
		if($user['access'] == 0){
		echo "توقیف شده";
		}
		else if($user['access'] == 2){
		echo "بازیکن";
		}
		else if($user['access'] == 8){
		echo "<b><font color=\"Blue\">مولتی هانتر</font></b>";
		}
		else if($user['access'] == 9){
		echo "<b><font color=\"Red\">مدیر</font></b>";
		}?></td>
    </tr>
    <tr>
        <td>باقی مانده طلا</td>
        <td><?php
		if($user['gold'] == 0){ ?>
		در حال حاظر 0 سکه دارد (<img src='../img/admin/gold_g.gif' class='gold' alt='Gold' title='در حال حاظر  <?php echo $user['gold']; ?> سکه دارد'/> <?php echo $user['gold']; ?>) <?php if($_SESSION['access'] == ADMIN){ ?><a href='index.php?p=player&uid=<?php echo $id; ?>&g'>ویرایش<?php } ?></a>
		<?php }
		else if($user['gold'] > 0){ ?>
		<img src='../img/admin/gold.gif' class='gold' alt='Gold' title='This user has: <?php echo $user['gold']; ?> gold'/> <?php echo $user['gold']; ?>  <?php if($_SESSION['access'] == ADMIN){ ?><a href='index.php?p=player&uid=<?php echo $id; ?>&g'><img src='../img/admin/edit.gif' title='Give Gold'><?php } ?></a></td>
	
		<?php }
		?>
    </tr>
 
    
 
    
    
    
     <tr>
     
     
     
     
     
     
        <td>باقی مانده نقره</td>
        <td>

در حال حاظر  (<?php echo $user['silver'];?>  <img src='images/silver.gif'>) نقره دارد 


        </td>
	
		
    </tr>
    
    
    
    
    
    
    
    
    
    
    
	<?php 	
	if($_SESSION['access'] == ADMIN){
	if($_GET['g'] == 'ok'){
		echo '';
	} else {
		if(isset($_GET['g'])){ ?>
		<form action="../GameEngine/Admin/Mods/gold_1.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<tr>
		<td>Insert number and press 'enter'</td>
		<td><input class="give_gold" name="gold" value="0"> <a href="index.php?p=player&uid=<?php echo $id; ?>"><img src="../img/admin/del.gif" title="Cancel"></a></td>
		</tr></form>
		<?php } } }?>
	<tr><td></td><td></td></tr>
	  <tr>
        <td>Sitter 1</td>
        <td><?php
		if($user['sit1'] >= 1){
		echo '<a href="index.php?p=player&uid='.$user['sit1'].'">'.$database->getUserField($user['sit1'],"username",0).'</a>';
		} 
		else if($user['sit1'] == 0){
		echo 'ندارد';
		}
		?>
</tr>
  <tr>
        <td>Sitter 2</td>
        <td><?php
		if($user['sit2'] >= 1){
		echo '<a href="index.php?p=player&uid='.$user['sit2'].'">'.$database->getUserField($user['sit2'],"username",0).'</a>';
		} 
		else if($user['sit2'] == 0){
		echo 'ندارد';
		}
		?>
</tr>
<tr><td></td><td></td></tr>
  <tr>
        <td>حمایت از تازه واردین</td>
        <td><?php 
		echo ''.date('d.m.Y H:i',$user['protect']+3600*2).'';
		?>
</tr>
  <tr>
        <td>امتیاز فرهنگی</td>
        <td><?php echo $user['cp'];?> <?php if($_SESSION['access'] == ADMIN){ ?><a href='admin.php?p=player&uid=<?php echo $id; ?>&cp'><img src='../img/admin/edit.gif' title='Give Gold'><?php } ?>
</tr>
<?php if($_SESSION['access'] == ADMIN){
	if($_GET['cp'] == 'ok'){
	echo '';
	} else {
		if(isset($_GET['cp'])){ ?>
		<form action="../GameEngine/Admin/Mods/cp.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<tr>
		<td>Insert number and press 'enter'</td>
		<td><input class="give_gold" name="cp" value="0"> <a href="admin.php?p=player&uid=<?php echo $id; ?>"><img src="../img/admin/del.gif" title="Cancel"></a></td>
		</tr></form>
		<?php } } }?>
  <tr>
        <td>اخرین فعالیت</td>
        <td><?php 
		echo ''.date('d.m.Y H:i',$user['timestamp']+3600*2).'';
		?>
</tr>
</table>


<center><?php include ('punish.tpl'); ?></center>

<?php
include ('villages.tpl');

include ('add_village.tpl');


}else{

  echo "Not found...<a href=\"javascript: history.go(-1)\">Back</a>";

}

}

?>