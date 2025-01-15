<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me :
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
header('Content-type: image/png');
echo file_get_contents('map_mark.png');exit();
/////////////////////////////////
include("GameEngine/Protection.php");
include("GameEngine/Village.php");

// /map_block.php?tx0=-50&ty0=120&tx1=-41&ty1=129&w=600&h=600&version=62

// Make the main image
//$img = imagecreate($_GET['w'],$_GET['h']);
$img = imagecreatefrompng('map_mark.png');
/*
// Add block backgrounds
$blocks = array('t1','t2','t3','t4','t5','t6','t7','t8','t9','t10','t7','t8','t9','t10');
$x = 0;
$y = 0;
$n = 0;
foreach($blocks as $block) {
	$img_type = $block;
	$img_block = imagecreatefromgif('img/m/'. $img_type .'.gif');
	imagecopyresized($img, $img_block, $x, $y, 0, 0, $_GET['w']/10, $_GET['h']/10, 60, 60);
	imagedestroy($img_block);
	$x += $_GET['w']/10;
	$n++;
	if( $n % 10 == 0 ) { $y += $_GET['h']/10;$x = 0; };
	//bool imagecopy ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h )
}
// Add blocks 
$blocks = array('o1','o2','o3','o4','o5','o6','o7','o8','o9','o10','o7','o8','o9','o10');
$x = 0;
$y = 0;
$n = 0;
foreach($blocks as $block) {
	$img_type = $block;
	$img_block = imagecreatefromgif('img/m/'. $img_type .'.gif');
	imagecopyresized($img, $img_block, $x, $y, 0, 0, $_GET['w']/10, $_GET['h']/10, 60, 60);
	imagedestroy($img_block);
	$x += $_GET['w']/10;
	$n ++;
	if( $n % 10 == 0 ) { $y += $_GET['h']/10;$x = 0; };
	//bool imagecopy ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h )
}
*/
// Output...
header('Content-type: image/png');
imagepng($img);
imagedestroy($img);
?>
