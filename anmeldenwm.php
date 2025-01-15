<?php
include("GameEngine/Protection.php");
include('GameEngine/Account.php');
if(isset($_COOKIE['lang']) and $_COOKIE['lang']!='')$_SESSION['lang'] = $_COOKIE['lang'];
$conf = $database->config();
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome signup">
	<div id="wrapper">
		<img id="staticElements" src="img/x.gif" alt="">
		<div class="bodyWrapper">
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="">
			<div id="header">
				<div id="mtop">
					<a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>"></a>
					<div class="clear"></div>
				</div>
			</div>
			<div id="mid">

      
              <a id="ingameManual" href="support.php" title="&#1585;&#1575;&#1607;&#1606;&#1605;&#1575;">
              <img src="img/x.gif" class="question" alt="&#1585;&#1575;&#1607;&#1606;&#1605;&#1575;"/>
            </a>
  
      
            
        
        <div id="anwersQuestionMark">
            <a href="http://forum.t4dl.ir/index.php" target="_blank" title="&#1662;&#1575;&#1587;&#1582; &#1607;&#1575;&#1740;  &#1578;&#1585;&#1608;&#1740;&#1606;">&nbsp;</a>
        </div>    
            
            
            
<div id="side_navi">
	<ul>
		<li>
			<a href="<?php echo HOMEPAGE; ?>" title="<?php echo HOME; ?>"><?php echo HOME; ?></a>
		</li>

		<li>
			<a href="login.php" title="<?php echo LOGIN; ?>"><?php echo LOGIN; ?></a>
		</li>

		<li class="active">
			<a href="anmelden.php" title="<?php echo REG; ?>"><?php echo REG; ?></a>
		</li>

		<li>
			<a href="http://trvinforum.ir" target="_blank" title="<?php echo FORUM; ?>"><?php echo FORUM; ?></a>
		</li>
		
		<li class="support">
			<a href="contact.php" title="<?php echo SUPPORT; ?>"><?php echo SUPPORT; ?></a>
		</li>
	</ul>
</div>												<div class="clear"></div>
						<div id="contentOuterContainer">
							<div class="contentTitle">&nbsp;</div>
							<div class="contentContainer">
								<div id="content" class="signup"><h1 class="titleInHeader"><?php echo REG; ?></h1>
		<h4 class="round"><?php echo REGISTER_USERINFO; ?></h4>
		<form name="snd" method="post" action="anmelden.php">
		<input type="hidden" name="ft" value="a1" />
			<table cellpadding="1" cellspacing="1" id="sign_input" class="transparent">
			<tbody>
				<tr class="top">
<th><label for="userName">&#1606;&#1575;&#1605;:</label></th>
					<td>
						<input id="userName" class="text" type="text" name="name" value="<?php echo $form->getValue('name'); ?>" maxlength="15" />
						<span class="error"><?php echo $form->getError('name'); ?></span>
					</td>
				</tr>
				<tr>
<th><label for="userEmail">&#1575;&#1740;&#1605;&#1740;&#1604;:</label></th>
					<td>
						<input id="userEmail" class="text" type="text" name="email" value="<?php echo $form->getValue('email'); ?>" maxlength="40" />
						<span class="error"><?php echo $form->getError('email'); ?></span>
					</td>
				</tr>
				<tr class="btm">
					<th><label for="userPassword">&#1585;&#1605;&#1586; &#1593;&#1576;&#1608;&#1585;:</label></th>
          <td>
            <input id="userPassword" class="text" type="password" name="pw" value="" maxlength="20" />
            <span class="error"></span>
          </td>
        </tr>
        <tr>
          <th></th>
          <td>
            <span class="error">&#1606;&#1575;&#1605; &#1705;&#1575;&#1585;&#1576;&#1585;&#1610; &#1608; &#1585;&#1605;&#1586; &#1593;&#1576;&#1608;&#1585; &#1575;&#1586; &#1581;&#1585;&#1608;&#1601; &#1575;&#1606;&#1711;&#1604;&#1610;&#1587;&#1610;&#1548; &#1575;&#1593;&#1583;&#1575;&#1583; &#1608; &#1705;&#1575;&#1585;&#1575;&#1705;&#1578;&#1585;&#1607;&#1575;&#1610; _ &#1608; &#1610;&#1575; - &#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1588;&#1608;&#1583;.
