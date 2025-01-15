<?php
include("Templates/Plus/pmenu.tpl");
$ttwarGoldArray = array();
$ttwarGoldArray['a'] = array('invoiceamountusd'=>0.5, 'invoiceamount'=>10000, 'goldcount'=>30, 'token'=>'c641dce87abd587ce4f348f5b11b33eb');
$ttwarGoldArray['b'] = array('invoiceamountusd'=>1, 'invoiceamount'=>30000, 'goldcount'=>100, 'token'=>'c641dce87abd587ce4f348f5b11b33eb');
$ttwarGoldArray['c'] = array('invoiceamountusd'=>2, 'invoiceamount'=>60000, 'goldcount'=>250, 'token'=>'c641dce87abd587ce4f348f5b11b33eb');
$ttwarGoldArray['d'] = array('invoiceamountusd'=>4, 'invoiceamount'=>120000, 'goldcount'=>600, 'token'=>'c641dce87abd587ce4f348f5b11b33eb');
$ttwarGoldArray['e'] = array('invoiceamountusd'=>8, 'invoiceamount'=>240000, 'goldcount'=>1600, 'token'=>'c641dce87abd587ce4f348f5b11b33eb');

require_once 'Templates/Plus/pasargad_config.php';
require_once 'Templates/Plus/pasargad.php';
if(isset($_GET['task']) && ($_GET['task']=='paypaad' || $_GET['task']=='failedpaypaad')){
	$invoicenumber = $_GET['iN']; $task = $_GET['task']; $isSuccess = ($task == 'paypaad');
	if($isSuccess){
		$i_date = $_GET['iD']; $i_number = $_GET['iN']; $tref = $_GET['tref'];
		$currentUserActiveBill = $database->userActiveBill($session->uid);
		$cart_data = array(
			'invoice_date'=>$currentUserActiveBill['invoicedate'],
			'invoice_number'=>$currentUserActiveBill['invoicenumber']
			);
		$cart = new PasargadCart($cart_data);
		$pasargad= new Pasargad();
		$response = $pasargad->getResponse($tref,$cart);
		if($response->result == 'true'){
			$transactionreferenceid = ($tref ? $tref :  $response->transaction_reference_id);
			if($database->approveUserActiveBill($invoicenumber,$transactionreferenceid,'paypaad')){
				echo TTWAR_SUCCESS_PAYPAAD;
				$userGold = $database->getUserField($currentUserActiveBill['uid'], 'gold', 0);
				$value = $currentUserActiveBill['goldcount']+$userGold;
				if($database->updateUserField($currentUserActiveBill['uid'], 'gold', $value, 1)){
					echo sprintf(TTWAR_SUCCESS_PAYPAAD_GOLD,$currentUserActiveBill['goldcount']);
					$database->updateUserField($currentUserActiveBill['uid'], 'boughtgold', $currentUserActiveBill['goldcount'], 2);
				} else{
					echo TTWAR_SUCCESS_PAYPAAD." ".TTWAR_ERROR_PAYPAAD_GOLD;
				}
			} else{
				echo TTWAR_SUCCESS_PAYPAAD." ".TTWAR_ERROR_PAYPAAD_SAVINGINBILL;
			}
		}else{
			echo TTWAR_ERROR_PAYPAAD_PAYMENT;
		}
	} else {
		echo TTWAR_ERROR_PAYPAAD_REFERER;
	}
}

