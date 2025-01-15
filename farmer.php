<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
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

<h1 class="titleInHeader">فارم</h1>
<?php
$villages = array();
if($_POST['no']>0) {
	$no = $_POST['no'];
	$lvl = $_POST['lvl'];
	$no2 = $no + 10;
	$sql = "SELECT * FROM ".TB_PREFIX."odata WHERE conqured = 0 ORDER BY rand() DESC LIMIT ". $no;
	$result = mysql_query($sql) or die(mysql_error());
	$row = array();
	while($row2 = mysql_fetch_array($result)) {
		array_push($row,$row2);
	}	

	if((count($row)) < $no) {
		echo "فضای خالی برای ایجاد تعداد داده شده دهکده موجود نمی باشد!<br>";
	}else{
		for($i=1;$i<=$no;$i++) {
			if($_POST['pop'] > 0) { $pop = $_POST['pop']; }else{ $pop = 60; };
		
			do{
				$rndo = mt_rand(0,count($row)-1);
				$oasis = $row[$rndo];
			}while(!is_array($oasis));			
			$o = $oasis;
			/************************************************************/
			$wid = $o['wref'];
			$status = 0;
			$uid = 3;
			
			
			if( true ) {
				$database->setFieldTaken($wid);
				$database->addVillage($wid, $uid, 'Nature', '0');
				$database->addResourceFields($wid, $database->getVillageType($wid));
				$database->addUnits($wid);
				$database->addTech($wid);
				$database->addABTech($wid);
				//mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . (rand(3000, 6000) * SPEED) . ", u42 = " . (rand(4500, 6000) * SPEED) . ", u43 = 10000, u44 = " . (rand(635, 1575) * SPEED) . ", u45 = " . (rand(3600, 5700) * SPEED) . ", u46 = " . (rand(4500, 6000) * SPEED) . ", u47 = " . (rand(1500, 2700) * SPEED) . ", u48 = " . (rand(300, 900) * SPEED) . " , u49 = 0, u50 = 9 WHERE vref = " . $wid . "");
				mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 10, f19t = 23, f19 = 10, f99t = 40, f26 = 0, f26t = 0, f21 = 1, f21t = 15, f39 = 1, f39t = 16 WHERE vref = " . $wid . "");
				mysql_query("UPDATE " . TB_PREFIX . "vdata SET pop = '". $pop ."' WHERE wref = '$wid'");
				mysql_query("UPDATE " . TB_PREFIX . "vdata SET name = 'Farm' WHERE wref = '$wid'");
				mysql_query("UPDATE " . TB_PREFIX . "vdata SET capital = 0 WHERE wref = '$wid'");
				mysql_query("UPDATE " . TB_PREFIX . "vdata SET natar = 0 WHERE wref = '$wid'");
				mysql_query("UPDATE " . TB_PREFIX . "units SET u31 = 0, u32 = 0, u33 = 0, u34 = 0, u35 = 0, u36 = 0, u37 = 0, u38 = 0, u39 = 0, u40 = 0, u41 = 0, u42 = 0, u43 = 0, u44 = 0, u45 = 0, u46 = 0, u47 = 0, u48 = 0, u49 = 0, u50 = 0 WHERE vref = " . $wid . "");
				mysql_query("INSERT INTO " . TB_PREFIX . "fdata(vref) VALUES('".$wid."')"); // this is the fix :|
				mysql_query("UPDATE " . TB_PREFIX . "fdata SET f21 = 1, f21t = 15 WHERE vref = " . $wid . "");
			}
			/************************************************************/
			$lvl = 1; // should be removed later?
			mysql_query("UPDATE ".TB_PREFIX."wdata SET fieldtype = '". $lvl ."' WHERE id = ".$o['wref']);
			mysql_query("UPDATE ".TB_PREFIX."wdata SET oasistype = '0' WHERE id = ".$o['wref']);
			mysql_query("UPDATE ".TB_PREFIX."wdata SET image = 't0' WHERE id = ".$o['wref']);
			mysql_query("UPDATE ".TB_PREFIX."wdata SET occupied = '1' WHERE id = ".$o['wref']);
			/************************************************************/
			if($_POST['prod'] > 800) {$prod = $_POST['prod'];}else{$prod = 800;};
			if($_POST['maxs'] > 0) {$maxs = $_POST['maxs'];}else{$maxs = 800;};
			//mysql_query("UPDATE ".TB_PREFIX."vdata SET woodp = $prod AND clayp = $prod AND ironp = $prod AND cropp = $prod WHERE wref = ".$wid);
			//mysql_query("UPDATE ".TB_PREFIX."vdata SET wood = $prod AND clay = $prod AND iron = $prod AND crop = $prod WHERE wref = ".$wid);
			mysql_query("UPDATE ".TB_PREFIX."vdata SET maxstore = $maxs AND maxcrop = $maxs WHERE wref = ".$wid);
			mysql_query("UPDATE ".TB_PREFIX."vdata SET prodf = $prod WHERE wref = ".$wid);
			mysql_query("UPDATE ".TB_PREFIX."vdata SET maxstoref = $maxs WHERE wref = ".$wid);




			mysql_query("DELETE FROM ".TB_PREFIX."odata WHERE wref = ".$oasis['wref']);
			///////////////////////
			$row[$rndo] = (string) "";
			array_push($villages,$wid);
		}
		echo "تعداد <b>".$_POST['no']."</b> دهکده با سطح تولیدات <b>".$_POST['lvl']."</b> و جمعیت <b>".$pop."</b> به نقشه اضافه شد.<br>دهکده ها: ";
		foreach($villages as $wid) {
			$result = mysql_query("SELECT * FROM ".TB_PREFIX."wdata WHERE id = ".$wid);
			$row = mysql_fetch_array($result);
			echo '<a href="karte.php?x='.$row['x'].'&y='.$row['y'].'">'.$wid.'</a>, ';
		}
		echo "<br><br>";
	}
}
?>
<h2>اضافه کردن دهکده های فارم</h2>
---------------------------------------------------<br>
برای اضافه کردن دهکده های فارم بصورت پراکنده و تصادفی به نقشه, سطح تولیدات و تعداد دهکده ها را مشخص کنید.<br><br>
<form action="" method="POST">
<table>
<tr><td>تعداد دهکده ها</td><td><input type="number" name="no" value="15"></td></tr>
<tr><td>جمعیت هر دهکده</td><td><input type="number" name="pop" value="50"></td></tr>
<tr><td>میزان تولیدات دهکده هر ساعت</td><td><input type="number" name="prod" value="800"></td></tr>
<tr><td>ظرفیت انبار دهکده</td><td><input type="number" name="maxs" value="1600"></td></tr>
<!--
<tr><td>سطح تولیدات دهکده ها</td><td><select name="lvl"><?php
for($i=1;$i<=12;$i++) { echo'<option value="'.$i.'">سطح '.$i.'</option>'; };?></select></td></tr>
-->
<tr><td></td><td><input type="submit" value="انجام"</td></td></tr>
</table>
</form>
<br>
<strong>توجه کنید که: </strong><br>
مقداری که برای ظرفیت انبار وارد می کنید برای ظرفیت گندم هم همان مقدار محاسبه می شود.<br>
همینطور مقداری که برای تولیدات هر ساعت وارد می کنید برای گندم, خشت, آهن و گندم در نظر گرفته می شود.<br>
حداقل مقدار مجاز برای ظرفیت و تولیدات 800 می باشد.<br>
سعی کنید که مقادیری که وارد می کنید متناسب باشد.<br>




</div>
<div id="side_info" class="outgame">
</div>
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


<?php } ?>