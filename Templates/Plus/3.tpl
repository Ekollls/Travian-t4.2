<?php
$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$row = mysql_fetch_array($result);
$cnf = $row;

$resultu = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE username = '". $session->username ."'");
$usr = mysql_fetch_array($resultu);


$phl = array(	"1"	=>	$cnf['ph1'],
				"2"	=>	$cnf['ph2'],
				"3"	=>	$cnf['ph3']
			);
			
			
function checkLimit($usrfield,$maximum) {
	global $cnf, $usr;
	if($cnf[$maximum] > $usr[$usrfield]) {
		return true;
	}else{
		return false;
	}
}
function getCoin($alias) {
	$result = mysql_query("SELECT * FROM ".TB_PREFIX."pitems WHERE alias = '$alias'");
    $row = mysql_fetch_array($result);
    return $row['coin'];
}
function getStatus($alias) {
	$result = mysql_query("SELECT * FROM ".TB_PREFIX."pitems WHERE alias = '$alias'");
    $row = mysql_fetch_array($result);
    $status =  $row['status'];
    if ($status == "active") {
    	return true;
    }else{
        return false;
    }
}

$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `username`='".$session->username."'") or die(mysql_error());
$golds = mysql_fetch_array($MyGold);
if($golds['b1'] <= time()) {
	mysql_query("UPDATE ".TB_PREFIX."users set b1 = '0' where `username`='".$session->username."'") or die(mysql_error());
}
if($golds['b2'] <= time()) {
	mysql_query("UPDATE ".TB_PREFIX."users set b2 = '0' where `username`='".$session->username."'") or die(mysql_error());
}
if($golds['b3'] <= time()) {
	mysql_query("UPDATE ".TB_PREFIX."users set b3 = '0' where `username`='".$session->username."'") or die(mysql_error());
}

if($golds['b4'] <= time()) {
	mysql_query("UPDATE ".TB_PREFIX."users set b4 = '0' where `username`='".$session->username."'") or die(mysql_error());
}
$userData = $database->getUser($session->username);


include("Templates/Plus/pmenu.tpl");
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `username`='".$session->username."'") or die(mysql_error());
$golds = mysql_fetch_array($MyGold);
$today = date("mdHi");
if (mysql_num_rows($MyGold)) {
	if($session->gold == 0) {
		echo "<div class=\"boxes boxesColor gray goldBalance\"><div class=\"boxes-tl\"></div><div class=\"boxes-tr\"></div><div class=\"boxes-tc\"></div><div class=\"boxes-ml\"></div><div class=\"boxes-mr\"></div><div class=\"boxes-mc\"></div><div class=\"boxes-bl\"></div><div class=\"boxes-br\"></div><div class=\"boxes-bc\"></div><div class=\"boxes-contents\">در حال حاضر شما <b>هیچ</b> سکه ای ندارید</div></div>";
	} else {
		echo "<div class=\"boxes boxesColor gray goldBalance\"><div class=\"boxes-tl\"></div><div class=\"boxes-tr\"></div><div class=\"boxes-tc\"></div><div class=\"boxes-ml\"></div><div class=\"boxes-mr\"></div><div class=\"boxes-mc\"></div><div class=\"boxes-bl\"></div><div class=\"boxes-br\"></div><div class=\"boxes-bc\"></div><div class=\"boxes-contents\">در حال حاضر شما <b>$session->gold</b> عدد سکۀ طلا  داريد.</div></div>";
	}
}
if(isset($_GET['action']) && $_GET['action']=='ordoogah'){
	if($session->gold >= 10) {
    	mysql_query("UPDATE ".TB_PREFIX."fdata SET `f39` = '20', `f39t` = '16' WHERE `vref` = '".$village->wid."'");
        mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 10 WHERE `username` = '".$session->username."'");
    }
    header("Location: plus.php?id=3");
}
if(isset($_GET['action']) && $_GET['action']=='anbar'){
	if(getStatus("khas20")) {
        $ag = getCoin("khas20");
        if($session->gold >= $ag) {
            $rr = mysql_query("SELECT * FROM ".TB_PREFIX."fdata WHERE `vref` = '".$village->wid."'");
            $rr = mysql_fetch_array($rr);
            for($yy=1;$yy<=40;$yy++) {
                if($rr["f".$yy."t"] == "0") {
                    // do the job
					$rrr = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE `wref` = '".$village->wid."'");
					$rrr = mysql_fetch_array($rrr);
					$wood = $rrr['wood'];
					$clay = $rrr['wood'];
					$iron = $rrr['wood'];
					// 10 aval level hast
                    mysql_query("UPDATE ".TB_PREFIX."fdata SET `f".$yy."` = '20', `f".$yy."t` = '10' WHERE `vref` = '".$village->wid."'");
                    mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - ".$ag." WHERE `username` = '".$session->username."'");
					
                    mysql_query("UPDATE ".TB_PREFIX."vdata SET `wood` = '$wood', `iron` = '$iron' , `clay` = '$clay' WHERE `wref` = '".$village->wid."'");
					
                    break;
    
                }
            }
        }
    }
    header("Location: plus.php?id=3");
}

