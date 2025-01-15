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
   include "Templates/html.tpl";  
   
	$data = $database->config();
	$is_closed = 0;
	$status = 0;
	if($data['peace']){
		$is_closed = 1;
	}
if(isset($_POST['submit'])) {
	if($_POST['peace']==0){
		$database->editconf("peace", 0);
		$status = 2;
	}
	elseif($_POST['peace']==1){
		$database->editconf("peace", 1);
		$status = 1;
	}
	else{
		$status = 3;
	}
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

<h1 class="titleInHeader">تنظيمات روز صلح<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>
<h4 class="round">روز صلح</h4>

لطفا يک گزينه را انتخاب کنيد.
<br>
در حال حاضر روز صلح  <b><?php if($is_closed){ echo "فعال"; } else{ echo "غير فعال"; } ?> </b>است.
<br><br><br>
 <form action="" method="post">
 <center>
<font color=#0C38F3 size=3><b>روز صلح پايان يابد</b></font>&nbsp;&nbsp;&nbsp;&nbsp;<td><input onmousedown="peace(0); return false;" id="files0" name="peace" value="0" type="radio" <?php if($is_closed){ echo "checked=\"checked\"";} ?>></td>&nbsp;&nbsp;&nbsp;&nbsp;
<font color=#E417D8 size=3><b>روز صلح آغاز شود</b></font>&nbsp;&nbsp;<td><input onmousedown="peace(1); return false;" id="files1" name="peace" value="1" type="radio" <?php if(!$is_closed){ echo "checked=\"checked\"";} ?>></td>
  <p><br>

	
  <input type="submit" name="submit" value="انجام شود">
</center>
</form>



<br><br><br>

<style type="text/css">
.auto-style1 {
text-align: center;
}

.activation_time {
	border:1px solid red;
	color:red;
	padding:8px;
	background:#E32636;
	text-align:center;
	margin-bottom:6px;
	line-height:1.5em;
	fontsize:25;

	}
</style>
<?php
if($status == 1){
echo "<div class=activation_time><font color=#000000>روز صلح آغاز شد.</font></div>";
}
if($status == 2){
echo "<div class=activation_time><font color=#000000>روز صلح پايان يافت.</font></div>";
}
if($status == 3){
echo "<div class=activation_time><font color=#000000>هيچ تغييري انجام نشد.</font></div>";
}
?>
<br><br><br>










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

