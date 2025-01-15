<div id="villageList" class="listing">
	<div class="head">
		<a href="statistiken.php?tid=0" accesskey="9" title="Village Overview"><?php echo STATS; ?>:</a> 
	</div> 
	<div class="list"> 
		<ul>        
			<?php
   $tribe1 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 1 and id>4");
   $tribe2 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 2 and id>4");
   $tribe3 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 3 and id>4");
   $tribes = array(mysql_num_rows($tribe1), mysql_num_rows($tribe2), mysql_num_rows($tribe3));
   $users = mysql_num_rows(mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE id>4")); ?>
<?php   $online += mysql_num_rows(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE " . time() . "-timestamp < (60*60) AND tribe!=5 AND tribe!=0")); ?>

     <tbody>
     <tr>
      <font color=brown><h4 align=center><?php echo "تعداد بازیکنان سرور:";?></h4></font>
      <font color=red><h2 align=center><?php echo $users; ?></h2></font>
     </tr>
       <tr>
      <font color=brown><h4 align=center><?php echo "بازیکنان آنلاین:";?></h4></font>
      <font color=red><h2 align=center><?php echo $online; ?></h2></font>
		</ul>
	</div>
<div class="foot"></div>
</div>

<?php include("Templates/links.tpl"); ?>