$currentUserActiveBill = $database->userActiveBill($session->uid);
if(isset($_POST['task']) && $_POST['task']=='deletebill'){
	if($currentUserActiveBill && !$currentUserActiveBill[approved]){
		if($database->deleteUserActiveBill($session->uid)){
			echo TTWAR_SUCCESS_BILL_DELETED;
		}else{
			echo TTWAR_FAIL_BILL_DELETION;
		}
	}else{
		echo TTWAR_NO_ACTIVE_BILL;
	}
}
if(!$currentUserActiveBill && isset($_POST['task']) && $_POST['task']=='regbill'){
	if ($_POST['packageid']!='a' and $_POST['packageid']!='b' and $_POST['packageid']!='c' and $_POST['packageid']!='d' and $_POST['packageid']!='e') $_POST['packageid'] = 'a';
	$invoiceamountusd=$ttwarGoldArray[$_POST['packageid']]['invoiceamountusd']; $invoiceamount=$ttwarGoldArray[$_POST['packageid']]['invoiceamount'];
	$goldcount=$ttwarGoldArray[$_POST['packageid']]['goldcount']; $token = $ttwarGoldArray[$_POST['packageid']]['token'];
	$invoicedate = time();
	$uid = $session->uid;
	$buyer_name = $_POST['completename'];
	$buyer_tel = $_POST['tel'];
	$delivery_address = $_POST['address'];
	$description = 'Package '.$_POST['packageid'];
	$database->addBill($invoiceamountusd,$invoiceamount, $invoicedate, $goldcount, $uid, $buyer_name, $buyer_tel, $delivery_address, $description, $token);
}
$currentUserActiveBill = $database->userActiveBill($session->uid);
if($currentUserActiveBill){
	$cart_data = array(
		'time_stamp' => date('Y/m/d H:i:s'),
		'redirect_address' => "http://".$_SERVER['SERVER_NAME']."/plus.php?task=paypaad",
		'referrer_address' => "http://".$_SERVER['SERVER_NAME']."/plus.php?task=failedpaypaad",
		'invoice_date' => date('Y/m/d',$currentUserActiveBill['invoicedate']),
		'invoice_number' => $currentUserActiveBill['invoicenumber'],
		'total_amount' => $currentUserActiveBill['invoiceamount'],
		'buyer_name' => $currentUserActiveBill['buyer_name'],
		'buyer_tel' => $currentUserActiveBill['buyer_tel'],
		'delivery_address' => $currentUserActiveBill['delivery_address'],
		'cart'=>array(
					array(
						'content'=>'Gold',
						'fee'=>($currentUserActiveBill['invoiceamount']/$currentUserActiveBill['goldcount']),
						'count'=>$currentUserActiveBill['goldcount'],
						'description'=>$currentUserActiveBill['description']
					)
			)
		);

	$cart = new PasargadCart($cart_data);
	
	$pasargad = new Pasargad();
	$xml = $pasargad->createXML($cart);
	$sign = $pasargad->sign($xml);
		
	$paypaad->xml = $xml;
	$paypaad->sign = $sign;
	$paypaad->cart = $cart;
	echo '<div id="products"><table  class="product" cellpadding="1" cellspacing="1">';
	echo '<thead><tr><th colspan="2">'.YOUR_ACTIVE_BILL.'</th></tr></thead>';
	echo '<tr><td colspan="2"><img src="img/logoALL.jpg" border="0" width="203" alt="'.PAY_WAY_PAPAAD.'"/></td></tr>';
	echo '<tr><td>'.PAY_WAY.'</td><td>'.PAY_WAY_PAPAAD.'</td></tr>';
	echo '<tr><td>'.GOLD_AMOUNT.'</td><td>'.$currentUserActiveBill['goldcount'].'</td></tr>';
	echo '<tr><td>'.INVOICE_AMOUNT.'</td><td>'.$currentUserActiveBill['invoiceamount'].' '.IRR_SYMBOL.'</td></tr>';
	echo '<tr><td><form action="https://paypaad.bankpasargad.com/PaymentController" method="POST">';
	?>
	<input type="hidden" name="content" value='<?php echo $paypaad->xml;?>' />
	<input type="hidden" name="sign" value="<?php echo $paypaad->sign;?>" />
	<?php
	echo '<button type="submit" value="PAY" name="pay" id="pay"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">'.PAY.'</div></div></button></form></td>';
	echo '<td><form action="plus.php" method="POST">';
	echo '<input type="hidden" name="task" value="deletebill" />';
	echo '<button type="submit" value="CANCELPAY" name="cancelpay" id="cancelpay"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">'.CANCELPAY.'</div></div></button></form></td></tr>';
	echo '</table>';
	echo '</div>';
	/*
	echo '<div id="products" ><table  class="product" cellpadding="1" cellspacing="1">';
	echo '<thead><tr><th colspan="2">'.YOUR_ACTIVE_BILL.'</th></tr></thead>';
	echo '<tr><td colspan="2"><img src="https://images.cashu.com/images/cashULogo/en/153-75-11.jpg" alt="cashU | Online Payment Method" border="0" width="203" ></td></tr>';
	echo '<tr><td>'.PAY_WAY.'</td><td>'.PAY_WAY_CASHU.'</td></tr>';
	echo '<tr><td>'.GOLD_AMOUNT.'</td><td>'.$currentUserActiveBill['goldcount'].'</td></tr>';
	echo '<tr><td>'.INVOICE_AMOUNT.'</td><td>'.$currentUserActiveBill['invoiceamountusd'].' '.DOLAR_SYMBOL.'</td></tr>';
	echo '<form action="https://sandbox.cashu.com/cgi-bin/pcashu.cgi" method="post"><input type="hidden" name="merchant_id" value="vahidbarzegar">';
	echo '<input type="hidden" name="token" value="'.$currentUserActiveBill['token'].'">';
	echo '<input type="hidden" name="display_text" value="'.$currentUserActiveBill['description'].'">';
	echo '<input type="hidden" name="currency" value="USD">';
	echo '<input type="hidden" name="amount" value="'.$currentUserActiveBill['invoiceamountusd'].'">';
	echo '<input type="hidden" name="language" value="en">';
	echo '<input type="hidden" name="session_id" value="'.$_SESSION['id'].'">';
	echo '<input type="hidden" name="txt1" value="'.$currentUserActiveBill['description'].'">';
	echo '<input type="hidden" name="txt2" value="http://'.$_SERVER['SERVER_NAME'].'"><input type="hidden" name="txt3" value="'.$currentUserActiveBill['uid'].'"><input type="hidden" name="txt4" value="'.$_SESSION['lang'].'"><input type="hidden" name="txt5" value="">';
	echo '<tr><td><input type="submit" name="but" value="'.PAY.'"></form></form></td>';
	echo '<form action="plus.php" method="POST">';
	echo '<input type="hidden" name="task" value="deletebill" />';
	echo '<td><input type="submit" value="'.CANCELPAY.'" name="submit" /></td></tr></form>';
	echo '</table>';
	echo '</div>';*/

} elseif(true /*$session->access != BANNED*/){
	
?>
	
<h4 class="round space" style="color:#ff0000"><?php echo JUSTIRANIANCANBUY;?><span class="plus_g"></span></h4>
<div id="products">
	<form id="productsform" method="POST" action="plus.php">
		<table class="<?php echo 'lang_'.DIRECTION;?>" cellpadding="1" cellspacing="1" width="100%">
			<thead><tr><th style="direction:<?php echo DIRECTION;?>;font-family:arial;color:red;" colspan="2"><?php echo HOWTOBUY;?></th></tr></thead>
			<tbody>
				<tr>
					<td style="direction:<?php echo DIRECTION;?>;font-family:arial;color:green;" colspan="2"><?php echo BILLREGDESC;?>
					</td>
				</tr>
				<tr>
					<td style="direction:<?php echo DIRECTION;?>;font-family:arial;color:green;padding:5px;">
						<label for="packageid"><?php echo GOLDPACKAGE;?>: </label>
						<select name="packageid" id="packageid">
							<option value="a" selected="selected"><?php echo GOLDPACKAGEA;?></option>
							<option value="b"><?php echo GOLDPACKAGEB;?></option><option value="c"><?php echo GOLDPACKAGEC;?></option>
							<option value="d"><?php echo GOLDPACKAGED;?></option><option value="e"><?php echo GOLDPACKAGEE;?></option>
						</select>
					</td>
					<td style="direction:<?php echo DIRECTION;?>;font-family:arial;color:green;padding:5px;">
						<label for="completename"><?php echo FULLNAME;?>: </label><input type="text" name="completename" id="completename"/>
					</td>
				</tr>
				<tr>
					<td style="direction:<?php echo DIRECTION;?>;font-family:arial;color:green;padding:5px;">
						<label for="tel"><?php echo TEL;?>: </label><input type="text" name="tel" id="tel"/>
					</td>
					<td style="direction:<?php echo DIRECTION;?>;font-family:arial;color:green;padding:5px;">
						<label for="address"><?php echo ADDRESS;?>: </label><input type="text" name="address" id="address"/>
					</td>
				</tr>
				<tr>
					<td style="direction:<?php echo DIRECTION;?>;font-family:arial;color:green;padding:5px;" colspan="2">
						<button type="submit" value="regbill" name="regbill" id="regbill"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo REGBILL;?></div></div></button>
					</td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="task" id="task" value="regbill"/>
	</form>
	<div class="productBackground <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?>">
	    <table class="transparent product <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?>"	cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th>
						<div class="boxes boxesColor orange">
							<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div>
							<div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div>
							<div class="boxes-bc"></div><div class="boxes-contents cf"><?php echo GOLDPACKAGEA;?></div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr><td class="pic"><img src="img/tarrif/paket_a.jpg" style="width:99px; height:99px;" alt="<?php echo GOLDPACKAGEA;?>" /></td></tr>
				<tr><td class="units"><?php echo $ttwarGoldArray['a']['goldcount'].' '.TTWARGOLD;?></td></tr>
				<?php if ($_SESSION['lang']=='fa') {echo '<tr><td class="price">'.$ttwarGoldArray['a']['invoiceamount'].' '.IRR_SYMBOL.'</td></tr>';}
				else { echo '<tr><td class="price">'.$ttwarGoldArray['a']['invoiceamountusd'].' '.DOLAR_SYMBOL.'</td></tr>';}?>
			</tbody>
		</table>
	</div>
	<div class="productBackground <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?>">
	    <table class="transparent product <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?> " cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th>
						<div class="boxes boxesColor orange">
							<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div>
							<div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div>
							<div class="boxes-bc"></div><div class="boxes-contents cf"><?php echo GOLDPACKAGEB;?></div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr><td class="pic"><img src="img/tarrif/paket_b.jpg" style="width:99px; height:99px;" alt="<?php echo GOLDPACKAGEB;?>" /></td></tr>
				<tr><td class="units"><?php echo $ttwarGoldArray['b']['goldcount'].' '.TTWARGOLD;?></td></tr>
				<?php if ($_SESSION['lang']=='fa') {echo '<tr><td class="price">'.$ttwarGoldArray['b']['invoiceamount'].' '.IRR_SYMBOL.'</td></tr>';}
				else { echo '<tr><td class="price">'.$ttwarGoldArray['b']['invoiceamountusd'].' '.DOLAR_SYMBOL.'</td></tr>';}?>
			</tbody>
		</table>
	</div>
	<div class="productBackground <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?>">
	    <table class="transparent product <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?> " cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th>
						<div class="boxes boxesColor orange">
							<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div>
							<div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div>
							<div class="boxes-bc"></div><div class="boxes-contents cf"><?php echo GOLDPACKAGEC;?></div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr><td class="pic"><img src="img/tarrif/paket_c.jpg" style="width:99px; height:99px;" alt="<?php echo GOLDPACKAGEC;?>" /></td></tr>
				<tr><td class="units"><?php echo $ttwarGoldArray['c']['goldcount'].' '.TTWARGOLD;?></td></tr>
				<?php if ($_SESSION['lang']=='fa') {echo '<tr><td class="price">'.$ttwarGoldArray['c']['invoiceamount'].' '.IRR_SYMBOL.'</td></tr>';}
				else { echo '<tr><td class="price">'.$ttwarGoldArray['c']['invoiceamountusd'].' '.DOLAR_SYMBOL.'</td></tr>';}?>
			</tbody>
		</table>
	</div>
	<div class="productBackground <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?>">
	    <table class="transparent product <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?> " cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th>
						<div class="boxes boxesColor orange">
							<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div>
							<div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div>
							<div class="boxes-bc"></div><div class="boxes-contents cf"><?php echo GOLDPACKAGED;?></div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr><td class="pic"><img src="img/tarrif/paket_d.jpg" style="width:99px; height:99px;" alt="<?php echo GOLDPACKAGED;?>" /></td></tr>
				<tr><td class="units"><?php echo $ttwarGoldArray['d']['goldcount'].' '.TTWARGOLD;?></td></tr>
				<?php if ($_SESSION['lang']=='fa') {echo '<tr><td class="price">'.$ttwarGoldArray['d']['invoiceamount'].' '.IRR_SYMBOL.'</td></tr>';}
				else { echo '<tr><td class="price">'.$ttwarGoldArray['d']['invoiceamountusd'].' '.DOLAR_SYMBOL.'</td></tr>';}?>
			</tbody>
		</table>
	</div>
	<div class="productBackground <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?>">
	    <table class="transparent product <?php echo 'lang_'.DIRECTION;?> <?php echo 'lang_'.$_SESSION['lang'];?> " cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th>
						<div class="boxes boxesColor orange">
							<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div>
							<div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div>
							<div class="boxes-bc"></div><div class="boxes-contents cf"><?php echo GOLDPACKAGEE;?></div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr><td class="pic"><img src="img/tarrif/paket_e.jpg" style="width:99px; height:99px;" alt="<?php echo GOLDPACKAGEE;?>" /></td></tr>
				<tr><td class="units"><?php echo $ttwarGoldArray['e']['goldcount'].' '.TTWARGOLD;?></td></tr>
				<?php if ($_SESSION['lang']=='fa') {echo '<tr><td class="price">'.$ttwarGoldArray['e']['invoiceamount'].' '.IRR_SYMBOL.'</td></tr>';}
				else { echo '<tr><td class="price">'.$ttwarGoldArray['e']['invoiceamountusd'].' '.DOLAR_SYMBOL.'</td></tr>';}?>
			</tbody>
		</table>
	</div>
	<div class="clear"></div>
</div>
<?php } ?>
