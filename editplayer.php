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
if($session->access != ADMIN) { 
	die( "شما ادمين نيستيد لطفا تلاش نکنيد." ); 
} 
$sssssss = false;
include "Templates/html.tpl";
$query = mysql_query('SELECT * FROM '.TB_PREFIX.'users WHERE `id` = '.mysql_real_escape_string((isset($_GET['id']) ? (int)$_GET['id'] : '0')));
if(mysql_num_rows($query) != 1){header("location: dorf1.php");exit();}
$row = mysql_fetch_assoc($query);
if(isset($_POST['search'])){
$gold = preg_replace('/[^0-9]/','',$_POST['addgold']);
	$access = $_POST['access'];
	if($access != $row['access']){
		mysql_query('UPDATE '.TB_PREFIX.'users SET access = '.$access.' WHERE `id` = '.$_GET['id']);
	}
	if($gold > 0){
		mysql_query('UPDATE '.TB_PREFIX.'users SET gold = gold + '.$gold.', giftgold = giftgold + '.$gold.' WHERE `id` = '.$_GET['id']);
	}
	$sssssss = true;
}
?>
<body class="v35 webkit chrome plus">
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
						<div id="content" class="plus">
                        <script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>
<h1>ویرایش بازیکن</h1>
<form action="" method='post'>
<table>
<tr>
	<th>نام</th>
	<th>ایمیل</th>
	<th>دسترسی</th>
	<th>افزودن طلا</th>
</tr>
<?php 
echo "<tr>
	<td>{$row['username']}</td>
	<td>{$row['email']}</td>
	<td>";
	echo "<select name=\"access\" dir='ltr'>";
	echo "<option value=\"0\"".($row['access'] == 0 ? 'selected="selected"':'').">banned</option>";
	echo "<option value=\"2\"".($row['access'] == 2 ? 'selected="selected"':'').">player</option>";
	echo "<option value=\"8\"".($row['access'] == 8 ? 'selected="selected"':'').">multihunter</option>";
	echo "<option value=\"9\"".($row['access'] == 9 ? 'selected="selected"':'').">admin</option>";
	echo "</select></td>
	<td><input type='text' name='addgold' class='text name' size='5' value='0'/></td>
</tr>";?>
</table><br>
<button type="submit" value="search" name="search" id="btn_ok" class="dynamic_img " src="img/x.gif">
            <div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">ثبت</div></div></button>
</form>
<?php 
if($sssssss)echo 'تنظیمات جدید با موفقیت ذخیره شد!<Br>';?>

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

