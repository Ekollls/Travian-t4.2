<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\">Error creating constant.php check chmod.</span></div><br>";
}
?>
<form action="process.php" method="post" id="dataform">
<div id="statLeft" class="top10Wrapper">
<h4 class="round small  top top10_offs">Game Server Settings</h4>
<table cellpadding="1" cellspacing="1" id="top10_offs" class="top10 row_table_data">

    	<tr class="hover">
			<td>نام سرور:</td>
			<td><input type="text" dir="rtl" class="text" name="servername" id="servername" value="mersad_mr@att.net"></td>
		</tr>
        <tr class="hover">
			<td>سرعت:</td>
			<td><input name="speed" dir="rtl" class="text" type="text" id="speed" value="200"></td>
		</tr>
		<tr class="hover">
			<td>مدت زمان سرور:</td>
			<td><input name="roundlenght" dir="rtl" class="text" type="text" id="roundlenght" value="7"></td>
		</tr>
    	<tr class="hover">
			<td>سرعت نیرو ها:</td>
			<td><input type="text" dir="rtl" class="text" name="incspeed" id="incspeed" value="50"></td>
		</tr>
		<tr class="hover">
			<td>ضریب قدرت قهرمان</td>
			<td><input type="text" dir="rtl" class="text" name="heroattrspeed" id="heroattrspeed" value="2"></td>
		</tr>
		<tr class="hover">
			<td>ضریب قدرت آیتم ها</td>
			<td><input type="text" dir="rtl" class="text" name="itemattrspeed" id="itemattrspeed" value="3"></td>
		</tr>
    	<tr class="hover">
			<td>اندازه نقشه:</td>
			<td><select name="wmax" dir="rtl" class="text">
		<option value="100" selected="selected">100x100</option>
        <option value="250">250x250</option>
        <option value="350">350x350</option>
        <option value="400">400x400</option></select></td>
		</tr>
		<tr class="hover">
			<td>اندازه منطقه خاکستری:</td>
			<td><input type="text" dir="rtl" class="text" name="natars_max" id="natars_max" value="22.1"></td>
		</tr>
    	<tr class="hover">
			<td>باز یا بسته بودن ثبت نام:</td>
			<td><select name="reg_open" dir="rtl" class="text">
	  <option value="false">بسته</option>
	  <option value="true" selected="selected">باز</option></select></td>
		</tr>
    	<tr class="hover">
			<td>دامنه:</td>
			<td><input name="domain" dir="rtl" class="text" type="text" id="domain" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/"></td>
		</tr>
    	<tr class="hover">
			<td>صفحه اصلی:</td>
			<td><input name="homepage" dir="rtl" class="text" type="text" id="homepage" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/"></td>
		</tr>
    	<tr class="hover">
			<td>آدرس سرور:</td>
			<td><input name="server_url" dir="rtl" class="text" type="text" id="server_url" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/"></td>
		</tr>
    	<tr class="hover">
			<td>زبان:</td>
			<td><select name="lang" dir="rtl" class="text">
		<option value="fa" selected="selected">فارسی</option><option value="en">انگلیسی</option></select></td>
    	<tr class="hover">
			<td>&#1605;&#1740;&#1586;&#1575;&#1606; &#1575;&#1606;&#1576;&#1575;&#1585; &#1608; &#1575;&#1606;&#1576;&#1575;&#1585; &#1587;&#1608;&#1604;&#1607;:</td>
			<td><input name="storagemultiplier" dir="rtl" class="text" type="text" id="storagemultiplier" value="1"></td>
		</tr>
    	<tr class="hover">
			<td>ضریب انبار ها:</td>
			<td><input name="zmultiplier" dir="rtl" class="text" type="text" id="zmultiplier" value="1"></td>
		</tr>
               	<tr class="hover">
		<td>Yahoo ID:</td>
		<td><input type="text" name="yid" dir="ltr" class="text"></td>
           </tr>
    	<tr class="hover">
			<td>&#1587;&#1575;&#1593;&#1578; &#1581;&#1605;&#1575;&#1740;&#1578; &#1575;&#1586; &#1576;&#1575;&#1586;&#1740;&#1705;&#1606;:</td>
			<td>
				<select name="minbeginner" dir="rtl" class="text" id="minbeginner">
					  <option value="0" selected="selected">&#1607;&#1740;&#1670;</option>
					  <option value="1200">20 &#1583;&#1602;&#1740;&#1602;&#1607;</option>
					  <option value="1800">30 &#1583;&#1602;&#1740;&#1602;&#1607;</option>
					  <option value="3600">1 &#1587;&#1575;&#1593;&#1578;</option>
					  <option value="10800">3 &#1587;&#1575;&#1593;&#1578;</option>
					  <option value="21600">6 &#1587;&#1575;&#1593;&#1578;</option>
					  <option value="43200">12 &#1587;&#1575;&#1593;&#1578;</option>
					  <option value="86400">1 &#1585;&#1608;&#1586;</option>
					  <option value="172800">2 &#1585;&#1608;&#1586;</option>
					  <option value="259200">3 &#1585;&#1608;&#1586;</option>
					  <option value="604800">7 &#1585;&#1608;&#1586;</option>
					  <option value="1209600">14 &#1585;&#1608;&#1586;</option>
				</select>
			  </td>
		</tr>
    	<tr class="hover">
			<td>&#1586;&#1605;&#1575;&#1606; &#1576;&#1606;&#1583;&#1740; &#1581;&#1601;&#1575;&#1592;&#1578; &#1576;&#1575;&#1740;&#1583; &#1576;&#1575; &#1581;&#1605;&#1575;&#1740;&#1578; &#1740;&#1705;&#1740; &#1576;&#1575;&#1588;&#1583;:</td>
			<td>
				<select name="maxbeginner" dir="rtl" class="text" id="maxbeginner">
					  <option value="0" selected="selected">&#1607;&#1740;&#1670;</option>
					  <option value="1200">20 &#1583;&#1602;&#1740;&#1602;&#1607;</option>
					  <option value="1800">30 &#1583;&#1602;&#1740;&#1602;&#1607;</option>
					  <option value="3600">1 &#1587;&#1575;&#1593;&#1578;</option>
					  <option value="10800">3 &#1587;&#1575;&#1593;&#1578;</option>
					  <option value="21600">6 &#1587;&#1575;&#1593;&#1578;</option>
					  <option value="43200">12 &#1587;&#1575;&#1593;&#1578;</option>
					  <option value="86400">1 &#1585;&#1608;&#1586;</option>
					  <option value="172800">2 &#1585;&#1608;&#1586;</option>
					  <option value="259200">3 &#1585;&#1608;&#1586;</option>
					  <option value="604800">7 &#1585;&#1608;&#1586;</option>
					  <option value="1209600">14 &#1585;&#1608;&#1586;</option>
				</select>
			  </td>
		</tr>
    	<tr class="hover">
			<td>&#1605;&#1583;&#1578; &#1662;&#1604;&#1575;&#1587;:</td>
			<td><select name="plus_time" dir="rtl" class="text">
	  <option value="43200" selected="selected">12 &#1587;&#1575;&#1593;&#1578;</option>
	  <option value="86400">1 &#1585;&#1608;&#1586;</option>
	  <option value="172800">2 &#1585;&#1608;&#1586;</option>
	  <option value="259200">3 &#1585;&#1608;&#1586;</option>
	  <option value="345600">4 &#1585;&#1608;&#1586;</option>
	  <option value="432000">5 &#1585;&#1608;&#1586;</option>
	  <option value="518400">6 &#1585;&#1608;&#1586;</option>
	  <option value="604800">7 &#1585;&#1608;&#1586;</option></select></td>
		</tr>
    	<tr class="hover">
			<td>&#1586;&#1605;&#1575;&#1606; &#1578;&#1608;&#1604;&#1740;&#1583; 25% &#1607;&#1575;:</td>
			<td><select name="plus_production" dir="rtl" class="text">
	  <<option value="43200" selected="selected">12 &#1587;&#1575;&#1593;&#1578;</option>
	  <option value="86400">1 &#1585;&#1608;&#1586;</option>
	  <option value="172800">2 &#1585;&#1608;&#1586;</option>
	  <option value="259200">3 &#1585;&#1608;&#1586;</option>
	  <option value="345600">4 &#1585;&#1608;&#1586;</option>
	  <option value="432000">5 &#1585;&#1608;&#1586;</option>
	  <option value="518400">6 &#1585;&#1608;&#1586;</option>
	  <option value="604800">7 &#1585;&#1608;&#1586;</option></select></td>
		</tr>
        
        <tr class="hover">
			<td>&#1605;&#1583;&#1578; &#1581;&#1585;&#1575;&#1580;&#1740;:</td>
			<td><select name="auction_time" dir="rtl" class="text">
      <option value="1200">20 &#1583;&#1602;&#1740;&#1602;&#1607;</option>
      <option value="1800">30 &#1583;&#1602;&#1740;&#1602;&#1607;</option>
      <option value="3600" selected="selected">1 &#1587;&#1575;&#1593;&#1578;</option>
      <option value="10800">3 &#1587;&#1575;&#1593;&#1578;</option>
	  <option value="21600">6 &#1587;&#1575;&#1593;&#1578;</option>
	  <option value="28800">8 &#1587;&#1575;&#1593;&#1578;</option>
	  <option value="43200">12 &#1587;&#1575;&#1593;&#1578;</option>
	  <option value="86400">24 &#1587;&#1575;&#1593;&#1578;</option>
      </select></td>
		</tr>
    	<tr class="hover">
			<td>&#1594;&#1740;&#1585;&#1601;&#1593;&#1575;&#1604; &#1570;&#1587;&#1578;&#1575;&#1606;&#1607;:</td>
			<td><input type="text" dir="rtl" class="text" name="ts_threshold" id="ts_threshold" value="20"></td>
		</tr>
    	<tr class="hover">
			<td>&#1601;&#1575;&#1589;&#1604;&#1607; &#1605;&#1583;&#1575;&#1604;:</td>
			<td><input type="text" dir="rtl" class="text" name="medalinterval" id="medalinterval" value="86400"></td>
		</tr>
    	<tr class="hover">
			<td>&#1575;&#1606;&#1576;&#1575;&#1585; &#1607;&#1575;&#1740; &#1576;&#1586;&#1585;&#1711;:</td>
			<td><select name="great_wks" dir="rtl" class="text">
      <option value="false">&#1594;&#1740;&#1585;&#1601;&#1593;&#1575;&#1604;</option>
      <option value="true" selected="selected">&#1601;&#1593;&#1575;&#1604;</option></select></td>
		</tr>
    	<tr class="hover">
			<td>&#1588;&#1711;&#1601;&#1578;&#1740; &#1580;&#1607;&#1575;&#1606; &#1583;&#1585; &#1575;&#1605;&#1575;&#1585;:</td>
			<td><select name="ww" dir="rtl" class="text">
      <option value="0">&#1594;&#1740;&#1585;&#1601;&#1593;&#1575;&#1604;</option>
      <option value="1" selected="selected">&#1601;&#1593;&#1575;&#1604;</option></select></td>
		</tr>
		<tr class="hover">
		<td>&#1587;&#1740;&#1587;&#1578;&#1605; &#1607;&#1575;&#1740; &#1589;&#1604;&#1581;:</td>
		<td><select name="peace">
		<option value="0" selected="selected">&#1607;&#1740;&#1670;</option>
		<option value="1">&#1593;&#1575;&#1583;&#1740;</option>
		<option value="2">&#1705;&#1585;&#1740;&#1587;&#1605;&#1587;</option>
		<option value="3">&#1587;&#1575;&#1604; &#1606;&#1608;</option>
		<option value="4">&#1593;&#1740;&#1583; &#1662;&#1575;&#1705;</option>				
		</select></td>
		</tr>

