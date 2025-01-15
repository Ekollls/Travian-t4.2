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
	<ul>
		<li>
			<a href="<?php echo HOMEPAGE; ?>" title="<?php echo HOME; ?>"><?php echo HOME; ?></a>
		</li>

		<li>
			<a href="login.php" title="<?php echo LOGIN; ?>"><?php echo LOGIN; ?></a>
		</li>

		<li class="active">
			<a href="anmelden.php" title="<?php echo REG; ?>"><?php echo REG; ?></a>
		</li>

		<li>
			<a href="http://trvinforum.ir" target="_blank" title="<?php echo FORUM; ?>"><?php echo FORUM; ?></a>
		</li>
		
		<li class="support">
			<a href="contact.php" title="<?php echo SUPPORT; ?>"><?php echo SUPPORT; ?></a>
		</li>
	</ul>
</div>	
<div class="clear"></div>
            <div id="contentOuterContainer">

              <div class="contentTitle">&nbsp;</div>
              <div class="contentContainer">
                <div id="content" class="activate">
<h1 class="titleInHeader">ثبت نام</h1>
<div id="passwordForgotten">
ثبت نام در اين سرور خاتمه يافته است.<br />لطفا در سرور ديگري ثبت نام کنيد. <a class="a arrow" href="http://mersad_mr@att.net/">صفحه اصلي سايت</a>
</div>
<br /><br /><h4 class="round">&#1601;&#1593;&#1575;&#1604; &#1587;&#1575;&#1586;&#1740;</h4>
    <a href="activate.php" title="&#1601;&#1593;&#1575;&#1604; &#1587;&#1575;&#1586;&#1740;">      &#1583;&#1585; &#1581;&#1575;&#1604; &#1581;&#1575;&#1590;&#1585; &#1579;&#1576;&#1578; &#1606;&#1575;&#1605; &#1705;&#1585;&#1583;&#1607;&#8204;&#1575;&#1740;&#1583;&#1567; &#1575;&#1705;&#1575;&#1606;&#1578; &#1582;&#1608;&#1583; &#1585;&#1575; &#1601;&#1593;&#1575;&#1604; &#1705;&#1606;&#1740;&#1583;. </a>

<br><br>
<center><b>با عرض سلام و خسته نباشید . <br>شما قبلا در سرور ما ثبت کرده اید و دیگر نمی توانید در سرور ما ثبت نام نمایید . <br><br><br><font color=red>توجه : </font> طبق <font color=red><u> قوانین </u></font>سرور 
<font color=red><u>هر کسی </u></font>
در 
<font color=red><u> هر سرور </u></font>
باید دارای 
<font color=red><u> یک اکانت </u></font>
باشد . در غیر این صورت هر شخصی دارای 
<font color=red><u>بیش از یک اکانت</u></font>
باشد توسط
<font color=red><u>
 سیستم مولتی اکانت موجود در سرور 
،</u></font><font color=blue><u>
بازداشت</font></u>
خواهد شد

</b></center>
<br><br><br>
    <div class="clear"></div>	
<div class="clear">&nbsp;</div></div>
<div class="clear"></div></div>
<div class="contentFooter">&nbsp;</div></div>
     <?php
@include("GameEngine/Database/connection.php");
@$con = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
@mysql_select_db(SQL_DB, $con);
$users = array();
$users['total'] = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users"));
$users['active'] = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (3600*24) AND tribe!=5 AND tribe!=0"));
$users['online'] = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (60*60) AND tribe!=5 AND tribe!=0"));
mysql_close($con);
?>

					<div id="side_info">
                    <div class="news" style="position:absolute;margin-right:-839px;margin-top:318px;background-size:131px 100px;padding-top:19px;line-height:20px;">
کاربران فعال: <b><?=$users['active']?></b> نفر<br>
کل کاربران: <b><?=$users['total']-4?></b> نفر<br>


</div>
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