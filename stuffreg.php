<!DOCTYPE html>
<html>
<head>
	<title>Stuff Registration</title>
</head>
	<link rel="stylesheet" type="text/css" href="styles/regstyle.css">
<body>
	
		<div class="header">
			<h1>School Management</h1>
			<h2>Stuff Registration!</h2>
		</div>
	
	<div class="container">
		<div class="logo">
			<img src="images/reglogo.png">
			<p class="logtext">Fill Up<br>The<br>Registration<br>Form!</p>
		</div>

		<form class="regform" action="stuffreg.php" method="post">
			
			<div>

				<p>Your Name : <input type="text" name="name" placeholder="Name" required></p>

				<p>Stuff ID : <input type="number" name="id" placeholder="ID" required></p>

				<p>Email Address : <input type="email" name="email" placeholder="Email" required></p>

				<p>Phone Number : <input type="number" name="phone" placeholder="Phone Number" required></p>

				<p>Password : <input type="password" name="password" placeholder="Password" required></p>
				
				<p>Confirm Password : <input type="password" name="confirm_password" placeholder="Confirm Password" required></p>

				<button type="submit" name="register">Register</button>

			</div>

			<div class="notuser">
				<p>
				<label>Not a stuff?</label>
				<label>Register as a <a href="registration.php"><b>student</b></a> or a <a href="teachereg.php"><b>teacher</b></a>.</label>
				</p>
			</div>

			<div class="login">
				
				<label>Already registered? <a href="stufflogin.php"><b>Login here!</b></a></label>

			</div>
		</form>
	</div>

<?php 

	session_start();
	
	$mydb = mysqli_connect('localhost','root','','project') or die("Couldn't connect to database!");
	if(isset($_POST['register']))
	{
		$username = $_POST['name'];
		$id = $_POST['id'];
		$mail = $_POST['email'];
		$phn = $_POST['phone'];
		$password = $_POST['password'];
		$con_pass = $_POST['confirm_password'];

		$sql=mysqli_query($mydb,"SELECT * FROM stuffs WHERE id=$id");
 			if(mysqli_num_rows($sql)>=1)
   			{
    			echo('ID already exists!');
   			}
 			else
    		{
    			if ($password==$con_pass) {
					$result = mysqli_query($mydb,"INSERT into stuffs values ('$username','$mail','$id','$phn','$password')");
					echo('Registered Successfully!');
					header('Location: stufflogin.php');
				}
				else
					echo('Passwords does not match!');

			}
	}


	 ?>

</body>
</html>