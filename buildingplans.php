<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include("GameEngine/Database/connection.php");
include("GameEngine/config.php");
if(!isset($_SESSION['lang'])){
$_SESSION['lang']='en';
}
include("GameEngine/Lang/".$_SESSION['lang'].".php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo SERVER_NAME ?></title>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="content-type"	content="text/html; charset=UTF-8" />
		<meta name="content-language" content="<?php echo $_SESSION['lang']; ?>" />
				<link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/compact.css?asd423" rel="stylesheet" type="text/css" /><link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/lang.css?asd423" rel="stylesheet" type="text/css" />				<link href="img/travian_basics.css" rel="stylesheet" type="text/css" />
							<script src="AC_OETags.js?asd423" type="text/javascript"></script>
				<script type="text/javascript" src="crypt.js?1336748301"></script>
<script type="text/javascript">
Travian.Translation.add(
{
	'allgemein.anleitung':	'Instrucţiuni',
	'allgemein.cancel':	'anulează',
	'allgemein.ok':	'OK',
	'cropfinder.keine_ergebnisse': 'Nici un rezultat găsit'
});
Travian.applicationId = 'T4.0 Game';
Travian.Game.version = '4.0';
Travian.Game.worldId = 'rox18';
Travian.Game.speed = 3;
</script>						<script type="text/javascript">
			Travian.Game.eventJamHtml = '&lt;a href=&quot;http://answers.t4dl.ir/index.php?aid=256#go2answer&quot; target=&quot;blank&quot; title=&quot;Travian Answers&quot;&gt;&lt;span class=&quot;c0 t&quot;&gt;0:00:0&lt;/span&gt;?&lt;/a&gt;'.unescapeHtml();
		</script>
					</head>
	<body class="v35 gecko village1">
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

								<div id="content" class="village1"><script type="text/javascript">
			window.addEvent("domready", function()
			{
				var body = $(document.body);
				var content = $("content");

				["village1","village2","map","statistics","reports","messages","build","alliance","a2b","village3","player","warsim","logout","signup","manual","admin","support","error_site","plus","forum","login","activate","banned_cn","cropfinder","hero_adventure","hero_auction","hero_inventory","hero_editor","support_form","hero_image","hero_body","loader","positionDetails","fatal_error","mygame_login","gidRessources","universal"].each(function(className)
				{
					if (body)
					{
						body.removeClass(className);
					}
					if (content)
					{
						content.removeClass(className);
					}
				});
				if (body)
				{
					body.addClass("");
				}
				if (content)
				{
					content.addClass("");
				}
			})
		</script><div id="sysmsg"><div style="width:450px; height:495px; padding: 35px 80px 90px 25px; background: url(http://www.travianmania.ro/images/scroll2.jpg) no-repeat;">
<center>
<h2><?php echo JR_CONSTRUCTION_PLANS_RELEASE_TITLE;?></h2>
<br/>
<p style="font-size:85%; text-align:justify; width:400px">
<?php echo JR_CONSTRUCTION_PLANS_RELEASE_DESC;?>
<br><img src="http://www.travianmania.ro/images/wwstart.png" alt="Minunea Lumii" width="170" height="137" style="float: right"></p>
<p style="font-size:85%; text-align:justify; width:400px">
<?php echo JR_CONSTRUCTION_PLANS_RELEASE_TREASURY_DESC;?>
<br/>
<?php echo JR_CONSTRUCTION_PLANS_RELEASE_MYTHS_DESC;?>
</p>
<p style="font-size:85%; text-align:justify; width:400px">
<?php echo JR_CONSTRUCTION_PLANS_RELEASE_DISCOVERED_DESC;?>
</p>
<p style="font-size:65%; text-align:justify; width:400px">
<?php echo JR_CONSTRUCTION_PLANS_RELEASE_LINK_DESC;?> <a href="<?php echo HOMEPAGE;?>"><?php echo JR_HERE;?></a>.
<br/><b><?php echo JR_TRAVIAN_TEAM;?></b></p>.
<p align="center"><a href="dorf1.php?ok=1">» <?php echo JR_CONTINUE;?> «</a></p><br> 
</center></div><script type="text/javascript">
			window.addEvent("domready", function()
			{
				var body = $(document.body);
				var content = $("content");

				["village1","village2","map","statistics","reports","messages","build","alliance","a2b","village3","player","warsim","logout","signup","manual","admin","support","error_site","plus","forum","login","activate","banned_cn","cropfinder","hero_adventure","hero_auction","hero_inventory","hero_editor","support_form","hero_image","hero_body","loader","positionDetails","fatal_error","mygame_login","gidRessources","universal"].each(function(className)
				{
					if (body)
					{
						body.removeClass(className);
					}
					if (content)
					{
						content.removeClass(className);
					}
				});
				if (body)
				{
					body.addClass("");
				}
				if (content)
				{
					content.addClass("");
				}
			})
		</script></div>								<div class="clear">&nbsp;</div>							</div>							<div class="clear"></div>
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
