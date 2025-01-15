<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include ("GameEngine/Protection.php");       

date_default_timezone_set('Asia/Tehran');

include("GameEngine/Account.php");
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome login qualificationServerLogin">
	<div id="wrapper">
		<img id="staticElements" src="img/x.gif" alt="">
		<div class="bodyWrapper">
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="">
			<div id="header">
				<div id="mtop">
					<a id="logo" href="../" target="_blank" title="<?php echo SERVER_NAME; ?>"></a>
					<div class="clear"></div>
				</div>
			</div>
			<div id="mid">

			
							<a id="ingameManual" href="support.php" title="<?php echo HELP_HELP;?>">
							<img src="img/x.gif" class="question" alt="<?php echo HELP_HELP;?>"/>
						</a>
	
			
						
				
        <div id="anwersQuestionMark">
            <a href="help.php" target="_blank" title="<?php echo HELP_2; ?> <?php echo NAME_FA;?>">&nbsp;</a>
        </div>		
						
						
						
<div id="side_navi">
	<ul>
		<li>
			<a href="../" title="<?php echo HOME; ?>"><?php echo HOME; ?></a>
		</li>

		<li class="active">
			<a href="login.php" title="<?php echo LOGIN; ?>"><?php echo LOGIN; ?></a>
		</li>

		<li>
			<a href="anmelden.php" title="<?php echo REG; ?>"><?php echo REG; ?></a>
		</li>

		<li>
			<a href="#" target="_blank" title="<?php echo FORUM; ?>"><?php echo FORUM; ?></a>
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
								<div id="content" class="login">
								<h1 class="titleInHeader">تعميرات</h1>
								
<script>
sec=0;
min=0;
hou=0;
function moisrexbbb(){
// creat by travianxspeed.in
	sec++;
	if (sec==60){
		sec=0;
		min++;
	}
	if (min==60){
		hou++;
	}
	document.getElementById('moisrexClock').innerHTML='<center><b>زمان حضور شما در این صفحه '+hou+' ساعت و '+min+' دقیقه و '+sec+' ثانیه می باشد.</b></center>';
	setTimeout("moisrexbbb();",1000);
}
window.onload=moisrexbbb;
</script>


<centeR><b><?php echo $session->username; ?> عزیز سرور در حال تعمیر و بازسازی میباشد. برای اطلاعات بیشتر متن زیر را بخوانید</b> </center><br><br>
<?php
$conf = $database->config();
$main = $conf['maintenance_time']-time();
    function secondsToString( $seconds )
    {
        $seconds = intval( $seconds );
        $h = floor( $seconds / 3600 );
        $m = floor( $seconds % 3600 / 60 );
        $s = floor( $seconds % 60 );
        if ( $h < 0 || $m < 0 || $s < 0 )
        {
            return "0:00:00<a href=\"#\" onclick=\"return showManual(7,0);\">?</a>";
        }
        return $h.":".( $m < 10 ? "0" : "" ).$m.":".( $s < 10 ? "0" : "" ).$s;
    }

$ss = secondsToString( $main );
echo "<p align=\"center\"><strong><span id=\"timer1\">$ss</span> ساعت تا پایان تعمیرات باقی مانده است</strong></p>";
echo "\t\t<div class=\"l-tl\"><div class=\"l-tr\"><div class=\"l-tc\"></div></div>";
echo "<div class=\"l-ml\"><div class=\"l-mr\"><div class=\"l-mc\"><div class=\"l-content\">";
echo '<table id="brought_in" cellpadding="1" cellspacing="1" align=center class="auto-style2">
<thead><th colspan="10" class="auto-style1">توضیحات</thead>
<tbody><th><center>';
$empty = $conf['maintenance_res'] == "";
if($empty){
echo "<center><font color=red><b>هیچ اطلاعاتی توسط ادمین ارائه نشده است.</b></font></center>";
} elseif(!$empty) {
echo "<center><font color=green><b>";
echo nl2br( $conf['maintenance_res'] );
echo "</b></font></center>";
}
echo "</th></tbody></table>";

echo "<div class=\"clear\"></div>\r\n\t\t\t\t\t</div></div></div>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"l-bl\"><div class=\"l-br\"><div class=\"l-bc\"></div></div></div>\r\n\t\t\t</form>\r\n\t\t</div>";

echo "<p class=\"f16\" align=\"center\"><a href=\"maintenance.php?reset\"><font color=blue>";
echo "صفحه بعدی";
echo "</font></a></p>";
echo "<p class=\"f16\" align=\"center\"><a href=\"logout.php\"><font color=red>";
echo "خروج";
echo "</font></a></p>";
if(isset($_GET['reset'])){
	if(time() > $conf['maintenance_time']){
        $database->editconf("maintenance", "0");
		$database->editconf("maintenance_time", "0");
		$database->editconf("maintenance_res", "");	
		echo "<SCRIPT language='JavaScript'>window.location='dorf1.php';</SCRIPT>";
	} 
	else {
		echo "<center><font color=red size = 3.5><b>تعمیرات هنوز تمام نشده است.</b></font></center>";
	}
}
for($I = 0 ; $I<= 10; ++$I){
if($I == 10){
echo "<center>";
}
}
?>
<div id="moisrexClock"></div>
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