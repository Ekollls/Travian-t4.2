<?php			   
	//gp link
	if($session->gpack == null || GP_ENABLE == false) {
	$gpack= GP_LOCATE;
	} else {
	$gpack= $session->gpack;
	}


  
//de lintjes
/******************************
INDELING CATEGORIEEN:
===============================
== 1. Aanvallers top 10      ==
== 2. Defence top 10         ==
== 3. Klimmers top 10        ==
== 4. Overvallers top 10     ==
== 5. In att en def tegelijk ==
== 6. in top 3 - aanval      ==
== 7. in top 3 - verdediging ==
== 8. in top 3 - klimmers    ==
== 9. in top 3 - overval     ==
******************************/
$geregistreerd=date('Y/m/d', ($allianceinfo['timestamp']));

$profiel = preg_replace("/\[war]/s",WARWITH.'<br>'.$database->getAllianceDipProfile($aid,3), $profiel, 1); 
$profiel = preg_replace("/\[ally]/s",CONFWITH.'<br>'.$database->getAllianceDipProfile($aid,1), $profiel, 1); 
$profiel = preg_replace("/\[nap]/s",NAPWITH.'<br>'.$database->getAllianceDipProfile($aid,2), $profiel, 1); 
$profiel = preg_replace("/\[diplomatie]/s",CONFWITH.'<br>'.$database->getAllianceDipProfile($aid,1).'<br>'.NAPWITH.'<br>'.$database->getAllianceDipProfile($aid,2).'<br>'.WARWITH.'<br>'.$database->getAllianceDipProfile($aid,3), $profiel, 1);

foreach($varmedal as $medal) {

switch ($medal['categorie']) {
    case "1":
        $titel=AOFW;
		$woord=POINTS;
        break;
    case "2":
        $titel=DOFW;
 		$woord=POINTS;
       break;
    case "3":
        $titel=COFW;
 		$woord=POINTS;
       break;
    case "4":
        $titel=ROFW;
		$woord=POINTS;
        break;
	 case "5":
        $titel=ADOFW;
        $bonus[$medal['id']]=1;
		break;
	 case "6":
        $titel=sprintf(TOP3AOFW,$medal['points']);
        $bonus[$medal['id']]=1;
		break;
	 case "7":
        $titel=sprintf(TOP3DOFW,$medal['points']);
        $bonus[$medal['id']]=1;
		break;
	 case "8":
        $titel=sprintf(TOP3COFW,$medal['points']);
        $bonus[$medal['id']]=1;
		break;
	 case "9":
        $titel=sprintf(TOP3ROFW,$medal['points']);
        $bonus[$medal['id']]=1;
		break;
    case "11":
        $titel=sprintf(TOP3COFW,$medal['points']);
        $bonus[$medal['id']]=1;
        break;
         case "12":
        $titel= POINTS.': '.$medal['points'];
        $bonus[$medal['id']]=1;
        break;
        case "13":
        $titel= POINTS.': '.$medal['points'];
        $bonus[$medal['id']]=1;
        break;
        case "15":
        $titel=POINTS.': '.$medal['points'];
        $bonus[$medal['id']]=1;
        break;
        case "16":
        $titel=POINTS.': '.$medal['points'];
        $bonus[$medal['id']]=1;
        break;

}

if(isset($bonus[$medal['id']])){
$profiel = preg_replace("/\[#".$medal['id']."]/is",'<img src="'.$gpack.'img/t/'.$medal['img'].'.gif" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>'.$titel.'<br /><br />'.WEEK.': '.$medal['week'].'</td></tr></table>\')">', $profiel, 1);
} else {
$profiel = preg_replace("/\[#".$medal['id']."]/is",'<img src="'.$gpack.'img/t/'.$medal['img'].'.gif" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>'.JR_CATEGORY.':</td><td>'.$titel.'</td></tr><tr><td>'.WEEK.':</td><td>'.$medal['week'].'</td></tr><tr><td>'.RANK.':</td><td>'.$medal['plaats'].'</td></tr><tr><td>'.$woord.':</td><td>'.$medal['points'].'</td></tr></table>\')">', $profiel, 1);
}
}



?>

