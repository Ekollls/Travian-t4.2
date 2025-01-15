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
if(isset($_POST['submit2'])) {
  function CheckPass($password,$uid){       
  	$q = "SELECT password FROM ".TB_PREFIX."users where id = '$uid' and access = ".ADMIN;
		$result = mysql_query($q);
		$dbarray = mysql_fetch_array($result);
		if($dbarray['password'] == md5($password)) { 
		  return true;
    }else{
      return false;
    }
  }
	function DelVillage($wref){
	  $q = "SELECT * FROM ".TB_PREFIX."vdata WHERE `wref` = $wref and capital = 1;";
	  $result = mysql_query($q);    	  
    if(mysql_num_rows($result) > 0){ 
	mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Deleted village <b>$wref</b>',".time().")");
    $q = "DELETE FROM ".TB_PREFIX."vdata WHERE `wref` = $wref and capital = 1;";
	  mysql_query($q);
    $q = "DELETE FROM ".TB_PREFIX."units WHERE `vref` = $wref;";
    mysql_query($q);  
    $q = "DELETE FROM ".TB_PREFIX."bdata WHERE `wid` = $wref;";
    mysql_query($q); 
    $q = "DELETE FROM ".TB_PREFIX."abdata WHERE `wid` = $wref;";
    mysql_query($q);    
    $q = "DELETE FROM ".TB_PREFIX."fdata WHERE `vref` = $wref;";
    mysql_query($q);
    $q = "DELETE FROM ".TB_PREFIX."training WHERE `vref` = $wref;";
    mysql_query($q); 
    $q = "DELETE FROM ".TB_PREFIX."movement WHERE `from` = $wref;";
    mysql_query($q);       
    $q = "UPDATE ".TB_PREFIX."wdata SET `occupied` = '0' WHERE `id` = $wref;";
    mysql_query($q);  
    }
  }
  
if(CheckPass($_POST['pass'],$_SESSION['id'])){
    $ID = $_SESSION['id'];//$database->getUserField($_SESSION['username'],'id',1);	 
	$villages = $database->getProfileVillages($_POST['uid']);
    for ($i = 0; $i <= count($villages)-1; $i++) {
		DelVillage($villages[$i]['wref']);
    }  
	$name = $database->getUserField($_POST['uid'],"username",0);
	mysql_query("Insert into ".TB_PREFIX."admin_log values (0,$ID,'Deleted user <a>$name</a>',".time().")");
    $q = "DELETE FROM ".TB_PREFIX."users WHERE `id` = ".$_POST['uid'];
	mysql_query($q);         
}
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

<h1 class="titleInHeader">بازیکنان<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>





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
<h4 class="round">مديريت بازيکن</h4>
  <tr>

    <td>حذف اکانت در : <span class="c2">79:56:11</span>

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
    

<h4 class="round">مديريت بازيکن (<?php echo $user['username'];?>)</h4>




    </tr>                                       

    <tr>

        <td>اطلاعات</td>

        <td>توضيحات</td>



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

                echo "رومي ها";

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

                  echo "<a href=\"allianz.php?aid=".$user['alliance']."\">".$database->getAllianceName($user['alliance'])."</a>";

                } ?>

                </td>

            </tr>

            <tr>

                <th>دهکده:</th>

                <td><?php echo count($varray);?></td>



            </tr>

            <tr>

                <th>جمعيت</th>

                <td><?php echo $totalpop;?> <a href="?action=recountPopUsr&uid=<?php echo $user['id'];?>"></a></td>

            </tr>

            <?php 

            if(isset($user['birthday']) && $user['birthday'] != 0) {

            $age = date("Y")-substr($user['birthday'],0,4);

            echo "<tr><th>سن : </th><td>$age</td></tr>";

            }

            if(isset($user['gender']) && $user['gender'] != 0) {

            $gender = ($user['gender']== 1)? "مرد" : "زن";

            echo "<tr><th>جنسیت</th><td>".$gender."</td></tr>";

            }

                        

            echo "<tr><th>موقعیت</th><td><input disabled class=\"fm\" name=\"location\" value=\"".$user['location']."\"></td></tr>";

            echo "<tr><th><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b></th><td>";
			if(date('d.m.Y H:i',$user['plus']) == '01.01.1970 00:00') {
			echo "غير فعال</tr></th>";
			} else { echo "".date('d.m.Y H:i',$user['plus']+3600*2)."</tr></th>"; }

            echo "<tr><th>ايميل:</th><td><input disabled class=\"fm\" name=\"email\" value=\"".$user['email']."\"></td></tr>";

            echo '<tr><td colspan="2" class="empty"></td></tr>';

            echo '<tr><td colspan="2"><a href="report.php?p=Users&uid='.$user['id'].'&Edit">&raquo; ويرايش پروفايل</a></td></tr>';

            echo '<tr><td colspan="2"> <a href="nachrichten.php?t=1&id='.$user['id'].'">&raquo; نوشتن نامه</a></td></tr>';
			 
            echo '<tr><td colspan="2"> <a class="rn3" href="?p=deletion&uid='.$user['id'].'">&raquo; حذف بازيکن</a></td></tr>';
			
            echo '<tr><td colspan="2"> <a href="ban.php?un='.$user['username'].'&ban">&raquo; توقيف بازيکن</a></td></tr>';

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
<br>    
<h4 class="round">اطلاعات</h4>
    
    

    </tr>
  </thead>    
    <tr>
        <td>دسترسي</td>
        <td><?php 
		if($user['access'] == 0){
		echo "توقيف شده";
		}
		else if($user['access'] == 2){
		echo "بازيکن";
		}
		else if($user['access'] == 8){
		echo "<b><font color=\"Blue\">مولتي هانتر</font></b>";
		}
		else if($user['access'] == 9){
		echo "<b><font color=\"Red\">مدير</font></b>";
		}?></td>
    </tr>
    <tr>
        <td>باقي مانده طلا</td>
        <td><?php
		if($user['gold'] == 0){ ?>
		در حال حاظر 0 سکه دارد (<img src='img/gold.gif' class='gold' alt='Gold' title='در حال حاظر  <?php echo $user['gold']; ?> سکه دارد'/> <?php echo $user['gold']; ?>)<a href='?uid=<?php echo $id; ?>&g'>ويرايش</a>
		<?php }
		else if($user['gold'] > 0){ ?>
		<img src='img/gold.gif' class='gold' alt='Gold' title='This user has: <?php echo $user['gold']; ?> gold'/> <?php echo $user['gold']; ?>  <a href='?uid=<?php echo $id; ?>&g'><img src='img/edit.gif' title='Give Gold'></a></td>
	
		<?php }
		?>
    </tr>
 
    
 
    
    
    
     <tr>
     
     
     
     
     
     
        <td>باقي مانده نقره</td>
        <td>

