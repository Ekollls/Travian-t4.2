<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       config.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);

mysql_select_db(SQL_DB);

if ($_SESSON['access'] == MULTIHUNTER) die("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><b><font color='Red'><center>Access Denied: You are not admin</b></font></center>");

?>
<style>
.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);} 
</style>  
<form action="proces.php" method="post">
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    
    	<ul class="tabs"><center>
		<li>تنظیمات سرور</li>
	</ul>
    
    
    </tr>
  </thead> 

</table>
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
    <tr>
        <td class="b">اطلاعات</td>
        <td class="b">مشخصات</td> 
    </tr> 
    <tr>
        <td>نام سرور</td>
        <td><input type="text" dir="ltr" class="text" name="servername" id="servername" value="<?php echo SERVER_NAME;?>"></td>    
    </tr> 
 <tr>

        <td>شروع سرور</td>

        <td><?php echo date("d.m.y H:i",COMMENCE);?></td>   

    </tr>  
    <tr>
        <td>زبان</td>
        <td>
        <?php if(LANG == en){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(LANG == fa){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="lang" class="text">
		<option value="en" <?php echo $sts; ?>>انگلیسی</option>
		<option value="fa" <?php echo $sts2; ?>>پارسی</option>
        </select>
        
        </td>  
    </tr>  
    <tr>  
        <td>سرعت سرور</td>
        <td><?php echo ''.SPEED.'x';?></td>    
    </tr>  
    <tr>
        <td>سایز مپ</td>
        <td><?php echo WORLD_MAX;?> x <?php echo WORLD_MAX;?></td>    
    </tr>  
	<tr>
        <td>سرعت حمله</td>
        <td><?php echo INCREASE_SPEED;?>x</td>    
    </tr> 
		<tr>

        <td>سرعت گسترش روستا</td>

        <td><?php if(CP == 0){
				echo "Fast";
				}
				else if(CP == 1){
				echo "Slow";
				} ?></td> 

    </tr>   
    <tr>

        <td>حمایت تازه واردین</td>

        <td><?php echo (PROTECTION/3600*SPEED);?> ساعت</td> 

    </tr>    	
	<tr>

        <td>ایمیل فعال سازی</td>

        <td>
        <?php if(AUTH_EMAIL == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(AUTH_EMAIL == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="activate" class="text">
		<option value="true" <?php echo $sts; ?>>فعال</option>
		<option value="false" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
        </td> 
				

    </tr> 
	<tr>

        <td>وظیفه ها</td>
		
        <td>
        <?php if(QUEST == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(QUEST == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="quest" class="text">
		<option value="true" <?php echo $sts; ?>>فعال</option>
		<option value="false" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
        </td> 
       

    </tr>    
	
	<tr>

        <td>سطح مورد نیاز برای تخریب</td>

        <td><?php echo DEMOLISH_LEVEL_REQ; ?></td> 

    </tr>  
	
	<tr>

        <td>نمایش .ناتار در امار</td>

        <td>
        <?php if(WW == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(WW == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="ww" class="text">
		<option value="true" <?php echo $sts; ?>>فعال</option>
		<option value="false" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
        </td> 

    </tr>  
	<tr>

        <td><b><font color='#71D000'></font><font color='#FF6F0F'></font><font color='#71D000'></font><font color='#FF6F0F'>پلاس</font></b> </td>

        <td><?php if(PLUS_TIME >= 86400){
			echo ''.(PLUS_TIME/86400).' روز';
			} else if(PLUS_TIME < 86400){
			echo ''.(PLUS_TIME/3600).' ساعت';
			} ?></td> 

    </tr>  
	
	<tr>

        <td>25% تولیدات پلاس</td>

        <td><?php if(PLUS_PRODUCTION >= 86400){
			echo ''.(PLUS_PRODUCTION/86400).' روز';
			} else if(PLUS_PRODUCTION < 86400){
			echo ''.(PLUS_PRODUCTION/3600).' ساعت';
			} ?></td> 

    </tr>  
	</table>
	
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    
    <ul class="tabs"><center>
		<li>تنظیمات ورود</li>
	</ul>
    

    </tr>
  </thead>
</table>  
  
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <tr>
        <td class="b">اطلاعات</td>
        <td class="b">مشخصات</td> 
    </tr> 
    <tr>
        <td>Log Build</td>
        <td><?php if(LOG_BUILD == true) {
				echo "<b><font color='Green'>فعال</font></b>";
				}
				else if(LOG_BUILD == false){
				echo "<b><font color='Red'>غیرفعال</font></b>"; 
				}
				?></td> 
    </tr>    
    <tr>
        <td>Log Technology</td>
        <td><?php if(LOG_TECH == true) {
				echo "<b><font color='Green'>فعال</font></b>";
				}
				else if(LOG_TECH == false){
				echo "<b><font color='Red'>غیر فعال</font></b>"; 
				}
				?></td> 
    </tr>    
    <tr>
        <td>Log Login</td>
        <td><?php if(LOG_LOGIN == true) {
				echo "<b><font color='Green'>فعال</font></b>";
				}
				else if(LOG_LOGIN == false){
				echo "<b><font color='Red'>غیر فعال</font></b>"; 
				}
				?></td> 
    </tr>    
    <tr>
        <td>Log Gold</td>
        <td><?php if(LOG_GOLD_FIN == true) {
				echo "<b><font color='Green'>فعال</font></b>";
				}
				else if(ALOG_GOLD_FIN == false){
				echo "<b><font color='Red'>غیر فعال</font></b>"; 
				}
				?></td> 
    </tr>    
    <tr>
        <td>Log Admin</td>
        <td><?php if(LOG_ADMIN == true) {
				echo "<b><font color='Green'>فعال</font></b>";
				}
				else if(LOG_ADMIN == false){
				echo "<b><font color='Red'>غیر فعال</font></b>"; 
				}
				?></td> 
    </tr>     
    <tr>
        <td>Log War</td>
        <td><?php if(LOG_WAR == true) {
				echo "<b><font color='Green'>فعال</font></b>";
				}
				else if(LOG_WAR == false){
				echo "<b><font color='Red'>غیر فعال</font></b>"; 
				}
				?></td> 
    </tr>     
    <tr>
        <td>Log Market</td>
        <td><?php if(LOG_MARKET == true) {
				echo "<b><font color='Green'>فعال</font></b>";
				}
				else if(LOG_MARKET == false){
				echo "<b><font color='Red'>غیر فعال</font></b>"; 
				}
				?></td> 
    </tr>     
    <tr>
        <td>Log Illegal</td>
        <td><?php if(LOG_ILLEGAL == true) {
				echo "<b><font color='Green'>فعال</font></b>";
				}
				else if(LOG_ILLEGAL == false){
				echo "<b><font color='Red'>غیر فعال</font></b>"; 
				}
				?></td> 
    </tr>     
       	</table>
	
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    
    <ul class="tabs"><center>
		<li>تنظیمات خبر ها</li>
	</ul>
    

    </tr>
  </thead>
</table>  
  
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <tr>
        <td class="b">اطلاعات</td>
        <td class="b">مشخصات</td> 
    </tr> 
	
	<tr>
		
		<td>خبر 1</td>
		
		<td>
        <?php if(NEWSBOX1 == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(NEWSBOX1 == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="box1" class="text">
		<option value="true" style="color:Green;" <?php echo $sts; ?>>فعال</option>
		<option value="false" style="color:Red;" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
        </td>
	</tr>
	<tr>
		
		<td>خبر 2 </td>
		
		<td>
        <?php if(NEWSBOX2 == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(NEWSBOX2 == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="box2" class="text">
		<option value="true" style="color:Green;" <?php echo $sts; ?>>فعال</option>
		<option value="false" style="color:Red;" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
      </td>
				
	</tr>
	<tr>
		
		<td>خبر داخل بازی</td>
		
		<td>
        <?php if(NEWSBOX3 == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(NEWSBOX3 == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="box3" class="text">
		<option value="true" style="color:Green;" <?php echo $sts; ?>>فعال</option>
		<option value="false" style="color:Red;" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
      </td>
				
	</tr>
	
	<td>Home 1</td>
		
	<td>
        <?php if(HOME1 == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(HOME1 == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="home1" class="text">
		<option value="true" style="color:Green;" <?php echo $sts; ?>>فعال</option>
		<option value="false" style="color:Red;" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
      </td>
        </tr>
	
	<td>Home 2</td>
		
		<td>
        <?php if(HOME2 == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(HOME2 == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="home2" class="text">
		<option value="true" style="color:Green;" <?php echo $sts; ?>>فعال</option>
		<option value="false" style="color:Red;" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
      </td>
				
	</tr>
	
	<td>Home 3</td>
		
		<td>
        <?php if(HOME3 == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(HOME3 == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="home3" class="text">
		<option value="true" style="color:Green;" <?php echo $sts; ?>>فعال</option>
		<option value="false" style="color:Red;" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
      </td>
				
	</tr>
  </table>
	
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    <ul class="tabs"><center>
		<li>تنظیمات دیتابس</li>
	</ul>
    
    
    </tr>
  </thead>
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <tr>
        <td class="b">اطلاعات</td>
        <td class="b">مشخصات</td> 
    </tr> 
    <tr>
        <td>نام هاست</td>
        <td><?php echo SQL_SERVER;?></td> 
    </tr>    
	<tr>
        <td>نام دیتابس</td>
        <td><?php echo SQL_USER;?></td> 
    </tr>  
	<tr>
        <td>رمز عبور</td>
        <td>*********</td> 
    </tr>  
	<tr>
        <td>یوز دیتابس</td>
        <td><?php echo SQL_DB;?></td> 
    </tr>  
	<tr>
        <td>Table Prefix</td>
        <td><?php echo TB_PREFIX;?></td> 
    </tr> 
	<tr>
        <td>DB Type</td>
        <td><?php 
                if(DB_TYPE == 0) {
                echo "MYSQL";
                }
                else if(DB_TYPE == 1) {
                echo "MYSQLi";
                } ?></td> 
    </tr> 
	</table>
	
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

  <thead>

    <tr>

    
    <ul class="tabs"><center>
		<li>تنظیمات </li>
	</ul>


    </tr>

  </thead>

<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

  <tr>

        <td class="b">اطلاعات</td>

        <td class="b">مشخصات</td> 

    </tr> 

    <tr>

        <td>Limit Mailbox</td>

		<td>
        <?php if(LIMIT_MAILBOX == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(LIMIT_MAILBOX == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="limit_mailbox" class="text">
		<option value="true" style="color:Green;" <?php echo $sts; ?>>فعال</option>
		<option value="false" style="color:Red;" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
        </td>
        
</tr>    
	<tr>

        <td>Max number of mails</td>

        <td><?php if(LIMIT_MAILBOX == true){
				echo "<input name=\"max_mails\" dir=\"rtl\" class=\"text\" type=\"number\" id=\"max_mails\" value=\"".MAX_MAIL."\" size=\"15\">";
				}
				else if(LIMIT_MAILBOX == false){
				echo "<font color='Gray'>غیر فعال</font>";
				} ?></td> 

    </tr>    
	<tr>

        <td>Include Admin in rank</td>
        
        <td>
        <?php if(INCLUDE_ADMIN == true){
				$sts = "selected=\"selected\"";
				} else { $sts = ""; }
				if(INCLUDE_ADMIN == false){
				$sts2 = "selected=\"selected\"";
                } else { $sts2 = ""; }
				?>
        <select name="admin_rank" class="text">
		<option value="true" style="color:Green;" <?php echo $sts; ?>>فعال</option>
		<option value="false" style="color:Red;" <?php echo $sts2; ?>>غیر فعال</option>
        </select>
        </td>


</tr>    
	</table>
	
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

  <thead>

    <tr>

    
    <ul class="tabs"><center>
		<li>تنظیمات مدیر</li>
	</ul>


    </tr>

  </thead>

<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

  <tr>

        <td class="b">اطلاعات</td>

        <td class="b">مشخصات</td> 

    </tr> 

    <tr>

        <td>Admin Email</td>

        <td><?php if(ADMIN_EMAIL == ''){
				echo "<b><font color='Red'>No admin email defined!</b></font>";
				}
				else if(ADMIN_EMAIL != ''){
				echo "<input name=\"aemail\" class=\"text\" type=\"text\" id=\"aemail\" value=\"".ADMIN_EMAIL."\">";
				} ?></td> 

    </tr>  
	 <tr>

        <td>Admin Name</td>

        <td><?php if(ADMIN_NAME == ''){
				echo "<b><font color='Red'>No admin name defined!</b></font>";
				}
				else if(ADMIN_NAME != ''){
				echo "<input type=\"text\" value=\"".ADMIN_NAME."\" class=\"text\" name=\"aname\" id=\"aname\">";
				} ?></td> 

    </tr>
    
    
</table><Br />	 <center>
            	<button name="submit" type="submit" value="submit" id="submit" class="submit"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">تایید</div></div></button>
 
	</form>
<?php

function define_array( $array, $keys = NULL )
{
    foreach( $array as $key => $value )
    {
        $keyname = ($keys ? $keys . "_" : "") . $key;
        if( is_array( $array[$key] ) )
            define_array( $array[$key], $keyname );
        else
            define( $keyname, $value );
    }
}

//define_array($array);

?>
