<?php


if($_POST['gold']){
    $golds = $_POST['gold'];
    $other = $_POST['other'];
    $password = md5($_POST['password']);
    $uid = $session->uid;

    $_SESSION['error_transfer_gold_35'] = NULL;
    $_SESSION['error_transfer_gold_less'] = NULL;
    $_SESSION['error_transfer_gold_pass'] = NULL;
    $_SESSION['error_transfer_gold_user'] = NULL;

    $key1=$key2=$key3=$key4=1;
    if($golds <= 35){
        $_SESSION['error_transfer_gold_35'] = '&#1591;&#1604;&#1575;&#1740; &#1575;&#1606;&#1578;&#1582;&#1575;&#1576;&#1740; &#1576;&#1585;&#1575;&#1740; &#1575;&#1606;&#1578;&#1602;&#1575;&#1604; &#1705;&#1605;&#1578;&#1585; &#1575;&#1586; 35 &#1605;&#1740; &#1576;&#1575;&#1588;&#1583; &#1604;&#1591;&#1601;&#1575; &#1593;&#1583;&#1583; &#1583;&#1740;&#1711;&#1585;&#1740; &#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;';
		$key1 = 0;
		}
    
    if($session->gold < $golds){
        $_SESSION['error_transfer_gold_less'] = '&#1591;&#1604;&#1575; &#1705;&#1575;&#1601;&#1740; &#1606;&#1583;&#1575;&#1585;&#1740;&#1583;';
		$key2 = 0;
	}

    $result = mysql_query("SELECT * FROM s1_users WHERE id = '$uid' AND password = '$password'" ) or die(mysql_error());
    if(!mysql_fetch_assoc($result)){
        $_SESSION['error_transfer_gold_pass'] = '&#1705;&#1604;&#1605;&#1607; &#1593;&#1576;&#1608;&#1585; &#1575;&#1606;&#1578;&#1582;&#1575;&#1576;&#1740; &#1594;&#1604;&#1591; &#1605;&#1740; &#1576;&#1575;&#1588;&#1583;';
		$key3 = 0;
	}
    
    $result = mysql_query("SELECT * FROM s1_users WHERE username = '$other'" ) or die(mysql_error());
    if(!mysql_fetch_assoc($result)){
        $_SESSION['error_transfer_gold_user'] = '&#1575;&#1740;&#1606; &#1575;&#1705;&#1575;&#1606;&#1578; &#1605;&#1608;&#1580;&#1608;&#1583; &#1606;&#1605;&#1740; &#1576;&#1575;&#1588;&#1583;';
		$key4 = 0;
	}
    if($key1 && $key2 && $key3 && $key4){
        mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - ".$golds." WHERE id = '".$uid."'");
        mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold + ".$golds." WHERE username = '".$other."'");
//        exit();
    header("Location: plus.php?id=0");

    }
    
                
}                


?>

<div id="silverExchange">
	
	<?php $id = $_SESSION['id']; ?>
        

        
<form action="plus.php?id=0" method="post">
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        <p>
        <?php
            if($_SESSION['error_transfer_gold_35']) {
                echo "<h4 style='color: red; text-align: center;'>{$_SESSION['error_transfer_gold_35']}<h4>";
			}
            if($_SESSION['error_transfer_gold_less'])
                echo "<h4 style='color: red; text-align: center;'>{$_SESSION['error_transfer_gold_less']}<h4>";
            if($_SESSION['error_transfer_gold_pass'])
                echo "<h4 style='color: red; text-align: center;'>{$_SESSION['error_transfer_gold_pass']}<h4>";
            if($_SESSION['error_transfer_gold_user'])
                echo "<h4 style='color: red; text-align: center;'>{$_SESSION['error_transfer_gold_user']}<h4>";
        ?>
        </p>
    
    <h3>&#1575;&#1606;&#1578;&#1602;&#1575;&#1604; &#1587;&#1705;&#1607; &#1591;&#1604;&#1575;</h3>
<table cellpadding="1" cellspacing="1" class="transparent">
  <tbody>
    <tr>
      <td colspan="2">
&#1583;&#1585; &#1575;&#1610;&#1606; &#1602;&#1587;&#1605;&#1578; &#1588;&#1605;&#1575; &#1602;&#1575;&#1583;&#1585; &#1576;&#1607; &#1575;&#1606;&#1578;&#1602;&#1575;&#1604; &#1587;&#1705;&#1607; &#1607;&#1575;&#1610; &#1575;&#1705;&#1575;&#1606;&#1578; &#1582;&#1608;&#1583; &#1576;&#1607; &#1575;&#1705;&#1575;&#1606;&#1578; &#1583;&#1610;&#1711;&#1585;&#1610; &#1605;&#1610; &#1576;&#1575;&#1588;&#1610;&#1583;.
<ul>
<li>
&#1581;&#1583;&#1575;&#1705;&#1579;&#1585; &#1576;&#1607; &#1605;&#1610;&#1586;&#1575;&#1606; &#1582;&#1585;&#1610;&#1583;&#1575;&#1585;&#1610; &#1588;&#1583;&#1607; &#1583;&#1585; &#1575;&#1610;&#1606; &#1576;&#1575;&#1586;&#1610; &#1602;&#1575;&#1583;&#1585; &#1576;&#1607; &#1575;&#1606;&#1578;&#1602;&#1575;&#1604; &#1608; &#1584;&#1582;&#1610;&#1585;&#1607; &#1587;&#1705;&#1607; &#1607;&#1587;&#1578;&#1610;&#1583;.
</li>
<li>
&#1581;&#1583;&#1575;&#1602;&#1604; &#1587;&#1705;&#1607; &#1607;&#1575; &#1576;&#1585;&#1575;&#1610; &#1575;&#1606;&#1578;&#1602;&#1575;&#1604; 35 &#1587;&#1705;&#1607; &#1575;&#1587;&#1578;.
</li>
</ul>

      </td>
    </tr>
    <tr>
      <td>&#1578;&#1593;&#1583;&#1575;&#1583;</td>
      <td><input class="text" type="text" name="gold" value="0"></td>
    </tr>
    <tr>
      <td>&#1575;&#1705;&#1575;&#1606;&#1578;</td>
      <td><input class="text" type="text" name="other" value"></td>
    </tr>
    <tr>
      <td>&#1576;&#1575; &#1585;&#1605;&#1586; &#1578;&#1575;&#1610;&#1740;&#1583; &#1705;&#1606;&#1740;&#1583;</td>
      <td><input class="text" type="password" name="password" maxlength="20"></td>
    </tr>
    <tr>
    <td></td>
    <td>
<br />
<button type="submit" value="&#1575;&#1606;&#1578;&#1602;&#1575;&#1604;"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">&#1575;&#1606;&#1578;&#1602;&#1575;&#1604;</div></div></button>
    </td>
    </tr>
  </tbody>
</table>

</form>
                
</div>
<script type="text/javascript">
	window.addEvent('domready', function(){
		new Travian.Game.GoldToSilver({
			elementInputGold: 'goldInput',
			elementInputSilver: 'silverInput',
			elementResultGold: 'goldResult',
			elementResultSilver: 'silverResult',
			gold: <?php echo $session->gold; ?>,
			silver: <?php echo $session->silver; ?>,
			rateGoldToSilver: 100,
			rateSilverToGold: 200
		});
	});
</script>
<?php
    $_SESSION['error_transfer_gold_35'] = NULL;
    $_SESSION['error_transfer_gold_less'] = NULL;
    $_SESSION['error_transfer_gold_pass'] = NULL;
    $_SESSION['error_transfer_gold_user'] = NULL;
?>