<br />
&#1605;&#1579;&#1575;&#1604;: ABC / abc / abc123 / ABC-123
<br />
&#1606;&#1575;&#1605; &#1705;&#1575;&#1585;&#1576;&#1585;&#1610; &#1608; &#1585;&#1605;&#1586; &#1593;&#1576;&#1608;&#1585; &#1576;&#1575; &#1705;&#1575;&#1585;&#1575;&#1705;&#1578;&#1585; 0 &#1588;&#1585;&#1608;&#1593; &#1606;&#1588;&#1608;&#1583; &#1608; &#1606;&#1588;&#1575;&#1606;&#1711;&#1585; &#1593;&#1583;&#1583; &#1575;&#1593;&#1588;&#1575;&#1585;&#1610; &#1593;&#1604;&#1605;&#1610; &#1606;&#1576;&#1575;&#1588;&#1583;.
<br />
&#1605;&#1579;&#1575;&#1604;: 0b11101 / 0123 / 000 / 123e10 / 1e100
</span>
          </td>
        </tr>
      </tbody>
    </table>

    <h4 class="round">&#1740;&#1705; &#1606;&#1688;&#1575;&#1583; &#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1705;&#1606;&#1740;&#1583;</h4>
    <p class="tribeInfo">&#1602;&#1576;&#1604; &#1575;&#1586; &#1575;&#1740;&#1606;&#1705;&#1607; &#1579;&#1576;&#1578; &#1606;&#1575;&#1605; &#1705;&#1606;&#1740;&#1583;&#1548; &#1576;&#1607;&#1578;&#1585; &#1575;&#1587;&#1578; &#1576;&#1582;&#1588; <a href='../anleitung.php' target='_blank'>&#1585;&#1575;&#1607;&#1606;&#1605;&#1575;&#1740;&#1740;</a> &#1578;&#1585;&#1608;&#1740;&#1606; &#1585;&#1575; &#1605;&#1591;&#1575;&#1604;&#1593;&#1607; &#1705;&#1606;&#1740;&#1583; &#1578;&#1575; &#1575;&#1586; &#1576;&#1585;&#1578;&#1585;&#1740; &#1608; &#1590;&#1593;&#1601; &#1607;&#1585; &#1740;&#1705; &#1575;&#1586; &#1587;&#1607; &#1606;&#1688;&#1575;&#1583; &#1605;&#1591;&#1604;&#1593; &#1588;&#1608;&#1740;&#1583;.<br /><br />&#1575;&#1711;&#1585; &#1576;&#1607; &#1578;&#1575;&#1586;&#1711;&#1740; &#1576;&#1575; t4dl &#1570;&#1588;&#1606;&#1575; &#1588;&#1583;&#1607; &#1575;&#1740;&#1583;&#1548; &#1578;&#1608;&#1589;&#1740;&#1607; &#1605;&#1740; &#1588;&#1608;&#1583; &#1705;&#1607; &#1606;&#1688;&#1575;&#1583; &#1711;&#1608;&#1604; &#1585;&#1575; &#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1705;&#1606;&#1740;&#1583;.</p>
    <div class="tribeSelect">
			<div class="tribe romans">
				<div class="selection">
					<input id="tribeRomans" class="radio" type="radio" name="vid" value="1" <?php echo $form->getRadio('vid',1); ?>>&nbsp;<label for="tribeRomans"><?php echo TRIBE1; ?></label>
				</div>
				<label for="tribeRomans"><img src="img/x.gif" class="tribeImage romans" alt="<?php echo TRIBE1; ?>" title="<?php echo TRIBE1; ?>" /></label>
			</div>

			<div class="tribe teutons">
				<div class="selection">
					<input id="tribeTeutons" class="radio" type="radio" name="vid" value="2" <?php echo $form->getRadio('vid',2); ?>>&nbsp;<label for="tribeTeutons"><?php echo TRIBE2; ?></label>
				</div>
				<label for="tribeTeutons"><img src="img/x.gif" class="tribeImage teutons" alt="<?php echo TRIBE2; ?>" title="<?php echo TRIBE2; ?>" /></label>
			</div>


			<div class="tribe gauls">
				<div class="selection">
					<input id="tribeGauls" class="radio" type="radio" name="vid" value="3" <?php echo $form->getRadio('vid',3); ?>>&nbsp;<label for="tribeGauls"><?php echo TRIBE3; ?></label>
				</div>
				<label for="tribeGauls"><img src="img/x.gif" class="tribeImage gauls" alt="<?php echo TRIBE3; ?>" title="<?php echo TRIBE3; ?>" /></label>
			</div>

			<div class="clear"></div>
		</div>

		<h4 class="round"><?php echo REGISTER_LOCATION; ?></h4>
		<table cellpadding="1" cellspacing="1" id="sign_select" class="transparent">
			<tbody>
				<tr>
					<td>
