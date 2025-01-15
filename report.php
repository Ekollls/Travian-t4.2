<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");

include_once("GameEngine/Village.php");
if($session->access != ADMIN) { 
	echo "شما ادمين نيستيد لطفا تلاش نکنيد."; 
} 
else{
   include "Templates/html.tpl";  
        	function mysql_fetch_all($result) {
        		$all = array();
        		if($result) {
        			while($row = mysql_fetch_assoc($result)) {
        				$all[] = $row;
        			}
        			return $all;
        		}
        	}

  function getUserActive() {
    $time = time() - (60*5);
	    return mysql_query("SELECT * FROM ".TB_PREFIX."users where timestamp > $time and username != 'support'");
	}
  
$active = mysql_fetch_all(getUserActive()); 
if(isset($_POST['submit'])) {


$id = $_POST['id'];
$user = $database->getUserArray($id,1);
mysql_query("UPDATE ".TB_PREFIX."users SET email = '".$_POST['email']."', tribe = ".$_POST['tribe'].", location = '".$_POST['location']."', desc1 = '".$_POST['desc1']."', `desc2` = '".$_POST['desc2']."' WHERE id = ".$_POST['id']."");
mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Changed <a href=\'admin.php?p=village&did=$id\'>".$user['username']."</a>\'s profile',".time().")");
}
?>
<body class="v35 webkit chrome statistics">
<script type="text/javascript">
			window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
		</script>
	<div id="background"> 
			<div id="headerBar"></div>
			<div id="bodyWrapper"> 
				<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> 
				<div id="header"> 

<?php 
	include("Templates/topheader.tpl");
	include("Templates/toolbar.tpl");

?>

	</div>
	<div id="center">
		<a id="ingameManual" href="help.php">
		<img class="question" alt="Help" src="img/x.gif">
		</a>

		<?php include("Templates/sideinfo.tpl"); ?>

		<div id="contentOuterContainer"> 

		<?php include("Templates/res.tpl"); ?>
							<div class="contentTitle">&nbsp;</div> 
							<div class="contentContainer"> 



<div id="content" class="statistics">
                                		<script type="text/javascript"> 
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>

