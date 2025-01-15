<div id="messageNavigation">
	<div id="backToInbox">
		<a href="nachrichten.php"><?php echo RETURNTOINBOX;?></a>
	</div>
	<div class="clear"></div>
</div>
<div id="write_head" class="msg_head"></div>
<div id="write_content" class="msg_content">
	<form method="post" action="nachrichten.php" accept-charset="UTF-8" name="msg">
	<input type="hidden" name="c" value="3e9" />
	<input type="hidden" name="p" value="" />
<div class="paper">
		<div class="layout">
			<div class="paperTop">
				<div class="paperContent">
					<div id="recipient">
						<div class="header label"><?php echo RECIPIENT;?></div>
						<div class="header text">
							<input tabindex="1" class="text" type="text" name="an" id="receiver" value="<?php if(isset($id)) { echo $database->getUserField($id,'username',0); } ?>" maxlength="50" onkeyup="copyElement('receiver')" >
							<button title="<?php echo ADDRESSBOOK;?>" type="button" value="adbook" id="adbook" class="icon" onclick="Travian.Game.Messages.Write.showAddressBook('adressbook');" tabindex="5"><img src="img/x.gif" class="adbook" alt="<?php echo ADDRESSBOOK;?>"></button><button title="<?php echo SIDEINFO_ALLIANCE;?>" type="button" value="ally" id="ally" class="icon" tabindex="6" onclick="this.form.receiver.value='[ally]';"><img src="img/x.gif" class="ally" alt="<?php echo SIDEINFO_ALLIANCE;?>"></button>
						</div>
				<div class="clear"></div>
			</div>
			<div id="subject">
				<div class="header label"><?php echo SUBJECT;?>:</div>
				<div class="header text"><input tabindex="2" class="text" name="be" id="subject" type="text" value="<?php if(isset($message->reply['topic'])) 
{ 
   if (preg_match("/RE([0-9]+)/i",$message->reply['topic'],$c)) 
   { 
       $c = $c[1]+1; 
       echo $message->reply['topic'] = preg_replace("/RE[0-9]+/i","RE".($c),$message->reply['topic']); 
}else{ 
echo "RE1:".$message->reply['topic']; }} ?>" name="be" onkeyup="copyElement('subject')"></div>
				<div class="clear"></div>
			</div>

					<div id="bbEditor">
			
			<div id="message_container" class="bbEditor">
