<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include('GameEngine/Account.php');
if(isset($_COOKIE['lang']) and $_COOKIE['lang']!='')$_SESSION['lang'] = $_COOKIE['lang'];
$conf = $database->config();
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome signup">
<?php include_once("analyticstracking.php") ?>
	<div id="wrapper">
		<img id="staticElements" src="img/x.gif" alt="">
		<div class="bodyWrapper">
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="">
			<div id="header">
				<div id="mtop">
					<a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>"></a>
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
            
            
            
<div id="side_navi">

<div class="clear"></div>
            <div id="contentOuterContainer">

              <div class="contentTitle">&nbsp;</div>
              <div class="contentContainer">
                <div id="content" class="activate">
<h1 class="titleInHeader">غير فعال</h1>
 اين سرور در حال حاضر غير فعال است.<br />اگر بازي خاتمه نيافته باشد تيم وارين در حال تهيه پشتيبان از اطلاعات است. لطفا چند دقيقه اي شکيبا باشيد.<br /><br />تيم t4dl اوقات خوشي براي شما آرزو مي کند. <a class="a arrow" href="http://mersad_mr@att.net/">صفحه اصلي سايت</a>

<div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>
</div>
<div class="contentFooter">&nbsp;</div>



</div>
		<div id="side_info">
	<?php if(NEWSBOX1) { ?>
                <div class="news news1">
                <?php include("Templates/News/newsbox1.tpl"); ?>
                </div>
                <?php } ?>
				<?php if(NEWSBOX2) { ?>
                <div class="news news2">
                <?php include("Templates/News/newsbox2.tpl"); ?>
                </div>
               <?php } ?>
            
		</div>
				<?php
				include("Templates/footer.tpl");
				?>
		</div>

<div id="ce"></div>
</div>
</body>
</html>