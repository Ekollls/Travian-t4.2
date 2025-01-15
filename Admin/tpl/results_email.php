<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       resutls_email.tpl                                           ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php
$result = $admin->search_email($_POST['s']);
?>
<table id="member">
  <thead>
    <tr>
    	<ul class="tabs"><center>
		<li>مدیریت ایمیل ها (<?php echo count($result);?>)</li>
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
        <td class="b">ایمیل</td>         
    </tr>
<?php 


	$time = time() - (60*5);
	$sql = mysql_query("SELECT * FROM ".TB_PREFIX."users where timestamp > $time and id > 3 ORDER BY username ASC $limit");
	$query = mysql_num_rows($sql);
	if (isset($_GET['page'])) { // دریافت شماره صفحه
		$page = preg_replace('#[^0-9]#i', '', $_GET['page']); // فیلتر کردن همه چیز به جز اعداد
	} else {
		$page = 1;
	}
	
	$itemsPerPage = 10; //تعداد آیتم های قابل نمایش در هر صفحه
	$lastPage = ceil($query / $itemsPerPage); // دریافت مقدار آخرین صفحه
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
		$paginationDisplay .=  '<img alt="صفحه اول" src="../img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه قبل" src="../img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="صفحه بعد" src="../img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه آخر" src="../img/x.gif" class="last disabled">';
		
	}elseif ($lastPage == 0){
		$paginationDisplay .=  '<img alt="صفحه اول" src="../img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه قبل" src="../img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="صفحه بعد" src="../img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه آخر" src="../img/x.gif" class="last disabled">';
		
	}elseif ($page == "1" && $lastPage != "1"){
		$paginationDisplay .=  '<img alt="صفحه اول" src="../img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه قبل" src="../img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<a class="next" href="page=' . $nextPage . '"><img alt="صفحه بعد" src="../img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="page=' . $lastPage . '"><img alt="صفحه آخر" src="../img/x.gif"></a>';
	
	}elseif ($page != "1" && $page != $lastPage){
		$paginationDisplay .=  '<a class="first" href="page=1"><img alt="صفحه اول" src="../img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="page=' . $previous . '"><img alt="صفحه قبل" src="../img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<a class="next" href="page=' . $nextPage . '"><img alt="صفحه بعد" src="../img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="page=' . $lastPage . '"><img alt="صفحه آخر" src="../img/x.gif"></a>';
	
	}elseif ($page == $lastPage){
		$paginationDisplay .=  '<a class="first" href="page=1"><img alt="صفحه اول" src="../img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="page=' . $previous . '"><img alt="صفحه قبل" src="../img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="صفحه بعد" src="../img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="صفحه آخر" src="../img/x.gif" class="last disabled">';
	}
	
	$limit = 'LIMIT ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 
	$time = time() - (60*5);
	$sql2 = mysql_query("SELECT * FROM ".TB_PREFIX."users where timestamp > $time and id > 3 ORDER BY username ASC $limit");

     
if($result){  
for ($i = 0; $i <= count($result)-1; $i++) {    
echo '
    <tr>
        <td>'.$result[$i]["id"].'</td>
        <td><a href="?p=player&uid='.$result[$i]["id"].'">'.$database->getUserField($result[$i]["id"],'username',0).'</a></td>
        <td>'.$result[$i]["email"].'</td>
    </tr>  
'; 
}}
else{  
echo '
    <tr>
        <td colspan="4">هیچ ایمیلی موجود نیست</td>  
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