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

	$center="<center>";
	$centeri="</center>";
	$table="<table cellspacing=\"1\" cellpadding=\"1\"><tbody>";
	$tablei="</tbody></table>";
	$tr="<tr>";
	$tri="</tr>";
	$td="<td style=\"border: 1px solid ;\">";
	$tdi="</td>";
	$br="<br />";

	$Server=$_SERVER['HTTP_HOST'];
	$Sub=$_SERVER["REQUEST_URI"];
	$mass=("$Server$Sub");
	$massage='';

	$Num="رديف";
	$ide="شماره بازيکن ";
	$usernamee="نام بازيکن ";
	$emaile="ايميل بازيکن";
	$golde="مقدار طلا";
	$silvere="مقدار نقره";

		$result = mysql_query("SELECT * FROM s1_users ");
		if(isset($result)){
			$j=0;
			while($row = mysql_fetch_array($result)){
				$id[$j] = $row['id'];			
				$username[$j]=$row['username'];
				$email[$j]=$row['email'];
				$gold[$j]=$row['gold'];
				$silver[$j]=$row['silver'];
				$j++;
				
			}
		}
		
	$massage=$center .$table  .$tr;
	
	$massage=$massage .$td .$center .$Num .$centeri .$tdi ;
	$massage=$massage .$td .$center .$ide .$centeri .$tdi ;
	$massage=$massage .$td .$center .$usernamee .$centeri .$tdi ;
	$massage=$massage .$td .$center .$emaile .$centeri .$tdi ;
	$massage=$massage .$td .$center .$golde .$centeri .$tdi  ;
	$massage=$massage .$td .$center .$silvere .$centeri .$tdi .$tri ;

	for($i=0;$i<$j;$i++){
	
		$massage=$massage .$td .$center .($i+1) .$centeri .$tdi ;
		$massage=$massage .$td .$center .$id[$i] .$centeri .$tdi ;
		$massage=$massage .$td .$center .$username[$i] .$centeri .$tdi ;
		$massage=$massage .$td .$center .$email[$i] .$centeri .$tdi ;
		$massage=$massage .$td .$center .$gold[$i] .$centeri .$tdi ;
		$massage=$massage .$td .$center .$silver[$i] .$centeri .$tdi .$tri;
		
		
		
	
		

		$mass="$mass 

		 $ide: $id[$i]     |     $usernamee: $username[$i]     |     $emaile: $email[$i]     |     $golde: $gold[$i]     |     $silvere: $silver[$i]  
		 
		 ";
	}
	$massage=$massage  .$table .$centeri;
	$subject ='گزارش سرور';
	$headers = '';	
   	 if(isset($_POST['submit'])) {
		$to=$_POST['sendemail'];
		$from= ADMIN_EMAIL;
		mail($to,$from,$subject,$mass,$headers);
		$status = 1;
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

<h1 class="titleInHeader">گزارش سرور<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>
<div id="div_1">

<h4 class="round space">گزارش سرور</h4>
<?php

	echo $massage;

?>
<br><br>
<h4 class="round space">ارسال گزارش به ایمیل</h4>
در اين قسمت شما قادر خواهيد بود تا تنها با پر کردن دو قسمت زير و فشردن کليد ارسال ، به کل بازيکنان به طور همزمان ايميل ارسال کنيد.
<br>
<form action="" method="post">
<table>
	<thead>
		<th colspan="6">اطلاعات</th>
	</thead>
	<tbody>
		<tr>
			<td>ایمیل شما :</td>
			<td><input type="text" name="sendemail" title="ایمیل خود را وارد کنید" value="<?php echo $session->email; ?>"></td>
		</tr>
		<th colspan="4"><center><input type="submit" name="submit" value="ارسال به ایمیل"></center></th>
</tbody>
</table>
</form>
<?php
if($status == 1){
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
 echo "گزارش به ایمیل شما ارسال شد.."; 

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

