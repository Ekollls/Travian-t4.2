<?php
/*
|--------------------------------------------------------------------------
| PLEASE DO NOT REMOVE THIS COPYRIGHT NOTICE!
|--------------------------------------------------------------------------
|
| Project owner: Travian-Classic-Team < trasilver_2012@yahoo.com >
|
| DECODE & DEBUG is property of Travian-Classic-Team Project. You are allowed to change
| its source and release it under own name, not under name `Travian-Classic-Team`.
| You have no rights to remove copyright notices.
|
| Travian-Classic-Team All rights reserved@
*/
include_once("GameEngine/Account.php");
$max_per_pass = 1000;
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (mysql_num_rows(mysql_query("SELECT id FROM ".TB_PREFIX."users WHERE access = 9 AND id = ".$session->uid)) != '1') die("Hacking attemp!");
?>


<?php    include "Templates/html.tpl";  ?>

<body class="v35 webkit chrome statistics">
	<div id="wrapper">
		<img id="staticElements" src="img/x.gif" alt="" />
		<div id="logoutContainer">
			<a id="logout" href="logout.php" title="<?php echo LOGOUT; ?>">&nbsp;</a>
		</div>
		<div class="bodyWrapper">
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
			<div id="header">
				<div id="mtop">
					<a id="logo" href="<?php include("adress.txt")?>" target="_blank" title="<?php echo SERVER_NAME ?>"></a>
					<ul id="navigation">
						<li id="n1" class="resources">
							<a class="" href="dorf1.php" accesskey="1" title="<?php echo HEADER_DORF1; ?>"></a>
						</li>
						<li id="n2" class="village">
							<a class="" href="dorf2.php" accesskey="2" title="<?php echo HEADER_DORF2; ?>"></a>
						</li>
						<li id="n3" class="map">
							<a class="" href="karte.php" accesskey="3" title="<?php echo HEADER_MAP; ?>"></a>
						</li>
						<li id="n4" class="stats">
							<a class=" active" href="statistiken.php" accesskey="4" title="<?php echo HEADER_STATS; ?>"></a>
						</li>
<?php
    	if(count($database->getMessage($session->uid,7)) >= 1000) {
			$unmsg = "+1000";
		} else { $unmsg = count($database->getMessage($session->uid,7)); }

    	if(count($database->getMessage($session->uid,8)) >= 1000) {
			$unnotice = "+1000";
		} else { $unnotice = count($database->getMessage($session->uid,8)); }
?>
<li id="n5" class="reports">
<a href="berichte.php" accesskey="5" title="<?php echo HEADER_NOTICES; ?><?php if($message->nunread){ echo' ('.count($database->getMessage($session->uid,8)).')'; } ?>"></a>
<?php
if($message->nunread){
	echo "<div class=\"ltr bubble\" title=\"".$unnotice." ".HEADER_NOTICES_NEW."\" style=\"display:block\">
			<div class=\"bubble-background-l\"></div>
			<div class=\"bubble-background-r\"></div>
			<div class=\"bubble-content\">".$unnotice."</div></div>";
}
?>
</li>
<li id="n6" class="messages">
<a href="nachrichten.php" accesskey="6" title="<?php echo HEADER_MESSAGES; ?><?php if($message->unread){ echo' ('.count($database->getMessage($session->uid,7)).')'; } ?>"></a>
<?php
if($message->unread) {
	echo "<div class=\"ltr bubble\" title=\"".$unmsg." ".HEADER_MESSAGES_NEW."\" style=\"display:block\">
			<div class=\"bubble-background-l\"></div>
			<div class=\"bubble-background-r\"></div>
			<div class=\"bubble-content\">".$unmsg."</div></div>";
}
?>
</li>

</ul>
<div class="clear"></div>
</div>
</div>
					<div id="mid">

												<div class="clear"></div>
<div id="contentOuterContainer">
<div class="contentTitle">&nbsp;</div>
    <div class="contentContainer">




