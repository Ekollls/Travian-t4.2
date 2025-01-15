<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\">Error creating wdata. Check configuration or file.</span></div><br>";
}
?>
<script type="text/javascript">
	function goAjax(){
		//var creatbtn = document.getElementById('creatbtn');
		//$('creatbtn').setStyle('visiblity','hidden');
		//alert('hi');
		return true;
	}
</script>
<div id="content" class="login">
	<form action="process.php" method="post" id="dataform" onsubmit="return goAjax();">
		<div class="lbox">
			<tr>
				<td>
					<span class="f9 c6">ساخت جهان:</span>
				</td>
				<td>
					<button type="submit" value="Upgrade level" class="build" id="creatbtn">
						<div class="button-container">
							<div class="button-position">
								<div class="btl">
									<div class="btr">
										<div class="btc"></div>
									</div>
								</div>
								<div class="bml">
									<div class="bmr">
										<div class="bmc"></div>
									</div>
								</div>
								<div class="bbl">
									<div class="bbr">
										<div class="bbc"></div>
									</div>
								</div>
							</div>
							<div class="button-contents">بساز</div>
						</div>
					</button>
				</td>
			</tr>
			<br /><br />
			<font color="Red"><b>هشدار:</b> این مرحله ممکن است کمی طول بکشد, لطفا صبر کنید و این صفحه را نبندید. در غیر اینصورت مشکل بوجود خواهد آمد!</font>
		</div>
		<input type="hidden" name="subwdata" value="1">
	</form>
</div>
