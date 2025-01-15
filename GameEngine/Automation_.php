<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
include("Automation.funcs/auctionComplete.php");
include("Automation.funcs/buildComplete.php");
include("Automation.funcs/celebrationComplete.php");
include("Automation.funcs/clearAndDeleting.php");
include("Automation.funcs/culturePoints.php");
include("Automation.funcs/demolitionComplete.php");
include("Automation.funcs/loyaltyRegeneration.php");
include("Automation.funcs/marketComplete.php");
include("Automation.funcs/MasterBuilder.php");
include("Automation.funcs/natarsJobs.php");
include("Automation.funcs/researchComplete.php");
include("Automation.funcs/returnunitsComplete.php");
include("Automation.funcs/sendAdventuresComplete.php");
include("Automation.funcs/sendreinfunitsComplete.php");
include("Automation.funcs/sendSettlersComplete.php");
include("Automation.funcs/sendunitsComplete.php");
include("Automation.funcs/trainingComplete.php");
include("Automation.funcs/updateHero.php");
include("Automation.funcs/zeroPopedVillages.php");
include("Automation.funcs/medals.php");
include("Automation.funcs/updateResource.php");

include("Automation.funcs/func/getPop.php");
include("Automation.funcs/func/getTypeLevel.php");
include_once("Technology.php");
$atime = time();
$winner = $database->hasWinner();if($winner){
} else {
	if(!file_exists("GameEngine/Prevention/1.txt")){fclose(fopen("GameEngine/Prevention/1.txt","w+"));auctionComplete();unlink("GameEngine/Prevention/1.txt");}
	if(!file_exists("GameEngine/Prevention/2.txt")){fclose(fopen("GameEngine/Prevention/2.txt","w+"));buildComplete();unlink("GameEngine/Prevention/2.txt");}
	if(!file_exists("GameEngine/Prevention/3.txt")){fclose(fopen("GameEngine/Prevention/3.txt","w+"));celebrationComplete();unlink("GameEngine/Prevention/3.txt");}
	if(!file_exists("GameEngine/Prevention/4.txt")){fclose(fopen("GameEngine/Prevention/4.txt","w+"));clearAndDeleting();unlink("GameEngine/Prevention/4.txt");}
	if(!file_exists("GameEngine/Prevention/5.txt")){fclose(fopen("GameEngine/Prevention/5.txt","w+"));culturePoints();unlink("GameEngine/Prevention/5.txt");}
	if(!file_exists("GameEngine/Prevention/6.txt")){fclose(fopen("GameEngine/Prevention/6.txt","w+"));demolitionComplete();unlink("GameEngine/Prevention/6.txt");}
	if(!file_exists("GameEngine/Prevention/7.txt")){fclose(fopen("GameEngine/Prevention/7.txt","w+"));loyaltyRegeneration();unlink("GameEngine/Prevention/7.txt");}
	if(!file_exists("GameEngine/Prevention/8.txt")){fclose(fopen("GameEngine/Prevention/8.txt","w+"));marketComplete();unlink("GameEngine/Prevention/8.txt");}
	if(!file_exists("GameEngine/Prevention/9.txt")){fclose(fopen("GameEngine/Prevention/9.txt","w+"));MasterBuilder();unlink("GameEngine/Prevention/9.txt");}
	if(!file_exists("GameEngine/Prevention/10.txt")){fclose(fopen("GameEngine/Prevention/10.txt","w+"));natarsJobs();unlink("GameEngine/Prevention/10.txt");}
	if(!file_exists("GameEngine/Prevention/11.txt")){fclose(fopen("GameEngine/Prevention/11.txt","w+"));researchComplete();unlink("GameEngine/Prevention/11.txt");}
	if(!file_exists("GameEngine/Prevention/12.txt")){fclose(fopen("GameEngine/Prevention/12.txt","w+"));returnunitsComplete();unlink("GameEngine/Prevention/12.txt");}
	if(!file_exists("GameEngine/Prevention/13.txt")){fclose(fopen("GameEngine/Prevention/13.txt","w+"));sendAdventuresComplete();unlink("GameEngine/Prevention/13.txt");}
	if(!file_exists("GameEngine/Prevention/14.txt")){fclose(fopen("GameEngine/Prevention/14.txt","w+"));sendreinfunitsComplete();unlink("GameEngine/Prevention/14.txt");}
	if(!file_exists("GameEngine/Prevention/15.txt")){fclose(fopen("GameEngine/Prevention/15.txt","w+"));sendSettlersComplete();unlink("GameEngine/Prevention/15.txt");}
	if(!file_exists("GameEngine/Prevention/16.txt")){fclose(fopen("GameEngine/Prevention/16.txt","w+"));sendunitsComplete();unlink("GameEngine/Prevention/16.txt");}
	if(!file_exists("GameEngine/Prevention/17.txt")){fclose(fopen("GameEngine/Prevention/17.txt","w+"));trainingComplete();unlink("GameEngine/Prevention/17.txt");}
	if(!file_exists("GameEngine/Prevention/18.txt")){fclose(fopen("GameEngine/Prevention/18.txt","w+"));updateHero();unlink("GameEngine/Prevention/18.txt");}
	if(!file_exists("GameEngine/Prevention/19.txt")){fclose(fopen("GameEngine/Prevention/19.txt","w+"));zeroPopedVillages();unlink("GameEngine/Prevention/19.txt");}
	if(!file_exists("GameEngine/Prevention/20.txt")){fclose(fopen("GameEngine/Prevention/20.txt","w+"));medals();unlink("GameEngine/Prevention/20.txt");}
}
?>
