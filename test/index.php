<?php
	header("Content-Type:image/png");

	$img = imagecreate(50, 25);

	$back = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);

	$red = imagecolorallocate($img, 255, 0, 0);


	$str = getRandom(4) ;
	imagestring($img, 5, 7, 5, $str, $red);

	imagepng($img);

	imagedestroy($img);


	function getRandom($len) {
		$base = "1234567890";
		mt_srand();
		$res = '';
		for($i=0;$i<$len;$i++) {
			$res .= $base[mt_rand(0,9)];
		}
		return $res;
	}