<?php
set_time_limit(0); 
   include_once("GameEngine/Account.php");
if($session->access != ADMIN) { 
	echo "شما ادمين نيستيد لطفا تلاش نکنيد."; 
} 
else{
	include_once ("Templates/html.tpl");  
$myartekey = 0;
if(isset($_POST['btn1'])){
        function generateBase($kid, $uid, $username) {
        	global $database, $message;
        	if($kid == 0) {
        		$kid = rand(1, 4);
        	} else {
        		$kid = $_POST['kid'];
        	}

        	$wid = $database->generateBase($kid);
        	$database->setFieldTaken($wid);
        	$database->addVillage($wid, $uid, $username, 1);
        	$database->addResourceFields($wid, $database->getVillageType($wid));
        	$database->addUnits($wid);
        	$database->addTech($wid);
        	$database->addABTech($wid);
        	$database->updateUserField($uid, "access", USER, 1);
        	$message->sendWelcome($uid, $username);
        }
        $username = "Natars";
        $password = md5('123edcvfrtg' . rand(999999999999, 9999999999999999999999999) . 'asdfvbgtyhn');
        $email = "Natars@t4dl.ir";
        $tribe = 5;
        $uid = $database->getUserField($username, 'id', true);
        $wid = mysql_fetch_assoc(mysql_query("SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = $uid"));
        $q = "UPDATE " . TB_PREFIX . "vdata SET pop = " . rand(700, 950) . " WHERE owner = $uid";
        mysql_query($q) or die(mysql_error());
        $q2 = "UPDATE " . TB_PREFIX . "users SET access = 0 WHERE id = $uid";
        mysql_query($q2) or die(mysql_error());
        if(SPEED > 3) {
        	$speed = 5;
        } else {
        	$speed = SPEED;
        }
        $q3 = "UPDATE " . TB_PREFIX . "units SET u41 = " . (64700 * $speed) . ", u42 = " . (295231 * $speed) . ", u43 = " . (180747 * $speed) . ", u44 = " . (7 * $speed) . ", u45 = " . (364401 * $speed) . ", u46 = " . (217602 * $speed) . ", u47 = " . (2034 * $speed) . ", u48 = " . (1040 * $speed) . " , u49 = " . (1 * $speed) . ", u50 = " . (9 * $speed) . " WHERE vref = " . $wid['wref'] . "";
        mysql_query($q3) or die(mysql_error());
        $q4 = "UPDATE " . TB_PREFIX . "users SET desc2 = '$desc' WHERE id = $uid";
        mysql_query($q4) or die(mysql_error());
  
		
        function Artefact($uid, $type, $size, $art_name, $village_name, $desc, $effect, $img) {
        	global $database;
        	$kid = rand(1, 4);
        	$wid = $database->generateBase($kid);
        	$database->addArtefact($wid, $uid, $type, $size, $art_name, $desc, $effect, $img);
        	$database->setFieldTaken($wid);
        	$database->addVillage($wid, $uid, $village_name, '0');
        	$database->addResourceFields($wid, $database->getVillageType($wid));
        	$database->addUnits($wid);
        	$database->addTech($wid);
        	$database->addABTech($wid);
        	mysql_query("UPDATE " . TB_PREFIX . "vdata SET pop = " . rand(10, 200) . " WHERE wref = $wid");
        	mysql_query("UPDATE " . TB_PREFIX . "vdata SET name = '$village_name' WHERE wref = $wid");
        	if(SPEED > 3) {
        		$speed = 5;
        	} else {
        		$speed = SPEED;
        	}
        	if($size == 1) {
        		mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . ($_POST['troop1'] * $speed) . ", u42 = " . ($_POST['troop2'] * $speed) . ", u43 = " . ($_POST['troop3'] * $speed) . ", u44 = " . ($_POST['troop4'] * $speed) . ", u45 = " . ($_POST['troop5'] * $speed) . ", u46 = " . ($_POST['troop6'] * $speed) . ", u47 = " . ($_POST['troop7'] * $speed) . ", u48 = " . ($_POST['troop8'] * $speed) . " , u49 = " . ($_POST['troop9'] * $speed) . ", u50 = " . ($_POST['troop10'] * $speed) . " WHERE vref = " . $wid . "");
        		mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 10, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
        	} 
			elseif($size == 2) {
				$speed = 2 * $speed;
        		mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . ($_POST['troop1'] * $speed) . ", u42 = " . ($_POST['troop2'] * $speed) . ", u43 = " . ($_POST['troop3'] * $speed) . ", u44 = " . ($_POST['troop4'] * $speed) . ", u45 = " . ($_POST['troop5'] * $speed) . ", u46 = " . ($_POST['troop6'] * $speed) . ", u47 = " . ($_POST['troop7'] * $speed) . ", u48 = " . ($_POST['troop8'] * $speed) . " , u49 = " . ($_POST['troop9'] * $speed) . ", u50 = " . ($_POST['troop10'] * $speed) . " WHERE vref = " . $wid . "");
        		mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
        	} 
			elseif($size == 3) {
				$speed = 4 * $speed;
        		mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . ($_POST['troop1'] * $speed) . ", u42 = " . ($_POST['troop2'] * $speed) . ", u43 = " . ($_POST['troop3'] * $speed) . ", u44 = " . ($_POST['troop4'] * $speed) . ", u45 = " . ($_POST['troop5'] * $speed) . ", u46 = " . ($_POST['troop6'] * $speed) . ", u47 = " . ($_POST['troop7'] * $speed) . ", u48 = " . ($_POST['troop8'] * $speed) . " , u49 = " . ($_POST['troop9'] * $speed) . ", u50 = " . ($_POST['troop10'] * $speed) . " WHERE vref = " . $wid . "");
        		mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
        	}
        }  


	if(isset($_POST['arte2']) && ($_POST['arte2'] != 0)){ //راز های معماری
			$desc = "اين كتيبه دهكده شما را در برابر منجنيق و دژكوب مقاومتر مي سازد .";
			if($_POST['smallarte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه راز هاي معماري';
				$effect = '4x';
				for($i > 1; $i < $_POST['arte2']; $i++) {
					Artefact($uid, 2, 1, 'راز هاي معماري كوچك', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
				}
			}
			if($_POST['largearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه راز هاي معماري';
				$effect = '3x';
				for($i > 1; $i < 2; $i++) {
					Artefact($uid, 2, 2, 'راز هاي معماري بزرگ', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
				}			
			}
			if($_POST['uniqearte']){
		        unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه راز هاي معماري';
				$effect = '5x';
				for($i > 1; $i < 1; $i++) {
					Artefact($uid, 2, 3, 'راز هاي معماري منحصر به فرد', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
				}
			}
	}
	if(isset($_POST['arte3']) && ($_POST['arte3'] != 0)){ //احمق ها
			$desc = "اين كتيبه تاثير دفاعي ديوار هاي دهكده را برابر كاهش مي دهد .";
			if($_POST['smallarte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه دهكده احمق ها';
				$effect = '2x';
				for($i > 1; $i < $_POST['arte3']; $i++) {
					Artefact($uid, 3, 1, 'دهكده احمق ها كوچك', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
				}			
			}
			if($_POST['largearte']){
				/*
					این نوع کتیبه بزرگ نخواهد داشت.
				*/
			}
			if($_POST['uniqearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه دهكده احمق ها';
				$effect = '5x';
				for($i > 1; $i < 1; $i++) {
					Artefact($uid, 3, 3, 'دهكده احمق ها منحصر به فرد', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
				}				
			}
	}
	if(isset($_POST['arte4']) && ($_POST['arte4'] != 0)){ // چکمه خدایان
			$desc = "اين كتيبه سرعت حركت سرباز هاي شما را سريعتر مي سازد .";
			if($_POST['smallarte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه چکمه خدايان';
				$effect = '2x';
				for($i > 1; $i < $_POST['arte4']; $i++) {
					Artefact($uid, 4, 1, 'چكمه خدايان كوچك', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
				}
			}
			if($_POST['largearte']){
		        unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه چکمه خدايان';
				$effect = '1.5x';
				for($i > 1; $i < intval($_POST['arte4'] /2); $i++) {
					Artefact($uid, 4, 2, 'چكمه خدايان بزرگ', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
				}
			}
			if($_POST['uniqearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه چکمه خدايان';
				$effect = '3x';
				for($i > 1; $i < 1; $i++) {
					Artefact($uid, 4, 3, 'چكمه خدايان منحصر به فرد', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
				}				
			}
	}
	if(isset($_POST['arte5']) && ($_POST['arte5'] != 0)){ // چشمان عقاب
        $desc = "اين كتيبه جاسوس هاي شما را قوي تر مي سازد . همچنين جاسوس هاي مستقر در دهكده نيز قوي تر از قبل عمل مي كنند . به علاوه اينكه شما ميتوانيد نوع سرباز هايي كه در حال حمله به شما هستند را در اردوگاه تشخيص دهيد ولي قادر به تشخيص تعداد آن ها نمي باشيد .";
			if($_POST['smallarte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه چشمان عقاب';
				$effect = '5x';
				for($i > 1; $i < $_POST['arte5']; $i++) {
					Artefact($uid, 5, 1, 'چشمان عقاب كوچك', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
				}			
			}
			if($_POST['largearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه چشمان عقاب';
				$effect = '3x';
				for($i > 1; $i < intval($_POST['arte5']/2); $i++) {
					Artefact($uid, 5, 2, 'چشمان عقاب بزرگ', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
				}			
			}
			if($_POST['uniqearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه چشمان عقاب';
				$effect = '10x';
				for($i > 1; $i < 1; $i++) {
					Artefact($uid, 5, 3, 'چشمان عقاب منحصر به فرد', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
				}
			}
	}
	if(isset($_POST['arte6']) && ($_POST['arte6'] != 0)){ // مرتاض ها
        $desc = "اين كتيبه مصرف گندم سرباز هاي اين دهكده و همچنين سرباز هاي كمكي مستقر در اين دهكده را كاهش مي دهد .";
			if($_POST['smallarte']){
				unset($i);
				unset($vname);
				unset($effect);;
				$vname = 'كتيبه مرتاض ها';
				$effect = '1/2';
				for($i > 1; $i < $_POST['arte6']; $i++) {
					Artefact($uid, 6, 1, 'كتيبه مرتاض هاي كوچك', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
				}				
			}
			if($_POST['largearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'كتيبه مرتاض ها';
				$effect = '3/4';
				for($i > 1; $i < intval($_POST['arte5'] / 2); $i++) {
					Artefact($uid, 6, 2, 'كتيبه مرتاض هاي بزرگ', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
				}
			}
			if($_POST['uniqearte']){
				unset($i);
				unset($vname);
				unset($effect);;
				$vname = 'كتيبه مرتاض ها';
				$effect = '1/2';
				for($i > 1; $i < 1; $i++) {
					Artefact($uid, 6, 3, 'كتيبه مرتاض هاي منحصر به فرد', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
				}							
			}
	}
	if(isset($_POST['arte7']) && ($_POST['arte7'] != 0)){
        $desc = 'صاحبان اين كتيبه تنها مورد هدف گيري اتفاقي منجنيق قرار خواهند گرفت ، البته خزانه و شگفتي جهان مورد هدفگيري انتخابي قرار خواهند گرفت و در صورتي كه كتيبه از نوع منحصر به فرد باشد هدف گيري انتخابي خزانه نيز امكان پذير نمي باشد .';
			if($_POST['smallarte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه گيج كننده';
				$effect = '200x';
				for($i > 1; $i < $_POST['arte7']; $i++) {
					Artefact($uid, 7, 1, 'گيج كننده كوچك', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
				}			
			}
			if($_POST['largearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه گيج كننده';
				$effect = '100x';
				for($i > 1; $i < intval($_POST['arte7'] / 2); $i++) {
					Artefact($uid, 7, 2, 'گيح كننده بزرگ', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
				}			
			}
			if($_POST['uniqearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه گيج كننده';
				$effect = '500x';
				for($i > 1; $i < 1; $i++) {
					Artefact($uid, 7, 3, 'گيج كننده منحصر به فرد', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
				}			
			}
	}
	if(isset($_POST['arte8']) && ($_POST['arte8'] != 0)){
	        $desc = 'اين كتيبه سرعت ساخت لشكريان شما را در پادگان ، اصطبل ، كارگاه افزايش مي دهد . همچنين سرعت ساخت سرباز در پادگان بزرگ و اصطبل بزرگ نيز تحت تاثير قرار خواهد گرفت .';
			if($_POST['smallarte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه جنگ آموز';
				$effect = '1/2';
				for($i > 1; $i < $_POST['arte8']; $i++) {
					Artefact($uid, 8, 1, 'جنگ آموز كوچك', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
				}			
			}
			if($_POST['largearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه جنگ آموز';
				$effect = '3/4';
				for($i > 1; $i < intval($_POST['arte8'] / 2); $i++) {
					Artefact($uid, 8, 2, 'جنگ آموز بزرگ', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
				}			
			}
			if($_POST['uniqearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه جنگ آموز';
				$effect = '1/2';
				for($i > 1; $i < 1; $i++) {
					Artefact($uid, 8, 3, 'جنگ آموز منحصر به فرد', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
				}			
			}
	}
	if(isset($_POST['arte9']) && ($_POST['arte9'] != 0)){
			$desc = 'اين نقشه به شما ساخت انبار بزرگ و انبار غذاي بزرگ را آموزش مي دهد . شما همچنين براي ارتقا ساختمان هاي مذكور به اين نقشه نياز خواهيد داشت .';
			if($_POST['smallarte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه انبار برتر';
				$effect = '';
				for($i > 1; $i < $_POST['arte9']; $i++) {
					Artefact($uid, 9, 1, 'انبار برتر كوچك', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type9.gif');
				}			
			}
			if($_POST['largearte']){
				unset($i);
				unset($vname);
				unset($effect);
				$vname = 'کتیبه انبار برتر';
				$effect = '';
				for($i > 1; $i < intval($_POST['arte8'] / 2); $i++) {
					Artefact($uid, 9, 2, 'انبار برتر بزرگ', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type9.gif');
				}			
			}
			if($_POST['uniqearte']){
				/*
					ین نوع کتیبه منحصر به فرد ندارد.
				*/
			}
	}
	if(isset($_POST['wwmap']) && ($_POST['wwmap'] != 0)){
		unset($i);
		unset($vname);
		unset($effect);
		$desc = 'نقشه ساخت به شما آموزش مي دهد كه چگونه در يك دهكده ناتار شگفتي جهان ايجاد كنيد . براي ارتقا تا سطح 50 يك نقشه كافي مي باشد . براي ارتقا از سطح 50 به بعد داشتن نقشه اضافه در اتحاد شما ضروري مي باشد .';
        $vname = 'نقشه ساخت شگفتی جهان';
        $effect = '';
        for($i > 1; $i < $_POST['wwmap']; $i++) {
        	Artefact($uid, 1, 1, 'نقشه ساخت ساختمان شگفتی های جهان', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type1.gif');
        }

	}
	$database->editconf("regcl", 1);
	$myartekey = 1;
}  

  ?>

<body class="v35 webkit chrome statistics">
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

<h1 class="titleInHeader">آزاد سازی کلی کتیبه ها<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">				
<div class="clear"></div>
</div>
<?php 
if(!$myartekey){
?>
<legend>تعداد و تنظیمات مربوط به کتیبه ها</legend>
<br>
با سلام
<br>
توضیحات :<br>
کتیبه ها نوع 1: راز معماری - نوع 2: احمق ها - نوع 3چکمه خدایان - نوع 4 : چشمان عقاب - نوع 5 : مرتاض ها - نوع 6: گیج کننده - نوع 7 : جنگ آموز - نوع 8 : انبار برتر<br>
در قسمت تعداد توع .. باید تعداد کتیبه هایی که از آن دسته میخواهید آزاد شود وارد کنید یعنی اگر 1 وارد شود یک دهکده با این کتیبه ایجاد میشود.<br>
درقسمت کوچک و بزرگ و منحصر و نقشه شگفتی شما باید 0 یا 1 وارد کنید به این ترتین که 0 برای آزاد نکردن و 1 برای ازاد کردن میباشد<br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<form method="post" action="Artefact.php">
<input type="text" id="Editbox1" style="position:absolute;left:197px;top:310px;width:198px;height:23px;line-height:23px;z-index:0;" name="arte2" value="1">
<input type="text" id="Editbox2" style="position:absolute;left:197px;top:340px;width:198px;height:23px;line-height:23px;z-index:1;" name="arte3" value="1">
<input type="text" id="Editbox3" style="position:absolute;left:197px;top:370px;width:198px;height:23px;line-height:23px;z-index:2;" name="arte4" value="1">
<input type="text" id="Editbox4" style="position:absolute;left:197px;top:400px;width:198px;height:23px;line-height:23px;z-index:3;" name="arte5" value="1">
<input type="text" id="Editbox5" style="position:absolute;left:197px;top:430px;width:198px;height:23px;line-height:23px;z-index:4;" name="arte6" value="1">
<input type="text" id="Editbox6" style="position:absolute;left:197px;top:460px;width:198px;height:23px;line-height:23px;z-index:5;" name="arte7" value="1">
<input type="text" id="Editbox7" style="position:absolute;left:197px;top:490px;width:198px;height:23px;line-height:23px;z-index:6;" name="arte8" value="1">
<input type="text" id="Editbox8" style="position:absolute;left:197px;top:520px;width:198px;height:23px;line-height:23px;z-index:7;" name="arte9" value="1">
<input type="text" id="Editbox9" style="position:absolute;left:197px;top:550px;width:198px;height:23px;line-height:23px;z-index:8;" name="smallarte" value="1">
<input type="text" id="Editbox10" style="position:absolute;left:197px;top:580px;width:198px;height:23px;line-height:23px;z-index:9;" name="largearte" value="0">
<input type="text" id="Editbox11" style="position:absolute;left:197px;top:610px;width:198px;height:23px;line-height:23px;z-index:10;" name="uniqearte" value="0">
<input type="text" id="Editbox12" style="position:absolute;left:197px;top:640px;width:198px;height:23px;line-height:23px;z-index:11;" name="wwmap" value="0">
<div id="wb_Text1" style="position:absolute;left:412px;top:310px;width:61px;height:16px;z-index:12;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:تعداد نوع 1</span></div>
<div id="wb_Text2" style="position:absolute;left:412px;top:340px;width:61px;height:16px;z-index:13;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:تعداد نوع 2</span></div>
<div id="wb_Text3" style="position:absolute;left:412px;top:370px;width:61px;height:16px;z-index:14;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:تعداد نوع 3</span></div>
<div id="wb_Text4" style="position:absolute;left:412px;top:400px;width:61px;height:16px;z-index:15;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:تعداد نوع 4</span></div>
<div id="wb_Text5" style="position:absolute;left:412px;top:430px;width:61px;height:16px;z-index:16;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:تعداد نوع 5</span></div>
<div id="wb_Text6" style="position:absolute;left:412px;top:460px;width:61px;height:16px;z-index:17;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:تعداد نوع 6</span></div>
<div id="wb_Text7" style="position:absolute;left:412px;top:490px;width:61px;height:16px;z-index:18;">
<span style="color:#000000;font-family:arial;font-size:13px;">:تعداد نوع 7</span></div>
<div id="wb_Text8" style="position:absolute;left:412px;top:520px;width:61px;height:16px;z-index:19;">
<span style="color:#000000;font-family:arial;font-size:13px;">:تعداد نوع 8</span></div>
<div id="wb_Text9" style="position:absolute;left:412px;top:550px;width:61px;height:16px;z-index:20;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:کوچک</span></div>
<div id="wb_Text10" style="position:absolute;left:412px;top:580px;width:61px;height:16px;z-index:21;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:بزرگ</span></div>
<div id="wb_Text11" style="position:absolute;left:412px;top:610px;width:61px;height:16px;z-index:22;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:منحصر</span></div>
<div id="wb_Text12" style="position:absolute;left:412px;top:640px;width:61px;height:16px;z-index:23;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نقشه شگفتی</span></div>
<input type="text" id="Editbox12" style="position:absolute;left:197px;top:670px;width:198px;height:23px;line-height:23px;z-index:25;" name="troop1" value="3500">
<input type="text" id="Editbox12" style="position:absolute;left:197px;top:700px;width:198px;height:23px;line-height:23px;z-index:25;" name="troop2" value="4500">
<input type="text" id="Editbox12" style="position:absolute;left:197px;top:730px;width:198px;height:23px;line-height:23px;z-index:25;" name="troop3" value="3000">
<input type="text" id="Editbox13" style="position:absolute;left:197px;top:760px;width:198px;height:23px;line-height:23px;z-index:26;" name="troop4" value="1500">
<input type="text" id="Editbox15" style="position:absolute;left:197px;top:790px;width:198px;height:23px;line-height:23px;z-index:27;" name="troop5" value="4500">
<input type="text" id="Editbox16" style="position:absolute;left:197px;top:820px;width:198px;height:23px;line-height:23px;z-index:29;" name="troop6" value="4000">
<input type="text" id="Editbox17" style="position:absolute;left:197px;top:850px;width:198px;height:23px;line-height:23px;z-index:30;" name="troop7" value="3000">
<input type="text" id="Editbox18" style="position:absolute;left:197px;top:880px;width:198px;height:23px;line-height:23px;z-index:31;" name="troop8" value="1500">
<input type="text" id="Editbox19" style="position:absolute;left:197px;top:920px;width:198px;height:23px;line-height:23px;z-index:32;" name="troop9" value="10">
<input type="text" id="Editbox20" style="position:absolute;left:197px;top:950px;width:198px;height:23px;line-height:23px;z-index:33;" name="troop10" value="30">
<div id="wb_Text14" style="position:absolute;left:412px;top:670px;width:70px;height:16px;z-index:29;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 1</span></div>
<div id="wb_Text15" style="position:absolute;left:412px;top:700px;width:70px;height:16px;z-index:30;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 2</span></div>
<div id="wb_Text15" style="position:absolute;left:412px;top:730px;width:70px;height:16px;z-index:30;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 3 </span></div>
<div id="wb_Text15" style="position:absolute;left:412px;top:760px;width:70px;height:16px;z-index:30;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 4</span></div>
<div id="wb_Text16" style="position:absolute;left:412px;top:790px;width:70px;height:16px;z-index:31;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 5</span></div>
<div id="wb_Text17" style="position:absolute;left:412px;top:820px;width:70px;height:16px;z-index:31;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 6</span></div>
<div id="wb_Text18" style="position:absolute;left:412px;top:850px;width:70px;height:16px;z-index:31;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 7</span></div>
<div id="wb_Text19" style="position:absolute;left:412px;top:880px;width:70px;height:16px;z-index:31;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 8</span></div>
<div id="wb_Text20" style="position:absolute;left:412px;top:920px;width:70px;height:16px;z-index:31;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 9</span></div>
<div id="wb_Text21" style="position:absolute;left:412px;top:950px;width:70px;height:16px;z-index:31;">
<span style="color:#000000;font-family:Arial;font-size:13px;">:نیروی نوع 10</span></div>




<input type="submit" name="btn1" style="position:absolute;left:197px;top:1000px;width:198px;height:23px;line-height:23px;z-index:0;" value="آزاد سازی کتیبه !" align="middle">
</form>

<?php } 
if($myartekey){
?>
<style type="text/css">
.auto-style1 {
text-align: center;
}

.activation_time {
	border:1px solid red;
	color:red;
	padding:8px;
	background:#E32636;
	text-align:center;
	margin-bottom:6px;
	line-height:1.5em;
	fontsize:25;

	}
</style>

				<div class=activation_time><font color=#000000>کتیبه ها آزاد شدند....</font></div>
<?php
}
?>
</div></div>








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

<?php 

}


?>