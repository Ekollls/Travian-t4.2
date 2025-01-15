<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
error_reporting(0);
include("GameEngine/Account.php");
$uname = $_SESSION['username'];
$uid = $database->getUserField($uname,"id",true);
$settedup = $database->getUserField($uname,"settedup",true);
if($settedup == "yes") { header("Location: dorf1.php");exit(); };
if($uid <= 4) { header("Location: dorf1.php");exit(); };


if ( ( time() - $database->getUserField($uname,"activateat",true) ) < 1*24*60*60 ) {
	$ok = "ok";
}

if($session->access >= 8) {
	$ok = "ok";
}

if(!$ok=="ok") {
	header("Location: dorf1.php");
}

if (isset($_POST['vid']) && $_POST['vid'] > 0 && $_POST['vid'] < 4) {
	$t=$_POST['vid'];
	mysql_query("update s1_users set tribe='$t' where id='$uid'");
}
if (isset($_POST['sector'])) {
	$sector;
	switch($_POST['sector']) {
		default: $sector = "1"; break;
		case "ne": $sector = "3"; break;
		case "nw": $sector = "4"; break;
		case "sw": $sector = "1"; break;
		case "se": $sector = "2"; break;
	}
	mysql_query("update s1_users set settedup='yes' where id='$uid'");
	$account->generateBase($sector,$uid,$uname,1);
	mysql_query("update s1_users set location='$sector' where id='$uid'");
	$database->modifyUnit($database->getVFH($uid), 'hero', 1, 1);
	$database->modifyHero($uid, 0,'wref', $database->getVFH($uid), 0);



}

$ta = array(array(first_page_tribe2_lead,first_page_tribe2),array(first_page_tribe1_lead,first_page_tribe1),array(first_page_tribe3_lead,first_page_tribe3));
$tribe = $database->getUserField($uname,"tribe",true);
$location = $database->getUserField($uname,"location",true);


if($tribe>0) {
	if (!$location>0) {
		$page = 2; 
		$title = first_page_second_step_desc1;
	}else{
		//$page = 3;
		//$title = "شما آماده بازی هستید!";
		if (!isset($_GET['ct'])) {
			header("Location: dorf1.php");
		}
	}
}else{
	$page = 1;
	$title = first_desc1;
}

if ( $ok=="ok" ) {
	if(isset($_GET['ct'])) {
		$page = 1;
		$title = first_desc1;
	}
}




?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo SERVER_NAME ?></title>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="content-type"	content="text/html; charset=UTF-8" />
		<meta name="content-language" content="ir" />
		<link href="first/a/a.css?8b796" rel="stylesheet" type="text/css">
        <link href="first/a/b.css?8b796" rel="stylesheet" type="text/css">
				
<script type="text/javascript" src="first/a/crypt.js?1375525830"></script>	<script type="text/javascript">
		Travian.Translation.add(
		{
			'allgemein.anleitung':	'دستورالعمل',
			'allgemein.cancel':	'لغو',
			'allgemein.ok':	'تایید',
			'cropfinder.keine_ergebnisse': 'چیزی مطابق جستجوی شما پیدا نشد.'
		});
		Travian.applicationId = 'T4.0 Game';
		Travian.Game.version = '4';
		Travian.Game.worldId = 'tx10';
		Travian.Game.speed = 10;
    </script>
    <script type="text/javascript">
		Travian.Game.eventJamHtml = '&lt;a href=&quot;http://t4.answers.travian.ir/index.php?aid=249#go2answer&quot; target=&quot;blank&quot; title=&quot;پاسخ&zwnj;های تراوین&quot;&gt;&lt;span class=&quot;c0 t&quot;&gt;0:00:0&lt;/span&gt;?&lt;/a&gt;'.unescapeHtml();
	</script>
</head>
<body class="v35 webkit chrome login">
	<div id="wrapper">
		<img id="staticElements" src="img/x.gif" alt="">
		<div class="bodyWrapper">
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="">
			<div id="header">
				<div id="mtop">
                	<a id="logo" href="http://mersad_mr@att.net/" target="_blank"></a>
					<div id="myGameLinkHeaderWrapper"></div>
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
	
                <div class="clear"></div>
                <div id="contentOuterContainer">
                    <div class="contentTitle">&nbsp;</div>
                    <div class="contentContainer">
                        <div id="content" class="activate">
                        
