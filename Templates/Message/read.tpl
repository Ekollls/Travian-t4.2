<?php
$input = $message->reading['message'];
include("GameEngine/BBCode.php");
?>
<div id="messageNavigation">
	<div id="backToInbox">
		<a href="nachrichten.php"><?php echo RETURNTOINBOX;?></a>
	</div>
	<div class="clear"></div>
</div>
<div class="paper">
	<div class="layout">
		<div class="paperTop">
			<div class="paperContent">

				<div id="sender">
					<div class="header label"><?php echo REPORT_SENDER;?></div>
					<div class="header text"><?php echo"<a href=\"spieler.php?uid=".$database->getUserField($message->reading['owner'],"id",0)."\">".$database->getUserField($message->reading['owner'],"username",0)."</a>"; ?></div>
					<div class="clear"></div>
				</div>
					
				<div id="subject">
					<div class="header label"><?php echo SUBJECT;?></div>
					<div class="header text"><?php echo $message->reading['topic']; ?></div>
					<div class="clear"></div>
				</div>

		<div id="time">
			<div class="header label"><?php echo SENT;?></div>
			<div class="header text"><?php $date = $generator->procMtime($message->reading['time']);echo $date[0]; ?> <?php echo $date[1]; ?></div>
					<div class="toolList">
						<div id="deleteMessage">			
							<form method="post" action="nachrichten.php?n1=<?php echo $message->reading['id']; ?>"> 
							<input type="hidden" name="n1" value="349835" id="n1">
							<input type="hidden" name="t" value="2" id="t">
							<button type="submit" name="delmsg"  id="delmsg" class="icon " onclick="return (function(){
							('Really delete this report?').dialog(
							{
								onOkay: function(dialog, contentElement)
								{
									$('delmsg').up('form').submit();},onShow: function() {
								var button = $('delmsg');
								button.disabled = true;
								button.disabled = false;
							}});
							return false;
						})()"><img src="img/x.gif" class="Delete delete" alt="Delete delete">
						</button>									
						<input type="hidden" name="delmsg" value="1">
					</form>
						</div>
					</div>
					<div class="clear"></div>		
		</div>

		<div class="separator"></div>
		<div id="message"><?php echo htmlspecialchars_decode(stripslashes(nl2br($bbcoded))); ?></div>

		<div id="answer">
        <form method="post" action="nachrichten.php">
	<input type="hidden" name="id" value="<?php echo $message->reading['id']; ?>" />
    <input type="hidden" name="ft" value="m1" />
	<input type="hidden" name="t" value="1" />
<button type="submit" value="<?php echo REPLY;?>" name="s1" id="s1" class="green ">
	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo REPLY;?></div>
	</div>
</button>
<script type="text/javascript">
	window.addEvent('domready', function()
	{
	if($('s1'))
	{
		$('s1').addEvent('click', function ()
		{
			window.fireEvent('buttonClicked', [this, {"type":"submit","value":"answer","name":"s1","id":"s1","class":"green ","title":"","confirm":"","onclick":""}]);
		});
	}
	});
</script>
					</form>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>