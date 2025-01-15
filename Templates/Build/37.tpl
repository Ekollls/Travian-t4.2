<h1 class="titleInHeader"><?php echo B37;?> <span class="level"> <?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>

    <div id="build" class="gid37">
    <div class="build_desc">
        <a href="#" onClick="return Travian.Game.iPopup(37,4);" class="build_logo">
        <img class="building big white g37" src="img/x.gif" alt="<?php echo B37;?>" title="<?php echo B37;?>"/></a>
        <?php echo B37_DESC; ?></div>
        
       <?php           
            include ("upgrade.tpl");             
            include("37_heromansion.tpl");
        ?>
        
    </div>
