<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include("GameEngine/Village.php");
$start = $generator->pageLoadTimeStart();
include "Templates/html.tpl";

if(isset($_POST['HeroFace'])){
	$face = intval($_POST['HeroFace']);
	$color = intval($_POST['color']);
	$hair = intval($_POST['HeroHair']);
	$ear = intval($_POST['HeroEar']);
	$eyebrow = intval($_POST['HeroEyebrow']);
	$eye = intval($_POST['HeroEye']);
	$nose = intval($_POST['HeroNose']);
	$mouth = intval($_POST['HeroMouth']);
	$beard = intval($_POST['HeroBeard']);
	$database->modifyWholeHeroFace($session->uid,$face,$color,$hair,$ear,$eyebrow,$eye,$nose,$mouth,$beard);
	
	$gender = intval($_POST['HeroGender']);
	$database->editTableField('heroface', 'gender', $gender, 'uid', $session->uid);
	//Zoltán
	header("Location: hero.php");
}

if(@$_GET['genRand']) {
	$database->modifyWholeHeroFace($session->uid,mt_rand(0,4),mt_rand(0,4),mt_rand(0,4),mt_rand(0,4),mt_rand(0,4),mt_rand(0,4),mt_rand(0,4),mt_rand(0,3),mt_rand(0,5),0);
	header("Location: hero.php");	
}

?>
<body class="v35 gecko hero">
<script type="text/javascript">
			window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
		</script>
	<div id="background"> 
			<div id="headerBar"></div>
			<div id="bodyWrapper"> 
				<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> 
				<div id="header"> 

<?php 
	include("Templates/topheader.tpl");
	include("Templates/toolbar.tpl");

?>

	</div>
	<div id="center">
		<a id="ingameManual" href="help.php">
		<img class="question" alt="Help" src="img/x.gif">
		</a>

		<?php include("Templates/sideinfo.tpl"); ?>

		<div id="contentOuterContainer"> 

		<?php include("Templates/res.tpl"); ?>
							<div class="contentTitle">&nbsp;</div> 
							<div class="contentContainer"> 
								<div id="content" class="hero_editor"><h1 class="titleInHeader"><?php echo U0; ?></h1>

<div class="contentNavi subNavi">
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_inventory.php"><span class="tabItem"><?php echo JR_HEROATTRIBUTES; ?></span></a></div>
				</div>
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero.php"><span class="tabItem"><?php echo JR_HEROAPPEARANCE; ?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_adventure.php"><span class="tabItem"><?php echo JR_HEROADVENTURE; ?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php"><span class="tabItem"><?php echo JR_HEROAUCTION; ?></span></a></div>
				</div><div class="clear"></div>
		</div><script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
					
				</script>
<?php
$herodetail = $database->getHeroFace($session->uid);
if($herodetail['color']==0){
	$color = "black";
}
if($herodetail['color']==1){
	$color = "brown";
}
if($herodetail['color']==2){
	$color = "darkbrown";
}
if($herodetail['color']==3){
	$color = "yellow";
}
if($herodetail['color']==4){
	$color = "red";
}
if($herodetail['gender']==0) {$gstr='male';} else {$gstr='female';}
$gender=$herodetail['gender'];
$geteye = $herodetail['eye'];if ($gender==0) $geteye%=5;
$geteyebrow = $herodetail['eyebrow'];if ($gender==0) $geteyebrow%=5;
$getnose = $herodetail['nose'];if ($gender==0) $getnose%=5;
$getear = $herodetail['ear'];if ($gender==0) $getear%=5;
$getmouth = $herodetail['mouth'];if ($gender==0) $getmouth%=4;
$getbeard = $herodetail['beard']; if ($gender==1) $getbeard=5;
$gethair = $herodetail['hair'];if ($gender==0) $gethair%=5;
$getface = $herodetail['face'];if ($gender==0) $getface%=5;