<div id="content" class="statistics">
<h1 class="titleInHeader">&#1576;&#1575;&#1586;&#1583;&#1575;&#1588;&#1578; &#1576;&#1575;&#1586;&#1610;&#1705;&#1606;</h1>
<center>
<br />&#1583;&#1585; &#1575;&#1610;&#1606;&#1580;&#1575; &#1588;&#1605;&#1575; &#1602;&#1575;&#1583;&#1585; &#1582;&#1608;&#1575;&#1607;&#1610;&#1583; &#1576;&#1608;&#1583; &#1578;&#1575; &#1576;&#1607; &#1583;&#1608; &#1606;&#1581;&#1608; &#1576;&#1575;&#1586;&#1610;&#1705;&#1606;&#1575;&#1606; &#1582;&#1608;&#1583; &#1585;&#1575; &#1576;&#1575;&#1586;&#1583;&#1575;&#1588;&#1578; &#1606;&#1605;&#1575;&#1610;&#1610;&#1583; <br /> &#1606;&#1581;&#1608;&#1607; &#1575;&#1608;&#1604; : &#1576;&#1575;&#1586;&#1610;&#1705;&#1606; &#1601;&#1602;&#1591; &#1576;&#1607; &#1662;&#1610;&#1575;&#1605; &#1607;&#1575; &#1583;&#1587;&#1578;&#1585;&#1587;&#1610; &#1582;&#1608;&#1575;&#1607;&#1583; &#1583;&#1575;&#1588;&#1578; <br /> &#1606;&#1581;&#1608;&#1607; &#1583;&#1608;&#1605; : &#1576;&#1575;&#1586;&#1610;&#1705;&#1606; &#1576;&#1607; &#1607;&#1610;&#1670; &#1610;&#1705; &#1575;&#1586; &#1575;&#1605;&#1705;&#1575;&#1606;&#1575;&#1578; &#1587;&#1585;&#1608;&#1585; &#1583;&#1587;&#1578;&#1585;&#1587;&#1610; &#1606;&#1582;&#1608;&#1575;&#1607;&#1583; &#1583;&#1575;&#1588;&#1578; <br />
<a href="bann.php?t=1"><font color=red>&#1608;&#1585;&#1608;&#1583; &#1576;&#1607; &#1606;&#1581;&#1608;&#1607; &#1575;&#1608;&#1604;</font>  </a> <br /><a href="bann.php?t=2"><font color=red>&#1608;&#1585;&#1608;&#1583; &#1576;&#1607; &#1606;&#1581;&#1608;&#1607; &#1583;&#1608;&#1605;</font>  </a><br /><a href="bann.php?t=3"><font color=red>&#1576;&#1575;&#1586;&#1711;&#1588;&#1578; &#1576;&#1575;&#1586;&#1610;&#1705;&#1606; &#1575;&#1586; &#1581;&#1575;&#1604;&#1578; &#1576;&#1575;&#1586;&#1583;&#1575;&#1588;&#1578;</font>  </a>
</center>
<?php
If (isset($_GET['t']) && $_GET['t'] == "1"){
  echo '<br><br>';
  echo '<center>&#1583;&#1585; &#1575;&#1610;&#1606; &#1605;&#1581;&#1604; &#1588;&#1605;&#1575; &#1605;&#1610; &#1578;&#1608;&#1575;&#1606;&#1610;&#1583; &#1576;&#1575;&#1586;&#1610;&#1705;&#1606; &#1585;&#1575; &#1608;&#1575;&#1585;&#1583; &#1705;&#1585;&#1583;&#1607; &#1601;&#1602;&#1591; &#1576;&#1575;&#1586;&#1610;&#1705;&#1606; &#1602;&#1575;&#1583;&#1585; &#1582;&#1608;&#1575;&#1607;&#1583; &#1576;&#1608;&#1583; &#1662;&#1610;&#1575;&#1605; &#1607;&#1575;&#1585;&#1575; &#1576;&#1575;&#1586; &#1606;&#1605;&#1575;&#1610;&#1583;</center>' ;
  ?>
   <form name="s1" method="post" action="bann.php?t=1">
    <br /><table>
    <tr>
    <td alligen=center>&#1606;&#1575;&#1605; &#1575;&#1705;&#1575;&#1606;&#1578; :</td><td><input name="acc1" type="text" id="textfield" placeholder="&#1606;&#1575;&#1605; &#1575;&#1705;&#1575;&#1606;&#1578;" size="20" /></td>
    </tr>
    </table>
    <br />
    <center><button type="submit" value="" name="send1" id="btn_ok"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">&#1575;&#1585;&#1587;&#1575;&#1604;</div></div></button>
</center>
   </form>
   <?php
   if (isset($_POST['send1']))
   {
     $getname = $_POST['acc1'];
     if ($getname == "")
     {
     echo "<br><br><center>&#1604;&#1591;&#1601;&#1575; &#1606;&#1575;&#1605; &#1585;&#1575; &#1608;&#1575;&#1585;&#1583; &#1705;&#1606;&#1610;&#1583;</center>";
     }
     else
     {
     $rest = mysql_query("UPDATE ".TB_PREFIX."users set `access` = '1' WHERE `username` = '$getname' ");
     echo "<br><br><center>&#1575;&#1606;&#1580;&#1575;&#1605; &#1588;&#1583;</center>";
     }
   }
  }
