 <?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$allianceinfo = $database->getAlliance($aid);
include("alli_menu.tpl");
if(strlen($_POST['topic']) > 0) {
	echo REPORT_SENT.".<br>";
}
?>
<form method="POST">
<input type="hidden" name="s" value="105">
<input type="hidden" name="o" value="105">
<table>
<tr><td><?=SUBJECT?>:</td><td><input type="text" name="topic"></td></tr>
<tr><td><?=Message?>:</td><td><textarea name="message" style="width:300px;height:200px;"></textarea></td></tr>
<tr><td></td><td><input type="submit" value="<?=SEND?>"></td></tr>

</table>

</form>


