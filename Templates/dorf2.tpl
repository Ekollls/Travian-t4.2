<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       dorf2.tpl                                                   ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<div class="villageMapWrapper">
<div id="village_map">
<?php
if($building->walling()) {
	$wtitle = $building->procResType($building->walling()).LVL.$village->resarray['f40'];
}
else {
	$wtitle = ($village->resarray['f40'] == 0)? EUC : $building->procResType($village->resarray['f40t'],0).LVL.$village->resarray['f40'];
}
?>
	<map name="clickareas" id="clickareas">
<?php
if(DIRECTION == 'ltr'){
$style = array(
19 => "left:81px; top:57px; z-index:19" ,
20 => "left:174px; top:15px; z-index:17" ,
21 => "left:261px; top:-3px; z-index:15",
22 => "left:354px; top:26px; z-index:17",
23 => "left:428px; top:69px; z-index:20",
24 => "left:42px; top:107px; z-index:23",
25 => "left:485px; top:119px; z-index:24",
26 => "left:249px; top:71px; z-index:20",
27 => "left:68px; top:241px; z-index:32",
28 => "left:31px; top:167px; z-index:27",
29 => "left:448px; top:170px; z-index:27",
30 => "left:153px; top:183px; z-index:28",
31 => "left:155px; top:110px; z-index:23",
32 => "left:227px; top:230px; z-index:32",
33 => "left:476px; top:238px; z-index:32",
34 => "left:153px; top:300px; z-index:36",
35 => "left:295px; top:291px; z-index:36",
36 => "left:404px; top:254px; z-index:33",
37 => "left:241px; top:333px; z-index:39",
38 => "left:365px; top:318px; z-index:38",
39 => "z-index:28"
);
	$coords = array(19=>"110,135,132,120,132,121,160,122,179,136,179,151,158,163,128,163,109,149",
		"202,93,223,79,223,79,251,80,271,95,271,109,249,121,220,121,200,108",
		"290,76,311,61,311,62,339,63,359,77,359,92,337,104,308,104,289,90",
		"384,105,406,91,406,91,434,92,453,106,453,121,432,133,402,133,383,120",
		"458,147,479,133,479,133,507,134,527,149,527,164,505,175,476,175,457,162",
		"71,184,92,170,92,171,120,172,140,186,139,201,118,213,88,213,69,199",
		"516,196,538,182,538,182,566,183,585,198,585,212,564,224,534,224,515,211",
		"280,113,301,98,301,99,329,100,349,114,348,169,327,181,298,181,278,168",
		"97,320,118,306,118,307,146,308,166,322,165,337,144,349,114,349,95,335",
		"59,244,80,230,80,230,108,231,128,246,128,260,106,272,77,272,57,259",
		"477,249,498,235,498,235,526,236,546,251,545,265,524,277,494,277,475,264",
		"181,259,202,245,202,245,230,246,250,261,250,275,228,287,199,287,180,274",
		"182,189,203,175,203,175,231,176,251,190,251,205,229,217,200,217,181,204",
		"254,308,276,294,276,294,304,295,324,309,323,324,302,336,272,336,253,323",
		"505,317,526,303,526,303,554,304,574,319,573,333,552,345,522,345,503,332",
		"182,379,204,365,204,365,232,366,251,380,251,395,230,407,200,407,181,394",
		"324,370,345,356,345,357,373,358,393,372,392,387,371,398,341,398,322,385",
		"433,334,454,320,454,321,482,322,502,336,502,351,480,362,451,362,432,349",
		"271,412,292,398,292,399,320,400,340,414,339,429,318,440,289,440,269,427",
		"396,396,417,381,417,382,445,383,465,397,464,412,443,424,413,424,394,410",
		"398,212,412,250,369,301,394,323,445,286,453,233,427,182",
		"72,450,1,373,-9,242,14,144,120,81,215,34,340,18,500,42,617,130,641,239,642,350,605,422,534,493,358,533,283,531,181,526,78,456,117,378,163,413,242,442,331,455,425,443,499,417,577,343,596,304,598,222,571,157,481,90,385,61,313,56,217,71,135,113,77,165,46,217,44,269,65,326,119,379");
}elseif(DIRECTION == 'rtl'){
$style = array(
19 => "right:81px; top:57px; z-index:19",
20 => "right:174px; top:15px; z-index:17",
21 => "right:261px; top:-3px; z-index:15",
22 => "right:354px; top:26px; z-index:17",
23 => "right:428px; top:69px; z-index:20",
24 => "right:42px; top:107px; z-index:23",
25 => "right:485px; top:119px; z-index:24",
26 => "right:249px; top:71px; z-index:20",
27 => "right:68px; top:241px; z-index:32",
28 => "right:31px; top:167px; z-index:27",
29 => "right:448px; top:170px; z-index:27",
30 => "right:153px; top:183px; z-index:28",
31 => "right:155px; top:110px; z-index:23",
32 => "right:227px; top:230px; z-index:32",
33 => "right:476px; top:238px; z-index:32",
34 => "right:153px; top:300px; z-index:36",
35 => "right:295px; top:291px; z-index:36",
36 => "right:404px; top:254px; z-index:33",
37 => "right:241px; top:333px; z-index:39",
38 => "right:365px; top:318px; z-index:38",
39 => "z-index:28"
);

	$coords = array(19=>"459,135,481,121,503,121,525,135,525,149,503,163,481,163,459,149",
		"367,93,389,79,411,79,433,93,433,107,411,121,389,121,367,107 ",
		"275,74,297,60,319,60,341,74,341,88,319,102,297,102,275,88",
		"184,105,206,91,228,91,250,105,250,119,228,133,206,133,184,119",
		"110,147,132,133,154,133,176,147,176,161,154,175,132,175,110,161",
		"498,184,520,170,542,170,564,184,564,198,542,212,520,212,498,198",
		"55,196,77,182,99,182,121,196,121,210,99,224,77,224,55,210",
		"288,148,310,134,332,134,354,148,354,162,332,176,310,176,288,162",
		"470,320,492,306,514,306,536,320,536,334,514,348,492,348,470,334",
		"510,244,532,230,554,230,576,244,576,258,554,272,532,272,510,258",
		"90,249,112,235,134,235,156,249,156,263,134,277,112,277,90,263",
		"385,263,407,249,429,249,451,263,451,277,429,291,407,291,385,277",
		"382,188,404,174,426,174,448,188,448,202,426,216,404,216,382,202",
		"312,310,334,296,356,296,378,310,378,324,356,338,334,338,312,324",
		"60,317,82,303,104,303,126,317,126,331,104,345,82,345,60,331",
		"386,379,408,365,430,365,452,379,452,393,430,407,408,407,386,393",
		"242,370,264,356,286,356,308,370,308,384,286,398,264,398,242,384",
		"133,334,155,320,177,320,199,334,199,348,177,362,155,362,133,348",
		"300,412,322,398,344,398,366,412,366,426,344,440,322,440,300,426",
		"173,396,195,382,217,382,239,396,239,410,217,424,195,424,173,410",
		"238,206,220,255,269,290,228,327,180,280,170,230,200,173",
		"71,450,2,374,3,374,-10,243,13,142,120,81,214,34,340,18,500,43,615,130,641,239,643,350,601,425,534,494,358,534,282,532,180,526,77,456,117,378,163,413,242,442,331,454,425,443,499,417,576,344,596,304,598,221,571,157,481,90,385,61,313,56,217,72,135,113,77,165,46,217,44,269,65,326,119,379");
}

