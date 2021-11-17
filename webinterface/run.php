<!DOCTYPE html>
<html>
<head>
<title>MVTec Anomaly Detection</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"><link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="script.js"></script>
</head>
<body>
<div class="global-container">
    <div class="card login-form">
        <div class="card-body">
		    <a href="index.php"> <img class="image-center" src="logo_ims.png" alt="IMS CHIPS"> </a>
			<h1 class="card-title text-center">Edge AI Demo</h1>
            <h2 class="card-title text-center">MVTec Anomaly Detection</h2>
            <div class="card-text">
               <?php
if (isset($_POST["btnSubmit"])){
				$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
   // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
   // echo "File is not an image.";
    $uploadOk = 0;
  }

// Check if file already exists
if (file_exists($target_file)) {
  echo '<div class="alert alert-danger" role="alert">File already exists.</div>';
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
  echo '<div class="alert alert-danger" role="alert">Your file is too large.</div>';
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo '<div class="alert alert-danger" role="alert">Only JPG, JPEG, PNG & GIF files are allowed.</div>';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo '<div class="alert alert-danger" role="alert">There was an error uploading your file. Please try again</div>';
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	 echo '<div class="alert alert-primary" role="alert">The image has been successfully uploaded.</div>';

	 $label = $_POST['label'];
	 $model = $_POST['model'];
	 $device = $_POST['device'];
	 
	 $file = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
	 $imageFile = "$file|$label";
	 
	 if($device == "all"){
		 $deviceArr = array("nano", "coral");
	 } else {
		 $deviceArr = array($device);
	 }
	 
	 foreach ($deviceArr as &$value) {
		  echo '<br><br><br><div class="container">';
		 if($value == "nano"){
			 echo "<h2>Nvidia Jetson Nano (4GB RAM)</h2>";
		 } else if($value == "coral"){
			 echo "<h2>Google Coral DEV Board (4GB RAM)</h2>";
		 }
		 
  echo '<br><br><div class="row">
    <div class="col-1"> </div>
    <div class="col-5">
	<img src="uploads/'.$file.'" alt="'.$file.'" width="256px" height="256px">
    </div>
    <div class="col-5">
	<img id="'.$value.'-image" src="loading.gif" alt="Processing..." width="256px" height="256px">
    </div>
    <div class="col-5"> </div>
  </div>
</div><br><br>
  <div id="'.$value.'-result"></div>';
	 }
	 
	 
	 
	 $coral = file_get_contents("devices/coral/status.txt");
	 $nano = file_get_contents("devices/nano/status.txt");
	 if($device == "all"){
		 if(substr($coral, 0, 1) == "0" AND substr($nano, 0, 1) == "0"){
			file_put_contents("devices/coral/image.txt", $imageFile);
			file_put_contents("devices/nano/image.txt", $imageFile);			
			file_put_contents("devices/coral/status.txt", "1$file");
			file_put_contents("devices/nano/status.txt", "1$file");
			echo '<script language="javascript">generate("coral"); generate("nano");</script>';
		 } else {
			 echo '<div class="alert alert-danger" role="alert">Device(s) already in use.</div>';
		 }
	 } else if($device == "nano"){
		if(substr($nano, 0, 1) == "0"){
			file_put_contents("devices/nano/image.txt", $imageFile);		
			file_put_contents("devices/nano/status.txt", "1$file");
			echo '<script language="javascript">generate("nano");</script>';
		 } else {
			 echo '<div class="alert alert-danger" role="alert">Device already in use.</div>';
		 }
	 } else if($device == "coral"){
		if(substr($coral, 0, 1) == "0"){
			file_put_contents("devices/coral/image.txt", $imageFile);		
			file_put_contents("devices/coral/status.txt", "1$file");
			echo '<script language="javascript">generate("coral");</script>';
		 } else {
			 echo '<div class="alert alert-danger" role="alert">Device already in use.</div>';
		 }
	 }
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	
  } else {
    echo '<div class="alert alert-danger" role="alert">There was an error uploading your file. Please try again</div>';
  }
}
}
			   ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>