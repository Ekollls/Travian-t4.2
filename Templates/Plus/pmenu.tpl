	<h1 class="titleInHeader">t4dl<font color="#71D000"> Plus </font></h1>
	<div class="contentNavi subNavi">
		<div title="" class="container <?php if(!isset($_GET['id']) || (isset($_GET['id']) && $_GET['id'] == 1)) {echo "active";}else{echo "normal";} ?>">
			<div class="background-start"></div>
			<div class="background-end"></div>
			<div class="content"><a href="plus.php?id=1"><span class="tabItem"> <?php echo BUYGOLD;?> </span></a></div>
		</div>
		<div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 2) {echo "active";}else{echo "normal";} ?>">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a href="plus.php?id=2"><span class="tabItem"> <?php echo ADVANTAGES;?> </span></a></div>
		</div>
		<div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 3) {echo "active";}else{echo "normal";} ?>">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a href="plus.php?id=3"><span class="tabItem"> <?php echo HEADER_PLUS;?></span></a></div>
		</div>
		<div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 5) {echo "active";}else{echo "normal";} ?>">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a href="plus.php?id=5"><span class="tabItem"> <?php echo FREEGOLD;?></span></a></div>
		</div>
		<div title="" class="container <?php if($_GET['id'] == 100) {echo "active";}else{echo "normal";} ?>">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a href="plus.php?id=100"><span class="tabItem"> بانک</span></a></div>
		</div>
		<div class="clear"></div>
	</div>
