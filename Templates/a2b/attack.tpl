<?php
$rallypoint = $building->getTypeLevel(16);
// Temp
$eigen = $database->getCoor($village->wid);
$coor = array('x'=>intval($_POST['x']), 'y'=>intval($_POST['y']));
$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
$to = array('x'=>$coor['x'], 'y'=>$coor['y']);

// Temp
$ckey= $generator->generateRandStr(6);

if (!isset($process['t1']) || $process['t1'] == ''){  $t1='0'; }else{  $t1=$process['t1']; }
if (!isset($process['t2']) || $process['t2'] == ''){  $t2='0'; }else{  $t2=$process['t2']; } 
if (!isset($process['t3']) || $process['t3'] == ''){  $t3='0'; }else{  $t3=$process['t3']; if ($session->tribe == 3){ $scout=1; } } 
if (!isset($process['t4']) || $process['t4'] == ''){  $t4='0'; }else{  $t4=$process['t4']; if ($session->tribe == 1 || $session->tribe == 2 || $session->tribe == 4 || $session->tribe == 5){ $scout=1;} } 
if (!isset($process['t5']) || $process['t5'] == ''){  $t5='0'; }else{  $t5=$process['t5']; } 
if (!isset($process['t6']) || $process['t6'] == ''){  $t6='0'; }else{  $t6=$process['t6']; } 
if (!isset($process['t7']) || $process['t7'] == ''){  $t7='0'; }else{  $t7=$process['t7']; } 
if (!isset($process['t8']) || $process['t8'] == ''){  $t8='0'; }else{  $t8=$process['t8']; } 
if (!isset($process['t9']) || $process['t9'] == ''){  $t9='0'; }else{  $t9=$process['t9']; } 
if (!isset($process['t10']) || $process['t10'] == ''){  $t10='0'; }else{  $t10=$process['t10']; } 
if (!isset($process['t11']) || $process['t11'] == ''){  $t11='0'; }else{  $t11=$process['t11']; $showhero=1;} 
if ($session->tribe == 3){
	$nonscoutunits = $process['t1']+$process['t2']+$process['t4']+$process['t5']+$process['t6']
			+$process['t7']+$process['t8']+$process['t9']+$process['t10']+$process['t11'];
}else{
	$nonscoutunits=$process['t1']+$process['t2']+$process['t3']+$process['t5']+$process['t6']
			+$process['t7']+$process['t8']+$process['t9']+$process['t10']+$process['t11'];
}

if (isset($scout) && $scout==1 && $nonscoutunits==0) {
	$process['c'] = 1;
}

$id = $database->addA2b($ckey,time(),$process['0'],$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11,$process['c']);

if ($process['c']==1){$actionType = ACTIONTYPESCOUT;}
elseif ($process['c']==2){$actionType = ACTIONTYPEREINF;}
elseif ($process['c']==3){$actionType = ACTIONTYPENATT;}
else{$actionType = ACTIONTYPERAID;}

$uid = $session->uid;
$tribe = $session->tribe;
$start = ($tribe-1)*10+1;
$end = ($tribe*10);
?>
<h1><?php echo $actionType." ".$process[1]; ?></h1>            
<form method="post" action="a2b.php">
	<table id="short_info" cellpadding="1" cellspacing="1">
		<tbody>
			<tr>
				<th><?php echo LOCATION;?></th>
				<td><a href="position_details.php?x=<?php echo $coor['x']; ?>&y=<?php echo $coor['y']; ?>">
