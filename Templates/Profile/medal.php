<?php			   
	//gp link
	if($session->gpack == null || GP_ENABLE == false) {
	$gpack= GP_LOCATE;
	} else {
	$gpack= $session->gpack;
	}

	
//de bird
if($displayarray['protect'] > time()){
$uurover=date('H:i:s', ($displayarray['protect'] - time()));
$profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'img/t/tn.gif" border="0" title="'.sprintf(UBPUNTIL,$uurover).'" >', $profiel, 1);
} else {
$geregistreerd=date('Y/m/d', ($displayarray['timestamp']));
$tregistreerd=date('H:i', ($displayarray['timestamp']));
$profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'img/t/tnd.gif" border="0" title="'.sprintf(PLAYERREGAT,$geregistreerd.' '.$tregistreerd).'">', $profiel, 1);
}

//natar image
if($displayarray['username'] == "Natars"){
$profiel = preg_replace("/\[#natars]/is",'<img src="gpack/travian_Travian_4.2_BigBang/img/t/t10_2.jpg" border="0">', $profiel, 1);
$profiel = preg_replace("/\[#natars]/is",'<img src="gpack/travian_Travian_4.2_BigBang/img/t/t10_2.jpg" border="0">', $profiel, 1);
}

//de lintjes
/******************************
INDELING CATEGORIEEN:
===============================
== 1. Attackers top 10       ==
== 2. Defence top 10         ==
== 3. Climbers top 10        ==
== 4. Raiders top 10 	     ==
== 5. attackers and defences ==
== 6. in top 3 - Attackers   ==
== 7. in top 3 - Defence 	 ==
== 8. in top 3 - Climbers    ==
== 9. in top 3 - Raiders     ==
******************************/

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
     case "10":
        $titel=COFW;
        $woord=RANK; 
        break;
         case "11":
        $titel=sprintf(TOP3COFW,$medal['points']);
        $bonus[$medal['id']]=1;
        break;
         case "12":
        $titel=sprintf(TOP10AOFW,$medal['points']);
        $bonus[$medal['id']]=1;
        break;
        case "13":
        $titel=sprintf(TOP10DOFW,$medal['points']);
        $bonus[$medal['id']]=1;
        break;
        case "14":
        $titel=sprintf(TOP10COFW,$medal['points']);
        $bonus[$medal['id']]=1;
        break;
        case "15":
        $titel=sprintf(TOP10ROFW,$medal['points']);
        $bonus[$medal['id']]=1;
        break;
        case "16":
        $titel=sprintf(TOP10COFW,$medal['points']);
        $bonus[$medal['id']]=1;
        break;
        

}

if(isset($bonus[$medal['id']])){

	$profiel = preg_replace("/\[#".$medal['id']."]/is",'<img class="medal '.$medal['img'].'" src="img/x.gif" title="'.$titel.'<br />'.WEEK.' '.$medal['week'].'">', $profiel, 1);
} else {
	$profiel = preg_replace("/\[#".$medal['id']."]/is",'<img class="medal '.$medal['img'].'" src="img/x.gif" title="'.JR_CATEGORY.': '.$titel.'<br />'.WEEK.': '.$medal['week'].'<br />'.RANK.': '.$medal['plaats'].'<br />'.$woord.': '.$medal['points'].'<br />">', $profiel, 1);
}
}



?>

