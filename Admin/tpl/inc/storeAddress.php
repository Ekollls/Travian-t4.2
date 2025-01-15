<?php
function storeAddress() {
  $message = "&nbsp;";
  // Check for an email address in the query string
  if( !isset($_GET['address']) ){
    // No email address provided
  }
  else {
    // Get email address from the query string
    $address = $_GET['address'];
    // Validate Address
    if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $address)) {
      $message = "<strong>Error</strong>: An invalid email address was provided.";
    }
    else {
$key = $address;
//load file into $fc array
$fc=file("maillist.php");
//open same file and use "w" to clear file
$f=fopen("maillist.php","w");
//loop through array using foreach
foreach($fc as $line)
{
     if (!strstr($line,$key)) //look for $key in each line
           fputs($f,$line); //place $line back in file
}
fclose($f);
$myFile = "maillist.php";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, $address);
$stringData = "<br>\n";
fwrite($fh, $stringData);
fclose($fh);

      if(mysql_error()){
        $message = "<strong>Error</strong>: There was an error storing your email address, try again later.";
      }
      else {
        $message = "Thanks for signing up!";
      }
    }
  }
  return $message;
}
?>