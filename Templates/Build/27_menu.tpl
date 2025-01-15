<div class="contentNavi tabNavi">
<div <?php if(!isset($_GET['t']) && $_GET['id'] == $id) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
<div class="background-start">&nbsp;</div>
<div class="background-end">&nbsp;</div>
<div class="content"><a href="build.php?id=<?php echo $id; ?>"><span class="tabItem"><?php echo JR_OVERVIEW;?></span></a></div>
</div>
<div <?php if(isset($_GET['t']) && $_GET['t'] == 2) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
<div class="background-start">&nbsp;</div>
<div class="background-end">&nbsp;</div>
<div class="content"><a href="build.php?id=<?php echo $id; ?>&t=2"><span class="tabItem"><?php echo SMALLARTES;?></span></a></div>
</div>
<div <?php if(isset($_GET['t']) && $_GET['t'] == 3) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
<div class="background-start">&nbsp;</div>
<div class="background-end">&nbsp;</div>
<div class="content"><a href="build.php?id=<?php echo $id; ?>&t=3"><span class="tabItem"><?php echo BIGARTES;?></span></a></div>
</div>
<div class="clear"></div>
</div>