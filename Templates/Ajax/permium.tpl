<?php if($success && !$finishnowsuccess){ 
/*
{
	response: {"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","options":{"html":null},"context":"paymentWizard"}}
}
*/
?>
{
	response: {"error":false,"errorMsg":null,"data":{"functionToCall":"reloadUrl","options":{"html":""},"context":7}}
}

<?php } elseif($fail && !$finishnowsuccess){ ?>
{
	response: {"error":false,"errorMsg":null,"data":{"functionToCall":"renderDialog","options":{"dialogOptions":{"infoIcon":null,"saveOnUnload":false,"draggable":false,"buttonOk":false,"context":"smallestPackage"},"html":"\n<div id=\"smallestPackageDialog\">\nطلای کافی برای فعال کردن این ویژگی ندارید!\t<div Id=\"smallestPackageData\">\n\t<div class=\"goldProduct\" title=\"Choose package\">\n\t<input type=\"hidden\" class=\"goldProductId\" value=\"0\" \/>\n\t<div class=\"goldProductContentWrapper\">\n\t\t<div class=\"goldProductImageWrapper\">\n\t\t\t<img src=\"http:\/\/content.tg-payment.com\/content\/img\/products\/Travian_Facelift_Festnetz.png\" width=\"100\" height=\"114\" alt=\"Phone\" \/>\n\t\t<\/div>\n\t\t<div class=\"goldProductTextWrapper\">\n\t\t\t<div class=\"goldUnits\"><?php echo $AppConfig['plus']['packages'][0]['gold']; ?><\/div>\n\t\t\t<div class=\"goldUnitsTypeText\">طلا<\/div>\t\t\t<div class=\"footerLine\"><span class=\"price\"><?php echo $AppConfig['plus']['packages'][0]['cost']; ?>&nbsp<?php echo $AppConfig['plus']['packages'][0]['currency']; ?>&nbsp;*<\/span><\/div>\n\t\t<\/div>\n\t<\/div>\n<\/div>\t<\/div>\n\t<span class=\"buyGoldQuestion\">آیا میخواهید طلا بخرید؟<\/span>\n\t<div>\n\t\t<button  type=\"submit\" value=\"Purchase gold\" id=\"button5230a0fc85131\" class=\"green \" onclick=\"openPaymentWizard(true); return false;\">\n\t<div class=\"button-container addHoverClick\">\n\t\t<div class=\"button-background\">\n\t\t\t<div class=\"buttonStart\">\n\t\t\t\t<div class=\"buttonEnd\">\n\t\t\t\t\t<div class=\"buttonMiddle\"><\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t<\/div>\n\t\t<div class=\"button-content\">طلا بخرید<\/div>\n\t<\/div>\n<\/button>\n<script type=\"text\/javascript\">\n\twindow.addEvent('domready', function()\n\t{\n\tif($('button5230a0fc85131'))\n\t{\n\t\t$('button5230a0fc85131').addEvent('click', function ()\n\t\t{\n\t\t\twindow.fireEvent('buttonClicked', [this, {\"type\":\"submit\",\"value\":\"Purchase gold\",\"name\":\"\",\"id\":\"button5230a0fc85131\",\"class\":\"green \",\"title\":\"\",\"confirm\":\"\",\"onclick\":\"openPaymentWizard(true); return false;\"}]);\n\t\t});\n\t}\n\t});\n<\/script>\n\t<\/div>\n\t<a class=\"changeGoldPackage arrow\" href=\"#\" onclick=\"openPaymentWizard(false); return false;\">انتخاب یک بسته دیگر<\/a>\n\t<script>\n\n\tfunction openPaymentWizard(withPackage)\n\t{\n\t\tvar options = {callback: 'openPaymentWizardWithProsTab'};\n\t\tif(withPackage)\n\t\t{\n\t\t\toptions = Object.merge(options, {goldProductId: '0'});\n\t\t}\n\t\tTravian.Game.WayOfPaymentEventListener.WayOfPaymentObject.openPaymentWizard(options);\n\t}\n\t<\/script>\n<\/div>"}}}
}
<?php }  elseif($finishnowsuccess){ ?>
{
	response: {"error":false,"errorMsg":null,"data":{"functionToCall":"reloadUrl","options":{"html":""},"context":7}}
}
<?php } ?>