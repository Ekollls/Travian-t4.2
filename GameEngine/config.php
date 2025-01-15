<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/

//////////////////////////////////
// *****  ERROR REPORTING  *****//
//////////////////////////////////
// (E_ALL ^ E_NOTICE) = enabled
// (0) = disabled
//ini_set('display_errors', 1);
// error_reporting (E_ALL ^ E_NOTICE);


date_default_timezone_set("Asia/Tehran");

if(file_exists(dirname(__FILE__).'/Database/connection.php')){
	include_once(dirname(__FILE__)."/Database/connection.php");
} elseif(file_exists(dirname(__FILE__).'/connection.php')){
	include_once(dirname(__FILE__)."/connection.php");
} else {
	die('Server is not ready to connect,wait...');
}
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
$sql = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$result = mysql_fetch_array($sql);

define('DEVEL_MODE','0');

//////////////////////////////////
/////// قیمت های سکه ی طلا ///////
/////////// به تومان ///////////
///////////////////////////////
define("TALA_100","5,000");
define("TALA_250","9,000");
define("TALA_500","16,000");
define("TALA_1200","28,000");
define("TALA_3200","50,000");

//////////////////////////////////
///////// آیدی مدیر فروش ////////
/////////// Yahoo!ID ///////////
///////////////////////////////
define("SALES_ID","westehran");


//////////////////////////////////
// *****  SERVER SETTINGS  *****//
//////////////////////////////////

// ***** Name
define("SERVER_NAME",$result['server_name']);

// ***** Serial
//define("SERIAL","%SERIAL%"); اقا مهران و لایسنسش :))

// ***** Yahoo ID
define("YID",$result['yid']);

// ***** Some other
define("OW", $result['ow']);
define("HELP_MAX", $result['maxhelp']);


// ***** Started
// Defines when has server started.
define("COMMENCE",$result['commence']);

// ***** Language
// Choose your server language.
define("LANG",$result['lang']);

// ***** Speed
// Choose your server speed. NOTICE: Higher speed, more likely
// to have some bugs. Lower speed, most likely no major bugs.
// Values: 1 (normal), 3 (3x speed) etc...
define("SPEED", $result['speed']);

// ***** Round lenght
// Choose your server Round lenght.
// Values: 365 (normal), 122 (3x speed) etc...
define("ROUNDLENGHT", $result['roundlenght']);

// ***** World Wonder done moment
define("WINMOMENT", $result['winmoment']);

// ***** World size
// Defines world size. NOTICE: DO NOT EDIT!!
define("WORLD_MAX", "100");
define("NATARS_MAX", $result['natars_max']);

// ***** Graphic Pack
// True = enabled, false = disabled
//!!!!!!!!!!!! DO NOT ENABLE !!!!!!!!!!!!
define("GP_ENABLE",false);
// Graphic pack location (default: gpack/travian_basic/)
define("GP_LOCATE", $result['gp_locate']);

// ***** Troop Speed
// Values: 1 (normal), 3 (3x speed) etc...
define("INCREASE_SPEED",$result['increase']);

// ***** Hero Power Speed
// Values: 1 (normal), 3 (3x speed) etc...
define("HEROATTRSPEED",$result['heroattrspeed']);

// ***** Item Power Speed
// Values: 1 (normal), 3 (3x speed) etc...
define("ITEMATTRSPEED",$result['itemattrspeed']);

// ***** Change storage capacity
define("STORAGE_MULTIPLIER",$result['storagemultiplier']);
define("ZMULTIPLIER",$result['zmultiplier']);
define("STORAGE_BASE",800*STORAGE_MULTIPLIER);
define("REWARD_MULTIPLIER",1);
// ***** Village Expand
// 1 = slow village expanding - more Cultural Points needed for every new village
// 0 = fast village expanding - less Cultural Points needed for every new village
define("CP", 1);

// ***** Demolish Level Required
// Defines which level of Main building is required to be able to
ignore_user_abort(true);
// demolish. Min value = 1, max value = 20
// Default: 10
define("DEMOLISH_LEVEL_REQ", $result['demolish_lvl']);

// ***** Quest
// Ingame quest enabled/disabled.
if($result['taskmaster']==1){ $quest = true; }else{ $quest = false; }
define("QUEST",$quest);

// ***** Beginners Protection
// 3600 = 1 hour
// 3600*12 = 12 hours
// 3600*24 = 1 day
// 3600*24*3 = 3 days
// You can choose any value you want!
define("MINPROTECTION",$result['minprotecttime']);
define("MAXPROTECTION",$result['maxprotecttime']);
define("AUCTIONTIME",$result['auctiontime']);
define("MEDALINTERVAL",$result['medalinterval']);

// ***** Enable WW Statistics
if($result['ww']==1){ $ww = true; }else{ $ww = false; }
define("SHOWWW2",$ww);

// ***** Activation Mail
// true = activation mail will be sent, users will have to finish registration
//        by clicking on link recieved in mail.
// false =  users can register with any mail. Not needed to be real one.
if($result['auth_email']==1){ $auth_email = true; }else{ $auth_email = false; }
define("AUTH_EMAIL",$auth_email);

