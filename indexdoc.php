<?php
session_start();
include_once 'dbconnect.php';
?>
<?php

  error_reporting( ~E_NOTICE ); // avoid notice
  
  require_once 'dbconfig.php';
  
  if(isset($_POST['btnsave']))
  {
    $username = $_POST['user_name'];// user name
    $userjob = $_POST['user_job'];// user email
    
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];
    
    
    if(empty($username)){
      $errMSG = "Please Enter Username.";
    }
    else if(empty($userjob)){
      $errMSG = "Please Enter Your Job Work.";
    }
    else if(empty($imgFile)){
      $errMSG = "Please Select Image File.";
    }
    else
    {
      $upload_dir = 'user_report/'; // upload directory
  
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
      // valid image extensions
      $valid_extensions = array('docx','pdf'); // valid extensions
    
      // rename uploading image
      $userpic = rand(1000,1000000).".".$imgExt;
        
      // allow valid image file formats
      if(in_array($imgExt, $valid_extensions)){     
        // Check file size '5MB'
        if($imgSize < 5000000)        {
          move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
        else{
          $errMSG = "Sorry, your file is too large.";
        }
      }
      else{
        $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";    
      }
    }
    
    
    // if no error occured, continue ....
    if(!isset($errMSG))
    {
      $stmt = $DB_con->prepare('INSERT INTO tbl_users(userName,userReport,userPic) VALUES(:uname, :ujob, :upic)');
      $stmt->bindParam(':uname',$username);
      $stmt->bindParam(':ujob',$userjob);
      $stmt->bindParam(':upic',$userpic);
      
      if($stmt->execute())
      {
        $successMSG = "new record succesfully inserted ...";
        header("refresh:5;report.php"); // redirects image view page after 5 seconds.
      }
      else
      {
        $errMSG = "error while inserting....";
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor's Page</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
 <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
  <link rel="stylesheet" type="text/css" media="screen" href="css/grid_12.css">
  <link rel="stylesheet" type="text/css" media="screen" href="css/slider.css">
<script src="js/jquery-1.7.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/tms-0.3.js"></script>
<script src="js/tms_presets.js"></script>
<script src="js/cufon-yui.js"></script>
<script src="js/Asap_400.font.js"></script>
<script src="js/Coolvetica_400.font.js"></script>
<script src="js/Kozuka_M_500.font.js"></script>
<script src="js/cufon-replace.js"></script>
<script src="js/FF-cash.js"></script>

 




</head>
<body>
<div class="container-fluid"> 
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			
			<a class="navbar-brand" href="indexdoc.php"><h2>FITNESS WORLD</h2></a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
		
				<li><a href="logout.php" style="margin-top: 24%;"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
		
			
   
	
			</ul>
		</div>
  <hr style="border: 1px solid rgba(0,0,0,0.7) !important;color: #000000;">
		<div class="main">

  <!--==============================header=================================-->

  <header>
    
    
    <nav>
     
      <ul class="menu">
     
      

       
      </ul>
    </nav>
    </nav>
  </header>
  <!--==============================content================================-->
  <div>
    
<div class="container">


  <div class="page-header">
      <h1 class="h2">add new user. <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
    </div>
    

  <?php
  if(isset($errMSG)){
      ?>
            <div class="alert alert-danger">
              <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
  }
  else if(isset($successMSG)){
    ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
  }
  ?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
      
  <table class="table table-bordered table-responsive">
  
    <tr>
      <td><label class="control-label">Username.</label></td>
        <td><input class="form-control" type="text" name="user_name" placeholder="Enter Username" value="<?php echo $username; ?>" /></td>
    </tr>
    
    <tr>
      <td><label class="control-label">Report Name</label></td>
        <td><input class="form-control" type="text" name="user_job" placeholder="Your Report Name" value="<?php echo $userjob; ?>" /></td>
    </tr>
    
    <tr>
      <td><label class="control-label">File</label></td>
        <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; save
        </button>
        </td>
    </tr>
    
    </table>
    
</form>
  </div>
  <!--==============================footer=================================-->
  <footer>
    <p>© 2017 Fitness World</p>
    <p>Website by <a target="_blank" href="#" class="link">CS Boys</a></p>
  </footer>
</div>
	</div>

</div>

</body>
</html>