</table>
<h4 class="round small spacer top top10_defs">Database Connection Settings</h4>
<table cellpadding="1" cellspacing="1" id="top10_defs" class="top10 row_table_data">
    	<tr class="hover">
			<td>&#1606;&#1575;&#1605; &#1607;&#1575;&#1587;&#1578;:</td>
			<td><input name="sserver" dir="rtl" class="text" type="text" id="sserver" value="localhost"></td>
		</tr>
    	<tr class="hover">
			<td>&#1740;&#1608;&#1586;:</td>
			<td><input name="suser" dir="rtl" class="text" type="text" id="suser" value=""></td>
		</tr>
    	<tr class="hover">
			<td>&#1662;&#1587;&#1608;&#1585;&#1583;:</td>
			<td><input type="text" dir="rtl" class="text" name="spass" id="spass"></td>
		</tr>
    	<tr class="hover">
			<td>DB &#1606;&#1575;&#1605;:</td>
			<td><input type="text" dir="rtl" class="text" name="sdb" id="sdb"></td>
		</tr>
    	<tr class="hover">
			<td>&#1583;&#1606;&#1576;&#1575;&#1604;&#1607;:</td>
			<td><input type="text" dir="rtl" class="text" name="prefix" id="prefix" value="s1_"></td>
		</tr>
    	<tr class="hover">
			<td>&#1606;&#1608;&#1593;:</td>
			<td><select name="connectt" dir="rtl" class="text">
	  <option value="0" selected="selected">MYSQL</option>
	  <option value="1" disabled="disabled">MYSQLi</option>
	</select></td>
		</tr>
        <tr class="empty"><td></td><td></td></tr>
    		<tr class="hover">
			<td>&#1575;&#1605;&#1606;&#1740;&#1578; &#1575;&#1605;&#1590;&#1575;:</td>
			<td><input type="text" dir="rtl" class="text" name="secsig" id="secsig"></td>
		</tr>
    		<tr class="hover">
			<td>Admin &#1606;&#1575;&#1605;:</td>
			<td><input type="text" dir="rtl" class="text" name="aname" id="aname"></td>
		</tr>
    	<tr class="hover">
			<td>Admin &#1575;&#1740;&#1605;&#1740;&#1604;:</td>
			<td><input name="aemail" dir="rtl" class="text" type="text" id="aemail"></td>
		</tr>
    	<tr class="hover">
			<td>&#1575;&#1583;&#1605;&#1740;&#1606; &#1583;&#1585; &#1575;&#1605;&#1575;&#1585;:</td>
			<td><select name="admin_rank" dir="rtl" class="text">
	  <option value="false" selected="selected">&#1606;&#1576;&#1575;&#1588;&#1583;</option>
	  <option value="true">&#1576;&#1575;&#1588;&#1583;</option></select></td>
		</tr>        
        
		<tr class="hover">
			<td>&#1587;&#1591;&#1581; &#1587;&#1575;&#1582;&#1578; &#1608; &#1587;&#1575;&#1586;:</td>
			<td><input type="text" dir="rtl" class="text" name="blevel" id="blevel"></td>
		</tr>
		<tr class="hover">
			<td>&#1602;&#1601;&#1587;:</td>
			<td><input type="text" dir="rtl" class="text" name="cages" id="cages"></td>
		</tr>
        
