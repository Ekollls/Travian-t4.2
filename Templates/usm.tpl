<?php 
ob_start();
echo "<SCRIPT language='JavaScript'>window.location='messages.php';</SCRIPT>";
header("Location: messages.php");
exit();
ob_flush();
?>