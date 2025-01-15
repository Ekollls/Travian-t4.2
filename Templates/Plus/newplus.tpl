<?php
include("Templates/Plus/price.tpl");$extragoud="0";
$Id = 0;
?>
<script type="text/javascript">
		<!--
		function loadProductGroup(group_id) {
		    if (group_id.length == 0){
		        path='';
		    } else {
		        path='?group='+group_id;
		    }

		    location.href=path;
		}
		//-->
		</script>


<div class="whatToDo lang_rtl">بسته ای انتخاب کنید:</div>
<div class="clear"></div>
<div id="products">
<?php
foreach ($AppConfig['plus']['packages'] as $x) {
?>


            <div class="productBackground lang_rtl lang_fa">
			    <table class="transparent product lang_rtl lang_fa " cellpadding="1" cellspacing="1">
					<thead>
						<tr>
							<th><div class="boxes boxesColor orange">
                            <div class="boxes-tl"></div><div class="boxes-tr"></div>
                            <div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div>
                            <div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div>
                            <div class="boxes-bc"></div><div class="boxes-contents"><?php echo $x['name'] ?></div>
				</div></th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td class="pic">
								<img src="img/plus/<?=$x['image']?>" style="width:100px; height:100px;" alt="<?php echo $x['name'] ?>">
							</td>
						</tr>
						<tr>
							<td class="units" style="font-family:tahoma"><?php echo $x['gold'] ?>&nbsp;سکۀ طلا</td>
						</tr>
						<tr>
							<td class="price" style="font-family:tahoma"><?php echo $x['cost'] ?>&nbsp;تومان</td>

						</tr>
					</tbody>
				</table>
				<a class="bookProduct" target="_blank" href="pay.php?c=<?=$x['id']?>"><img src="img/x.gif" alt=""></a>
			</div>


        <?php } ?>



						<div class="productBackground lang_rtl lang_fa">
			    <table class="transparent product lang_rtl lang_fa " cellpadding="1" cellspacing="1">
						<tr>
							<th><div class="boxes boxesColor orange"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">سفارشی	</div>
				</div></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="pic">
								<img src="img/products/Travian_voucher_a.jpg" style="width:100px; height:100px;" alt="Voucher">
							</td>
						</tr>
						<tr>
							<td class="voucher">انتقال سکه</td>
						</tr>
						<tr>
							<td class="voucher">به ادمین پیام بدین</td>
						</tr>
					</tbody>
				</table>
				<a class="voucher" href="ymsgr:<?=YID?>"><img src="img/x.gif" alt=""></a>
			</div>
					<div class="clear"></div>
	</div>
    <span class="final_sales_amounts_text">تمام قیمت ها نهایی هستند...سکه ها قابل انتقال به سرور های دیگه نمیباشد...تنها میتوان با 25% کاهش به اکانت دیگر انتقال داد...که توسط ادمین انجام میگردد.</span>
    <div class="clear">&nbsp;</div>