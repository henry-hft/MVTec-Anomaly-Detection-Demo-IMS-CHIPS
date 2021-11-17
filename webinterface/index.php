<!DOCTYPE html>
<html>
<head>
<title>MVTec Anomaly Detection</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"><link rel="stylesheet" href="style.css">
</head>
<body>
<div class="global-container">
    <div class="card login-form">
        <div class="card-body">
		    <img class="image-center" src="logo_ims.png" alt="IMS CHIPS"> 
			<h1 class="card-title text-center">Edge AI Demo</h1>
            <h2 class="card-title text-center">MVTec Anomaly Detection</h2>
            <div class="card-text">
                <!--
            <div class="alert alert-danger alert-dismissible fade show" 
             role="alert">Incorrect username or password.</div> -->
                <form action="run.php" method="POST" enctype="multipart/form-data">
		
				 <div class="form-group">
    <label class="col-form-label col-form-label-lg" for="model">TensorFlow Lite Model</label>
    <select name="model" class="form-control form-control-lg" id="model">
      <option value="screws">Screws</option>
      <option>...</option>
      <option>...</option>
    </select>
  </div>
  
<div class="form-group">
    <label class="col-form-label col-form-label-lg" for="image">Image</label>
  <div class="custom-file">

    <input type="file" name="fileToUpload" class="custom-file-input form-control-lg">
    <label class="custom-file-label form-control-lg">Choose Image</label>
  </div>
</div>
                    <!-- to error: add class "has-danger" -->
                    <div class="form-group">
                        <label class="col-form-label col-form-label-lg" for="exampleInputLabel1">Label</label>
                        <input type="text" class="form-control form-control-lg form-control-sm" value="MVTec Anomaly Detection Demo" name="label" id="exampleInputLabel1">
                    </div>
									 <div class="form-group">
    <label name="device" class="col-form-label col-form-label-lg" for="device">Device(s)</label>
    <select class="form-control form-control-lg" name="device" id="device">
	  <option value="all">All</option>
      <option value="nano">NVIDIA Jetson NANO</option>
      <option value="coral">Google Coral DEV Board</option>
      
    </select>
  </div>
   <div class="form-group">
                    <button type="submit" name="btnSubmit" class="btn btn-primary btn-lg btn-block">Run</button>
  </div>
                  
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>