<h1 class="titleInHeader">بازيکنان آنلاين<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>
<?php
if(!isset($_GET['p']) || !isset($_GET['uid'])){
?>
<h4 class="round">بازيکنان آنلاين (<?php echo count($active);?>)</h4>
<table cellpadding="1" cellspacing="1" id="alliance" class="row_table_data">
    <tr style="height:30px;">
        <td dir="rtl"><center>نام [<b>دسترسي</b>]</center></td>
        <td><b>زمان</b></td>
        <td><b>نژاد</b></td> 
        <td><b>جمعيت</b></td> 
        <td><b>دهکده ها</b></td> 
        <td><b>طلا</b></td>  
        <td><b>نقره</b></td>
        <td></td>
    </tr>
<?php
	$sql2 = mysql_query("SELECT * FROM ".TB_PREFIX."users ORDER BY id ASC");
	$qq = mysql_fetch_all($sql2);
if(count($qq) > 0){
	foreach($qq as $row) {  
		$uid = $row['id'];
		$sql3 = mysql_query("SELECT * FROM ".TB_PREFIX."vdata where owner = $uid");
		$vil = $database->mysql_fetch_all($sql3);
		$totalpop = 0;

		foreach($vil as $varray) {
			$totalpop += $varray['pop'];
		}
		if($row['tribe'] == 1){
			$tribe = "رومي ها";
		} else if($row['tribe'] == 2){
			$tribe = "توتن ها";
		} else if($row['tribe'] == 3){
			$tribe = "گول ها";
		}
		if($row['access'] == 9){
			$access = "[<b>مدير</b>]";
        } elseif($row['access'] == 8){
			$access = "[<b>مولتي هانتر</b>]";
        } elseif($row['access'] == 0){
			$access = "[<b>بازداشت</b>]";
        }else{ $access = ""; }
		
		echo '
				<tr>
					<td dir="rtl"><a href="?p=Users&uid='.$uid.'">'.$row['username'].'</a> '.$access.'</td>
					<td>'.date("d/m/Y H:i",$row['timestamp']).'</td>
					<td>'.$tribe.'</td>
					<td>'.$totalpop.'</td>
					<td>'.count($vil).'</td>
					<td><img src="img/gold.gif" class="gold" alt="Gold" title="اين بازيکن '.$row['gold'].' طلا دارد"/> '.$row['gold'].'</td>
					<td><img src="img/silver.gif" class="gold" alt="Silver" title="اين بازيکن '.$row['silver'].' نقره دارد"/> '.$row['silver'].'</td>
					<td><a href="?p=Users&uid='.$uid.'"><img title="ويرايش بازيکن" border="0" src="img/edit.gif"></a></td>
				</tr>  
			';
	}
}
else{
	echo '<tr><td colspan="8" align="center">هيچ بازيکني آنلاين نيست</td></tr>';
} 

?>    

</table><br><br><br>

<?php
}
if(isset($_GET['p']) && isset($_GET['uid'])){
	$id = $_GET['uid'];
	if(isset($id)){        
		$user = $database->getUserArray($id,1);    
		$varray = $database->getProfileVillages($id);
		$varmedal = $database->getProfileMedal($id);
		foreach($varray as $vil) {
			$totalpop += $vil['pop'];
		}
?>
<h4 class="round">ويرايش پروفايل</h4>
<br>
<div id="div_1">
<?php if(isset($_GET['Edit'])){ if(isset($id)){        
$user = $database->getUserArray($id,1);    
$varray = $database->getProfileVillages($id);
$varmedal = $database->getProfileMedal($id);
?>
<br />
<form action="" method="POST">
    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
<table id="profile" cellpadding="1" cellspacing="1" >
    <thead>
    <tr>
        <th colspan="2">بازيکن <a href="?p=User&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></th>
    </tr>                                       
    <tr>
        <td>جزئيات</td>
        <td>توضيحات</td>
    </tr>
    </thead><tbody>
    <tr>
        <td class="empty"></td><td class="empty"></td>
    </tr>
    <tr>
        <td class="details">
            <table cellpadding="0" cellspacing="0">
            <tr><th>نژاد</th>
                <td><select name="tribe">
				<option value="1" <?php if($user['tribe'] == 1) { echo "selected='selected'"; } else { echo ''; } ?>>رومي ها</option>
				<option value="2" <?php if($user['tribe'] == 2) { echo "selected='selected'"; } else { echo ''; } ?>>توتن ها</option>
				<option value="3" <?php if($user['tribe'] == 3) { echo "selected='selected'"; } else { echo ''; } ?>>گول ها</option>
				</select></td>
            </tr>
            <?php                    
            echo "<tr><th>موقعیت</th><td><input class=\"fm\" name=\"location\" value=\"".$user['location']."\"></td></tr>";
            echo "<tr><th>ایمیل</th><td><input class=\"fm\" name=\"email\" value=\"".$user['email']."\"></td></tr>";
            echo '<tr><td colspan="2" class="empty"></td></tr>';
            echo '<tr><td colspan="2"><a href="?p=User&uid='.$user['id'].'"><span class="rn2" >&raquo;</span> Go back</a></td></tr>';
			echo '<tr><td colspan="2" class="empty"></td></tr>';
            echo '<tr><td colspan="2" class="desc2"><textarea cols="40" rows="14" tabindex="1" name="desc1">'.nl2br($user['desc1']).'</textarea></td></tr>';
?>
            </table>
        </td>
        <td class="desc1">
		<textarea tabindex="8" cols="45" rows="20" name="desc2"><?php echo nl2br($user['desc2']); ?></textarea>
        </td>
    </tr>
	<tr><td colspan="2" class="empty"></td></tr>
    </tbody>
</table>

<p>
		<table cellspacing="1" cellpadding="2" class="tbg">
		<tr><td class="rbg" colspan="4">مدال ها</td></tr>
		<tr>
			<td>دسته</td>
			<td>رتبه</td>
			<td>هفته</td>
			<td>کد</td>
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
        $titel="مهاجم هفته";
        break;
    case "2":
        $titel="مدافع هفته";
        break;
    case "3":
        $titel="پيشرفت کننده هفته";
        break;
    case "4":
        $titel="دزدان هفته";
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
				   <td>حمايت از تازه واردين</td>
				   <td></td>
				   <td></td>
				   <td>[#0]</td>
			 	 </tr>
				 </table></p>
				 
				 <br><br><br>
	<center>  <input type="submit" name="submit" value="اعمال"></p>
    </center></form>
<?php } ?>

<?php }else{ ?>
<table width="600" border="1" align="center" cellpadding="3" id="profile">
      <thead>
	    	<tr bgcolor="#E2E2E2" height="25">
				<th colspan="2">بازيکن <a href="?p=Users&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></th>
    		</tr>                                       
    		<tr align="center" bgcolor="#E2E2E2" height="25">
                <td><B>مشخصات</B></td>
                <td><B>توضيحات</B></td>
       	</tr>
   	</thead>
		<tbody>
		    <tr>
                <td class="details">
              <table cellpadding="3" cellspacing="0" border="1" width="100%">
                        <tr align="right">
                            <th>رتبه:</th>
                            <td><?php echo $ranking->getUserRank($user['username']); ?></td>
                        </tr>
						<tr align="right">
                            <th>نژاد</th>
                            <td><?php if($user['tribe'] == 1) {echo "رومي ها";}else if($user['tribe'] == 2) {echo "توتن ها";}else if($user['tribe'] == 3) {echo "گول ها";} ?></td>
			            </tr>
			            <tr align="right">
                            <th>اتحاد:</th>
                            <td><?php
				if($user['alliance'] == 0) {
					echo "-";
				}
                else {
					echo "<a href=\"allianz.php?aid=".$user['alliance']."\">".$database->getAllianceName($user['alliance'])."</a>";
                }
				?>
                			</td>
            			</tr>
            			<tr align="right">
                            <th>دهکده ها:</th>
                            <td><?php echo count($varray);?></td>
                        </tr>
			            <tr align="right">
			                <th>جمعيت:</th>
				                <td><?php echo $totalpop;?></td>
			            </tr>
            <?php 
            if(isset($user['birthday']) && $user['birthday'] != 0) {
				$age = date("Y")-substr($user['birthday'],0,4);
				echo "<tr align='right'><th>سن: </th><td>$age</td></tr>";
            }
            if(isset($user['gender']) && $user['gender'] != 0) {
				$gender = ($user['gender']== 1)? "مرد" : "زن";
				echo "<tr align='right'><th>جنسيت: </th><td>".$gender."</td></tr>";
            }

            echo "<tr align='right'><th>ايميل: </th><td>".$user['email']."</td></tr>";
			?>
                <tr><td colspan="2" class="empty"></td></tr>
          <tr>
            	<td colspan="2" class="desc2">
                	<div class="desc2div" style="height:200"><center><?php echo nl2br($user['desc1']); ?></center></div>
                </td>
            </tr>
        </table>
        </td>
        <td class="desc1" width="285">
        <table cellpadding="3" cellspacing="0" border="1" width="100%">
        
	<?php
			echo '<tr align="right"><td colspan="2"><a href="?p=Users&uid='.$user['id'].'&Edit">&raquo;<b> ويرايش پروفايل</b></a></td></tr>';
	?>
		<tr align="right"><td colspan="2"><a href="nachrichten.php?t=1&id=<?php echo $user['id']; ?>">&raquo;<b> نوشتن نامه</b></a></td></tr>
	<tr><td colspan="2"><a onclick="return (function(){
				('<b>حذف بازيکن <?php echo $user['username'];?></b><br><br>آيا ميخواهيد اين بازيکن را حذف کنيد؟').dialog(
				{
					onOkay: function(dialog, contentElement)
					{
						window.location.href = 'player.php?p=deletion&&uid=<?php echo $user['id']; ?>'}
				});
				return false;
			})()" href="#">&raquo;<b> حذف بازيکن</b></a></td></tr>
		<tr align="right"><td colspan="2"><a href="ban.php?un=<?php echo $user['username'];?>&ban">&raquo;<b> بازداشت</b></a></td></tr>
		<tr><td colspan="2" class="empty"></td></tr>
            <tr>
            	<td colspan="2" class="desc2">
               	  <div class="desc2div" style="height:240"><center><?php echo nl2br($user['desc2']); ?></center></div>
                </td>
            </tr>
        </table>
        
        </td>
    </tr>

    </tbody>

</table>
<?php } } ?>
</div>
<?php
}

?>





<div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>


</div>
<div class="contentFooter">&nbsp;</div>

					</div>
<?php  
include("Templates/rightsideinfor.tpl");		
?>
				<div class="clear"></div>
</div>
<?php 
include("Templates/footer.tpl"); 
include("Templates/header.tpl");
?>
</div>
<div id="ce"></div>
</div>
</body>
</html>

<?php }
?>

