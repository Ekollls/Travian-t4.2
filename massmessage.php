<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include_once("GameEngine/Account.php");
$max_per_pass = 1000;
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (mysql_num_rows(mysql_query("SELECT id FROM ".TB_PREFIX."users WHERE access = 9 AND id = ".$session->uid)) != '1') die("Hacking attemp!");

if (@$_POST['submit'] == "Send")
{
	unset ($_SESSION['m_message']); unset ($_SESSION['m_subject']); unset ($_SESSION['m_color']);
	if (!$_POST['message']){die("You have to enter message");}
	if (!$_POST['subject']){die("You have to enter subject");}
	if (!$_POST['color']){$_SESSION['m_color'] = "black";}
	$_SESSION['m_subject'] = $_POST['subject'];
	if (!$_SESSION['m_color']){$_SESSION['m_color'] = $_POST['color'];}
	$_SESSION['m_message'] = $_POST['message'];
	$NextStep = true;
}


if (@isset($_POST['confirm']))
{
	if ($_POST['confirm'] == 'Yes') $NextStep2 = true;
	if ($_POST['confirm'] == 'No' ) $Interupt = true;
}

$max_per_pass = 1000;

if (isset($_GET['send']) && isset($_GET['from']))
{
	$_SESSION['m_message'] = preg_replace("/\[img\]([a-z0-9\_\.\:\/\-]*)\[\/img\]/i","<img src='$1' alt='Corrupted image'/>",  $_SESSION['m_message']);
	$_SESSION['m_message'] = preg_replace("/\[url\]([a-z0-9\_\.\:\/\-]*)\[\/url\]/i", "<a href='$1'>$1</a>",  $_SESSION['m_message']);
	$_SESSION['m_message'] = preg_replace("/\[url\=([a-z0-9\_\.\:\/\-]*)\]([a-z0-9\_\.\:\/\-]*)\[\/url\]/i", "<a href='$1'>$2</a>",  $_SESSION['m_message']);
	$_SESSION['m_message'] = preg_replace("/\*u([0-9]*)(left|right)\*/i", "<img src='img/u2/u$1.gif' style='float:$2;' alt='unit$1' />",  $_SESSION['m_message']);

	$users_count = mysql_fetch_assoc(mysql_query("SELECT count(*) as count FROM ".TB_PREFIX."users WHERE id != 0"));
	$users_count = $users_count['count'];
	if ($_GET['from'] + $max_per_pass <= $users_count) $plus = $max_per_pass; else $plus = $users_count - $_GET['from'];
	$sql = "INSERT INTO ".TB_PREFIX."mdata (`target`, `owner`, `topic`, `message`, `viewed`, `archived`, `send`, `time`) VALUES ";
	for($i = $_GET['from']; $i < ($_GET['from'] + $plus) ; $i++) {
		if ($_SESSION['m_color'])
		{
			$sql .= "($i, 0, '<span style=\'color:{$_SESSION['m_color']};\'>{$_SESSION['m_subject']}</span>', \"{$_SESSION['m_message']}\", 0, 0, 0, ".time()."),";
		}
		else
		{
			$sql .= "($i, 0, '{$_SESSION['m_subject']}', \"{$_SESSION['m_message']}\", 0, 0, 0, ".time()."),";
		}
	}
	if ($_SESSION['m_color'])
	{
		$sql .= "($i, 0, '<span style=\'color:{$_SESSION['m_color']};\'>{$_SESSION['m_subject']}</span>', \"{$_SESSION['m_message']}\", 0, 0, 0, ".time().")";
	}
	else
	{
		$sql .= "($i, 0, '{$_SESSION['m_subject']}', \"{$_SESSION['m_message']}\", 0, 0, 0, ".time()."),";
	}
	mysql_query($sql);
	if (($users_count - $_GET['from']) > $max_per_pass) echo header("Location: massmessage.php?send=true&from=",$_GET['from'] + $max_per_pass); else $done = true;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo SERVER_NAME; ?></title>
        <link REL="shortcut icon" HREF="favicon.ico"/>
        <style>
        .fm {
        border:1px solid #71D000;
        font-size:8pt;
        padding-bottom:2px;
        padding-left:3px;
        padding-top:2px;
        }
        .tbg {
        background-color:#C0C0C0;
        font-size:10pt;
        text-align:center;
        width:100%;
        }
        
        
        .uu1 {background-image: url(img/u2/u1.gif);}
        .uu2 {background-image: url(img/u2/u2.gif);}
        .uu3 {background-image: url(img/u2/u3.gif);}
        .uu4 {background-image: url(img/u2/u4.gif);}
        .uu5 {background-image: url(img/u2/u5.gif);}
        .uu6 {background-image: url(img/u2/u6.gif);}
        .uu7 {background-image: url(img/u2/u7.gif);}
        .uu8 {background-image: url(img/u2/u8.gif);}
        .uu9 {background-image: url(img/u2/u9.gif);}
        .uu10 {background-image: url(img/u2/u10.gif);}
        .uu11 {background-image: url(img/u2/u11.gif);}
        .uu12 {background-image: url(img/u2/u12.gif);}
        .uu13 {background-image: url(img/u2/u13.gif);}
        .uu14 {background-image: url(img/u2/u14.gif);}
        .uu15 {background-image: url(img/u2/u15.gif);}
        .uu16 {background-image: url(img/u2/u16.gif);}
        .uu17 {background-image: url(img/u2/u17.gif);}
        .uu18 {background-image: url(img/u2/u18.gif);}
        .uu19 {background-image: url(img/u2/u19.gif);}
        .uu20 {background-image: url(img/u2/u20.gif);}
        .uu21 {background-image: url(img/u2/u21.gif);}
        .uu22 {background-image: url(img/u2/u22.gif);}
        .uu23 {background-image: url(img/u2/u23.gif);}
        .uu24 {background-image: url(img/u2/u24.gif);}
        .uu25 {background-image: url(img/u2/u25.gif);}
        .uu26 {background-image: url(img/u2/u26.gif);}
        .uu27 {background-image: url(img/u2/u27.gif);}
        .uu28 {background-image: url(img/u2/u28.gif);}
        .uu29 {background-image: url(img/u2/u29.gif);}
        .uu30 {background-image: url(img/u2/u30.gif);}
	.uu1, .uu2, .uu3, .uu4, .uu5, .uu6, .uu7, .uu8, .uu9, .uu10, u11, .uu12, .uu13, .uu14, .uu15, .uu16, .uu17, .uu18, .uu19, .uu20, .uu21, .uu22, .uu23, .uu24, .uu25, .uu26, .uu27, .uu28, .uu29, .uu30
	{
	    height: 150px;
	    width: 150px;
	}
	
	div.messages div#message_container div#message_toolbarWindows div, div#text_container div#text_toolbarWindows div {
	background:none repeat scroll 0 0 #EFEFEF;
	border:1px solid #71D000;
	/*display:none;*/
	left:180px;
	margin-top:5px;
	max-width:240px;
	padding:5px;
	position:absolute;
	}
	.uu19 {width: 150px;}
	.uu20 {width: 150px;}
	.uu17 {width: 150px;}


        </style>
