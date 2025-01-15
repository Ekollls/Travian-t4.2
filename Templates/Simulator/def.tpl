<div id="defender">
	<?php
	$tribe = isset($_POST['defendertribe'])? $_POST['defendertribe'] : 0;
	if($tribe > 0) {
		$start = ($tribe-1)*10 +1;
		$end = $tribe*10;?>
		<div class="fighterType">
			<div class="boxes boxesColor green">
				<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
				<div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
				<div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
				<div class="boxes-contents"><?php echo REPORT_DEFENDER; ?></div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="border">
			<table class="fill_in transparent" cellpadding="1" cellspacing="0">
				<tbody>
					<tr>
						<th><?php echo constant('TRIBE'.$tribe); ?></th>
					</tr>
					<tr>
						<td class="details">
							<table cellpadding="1" cellspacing="1">
								<tbody>
									<?php
									for($i=$start;$i<=$end;$i++){
									echo '<tr>'
										.'<td class="ico"><img src="img/x.gif" class="unit u'.$i.'" alt="'.constant('U'.$i).'" title="'.constant('U'.$i).'"></td>'
										.'<td class="desc">'.$technology->unarray[$i].'</td>'
										.'<td class="value"><input class="text" type="text" name="du_'.$i.'" value="'.$form->getValue('du_'.$i).'" maxlength="6"></td>'
										.'<td class="research"><input class="text" type="text" name="da_'.($i-$start+1).'" value="'.$form->getValue('da_'.($i-$start+1)).'" maxlength="2"></td>'
										.'</tr>';
									}
									?>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="fill_in transparent" cellpadding="1" cellspacing="0">
				<tbody>
					<tr>
						<th><?php echo U0; ?></th>
					</tr>
					<tr>
						<td class="details">
							<table cellpadding="1" cellspacing="1">
								<tbody>
									<tr>
										<td class="ico"><img src="img/x.gif" class="unit uhero" title="<?php echo FS; ?>"></td>
										<td class="desc"><?php echo FS; ?></td>
										<td class="value"><input class="text" type="text" name="d_h_fs" value="<?php echo $form->getValue('d_h_fs')==""? 0 : $form->getValue('d_h_fs'); ?>" maxlength="6"></td>
										<td class="research"></td>
									</tr>
									<tr>
										<td class="ico"><img src="img/x.gif" class="unit uhero" title="<?php echo DB.' '.POINT; ?>"></td>
										<td class="desc"><?php echo DB.' '.POINT; ?></td>
										<td class="value"><input class="text" type="text" name="d_h_db" value="<?php echo $form->getValue('d_h_db')==""? 0 : $form->getValue('d_h_db'); ?>" maxlength="6"></td>
										<td class="research"></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="border">
			<table class="fill_in transparent" cellpadding="1" cellspacing="0">
				<tbody>
					<tr>
						<th><?php echo WARSIM_ETC; ?></th>
					</tr>
					<tr>
						<td class="details">
							<table cellpadding="1" cellspacing="1">
								<tbody>
									<tr>
										<td class="ico"><img src="img/x.gif" class="unit uhab" alt="<?php echo INHABITANTS; ?>" title="<?php echo INHABITANTS; ?>"></td>
										<td class="desc"><?php echo INHABITANTS; ?></td>
										<td class="value">
											<?php if ($tribe != 4) {?>
											<input class="text" type="text" name="ew2" value="<?php echo $form->getValue('ew2')==""?1:$form->getValue('ew2');?>" maxlength="5">
											<?php
											} else { echo '100';}
											?>
										</td>
										<td class="research"></td>
									</tr>
									<tr>
										<td class="ico"><img src="img/x.gif" class="gebIcon g34Icon" alt="<?php echo B34; ?>" title="<?php echo B34; ?>"></td>
										<td class="desc"><?php echo B34; ?></td>
										<td class="value">
											<?php if ($tribe != 4) {?>
											<input class="text" type="text" name="stonemason" value="<?php echo $form->getValue('stonemason')==""?0:$form->getValue('stonemason'); ?>" maxlength="2">
											<?php
											} else { echo '0';}
											?>
										</td>
										<td class="research"></td>
									</tr>
									<?php
									switch ($tribe){
										case 1: $title = B31;$class = "g31Icon"; break;
										case 2: case 4: case 5: $title = B32;$class = "g32Icon"; break;
										case 3: $title = B33;$class = "g33Icon"; break;
									}
									echo '<tr><td class="ico"><img src="img/x.gif" class="gebIcon '.$class.'" title="'.$title.'" /></td>'
										.'<td class="desc">'.$title.'</td>'
										.'<td class="value">';
									if ($tribe != 4){
										echo '<input class="text" type="text" name="wall" value="'.($form->getValue('wall')==""?0:$form->getValue('wall'))
										.'" maxlength="2" title="'.$title.'" />';
									} else { echo '0';}
									echo '</td><td class="research"></td></tr>';
									?>
									<tr>
										<td class="ico"><img src="img/x.gif" class="gebIcon g26Icon" title="<?php echo B25.'/'.B26; ?>"></td>
										<td class="desc"><?php echo B25.'/'.B26; ?></td>
										<td class="value">
											<?php if ($tribe != 4) {?>
											<input class="text" type="text" name="palast" value="<?php echo $form->getValue('palast')==""?0:$form->getValue('palast');?>" maxlength="2">
											<?php
											} else { echo '0';}
											?>
										</td>
										<td class="research"></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	<?php
	}
	$enforcestribes = isset($_POST['enforcestribes'])?$_POST['enforcestribes']:array();
	if(count($enforcestribes) > 0) {?>
		<div class="fighterType">
			<div class="boxes boxesColor green">
				<div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
				<div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
				<div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
				<div class="boxes-contents"><?php echo REPORT_REINF; ?></div>
			</div>
		</div>
		<div class="clear"></div>
		<?php
		foreach($enforcestribes as $tribe) {
			$start = ($tribe-1)*10 +1;
			$end = $tribe*10;
			?>
			<div class="border">
				<table class="fill_in transparent" cellpadding="1" cellspacing="0">
					<tbody>
						<tr>
							<th><?php echo constant('TRIBE'.$tribe); ?></th>
						</tr>
						<tr>
							<td class="details">
								<table cellpadding="1" cellspacing="1">
									<tbody>
										<?php
										for($i=$start;$i<=$end;$i++){
										echo '<tr>'
											.'<td class="ico"><img src="img/x.gif" class="unit u'.$i.'" alt="'.constant('U'.$i).'" title="'.constant('U'.$i).'"></td>'
											.'<td class="desc">'.$technology->unarray[$i].'</td>'
											.'<td class="value"><input class="text" type="text" name="eu_'.$i.'" value="'.$form->getValue('eu_'.$i).'" maxlength="6"></td>'
											.'<td class="research"><input class="text" type="text" name="ea_'.($i-$start+1).'" value="'.$form->getValue('ea_'.($i-$start+1)).'" maxlength="2"></td>'
											.'</tr>';
										}
										?>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="fill_in transparent" cellpadding="1" cellspacing="0">
				<tbody>
					<tr>
						<th><?php echo U0; ?></th>
					</tr>
					<tr>
						<td class="details">
							<table cellpadding="1" cellspacing="1">
								<tbody>
									<tr>
										<td class="ico"><img src="img/x.gif" class="unit uhero" title="<?php echo FS; ?>"></td>
										<td class="desc"><?php echo FS; ?></td>
										<td class="value"><input class="text" type="text" name="e_h_fs<?php echo $tribe?>" value="<?php echo $form->getValue('e_h_fs'.$tribe)==""? 0 : $form->getValue('e_h_fs'.$tribe); ?>" maxlength="6"></td>
										<td class="research"></td>
									</tr>
									<tr>
										<td class="ico"><img src="img/x.gif" class="unit uhero" title="<?php echo DB.' '.POINT; ?>"></td>
										<td class="desc"><?php echo DB.' '.POINT; ?></td>
										<td class="value"><input class="text" type="text" name="e_h_db<?php echo $tribe?>" value="<?php echo $form->getValue('e_h_db'.$tribe)==""? 0 : $form->getValue('e_h_db'.$tribe); ?>" maxlength="6"></td>
										<td class="research"></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			</div>
		<?php
		}
	}
	?>
</div>
<div class=\"clear\"></div>