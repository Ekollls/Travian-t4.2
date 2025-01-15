<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       sysmsg.php                                                  ##
##  Developed by:  Dixie                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

<?php
 if(function_exists("set_time_limit")){
 set_time_limit(3600);
 }

include('app/config.php');

 if ( $this->data['player_type'] == PLAYERTYPE_ADMIN ){
 
$db_connect = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']);
mysql_select_db($AppConfig['db']['database'], $db_connect);


?>


<form  method="post">
 <table id="coords" cellpadding="3" cellspacing="3">
    <tbody>
<br><br><br>
<center>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red size=3><b>وارد کردن اکانت فارم </b></font><p>

<p><br>


	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=blue size=2><b>با هر بار ايجاد کردن اکانت فارم ؛مکان دهکده هاي آن در نقشه عوض مي شود</b></font><p>


<br><p>

		<p>پسورد اکانت فارم  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" maxlength="50" value="123456" name="passwo" class="text" /></p><p>	

		<p>تعداد دهکده فارم :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" maxlength="50" value="3" name="Farmv" class="text" /> </p><p>	
		
		جمعيت  هر دهکده : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" maxlength="50" value="750" name="people" class="text" /></p><p>
		
       توليدات  هر دهکده : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" maxlength="50" value="1500000" name="Manabe" class="text" /></p><p>
       	
		سطح منابع در  هر دهکده :	&nbsp;<input type="text" maxlength="50" value="8" name="Manabex" class="text" /></p><p>

		 انبار هر دهکده : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" maxlength="50" value="15000000" name="anbar" class="text" /></p>
		
		 سطح ساختمانها هر دهکده : <input type="text" maxlength="50" value="15" name="building" class="text" /></p>
		
		سطح ساختمانهاي توليدي :&nbsp;&nbsp;&nbsp;<input type="text" maxlength="50" value="5" name="building1" class="text" /> <p>

(مثل نانوايي ، آسياب ؛ ذوب آهن)</p>



</center>

		
  </tbody>
  </table>
  <p>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <input type="submit" name="submit" value="ايجاد اکانت فارم">
    </form>
</p></br>
	


<?php
 if(isset($_POST['submit'])) {

      $Farmv = $_POST['Farmv'];
      $Passwo = $_POST['passwo'];
      $people = $_POST['people'];
      $Manabe = $_POST['Manabe'];
      $Manabex = $_POST['Manabex'];
      $anbar = $_POST['anbar'];
      $building = $_POST['building'];
      $building1 = $_POST['building1'];



	 





mysql_query("DELETE FROM `p_players` WHERE `p_players`.`name` = 'Farm' LIMIT 1");
mysql_query("UPDATE p_villages SET tribe_id=NULL, player_id=NULL, alliance_id=NULL, player_name=NULL, village_name=NULL, alliance_name=NULL, is_capital=NULL, is_special_village=NULL, is_oasis=NULL, people_count='2', crop_consumption='2', time_consume_percent='100', offer_merchants_count=NULL, resources=NULL, cp=NULL, buildings=NULL, troops_training=NULL, troops_num=NULL, troops_out_num=NULL, troops_intrap_num=NULL, troops_out_intrap_num=NULL, troops_trapped_num=NULL, allegiance_percent=NULL, child_villages_id=NULL, village_oases_id=NULL, creation_date=NULL, update_key=NULL, last_update_date=NULL WHERE player_name = 'Farm' LIMIT 700000");
// 



$resultx = mysql_query("SELECT * FROM p_players ");
 if(isset($resultx)){
  while($row = mysql_fetch_array($resultx)){
	$playerCount=$row['id'];
  }
}

$player_id = $playerCount+1;
$player_name = 'Farm';
$password = md5(base64_encode(base64_encode($Passwo)));
$email = 'FARM';
$total_people_count = ($people*$Farmv);
$data = 'Farm<br>===============<br><img border="0" alt="اين اکانت به عنوان فارم ثابت بازي است . دهکده اول آن جهت گرفتن امتياز غارت و منابع و دهکده دوم جهت گرفتن امتياز هجومي است.در دهکده دوم سربازان زيادي هستند پس با احتياط حمله کنيد"<br>===============';


// 
mysql_query("INSERT INTO p_players (id, name) VALUES ('$player_id', '$player_name')");

// Player INC
mysql_query("UPDATE p_players set tribe_id='7' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set pwd='$password' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set email='$email' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set villages_count='$Farmv' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set is_active='1' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set is_blocked='0' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set player_type='1' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set active_plus_account='1' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set description1='$data' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set gold_num='0' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set total_people_count='$total_people_count' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set villages_count='$Farmv' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players set guide_quiz='-1' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_players SET villages_id=''  WHERE id='$player_id'") or die(mysql_error());


//Village

mysql_query("UPDATE p_villages SET tribe_id=NULL, player_id=NULL, alliance_id=NULL, player_name=NULL, village_name=NULL, alliance_name=NULL, is_capital=NULL, is_special_village=NULL, is_oasis=NULL, people_count='2', crop_consumption='2', time_consume_percent='100', offer_merchants_count=NULL, resources=NULL, cp=NULL, buildings=NULL, troops_training=NULL, troops_num=NULL, troops_out_num=NULL, troops_intrap_num=NULL, troops_out_intrap_num=NULL, troops_trapped_num=NULL, allegiance_percent=NULL, child_villages_id=NULL, village_oases_id=NULL, creation_date=NULL, update_key=NULL, last_update_date=NULL WHERE player_id=2")or die(mysql_error());


 $result1 = mysql_query("SELECT * FROM p_villages where tribe_id='0' && field_maps_id='3' ");
 
 if(isset($result1)){
    $k=0;
     while($row = mysql_fetch_array($result1))
{
   
		
		$id = $row['id'];
		
		$XX[$k]=$id;
		$relx[$k]=$row['rel_x'];
		$rely[$k]=$row['rel_y'];
	
	$k++; 
}
}

define("villagee","Farm"); 

			for ($i=0;$i<$Farmv;$i++){


			
				
				$randk=rand(0,$k);
				
				while(isset($XX[$randk])){
				$Village=$XX[$randk];
				$VX=$relx[$randk];
				$VY=$rely[$randk];
				unset($XX[$randk]);
				}
				
				if ($i==0){
				mysql_query("UPDATE p_players set selected_village_id='$Village' where id='$player_id'") or die(mysql_error());
				}
			
				$yX= villagee ;

				$ii=$i+1;

				$VillageN=("$yX $ii");
				$villages_datax=("$Village $VX $VY $VillageN");

				mysql_query("UPDATE p_players set villages_data=CONCAT_WS('\n', villages_data, '$villages_datax')  where id='$player_id'") or die(mysql_error());
				
				$cp=("100 1000");
				$troops_training='';

				$Resourcx=("1 $anbar $anbar 800 $Manabe 25,2 $anbar $anbar 800 $Manabe 25,3 $anbar $anbar 800 $Manabe 25,4 $anbar $anbar 800 $Manabe 50");
				$buildings1 =("4 $Manabex 0,4 $Manabex 0,1 $Manabex 0,4 $Manabex 0,4 $Manabex 0,2 $Manabex 0,3 $Manabex 0,4 $Manabex 0,4 $Manabex 0,3 $Manabex 0,3 $Manabex 0,4 $Manabex 0,4 $Manabex 0,1 $Manabex 0,4 $Manabex 0,2 $Manabex 0,1 $Manabex 0,2 $Manabex 0,10 $building 0,11 $building 0,22 $building 0,17 $building 0,19 $building 0,25 $building 0,0 0 0,15 $building 0,15 $building 0,6 $building1 0,0 0 0,0 0 0,8 $building1 0,7 $building1 0,0 0 0,0 0 0,11 $building 0,20 $building 0,10 $building 0,21 $building 0,16 $building 0,31 $building 0");
				$kk= ("99 1 0 0,100 1 0 0,101 1 0 0,102 1 0 0,103 1 0 0,104 1 0 0,105 1 0 0,106 1 0 0,107 0 0 0,108 0 0 0,109 1 0 0");
				$k2 = ("-1:99 0,100 0,101 0,102 0,103 0,104 0,105 0,106 0,107 0,108 0,109 0");

				mysql_query("UPDATE p_villages set tribe_id='7' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set player_id='$player_id' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set player_name='$player_name' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set village_name='$VillageN' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set is_capital='1' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set is_special_village='0' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set people_count='$people' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set resources='$Resourcx' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set cp='$cp' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set buildings='$buildings1' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set troops_num='$k2' where id='$Village'") or die(mysql_error());
				mysql_query("UPDATE p_villages set troops_training='$kk' where id='$Village'") or die(mysql_error());
				
				if ($i==0){
				mysql_query("UPDATE p_players SET villages_id=CONCAT_WS(villages_id, '$Village')  WHERE id='$player_id'") or die(mysql_error());
			
				}
				else {
				mysql_query("UPDATE p_players SET villages_id=CONCAT_WS(',', villages_id, '$Village')  WHERE id='$player_id'") or die(mysql_error());
				}
				

			}
//SEC


echo "<title>فارم بازي با موفقيت افزوده شد</title>";
echo '<br><br><br><p align="center"><font color="blue" size="5">Farm Be Added  <p><center> فارم ها با موفقيت وارد شدند</center></font></p>';
echo '<p align="center">&nbsp;</p>';
echo '<br><br><br><p align="center"><font color="#2c6935" size="5">user :Farm  <p><center> Farm : نام کاربري اکانت فارم </center></font></p>';
echo '<p align="center">&nbsp;</p>';
echo '<p align="center"><b><font color="red"><a target="_blank" href="">
<span style="text-decoration: none" lang="ar-eg"><font color="#FF0000">حق انتشار محفوظ است براي   
</font></span><p><center><font color="#FF0000"><span style="text-decoration: none"><span lang="ar-eg"></span></span></font><span lang="ar-eg" style="text-decoration: none"><font color="#FF0000"><center>goodtravian@ymail.com</center></font></span></a></font></b></p>';

//mysql close
mysql_close($db_connect);
}
}

 else {
			echo "<p><br><p><br><center><font size=4 color=red> شما ادمین بازی نیستید </font></center>"; 

}

?> 










</div>
<div id="side_info" class="outgame">
</div>
</div>
<div class="contentFooter">&nbsp;</div>

					</div>
<?php  
include("Templates/rightsideinfor.tpl");		
?>
				<div class="clear"></div>
</div>
<?php 
include("Templates/footer.tpl"); 
include("Templates/header.tpl");
?>
</div>
<div id="ce"></div>
</div>
</body>
</html>


<?php } ?>

