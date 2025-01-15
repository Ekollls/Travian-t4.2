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
	echo "شما ادمین نیستید لطفا تلاش نکنید."; 
} 
else{
$max_per_pass = 1000;

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);

mysql_select_db(SQL_DB);

if (mysql_num_rows(mysql_query("SELECT id FROM ".TB_PREFIX."users WHERE access = 9 AND id = ".$session->uid)) != '1') die("Hacking attempt!");



if(isset($_GET['del'])){

			$query="SELECT * FROM ".TB_PREFIX."users ORDER BY id + 0 DESC";

			$result=mysql_query($query) or die (mysql_error());

			for ($i=0; $row=mysql_fetch_row($result); $i++) {

					$updateattquery = mysql_query("UPDATE ".TB_PREFIX."users SET ok = '0' WHERE id = '".$row[0]."'")

					or die(mysql_error());	

			}

}


if (@$_POST['submit'] == "Send")

{

	unset ($_SESSION['m_message']);

	$_SESSION['m_message'] = $_POST['message'];

	$NextStep = true;

}





if (@isset($_POST['confirm']))

{

	if ($_POST['confirm'] == 'No' ) $Interupt = true;

	if ($_POST['confirm'] == 'Yes'){



		if(file_exists("Templates/text.tpl")) {



		$myFile = "Templates/text.tpl";

		$fh = fopen($myFile, 'w') or die("<br/><br/><br/>Can't open file: templates/text.tpl");

		$text = file_get_contents("Templates/text_format.tpl");

		$text = preg_replace("'%TEKST%'",$_SESSION['m_message'] ,$text);																	

		fwrite($fh, $text);



			$query="SELECT * FROM ".TB_PREFIX."users ORDER BY id + 0 DESC";

			$result=mysql_query($query) or die (mysql_error());

			for ($i=0; $row=mysql_fetch_row($result); $i++) {

					$updateattquery = mysql_query("UPDATE ".TB_PREFIX."users SET ok = '1' WHERE id = '".$row[0]."'")

					or die(mysql_error());	

			}

		$done = true;

		} else { die("<br/><br/><br/>wrong"); }

}}



?>	


<?php    include "Templates/html.tpl";  ?>

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

<h1 class="titleInHeader">نامه همگانی<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>



<h4 class="round">&#1575;&#1585;&#1587;&#1575;&#1604; نامه همگانی</h4>


<?php if (@!$NextStep && @!$NextStep2 && @!$done){?>

<form method="POST" action="Mssg.php" name="myform" id="myform">

			<table cellspacing="1" cellpadding="1" class="tbg" style="background-color:#C0C0C0; border: 0px solid #C0C0C0; font-size: 10pt;">    

			  <tbody>

			    <tr>	

			      <td class="rbg" style="font-size: 10pt; text-align:center;">System Message</td>    

			    </tr>

			    <tr>	

			      <td style="font-size: 10pt; text-align:center;">Text BBCode:<br><b>[b] txt [/b]</b> - <i>[i] txt [/i]</i> - <u>[u] txt [/u]</u> <br />

			<textarea class="fm" name="message" cols="60" rows="23"></textarea></td>    

			    </tr>

			    <tr>	

			      <td style="text-align:center;">All fields required</td>    

			    </tr>

			    <tr>	

			      <td style="text-align:center;">

			        <input type="submit" value="Send" name="submit" />    </td>

			    </tr>

			  </tbody>

			</table> 

			</form>

<a href="Mssg.php?del">Delete old System Message</a>

<?php }elseif (@$NextStep){?>

<form method="POST" action="Mssg.php">

			<table cellspacing="1" cellpadding="2" class="tbg">    

			  <tbody>

			    <tr>	

			      <td class="rbg" colspan="2">Confirmation</td>    

			    </tr>

			    <tr>	

			      <td style="text-align: left; width: 200px;">Do you really want to send System Message?</td>

			      <td style="text-align: left;">

			        <input type="submit" style="width: 240px;" class="fm" name="confirm" value="Yes">

			        <input type="submit" style="width: 240px;" class="fm" name="confirm" value="No"></td>    

			    </tr>

			  </tbody>

			</table> 

</form>

Example: (BBCode doesn't work over here!)

<?php

$txt=$_SESSION['m_message'];

$txt = preg_replace("/\[b\]/is",'<b>', $txt);

$txt = preg_replace("/\[\/b\]/is",'</b>', $txt);

$txt = preg_replace("/\[i\]/is",'<i>', $txt);

$txt = preg_replace("/\[\/i\]/is",'</i>', $txt);

$txt = preg_replace("/\[u\]/is",'<u>', $txt);

$txt = preg_replace("/\[\/u\]/is",'</u>', $txt);

echo ($txt);



}elseif (@$Interupt){?>

<b><?php echo MASS_ABORT; ?></b>



<?php }elseif (@$done){?>

System Message was sent

<?php }else{die("Something is wrong");}?>

















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