<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       ban.tpl                                                     ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<style>

.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);} 

</style>



<form action="" method="get">

<input name="action" type="hidden" value="addBan">

<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

    <thead>

    <tr>

    
    
	<ul class="tabs"><center>
		<li>لیست سیاه</li>
        </center>
	</ul>
</div> 
    
    
    
       

    </tr>                                       

    </thead>

    <tr>

    

        <td>نام اکانت</td>                                    

        <td>                                                   

          <input type="text" class="fm" name="uid" value="<?php echo $_GET['uid'];?>">

        </td>      

    </tr>

    <tr>

        <td>تخلف</td>

        <td>

        <select name="reason" class="fm">         

          <?php     

          $arr = array('Pushing','Cheat','Hack','Bug','Bad Name','Multi Account','Swearing');            

          foreach($arr as $r){

            echo '<option value="'.$r.'">'.$r.'</option>';                         

          }

          ?>

          </select>    

        </td>      

    </tr>       

    <tr>

        <td>مدت</td>

        <td>

          <select name="time" class="fm">         

          <?php

          $arr = array(1,2,5,10,12);             

          foreach($arr as $r){

            echo '<option value="'.($r*3600).'">'.$r.' hour/s</option>';

          }       

          $arr2 = array(1,2,5,10,30,50,90);

          foreach($arr2 as $r){

            echo '<option value="'.($r*3600*24).'">'.$r.' day/s</option>';

          }

            echo '<option value="">Forever</option>';

          ?>

          </select>

        </td>      

    </tr>

    <tr>

        <td colspan="2" class="on"><input type="submit" value="Save"></td>     

    </tr>

</table>

</form>



<?php                                 

$bannedUsers = $admin->search_banned();

?>

<br>

<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

    <thead>

    <tr>

    
    
  
	<ul class="tabs"><center>
		<li>لیست سیاه(<?php echo count($banned);?>)</li>
        </center>
	</ul>
</div> 
    
    
    
    
      

    </tr>                                       

    </thead><tbody>

    <tr>

        <td><b>نام</b></td>

        <td><b>مدت</b></td>      

        <td><b>تخلف</b></td> 

        <td></td>        

    </tr>

    

    <?php

    if($bannedUsers){

    for ($i = 0; $i <= count($bannedUsers)-1; $i++) {

      if($database->getUserField($bannedUsers[$i]['uid'],'username',0)==''){

        $name = $bannedUsers[$i]['name'];

        $link = "<span class=\"c b\">[".$name."]</span>";

      }else{

        $name = $database->getUserField($bannedUsers[$i]['uid'],'username',0);

        $link = '<a href="?p=player&uid='.$bannedUsers[$i]['uid'].'">'.$name.'<a/>';

      } 

      if($bannedUsers[$i]['end']){$end = date("d.m.y H:i",$bannedUsers[$i]['end']);}else{$end = '*';}     

    echo '                                           

    <tr>

        <td>'.$link.'</td> 

        <td ><span class="f7">'.date("d.m.y H:i",$bannedUsers[$i]['time']).' - '.$end.'</td>     

        <td>'.$bannedUsers[$i]['reason'].'</td>

        <td class="on"><a href="?action=delBan&uid='.$bannedUsers[$i]['uid'].'&id='.$bannedUsers[$i]['id'].'" onClick="return del(\'unban\',\''.$name.'\')"><img src="../img/Admin/del.gif" class="del" title="cancel" alt="cancel"></img></a></td>           

    </tr>

    ';

    }

    }else{

    echo '<tr><td colspan="6" class="on">هیچ بازیکنی توقیف نشده است</td></tr>';

    }

    ?>



  

    </tbody>

</table>





