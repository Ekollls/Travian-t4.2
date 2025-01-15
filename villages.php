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
   include "Templates/html.tpl";  



?>
<body class="v35 webkit chrome statistics">
<script type="text/javascript">
			window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
		</script>
	<div id="background"> 
			<div id="headerBar"></div>
			<div id="bodyWrapper"> 
				<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> 
				<div id="header"> 

<?php 
	include("Templates/topheader.tpl");
	include("Templates/toolbar.tpl");

?>

	</div>
	<div id="center">
		<a id="ingameManual" href="help.php">
		<img class="question" alt="Help" src="img/x.gif">
		</a>

		<?php include("Templates/sideinfo.tpl"); ?>

		<div id="contentOuterContainer"> 

		<?php include("Templates/res.tpl"); ?>
							<div class="contentTitle">&nbsp;</div> 
							<div class="contentContainer"> 



<div id="content" class="statistics">
                                		<script type="text/javascript"> 
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>

<h1 class="titleInHeader">تنظيمات اخبار بازي<?php if($session->access == ADMIN) { echo " <a href=\"\"></a>"; } ?></h1>
<div class="contentNavi subNavi">
				<div class="clear"></div>
</div>


<?php
        	function mysql_fetch_all($result) {
        		$all = array();
        		if($result) {
        			while($row = mysql_fetch_assoc($result)) {
        				$all[] = $row;
        			}
        			return $all;
        		}
        	}
  function search_village($village){
    $q = "SELECT * FROM ".TB_PREFIX."vdata WHERE `name` LIKE '%$village%' or `wref` LIKE '%$village%'";
    return mysql_query($q);
  }
  

$result = mysql_fetch_all(search_village($_POST['s']));
?>



<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    
    <ul class="tabs"><center>
		<li>مديريت دهکده ها (<?php echo count($result);?>)</li>
        </center>
	</ul>
</div>
    

    </tr>
  </thead> 

</table>
<table id="member" border="1" cellpadding="3" align="center" dir="rtl">    
    <tr>
        <td class="b">اکانت</td>
        <td class="b">نام</td>
        <td class="b">مالک</td>         
        <td class="b">جمعيت</td>
		<td></td>
    </tr>
