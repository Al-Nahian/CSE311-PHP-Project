<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
</head>
		<link rel="stylesheet" type="text/css" href="styles/regstyle.css">
<body>
	
		<div class="header">
			<h1>School Management</h1>
			<h2>Student Registration!</h2>
		</div>
	
	<div class="container">
		<div class="logo">
			<img src="images/reglogo.png">
			<p class="logtext">Fill Up<br>The<br>Registration<br>Form!</p>
		</div>
		
		<form class="regform" action="registration.php" method="post">
			
			<div>

				<p>Your Name : <input type="text" name="name" placeholder="Name" required></p>

				<p>Your ID : <input type="number" name="id" placeholder="ID" required></p>

				<p>Your Email : <input type="email" name="email" placeholder="Email" required></p>

				<p>Your Phone Number : <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{11}" required></p>

				<p>Father's Name : <input type="text" name="father" placeholder="Father's Name" required></p>

				<p>Mother's Name : <input type="text" name="mother" placeholder="Mother's Name" required></p>

				<p>Parent's Phone number : <input type="tel" name="guardians_number" placeholder="Guardians Number" pattern="[0-9]{11}" required></p>

				<p>Password : <input type="password" name="password" placeholder="Password" required></p>
				
				<p>Confirm Password : <input type="password" name="confirm_password" placeholder="Confirm Password" required></p>

				<button type="submit" name="register">Register</button>

			</div>

			<div class="notuser">
				<p>
				<label>Not a student?</label>
				<label>Register as a <a href="teachereg.php"><b>teacher</b></a> or a <a href="stuffreg.php"><b>stuff</b></a>.</label>
				</p>
			</div>

			<div class="login">
				<label>Already registered? <a href="stulogin.php"><b>Login here!</b></a></label>
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
		$dad = $_POST['father'];
		$mom = $_POST['mother'];
		$g_number = $_POST['guardians_number'];
		$password = $_POST['password'];
		$con_pass = $_POST['confirm_password'];

		$sql=mysqli_query($mydb,"SELECT * FROM students WHERE id=$id");
 			if(mysqli_num_rows($sql)>=1)
   			{
    			echo('ID already exists!');
   			}
 			else
    		{
    			if ($password==$con_pass) {
					$result = mysqli_query($mydb,"INSERT into students values ('$username','$mail','$id','$phn','$dad','$mom','$g_number','$password')");
					echo('Registered Successfully!');
					header('Location: stulogin.php');
				}
				else
					echo('Passwords does not match!');
			}
	}
	 ?>

</body>
</html>