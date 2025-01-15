<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");

include("GameEngine/Village.php");
$start = $generator->pageLoadTimeStart();
if(isset($_GET['rank'])){ $_POST['rank']==$_GET['rank']; }
if(isset($_GET['newdid'])) {
    $_SESSION['wid'] = $_GET['newdid'];
    header("Location: ".$_SERVER['PHP_SELF']);
}
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

				
				
				
		<script type="text/javascript">
Travian.Translation.add(
{
	'allgemein.anleitung':	'دستورالعمل',
	'allgemein.cancel':	'لغو',
	'allgemein.ok':	'تایید',
	'cropfinder.keine_ergebnisse': 'چیزی مطابق جستجوی شما پیدا نشد.'
});
Travian.applicationId = 'T4.0 Game';
Travian.Game.version = '4.0';
Travian.Game.worldId = 'ir1010';
</script>				
				
				
				
				
				
				
<h1 class="titleInHeader">راهنما</h1>

<div class="helpInfoBlock">
	<a target="_blank" href="#" class="helpHeadLine">سوالات متداول - پاسخ‌های تراوین</a>
	<a target="_blank" href="#" class="helpText">در اینجا شما قادر به پیدا کردن پاسخ‌های سوالات خود در مورد تراوین می‌باشید. اگر قادر به پیدا کردن پاسخ خود نبودید می‌توانید با پشتیبانی داخل بازی نیز تماس بگیرید.</a>
</div>

<div class="helpInfoBlock">
	<a target="_blank" href="agb.php" class="helpHeadLine">قوانین بازی</a>
	<a target="_blank" href="agb.php" class="helpText">اینجا شما می‌توانید قوانین فعلی بازی را پیدا کنید.</a>
</div>

<div class="helpInfoBlock">
	<a href="contact.php" class="helpHeadLine">تماس با پشتیبانی داخل بازی</a>
	<a href="contact.php" class="helpText">اگر قادر به پیدا کردن پاسخ سوال خود نبودید، از اینجا می‌توانید با پشتیبانی داخل بازی تماس بگیرید.</a>
</div>

<div class="helpInfoBlock">
	<a href="contact.php" class="helpHeadLine">سوالات مربوط به پلاس</a>
	<a href="contact.php" class="helpText">می توانید سوالات خود در مورد پرداخت و امکانات سکه‌ی طلای تراوین و پلاس را در اینجا مطرح کنید.</a>
</div>

<div class="helpInfoBlock">
	<a target="_blank" href="#" class="helpHeadLine">فروم</a>
	<a target="_blank" href="#" class="helpText">در فروم، شما می‌توانید با بازیکن‌های دیگر آشنا شده و گفتگو کنید.</a>
</div>

<div class="helpInfoBlock">
	<a href="#" class="helpHeadLine" onclick="return Travian.Game.iPopup(0,0);">دستورالعمل</a>
	<a href="#" onclick="return Travian.Game.iPopup(0,0);" class="helpText">در اینجا شما می‌توانید اطلاعات مختصری در مورد ساختمان‌ها و نیروهای موجود در تراوین را پیدا کنید.</a>
</div>



 <div class="clear">&nbsp;</div>




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

