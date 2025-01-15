<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For Mersad_mr@att.net
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
            <a href="http://answers.t4dl.ir/index.php" target="_blank" title="&#1662;&#1575;&#1587;&#1582; &#1607;&#1575;&#1740;  &#1578;&#1585;&#1608;&#1740;&#1606;">&nbsp;</a>
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

<h1 class="titleInHeader">اصلاح نیرو های آبادی های تسخیر نشده</h1>
<?php
if($_GET['do'] == "yes") {
	$result = mysql_query("SELECT * FROM ".TB_PREFIX."odata");
	$t_ids = array(31,32,33,34,35,36,37,38,39,40);
	while($row = mysql_fetch_array($result)) {
		$vref = $row['wref'];
		for($y=31;$y<=40;$y++) {
			mysql_query("UPDATE ".TB_PREFIX."units SET u".$y." = 0 WHERE vref = ".$vref);
		}
		if($_GET['no2'] > 0) {$oo = $_GET['no2'];}else{$oo = mt_rand(1,10);};
		for($i=1;$i<=$oo;$i++) {
			$t_id = $t_ids[mt_rand(0,count($t_ids)-1)];
			if($_GET['no'] > 0) { $no = $_GET['no']; }else {$no = mt_rand(0,SPEED/5);} ;
			$t_n = $no;
			mysql_query("UPDATE ".TB_PREFIX."units SET u".$t_id." = ".$t_n." WHERE vref = ".$vref);
		};
	}
	echo "<b>نیرو ها اصلاح شدند.</b><br>";
}
?>

برای ریست کردن نیرو های آبادی های تسخیر نشده با توجه به سرعت بازی, روی دکمه زیر کلیک کنید:<br>
( توجه کنید که این عمل زمانبر است )<br>
برای انجام روند تصادفی برای هر یک از اطلاعات خواسته شده, به مقدار آن دست نزنید ( 0 باشد ).<br>
<form action="" method="GET">
<input type="hidden" name="do" value="yes">
<table>
<tr><td>تعداد هر گونه در آبادی ها</td><td><input type="text" name="no" value="0"></td></tr>
<tr><td>تعداد گونه ها در هر آبادی</td><td><input type="text" name="no2" value="0"></td></tr>
<tr><td></td><td><input type="submit" value="ریست آبادی ها"></td></tr>
</table>
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

