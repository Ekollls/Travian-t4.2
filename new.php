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

if($_GET['n'] > 0) {}else{$_GET['n'] = 1;}

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

<h1 class="titleInHeader">تنظیمات اخبار بازی<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>


<div id="div_1">

<form method="POST">
<input name="action" type="hidden" value="News">
<table align="center" width="404" cellpadding="1" cellspacing="1" border="1">
	<thead>
		<tr>
			<th height="21" colspan="2" valign="top">ویرایش خبرها</th>
		</tr>                                       
	</thead>
	<tr>
		<td height="24" align="center">انتخاب شمارۀ خبر:</td>                                    
		<td valign="top">
        	<center>                                                   
                <font size=3>
                    <label>1 <input onClick="window.location = 'new.php?n=1'" type="radio" name="n" value="1" <?php if(isset($_GET['n'])){ if($_GET['n']==1){ echo 'checked="checked"'; } }else{ echo 'checked="checked"'; } ?>/></label>
                    <label>2 <input onClick="window.location = 'new.php?n=2'"  type="radio" name="n" value="2" <?php if(isset($_GET['n'])){ if($_GET['n']==2){ echo 'checked="checked"'; } } ?>/></label>
                    <label>3 <input onClick="window.location = 'new.php?n=3'" type="radio" name="n" value="3" <?php if(isset($_GET['n'])){ if($_GET['n']==3){ echo 'checked="checked"'; } } ?>/></label>
                </font>
            </center>
        </td>      
    </tr>
    <tr>
        <td height="24" align="center">موضوع:</td>
        <td valign="top"><center><input id="title" type="text" name="title" value="" size=30></td>
    </tr>       
    <tr>
        <td align="center"><strong>متن خبر:</strong></td>
        <td valign="top"><center><textarea id="txt" name="txt" cols="40" rows="10"></textarea></td>      
    </tr>
        <tr>
    <td>متن فعلی:</td><td><center><?php echo file_get_contents('Templates/News/newsbox'.$_GET['n'].'.tpl'); ?></center></td></tr>

    <tr>
        <td height="26" valign="top" colspan="2"><br />
            <center>
            	<button name="submit" type="submit" value="submit" id="submit" class="submit"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">تایید</div></div></button>
                <button onClick="document.getElementById('title').innerHTML = '';document.getElementById('txt').innerHTML = ''" name="reset" type="reset" value="reset" id="reset" class="reset"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">بازنویسی</div></div></button>
            </center>
        </td>     
    </tr>
</table>
<br><br>
</form>


<?php
if($_POST['action']=='News'){
	$number = $_POST['n'];$title = $_POST['title'];$text = $_POST['txt'];$delete = $_POST['delete'];
	
	if ($text){
		if (!$title){
			$st = "";
		}else{
			$st = "<b>".$title."</b><br>";
		}
		unlink ('Templates/News/newsbox'.$number.'.tpl');
		$file = fopen('Templates/News/newsbox'.$number.'.tpl','w+');
		fwrite($file,''.$st.''.$text.'');
		$database->editconf("newsbox".$number,1);
		echo '<center><font size="5">خبر با موفقیت ایجاد شد</font>';
	}else{
		echo "<center><font size='5' color='red'>متن خبر خالی است!</font>";
	}
}
?>
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

