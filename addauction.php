<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");

include_once("GameEngine/Village.php");
if($session->access != ADMIN) { 
	echo "شما ادمين نيستيد لطفا تلاش نکنيد."; 
} 
else{

			function addAuctionNew($owner,$btype,$type,$amount,$mtime) {
				global $database;
				$time = time()+$mtime;
        		$q = "INSERT INTO " . TB_PREFIX . "heroitems (`uid`, `btype`, `type`, `num`, `proc`) VALUES ('$owner', '$btype', '$type', '$amount', 1)";
        		mysql_query($q, $database->connection);
				$item_id = mysql_insert_id($database->connection);
				
				if($btype==7 || $btype==8 || $btype==9 || $btype==10 || $btype==11 || $btype==13 || $btype==14){
					$silver = $amount;
						$q = "INSERT INTO " . TB_PREFIX . "auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `time`, `finish`) VALUES ('$owner', '$itemid', '$btype', '$type', '$amount', 0, 0, '$silver', '$time', 0)";
						mysql_query($q);
				}else{
					$silver = 100;
					$q = "INSERT INTO " . TB_PREFIX . "auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `time`, `finish`) VALUES ('$owner', '$itemid', '$btype', '$type', '$amount', 0, 0, '$silver', '$time', 0)";
						mysql_query($q);
				}
					
        	}

$items = array (
					array (		"name"			=>			"",
								"pname"			=>			""
						   ),
					array (		"name"			=>			"helmet",
								"pname"			=>			"کلاه"
						   ),
					array (		"name"			=>			"body",
								"pname"			=>			"اجناس بدن"
						   ),
					array (		"name"			=>			"leftHand",
								"pname"			=>			"اجناس دست چپ"
						   ),
					array (		"name"			=>			"rightHand",
								"pname"			=>			"اجناس دست راست"
						   ),
					array (		"name"			=>			"shoes",
								"pname"			=>			"کفش"
						   ),
					array (		"name"			=>			"horse",
								"pname"			=>			"اسب"
						   ),
					array (		"name"			=>			"bandage25",
								"pname"			=>			"نوار برای زخم کوچک"
						   ),
					array (		"name"			=>			"bandage33",
								"pname"			=>			"نوار زخم"
						   ),
					array (		"name"			=>			"cage",
								"pname"			=>			"قفس"
						   ),
					array (		"name"			=>			"scroll",
								"pname"			=>			"کتیبه"
						   ),
					array (		"name"			=>			"ointment",
								"pname"			=>			"پماد"
						   ),
					array (		"name"			=>			"bucketOfWater",
								"pname"			=>			"سطل"
						   ),
					array (		"name"			=>			"bookOfWisdom",
								"pname"			=>			"کتاب های دانش"
						   ),
					array (		"name"			=>			"lawTables",
								"pname"			=>			"لوح قانون"
						   ),
					array (		"name"			=>			"artWork",
								"pname"			=>			"اثر هنری"
						   )
);

$status = "";
if (isset($_POST['submitted']) && $_POST['submitted']=="yes") {
	if (isset($_POST["time"]) && !$_POST["time"]=="" && is_numeric($_POST['time'])) {
		$mtime = $_POST['time']*60*60;
	}else{
		$mtime = 60*60;
	}
	if (isset($_POST["repeat"]) && !$_POST["repeat"]=="" && is_numeric($_POST['repeat'])) {
		$repeat = $_POST['repeat'];
	}else{
		$repeat = 1;
	}
	for($y=1;$y<16;$y++) {
		if (isset($_POST[$y."_c"]) && !$_POST[$y."_c"]=="") {
			if (isset($_POST[$y."_n"]) && is_numeric($_POST[$y."_n"]) && $_POST[$y."_n"]>0) {
				$btype = $_POST[$y."_c"];
				$item_id = $y;
				$item_qty = $_POST[$y."_n"];
				$qty = $item_qty;
				for($z=0;$z<$repeat;$z++) {
					if($btype==1){
						$type=rand(1,15);
						$item_qty = 1;
					}
					elseif($btype==2){
						$type=rand(82,93);
						$item_qty = 1;
					}
					elseif($btype==3){
						$type=rand(61,81);
						$item_qty = 1;
					}
					elseif($btype==4){
						$type=rand(16,60);
						$item_qty = 1;
					}
					elseif($btype==5){
						$type=rand(94,102);
						$item_qty = 1;
					}
					elseif($btype==6){
						$type=rand(103,105);
						$item_qty = 1;
					}
					elseif($btype==7){
						$type=112;
					}
					elseif($btype==8){
						$type=113;
					}
					elseif($btype==9){
						$type=114;
					}
					elseif($btype==10){
						$type=107;
					}
					elseif($btype==11){
						$type=106;
					}
					elseif($btype==12){
						$type=108;
					}
					elseif($btype==13){
						$type=110;
						$item_qty = 1;
					}
					elseif($btype==14){
						$type=109;
						$item_qty = 1;
					}
					elseif($btype==15){
						$type=111;
					}
					$item_qty = $qty;
					addAuctionNew("4",$btype,$type,$item_qty,$mtime);	
					$status .= "- تعداد ".$item_qty." عدد ".$items[$item_id]['pname']." به حراجی اضافه شد.<br>";	
				}
			}
		}
	}
}




?>


<form action="" method="post">
<input type="hidden" name="submitted" value="yes">
آیتم مورد نظر خود را انتخاب کنید:<br>
<table>
<tr><td>انتخاب</td><td>آیکن</td><td>نام</td><td>تعداد</td></tr>

<?php
for($i=1;$i<16;$i++) {
	echo '<tr>';
	
	
	echo '<td><input type="checkbox" name="'.$i.'_c" value="'.$i.'"></td>';
	echo '<td><img src="img/x.gif" class="itemCategory itemCategory_'.$items[$i]['name'].'"></td>';
	echo '<td>'.$items[$i]['pname'].'</td>';
	echo '<td>'.'<input type="number" name="'.$i.'_n" value="1">'.'</td>';
	echo '</tr>';
};


?>
</table>
تکرار: <input type="number" value="1" name="repeat"><br>
زمان: <input type="number" value="1" name="time"> ساعت<br>
<input type="submit" value="ارسال به حراجی">
</form>
<br><br><br>
<?php
if($status!=""){
echo $status;
}
?>
<?php }
?>

