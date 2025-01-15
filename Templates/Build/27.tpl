<h1 class="titleInHeader"><?php echo B27;?><span class="level"><?php echo LVL.' '.$village->resarray['f'.$id]; ?></span></h1>

    <div id="build" class="gid27">
    <div class="build_desc">
        <a href="#" onClick="return Travian.Game.iPopup(27,4);" class="build_logo">
        <img class="building big white g27" src="img/x.gif" alt="<?php echo B27;?>" title="<?php echo B27;?><?php echo B27;?>"></a>
        <?php echo B27_DESC;?></div>
        <?php
        include("upgrade.tpl");
        include("27_menu.tpl");
        if(isset($_GET['show'])){  include("27_show.tpl");  }else{
        if(!isset($_GET['t'])){
            include("27_1.tpl");     
        }elseif(isset($_GET['t']) && $_GET['t'] == 2){
            include("27_2.tpl"); 
        }elseif(isset($_GET['t']) && $_GET['t'] == 3){
            include("27_3.tpl");
        }
        }
        
        
        ?>
    </div>