If (isset($_GET['t']) && $_GET['t'] == "2"){
  echo '<br><br>';
  echo '<center>&#1583;&#1585; &#1575;&#1610;&#1606; &#1605;&#1581;&#1604; &#1588;&#1605;&#1575; &#1602;&#1575;&#1583;&#1585; &#1582;&#1608;&#1575;&#1607;&#1610;&#1583; &#1576;&#1608;&#1583; &#1576;&#1575;&#1586;&#1610;&#1705;&#1606; &#1585;&#1575; &#1575;&#1586; &#1585;&#1610;&#1588;&#1607; &#1576;&#1575;&#1586;&#1583;&#1575;&#1588;&#1578; &#1705;&#1606;&#1610;&#1583; :D</center>' ;
  ?>
   <form name="s2" method="post" action="bann.php?t=2">
    <br /><table>
    <tr>
    <td alligen=center>&#1606;&#1575;&#1605; &#1575;&#1705;&#1575;&#1606;&#1578; :</td><td><input name="acc2" type="text" id="textfield" placeholder="&#1606;&#1575;&#1605; &#1575;&#1705;&#1575;&#1606;&#1578;" size="20" /></td>
    </tr>
    </table>
    <br />
    <center><button type="submit" value="" name="send2" id="btn_ok"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">&#1575;&#1585;&#1587;&#1575;&#1604;</div></div></button>
</center>
   </form>
   <?php
   if (isset($_POST['send2']))
   {
     $getname2 = $_POST['acc2'];
     if ($getname2 == "")
     {
     echo "<br><br><center>&#1604;&#1591;&#1601;&#1575; &#1606;&#1575;&#1605; &#1585;&#1575; &#1608;&#1575;&#1585;&#1583; &#1705;&#1606;&#1610;&#1583;</center>";
     }
     else
     {
     $rest = mysql_query("UPDATE ".TB_PREFIX."users set `access` = '0' WHERE `username` = '$getname2' ");
     echo "<br><br><center>&#1575;&#1606;&#1580;&#1575;&#1605; &#1588;&#1583;</center>";
     }
   }
  }
If (isset($_GET['t']) && $_GET['t'] == "3"){
  echo '<br><br>';
  echo '<center>&#1583;&#1585; &#1575;&#1610;&#1606; &#1602;&#1587;&#1605;&#1578; &#1588;&#1605;&#1575; &#1605;&#1610; &#1578;&#1608;&#1575;&#1606;&#1610;&#1583; &#1576;&#1575;&#1586;&#1610;&#1705;&#1606; &#1576;&#1575;&#1586;&#1583;&#1575;&#1588;&#1578; &#1588;&#1583;&#1607; &#1585;&#1575; &#1576;&#1607; &#1581;&#1575;&#1604;&#1578; &#1575;&#1608;&#1604; &#1576;&#1585;&#1711;&#1585;&#1583;&#1575;&#1606;&#1610;&#1583;</center>' ;
  ?>
   <form name="s3" method="post" action="bann.php?t=3">
    <br /><table>
    <tr>
    <td alligen=center>&#1606;&#1575;&#1605; &#1575;&#1705;&#1575;&#1606;&#1578; :</td><td><input name="acc3" type="text" id="textfield" placeholder="&#1606;&#1575;&#1605; &#1575;&#1705;&#1575;&#1606;&#1578;" size="20" /></td>
    </tr>
    </table>
    <br />
    <center><button type="submit" value="" name="send3" id="btn_ok"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">&#1575;&#1585;&#1587;&#1575;&#1604;</div></div></button>
</center>
   </form>
   <?php
   if (isset($_POST['send3']))
   {
     $getname3 = $_POST['acc3'];
     if ($getname3 == "")
     {
     echo "<br><br><center>&#1604;&#1591;&#1601;&#1575; &#1606;&#1575;&#1605; &#1585;&#1575; &#1608;&#1575;&#1585;&#1583; &#1705;&#1606;&#1610;&#1583;</center>";
     }
     else
     {
     $rest = mysql_query("UPDATE ".TB_PREFIX."users set `access` = '2' WHERE `username` = '$getname3' ");
     echo "<br><br><center>&#1575;&#1606;&#1580;&#1575;&#1605; &#1588;&#1583;</center>";
     }
   }
  }
?>
<br /><br /><center><b> <a href="http://travian-classic.ir"><font color=red>Travian</font>-<font color=blue>Classic</font>-<font color=red>Team</font><br><font color=blue>We</font> <font color=red>Have </font><font color=blue>Revived</font> <font color=red>Travian</font> <font color=blue>3.6</font></a></b></center>
</div>
</div>

                        <div class="contentFooter">&nbsp;</div>
</div>

<?php
include("Templates/sideinfo.tpl");
include("Templates/footer.tpl");
include("Templates/header.tpl");
include("Templates/res.tpl");
include("Templates/vname.tpl");
include("Templates/quest.tpl");
?>

</div>
<div id="ce"></div>
</div>
</body>
</html>