<h1 class="titleInHeader"><?php echo $title;?></h1>
<!--- CONTENT ---->
<?php
switch($page) {
	case 1: {
		// tribe selection
		?>


<div id="vid">
	<div class="ffBug"></div>
	<div class="greenbox boxVidInfo ">
		<div class="greenbox-top"></div>
		<div class="greenbox-content"><?=first_desc2?></div>
		<div class="greenbox-bottom"></div>
		<div class="clear"></div>
	</div>
	<div class="boxes boxGrey boxesColor gray">
        <div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
		<div class="boxes-contents cf">
        	<div class="content">
			<form method="post" action="first.php">
				<input type="hidden" name="vid" value="3">
				<div class="container">
					<div class="vidDescription"><?=first_desc3?><br><?=first_desc4?></div>
					<div class="vidSelect">
						<div class="kind">
							<div id="vid3" class="vid vid3 vid3Active"></div>
							<div id="vid1" class="vid vid1 "></div>
							<div id="vid2" class="vid vid2"></div>
						</div>
						<div class="description-container">
                            <div class="description vid1 vid1Highlight" style="display: none; ">
                                <div class="bubble"></div>
                                <div class="text">
                                    <div class="headline"><?=first_page_tribe1?></div>
                                    <div class="text">
                                        <div class="special"><?=first_Gauls_desc2?></div>
										<ul>
											<li><?=first_Roman_desc3?><br></li>
                                            <li><?=first_Roman_desc4?><br></li>
                                            <li><?=first_Roman_desc5?></li>
                                            <li><?=first_Roman_desc6?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="avatar vid1 vid1Highlight"></div>
                            </div>							
                            <div class="description vid2 vid2Highlight" style="display: none; ">
                                <div class="bubble"></div>
                                <div class="text">
                                    <div class="headline"><?=first_Teutons_desc1?></div>
                                    <div class="text">
                                        <div class="special"><?=first_Gauls_desc2?></div>
                                        <ul>
											<li><?=first_Teutons_desc3?><br></li>
                                            <li><?=first_Teutons_desc4?></li>
                                            <li><?=first_Teutons_desc5?></li>
										</ul>
									</div>
								</div>
								<div class="avatar vid2"></div>
							</div>							
                            <div class="description vid3 vid3Active" style="display: block;">
                                <div class="bubble"></div>
                                <div class="text">
                                    <div class="headline"><?=first_Gauls_desc1?></div>
                                    <div class="text">
                                        <div class="special"><?=first_Gauls_desc2?></div>
										<ul>
                                            <li><?=first_Gauls_desc3?><br></li>
                                            <li><?=first_Gauls_desc4?><br></li>
                                            <li><?=first_Gauls_desc5?><br></li>
                                            <li><?=first_Gauls_desc6?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="avatar vid3 vid3Active"></div>
                            </div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="submitButton">
					<button type="submit" value="<?=first_desc1?>" name="submitKind" id="submitKind"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?=first_desc1?></div></div></button>
				</div>
			</form>
		</div>
	</div>
</div>
</div> 
<script type="text/javascript">
	var vid = new Travian.Game.Vid('vid3');
</script>       <?php
		
		
		break;
	}
	case 2: {
		// location selection
		?>
        
        
        <div id="sector">
	<form method="post" action="first.php">
		<div class="ffBug"></div>
	
		<div class="greenbox boxVidInfo">
			<div class="greenbox-top"></div>
            			<div class="greenbox-content"><?=sprintf(first_Gauls_chosen_desc1,$ta[$tribe-1][1],$ta[$tribe-1][0]);?><!--شما نژاد <?=$ta[$tribe-1][1]?> ها را انتخاب کردید. از این به بعد <?=$ta[$tribe-1][0]?> راهنمای شما خواهد بود.-->
				<div class="changeVid"><a href="?ct"><?=first_page_second_step_desc2?></a></div>
			</div>
			<div class="greenbox-bottom"></div>
			<div class="clear"></div>
		</div>
		<div class="boxes boxGrey boxesColor gray">
			<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
			<div class="boxes-contents cf">
            	<div class="content">
					<div class="sectorDescription"><?=first_page_second_step_desc3?></div>
					<div class="sectorSelect">
                        <div class="map">
                            <div id="nw" class="sector nw a"><div class="highlight "></div></div>
                            <div id="ne" class="sector ne a"><div class="highlight active"></div></div>
                            <div id="sw" class="sector sw a"><div class="highlight "></div></div>
                            <div id="se" class="sector se a"><div class="highlight "></div></div>
                            <div class="clear"></div>
                        </div>
                        <div class="start">
							<div class="center">
				    			<select name="sector">
									<option value="nw"><?=first_page_second_step_desc4?></option>
				    				<option value="ne"><?=first_page_second_step_desc5?></option>
									<option value="sw"><?=first_page_second_step_desc6?></option>
									<option value="se"><?=first_page_second_step_desc7?></option>
								</select>
							</div>
						</div>
						<div class="buttonContainer">
							<button type="submit" value="<?=first_page_second_step_desc8?>" name="submitSector" id="submitSector" class="submitSector"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?=first_page_second_step_desc8?></div></div></button>
						</div>
						<div class="clear"></div>
					</div>
					<div class="avatar vid<?=$tribe?>"></div>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	var sector = new Travian.Game.Sector('ne');
</script>
        
        
        <?php
		
		
		
		
		break;
	}
	case "3": {
		
		
		
		
		break;
	}
}
?>
<!--- /CONTENT ---->

	
<div id="tpixeliframe_loading" style="z-index: 1000; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; background-color: rgb(0, 0, 0); opacity: 0.4; display: none; "></div>
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

        
				<?php
				//include("Templates/footer.tpl");
				?>
															</div>

			<div id="ce"></div>
														</div>

			</body>
</html>