for($t=19;$t<=40;$t++) {
	if(($village->resarray['f99t'] == 40 AND ($t)=='26') or ($village->resarray['f99t'] == 40 AND ($t)=='30') or ($village->resarray['f99t'] == 40 AND ($t)=='31') or ($village->resarray['f99t'] == 40 AND ($t)=='32')) {
		echo "<area href=\"build.php?id=99\" title=\"<div style=color:#FFF><b>".WW."</b></div> ".LVL." ".$village->resarray['f99']."\" coords=\"$coords[$t]\" shape=\"poly\"/>";
	} else {
		if($village->resarray['f'.$t.'t'] != 0) {
			$loopsame = $building->isCurrent($t)?1:0;
			$doublebuild = 0;
			if ($loopsame>0 && $building->isLoop($t)) {$doublebuild = 1;}
			$uprequire = $building->resourceRequired($t,$village->resarray['f'.$t.'t'],($loopsame > 0 ? 2:1)+$doublebuild);
			$bindicate = $building->canBuild($t,$village->resarray['f'.$t.'t']);
			$title = '<div style=\'color:#FFF\'><b>'.constant('B'.$village->resarray['f'.$t.'t']).'</b> '.LVL.' '.$village->resarray['f'.$t].'</div>';
			if($bindicate!=10 && $bindicate!=1)
				$title .= sprintf(UPGRADECOST,($village->resarray['f'.$t]+($loopsame > 0 ? 2:1)+$doublebuild)).':<br/>
 <span class=\'resources r1\'> <img class=\'r1\' src=\'img/x.gif\' > '.$uprequire['wood'].' </span> 
 <span class=\'resources r2\'> <img class=\'r2\' src=\'img/x.gif\' > '.$uprequire['clay'].' </span> 
 <span class=\'resources r3\'> <img class=\'r3\' src=\'img/x.gif\' > '.$uprequire['iron'].' </span> 
 <span class=\'resources r4\'> <img class=\'r4\' src=\'img/x.gif\' > '.$uprequire['crop'].' </span> ';
		} else {
			$title = CS;
			if(($t == 39) && ($village->resarray['f'.$t] == 0)) {
				$title = CS;
			}
		}
	echo '<area coords="'.$coords[$t].'" href="build.php?id='.$t.'" alt= "" title="'.$title.'" shape="poly"/>';
	}
}