</table>
</div>
<div id="statRight" class="top10Wrapper">
<h4 class="round small  top top10_climbers">News Box :</h4>
<table cellpadding="1" cellspacing="1" id="top10_climbers" class="top10 row_table_data">
    	<tr class="hover">
			<td>&#1575;&#1582;&#1576;&#1575;&#1585; 1 :</td>
			<td><select name="box1" dir="rtl" class="text">
	  <option value="1">&#1601;&#1593;&#1575;&#1604;</option>
	  <option value="0" selected="selected">&#1594;&#1740;&#1585;&#1601;&#1593;&#1575;&#1604;</option></select></td>
		</tr>
    	<tr class="hover">
			<td>&#1575;&#1582;&#1576;&#1575;&#1585; 2 :</td>
			<td><select name="box2" dir="rtl" class="text">
	  <option value="1">&#1601;&#1593;&#1575;&#1604;</option>
	  <option value="0" selected="selected">&#1594;&#1740;&#1585;&#1601;&#1593;&#1575;&#1604;</option></select></td>
		</tr>
    	<tr class="hover">
			<td>&#1575;&#1582;&#1576;&#1575;&#1585; 3 :</td>
			<td><select name="box3" dir="rtl" class="text">
	  <option value="1">Enable</option>
	  <option value="0" selected="selected">Disable</option></select></td>
		</tr>
