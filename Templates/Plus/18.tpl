<?php
include("Templates/Plus/pmenu.tpl");
date_default_timezone_set("Asia/Tehran");
$uid = $session->uid;


// Process the draw

$dresult = mysql_query("SELECT * FROM ".TB_PREFIX."draw WHERE Proc!='yes' LIMIT 1");
if( mysql_num_rows($dresult)>0 ) {
	$drow = mysql_fetch_array($dresult);
	$now = $drow['TS'];
	$abc =  ( (date("H",$now)*3600)) + (3600*2) + (date("i",$now)*60) + (date("s",$now));
	$lastDraw = ( $drow['TS'] - $abc );
	$nextDraw = $lastDraw + 2*(24*3600);

	if (time() > $nextDraw) {
	
		$dusers = array();
		$dgold = 0;
		$dresult = mysql_query("SELECT * FROM ".TB_PREFIX."draw WHERE Proc!='yes'");
		while( $drow = mysql_fetch_array($dresult) ) {
			array_push($dusers,$drow['UID']);
			$dgold = $dgold + $drow['Amount'];
		}
		$randd = mt_rand(0,count($dusers)-1);
		$did = $dusers[$randd];
		
		$dgold = 95*$dgold/100;
		mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold + $dgold WHERE id='$did'");
		mysql_query("UPDATE ".TB_PREFIX."users SET giftgold = giftgold + $dgold WHERE id='$did'");
		mysql_query("UPDATE ".TB_PREFIX."draw SET wAmount = '$dgold' WHERE UID='$did' AND Proc!='yes'");
		mysql_query("UPDATE ".TB_PREFIX."draw SET Status = 'nochance' WHERE Proc!='yes'");
		mysql_query("UPDATE ".TB_PREFIX."draw SET Status = 'won' WHERE UID='$did' AND Proc!='yes'");
		mysql_query("UPDATE ".TB_PREFIX."draw SET Proc = 'yes'");
	}
}
	




// Check to join the user or not
if(@$_GET['join']=="yes") {
	$result = mysql_query("SELECT * FROM ".TB_PREFIX."draw WHERE Proc!='yes' AND UID='$uid'");
	if(mysql_num_rows($result)>0) {
		echo "<b>پیام: </b>"."شما قبلا در این دوره شرکت کرده اید"."<br>";
	}else{
		if ( $session->gold >= 20 ) {
			$now = time();
			mysql_query("UPDATE ".TB_PREFIX."users SET gold = gold - 20 WHERE id = '$uid'");
			mysql_query("INSERT INTO ".TB_PREFIX."draw(UID,Amount,Status,Proc,TS) VALUES('$uid','20','pending','no','$now')");
			echo "<b>پیام: </b>"."با موفقیت در قرعه کشی شرکت داده شدید.<br>";
		}else{
			echo "<b>پیام: </b>"."شما به مقدار کافی طلا ندارید!<br>";
		}
	}
	
}

?>
شما می توانید در قرعه کشی روزانه شرکت کنید و شانس خود را امتحان کنید!<br>
قرعه کشی هر روز ساعت 10 شب انجام شده و برای شرکت در آن باید 20<img src="img/x.gif" alt="سکه طلا" class="gold"> خرج کنید. هنگام اعلام برنده قرعه کشی, تمام طلاهایی که بازیکن ها برای شرکت در قرعه کشی خرج کرده اند به اکانت او منتقل می شود.<br>
با کلیک روی گزینه زیر در قرعه کشی امشب شرکت داده خواهید شد.<br>
<center><?php
$result = mysql_query("SELECT * FROM ".TB_PREFIX."draw WHERE Proc!='yes' AND UID='$uid'");
if(mysql_num_rows($result)>0) {
	echo "شما در این دوره شرکت کرده اید. لازم به شرکت دوباره نیست!";
	}else{
		echo'<a href="?id=18&join=yes"><input type="button" value="شرکت در قرعه کشی"></a>';
	};?></center>
<hr>
<h2>شرکت کنندگان این دوره قرعه کشی</h2><br>
<table>
<tr><td>ردیف</td><td>نام کاربر</td><td>طلای خرج شده</td><td>زمان شرکت</td></tr>
<?php
$result = mysql_query("SELECT * FROM ".TB_PREFIX."draw WHERE Proc!='yes' AND UID='$uid'");
if(mysql_num_rows($result) > 0) {
	while( $row = mysql_fetch_array($result) ) {
		$rr = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id='".$row['UID']."'");
		$rrr = mysql_fetch_array($rr);
		$uname2 = $rrr['username'];
		$now = time();
		$tt = $now - $row['TS'];
		if($tt > 3600) {
			$wr = round($tt/3600,0)." ساعت پیش";
		}else{
			$wr = round($tt/60) ." دقیقه پیش";
		}
		echo "<tr><td>".$row['ID']."</td><td>$uname2</td><td>".$row['Amount'].'<img src="img/x.gif" alt="سکه طلا" class="gold">'."</td><td>حدود $wr</td></tr>";
	}
}else{
	echo "<tr><td colspan=\"4\"><center>هنوز کسی در این دوره قرعه کشی شرکت نکرده است. اولین باشید!</center></td></tr>";
}




?>
</table>


<hr>
<h2>تاریخچه برندگان</h2><br>
<table>
<tr><td>دوره پیش</td><td>نام کاربر</td><td>تعداد سکه برنده شده</td></tr>
<?php
$e = 1;
$result = mysql_query("SELECT * FROM ".TB_PREFIX."draw WHERE Proc='yes' AND Status='won'");
if(mysql_num_rows($result) > 0) {
	while( $row = mysql_fetch_array($result) ) {
		$rr = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id='".$row['UID']."'");
		$rrr = mysql_fetch_array($rr);
		$uname2 = $rrr['username'];
		echo "<tr><td>".$e."</td><td>$uname2</td><td>".$row['wAmount'].'<img src="img/x.gif" alt="سکه طلا" class="gold">'."</td></tr>";
		$e+=1;
	}
}else{
	echo "<tr><td colspan=\"3\"><center>تابحال برنده ای وجود نداشته است!</center></td></tr>";
}




?>
</table>
