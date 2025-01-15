<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include('GameEngine/Account.php');
if(isset($_COOKIE['lang']) and $_COOKIE['lang']!='')$_SESSION['lang'] = $_COOKIE['lang'];
$conf = $database->config();
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome signup perspectiveBuildings">
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
							<a href="<?php echo HOMEPAGE; ?>" title="<?php echo HOME; ?>"><?php echo HOME; ?></a>
						</li>

						<li>
							<a href="login.php" title="<?php echo LOGIN; ?>"><?php echo LOGIN; ?></a>
						</li>

						<li class="active">
							<a href="anmelden.php" title="<?php echo REG; ?>"><?php echo REG; ?></a>
						</li>

						<li>
							<a href="<?php echo FORUM_LINK;?>" target="_blank" title="<?php echo FORUM; ?>"><?php echo FORUM; ?></a>
						</li>
						<li>
							<label for="sellang" class="lsMl">Language:</label>
							<select name="sellang" id="sellang" onchange="changeLanguage();">
								<option value="en" <?php if ($_SESSION['lang']=='en') echo 'selected="selected"';?>>English</option>
								<option value="fa" <?php if ($_SESSION['lang']=='fa') echo 'selected="selected"';?>>فارسی</option>
							</select>
						</li>
					</ul>
				</div>
				</div></div></div>
				<div id="contentOuterContainer">
					<div class="contentTitle">&nbsp;</div>
					<div class="contentContainer">
								<div id="content" class="signup"><h1 class="titleInHeader"><?php echo REG; ?></h1>
<?php if(REG_OPEN == true){ ?>
		<h4 class="round"><?php echo REGISTER_USERINFO; ?></h4>
		<form name="snd" method="post" action="anmelden.php">
		<input type="hidden" name="ft" value="a1" />
		<?php if(isset($_GET['anc']) && $_GET['anc']!='') { echo '<input type="hidden" name="anc" value="'.$_GET['anc'].'" />';}?>
			<table cellpadding="1" cellspacing="1" id="sign_input" class="transparent">
			<tbody>
				<tr class="top">
					<th><label for="userName"><?php echo REGISTER_USERNAME; ?></label></th>
					<td>
						<input id="userName" class="text" type="text" name="name" value="<?php echo $form->getValue('name'); ?>" maxlength="15" />
						<span class="error"><?php echo $form->getError('name'); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="userEmail"><?php echo REGISTER_EMAIL; ?></label></th>
					<td>
						<input id="userEmail" class="text" type="text" name="email" value="<?php echo $form->getValue('email'); ?>" maxlength="40" />
						<span class="error"><?php echo $form->getError('email'); ?></span>
					</td>
				</tr>
				<tr class="btm">
					<th><label for="userPassword"><?php echo REGISTER_PASSWORD; ?></label></th>
					<td>
						<input id="userPassword" class="text" type="password" name="pw" value="<?php echo $form->getValue('pw'); ?>" maxlength="20" />
						<span class="error"><?php echo $form->getError('pw'); ?></span>
					</td>
				</tr>
			</tbody>
		</table>


	
			<h4 class="round"><?php echo REGISTER_MOREINFO; ?></h4>
			<div class="checks">
				<input class="check" type="checkbox" id="agb" name="agb" value="1" <?php echo $form->getRadio('agb',1); ?>/>
				<label for="agb"><?php echo ACCEPT_RULES; ?></label>
			</div>
        <ul class="important">
<?php
echo $form->getError('tribe');
echo $form->getError('agree');
?>
		</ul>
		<div class="btn">
        <input type="hidden" name="vid" value="0">
        <input type="hidden" name="kid" value="0">
			<button type="submit" value="anmelden" name="s1" class="green "  id="btn_signup" title="Register">
	<div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo REG; ?></div>
	</div>
            </button>
		</div>
	</form>
    <div class="clear">&nbsp;</div>
<?php }else{ ?>
<p><?php echo REGISTER_CLOSED; ?></p>
<?php } ?>   
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
