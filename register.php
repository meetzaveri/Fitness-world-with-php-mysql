<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}

include_once 'dbconnect.php';


$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password= mysqli_real_escape_string($con, $_POST['password']);
	$cpassword= mysqli_real_escape_string($con, $_POST['cpassword']);
	$address= mysqli_real_escape_string($con, $_POST['address']);
	$contact= mysqli_real_escape_string($con, $_POST['contact']);
	
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$name_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen ($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
 

	if (!$error) {
		if(mysqli_query($con, "INSERT INTO users(name,email,password,address,contact) VALUES('" . $name . "', '" . $email . "', '" .$password . "','" . $address . "','" . $contact . "')")) {
			$successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
		} else {
			$errormsg = "Error in registering...Please try again later!";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Registration Script</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/register.css">
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
		.footer{
			padding:0px;

		}			
	</style>
</head>
<body>
<div class="main-body" 	style="background-image: url('images/gym2.jpg'); background-repeat: no-repeat ;" >
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php" style="margin-top: 5%;">FITNESS WORLD</a>
		</div>
		<!-- menu items -->
		<div class="collapse header-part navbar-collapse" id="navbar1">
			<ul class="nav navbar-header navbar-nav navbar-right">
				<li><a class="login" href="login.php">Login</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row register" >
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Sign Up</legend>

					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Confirm Password</label>
						<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Address</label>
						<input type="text" name="address" placeholder="Address" required class="form-control" />
						<span class="text-danger"></span>
					</div>

					<div class="form-group">
						<label for="name">Contact</label>
						<input name="contact" placeholder="contact" type="text" maxlength="10" required class="form-control" pattern="[0-9]{10}" />
						<span class="text-danger"></span>
					</div>

					<div class="form-group text-center">
						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center footer">	
		Already Registered?&nbsp;<a href="login.php" style="color: white"><button class="btn btn-primary">Login Here</button></a>
		</div>
	</div>
</div>
</div>

</body>
</html>



