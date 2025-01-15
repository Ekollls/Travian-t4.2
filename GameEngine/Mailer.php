<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

class Mailer {
	
	function sendActivate($email,$username,$pass,$act) {
		
	$subject = "به ".SERVER_NAME." خوش آمدید!";
	$message = "سلام ".$username.",

خوشحالیم که در سرور ما ثبت نام کرده اید!

<strong>اطلاعات اکانت</strong>
----------------------------
نام کاربری: ".$username."
کلمه عبور: ".$pass."
کد فعالسازی: ".$act."
----------------------------

یا می توانید از طریق لینک زیر اکانت خود را فعال کنید:
".SERVER."/activate.php?code=".$act."

با احترام,
مدیریت سرور";

		$headers = "From: ".ADMIN_EMAIL."\n";
		
	mail($email, $subject, $message, $headers);
	}
	
	function sendInvite($email,$uid,$text) {

		$subject = "".SERVER_NAME." registeration";

		$message = "Hi, This is an invitation to Travian from one of your friends who is currently playing in this word. Come and Try the new ".SERVER_NAME."! Link: ".SERVER."/anmelden.php?anc=".$uid."Greetings,Travian";

		$headers = "From: ".ADMIN_EMAIL."\n";

		mail($email, $subject, $message, $headers);
	}
	
	
	function sendPassword($email,$uid,$username,$npw,$cpw) {

		$subject = "Password forgotten";

		$message = "Hello ".$username."

You have requested a new password for Travian.

Please click this link to activate your new password. The old password then
becomes invalid:

http://${_SERVER['HTTP_HOST']}/password.php?cpw=$cpw&npw=$uid


----------------------------
Name: ".$username."
Password: ".$npw."
----------------------------

If you want to change your new password, you can enter a new one in your profile
on tab \"account\".

In case you did not request a new password you may ignore this email.

Travian
";

		$headers = "From: ".ADMIN_EMAIL."\n";

		mail($email, $subject, $message, $headers);
	}

};

$mailer = new Mailer;
?>
