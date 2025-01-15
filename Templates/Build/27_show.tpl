<?php

    $artefact = $database->getArtefactDetails($_GET['show']);
                    if($artefact['size'] == 1){
                       $reqlvl = 10;
                       $aoe = ARTEAREAVILLAGE;
                   }elseif($artefact['size'] == 2 OR $artefact['size'] == 3){
                       $reqlvl = 20;
                       $aoe = ARTEAREAACCOUNT;
                   }  
                   if (($artefact['conquered'] <= (time()-max(86400/SPEED,600))) && ($artefact['status']==1)){
                   	$active = ACTIVE; 
                   }else{
                    	$active = INACTIVE; 
			if($artefact['status']==1) $active .= ' '.WILLACTIN.' '.$generator->getTimeFormat(max(86400/SPEED,600)-(time()-$artefact['conquered'])).' '.HRS;
                   }
					if(defined( preg_replace("/ /i","",$artefact['name']) )) { $artefact['name'] = constant(preg_replace("/ /i","",$artefact['name'])); } else{ $artefact['name'] = $artefact['name']; }
?>
        
       <div class="artefact.image-6">
        <h4 class="round"><?php echo $artefact['name'];?> <b><?php echo $artefact['effect']; ?></b></h4>
            <table id="art_details" cellpadding="1" cellspacing="1">
                <tbody>
                    <tr>
                        <td colspan="2" class="desc">
                            <span class="detail">
				<center>
                            <?php 
				if(defined($artefact['desc'])) $artefact['desc'] = constant($artefact['desc']);
				echo $artefact['desc']; 
			    ?>
				</center>
			    </span>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo OWNER;?></th>
                        <td>
                            <a href="spieler.php?uid=<?php echo $artefact['owner'];?>"><?php echo $database->getUserField($artefact['owner'],"username",0);?></a>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo VILLAGE;?></th>
                        <td>
                            <a href="karte.php?d=<?php echo $artefact['vref'];?>&c=<?php echo $generator->getMapCheck($artefact['vref']);?>">
<?php
$avname = $database->getVillageField($artefact['vref'], "name");
if(defined($avname)) $avname = constant($avname);
echo $avname;
?> </a>
                        </td>
                    </tr>                                  
                    <tr>
                        <th><?php echo SIDEINFO_ALLIANCE;?></th>
                        <td><a href="allianz.php?aid=<?php echo $database->getUserField($artefact['owner'],"alliance",0);?>"><?php echo $database->getAllianceName($database->getUserField($artefact['owner'],"alliance",0)); ?></a></td>
                    </tr> 
                    <tr>
                        <th><?php echo ARTE_AOE;?></th>
                        <td><?php echo $aoe; ?></td>
                    </tr>
         		<tr>
                        <th><?php echo EFFECT;?></th>
                        <td><?php 
							$str = 'ART_ETN_'.$artefact['effecttype'];
							if (defined($str)){echo constant($str);} else {echo '-';}
						?></td>
                    </tr>
        
                <tr>
                    <th><?php echo OF;?></th>
                    <td><b><?php echo $artefact['effect']; ?></b></td>
                </tr>
               
            <tr>
                <th><?php echo B27;?></th>
                <td>A <?php echo B27.' '.LVL.' ';?> <b><?php echo $reqlvl; ?></b></td>
            </tr>
        
                <tr>
                    <th><?php echo DATE;?></th>
                    <td><?php echo date("Y.m.d. H:i",$artefact['conquered']);?></td>
                </tr>
            
                <tr>
                    <th><?php echo ACTIVITY;?></th>
                    <td><?php echo $active;?></td>
                </tr>
            </tbody></table><br />
            <h4><?php echo CAPTUREHISTORY;?></h4>
                <table class="art_details" cellpadding="1" cellspacing="1">
                    <thead>
                        <tr>
                            <td><?php echo PLAYER;?></td>
                            <td><?php echo VILLAGE;?></td>
                            <td><?php echo CAPTUREHISTORY;?></td>
                        </tr>
                    </thead>
                    <tbody>
            
                    <tr>
                        <td><span class="none"><?php echo NOUSER;?></span></td>
                        <td><span class="none">[?]</span></td>
                        <td><span class="none"><?php echo YETTOBECONQUERED;?></span></td> 
                        
                    </tr>
                   
                    </tr></tbody></table></div>
