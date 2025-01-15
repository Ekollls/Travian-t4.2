<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("../GameEngine/config.php");
unlink(dirname(dirname(dirname(__FILE__)))."/GameEngine/Prevention/Automation.log");
unlink(dirname(dirname(dirname(__FILE__)))."/GameEngine/Prevention/Automation.pid");
fclose(fopen(dirname(dirname(dirname(__FILE__)))."/GameEngine/Prevention/Automation.log","w"));
fclose(fopen(dirname(dirname(dirname(__FILE__)))."/GameEngine/Prevention/Automation.pid","w"));
?>
<div id="content" class="login">
<!--<br>
&nbsp;&nbsp; درحال شروع اتوماسیون<br>
--><?php
//$cmd = dirname(__FILE__)."/../../GameEngine/Automation.php --start";
//exec($cmd, $output, $result);
//var_dump($output);
//echo PHP_EOL;
//var_dump($result);

$time = time();
rename("../install/","../installed_".$time);
?>
<br><br>
مراحل نصب با موفقیت طی شد.<br>
به منظور امنیت بیشتر, نام پوشه نصب تغییر یافت.<br>
فایل config.php نوشته شد.<br><br>
<br /><br />

<div align="center"><font size="4"><a href="<?php echo HOMEPAGE; ?>">تراوین من</font></a>
</div></div>
