<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include('GameEngine/config.php');
include('GameEngine/database.php');
include "Templates/html.tpl";
include('GameEngine/lang/'.$_SESSION['lang'].'.php');
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
?>
<body class="v35 webkit chrome activate">
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

						<li class="active">
							<a href="login.php" title="<?php echo LOGIN; ?>"><?php echo LOGIN; ?></a>
						</li>

						<li>
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
								<div id="content" class="activate">
<h1 class="titleInHeader"><?php echo LOGIN; ?></h1>
<div id="passwordForgotten">
<?php
$npw = $_GET['npw'];
$act = $_GET['code'];
$user = $_GET['user'];
$pagehide = false;
if($database->checkExist($user, 0)){
	$getUser = $database->getUser($user, 0);
    $getProc = $database->getNewProc($getUser['id']);
    if($npw == $getProc['npw']){
    	if($act == $getProc['act']){
        	$newPassword = md5($npw);
        	$database->updateUserField($user, password, $newPassword, 0);
            $database->editTableField('newproc', 'proc', 1, 'uid', $getUser['id']);
			echo JR_PASSCHANGESUCCESS.'<br /><br />'.JR_PASSFOLLOW.'<a class="a arrow" href="login.php?user='.$user.'&pw='.$npw.'">'.LOGIN.'</a>';
			$database->removeProc($getUser['id']);
        }else{
        	echo '<font color="#FF0000">'.JR_PASSWRONGCODE.'</font>';
        }
    }else{
        	echo '<font color="#FF0000">'.JR_PASSWRONG.'</font>';
        }
}else{
	echo '<font color="#FF0000">'.JR_PASSNOTAUSER.'</font>';
}
?>

</div>
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