// ***** PLUS
//Plus account lenght
define("PLUS_TIME",$result['plus_time']);
//+25% production lenght
define("PLUS_PRODUCTION",$result['plus_prodtime']);
// ***** Great Workshop
define("GREAT_WKS",$result['great_wks']);
// ***** Tourn threshold
define("TS_THRESHOLD",$result['ts_threshold']);  

//cage number
define("CAGE_NUMBER",$result['cages']);

//building level
define("B_LEVEL",$result['blevel']);

//////////////////////////////////
//    **** LOG SETTINGS  ****   //
//////////////////////////////////
// LOG BUILDING/UPGRADING
if($result['log_build']==1){ $log_build = true; }else{ $log_build = false; }
define("LOG_BUILD",$log_build);
// LOG RESEARCHES
if($result['log_tech']==1){ $log_tech = true; }else{ $log_tech = false; }
define("LOG_TECH",$log_tech);
// LOG USER LOGIN (IP's)
if($result['log_login']==1){ $log_login = true; }else{ $log_login = false; }
define("LOG_LOGIN",$log_login);
// LOG GOLD
if($result['log_gold']==1){ $log_gold = true; }else{ $log_gold = false; }
define("LOG_GOLD_FIN",$log_gold);
// LOG ADMIN
if($result['log_admin']==1){ $log_admin = true; }else{ $log_admin = false; }
define("LOG_ADMIN",$log_admin);
// LOG ATTACK REPORTS
if($result['log_war']==1){ $log_war = true; }else{ $log_war = false; }
define("LOG_WAR",$log_war);
// LOG MARKET REPORTS
if($result['log_market']==1){ $log_market = true; }else{ $log_market = false; }
define("LOG_MARKET",$log_market);
// LOG ILLEGAL ACTIONS
if($result['log_illegal']==1){ $log_illegal = true; }else{ $log_illegal = false; }
define("LOG_ILLEGAL",$log_illegal);



//////////////////////////////////
// ****  NEWSBOX SETTINGS  **** //
//////////////////////////////////
//true = enabled
//false = disabled
if($result['newsbox1']==1){ $newsbox1 = true; }else{ $newsbox1 = false; }
if($result['newsbox2']==1){ $newsbox2 = true; }else{ $newsbox2 = false; }
if($result['newsbox3']==1){ $newsbox3 = true; }else{ $newsbox3 = false; }

define("NEWSBOX1",$newsbox1);
define("NEWSBOX2",$newsbox2);
define("NEWSBOX3",$newsbox3);


////////////////////////////////////
//   ****  EXTRA SETTINGS  ****   //
////////////////////////////////////

// ***** Censore words
//define("WORD_CENSOR", "%ACTCEN%");

// ***** Words (censore)
// Choose which words do you want to be censored
//define("CENSORED","%CENWORDS%");


// ***** Limit Mailbox
// Limits mailbox to defined number of mails. (IGM's)
define("LIMIT_MAILBOX",false);
// If enabled, define number of maximum mails.
define("MAX_MAIL","30");

// ***** Include administrator in statistics/rank
define("INCLUDE_ADMIN", false);

// ***** Register Open/Close
define("REG_OPEN", true);

// ***** Peace system
// 0 = None
// 1 = Normal
// 2 = Christmas
// 3 = New Year
// 4 = Easter
define("PEACE",0);

////////////////////////////////////
//   ****  ADMIN SETTINGS  ****   //
////////////////////////////////////

// ***** Admin Email
define("ADMIN_EMAIL", $result['admin_email']);

// ***** Admin Name
define("ADMIN_NAME", "");



//////////////////////////////////////////
//   ****  DO NOT EDIT SETTINGS  ****   //
//////////////////////////////////////////
define("TRACK_USR","0");
define("USER_TIMEOUT","30"); 
define("ALLOW_BURST",false);
define("BASIC_MAX",1);
define("INNER_MAX",1);
define("PLUS_MAX",1);
define("ALLOW_ALL_TRIBE",true);
define("CFM_ADMIN_ACT",true);
define("SERVER_WEB_ROOT",false);
define("USRNM_SPECIAL",false);
define("USRNM_MIN_LENGTH",3);
define("PW_MIN_LENGTH",4);
define("BANNED",0);
define("AUTH",1);
define("USER",2);
define("MULTIHUNTER",8);
define("ADMIN",9);
define("COOKIE_EXPIRE", 60*60*24*7); 
define("COOKIE_PATH", "/"); 


////////////////////////////////////////////
//   ****  DOMAIN/SERVER SETTINGS  ****   //
////////////////////////////////////////////
define("DOMAIN", $result['domain_url']);
define("HOMEPAGE", $result['homepage_url']);
define("SERVER", $result['server_url']);

define('TRAPPED_FREEKILL_PORTION',1/3);
define('TRAP_MIN_EFFECT',0.6);
define('TRAP_MAX_EFFECT',1.0);

define('ANCINVITEPOP',250);
define('ANCINVITEGOLD',60);
define('ANCINVITEMAXCOUNT',15);
?>