<script language="javascript" type="text/javascript">
function smilie(text) {
    document.myform.message.value += text;
    }
    </script>

<script language="javascript">
function toggleDisplay(e){
    element = document.getElementById(e).style;
    element.display == 'none' ? element.display = 'block' :
    element.display='none';
}
</script>
    
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME ?></title>
    <link REL="shortcut icon" HREF="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<script src="mt-full.js?0ac36" type="text/javascript"></script>
	<script src="unx.js?0ac36" type="text/javascript"></script>
	<script src="new.js?0ac36" type="text/javascript"></script>
   	<link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/compact.css?f4b7c" rel="stylesheet" type="text/css" />
   	<link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>travian.css?f4b7c" rel="stylesheet" type="text/css" />
    <link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/lang.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">

		window.addEvent('domready', start);
	</script>
</head> 


 
<body class="v35 ie ie8">
<div class="wrapper">
<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
<div id="dynamic_header">
	</div>
<?php include("Templates/header.tpl"); ?>
</div><div id="mid">

      
              <a id="ingameManual" href="support.php" title="&#1585;&#1575;&#1607;&#1606;&#1605;&#1575;">
              <img src="img/x.gif" class="question" alt="&#1585;&#1575;&#1607;&#1606;&#1605;&#1575;"/>
            </a>
  
      
            
        
        <div id="anwersQuestionMark">
            <a href="http://forum.t4dl.ir/index.php" target="_blank" title="&#1662;&#1575;&#1587;&#1582; &#1607;&#1575;&#1740;  &#1578;&#1585;&#1608;&#1740;&#1606;">&nbsp;</a>
        </div>    
												<div class="clear"></div>