<div class="boxes boxesColor gray">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf">
				<div id="message_toolbar" class="bbToolbar"><button type="button" class="icon bbButton bbBold bbType{d} bbTag{b}"><img src="img/x.gif" class="bbBold" alt="bbBold"></button><button type="button" class="icon bbButton bbItalic bbType{d} bbTag{i}"><img src="img/x.gif" class="bbItalic" alt="bbItalic"></button><button type="button" class="icon bbButton bbUnderscore bbType{d} bbTag{u}"><img src="img/x.gif" class="bbUnderscore" alt="bbUnderscore"></button><button type="button" class="icon bbButton bbAlliance bbType{d} bbTag{alliance}"><img src="img/x.gif" class="bbAlliance" alt="bbAlliance"></button><button type="button" class="icon bbButton bbPlayer bbType{d} bbTag{player}"><img src="img/x.gif" class="bbPlayer" alt="bbPlayer"></button><button type="button" class="icon bbButton bbCoordinate bbType{d} bbTag{x|y}"><img src="img/x.gif" class="bbCoordinate" alt="bbCoordinate"></button><button type="button" class="icon bbButton bbReport bbType{d} bbTag{report}"><img src="img/x.gif" class="bbReport" alt="bbReport"></button><button type="button" id="message_resourceButton" class="icon bbWin{resources} bbButton bbResource"><img src="img/x.gif" class="bbResource" alt="bbResource"></button><button type="button" id="message_smilieButton" class="icon bbWin{smilies} bbButton bbSmilies"><img src="img/x.gif" class="bbSmilies" alt="bbSmilies"></button><button type="button" id="message_troopButton" class="icon bbWin{troops} bbButton bbTroops"><img src="img/x.gif" class="bbTroops" alt="bbTroops"></button><button type="button" id="message_previewButton" class="icon bbButton bbPreview"><img src="img/x.gif" class="bbPreview" alt="bbPreview"></button><div class="clear"></div>
					<div id="message_toolbarWindows" class="bbToolbarWindow">
						<div id="message_resources"><a href="#" class="bbType{o} bbTag{l}"><img src="img/x.gif" class="r1" alt="Lumber"></a><a href="#" class="bbType{o} bbTag{cl}"><img src="img/x.gif" class="r2" alt="Clay"></a><a href="#" class="bbType{o} bbTag{c}"><img src="img/x.gif" class="r4" alt="Crop"></a><a href="#" class="bbType{o} bbTag{ir}"><img src="img/x.gif" class="r3" alt="Iron"></a></div>
						<div id="message_smilies"><a href="#" class="bbType{s} bbTag{*aha*}"><img class="smiley aha" src="img/x.gif" alt="*aha*"></a><a href="#" class="bbType{s} bbTag{*angry*}"><img class="smiley angry" src="img/x.gif" alt="*angry*"></a><a href="#" class="bbType{s} bbTag{*cool*}"><img class="smiley cool" src="img/x.gif" alt="*cool*"></a><a href="#" class="bbType{s} bbTag{*cry*}"><img class="smiley cry" src="img/x.gif" alt="*cry*"></a><a href="#" class="bbType{s} bbTag{*cute*}"><img class="smiley cute" src="img/x.gif" alt="*cute*"></a><a href="#" class="bbType{s} bbTag{*depressed*}"><img class="smiley depressed" src="img/x.gif" alt="*depressed*"></a><a href="#" class="bbType{s} bbTag{*eek*}"><img class="smiley eek" src="img/x.gif" alt="*eek*"></a><a href="#" class="bbType{s} bbTag{*ehem*}"><img class="smiley ehem" src="img/x.gif" alt="*ehem*"></a><a href="#" class="bbType{s} bbTag{*emotional*}"><img class="smiley emotional" src="img/x.gif" alt="*emotional*"></a><a href="#" class="bbType{s} bbTag{:D}"><img class="smiley grin" src="img/x.gif" alt=":D"></a><a href="#" class="bbType{s} bbTag{:)}"><img class="smiley happy" src="img/x.gif" alt=":)"></a><a href="#" class="bbType{s} bbTag{*hit*}"><img class="smiley hit" src="img/x.gif" alt="*hit*"></a><a href="#" class="bbType{s} bbTag{*hmm*}"><img class="smiley hmm" src="img/x.gif" alt="*hmm*"></a><a href="#" class="bbType{s} bbTag{*hmpf*}"><img class="smiley hmpf" src="img/x.gif" alt="*hmpf*"></a><a href="#" class="bbType{s} bbTag{*hrhr*}"><img class="smiley hrhr" src="img/x.gif" alt="*hrhr*"></a><a href="#" class="bbType{s} bbTag{*huh*}"><img class="smiley huh" src="img/x.gif" alt="*huh*"></a><a href="#" class="bbType{s} bbTag{*lazy*}"><img class="smiley lazy" src="img/x.gif" alt="*lazy*"></a><a href="#" class="bbType{s} bbTag{*love*}"><img class="smiley love" src="img/x.gif" alt="*love*"></a><a href="#" class="bbType{s} bbTag{*nocomment*}"><img class="smiley nocomment" src="img/x.gif" alt="*nocomment*"></a><a href="#" class="bbType{s} bbTag{*noemotion*}"><img class="smiley noemotion" src="img/x.gif" alt="*noemotion*"></a><a href="#" class="bbType{s} bbTag{*notamused*}"><img class="smiley notamused" src="img/x.gif" alt="*notamused*"></a><a href="#" class="bbType{s} bbTag{*pout*}"><img class="smiley pout" src="img/x.gif" alt="*pout*"></a><a href="#" class="bbType{s} bbTag{*redface*}"><img class="smiley redface" src="img/x.gif" alt="*redface*"></a><a href="#" class="bbType{s} bbTag{*rolleyes*}"><img class="smiley rolleyes" src="img/x.gif" alt="*rolleyes*"></a><a href="#" class="bbType{s} bbTag{:(}"><img class="smiley sad" src="img/x.gif" alt=":("></a><a href="#" class="bbType{s} bbTag{*shy*}"><img class="smiley shy" src="img/x.gif" alt="*shy*"></a><a href="#" class="bbType{s} bbTag{*smile*}"><img class="smiley smile" src="img/x.gif" alt="*smile*"></a><a href="#" class="bbType{s} bbTag{*tongue*}"><img class="smiley tongue" src="img/x.gif" alt="*tongue*"></a><a href="#" class="bbType{s} bbTag{*veryangry*}"><img class="smiley veryangry" src="img/x.gif" alt="*veryangry*"></a><a href="#" class="bbType{s} bbTag{*veryhappy*}"><img class="smiley veryhappy" src="img/x.gif" alt="*veryhappy*"></a><a href="#" class="bbType{s} bbTag{;)}"><img class="smiley wink" src="img/x.gif" alt=";)"></a></div>
						<div id="message_troops"><a href="#" class="bbType{o} bbTag{tid1}"><img class="unit u1" src="img/x.gif" alt="Legionnaire"></a><a href="#" class="bbType{o} bbTag{tid2}"><img class="unit u2" src="img/x.gif" alt="Praetorian"></a><a href="#" class="bbType{o} bbTag{tid3}"><img class="unit u3" src="img/x.gif" alt="Imperian"></a><a href="#" class="bbType{o} bbTag{tid4}"><img class="unit u4" src="img/x.gif" alt="Equites Legati"></a><a href="#" class="bbType{o} bbTag{tid5}"><img class="unit u5" src="img/x.gif" alt="Equites Imperatoris"></a><a href="#" class="bbType{o} bbTag{tid6}"><img class="unit u6" src="img/x.gif" alt="Equites Caesaris"></a><a href="#" class="bbType{o} bbTag{tid7}"><img class="unit u7" src="img/x.gif" alt="Battering Ram"></a><a href="#" class="bbType{o} bbTag{tid8}"><img class="unit u8" src="img/x.gif" alt="Fire Catapult"></a><a href="#" class="bbType{o} bbTag{tid9}"><img class="unit u9" src="img/x.gif" alt="Senator"></a><a href="#" class="bbType{o} bbTag{tid10}"><img class="unit u10" src="img/x.gif" alt="Settler"></a><a href="#" class="bbType{o} bbTag{tid11}"><img class="unit u11" src="img/x.gif" alt="Clubswinger"></a><a href="#" class="bbType{o} bbTag{tid12}"><img class="unit u12" src="img/x.gif" alt="Spearman"></a><a href="#" class="bbType{o} bbTag{tid13}"><img class="unit u13" src="img/x.gif" alt="Axeman"></a><a href="#" class="bbType{o} bbTag{tid14}"><img class="unit u14" src="img/x.gif" alt="Scout"></a><a href="#" class="bbType{o} bbTag{tid15}"><img class="unit u15" src="img/x.gif" alt="Paladin"></a><a href="#" class="bbType{o} bbTag{tid16}"><img class="unit u16" src="img/x.gif" alt="Teutonic Knight"></a><a href="#" class="bbType{o} bbTag{tid17}"><img class="unit u17" src="img/x.gif" alt="Ram"></a><a href="#" class="bbType{o} bbTag{tid18}"><img class="unit u18" src="img/x.gif" alt="Catapult"></a><a href="#" class="bbType{o} bbTag{tid19}"><img class="unit u19" src="img/x.gif" alt="Chief"></a><a href="#" class="bbType{o} bbTag{tid20}"><img class="unit u20" src="img/x.gif" alt="Settler"></a><a href="#" class="bbType{o} bbTag{tid21}"><img class="unit u21" src="img/x.gif" alt="Phalanx"></a><a href="#" class="bbType{o} bbTag{tid22}"><img class="unit u22" src="img/x.gif" alt="Swordsman"></a><a href="#" class="bbType{o} bbTag{tid23}"><img class="unit u23" src="img/x.gif" alt="Pathfinder"></a><a href="#" class="bbType{o} bbTag{tid24}"><img class="unit u24" src="img/x.gif" alt="Theutates Thunder"></a><a href="#" class="bbType{o} bbTag{tid25}"><img class="unit u25" src="img/x.gif" alt="Druidrider"></a><a href="#" class="bbType{o} bbTag{tid26}"><img class="unit u26" src="img/x.gif" alt="Haeduan"></a><a href="#" class="bbType{o} bbTag{tid27}"><img class="unit u27" src="img/x.gif" alt="Ram"></a><a href="#" class="bbType{o} bbTag{tid28}"><img class="unit u28" src="img/x.gif" alt="Trebuchet"></a><a href="#" class="bbType{o} bbTag{tid29}"><img class="unit u29" src="img/x.gif" alt="Chieftain"></a><a href="#" class="bbType{o} bbTag{tid30}"><img class="unit u30" src="img/x.gif" alt="Settler"></a><a href="#" class="bbType{o} bbTag{tid31}"><img class="unit u31" src="img/x.gif" alt="Rat"></a><a href="#" class="bbType{o} bbTag{tid32}"><img class="unit u32" src="img/x.gif" alt="Spider"></a><a href="#" class="bbType{o} bbTag{tid33}"><img class="unit u33" src="img/x.gif" alt="Snake"></a><a href="#" class="bbType{o} bbTag{tid34}"><img class="unit u34" src="img/x.gif" alt="Bat"></a><a href="#" class="bbType{o} bbTag{tid35}"><img class="unit u35" src="img/x.gif" alt="Wild Boar"></a><a href="#" class="bbType{o} bbTag{tid36}"><img class="unit u36" src="img/x.gif" alt="Wolf"></a><a href="#" class="bbType{o} bbTag{tid37}"><img class="unit u37" src="img/x.gif" alt="Bear"></a><a href="#" class="bbType{o} bbTag{tid38}"><img class="unit u38" src="img/x.gif" alt="Crocodile"></a><a href="#" class="bbType{o} bbTag{tid39}"><img class="unit u39" src="img/x.gif" alt="Tiger"></a><a href="#" class="bbType{o} bbTag{tid40}"><img class="unit u40" src="img/x.gif" alt="Elephant"></a><a href="#" class="bbType{o} bbTag{tid41}"><img class="unit u41" src="img/x.gif" alt="Pikeman"></a><a href="#" class="bbType{o} bbTag{tid42}"><img class="unit u42" src="img/x.gif" alt="Thorned Warrior"></a><a href="#" class="bbType{o} bbTag{tid43}"><img class="unit u43" src="img/x.gif" alt="Guardsman"></a><a href="#" class="bbType{o} bbTag{tid44}"><img class="unit u44" src="img/x.gif" alt="Birds Of Prey"></a><a href="#" class="bbType{o} bbTag{tid45}"><img class="unit u45" src="img/x.gif" alt="Axerider"></a><a href="#" class="bbType{o} bbTag{tid46}"><img class="unit u46" src="img/x.gif" alt="Natarian Knight"></a><a href="#" class="bbType{o} bbTag{tid47}"><img class="unit u47" src="img/x.gif" alt="War Elephant"></a><a href="#" class="bbType{o} bbTag{tid48}"><img class="unit u48" src="img/x.gif" alt="Ballista"></a><a href="#" class="bbType{o} bbTag{tid49}"><img class="unit u49" src="img/x.gif" alt="Natarian Emperor"></a><a href="#" class="bbType{o} bbTag{tid50}"><img class="unit u50" src="img/x.gif" alt="Settler"></a><a href="#" class="bbType{o} bbTag{hero}"><img class="unit uhero" src="img/x.gif" alt="Hero"></a></div>
					</div>
				</div>
	</div>