?>
<div id="heroEditor" class="genderSwitch <?php echo $gstr; ?>">
	<div class="hero_head head">
		<div class="tl"><div class="tr"></div></div>
		<div class="bl"><div class="br"></div></div>
		<div class="image">
			<img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/face0.png" alt="" />
			<img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/eye/eye<?php echo $geteye; ?>.png" alt="" />
			<img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/eyebrow/eyebrow<?php echo $geteyebrow.(($gender==0)?'-'.$color:''); ?>.png" alt="" />
			<?php if(!($gender==0 && $gethair==5)){ ?><img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/hair/hair<?php echo $gethair.'-'.$color; ?>.png" alt="" /><?php } ?>
			<img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/face/face<?php echo $getface; ?>.png" alt="" />
			<img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/mouth/mouth<?php echo $getmouth; ?>.png" alt="" />
			<img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/nose/nose<?php echo $getnose; ?>.png" alt="" />
			<img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/ear/ear<?php echo $getear; ?>.png" alt="" />
			<?php if($getbeard!=5){ ?><img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/beard/beard<?php echo $getbeard.'-'.$color; ?>.png" alt="" /><?php } ?>
		</div>
	</div>
	<div class="attributes">
		<div class="boxes boxesColor gender gray">
			<div class="boxes-tl"></div>
			<div class="boxes-tr"></div>
			<div class="boxes-tc"></div>
			<div class="boxes-ml"></div>
			<div class="boxes-mr"></div>
			<div class="boxes-mc"></div>
			<div class="boxes-bl"></div>
			<div class="boxes-br"></div>
			<div class="boxes-bc"></div>
			<div class="boxes-contents cf">		
				<div class="gender-container cf">
					<div class="info">
						<div class="headline">
							<div class="title"><?php echo GENDER;?></div>
						</div>
						<div id="genderButtons">
								<button <?php if($herodetail['gender']==0){ echo "class=\"icon iconActive disabled\"";} else { echo "class='icon' onclick=\"$('HeroEditorForm').HeroGender.value='0'; $('HeroEditorForm').submit(); return false;\" ";}?> id="heroEditorActivateMale" value="heroEditorActivateMale" type="button">
									<img alt="heroEditorActivateMale" class="heroEditorActivateMale" src="img/x.gif">
								</button>
								<button <?php if($herodetail['gender']==1){ echo "class=\"icon iconActive disabled\"";} else { echo "class='icon' onclick=\"$('HeroEditorForm').HeroGender.value='1'; $('HeroEditorForm').submit(); return false;\" ";}?> id="heroEditorActivateFemale" value="heroEditorActivateFemale" type="button">
									<img alt="heroEditorActivateFemale" class="heroEditorActivateFemale" src="img/x.gif">
								</button>							
						</div>
					</div>
				</div>
			</div>
		</div>		


	<div class="boxes boxesColor gray">
		<div class="boxes-tl"></div>
		<div class="boxes-tr"></div>
		<div class="boxes-tc"></div>
		<div class="boxes-ml"></div>
		<div class="boxes-mr"></div>
		<div class="boxes-mc"></div>
		<div class="boxes-bl"></div>
		<div class="boxes-br"></div>
		<div class="boxes-bc"></div>
		<div class="boxes-contents cf">		
			<div class="container cf" id="attributesContainer">
				<div class="info" id="headProfile">
					<div class="headline switchClosed">
						<a href="#" class="title"><?php echo JR_HEROHEAD; ?></a>
						<div class="clear"></div>					
					</div>
					<div class="details">
						<img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face0.png" alt=""/>
						<img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face1.png" alt=""/>
						<img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face2.png" alt=""/>
						<img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face3.png" alt=""/>
						<img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face4.png" alt=""/>
						<?php if ($herodetail['gender']==1) {?>	
							<img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face5.png" alt=""/>
						<?php } ?>
						<div class="clear"></div>
					</div>
				</div>
				<div class="info" id="hairColor">
					<div class="headline switchClosed">
						<a href="#" class="title"><?php echo JR_HEROHAIRCOLOR; ?></a>
						<div class="clear"></div>
					</div>
					<div class="details">
						<img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").color.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color0.png" alt=""/>
						<img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").color.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color1.png" alt=""/>
						<img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").color.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color2.png" alt=""/>
						<img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").color.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color3.png" alt=""/>
						<img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").color.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color4.png" alt=""/>
						<div class="clear"></div>
					</div>
				</div>
				<div class="info" id="hairStyle">
					<div class="headline switchClosed">
						<a href="#" class="title"><?php echo JR_HEROHAIRSTYLE; ?></a>
						<div class="clear"></div>
					</div>
					<div class="details">
						<img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair0.png" alt=""/>
						<img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair1.png" alt=""/>
						<img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair2.png" alt=""/>
						<img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair3.png" alt=""/>
						<img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair4.png" alt=""/>
                    <?php if($herodetail['gender']==0) {?>
						<img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hairNone.png" alt=""/>
					<?php }?>
                   <?php if ($herodetail['gender']==1) {?>			
						<img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair5.png" alt=""/>
				   <?php } ?>
						<div class="clear"></div>
					</div>
				</div>
			
				<div class="info" id="ears">
					<div class="headline switchClosed">
						<a href="#" class="title"><?php echo JR_HEROEARS; ?></a>
						<div class="clear"></div>
					</div>
					<div class="details">
						<img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear0.png" alt=""/>
						<img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear1.png" alt=""/>
						<img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear2.png" alt=""/>
						<img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear3.png" alt=""/>
						<img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear4.png" alt=""/>
						<?php  if ($herodetail['gender']==1) {?>						
							<img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear5.png" alt=""/>
							<img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear6.png" alt=""/>
							<img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear7.png" alt=""/>
						<?php } ?>
						<div class="clear"></div>
					</div>
				</div>
			
				<div class="info" id="eyebrow">
					<div class="headline switchClosed">
						<a href="#" class="title"><?php echo JR_HEROEYEBROWS; ?></a>
						<div class="clear"></div>
					</div>
					<div class="details">
						<img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow0.png" alt=""/>
						<img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow1.png" alt=""/>
						<img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow2.png" alt=""/>
						<img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow3.png" alt=""/>
						<img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow4.png" alt=""/>
                    <?php
					if ($herodetail['gender']==1) {?>
						<img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow5.png" alt=""/>
						<img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow6.png" alt=""/>
						<img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow7.png" alt=""/>
						<img id="attribute_button_8" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="8";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow8.png" alt=""/>
						<img id="attribute_button_9" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="9";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow9.png" alt=""/>
						<?php } ?>
						<div class="clear"></div>
					</div>
				</div>
			
				<div class="info" id="eyes">
					<div class="headline switchClosed">
						<a href="#" class="title"><?php echo JR_HEROEYES; ?></a>
						<div class="clear"></div>
					</div>
					<div class="details">
						<img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye0.png" alt=""/>
						<img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye1.png" alt=""/>
						<img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye2.png" alt=""/>
						<img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye3.png" alt=""/>
						<img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye4.png" alt=""/>
                    <?php if ($herodetail['gender']==1) {?>	
						<img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye5.png" alt=""/>
						<img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye6.png" alt=""/>
						<img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye7.png" alt=""/>
						<img id="attribute_button_8" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="8";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye8.png" alt=""/>
						<img id="attribute_button_9" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="9";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye9.png" alt=""/>
						<?php } ?>
						<div class="clear"></div>
					</div>
				</div>
			
				<div class="info" id="nose">
					<div class="headline switchClosed">
						<a href="#" class="title"><?php echo JR_HERONOSE; ?></a>
						<div class="clear"></div>
					</div>
					<div class="details">
						<img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose0.png" alt=""/>
						<img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose1.png" alt=""/>
						<img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose2.png" alt=""/>
						<img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose3.png" alt=""/>
						<img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose4.png" alt=""/>
                    <?php if ($herodetail['gender']==1) {?>	
						<img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose5.png" alt=""/>
						<img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose6.png" alt=""/>
						<img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose7.png" alt=""/>
						<?php } ?>
						<div class="clear"></div>
					</div>
				</div>
			
				<div class="info" id="mouth">
					<div class="headline switchClosed">
						<a href="#" class="title"><?php echo JR_HEROMOUTH; ?></a>
						<div class="clear"></div>
					</div>
					<div class="details">
						<img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth0.png" alt=""/>
						<img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth1.png" alt=""/>
						<img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth2.png" alt=""/>
						<img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth3.png" alt=""/>
                    <?php if ($herodetail['gender']==1) {?>
						<img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth4.png" alt=""/>
						<img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth5.png" alt=""/>
						<img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth6.png" alt=""/>
						<img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth7.png" alt=""/>
						<img id="attribute_button_8" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="8";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth8.png" alt=""/>
					<?php } ?>
						<div class="clear"></div>
					</div>
				</div>
			<?php if($herodetail['gender']==0) { ?>
			
				<div class="info" id="beard">
					<div class="headline switchClosed">
						<a href="#" class="title"><?php echo JR_HEROBEARD; ?></a>
						<div class="clear"></div>
					</div>
					<div class="details">
						<img id="attribute_button_5000" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard0.png" alt=""/>
						<img id="attribute_button_5001" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard1.png" alt=""/>
						<img id="attribute_button_5002" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard2.png" alt=""/>
						<img id="attribute_button_5003" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard3.png" alt=""/>
						<img id="attribute_button_5004" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard4.png" alt=""/>
						<img id="attribute_button_5999" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beardNone.png" alt=""/>
						<div class="clear"></div>
					</div>
				</div>
					<?php } ?>				
			</div>
		</div>
	</div>
		<div class="options">
		<form id="HeroEditorForm" method="post">
        		<button type="button" value="" name="" id="btn_login" style="float:right;" class="green " onClick="window.location='hero.php?genRand=yes'">
        	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">تصادفی</div></div>
        </button>

		<button type="submit" value="save" name="save" id="btn_login" style="float:left;" class="green " onClick="document.snd.attributes.value=screen.width+':'+screen.height;">
        	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo JR_SAVE; ?></div></div>
        </button>
		<input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />
		<input type="hidden" name="HeroFace" value="<?php echo $herodetail['face']; ?>" />
		<input type="hidden" name="color" value="<?php echo $herodetail['color']; ?>" />
		<input type="hidden" name="HeroHair" value="<?php echo $herodetail['hair']; ?>" />
		<input type="hidden" name="HeroEar" value="<?php echo $herodetail['ear']; ?>" />
		<input type="hidden" name="HeroEyebrow" value="<?php echo $herodetail['eyebrow']; ?>" />
		<input type="hidden" name="HeroEye" value="<?php echo $herodetail['eye']; ?>" />
		<input type="hidden" name="HeroNose" value="<?php echo $herodetail['nose']; ?>" />
		<input type="hidden" name="HeroMouth" value="<?php echo $herodetail['mouth']; ?>" />
		<input type="hidden" name="HeroBeard" value="<?php echo $herodetail['beard']; ?>" />
		<input type="hidden" name="HeroGender" value="<?php echo $herodetail['gender']; ?>" />
        </form>
    </div>

	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	new Travian.Game.Hero.Editor(
	{
		element: 'heroEditor',
		command: 'heroEditor',
		urlHeroImage: 'hero_image.php?uid=<?php echo $session->uid; ?>&amp;size=sideinfo&amp;{time}',
		attributes: {"headProfile":<?php echo $herodetail['face']; ?>,"hairColor":<?php echo $herodetail['color']; ?>,"hairStyle":<?php echo $herodetail['hair']; ?>,"ears":<?php echo $herodetail['ear']; ?>,"eyebrow":<?php echo $herodetail['eyebrow']; ?>,"eyes":<?php echo $herodetail['eye']; ?>,"nose":<?php echo $herodetail['nose']; ?>,"mouth":<?php echo $herodetail['mouth']; ?>,"beard":<?php echo $herodetail['beard']; ?>,"gender":"<?php echo $gstr; ?>"},
		elementHeroImage: 'heroImage'
	});
</script>								



<div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>


</div>
<div class="contentFooter">&nbsp;</div>

					</div>
<?php  
include("Templates/rightsideinfor.tpl");		
?>
				<div class="clear"></div>
</div>
<?php 
include("Templates/footer.tpl"); 
include("Templates/header.tpl");
?>
</div>
<div id="ce"></div>
</div>
</body>
</html>

