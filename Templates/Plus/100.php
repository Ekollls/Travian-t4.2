<?php
$resultc = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$cnf = mysql_fetch_array($resultc);
$resultu = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE username = '". $session->username ."'");
$usr = mysql_fetch_array($resultu);


$bpw = $cnf['bspw'];
$bserver = $cnf['bsserver'];


// get info from remote bank

$email = $usr['email'];
$result = file_get_contents($bserver."?function=check&type=account&email=".urlencode($email)."&bpw=".urlencode($bpw));
$result = json_decode($result);

$wage = $cnf['bsWage'];
$mpop = $cnf['bsMpop'];

$pop = $village->pop;

if(is_numeric($result->balance)) { $balance = $result->balance; } else { $balance = 0; };




if( $result->status == "ok" ) {
	if($_POST['action'] == "save" && $_POST['s_amount'] > 0) {
		if($pop > $mpop) {
			$amount = (int)$_POST['s_amount'];
			if($amount >= 10) {
				if( $session->gold > round($amount+($amount*($wage/100))) ) {
					$result = file_get_contents($bserver."?amount=".$amount."&function=save&type=account&email=".urlencode($email)."&bpw=".urlencode($bpw));
					$result = json_decode($result);
					if(is_numeric($result->balance)) { $balance = $result->balance; } else { $balance = 0; };
					mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - ". round($amount+($amount*($wage/100))) ." WHERE username ='". $session->username ."'");
					echo "<strong>". GB_M_2 ."</strong><br>";
				}else{
					echo "<strong>". GB_M_3 ."</strong><br>";
				}
			}else{
				echo "<strong>". GB_M_4 ."</strong><br>";
			}
		}else{
			echo "<strong>". GB_M_5 ."</strong><br>";
		}
	}
	if($_POST['action'] == "take" && $_POST['t_amount'] > 0) {
		if(/*$pop > $mpop*/ true) {
			$amount = (int)$_POST['t_amount'];
			if($amount >= 1) {
				$result = file_get_contents($bserver."?function=check&type=account&email=".urlencode($email)."&bpw=".urlencode($bpw));
				$result = json_decode($result);
				if(is_numeric($result->balance)) { $balance = $result->balance; } else { $balance = 0; };
				if( $balance >= $amount ) {
					$result = file_get_contents($bserver."?amount=".$amount."&function=take&type=account&email=".urlencode($email)."&bpw=".urlencode($bpw));
					$result = json_decode($result);
					if(is_numeric($result->balance)) { $balance = $result->balance; } else { $balance = 0; };
					mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold + ". round($amount) ." WHERE username ='". $session->username ."'");
					echo "<strong>". GB_M_6 ."</strong><br>";
				}else{
					echo "<strong>". GB_M_3 ."</strong><br>";
				}
			}else{
				echo "<strong>". GB_M_8 ."</strong><br>";
			}
		}else{
			echo "<strong>". GB_M_5 ."</strong><br>";
		}
	}
?>
<?=GB_M_TOP?>

<div style="display:block;border-bottom:1px black solid;font-size:14px;font-weight:bold;margin-top:8px;margin-bottom:5px;"><?=GB_M_10?></div>
<table>
<tr><td><?=GB_M_11?></td><td><b><?=$balance?></b> <img src="img/x.gif" class="gold" alt=""> <?=GB_M_12?></td></tr>
<tr><td><?=GB_M_13?></td><td><b><?=$wage?></b> <?=GB_M_14?></td></tr>
<tr><td><?=GB_M_15?></td><td><b><?=$mpop?></b> <?=GB_M_16?></td></tr>
</table>

<div style="display:block;border-bottom:1px black solid;font-size:14px;font-weight:bold;margin-top:8px;margin-bottom:5px;"><?=GB_M_17?></div>
<form action="?id=100" method="POST">
<input type="hidden" name="action" value="save">
<table>
<tr><td><?=GB_M_18?></td><td><input type="number" value="0" name="s_amount"></td></tr>
<tr><td></td><td><input type="submit" value="<?=GB_M_19?>"></td></tr>
</table>
</form>

<div style="display:block;border-bottom:1px black solid;font-size:14px;font-weight:bold;margin-top:8px;margin-bottom:5px;"><?=GB_M_20?></div>
<form action="?id=100" method="POST">
<input type="hidden" name="action" value="take">
<table>
<tr><td><?=GB_M_18?></td><td><input type="number" value="0" name="t_amount"></td></tr>
<tr><td></td><td><input type="submit" value="<?=GB_M_21?>"></td></tr>
</table>
</form>

<script type="text/javascript">
<?php
$result = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = ".$session->uid);
$row = mysql_fetch_array($result);
?>document.getElementById("ajaxReplaceableGoldAmount_2").innerHTML = <?=$row['gold']?>;
</script>





<?php
}else{
	echo '<center><a style="color:#F00">'.GB_M_1.'</a></center>';
}
?>
