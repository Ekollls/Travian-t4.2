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

if(isset($_POST['submit'])) {
	$q = "UPDATE `".TB_PREFIX."config` SET `zmultiplier` = '".$_POST['zmultiplier']."'";
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `server_name` = '".$_POST['servername']."'";
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `speed` = '".$_POST['speed']."'";
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `increase` = '".$_POST['attack']."'";
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `protecttime` = '".($_POST['prot'] * 3600)."'";
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `plus_time` = '".($_POST['plus'] * 3600)."'";
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `plus_prodtime` = '".($_POST['plusp'] * 3600)."'";;
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `ph1` = '".($_POST['ph1'] * 6)."'";;
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `ph2` = '".($_POST['ph2'] * 6)."'";;
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `ph3` = '".($_POST['ph3'] * 6)."'";;
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `maxmanabe` = '". $_POST['maxmanabe']."'";;
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `maxmanabe2` = '". $_POST['maxmanabe2']."'";;
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `bsserver` = '". $_POST['bsserver']."'";;
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `bspw` = '". $_POST['bspw']."'";;
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `bsMpop` = '". $_POST['bsmpop']."'";;
	$database->query($q);
	$q = "UPDATE `".TB_PREFIX."config` SET `bsWage` = '". $_POST['bswage']."'";;
	$database->query($q);
}
$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$row = mysql_fetch_array($result);


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

<h1 class="titleInHeader">تنظيمات اخبار بازي<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>


<style>
.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);} 
</style>  
<form action="conf.php" method="post">
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
    <tr>
        <td class="b">اطلاعات</td>
        <td class="b">مشخصات</td> 
    </tr> 
    <tr>
        <td>نام سرور</td>
        <td><input type="text" dir="ltr" class="text" name="servername" id="servername" value="<?php echo SERVER_NAME;?>"></td>    
    </tr> 
    <tr>  
        <td>سرعت سرور</td>
        <td><input type="text" dir="ltr" class="text" name="speed" id="speed" value="<?php echo SPEED;?>"></td>    
    </tr>  
	<tr>
        <td>سرعت حمله</td>
        <td><input type="text" dir="ltr" class="text" name="attack" id="attack" value="<?php echo INCREASE_SPEED;?>"></td>    
    </tr> 
    <tr>

        <td>حمايت تازه واردين</td>

        <td><input type="text" dir="ltr" class="text" name="prot" id="prot" value="<?php echo (PROTECTION/3600);?>"> ساعت</td> 

    </tr>    	
	<tr>

        <td><b><font color='#71D000'></font><font color='#FF6F0F'></font><font color='#71D000'></font><font color='#FF6F0F'>پلاس</font></b> </td>

        <td><input type="text" dir="ltr" class="text" name="plus" id="plus" value="<?php echo (PLUS_TIME/3600); ?>">ساعت
		</td> 

    </tr>  	
	<tr>

        <td>25% توليدات پلاس</td>

        <td><input type="text" dir="ltr" class="text" name="plusp" id="plusp" value="<?php echo (PLUS_PRODUCTION/3600); ?>"> ساعت</td> 

    </tr>  
	<tr>

        <td>تعداد هر گونه از حیوان در پک حیوان 1</td>

        <td><input type="text" dir="ltr" class="text" name="ph1" value="<?=$row['ph1']/6?>"> عدد</td> 

    </tr>  
	<tr>

        <td>تعداد هر گونه از حیوان در پک حیوان 2</td>

        <td><input type="text" dir="ltr" class="text" name="ph2" value="<?=$row['ph2']/6?>"> عدد</td> 

    </tr>  
	<tr>

        <td>تعداد هر گونه از حیوان در پک حیوان 3</td>

        <td><input type="text" dir="ltr" class="text" name="ph3" value="<?=$row['ph3']/6?>"> عدد</td> 

    </tr>  
	<tr>

        <td>محدودیت خرید گزینه افزودن منابع اندازه یک ساعت تولیدات </td>

        <td><input type="text" dir="ltr" class="text" name="maxmanabe2" value="<?=$row['maxmanabe2']?>"> دفعه</td> 

    </tr>  
	<tr>

        <td>محدودیت خرید گزینه افزودن منابع اندازه انبار سطح 20</td>

        <td><input type="text" dir="ltr" class="text" name="maxmanabe" value="<?=$row['maxmanabe']?>"> دفعه</td> 

    </tr>
	<tr>

        <td>ضریب انبار ها:</td>

        <td><input type="text" dir="ltr" class="text" name="zmultiplier" value="<?=$row['zmultiplier']?>"></td> 

    </tr>
    <tr><td colspan="2"><center><strong>تنظیمات بانک</strong></center></td></tr>
    <tr><td>آدرس سرور بانک:<br>( مثلا http://test.com/bank/ )</td><td><input type="text" name="bsserver" value="<?=$row['bsserver']?>"></td></tr> 
    <tr><td>رمز اصلی سرور<br>( رمزی که در سرور بانک تنظیم شده )</td><td><input type="text" name="bspw" value="<?=$row['bspw']?>"></td></tr> 
    <tr><td>حداقل جمعیت برای ذخیره سکه</td><td><input type="text" name="bsmpop" value="<?=$row['bsMpop']?>"></td></tr> 
    <tr><td>درصد کارمزد برای هر ذخیره<br>( 0 تا 100 )</td><td><input type="text" name="bswage" value="<?=$row['bsWage']?>"></td></tr> 
	</table>
		
<Br />	 <center>
        <input type="submit" name="submit" value="submit">
 </center>
	</form>
<?php

function define_array( $array, $keys = NULL )
{
    foreach( $array as $key => $value )
    {
        $keyname = ($keys ? $keys . "_" : "") . $key;
        if( is_array( $array[$key] ) )
            define_array( $array[$key], $keyname );
        else
            define( $keyname, $value );
    }
}

//define_array($array);

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