if(isset($_GET['action']) && $_GET['action']=='buyprotect'){
	if($session->gold >= HEMAYAT_COST) {
		if($session->userinfo['hemayat'] < HEMAYAT){
			if($session->userinfo['protect'] < time()){
				$time = time() + HEMAYAT_TIME;
				mysql_query("UPDATE ".TB_PREFIX."users SET `protect` = '".$time."' WHERE `id` = '".$session->uid."'");
				mysql_query("UPDATE ".TB_PREFIX."users SET `hemayat` = hemayat + '1' WHERE `id` = '".$session->uid."'");
				mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - ".HEMAYAT_COST." WHERE `username` = '".$session->username."'");
			}
			else{
				$time = time() + HEMAYAT_TIME;
				mysql_query("UPDATE ".TB_PREFIX."users SET `protect` = protect + '".HEMAYAT_TIME."' WHERE `id` = '".$session->uid."'");
				mysql_query("UPDATE ".TB_PREFIX."users SET `hemayat` = hemayat + '1' WHERE `id` = '".$session->uid."'");
				mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - ".HEMAYAT_COST." WHERE `username` = '".$session->username."'");
			}
		}
    }
    header("Location: plus.php?id=3");
}
if(isset($_GET['action']) && $_GET['action']=='ph1'){
	if(getStatus("khp1")) {
        if($session->gold >= getCoin("khp1")) {
			// do the job
			$vref = $village->wid;
			$t_ids = array(31,32,33,34/*,35*/,36,/*37,*/38/*,39*//*,40*/);
			/*
			for($y=31;$y<=40;$y++) {
				mysql_query("UPDATE ".TB_PREFIX."units SET u".$y." = 0 WHERE vref = ".$vref);
			}
			*/
			mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - ". getCoin("khp1") ." WHERE `username` = '".$session->username."'");
			
			$ga = 0;
			
			foreach($t_ids as $i) { // tedade gune ha
				$t_id = $i;; // noE gune
				$t_n = ($phl['1']/count($t_ids)); // tedade azaye in gune
				if($t_n+$ga > $phl['1']) {
					$t_n = $phl['1']-$ga;
				}
				$ga += $t_n;
				mysql_query("UPDATE ".TB_PREFIX."units SET u".$t_id." = u".$t_id." + ".$t_n." WHERE vref = ".$vref);
			};
			
			header("Location: plus.php?id=3");
		}
	}
}
if(isset($_GET['action']) && $_GET['action']=='ph2'){
	if(getStatus("khp2")) {
        if($session->gold >= getCoin("khp2")) {
			mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - ". getCoin("khp2") ." WHERE `username` = '".$session->username."'");
			// do the job
			$vref = $village->wid;
			$t_ids = array(/*31,32,*/33,34,35,36,37,38/*,39*//*,40*/);
			/*
			for($y=31;$y<=40;$y++) {
				mysql_query("UPDATE ".TB_PREFIX."units SET u".$y." = 0 WHERE vref = ".$vref);
			}
			*/
			$ga = 0;
			foreach($t_ids as $i) { // tedade gune ha
				$t_id = $i;; // noE gune
				$t_n = ($phl['2']/count($t_ids)); // tedade azaye in gune
				if($t_n+$ga > $phl['2']) {
					$t_n = $phl['2']-$ga;
				}
				$ga += $t_n;
				mysql_query("UPDATE ".TB_PREFIX."units SET u".$t_id." = u".$t_id." + ".$t_n." WHERE vref = ".$vref);
			};
			header("Location: plus.php?id=3");
		}
	}
}
if(isset($_GET['action']) && $_GET['action']=='ph3'){
	if(getStatus("khp3")) {
        if($session->gold >= getCoin("khp3")) {
			mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - ". getCoin("khp3") ." WHERE `username` = '".$session->username."'");
			// do the job
			$vref = $village->wid;
			$t_ids = array(/*31,32,33,34,*/35,36,37,38,39,40);
			/*
			for($y=31;$y<=40;$y++) {
				mysql_query("UPDATE ".TB_PREFIX."units SET u".$y." = 0 WHERE vref = ".$vref);
			}
			*/
			$ga = 0;
			foreach($t_ids as $i) { // tedade gune ha
				$t_id = $i;; // noE gune
				$t_n = ($phl['3']/count($t_ids)); // tedade azaye in gune
				if($t_n+$ga > $phl['3']) {
					$t_n = $phl['3']-$ga;
				}
				$ga += $t_n;
				mysql_query("UPDATE ".TB_PREFIX."units SET u".$t_id." = u".$t_id." + ".$t_n." WHERE vref = ".$vref);
			};
			header("Location: plus.php?id=3");
		}
	}
}

