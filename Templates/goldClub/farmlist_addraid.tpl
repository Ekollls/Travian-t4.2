<?php

if(isset($_POST['action']) == 'addSlot' && $_POST['lid']) {

    if(!isset($_POST['x']) or $_POST['x'] =='' or !isset($_POST['y']) or $_POST['y'] ==''){
    	$errormsg .= ENTERCOORDINATES;
    }elseif(($_POST['x']>WORLD_MAX or $_POST['x']<-WORLD_MAX) or ($_POST['y']>WORLD_MAX or $_POST['y']<-WORLD_MAX) ){
    	$errormsg .= ENTERCORRECTCOORDINATES;
    }else{
		$Wref = $database->getVilWref($_POST['x'], $_POST['y']);
        	$isoasis = $database->isVillageOases($Wref);
		$vdata['owner']=0;
		if(!$isoasis) $vdata = $database->getMInfo($Wref);
		if(!$isoasis && $vdata['owner']==0){
			$errormsg .= NOVILLATCOORDINATES;
		} else {
			$troops = 0;
			for($i=1;$i<=10;$i++){
				if (isset($_POST['t'.$i]) and $_POST['t'.$i]>0){
					$troops = $troops+$_POST['t'.$i];
				}
			}
			if($troops == 0){
				$errormsg .= NOTROOPSSELECTED;
			} else {
    
				$Wref = $database->getVilWref($_POST['x'], $_POST['y']);
				$coor = $database->getCoor($village->wid);
				
				function getDistance($coorx1, $coory1, $coorx2, $coory2) {
					$max = 2 * WORLD_MAX + 1;
					$x1 = intval($coorx1);
					$y1 = intval($coory1);
					$x2 = intval($coorx2);
					$y2 = intval($coory2);
					$distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
					$distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
					$dist = sqrt(pow($distanceX, 2) + pow($distanceY, 2));
					return round($dist, 1);
				}
                $sql2 = mysql_query("SELECT * FROM ".TB_PREFIX."raidlist WHERE lid = ".$_POST['lid']." ORDER BY distance ASC");
                $noofli = mysql_num_rows($sql2);
                
                $flimit = $database->getFieldLevel($village->wid, 39) * 50;
                if($flimit > $noofli) {} else{
                exit();
                }

				$distance = getDistance($coor['x'], $coor['y'], $_POST['y'], $_POST['x']);
					
				$database->addSlotFarm($_POST['lid'], $Wref, $_POST['x'], $_POST['y'], $distance, $_POST['t1'], $_POST['t2'], $_POST['t3'], $_POST['t4'], $_POST['t5'], $_POST['t6'], $_POST['t7'], $_POST['t8'], $_POST['t9'], $_POST['t10']);
				
				header("Location: build.php?id=39&t=99");
				if(!is_null(error_get_last())){
					echo '<script type="text/javascript">location.assign("build.php?id=39&t=99");</script>';
				}
			}
		}
	}
}
?>

<script type="text/javascript">
    var targets = {};

    function fillTargets()
    {
        var targetId = $('target_id');

        targetId.empty();

        var option = new Element('option',
        {
            'html': '<?php echo SELECTVILLAGE;?>'
        });
        targetId.insert(option);

        $each(targets[lid], function(data)
        {
            var option = new Element('option',
            {
                'value': data.did,
                'html': data.name
            });
            targetId.insert(option);
        });
    }

    function getTargetsByLid()
    {
        var lidSelect = $('lid');
        lid = lidSelect.getSelected()[0].value;

        if (targets[lid])
        {
            fillTargets();
        }
        else
        {
            Travian.ajax(
            {
                data:
                {
                    cmd: 'raidListTargets',
                    'lid': lid
                },
                onSuccess: function(data)
                {
                    targets[data.lid] = data.targets;
                    fillTargets();
                }
            });

        }
    }

    function selectCoordinates()
    {
        var targetId = $('target_id');
        var did = targetId.getSelected()[0].value;

        if (did == '')
        {
            $('xCoordInput').value = '';
            $('yCoordInput').value = '';
        }
        else
        {
            var array;
            $each(targets[lid], function(data)
            {
                if (data.did == did)
                {
                    array = data;
                    return;
                }
            });


            $('xCoordInput').value = array.x;
            $('yCoordInput').value = array.y;
        }
    }

    var lid = <?php echo $_GET['lid']; ?>;targets[lid] = {};
