<?php
if(!isset($_SESSION['lang'])) $_SESSION['lang'] = 'en';

?><html>
	<head>
		<title><?php echo SERVER_NAME ?></title>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="pragma" content="no-cache" />
                <link rel="canonical" href="http://www.20script.ir" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="content-language" content="<?php echo $_SESSION['lang']; ?>" />
		<link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/compact.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo GP_LOCATE; ?>lang/<?php echo $_SESSION['lang']; ?>/lang.css" rel="stylesheet" type="text/css" />										
        <link href="img/travian_basics.css" rel="stylesheet" type="text/css" />
        <script src="unx.js" type="text/javascript"></script>
        <script src="crypt.js?<?php echo time();?>" type="text/javascript"></script>
        <script src="jquery.js" type="text/javascript"></script>
                <script>
		var j$ = $.noConflict();
		</script>

<script type="text/javascript">
	function matchHeight(id1,id2){	
		var el1=document.getElementById(id1);
		var el2=document.getElementById(id2);		
		el2.style.height = el1.style.height;
	}
</script>		
<script type="text/javascript">
  function changeLanguage(){
		var sellang = document.getElementById('sellang');
		var p = sellang.options[sellang.selectedIndex].value;
		location.assign('setlang.php?setlang='+p);
	}
</script>
<script type="text/javascript">
Travian.Translation.add(
{
	'allgemein.anleitung':	'راهنمای سریع',
	'allgemein.cancel':	'<?=CANCEL?>',
	'allgemein.ok':	'<?=OK?>',
	'cropfinder.keine_ergebnisse': 'مطابق با جستجوی شما نتیجه ای یافت نشد.'
});
Travian.applicationId = 'T4.2 Game';
Travian.Game.version = '4.2';
Travian.Game.worldId = '<?=SERVER_NAME?>';
Travian.Game.speed = <?=SPEED?>;

Travian.Templates = {};
	Travian.Templates.ButtonTemplate = "<button >\n\t<div class=\"button-container addHoverClick\">\n\t\t<div class=\"button-background\">\n\t\t\t<div class=\"buttonStart\">\n\t\t\t\t<div class=\"buttonEnd\">\n\t\t\t\t\t<div class=\"buttonMiddle\"><\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t<\/div>\n\t\t<div class=\"button-content\"><\/div>\n\t<\/div>\n<\/button>\n";

</script>
<script type="text/javascript">
	Travian.Game.eventJamHtml = '&lt;a href=&quot;http://t4.answers.travian.com.sa/index.php?aid=256#go2answer&quot; target=&quot;blank&quot; title=&quot;بیشتر بدانید&quot;&gt;&lt;span class=&quot;c0 t&quot;&gt;0:00:0&lt;/span&gt;?&lt;/a&gt;'.unescapeHtml();
</script>		
<script type="text/javascript">
window.addEvent('domready', function() {
		Travian.Form.UnloadHelper.message = '<?=SOME_CHANGES_DONE?>';
});
			window.addEvent("domready",function(){
		if(((quest.number===null&&Travian.Game.currentPage!="hero")&&typeof quest.lastparallel=="undefined")||(window.location.href.indexOf("questUpdate")!=-1)){
			qst_handle()
		}else{
			if(typeof quest.lastparallel!="undefined"){
				qst_showQuest(quest.lastparallel)
			}
		}
	});
</script>
<style>
body, input, a, button, div, span, ul, li {
	font-family:Tahoma;
	font-size:11px;
}
</style>
	</head>