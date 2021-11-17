<?php
$img = $_GET['img'];
$filename = "uploads/$img";
header("Content-type: image/png");
$string = $_GET['label'];
list($width, $height) = getimagesize($filename);
$new_width = 256;
$new_height = 256;
$im_p = imagecreatetruecolor($new_width, $new_height);
$im = imagecreatefrompng($filename);
imagecopyresampled($im_p, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
$black = imagecolorallocate($im_p, 0, 0, 0);
$green = imagecolorallocate($im_p, 0, 200, 0);
$red = imagecolorallocate($im_p, 255, 0, 0);
//$px = (imagesx($im_p) - 7.5 * strlen($string)) / 2;
$score = $_GET['score'];
if($_GET['status'] == "ok"){
	imagestring($im_p, 5, 2, 9, $string, $green);
	$result = "OK: $score%";
	imagestring($im_p, 5, 2, 30, $result, $green);
} else if ($_GET['status'] == "damaged") {
	imagestring($im_p, 5, 2, 9, $string, $red);
	$result = "DAMAGED: $score%";
	imagestring($im_p, 5, 2, 30, $result, $red);
}
if($_GET['device'] == "coral"){
	$logo = imagecreatefrompng("coral.png");
} else if($_GET['device'] == "nano"){
	$logo = imagecreatefrompng("nvidia.png");
} else {
	$logo = imagecreatefrompng("ims-logo.png");
}

imagecopy($im_p, $logo, 0, 227, 0, 0, imagesx($logo), imagesy($logo));
imagepng($im_p, null, 0);
imagedestroy($im_p);

?>