<!DOCTYPE html>
<html>
<head>
	<title>Student Portal</title>
</head>
	<link rel="stylesheet" type="text/css" href="styles/logstyle.css">
<body>

	<div class="header">
		<h1>School Management System</h1>
		<h2 style="left: 38%">Student Login Portal</h2>
	</div>

	<div class="container">
		
		<form class="loginform" action="stulogin.php" method="post">
			<input type="number" name="id" placeholder="ID" required>
			
			<input type="password" name="password" placeholder="Password" required>
			<br>
			<button type="submit" name="login">Login</button>

		</form>

		<div>
			
			<label>Not an user? <a href="registration.php"><b>Register Now!</b></a></label>
		</div>
	</div>

<?php 
	session_start();
	$conn = mysqli_connect('localhost','root','','project');
	if (isset($_POST['login'])) {
	$username = $_POST['id'];
	$password = $_POST['password'];

	$users = mysqli_query($conn,"SELECT * FROM students WHERE id=$username");
	

	if (mysqli_num_rows($users)!=0) {
		$user = mysqli_fetch_object($users);

	if ($username== $user->id && $password==$user->password) {
		echo('Login successful');
		$_SESSION['id']=$username;
		header("Location: studentportal.php");
	}
	else
		echo "Username or password is incorrect";
	}
	else
		echo("Username or Password is incorrect");	
}
 ?>

</body>
</html>