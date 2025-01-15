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

if(isset($_POST)){
	if(isset($_POST['send'])){
		if(isset($_POST['top']) && isset($_POST['body']) && $_POST['top'] != "" && $_POST['body'] != ""){
			$q = "SELECT * FROM `s1_users` WHERE `access` < 8";
			$po = $database->query($q);
			if(isset($po)){
				$i=0;
				while($row = mysql_fetch_array($po)){
					 
					
					$name[$i] = $row['username'];
					$email[$i] = $row['email'];
					$i++;
				}
			}
			for ($j=0;$j<$i;$j++){
				$from= ADMIN_EMAIL;
				$body = $name[$i];
				$body .= " عزیز سلام";
				$body .= "
				
				
				
				";
				$body .= $_POST['body'];
				$body .= "
				
				
				موفق و پیروز و سربلند باشید
				
				";
				$body .= SERVER_NAME;
				$headers = "From:" .$from ;
				$to=$email[$j];
				mail($to,$_POST['top'],$body,$headers);
				
				
			}
			$status = 1;
		}
		else{
			$status = 2;
		}
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

<h1 class="titleInHeader">ارسال ايميل<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>


<div id="div_1">
<h4 class="round space">ارسال ایمیل به بازیکنان سرور</h4>
در این قسمت شما قادر خواهید بود تا تنها با پر کردن دو قسمت زیر و فشردن کلید ارسال ، به کل بازیکنان به طور همزمان ایمیل ارسال کنید.
<br>
<form action="" method="post">
<table>
	<thead>
		<th colspan="6">اطلاعات</th>
	</thead>
	<tbody>
		<tr>
			<td>موضوع</td>
			<td><input type="text" class="text"  placeholder="موضوع نامه را وارد کنید." maxlength="100" width="100" name="top"></td>
		</tr>
		<tr>
			<td>متن نامه</td>
			<td><textarea name="body" cols="70" rows="20" placeholder="متن نامه را وارد کنید."></textarea></td>
		</tr>
		<th colspan="4"><center><input type="submit" name="send" value="ارسال"  id="submit"></center></th>
</tbody>
</table>
</form>
<style type="text/css">
.auto-style1 {
text-align: center;
}

.notice {
	border:1px solid green;
	color:green;
	padding:8px;
	background:#DCFFD2;
	text-align:center;
	margin-bottom:6px;
	line-height:1.5em;
	fontsize:25;

	}
</style>


 <br><br><br>
<div class=notice>
<?php 
if($status == 1){ echo "تعداد ".$i." ایمیل به بازیکنان سرور ارسال شد."; } elseif($status == 2){ echo "لطفا موضوع و متن نامه را پر کنید."; }

?></div>
 <br><br><br>





</div>

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

