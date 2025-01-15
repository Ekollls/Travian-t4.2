<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
function updateHero(){
	global $database,$hero_levels;
	if(!$database->checkConnection()) {throw new Exception(__FILE__.' cant connect to database.');return;}
	//throw new Exception(__FILE__.' thrower.');
	$time = time();
	$q = "SELECT * FROM ".TB_PREFIX."hero";
	$harray = $database->query_return($q);
	if(!empty($harray)) {
		foreach($harray as $hero) {
			if($hero['dead']==0 && $hero['health']<100) {
				$updatediff = $time-$hero['lastupdate'];
				$updatepart = $updatediff/86400;
				$health = round((($hero['autoregen']*HEROATTRSPEED)+($hero['itemautoregen']*ITEMATTRSPEED))*$updatepart,1);
				$health += $hero['health'];
				if ($health>100) $health = 100;
				$database->modifyHero(0,$hero['heroid'],"health",$health,0);
				$database->modifyHero(0,$hero['heroid'],"lastupdate",time(),0);
			}
			while($hero['experience']>0 && $hero['level']<100 && isset($hero_levels[$hero['level']]) && $hero['experience']>=$hero_levels[$hero['level']]){
				$database->modifyHero(0,$hero['heroid'],"level",1,1);
				$database->modifyHero(0,$hero['heroid'],"points",4,1);
				$hero['level']++;
			}
			if ($hero['level']>100){
				$hero['level']= 100;
				$database->modifyHero(0,$hero['heroid'],"level",100,0);
			}
		}
	}
	$q2 = "UPDATE ".TB_PREFIX."units SET hero = 1 WHERE hero > 1";
	$database->query($q2);
	$q2 = "UPDATE ".TB_PREFIX."enforcement SET hero = 1 WHERE hero > 1";
	$database->query($q2);
	$q2 = "UPDATE ".TB_PREFIX."trapped SET hero = 1 WHERE hero > 1";
	$database->query($q2);
	$q2 = "UPDATE ".TB_PREFIX."attacks SET t11 = 1 WHERE t11 > 1";
	$database->query($q2);
}
?>
