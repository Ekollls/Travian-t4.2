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
   error_reporting(0);
   if(isset($_POST['int'])) {
		mysql_query("UPDATE ".TB_PREFIX."config SET m_int = ".$_POST['int']*3600);
		mysql_query("UPDATE ".TB_PREFIX."config SET m_lastpt = ".time());
   }
	if($_GET['active'] == "yes") {
		mysql_query("UPDATE ".TB_PREFIX."config SET m_int = 86400");
		mysql_query("UPDATE ".TB_PREFIX."config SET m_lastpt = ".time());
	}
	if($_GET['deactive'] == "yes") {
		mysql_query("UPDATE ".TB_PREFIX."config SET m_int = 0");
		mysql_query("UPDATE ".TB_PREFIX."config SET m_lastpt = ".time());
	}
	$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
	$row = mysql_fetch_array($result);
	if($row['m_int']>0) { $status="فعال"; }else{ $status = "غیرفعال"; };
	if($_GET['active'] == "yes") {
		mysql_query("UPDATE ".TB_PREFIX."config SET m_int = 3600");
		mysql_query("UPDATE ".TB_PREFIX."config SET m_lastpt = ".time());
	}
	if($_GET['deactive'] == "yes") {
		mysql_query("UPDATE ".TB_PREFIX."config SET m_int = 0");
		mysql_query("UPDATE ".TB_PREFIX."config SET m_lastpt = ".time());
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

<h1 class="titleInHeader">اهدای مدال ها بصورت خودکار</h1>
<b>وضعیت</b><br>
------------------------------------------------------------------------------------------------------------------------------------<br><?php
if($row['m_int']>0) {
	if( $row['m_int'] >= 86400 ) {
		$intf = round($row['m_int'] / (86400)) ." روز";
	}else{
		$intf = round($row['m_int'] / (3600)) ." ساعت";
	}
	if( time()-$row['m_lastpt'] >= 86400 ) {
		$intf = round($row['m_int'] / (86400)) ." روز";
	}else{
		$intf = round($row['m_int'] / (3600)) ." ساعت";
	}
	?>
	در حال حاظر مدال ها هر <strong><?=$intf?></strong> بصورت خودکار اهدا می شوند.<br>
	آخرین اهدا مدال: <strong><?=round( (time()-$row['m_lastpt'])/3600 ,1 )?> ساعت پیش</strong><br>
	اهدا مدال بعدی: <strong><?=round( ( ($row['m_lastpt']+$row['m_int']) - time() )/3600 ,1 )?> ساعت آینده</strong><br>    
<?php }else{ ?>
	در حال حاظر مدال ها بصورت خودکار اهدا <strong>نمی شوند</strong>.
<?php }; ?>

<br>
<br>
<br>


<b>تنظیمات</b><br>
------------------------------------------------------------------------------------------------------------------------------------<br>
وضعیت: <strong><?=$status?></strong>
<br>
<center><a href="?active=yes">فعال کن</a> | <a href="?deactive=yes">غیرفعال کن</a></center> <br>
<form action="?" method="post">
مدال ها هر چند ساعت به صورت خودکار اهدا شوند؟ <input type="text" name="int" value="<?=round($row['m_int']/3600)?>"><br>
<input type="submit" value="ثبت">
</form>





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

