<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
$config_file = file_get_contents("GameEngine/config.php");
if ( preg_match('/NOT_INSTALLED/is',$config_file) ) {
	header("Location: install/");
}
include("GameEngine/Account.php");
include "Templates/html.tpl";

function getremoteip() {
		if (!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
	 //check for ip from share internet
	 $remote_ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
	 // Check for the Proxy User
	 $remote_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else
	{
	 $remote_ip = $_SERVER["REMOTE_ADDR"];
	};
	return $remote_ip;
};
$ip = getremoteip();
if($session->logged_in) {
	mysql_query("UPDATE ".TB_PREFIX."users SET ip = '". $ip ."' WHERE username = '". $session->username ."'");
}
	

?>
<body class="v35 webkit chrome login perspectiveBuildings">
	<div id="background">
		<img id="staticElements" src="img/x.gif" alt=""/>
		<div id="bodyWrapper">
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt=""/>
			<div id="header">
				<div id="mtop">
					<a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>"></a>
					<div class="clear"></div>
				</div>
			</div>
			<div id="center">
<div id="sidebarBeforeContent" class="sidebar beforeContent">
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

										
<div id="sidebarBoxMenu" class="sidebarBox   ">
	<div class="sidebarBoxBaseBox">
		<div class="baseBox baseBoxTop">
			<div class="baseBox baseBoxBottom">
				<div class="baseBox baseBoxCenter"></div>
			</div>
		</div>
	</div>
	<div class="sidebarBoxInnerBox">
		<div class="innerBox header noHeader">
					</div>
		<div class="innerBox content">
			<ul>
	<li class="first">
		<a href="/" target="_blank"><?=HOME?></a>
	</li>

	<li class="active">
		<a href="login.php"><?=LOGIN?></a>
	</li>

	<li>
		<a href="anmelden.php" target="_blank"><?=REGISTER?></a>
	</li>

	<li>
		<a href="#" target="_blank"><?=FORUM?></a>
	</li>

	<li>
		<a href="#"><?=SUPPORT?></a>
	</li>
    						<li>
							<label for="sellang" class="lsMl">Language:</label>
							<select name="sellang" id="sellang" onchange="changeLanguage();">
								<option value="en" <?php if ($_SESSION['lang']=='en') echo 'selected="selected"';?>>English</option>
								<option value="fa" <?php if ($_SESSION['lang']=='fa') echo 'selected="selected"';?>>فارسی</option>
							</select>
						</li>

    <li style="border-top:2px black solid;">
    <a>
    <?=USERS_ONLINE?>: <b><?=$users['online']?></b>
    </a></li>
    <li>
    <a>
    <?=USERS_ACTIVE?>: <b><?=$users['active']?></b>
    </a></li>
    <li><a><?=USERS_TOTAL?>: <b><?=$users['total']-4?></b></a></li>

</ul>		</div>
		<div class="innerBox footer">
					</div>
	</div>
</div>												<div class="clear"></div>
					</div>				<div id="contentOuterContainer">
					<div class="contentTitle">&nbsp;</div>
					<div class="contentContainer">
						<div id="content" class="login">
							<h1 class="titleInHeader"><?php echo LOGIN; ?></h1>
								<script type="text/javascript">
								Element.implement({
									//imgid: falls zu dem link ein pfeil gehört kann dieser "auf/zugeklappt" werden
									showOrHide: function(imgid) {
										//einblenden
										if (this.getStyle('display') == 'none'){
											if (imgid != ''){
												$(imgid).className = 'open';
											}
										}
										//ausblenden
										else {
											if (imgid != '') {
												$(imgid).className = 'close';
											}
										}
										this.toggleClass('hide');
									}
								});
								</script>
								<?php
								$loginform = '';
								$startin = '';
								if(COMMENCE > time()){
									$loginform = "hide";
								}else{ $startin = "hide"; }
								?>
								<script type="text/javascript">
								Element.implement({
									//imgid: falls zu dem link ein pfeil gehört kann dieser "auf/zugeklappt" werden
									showOrHide: function(imgid) {
										//einblenden
										if (this.getStyle('display') == 'none'){
											if (imgid != ''){
												$(imgid).className = 'open';
											}
										}
										//ausblenden
										else{
											if (imgid != ''){
												$(imgid).className = 'close';
											}
										}
										this.toggleClass('hide');
									}
								});
								</script>
								<div class="outerLoginBox <?php echo @$loginform; ?>">
									<h2><?php echo LOGIN_WELCOME; ?></h2>
									<noscript>
										<div class="noJavaScript"><?php echo LOGIN_NO_JAVASCRIPT; ?></div>
									</noscript>
									<div class="greenbox passwordForgotten" id="top_browser_box">
				<div class="greenbox-top"></div>
				<div class="greenbox-content">


<center>
	<script type="text/javascript">

if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)){ //test for Firefox/x.x or Firefox x.x (ignoring remaining digits);
 var ffversion=new Number(RegExp.$1) // capture x.x portion and store as a number
if (ffversion>=1)
 document.write("<?php echo LOGIN_BROWSER_1; ?>")
}
else
 if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){ //test for MSIE x.x;
 var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number
 if (ieversion>=5)
  document.write("<?php echo LOGIN_BROWSER_4; ?>")
}
else
if (/Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent)){ //test for Opera/x.x or Opera x.x (ignoring remaining decimal places);
 var oprversion=new Number(RegExp.$1) // capture x.x portion and store as a number
 if (oprversion>=7)
  document.write("<?php echo LOGIN_BROWSER_3; ?>")
}
else
	var isChrome = window.chrome;
	if(isChrome) {
		document.write("<?php echo LOGIN_BROWSER_2; ?>")
	}


