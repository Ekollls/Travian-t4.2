<?php
include("GameEngine/Protection.php");
include_once("GameEngine/Village.php");
if($session->access != ADMIN) { 
	echo "شما ادمين نيستيد لطفا تلاش نکنيد."; 
} 
else{
   include "Templates/html.tpl";  
$items = array(
	'btype' => array(
		'1' => array(
			'bid' => '1',
			'group' => 'کلاه خود ها',
			'type'	=> array(
				'1' => array(
					'id' => '1',
					'name' => 'کلاه خود هشیاری'
					),
				'2' => array(
					'id' => '2',
					'name' => 'کلاه خود روشنگری'
					),
				'3' => array(
					'id' => '3',
					'name' => 'کلاه خود دانش'
					),
				'4' => array(
					'id' => '4',
					'name' => 'کلاه خود بازسازی'
					),
				'5' => array(
					'id' => '5',
					'name' => 'کلاه خود سلامتی'
					),
				'6' => array(
					'id' => '6',
					'name' => 'کلاه خود شفا'
					),
				'7' => array(
					'id' => '7',
					'name' => 'کلاه خود گلادیاتورها'
					),
				'8' => array(
					'id' => '8',
					'name' => 'کلاه خود تریبون'
					),
				'9' => array(
					'id' => '9',
					'name' => 'کلاه خود کنسول'
					),
				'10' => array(
					'id' => '10',
					'name' => 'کلاه خود سوارکار'
					),
				'11' => array(
					'id' => '11',
					'name' => 'کلاه خود سواره نظام'
					),
				'12' => array(
					'id' => '12',
					'name' => 'کلاه خود سواره نظام عالی رتبه'
					),
				'13' => array(
					'id' => '13',
					'name' => 'کلاه خود سربازها'
					),
				'14' => array(
					'id' => '14',
					'name' => 'کلاه خود جنگجویان'
					),
				'15' => array(
					'id' => '15',
					'name' => 'کلاه خود فرمانروا'
					)
				)
			),
		'2' => array(
			'bid' => '2',
			'group' => 'زره ها',
			'type'	=> array(
				'82' => array(
					'id' => '82',
					'name' => 'زره بازسازی'
					),
				'83' => array(
					'id' => '83',
					'name' => 'زره سلامتی'
					),
				'84' => array(
					'id' => '84',
					'name' => 'زره تندرستی'
					),
				'85' => array(
					'id' => '85',
					'name' => 'زره سبک'
					),
				'86' => array(
					'id' => '86',
					'name' => 'زره'
					),
				'87' => array(
					'id' => '87',
					'name' => 'زره سنگین'
					),
				'88' => array(
					'id' => '88',
					'name' => 'سپر سینه‌ی سبک'
					),
				'89' => array(
					'id' => '89',
					'name' => 'سپر سینه‌'
					),
				'90' => array(
					'id' => '90',
					'name' => 'سپر سینه‌ی سنگین'
					),
				'91' => array(
					'id' => '91',
					'name' => 'زره چند بخشی سبک'
					),
				'92' => array(
					'id' => '92',
					'name' => 'زره چند بخشی'
					),
				'93' => array(
					'id' => '93',
					'name' => 'زره چند بخشی سنگین'
					)
				)
			),
		'3' => array(
			'bid' => '3',
			'group' => 'اجناس دست چپ',
			'type'	=> array(
				'61' => array(
					'id' => '61',
					'name' => 'نقشه‌ی کوچک'
					),
				'62' => array(
					'id' => '62',
					'name' => 'نقشه'
					),
				'63' => array(
					'id' => '63',
					'name' => 'نقشه‌ی بزرگ'
					),
				'64' => array(
					'id' => '64',
					'name' => 'پرچم سه گوش کوچک'
					),
				'65' => array(
					'id' => '65',
					'name' => 'پرچم سه گوش'
					),
				'66' => array(
					'id' => '66',
					'name' => 'پرچم سه گوش بزرگ'
					),
				'67' => array(
					'id' => '67',
					'name' => 'پرچم کوچک'
					),
				'68' => array(
					'id' => '68',
					'name' => 'پرچم'
					),
				'69' => array(
					'id' => '69',
					'name' => 'پرچم بزرگ'
					),
				'73' => array(
					'id' => '73',
					'name' => 'کیسه‌ی کوچک دزدان'
					),
				'74' => array(
					'id' => '74',
					'name' => 'کیسه‌ی دزدان'
					),
				'75' => array(
					'id' => '75',
					'name' => 'کیسه‌ی بزرگ دزدان'
					),
				'76' => array(
					'id' => '76',
					'name' => 'سپر کوچک'
					),
				'77' => array(
					'id' => '77',
					'name' => 'سپر'
					),
				'78' => array(
					'id' => '78',
					'name' => 'سپر بزرگ'
					),
				'79' => array(
					'id' => '79',
					'name' => 'شیپور کوچک ناتارها'
					),
				'80' => array(
					'id' => '80',
					'name' => 'شیپور ناتارها'
					),
				'81' => array(
					'id' => '81',
					'name' => 'شیپور بزرگ ناتارها'
					)
				)
			),
		'4' => array(
			'bid' => '4',
			'group' => 'اجناس دست راست',
			'type'	=> array(
				'16' => array(
					'id' => '16',
					'name' => 'شمشیر کوتاه سرباز لژیون'
					),
				'17' => array(
					'id' => '17',
					'name' => 'شمشیر سرباز لژیون'
					),
				'18' => array(
					'id' => '18',
					'name' => 'شمشیر بلند سرباز لژیون'
					),
				'19' => array(
					'id' => '19',
					'name' => 'شمشیر کوتاه محافظ'
					),
				'20' => array(
					'id' => '20',
					'name' => 'شمشیر محافظ'
					),
				'21' => array(
					'id' => '21',
					'name' => 'شمشیر بلند محافظ'
					),
				'22' => array(
					'id' => '22',
					'name' => 'شمشیر کوتاه شمشیرزن روم'
					),
				'23' => array(
					'id' => '23',
					'name' => 'شمشیر شمشیرزن روم'
					),
				'24' => array(
					'id' => '24',
					'name' => 'شمشیر بلند شمشیرزن روم'
					),
				'25' => array(
					'id' => '25',
					'name' => 'شمشیر کوتاه شوالیه'
					),
				'26' => array(
					'id' => '26',
					'name' => 'شمشیر شوالیه'
					),
				'27' => array(
					'id' => '27',
					'name' => 'شمشیر بلند شوالیه'
					),
				'28' => array(
					'id' => '28',
					'name' => 'نیزه‌ی سبک شوالیه‌ی سزار'
					),
				'29' => array(
					'id' => '29',
					'name' => 'نیزه‌ی شوالیه‌ی سزار'
					),
				'30' => array(
					'id' => '30',
					'name' => 'نیزه‌ی سنگین شوالیه‌ی سزار'
					),
				'31' => array(
					'id' => '31',
					'name' => 'نیزه‌ی سبک سرباز پياده'
					),
				'32' => array(
					'id' => '32',
					'name' => 'نیزه‌ی سرباز پياده'
					),
				'33' => array(
					'id' => '33',
					'name' => 'نیزه‌ی سنگین سرباز پياده'
					),
				'34' => array(
					'id' => '34',
					'name' => 'شمشیر کوتاه شمشيرزن گول'
					),
				'35' => array(
					'id' => '35',
					'name' => 'شمشیر شمشيرزن گول'
					),
				'36' => array(
					'id' => '36',
					'name' => 'شمشیر بلند شمشيرزن گول'
					),
				'37' => array(
					'id' => '37',
					'name' => 'کمان کوچک رعد'
					),
				'38' => array(
					'id' => '38',
					'name' => 'کمان رعد'
					),
				'39' => array(
					'id' => '39',
					'name' => 'کمان بزرگ رعد'
					),
				'40' => array(
					'id' => '40',
					'name' => 'تجهیزات جنگی سبک كاهن سواره'
					),
				'41' => array(
					'id' => '41',
					'name' => 'تجهیزات جنگی كاهن سواره'
					),
				'42' => array(
					'id' => '42',
					'name' => 'تجهیزات جنگی سنگین كاهن سواره'
					),
				'43' => array(
					'id' => '43',
					'name' => 'نیزه‌ی سبک شوالیه‌ی گول'
					),
				'44' => array(
					'id' => '44',
					'name' => 'نیزه‌ی شوالیه‌ی گول'
					),
				'45' => array(
					'id' => '45',
					'name' => 'نیزه‌ی سنگین شوالیه‌ی گول'
					),
				'46' => array(
					'id' => '46',
					'name' => 'گرز سبک گرزدار'
					),
				'47' => array(
					'id' => '47',
					'name' => 'گرز گرزدار'
					),
				'48' => array(
					'id' => '48',
					'name' => 'گرز سنگین گرزدار'
					),
				'49' => array(
					'id' => '49',
					'name' => 'نیزه‌ی سبک نيزه دار'
					),
				'50' => array(
					'id' => '50',
					'name' => 'نیزه‌ی نيزه دار'
					),
				'51' => array(
					'id' => '51',
					'name' => 'نیزه‌ی سنگین نيزه دار'
					),
				'52' => array(
					'id' => '52',
					'name' => 'تبر سبک تبرزن'
					),
				'53' => array(
					'id' => '53',
					'name' => 'تبر تبرزن'
					),
				'54' => array(
					'id' => '54',
					'name' => 'تبر سنگین تبرزن'
					),
				'55' => array(
					'id' => '55',
					'name' => 'چکش سبک دلاور'
					),
				'56' => array(
					'id' => '56',
					'name' => 'چکش دلاور'
					),
				'57' => array(
					'id' => '57',
					'name' => 'چکش سنگین دلاور'
					),
				'58' => array(
					'id' => '58',
					'name' => 'شمشیر کوتاه شوالیه‌ی توتن'
					),
				'59' => array(
					'id' => '59',
					'name' => 'شمشیر شوالیه‌ی توتن'
					),
				'60' => array(
					'id' => '60',
					'name' => 'شمشیر بلند شوالیه‌ی توتن'
					)
				)
			),
		'5' => array(
			'bid' => '5',
			'group' => 'چکمه ها',
			'type'	=> array(
				'94' => array(
					'id' => '94',
					'name' => 'چکمه‌ی بازسازی'
					),
				'95' => array(
					'id' => '95',
					'name' => 'کمه‌ی سلامتی'
					),
				'96' => array(
					'id' => '96',
					'name' => 'چکمه‌ی ترمیم'
					),
				'97' => array(
					'id' => '97',
					'name' => 'چکمه‌ی سربازی'
					),
				'98' => array(
					'id' => '98',
					'name' => 'چکمه‌ی جنگجو'
					),
				'99' => array(
					'id' => '99',
					'name' => 'چکمه‌ی فرمانروا'
					),
				'100' => array(
					'id' => '100',
					'name' => 'مهمیز کوچک'
					),
				'101' => array(
					'id' => '101',
					'name' => 'مهمیز'
					),
				'102' => array(
					'id' => '102',
					'name' => 'مهمیز بزرگ'
					)
				)
			),
		'6' => array(
			'bid' => '6',
			'group' => 'اسب ها',
			'type'	=> array(
				'103' => array(
					'id' => '103',
					'name' => 'اسب'
					),
				'104' => array(
					'id' => '104',
					'name' => 'اسب اصیل'
					),
				'105' => array(
					'id' => '105',
					'name' => 'اسب جنگی'
					)
				)
			),
		'7' => array(
			'bid' => '7',
			'group' => 'نوار زخم کوچک',
			'type'	=> array(
				'112' => array(
					'id' => '112',
					'name' => 'نوار زخم کوچک'
					)
				)
			),
		'8' => array(
			'bid' => '8',
			'group' => 'نوار زخم',
			'type'	=> array(
				'113' => array(
					'id' => '113',
					'name' => 'نوار زخم'
					)
				)
			),
		'9' => array(
			'bid' => '9',
			'group' => 'قفس',
			'type'	=> array(
				'114' => array(
					'id' => '114',
					'name' => 'قفس'
					)
				)
			),
		'10' => array(
			'bid' => '10',
			'group' => 'کتیبه',
			'type'	=> array(
				'107' => array(
					'id' => '107',
					'name' => 'کتیبه'
					)
				)
			),
		'11' => array(
			'bid' => '11',
			'group' => 'پماد',
			'type'	=> array(
				'106' => array(
					'id' => '106',
					'name' => 'پماد'
					)
				)
			),
		'12' => array(
			'bid' => '12',
			'group' => 'سطل',
			'type'	=> array(
				'108' => array(
					'id' => '108',
					'name' => 'سطل'
					)
				)
			),
		'13' => array(
			'bid' => '13',
			'group' => 'کتاب دانش',
			'type'	=> array(
				'110' => array(
					'id' => '110',
					'name' => 'کتاب دانش'
					)
				)
			),
		'14' => array(
			'bid' => '14',
			'group' => 'لوح قانون',
			'type'	=> array(
				'109' => array(
					'id' => '109',
					'name' => 'لوح قانون'
					)
				)
			),
		'15' => array(
			'bid' => '15',
			'group' => 'اثر هنری',
			'type'	=> array(
				'111' => array(
					'id' => '111',
					'name' => 'اثر هنری'
					)
				)
			)
		)
	);   
	$status = 0;
	if(isset($_POST['submit'])){  
		for($i=1;$i<=114;$i++){
			if(isset($_POST['item_'.$i]) && $_POST['item_'.$i]==1){
				mysql_query("UPDATE `". TB_PREFIX ."autoauction` SET `item_".$i."` = '1'");
			}
			else{
				mysql_query("UPDATE `". TB_PREFIX ."autoauction` SET `item_".$i."` = '0'");
			}
		}
		if(isset($_POST['tbrtime']) && $_POST['tbrtime'] > 0){
			mysql_query("UPDATE `". TB_PREFIX ."autoauction` SET `tbrtime` = '". $_POST['tbrtime'] ."'");
		}
		if(isset($_POST['cofitem']) && $_POST['cofitem'] > 0){
			mysql_query("UPDATE `". TB_PREFIX ."autoauction` SET `cofitem` = '". $_POST['cofitem'] ."'");
		}
		if(isset($_POST['cofrel']) && $_POST['cofrel'] > 0){
			mysql_query("UPDATE `". TB_PREFIX ."autoauction` SET `cofrel` = '". $_POST['cofrel'] ."'");
		}
		$status = 1;
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

<h1 class="titleInHeader">تنظیمات حراجی خودکار</h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>


<?php
if($status == 0){
?>
<form action="" method="POST">
<ul class="tabs"><center>
	<li>ویرایش تنظیمات حراجی خودکار</li>
	</center>
</ul>
کاربر عزیز دقت فرمایید که هنگامی که دو مقدار "تعداد آزاد سازی" و یا "تعداد اجناس" برابر با صفر در نظر گرفته شوند حراجی خودکار متوقف خواهد شد.<br>
آخرین حراجی آزاد شده : <?php echo date("Y:m:d H:i:s",AUTO_AUCTION_1); ?><br>
مدت زمان بین حراجی ها : <input name="tbrtime" type="number" value="<?php echo AUTO_AUCTION_2; ?>"> (مقیاس : ثانیه)<br>
تعداد آزاد سازی : <input name="cofrel" type="number" value="<?php echo AUTO_AUCTION_4; ?>"> (مقیاس : تعداد)<br>
تعداد اجناس : <input name="cofitem" type="number" value="<?php echo AUTO_AUCTION_3; ?>"> (مقیاس : تعداد)<br>
<table width="350" border="1" align="center" class="tbl" id="tabs_2_content_in">
    <tbody>
		<tr>
			<td bgcolor="#d1dde0" height="26" align="center"><b>وضعیت</b></td>
			<td bgcolor="#d1dde0" height="26" align="center"><b>توضیحات</b></td>
		</tr>
<?php 
foreach($items['btype'] as $btype){ 
	echo "<tr>";
	echo "<td colspan='2'>Part ". $btype['bid'] ." : ". $btype['group'] ."</td>";
	echo "</tr>";
	foreach($btype['type'] as $type){
		echo "<tr>";
		echo "<td><input type='checkbox' name='item_".$type['id']."' ";
		$value = "AUTO_AUCTION_ITEM_".$type['id'];
		if(constant($value) == 1){
			echo "checked = 'checked'";
		}
		echo " value='1'></td>";
		echo "<td>". $type['name'] ."</td>";
		echo "</tr>";
		
	}
}
?>	
	</tbody>
</table>

<br />
<div align="right"><input type="submit" name="submit" border="0" src="img/admin/b/ok1.gif"></div>
</form>
<?php } ?>
<br /><br /><div align="right">
<?php if($status == 1) { echo '<font color="Red"><b>Etelaat beruz shodand....</font></b>';
} ?></div>









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

