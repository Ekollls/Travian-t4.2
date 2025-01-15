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
		$newcode = time() + rand(111111111,999999999);
		$file = "GameEngine/Emails/$newcode.txt";
		$f = fopen($file, 'w'); // Open in write mode
		$sql = mysql_query("SELECT * FROM `s1_users` WHERE access < 8 ORDER BY id DESC");
		while($row = mysql_fetch_array($sql)){
			$emails = $row['email'];
			$emails .= "
";
			fwrite($f, $emails);
		}
	
		function Create_zip($source, $destination,$overwrite='')
		{
		  $zip = new ZipArchive();
		  if($zip->open($destination,$overwrite?       ZIPARCHIVE::OVERWRITE:ZIPARCHIVE::CREATE)===TRUE)
		 {
		   $zip->addFile($source);// Add the files to the .zip file
		   $zip->close(); // Closing the zip file
		 }
		}
		Create_zip($file,"GameEngine/Emails/".$newcode.".zip");
		$myfile = "GameEngine/Emails/".$newcode.".zip";
		fclose($f);
		$status = 1;
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

<h1 class="titleInHeader">ايميل ها<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>


<div id="div_1">
<h4 class="round space">جمع آوري ايميل ها</h4>
در اين قسمت شما قادر خواهيد بود تا تنها يک کليک ايميل تمام بازيکنان را در يک فايل txt ذخيره کنيد.
<br>
<form action="" method="post">
<table>
	<thead>
		<th colspan="6">اطلاعات</th>
	</thead>
	<tbody>
		<th colspan="4"><center><input type="submit" name="send" value="ارسال"  id="submit"></center></th>
</tbody>
</table>
</form>
<?php if($status == 1){

?>
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
echo "لیست ایمیل هاساخته شد و در فایل <a href=\"".SERVER."".$file."\"><font color=\"red\">ایمیل ها</font></a> موجود میباشد. فایل زیپ شده <a href=\"".SERVER."".$myfile."\"><font color=\"red\">ایمیل ها (زیپ شده)</font></a>"; 

?></div>
<?php
}
?>
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

