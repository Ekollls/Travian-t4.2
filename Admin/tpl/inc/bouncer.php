<?php
 if(!isset($_GET['debug'])){
	error_reporting(0);
}
session_save_path("sessions");
session_start();

function session_defaults() {
	$_SESSION['logged'] = "false";
	$_SESSION['username'] = '';
	$_SESSION['failed'] = 0;
	}
if (!isset($_SESSION['active']) ) {
	session_defaults();
	} 
	
if (isset($_POST['pass']) ) {
	include("inc/config.php");
	$pass = $_POST['pass'];
	if($pass == $password){
	 $_SESSION['logged'] = "true";
	 $_SESSION['active'] = true;
	 $_SESSION['username'] = "admin";
	 $_SESSION['failed'] = 0;
	}  
	}

if(isset($_GET['debug'])) {
	echo "Debug mode <b>ON</b><br>".
	" Username: ".$_SESSION['username'].
	", Logged: ".$_SESSION['logged'].
	", Active: ".$_SESSION['active'].
	", Failed: ".$_SESSION['failed'].
	" <a href='javascript:alert(document.cookie)'>show cookie</a><hr>";
	}
if($_SESSION['logged'] == "false"){
	include("assets/login.php");
	}
if (isset($_GET['logout']) ) {
	header('refresh: 1; url=admin.php');
	session_defaults();
	} 
?>