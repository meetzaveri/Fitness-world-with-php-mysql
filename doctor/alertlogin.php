

<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
	header("Location: ../../index.php");
}

include_once 'dbconnect.php';


if (isset($_POST['submit'])) {

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT * FROM doctor_view WHERE email_id = '" . $email. "' and password = '" .$password. "' and emp_id = 'doc101' ");

	if ($row = mysqli_fetch_array($result)) {
		
		
		header("Location: ../indexdoc.php");
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
	<title>Doctor Login</title>
</head>
<body >
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div style="width:400px; height:450px; border:1px solid white; margin:auto; margin-top:50px; background: url('bck.png'); ">
	<img src="logo.png" width="100px" height="60px" style="margin-left:140px;">
	<img src="logi2.png" width="55px" height="50px" style="margin-left:-80px;  position: absolute; ">
	
	<h1 style="margin-left:100px; font-family: Aldhabi; font-size: 60px; font-weight: 5px;  margin-top: -5px; color: #000000; position:absolute;">Doctor-Login</h1>
	<h2 style="color:#000000; font-family: calibiri; font-size:15px; font-weight: 5px; margin-left:30px; margin-top: 100px; width: 150px; ">Email</h2>
	<input type="text" name="email" required="required" style=" background: #D6BFD2; border:1px solid orange; outline: none; margin-left: 30px; width: 340px; height: 30px; padding: 5px; " >
	<h2 style="color:#000000; font-family: calibiri; font-size:15px; font-weight: 5px; margin-left:30px; margin-top: 30px; width: 150px; ">Password</h2>
	<input type="password" name="password" required="" style=" background:#D6BFD2; border:1px solid orange; outline: none; margin-left: 30px; width: 340px; height: 30px; padding: 5px; " >
	<input type="submit" name="submit" value="Go"  style=" background: #BF08AA;  border-radius:25px ;outline: none; margin-left: 130px; width: 150px; height: 40px ; margin-top: 40px; font-size:20px; color:white;" >
	</form>
</div>
</body>
</html>