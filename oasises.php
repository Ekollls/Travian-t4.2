<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/
*/

include_once("GameEngine/Account.php");
if($session->access != ADMIN) { 
	echo "شما ادمين نيستيد لطفا تلاش نکنيد."; 
} 
else{
   include "Templates/html.tpl";  



?>
<body class="v35 webkit chrome statistics">
	<div id="wrapper"> 
		<img id="staticElements" src="img/x.gif" alt="" /> 
		<div id="logoutContainer"> 
			<a id="logout" href="logout.php" title="<?php echo LOGOUT; ?>">&nbsp;</a> 
		</div> 
		<div class="bodyWrapper"> 
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> 
			<div id="header"> 
				<div id="mtop">
					<a id="logo" href="" target="_blank" title="<?php echo SERVER_NAME ?>"></a>
					<ul id="navigation">
						<li id="n1" class="resources">
							<a class="" href="dorf1.php" accesskey="1" title="<?php echo HEADER_DORF1; ?>"></a>
						</li>
						<li id="n2" class="village">
							<a class="" href="dorf2.php" accesskey="2" title="<?php echo HEADER_DORF2; ?>"></a>
						</li>
						<li id="n3" class="map">
							<a class="" href="karte.php" accesskey="3" title="<?php echo HEADER_MAP; ?>"></a>
						</li>
						<li id="n4" class="stats">
							<a class=" active" href="statistiken.php" accesskey="4" title="<?php echo HEADER_STATS; ?>"></a>
						</li>
<?php
    	if(count($database->getMessage($session->uid,7)) >= 1000) {
			$unmsg = "+1000";
		} else { $unmsg = count($database->getMessage($session->uid,7)); }
		
    	if(count($database->getMessage($session->uid,8)) >= 1000) {
			$unnotice = "+1000";
		} else { $unnotice = count($database->getMessage($session->uid,8)); }
?>
<li id="n5" class="reports"> 
<a href="berichte.php" accesskey="5" title="<?php echo HEADER_NOTICES; ?><?php if($message->nunread){ echo' ('.count($database->getMessage($session->uid,8)).')'; } ?>"></a>
<?php
if($message->nunread){
	echo "<div class=\"ltr bubble\" title=\"".$unnotice." ".HEADER_NOTICES_NEW."\" style=\"display:block\">
			<div class=\"bubble-background-l\"></div>
			<div class=\"bubble-background-r\"></div>
			<div class=\"bubble-content\">".$unnotice."</div></div>";
}
?>
</li>
<li id="n6" class="messages"> 
<a href="nachrichten.php" accesskey="6" title="<?php echo HEADER_MESSAGES; ?><?php if($message->unread){ echo' ('.count($database->getMessage($session->uid,7)).')'; } ?>"></a> 
<?php
if($message->unread) {
	echo "<div class=\"ltr bubble\" title=\"".$unmsg." ".HEADER_MESSAGES_NEW."\" style=\"display:block\">
			<div class=\"bubble-background-l\"></div>
			<div class=\"bubble-background-r\"></div>
			<div class=\"bubble-content\">".$unmsg."</div></div>";
}
?>
</li>

</ul>
<div class="clear"></div> 
</div> 
</div>
<div id="mid">

      
              <a id="ingameManual" href="support.php" title="&#1585;&#1575;&#1607;&#1606;&#1605;&#1575;">
              <img src="img/x.gif" class="question" alt="&#1585;&#1575;&#1607;&#1606;&#1605;&#1575;"/>
            </a>
  
      
            
        
        <div id="anwersQuestionMark">
            <a href="http://forum.t4dl.ir/index.php" target="_blank" title="&#1662;&#1575;&#1587;&#1582; &#1607;&#1575;&#1740;  &#1578;&#1585;&#1608;&#1740;&#1606;">&nbsp;</a>
        </div>    
            
            

												<div class="clear"></div> 
<div id="contentOuterContainer"> 
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
<table id="member" border="1" cellpadding="3" align="center" dir="rtl"> 
  <thead>
    <tr>
    
    <ul class="tabs"><center>
		<li>مديريت دهکده ها</li>
        </center>
	</ul>
</div>
    

    </tr>
  </thead> 

</table>
<table id="member" border="1" cellpadding="3" align="center" dir="rtl">    
    <tr>
        <td class="b">شماره آبادی</td>
        <td class="b">نام آبادی</td>
    </tr>
<?php 
	if (isset($_GET['page'])) { // دريافت شماره صفحه
		$page = preg_replace('#[^0-9]#i', '', $_GET['page']); // فيلتر کردن همه چيز به جز اعداد
	} else {
		$page = 1;
	}
	$data = $database->query("SELECT * FROM `". TB_PREFIX ."odata` WHERE 1 ORDER BY `wref` ASC ");
	$query = mysql_num_rows($data);
	$itemsPerPage = 30; //تعداد آيتم هاي قابل نمايش در هر صفحه
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
		$centerPages .= '<a class="number" href="oasises.php?page=2">2</a>';
		
	}elseif ($page == 1 && $lastPage == 3) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="oasises.php?page=2">2</a> ';
		$centerPages .= '<a class="number" href="oasises.php?page=3">3</a>';
		
	}elseif ($page == 1) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $add1 . '">' . $add1 . '</a> ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $add2 . '">' . $add2 . '</a> ... ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $lastPage . '">' . $lastPage . '</a>';
		
	} else if ($page == $lastPage && $lastPage == 2) {
		$centerPages .= '<a class="number" href="oasises.php?page=1">1</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
		
	} else if ($page == $lastPage && $lastPage == 3) {
		$centerPages .= '<a class="number" href="oasises.php?page=1">1</a> ';
		$centerPages .= '<a class="number" href="oasises.php?page=2">2</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
		
	} else if ($page == $lastPage) {
		$centerPages .= '<a class="number" href="oasises.php?page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $sub2 . '">' . $sub2 . '</a> ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
		
	} else if ($page == ($lastPage - 1) && $lastPage == 3) {
		$centerPages .= '<a class="number" href="oasises.php?page=1">1</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $lastPage . '">' . $lastPage . '</a>';
	
	} else if ($page > 2 && $page < ($lastPage - 1)) {
		$centerPages .= '<a class="number" href="oasises.php?page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $add1 . '">' . $add1 . '</a> ... ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $lastPage . '">' . $lastPage . '</a>';
		
	}else if ($page == ($lastPage - 1)) {
		$centerPages .= '<a class="number" href="oasises.php?page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $lastPage . '">' . $lastPage . '</a>';
	
	} else if ($page > 1 && $page < $lastPage && $lastPage == 3) {
		$centerPages .= '<a class="number" href="oasises.php?page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $add1 . '">' . $add1 . '</a>';
		
	} else if ($page > 1 && $page < $lastPage) {
		$centerPages .= '<a class="number" href="oasises.php?page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $add1 . '">' . $add1 . '</a> ... ';
		$centerPages .= '<a class="number" href="oasises.php?page=' . $lastPage . '">' . $lastPage . '</a>';
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
		$paginationDisplay .=  '<a class="next" href="oasises.php?page=' . $nextPage . '"><img alt="صفحه بعد" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="oasises.php?page=' . $lastPage . '"><img alt="صفحه آخر" src="img/x.gif"></a>';
	
	}elseif ($page != "1" && $page != $lastPage){
		$paginationDisplay .=  '<a class="first" href="oasises.php?page=1"><img alt="صفحه اول" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="oasises.php?page=' . $previous . '"><img alt="صفحه قبل" src="img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<a class="next" href="oasises.php?page=' . $nextPage . '"><img alt="صفحه بعد" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="oasises.php?page=' . $lastPage . '"><img alt="صفحه آخر" src="img/x.gif"></a>';
	
	}elseif ($page == $lastPage){
		$paginationDisplay .=  '<a class="first" href="oasises.php?page=1"><img alt="صفحه اول" src="img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="oasises.php?page=' . $previous . '"><img alt="صفحه قبل" src="img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="صفحه بعد" src="img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه آخر" src="img/x.gif" class="last disabled">';
	}
	$page = $page == 0 ? 1 : $page;
	$limit = 'LIMIT ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 
$result = $database->query_return("SELECT * FROM `". TB_PREFIX ."odata` WHERE 1 ORDER BY `wref` ASC ".$limit."");
     
if(isset($result)){  
for ($i = 0; $i <= count($result)-1; $i++) {    
echo '
    <tr>
        <td>'.$result[$i]["wref"].'</td>
        <td><a href="addtroops.php?did='.$result[$i]["wref"].'">'.$result[$i]["name"].'</a></td>
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

