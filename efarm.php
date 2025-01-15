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

<h1 class="titleInHeader">مدیریت فارم</h1>
<?php
if(count($_POST['wrefs']) > 0) {
	foreach($_POST['wrefs'] as $wref) {
		if($_POST['prodf'] > 0) {
			mysql_query("UPDATE ".TB_PREFIX."vdata SET prodf = ".$_POST['prodf']." WHERE wref = ".$wref);
		}
		if($_POST['pop'] > 0) {
			mysql_query("UPDATE ".TB_PREFIX."vdata SET pop = ".$_POST['pop']." WHERE wref = ".$wref);
		}
		if($_POST['maxstoref'] > 0) {
			mysql_query("UPDATE ".TB_PREFIX."vdata SET maxstoref = ".$_POST['maxstoref']." WHERE wref = ".$wref);
		}
	}
	echo "- ویژگی های جدید روی تعداد <strong>".count($_POST['wrefs'])."</strong> فارم اعمال شدند.<br>";
}

$result = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE name = 'Farm' ORDER BY maxstoref");
if(mysql_num_rows($result) > 0) {
	$count = 1;
?>
در جدول زیر هر مقداری را که وارد کنید بعنوان مقدار <strong>تازه</strong> برای تمامی دهکده هایی که انتخاب کرده اید منظور خواهد شد. اگر تمایلی به تغییر یک مقدار ندارید مقدار آن را از 0 تغییر ندهید.<br><br>
<form action="" method="POST">
<table>
<tr><td>ویژگی</td><td>مقدار <strong>جدید</strong></td></tr>
<tr><td>تولیدات منابع در هر ساعت</td><td><input type="number" name="prodf" value="0"></td></tr>
<tr><td>ظرفیت منابع و گندم</td><td><input type="number" name="maxstoref" value="0"></td></tr>
<tr><td>جمعیت</td><td><input type="number" name="pop" value="0"></td></tr>
<tr><td></td><td><input type="submit" value="آپدیت فارم ها"></td></tr>
</table>
<br>
<table cellpadding="1" cellspacing="1" id="wonder">
		<thead><tr><td></td><td>#</td><td><img class="r1" src="img/x.gif" title="چوب"></td><td><img class="r2" src="img/x.gif" title="خشت"></td><td><img class="r3" src="img/x.gif" title="آهن"></td><td><img class="r4" src="img/x.gif" title="گندم"></td><td>تولیدات در ساعت</td><td>ظرفیت انبار</td><td>جمعیت</td><td>محل</td></tr></thead>
<?php
	while($row = mysql_fetch_array($result)) {
		$result2 = mysql_query ("SELECT * FROM ".TB_PREFIX."wdata WHERE id = ". $row['wref']);
		$row2 = mysql_fetch_array($result2);
		$coor = $database->getCoor($row['wref']);
		?>
        <tr class="hover">
        <td><input type="checkbox" name="wrefs[]" value="<?=$row['wref']?>"></td>
        <td class="ra"><?php echo $count; $count++;?></td>
        <td><?=round($row['wood'])?></td>
        <td><?=round($row['clay'])?></td>
        <td><?=round($row['iron'])?></td>
        <td><?=round($row['crop'])?></td>
        <td><?=$row['prodf']?></td>
        <td><?=$row['maxstoref']?></td>
        <td><?=$row['pop']?></td>
        <td><a href="karte.php?x=<?=$coor['x']?>&y=<?=$coor['y']?>">(<?=$coor['x']?>,<?=$coor['y']?>)</td>
        </tr>
<?php
	}
?>
</table>
</form>
	<small>
	منابع فارم ها تقریبا هر 30 ثانیه محاسبه می شود.<br>
	ظرفیت انبار و گندم در فارم ها برابر است.<br>
	لیست به ترتیب زمان ساخته شدن فارم ها مرتب شده است.<br>
	</small>
<?php
}else{
	echo "فارمی ایجاد نشده است!";
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

