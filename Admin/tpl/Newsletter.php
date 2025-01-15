<?php require_once("../mail/inc/bouncer.php"); ?>
<script language="javascript" type="text/javascript" src="mail/wys/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
		tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<center>

<?php
	$names = file("../mail/maillist.php");	
	$lines = count(file("../mail/maillist.php"));
  $lines = $lines-1;  
?>
<form method="post" action="../mail/sendit.php">

	<ul class="tabs"><center>
		<li>&#1575;&#1585;&#1587;&#1575;&#1604; &#1582;&#1576;&#1585;&#1606;&#1575;&#1605;&#1607; &#1576;&#1607; &#1575;&#1593;&#1590;&#1575;</li>
        </center>
	</ul>

	<table id="member" border="1" cellpadding="3" align="center" dir="rtl">
<br>&#1601;&#1585;&#1587;&#1578;&#1575;&#1583;&#1606; &#1576;&#1607;:<input type="text" name="to" size="44" value="<?php 	for($i=1; $i<=$lines; $i=$i+1)
	{
    $names[$i] = str_replace("<br>", "", $names[$i]);
    $names[$i] = str_replace("\n", "", $names[$i]);
		echo $names[$i].';';
	}	
	
	?>"><br>
 <br>&#1575;&#1740;&#1605;&#1740;&#1604; &#1605;&#1606;:<input type="text" name="email" size="44" value="admin@trafianpro.ir"><br>
 <br>&#1593;&#1606;&#1608;&#1575;&#1606; &#1575;&#1740;&#1605;&#1740;&#1604;:<input type="text" name="subject" size="44" /><br><br>
<textarea id="elm2" name="elm2" rows="10" cols="40">
<?php if(isset($load)){

include("../mail/outbox/".$load.".txt");
}
?>
</textarea>

<br><input type="submit" name="save" value="Submit">
	<input type="reset" name="reset" value="Reset">
</form>
</center>
</table>
_____________________________________________________________________________________________________