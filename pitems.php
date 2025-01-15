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

$result = mysql_query("SELECT * FROM ".TB_PREFIX."pitems");
if(@mysql_num_rows($result)<1) {
					$pitems = array(
					array("name"		=>		"اکانت پلاس",
						  "alias"		=>		"pa",
						  "coin"		=>		"10"
						  ),
					array("name"		=>		"25%+ تولید چوب",
						  "alias"		=>		"25w",
						  "coin"		=>		"5"
						  ),
					array("name"		=>		"25%+ تولید خشت",
						  "alias"		=>		"25c",
						  "coin"		=>		"5"
						  ),
					array("name"		=>		"25%+ تولید آهن",
						  "alias"		=>		"25i",
						  "coin"		=>		"5"
						  ),
					array("name"		=>		"25%+ تولید گندم",
						  "alias"		=>		"25wh",
						  "coin"		=>		"5"
						  ),
					array("name"		=>		"اتمام فوری ساخت ها و تحقیق ها",
						  "alias"		=>		"baric",
						  "coin"		=>		"2"
						  ),
					array("name"		=>		"اتمام فوری آموزش سربازان و ساخت ابزار ها",
						  "alias"		=>		"icasa",
						  "coin"		=>		"10"
						  ),
					array("name"		=>		"افزودن 50 نفر جمعیت",
						  "alias"		=>		"a50p",
						  "coin"		=>		"25"
						  ),
					array("name"		=>		"بنای فوری اردوگاه سطح 20",
						  "alias"		=>		"o20",
						  "coin"		=>		"10"
						  ),
					array("name"		=>		"افزودن 15% وفاداری",
						  "alias"		=>		"a15v",
						  "coin"		=>		"25"
						  ),
					array("name"		=>		"اخرید منابع به اندازه 1ساعت تولید دهکده",
						  "alias"		=>		"khm1td",
						  "coin"		=>		"10"
						  ),
					array("name"		=>		"افزودن 3000 امتیاز فرنگی",
						  "alias"		=>		"a3hef",
						  "coin"		=>		"25"
						  ),
					array("name"		=>		"بازگشت فوری سربازان در راه برگشت",
						  "alias"		=>		"bfh",
						  "coin"		=>		"20"
						  ),
					array("name"		=>		"خرید منابع به اندازه یک انبار سطح 20",
						  "alias"		=>		"khm20dh",
						  "coin"		=>		"30"
						  ),
					array("name"		=>		"افزودن 1000 امتیاز به تجربه ی قهرمان",
						  "alias"		=>		"1ebtgh",
						  "coin"		=>		"10"
						  ),
					array("name"		=>		"خرید حمایت",
						  "alias"		=>		"khhhh",
						  "coin"		=>		"30"
						  ),
					array("name"		=>		"خرید ماجراجویی",
						  "alias"		=>		"khmjjj",
						  "coin"		=>		"1"
						  ),
					array("name"		=>		"تعدیل منابع بصورت 1:1",
						  "alias"		=>		"tmb11",
						  "coin"		=>		"3"
						  ),
					array("name"		=>		"کلوپ طلایی",
						  "alias"		=>		"ctt",
						  "coin"		=>		"100"
						  )
					
					);
					foreach($pitems as $item) {
						mysql_query("INSERT INTO ".TB_PREFIX."pitems(name,alias,coin,status) VALUES('".$item['name']."','".$item['alias']."','".$item['coin']."','active')");
					}
}


if(isset($_POST['submitted'])) {
	$result = mysql_query("SELECT * FROM ".TB_PREFIX."pitems");
	while($row=mysql_fetch_array($result)) {
		mysql_query("UPDATE ".TB_PREFIX."pitems SET coin = '".$_POST[$row['alias']."_coin"]."' WHERE alias = '".$row['alias']."'");
		mysql_query("UPDATE ".TB_PREFIX."pitems SET status = '".$_POST[$row['alias']."_status"]."' WHERE alias = '".$row['alias']."'");
		
		
		
		
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

<h1 class="titleInHeader">تنظیمات گزینه های پلاس<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>

<table>
<form action="" method="post">
<input type="hidden" name="submitted" value="1">
<tr><td>نام</td><td>سکه</td><td>وضعیت</td></tr>
<?php
$result = mysql_query("SELECT * FROM ".TB_PREFIX."pitems");
while($row=mysql_fetch_array($result)) {
	if($row['status'] == "active") {
		$se = ' checked="checked"';
		$sd = '';
	}else{
		$sd = ' checked="checked"';
		$se = '';
	}
	
	echo '<tr><td>'.$row['name'].'</td><td><input style="width:40px;" type="number" name="'.$row['alias'].'_coin" value="'.$row['coin'].'"></td><td>فعال: <input type="radio" name="'.$row['alias'].'_status" value="active"'.$se.'> | غیرفعال: <input type="radio" name="'.$row['alias'].'_status" value="notactive"'.$sd.'></td></tr>';
	
	
	
	
}






?>


<input type="submit" value="ارسال تغییرات">
</form>

</table>













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