در حال حاظر  (<?php echo $user['silver'];?>  <img src='img/silver.gif'>) نقره دارد 


        </td>
	
		
    </tr>
    
    
    
    
    
    
    
    
    
    
    
	<?php 	
	if($_GET['g'] == 'ok'){
		echo '';
	} else {
		if(isset($_GET['g'])){ ?>
		<form action="GameEngine/Admin/Mods/gold_1.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<tr>
		<td>عدد را وارد کرده سپس 'enter' را فشار دهید</td>
		<td><input class="give_gold" name="gold" value="0"> <a href="?uid=<?php echo $id; ?>"><img src="img/del.gif" title="Cancel"></a></td>
		</tr></form>
		<?php } } ?>
	<tr><td></td><td></td></tr>
	  <tr>
        <td>جانشین 1</td>
        <td><?php
		if($user['sit1'] >= 1){
		echo '<a href="?uid='.$user['sit1'].'">'.$database->getUserField($user['sit1'],"username",0).'</a>';
		} 
		else if($user['sit1'] == 0){
		echo 'ندارد';
		}
		?>
</tr>
  <tr>
        <td>جانشین 2</td>
        <td><?php
		if($user['sit2'] >= 1){
		echo '<a href="?uid='.$user['sit2'].'">'.$database->getUserField($user['sit2'],"username",0).'</a>';
		} 
		else if($user['sit2'] == 0){
		echo 'ندارد';
		}
		?>
</tr>
<tr><td></td><td></td></tr>
  <tr>
        <td>حمايت از تازه واردين</td>
        <td><?php 
		echo ''.date('d.m.Y H:i',$user['protect']+3600*2).'';
		?>
</tr>
  <tr>
        <td>امتياز فرهنگي</td>
        <td><?php echo $user['cp'];?><a href='?&uid=<?php echo $id; ?>&cp'><img src='img/edit.gif' title='Give Gold'>
