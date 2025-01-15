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
	if($session->access == 8) {
		header("Location: ./multihunter.php");
	}
	echo "شما ادمین نیستید لطفا تلاش نکنید."; 
} 
else{
	if(@$_GET['rel']=="yes") {
		mysql_query("UPDATE ".TB_PREFIX."config SET relArte='1'");
		header("Location: Artefact.php");
	}
	if(@$_GET['relns']=="yes") {
		mysql_query("UPDATE ".TB_PREFIX."config SET relns='1'");
		header("Location: Artefact.php");
	}

include "Templates/html.tpl";  ?>

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

<h1 class="titleInHeader">کتیبه ها</h1>
<center><h1>کتیبه ها</h1></center>
<hr>
<?php

if(@$_POST['submitted']=="yes") {
	if(@$_POST['eacharte'] > 0) {
		$a = $_POST['eacharte']*3600;
		mysql_query("UPDATE ".TB_PREFIX."config SET eachArte='$a'");
	}
	if(@$_POST['relarte'] > 0) {
		$a = time() + $_POST['relarte']*3600;
		mysql_query("UPDATE ".TB_PREFIX."config SET relArte='$a'");
	}
	echo "تغییرات کتیبه ها اعمال شد.<br>";
}

// ns
if(@$_POST['submittedns']=="yes") {
	if(@$_POST['relns'] > 0) {
		$a = time() + $_POST['relns']*3600;
		mysql_query("UPDATE ".TB_PREFIX."config SET relns='$a'");
	}
	echo "تغییرات نقشه ساخت اعمال شد.<br>";
}






?>
<?php
$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$row = mysql_fetch_array($result);

?>
<h4>اطلاعات کتیبه ها</h4>
<?php
if ($row['relArte'] < time()) {
	echo "در حال حاضر کتیبه ها آزاد <b>شده</b> اند.";
}else{
	echo "کتیبه ها تا <b>". round( (($row['relArte']-time())/3600) ,0 ) ." ساعت دیگر</b> آزاد خواهند شد.";
}?><br>
کاربران پس از دریافت هر کتیبه باید مدت <b><?=$row['eachArte']/3600?></b> ساعت برای فعال شدن آن صبر کنند.<br>
<hr>
<h4>تنظیمات</h4>
برای تغییر هر مورد مقدار آن را تغییر دهید. درصورتی که موردی را نمی خواهید تغییر دهید مقدار آن را تغییر ندهید.<br>
<form action="" method="post">
<input type="hidden" value="yes" name="submitted">
زمان آزاد شدن کتیبه ها: [ الآن+ <input type="number" name="relarte" value="-1"> ساعت ]<br>
زمان فعال شدن هر کتیبه برای کاربر: [ <input type="number" name="eacharte" value="-1"> ساعت ]<br>
<input type="submit" value="اعمال تغییرات">
</form>
<hr>
<h4>آزاد کردن کتیبه ها</h4>
<?php
if ($row['relArte'] < time()) {
	echo "کتیبه ها آزاد شده اند. نمی توانید دوباره آنها را آزاد کنید!";
}else{
	echo 'برای آزاد کردن کتیبه ها بصورت خودکار و آنی <a href="?rel=yes">اینجا</a> کلیک کنید.';
}
?>
<br>
<br>
<br>
<center><h1>نقشه ساخت</h1></center>
<hr>
<h4>اطلاعات نقشه ساخت</h4>
<?php
if ($row['relns'] < time()) {
	echo "در حال حاضر نقشه ساخت آزاد <b>شده</b> است.";
}else{
	echo "نقشه ساخت تا <b>". round( (($row['relns']-time())/3600) ,0 ) ." ساعت دیگر</b> آزاد خواهد شد.";
}?>
<hr>
<h4>تنظیمات</h4>
برای تغییر هر مورد مقدار آن را تغییر دهید. درصورتی که موردی را نمی خواهید تغییر دهید مقدار آن را تغییر ندهید.<br>
<form action="" method="post">
<input type="hidden" value="yes" name="submittedns">
زمان آزاد شدن نقشه ساخت: [ الآن+ <input type="number" name="relns" value="-1"> ساعت ]<br>
<input type="submit" value="اعمال تغییرات">
</form>
<hr>
<h4>آزاد کردن نقشه ساخت</h4>
<?php
if ($row['relns'] < time()) {
	echo "نقشه ساخت آزاد شده است. نمی توانید آن را دوباره آزاد کنید!";
}else{
	echo 'برای آزاد کردن نقشه ساخت بصورت خودکار و آنی <a href="?relns=yes">اینجا</a> کلیک کنید.';
}
?>








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