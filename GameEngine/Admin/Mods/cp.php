<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold.php                                                    ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
include_once("../../Account.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if ($session->access < ADMIN) die("Access Denied: You are not Admin!");

$id = $_POST['id'];
$admid = $_POST['admid'];
mysql_query("UPDATE ".TB_PREFIX."users SET cp = cp + ".$_POST['cp']." WHERE id = ".$id."");
header("Location: ../../../player.php?uid=".$id."&cp=ok");
?>