if(isset($_GET['action']) && $_GET['action']=='buyreturn'){
	if($session->gold >= BAZGASHT_COST) {
		if($session->userinfo['hemayat'] < BAZGASHT){
			$golds = $database->getUserArray($session->username, 0);
			$MyVilId = mysql_query("SELECT * FROM ".TB_PREFIX."movement WHERE `to`='".$village->wid."' and `sort_type`='4' and `proc`='0'");
			$time = time() + BAZGASHT_TIME;
			$q = "SELECT * FROM ".TB_PREFIX."movement, ".TB_PREFIX."attacks where ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id and ".TB_PREFIX."movement.proc = '0' and ".TB_PREFIX."movement.to = ".$village->wid." and ".TB_PREFIX."movement.sort_type = '3' and ".TB_PREFIX."attacks.attack_type != '2' and endtime > $time ORDER BY endtime ASC";
			$MyVilId2 = mysql_query($q);
			$uuVilid = mysql_fetch_array($MyVilId);
			$buildnum = mysql_num_rows($MyVilId);
			if (mysql_num_rows($MyVilId) && empty($MyVilId2)) {
				mysql_query("UPDATE ".TB_PREFIX."movement SET endtime = '3' WHERE `to` = ".$village->wid." and `sort_type`='4' and `proc`='0' and endtime > $time");
				mysql_query("UPDATE ".TB_PREFIX."users SET `bazgasht` = bazgasht + '1' WHERE `id` = '".$session->uid."'");
				mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - ".BAZGASHT_COST." WHERE `username` = '".$session->username."'");
			}
		}
    }
    header("Location: plus.php?id=3");
}
if(isset($_GET['action']) && $_GET['action']=='buyexp'){
	if($session->gold >= 10) {
    	mysql_query("UPDATE ".TB_PREFIX."hero SET `experience` = experience + '1000' WHERE `uid` = '".$session->uid."'");
        mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 10 WHERE `username` = '".$session->username."'");
    }
    header("Location: plus.php?id=3");
}
if(isset($_GET['action']) && $_GET['action']=='buymanabe'){
	if(checkLimit("boughtmanabe","maxmanabe")) {
		$check = mysql_query("SELECT * FROM `".TB_PREFIX."fdata` WHERE `vref` = '".$village->wid."'");
		$check = mysql_fetch_array($check);
		if($session->gold >= 50 && $check['f99t']==0) {
			mysql_query("UPDATE ".TB_PREFIX."vdata SET `wood` = wood + '".$bid10[20]['attri']."' WHERE `wref` = '".$village->wid."'");
			mysql_query("UPDATE ".TB_PREFIX."vdata SET `clay` = clay + '".$bid10[20]['attri']."' WHERE `wref` = '".$village->wid."'");
			mysql_query("UPDATE ".TB_PREFIX."vdata SET `iron` = iron + '".$bid10[20]['attri']."' WHERE `wref` = '".$village->wid."'");
			mysql_query("UPDATE ".TB_PREFIX."vdata SET `crop` = crop + '".$bid10[20]['attri']."' WHERE `wref` = '".$village->wid."'");
			mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 30 WHERE `username` = '".$session->username."'");
			mysql_query("UPDATE ".TB_PREFIX."users SET `boughtmanabe` = boughtmanabe + 1 WHERE `username` = '".$session->username."'");
		}
	}
    header("Location: plus.php?id=3");
}

