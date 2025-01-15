<?php
$eigen = $database->getCoor($village->wid);
$adventure = $database->getAdventure($session->uid,$_GET['id'],0);
if (!isset($adventure) || !$adventure) {
	header('Location: hero_adventure.php');
	exit;
}
$adventureXY = $database->getMInfo($_GET['id']);
$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
$to = array('x'=>$adventureXY['x'], 'y'=>$adventureXY['y']);
$herodetail = $database->getHero($session->uid);
$speed = $herodetail['speed']+$herodetail['itemspeed'];
$time = $generator->procDistanceTime($from,$to,$speed,1,$herodetail);
$founder = $database->getVillage($village->wid);
$isoasis = $database->isVillageOases($_GET['id']);
if($isoasis){
	$get = $database->getOMInfo($_GET['id']);
	$type = $get['type'];
}else{
	$get = $database->getMInfo($_GET['id']);
	$type = $get['fieldtype'];
}
switch($type) {
default:
$timg = "2";
breal;
case 1:
case 2:
case 3:
$tname =  JR_FOREST;
$timg = "3";
break;
case 4:
case 5:
case 6:
$tname =  JR_FIELD;
$timg = "1";
break;
case 7:
case 8:
case 9:
$tname =  JR_MOUNTAIN;
$timg = "1";
break;
case 10:
case 11:
case 12:
$tname =  JR_SEA;
$timg = "4";
break;
}

?>

<h1><?php echo SIDEINFO_ADVENTURES;?></h1>
				<form method="POST" action="build.php">
				<input type="hidden" name="a" value="adventure" />
				<input type="hidden" name="c" value="5" />
				<input type="hidden" name="h" value="<?php echo $_GET['id']; ?>" />
				<input type="hidden" name="id" value="39" />
				<input type="hidden" name="timestamp" value="<?php echo time()+$time ?>" />
                <img style="width:552px;height:336px;" src="./img/adv-bg/<?=$timg?>.jpg"><br>
                <div style="margin-top:-51px;background-color:#FFF;position:absolute;width:515px;margin-<?=DIRECTION_2?>:13px;padding:3px;border:1px dashed black;"><center>

             
             
                             <?=a2b_HERO_GOING_TO?> <b><?=@$tname?> (<?php echo (DIRECTION=='ltr'?$adventureXY['x'].'|'.$adventureXY['y']:$adventureXY['y'].'|'.$adventureXY['x']); ?>)</b> <?=a2b_THIS_TAKES?> <b><img class="clock" src="img/x.gif" alt="Duration" title="Duration" /> <?php echo $generator->getTimeFormat($time); ?></b> <?=a2b_TO_PROCEED?>.
                             <br>

<?php
if($village->resarray['f39'] >= 1){
if($herodetail['dead']==0){
	$ishh = 0;
	foreach($session->villages as $vill) {
    	if($database->getHUnit($vill)) { $ishh ++; }
    }
	if($ishh > 0){
?>
	<p class="button" style="margin-top:2px;margin-bottom:0px;">
		<button class="green" type="submit" value="ok" name="s1" id="btn_ok"><div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo STARTADVENTURE;?></div></div></button>
	</p>
<?php }else{ ?>
<button class="green disabled" type="button" title="<?php echo HEROISAWAY; ?>" value="<?php echo "قهرمان در هیچکدام از دهکده های شما نیست!"; ?>" class="disabled"><div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo "قهرمان در هیچکدام از دهکده های شما نیست!"; ?></div></div></button>
<?php } ?>
<?php }else{ ?>
<button type="button" title="<?php echo HEROISDEAD; ?>" value="<?php echo JR_HEROADVENTURE;?>" class="green disabled"><div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo HEROISDEAD; ?></div></div></button>
<?php 
}
}else{ 
?>
<button class="green disabled" type="button" title="<?php echo BUILDRALLYPOINTTORAID;?>" value="<?php echo JR_HEROADVENTURE;?>" class="disabled"><div class="button-container addHoverClick ">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo BUILDRALLYPOINTTORAID; ?></div></div></button>
<?php } ?>
</form>
</center>                             
                             
                             </div>
                             
                             