<input class="radio" type="radio" id="positionRandom" name="kid" value="0" checked="checked"  />&nbsp;<label for="positionRandom">&#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1578;&#1589;&#1575;&#1583;&#1601;&#1740;</label>
					</td>
					<td>
						<input class="radio" type="radio" id="positionNW" name="kid" value="4" <?php echo $form->getRadio('kid',4); ?>>&nbsp;<label for="positionNW"><?php echo Nw; ?></label>
					</td>
					<td>
						<input class="radio" type="radio" id="positionNE" name="kid" value="3" <?php echo $form->getRadio('kid',3); ?>>&nbsp;<label for="positionNE"><?php echo Ne; ?></label>
					</td>
				</tr>
				<tr>
					<td class="pos2">&nbsp;
						
					</td>
					<td>
						<input class="radio" type="radio" id="positionSW" name="kid" value="1" <?php echo $form->getRadio('kid',1); ?>>&nbsp;<label for="positionSW"><?php echo Sw; ?></label>
					</td>
					<td>
						<input class="radio" type="radio" id="positionSE" name="kid" value="2" <?php echo $form->getRadio('kid',2); ?>>&nbsp;<label for="positionSE"><?php echo Se; ?></label>
					</td>
				</tr>
			</tbody>
		</table>
	
			<!--h4 class="round">&#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1576;&#1740;&#1588;&#1578;&#1585;</h4-->
      <h4 class="round">&#1602;&#1608;&#1575;&#1606;&#1610;&#1606;</h4>
      <div class="checks">