function xyxy() {
	var x = j$('#target_id>option:selected').attr('x');
	var y = j$('#target_id>option:selected').attr('y');
	$('xCoordInput').value = x;
	$('yCoordInput').value = y;
}
</script>

<div id="raidListSlot">
    <h4><?php echo ADDSLOT;?></h4>
<font color="#FF0000"><b>    
<?php echo $errormsg; ?>
</b></font>
    
    <form action="build.php?id=39&t=99&action=showSlot&lid=<?php echo $_GET['lid']; ?>" method="post">
        <div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">
        <input type="hidden" name="action" value="addSlot">
        <input type="hidden" name="lid" value="<?php echo $_GET['lid']; ?>">
            <table cellpadding="1" cellspacing="1" class="transparent">
                <tbody><tr>
                    <th><?php echo FARMNAME;?>:</th>
                    <td>
                        <select onchange="getTargetsByLid();" id="lid" name="lid">
<?php

$sql = mysql_query("SELECT * FROM ".TB_PREFIX."farmlist WHERE owner = $session->uid ORDER BY name ASC");
while($row = mysql_fetch_array($sql)){ 
$lid = $row["id"];
$lname = $row["name"];
$lowner = $row["owner"];
$lwref = $row["wref"];
$lvname = $database->getVillageField($row["wref"], 'name');
    if($_GET['lid']==$lid){
        $selected = 'selected=""';
        }else{ $selected = ''; }
    echo '<option value="'.$lid.'" '.$selected.'>'.$lvname.' - '.$lname.'</option>';
}
?>    
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php echo SELECTTARGET;?>:</th>
                    <td class="target">
                        
            <div class="coordinatesInput">
                <div class="xCoord">
                    <label for="xCoordInput">X:</label>
                    <input value="<?php echo $_POST['x']; ?>" name="x" id="xCoordInput" class="text coordinates x ">
                </div>
                <div class="yCoord">
                    <label for="yCoordInput">Y:</label>
                    <input value="<?php echo $_POST['y']; ?>" name="y" id="yCoordInput" class="text coordinates y ">
                </div>
                <div class="clear"></div>
            </div>
                                <div class="targetSelect">
                            <label class="lastTargets" for="last_targets"><?php echo LASTTARGETS;?>:</label>
                            <select onchange="xyxy()" id="target_id" name="target_id">
                                <option x="" y="">یک دهکده را انتخاب کنید</option>
                                <?php
                                //$result = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE name = 'Farm'");
                                $result = mysql_query("SELECT * FROM ".TB_PREFIX."vdata");
                                if(mysql_num_rows($result) > 0) {
                                    while($row = mysql_fetch_array($result)) {
                                        $vref = $row['wref'];
                                        $result2 = mysql_query("SELECT * FROM ".TB_PREFIX."wdata WHERE id = '".$vref."'");
                                        $row2 = mysql_fetch_array($result2);
                                        $x = $row2['x'];
                                        $y = $row2['y'];
                                        $vname = $row['name'];
                                        if($vname == "Farm") {
                                        	echo '<option x="'.$x.'" y="'.$y.'">فارم ('.$x.','.$y.')</option>';
                                        }else{
                                        	echo '<option x="'.$x.'" y="'.$y.'">'.$vname.'</option>';
                                        }
                                    }
                                }else{
                                    echo '<option x="" y="">فارمی وجود ندارد!</option>';
                                }
                                ?>                        
                            </select>
                        </div>
                        <div class="clear"></div>
                    </td>
                </tr>
            </tbody></table>
            </div>
                </div>
        <?php include "Templates/goldClub/trooplist2.tpl"; ?>

        
<button type="submit" value="save" name="save" id="save"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo SAVE;?></div></div></button>
        
</form>
</div>