</tr>
<?php 
	if($_GET['cp'] == 'ok'){
	echo '';
	} else {
		if(isset($_GET['cp'])){ ?>
		<form action="GameEngine/Admin/Mods/cp.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<tr>
		<td>عدد را وارد کرده سپس 'enter' را فشار دهید</td>
		<td><input class="give_gold" name="cp" value="0"> <a href="?uid=<?php echo $id; ?>"><img src="img/del.gif" title="Cancel"></a></td>
		</tr></form>
		<?php } } ?>
  <tr>
        <td>اخرين فعاليت</td>
        <td><?php 
		echo ''.date('d.m.Y H:i',$user['timestamp']+3600*2).'';
		?>
</tr>
</table>


<center><?php 
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
?>

<style>

.del {width:12px; height:12px; background-image: url(img/del.gif);} 

</style>  

</center>



<style>
.del {width:12px; height:12px; background-image: url(img/del.gif);} 
</style>  
<table id="member" border="1" cellpadding="3" align="center" dir="rtl">
  <thead>
    <tr>
    
<h4 class="round">اطلاعات دهکده</h4>
    
    

    </tr>
  </thead> 

</table>
<table id="member" border="1" cellpadding="3" align="center" dir="rtl">   
    <tr>
        <td>نام</td>
        <td>جمعیت</td>
        <td>مختصات</td>
		<td></td>
    </tr>
<?php         
for ($i = 0; $i <= count($varray)-1; $i++) {
$coorproc = $database->getCoor($varray[$i]['wref']);
if($varray[$i]['capital']){
$capital = '<span class="c">(پایتخت)</span>';
$delLink = '<a href="#"><img src="img/del_g.gif" class="del"></a>'; 
}else{
$capital = '';

$delLink = '<a href="?action=delVil&did='.$varray[$i]['wref'].'" onClick="return del(\'did\','.$varray[$i]['wref'].');"><img src="../img/Admin/del.gif" class="del"></a>';
}

echo '
    <tr>
        <td><a href="villages.php?did='.$varray[$i]['wref'].'">'.$varray[$i]['name'].'</a> '.$capital.'</td>
        <td>'.$varray[$i]['pop'].' <a href="?action=recountPop&did='.$varray[$i]['wref'].'"><a/></td>
        <td>('.$coorproc['x'].'|'.$coorproc['y'].')</td>
		<td>'.$delLink.' </td>
    </tr>  
'; 
}  

?>    
  
</table>

<style>
.del {width:12px; height:12px; background-image: url(fmg/del.gif);} 
</style>  
<form method="post" action="index.php">
<input name="action" type="hidden" value="addVillage">
<input name="uid" type="hidden" value="<?php echo $user['id'];?>">
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    
    
<h4 class="round">اضافه کردن دهکده</h4>

    </tr>
  </thead>   
  
	<tr>
        <td colspan="2"><center>مختصات : (<b>X</b>|<b>Y</b>)</center></td>
    </tr>  
    
	<tr>
        <td>مختصات X</td>
        <td><input name="x" class="fm" value="" type="input" ></td>
    </tr>
	
    <tr>
        <td>مختصات Y</td>
        <td><input name="y" class="fm" value="" type="input" ></td>
    </tr>
	
    <tr>
        <td colspan="2"><center><input value="Add Village" type="submit" ></center></td>
    </tr> 
	
</table>
</form>
<?php


}else{

  echo "Not found...<a href=\"javascript: history.go(-1)\">Back</a>";

}

}
if(isset($_GET['p']) && $_GET['p'] == "deletion"){ ?>
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
        <td colspan="2"><input type="submit" class="c5" name="submit2" value="&#1581;&#1584;&#1601;"></td>
    </tr>  
</table>
<br /><br />
<font color="Red"><b>&#1575;&#1582;&#1591;&#1575;&#1585;: &#1575;&#1711;&#1585; &#1576;&#1575;&#1586;&#1740;&#1705;&#1606; &#1581;&#1584;&#1601; &#1588;&#1608;&#1583; &#1578;&#1605;&#1575;&#1605; &#1583;&#1607;&#1705;&#1583;&#1607; &#1607;&#1575; &#1608;&#1740; &#1581;&#1584;&#1601; &#1605;&#1740;&#1588;&#1608;&#1606;&#1583;</font></b><br /><br />
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
        <td><a href="villages.php?did='.$varray[$i]['wref'].'">'.$varray[$i]['name'].'</a> '.$capital.'</td>
        <td>'.$varray[$i]['pop'].' <a href="?p=deletion&uid='.$varray[$i]['owner'].'">Check<a/></td>
        <td>('.$coorproc['x'].'|'.$coorproc['y'].')</td>
		<td>'.$delLink.' </td>
    </tr>  
'; 
}  

?>    
</form>
</table>
<?php
}
}  
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