if(isset($_GET['action']) && $_GET['action']=='buycp'){
	if($session->gold >= 25) {
    	mysql_query("UPDATE ".TB_PREFIX."vdata SET `cp` = cp + '3000' WHERE `wref` = '".$village->wid."'");
        mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 25 WHERE `username` = '".$session->username."'");
    }
    header("Location: plus.php?id=3");
}
if(isset($_GET['action']) && $_GET['action']=='buyloyalty'){
	if($session->gold >= 30) {
		$vil = mysql_fetch_array(mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE wref = ".$village->wid.""));
		if($vil['loyalty']<125){
			if($vil['loyalty']<110){
				mysql_query("UPDATE ".TB_PREFIX."vdata SET `loyalty` = loyalty + '15' WHERE `wref` = '".$village->wid."'");
				mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 25 WHERE `username` = '".$session->username."'");
			}
			else{
				mysql_query("UPDATE ".TB_PREFIX."vdata SET `loyalty` = '125' WHERE `wref` = '".$village->wid."'");
				mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 25 WHERE `username` = '".$session->username."'");
			}
		}
    }
    header("Location: plus.php?id=3");
}
if(isset($_GET['action']) && $_GET['action']=='buypop'){
	if($session->gold >= 25) {
    	mysql_query("UPDATE ".TB_PREFIX."vdata SET `pop` = pop + '50' WHERE `wref` = '".$village->wid."'");
        mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 25 WHERE `username` = '".$session->username."'");
    }
    header("Location: plus.php?id=3");
}
if(isset($_GET['action']) && $_GET['action']=='anbarsath20'){
	if($session->gold >= 30) {
		$build = mysql_fetch_array(mysql_query("SELECT * FROM ".TB_PREFIX."fdata WHERE vref = ".$village->wid.""));
		$stat = false;
		for($i=19;$i<=38;$i++){
			if($build['f'.$i]==0 && $build['f'.$i.'t']==0){
				$stat = true;
				break;
			}
		}
		if($stat){
			mysql_query("UPDATE ".TB_PREFIX."fdata SET `f{$i}` = '20', `f{$i}t` = '10' WHERE `vref` = '".$village->wid."'");
			mysql_query("UPDATE `".TB_PREFIX."vdata` SET maxstore = maxstore + '".$bid10[20]['attri']."' WHERE `wref` = '".$village->wid."'");
			mysql_query("UPDATE `".TB_PREFIX."vdata` SET pop = pop + 30 WHERE `wref` = '".$village->wid."'");
			mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 30 WHERE `username` = '".$session->username."'");
		}
    }
    header("Location: plus.php?id=3");
}

if(isset($_GET['action']) && $_GET['action']=='manabe'){
	if(checkLimit("boughtmanabe2","maxmanabe2")) {
		$check = mysql_query("SELECT * FROM `".TB_PREFIX."fdata` WHERE `vref` = '".$village->wid."'");
		$check = mysql_fetch_array($check);
		if($session->gold >= 10 && $check['f99t']==0) {
			mysql_query("UPDATE `".TB_PREFIX."vdata` SET wood = wood + ".$village->getProd("wood")." WHERE `wref` = '".$village->wid."'");
			mysql_query("UPDATE `".TB_PREFIX."vdata` SET clay = clay + ".$village->getProd("clay")." WHERE `wref` = '".$village->wid."'");
			mysql_query("UPDATE `".TB_PREFIX."vdata` SET iron = iron + ".$village->getProd("iron")." WHERE `wref` = '".$village->wid."'");
			if($village->getProd("crop")>0){
				mysql_query("UPDATE `".TB_PREFIX."vdata` SET crop = crop + ".$village->getProd("crop")." WHERE `wref` = '".$village->wid."'");
			}
			mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 10 WHERE `username` = '".$session->username."'");
			mysql_query("UPDATE ".TB_PREFIX."users SET `boughtmanabe2` = boughtmanabe2 + 1 WHERE `username` = '".$session->username."'");
		}
	}
    header("Location: plus.php?id=3");
}

if(isset($_GET['action']) && $_GET['action']=='FinishBuilding'){
	$golds = $database->getUserArray($session->username, 0);

    $MyVilId = mysql_query("SELECT * FROM ".TB_PREFIX."bdata WHERE `wid`='".$village->wid."'") or die(mysql_error());
    $uuVilid = mysql_fetch_array($MyVilId);
    $MyVilId2 = mysql_query("SELECT * FROM ".TB_PREFIX."research WHERE `vref`='".$village->wid."'") or die(mysql_error());
    $uuVilid2 = mysql_fetch_array($MyVilId2);

    $buildnum = mysql_num_rows($MyVilId);
    $resnum = mysql_num_rows($MyVilId2);

    $goldlog = mysql_query("SELECT * FROM ".TB_PREFIX."gold_fin_log") or die(mysql_error());

if($session->gold >= 2) {

if (mysql_num_rows($MyVilId) || mysql_num_rows($MyVilId2)) {

mysql_query("UPDATE ".TB_PREFIX."bdata set timestamp = '1' where wid = ".$village->wid." AND type != '25' OR type != '26' OR type != '40'") or die(mysql_error());
mysql_query("UPDATE ".TB_PREFIX."research set timestamp = '1' where vref = '".$village->wid."'") or die(mysql_error());



$done1 = "ساخت <b>".$buildnum."</b> ساختمان و <b>".$resnum."</b> تحقیق به پایان رسید.";
    mysql_query("UPDATE ".TB_PREFIX."users set gold = ".($session->gold-2)." where `username`='".$session->username."'") or die(mysql_error());
    mysql_query("INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysql_num_rows($goldlog)+1)."', '".$village->wid."', 'Finish construction and research with gold')") or die(mysql_error());

} else {
    mysql_query("INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysql_num_rows($goldlog)+1)."', '".$village->wid."', 'Failed construction and research with gold')") or die(mysql_error());

}
} else {
        $done1 = "سکۀ طلای کافی ندارید";
}

} else if ($_GET['action']=='FinishTraining'){
	$golds = $database->getUserArray($session->username, 0);

    $MyVilId = mysql_query("SELECT * FROM ".TB_PREFIX."training WHERE `vref`='".$village->wid."'") or die(mysql_error());
    $uuVilid = mysql_fetch_array($MyVilId);

    $buildnum = mysql_num_rows($MyVilId);

    $goldlog = mysql_query("SELECT * FROM ".TB_PREFIX."gold_fin_log") or die(mysql_error());

if($session->gold >= 10) {

if (mysql_num_rows($MyVilId)) {

mysql_query("UPDATE ".TB_PREFIX."training set eachtime = '1', timestamp = '1', commence = '1' where `vref` = ".$village->wid."") or die(mysql_error());

$done1 = "ساخت <b>".$buildnum."</b> سرباز به پایان رسید.";
    mysql_query("UPDATE ".TB_PREFIX."users set gold = ".($session->gold-10)." where `username`='".$session->username."'") or die(mysql_error());
    mysql_query("INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysql_num_rows($goldlog)+1)."', '".$village->wid."', 'Finish training with gold')") or die(mysql_error());

} else {
    mysql_query("INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysql_num_rows($goldlog)+1)."', '".$village->wid."', 'Failed training with gold')") or die(mysql_error());

}
} else {
        $done1 = "سکۀ طلای کافی ندارید";
}

}
$result = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$row = mysql_fetch_array($result);
$cnf = $row;

$resultu = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE username = '". $session->username ."'");
$usr = mysql_fetch_array($resultu);


 ?>
<style type="text/css">
.plusFunctions tbody tr .desc {
	text-align: justify;
}
.plusFunctions tr .desc {
	text-align: justify;
}
</style>


<h4 class="spacer">پلاس</h4>

<?php echo $done1; ?>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
	<thead>

		<tr>
			<td>توضیح</td>
			<td>مدت زمان</td>
			<td>سکه ی طلای تراوین t4dl</td>
			<td>عمل</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="desc">
				اکانت <b><font color="#71D000">پلاس</font></b><br><span class="run">
<?php
$datetimep=$golds['plus'];
$datetime1=$golds['b1'];
$datetime2=$golds['b2'];
$datetime3=$golds['b3'];
$datetime4=$golds['b4'];
$datetimeap=$golds['ap'];
$datetimedp=$golds['dp'];
//Retrieve the current date/time
$date2=strtotime("NOW");


	if ($datetimep == 0) {
		print "";
	}elseif ($datetimep <= $date2) {
		mysql_query("UPDATE ".TB_PREFIX."users set plus = '0' where `username`='".$session->username."'") or die(mysql_error());
 	} else {

$holdtotmin=(($datetimep-$date2)/60);
$holdtothr=(($datetimep-$date2)/3600);
$holdtotday=round(($datetimep-$date2)/86400, 1);
$holdhr=intval($holdtothr-($holdtotday*24));
$holdmr=intval($holdtotmin-(($holdhr*60)+($holdtotday*1440)));

    echo "هنوز <b>".$holdtotday. "</b> روز تا ".date('H:i',$golds['plus'])."";
 }
?>
                </span>			</td>
			<td class="dur"><?php if(PLUS_TIME >= 86400){
			echo ''.(PLUS_TIME/86400).' روز';
			} else if(PLUS_TIME < 86400){
			echo ''.(PLUS_TIME/3600).' ساعت';
			} ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای  t4dl"><?=getCoin("pa")?></td>
			<td class="act">
<?php
    $MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `username`='".$session->username."'") or die(mysql_error());
    $golds = mysql_fetch_array($MyGold);
if (getStatus("pa")){
if (mysql_num_rows($MyGold)) {
	if($golds['gold'] > getCoin("pa") && $datetimep < $date2) {
	echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=8'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
}elseif
	($golds['gold'] > getCoin("pa") && $datetimep > $date2) {
	echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=8'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">تمدید</div></div></button>";

} else {
	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
    }
}
}else{
echo "غیر فعال";
}
 ?>
            </td>
		</tr>
  </tbody>
</table>
<p>&nbsp;</p>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td>توضیح</td>
			<td>مدت زمان</td>
			<td>سکه ی طلای تراوین t4dl</td>
			<td>عمل</td>
		</tr>
	</thead>
	<tbody>
				<tr>
			<td class="desc">
				+<b>25</b>% <img class="r1" src="img/x.gif" alt="چوب"> تولید: چوب<br>
				<span class="run">
<?php

$tl_b1=$golds['b1'];
 if ($tl_b1 < $date2) {
     print "";
 } else {
$holdtotmin1=(($tl_b1-$date2)/60);
$holdtothr1=(($tl_b1-$date2)/3600);
$holdtotday1=round(($tl_b1-$date2)/86400, 1);
$holdhr1=intval($holdtothr1-($holdtotday1*24));
$holdmr1=intval($holdtotmin1-(($holdhr1*60)+($holdtotday1*1440)));
}

 if ($tl_b1 < $date2) {
     print " ";
 } else {
echo "هنوز <b>".$holdtotday1. "</b> روز تا ".date('H:i',$golds['b1'])."";

 }
?>

                </span>			</td>
			<td class="dur"><?php if(PLUS_PRODUCTION >= 86400){
			echo ''.(PLUS_PRODUCTION/86400).' روز';
			} else if(PLUS_PRODUCTION < 86400){
			echo ''.(PLUS_PRODUCTION/3600).' ساعت';
			} ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("25w")?></td>
			<td class="act">
<?php
if (getStatus("25w")){

if (mysql_num_rows($MyGold)) {
	if($golds['gold'] > getCoin("25w") && $tl_b1 < $date2) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=9'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
}elseif
	($golds['gold'] > getCoin("25w") && $datetime1 > $date2) {
	echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=9'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">تمدید</div></div></button>";
} else {
	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
    }
}
}else{
echo "غیر فعال";
}
?>
            </td>
		</tr>
			<tr>
			<td class="desc">
				+<b>25</b>% <img class="r2" src="img/x.gif" alt="خشت"> تولید: خشت<br>
				<span class="run">
                <?php

$tl_b2=$golds['b2'];
 if ($tl_b2 < $date2) {
     print " ";
 } else {
$holdtotmin2=(($tl_b2-$date2)/60);
$holdtothr2=(($tl_b2-$date2)/3600);
$holdtotday2=round(($tl_b2-$date2)/86400, 1);
$holdhr2=intval($holdtothr2-($holdtotday2*24));
$holdmr2=intval($holdtotmin2-(($holdhr2*60)+($holdtotday2*1440)));
}

 if ($tl_b2 < $date2) {
     print " ";
 } else {

echo "هنوز <b>".$holdtotday2. "</b> روز تا ".date('H:i',$golds['b2'])."";

 }
?>

                </span>			</td>
			<td class="dur"><?php if(PLUS_PRODUCTION >= 86400){
			echo ''.(PLUS_PRODUCTION/86400).' روز';
			} else if(PLUS_PRODUCTION < 86400){
			echo ''.(PLUS_PRODUCTION/3600).' ساعت';
			} ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای  t4dl"><?=getCoin("25c")?></td>
			<td class="act">
<?php
if (getStatus("25c")){

if (mysql_num_rows($MyGold)) {
	if($golds['gold'] > getCoin("25c") && $tl_b2 < $date2) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=10'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
}elseif
	($golds['gold'] > getCoin("25c") && $tl_b2 > $date2) {
	echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=10'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">تمدید</div></div></button>";
} else {
	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
    }
    }
    }else{
echo "غیر فعال";
}

 ?>

            </td>
		</tr>
			<tr>
			<td class="desc">
				+<b>25</b>% <img class="r3" src="img/x.gif" alt="آهن"> تولید: آهن<br>
				<span class="run">
<?php

$tl_b3=$golds['b3'];
 if ($tl_b3 < $date2) {
     print " ";
 } else {
$holdtotmin3=(($tl_b3-$date2)/60);
$holdtothr3=(($tl_b3-$date2)/3600);
$holdtotday3=round(($tl_b3-$date2)/86400, 1);
$holdhr3=intval($holdtothr3-($holdtotday3*24));
$holdmr3=intval($holdtotmin3-(($holdhr3*60)+($holdtotday3*1440)));
}

 if ($tl_b3 < $date2) {
     print " ";
 } else {
echo "هنوز <b>".$holdtotday3. "</b> روز تا ".date('H:i',$golds['b3'])."";

 }
?>

                </span>			</td>
			<td class="dur"><?php if(PLUS_PRODUCTION >= 86400){
			echo ''.(PLUS_PRODUCTION/86400).' روز';
			} else if(PLUS_PRODUCTION < 86400){
			echo ''.(PLUS_PRODUCTION/3600).' ساعت';
			} ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("25i")?></td>
			<td class="act">
<?php
if (getStatus("25i")){

if (mysql_num_rows($MyGold)) {
	if($golds['gold'] > getCoin("25i") && $tl_b3  < $date2) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=11'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
}elseif
	($golds['gold'] > getCoin("25i") && $tl_b3 > $date2) {
	echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=11'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">تمدید</div></div></button>";
} else  {
	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
} }
}else{
echo "غیر فعال";
}

 ?>
            </td>
		</tr>
			<tr>
			<td class="desc">
				+<b>25</b>% <img class="r4" src="img/x.gif" alt="گندم"> تولید: گندم<br>
<?php

$tl_b4=$golds['b4'];
 if ($tl_b4 < $date2) {
     print " ";
 } else {
$holdtotmin4=(($tl_b4-$date2)/60);
$holdtothr4=(($tl_b4-$date2)/3600);
$holdtotday4=round(($tl_b4-$date2)/86400, 1);
$holdhr4=intval($holdtothr4-($holdtotday4*24));
$holdmr4=intval($holdtotmin4-(($holdhr4*60)+($holdtotday4*1440)));
}

 if ($tl_b4 < $date2) {
     print " ";
 } else {

echo "هنوز <b>".$holdtotday4. "</b> روز تا ".date('H:i',$golds['b4'])."";
 }
?>
		</td>
			<td class="dur"><?php if(PLUS_PRODUCTION >= 86400){
			echo ''.(PLUS_PRODUCTION/86400).' روز';
			} else if(PLUS_PRODUCTION < 86400){
			echo ''.(PLUS_PRODUCTION/3600).' ساعت';
			} ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای  t4dl"><?=getCoin("25wh")?></td>
			<td class="act">
<?php
if (getStatus("25wh")){

if (mysql_num_rows($MyGold)) {
	if($golds['gold'] > getCoin("25wh") && $tl_b4 < $date2) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=12'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
}elseif
	($golds['gold'] > getCoin("25wh") && $tl_b4 > $date2) {
	echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=12'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">تمدید</div></div></button>";
} else {
	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
} }
}else{
echo "غیر فعال";
}

?>

            </td>
		</tr>
  </tbody>
</table>
<p>&nbsp;</p>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td>توضیح</td>

			<td>مدت زمان</td>
			<td>سکه ی طلای تراوین t4dl</td>
			<td>عمل</td>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td class="desc">تمامی ساخت ها و تحقیق های در حال انجام در این دهکده را
بصورت فوری تمام کن (در مورد اقامتگاه و قصر کار نمی کند).</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("baric")?></td>
			<td class="act">
<?php
if (getStatus("baric")){

if (mysql_num_rows($MyGold)) {
	if($golds['gold'] > getCoin("baric")) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=FinishBuilding'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";

} else {
	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
	}
}
}else{
echo "غیر فعال";
}

 ?>
			</td>
		</tr>
		<tr>
			<td class="desc">تمامی آموزش سربازان و ساخت ابزارآلات جنگی در حال اجرا در این دهکده را بصورت فوری تمام کن.</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("icasa")?></td>
			<td class="act">
