<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       massmessage.php                                                 ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

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
                                		<script type="text/javascript"> 
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>

<h1 class="titleInHeader">&#1606;&#1575;&#1605;&#1607;<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				



<div title="" <?php if(!isset($_GET['tid']) || (isset($_GET['tid']) && ($_GET['tid'] == 1 || $_GET['tid'] == 31 || $_GET['tid'] == 32 || $_GET['tid'] == 7))) { echo "class=\"container normal\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="Mssg.php"><span class="tabItem">&#1606;&#1575;&#1605;&#1607; &#1607;&#1605;&#1711;&#1575;&#1606;&#1610;</span></a></div> 
				</div> 
				<div title="" <?php if(isset($_GET['tid']) && ($_GET['tid'] == 4 || $_GET['tid'] == 41 || $_GET['tid'] == 42 || $_GET['tid'] == 43)) { echo "class=\"container normal\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div> 
					<div class="content"><a href="Mass.php"><span class="tabItem">&#1606;&#1575;&#1605;&#1607;</span></a></div> 
				</div> 
				<div title="" <?php if(isset($_GET['tid']) && $_GET['tid'] == 2) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div> 
					<div class="content"><a href="admin"><span class="tabItem">&#1605;&#1583;&#1610;&#1585;&#1610;&#1578;</span></a></div> 
				</div> 
				<div title="" <?php if(isset($_GET['tid']) && $_GET['tid'] == 8) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div> 
					<div class="content"><a href="meDa.php"><span class="tabItem">&#1605;&#1583;&#1575;&#1604; &#1607;&#1575;</span></a></div> 
				</div> 
				<div title="" <?php if(isset($_GET['tid']) && $_GET['tid'] == 0) { echo "class=\"container active\""; } else { echo "class=\"container active\""; } ?>> 
					<div class="background-start">&nbsp;</div> 
					<div class="background-end">&nbsp;</div> 
					<div class="content"><a href="katibe.php"><span class="tabItem">&#1705;&#1578;&#1740;&#1576;&#1607; &#1607;&#1575;</span></a></div> 
				</div> 
				
				<div class="clear"></div>







</div>

<h4 class="round">&#1705;&#1578;&#1740;&#1576;&#1607; &#1607;&#1575;</h4>



&#1576;&#1585;&#1575;&#1740; &#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1607;&#1605;&#1711;&#1740; &#1606;&#1575;&#1578;&#1575;&#1585; &#1607;&#1575; &#1576;&#1607; &#1589;&#1608;&#1585;&#1578; &#1740;&#1705;&#1580;&#1575; &#1576;&#1575;&#1740;&#1583; &#1578;&#1575;&#1740;&#1740;&#1583; &#1705;&#1606;&#1740;&#1583; ---><a href="katibekoli.php" target=blank">&#1578;&#1575;&#1740;&#1740;&#1583;</a>


<br><br>
&#1576;&#1585;&#1575;&#1740; &#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1606;&#1602;&#1588;&#1607; &#1587;&#1575;&#1582;&#1578; &#1588;&#1711;&#1601;&#1578;&#1740; &#1580;&#1607;&#1575;&#1606; &#1576;&#1575;&#1740;&#1583; &#1578;&#1575;&#1740;&#1740;&#1583; &#1705;&#1606;&#1740;&#1583;---> <a href="wonder/wonderplan.php"target=blank">&#1578;&#1575;&#1740;&#1740;&#1583;</a>




<br><br><br><br><br>


<br><br><br><br><br>
<h4 class="round">&#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1578;&#1705; &#1578;&#1705; &#1705;&#1578;&#1740;&#1576;&#1607; &#1607;&#1575;</h4>

<a href="wonder/AnbareBartar.php"target=blank">&#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1705;&#1578;&#1740;&#1576;&#1607; (&#1575;&#1606;&#1576;&#1575;&#1585; &#1576;&#1585;&#1578;&#1585;)</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="wonder/AhmaghHa.php"target=blank">&#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; (&#1705;&#1578;&#1740;&#1576;&#1607; &#1575;&#1581;&#1605;&#1602; &#1607;&#1575;)</a>

<br>
<a href="wonder/CheshmaneOghab.php"target=blank">&#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1705;&#1578;&#1740;&#1576;&#1607; (&#1670;&#1588;&#1605; &#1593;&#1602;&#1575;&#1576;)</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="wonder/ChakmeKhodayan.php"target=blank">&#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1705;&#1578;&#1740;&#1576;&#1607; (&#1670;&#1705;&#1605;&#1607; &#1582;&#1583;&#1575;&#1740;&#1575;&#1606;)</a>

<br>
<a href="wonder/JangAmoz.php"target=blank">&#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1705;&#1578;&#1740;&#1576;&#1607; (&#1580;&#1606;&#1711; &#1575;&#1605;&#1608;&#1586;)</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="wonder/GijKonande.php"target=blank">&#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1705;&#1578;&#1740;&#1576;&#1607; (&#1711;&#1740;&#1580; &#1705;&#1606;&#1606;&#1583;&#1607;)</a>

<br>
<a href="wonder/Mertaz.php"target=blank">&#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1705;&#1578;&#1740;&#1576;&#1607; (&#1605;&#1585;&#1578;&#1575;&#1586;)</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="wonder/RazeMemari.php"target=blank">&#1575;&#1586;&#1575;&#1583; &#1705;&#1585;&#1583;&#1606; &#1705;&#1578;&#1740;&#1576;&#1607; (&#1585;&#1575;&#1586; &#1605;&#1593;&#1605;&#1575;&#1585;&#1740;)</a>
<br>
<a href="wonder/farm.php"target=blank">ازاد سازی ده های فارم برای ناتار ها)</a>

















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



