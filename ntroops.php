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

<h1 class="titleInHeader">اضافه کردن نیرو</h1>
<?php
if($_GET['reset']) {
	for($i=2;$i<=49;$i++) {
		mysql_query("UPDATE ".TB_PREFIX."units SET u".$i." = 0 WHERE vref = '". $_GET['reset'] ."'");
	}
}
$tns = array("","سرباز لژیون","محافظ","شمشیرزن","خبرچین","شوالیه","شوالیه سزار","دژکوب","منجنیق آتشین","سناتور","مهاجر","گرزدار","نیزه دار","تبرزن","جاسوس","دلاور","شوالیه توتن","دژکوب","منجنیق","رئیس","مهاجر","سرباز پیاده","شمشیرزن","ردیاب","رعد","کاهن سواره","شوالیه گول","دژکوب","منجنیق","رئیس قبیله","مهاجر","موش","عنکبوت","مار","خفاش","گراز وحشی","گرگ","خرس","تمساح","ببر","فیل","نیزه دار ناتار","تیغ پوش","جاوید","پرندگان شکاری","تیشه زن","شوالیه ناتار","فيل عظيم الجثه جنگي","منجنیق عظيم","امپراطور ناتار");
$vref = mysql_real_escape_string($_GET['vref']);
$result = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE wref = '$vref'");
if(mysql_num_rows($result)>0) {
	if($_POST['submitted']=="yes") {
		for($i=1;$i<=49;$i++) {
			mysql_query("UPDATE ".TB_PREFIX."units SET u".$i." = u".$i." + ".$_POST[$i]." WHERE vref = '".$vref."'");
		}
		echo "نیرو ها اضافه شدند.<br><a href='?new'>از نو</a>";		
	}else{
		$row = mysql_fetch_array($result);
		$vname = $row['name'];
		$uid = $row['owner'];
		echo 'در حال اضافه کردن نیرو به دهکده <b>'.$vname.'</b>.<br>
		نیرو هایی که می خواهید به این دهکده اضافه شوند را مشخص کرده و تعداد بدهید:<br>
		<form action="?vref='.$vref.'" method="post">
		<table>
		<tr><td>نام نیرو</td><td>تعداد</td></tr>';
		$resultt = mysql_query("SELECT * FROM ".TB_PREFIX."units WHERE vref = '$vref'");
		$roww = mysql_fetch_array($resultt);
		for($i=1;$i<=49;$i++) {
			echo '<tr><td>'.$i.'- <img class="unit u'.$i.'" src="img/x.gif" alt="'.$tns[$i].'">  '.$tns[$i].'</td><td>'.$roww["u".$i].' + <input type="text" name="'.$i.'" value="0"></td></tr>';
		}	
		echo '</table>
		<input type="hidden" name="submitted" value="yes">
		<input type="submit" value="ارسال نیرو ها"> یا <a href="?new">از نو</a>
		</form>';
	}
	
	
}else{
	echo '
	برای اضافه کردن نیرو, دهکده ای که می خواهید به آن نیرو اضافه کنید را انتخاب کنید:<br>( برای کم کردن نیرو از علامت منفی استفاده کنید مثلا : -10 )<br>
	<table>
	<tr><td>صاحب دهکده</td><td>نام دهکده</td></tr>';
	$result = mysql_query("SELECT * FROM ".TB_PREFIX."users");
	while($row = mysql_fetch_array($result)) {
		$i_uid = $row['id'];
		$i_uname = $row['username'];
		$r2 = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE owner = '$i_uid'");
		while($row2 = mysql_fetch_array($r2)) {
			$i_vref = $row2['wref'];
			$i_vname = $row2['name'];
			echo '<tr><td>'.$i_uname.'</td><td><a href="?vref='.$i_vref.'">'.$i_vname.'</a></td></tr>';
		}
	}
	echo '</table>';
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