<?php
if (getStatus("icasa")){

if (mysql_num_rows($MyGold)) {
	if($golds['gold'] > getCoin("icasa")) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=FinishTraining'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";

} else {
	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
	}
}
}else{
echo "غیر فعال";
}

 ?>
			</td>
		</tr>
		
	<tr>
			<td class="desc">50 نفر به جمعیت به این دهکده اضافه کن.</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("a50p")?></td>
			<td class="act">
<?php
if (getStatus("a50p")){

if (mysql_num_rows($MyGold)) {
    if($golds['gold'] > getCoin("a50p")) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=buypop'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
} else {
    	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}
}
}else{
echo "غیر فعال";
}

 ?>
			</td>
	  </tr>

		<tr>
			<td class="desc">بنا کردن یک اردوگاه سطح 20 در این دهکده به صورت فوری.</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("o20")?></td>
			<td class="act">
<?php
if (getStatus("a50p")){

if (mysql_num_rows($MyGold)) {
    if($village->resarray['f39'] < 20){
        if($golds['gold'] > getCoin("o20")) {
            echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=ordoogah'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
        } else {
            	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}
	}else{
    	echo '<span class="none">اردوگاه به سطح 20 رسیده.</span>';
    }
}
}else{
echo "غیر فعال";
}
?>
</td>
</tr>
		<tr>
			<td class="desc">بنا کردن یک انبار سطح 20 در این دهکده به صورت فوری.</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("khas20")?></td>
			<td class="act">
