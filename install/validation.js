function setCookie( name, value, expires, path, domain, secure ) {
	var today = new Date();
	today.setTime( today.getTime() );
	if ( expires ) {
		//expires = expires * 1000 * 60 * 60 * 24;
	}
	var expires_date = new Date( today.getTime() + (expires) );
	document.cookie = name+'='+escape( value ) +
		( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) + //expires.toGMTString()
		( ( path ) ? ';path=' + path : '' ) + 
		( ( domain ) ? ';domain=' + domain : '' ) +
		( ( secure ) ? ';secure' : '' );
}
function validate() {
	setCookie("serial",j$("#serial").val());
	j$("#cnt").fadeIn(500);
	j$("#status").html("در حال ارسال درخواست...");
	j$.ajax({
		url:"http://t4dl.ir/validate.php",
		data:{"function":"validate","serial":j$("#serial").val()},
		type:"GET",
		dataType:"json",
		success: function(resp) {
			if(resp.status == "valid") {
				var date = resp.date;
				var cust = resp.customer;
				j$("#status").html('سریال <b>معتبر</b> بود. ممنون از اینکه محصول ما را تهیه کرده اید!<br>سریال وارد شده در تاریخ <b>'+date+'</b> توسط "<b>'+cust+'</b>" خریداری شده است.');
				
				j$(".rbox").fadeIn(500);
			}else{
				j$("#status").html("سریال وارد شده معتبر نمی باشد.");
			}
			
			
			
		}
	})
	
	
	
	
	
	
}