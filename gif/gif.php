<?php
include 'GIFencode.class.php';
include 'TimeZone.class.php';
include 'Config.class.php';
include 'Theme.class.php';

/**
 * 1.时区列表
 * 2.get参数 time，theme，timezone(时区),$delay（milliseconds微妙）
 */
//var_dump($_GET['p']);die;
//$time = '2020-04-14 12:00:00';


///时区转换
$zone = empty($_GET['timezone']) ? 0 : $_GET['timezone'] ;//时区
$timeZone = new TimeZone();
$timezone = $timeZone->get_time_zone($zone);
date_default_timezone_set($timezone);

//参数获取
$time = isset($_GET['time']) ? $_GET['time'] : date('Y-m-d H:i:s',time()); //截止时间
$theme = isset($_GET['theme']) ? $_GET['theme'] : THEME_DEFAULT ;//主题类型
$delay = isset($_GET['delay']) ?  (int) $_GET['delay'] : DELAY_DEFAULT;//执行微秒数（milliseconds）

$themes = new Theme();
$th = $themes->get_theme($theme);


$future_date = new DateTime(date('r',strtotime($time)));
$time_now = time();
$now = new DateTime(date('r', $time_now));

$frames = array();
$delays = array();


$image = imagecreatefrompng($th);
//$delay = 100; // milliseconds
$font = array(
	'size'=>40,
	'angle'=>0,
	'x-offset'=>10,
	'y-offset'=>64,
	'file'=>'Digitaldream.ttf',
	'color'=>imagecolorallocate($image, 255, 255, 255),
);
for($i = 0; $i <= 60; $i++){
	$interval = date_diff($future_date, $now);
	if($future_date < $now){
		// Open the first source image and add the text.
		$image = imagecreatefrompng($th);
		$text = $interval->format('00:00:00:00');
		imagettftext ($image , $font['size'] , $font['angle'] , $font['x-offset'] , $font['y-offset'] , $font['color'] , realpath($font['file']), $text );
		ob_start();
		imagegif($image);
		$frames[]=ob_get_contents();
		$delays[]=$delay;
        $loops = 1;
		ob_end_clean();
		break;
	} else {
		// Open the first source image and add the text.
		$image = imagecreatefrompng($th);
		$text = $interval->format('%a:%H:%I:%S');
		// %a is weird in that it doesn’t give you a two digit number
		// check if it starts with a single digit 0-9
		// and prepend a 0 if it does
		if(preg_match('/^[0-9]\:/', $text)){
			$text = '0'.$text;
		}
		imagettftext ($image , $font['size'] , $font['angle'] , $font['x-offset'] , $font['y-offset'] , $font['color'] , realpath($font['file']), $text );
		ob_start();
		imagegif($image);
		$frames[]=ob_get_contents();
		$delays[]=$delay;
        $loops = 0;
		ob_end_clean();
	}
	$now->modify('+1 second');
}
//expire this image instantly
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' ); 
$gif = new AnimatedGif($frames,$delays,$loops);
$gif->display();
?>