<?php


if (getStatus("khas20")){

if (mysql_num_rows($MyGold)) {
	$ag = getCoin("khas20");
    if(true){
        if($golds['gold'] >= $ag) {
            echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=anbar'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
        } else {
            	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}
	}
}
}else{
echo "غیر فعال";
}

?>
			</td>
		</tr>

<tr>
			<td class="desc">15% وفاداری به این دهکده اضافه کن .برای خرید لازم است شما بیش از 30 سکه داشته باشید ولی هزینه ی خرید 25 سکه است<br>حداکثر میزان وفاداری 125% میباشد</br></td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("a15v")?></td>
			<td class="act">
<?php
if (getStatus("a15v")){
if (mysql_num_rows($MyGold)) {
    if($golds['gold'] > getCoin("a15v")) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=buyloyalty'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
} else {
    	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}
}
}else{
echo "غیر فعال";
}

 ?>
			</td>
	  </tr>


        <tr>
			<td class="desc">خرید منابع به اندازه تولیدات 1 ساعت این دهکده. (این امکان در دهکده شگفتی جهان کار نمیکند)<br>
( <?=$usr['boughtmanabe2']?> خرید از <?=$cnf['maxmanabe2']?> خرید مجاز )</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("khm1td")?></td>
			<td class="act">
