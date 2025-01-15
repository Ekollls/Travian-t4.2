<?php
$config = mysql_query("SELECT * FROM ".TB_PREFIX."config");
$config = mysql_fetch_array($config);

$AppConfig = array (

	'plus'			=> array (
		'packages'	=> array (
			array ( 
				'id' 		  => 1,
				'name'		=> 'بسته A',
				'gold'		=> 30,
				'cost'		=> 1000,
				'currency'	=> 'تومان',
				'image'		=> 'package_a.jpg'
			),
			array ( 
				'id' 		  => 2,
				'name'		=> 'بسته B',
				'gold'		=> 100,
				'cost'		=> 4000,
				'currency'	=> 'تومان',
				'image'		=> 'package_b.jpg'
			),
			array ( 
				'id' 		  => 3,
				'name'		=> 'بسته C',
				'gold'		=> 250,
				'cost'		=> 8500,
				'currency'	=> 'تومان',
				'image'		=> 'package_c.jpg'
			),
			array ( 
				'id' 		  => 4,
				'name'		=> 'بسته D',
				'gold'		=> 800,
				'cost'		=> 16500,
				'currency'	=> 'تومان',
				'image'		=> 'package_d.jpg'
			),
			array ( 
				'id' 		  => 5,
				'name'		=> 'بسته E',
				'gold'		=> 2500,
				'cost'		=> 45000,
				'currency'	=> 'تومان',
				'image'		=> 'package_e.jpg'
			),
		
		),
		'payments' => array (
/*			'cashu'	=> array (
				'testMode'		=> FALSE,
				'name'			=> ' پرداخت از طريق شتاب',
				'image'			=> 'cashu.gif',
				'serviceName'    	=> 'tatar.dboor',
				'merchant_id'   	=> '50c9abb0-b27c-4c96-963a-6ed35ee8aeb5',
				'key'			=> '5248910',
				'returnKey'		=> '548fhmr847470',
				'currency'		=> 'rials'
			),
*/            
          'payline'       => array (
				'name'			=> 'درگاه پی لاین',
				//'test'			=>	true,
				'test'			=>	false,
				'image'			=> 'payline.png',
				'start'			=>	'Gateways/payline/start.php',
				//'api'			=>	'adxcv-zzadq-polkjsad-opp13opoz-1sdf455aadzmck1244567',
				'api'			=>	'',
				'return'		=>	$config['server_url'].'/Gateways/payline/check.php'
			)
			
		)
	)
);
?>