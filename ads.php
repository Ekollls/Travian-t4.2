<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

include_once("GameEngine/Account.php");
if($session->access != ADMIN) { 
	echo "شما ادمين نيستيد لطفا تلاش نکنيد."; 
} 
else{
   include "Templates/html.tpl"; 
   error_reporting(0);
   if(@$_POST['submitted2']=="yes") {
	$maxhits = $_POST['maxhits'];
	$sil = $_POST['sil'];
	$delay = $_POST['delay']*1000;
	$qry = "UPDATE ".TB_PREFIX."config SET ads_maxhits='$maxhits'";
	mysql_query($qry);
	$qry = "UPDATE ".TB_PREFIX."config SET ads_delay='$delay'";
	mysql_query($qry);
	$qry = "UPDATE ".TB_PREFIX."config SET ads_silver='$sil'";
	mysql_query($qry);
}
if(@$_GET['active']=="yes") {
	$qry = "UPDATE ".TB_PREFIX."config SET ads_active='yes'";
	mysql_query($qry);
}
if(@$_GET['deactive']=="yes") {
	$qry = "UPDATE ".TB_PREFIX."config SET ads_active='no'";
	mysql_query($qry);
}
$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$row = mysql_fetch_array($result);
$ads = array(	
				"maxHits"		=>		$row['ads_maxhits'],
				"sil"			=>		$row['ads_silver'],
				"delay"			=>		$row['ads_delay'],
				"active"		=>		$row['ads_active']
			);
			if($ads['active'] == "yes") {
				$ads['active'] = "فعال";
			}else{
				$ads['active'] = "غیرفعال";
			}
if(@is_numeric($_GET['remove'])) {
	$id = @mysql_real_escape_string($_GET['remove']);
	$qry = "DELETE FROM ".TB_PREFIX."ads WHERE ID='$id'";
	mysql_query($qry);
}
if(@$_POST['submitted']=="yes") {
	$qry = "INSERT INTO ".TB_PREFIX."ads(url,banner) VALUES('".$_POST['url']."','".$_POST['banner']."')";
	mysql_query($qry);
}
?>
<body class="v35 webkit chrome statistics">
	<div id="wrapper"> 
		<img id="staticElements" src="img/x.gif" alt="" /> 
		<div id="logoutContainer"> 
			<a id="logout" href="logout.php" title="<?php echo LOGOUT; ?>">&nbsp;</a> 
		</div> 
		<div class="bodyWrapper"> 
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> 
			<div id="header"> 
				<div id="mtop">
					<a id="logo" href="../" target="_blank" title="<?php echo SERVER_NAME ?>"></a>
					<ul id="navigation">
						<li id="n1" class="resources">
							<a class="" href="dorf1.php" accesskey="1" title="<?php echo HEADER_DORF1; ?>"></a>
						</li>
						<li id="n2" class="village">
							<a class="" href="dorf2.php" accesskey="2" title="<?php echo HEADER_DORF2; ?>"></a>
						</li>
						<li id="n3" class="map">
							<a class="" href="karte.php" accesskey="3" title="<?php echo HEADER_MAP; ?>"></a>
						</li>
						<li id="n4" class="stats">
							<a class=" active" href="statistiken.php" accesskey="4" title="<?php echo HEADER_STATS; ?>"></a>
						</li>
<?php
    	if(count($database->getMessage($session->uid,7)) >= 1000) {
			$unmsg = "+1000";
		} else { $unmsg = count($database->getMessage($session->uid,7)); }
		
    	if(count($database->getMessage($session->uid,8)) >= 1000) {
			$unnotice = "+1000";
		} else { $unnotice = count($database->getMessage($session->uid,8)); }
?>
<li id="n5" class="reports"> 
<a href="berichte.php" accesskey="5" title="<?php echo HEADER_NOTICES; ?><?php if($message->nunread){ echo' ('.count($database->getMessage($session->uid,8)).')'; } ?>"></a>
<?php
if($message->nunread){
	echo "<div class=\"ltr bubble\" title=\"".$unnotice." ".HEADER_NOTICES_NEW."\" style=\"display:block\">
			<div class=\"bubble-background-l\"></div>
			<div class=\"bubble-background-r\"></div>
			<div class=\"bubble-content\">".$unnotice."</div></div>";
}
?>
</li>
<li id="n6" class="messages"> 
<a href="nachrichten.php" accesskey="6" title="<?php echo HEADER_MESSAGES; ?><?php if($message->unread){ echo' ('.count($database->getMessage($session->uid,7)).')'; } ?>"></a> 
<?php
if($message->unread) {
	echo "<div class=\"ltr bubble\" title=\"".$unmsg." ".HEADER_MESSAGES_NEW."\" style=\"display:block\">
			<div class=\"bubble-background-l\"></div>
			<div class=\"bubble-background-r\"></div>
			<div class=\"bubble-content\">".$unmsg."</div></div>";
}
?>
</li>

</ul>
<div class="clear"></div> 
</div> 
</div>
					<div id="mid">

      
              <a id="ingameManual" href="support.php" title="&#1585;&#1575;&#1607;&#1606;&#1605;&#1575;">
              <img src="img/x.gif" class="question" alt="&#1585;&#1575;&#1607;&#1606;&#1605;&#1575;"/>
            </a>
  
      
            
        
        <div id="anwersQuestionMark">
            <a href="http://forum.t4dl.ir/index.php" target="_blank" title="&#1662;&#1575;&#1587;&#1582; &#1607;&#1575;&#1740;  &#1578;&#1585;&#1608;&#1740;&#1606;">&nbsp;</a>
        </div>    

												<div class="clear"></div> 
<div id="contentOuterContainer"> 
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

<h1 class="titleInHeader">تبلیغات</h1>
<b>تنظیمات</b><br>
------------------------------------------------------------------------------------------------------------------------------------<br>

وضعیت: <?=$ads['active']?>
<br>
<center><a href="?active=yes">فعال کن</a> | <a href="?deactive=yes">غیرفعال کن</a></center> 
<form action="" method="post">
<input type="hidden" name="submitted2" value="yes">
زمان توقف و نشان دادن "درحال انتقال..." به کاربر(به ثانیه): <input type="text" name="delay" value="<?=$ads['delay']/1000?>"><br>
مقدار هقره ی هدیه به ازای هرکلیک روی هر تبلیغ در یک روز: <input type="text" name="sil" value="<?=$ads['sil']?>"><br>
حداکثر تعداد دفعه کلیک روی هر تبلیغ و دادن نقره به کاربر در طی روز: <input type="text" name="maxhits" value="<?=$ads['maxHits']?>"><br>
<input type="submit" value="تغییر">




</form>




<br>
<br>

<h1 class="titleInHeader">تبلیغات</h1>
<b>اضافه کردن تبلیغ</b><br>
------------------------------------------------------------------------------------------------------------------------------------<br>
<form action="" method="post">
<input type="hidden" name="submitted" value="yes">
<table>
<tr><td>لینک:</td><td><input placeholder="http://google.com" style="direction:ltr;width:100%;" type="text" name="url"></td></tr>
<tr><td>آدرس بنر:</td><td><input placeholder="http://google.com/img/banner.gif" style="direction:ltr;width:100%;" type="text" name="banner"></td></tr>
<tr><td></td><td><input style="width:40%;" type="submit" value="اضافه کن"></td></tr>
</table>
</form>

<br>
<br>


<b>لیست تبلیغات</b><br>
------------------------------------------------------------------------------------------------------------------------------------<br>
<table style="width:100%">
<tr><td>ردیف</td><td>لینک</td><td>عملیات</td></tr>
<?php
$result = mysql_query("SELECT * FROM ".TB_PREFIX."ads");
if(@mysql_num_rows($result) > 0) {
    while ($row = @mysql_fetch_array($result)) {
        $id = $row['ID'];
        $image = $row['banner'];
        echo '<tr><td>'.$row['ID'].'</td><td>'.$row['url'].'</td><td><a href="?remove='.$row['ID'].'">حذف</a></td></tr>';
    }
}






?>




</table>











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

