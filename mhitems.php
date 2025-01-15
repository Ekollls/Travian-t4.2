<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include_once("GameEngine/Session.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (mysql_num_rows(mysql_query("SELECT id FROM ".TB_PREFIX."users WHERE access = 9 AND id = ".$session->uid)) != '1') die("Hacking attempt!");

if(isset($_GET['item'])){
	if($_GET['item']=='add'){
		$res = mysql_query("DELETE FROM ".TB_PREFIX."heroitems where `uid`=4")  or die(mysql_error());
		$num = 100000;
		$btype=1;for($type=1;$type<=15;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=2;for($type=82;$type<=93;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=3;for($type=61;$type<=81;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=4;for($type=16;$type<=60;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=5;for($type=94;$type<=102;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=6;for($type=103;$type<=105;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=7;for($type=112;$type<=112;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=8;for($type=113;$type<=113;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=9;for($type=114;$type<=114;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=10;for($type=107;$type<=107;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=11;for($type=106;$type<=106;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=12;for($type=108;$type<=108;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=13;for($type=110;$type<=110;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=14;for($type=111;$type<=111;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		$btype=15;for($type=109;$type<=109;$type++){$database->addHeroItem(4, $btype, $type, $num);}
		echo 'added';
	} elseif($_GET['item']=='remove'){
		$res = mysql_query("DELETE FROM ".TB_PREFIX."heroitems where `uid`=4")  or die(mysql_error());
		echo 'removed';
	}
} elseif(isset($_GET['au'])){
	$count = intval($_GET['au']);
	if ($count <=0) $count = 10;
	if(isset($_GET['t'])) $tear = intval($_GET['t']);
	if ($tear<=0){$tear = 1;}
	if ($tear>=4){$tear = 3;}
	for($i=1;$i<=$count;$i++){
		$btype = rand(1,15);
		if($btype==1){
			if($tear >= 3){$ntype = array(1=>1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
			}elseif($tear >= 2){$ntype = array(1=>1,2,4,5,7,8,10,11,13,14);
			}else{$ntype = array(1=>1,4,7,10,13);}
		}elseif($btype==2){
			if($tear >= 3){$ntype = array(1=>82,83,84,85,86,87,88,89,90,91,92,93);
			}elseif($tear >= 2){$ntype = array(1=>82,83,85,86,88,89,91,92);
			}else{$ntype = array(1=>82,85,88,91);}
		}elseif($btype==3){
			if($tear >= 3){$ntype = array(1=>61,62,63,64,65,66,67,68,69,73,74,75,76,77,78,79,80,81);
			}elseif($tear >= 2){$ntype = array(1=>61,62,64,65,67,68,73,74,79,80);
			}else{$ntype = array(1=>61,64,67,73,79);}
		}elseif($btype==4){
			if($tear >= 3){
				$ntype = array(1=>16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60);
			}elseif($tear >= 2){
				$ntype = array(1=>16,17,19,20,22,23,25,26,28,29,31,32,34,35,37,38,40,41,43,44,46,47,49,50,52,53,55,56,58,59);
			}else{
				$ntype = array(1=>16,19,22,25,28,31,34,37,40,43,46,49,52,55,58);
			}
		}elseif($btype==5){
			if($tear >= 3){$ntype = array(1=>94,95,96,98,99,100,101,102);
			}elseif($tear >= 2){$ntype = array(1=>94,95,97,98,100,101);
			}else{$ntype = array(1=>94,97,100);}
		}elseif($btype==6){
			if($tear >= 3){$ntype = array(1=>103,104,105);
			}elseif($tear >= 2){$ntype = array(1=>103,104);
			}else{$ntype = array(1=>103);}
		}elseif($btype==7){
			$ntype = array(1=>112);
		}elseif($btype==8){
			$ntype = array(1=>113);
		}elseif($btype==9){
			$ntype = array(1=>114);
		}elseif($btype==10){
			$ntype = array(1=>107);
		}elseif($btype==11){
			$ntype = array(1=>106);
		}elseif($btype==12){
			$ntype = array(1=>108);
		}elseif($btype==13){
			$ntype = array(1=>110);
		}elseif($btype==14){
			$ntype = array(1=>111);
		}elseif($btype==15){
			$ntype = array(1=>109);
		}
		
		switch ($btype){
			case 1: case 2: case 3: case 4: case 5: case 6: case 12: case 13: case 15:
				$num = 1;
			break;
			case 7: case 8: case 10: case 11: case 14:
				$num = rand(20,50);
			break;
			case 9:
				$num = rand(6,20);
			break;
		}
		$s2 = rand(1, count($ntype));
		$nntype = $ntype[$s2];
		if($database->checkHeroItem(4, $btype, $nntype)){
			$items = $database->getHeroItem(0,4, $btype, $nntype);
			$database->modifyHeroItem($items[0]['id'], 'num', $num, 1);
			$database->modifyHeroItem($items[0]['id'], 'proc', 0, 0);
		}else{
			$database->addHeroItem(4, $btype, $nntype, $num);
		}
	}
	$result = mysql_query("SELECT * FROM " . TB_PREFIX . "heroitems WHERE uid=4 AND proc=0")  or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)) {
		$database->addAuction(4, $row['id'], $row['btype'], $row['type'], $row['num']);
	}
} else {
}


mysql_close();
header('Location: hero_auction.php?action=sell');
?>