<?php
if (getStatus("khm1td") && checkLimit("boughtmanabe2","maxmanabe2")){
if (mysql_num_rows($MyGold)) {
    if($golds['gold'] > getCoin("khm1td")) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=manabe'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
} else {
   	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}
}
}else{
echo "غیر فعال";
}

 ?>
			</td>
		</tr>
<tr>
			<td class="desc">3000 امتیاز فرهنگی به این دهکده اضافه کن</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("a3hef")?></td>
			<td class="act">
<?php
if (getStatus("a3hef")){

if (mysql_num_rows($MyGold)) {
    if($golds['gold'] > getCoin("a3hef")) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=buycp'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
} else {
    	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}
}
}else{
echo "غیر فعال";
}

 ?>
			</td>
	  </tr>

<tr>
			<td class="desc">تمام سربازان در حال برگشت به دهکده را به صورت سريع به دهکده برگردان. سربازان در فاصله يک دقيقه اي بازگشت قرار خواهند گرفت. شما <?php echo $session->userinfo['bazgasht']; ?> خريد از بازگشت امکان خريد خود را انجام داده ايد.</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("bfh")?></td>
			<td class="act">
<?php
if (getStatus("bfh")){

if (mysql_num_rows($MyGold)) {
    if($golds['gold'] >= getCoin("bfh")) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=buyreturn'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
} else {
    	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}
}
}else{
echo "غیر فعال";
}

 ?>
			</td>
	  </tr>

<tr>
			<td class="desc">به ميزان يک انبار سطح بيست، در اين دهکده منابع خريداري کن. در دهکده شگفتي جهان خريد امکان پذير نيست.برای خرید لازم است شما بیش از 50 سکه داشته باشید ولی هزینه ی خرید 30 سکه است<br>
( <?=$usr['boughtmanabe']?> خرید از <?=$cnf['maxmanabe']?> خرید مجاز )</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("khm20dh")?></td>
			<td class="act">
<?php
if (getStatus("khm20dh") && checkLimit("boughtmanabe","maxmanabe")){

if (mysql_num_rows($MyGold)) {
    if($golds['gold'] > getCoin("khm20dh")) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=buymanabe'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
} else {
    	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}
}

}else{
echo "غیر فعال";
}


 ?>
			</td>
	  </tr>

</table>

<p>&nbsp;</p>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
  <thead>
    <tr>
			<td>توضیح</td>
			<td>مدت زمان</td>
			<td>سکه ی طلای تراوین t4dl</td>
			<td>عمل</td>
		</tr>
  </thead>
  <tr>
    			<td class="desc">1000 امتیاز به تجربه ی قهرمان اضافه کن</td>

    <td class="dur">فوری</td>
    <td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"><?=getCoin("1ebtgh")?></td>
	<td class="act"><center>
			  <?php
              if (getStatus("1ebtgh")){

if (mysql_num_rows($MyGold)) {
    if($golds['gold'] > getCoin("1ebtgh")) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=3&action=buyexp'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";
} else {
    	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}

} 
}else{
echo "غیر فعال";
}

?></center></td>
  </tr>
  		<tr>
			<td class="desc">خرید حمایت. پس از آزادی کتیبه ها تمام حمایت ها لغو می شود و امکان خرید وجود ندارد. خرید حمایت, حمله های جاری را بر روی دهکده لغو نمی کند. <small>شما <i><?php echo $userData['boughthelp']?></i> خرید از تعداد <?php echo HELP_MAX; ?> امکان خرید را انجام داده اید.</small></td>
			<td class="dur">6 ساعت</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="طلا"><?=getCoin("khhhh")?></td>
			<td class="act">

