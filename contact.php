<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");
include("GameEngine/Village.php");

include "Templates/html.tpl";
?>
<body class="v35 webkit chrome support">
<?php include_once("analyticstracking.php") ?>
	<div id="wrapper">
		<img id="staticElements" src="img/x.gif" alt="">
		<div class="bodyWrapper">
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="">
			<div id="header">
				<div id="mtop">
					<a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>"></a>
					<div class="clear"></div>
				</div>
			</div>
			<div id="mid">
<a id="ingameManual" href="help.php"><img class="question" alt="Help" src="img/x.gif"></a>
<div id="side_navi">
	<ul>
						<li>
							<a href="<?php echo HOMEPAGE; ?>" title="<?php echo HOME; ?>"><?php echo HOME; ?></a>
						</li>

						<li>
							<a href="login.php" title="<?php echo LOGIN; ?>"><?php echo LOGIN; ?></a>
						</li>

						<li>
							<a href="anmelden.php" title="<?php echo REG; ?>"><?php echo REG; ?></a>
						</li>

						<li>
							<a href="<?php echo FORUM_LINK;?>" target="_blank" title="<?php echo FORUM; ?>"><?php echo FORUM; ?></a>
						</li>
						<li class="active">
							<a href="contact.php" title="<?php echo SUPPORT; ?>"><?php echo SUPPORT; ?></a>
						</li>
						<li>
							<label for="sellang" class="lsMl">Language:</label>
							<select name="sellang" id="sellang" onchange="changeLanguage();">
								<option value="en" <?php if ($_SESSION['lang']=='en') echo 'selected="selected"';?>>English</option>
								<option value="fa" <?php if ($_SESSION['lang']=='fa') echo 'selected="selected"';?>>فارسی</option>
							</select>
						</li>
					</ul>
</div>
<div class="clear"></div>
<div id="contentOuterContainer">
							<div class="contentTitle">&nbsp;</div>
							<div class="contentContainer">
								<div id="content" class="support"><h1 class="titleInHeader"><?php echo SUPPORT; ?></h1>
<div class="supportDescription"><?php echo SUPPORT_DESC; ?></div>
<div class="supportForm">
<?php
if($_POST){
	if($_POST['username']!=''){
		if($_POST['email']!=''){
			if($_POST['message']!=''){
				if($database->checkExist($_POST['username'], 0)){
					$userID = $database->getUserField($_POST['username'], 'id', 1);
					$username = $_POST['username'];
					$subject = "[".rand(12345,543210)."|".date('Y/m/d',time())."]";
					if($_POST['category']==1){
						$mSubject = CONTACT_SUBJECT1;
					}elseif($_POST['category']==2){
						$mSubject = CONTACT_SUBJECT2;
					}elseif($_POST['category']==3){
						$mSubject = CONTACT_SUBJECT3;
					} else {
						$mSubject = 'No subject';
					}
					$message = "[b]".EMAIL."[/b]: ".$_POST['email']."<br/><br/>[b]".MESSAGE_CONTENT.":[/b]<br/>".$_POST['message']."";
					$database->sendMessage($database->getUserField('Multihunter', 'id', 1), $userID, $mSubject, $message, 0);
					echo '<center><font color="green">'.REPORT_SENT.'</font></center>';
				}
			}
		}
	}
}
?>
<form method="post" action="contact.php" name="support" id="support">

<div id="group_support_category">
<table class="form_table form_tablel_support" width="100%"><tbody><tr>
	<td class="form_table_label form_table_label_support_category">
		<label class="form_label" for="category"><?php echo JR_CATEGORY; ?></label></td>
	<td class="form_table_element form_table_element_support_category">
		<select id="support_category" name="category">
			<option value="please_select"><?php echo JR_SELECT; ?></option>
			<option value="1"><?php echo JR_GENERALQUESTIONS; ?></option>
			<option value="2"><?php echo JR_ICANNOTLOGIN; ?></option>
			<option value="3"><?php echo JR_ICANNOTREGISTER; ?></option>
		</select>
	</td></tr></tbody>
</table>
</div>

<div id="group_support_gameworld"></div>
<div id="group_support_username">
<table class="form_table form_tablel_support" width="100%">
	<tbody>
		<tr>
			<td class="form_table_label form_table_label_support_username">
				<label class="form_label" for="username"><?php echo LOGIN_USERNAME; ?></label>
			</td>
			<td class="form_table_element form_table_element_support_username">
				<input type="text" id="support_username" name="username" label="<?php echo LOGIN_USERNAME; ?>" value="<?php echo $_POST['username']; ?>">
                <?php
				if(isset($_POST) && count($_POST)>0 && (!isset($_POST['username']) || $_POST['username']=='')){
					echo '<span class="error">'.USRNM_EMPTY.'</span>';
				}elseif($_POST && !$database->checkExist($_POST['username'], 0)){
					echo '<span class="error">'.CONTACT_USER_NOT_EXIST.'</span>';
				}
				?>
			</td>
		</tr>
	</tbody>
</table>
</div>

<div id="group_support_email">
<table class="form_table form_tablel_support" width="100%">
	<tbody>
    	<tr>
        <td class="form_table_label form_table_label_support_email">
        	<label class="form_label" for="email"><?php echo REGISTER_EMAIL; ?></label>
        </td>
        <td class="form_table_element form_table_element_support_email">
        	<input type="text" id="support_email" name="email" label="<?php echo REGISTER_EMAIL; ?>" value="<?php echo $_POST['email']; ?>">
                <?php if(isset($_POST) && count($_POST)>0 && (!isset($_POST['email']) || $_POST['email']=='')){ echo '<span class="error">'.EMAIL_EMPTY.'</span>';} ?>
        </td>
        </tr>
	</tbody>
</table>
</div>

<div id="group_support_message">
<table class="form_table form_tablel_support" width="100%">
	<tbody>
    	<tr>
        <td class="form_table_label form_table_label_support_message">
        	<label class="form_label" for="message"><?php echo MESSAGE_CONTENT; ?></label>
        </td>
        <td class="form_table_element form_table_element_support_message">
        	<textarea name="message" cols="43" rows="7" label="<?php echo MESSAGE_CONTENT; ?>" helper=""><?php echo $_POST['message']; ?></textarea>
                <?php if(isset($_POST) && count($_POST)>0 && (!isset($_POST['message']) || $_POST['message']=='')){ echo '<p class="error">'.MSG_EMPTY.'</p>';} ?>
		</td>
        </tr>
	</tbody>
</table>
</div>

<div id="group_support_submit">
<table class="form_table form_tablel_support" width="100%">
	<tbody>
    	<tr>
        <td class="form_table_label form_table_label_support_submit">
        	<label class="form_label" for="submit"></label>
		</td>
        <td class="form_table_element form_table_element_support_submit">
        	<button type="submit" value="<?php echo JR_SEND; ?>" name="submit" id="submit" submit="1">
        	<div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents"><?php echo JR_SEND; ?></div></div>
            </button>
		</td>
        </tr>
	</tbody>
</table>
</div>
</form>


</div>
<div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>
</div>
<div class="contentFooter">&nbsp;</div>
</div>

<div id="side_info">  
	<?php if(NEWSBOX1) { ?>
			<div class="news news1">
				<?php include("Templates/News/newsbox1.tpl"); ?>
			</div>
    <?php } ?>
	<?php if(NEWSBOX2) { ?>
		<div class="news news2">
			<?php include("Templates/News/newsbox2.tpl"); ?>
		</div>
	<?php } ?>
            
</div>
<?php include("Templates/footer.tpl");?>
</div>

<div id="ce"></div>
</div>
</body>
</html>