<tr class="empty"><td></td><td></td></tr>
    	<tr class="hover">
			<td>Log Building:</td>
			<td><select name="log_build" dir="rtl" class="text">
	  <option value="0" selected="selected">No</option>
	  <option value="1">Yes</option></select></td>
		</tr>
    	<tr class="hover">
			<td>Log Tech:</td>
			<td><select name="log_tech" dir="rtl" class="text">
	  <option value="0" selected="selected">No</option>
	  <option value="1">Yes</option></select></td>
		</tr>
    	<tr class="hover">
			<td>Log Login:</td>
			<td><select name="log_login" dir="rtl" class="text">
	  <option value="0" selected="selected">No</option>
	  <option value="1">Yes</option></select></td>
		</tr>
    	<tr class="hover">
			<td>Log Gold:</td>
			<td><select name="log_gold_fin" dir="rtl" class="text">
	  <option value="0" selected="selected">No</option>
	  <option value="1">Yes</option></select></td>
		</tr>
    	<tr class="hover">
			<td>Log Admin:</td>
			<td><select name="log_admin" dir="rtl" class="text">
	  <option value="0" selected="selected">No</option>
	  <option value="1">Yes</option></select></td>
		</tr>
    	<tr class="hover">
			<td>Log user:</td>
			<td><select name="trackusers" dir="rtl" class="text">
	  <option value="0" selected="selected">No</option>
	  <option value="1">Yes</option></select></td>
		</tr>
    	<tr class="hover">
			<td>Log War:</td>
			<td><select name="log_war" dir="rtl" class="text">
	  <option value="0" selected="selected">No</option>
	  <option value="1">Yes</option></select></td>
		</tr>
    	<tr class="hover">
			<td>Log Market:</td>
			<td><select name="log_market" dir="rtl" class="text">
	  <option value="0" selected="selected">No</option>
	  <option value="1">Yes</option></select></td>
		</tr>
    	<tr class="hover">
			<td>Log Illegal:</td>
			<td><select name="log_illegal" dir="rtl" class="text">
	  <option value="0" selected="selected">No</option>
	  <option value="1">Yes</option></select></td>
		</tr>