<div id="content"  class="login">
<?php if (@!$NextStep && @!$NextStep2 && @!$done){?>
<form method="POST" action="massmessage.php" name="myform" id="myform">
			<table cellspacing="1" cellpadding="2" class="tbg" style="background-color:#C0C0C0; border: 0px solid #C0C0C0; font-size: 10pt;">    
			  <tbody>
			    <tr>	
			      <td class="rbg" style="font-size: 10pt; text-align:center;" colspan="2"><?php echo MASS; ?></td>    
			    </tr>
			    <tr>	
			      <td style="font-size: 10pt; text-align: left; width: 200px;"><?php echo MASS_SUBJECT; ?></td>
			      <td style="font-size: 10pt; text-align: left;">
			        <input type="text" style="width: 240px;" class="fm" name="subject" value="" size="30"></td>    
			    </tr>
			    <tr>	
			      <td style="font-size: 10pt; text-align: left;"><?php echo MASS_COLOR; ?></td>
			      <td style="font-size: 10pt; text-align: left;">
			      

			        <input type="text" style="width: 240px;" class="fm" name="color" size="30"></td>    
			    </tr>
			    <tr>	
			      <td colspan="2" style="font-size: 10pt; text-align:center;"><?php echo MASS; ?>			        <br>
			<textarea class="fm" name="message" cols="60" rows="23"></textarea></td>    
			    </tr>
			    <tr>	
			      <td colspan="2"  style="text-align:center;"><?php echo MASS_REQUIRED; ?><td>    
			    </tr>
			    <tr>	
			      <td colspan="2"  style="text-align:center;">
			        <input type="submit" value="<?php echo JR_SEND; ?>" name="submit" />    </td>
			    </tr>
			  </tbody>
			</table> 
			</form>
			<?php if (@!$NextStep && @!$NextStep2 && @!$done){?>
<?php echo MASS_UNITS; ?>
<a href="javascript:toggleDisplay('message_smilies')"><?php echo MASS_SHOWHIDE; ?></a>

<div name="smilll" id="message_smilies" style="background:none repeat scroll 0 0 #EFEFEF;border:1px solid #71D000;left:20px;margin-top:5px;max-width:660px;padding:5px;position:relative;display: none;"> 
<?php echo MASS_READ; ?>
<a href="#" onclick="smilie('*u1*')"><img src="img/x.gif" class="uu1" /></a>
<a href="#" onclick="smilie('*u2*')"><img src="img/x.gif" class="uu2" /></a>
<a href="#" onclick="smilie('*u3*')"><img src="img/x.gif" class="uu3" /></a>
<a href="#" onclick="smilie('*u4*')"><img src="img/x.gif" class="uu4" /></a>
<a href="#" onclick="smilie('*u5*')"><img src="img/x.gif" class="uu5" /></a>
<a href="#" onclick="smilie('*u6*')"><img src="img/x.gif" class="uu6" /></a>
<a href="#" onclick="smilie('*u7*')"><img src="img/x.gif" class="uu7" /></a>
<a href="#" onclick="smilie('*u8*')"><img src="img/x.gif" class="uu8" /></a>
<a href="#" onclick="smilie('*u9*')"><img src="img/x.gif" class="uu9" /></a>
<a href="#" onclick="smilie('*u10*')"><img src="img/x.gif" class="uu10" /></a>
<a href="#" onclick="smilie('*u11*')"><img src="img/x.gif" class="uu11" /></a>
<a href="#" onclick="smilie('*u12*')"><img src="img/x.gif" class="uu12" /></a><br />
<a href="#" onclick="smilie('*u13*')"><img src="img/x.gif" class="uu13" /></a>
<a href="#" onclick="smilie('*u14*')"><img src="img/x.gif" class="uu14" /></a>
<a href="#" onclick="smilie('*u15*')"><img src="img/x.gif" class="uu15" /></a>
<a href="#" onclick="smilie('*u16*')"><img src="img/x.gif" class="uu16" /></a>
<a href="#" onclick="smilie('*u17*')"><img src="img/x.gif" class="uu17" /></a>
<a href="#" onclick="smilie('*u18*')"><img src="img/x.gif" class="uu18" /></a>
<a href="#" onclick="smilie('*u19*')"><img src="img/x.gif" class="uu19" /></a>
<a href="#" onclick="smilie('*u21*')"><img src="img/x.gif" class="uu21" /></a>
<a href="#" onclick="smilie('*u22*')"><img src="img/x.gif" class="uu22" /></a>
<a href="#" onclick="smilie('*u23*')"><img src="img/x.gif" class="uu23" /></a>
<a href="#" onclick="smilie('*u24*')"><img src="img/x.gif" class="uu24" /></a><br />
<a href="#" onclick="smilie('*u25*')"><img src="img/x.gif" class="uu25" /></a>
<a href="#" onclick="smilie('*u26*')"><img src="img/x.gif" class="uu26" /></a>
<a href="#" onclick="smilie('*u29*')"><img src="img/x.gif" class="uu29" /></a>
</div>
<?php } ?>

<?php }elseif (@$NextStep){?>
<form method="POST" action="massmessage.php">
			<table cellspacing="1" cellpadding="2" class="tbg">    
			  <tbody>
			    <tr>	
			      <td class="rbg" colspan="2"><?php echo MASS_CONFIRM; ?></td>    
			    </tr>
			    <tr>	
			      <td style="text-align: left; width: 200px;"><?php echo MASS_REALLY; ?></td>
			      <td style="text-align: left;">
			        <input type="submit" style="width: 240px;" class="fm" name="confirm" value="<?php echo JR_YES; ?>">
			        <input type="submit" style="width: 240px;" class="fm" name="confirm" value="<?php echo JR_NO; ?>"></td>    
			    </tr>
			  </tbody>
			</table> 
</form>
<?php }elseif (@$NextStep2){?>
<script>document.location.href='massmessage.php?send=true&from=0'</script>

<?php }elseif (@$Interupt){?>
<b><?php echo MASS_ABORT; ?></b>

<?php }elseif (@$done){?>
<?php echo MASS_SENT; ?>
<?php }else{die("Something is wrong");}?>
</div>
<div id="side_info" class="outgame">
</div>

<div class="clear"></div>
			</div>

			<div class="footer-stopper outgame"></div>
            <div class="clear"></div>
            
<?php include("Templates/footer.tpl"); ?>
<div id="ce"></div>
</body>
</html>
<?php mysql_close(); ?>
