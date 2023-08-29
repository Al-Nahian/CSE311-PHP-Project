<!DOCTYPE html>
<html>
<head>
	<title>Stuff Login</title>
</head>
	<link rel="stylesheet" type="text/css" href="styles/logstyle.css">
<body>

	<div class="header">
		<h1>School Management System</h1>
		<h2 style="left: 40%;">Stuff Login Portal</h2>
	</div>

	<div class="container">
		
		<form class="loginform" action="stufflogin.php" method="post">
			<input type="text" name="id" placeholder="Stuff ID" required>

			<input type="password" name="password" placeholder="Password" required>

			<button type="submit" name="login">Login</button>

		</form>

		<div>
			
			<label>Not an user? <a href="stuffreg.php"><b>Register Now!</b></a></label>
		</div>
	</div>


<?php 
	session_start();
	$conn = mysqli_connect('localhost','root','','project');
	if (isset($_POST['login'])) {
	$username = $_POST['id'];
	$password = $_POST['password'];

	$users = mysqli_query($conn,"SELECT * FROM stuffs WHERE id=$username");
	

	if (mysqli_num_rows($users)!=0) {
		$user = mysqli_fetch_object($users);

	if ($username== $user->id && $password==$user->password) {
		echo('Login successful');
		$_SESSION['id']=$username;
		header("Location: stuffportal.php");
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