<tr class="empty"><td></td><td></td></tr>
</table>
<h4 class="round small spacer top top10_raiders">Options</h4>
<table cellpadding="1" cellspacing="1" id="top10_raiders" class="top10 row_table_data">
    	<tr class="hover">
			<td>&#1608;&#1592;&#1740;&#1601;&#1607; &#1607;&#1575;:</td>
			<td><select name="quest" dir="rtl" class="text">
	  <option value="0">Disable</option>
	  <option value="1" selected="selected">Enable</option></select></td>
		</tr>
    	<tr class="hover">
			<td>&#1575;&#1740;&#1605;&#1740;&#1604; &#1601;&#1593;&#1575;&#1604; &#1587;&#1575;&#1586;&#1740;:</td>
			<td><select name="activate" dir="rtl" class="text">
	  <option value="0" selected="selected">Disable</option>
	  <option value="1">Enable</option></select></td>
		</tr>
    	<tr class="hover">
			<td>&#1589;&#1606;&#1583;&#1608;&#1602; &#1662;&#1587;&#1578;&#1740; &#1605;&#1581;&#1583;&#1608;&#1583;:</td>
			<td><select name="limit_mailbox" dir="rtl" class="text">
	  <option value="false" selected="selected">Disable</option>
	  <option value="true">Enable</option></select></td>
		</tr>
    	<tr class="hover">
			<td>&#1581;&#1583;&#1575;&#1705;&#1579;&#1585; &#1575;&#1740;&#1605;&#1740;&#1604;:</td>
			<td><input name="max_mails" dir="rtl" class="text" type="number" id="max_mails" value="30" size="15"></td>
		</tr>
    	<tr class="hover">
			<td>Time out:</td>
			<td><input name="timeout" dir="rtl" class="text" type="number" id="timeout" value="30" size="15"></td>
		</tr>
		<tr class="hover">
			<td>autodel:</td>
			<td><select name="autodel" dir="rtl" class="text">
	  <option value="false" selected="selected">Disable</option>
	  <option value="true">Enable</option></select></td>
		</tr>
    	<tr class="hover">
			<td>autodeltime:</td>
			<td><input name="autodeltime" dir="rtl" class="text" type="number" id="autodeltime" value="864000" size="15"></td>
		</tr>
    	<tr class="hover">
			<td>&#1587;&#1591;&#1581; &#1587;&#1575;&#1582;&#1578;&#1605;&#1575;&#1606; &#1575;&#1589;&#1604;&#1740; &#1576;&#1585;&#1575;&#1740; &#1578;&#1582;&#1576;&#1585;&#1740; &#1583;&#1740;&#1711;&#1585; &#1587;&#1575;&#1582;&#1578;&#1605;&#1575;&#1606; &#1605;&#1608;&#1585;&#1583; &#1606;&#1740;&#1575;&#1586;</td>
			<td><select name="demolish" dir="rtl" class="text">
	  <option value="5">5</option>
	  <option value="10" selected="selected">10 - Default</option>
	  <option value="15">15</option>
	  <option value="20">20</option></select></td>
		</tr>
    	<tr class="hover">
			<td>&#1585;&#1608;&#1587;&#1578;&#1575;&#1740; &#1576;&#1575;&#1586;:</td>
			<td><select name="village_expand" dir="rtl" class="text">
	  <option value="1" selected="selected">&#1575;&#1585;&#1575;&#1605;</option>
	  <option value="0">&#1587;&#1585;&#1740;&#1593;</option></select></td>
		</tr>
    	<tr class="hover">
			<td>Error Reporting:</td>
			<td><select name="error" dir="rtl" class="text">
	  <option value="error_reporting (E_ALL ^ E_NOTICE);" selected="selected">Yes</option>
	  <option value="error_reporting (0); ">No</option></select></td>
		</tr>

</table><br />

<h4 class="round small  top top10_offs">Server Begin Settings</h4>
<table cellpadding="1" cellspacing="1" id="top10_raiders" class="top10 row_table_data">
    	<tr class="hover">
			<td>Start Date :</td>
			<td>
			<font class="none" size="1" face="Trebuchet MS">[ <?php echo date('Y-m-d H:i:s');?> (now)] + </font>
			<input name="commencediff" style="text-align:center;" class="text" type="text" id="commencediff" value="0" size="20"> seconds.<br />
            </td>
		</tr>
</table>

<div align="left">
<button type="submit" value="Upgrade level" class="build">
<div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div>
<div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">ادامه</div></div></button></div>
	<input type="hidden" name="subconst" value="1">
	</form>
</div>