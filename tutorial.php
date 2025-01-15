<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("GameEngine/Protection.php");

	if(!isset($_GET['s'])) {
	$_GET['s'] = ""; }
	if ($_GET['s'] == "") {
	include("Templates/Tutorial/1.tpl"); }
	if ($_GET['s'] == "1") {
	include("Templates/Tutorial/1.tpl"); }
	if ($_GET['s'] == "2") {
	include("Templates/Tutorial/2.tpl"); }
	if ($_GET['s'] == "3") {
	include("Templates/Tutorial/3.tpl"); }
	if ($_GET['s'] == "4") {
	include("Templates/Tutorial/4.tpl"); }
	if ($_GET['s'] == "5") {
	include("Templates/Tutorial/5.tpl"); }
	
?>