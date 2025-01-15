<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
		date_default_timezone_set("Asia/Tehran");

include("database.php");


$xyas=(1+(2*WORLD_MAX));
$nareadis = NATARS_MAX;
for($i=0; $i<$xyas; $i++){
$y=(WORLD_MAX-$i);

	for($j=0; $j<$xyas; $j++){
	$x=((WORLD_MAX*-1)+$j);
	
	//choose a field type
	if($x >= -2 && $x <= 2 && $y >= -2 && $y <= 1){
		if($x == 0 && $y == 0){	$typ='1';} else {$typ='3';} 
		$otype='0';
	}else{
		$rand=rand(1, 1000);
		if("900" >= $rand){
			if("10" >= $rand){	$typ='1';$otype='0';
			} else if("90" >= $rand){$typ='2';$otype='0';
			} else if("400" >= $rand){$typ='3';$otype='0';
			} else if("480" >= $rand){$typ='4';$otype='0';
			} else if("560" >= $rand){$typ='5';$otype='0';
			} else if("570" >= $rand){$typ='6';$otype='0';
			} else if("600" >= $rand){$typ='7';$otype='0';
			} else if("630" >= $rand){$typ='8';$otype='0';
			} else if("660" >= $rand){$typ='9';$otype='0';
			} else if("740" >= $rand){$typ='10';$otype='0';
			} else if("820" >= $rand){$typ='11';$otype='0';
			} else{$typ='12';$otype='0';}
		} else {
			if(sqrt(($x*$x)+($y*$y))<=$nareadis){
				if("916" >= $rand){$typ='0';$otype='2';
				} else if("924" >= $rand){	$typ='0';$otype='3';
				} else if("940" >= $rand){$typ='0';$otype='5';
				} else if("948" >= $rand){$typ='0';$otype='6';
				} else if("964" >= $rand){$typ='0';$otype='8';
				} else if("972" >= $rand){$typ='0';$otype='9';
				} else {$typ='0';$otype='12';}
			} else {
				if("916" >= $rand){$typ='0';$otype='1';
				} else if("924" >= $rand){	$typ='0';$otype='3';
				} else if("940" >= $rand){$typ='0';$otype='4';
				} else if("948" >= $rand){$typ='0';$otype='6';
				} else if("964" >= $rand){$typ='0';$otype='7';
				} else if("972" >= $rand){$typ='0';$otype='9';
				} else if("980" >= $rand){$typ='0';$otype='10';
				} else if("988" >= $rand){$typ='0';$otype='11';
				} else {$typ='0';$otype='12';}
			}
		}
	}
	
	//image pick
	if($otype=='0'){
		$image="t".rand(0,8)."";
	} else {
		$image="o".$otype."";
	}
		
		//into database
		$q = "INSERT into ".TB_PREFIX."wdata values (0,'".$typ."','".$otype."','".$x."','".$y."',0,'".$image."')";
		$database->query($q);
	}
}
		header("Location: ../index.php?s=4");

?>