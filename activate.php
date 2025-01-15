<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : 20script.ir
/
*/
include("GameEngine/Protection.php");
include("GameEngine/Account.php");
if(isset($_GET['del_cookie'])) {
	setcookie("COOKUSR","",time()-3600*24,"/");
	header("Location: login.php");
}
if(!isset($_COOKIE['COOKUSR'])) {
	$_COOKIE['COOKUSR'] = "";
}
include "Templates/html.tpl";
?>
<body class="v35 webkit chrome logout">
	<div id="background">
		<img id="staticElements" src="img/x.gif" alt=""/>
                <link rel="canonical" href="http://www.20script.ir" />
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
		<a href="/" target="_blank">صفحه اصلی</a>
	</li>

	<li class="active">
		<a href="login.php">ورود</a>
	</li>

	<li>
		<a href="anmelden.php" target="_blank">ثبت نام</a>
	</li>

	<li>
		<a href="#" target="_blank">انجمن</a>
	</li>

	<li>
		<a href="#">پشتیبانی</a>
	</li>

</ul>
				</div>
				</div></div></div>
				<div id="contentOuterContainer">
					<div class="contentTitle">&nbsp;</div>
					<div class="contentContainer">
								<div id="content" class="activate">


<h1 class="titleInHeader"><?php echo REG; ?></h1>

<?php
if(isset($_GET['e']) && !is_numeric($_GET['e'])) $_GET['e'] = 1;
if(isset($_GET['e'])) {
	switch($_GET['e']) {
		case 1:
		include("Templates/activate/delete.tpl");
		break;
		case 2:
		include("Templates/activate/activated.tpl");
		break;
		case 3:
		include("Templates/activate/cantfind.tpl");
		break;
	}
} else if(isset($_GET['id']) && isset($_GET['c'])) {
	if(isset($_GET['id']) && !is_numeric($_GET['id'])) die('Attempt of sql injection blocked');
	$c=$database->getActivateField($_GET['id'],"email",0);
	if($_GET['c'] == $generator->encodeStr($c,5)){
		include("Templates/activate/delete.tpl");
	} else { include("Templates/activate/activate.tpl"); }
} else {
include("Templates/activate/activate.tpl");
}


?>
<div class="clear">&nbsp;</div></div>
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