<br />
&#1607;&#1585; &#1606;&#1585;&#1605; &#1575;&#1601;&#1586;&#1575;&#1585; &#1608; &#1587;&#1575;&#1610;&#1578;&#1610; &#1605;&#1605;&#1705;&#1606; &#1575;&#1587;&#1578; &#1583;&#1575;&#1585;&#1575;&#1610; &#1705;&#1575;&#1587;&#1578;&#1610; &#1607;&#1575; &#1608; &#1605;&#1588;&#1705;&#1604;&#1575;&#1578;&#1610; &#1576;&#1575;&#1588;&#1583;. &#1604;&#1584;&#1575; &#1575;&#1711;&#1585; &#1606;&#1605;&#1610; &#1578;&#1608;&#1575;&#1606;&#1610;&#1583; &#1575;&#1610;&#1606; &#1605;&#1587;&#1575;&#1574;&#1604; &#1585;&#1575; &#1576;&#1662;&#1584;&#1610;&#1585;&#1610;&#1583; &#1582;&#1608;&#1575;&#1607;&#1588;&#1605;&#1606;&#1583;&#1610;&#1605; &#1583;&#1585; &#1587;&#1575;&#1610;&#1578; &#1579;&#1576;&#1578; &#1606;&#1575;&#1605; &#1606;&#1705;&#1606;&#1610;&#1583;. &#1711;&#1585;&#1608;&#1607; &#1578;&#1585;&#1608;&#1740;&#1606; &#1606;&#1587;&#1576;&#1578; &#1576;&#1607; &#1605;&#1587;&#1575;&#1574;&#1604; &#1608; &#1605;&#1588;&#1705;&#1604;&#1575;&#1578; &#1576;&#1607; &#1608;&#1580;&#1608;&#1583; &#1570;&#1605;&#1583;&#1607; &#1585;&#1601;&#1593; &#1605;&#1587;&#1574;&#1608;&#1604;&#1610;&#1578; &#1605;&#1610; &#1705;&#1606;&#1583; &#1608; &#1607;&#1610;&#1670;&#1711;&#1608;&#1606;&#1607; &#1578;&#1593;&#1607;&#1583;&#1610; &#1606;&#1583;&#1575;&#1585;&#1583;. &#1576;&#1585;&#1575;&#1610; &#1575;&#1591;&#1604;&#1575;&#1593; &#1576;&#1610;&#1588;&#1578;&#1585; &#1583;&#1585; &#1605;&#1608;&#1585;&#1583; &#1605;&#1587;&#1575;&#1574;&#1604; &#1587;&#1575;&#1610;&#1578; &#1576;&#1607; &#1601;&#1585;&#1608;&#1605;&#1548; &#1602;&#1587;&#1605;&#1578; <a href="http://trvinforum.ir/"> &#1587;&#1608;&#1575;&#1604;&#1575;&#1578; &#1605;&#1578;&#1583;&#1575;&#1608;&#1604; </a> &#1585;&#1580;&#1608;&#1593; &#1705;&#1606;&#1610;&#1583;.
<br />
<br />
&#1578;&#1575; &#1586;&#1605;&#1575;&#1606; &#1606;&#1607;&#1575;&#1610;&#1610; &#1588;&#1583;&#1606; &#1587;&#1585;&#1608;&#1585; &#1608; &#1605;&#1583;&#1608;&#1606; &#1588;&#1583;&#1606; &#1602;&#1608;&#1575;&#1606;&#1610;&#1606; &#1576;&#1607; &#1578;&#1589;&#1605;&#1610;&#1605;&#1575;&#1578; &#1605;&#1587;&#1574;&#1608;&#1604;&#1610;&#1606; &#1587;&#1575;&#1610;&#1578; &#1575;&#1581;&#1578;&#1585;&#1575;&#1605; &#1605;&#1610;&#1711;&#1584;&#1575;&#1585;&#1605;. &#1576;&#1607; &#1582;&#1575;&#1591;&#1585; &#1578;&#1589;&#1605;&#1610;&#1605;&#1575;&#1578;&#1610; &#1705;&#1607; &#1711;&#1585;&#1608;&#1607; &#1578;&#1585;&#1608;&#1740;&#1606; &#1575;&#1578;&#1582;&#1575;&#1584; &#1605;&#1610; &#1705;&#1606;&#1610;&#1583; &#1608; &#1576;&#1607; &#1583;&#1604;&#1610;&#1604; &#1576;&#1585;&#1608;&#1586; &#1605;&#1588;&#1705;&#1604;&#1575;&#1578;&#1610; &#1705;&#1607; &#1605;&#1605;&#1705;&#1606; &#1575;&#1587;&#1578; &#1583;&#1585; &#1591;&#1608;&#1604; &#1575;&#1580;&#1585;&#1575;&#1610; &#1576;&#1575;&#1586;&#1610; &#1575;&#1578;&#1601;&#1575;&#1602; &#1576;&#1610;&#1601;&#1578;&#1583; &#1581;&#1602; &#1601;&#1581;&#1575;&#1588;&#1610;&#1548; &#1578;&#1606;&#1583;&#1582;&#1608;&#1610;&#1610; &#1608; &#1578;&#1607;&#1583;&#1610;&#1583; &#1606;&#1587;&#1576;&#1578; &#1576;&#1607; &#1605;&#1587;&#1574;&#1608;&#1604;&#1610;&#1606; &#1587;&#1575;&#1610;&#1578; &#1585;&#1575; &#1606;&#1583;&#1575;&#1585;&#1605; &#1608; &#1608; &#1605;&#1588;&#1705;&#1604;&#1575;&#1578; &#1608; &#1605;&#1587;&#1575;&#1574;&#1604; &#1662;&#1610;&#1588; &#1570;&#1605;&#1583;&#1607; &#1585;&#1575; &#1576;&#1575; &#1705;&#1605;&#1575;&#1604; &#1582;&#1608;&#1606;&#1587;&#1585;&#1583;&#1610; &#1608; &#1575;&#1583;&#1576; &#1608; &#1575;&#1581;&#1578;&#1585;&#1575;&#1605; &#1576;&#1607; &#1605;&#1587;&#1574;&#1608;&#1604;&#1610;&#1606; &#1587;&#1575;&#1610;&#1578; &#1575;&#1591;&#1604;&#1575;&#1593; &#1605;&#1610;&#1583;&#1607;&#1605;. &#1583;&#1585; &#1594;&#1610;&#1585; &#1575;&#1610;&#1606;&#1589;&#1608;&#1585;&#1578;&#1548; &#1605;&#1587;&#1574;&#1608;&#1604;&#1610;&#1606; &#1587;&#1575;&#1610;&#1578; &#1581;&#1602; &#1580;&#1604;&#1608;&#1711;&#1610;&#1585;&#1610; &#1575;&#1586; &#1575;&#1583;&#1575;&#1605;&#1607; &#1576;&#1575;&#1586;&#1610; &#1585;&#1575; &#1576;&#1585;&#1575;&#1610; &#1575;&#1705;&#1575;&#1606;&#1578; &#1575;&#1610;&#1606;&#1580;&#1575;&#1606;&#1576; &#1582;&#1608;&#1575;&#1607;&#1606;&#1583; &#1583;&#1575;&#1588;&#1578;.
<br />
<br />
        <input class="check" type="checkbox" id="agb" name="agb" value="1" />
        <label for="agb"> &#1605;&#1606; &#1602;&#1608;&#1575;&#1606;&#1740;&#1606; &#1585;&#1575; &#1582;&#1608;&#1575;&#1606;&#1583;&#1607; &#1608; &#1602;&#1576;&#1608;&#1604; &#1583;&#1575;&#1585;&#1605;.</label>
      </div>
        <ul class="important">
    </ul>
    <div class="btn">
      <button type="submit" value="anmelden" name="s1" id="btn_signup" title="&#1579;&#1576;&#1578; &#1606;&#1575;&#1605;">
            <div class="button-container">
            <div class="button-position">
            <div class="btl">
            <div class="btr">
            <div class="btc"></div></div></div>
            <div class="bml">
            <div class="bmr">
            <div class="bmc"></div></div></div>
            <div class="bbl">
            <div class="bbr">
            <div class="bbc"></div></div></div></div>
            <div class="button-contents">&#1579;&#1576;&#1578; &#1606;&#1575;&#1605;</div></div>
            </button>
		</div>
	</form>
    <div class="clear">&nbsp;</div>
    </div>
    <div class="clear"></div>
						</div>
                        <div class="contentFooter">&nbsp;</div>
					</div>
                    <?php
@include("GameEngine/Database/connection.php");
@$con = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
@mysql_select_db(SQL_DB, $con);
$users = array();
$users['total'] = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users"));
$users['active'] = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (3600*24) AND tribe!=5 AND tribe!=0"));
$users['online'] = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (60*60) AND tribe!=5 AND tribe!=0"));
mysql_close($con);
?>

					<div id="side_info">
                    <div class="news" style="position:absolute;margin-right:-839px;margin-top:318px;background-size:131px 100px;padding-top:19px;line-height:20px;">
کاربران فعال: <b><?=$users['active']?></b> نفر<br>
کل کاربران: <b><?=$users['total']-4?></b> نفر<br>


</div>
    
						<?php if(NEWSBOX1) { ?>
							<div class="news news1"><?php include("Templates/News/newsbox1.tpl"); ?></div>
						<?php } ?>
						<?php if(NEWSBOX2) { ?>
							<div class="news news2"><?php include("Templates/News/newsbox2.tpl"); ?></div>
						<?php } ?>
					</div>
					<?php
					include("Templates/footer.tpl");
					?>
				</div>
				<div id="ce"></div>
			</div>
</body>
</html>
