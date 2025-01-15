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
if($session->access<2){header("Location: banned.php");}
$start = $generator->pageLoadTimeStart();
if(isset($_GET['ok'])){
	$database->updateUserField($session->username,'ok','0','0'); $_SESSION['ok'] = '0'; }
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
else {
	$building->procBuild($_GET);
}
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome village3">
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
						<div id="content" class="village3">
                                                <h1 class="titleInHeader">درباره اسکریپت</h1>

<script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>
<h2>آخرین تغییرات</h2><br>
<b>ویرایش دوم</b>
<ul>
<li><b>بهبود روند مرگ سرباز ها در هنگام گندم منفی;</b> مرگ سرباز ها پس از مصرف گندم های دهکده شروع خواهد شد. همچنین سرعت انجام محاسبات افزایش بسیاری داشته و لود سرور کاهش یافته است.</li>
<li>رفع مشکل دکمه ها در بخش های مختلف</li>
<li><b>بخش وظایف بازنویسی و با اسکریپت سازگار شد;</b> ازین پس وظایف و عنوان مرحله جاری در سمت چپ صفحه قابل دسترس خواهد بود.</li>
<li>راهنمای پنل کاربری جدید تراوین در سمت چپ صفحه ( دکمه چراغ ) اضافه شد.</li>
<li>رفع باگ ثابت ماندن شمارش های معکوس در قسمت های مختلف بازی; هم اکنون شمارش معکوس در بخش های مربوطه انجام می شود.</li>
<li>حذف قسمت های اضافه در نقشه</li>
<li>بازنویسی دکمه "+25%" در صفحه منابع</li>
</ul>


<b>ویرایش اول</b>
<ul>
<li>اصلاح تصویر قهرمان در جعبه مربوطه</li>
<li>اصلاح امکانات جعبه اتحاد</li>
<li>اصلاح دیالوگ پلاس ( حذف تب اضافه )</li>
<li>اصلاح شماره سطح ساختمان ها در صفحه مرکز دهکده ( موقعیت دایره ها )</li>
<li>اصلاح تصویر آیتم ها در صفحه قهرمان</li>
<li>اصلاح دکمه "25% تولیدات بیشتر" در صفحه منابع. ( این مورد بزودی تکمیل خواهد شد )</li>
<li>رفع باگ دکمه های فعال سازی "25% تولیدات بیشتر" در دیالوگ ها</li>
<li>رفع باگ ثبت نام با نام کاربری های خالی; از الآن کاربری را با نام سفید ( خالی, بدون نام ) مشاهده نخواهید کرد!</li>
<li>رفع باگ باز نشدن قسمت "ساختمان هایی که به زودی قابل تاسیس هستند"</li>
<li>رفع باگ انتخاب حالت "بدون ریش" در صفحه ظاهر قهرمان</li>
<li>رفع باگ نشان داده نشدن تصویر در دیالوگ جزییات هر نقطه در نقشه</li>
<li>حذف آیکون های اضافه در نقشه و اضافه کردن جستجو گر گندم</li>
<li><b>صفحه ریزِ تولیدات منابع مشابه travian.com اصافه شد</b>; می توانید با کلیک روی هرکدام از منابع چوب, خشت, آهن و گندم در بالای صفحه اطلاعات دقیق را مشاهده کنید.</li>
<li><b>قابلیت کچ ( Cache ) شدن بلاک های نقشه اضافه شد</b>; این مورد در کاهش ترافیک سرور, لود سرور و سرعت لود شدن نقشه تاثیر دارد. ( نیاز به فضای هاست بالا. امکان غیرفعال شدن. )</li>
<li>ترجمه برخی قسمت ها که فارسی نبودند</li>
<li>رفع برخی اشکالات ظاهری</li>
<li>و بسیاری دیگر...</li>
</ul>





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

