<?php
if($_GET['device'] == "nano" OR $_GET['device'] == "coral"){
$device = $_GET['device'];
if($_GET['method'] == "get"){
	$file = file_get_contents("devices/$device/status.txt");
	
	if(substr($file, 0, 1) == "1"){
		$image = substr($file, 1);
		echo $image;
	} else {
		echo "0";
	}
} else if($_GET['method'] == "update"){
	$entityBody = file_get_contents('php://input');
	file_put_contents("devices/$device/status.txt", "2$entityBody");
} else if($_GET['method'] == "read"){
	$file = file_get_contents("devices/$device/status.txt");
	if(substr($file, 0, 1) == "2"){
		//$result = substr($device, 2);
		$imageFile = file_get_contents("devices/$device/image.txt");
		$imageArr = explode("|", $imageFile);
		$image = $imageArr[0];
		$label = urlencode($imageArr[1]);
		if (strpos($file, 'damaged:') !== false) {
			$status = "damaged";
		} else if(strpos($file, 'ok:') !== false) {
			$status = "ok";
		} else {
			$status = "";
		}
		$split = explode(' ', $file);
		array_pop($split);
		$score = array_pop($split) * 100;
		$url = "http://444cf218-ed32-4b3d-81ce-7429e1231e99.ma.bw-cloud-instance.org/ims/mvtec/image.php?label=$label&device=$device&img=$image&status=$status&score=$score";
		echo $file;
		echo $url;
		file_put_contents("devices/$device/status.txt", "0");
	} else {
		echo "";
	}
}
}
?>