<?php 		

              if (getStatus("khhhh")){

			if($userData['gold'] > getCoin("khhhh")) {
echo "<button type=\"button\" value=\"".ACTIVATE."\" onclick=\"window.location.href = 'plus.php?id=16'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}else{echo "<button type=\"button\" value=\"".ACTIVATE."\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}
}else{
echo "غیر فعال";
}

?>
		</tr>
		<tr>
			<td class="desc">خرید ماجراجویی<br></td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="طلا"><?=getCoin("khmjjj")?></td>
			<td class="act">
<?php 					

              if (getStatus("khmjjj")){


if($userData['gold'] >= getCoin("khmjjj")) {
echo "<button type=\"button\" value=\"".ACTIVATE."\" onclick=\"window.location.href = 'plus.php?id=17'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}else{echo "<button type=\"button\" value=\"".ACTIVATE."\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}
}else{
echo "غیر فعال";
}

?>
		</tr>
		<tr>
			<td class="desc">خرید حیوانات سطح 1 برای همین دهکده<br></td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="طلا"><?=getCoin("khp1")?></td>
			<td class="act">
<?php 					

              if (getStatus("khp1")){


if($userData['gold'] >= getCoin("khp1")) {
echo "<button type=\"button\" value=\"".ACTIVATE."\" onclick=\"window.location.href = 'plus.php?id=3&action=ph1'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}else{echo "<button type=\"button\" value=\"".ACTIVATE."\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}
}else{
echo "غیر فعال";
}

?>
		</tr>
		<tr>
			<td class="desc">خرید حیوانات سطح 2 برای همین دهکده<br></td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="طلا"><?=getCoin("khp2")?></td>
			<td class="act">
<?php 					

              if (getStatus("khp2")){


if($userData['gold'] >= getCoin("khp2")) {
echo "<button type=\"button\" value=\"".ACTIVATE."\" onclick=\"window.location.href = 'plus.php?id=3&action=ph2'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}else{echo "<button type=\"button\" value=\"".ACTIVATE."\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}
}else{
echo "غیر فعال";
}

?>
		</tr>
		<tr>
			<td class="desc">خرید حیوانات سطح 3 برای همین دهکده<br></td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="طلا"><?=getCoin("khp3")?></td>
			<td class="act">
<?php 					

              if (getStatus("khp3")){


if($userData['gold'] >= getCoin("khp3")) {
echo "<button type=\"button\" value=\"".ACTIVATE."\" onclick=\"window.location.href = 'plus.php?id=3&action=ph3'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}else{echo "<button type=\"button\" value=\"".ACTIVATE."\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".ACTIVATE."</div></div></button>";
}
}else{
echo "غیر فعال";
}

?>
		</tr>
</table>
<p>&nbsp;</p>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td>توضیح</td>
			<td>مدت زمان</td>
			<td>سکه ی طلای تراوین t4dl</td>
			<td>عمل</td>
		</tr>
</thead>

			<tr>
			<td class="desc">تعدیل منابع بصورت 1:1</td>
			<td class="dur">فوری</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای  t4dl"><?=getCoin("tmb11")?></td>
			<td class="act link">
            <?php
            if($building->getTypeLevel(17)){ ?>
            <a class="arrow" href="build.php?gid=17&amp;t=3">ورود به بازار</a>
            <?php }else{ ?>
            <span class="none"><center>بازار بنا کن</center></span>
            <?php } ?>
			</td>
		</tr>
<tr>
				<td class="desc">مبادلۀ سکۀ طلای  t4dl و سکۀ نقرۀ  t4dl</td>
				<td class="dur">فوری</td>
				<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای <?php echo NAME_FA?>"></td>
				<td class="act arrow" style="text-align: right"><a class="arrow" href="plus.php?id=6">مبادله</a></td>
			</tr>
			        <tr>
				<td class="desc">انتقال سکه
				<td class="dur">فوری</td>
				<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای t4dl"></td>
				<td class="act arrow" style="text-align: right"><a class="arrow" href="plus.php?id=0">انتقال</a></td>
			</tr>
        </tbody>
</table>
<h4 class="spacer">&nbsp;</h4>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
		<thead>
			<tr>
			<td>توضیح</td>
			<td>مدت زمان</td>
			<td>سکه ی طلای تراوین t4dl</td>
			<td>عمل</td>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td class="desc">
					<a name="goldclub"></a>
					<b>کلوپ طلایی</b><br><font color = red>در حال حاضر امکانات کلوپ طلايي کامل نيست.</font>
</br>کلوپ طلايي در حال حاضر شامل: مرکز تحقيق 9/15 گندمي و لیست فارم ها مي باشد.
				</td>
				<td class="dur">
					تا پایان بازی فعال می باشد؛ امکانات اکانت پلاس و افزایش تولید
جز امکانات کلوپ طلایی نمی باشد.
				</td>
				<td class="cost"><img src="img/x.gif" class="gold" alt="سکۀ طلای  t4dl"><?=getCoin("ctt")?></td>
				<td class="act">
<?php
              if (getStatus("ctt")){

if($session->gold >= getCoin("ctt")){
	if($golds['goldclub'] == 0) {
		echo "<button type=\"button\" value=\"فعال سازی\" onclick=\"window.location.href = 'plus.php?id=15'; return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال سازی</div></div></button>";

	} else {
		echo "<button type=\"button\" value=\"فعال شده\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">فعال شده</div></div></button>";
	}
}else{
	echo "<button type=\"button\" value=\"فعال سازی\" class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">طلا کم است</div></div></button>";
}
               
               }else{
echo "غیر فعال";
}

               
                ?></td>
			</tr>



	</tbody>
</table>
<div class="clear">&nbsp;</div>