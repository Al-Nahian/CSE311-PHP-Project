<?php 
	session_start();
	if ($_SESSION['id']) {
		echo "Hello " . $_SESSION['id']. (";");
	}
	else
		header("Location: teacherlogin.php");

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Teacher Portal</title>
</head>
<body>
	<div class="header">
		<h1>Welcome to Teacher Portal!</h1>
	</div>

	<div class="courses">
		<p><b><u>Manage Courses </u></b></p>
		<form method="post">
		<p>Student ID : <input type="number" name="id" required></p>
		<p>Course Name : <input type="text" name="c_name" required></p>
		<p>Section : <input type="number" name="sec" required></p>
		<p>Faculty Initial : <input type="text" name="fac" required></p>
		<p>Semester : <input type="text" name="sem" required></p>
		<button type="submit" name="enroll">Enroll</button>
		</form>
		<p>
		<?php 
		$mydb = mysqli_connect('localhost','root','','project');

		if (isset($_POST['enroll'])) 
		{
			
			$id = $_POST['id'];
			$c_name = $_POST['c_name'];
			$sec = $_POST['sec'];
			$fac = $_POST['fac'];
			$sem = $_POST['sem'];

			$sql=mysqli_query($mydb,"SELECT * FROM students WHERE id=$id");
 			if(mysqli_num_rows($sql)==0)
   			{
    			echo('Student id does not exist!');
   			}
   			else 
   			{
   				$query = mysqli_query($mydb,"INSERT into courses values (0,'$id','$c_name','$sec','$fac','$sem')");
   				echo('Successfully Enrolled!');
   			}
		}
		 ?>
		 </p>
	</div>

	<div class="container">
		<form method="post">
		<button type="submit" name="stinfo">Get Student info</button> <br>
		<button type="submit" name="stuinfo">Get Stuff info</button><br>
		</form>

		<?php 
		if (isset($_POST['stinfo'])) 
			{
				$sql=mysqli_query($mydb,"SELECT * FROM students");
 				if(mysqli_num_rows($sql)>=1)
   				{
  					echo "<table border = '1'><tr><th>Name</th><th>Email</th><th>Phone Number</th><th>ID</th><th>Parent's Number</th>";
    				while ($row = mysqli_fetch_assoc($sql)) 
    				{
   						echo "<tr><td>".$row['name']."</td><td>".$row['email']."</td><td>"."0".$row['number']."</td><td>".$row['id']."</td><td>"."0".$row['parents_number']."</td>";
    				}
   				}else
   				{
   					echo('No student is currently enrolled!');
   				}
   			}

   		if (isset($_POST['stuinfo'])) 
			{
				$sql1=mysqli_query($mydb,"SELECT * FROM stuffs");
 				if(mysqli_num_rows($sql1)>=1)
   				{
  					echo "<table border = '1'><tr><th>Name</th><th>Email</th><th>Phone Number</th>";
    				while ($row = mysqli_fetch_assoc($sql1)) 
    				{
   						echo "<tr><td>".$row['username']."</td><td>".$row['mail']."</td><td>"."0".$row['phone']."</td>";
    				}
   				}else
   				{
   					echo('No stuff is currently enrolled!');
   				}
   			}
   				
		 ?>

	</div>

	<div class="update">
		
		<form method="post">
			<p><button type="submit" name="edit">Click</button> to edit results of students.</p>
		</form>

		<?php 

			if (isset($_POST['edit'])) {
				header("Location: result.php");
			}

		 ?>

	</div>


	<div class="logout">
			
		<p><a href="logout.php">Logout</a></p>

	</div>

</body>
</html>