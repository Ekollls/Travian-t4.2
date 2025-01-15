<?php


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
	<a target="_blank" href="http://forum.t4dl.ir/index.php" class="helpHeadLine">سوالات متداول - پاسخ‌های تراوین</a>
	<a target="_blank" href="http://forum.t4dl.ir/index.php" class="helpText">در اینجا شما قادر به پیدا کردن پاسخ‌های سوالات خود در مورد تراوین می‌باشید. اگر قادر به پیدا کردن پاسخ خود نبودید می‌توانید با پشتیبانی داخل بازی نیز تماس بگیرید.</a>
</div>

<div class="helpInfoBlock">
	<a target="_blank" href="http://t4dl.ir/#agb" class="helpHeadLine">قوانین بازی</a>
	<a target="_blank" href="http://t4dl.ir/#agb" class="helpText">اینجا شما می‌توانید قوانین فعلی بازی را پیدا کنید.</a>
</div>

<div class="helpInfoBlock">
	<a href="contact.php" class="helpHeadLine">تماس با پشتیبانی داخل بازی</a>
	<a href="contact.php" class="helpText">اگر قادر به پیدا کردن پاسخ سوال خود نبودید، از اینجا می‌توانید با پشتیبانی داخل بازی تماس بگیرید.</a>
</div>

<div class="helpInfoBlock">
	<a href="http://forum.t4dl.ir/index.php" class="helpHeadLine">سوالات مربوط به پلاس</a>
	<a href="http://forum.t4dl.ir/index.php" class="helpText">می توانید سوالات خود در مورد پرداخت و امکانات سکه‌ی طلای تراوین و پلاس را در اینجا مطرح کنید.</a>
</div>

<div class="helpInfoBlock">
	<a target="_blank" href="http://trvinforum.ir/" class="helpHeadLine">فروم</a>
	<a target="_blank" href="http://trvinforum.ir/" class="helpText">در فروم، شما می‌توانید با بازیکن‌های دیگر آشنا شده و گفتگو کنید.</a>
</div>

<div class="helpInfoBlock">
	<a href="#" class="helpHeadLine" onclick="return Travian.Game.iPopup(0,0);">دستورالعمل</a>
	<a href="#" onclick="return Travian.Game.iPopup(0,0);" class="helpText">در اینجا شما می‌توانید اطلاعات مختصری در مورد ساختمان‌ها و نیروهای موجود در تراوین را پیدا کنید.</a>
</div>



 <div class="clear">&nbsp;</div>



</div></div>


   




                        <div class="contentFooter">&nbsp;</div>
</div>
                    
<?php
include("Templates/sideinfo.tpl");
include("Templates/footer.tpl");
include("Templates/header.tpl");
include("Templates/res.tpl");
include("Templates/vname.tpl");
include("Templates/quest.tpl");
?>

</div>
<div id="ce"></div>
</div>
</body>
</html>
