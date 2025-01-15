<?php if(GP_ENABLE) {
?>
<h1><?php echo PROFILE;?></h1>

<?php include("menu.tpl"); ?>
<?php if(isset($_POST["custom_url"])) {
$database->updateUserField($session->uid,gpack,$_POST["custom_url"],1);
 } ?>
<?php if(isset($_GET["custom_url"])) {
?>
<link href="<?php echo $_GET["custom_url"]; ?>/lang/<?php echo $_SESSION['lang']; ?>/gp_check.css" rel="stylesheet" type="text/css">
<div id="gpack_popup">
		
		<div id="gpack_error">
			<img class="logo unknown" src="img/x.gif" alt="unknown" title="unknown"><span class="error"><?php echo GPNFOUNDDESC;?>:</span><br>
<ul>
<li><?php echo GPNFREASON1;?></li>
<li><?php echo GPNFREASON2;?></li>
</ul>			<form action="spieler.php" method="post">
				<input type="hidden" name="s" value="4">
				<div class="btn"><input type="image" alt="OK" src="img/x.gif" value="ok" class="dynamic_img" id="btn_ok"></div>
			</form>
		</div>

		
		<div id="gpack_activate">
			<span class="info"><?php echo GPFOUND;?></span><br>
			<img id="preview" src="img/x.gif"><br>

			<?php echo sprintf(GPFOUNDDESC,'<span class="path">'.$_GET["custom_url"].'</span>');?>
			
			<form action="spieler.php" method="post">
				<input type="hidden" name="s" value="4">
				<input type="hidden" name="custom_url" value="<?php echo $_GET["custom_url"]; ?>">
				<div class="btn"><input type="image" alt="save" src="img/x.gif" value="save" class="dynamic_img" id="btn_save" name="gp_activate_button"></div>
			</form>
		</div>
	</div>
<?php } ?>

<form action="spieler.php" method="post" name="gp_selection">
<input type="hidden" name="s" value="4" />
<table cellpadding="1" cellspacing="1" id="gpack">
    <thead>
        <tr>
            <th><?php echo GPSETTING;?></th>
        </tr>
	</thead>
 
			<tbody>
	        <tr>
	        	<td class="info">
	        		<?php echo GPSETTINGDESC;?>
	        	</td>
	        </tr>
	        <tr>
	        	<th class="empty"></th>
	        </tr>
            <tr>
	        	<td>
	        		<label>
		        		<input type="radio" class="radio" name="gp_type" value="<?php echo GP_LOCATE; ?>" checked="checked">
		        		<?php echo GPSTANDARD;?>
                    </label>
	            </td>
	        </tr>
            <tr>
	        	<td>
	        		<label>
		        		<input type="radio" class="radio" name="gp_type" value="<?php echo GP_LOCATE_NEW; ?>">
		        		<?php echo UPGRADEGP;?></label>
	            </td>
	        </tr>
            	        <tr>
	        	<th class="empty"></th>
	        </tr>
	        <tr>
	            <td>
	            	<label>
                        <input type="radio" class="radio" name="gp_type" value="custom" />
                        <?php echo CUSTOMGP;?>
                    </label>
                    <input class="text" type="text" name="custom_url" value="<?php echo $session->gpack; ?>" onclick="document.gp_selection.gp_type[1].checked = true" /><br />
<div class="example"><?php echo JR_EXAMPLE;?>: <span class="path">file:///C://gpack/</span> <?php echo OR_STR;?> <span class="path">http://www..org/user/gpack/</span></div>

                </td>

            </tr>
        </tbody>
    </table>
    <p class="btn"><input type="image" alt="OK" src="img/x.gif" name="gp_selection_button" value="ok" class="dynamic_img" id="btn_ok" /></p>
    </form>


    <table cellpadding="1" cellspacing="1" id="download">
        <thead>
            <tr>

                <th colspan="4"><?php echo MOREGP;?></th>
            </tr>
            <tr>
                <td><?php echo NAME;?></td>
                <td><?php echo SIZEINMB;?></td>
                <td><?php echo ACTIVATE;?></td>
                <td><?php echo DOWNLOAD;?></td>

            </tr>
        </thead>
        <tbody>
                <tr>
                    <td class="nam">Travian Default</td>
                                        <td class="size">4</td>
                    <td class="act"><a href="spieler.php?s=4&gp_type=custom&custom_url=gpack/travian_default/"><?php echo ACTIVATE;?></a></td>

                    <td class="down"><a href="gpack/download/travian_default.zip" target="_blank"><?php echo DOWNLOAD;?></a></td>
                </tr>
                    </tbody>
    </table>
    <?php
    }
    ?>
