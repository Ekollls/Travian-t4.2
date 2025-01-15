<?php
if(isset($btype) && isset($type)){
	if($btype==1){
	    	if($type==1){
			$name = HELMETEXP1;
		    $item = "1";
		    $effect = "15";
				$title = sprintf(HELMETEXPDESC,($effect*ITEMATTRSPEED));
			}elseif($type==2){
			$name = HELMETEXP2;
		    $item = "2";
		    $effect = "20";
				$title = sprintf(HELMETEXPDESC,($effect*ITEMATTRSPEED));
			}elseif($type==3){
			$name = HELMETEXP3;
		    $item = "3";
		    $effect = "25";
				$title = sprintf(HELMETEXPDESC,($effect*ITEMATTRSPEED));
			}
		if($type==4){
			$name = HELMETREG1;
		    $item = "4";
		    $effect = "10";
				$title = sprintf(HELMETREGDESC,($effect*ITEMATTRSPEED));
		}elseif($type==5){
			$name = HELMETREG2;
		    $item = "5";
		    $effect = "15";
				$title = sprintf(HELMETREGDESC,($effect*ITEMATTRSPEED));
		}elseif($type==6){
			$name = HELMETREG3;
		    $item = "6";
		    $effect = "20";
				$title = sprintf(HELMETREGDESC,($effect*ITEMATTRSPEED));
		}
		if($type==7){
			$name = HELMETCP1;
		    $item = "7";
		    $effect = "100";
				$title = sprintf(HELMETCPDESC,($effect*ITEMATTRSPEED));
			}elseif($type==8){
			$name = HELMETCP2;
		    $item = "8";
		    $effect = "400";
				$title = sprintf(HELMETCPDESC,($effect*ITEMATTRSPEED));
			}elseif($type==9){
			$name = HELMETCP3;
		    $item = "9";
		    $effect = "800";
				$title = sprintf(HELMETCPDESC,($effect*ITEMATTRSPEED));
			}
		if($type==10){
			$name = HELMETCAV1;
		    $item = "10";
		    $effect = "10";
				$title = sprintf(HELMETCAVDESC,($effect*ITEMATTRSPEED));
			}elseif($type==11){
			$name = HELMETCAV2;
		    $item = "11";
		    $effect = "15";
				$title = sprintf(HELMETCAVDESC,($effect*ITEMATTRSPEED));
			}elseif($type==12){
			$name = HELMETCAV3;
		    $item = "12";
		    $effect = "20";
				$title = sprintf(HELMETCAVDESC,($effect*ITEMATTRSPEED));
			}
		if($type==13){
			$name = HELMETINF1;
		    $item = "13";
		    $effect = "10";
				$title = sprintf(HELMETINFDESC,($effect*ITEMATTRSPEED));
			}elseif($type==14){
			$name = HELMETINF2;
		    $item = "14";
		    $effect = "15";
				$title = sprintf(HELMETINFDESC,($effect*ITEMATTRSPEED));
			}elseif($type==15){
			$name = HELMETINF3;
		    $item = "15";
		    $effect = "20";
				$title = sprintf(HELMETINFDESC,($effect*ITEMATTRSPEED));
			}
		
	}elseif($btype==2){
		if($type==82){
		$name = ARMORREG1;
		$item = "82";
		    $effect = "20";
				$title = sprintf(ARMORREGDESC,($effect*ITEMATTRSPEED));
			}elseif($type==83){
			$name = ARMORREG2;
		    $item = "83";
		    $effect = "30";
				$title = sprintf(ARMORREGDESC,($effect*ITEMATTRSPEED));
			}elseif($type==84){
			$name = ARMORREG3;
		    $item = "84";
		    $effect = "40";
				$title = sprintf(ARMORREGDESC,($effect*ITEMATTRSPEED));
			}
		if($type==85){
			$name = ARMORSCA1;
		    $item = "85";
		    $effect = "10";
		    $effect2 = "4";
				$title = sprintf(ARMORSCADESC,($effect*ITEMATTRSPEED),($effect2*ITEMATTRSPEED));
		}elseif($type==86){
			$name = ARMORSCA2;
		    $item = "86";
		    $effect = "15";
		    $effect2 = "6";
				$title = sprintf(ARMORSCADESC,($effect*ITEMATTRSPEED),($effect2*ITEMATTRSPEED));
		}elseif($type==87){
			$name = ARMORSCA3;
		    $item = "87";
		    $effect = "20";
		    $effect2 = "8";
				$title = sprintf(ARMORSCADESC,($effect*ITEMATTRSPEED),($effect2*ITEMATTRSPEED));
		}
		if($type==88){
			$name = ARMORBPL1;
		    $item = "88";
		    $effect = "500";
				$title = sprintf(ARMORBPLDESC,($effect));
			}elseif($type==89){
			$name = ARMORBPL2;
		    $item = "89";
		    $effect = "1000";
				$title = sprintf(ARMORBPLDESC,($effect));
			}elseif($type==90){
			$name = ARMORBPL3;
		    $item = "90";
		    $effect = "1500";
				$title = sprintf(ARMORBPLDESC,($effect));
			}
		if($type==91){
			$name = ARMORSEG1;
		    $item = "91";
		    $effect = "3";
		    $effect2 = "250";
				$title = sprintf(ARMORSEGDESC,($effect*ITEMATTRSPEED),($effect2));
			}elseif($type==92){
			$name = ARMORSEG2;
		    $item = "92";
		    $effect = "4";
		    $effect2 = "500";
				$title = sprintf(ARMORSEGDESC,($effect*ITEMATTRSPEED),($effect2));
			}elseif($type==93){
			$name = ARMORSEG3;
		    $item = "93";
		    $effect = "5";
		    $effect2 = "750";
				$title = sprintf(ARMORSEGDESC,($effect*ITEMATTRSPEED),($effect2));
			}
		
	}elseif($btype==3){
	    
			if($type==61){
			$name = LEFTMAP1;
		    $item = "61";
		    $effect = "30";
				$title = sprintf(LEFTMAPDESC,($effect*ITEMATTRSPEED));
			}elseif($type==62){
			$name = LEFTMAP2;
		    $item = "62";
		    $effect = "40";
				$title = sprintf(LEFTMAPDESC,($effect*ITEMATTRSPEED));
			}elseif($type==63){
			$name = LEFTMAP3;
		    $item = "63";
		    $effect = "50";
				$title = sprintf(LEFTMAPDESC,($effect*ITEMATTRSPEED));
			}
		if($type==64){
			$name = LEFTFLG1;
		    $item = "64";
		    $effect = "30";
				$title = sprintf(LEFTFLGDESC,($effect*ITEMATTRSPEED));
			}elseif($type==65){
			$name = LEFTFLG2;
		    $item = "65";
		    $effect = "40";
				$title = sprintf(LEFTFLGDESC,($effect*ITEMATTRSPEED));
			}elseif($type==66){
			$name = LEFTFLG3;
		    $item = "66";
		    $effect = "50";
				$title = sprintf(LEFTFLGDESC,($effect*ITEMATTRSPEED));
			}
		if($type==67){
			$name = LEFTFOF1;
		    $item = "67";
		    $effect = "15";
				$title = sprintf(LEFTFOFDESC,($effect*ITEMATTRSPEED));
			}elseif($type==68){
			$name = LEFTFOF2;
		    $item = "68";
		    $effect = "20";
				$title = sprintf(LEFTFOFDESC,($effect*ITEMATTRSPEED));
			}elseif($type==69){
			$name = LEFTFOF3;
		    $item = "69";
		    $effect = "25";
				$title = sprintf(LEFTFOFDESC,($effect*ITEMATTRSPEED));
			}
		if($type==73){
			$name = LEFTBAG1;
		    $item = "73";
		    $effect = "10";
				$title = sprintf(LEFTBAGDESC,($effect*ITEMATTRSPEED));
			}elseif($type==74){
			$name = LEFTBAG2;
		    $item = "74";
		    $effect = "15";
				$title = sprintf(LEFTBAGDESC,($effect*ITEMATTRSPEED));
			}elseif($type==75){
			$name = LEFTBAG3;
		    $item = "75";
		    $effect = "20";
				$title = sprintf(LEFTBAGDESC,($effect*ITEMATTRSPEED));
			}
		if($type==76){
			$name = RIGHTSLD1;
		    $item = "76";
		    $effect = "500";
				$title = sprintf(RIGHTSLDDESC,($effect));
		}elseif($type==77){
			$name = RIGHTSLD2;
		    $item = "77";
		    $effect = "1000";
				$title = sprintf(RIGHTSLDDESC,($effect));
		}elseif($type==78){
			$name = RIGHTSLD3;
		    $item = "78";
		    $effect = "1500";
				$title = sprintf(RIGHTSLDDESC,($effect));
		}
		if($type==79){
			$name = RIGHTNRH1;
		    $item = "79";
		    $effect = "25";
				$title = sprintf(RIGHTNRHDESC,($effect*ITEMATTRSPEED));
			}elseif($type==80){
			$name = RIGHTNRH2;
		    $item = "80";
		    $effect = "50";
				$title = sprintf(RIGHTNRHDESC,($effect*ITEMATTRSPEED));
			}elseif($type==81){
			$name = RIGHTNRH3;
		    $item = "81";
		    $effect = "75";
				$title = sprintf(RIGHTNRHDESC,($effect*ITEMATTRSPEED));
			}
		
		}elseif($btype==4){
	    
			if($type==16){
			$name = RIGHTU1S1;
		    $item = "16";
		    $effect = "500";
		    $effect2 = "3";
				$title = sprintf(RIGHTU1SDESC,($effect),($effect2),($effect2));
			}elseif($type==17){
			$name = RIGHTU1S2;
		    $item = "17";
		    $effect = "1000";
				$effect2 = "4";
				$title = sprintf(RIGHTU1SDESC,($effect),($effect2),($effect2));
			}elseif($type==18){
			$name = RIGHTU1S3;
		    $item = "18";
		    $effect = "1500";
				$effect2 = "5";
				$title = sprintf(RIGHTU1SDESC,($effect),($effect2),($effect2));
			}
		if($type==19){
			$name = RIGHTU2S1;
		    $item = "19";
				$effect2 = "3";
		    $effect = "500";
				$title = sprintf(RIGHTU2SDESC,($effect),($effect2),($effect2));
		}elseif($type==20){
			$name = RIGHTU2S2;
		    $item = "20";
		    $effect = "1000";
				$effect2 = "4";
				$title = sprintf(RIGHTU2SDESC,($effect),($effect2),($effect2));
		}elseif($type==21){
			$name = RIGHTU2S3;
		    $item = "21";
		    $effect = "1500";
				$effect2 = "5";
				$title = sprintf(RIGHTU2SDESC,($effect),($effect2),($effect2));
		}
		if($type==22){
			$name = RIGHTU3S1;
		    $item = "22";
		    $effect = "500";
				$effect2 = "3";
				$title = sprintf(RIGHTU3SDESC,($effect),($effect2),($effect2));
			}elseif($type==23){
			$name = RIGHTU3S2;
		    $item = "23";
		    $effect = "1000";
				$effect2 = "4";
				$title = sprintf(RIGHTU3SDESC,($effect),($effect2),($effect2));
			}elseif($type==24){
			$name = RIGHTU3S3;
		    $item = "24";
		    $effect = "1500";
				$effect2 = "5";
				$title = sprintf(RIGHTU3SDESC,($effect),($effect2),($effect2));
			}
		if($type==25){
			$name = RIGHTU5S1;
		    $item = "25";
		    $effect = "500";
				$effect2 = "9";
				$title = sprintf(RIGHTU5SDESC,($effect),($effect2),($effect2));
			}elseif($type==26){
			$name = RIGHTU5S2;
		    $item = "26";
		    $effect = "1000";
				$effect2 = "12";
				$title = sprintf(RIGHTU5SDESC,($effect),($effect2),($effect2));
			}elseif($type==27){
			$name = RIGHTU5S3;
		    $item = "27";
		    $effect = "1500";
				$effect2 = "15";
				$title = sprintf(RIGHTU5SDESC,($effect),($effect2),($effect2));
			}
		if($type==28){
			$name = RIGHTU6S1;
		    $item = "28";
		    $effect = "500";
				$effect2 = "12";
				$title = sprintf(RIGHTU6SDESC,($effect),($effect2),($effect2));
		}elseif($type==29){
			$name = RIGHTU6S2;
		    $item = "29";
		    $effect = "1000";
				$effect2 = "16";
				$title = sprintf(RIGHTU6SDESC,($effect),($effect2),($effect2));
		}elseif($type==30){
			$name = RIGHTU6S3;
		    $item = "30";
		    $effect = "1500";
				$effect2 = "20";
				$title = sprintf(RIGHTU6SDESC,($effect),($effect2),($effect2));
		}
		if($type==31){
			$name = RIGHTU21S1;
		    $item = "31";
		    $effect = "500";
				$effect2 = "3";
				$title = sprintf(RIGHTU21SDESC,($effect),($effect2),($effect2));
			}elseif($type==32){
			$name = RIGHTU21S2;
		    $item = "32";
		    $effect = "1000";
				$effect2 = "4";
				$title = sprintf(RIGHTU21SDESC,($effect),($effect2),($effect2));
			}elseif($type==33){
			$name = RIGHTU21S3;
		    $item = "33";
		    $effect = "1500";
				$effect2 = "5";
				$title = sprintf(RIGHTU21SDESC,($effect),($effect2),($effect2));
			}
		if($type==34){
			$name = RIGHTU22S1;
		    $item = "34";
		    $effect = "500";
				$effect2 = "3";
				$title = sprintf(RIGHTU22SDESC,($effect),($effect2),($effect2));
		}elseif($type==35){
			$name = RIGHTU22S2;
		    $item = "35";
		    $effect = "1000";
				$effect2 = "4";
				$title = sprintf(RIGHTU22SDESC,($effect),($effect2),($effect2));
		}elseif($type==36){
			$name = RIGHTU22S3;
		    $item = "36";
		    $effect = "1500";
				$effect2 = "5";
				$title = sprintf(RIGHTU22SDESC,($effect),($effect2),($effect2));
		}
		if($type==37){
			$name =  RIGHTU24S1;
		    $item = "37";
		    $effect = "500";
				$effect2 = "6";
				$title = sprintf(RIGHTU24SDESC,($effect),($effect2),($effect2));
			}elseif($type==38){
			$name = RIGHTU24S2;
		    $item = "38";
		    $effect = "1000";
				$effect2 = "8";
				$title = sprintf(RIGHTU24SDESC,($effect),($effect2),($effect2));
			}elseif($type==39){
			$name = RIGHTU24S3;
		    $item = "39";
		    $effect = "1500";
				$effect2 = "10";
				$title = sprintf(RIGHTU24SDESC,($effect),($effect2),($effect2));
			}
		if($type==40){
			$name = RIGHTU25S1;
		    $item = "40";
		    $effect = "500";
				$effect2 = "6";
				$title = sprintf(RIGHTU25SDESC,($effect),($effect2),($effect2));
			}elseif($type==41){
			$name = RIGHTU25S2;
		    $item = "41";
		    $effect = "1000";
				$effect2 = "8";
				$title = sprintf(RIGHTU25SDESC,($effect),($effect2),($effect2));
			}elseif($type==42){
			$name = RIGHTU25S3;
		    $item = "42";
		    $effect = "1500";
				$effect2 = "10";
				$title = sprintf(RIGHTU25SDESC,($effect),($effect2),($effect2));
			}
		if($type==43){
			$name = RIGHTU26S1;
		    $item = "43";
		    $effect = "500";
				$effect2 = "9";
				$title = sprintf(RIGHTU26SDESC,($effect),($effect2),($effect2));
		}elseif($type==44){
			$name = RIGHTU26S2;
		    $item = "44";
		    $effect = "1000";
				$effect2 = "12";
				$title = sprintf(RIGHTU26SDESC,($effect),($effect2),($effect2));
		}elseif($type==45){
			$name = RIGHTU26S3;
		    $item = "45";
		    $effect = "1500";
				$effect2 = "15";
				$title = sprintf(RIGHTU26SDESC,($effect),($effect2),($effect2));
		}
		if($type==46){
			$name = RIGHTU11S1;
		    $item = "46";
		    $effect = "500";
				$effect2 = "3";
				$title = sprintf(RIGHTU11SDESC,($effect),($effect2),($effect2));
			}elseif($type==47){
			$name = RIGHTU11S2;
		    $item = "47";
		    $effect = "1000";
				$effect2 = "4";
				$title = sprintf(RIGHTU11SDESC,($effect),($effect2),($effect2));
			}elseif($type==48){
			$name = RIGHTU11S3;
		    $item = "48";
		    $effect = "1500";
				$effect2 = "5";
				$title = sprintf(RIGHTU11SDESC,($effect),($effect2),($effect2));
			}
		if($type==49){
			$name = RIGHTU12S1;
		    $item = "49";
		    $effect = "500";
				$effect2 = "3";
				$title = sprintf(RIGHTU12SDESC,($effect),($effect2),($effect2));
		}elseif($type==50){
			$name = RIGHTU12S2;
		    $item = "50";
		    $effect = "1000";
				$effect2 = "4";
				$title = sprintf(RIGHTU12SDESC,($effect),($effect2),($effect2));
		}elseif($type==51){
			$name = RIGHTU12S3;
		    $item = "51";
		    $effect = "1500";
				$effect2 = "5";
				$title = sprintf(RIGHTU12SDESC,($effect),($effect2),($effect2));
		}
		if($type==52){
			$name = RIGHTU13S1;
		    $item = "52";
		    $effect = "500";
				$effect2 = "3";
				$title = sprintf(RIGHTU13SDESC,($effect),($effect2),($effect2));
			}elseif($type==53){
			$name = RIGHTU13S2;
		    $item = "53";
		    $effect = "1000";
				$effect2 = "4";
				$title = sprintf(RIGHTU13SDESC,($effect),($effect2),($effect2));
			}elseif($type==54){
			$name = RIGHTU13S3;
		    $item = "54";
		    $effect = "1500";
				$effect2 = "5";
				$title = sprintf(RIGHTU13SDESC,($effect),($effect2),($effect2));
			}
		if($type==55){
			$name = RIGHTU15S1;
		    $item = "55";
				$effect2 = "6";
				$title = sprintf(RIGHTU15SDESC,($effect),($effect2),($effect2));
			}elseif($type==56){
			$name = RIGHTU15S2;
		    $item = "56";
				$effect2 = "8";
				$title = sprintf(RIGHTU15SDESC,($effect),($effect2),($effect2));
			}elseif($type==57){
			$name = RIGHTU15S3;
		    $item = "57";
				$effect2 = "10";
				$title = sprintf(RIGHTU15SDESC,($effect),($effect2),($effect2));
			}
		if($type==58){
			$name = RIGHTU16S1;
		    $item = "58";
		    $effect = "500";
				$effect2 = "9";
				$title = sprintf(RIGHTU16SDESC,($effect),($effect2),($effect2));
		}elseif($type==59){
			$name = RIGHTU16S2;
		    $item = "59";
		    $effect = "1000";
				$effect2 = "12";
				$title = sprintf(RIGHTU16SDESC,($effect),($effect2),($effect2));
		}elseif($type==60){
			$name = RIGHTU16S3;
		    $item = "60";
		    $effect = "1500";
				$effect2 = "15";
				$title = sprintf(RIGHTU16SDESC,($effect),($effect2),($effect2));
		}
		
		}elseif($btype==5){
	    
			if($type==94){
			$name = SHOEREG1;
		    $item = "94";
		    $effect = "10";
				$title = sprintf(SHOEREGDESC,($effect*ITEMATTRSPEED));
			}elseif($type==95){
			$name = SHOEREG2;
		    $item = "95";
		    $effect = "15";
				$title = sprintf(SHOEREGDESC,($effect*ITEMATTRSPEED));
			}elseif($type==96){
			$name = SHOEREG3;
		    $item = "96";
		    $effect = "20";
				$title = sprintf(SHOEREGDESC,($effect*ITEMATTRSPEED));
			}
		if($type==97){
			$name = SHOEMER1;
		    $item = "97";
		    $effect = "25";
				$title = sprintf(SHOEMERDESC,($effect*ITEMATTRSPEED));
		}elseif($type==98){
			$name = SHOEMER2;
		    $item = "98";
		    $effect = "30";
				$title = sprintf(SHOEMERDESC,($effect*ITEMATTRSPEED));
		}elseif($type==99){
			$name = SHOEMER3;
		    $item = "99";
		    $effect = "35";
				$title = sprintf(SHOEMERDESC,($effect*ITEMATTRSPEED));
		}
		if($type==100){
			$name = SHOESPU1;
		    $item = "100";
		    $effect = "3";
				$title = sprintf(SHOESPUDESC,($effect*INCREASE_SPEED));
			}elseif($type==101){
			$name = SHOESPU2;
		    $item = "101";
		    $effect = "4";
				$title = sprintf(SHOESPUDESC,($effect*INCREASE_SPEED));
			}elseif($type==102){
			$name = SHOESPU3;
		    $item = "102";
		    $effect = "5";
				$title = sprintf(SHOESPUDESC,($effect*INCREASE_SPEED));
			}
		
		}elseif($btype==6){
	    	if($type==103){
			$name = HORSE1;
		    $item = "103";
		    $effect = "14";
				$title = sprintf(HORSEDESC,($effect*INCREASE_SPEED));
			}elseif($type==104){
			$name = HORSE2;
		    $item = "104";
		    $effect = "17";
				$title = sprintf(HORSEDESC,($effect*INCREASE_SPEED));
			}elseif($type==105){
			$name = HORSE3;
		    $item = "105";
		    $effect = "20";
				$title = sprintf(HORSEDESC,($effect*INCREASE_SPEED));
			}
		
		}elseif($btype==7){
	    	$name = SMALLBAND1;
			$item = "112";
			$title = SMALLBANDDESC;
		}elseif($btype==8){
	    	$name = BAND1;
			$item = "113";
			$title = BANDDESC;
		}elseif($btype==9){
	    	$name = CAGE1;
			$item = "114";
			$title = CAGEDESC;
		}elseif($btype==10){
	    	$name = SCROLLEXP1;
			$item = "107";
			$title = SCROLLEXPDESC;
		}elseif($btype==11){
	    	$name = OINMENT1;
			$item = "106";
			$title = OINMENTDESC;
		}elseif($btype==12){
	    	$name = BUCKET1;
		$item = "108";
			$title = BUCKETDESC;
		}elseif($btype==13){
	    	$name = BOOKWIS1;
			$title = BOOKWISDESC;
		$item = "110";
		}elseif($btype==14){
	    	$name = TABLETLAW1;
			$title = TABLETLAWDESC;
			$item = "109";
		}elseif($btype==15){
	    	$name = ARTWORK1;
		$item = "111";
			$title = ARTWORKDESC;
		}
}
?>
