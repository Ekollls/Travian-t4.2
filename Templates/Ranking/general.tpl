<?php
   $tribe1 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 1 and id>4");
   $tribe2 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 2 and id>4");
   $tribe3 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 3 and id>4");
   $tribes = array(mysql_num_rows($tribe1), mysql_num_rows($tribe2), mysql_num_rows($tribe3));
   $users = mysql_num_rows(mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE id>4")); ?>

<h4 class="round"><?php echo STATS;?></h4>
<table cellpadding="1" cellspacing="1" id="world_player" class="transparent">
     <tbody>
     <tr>
      <th><?php echo REGISTEREDPLAYERS;?></th>
      <td><?php echo $users; ?></td>
     </tr>
     <tr>
      <th><?php echo ACTIVE_PLAYERS;?></th>
      <td><?php
                   $active = mysql_num_rows(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id>4 AND ".time()."-timestamp < ".(3600*24)));
                   echo $active; ?></td>
     </tr>     <tr>
      <th><?php echo ONLINE_PLAYERS;?></th>
      <td><?php
                              $online += mysql_num_rows(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE " . time() . "-timestamp < (60*60) AND tribe!=5 AND tribe!=0"));
				echo $online;
				?></td>
     </tr>
    </tbody>
   </table>
<h4 class="round spacer"><?php echo TRIBE;?></h4>
<table cellpadding="1" cellspacing="1" id="world_tribes" class="world">
    <thead>
     <tr class="hover">
      <td><?php echo TRIBE;?></td>
      <td><?php echo REGISTEREDPLAYERS;?></td>
      <td><?php echo PERCENT;?></td>
     </tr>
     </thead>
     <tbody>
     <tr class="hover">
      <td><?php echo TRIBE1;?></td>
      <td><?php echo $tribes[0]; ?></td>
      <td><?php
$percents = 100*($tribes[0] / $users);
echo $percents = intval ($percents);
echo "%"; ?></td>
     </tr>
     <tr class="hover">
      <td><?php echo TRIBE2;?></td>
      <td><?php echo $tribes[1]; ?></td>
      <td><?php
$percents = 100*($tribes[1] / $users);
echo $percents = intval ($percents);
echo "%"; ?></td>
     </tr>
     <tr class="hover">
      <td><?php echo TRIBE3;?></td>
      <td><?php echo $tribes[2]; ?></td>
      <td><?php
$percents = 100*($tribes[2] / $users);
echo $percents = intval ($percents);
echo "%"; ?></td>
     </tr>
    </tbody>
   </table>