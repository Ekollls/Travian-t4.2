<div id="villageList" class="listing">
	<div class="head">
		<a href="dorf3.php" accesskey="9" title="Village Overview"><?php echo MULTI_V_HEADER; ?>:</a> 
	</div> 
	<div class="list"> 
		<ul>        
			<?php 
				for($i=1;$i<=count($session->villages);$i++) { 
					$village_title = '';$village_attack = '';
					$vm['v31'] = array(); $vm['o31'] = array();
					if($session->plus){
						$vm['v31'] = $database->getMovement(3,$session->villages[$i-1],1);

						$list['extra'] = 'distance<4.9497474683058326708059105347339';
						$order['by'] = 'distance';
						$coor = $database->getCoor($session->villages[$i-1]);
						$order['x'] = $coor['x'];
						$order['y'] = $coor['y'];
						$order['max'] = 2 * WORLD_MAX + 1;
						$oasats = $database->getVillageOasis($list,30,$order);
						foreach($oasats as $os){
							if ($os['owner']==$session->uid){
								$vm['o31'] = $database->getMovement(3,$os['wref'],1);
							}
						}
						$attack_coming = array_merge($vm['v31'],$vm['o31']);//$database->getMovement2(3,$session->villages[$i-1],1);
						$aantal = count($attack_coming);
						foreach($attack_coming as $attcom){
							if($attcom['attack_type'] == 2) $aantal -= 1;
						}
						if($aantal > 0){
							$village_attack = ATTACK.' ';
							$village_title = UNDERATTACK.": ".$aantal;
						} else {
							$village_attack = "";
							$village_title = '';//htmlspecialchars($returnVillageArray[$i-1]['name']);
						}
					}
					if($session->villages[$i-1] == $village->wid){
						$select = "active";
						$sid = "currentVillage";
					} else {
						$select = "";
						$sid = "";
					}
					$coorproc = $database->getCoor($session->villages[$i-1]);
					if(isset($_GET['id'])){
						$vill = "&id=".$_GET['id'];
					}elseif(isset($_GET['gid'])){
						$vill = "&gid=".$_GET['gid'];
					}elseif(isset($_GET['id'])==39 && $_GET['t']){
						$vill = "&id=39&t=".$_GET['t'];
					}else{
						$vill = "";
					}
					$vname = $database->getVillageField($session->villages[$i-1],'name');
					if(defined($vname)){$vname = constant($vname);}
					if(DIRECTION=='ltr'){ $title = 'title="'.$vname.' ('.$coorproc['x'].'|'.$coorproc['y'].')"';}
					elseif(DIRECTION=='rtl'){ $title = 'title="'.$vname.' ('.$coorproc['y'].'|'.$coorproc['x'].')"';}
					echo "<li class=\"entry ".$village_attack."".$select."\" title=\"".$village_title."\">
					<a id=\"".$sid."\" ".$title."\" href=\"?newdid=".$session->villages[$i-1]."".$vill."\" class=\"".$select."\">".$vname."</a></li>";
				}
			?>	
		</ul>
	</div>
	<div class="foot"></div>
</div>
<?php include("Templates/links.tpl"); ?>
