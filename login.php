<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}

include_once 'dbconnect.php';

if (isset($_POST['login'])) {

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT * FROM users WHERE email= '" . $email. "' and password = '" .$password. "'");

	if ($row = mysqli_fetch_array($result)) {
		
		
		header("Location:indexuser.php");
	} else {
		
       function myFunction() {
       alert("Wrong credentials");
		}

	}
}
?>

    
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
		.header-btn{
		    padding: 10px !important;
       		top: 4px;
}			
		.navbar-header li{
			padding:10px;
		}
		.header-part a:hover{
			background-color: transparent !important;
			border : 1px solid red;
			color : red !important;
			border-radius: 50px ;
			transition: all 0.3s;
			}		
	</style>
</head>
<body>
<div class="main-body" 	style="background-image: url('images/gym2.jpg');" >

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php" style="/*! top:  4px !important; */margin-top: 3%;">FITNESS WORLD</a>
		</div>
		
		<div class="header-part" id="navbar1">
			<ul class="nav navbar-header navbar-nav navbar-right">
				<li><a class="header-btn" href="register.php">Sign Up</a></li>

				<li><a class="header-btn" href="admin.php">Admin Panel</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row  login-main">
		<div class="col-md-4 col-md-offset-4 well">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<fieldset>
					<legend>Login</legend>
					
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" placeholder="Your Email" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Your Password" required class="form-control" />
					</div>

					<div class="form-group text-center">
						<input type="submit" name="login" value="Login" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center last-footer">
		New User? &nbsp;	
		 <a href="register.php" style="color: white"><button class="btn btn-info">Sign Up Here</button></a>
		</div>
	</div>
</div>
</div>


</body>
</html>