<?php
if(defined($process[1])) $process[1]=constant($process[1]);
echo $process[1]; 
?> (<?php echo (DIRECTION=='ltr'?$coor['x'].'|'.$coor['y']:$coor['y'].'|'.$coor['x']); ?>)</a></td>
			</tr>
			<tr>
				<th><?php echo PLAYER;?></th>
				<td>
					<?php if($process['2'] == 3){ ?>
						<font class="none"><b><?php echo TRIBE4;?></b></font>
					<?php } else { ?>
						<a href="spieler.php?uid=<?php echo $process['2']; ?>">
						<?php if($process['2'] == 2){
							echo "Natar";
						} else {
							echo $database->getUserField($process['2'],'username',0);
						} ?>
						</a>
					<?php } ?>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="troop_details" cellpadding="1" cellspacing="1">
		<thead>
			<tr>
				<td><?php echo $village->vname; ?></td>
				<td colspan="<?php if($process['t11'] != ''){ echo"11"; }else{ echo"10"; } ?>">
					<?php echo $actionType." ".$process['1']; ?> (<?php echo (DIRECTION=='ltr'?$coor['x'].'|'.$coor['y']:$coor['y'].'|'.$coor['x']); ?>)
				</td>
			</tr>
		</thead>
		<tbody class="units">
			<tr>
				<td></td>
				<?php 
				for($i=$start;$i<=($end);$i++) {
					echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";    
				}
				if (!isset($process['t11']) || $process['t11'] == '' || $process['t11'] == 0 || $process['t11'] == '0'){
				} else {
					echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";    
				}?>
			</tr>
			<tr>
				<th><?php echo UNITS;?></th>
				<td <?php if (!isset($process['t1']) || $process['t1'] == '' || $process['t1'] == 0 || $process['t1'] == '0'){ echo "class=\"none\">0"; }else{ echo ">".$process['t1'];} ?></td>
				<td <?php if (!isset($process['t2']) || $process['t2'] == '' || $process['t2'] == 0 || $process['t2'] == '0'){ echo "class=\"none\">0"; }else{ echo ">".$process['t2'];} ?></td>
				<td <?php if (!isset($process['t3']) || $process['t3'] == '' || $process['t3'] == 0 || $process['t3'] == '0'){ echo "class=\"none\">0"; }else{ echo ">".$process['t3'];} ?></td>
				<td <?php if (!isset($process['t4']) || $process['t4'] == '' || $process['t4'] == 0 || $process['t4'] == '0'){ echo "class=\"none\">0"; }else{ echo ">".$process['t4'];} ?></td>
				<td <?php if (!isset($process['t5']) || $process['t5'] == '' || $process['t5'] == 0 || $process['t5'] == '0'){ echo "class=\"none\">0"; }else{ echo ">".$process['t5'];} ?></td>
				<td <?php if (!isset($process['t6']) || $process['t6'] == '' || $process['t6'] == 0 || $process['t6'] == '0'){ echo "class=\"none\">0"; }else{ echo ">".$process['t6'];} ?></td>
				<td <?php if (!isset($process['t7']) || $process['t7'] == '' || $process['t7'] == 0 || $process['t7'] == '0'){ echo "class=\"none\">0"; }else{ echo ">".$process['t7'];} ?></td>
				<td <?php if (!isset($process['t8']) || $process['t8'] == '' || $process['t8'] == 0 || $process['t8'] == '0'){ echo "class=\"none\">0"; $kata='0';}else{ $kata='1'; echo ">".$process['t8'];} ?></td>
				<td <?php if (!isset($process['t9']) || $process['t9'] == '' || $process['t9'] == 0 || $process['t9'] == '0'){ echo "class=\"none\">0"; }else{ echo ">".$process['t9'];} ?></td>
				<td <?php if (!isset($process['t10']) || $process['t10'] == '' || $process['t10'] == 0 || $process['t10'] == '0'){ echo "class=\"none\">0"; }else{ echo ">".$process['t10'];} ?></td>
				<?php if (!isset($process['t11']) || $process['t11'] == '' || $process['t11'] == 0 || $process['t11'] == '0'){}else{ echo "<td>".$process['t11'].'</td>';} ?>
			</tr>
		</tbody>
		<?php if ($process['c']==1){ ?>
			<tbody class="options">
                <tr>
					<th><?php echo OPTIONS;?></th>
					<td colspan="11">
						<input class="radio" name="spy" value="1" checked="checked" type="radio">
							<?php echo SPYTYPE1;?><br>
						<input class="radio" name="spy" value="2" type="radio">
							<?php echo SPYTYPE2;?>
					</td>
				</tr>
			</tbody>
		<?php }
		if(isset($kata) && $kata=='1' && $process['c']!='2'){?><tr>
            <?php if($process['c']=='3'){ ?>
				<tbody class="cata">
					<tr>
						<th><?php echo CATAPULTS;?></th>
						<td colspan="10">
							<select name="ctar1" class="dropdown">
								<option value="0"><?php echo RANDOM;?></option>
								<?php if($session->tribe!=2 || $database->getCapBrewery($session->uid) == 0) { ?>
									<?php if($rallypoint >= 5) { ?>
									<optgroup label="<?php echo RESOURCES;?>">
										<option value="1"><?php echo B1;?></option>
										<option value="2"><?php echo B2;?></option>
										<option value="3"><?php echo B3;?></option>
										<option value="4"><?php echo B4;?></option>
										<option value="5"><?php echo B5;?></option>
										<option value="6"><?php echo B6;?></option>
										<option value="7"><?php echo B7;?></option>
										<option value="8"><?php echo B8;?></option>
										<option value="9"><?php echo B9;?></option>
									</optgroup>
									<?php } ?>
									<?php if($rallypoint >= 3) { ?>
									<optgroup label="<?php echo INFRASTRUCTURE;?>">
										<option value="10"><?php echo B10;?></option>
										<option value="11"><?php echo B11;?></option>
										<?php if($rallypoint >= 10) { ?>
										<option value="15"><?php echo B15;?></option>
										<option value="17"><?php echo B17;?></option>
										<option value="18"><?php echo B18;?></option>
										<option value="24"><?php echo B24;?></option>
										<option value="25"><?php echo B25;?></option>
										<option value="26"><?php echo B26;?></option>
										<option value="27"><?php echo B27;?></option>
										<option value="28"><?php echo B28;?></option>
										<option value="40"><?php echo B40;?></option>
										<?php } ?>
										<option value="38"><?php echo B38;?></option>
										<option value="39"><?php echo B39;?></option>
									</optgroup>
									<?php } ?>
									<?php if($rallypoint >= 10) { ?>
									<optgroup label="<?php echo MILITARY;?>">
										<option value="12"><?php echo B12;?></option>
										<option value="14"><?php echo B14;?></option>
										<option value="16"><?php echo B16;?></option>
										<option value="19"><?php echo B19;?></option>
										<option value="20"><?php echo B20;?></option>
										<option value="21"><?php echo B21;?></option>
										<option value="22"><?php echo B22;?></option>
										<option value="29"><?php echo B29;?></option>
										<option value="30"><?php echo B30;?></option>
										<option value="37"><?php echo B37;?></option>
									</optgroup>
									<?php } ?>
								<?php } ?>
							</select>
							<?php if($rallypoint == 20) { ?>
							<select name="ctar2" class="dropdown">
								<option value="255">-</option>
								<option value="0">Random</option>
								<?php if($session->tribe!=2 || $database->getCapBrewery($session->uid) == 0) { ?>
									<?php if($rallypoint >= 5) { ?>
									<optgroup label="<?php echo RESOURCES;?>">
										<option value="1"><?php echo B1;?></option>
										<option value="2"><?php echo B2;?></option>
										<option value="3"><?php echo B3;?></option>
										<option value="4"><?php echo B4;?></option>
										<option value="5"><?php echo B5;?></option>
										<option value="6"><?php echo B6;?></option>
										<option value="7"><?php echo B7;?></option>
										<option value="8"><?php echo B8;?></option>
										<option value="9"><?php echo B9;?></option>
									</optgroup>
									<?php } ?>
									<?php if($rallypoint >= 3) { ?>
									<optgroup label="<?php echo INFRASTRUCTURE;?>">
										<option value="10"><?php echo B10;?></option>
										<option value="11"><?php echo B11;?></option>
										<?php if($rallypoint >= 10) { ?>
										<option value="15"><?php echo B15;?></option>
										<option value="17"><?php echo B17;?></option>
										<option value="18"><?php echo B18;?></option>
										<option value="24"><?php echo B24;?></option>
										<option value="25"><?php echo B25;?></option>
										<option value="26"><?php echo B26;?></option>
										<option value="27"><?php echo B27;?></option>
										<option value="28"><?php echo B28;?></option>
										<option value="40"><?php echo B40;?></option>
										<?php } ?>
										<option value="38"><?php echo B38;?></option>
										<option value="39"><?php echo B39;?></option>
									</optgroup>
									<?php } ?>
									<?php if($rallypoint >= 10) { ?>
									<optgroup label="<?php echo MILITARY;?>">
										<option value="12"><?php echo B12;?></option>
										<option value="14"><?php echo B14;?></option>
										<option value="16"><?php echo B16;?></option>
										<option value="19"><?php echo B19;?></option>
										<option value="20"><?php echo B20;?></option>
										<option value="21"><?php echo B21;?></option>
										<option value="22"><?php echo B22;?></option>
										<option value="29"><?php echo B29;?></option>
										<option value="30"><?php echo B30;?></option>
										<option value="37"><?php echo B37;?></option>
									</optgroup>
									<?php } ?>
								<?php } ?>
							</select>
							<?php }?>
							<span class="info"><?php echo WBABYCATA;?></span>
						</td>
					</tr>
				</tbody>
			<?php  
			} elseif(isset($kata) && $kata=='1' &&$process['c']=='4'){?>
				<tbody class="infos">  
                <th>Destination:</th>
				<td colspan="10">
					<?php
						echo NORMALATTTOCATA;
					?>
                </td>
			</tr>
			<?php
            }
            ?>
        <?php 
		} 
		?>
		<tbody class="infos">
			<tr>
				<th><?php echo ARRIVAL;?></th>
				<?php
				$speeds = array();
				$scout = 1;
				//find slowest unit.
				for($i=1;$i<=11;$i++){
					if (isset($process['t'.$i])){
						if( $process['t'.$i] != '' && $process['t'.$i] > 0){
							if ($i<11) {
								$speeds[] = ${'u'.(($session->tribe-1)*10+$i)}['speed'];
							}else{
								$herodetail = $database->getHero($session->uid);
								$speeds[] = $herodetail['speed'];
							}
							if($i != 4){
								$scout = 0;
							}
						}
					}
				}
				if($scout){
					$process['c'] = 1;
				}
				$time = $generator->procDistanceTime($from,$to,min($speeds),1,(isset($herodetail)?$herodetail:array()));
				?>
				<td colspan="<?php if($process['t11'] != ''){ echo "11"; }else{ echo"10"; } ?>">
					<div class="in"><?php echo sprintf(ARRIVALINHRS,$generator->getTimeFormat($time)); ?></div>
					<div class="at"><?php echo REPORT_AT.' ';?><span id="tp2"> <?php echo date("H:i:s",time()+$time);?></span></div>
				</td>
			</tr>
		</tbody>
	</table>
	<input name="timestamp" value="<?php echo time(); ?>" type="hidden"> 
	<input name="timestamp_checksum" value="<?php echo $ckey; ?>" type="hidden"> 
	<input name="ckey" value="<?php echo $id; ?>" type="hidden"> 
	<input name="id" value="39" type="hidden"> 
	<input name="a" value="533374" type="hidden">
	<input name="c" value="3" type="hidden">
	<?php
	$attacker = $database->getUserField($session->uid,'alliance',0);
	$defender = $database->getUserField($process['2'],'alliance',0);
	if($attacker!=0 && $attacker==$defender){
		echo "<div class=\"alert\">Warning! Are you sure you want to attack this player</div>";
	}
	if($database->hasBeginnerProtection($process['0'])==1) {  
		echo"<div class=\"alert\"><b>Cannot attack, in begginers protection.</b></div>"; 
	} else { ?> 
		<button type="submit" value="ok" name="s1" id="btn_ok" class="green ">
        	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">		<?php echo CONFIRM;?></div></div></button>
	<?php 
	}
	?>
</form>