if($village->resarray['f40'] == 0) { 
	if($building->walling()) {
		$wtitle = $building->procResType($building->walling()).LVL.$village->resarray['f40'];
		echo "<img src=\"img/x.gif\" class=\"wall g3".$session->tribe."Top \" alt=\"$wtitle ".LVL." ".$village->resarray['f40']."\">";
		echo "<img src=\"img/x.gif\" class=\"wall g3".$session->tribe."bBottom \" alt=\"$wtitle ".LVL." ".$village->resarray['f40']."\">";
    }
}else {
	$wtitle = $building->procResType($building->walling()).LVL.$village->resarray['f40'];
    echo "<img src=\"img/x.gif\" class=\"wall g3".$session->tribe."Top \" alt=\"$wtitle ".LVL." ".$village->resarray['f40']."\">";
    echo "<img src=\"img/x.gif\" class=\"wall g3".$session->tribe."Bottom \" alt=\"$wtitle ".LVL." ".$village->resarray['f40']."\">";
} ?>

	</map>

<?php
for ($i=1;$i<=20;$i++) {
	if(($village->resarray['f99t'] == 40 AND ($i+18)=='26') or ($village->resarray['f99t'] == 40 AND ($i+18)=='30') or ($village->resarray['f99t'] == 40 AND ($i+18)=='31') or ($village->resarray['f99t'] == 40 AND ($i+18)=='32')) {
	} else {
		$text = CS;
		$img = "iso";
		if($village->resarray['f'.($i+18).'t'] != 0) {
			$text = $building->procResType($village->resarray['f'.($i+18).'t']).LVL.$village->resarray['f'.($i+18)];
			$esi_img = $village->resarray['f'.($i+18).'t'];
			if($esi_img==12) $esi_img++;
			$img = "g".$esi_img;
		}
		foreach($building->buildArray as $job) {
			if($job['field'] == ($i+18)) {
				$img = 'g'.$job['type'].'b';
				$text = $building->procResType($job['type']).LVL.$village->resarray['f'.$job['field']];
			}
		}
		echo "<img style=\"".$style[($i + 18)]."\" src=\"img/x.gif\" class=\"building $img\" alt=\"$text\" />";
	}
}

if($village->resarray['f39'] == 0) {
	if($building->rallying()) {
		echo "<img src=\"img/x.gif\" class=\"dx1 g16b\" alt=\"".RALLYPOINT." ".$village->resarray['f39']."\" />";
	} else {
		echo "<img src=\"img/x.gif\" class=\"dx1 g16e\" alt=\"".RALLYPOINTSITE."\" />";
	}
} else {
	echo "<img src=\"img/x.gif\" class=\"dx1 g16\" alt=\"".RALLYPOINT." ".$village->resarray['f39']."\" />";
}

if($village->resarray['f99t'] == 40) {
	if($village->resarray['f99'] >= 0 && $village->resarray['f99'] <= 19)  { echo '<img class="ww g40 g40_0" src="img/x.gif" alt="'.WW.'">'; }
	if($village->resarray['f99'] >= 20 && $village->resarray['f99'] <= 39) { echo '<img class="ww g40 g40_1" src="img/x.gif" alt="'.WW.'">'; }
	if($village->resarray['f99'] >= 40 && $village->resarray['f99'] <= 59) { echo '<img class="ww g40 g40_2" src="img/x.gif" alt="'.WW.'">'; }
	if($village->resarray['f99'] >= 60 && $village->resarray['f99'] <= 79) { echo '<img class="ww g40 g40_3" src="img/x.gif" alt="'.WW.'">'; }
	if($village->resarray['f99'] >= 80 && $village->resarray['f99'] <= 89) { echo '<img class="ww g40 g40_4" src="img/x.gif" alt="'.WW.'">'; }
	if($village->resarray['f99'] >= 90 && $village->resarray['f99'] <= 100){ echo '<img class="ww g40 g40_5" src="img/x.gif" alt="'.WW.'">'; }
}
?>
    <div id="levels" <?php if(isset($_COOKIE['t4level'])) { echo "class=\"on\""; } ?>>
<?php
for($i=1;$i<=20;$i++) {
	if ($village->resarray['f'.($i+18)] != 0) {
		echo "<div class=\"l$i\">".$village->resarray['f'.($i+18)]."</div>";
	}
}
if($village->resarray['f39'] != 0) {
	echo "<div class=\"l39\">".$village->resarray['f39']."</div>";
}
if($village->resarray['f40'] != 0) {
	echo "<div class=\"aid40\">".$village->resarray['f40']."</div>";
}
?>
	</div>
	<img src="img/x.gif" id="lswitch" <?php if(isset($_COOKIE['t4level'])) { echo "class=\"lswitchMinus\""; }else{ echo "class=\"lswitchPlus\""; } ?> onclick=" 
				$('lswitch').toggleClass('lswitchMinus');
				$('lswitch').toggleClass('lswitchPlus');
				if ($('levels').toggleClass('on').hasClass('on')){
					document.cookie = 't4level=1; expires=Wed, 1 Jan 2020 00:00:00 GMT';
				} else {
					document.cookie = 't4level=1; expires=Thu, 01-Jan-1970 00:00:01 GMT';
				}
			" />
	<img class="clickareas" usemap="#clickareas" src="img/x.gif" alt="" />
</div>
</div>
<div class="clear">&nbsp;</div>
            
           