</script>							</div>
				<div class="greenbox-bottom"></div>
				<div class="clear"></div>
			</div></center>
	
<Br />
<div class="innerLoginBox">
	<form method="post" name="snd" action="login.php" class="<?php echo @$loginform; ?>">
		<input type="hidden" name="ft" value="a4" />
		<table class="transparent loginTable">
			<tbody>
				<tr class="account">
					<td class="accountNameOrEmailAddress"><?php echo LOGIN_USERNAME; ?></td>
					<td>
						<input type="text" name="user" value="" class="text">
						<div class="error RTL"><?php echo $form->getError("user"); ?></div>
					</td>
					<td>
					</td>
				</tr>
				<tr class="pass">
					<td><?php echo LOGIN_PASSWORD; ?></td>
					<td>
						<input type="password" maxlength="20" name="pw" value="<?php echo $form->getValue("pw");?>" class="text"><br>
						<div class="error RTL"><?php echo $form->getError("pw"); ?></div>
					</td>
					<td>
					</td>
				</tr>
				<tr class="lowResOption">
					<td><?php echo LOGIN_LOWRES_OPTION; ?></td>
					<td colspan="2">
						<input type="checkbox" class="checkbox" id="lowRes" name="lowRes" value="1">
						<label for="lowRes"><?php echo LOGIN_LOWRES_DESC; ?></label>
					</td>
				</tr>
				<tr class="lowResInfo">
					<td colspan="3"><?php echo LOGIN_LOWRES_NOTICE; ?></td>
				</tr>
                                <tr>
                <td colspan="1" dir="rtl" valign="top" align="right">
                <a onClick="document.getElementById('cap').src = 'securimage/securimage_show.php'; this.blur(); return false"><img style="border:none;width:150px;height:50px;" src="securimage/securimage_show.php" id="cap"></a>
                </td>
                <td>
                <input name="captcha" class="text" type="text" id="captcha">
                <div class="error RTL"><?php echo $form->getError("captcha"); ?></div>
                </td>
                </tr>

				<tr>
					<td>
					</td>
														<td>
															
															
															
															
<button type="submit" value="<?php echo LOGIN; ?>" name="s1" id="s1" class="green " onclick="document.login.w.value=screen.width+':'+screen.height;">
	<div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo LOGIN; ?></div>
	</div>
</button>
															
						
															<input type="hidden" name="w" value="">
															<input type="hidden" name="login" value="<?php echo time(); ?>">
														</td>
														<td>
														</td>
													</tr>
												</tbody>
											</table>
										</form>
									</div>
                                    <br>
