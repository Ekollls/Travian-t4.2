<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
set_time_limit(0); 
date_default_timezone_set('Asia/Tehran');
   include_once("GameEngine/Village.php");
if($session->access != ADMIN) { 
	echo "شما ادمين نيستيد لطفا تلاش نکنيد."; 
} 
else{
	include_once ("Templates/html.tpl");  
   include_once("GameEngine/Database.php");
	?>
<meta content="en-us" http-equiv="Content-Language">
<style type="text/css">
.menu {
	border:1px solid green;
	color:green;
	padding:8px;
	background:#DCFFD2;
	text-align:center;
	margin-bottom:6px;
	line-height:1.5em;
	fontsize:25;

	}
.auto-style1 {
	text-align: center;
}
.auto-style2 {
	text-align: center;
	color: #0000FF;
}
</style>
<script language="javascript">
function confirmDel(){
return confirm('آيا مطمئن هستيد ميخواهيد تعميرات تمام شود ؟');
}

</script>
<?php
$conf = $database->config();

if(isset($_GET['id']) && $_GET['id'] == 2){
        $database->editconf("maintenance", "0");
		$database->editconf("maintenance_time", "0");
		$database->editconf("maintenance_res", "");

echo "<SCRIPT language='JavaScript'>window.location='$PHP_SELF?3';</SCRIPT>";
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

<h1 class="titleInHeader">تنظیمات تعمیرات</h1>
<div class="contentNavi subNavi">
				




</div>
<?php
if ($conf['maintenance']) {
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
?>
	<p class="auto-style2"><strong><span id="timer1"><?php echo secondsToString( $main ); ?></span> ساعت تا پايان تعميرات باقي مانده است</strong></p>
	
<p class="auto-style1"><strong>براي ويرايش توضيحات <a href="<?php echo $PHP_SELF.'?id=1'; ?>">اينجا</a> کليک 
کنيد.</strong></p>

<?php
                  echo "<p class=\"auto-style1\"><strong>براي پايان فوري <a onclick=\"return confirmDel('";
                  echo htmlspecialchars(str_replace("'", "`", $session->uname));
                  echo "');\" href=\"maintenanceset.php?id=";
                  echo 2;
                  echo "\">";
                  echo " اينجا </a>کليک کنيد</strong></p>";
}
if(time() > $conf['maintenance_time']) {
?>
<form method="post" action="<?php echo $PHP_SELF.'?t=1391'; ?>">
	<table style="width: 100%">
		<tr>
			<td class="auto-style1">زمان :</td>
			<td class="auto-style1"><select name="Time" style="width: 123px">
			<option selected="" value="1">1 ساعت</option>
			<option value="2">2 ساعت</option>
			<option value="3">3 ساعت</option>
			<option value="4">4 ساعت</option>
			<option value="5">5 ساعت</option>
			<option value="6">6 ساعت</option>
			<option value="12">12 ساعت</option>
			<option value="24">24 ساعت</option>
			<option value="48">48 ساعت</option>
			<option value="72">72 ساعت</option>
			</select></td>
		</tr>
		<tr>
			<td class="auto-style1">متن براي نمايش به بازيکن</td>
			<td class="auto-style1">
			<textarea name="becuase" style="width: 222px; height: 166px"></textarea>&nbsp;</td>
		</tr>
		</table>
		<br><center>
	<div id="send">
				<button type="submit" value="ذخيره" name="s1" id="s1" tabindex="4">
				<div class="button-container">
				<div class="button-position">
				<div class="btl">
				<div class="btr">
				<div class="btc">
				</div>
				</div>
				</div>
				<div class="bml">
				<div class="bmr">
				<div class="bmc">
				</div></div></div>
				<div class="bbl">
				<div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">ذخيره</div></div></button>
                <input type="hidden" name="ft" value="m2" />
							</div>
</center></form>
    <?php
    if(isset($_POST['becuase'])){
		if($_POST['becuase'] != "" && $_POST['Time'] != ""){
			$a = trim($_POST['becuase']);
			$b = (int) trim($_POST['Time'] * 3600);
			$b = time() + $b;
			$database->editconf("maintenance", "1");
			$database->editconf("maintenance_time", $b);
			$database->editconf("maintenance_res", $a);


echo "<SCRIPT language='JavaScript'>window.location='$PHP_SELF?4';</SCRIPT>";

		} 
		else {
			echo "<center><b><font color=blue size=4>شما بايد دليلي را براي نمايش به کاربر بنويسيد..</font></b></center>";
		}
    }
    
}
if(isset($_GET['id']) && $_GET['id'] == 1){
?>
<form method="post" action="<?php echo $PHP_SELF.'?id='.$_GET['id']; ?>">
	<table style="width: 100%">
				<tr>
			<td class="auto-style1">متن براي نمايش به بازيکن</td>
			<td class="auto-style1">
			<textarea name="becuase" style="width: 222px; height: 166px"></textarea>&nbsp;</td>
		</tr>
		</table>
	<p class="btn"><input id="btn_save" type="image" value="" name="s1" src="assets/x.gif" class="dynamic_img" alt=""></form>


<?php
    if(isset($_POST['becuase'])){
    if($_POST['becuase'] != ""){
    $a = trim($_POST['becuase']);
	$database->editconf("maintenance_res", $a);
echo "<SCRIPT language='JavaScript'>window.location='$PHP_SELF?2';</SCRIPT>";

    } else {
	echo "<center><b><font color=blue size=4>شما بايد دليلي را براي نمايش به کاربر بنويسيد..</font></b></center>";
    }
    }

    
}
	if(isset($_GET['2'])){
	echo "<center><b><font color=red size=4>بروز رساني انجام شد.</font></b></center>";
	} elseif(isset($_GET['3'])){
	echo "<center><b><font color=blue size=4>تعميرات پايان يافت.</font></b></center>";
	}
	elseif(isset($_GET['4'])){
	echo "<center><b><font color=blue size=4>تعميرات آغاز شد.</font></b></center>";
	}
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