</div>
				<div class="line bbLine"></div>
                <textarea id="message" name="message" class="messageEditor" tabindex="3" cols="1" rows="1" onkeyup="copyElement('body')"  >
				<?php if(isset($message->reply['message'])) { echo " \n_________________________\n".REPLY.":\n".htmlspecialchars_decode(stripslashes($message->reply['message'])); } ?>
				</textarea>
				<div id="message_preview" class="messageEditor preview" style="display: none; "></div>
			</div>
			<script type="text/javascript">
				window.addEvent('domready', function()
				{
					new Travian.Game.BBEditor("message");
				});
			</script>
								</div>
                                                        <center>
                        <a onClick="document.getElementById('cap').src = 'securimage/securimage_show.php'; this.blur(); return false"><img style="margin-top:-30px;border:1px black dashed;width:150px;height:50px;position:relative" src="securimage/securimage_show.php" id="cap"></a>
                        <br>
                        <?=CAPTCHA_1?>
                        <br>
                        <input type="text" name="captcha">
                        </center>


					<div id="send">
				<button type="submit" value="Elküld" name="s1" id="s1" tabindex="4" class="green ">
					<div class="button-container addHoverClick">
						<div class="button-background">
							<div class="buttonStart">
								<div class="buttonEnd">
									<div class="buttonMiddle"></div>
								</div>
							</div>
						</div>
						<div class="button-content"><?php echo JR_SEND;?></div>
					</div>
				</button>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
	if($('s1'))
	{
		$('s1').addEvent('click', function ()
		{
			window.fireEvent('buttonClicked', [this, {"type":"submit","value":"send","name":"s1","id":"s1","class":"green ","title":"","confirm":"","onclick":"","tabindex":"4"}]);
		});
	}
	});