<br>
<br>

									<div class="greenbox passwordForgotten">
										<div class="greenbox-top"></div>
										<div class="greenbox-content">
											<div class="passwordForgottenLink">
												<a onClick="$('showPasswordForgotten').showOrHide('arrow');" href="<?php if(isset($_GET['action'])){ echo'#'; }else{ echo'?action=forgotPassword'; }?>" class="showPWForgottenLink">
													<img class="close" id="arrow" src="img/x.gif"><?php echo LOGIN_PW_FORGOTTEN; ?>
												</a>
											</div>
											<div class="showPasswordForgotten <?php if(isset($_GET['action']) && $_GET['action']=='forgotPassword'){}else{ echo'hide'; }?>" id="showPasswordForgotten">
												<?php if(isset($_GET['finish'])){ ?>
													<font color="#008000"><?php echo LOGIN_PW_SENT; ?></font>
												<?php }else{ ?>
													<form method="POST" action="">
														<input type="hidden" name="forgotPassword" value="1">
														<div class="forgotPasswordDescription"><?php echo LOGIN_PW_REQUEST; ?></div>
														<table class="transparent pwForgottenTable" id="pw_forgotten_form" cellpadding="0" cellspacing="0">
															<tbody>
																<tr class="mail">
																	<th><?php echo LOGIN_PW_EMAIL; ?></th>
																	<td>
																		<input class="text" type="text" name="pw_email" value=""><br><div class="error RTL"><?php echo $form->getError("pw_email"); ?></div>
																	</td>
																</tr>
																<tr>
																	<td></td>
																	<td colspan="2">
																		<button type="submit" value="<?php echo LOGIN_PW_BTN; ?>" name="s2" id="s2" class="green " onclick="document.login.w.value=screen.width+':'+screen.height;">
	<div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo LOGIN_PW_BTN; ?></div>
	</div>
</button>

																	</td>
																</tr>
															</tbody>
														</table>
													</form>
												<?php } ?>
											</div>
										</div>
										<div class="greenbox-bottom"></div>
										<div class="clear"></div>
									</div>
								</div>
								<div class="worldStartInfo <?php echo $startin; ?>" id="worldStartInfo">
									<?php echo LOGIN_SERVER_START; ?>
									<script language="JavaScript">
									dthen = <?php echo COMMENCE; ?>; var dnow = <?php echo time()?>; CountActive = true; CountStepper = -1; LeadingZero = true; DisplayFormat = "%%D%% <?php echo DAYS;?> + %%H%%:%%M%%:%%S%% <?php echo HRS;?>";
									FinishMessage = "<?php echo STARTNOW;?>";

									function calcage(secs, num1, num2) {
									  s = ((Math.floor(secs/num1))%num2).toString();
									  if (LeadingZero && s.length < 2) s = "0" + s;
									  return "" + s + "";
									}

									function CountBack(secs) {
									  if (secs < 0) { document.getElementById("worldStartInfo").innerHTML = "<a href='login.php'>"+FinishMessage+'</a>'; return; }
									  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
									  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
									  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
									  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

									  document.getElementById("gameStartInfo").innerHTML = DisplayStr;
									  if (CountActive) setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
									}

									function putspan(backcolor, forecolor) { document.write("<div class='countdownContent' id='gameStartInfo'></div>");}

									if (typeof(BackColor)=="undefined") BackColor = "white";
									if (typeof(ForeColor)=="undefined") ForeColor= "black";

									CountStepper = Math.ceil(CountStepper);
									if (CountStepper == 0)
									  CountActive = false;
									var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
									putspan(BackColor, ForeColor);
									var dnow = <?php echo time()?>;
									if(CountStepper>0)
									  ddiff = new Date(dnow-dthen);
									else
									  ddiff = new Date(dthen-dnow);
									gsecs = Math.floor(ddiff);
									CountBack(gsecs);
									</script>
									<?php echo LOGIN_SERVER_START2; ?>
								</div>
								<div class="clear">&nbsp;</div>
								</div>
							<div class="clear"></div>
					</div>
						<div class="contentFooter">&nbsp;</div>
					</div>
						<div id="sidebarAfterContent" class="sidebar afterContent">
                        
<?php if(NEWSBOX1) { ?>
	<div id="sidebarBoxNews1" class="sidebarBox   sidebarBoxNews">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header noHeader"></div>
			<div class="innerBox content">
		<div class="news news1"><?php include("Templates/News/newsbox1.tpl"); ?></div>
		</div>
			<div class="innerBox footer">	 
			</div>
		</div>
	</div>
<?php } ?>

<?php if(NEWSBOX2) { ?>
<div id="sidebarBoxNews2" class="sidebarBox   sidebarBoxNews">

	<div class="sidebarBoxBaseBox">
		<div class="baseBox baseBoxTop">
			<div class="baseBox baseBoxBottom">
				<div class="baseBox baseBoxCenter"></div>
			</div>
		</div>
	</div>
	<div class="sidebarBoxInnerBox">
		<div class="innerBox header noHeader"></div>
		<div class="innerBox content">
	<div class="news news2"><?php include("Templates/News/newsbox2.tpl"); ?></div>
	</div>
		<div class="innerBox footer">
				 
		</div>
	</div>
</div>
<?php } ?>
		</div>
					</div>
					
					<?php
					include("Templates/footer.tpl");
					?>
				</div>
				<div id="ce"></div></div></div></div>
			
</body>
</html>
