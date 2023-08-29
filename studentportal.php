
<?php 
	session_start();
	if ($_SESSION['id']) {
		echo "Hello " . $_SESSION['id']. (";");
	}
	else
		header("Location: stulogin.php");

 ?>




<!DOCTYPE html>
<html>
<head>
	<title>Student Portal</title>
</head>
<body>
	<div class="header">
		<h1>Welcome to Student Portal!</h1>
	</div>

	<div class="info">
		<p>Your info :</p>
		<table border="1">
			<tr>
				<th>Name</th>
				<th>ID</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Father's Name</th>
				<th>Mother's Name</th>
				<th>Parent's Number</th>
			</tr>
		<?php 
		$conn = mysqli_connect('localhost','root','','project');
		$id = $_SESSION['id'];
		$users = mysqli_query($conn,"SELECT * FROM students WHERE id=$id");	
		$user = mysqli_fetch_object($users);
		echo "<tr><td>".($user->name)."</td><td>".($user->id)."</td><td>".($user->email)."</td><td>0".($user->number).
		"</td><td>".($user->fathers_name)."</td><td>".($user->mothers_name)."</td><td>0".($user->parents_number)."</td>";
		 ?>
		 </table>

	</div>

	<div class="course">
		<p>Course info :</p>
			<table>
			<?php
			$mydb = mysqli_connect('localhost','root','','project');
			$sql=mysqli_query($mydb,"SELECT * FROM courses WHERE id=$id");
 				if(mysqli_num_rows($sql)>=1)
   				{
    				echo "<table border = '1'><tr><th>Course Name</th><th>Course Code</th><th>Section</th><th>Faculty</th><th>Semester</th>";
    				while ($row = mysqli_fetch_assoc($sql)) {
    					echo "<tr><td>".$row['course_name']."</td><td>".$row['no']."</td><td>".$row['section']."</td><td>".$row['faculty']."</td><td>".$row['semester']."</td>";
    				}
   				}else
   				{
   					echo('No courses registered yet!');
   				}
			 ?>
			</table>
			<br>

	</div>

		<div class="drop">
			<form method="post">
			<input type="number" name="c_code" placeholder="Course Name">
			<button type="submit" name="drp">Drop course</button> 
			<p></a><button type="submit" name="result">Get result</button></p>
			</form>
				<?php 
				$mydb = mysqli_connect('localhost','root','','project');
					if (isset($_POST['drp'])) 
					{
						$no = $_POST['c_code'];
						$db = mysqli_query($mydb,"DELETE FROM courses WHERE no=$no");
						if ($db) {
							echo('Course dropped!' . '<a href="studentportal.php">Refresh</a>'.' to see enrolled courses!');
						}else
							echo('course not found');
					}
					if (isset($_POST['result'])) 
					{
						$sql1=mysqli_query($mydb,"SELECT * FROM results WHERE id=$id");
 							if(mysqli_num_rows($sql1)>=1)
   							{
    							echo "<table border = '1'><tr><th>Course Name</th><th>Section</th><th>Faculty</th><th>Semester</th><th>Grade</th>";
    							while ($row = mysqli_fetch_assoc($sql1)) 
    							{
    								echo "<tr><td>".$row['c_name']."</td><td>".$row['section']."</td><td>".$row['initial']."</td><td>".$row['semester']."</td><td>".$row['grade']."</td>";
    							}
   							}else
   								{
   									echo('No result found!');
   								}
					}
				 ?>
		</div>
		<br>

	<div class="logout">
		<p><a href="logout.php">Logout</a></p>
	</div>

</body>
</html>