</script>
                <input type="hidden" name="ft" value="m2" />
											</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="paperBottom"></div>
		</div>
	</div>			
				<script>
				var bbEditor = new BBEditor("message");
			</script>
            
	</form>
<div class="hide" id="adressbook">
    <form method="post" name="abform" action="nachrichten.php" accept-charset="UTF-8">
 <input type="hidden" name="a" value="3e9" />
 <input type="hidden" name="t" value="1" />
 <input type="hidden" id="copy_receiver" name="copy_receiver" value="" />
 <input type="hidden" id="copy_subject" name="copy_subject" value="" />
 <input type="hidden" id="copy_igm" name="copy_igm" value="" />
 <input type="hidden" name="sbmtype" value="default" />
 <input type="hidden" name="sbmvalue" value="" />
	<div class="friendListContainer">
		<table cellpadding="1" cellspacing="1" class="friendlist friendlist1">
			<tbody>
				<tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[0]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr>
						<tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[2]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr>
						<tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[4]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr>
						<tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[6]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr>
						<tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[8]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr>
						<tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[10]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr><tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[12]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr>
						<tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[14]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr>
						<tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[16]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr>
						<tr>
							<td class="end"></td>
							<td class="pla">
								<input class="text" type="text" name="addfriends[18]" value="" maxlength="15" />
							</td>
							<td class="accept"></td>
						</tr>
					</tbody>
		</table>

		<table cellpadding="1" cellspacing="1" class="friendlist friendlist2">
			<tbody>
				<tr>
					<td class="end"></td>
					<td class="pla">
						<input class="text" type="text" name="addfriends[1]" value="" maxlength="15" />
					</td>
					<td class="accept"></td>
				</tr>
				<tr>
					<td class="end"></td>
					<td class="pla">
						<input class="text" type="text" name="addfriends[3]" value="" maxlength="15" />
					</td>
					<td class="accept"></td>
				</tr>
				<tr>
					<td class="end"></td>
					<td class="pla">
						<input class="text" type="text" name="addfriends[5]" value="" maxlength="15" />
					</td>
					<td class="accept"></td>
				</tr>
				<tr>
					<td class="end"></td>
					<td class="pla">
						<input class="text" type="text" name="addfriends[7]" value="" maxlength="15" />
					</td>
					<td class="accept"></td>
				</tr>
				<tr>
					<td class="end"></td>
					<td class="pla">
						<input class="text" type="text" name="addfriends[9]" value="" maxlength="15" />
					</td>
					<td class="accept"></td>
				</tr>
				<tr>
						<td class="end"></td>
						<td class="pla">
							<input class="text" type="text" name="addfriends[11]" value="" maxlength="15" />
						</td>
						<td class="accept"></td>
					</tr>
					<tr>
						<td class="end"></td>
						<td class="pla">
							<input class="text" type="text" name="addfriends[13]" value="" maxlength="15" />
						</td>
						<td class="accept"></td>
					</tr>
					<tr>
						<td class="end"></td>
						<td class="pla">
							<input class="text" type="text" name="addfriends[15]" value="" maxlength="15" />
						</td>
						<td class="accept"></td>
					</tr>
					<tr>
						<td class="end"></td>
						<td class="pla">
							<input class="text" type="text" name="addfriends[17]" value="" maxlength="15" />
						</td>
						<td class="accept"></td>
					</tr>
					<tr>
						<td class="end"></td>
						<td class="pla">
							<input class="text" type="text" name="addfriends[19]" value="" maxlength="15" />
						</td>
						<td class="accept"></td>
					</tr>
			</tbody>
            
		</table>
        </form>
		<div class="clear"></div>
	</div>
</div></div>
<script type="text/javascript">
	Travian.Translation.add(
	{
		'nachrichten.adressbuch': '<?php echo ADDRESSBOOK;?>',
		'allgemein.save': '<?php echo JR_SAVE;?>'
	});
</script>

