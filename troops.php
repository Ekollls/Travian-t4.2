<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");

include_once("GameEngine/Village.php");
if($session->access != ADMIN) { 
	echo "شما ادمين نيستيد لطفا تلاش نکنيد."; 
} 
else{
$reportstatus = 0;
$output = "";
if(isset($_POST)){
	if(isset($_POST['action']) && $_POST['action']=='showreport'){
		if(isset($_POST['submit'])){
			$users = $database->query_return("SELECT * FROM ".TB_PREFIX."users WHERE access = 2 AND id > 4");
			$auto = mysql_fetch_array($database->query("SELECT * FROM ".TB_PREFIX."automation WHERE 1"));
			if(!empty($users)){
				$auto['lastunitsbackup'] = time() - 3600;
				define("SPEED1","100");
				if(SPEED <= 5){
					$Esivar = 10;
				}
				elseif(SPEED <= 50){
					$Esivar = 100;
				}
				elseif(SPEED <= 200){
					$Esivar = 600;
				}
				elseif(SPEED <= 500){
					$Esivar = 1500;
				}
				elseif(SPEED <= 1000){
					$Esivar = 4000;
				}
				else{
					$Esivar = 10000;
				}
				$variable = round((((time() - $auto['lastunitsbackup']) / 3600) * $Esivar)/SPEED);
				if($variable <= 2){
					$variable = 2;
				}
				foreach($users as $user){
					$output .= "<h4 class=\"spacer\">«««بازیکن - ".$user['username']." »»»</h4>";
					$villages = $database->query_return("SELECT * FROM ".TB_PREFIX."vdata WHERE owner = '".$user['id']."'");
					$start = (($user['tribe'] - 1) * 10) + 1;
					$end = ($user['tribe']) * 10;
					foreach($villages as $village){
						$units = mysql_fetch_array($database->query("SELECT * FROM ".TB_PREFIX."units WHERE `vref`= '".$village['wref']."'"));
						$enforces = $database->query_return("SELECT * FROM ".TB_PREFIX."enforcement WHERE `from`= '".$village['wref']."'");
						if(!empty($enforces)){
							foreach($enforces as $enforce){
								for($i=$start;$i<=$end;$i++){
									$units['u'.$i] += $enforce['u'.$i];
								}
							}
						}
						$units_backup = mysql_fetch_array($database->query("SELECT * FROM ".TB_PREFIX."units_backup WHERE `vref`= '".$village['wref']."'"));
						$detected = 0;
						if(!empty($units_backup)){
							for($i=$start;$i<=$end;$i++){	
								if($units['u'.$i] >= ($units_backup['u'.$i] * $variable) && $units_backup['u'.$i] > 0){
									$detected = 1;
									break;
								}
							}
						}
						$output .= "<table id=\"oasesSurround\" cellpadding=\"1\" cellspacing=\"1\"><thead>«دهکده - ".$village['name']." »";
						if($detected==1){
							$output .= "<font color=red> <b> مشکوک به باگ </b></font>";
						}
						$output .= "</thead><thead>";
						for($j=$start;$j<=$end;$j++){
							$output .= "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$j\" title=\"".$technology->getUnitName($j)."\" alt=\"".$technology->getUnitName($j)."\" /></td>";
						}
						$output .= "</thead><tbody><tr>";
						for($j=$start;$j<=$end;$j++){
							$output .= "<td>".$units['u'.$j]."</td>";
						}
						$output .= "</tr><tr>";
						if(!empty($units_backup)){
							for($j=$start;$j<=$end;$j++){
								$output .= "<td>".$units_backup['u'.$j]."</td>";
							}							
						}
						else{
							$output .= "<td colspan=\"10\">اطلاعاتی از قبل برای این دهکده موجود نیست</td>";
						}
						$output .= "</tr></tbody></table>";
					}
				}
			}
			$reportstatus = 1;
		}
	}
	if(isset($_POST['action']) && $_POST['action']=='updatereport'){
		if(isset($_POST['submit'])){
			$users = $database->query_return("SELECT * FROM ".TB_PREFIX."users WHERE access = 2 AND id > 4");
			if(!empty($users)){
				foreach($users as $user){
					$villages = $database->query_return("SELECT * FROM ".TB_PREFIX."vdata WHERE owner = '".$user['id']."'");
					$start = (($user['tribe'] - 1) * 10) + 1;
					$end = ($user['tribe']) * 10;
					foreach($villages as $village){
						$units = mysql_fetch_array($database->query("SELECT * FROM ".TB_PREFIX."units WHERE `vref`= '".$village['wref']."'"));
						$enforces = $database->query_return("SELECT * FROM ".TB_PREFIX."enforcement WHERE `from`= '".$village['wref']."'");
						if(!empty($enforces)){
							foreach($enforces as $enforce){
								for($i=$start;$i<=$end;$i++){
									$units['u'.$i] += $enforce['u'.$i];
								}
							}
						}
						$result = $database->query("SELECT * FROM ".TB_PREFIX."units_backup WHERE `vref`= '".$village['wref']."'");
						$units_backup = mysql_fetch_array($result);
						if(mysql_num_rows($result) < 1){
							$database->query("INSERT INTO `".TB_PREFIX."units_backup` (`vref`, `u1`, `u2`, `u3`, `u4`, `u5`, `u6`, `u7`, `u8`, `u9`, `u10`, `u11`, `u12`, `u13`, `u14`, `u15`, `u16`, `u17`, `u18`, `u19`, `u20`, `u21`, `u22`, `u23`, `u24`, `u25`, `u26`, `u27`, `u28`, `u29`, `u30`) VALUES ('".$village['wref']."', '".$units['u1']."', '".$units['u2']."', '".$units['u3']."', '".$units['u4']."', '".$units['u5']."', '".$units['u6']."', '".$units['u7']."', '".$units['u8']."', '".$units['u9']."', '".$units['u10']."', '".$units['u11']."', '".$units['u12']."', '".$units['u13']."', '".$units['u14']."', '".$units['u15']."', '".$units['u16']."', '".$units['u17']."', '".$units['u18']."', '".$units['u9']."', '".$units['u20']."', '".$units['u21']."', '".$units['u22']."', '".$units['u23']."', '".$units['u24']."', '".$units['u25']."', '".$units['u26']."', '".$units['u27']."', '".$units['u28']."', '".$units['u29']."', '".$units['u30']."');");
						}
						else{
							for($i=$start;$i<=$end;$i++){
								$database->query("UPDATE `".TB_PREFIX."units_backup` SET `u".$i."`= '".$units['u'.$i]."' WHERE `vref` = '".$village['wref']."'");
							}
						}
					}
				}
				$database->query("UPDATE ".TB_PREFIX."automation SET `lastunitsbackup` = '".time()."'");										
			}			
			$reportstatus = 2;
		}
	}


}
   include "Templates/html.tpl";  
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

<h1 class="titleInHeader">گزارش سربازان سرور</h1>
در این قسمت شما قادر خواهید بود تا گزارش مربوط به نیرو های هر دهکده را مشاهده کنید. <br>
نکته: ابتدا بر روی مشاهده گزارش کلیک کنید. سپس گزارش نمایش داده شده و در آخر حتما بر روی ثبت و ضبظ گزارش کلیک کنید.<br><br>
<?php 
if($reportstatus==0){
?>
<form action="" name="troopreport" method="post">
<input type="hidden" name="action" value="showreport">
<center><input type="submit" name="submit" value="مشاهده گزارش"></center>
</form>
<?php
}
elseif($reportstatus==1){
?>
<br>
حتما کلید زیر را پس از مطالعه ی گزارش فشار دهید تا اطلاعات پایگاه داده به روز شود در غیر این صورت اطلاعات شما کمکی به شما نخواهد کرد.
<form action="" name="troopreport" method="post">
<input type="hidden" name="action" value="updatereport">
<center><input type="submit" name="submit" value="به روز رسانی"></center>
</form>
<br>
<?php
 echo $output;
}
elseif($reportstatus==2){

?>

طلاعات با موفقیت به روز شد. لطفا دیگر تا مشاهده کامل گزارش بعدی کلید به روز رسانی را نزنید. با تشکر.

<?php

}
?>

















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

<?php }
?>