<?php 

	$time = time() - (60*5);
	$sql = mysql_query("SELECT * FROM ".TB_PREFIX."users where timestamp > $time and id > 3 ORDER BY username ASC $limit");
	$query = mysql_num_rows($sql);
	if (isset($_GET['page'])) { // دريافت شماره صفحه
		$page = preg_replace('#[^0-9]#i', '', $_GET['page']); // فيلتر کردن همه چيز به جز اعداد
	} else {
		$page = 1;
	}
	
	$itemsPerPage = 10; //تعداد آيتم هاي قابل نمايش در هر صفحه
	$lastPage = ceil($query / $itemsPerPage); // دريافت مقدار آخرين صفحه
	if ($page < 1) {
		$page = 1;
	} else if ($page > $lastPage) {
		$page = $lastPage;
	}
	$centerPages = "";
	$sub1 = $page - 1;
	$sub2 = $page - 2;
	$sub3 = $page - 3;
	$add1 = $page + 1;
	$add2 = $page + 2;
	$add3 = $page + 3;
	if ($page <= 1 && $lastPage <= 1) {
		$centerPages .= '<span class="number currentPage">1</span>';
		
	}elseif ($page == 1 && $lastPage == 2) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=2">2</a>';
		
	}elseif ($page == 1 && $lastPage == 3) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=2">2</a> ';
		$centerPages .= '<a class="number" href="page=3">3</a>';
		
	}elseif ($page == 1) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $add1 . '">' . $add1 . '</a> ';
		$centerPages .= '<a class="number" href="page=' . $add2 . '">' . $add2 . '</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
		
	} else if ($page == $lastPage && $lastPage == 2) {
		$centerPages .= '<a class="number" href="page=1">1</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
		
	} else if ($page == $lastPage && $lastPage == 3) {
		$centerPages .= '<a class="number" href="page=1">1</a> ';
		$centerPages .= '<a class="number" href="page=2">2</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
		
	} else if ($page == $lastPage) {
		$centerPages .= '<a class="number" href="page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $sub2 . '">' . $sub2 . '</a> ';
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
		
	} else if ($page == ($lastPage - 1) && $lastPage == 3) {
		$centerPages .= '<a class="number" href="page=1">1</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
	
	} else if ($page > 2 && $page < ($lastPage - 1)) {
		$centerPages .= '<a class="number" href="page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $add1 . '">' . $add1 . '</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
		
	}else if ($page == ($lastPage - 1)) {
		$centerPages .= '<a class="number" href="page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
	
	} else if ($page > 1 && $page < $lastPage && $lastPage == 3) {
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $add1 . '">' . $add1 . '</a>';
		
	} else if ($page > 1 && $page < $lastPage) {
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $add1 . '">' . $add1 . '</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
	}
	$paginationDisplay = "";
	$nextPage = $_GET['page'] + 1;
	$previous = $_GET['page'] - 1;
	if ($page == "1" && $lastPage == "1"){
		$paginationDisplay .=  '<img alt="صفحه اول" src="img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه قبل" src="img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="صفحه بعد" src="img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه آخر" src="img/x.gif" class="last disabled">';
		
	}elseif ($lastPage == 0){
		$paginationDisplay .=  '<img alt="صفحه اول" src="img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه قبل" src="img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="صفحه بعد" src="img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه آخر" src="img/x.gif" class="last disabled">';
		
	}elseif ($page == "1" && $lastPage != "1"){
		$paginationDisplay .=  '<img alt="صفحه اول" src="img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه قبل" src="img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<a class="next" href="page=' . $nextPage . '"><img alt="صفحه بعد" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="page=' . $lastPage . '"><img alt="صفحه آخر" src="img/x.gif"></a>';
	
	}elseif ($page != "1" && $page != $lastPage){
		$paginationDisplay .=  '<a class="first" href="page=1"><img alt="صفحه اول" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="page=' . $previous . '"><img alt="صفحه قبل" src="img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<a class="next" href="page=' . $nextPage . '"><img alt="صفحه بعد" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="page=' . $lastPage . '"><img alt="صفحه آخر" src="img/x.gif"></a>';
	
	}elseif ($page == $lastPage){
		$paginationDisplay .=  '<a class="first" href="page=1"><img alt="صفحه اول" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="page=' . $previous . '"><img alt="صفحه قبل" src="img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="صفحه بعد" src="img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه آخر" src="img/x.gif" class="last disabled">';
	}
	
	$limit = 'LIMIT ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 
	$time = time() - (60*5);
	$sql2 = mysql_query("SELECT * FROM ".TB_PREFIX."users where timestamp > $time and id > 3 ORDER BY username ASC $limit");

     
if($result){  
for ($i = 0; $i <= count($result)-1; $i++) {    

	$delLink = '<a href="?action=delVil&did='.$varray[$i]['wref'].'" onClick="return del(\'did\','.$varray[$i]['wref'].');"><img src="img/Admin/del.gif" class="del"></a>';
echo '
    <tr>
        <td>'.$result[$i]["wref"].'</td>
        <td><a href="?did='.$result[$i]["wref"].'">'.$result[$i]["name"].'</a></td>
        <td><a href="player.php?uid='.$result[$i]["owner"].'">'.$database->getUserField($result[$i]["owner"],'username',0).'</a></td>
        <td>'.$result[$i]["pop"].'</td>
		<td>'.$delLink.'</td>
    </tr>  
'; 
}}
else{  
echo '
    <tr>
        <td colspan="4">هيچ دهکده اي موجود نيست</td>  
    </tr>  
';
}
?>    
  
</table>
<div class="footer">
	<div class="paginator">
    <?php echo $paginationDisplay; ?>
    </div>
    <div class="clear"></div>
</div>





<style>

.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);} 

</style>

<?php

$id = $_GET['did'];

