<?php
if(!$session->goldclub) {
			include "Templates/Build/16.tpl";
			}else{
?>
<h1 class="titleInHeader">اردوگاه <span class="level">سطح <?php echo $village->resarray['f'.$id]; ?></span></h1>
<div id="build" class="gid16">
<div class="build_desc">
<a href="#" onClick="return Travian.Game.iPopup(16,4);" class="build_logo">
<img class="g16 big white" src="img/x.gif" alt="اردوگاه" title="اردوگاه" />
</a>
لشکریان دهکده‌ی شما در این محل جمع می شوند. از اینجا شما قادر به ارسال آنها برای غارت، حمله، تسخیر و یا پشتیبانی دهکده های دیگر می باشید.</div>
<?php include("upgrade.tpl"); ?>
<div class="contentNavi tabNavi">
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=<?php echo $id; ?>"><span class="tabItem">دیدکلی</span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="a2b.php"><span class="tabItem">لشکرکشی</span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="warsim.php"><span class="tabItem">شبیه ساز جنگی</span></a></div>
				</div>
                <div class="container">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=39&amp;t=99"><span class="tabItem">لیست فارم ها</span></a></div>
				</div>
     			<?php if($session->goldclub==1){ ?>
                <div class="container noraml">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=39&amp;t=100"><span class="tabItem">گریز از حمله</span></a></div>
				</div>
				<?php } ?>
</div>
<?php
if(isset($_GET['disable'])){
$database->query("UPDATE `s1_users` SET `escape`=0 WHERE `id` = '".$session->uid."'");		header("Location: build.php?id=39&t=100");		echo "<SCRIPT language='JavaScript'>window.location='build.php?id=39&t=100';</SCRIPT>";
}
if(isset($_GET['enable'])){
$database->query("UPDATE `s1_users` SET `escape`=1 WHERE `id` = '".$session->uid."'");		header("Location: build.php?id=39&t=100");		echo "<SCRIPT language='JavaScript'>window.location='build.php?id=39&t=100';</SCRIPT>";
}
$evasion = mysql_fetch_array($database->query("SELECT * FROM `s1_users` WHERE `id` = '".$session->uid."'"));
?>
<div id="raidList">
				<div class="round spacer listTitle">
						<div class="listTitleText">
							تنظیمات گریز
						</div>
						<div class="clear"></div>
					</div>
<div class="options">
<br>
گریز از حمله هنگامی که حتی یک موج نیرو در حال برگشت باشد و فاصله زمانی آن کمتر از 10 ثانیه باشد عمل نخواهد کرد. و این گزینه تنها در پایتخت عمل میکنید.
<br>
<?php	if($evasion['escape'] == 1){	?> درحال حاضر گریز فعال است و لشگریان شما گریز خواهند کرد. <?php 	}else{	?> در حال حاضر گریز غیر فعال است و لشگریان شما در دهکده خواهند جنگید.	<?php } ?>	
<br><br><br>
		<input type="checkbox" class="check" name="hideShow" onclick="window.location.href = '?id=39&t=100&<?php if($evasion['escape'] == 1){ echo "disable"; } else{ echo "enable"; } ?>';"  <?php if($evasion['escape']==1){ echo "checked=\"checked\""; }else{ echo ""; } ?>> 
		فعال سازی گریز برای دهکده پایتخت.
	
</div>

</div>

</div>
<?php } ?>