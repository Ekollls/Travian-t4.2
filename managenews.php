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

if(isset($_GET['news'])){
	if($_GET['news'] == 1){
		$database->editconf("newsbox1",1);
	}
	if($_GET['news'] == 2){
		$database->editconf("newsbox1",0);
	}
	if($_GET['news'] == 3){
		$database->editconf("newsbox2",1);
	}
	if($_GET['news'] == 4){
		$database->editconf("newsbox2",0);
	}
	if($_GET['news'] == 5){
		$database->editconf("newsbox3",1);
	}
	if($_GET['news'] == 6){
		$database->editconf("newsbox3",0);
	}
	header("Location: managenews.php");
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

<h1 class="titleInHeader">تنظيمات اخبار بازي<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>


<div id="div_1">
<div id="succes" class="MsgHead success" style="display:none;"><div class="MsgBody">عمليات با موفقيت انجام شد.</div></div><br>
<table width="350" border="1" align="center" class="tbl" id="tabs_2_content_in">
    <tbody>
        <tr>
            <td bgcolor="#d1dde0" height="26" align="center"><b>عنوان</b></td>
            <td bgcolor="#d1dde0" height="26" align="center"><b>وضعيت</b></td>
            <td bgcolor="#d1dde0" height="26" align="center"><b>نمايش</b></td>
            <td align="center" bgcolor="#d1dde0"><b>عمليات</b></td>
        </tr>
	<tr>
        <td bgcolor="#f3f7f8" height="26" align="center">خبر شماره 1</td>
        <td bgcolor="#f3f7f8" height="26" align="center"><?php if(NEWSBOX1){ echo "<div id='nsts1'><font color='green'>فعال</font></div>"; }else{ echo "<div id='nsts1'><font color='red'>غير فعال</font></div>"; } ?></td>
        <td bgcolor="#f3f7f8" height="26" align="center">
        بلي &nbsp; خير<p>
        <input type="radio" name="news1_1" onclick="window.location.href = '?news=1';" id="radio" <?php if(NEWSBOX1){ echo "checked='checked'"; } ?>/>
        <input type="radio" name="news1_0" onclick="window.location.href = '?news=2';" id="radio" <?php if(!NEWSBOX1){ echo "checked='checked'"; } ?>/>
        </td>
		<td align="center" bgcolor="#f3f7f8">
        	<a href="new.php?n=1"><img border="0" src="img/edit.gif" /></a></td>
	</tr>
    <tr>
        <td bgcolor="#f3f7f8" height="26" align="center">خبر شماره 2</td>
        <td bgcolor="#f3f7f8" height="26" align="center"><?php if(NEWSBOX2){ echo "<div id='nsts2'><font color='green'>فعال</font></div>"; }else{ echo "<div id='nsts2'><font color='red'>غير فعال</font></div>"; } ?></td>
        <td height="26" align="center" bgcolor="#f3f7f8"> بلي &nbsp; خير
          <p>
        <input type="radio" name="news2_1" onclick="window.location.href = '?news=3';" id="radio" <?php if(NEWSBOX2){ echo "checked='checked'"; } ?>/>
        <input type="radio" name="news2_0" onclick="window.location.href = '?news=4';" id="radio" <?php if(!NEWSBOX2){ echo "checked='checked'"; } ?>/>
          </p></td>
        <td align="center" bgcolor="#f3f7f8">
        	<a href="new.php?n=2"><img border="0" src="img/edit.gif" /></a></td>
	</tr>
    <tr>
    	<td bgcolor="#f3f7f8" height="26" align="center">خبر داخل بازي+جشن</td>
        <td bgcolor="#f3f7f8" height="26" align="center"><?php if(NEWSBOX3){ echo "<div id='nsts3'><font color='green'>فعال</font></div>"; }else{ echo "<div id='nsts3'><font color='red'>غير فعال</font></div>"; } ?></td>
        <td height="26" align="center" bgcolor="#f3f7f8"> بلي &nbsp; خير
          <p>
        <input type="radio" name="news3_1" onclick="window.location.href = '?news=5';" id="radio"  <?php if(NEWSBOX3){ echo "checked='checked'"; } ?>/>
        <input type="radio" name="news3_0" onclick="window.location.href = '?news=6';" id="radio"  <?php if(!NEWSBOX3){ echo "checked='checked'"; } ?>/>
          </p></td>
    	<td align="center" bgcolor="#f3f7f8">
        	<a href="new.php?n=3"><img border="0" src="img/edit.gif" /></a></td>
	</tr>
</tbody>
</table>
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