if(isset($id)){      

$village = $database->getVillage($id);  

$user = $database->getUserArray($village['owner'],1);  

$coor = $database->getCoor($village['wref']); 

$varray = $database->getProfileVillages($village['owner']); 

$type = $database->getVillageType($village['wref']);

$fdata = $database->getResourceLevel($village['wref']);

$units = $database->getUnit($village['wref']);



if($type == 3){

$typ = array(4,4,4,6);

}elseif($type == 6){

$typ = array(1,1,1,15);

}





if($village and $user){
?>

<br>

<table id="member" border="1" cellpadding="3" align="center" dir="rtl">

    <thead>

    <tr>

    
    <ul class="tabs"><center>
		<li>&#1578;&#1606;&#1592;&#1740;&#1605;&#1575;&#1578; &#1583;&#1607;&#1705;&#1583;&#1607;</li>
        </center>
	</ul>
    

    </tr>                                       

    </thead><tbody>

    <tr>

        <td>Village name:</td>

        <td><?php echo $village['name'];?></td>     

    </tr>

    <tr>

        <td>Population</td>

        <td><?php echo $village['pop'];?></td>     

    </tr>


    <tr>

        <td>Coordinates:</td>

        <td>(<?php echo $coor['x'];?>|<?php echo $coor['y'];?>)</td>     

    </tr>
		<tr>

        <td>Village ID</td>

        <td><?php echo $village['wref'];?></td>     

    </tr>

    <tr>

        <td>Field type</td>

        <td><?php        

          for ($i = 0; $i <= 3; $i++) {

            $a = $i+1;

            if($i != 3){

              echo $typ[$i].'x <img src="img/admin/r/'.$a.'.gif">| ';

            }else{

              echo $typ[$i].'x <img src="img/admin/r/'.$a.'.gif"> ';

            }               

          }

        ?></td>     

    </tr>

    </tbody>

</table>



<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

    <thead>

    <tr>
<ul class="tabs"><center>
		<li>&#1578;&#1606;&#1592;&#1740;&#1605;&#1575;&#1578; &#1605;&#1606;&#1575;&#1576;&#1593;</li>
        </center>
	</ul>


    </tr> 

    <tr>

    
    
    
        <td class="hab">Resource</td>

        <td class="hab" colspan="2">Warehouse</td>  
       

    </tr>                                     

    </thead><tbody> 

    <tr>

        <td><img src="img/admin/r/1.gif"> Lumber</td>

        <td class="hab"><?php echo floor($village['wood']);?></td>

        <td class="hab" rowspan="3"><?php echo $village['maxstore'];?></td>      

    </tr>

    <tr>

        <td><img src="img/admin/r/2.gif"> Clay</td>

        <td class="hab"><?php echo floor($village['clay']);?></td>
      

    </tr>

    <tr>

        <td><img src="img/admin/r/3.gif"> Iron</td>

        <td class="hab"><?php echo floor($village['iron']);?></td>    

    </tr>

    <tr>

        <td><img src="img/admin/r/4.gif"> Crop</td>

        <td class="hab"><?php echo floor($village['crop']);?></td>

        <td class="hab"><?php echo $village['maxcrop'];?></td> 
     

    </tr>



    </tbody>

</table>




<!-- OASIS -->
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

    <thead>

    <tr>

    
    
    <ul class="tabs"><center>
		<li>&#1578;&#1606;&#1592;&#1740;&#1605;&#1575;&#1578; &#1570;&#1576;&#1575;&#1583;&#1740;</li>
        </center>
	</ul>


    </tr>  

    <tr>

        <td class="ra"></td>

        <td class="hab">Name</td>

        <td class="hab">Coordinates</td>  

        <td class="hab">Loyalty</td>

        <td class="hab">Resource</td>         

    </tr>                                     

    </thead><tbody> 

    <tr>

        <td><a href="?delOas&oid=" onClick="return del(\'oas\','.$varray[$i]['wref'].');"><img src="img/admin/del.gif"></a></td>

        <td class="hab">Cooming soon</td>

        <td class="hab">Cooming soon</td> 

        <td class="hab">Cooming soon</td>  

        <td class="hab">Cooming soon</td>      

    </tr>



    </tbody>

</table>


<!-- TROOPS IN VILLAGE -->
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

    <thead>

    <tr>

    
    <ul class="tabs"><center>
		<li>&#1578;&#1606;&#1592;&#1740;&#1605;&#1575;&#1578; &#1604;&#1588;&#1705;&#1585;&#1740;&#1575;&#1606;</li>
        </center>
	</ul>
    


		<?php
		

		
#== Romans ==#          
if($units['u1'] == 0){
$u1 = '<font color="gray">'.$units['u1'].'';
}
else if($units['u1'] > 0){
$u1 = '<font color="black">'.$units['u1'].'';
}
if($units['u2'] == 0){
$u2 = '<font color="gray">'.$units['u2'].'';
}
else if($units['u2'] > 0){
$u2 = '<font color="black">'.$units['u2'].'';
}
#========================================
if($units['u3'] == 0){
$u3 = '<font color="gray">'.$units['u3'].'';
}
else if($units['u3'] > 0){
$u3 = '<font color="black">'.$units['u3'].'';
}
#========================================
if($units['u4'] == 0){
$u4 = '<font color="gray">'.$units['u4'].'';
}
else if($units['u4'] > 0){
$u4 = '<font color="black">'.$units['u4'].'';
}
#========================================
if($units['u5'] == 0){
$u5 = '<font color="gray">'.$units['u5'].'';
}
else if($units['u5'] > 0){
$u5 = '<font color="black">'.$units['u5'].'';
}
#========================================
if($units['u6'] == 0){
$u6 = '<font color="gray">'.$units['u6'].'';
}
else if($units['u6'] > 0){
$u6 = '<font color="black">'.$units['u6'].'';
}
#========================================
if($units['u7'] == 0){
$u7 = '<font color="gray">'.$units['u7'].'';
}
else if($units['u7'] > 0){
$u7 = '<font color="black">'.$units['u7'].'';
}
#========================================
if($units['u8'] == 0){
$u8 = '<font color="gray">'.$units['u8'].'';
}
else if($units['u8'] > 0){
$u8 = '<font color="black">'.$units['u8'].'';
}
#========================================
if($units['u9'] == 0){
$u9 = '<font color="gray">'.$units['u9'].'';
}
else if($units['u9'] > 0){
$u9 = '<font color="black">'.$units['u9'].'';
}
#========================================
if($units['u10'] == 0){
$u10 = '<font color="gray">'.$units['u10'].'';
}
else if($units['u10'] > 0){
$u10 = '<font color="black">'.$units['u10'].'';
}
#========================================
#== Teuotons ==#
#========================================
if($units['u11'] == 0){
$u11 = '<font color="gray">'.$units['u11'].'';
}
else if($units['u11'] > 0){
$u11 = '<font color="black">'.$units['u11'].'';
}
#========================================
if($units['u12'] == 0){
$u12 = '<font color="gray">'.$units['u12'].'';
}
else if($units['u12'] > 0){
$u12 = '<font color="black">'.$units['u12'].'';
}
#========================================
if($units['u13'] == 0){
$u13 = '<font color="gray">'.$units['u13'].'';
}
else if($units['u13'] > 0){
$u13 = '<font color="black">'.$units['u13'].'';
}
#========================================
if($units['u14'] == 0){
$u14 = '<font color="gray">'.$units['u14'].'';
}
else if($units['u14'] > 0){
$u14 = '<font color="black">'.$units['u14'].'';
}
#========================================
if($units['u15'] == 0){
$u15 = '<font color="gray">'.$units['u15'].'';
}
else if($units['u15'] > 0){
$u15 = '<font color="black">'.$units['u15'].'';
}
#========================================
if($units['u16'] == 0){
$u16 = '<font color="gray">'.$units['u16'].'';
}
else if($units['u16'] > 0){
$u16 = '<font color="black">'.$units['u16'].'';
}
#========================================
if($units['u17'] == 0){
$u17 = '<font color="gray">'.$units['u17'].'';
}
else if($units['u17'] > 0){
$u17 = '<font color="black">'.$units['u17'].'';
}
#========================================
if($units['u18'] == 0){
$u18 = '<font color="gray">'.$units['u18'].'';
}
else if($units['u18'] > 0){
$u18 = '<font color="black">'.$units['u18'].'';
}
#========================================
if($units['u19'] == 0){
$u19 = '<font color="gray">'.$units['u19'].'';
}
else if($units['u19'] > 0){
$u19 = '<font color="black">'.$units['u19'].'';
}
#========================================
if($units['u20'] == 0){
$u20 = '<font color="gray">'.$units['u20'].'';
}
else if($units['u20'] > 0){
$u20 = '<font color="black">'.$units['u20'].'';
}
#========================================
#== Gauls ==#
#========================================
if($units['u21'] == 0){
$u21 = '<font color="gray">'.$units['u21'].'';
}
else if($units['u21'] > 0){
$u21 = '<font color="black">'.$units['u21'].'';
}
#========================================
if($units['u22'] == 0){
$u22 = '<font color="gray">'.$units['u22'].'';
}
else if($units['u22'] > 0){
$u22 = '<font color="black">'.$units['u22'].'';
}
#========================================
if($units['u23'] == 0){
$u23 = '<font color="gray">'.$units['u23'].'';
}
else if($units['u23'] > 0){
$u23 = '<font color="black">'.$units['u23'].'';
}
#========================================
if($units['u24'] == 0){
$u24 = '<font color="gray">'.$units['u24'].'';
}
else if($units['u24'] > 0){
$u24 = '<font color="black">'.$units['u24'].'';
}
#========================================
if($units['u25'] == 0){
$u25 = '<font color="gray">'.$units['u25'].'';
}
else if($units['u25'] > 0){
$u25 = '<font color="black">'.$units['u25'].'';
}
#========================================
if($units['u26'] == 0){
$u26 = '<font color="gray">'.$units['u26'].'';
}
else if($units['u26'] > 0){
$u26 = '<font color="black">'.$units['u26'].'';
}
#========================================
if($units['u27'] == 0){
$u27 = '<font color="gray">'.$units['u27'].'';
}
else if($units['u27'] > 0){
$u27 = '<font color="black">'.$units['u27'].'';
}
#========================================
if($units['u28'] == 0){
$u28 = '<font color="gray">'.$units['u28'].'';
}
else if($units['u28'] > 0){
$u28 = '<font color="black">'.$units['u28'].'';
}
#========================================
if($units['u29'] == 0){
$u29 = '<font color="gray">'.$units['u29'].'';
}
else if($units['u29'] > 0){
$u29 = '<font color="black">'.$units['u29'].'';
}
#========================================
if($units['u30'] == 0){
$u30 = '<font color="gray">'.$units['u30'].'';
}
else if($units['u30'] > 0){
$u30 = '<font color="black">'.$units['u30'].'';
}
#========================================
#== Nature ==#  
if($units['u31'] == 0){
$u31 = '<font color="gray">'.$units['u31'].'';
}
else if($units['u31'] > 0){
$u31 = '<font color="black">'.$units['u31'].'';
}
#========================================
if($units['u32'] == 0){
$u32 = '<font color="gray">'.$units['u32'].'';
}
else if($units['u32'] > 0){
$u32 = '<font color="black">'.$units['u32'].'';
}
#========================================
if($units['u33'] == 0){
$u33 = '<font color="gray">'.$units['u33'].'';
}
else if($units['u33'] > 0){
$u33 = '<font color="black">'.$units['u33'].'';
}
#========================================
if($units['u34'] == 0){
$u34 = '<font color="gray">'.$units['u34'].'';
}
else if($units['u34'] > 0){
$u34 = '<font color="black">'.$units['u34'].'';
}
#========================================
if($units['u35'] == 0){
$u35 = '<font color="gray">'.$units['u35'].'';
}
else if($units['u35'] > 0){
$u35 = '<font color="black">'.$units['u35'].'';
}
#========================================
if($units['u36'] == 0){
$u36 = '<font color="gray">'.$units['u36'].'';
}
else if($units['u36'] > 0){
$u36 = '<font color="black">'.$units['u36'].'';
}
#========================================
if($units['u37'] == 0){
$u37 = '<font color="gray">'.$units['u37'].'';
}
else if($units['u37'] > 0){
$u37 = '<font color="black">'.$units['u37'].'';
}
#========================================
if($units['u38'] == 0){
$u38 = '<font color="gray">'.$units['u38'].'';
}
else if($units['u38'] > 0){
$u38 = '<font color="black">'.$units['u38'].'';
}
#========================================
if($units['u39'] == 0){
$u39 = '<font color="gray">'.$units['u39'].'';
}
else if($units['u39'] > 0){
$u39 = '<font color="black">'.$units['u39'].'';
}
#========================================
#== Natars ==# 
if($units['u40'] == 0){
$u40 = '<font color="gray">'.$units['u40'].'';
}
else if($units['u40'] > 0){
$u40 = '<font color="black">'.$units['u40'].'';
}
#========================================
if($units['u41'] == 0){
$u41 = '<font color="gray">'.$units['u41'].'';
}
else if($units['u41'] > 0){
$u41 = '<font color="black">'.$units['u41'].'';
}
#========================================
if($units['u42'] == 0){
$u42 = '<font color="gray">'.$units['u42'].'';
}
else if($units['u42'] > 0){
$u42 = '<font color="black">'.$units['u42'].'';
}
#========================================
if($units['u43'] == 0){
$u43 = '<font color="gray">'.$units['u43'].'';
}
else if($units['u43'] > 0){
$u43 = '<font color="black">'.$units['u43'].'';
}
#========================================
if($units['u44'] == 0){
$u44 = '<font color="gray">'.$units['u44'].'';
}
else if($units['u44'] > 0){
$u44 = '<font color="black">'.$units['u44'].'';
}
#========================================
if($units['u45'] == 0){
$u45 = '<font color="gray">'.$units['u45'].'';
}
else if($units['u45'] > 0){
$u45 = '<font color="black">'.$units['u45'].'';
}
#========================================
if($units['u46'] == 0){
$u46 = '<font color="gray">'.$units['u46'].'';
}
else if($units['u46'] > 0){
$u46 = '<font color="black">'.$units['u46'].'';
}
#========================================
if($units['u47'] == 0){
$u47 = '<font color="gray">'.$units['u47'].'';
}
else if($units['u47'] > 0){
$u47 = '<font color="black">'.$units['u47'].'';
}
#========================================
if($units['u48'] == 0){
$u48 = '<font color="gray">'.$units['u48'].'';
}
else if($units['u48'] > 0){
$u48 = '<font color="black">'.$units['u48'].'';
}
#========================================
if($units['u49'] == 0){
$u49 = '<font color="gray">'.$units['u49'].'';
}
else if($units['u49'] > 0){
$u49 = '<font color="black">'.$units['u49'].'';
}
#========================================
if($units['u50'] == 0){
$u50 = '<font color="gray">'.$units['u50'].'';
}
else if($units['u50'] > 0){
$u50 = '<font color="black">'.$units['u50'].'';
}
#======================================== 
?>


<!-- ROMAN UNITS -->
<?php 
		if($user['tribe'] == 1){
		echo '
    </tr></thead><tbody> 
    <tr>
		<td><center /><img src="img/un/u/1.gif"></img></td>
		<td><center /><img src="img/un/u/2.gif"></img></td>
        <td><center /><img src="img/un/u/3.gif"></img></td>
        <td><center /><img src="img/un/u/4.gif"></img></td>
        <td><center /><img src="img/un/u/5.gif"></img></td>
		<td><center /><img src="img/un/u/6.gif"></img></td>
        <td><center /><img src="img/un/u/7.gif"></img></td>
        <td><center /><img src="img/un/u/8.gif"></img></td>
        <td><center /><img src="img/un/u/9.gif"></img></td>
        <td><center /><img src="img/un/u/10.gif"></img></td>
    </tr>
		
   
   <tr>
        <td><center />'.$u1.'</td>
        <td><center />'.$u2.'</td>
        <td><center />'.$u3.'</td>
        <td><center />'.$u4.'</td>
        <td><center />'.$u5.'</td>
        <td><center />'.$u6.'</td>
        <td><center />'.$u7.'</td>
        <td><center />'.$u8.'</td>
        <td><center />'.$u9.'</td>
        <td><center />'.$u10.'</td>
     </tr>';
	}
	// TEUTON UNITS
	else if($user['tribe'] == 2){
	echo '
    </tr></thead><tbody> 
    <tr>
		<td><center /><img src="img/un/u/11.gif"></img></td>
		<td><center /><img src="img/un/u/12.gif"></img></td>
        <td><center /><img src="img/un/u/13.gif"></img></td>
        <td><center /><img src="img/un/u/14.gif"></img></td>
        <td><center /><img src="img/un/u/15.gif"></img></td>
		<td><center /><img src="img/un/u/16.gif"></img></td>
        <td><center /><img src="img/un/u/17.gif"></img></td>
        <td><center /><img src="img/un/u/18.gif"></img></td>
        <td><center /><img src="img/un/u/19.gif"></img></td>
        <td><center /><img src="img/un/u/20.gif"></img></td>
    </tr>
		
   
   <tr>
		<td><center />'.$u11.'</td>
        <td><center />'.$u12.'</td>
        <td><center />'.$u13.'</td>
        <td><center />'.$u14.'</td>
        <td><center />'.$u15.'</td>
        <td><center />'.$u16.'</td>
        <td><center />'.$u17.'</td>
        <td><center />'.$u18.'</td>
        <td><center />'.$u19.'</td>
        <td><center />'.$u20.'</td>
    </tr>';
	}
	// GAUL UNITS
	else if($user['tribe'] == 3){
	echo '
    </tr></thead><tbody> 
    <tr>
		<td><center /><img src="img/un/u/21.gif"></img></td>
		<td><center /><img src="img/un/u/22.gif"></img></td>
        <td><center /><img src="img/un/u/23.gif"></img></td>
        <td><center /><img src="img/un/u/24.gif"></img></td>
        <td><center /><img src="img/un/u/25.gif"></img></td>
		<td><center /><img src="img/un/u/26.gif"></img></td>
        <td><center /><img src="img/un/u/27.gif"></img></td>
        <td><center /><img src="img/un/u/28.gif"></img></td>
        <td><center /><img src="img/un/u/29.gif"></img></td>
        <td><center /><img src="img/un/u/30.gif"></img></td>
    </tr>
		
   
   <tr>
		<td><center />'.$u21.'</td>
        <td><center />'.$u22.'</td>
        <td><center />'.$u23.'</td>
        <td><center />'.$u24.'</td>
        <td><center />'.$u25.'</td>
        <td><center />'.$u26.'</td>
        <td><center />'.$u27.'</td>
        <td><center />'.$u28.'</td>
        <td><center />'.$u29.'</td>
        <td><center />'.$u30.'</td>
    </tr>';
	}
    // Nature UNITS
    else if($user['tribe'] == 4){
    echo '
    </tr></thead><tbody> 
    <tr>
        <td><center /><img src="img/un/u/31.gif"></img></td>
        <td><center /><img src="img/un/u/32.gif"></img></td>
        <td><center /><img src="img/un/u/33.gif"></img></td>
        <td><center /><img src="img/un/u/34.gif"></img></td>
        <td><center /><img src="img/un/u/35.gif"></img></td>
        <td><center /><img src="img/un/u/36.gif"></img></td>
        <td><center /><img src="img/un/u/37.gif"></img></td>
        <td><center /><img src="img/un/u/38.gif"></img></td>
        <td><center /><img src="img/un/u/39.gif"></img></td>
        <td><center /><img src="img/un/u/40.gif"></img></td>
    </tr>
        
   
   <tr>
        <td><center />'.$u31.'</td>
        <td><center />'.$u32.'</td>
        <td><center />'.$u33.'</td>
        <td><center />'.$u34.'</td>
        <td><center />'.$u35.'</td>
        <td><center />'.$u36.'</td>
        <td><center />'.$u37.'</td>
        <td><center />'.$u38.'</td>
        <td><center />'.$u39.'</td>
        <td><center />'.$u40.'</td>
    </tr>';
    }
    // Natras UNITS
    else if($user['tribe'] == 5){
    echo '
    </tr></thead><tbody> 
    <tr>
        <td><center /><img src="img/un/u/41.gif"></img></td>
        <td><center /><img src="img/un/u/42.gif"></img></td>
        <td><center /><img src="img/un/u/43.gif"></img></td>
        <td><center /><img src="img/un/u/44.gif"></img></td>
        <td><center /><img src="img/un/u/45.gif"></img></td>
        <td><center /><img src="img/un/u/46.gif"></img></td>
        <td><center /><img src="img/un/u/47.gif"></img></td>
        <td><center /><img src="img/un/u/48.gif"></img></td>
        <td><center /><img src="img/un/u/49.gif"></img></td>
        <td><center /><img src="img/un/u/50.gif"></img></td>
    </tr>
       
   
   <tr>
        <td><center />'.$u41.'</td>
        <td><center />'.$u42.'</td>
        <td><center />'.$u43.'</td>
        <td><center />'.$u44.'</td>
        <td><center />'.$u45.'</td>
        <td><center />'.$u46.'</td>
        <td><center />'.$u47.'</td>
        <td><center />'.$u48.'</td>
        <td><center />'.$u49.'</td>
        <td><center />'.$u50.'</td>
    </tr>';
    }


	?>
</tbody></table>
<?php echo '<div align="right"><a href="addtroops.php?did='.$id.'">Edit troops</div></a>'; 
	
	?>

<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 

    <thead>

    <tr>
    
    
    <ul class="tabs"><center>
		<li>&#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1605;&#1606;&#1575;&#1576;&#1593;</li>
        </center>
	</ul>
    



    </tr> 

    <tr>

        <td class="on">ID</td>

        <td class="on">GID</td>

        <td class="hab">Name</td>

        <td class="on">Level</td>        

    </tr>                                     

    </thead><tbody> 

    <?php           
function procResType($ref) {
		global $session;
		switch($ref) {
			case 1: $build = "Woodcutter"; break;
			case 2: $build = "Clay Pit"; break;
			case 3: $build = "Iron Mine"; break;
			case 4: $build = "Cropland"; break;
			case 5: $build = "Sawmill"; break;
			case 6: $build = "Brickyard"; break;
			case 7: $build = "Iron Foundry"; break;
			case 8: $build = "Grain Mill"; break;
			case 9: $build = "Bakery"; break;
			case 10: $build = "Warehouse"; break;
			case 11: $build = "Granary"; break;
			case 12: $build = "Blacksmith"; break;
			case 13: $build = "Armoury"; break;
			case 14: $build = "Tournament Square"; break;
			case 15: $build = "Main Building"; break;
			case 16: $build = "Rally Point"; break;
			case 17: $build = "Marketplace"; break;
			case 18: $build = "Embassy"; break;
			case 19: $build = "Barracks"; break;
			case 20: $build = "Stable"; break;
			case 21: $build = "Workshop"; break;
			case 22: $build = "Academy"; break;
			case 23: $build = "Cranny"; break;
			case 24: $build = "Town Hall"; break;
			case 25: $build = "Residence"; break;
			case 26: $build = "Palace"; break;
			case 27: $build = "Treasury"; break;
			case 28: $build = "Trade Office"; break;
			case 29: $build = "Great Barracks"; break;
			case 30: $build = "Great Stable"; break;
			case 31: $build = "City Wall"; break;
			case 32: $build = "Earth Wall"; break;
			case 33: $build = "Palisade"; break;
			case 34: $build = "Stonemason's Lodge"; break;
			case 35: $build = "Brewery"; break;
			case 36: $build = "Trapper"; break;
			case 37: $build = "Hero's Mansion"; break;
			case 38: $build = "Great Warehouse"; break;
			case 39: $build = "Great Granary"; break;
			case 40: $build = "Wonder of the World"; break;
			case 41: $build = "Horse Drinking Trough"; break;
			default: $build = "Error"; break;
		}
		return $build;
	}
      for ($i = 1; $i <= 40; $i++) {

      if($fdata['f'.$i.'t'] == 0){

        $bu = "-";

      }else{

        $bu = procResType($fdata['f'.$i.'t']);

      }

      echo '

      <tr>

        <td class="on">'.$i.'</td>

        <td class="on">'.$fdata['f'.$i.'t'].'</td>

        <td class="hab">'.$bu.'</td>   

        <td class="on">'.$fdata['f'.$i].'</td>    

      </tr>

      ';

    }

    ?>  

    </tbody>

</table>         



<?php

}else{

  echo "Not found...<a href=\"javascript: history.go(-1)\">Back</a>";

}

}

?>








<div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>


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


<?php }
?>

